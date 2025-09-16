<?php

namespace App\Http\Controllers;

use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
use App\Models\ti_kartu_stok;
use App\Models\ts_retur_detail;
use App\Models\ts_retur_header;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Codedge\code128\PDF_Code128 as Code128PDF_Code128;
use Codedge\code128\PDF_Code128\PDF_Code128 as PDF_Code128PDF_Code128;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\PDF;
use Codedge\Fpdf\code128\PDF_Code128;
use Codedge\Fpdf\Fpdf128;
use \Milon\Barcode\DNS1D;
use simitsdk\phpjasperxml\PHPJasperXML;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Net\SFTP;
// use Oriceon\PdfMerger\Facades\PdfMerger;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class FarmasiController extends Controller
{
    public function index_layanan_resep()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'farmasi_1';
        $sidebar_m = 'farmasi_1';
        $mt_unit = DB::select('select * from mt_unit where group_unit = ?', (['J']));
        $now = $this->get_date();
        return view('farmasi.index_layanan_resep', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'mt_unit'
        ]));
    }
    public function index_cek_pasien_kronis()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'index_cek_pasien_kronis';
        $sidebar_m = 'farmasi_1';
        $now = $this->get_date();
        return view('farmasi.index_cek_pasien_kronis', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
        ]));
    }
    public function datakunjunganpasienfarmasi()
    {
        $title = 'SIMRS - Data Kunjungan Pasien';
        $sidebar = 'datakunjunganpasienfarmasi';
        $sidebar_m = 'farmasi_1';
        $now = $this->get_date();
        return view('farmasi.index_data_kunjungan_pasien', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
        ]));
    }
    public function cari_data_kunjungan(request $request)
    {
        $tglawal = $request->tanggalawal;
        $tglakhir = $request->tanggalakhir;
        $sk = db::select('SELECT kode_kunjungan,no_rm,fc_nama_px(no_rm) AS nama_pasien,fc_alamat(no_rm) AS alamat,DATE(tgl_masuk) AS tgl_masuk
        ,no_sep,catatan,fc_nama_unit1(kode_unit) AS nama_unit
        FROM ts_kunjungan WHERE DATE(tgl_masuk) BETWEEN ?  AND ? AND status_kunjungan != 8', [$tglawal, $tglakhir]);
        return view('farmasi.tabel_pasien_kronis', compact([
            'sk'
        ]));
    }
    public function cari_pasien_kronis(request $request)
    {
        $tglawal = $request->tanggalawal;
        $tglakhir = $request->tanggalakhir;
        $sk = db::select('SELECT kode_kunjungan,no_rm,fc_nama_px(no_rm) AS nama_pasien,fc_alamat(no_rm) AS alamat,DATE(tgl_masuk) AS tgl_masuk
        ,no_sep,catatan,fc_nama_unit1(kode_unit) AS nama_unit
        FROM ts_kunjungan WHERE DATE(tgl_masuk) BETWEEN ?  AND ? AND catatan = ?', [$tglawal, $tglakhir, 'KRONIS']);
        return view('farmasi.tabel_pasien_kronis', compact([
            'sk'
        ]));
    }
    public function cari_detail_pasien_kronis(request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $rm = $request->rm;
        $sep = $request->sep;

        $farmasi = db::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit > ? and status_layanan != ?', [$kodekunjungan, 4000, 3]);
        $farmasi2 = db::select('select row_id_header,b.kode_barang as kode_barang,nama_barang,d.NAMA_TARIF,jumlah_layanan
        ,b.aturan_pakai,b.total_layanan from ts_layanan_header a
        left outer join ts_layanan_detail b on a.id = b.row_id_header
        left outer join mt_barang c on b.kode_barang = c.kode_barang
        left outer join mt_tarif_header d on substr(b.kode_tarif_detail,1,6) = d.KODE_TARIF_HEADER
        where a.kode_kunjungan = ? and a.kode_unit > ? and a.status_layanan != ? ', [$kodekunjungan, 4000, 3]);

        $hasil_lab = DB::select('SELECT * FROM ts_kunjungan a INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan` WHERE a.`kode_kunjungan` = ? AND b.`kode_unit` = ? ORDER BY a.`kode_kunjungan` DESC LIMIT 1', [$kodekunjungan, '3002']);

        $hasil_rad = DB::select('SELECT * FROM ts_hasil_expertisi WHERE kode_kunjungan = ? ORDER BY id DESC', [$kodekunjungan]);
        $date = $this->get_date();

        $mt_pasien = db::SELECT('select *,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $assesmen_dokter = db::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('farmasi.detail_kronis', compact([
            'farmasi',
            'farmasi2',
            'assesmen_dokter',
            'hasil_lab',
            'hasil_rad',
            'date',
            'sep',
            'mt_pasien'
        ]));
    }
    public function index_cari_resep()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'farmasi_3';
        $sidebar_m = 'farmasi_3';
        $now = Carbon::now();
        // $oneweek = '2023-09-01';
        $oneweek = $now->startOfWeek()->format('Y-m-d');
        $now = $this->get_date();
        // $weekEndDate = (Carbon::now()->subMonth(1)->toDateString());
        return view('farmasi.index_cari_resep', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'oneweek'
        ]));
    }
    public function ambil_kartu_stok(Request $request)
    {
        $tanggal_awal = $request->tanggalawal;
        $tanggal_akhir = $request->tanggalakhir;
        // $stok = DB::select('select no_dokumen,fc_nama_barang(kode_barang) as nama_barang,tgl_stok,stok_last,stok_in,stok_out,stok_current,harga_beli,keterangan from ti_kartu_stok WHERE kode_unit = ? AND DATE(tgl_stok) BETWEEN ? AND ? ORDER BY no DESC',[auth()->user()->unit,$tanggal_awal,$tanggal_akhir]);
        $unit = auth()->user()->unit;
        $stok = DB::select("CALL WSP_Kartu_Stok('','$tanggal_awal','$tanggal_akhir','$unit')");
        return view('farmasi.tabel_kartu_stok', compact([
            'stok'
        ]));
    }
    public function index_kartu_stok()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'farmasi_4';
        $sidebar_m = 'farmasi_4';
        $now = Carbon::now();
        // $oneweek = '2023-09-01';
        $oneweek = $now->startOfWeek()->format('Y-m-d');
        $now = $this->get_date();
        // $weekEndDate = (Carbon::now()->subMonth(1)->toDateString());
        return view('farmasi.index_kartu_stok', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'oneweek'
        ]));
    }
    public function ambil_data_pasien_far(Request $request)
    {
        $rm = $request->rm;
        $poliklinik = $request->poliklinik;
        $tanggalcari = $request->tanggalcari;
        $now = $this->get_date();
        if ($tanggalcari == $now) {
            $kunjungan = DB::select('SELECT date(tgl_masuk) as tgl_masuk,no_rm,kode_kunjungan,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat,fc_nama_unit1(kode_unit) AS nama_unit,kode_unit, fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin FROM ts_kunjungan WHERE kode_unit = ? AND status_kunjungan = ? AND date(tgl_masuk) = ?', [$poliklinik, '1', $tanggalcari]);
        } else {
            $kunjungan = DB::select('SELECT date(tgl_masuk) as tgl_masuk,no_rm,kode_kunjungan,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat,fc_nama_unit1(kode_unit) AS nama_unit,kode_unit, fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin FROM ts_kunjungan WHERE kode_unit = ? AND status_kunjungan <> ? AND date(tgl_masuk) = ?', [$poliklinik, '8', $tanggalcari]);
        }
        return view('farmasi.tabel_pasien_poli', compact([
            'kunjungan'
        ]));
        // $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        // return view('farmasi.detail_pasien_pencarian', compact([
        //     'mt_pasien',
        //     'kunjungan'
        // ]));
    }
    public function ambil_detail_pasien(Request $request)
    {
        $rm = $request->rm;
        $kodeunit = $request->kodeunit;
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('SELECT date(tgl_masuk) as tgl_masuk,no_rm,kode_kunjungan,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat,fc_nama_unit1(kode_unit) AS nama_unit,kode_unit, fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin FROM ts_kunjungan WHERE no_rm = ? AND kode_unit = ? AND status_kunjungan <> ? AND kode_kunjungan = ?', [$rm, $kodeunit, '8', $kodekunjungan]);
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $orderan = db::select('SELECT * ,fc_nama_unit1(unit_pengirim) AS nama_unit,fc_nama_paramedis1(dok_kirim) AS nama_dokter FROM ts_layanan_detail_order a
        LEFT OUTER JOIN ts_layanan_header_order b ON a.`row_id_header` = b.`id`
        WHERE DATE(a.`tgl_layanan_detail`) = ? AND b.`kode_kunjungan` = ?', ([$kunjungan[0]->tgl_masuk, $kunjungan[0]->kode_kunjungan]));
        return view('farmasi.detail_pasien_pencarian', compact([
            'mt_pasien',
            'kunjungan',
            'orderan'
        ]));
    }
    public function ambil_data_order()
    {
        $cari_order = DB::select('SELECT date(tgl_entry) as tgl_entry
        ,b.no_rm
        ,fc_nama_px(b.no_rm) AS nama_pasien
        ,fc_alamat(b.no_rm) AS alamat
        ,a.id
        ,a.kode_layanan_header
        ,a.status_layanan
        ,a.kode_kunjungan
        ,fc_NAMA_PARAMEDIS1(a.dok_kirim) AS nama_dokter
        ,fc_nama_unit1(a.kode_unit) AS nama_unit
        ,a.unit_pengirim as kode_unit_pengirim
        ,fc_nama_unit1(a.unit_pengirim) as nama_unit_pengirim
        ,status_order
        FROM ts_layanan_header_order a
        LEFT OUTER JOIN ts_kunjungan b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        WHERE a.kode_unit = ? and date(tgl_entry) = curdate()', ([auth()->user()->unit]));
        return view('farmasi.tabel_riwayat_order', compact([
            'cari_order'
        ]));
    }
    public function cari_obat_farmasi(Request $request)
    {
        $nama = $request->nama;
        $pencarian_obat = DB::select('CALL sp_cari_obat_semua(?,?)', [$nama, auth()->user()->unit]);
        return view('farmasi.tabel_obat', compact([
            'pencarian_obat'
        ]));
    }
    public function simpanorderan_far(Request $request)
    {
        $jsf = DB::select('select * from mt_jasa_farmasi');
        $data_obat = json_decode($_POST['data1'], true);
        $arrayindex_reguler = [];
        $arrayindex_kronis = [];
        $arrayindex_kemo = [];
        $arrayindex_hibah = [];
        foreach ($data_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'sub_total_order') {
                if ($dataSet['status_order_2'] == 80) {
                    $arrayindex_reguler[] = $dataSet;
                } else if ($dataSet['status_order_2'] == 81) {
                    $arrayindex_kronis[] = $dataSet;
                } else if ($dataSet['status_order_2'] == 82) {
                    $arrayindex_kemo[] = $dataSet;
                } else if ($dataSet['status_order_2'] == 83) {
                    $arrayindex_hibah[] = $dataSet;
                }
                $arrayindex_far[] = $dataSet;
            }
        }

        foreach ($arrayindex_far as $a) {
            $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
            $stok_current = $cek_stok[0]->stok_current - $a['qty_order'];
            if ($stok_current < 0) {
                $data = [
                    'kode' => 500,
                    'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                ];
                echo json_encode($data);
                die;
            }
        }
        $cek_reg = count($arrayindex_reguler);
        $cek_kron = count($arrayindex_kronis);
        $cek_kemo = count($arrayindex_kemo);
        $cek_hib = count($arrayindex_hibah);
        $data_kunjungan = DB::select('select *,fc_nama_px(no_rm) AS nama_pasien,fc_alamat(no_rm) AS alamat_pasien from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kodeunit = auth()->user()->unit;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kodeunit]);
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $kategori_resep = 'Resep Kredit';
            $kode_tipe_transaki = 2;
            $status_layanan = 2;
        } else {
            $kategori_resep = 'Resep Tunai';
            $kode_tipe_transaki = 1;
            $status_layanan = 1;
        }
        //insert resep reguler
        if ($cek_reg > 0) {
            foreach ($arrayindex_reguler as $a) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_current = $cek_stok[0]->stok_current - $a['qty_order'];
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                }
            }
            $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            //insert layanan header
            try {
                $ts_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' => $this->get_now(),
                    'kode_kunjungan' => $request->kodekunjungan,
                    'kode_unit' => auth()->user()->unit,
                    'kode_tipe_transaksi' => '2',
                    'pic' => auth()->user()->id,
                    'status_layanan' => '8',
                    'keterangan' => 'FARMASI BARU',
                    'status_retur' => 'OPN',
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'status_pembayaran' => 'OPN',
                    'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                    'unit_pengirim' => $data_kunjungan[0]->kode_unit
                ];
                $header = ts_layanan_header_dummy::create($ts_layanan_header);
            } catch (\Exception $e) {
                $data = [
                    'kode' => 500,
                    'message' => $e->getMessage(),
                ];
                echo json_encode($data);
            }
            //end of insert layanan
            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail obat
            foreach ($arrayindex_reguler as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat = $this->createLayanandetail();
                try {
                    $ts_layanan_detail = [
                        'id_layanan_detail' => $kode_detail_obat,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_tarif_detail' => '',
                        'total_tarif' => $a['harga2_order'],
                        'jumlah_layanan' => $a['qty_order'],
                        'total_layanan' => $total,
                        'diskon_layanan' => $a['disc_order'],
                        'grantotal_layanan' => $grandtotal,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'kode_barang' => $a['kode_barang_order'],
                        'aturan_pakai' => $a['dosis_order'],
                        'kategori_resep' => $kategori_resep,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'tipe_anestesi' => $a['status_order_2'],
                        'tagihan_pribadi' => $tagihan_pribadi,
                        'tagihan_penjamin' => $tagihan_penjamin,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $header->id,
                    ];
                    $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
                } catch (\Exception $e) {
                    $data = [
                        'kode' => 500,
                        'message' => $e->getMessage(),
                    ];
                    echo json_encode($data);
                }
                $totalheader = $totalheader + $grandtotal;
            }
            //end layanan detail obat
            //insert ti_kartu_stok dan jasa embalase
            $get_detail_obat = DB::connection('mysql4')->select('select * from ts_layanan_detail where row_id_header = ? and kode_tarif_detail = ?', [$header->id, '']);
            foreach ($get_detail_obat as $do) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$do->kode_barang, auth()->user()->unit]));
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$do->kode_barang]);
                $stok_current = $cek_stok[0]->stok_current - $do->jumlah_layanan;
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                    die;
                }
                $data_ti_kartu_stok = [
                    'no_dokumen' => $do->kode_layanan_header,
                    'no_dokumen_detail' => $do->id_layanan_detail,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $do->kode_barang,
                    'stok_last' => $cek_stok[0]->stok_current,
                    'stok_out' => $do->jumlah_layanan,
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->hna,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_pribadi' => 0,
                    'tagihan_penjamin' => 0,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            }
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagian_penjamin_head = $jsf[0]->jasa_baca;
                $tagian_pribadi_head = 0;
            } else {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = $jsf[0]->jasa_baca;
            }
            $ts_layanan_detail3 = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => 'TX23523',
                'total_tarif' => $jsf[0]->jasa_baca,
                'jumlah_layanan' => 1,
                'total_layanan' => $jsf[0]->jasa_baca,
                'grantotal_layanan' => $jsf[0]->jasa_baca,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_pribadi' => $tagian_pribadi_head,
                'tagihan_penjamin' => $tagian_penjamin_head,
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $header->id,
            ];
            $detail3 = ts_layanan_detail_dummy::create($ts_layanan_detail3);
            //end layanan detail

            //update layanan header
            $totalheader = $totalheader + $jsf[0]->jasa_baca;
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagihan_penjamin_header = $totalheader;
                $tagihan_pribadi_header = '0';
            } else {
                $tagihan_penjamin_header = '0';
                $tagihan_pribadi_header = $totalheader;
            }
            ts_layanan_header_dummy::where('id', $header->id)
                ->update(['status_layanan' => $status_layanan, 'kode_tipe_transaksi' => $kode_tipe_transaki, 'total_layanan' => $totalheader, 'tagihan_penjamin' => $tagihan_penjamin_header, 'tagihan_pribadi' => $tagihan_pribadi_header]);
            //end update layanan header

        }
        //end of reguler

        //insert resep Kronis
        if ($cek_kron > 0) {
            foreach ($arrayindex_kronis as $a) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_current = $cek_stok[0]->stok_current - $a['qty_order'];
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                }
            }
            $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            //insert layanan header
            try {
                $ts_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' => $this->get_now(),
                    'kode_kunjungan' => $request->kodekunjungan,
                    'kode_unit' => auth()->user()->unit,
                    'kode_tipe_transaksi' => '2',
                    'pic' => auth()->user()->id,
                    'status_layanan' => '8',
                    'keterangan' => 'FARMASI BARU',
                    'status_retur' => 'OPN',
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'status_pembayaran' => 'OPN',
                    'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                    'unit_pengirim' => $data_kunjungan[0]->kode_unit
                ];
                $header = ts_layanan_header_dummy::create($ts_layanan_header);
            } catch (\Exception $e) {
                $data = [
                    'kode' => 500,
                    'message' => $e->getMessage(),
                ];
                echo json_encode($data);
            }
            //end of insert layanan


            $now = $this->get_now();
            $totalheader = 0;

            //create layanan detail obat
            foreach ($arrayindex_kronis as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat = $this->createLayanandetail();
                try {
                    $ts_layanan_detail = [
                        'id_layanan_detail' => $kode_detail_obat,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_tarif_detail' => '',
                        'total_tarif' => $a['harga2_order'],
                        'jumlah_layanan' => $a['qty_order'],
                        'total_layanan' => $total,
                        'diskon_layanan' => $a['disc_order'],
                        'grantotal_layanan' => $grandtotal,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'kode_barang' => $a['kode_barang_order'],
                        'aturan_pakai' => $a['dosis_order'],
                        'kategori_resep' => $kategori_resep,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'tipe_anestesi' => $a['status_order_2'],
                        'tagihan_pribadi' => $tagihan_pribadi,
                        'tagihan_penjamin' => $tagihan_penjamin,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $header->id,
                    ];
                    $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
                } catch (\Exception $e) {
                    $data = [
                        'kode' => 500,
                        'message' => $e->getMessage(),
                    ];
                    echo json_encode($data);
                }
                $totalheader = $totalheader + $grandtotal;
            }
            //insert ti_kartu_stok dan jasa embalase
            $get_detail_obat = DB::connection('mysql4')->select('select * from ts_layanan_detail where row_id_header = ? and kode_tarif_detail = ?', [$header->id, '']);
            foreach ($get_detail_obat as $do) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$do->kode_barang, auth()->user()->unit]));
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$do->kode_barang]);
                $stok_current = $cek_stok[0]->stok_current - $do->jumlah_layanan;
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                    die;
                }
                $data_ti_kartu_stok = [
                    'no_dokumen' => $do->kode_layanan_header,
                    'no_dokumen_detail' => $do->id_layanan_detail,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $do->kode_barang,
                    'stok_last' => $cek_stok[0]->stok_current,
                    'stok_out' => $do->jumlah_layanan,
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->hna,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_pribadi' => 0,
                    'tagihan_penjamin' => 0,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            }
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagian_penjamin_head = $jsf[0]->jasa_baca;
                $tagian_pribadi_head = 0;
            } else {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = $jsf[0]->jasa_baca;
            }
            $ts_layanan_detail3 = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => 'TX23523',
                'total_tarif' => $jsf[0]->jasa_baca,
                'jumlah_layanan' => 1,
                'total_layanan' => $jsf[0]->jasa_baca,
                'grantotal_layanan' => $jsf[0]->jasa_baca,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_pribadi' => $tagian_pribadi_head,
                'tagihan_penjamin' => $tagian_penjamin_head,
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $header->id,
            ];
            $detail3 = ts_layanan_detail_dummy::create($ts_layanan_detail3);
            //end layanan detail

            //update layanan header
            $totalheader = $totalheader + $jsf[0]->jasa_baca;
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagihan_penjamin_header = $totalheader;
                $tagihan_pribadi_header = '0';
            } else {
                $tagihan_penjamin_header = '0';
                $tagihan_pribadi_header = '$totalheader';
            }
            ts_layanan_header_dummy::where('id', $header->id)
                ->update(['status_layanan' => $status_layanan, 'kode_tipe_transaksi' => $kode_tipe_transaki, 'total_layanan' => $totalheader, 'tagihan_penjamin' => $tagihan_penjamin_header, 'tagihan_pribadi' => $tagihan_pribadi_header]);
            //end update layanan header
        }
        //end of Kronis

        //insert resep kemo
        if ($cek_kemo > 0) {
            foreach ($arrayindex_kemo as $a) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_current = $cek_stok[0]->stok_current - $a['qty_order'];
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                }
            }
            $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            // $ts_layanan_header = [
            //     'kode_layanan_header' => $kode_layanan_header,
            //     'tgl_entry' => $this->get_now(),
            //     'kode_kunjungan' => $request->kodekunjungan,
            //     'kode_unit' => auth()->user()->unit,
            //     'kode_tipe_transaksi' => '2',
            //     'pic' => auth()->user()->id,
            //     'status_layanan' => '3',
            //     'keterangan' => 'FARMASI BARU',
            //     'status_retur' => 'OPN',
            //     'tagihan_pribadi' => '0',
            //     'tagihan_penjamin' => '0',
            //     'status_pembayaran' => 'OPN',
            //     'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            //     'unit_pengirim' => $data_kunjungan[0]->kode_unit
            // ];
            // $header = ts_layanan_header_dummy::create($ts_layanan_header);
            // $now = $this->get_now();
            // $totalheader = 0;
            //insert layanan header
            try {
                $ts_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' => $this->get_now(),
                    'kode_kunjungan' => $request->kodekunjungan,
                    'kode_unit' => auth()->user()->unit,
                    'kode_tipe_transaksi' => '2',
                    'pic' => auth()->user()->id,
                    'status_layanan' => '8',
                    'keterangan' => 'FARMASI BARU',
                    'status_retur' => 'OPN',
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'status_pembayaran' => 'OPN',
                    'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                    'unit_pengirim' => $data_kunjungan[0]->kode_unit
                ];
                $header = ts_layanan_header_dummy::create($ts_layanan_header);
            } catch (\Exception $e) {
                $data = [
                    'kode' => 500,
                    'message' => $e->getMessage(),
                ];
                echo json_encode($data);
            }
            //end of insert layanan


            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail
            // foreach ($arrayindex_kemo as $a) {
            //     $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
            //     $total = $a['harga2_order'] * $a['qty_order'];
            //     $diskon = $a['disc_order'];
            //     $hitung = $diskon / 100 * $total;
            //     $grandtotal = $total - $hitung + 1200 + 500;

            //     if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            //         $tagihan_pribadi = 0;
            //         $tagihan_penjamin = $grandtotal;
            //     } else {
            //         $tagihan_pribadi = $grandtotal;
            //         $tagihan_penjamin = 0;
            //     }
            //     $kode_detail_obat_kemo = $this->createLayanandetail();
            //     $ts_layanan_detail = [
            //         'id_layanan_detail' => $kode_detail_obat_kemo,
            //         'kode_layanan_header' => $kode_layanan_header,
            //         'kode_tarif_detail' => '',
            //         'total_tarif' => $a['harga2_order'],
            //         'jumlah_layanan' => $a['qty_order'],
            //         'total_layanan' => $total,
            //         'diskon_layanan' => $a['disc_order'],
            //         'grantotal_layanan' => $grandtotal,
            //         'status_layanan_detail' => 'OPN',
            //         'tgl_layanan_detail' => $now,
            //         'kode_barang' => $a['kode_barang_order'],
            //         'aturan_pakai' => $a['dosis_order'],
            //         'kategori_resep' => $kategori_resep,
            //         'satuan_barang' => $mt_barang[0]->satuan,
            //         'tipe_anestesi' => $a['status_order_2'],
            //         'tagihan_pribadi' => $tagihan_pribadi,
            //         'tagihan_penjamin' => $tagihan_penjamin,
            //         'tgl_layanan_detail_2' => $now,
            //         'row_id_header' => $header->id,
            //     ];
            //     $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
            //     //insert_ti_kartu_stok
            //     $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
            //     $stok_last = $cek_stok_curr[0]->stok_current;
            //     $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

            //     $data_ti_kartu_stok = [
            //         'no_dokumen' => $kode_layanan_header,
            //         'no_dokumen_detail' => $kode_detail_obat_kemo,
            //         'tgl_stok' => $this->get_now(),
            //         'kode_unit' => auth()->user()->unit,
            //         'kode_barang' => $a['kode_barang_order'],
            //         'stok_last' => $stok_last,
            //         'stok_out' => $a['qty_order'],
            //         'stok_current' => $stok_current,
            //         'harga_beli' => $mt_barang[0]->harga_beli,
            //         'act' => '1',
            //         'act_ed' => '1',
            //         'input_by' => auth()->user()->id,
            //         'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
            //     ];
            //     $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
            //     //end of insert ti_kartu_Stok

            //     $ts_layanan_detail2 = [
            //         'id_layanan_detail' => $this->createLayanandetail(),
            //         'kode_layanan_header' => $kode_layanan_header,
            //         'kode_tarif_detail' => 'TX23513',
            //         'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
            //         'jumlah_layanan' => 1,
            //         'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
            //         'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
            //         'status_layanan_detail' => 'OPN',
            //         'tgl_layanan_detail' => $now,
            //         'tagihan_pribadi' => '0',
            //         'tagihan_penjamin' => '0',
            //         'tgl_layanan_detail_2' => $now,
            //         'row_id_header' => $header->id,
            //     ];
            //     $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            //     $totalheader = $totalheader + $grandtotal;
            // }
            //end layanan detail

            //create layanan detail obat
            foreach ($arrayindex_kemo as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat = $this->createLayanandetail();
                try {
                    $ts_layanan_detail = [
                        'id_layanan_detail' => $kode_detail_obat,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_tarif_detail' => '',
                        'total_tarif' => $a['harga2_order'],
                        'jumlah_layanan' => $a['qty_order'],
                        'total_layanan' => $total,
                        'diskon_layanan' => $a['disc_order'],
                        'grantotal_layanan' => $grandtotal,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'kode_barang' => $a['kode_barang_order'],
                        'aturan_pakai' => $a['dosis_order'],
                        'kategori_resep' => $kategori_resep,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'tipe_anestesi' => $a['status_order_2'],
                        'tagihan_pribadi' => $tagihan_pribadi,
                        'tagihan_penjamin' => $tagihan_penjamin,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $header->id,
                    ];
                    $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
                } catch (\Exception $e) {
                    $data = [
                        'kode' => 500,
                        'message' => $e->getMessage(),
                    ];
                    echo json_encode($data);
                }
                $totalheader = $totalheader + $grandtotal;
            }
            //insert ti_kartu_stok dan jasa embalase
            $get_detail_obat = DB::connection('mysql4')->select('select * from ts_layanan_detail where row_id_header = ? and kode_tarif_detail = ?', [$header->id, '']);
            foreach ($get_detail_obat as $do) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$do->kode_barang, auth()->user()->unit]));
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$do->kode_barang]);
                $stok_current = $cek_stok[0]->stok_current - $do->jumlah_layanan;
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                    die;
                }
                $data_ti_kartu_stok = [
                    'no_dokumen' => $do->kode_layanan_header,
                    'no_dokumen_detail' => $do->id_layanan_detail,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $do->kode_barang,
                    'stok_last' => $cek_stok[0]->stok_current,
                    'stok_out' => $do->jumlah_layanan,
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->hna,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_pribadi' => 0,
                    'tagihan_penjamin' => 0,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            }
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagian_penjamin_head = $jsf[0]->jasa_baca;
                $tagian_pribadi_head = 0;
            } else {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = $jsf[0]->jasa_baca;
            }
            $ts_layanan_detail3 = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => 'TX23523',
                'total_tarif' => $jsf[0]->jasa_baca,
                'jumlah_layanan' => 1,
                'total_layanan' => $jsf[0]->jasa_baca,
                'grantotal_layanan' => $jsf[0]->jasa_baca,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_pribadi' => $tagian_pribadi_head,
                'tagihan_penjamin' => $tagian_penjamin_head,
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $header->id,
            ];
            $detail3 = ts_layanan_detail_dummy::create($ts_layanan_detail3);
            //end layanan detail

            //update layanan header
            $totalheader = $totalheader + $jsf[0]->jasa_baca;
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagihan_penjamin_header = $totalheader;
                $tagihan_pribadi_header = '0';
            } else {
                $tagihan_penjamin_header = '0';
                $tagihan_pribadi_header = '$totalheader';
            }
            ts_layanan_header_dummy::where('id', $header->id)
                ->update(['status_layanan' => $status_layanan, 'kode_tipe_transaksi' => $kode_tipe_transaki, 'total_layanan' => $totalheader, 'tagihan_penjamin' => $tagihan_penjamin_header, 'tagihan_pribadi' => $tagihan_pribadi_header]);
            //end update layanan header
        }
        //end of kemo

        //insert resep hibah
        if ($cek_hib > 0) {
            foreach ($arrayindex_hibah as $a) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_current = $cek_stok[0]->stok_current - $a['qty_order'];
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                }
            }
            $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            //insert layanan header
            try {
                $ts_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' => $this->get_now(),
                    'kode_kunjungan' => $request->kodekunjungan,
                    'kode_unit' => auth()->user()->unit,
                    'kode_tipe_transaksi' => '2',
                    'pic' => auth()->user()->id,
                    'status_layanan' => '8',
                    'keterangan' => 'FARMASI BARU',
                    'status_retur' => 'OPN',
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'status_pembayaran' => 'OPN',
                    'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                    'unit_pengirim' => $data_kunjungan[0]->kode_unit
                ];
                $header = ts_layanan_header_dummy::create($ts_layanan_header);
            } catch (\Exception $e) {
                $data = [
                    'kode' => 500,
                    'message' => $e->getMessage(),
                ];
                echo json_encode($data);
            }
            //end of insert layanan


            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail obat
            foreach ($arrayindex_hibah as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 0 + 0;

                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat_hibah = $this->createLayanandetail();
                try {
                    $ts_layanan_detail = [
                        'id_layanan_detail' => $kode_detail_obat_hibah,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_tarif_detail' => '',
                        'total_tarif' => $a['harga2_order'],
                        'jumlah_layanan' => $a['qty_order'],
                        'total_layanan' => $total,
                        'diskon_layanan' => $a['disc_order'],
                        'grantotal_layanan' => $grandtotal,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'kode_barang' => $a['kode_barang_order'],
                        'aturan_pakai' => $a['dosis_order'],
                        'kategori_resep' => $kategori_resep,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'tipe_anestesi' => $a['status_order_2'],
                        'tagihan_pribadi' => $tagihan_pribadi,
                        'tagihan_penjamin' => $tagihan_penjamin,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $header->id,
                    ];
                    $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
                } catch (\Exception $e) {
                    $data = [
                        'kode' => 500,
                        'message' => $e->getMessage(),
                    ];
                    echo json_encode($data);
                }
                $totalheader = $totalheader + $grandtotal;
            }

            // foreach ($arrayindex_hibah as $a) {
            //     $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
            //     $total = $a['harga2_order'] * $a['qty_order'];
            //     $diskon = $a['disc_order'];
            //     $hitung = $diskon / 100 * $total;
            //     $grandtotal = $total - $hitung + 0 + 0;

            //     if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            //         $tagihan_pribadi = 0;
            //         $tagihan_penjamin = $grandtotal;
            //     } else {
            //         $tagihan_pribadi = $grandtotal;
            //         $tagihan_penjamin = 0;
            //     }
            //     $kode_detail_obat_hibah = $this->createLayanandetail();
            //     $ts_layanan_detail = [
            //         'id_layanan_detail' => $kode_detail_obat_hibah,
            //         'kode_layanan_header' => $kode_layanan_header,
            //         'kode_tarif_detail' => '',
            //         'total_tarif' => $a['harga2_order'],
            //         'jumlah_layanan' => $a['qty_order'],
            //         'total_layanan' => $total,
            //         'diskon_layanan' => $a['disc_order'],
            //         'grantotal_layanan' => $grandtotal,
            //         'status_layanan_detail' => 'OPN',
            //         'tgl_layanan_detail' => $now,
            //         'kode_barang' => $a['kode_barang_order'],
            //         'aturan_pakai' => $a['dosis_order'],
            //         'kategori_resep' => $kategori_resep,
            //         'satuan_barang' => $mt_barang[0]->satuan,
            //         'tipe_anestesi' => $a['status_order_2'],
            //         'tagihan_pribadi' => $tagihan_pribadi,
            //         'tagihan_penjamin' => $tagihan_penjamin,
            //         'tgl_layanan_detail_2' => $now,
            //         'row_id_header' => $header->id,
            //     ];
            //     $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
            //     //insert_ti_kartu_stok
            //     $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
            //     $stok_last = $cek_stok_curr[0]->stok_current;
            //     $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

            //     $data_ti_kartu_stok = [
            //         'no_dokumen' => $kode_layanan_header,
            //         'no_dokumen_detail' => $kode_detail_obat_hibah,
            //         'tgl_stok' => $this->get_now(),
            //         'kode_unit' => auth()->user()->unit,
            //         'kode_barang' => $a['kode_barang_order'],
            //         'stok_last' => $stok_last,
            //         'stok_out' => $a['qty_order'],
            //         'stok_current' => $stok_current,
            //         'harga_beli' => $mt_barang[0]->harga_beli,
            //         'act' => '1',
            //         'act_ed' => '1',
            //         'input_by' => auth()->user()->id,
            //         'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
            //     ];
            //     $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
            //     //end of insert ti_kartu_Stok

            //     $ts_layanan_detail2 = [
            //         'id_layanan_detail' => $this->createLayanandetail(),
            //         'kode_layanan_header' => $kode_layanan_header,
            //         'kode_tarif_detail' => 'TX23513',
            //         'total_tarif' => 0,
            //         'jumlah_layanan' => 1,
            //         'total_layanan' => 0,
            //         'grantotal_layanan' => 0,
            //         'status_layanan_detail' => 'OPN',
            //         'tgl_layanan_detail' => $now,
            //         'tagihan_pribadi' => '0',
            //         'tagihan_penjamin' => '0',
            //         'tgl_layanan_detail_2' => $now,
            //         'row_id_header' => $header->id,
            //     ];
            //     $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            //     $totalheader = $totalheader + $grandtotal;
            // }
            //end layanan detail
            //insert ti_kartu_stok dan jasa embalase
            $get_detail_obat = DB::connection('mysql4')->select('select * from ts_layanan_detail where row_id_header = ? and kode_tarif_detail = ?', [$header->id, '']);
            foreach ($get_detail_obat as $do) {
                $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$do->kode_barang, auth()->user()->unit]));
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$do->kode_barang]);
                $stok_current = $cek_stok[0]->stok_current - $do->jumlah_layanan;
                if ($stok_current < 0) {
                    $data = [
                        'kode' => 500,
                        'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                    ];
                    echo json_encode($data);
                    die;
                }
                $data_ti_kartu_stok = [
                    'no_dokumen' => $do->kode_layanan_header,
                    'no_dokumen_detail' => $do->id_layanan_detail,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $do->kode_barang,
                    'stok_last' => $cek_stok[0]->stok_current,
                    'stok_out' => $do->jumlah_layanan,
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->hna,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_pribadi' => 0,
                    'tagihan_penjamin' => 0,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            }
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = 0;
            } else {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = 0;
            }
            $ts_layanan_detail3 = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => 'TX23523',
                'total_tarif' => 0,
                'jumlah_layanan' => 1,
                'total_layanan' => 0,
                'grantotal_layanan' => 0,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_pribadi' => $tagian_pribadi_head,
                'tagihan_penjamin' => $tagian_penjamin_head,
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $header->id,
            ];
            $detail3 = ts_layanan_detail_dummy::create($ts_layanan_detail3);
            //end layanan detail

            //update layanan header
            $totalheader = $totalheader + 0;
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagihan_penjamin_header = $totalheader;
                $tagihan_pribadi_header = '0';
            } else {
                $tagihan_penjamin_header = '0';
                $tagihan_pribadi_header = $totalheader;
            }
            ts_layanan_header_dummy::where('id', $header->id)
                ->update(['status_layanan' => $status_layanan, 'kode_tipe_transaksi' => $kode_tipe_transaki, 'total_layanan' => $totalheader, 'tagihan_penjamin' => $tagihan_penjamin_header, 'tagihan_pribadi' => $tagihan_pribadi_header]);
            //end update layanan header
        }
        //end of hibah

        //update ts layanan header order
        // $request->nomororder;
        $data = [
            'kode' => 200,
            'message' => 'sukses',
            'idheader' => $header->id
        ];
        echo json_encode($data);
        die;
        // dd('ok');
    }
    public function jumlah_grand_total(Request $request)
    {
        $status = $request->status;
        $resep_reguler = $request->resepreguler;
        $resep_kronis = $request->resepkronis;
        $resep_kemo = $request->resephibah;
        $resep_hibah = $request->resepkemo;
        if ($status == '80') {
            $resep_reguler = $resep_reguler + 1;
        } else if ($status == '81') {
            $resep_kronis = $resep_kronis + 1;
        } else if ($status == '82') {
            $resep_kemo = $resep_kemo + 1;
        } else if ($status == '83') {
            $resep_hibah = $resep_hibah + 1;
        }

        if ($resep_reguler > 0) {
            $reguler = 1;
        } else {
            $reguler = 0;
        }
        if ($resep_kronis > 0) {
            $kronis = 1;
        } else {
            $kronis = 0;
        }
        if ($resep_kemo > 0) {
            $kemo = 1;
        } else {
            $kemo = 0;
        }
        if ($resep_hibah > 0) {
            $hibah = 0;
        } else {
            $hibah = 0;
        }

        $total_resep = $reguler + $kronis + $kemo + $hibah;
        $jasa_resep_lbr = 1000 * $total_resep;
        $subtot2 = $request->subtot2;
        $totalitem = $request->totalitem;
        $grandtotal = $request->grandtotal;
        $jumlahitem = $request->jumlahitem;
        if ($jumlahitem == 'null') {
            $jumlahitem = 1;
        } else {
            $jumlahitem = $request->jumlahitem + 1;
        };
        $new_total_item = $subtot2 + $totalitem;
        $grandtotal = $grandtotal + $subtot2 + 1200 + 500;
        $operator = '+';
        return view('farmasi.grand_total', compact([
            'new_total_item',
            'grandtotal',
            'operator',
            'jumlahitem',
            'resep_reguler',
            'resep_kronis',
            'resep_kemo',
            'resep_hibah',
            'jasa_resep_lbr',
            'total_resep'
        ]));
    }
    public function minus_grand_total(Request $request)
    {
        $reguler = $request->resepreguler;
        $kronis = $request->resepkronis;
        $hibah = $request->resephibah;
        $kemo = $request->resepkemo;
        $jenis = $request->jenis;
        if ($jenis == 80) {
            $reguler = $reguler - 1;
        }
        if ($jenis == 81) {
            $kronis = $kronis - 1;
        }
        if ($jenis == 82) {
            $kemo = $kemo - 1;
        }
        if ($jenis == 83) {
            $hibah = $hibah - 1;
        }
        $resep_reguler = $reguler;
        $resep_kronis = $kronis;
        $resep_kemo = $kemo;
        $resep_hibah = $hibah;

        if ($resep_reguler > 0) {
            $reguler = 1;
        } else {
            $reguler = 0;
        }
        if ($resep_kronis > 0) {
            $kronis = 1;
        } else {
            $kronis = 0;
        }
        if ($resep_kemo > 0) {
            $kemo = 1;
        } else {
            $kemo = 0;
        }
        if ($resep_hibah > 0) {
            $hibah = 0;
        } else {
            $hibah = 0;
        }

        $total_resep = $reguler + $kronis + $kemo + $hibah;
        $jasa_resep_lbr = 1000 * $total_resep;
        $subtot3 = $request->subtot3;
        $totalitem = $request->totalitem;
        $grandtotal = $request->grandtotal;
        $new_total_item = $totalitem - $subtot3;
        $nilai_min = $subtot3 + 1200 + 500;
        $grandtotal = $grandtotal - $nilai_min;
        $operator = '-';
        $jumlahitem = $request->jumlahitem;
        $jumlahitem = $jumlahitem - 1;
        return view('farmasi.grand_total', compact([
            'new_total_item',
            'grandtotal',
            'operator',
            'jumlahitem',
            'resep_reguler',
            'resep_kronis',
            'resep_kemo',
            'resep_hibah',
            'jasa_resep_lbr',
            'total_resep'
        ]));
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function createLayanandetail()
    {
        $q = DB::connection('mysql4')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    public function test_print()
    {
        // ambil ip client
        // dd($this->get_client_ip_env());
        // $connector = new WindowsPrintConnector("termal1");
        // // $connector = new WindowsPrintConnector("smb://computername/Receipt Printer");
        // // $connector = new FilePrintConnector("EPSON TM-T82X Receipt");
        // $printer = new Printer($connector);
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->cut();
        // $printer->close();
        // require('code128.php');
        $get_header = DB::select('select * from ts_layanan_header where id = ?', ['5031937']);
        $dtpx = DB::select('SELECT no_rm,fc_nama_px(no_rm) AS nama, fc_umur(no_rm) AS umur,DATE(fc_tgl_lahir(no_rm)) AS tgl_lahir,fc_alamat(no_rm) AS alamat FROM ts_kunjungan WHERE kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $get_detail = DB::select('SELECT a.kode_barang,b.`nama_barang`,a.aturan_pakai,a.`ed_obat` FROM ts_layanan_detail a
        LEFT OUTER JOIN mt_barang b ON a.`kode_barang` = b.`kode_barang`
        WHERE a.row_id_header = ?', ['5031937']);

        $pdf = new PDF('P', 'in', array('1.97', '2.36'));
        $i = $pdf->GetY();
        // $pdf->AliasNbPages();
        // $pdf->AddPage();
        $pdf->SetTitle('Cetak Etiket');
        $pdf->SetFont('Arial', 'B', 8);
        foreach ($get_detail as $d) {
            if ($d->kode_barang != '') {
                $pdf->SetXY(0, $i);
                $pdf->Cell(0.1, 10, '' . $i, 0, 1);
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(0, 0.4);
                $pdf->Cell(0.3, 0.10, $dtpx[0]->no_rm, 0, 0);
                $pdf->SetXY(1, 0.4);
                $pdf->Cell(0.3, 0.10, $dtpx[0]->tgl_lahir . '   ' . $dtpx[0]->umur, 0, 0);
                $pdf->SetXY(0, 0.6);
                $pdf->Cell(0.3, 0.10, $dtpx[0]->nama, 0, 0);
                $pdf->SetFont('Arial', '', 5);
                $pdf->SetXY(0, 0.8);
                $pdf->MultiCell(1.9, 0.1, $dtpx[0]->alamat);
                $y = $pdf->GetY();
                // $pdf->Cell(0.3, 0.10, $dtpx[0]->alamat, 0, 0);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->SetXY(0, $y + 0.1);
                $pdf->MultiCell(1.8, 0.10, $d->nama_barang);
                $y = $pdf->GetY();
                $pdf->SetXY(0, $y);
                $pdf->MultiCell(1.9, 0.10, $d->aturan_pakai);
                // $pdf->Cell(0.3, 0.10, $d->nama_barang, 0, 0);
                // //A set
                $code = 'CODE 128';
                $pdf->Code128(0.1, 1.6, $code, 1.8, 0.4);
                // // $pdf->Cell(0.3, 0.10, $barcode, 0, 0);
                $y = $pdf->GetY();
                $pdf->SetFont('Arial', 'b', 5);
                $pdf->SetXY(0, $y);
                $pdf->Cell(0.3, 0.10, '06-09-2023', 0, 0);
                $pdf->SetXY(1.2, $y);
                $pdf->Cell(0.3, 0.10, 'EXP 06-09-2023', 0, 0);
                $i = 10;
            }
        }
        // $pdf->Image('public/img/logo_rs2.png', 0.08, 0.05, 0.2, 0.2);
        // $pdf->SetXY(0.5, 0.05);
        // $pdf->Cell(0.3, 0.10, 'INSTALASI FARMASI', 0, 0);
        // $pdf->SetXY(0.3, 0.15);
        // $pdf->Cell(0.3, 0.10, 'RSUD WALED KAB. CIREBON', 0, 0);
        // $pdf->Line(0, 0.34, 100, 0.34);
        // $pdf->SetXY(0, 0.4);
        // $pdf->Cell(0.3, 0.10, '23982408', 0, 0);
        // $pdf->SetFont('Arial', '', 8);
        // $pdf->SetXY(1, 0.4);
        // $pdf->Cell(0.3, 0.10, '22/28/1991' . '   ' . '56', 0, 0);
        // $pdf->SetXY(0, 0.6);
        // $pdf->Cell(0.3, 0.10, 'RIMBOS', 0, 0);
        // $pdf->SetXY(0, 0.8);
        // $pdf->Cell(0.3, 0.10, 'RT 99/99 BLOK M', 0, 0);
        // $pdf->SetFont('Arial', 'B', 8);
        // $pdf->SetXY(0, 1);
        // $pdf->Cell(0.3, 0.10, 'SANTAGESIK INJ', 0, 0);
        // //A set
        // $code = 'CODE 128';
        // $pdf->Code128(0.3, 1.2, $code, 1.5, 0.2);
        // // $pdf->Cell(0.3, 0.10, $barcode, 0, 0);
        // $pdf->SetFont('Arial', '', 5);
        // $pdf->SetXY(0, 1.470);
        // $pdf->Cell(0.3, 0.10, '06-09-2023', 0, 0);
        // $pdf->SetXY(1.2, 1.470);
        // $pdf->Cell(0.3, 0.10, 'EXP 06-09-2023', 0, 0);
        $pdf->Output();
        exit;
        // return;
    }
    public function cari_detail_resep(Request $request)
    {
        $mt_pasien = DB::connection('mysql4')->select('select no_rm,nama_px,fc_alamat(no_rm) as alamat,date(tgl_lahir) as tgl_lahir,fc_umur(no_rm) as umur from mt_pasien where no_rm = ?', [$request->rm]);
        $header_layanan = DB::connection('mysql4')->select('select id,tgl_entry,kode_layanan_header,fc_nama_unit1(unit_pengirim) as nama_unit, unit_pengirim,fc_nama_paramedis1(dok_kirim) as dok_kirim,total_layanan,tagihan_penjamin,tagihan_pribadi from ts_layanan_header where kode_kunjungan = ? and kode_unit = ?', ([$request->kodekunjungan, auth()->user()->unit]));
        $detail = DB::connection('mysql4')->select('SELECT a.id AS id_header
        ,b.`id` AS id_detail
        ,a.`tgl_entry` AS tgl_entry
        ,a.kode_layanan_header
        ,b.`id_layanan_detail`
        ,b.`kode_tarif_detail`
        ,fc_nama_barang(b.`kode_barang`) AS namabarang
        ,b.`jumlah_layanan`
        ,b.satuan_barang
        ,b.`total_layanan`
        ,b.`jumlah_retur`
        ,b.`tagihan_penjamin`
        ,b.`kode_barang`
        ,b.`tagihan_pribadi`
        ,a.`keterangan`
        ,a.`status_layanan`
        ,b.tipe_anestesi
         FROM ts_layanan_header a
        LEFT OUTER JOIN ts_layanan_detail b ON a.`id` = b.`row_id_header`
        WHERE a.`kode_unit` = ? AND a.`kode_kunjungan` = ? AND status_layanan != ?', ([auth()->user()->unit, $request->kodekunjungan, 3]));
        return view('farmasi.index_detail_resep', compact([
            'mt_pasien',
            'header_layanan',
            'detail'
        ]));
    }
    public function CetakEtiket($id)
    {
        $get_header = DB::connection('mysql4')->select('select * from ts_layanan_header where id = ?', [$id]);
        $dtpx = DB::select('SELECT no_rm,fc_nama_px(no_rm) AS nama, fc_umur(no_rm) AS umur,DATE(fc_tgl_lahir(no_rm)) AS tgl_lahir,fc_alamat(no_rm) AS alamat FROM ts_kunjungan WHERE kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $get_detail = DB::connection('mysql4')->select('SELECT a.kode_barang,b.`nama_barang`,a.aturan_pakai,a.`ed_obat`,a.jumlah_layanan,a.jumlah_retur FROM ts_layanan_detail a
        LEFT OUTER JOIN mt_barang b ON a.`kode_barang` = b.`kode_barang`
        WHERE a.row_id_header = ?', [$id]);
        $pdf = new PDF('P', 'in', array('1.97', '2.36'));
        $i = $pdf->GetY();
        // $pdf->AliasNbPages();
        // $pdf->AddPage();
        $pdf->SetTitle('Cetak Etiket');
        $pdf->SetFont('Arial', 'B', 8);
        foreach ($get_detail as $d) {
            $total_barang = $d->jumlah_layanan - $d->jumlah_retur;
            if ($d->kode_barang != '' && $total_barang > 0) {
                $pdf->SetXY(0, $i);
                $pdf->Cell(0.1, 10, '' . $i, 0, 1);
                $pdf->SetFont('Arial', '', 8);
                $pdf->SetXY(0, 0.4);
                $pdf->Cell(0.3, 0.10, $dtpx[0]->no_rm, 0, 0);
                $pdf->SetXY(0.8, 0.4);
                $pdf->Cell(0.3, 0.10, $dtpx[0]->tgl_lahir . '/ usia ' . $dtpx[0]->umur, 0, 0);
                $pdf->SetXY(0, 0.6);
                $pdf->Cell(0.3, 0.10, $dtpx[0]->nama, 0, 0);
                $pdf->SetFont('Arial', '', 5);
                $pdf->SetXY(0, 0.8);
                $pdf->MultiCell(1.9, 0.1, $dtpx[0]->alamat);
                $y = $pdf->GetY();
                // $pdf->Cell(0.3, 0.10, $dtpx[0]->alamat, 0, 0);
                $pdf->SetFont('Arial', 'B', 7);
                $pdf->SetXY(0, $y + 0.1);
                $pdf->MultiCell(1.8, 0.10, $d->nama_barang);
                $y = $pdf->GetY() + 0.007;
                $pdf->SetXY(0, $y);
                $pdf->MultiCell(1.9, 0.10, $d->aturan_pakai);
                // $pdf->Cell(0.3, 0.10, $d->nama_barang, 0, 0);
                // //A set
                $code = 'CODE 128';
                $pdf->Code128(0.1, 1.6, $code, 1.8, 0.4);
                // // $pdf->Cell(0.3, 0.10, $barcode, 0, 0);
                $y = $pdf->GetY();
                $pdf->SetFont('Arial', 'b', 5);
                $pdf->SetXY(0, $y);
                $pdf->Cell(0.3, 0.10, $get_header[0]->tgl_entry, 0, 0);
                $pdf->SetXY(1.2, $y);
                $pdf->Cell(0.3, 0.10, 'EXP' . $d->ed_obat, 0, 0);
                $i = 10;
            }
        }
        $pdf->Output();
        exit;
        // return;
    }
    public function cetaknotafarmasi($id)
    {
        $get_header = DB::connection('mysql4')->select('select *,fc_NAMA_USER(pic) as nama_user from ts_layanan_header where id = ?', [$id]);
        $dtpx = DB::select('SELECT counter,no_rm,fc_nama_px(no_rm) AS nama, fc_umur(no_rm) AS umur,DATE(fc_tgl_lahir(no_rm)) AS tgl_lahir,fc_alamat(no_rm) AS alamat,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as unit,fc_nama_paramedis(kode_paramedis) as dokter,kode_penjamin FROM ts_kunjungan WHERE kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $get_detail = DB::connection('mysql4')->select('SELECT a.kode_tarif_detail,a.kode_barang,b.`nama_barang`,a.jumlah_layanan,a.jumlah_retur,a.tagihan_pribadi,a.tagihan_penjamin FROM ts_layanan_detail a
        LEFT OUTER JOIN mt_barang b ON a.`kode_barang` = b.`kode_barang`
        WHERE a.row_id_header = ?', [$id]);
        if ($dtpx[0]->kode_penjamin == 'P01') {
            $jenis_Resep = 'Resep Tunai';
        } else {
            $jenis_Resep = 'Resep Kredit';
        }
        $pdf = new Fpdf('P', 'cm', array('11', '14'));
        $pdf->AddPage();
        $pdf->SetTitle('Cetak nota farmasi');
        $pdf->SetMargins('15', '20', '14');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Image('public/img/logo_rs.png', 0.5, 0.2, 1.5, 1.1);
        $pdf->SetXY(2, 0.5);
        $pdf->Cell(10, 0.5, 'RINCIAN BIAYA FARMASI', 0, 1);
        $pdf->SetXY(2, 0.8);
        $pdf->Cell(10, 0.5, 'RSUD WALED KAB.CIREBON', 0, 1);
        $pdf->SetXY(8, 1);
        $pdf->Cell(10, 0.5, $jenis_Resep, 0, 1);
        $pdf->SetLineWidth(0.05);
        $pdf->Line(0, 1.6, 78, 1.6);
        $pdf->SetXY(0.5, 1.8);
        $pdf->Cell(10, 0.5, 'Kode Layanan', 0, 1);
        $pdf->SetXY(3, 1.8);
        $pdf->Cell(10, 0.5, ': ' . $get_header[0]->kode_layanan_header, 0, 1);
        $pdf->SetXY(6.5, 1.8);
        $pdf->Cell(10, 0.5, 'RM / Counter', 0, 1);
        $pdf->SetXY(8.3, 1.8);
        $pdf->Cell(10, 0.5, ': ' . $dtpx[0]->no_rm . ' / ' . $dtpx[0]->counter, 0, 1);
        $pdf->SetXY(0.5, 2.2);
        $pdf->Cell(10, 0.5, 'Nama Pasien', 0, 1);
        $pdf->SetXY(3, 2.2);
        $pdf->Cell(10, 0.5, ': ' . $dtpx[0]->nama, 0, 1);
        $pdf->SetXY(0.5, 2.6);
        $pdf->Cell(10, 0.5, 'Tanggal Lahir', 0, 1);
        $pdf->SetXY(3, 2.6);
        $pdf->Cell(10, 0.5, ': ' . $dtpx[0]->tgl_lahir, 0, 1);
        $pdf->SetXY(0.5, 3);
        $pdf->Cell(10, 0.5, 'Alamat', 0, 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(3, 3);
        $pdf->MultiCell(6, 0.4, ': ' . $dtpx[0]->alamat);
        $y = $pdf->GetY() + 0.2;
        $x = $pdf->GetX();
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(0.5, $y);
        $pdf->Cell(10, 0.5, 'Penjamin', 0, 1);
        $pdf->SetXY(3, $y);
        $pdf->Cell(10, 0.5, ': ' . $dtpx[0]->nama_penjamin, 0, 1);
        $y2 = $y + 0.5;
        $pdf->SetXY(0.5, $y2);
        $pdf->Cell(10, 0.5, 'Unit Asal', 0, 1);
        $pdf->SetXY(3, $y2);
        $pdf->Cell(10, 0.5, ': ' . $dtpx[0]->unit, 0, 1);
        $y3 = $y2 + 0.5;
        $pdf->SetXY(0.5, $y3);
        $pdf->Cell(10, 0.5, 'Dokter', 0, 1);
        $pdf->SetXY(3, $y3);
        $pdf->Cell(10, 0.5, ': ' . $dtpx[0]->dokter, 0, 1);
        $y4 = $y3 + 0.5;
        $pdf->Line(0, $y4, 78, $y4);
        $y5 = $y4 + 0.01;
        $pdf->SetXY(0.5, $y5);
        $pdf->Cell(10, 0.5, 'Nama Obat', 0, 1);
        $pdf->SetXY(7, $y5);
        $pdf->Cell(10, 0.5, 'QTY', 0, 1);
        $pdf->SetXY(9, $y5);
        $pdf->Cell(10, 0.5, 'Jumlah', 0, 1);
        $y6 = $y5 + 0.4;
        $pdf->Line(0, $y6, 78, $y6);
        $y7 = $y6 + 0.2;
        $total_item = 0;
        $jasa_resep = 0;
        $jasa_resep_total = 0;
        $subtotal = 0;
        foreach ($get_detail as $d) {
            $pdf->SetFont('Arial', 'B', 7);
            if ($d->nama_barang != '') {
                if ($dtpx[0]->kode_penjamin == 'P01') {
                    $jumlah = $d->tagihan_pribadi;
                } else {
                    $jumlah = $d->tagihan_penjamin;
                }
                $qty = $d->jumlah_layanan - $d->jumlah_retur;
                if ($qty > 0) {
                    $pdf->SetXY(0.5, $y7);
                    $pdf->MultiCell(7, 0.4, $d->nama_barang);
                    $pdf->SetXY(7.3, $y7);
                    $pdf->Cell(10, 0.5, $qty, 0, 1);
                    $pdf->SetXY(8.5, $y7);
                    $pdf->Cell(10, 0.5, number_format($jumlah, 2), 0, 1);
                    $y7 = $y7 + 0.4;
                    $total_item = $total_item + 1;
                    $subtotal = $subtotal + $jumlah;
                }
            }
            if ($d->kode_tarif_detail == 'TX23523') {
                if ($dtpx[0]->kode_penjamin == 'P01') {
                    $jumlah_resep = $d->tagihan_pribadi;
                } else {
                    $jumlah_resep = $d->tagihan_penjamin;
                }
                $jasa_resep = $jasa_resep + 1;
                $jasa_resep_total = $jasa_resep_total + $jumlah_resep;
            }
        }
        $y8 = $pdf->GetY() + 0.3;
        $pdf->Line(0, $y8, 78, $y8);
        $y9 = $y8 + 0.3;
        $pdf->SetXY(0.5, $y9);
        $pdf->Cell(10, 0.5, 'Total item : ' . $total_item, 0, 1);
        $pdf->SetXY(6, $y9);
        $pdf->Cell(10, 0.5, 'Subtotal', 0, 1);
        $pdf->SetXY(8.5, $y9);
        $pdf->Cell(10, 0.5, ': ' . number_format($subtotal, 2), 0, 1);
        $pdf->SetXY(6, $y9 + 0.4);
        $pdf->Cell(10, 0.5, 'Jasa Resep' . ' ( ' . $jasa_resep . ' )', 0, 1);
        $pdf->SetXY(8.5, $y9 + 0.4);
        $pdf->Cell(10, 0.5, ': ' . number_format($jasa_resep_total, 2), 0, 1);
        $y10 = $pdf->GetY() + 0.1;
        $pdf->Line(6, $y10, 78, $y10);
        $y11 = $pdf->GetY() + 0.1;
        $pdf->SetXY(6, $y11);
        $pdf->Cell(10, 0.5, 'Total Bayar', 0, 1);
        $pdf->SetXY(8.5, $y11);
        $total = $subtotal + $jasa_resep_total;
        $pdf->Cell(10, 0.5, ': ' . number_format($total, 2), 0, 1);
        $y12 = $pdf->GetY() + 0.1;
        $pdf->Line(6, $y12, 78, $y12);
        $y13 = $pdf->GetY() + 0.2;
        $pdf->Line(6, $y13, 78, $y13);
        $y14 = $pdf->GetY() + 0.2;
        $pdf->SetXY(0.5, $y14);
        $pdf->Cell(10, 0.5, 'Tgl Input : ' . $get_header[0]->tgl_entry, 0, 1);
        $pdf->SetXY(0.5, $y14 + 0.5);
        $pdf->Cell(10, 0.5, 'Input by : ' . $get_header[0]->nama_user, 0, 1);
        $pdf->SetXY(0.5, $y14 + 1);
        $pdf->Cell(10, 0.5, $this->get_now(), 0, 1);
        // $pdf->Cell(10, 0.5, ': ' .$dtpx[0]->tgl_lahir, 0, 1);
        // foreach ($get_detail as $d) {
        //     if ($d->kode_barang != '') {
        //         $pdf->SetXY(0, $i);
        //         $pdf->Cell(0.1, 10, '' . $i, 0, 1);
        //         $pdf->SetFont('Arial', '', 8);
        //         $pdf->SetXY(0, 0.4);
        //         $pdf->Cell(0.3, 0.10, $dtpx[0]->no_rm, 0, 0);
        //         $pdf->SetXY(0.8, 0.4);
        //         $pdf->Cell(0.3, 0.10, $dtpx[0]->tgl_lahir . '/ usia ' . $dtpx[0]->umur, 0, 0);
        //         $pdf->SetXY(0, 0.6);
        //         $pdf->Cell(0.3, 0.10, $dtpx[0]->nama, 0, 0);
        //         $pdf->SetFont('Arial', '', 5);
        //         $pdf->SetXY(0, 0.8);
        //         $pdf->MultiCell(1.9, 0.1, $dtpx[0]->alamat);
        //         $y = $pdf->GetY();
        //         // $pdf->Cell(0.3, 0.10, $dtpx[0]->alamat, 0, 0);
        //         $pdf->SetFont('Arial', 'B', 7);
        //         $pdf->SetXY(0, $y + 0.1);
        //         $pdf->MultiCell(1.8, 0.10, $d->nama_barang);
        //         $y = $pdf->GetY() + 0.007;
        //         $pdf->SetXY(0, $y);
        //         $pdf->MultiCell(1.9, 0.10, $d->aturan_pakai);
        //         // $pdf->Cell(0.3, 0.10, $d->nama_barang, 0, 0);
        //         // //A set
        //         $code = 'CODE 128';
        //         $pdf->Code128(0.1, 1.6, $code, 1.8, 0.4);
        //         // // $pdf->Cell(0.3, 0.10, $barcode, 0, 0);
        //         $y = $pdf->GetY();
        //         $pdf->SetFont('Arial', 'b', 5);
        //         $pdf->SetXY(0, $y);
        //         $pdf->Cell(0.3, 0.10, $get_header[0]->tgl_entry, 0, 0);
        //         $pdf->SetXY(1.2, $y);
        //         $pdf->Cell(0.3, 0.10, 'EXP' . $d->ed_obat, 0, 0);
        //         $i = 10;
        //     }
        // }
        $pdf->Output();
        exit;
        // return;
    }
    public function cari_riwayat_resep(Request $request)
    {
        $tanggal_awal = $request->tanggalawal;
        $tanggal_akhir = $request->tanggalakhir;
        // $cari_order = DB::connection('mysql4')->select('SELECT DISTINCT a.kode_kunjungan
        // ,a.tgl_entry
        // ,b.no_rm
        // ,fc_nama_px(no_rm) AS nama_pasien
        // ,fc_alamat(no_rm) AS alamat
        // ,a.id
        // -- ,a.kode_layanan_header
        // ,a.status_layanan
        // -- ,a.kode_kunjungan
        // ,fc_NAMA_PARAMEDIS1(a.dok_kirim) AS nama_dokter
        // ,fc_nama_unit1(a.kode_unit) AS nama_unit
        // ,a.unit_pengirim
        // FROM db_dummy.ts_layanan_header a
        // JOIN simrs_waled.ts_kunjungan b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        // WHERE a.kode_unit = ? AND DATE(a.tgl_entry) BETWEEN ? AND ? AND a.status_layanan != ?', ([auth()->user()->unit, $tanggal_awal, $tanggal_akhir, 3]));
        $cari_order = DB::connection('mysql4')->select('SELECT DISTINCT a.kode_kunjungan
         ,DATE(a.tgl_entry) AS tgl_entry
         ,b.no_rm
         ,fc_nama_px(b.no_rm) AS nama_pasien
         ,fc_alamat4(b.no_rm) AS alamat
         #,a.id
         -- ,a.kode_layanan_header
         ,a.status_layanan
         -- ,a.kode_kunjungan
         ,fc_NAMA_PARAMEDIS1(a.dok_kirim) AS nama_dokter
         ,fc_nama_unit1(a.kode_unit) AS nama_unit
         ,fc_nama_unit1(a.unit_pengirim) AS unit_pengirim
         FROM db_dummy.ts_layanan_header a
         INNER JOIN simrs_waled.ts_kunjungan b ON a.`kode_kunjungan` = b.`kode_kunjungan`
         WHERE a.kode_unit = ? AND DATE(a.tgl_entry) BETWEEN ? AND ? AND a.status_layanan <> ? ORDER BY tgl_entry desc', ([auth()->user()->unit, $tanggal_awal, $tanggal_akhir, 3]));
        return view('farmasi.tabel_riwayat_resep', compact([
            'cari_order'
        ]));
    }
    public function ambil_data_obat_retur(Request $request)
    {
        $idheader = $request->idheader;
        $iddetail = $request->iddetail;
        $ambil_detail = DB::connection('mysql4')->select('select kode_barang,fc_nama_barang(kode_barang) as nama_barang,jumlah_layanan,jumlah_retur,satuan_barang from ts_layanan_detail where id = ?', [$iddetail]);
        return view('farmasi.form_retur_obat', compact([
            'ambil_detail',
            'idheader',
            'iddetail'
        ]));
    }
    public function cetaknota_new($kodekunjungan, $kodeheader, $idheader)
    {
        // dd($kodeheader);
        // SP_Karcis_Pendaftaran3(kodelayananheader,norm)
        // $DH = DB::select('select * from ts_layanan_header where id = ?', [$id]);
        $DK = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $DK[0]->no_rm;
        // $KODE_HEADER = $DH[0]->kode_layanan_header;
        // $ID_HEADER = $DK[0]->counter;
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare("CALL SP_CETAK_NOTA_WEB('$kodeheader','$idheader')");
        $QUERY->execute();
        $data = $QUERY->fetchAll();
        $filename = 'C:\cetakanresep\cetakannotaresep.jrxml';
        $config = ['driver' => 'array', 'data' => $data];
        $report = new PHPJasperXML();
        $report->load_xml_file($filename)
            ->setDataSource($config)
            ->export('Pdf');
    }
    public function simpanretur(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if (trim($dataSet['jumlahretur']) == '') {
            $data = [
                'kode' => 500,
                'message' => 'Jumlah retur tidak boleh kosong !',
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['jumlah'] <= 0) {
            $data = [
                'kode' => 500,
                'message' => 'Gagal , semua obat sudah diretur !',
            ];
            echo json_encode($data);
            die;
        }
        $get_header = db::connection('mysql4')->select('select * from ts_layanan_header where id = ?', [$dataSet['idheader']]);
        $get_detail = db::connection('mysql4')->select('select * from ts_layanan_detail where id = ?', [$dataSet['iddetail']]);
        $data_kunjungan = db::select('select kode_penjamin,no_rm,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat_pasien from ts_kunjungan where kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $penjamin = $data_kunjungan[0]->kode_penjamin;

        //proses hitung retur dits layanan detail
        $tarif_layanan = $get_detail[0]->total_tarif;
        $jumlah_layanan = $get_detail[0]->jumlah_layanan;
        if ($jumlah_layanan - $dataSet['jumlahretur'] < 0) {
            $data = [
                'kode' => 500,
                'message' => 'Gagal , Jumlah retur lebih banyak dari qty awal !',
            ];
            echo json_encode($data);
            die;
        }
        $jumlah_retur = $dataSet['jumlahretur'] + $get_detail[0]->jumlah_retur;
        $total_layanan_retur = $jumlah_retur * $tarif_layanan;
        $total_layanan_sebelum_retur = $get_detail[0]->total_layanan;
        $total_layanan_setelah_retur = $total_layanan_sebelum_retur - $total_layanan_retur;
        if ($total_layanan_setelah_retur > 0) {
            $tagihan_detail_baru = $total_layanan_setelah_retur + 1700;
            $status_layanan_detail = 'OPN';
            // $tagihan_embalase = 1700;
            $tagihan_resep = 1000;
        } else {
            // $tagihan_embalase = 0;
            $tagihan_resep = 0;
            $tagihan_detail_baru = 0;
            $status_layanan_detail = 'CCL';
        }
        //menentukan tagihan penjamin atau pribadi
        $cari_jasa = DB::connection('mysql4')->select('select * from ts_layanan_detail where kode_tarif_detail = ? and row_id_header = ? and status_layanan_detail <> ? LIMIT 1', (['TX23513', $dataSet['idheader'], 'CCL']));
        if ($penjamin == 'P01') {
            $tagihan_detail_lama = $get_detail[0]->tagihan_pribadi;
            $tagihan_pribadi_detail_1 = $tagihan_detail_baru;
            $tagihan_penjamin_detail_1 = 0;
            // $cari_jasa = DB::connection('mysql4')->select('select * from ts_layanan_detail where kode_tarif_detail = ? and row_id_header = ? and tagihan_pribadi > ? LIMIT 1', (['TX23513', $dataSet['idheader'], 0]));
            $cari_jasa_resep = DB::connection('mysql4')->select('select * from ts_layanan_detail where kode_tarif_detail = ? and row_id_header = ? and tagihan_pribadi > ? LIMIT 1', (['TX23523', $dataSet['idheader'], 0]));
            // $tagihan_pribadi_embalase = $tagihan_embalase;
            // $tagihan_penjamin_embalase = $tagihan_embalase;
            $tagihan_pribadi_jasa_baca = $tagihan_resep;
            $tagihan_penjamin_jasa_baca = $tagihan_resep;
        } else {
            $tagihan_detail_lama = $get_detail[0]->tagihan_penjamin;
            $tagihan_pribadi_detail_1 = 0;
            $tagihan_penjamin_detail_1 = $tagihan_detail_baru;
            // $cari_jasa = DB::connection('mysql4')->select('select * from ts_layanan_detail where kode_tarif_detail = ? and row_id_header = ? and tagihan_penjamin > ? LIMIT 1', (['TX23513', $dataSet['idheader'], 0]));
            $cari_jasa_resep = DB::connection('mysql4')->select('select * from ts_layanan_detail where kode_tarif_detail = ? and row_id_header = ? and tagihan_penjamin > ? LIMIT 1', (['TX23523', $dataSet['idheader'], 0]));
            // $tagihan_pribadi_embalase = $tagihan_embalase;
            // $tagihan_penjamin_embalase = $tagihan_embalase;
            $tagihan_pribadi_jasa_baca = $tagihan_resep;
            $tagihan_penjamin_jasa_baca = $tagihan_resep;
        }
        //menentukan retur semua atau retur sebagian
        $ts_layanan_detail_1 = [
            'jumlah_retur' => $jumlah_retur,
            'tagihan_pribadi' => $tagihan_pribadi_detail_1,
            'tagihan_penjamin' => $tagihan_penjamin_detail_1,
            'status_layanan_detail' => $status_layanan_detail
        ];
        ts_layanan_detail_dummy::where('id', $dataSet['iddetail'])->update($ts_layanan_detail_1);
        //menentukan hilang atau tidaknya jasa embalase
        if ($total_layanan_setelah_retur <= 0) {
            $ts_layanan_detail_2 = [
                // 'tagihan_pribadi' => $tagihan_pribadi_embalase,
                // 'tagihan_penjamin' => $tagihan_penjamin_embalase,
                // 'grantotal_layanan' => $tagihan_embalase,
                'status_layanan_detail' => $status_layanan_detail
            ];
            ts_layanan_detail_dummy::where('id', $cari_jasa[0]->id)->update($ts_layanan_detail_2);
        }
        $cek_detail = db::connection('mysql4')->select('select * from ts_layanan_detail where row_id_header = ? and status_layanan_detail = ?', [$dataSet['idheader'], 'OPN']);
        if (count($cek_detail) == 1) {
            $id_detail = $cek_detail[0]->id;
            $ts_layanan_detail_3 = [
                'tagihan_pribadi' => $tagihan_pribadi_jasa_baca,
                'tagihan_penjamin' => $tagihan_penjamin_jasa_baca,
                'status_layanan_detail' => 'CCL'
            ];
            ts_layanan_detail_dummy::where('id', $cari_jasa_resep[0]->id)->update($ts_layanan_detail_3);
            $total_header_baru = 0;
            if ($penjamin == 'P01') {
                $tagihan_head_pribadi = $total_header_baru;
                $tagihan_head_penjamin = 0;
            } else {
                $tagihan_head_pribadi = 0;
                $tagihan_head_penjamin = $total_header_baru;
            }
            $ts_layanan_header = [
                'tagihan_pribadi' => $tagihan_head_pribadi,
                'tagihan_penjamin' => $tagihan_head_penjamin,
                'status_retur' => 'CLS',
            ];
        } else {
            //hitung ts layanan header
            if ($penjamin == 'P01') {
                $tagihan_lama = $get_header[0]->tagihan_pribadi;
            } else {
                $tagihan_lama = $get_header[0]->tagihan_penjamin;
            }
            $total_layanan_header_sebelum_ada_retur = $tagihan_lama;
            $total_header = $total_layanan_header_sebelum_ada_retur - $tagihan_detail_lama;
            $total_header_baru = $total_header + $tagihan_detail_baru;
            if ($penjamin == 'P01') {
                $tagihan_head_pribadi = $total_header_baru;
                $tagihan_head_penjamin = 0;
            } else {
                $tagihan_head_pribadi = 0;
                $tagihan_head_penjamin = $total_header_baru;
            }
            $ts_layanan_header = [
                'tagihan_pribadi' => $tagihan_head_pribadi,
                'tagihan_penjamin' => $tagihan_head_penjamin,
                'status_retur' => 'OPN',
            ];
        }
        ts_layanan_header_dummy::where('id', $dataSet['idheader'])->update($ts_layanan_header);

        //ti kartu stok
        $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$dataSet['kodebarang'], auth()->user()->unit]));
        $kode_kunjungan = $get_header[0]->kode_kunjungan;
        $kode_layanan_header = $get_header[0]->kode_layanan_header;
        $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [auth()->user()->unit]);
        $prefix_unit = $mt_unit[0]->prefix_unit;
        $kode_retur_header = $this->createReturHeader($prefix_unit);
        $stok_cur_1 = $cek_stok[0]->stok_current;
        $jlh_Ret = $dataSet['jumlahretur'];
        $qty_sisa = $jumlah_layanan - $jlh_Ret;

        $ts_retur_header = [
            'kode_kunjungan' => $kode_kunjungan,
            'kode_retur_header' => $kode_retur_header,
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_retur' => $this->get_now(),
            'total_retur' => $total_layanan_retur,
            'alasan_retur' => 'RETUR',
            'status_retur' => $status_layanan_detail,
            'pic' => auth()->user()->id,
            'status_pembayaran' => $status_layanan_detail
        ];
        // //insert ke ts_retur_header
        $insert_retur_header = ts_retur_header::create($ts_retur_header);
        $ts_retur_detail = [
            'kode_retur_detail' => $this->createReturDetail(),
            'tgl_retur_detail' => $this->get_now(),
            'kode_retur_header' => $kode_retur_header,
            'id_layanan_detail' => $get_detail[0]->id_layanan_detail,
            'qty_awal' => $jumlah_layanan,
            'qty_retur' => $jlh_Ret,
            'qty_sisa' => $qty_sisa,
            'tarif_layanan' => $tarif_layanan,
            'total_retur_detail' => $total_layanan_retur,
            'status_retur_detail' => $status_layanan_detail,
            'row_id_header' => $insert_retur_header['id'],
        ];
        // //insert ke ts_retur_detail
        $insert_retur_detail = ts_retur_detail::create($ts_retur_detail);
        $stok_current = (int)$stok_cur_1 + (int)$jlh_Ret;
        $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$dataSet['kodebarang']]);
        $data_ti_kartu_stok = [
            'no_dokumen' => 'RET' . $get_header[0]->kode_layanan_header,
            'no_dokumen_detail' => 'RET' . $get_detail[0]->id_layanan_detail,
            'tgl_stok' => $this->get_now(),
            'kode_unit' => auth()->user()->unit,
            'kode_barang' => $dataSet['kodebarang'],
            'stok_in' => $jlh_Ret,
            'stok_last' => $cek_stok[0]->stok_current,
            'stok_current' => $stok_current,
            'harga_beli' =>  $mt_barang[0]->hna,
            'act' => '1',
            'act_ed' => '1',
            'input_by' => auth()->user()->id,
            'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
        ];
        $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
        $data = [
            'kode' => 200,
            'message' => 'sukses',
        ];
        echo json_encode($data);
        die;
    }
    public function createReturHeader($prefix_unit)
    {
        $q = DB::connection('mysql4')->select('SELECT id,kode_retur_header,RIGHT(kode_retur_header,6) AS kd_max  FROM ts_retur_header
        WHERE DATE(tgl_retur) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'RET' . $prefix_unit . date('ymd') . $kd;
    }
    public function createReturDetail()
    {
        $q = DB::connection('mysql4')->select('SELECT id,kode_retur_detail,RIGHT(kode_retur_detail,6) AS kd_max  FROM ts_retur_detail
        WHERE DATE(tgl_retur_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'RETDET' . date('ymd') . $kd;
    }
    public function mergerpdf($kodekunjungan)
    {
        $date = $this->get_date();
        // ... inside a controller method or similar
        $pdf = PdfMerger::init();
        $resume = db::select('select * from log_ttd_elektronik where status_file = 1');
        // file_get_contents($d[0]->file)
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
            )
        );
        $ts_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select * from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $cek_resume = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_file = 1', [$kodekunjungan]);
        $cek_lab = $this->get_lab($kodekunjungan);
        $cek_rad = db::select('select * from ts_hasil_expertisi where kode_kunjungan = ?', [$kodekunjungan]);
        $cek_far = db::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit IN (4002,4008)', [$kodekunjungan]);
        // dd($cek_lab);
        $contents = [];
        if (count($cek_resume) > 0) {
            $resume = $cek_resume[0]->file;
            $pdf->addPDF($resume, 'all');
        } else {
            $context = stream_context_create($opts);
            $contents_resume = file_get_contents('http://192.168.2.45/simrs/cetakresumeblank/' . $kodekunjungan, FALSE, $context);
            Storage::disk('SEP')->put('resume' . $kodekunjungan . '.pdf', $contents_resume);
            $pdf->addPDF('\\\193.193.193.203\erm\sep/' . 'resume' . $kodekunjungan . '.pdf', 'all');
            $contents[] = $contents_resume;
        }
        if (count($ts_kunjungan) > 0) {
            $context = stream_context_create($opts);
            foreach ($ts_kunjungan as $tk) {
                if (strlen($tk->no_sep) > 3) {
                    $contents_sep = file_get_contents('http://192.168.2.45/simrs/cetaksep_v_2/' . $tk->no_sep, FALSE, $context);
                    // $contents_rad  = file_get_contents('https://192.168.2.233/expertise/cetak.php?IDs=' . $cr->id_header . '&IDd=' . $cr->id_detail . '&tgl_cetak=' . $date, FALSE, $context);
                    Storage::disk('SEP')->put($tk->no_sep . '.pdf', $contents_sep);
                    $pdf->addPDF('\\\193.193.193.203\erm\sep/' . $tk->no_sep . '.pdf', 'all');
                    $contents[] = $contents_sep;
                }
            }
        }
        // dd($cek_lab);
        // if (count($cek_lab) > 0) {
        //     foreach ($cek_lab as $cl) {
        //         $kode_layanan_header = $cl->layanan;
        //         $contents_lab = file_get_contents($cl->link);
        //         Storage::disk('LAB_1')->put($kode_layanan_header . '.pdf', $contents_lab);
        //         $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $kode_layanan_header . '.pdf', 'all');
        //         $contents[] = $contents_lab;
        //     }
        // }
        if (count($cek_lab) > 0) {
            foreach ($cek_lab as $cl) {
                $kode_layanan_header = $cl->layanan;
                $contents_lab = file_get_contents($cl->link);
                Storage::disk('LAB_1')->put($kode_layanan_header . '.pdf', $contents_lab);
                $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $kode_layanan_header . '.pdf', 'all');
                $contents[] = $contents_lab;
            }
        }
        if (count($cek_rad) > 0) {
            $context = stream_context_create($opts);
            foreach ($cek_rad as $cr) {
                $contents_rad  = file_get_contents('https://192.168.2.233/expertise/cetak.php?IDs=' . $cr->id_header . '&IDd=' . $cr->id_detail . '&tgl_cetak=' . $date, FALSE, $context);
                Storage::disk('RAD')->put('RAD' . $cr->id_header . '.pdf', $contents_rad);
                $pdf->addPDF('\\\193.193.193.203\erm\expertisi_radiologi/RAD' . $cr->id_header . '.pdf', 'all');
                $contents[] = $contents_rad;
            }
        }

        if (count($cek_far) > 0) {
            $context = stream_context_create($opts);
            foreach ($cek_far as $cf) {
                $contents_resep  = file_get_contents('http://192.168.2.45/simrs/cetaknotafarmasi_2/' . $cf->kode_kunjungan . '/' . $cf->kode_layanan_header . '/' . $cf->id, FALSE, $context);
                Storage::disk('FAR')->put('FAR' . $cf->kode_layanan_header . '.pdf', $contents_resep);
                // $pdf->addPDF('\\\193.193.193.203\erm\resepfarmasi/'. $cf->kode_layanan_header . '.pdf', 'all');
                $pdf->addPDF('\\\193.193.193.203\erm\resepfarmasi/FAR' . $cf->kode_layanan_header . '.pdf', 'all');
                $contents[] = $contents_resep;
            }
        }
        if (count($contents) > 0) {
            $pdf->merge();
            $output = $pdf->Output();
            $name = $kodekunjungan . '.pdf';
            $pdf->save(Storage::disk('MER', $name)->put($name, $output));
            return Response::make(file_get_contents('\\\193.193.193.203\erm\merger_resume_rajal/' . $kodekunjungan . '.pdf'), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $mt_pasien[0]->nama_px . ' | ' . $name . '"'
            ],);
        }
    }
    public function get_lab($kodekunjungan)
    {
        $hasil = db::select("SELECT * FROM
(
SELECT DISTINCT
CASE WHEN dd.NAMA_TARIF LIKE '%Morfologi darah tepi%' THEN bb.kode_layanan_header

            WHEN dd.nama_tarif IN ('Gall Kultur Darah (Resin)'
                                                            ,'Gall Kultur Urine(Urotube)'
                                                            ,'Identifikasi Parasit'
                                                            ,'Kultur'
                                                            ,'KULTUR / IDENTIFIKASI KUMAN'
                                                            ,'Kultur Darah  (Gall )'
                                                            ,'KULTUR DARAH (GALL) IDENTIFIKASI'
                                                            ,'KULTUR DARAH / IDENTIFIKASI'
                                                            ,'Kultur Jamur Identifikasi'
                                                            ,'KULTUR JAMUR IDENTIFIKASI'
                                                            ,'Kultur Rectal Swab'
                                                            ,'KULTUR RECTAL SWAB'
                                                            ,'KULTUR SPECIMEN CAIRAN TUBUH / PLEURA'
                                                            ,'Kultur specimen cairan tubuh/Pleura'
                                                            ,'Kultur specimen Pus'
                                                            ,'KULTUR SPECIMEN PUS'
                                                            ,'Kultur Sputum'
                                                            ,'KULTUR SPUTUM'
                                                            ,'Kultur Urine identifikasi'
                                                            ,'KULTUR URINE IDENTIFIKASI'
                                                            ,'Resistensi'
                                                            ,'Skrining MRSA'
                                                            ,'Uji Resistensi  specimen cairan tubuh/Pleura'
                                                            ,'Uji Resistensi Darah (Gall)'
                                                            ,'UJI RESISTENSI DARAH (GALL)'
                                                            ,'Uji Resistensi jamur'
                                                            ,'UJI RESISTENSI JAMUR'
                                                            ,'Uji Resistensi Rectal swab'
                                                            ,'UJI RESISTENSI RECTAL SWAB'
                                                            ,'UJI RESISTENSI SPECIMEN CAIRAN TUBUH / PLEURA'
                                                            ,'Uji Resistensi specimen Pus'
                                                            ,'UJI RESISTENSI SPECIMEN PUS'
                                                            ,'Uji Resistensi Sputum'
                                                            ,'UJI RESISTENSI SPUTUM'
                                                            ,'UJI RESISTENSI URINE'
                                                            ,'Uji Resistensi Urine '
                                                            ,'Urine Culture'
                                                            ) THEN bb.kode_layanan_header #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-KULTR')
WHEN dd.NAMA_TARIF LIKE '%kultur%' THEN bb.kode_layanan_header #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-KULTR')
            WHEN dd.nama_tarif IN ('Apus Vagina'
                                                            ,'BTA CUPING KANAN'
                                                            ,'BTA CUPING KIRI'
                                                            ,'BTA LESI KULIT KANAN'
                                                            ,'BTA LESI KULIT KIRI'
                                                            ,'BTA SWAB HIDUNG KANAN'
                                                            ,'BTA SWAB HIDUNG KIRI'
                                                            ,'Difteri'
                                                            ,'HITUNG JUMLAH KUMAN / MPN URINE'
                                                            ,'Hitung Jumlah Kuman /MPN Urine'
                                                            ,'Pengecatan Neisser'
                                                            ,'Reitz Serum'
                                                            ,'REITZ SERUM'
                                                            ,'RESISTENSI'
                                                            ,'Sediaan BTA - A'
                                                            ,'Sediaan BTA - B'
                                                            ,'Sediaan BTA - C'
                                                            ,'Sediaan BTA - D'
                                                            ,'Sediaan BTA - E'
                                                            ,'Sediaan BTA - F'
                                                            ,'Sediaan BTA - G'
                                                            ,'Sediaan BTA - H'
                                                            ,'Sediaan BTA - I'
                                                            ,'Sediaan BTA - J'
                                                            ,'Sediaan BTA - K'
                                                            ,'Sediaan GO'
                                                            ,'Sediaan Gram'
                                                            ,'Sediaan Jamur'
                                                            ) THEN bb.kode_layanan_header #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-PGCT')
WHEN dd.NAMA_TARIF LIKE '%bta%' THEN bb.kode_layanan_header #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-PGCT')

            WHEN dd.nama_tarif IN ('[PRD] - CMV PCR Kualitatif'
                                                            ,'[PRD] -Toxoplasma PCR'
                                                            ,'[PRM] - HBV DNA KUANTITATIF PCR'
                                                            ,'[PRM] - HCV RNA GENOTYPING PCR'
                                                            ,'[PRM] - HCV RNA Kuantitatif PCR'
                                                            ,'BONE MARROW (BM)'
                                                            ,'Bone Marrow Ekspertise'
                                                            ,'PEWARNAAN SUMSUM TULANG'
                                                            ,'SWAB PCR'
                                                            ,'Swab SARS-CoV-2'
                                                            ,'Swab SARS-CoV-2 [A]'
                                                            ,'Swab SARS-CoV-2 [B]'
                                                            ,'Swab SARS-CoV-2 [C]'
                                                            ,'Swab SARS-CoV-2 [D]'
                                                            ,'Swab SARS-CoV-2 [E]'
                                                            ,'Swab SARS-CoV-2 [F]'
                                                            ,'Swab SARS-CoV-2 [ii PCR]'
                                                            ,'Swab SARS-CoV-2 [RT PCR]'
                                                      ) THEN bb.kode_layanan_header #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-Bone')
                        WHEN dd.NAMA_TARIF LIKE '%BM%' THEN bb.kode_layanan_header #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-BM')
            WHEN dd.NAMA_TARIF LIKE '%Bone%' THEN bb.kode_layanan_header  #CONCAT(aa.no_sep,'-',bb.kode_layanan_header,'-Bone')

            ELSE '' END AS layanan
  ,CASE WHEN dd.NAMA_TARIF LIKE '%Morfologi darah tepi%' THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=MDT')

               WHEN dd.nama_tarif IN ('Gall Kultur Darah (Resin)'
                                                            ,'Gall Kultur Urine(Urotube)'
                                                            ,'Identifikasi Parasit'
                                                            ,'Kultur'
                                                            ,'KULTUR / IDENTIFIKASI KUMAN'
                                                            ,'Kultur Darah  (Gall )'
                                                            ,'KULTUR DARAH (GALL) IDENTIFIKASI'
                                                            ,'KULTUR DARAH / IDENTIFIKASI'
                                                            ,'Kultur Jamur Identifikasi'
                                                            ,'KULTUR JAMUR IDENTIFIKASI'
                                                            ,'Kultur Rectal Swab'
                                                            ,'KULTUR RECTAL SWAB'
                                                            ,'KULTUR SPECIMEN CAIRAN TUBUH / PLEURA'
                                                            ,'Kultur specimen cairan tubuh/Pleura'
                                                            ,'Kultur specimen Pus'
                                                            ,'KULTUR SPECIMEN PUS'
                                                            ,'Kultur Sputum'
                                                            ,'KULTUR SPUTUM'
                                                            ,'Kultur Urine identifikasi'
                                                            ,'KULTUR URINE IDENTIFIKASI'
                                                            ,'Resistensi'
                                                            ,'Skrining MRSA'
                                                            ,'Uji Resistensi  specimen cairan tubuh/Pleura'
                                                            ,'Uji Resistensi Darah (Gall)'
                                                            ,'UJI RESISTENSI DARAH (GALL)'
                                                            ,'Uji Resistensi jamur'
                                                            ,'UJI RESISTENSI JAMUR'
                                                            ,'Uji Resistensi Rectal swab'
                                                            ,'UJI RESISTENSI RECTAL SWAB'
                                                            ,'UJI RESISTENSI SPECIMEN CAIRAN TUBUH / PLEURA'
                                                            ,'Uji Resistensi specimen Pus'
                                                            ,'UJI RESISTENSI SPECIMEN PUS'
                                                            ,'Uji Resistensi Sputum'
                                                            ,'UJI RESISTENSI SPUTUM'
                                                            ,'UJI RESISTENSI URINE'
                                                            ,'Uji Resistensi Urine '
                                                            ,'Urine Culture'
                                                            ) THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=KULTR')
               WHEN dd.NAMA_TARIF LIKE '%kultur%'  THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=KULTR')


               WHEN dd.nama_tarif IN ('Apus Vagina'
                                                            ,'BTA CUPING KANAN'
                                                            ,'BTA CUPING KIRI'
                                                            ,'BTA LESI KULIT KANAN'
                                                            ,'BTA LESI KULIT KIRI'
                                                            ,'BTA SWAB HIDUNG KANAN'
                                                            ,'BTA SWAB HIDUNG KIRI'
                                                            ,'Difteri'
                                                            ,'HITUNG JUMLAH KUMAN / MPN URINE'
                                                            ,'Hitung Jumlah Kuman /MPN Urine'
                                                            ,'Pengecatan Neisser'
                                                            ,'Reitz Serum'
                                                            ,'REITZ SERUM'
                                                            ,'RESISTENSI'
                                                            ,'Sediaan BTA - A'
                                                            ,'Sediaan BTA - B'
                                                            ,'Sediaan BTA - C'
                                                            ,'Sediaan BTA - D'
                                                            ,'Sediaan BTA - E'
                                                            ,'Sediaan BTA - F'
                                                            ,'Sediaan BTA - G'
                                                            ,'Sediaan BTA - H'
                                                            ,'Sediaan BTA - I'
                                                            ,'Sediaan BTA - J'
                                                            ,'Sediaan BTA - K'
                                                            ,'Sediaan GO'
                                                            ,'Sediaan Gram'
                                                            ,'Sediaan Jamur'
                                                            ) THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=PGCT')
               WHEN dd.NAMA_TARIF LIKE '%bta%' THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=PGCT')


                WHEN dd.nama_tarif IN ('[PRD] - CMV PCR Kualitatif'
                                                            ,'[PRD] -Toxoplasma PCR'
                                                            ,'[PRM] - HBV DNA KUANTITATIF PCR'
                                                            ,'[PRM] - HCV RNA GENOTYPING PCR'
                                                            ,'[PRM] - HCV RNA Kuantitatif PCR'
                                                            ,'BONE MARROW (BM)'
                                                            ,'Bone Marrow Ekspertise'
                                                            ,'PEWARNAAN SUMSUM TULANG'
                                                            ,'SWAB PCR'
                                                            ,'Swab SARS-CoV-2'
                                                            ,'Swab SARS-CoV-2 [A]'
                                                            ,'Swab SARS-CoV-2 [B]'
                                                            ,'Swab SARS-CoV-2 [C]'
                                                            ,'Swab SARS-CoV-2 [D]'
                                                            ,'Swab SARS-CoV-2 [E]'
                                                            ,'Swab SARS-CoV-2 [F]'
                                                            ,'Swab SARS-CoV-2 [ii PCR]'
                                                            ,'Swab SARS-CoV-2 [RT PCR]'
                                                      ) THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=BM')
               WHEN dd.NAMA_TARIF LIKE '%BM%' THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=BM')
               WHEN dd.NAMA_TARIF LIKE '%Bone%' THEN CONCAT('http://192.168.2.74/smartlab_waled/his/his_report?hisno=',bb.kode_layanan_header,'&type=BM')

            ELSE '' END AS link

FROM
(
SELECT DISTINCT b.kode_kunjungan FROM simrs_waled.ts_kunjungan b
WHERE b.kode_kunjungan = $kodekunjungan
)aa

INNER JOIN simrs_waled.ts_layanan_header bb ON bb.kode_kunjungan = aa.kode_kunjungan
INNER JOIN simrs_waled.ts_layanan_detail cc ON cc.row_id_header = bb.id
INNER JOIN simrs_waled.mt_tarif_header dd ON dd.KODE_TARIF_HEADER = LEFT(cc.kode_tarif_detail,6)
WHERE bb.kode_unit = '3002'
AND cc.status_layanan_detail = 'opn'
AND bb.keterangan = 'Terkirim'
)Q
WHERE layanan <> ''");

        return $hasil;
    }
}
