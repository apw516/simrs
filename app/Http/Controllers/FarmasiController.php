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
    public function index_cari_resep()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'farmasi_3';
        $sidebar_m = 'farmasi_3';
        $now = Carbon::now();
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
    public function ambil_data_pasien_far(Request $request)
    {
        $rm = $request->rm;
        $poliklinik = $request->poliklinik;
        $kunjungan = DB::select('SELECT date(tgl_masuk) as tgl_masuk,no_rm,kode_kunjungan,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat,fc_nama_unit1(kode_unit) AS nama_unit,kode_unit, fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin FROM ts_kunjungan WHERE kode_unit = ? AND status_kunjungan = ?', [$poliklinik, '1']);
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
        $kunjungan = DB::select('SELECT date(tgl_masuk) as tgl_masuk,no_rm,kode_kunjungan,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat,fc_nama_unit1(kode_unit) AS nama_unit,kode_unit, fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin FROM ts_kunjungan WHERE no_rm = ? AND kode_unit = ? AND status_kunjungan = ?', [$rm, $kodeunit, '1']);
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $orderan = db::select('SELECT * ,fc_nama_unit1(unit_pengirim) AS nama_unit,fc_nama_paramedis1(dok_kirim) AS nama_dokter FROM ts_layanan_detail_order a
        LEFT OUTER JOIN ts_layanan_header_order b ON a.`row_id_header` = b.`id`
        WHERE DATE(a.`tgl_layanan_detail`) = CURDATE() AND b.`kode_kunjungan` = ?', ([$kunjungan[0]->kode_kunjungan]));
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
            $this->test_print();
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
            $ts_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' => $this->get_now(),
                'kode_kunjungan' => $request->kodekunjungan,
                'kode_unit' => auth()->user()->unit,
                'kode_tipe_transaksi' => '2',
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'keterangan' => 'FARMASI BARU',
                'status_retur' => 'OPN',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'status_pembayaran' => 'OPN',
                'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                'unit_pengirim' => $data_kunjungan[0]->kode_unit
            ];
            $header = ts_layanan_header_dummy::create($ts_layanan_header);
            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail
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

                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok

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
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
                $totalheader = $totalheader + $grandtotal;
            }
            //end layanan detail

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
            $ts_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' => $this->get_now(),
                'kode_kunjungan' => $request->kodekunjungan,
                'kode_unit' => auth()->user()->unit,
                'kode_tipe_transaksi' => '2',
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'keterangan' => 'FARMASI BARU',
                'status_retur' => 'OPN',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'status_pembayaran' => 'OPN',
                'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                'unit_pengirim' => $data_kunjungan[0]->kode_unit
            ];
            $header = ts_layanan_header_dummy::create($ts_layanan_header);
            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail
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
                $kode_detail_obat_kronis = $this->createLayanandetail();
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat_kronis,
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

                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat_kronis,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok


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
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
                $totalheader = $totalheader + $grandtotal;
            }
            //end layanan detail

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
            $ts_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' => $this->get_now(),
                'kode_kunjungan' => $request->kodekunjungan,
                'kode_unit' => auth()->user()->unit,
                'kode_tipe_transaksi' => '2',
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'keterangan' => 'FARMASI BARU',
                'status_retur' => 'OPN',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'status_pembayaran' => 'OPN',
                'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                'unit_pengirim' => $data_kunjungan[0]->kode_unit
            ];
            $header = ts_layanan_header_dummy::create($ts_layanan_header);
            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail
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
                $kode_detail_obat_kemo = $this->createLayanandetail();
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat_kemo,
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
                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat_kemo,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok

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
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
                $totalheader = $totalheader + $grandtotal;
            }
            //end layanan detail

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
            $ts_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' => $this->get_now(),
                'kode_kunjungan' => $request->kodekunjungan,
                'kode_unit' => auth()->user()->unit,
                'kode_tipe_transaksi' => '2',
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'keterangan' => 'FARMASI BARU',
                'status_retur' => 'OPN',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'status_pembayaran' => 'OPN',
                'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
                'unit_pengirim' => $data_kunjungan[0]->kode_unit
            ];
            $header = ts_layanan_header_dummy::create($ts_layanan_header);
            $now = $this->get_now();
            $totalheader = 0;
            //create layanan detail
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
                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat_hibah,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok

                $ts_layanan_detail2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => 0,
                    'jumlah_layanan' => 1,
                    'total_layanan' => 0,
                    'grantotal_layanan' => 0,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_pribadi' => '0',
                    'tagihan_penjamin' => '0',
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
                $totalheader = $totalheader + $grandtotal;
            }
            //end layanan detail

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


        $data = [
            'kode' => 200,
            'message' => 'sukses',
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
        $mt_pasien = DB::select('select no_rm,nama_px,fc_alamat(no_rm) as alamat,date(tgl_lahir) as tgl_lahir,fc_umur(no_rm) as umur from mt_pasien where no_rm = ?', [$request->rm]);
        $header_layanan = DB::select('select unit_pengirim,fc_nama_paramedis1(dok_kirim) as dok_kirim from ts_layanan_header where kode_kunjungan = ? and kode_unit = ?', ([$request->kodekunjungan, auth()->user()->unit]));
        $detail = DB::select('SELECT a.id AS id_header
        ,b.`id` AS id_detail
        ,a.`tgl_entry` AS tgl_entry
        ,a.kode_layanan_header
        ,b.`id_layanan_detail`
        ,fc_nama_barang(b.`kode_barang`) AS namabarang
        ,b.`jumlah_layanan`
        ,b.satuan_barang
        ,b.`total_layanan`
        ,a.`keterangan`
        ,a.`status_layanan`
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
        $get_header = DB::select('select * from ts_layanan_header where id = ?', [$id]);
        $dtpx = DB::select('SELECT no_rm,fc_nama_px(no_rm) AS nama, fc_umur(no_rm) AS umur,DATE(fc_tgl_lahir(no_rm)) AS tgl_lahir,fc_alamat(no_rm) AS alamat FROM ts_kunjungan WHERE kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $get_detail = DB::select('SELECT a.kode_barang,b.`nama_barang`,a.aturan_pakai,a.`ed_obat` FROM ts_layanan_detail a
        LEFT OUTER JOIN mt_barang b ON a.`kode_barang` = b.`kode_barang`
        WHERE a.row_id_header = ?', [$id]);
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
        $get_header = DB::select('select * from ts_layanan_header where id = ?', [$id]);
        $dtpx = DB::select('SELECT no_rm,fc_nama_px(no_rm) AS nama, fc_umur(no_rm) AS umur,DATE(fc_tgl_lahir(no_rm)) AS tgl_lahir,fc_alamat(no_rm) AS alamat FROM ts_kunjungan WHERE kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $get_detail = DB::select('SELECT a.kode_barang,b.`nama_barang`,a.aturan_pakai,a.`ed_obat` FROM ts_layanan_detail a
        LEFT OUTER JOIN mt_barang b ON a.`kode_barang` = b.`kode_barang`
        WHERE a.row_id_header = ?', [$id]);
        $pdf = new PDF('P', 'in', array('1.97', '2.36'));
        $i = $pdf->GetY();
        // $pdf->AliasNbPages();
        // $pdf->AddPage();
        $pdf->SetTitle('Cetak Nota Farmasi');
        $pdf->SetFont('Arial', 'B', 8);
        foreach ($get_detail as $d) {
            if ($d->kode_barang != '') {
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
    public function cari_riwayat_resep(Request $request)
    {
        $tanggal_awal = $request->tanggalawal;
        $tanggal_akhir = $request->tanggalakhir;
        $cari_order = DB::select('SELECT tgl_entry
        ,b.no_rm
        ,fc_nama_px(no_rm) AS nama_pasien
        ,fc_alamat(no_rm) AS alamat
        ,a.id
        ,a.kode_layanan_header
        ,a.status_layanan
        ,a.kode_kunjungan
        ,fc_NAMA_PARAMEDIS1(a.dok_kirim) AS nama_dokter
        ,fc_nama_unit1(a.kode_unit) AS nama_unit
        ,a.unit_pengirim
        FROM ts_layanan_header a
        LEFT OUTER JOIN ts_kunjungan b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        WHERE a.kode_unit = ? AND DATE(a.tgl_entry) BETWEEN ? AND ? AND a.status_layanan != ?', ([auth()->user()->unit, $tanggal_awal, $tanggal_akhir, 3]));
        return view('farmasi.tabel_riwayat_resep', compact([
            'cari_order'
        ]));
    }
    public function ambil_data_obat_retur(Request $request)
    {
        $idheader = $request->idheader;
        $iddetail = $request->iddetail;
        $ambil_detail = DB::select('select kode_barang,fc_nama_barang(kode_barang) as nama_barang,jumlah_layanan,satuan_barang from ts_layanan_detail where id = ?', [$iddetail]);
        return view('farmasi.form_retur_obat', compact([
            'ambil_detail',
            'idheader',
            'iddetail'
        ]));
    }
    public function simpanretur(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }

        $get_header = db::select('select * from ts_layanan_header where id = ?', [$dataSet['idheader']]);
        $get_detail = db::select('select * from ts_layanan_detail where id = ?', [$dataSet['iddetail']]);
        $data_kunjungan = db::select('select no_rm,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat_pasien from ts_kunjungan where kode_kunjungan = ?', [$get_header[0]->kode_kunjungan]);
        $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$dataSet['kodebarang'], auth()->user()->unit]));
        $kode_kunjungan = $get_header[0]->kode_kunjungan;
        $kode_layanan_header = $get_header[0]->kode_layanan_header;
        $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [auth()->user()->unit]);
        $prefix_unit = $mt_unit[0]->prefix_unit;
        $kode_retur_header = $this->createReturHeader($prefix_unit);
        $cek_mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$dataSet['kodebarang']]);
        // dd($cek_mt_barang);
        $stok_cur_1 = $cek_stok[0]->stok_current;
        $jlh_Ret = $dataSet['jumlahretur'];
        $total_retur = ceil($dataSet['jumlahretur'] * $cek_mt_barang[0]->harga_jual);
        $qty_awal = $dataSet['jumlah'];
        $harga_jual = $cek_mt_barang[0]->harga_jual;
        $habis_retur = $qty_awal - $jlh_Ret;
        if ($habis_retur > 0) {
            $status_retur = 'OPN';
            $status_pembayaran = 'OPN';
        } else if ($habis_retur < 0) {
            $data = [
                'kode' => 500,
                'message' => 'retur eror ! jumlah retur tidak sesuai jumlah order',
            ];
            echo json_encode($data);
            die;
        } else if ($habis_retur == 0) {
            $status_retur = 'CLS';
            $status_pembayaran = 'CLS';
        }
        $ts_retur_header = [
            'kode_kunjungan' => $kode_kunjungan,
            'kode_retur_header' => $kode_retur_header,
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_retur' => $this->get_now(),
            'total_retur' => $total_retur,
            'alasan_retur' => 'RETUR',
            'status_retur' => $status_retur,
            'pic' => auth()->user()->id,
            'status_pembayaran' => $status_pembayaran
        ];
        //insert ke ts_retur_header
        $insert_retur_header = ts_retur_header::create($ts_retur_header);
        $ts_retur_detail = [
            'kode_retur_detail' => $this->createReturDetail(),
            'tgl_retur_detail' => $this->get_now(),
            'kode_retur_header' => $kode_retur_header,
            'id_layanan_detail' => $get_detail[0]->id_layanan_detail,
            'qty_awal' => $qty_awal,
            'qty_retur' => $jlh_Ret,
            'qty_sisa' => $habis_retur,
            'tarif_layanan' => $harga_jual,
            'total_retur_detail' => $total_retur,
            'status_retur_detail' => $status_retur,
            'row_id_header' => $insert_retur_header['id'],
        ];
        //insert ke ts_retur_detail
        $insert_retur_detail = ts_retur_detail::create($ts_retur_detail);

        $stok_current = (int)$stok_cur_1 + (int)$jlh_Ret;
        $data_ti_kartu_stok = [
            'no_dokumen' => 'RET' . $get_header[0]->kode_layanan_header,
            'no_dokumen_detail' => 'RET' . $get_detail[0]->id_layanan_detail,
            'tgl_stok' => $this->get_now(),
            'kode_unit' => auth()->user()->unit,
            'kode_barang' => $dataSet['kodebarang'],
            'stok_in' => $jlh_Ret,
            'stok_last' => $cek_stok[0]->stok_current,
            'stok_current' => $stok_current,
            'harga_beli' => $cek_stok[0]->harga_beli,
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
}
