<?php

namespace App\Http\Controllers;

use App\Models\model_order_resep_detail;
use App\Models\model_order_resep_header;
use App\Models\model_template_resep_detail;
use App\Models\model_template_resep_header;
use App\Models\mt_antrian_farmasi_detail;
use App\Models\mt_antrian_farmasi_header;
use App\Models\mt_racikan;
use App\Models\mt_racikan_detail;
use App\Models\mt_unit;
use App\Models\template_racikan_detail;
use App\Models\template_racikan_header;
use App\Models\ti_kartu_stok;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class newFarmasiController extends Controller
{
    public function indexdataorderfarmasi(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'indexdataorder';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('depofarmasi.indexorderanresep', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function riwayatkartustok(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'riwayatkartustok';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('depofarmasi.indexriwayatkartustok', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function indexriwayatpelayananfarmasi(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'indexriwayatpelayananresep';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('depofarmasi.indexriwayatpelayanan', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function getriwayatpelayanan_farmasi(Request $request)
    {
        $unit = $request->unit;
        $awal = $request->tanggalawal;
        $akhir = $request->tanggalakhir;
        $riwayat = db::connection('mysql4')->select('SELECT B.no_rm as rm,a.id AS id_layanan_header,a.`tgl_entry`,a.`kode_kunjungan`
        ,fc_nama_unit1(B.kode_unit) AS unit_pengirim
        ,fc_nama_paramedis1(B.kode_paramedis) as nama_dokter
        ,simrs_waled.fc_nama_px(B.no_rm) AS nama_pasien
        ,simrs_waled.fc_alamat(B.no_rm) AS alamat
        FROM ts_layanan_header A
        INNER JOIN simrs_waled.ts_kunjungan B ON A.`kode_kunjungan` = B.`kode_kunjungan`
        WHERE A.kode_unit = ? AND DATE(A.tgl_entry) BETWEEN ? AND  ?', [$unit, $awal, $akhir]);
        return view('new_farmasi.riwayat_pelayanan', compact([
            'riwayat'
        ]));
    }
    public function detaillayananfarmasi(Request $request)
    {
        $idheader = $request->idheader;
        $datalayanan = db::connection('mysql4')->select('SELECT a.id AS idheader
        ,b.`id` AS iddetail
        ,b.`kode_barang`
        ,c.`nama_barang`
        ,b.`kode_tarif_detail`
        ,d.`NAMA_TARIF`
        ,b.`total_tarif`
        ,b.`jumlah_layanan`
        ,b.`total_layanan`
        ,e.nama_racik
        ,a.`total_layanan` AS grandtotal
        FROM ts_layanan_header a
        INNER JOIN ts_layanan_detail b ON a.`id` = b.`row_id_header`
        LEFT OUTER JOIN mt_barang c ON b.`kode_barang` = c.`kode_barang`
        LEFT OUTER JOIN mt_tarif_header d ON SUBSTR(b.`kode_tarif_detail`,1,6) = D.`KODE_TARIF_HEADER`
        LEFT OUTER JOIN mt_racikan e on b.kode_barang = e.kode_racik
        WHERE a.id = ?', [$idheader]);
        return view('new_farmasi.detail_layanan_farmasi', compact([
            'datalayanan'
        ]));
    }
    public function ambilformfarmasi2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $kunjungan[0]->no_rm;
        return view('new_farmasi.form_order', compact([
            'kodekunjungan',
            'rm'
        ]));
    }
    public function riwayatresepdibuat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $dataorder = db::connection('mysql5')->select('select *,b.id as iddetail from order_farmasi_header a inner join order_farmasi_detail b on a.id = b.idheader where kode_kunjungan = ? and b.status_detail != 0', [$kodekunjungan]);
        return view('new_farmasi.tabel_riwayat_order_hari_ini', compact([
            'dataorder'
        ]));
    }
    public function ambiltabelhasilcariobat(Request $request)
    {
        $nama = $request->keyword;
        $kodekunjungan = $request->kodekunjungan;
        $status = $request->status;
        if ($status == 2) {
            $unit = '4002';
            $data = db::select("CALL sp_cari_obat_stok_all_erm_2(?,?)", ([$nama, $unit]));
        } else {
            $ts_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
            if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                $unit = '4002';
            } else {
                $unit = '4008';
            }
            $data = db::select("CALL sp_cari_obat_stok_all_erm(?,?)", ([$nama, $unit]));
        }
        return view('new_farmasi.tabel_stok_obat', compact([
            'data'
        ]));
    }
    public function ambiltabelhasilcariobat_depo(Request $request)
    {
        $nama = $request->keyword;
        $kodekunjungan = $request->kodekunjungan;
        $status = $request->status;
        if ($status == 2) {
            $unit = '4002';
            $data = db::select("CALL sp_cari_obat_stok_all_erm_2(?,?)", ([$nama, $unit]));
        } else {
            $ts_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
            if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                $unit = '4002';
            } else {
                $unit = '4008';
            }
            $data = db::select("CALL sp_cari_obat_stok_all_erm(?,?)", ([$nama, $unit]));
        }
        return view('depofarmasi.tabel_stok_obat_depo', compact([
            'data'
        ]));
    }
    public function ambiltabelhasilcarikomponenobat_depo(Request $request)
    {
        $nama = $request->keyword;
        $kodekunjungan = $request->kodekunjungan;
        $status = $request->status;
        if ($status == 2) {
            $unit = '4002';
            $data = db::select("CALL sp_cari_obat_stok_all_erm_2(?,?)", ([$nama, $unit]));
        } else {
            $ts_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
            if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                $unit = '4002';
            } else {
                $unit = '4008';
            }
            $data = db::select("CALL sp_cari_obat_stok_all_erm(?,?)", ([$nama, $unit]));
        }
        return view('depofarmasi.tabel_komponen_obat_depo', compact([
            'data'
        ]));
    }
    public function riwayattemplateresep(Request $request)
    {
        $dokter = auth()->user()->kode_paramedis;
        $header = db::connection('mysql5')->select('select * from erm_template_resep_header_2 where kode_paramedis = ?', [$dokter]);
        $detail = db::connection('mysql5')->select('select * from erm_template_resep_header_2 a inner join erm_template_resep_detail_2 b on a.id = b.id_header where a.kode_paramedis = ?', [$dokter]);
        return view('new_farmasi.tabel_template_resep_dokter', compact([
            'header',
            'detail'
        ]));
    }
    public function ambil_detail_template(Request $request)
    {
        $idresep = $request->id;
        $detail = db::connection('mysql5')->select('select * from erm_template_resep_header_2 a inner join erm_template_resep_detail_2 b on a.id = b.id_header where a.id = ?', [$idresep]);
        $str = "";
        foreach ($detail as $d) {
            $str .= "<div class='form-row text-xs'><div class='form-group col-md-2 text-xxs'><label for=''>Tipe Anestesi</label><select class='form-control' id='tipeanestesi' name='tipeanestesi'><option value='REG'>REGULER</option><option value='KRONIS'>KRONIS</option></select></div><div class='form-group col-md-1'><label for=''>Jumlah</label><input type='' class='form-control form-control-sm text-xs edit_field' id='jumlah' name='jumlah' value='$d->jumlah'></div><div class='form-group col-md-2'><label for=''>Nama Barang</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='namabarang' name='namabarang' value='$d->namabarang'><input   hidden readonly type='' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$d->kodebarang'><input hidden readonly type='' class='form-control form-control-sm' id='jenisresep' name='jenisresep' value='$d->jenisresep'></div><div class='form-group col-md-1'><label for=''>Dosis</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='dosis' name='dosis' value='$d->dosis'></div><div class='form-group col-md-1'><label for=''>Stok</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='stok' name='stok' value=''></div><div class='form-group col-md-1'><label for=''>Sediaan</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='sediaan' name='sediaan' value='$d->sediaan'></div><div class='form-group col-md-3'><label for=''>Aturan Pakai</label><textarea type='' cols='3' rows='3' class='form-control form-control-sm text-xs edit_field' id='aturanpakai' name='aturanpakai' value=''>$d->aturanpakai</textarea></div><i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2=''></i></div>";
        }
        return $str;
    }
    public function ambil_detail_resep_pasien(Request $request)
    {
        $idresep = $request->id;
        $detail = db::connection('mysql')->select('SELECT a.id,tgl_entry,fc_nama_paramedis1(a.dok_kirim) AS nama_dokter,c.nama_barang,b.jumlah_layanan,b.aturan_pakai,b.row_id_header,c.dosis,c.sediaan,c.kode_barang,b.tipe_anestesi,d.stok_current FROM ts_layanan_header a
        INNER JOIN ts_layanan_detail b ON a.id = b.row_id_header
        INNER JOIN mt_barang c ON b.kode_barang = c.kode_barang
        INNER JOIN ti_kartu_stok d on b.kode_barang = d.kode_barang
        WHERE d.no = (SELECT MAX(no) from ti_kartu_stok f where f.kode_barang = b.kode_barang and f.kode_unit = a.kode_unit)
        AND b.`row_id_header` = ?', ([$idresep]));
        $str = "";
        foreach ($detail as $d) {
            $str .= "<div class='form-row text-xs'><div class='form-group col-md-2 text-xxs'><label for=''>Tipe Anestesi</label><select class='form-control' id='tipeanestesi' name='tipeanestesi'><option value='REG'>REGULER</option><option value='KRONIS'>KRONIS</option></select></div><div class='form-group col-md-1'><label for=''>Jumlah</label><input type='' class='form-control form-control-sm text-xs edit_field' id='jumlah' name='jumlah' value='$d->jumlah_layanan'></div><div class='form-group col-md-2'><label for=''>Nama Barang</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='namabarang' name='namabarang' value='$d->nama_barang'><input   hidden readonly type='' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$d->kode_barang'><input hidden readonly type='' class='form-control form-control-sm' id='jenisresep' name='jenisresep' value='NON RACIK'></div><div class='form-group col-md-1'><label for=''>Dosis</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='dosis' name='dosis' value='$d->dosis'></div><div class='form-group col-md-1'><label for=''>Stok</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='stok' name='stok' value='$d->stok_current'></div><div class='form-group col-md-1'><label for=''>Sediaan</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='sediaan' name='sediaan' value='$d->sediaan'></div><div class='form-group col-md-3'><label for=''>Aturan Pakai</label><textarea type='' cols='3' rows='3' class='form-control form-control-sm text-xs edit_field' id='aturanpakai' name='aturanpakai' value=''>$d->aturan_pakai</textarea></div><i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2=''></i></div>";
        }
        return $str;
    }
    public function riwayatreseppasien(Request $request)
    {
        $rm = $request->rm;
        $header = db::select('SELECT b.`kode_kunjungan`,b.`kode_layanan_header`,fc_nama_paramedis1(b.dok_kirim) AS nama_dokter,b.`dok_kirim`,b.`tgl_entry`,b.`unit_pengirim`,b.id as id_header FROM ts_kunjungan a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        WHERE a.no_rm = ? AND b.`kode_unit` IN (4001,4002,4008) AND LEFT(a.kode_unit,1) = 1
        ORDER BY a.`kode_kunjungan` DESC', ([$rm]));

        $detail = db::select('SELECT d.nama_barang,c.jumlah_layanan,c.aturan_pakai,c.row_id_header FROM ts_kunjungan a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        INNER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        INNER JOIN mt_barang d ON c.kode_barang = d.kode_barang
        WHERE a.no_rm = ? AND b.`kode_unit` IN (4001,4002,4008)', ([$rm]));

        return view('new_farmasi.tabel_riwaat_resep_pasien', compact([
            'header',
            'detail'
        ]));
    }
    public function riwayatresepdokter(Request $request)
    {
        $rm = $request->rm;
        $dokter = auth()->user()->kode_paramedis;

        $header = db::connection('mysql')->select('SELECT b.`kode_kunjungan`,b.`kode_layanan_header`,fc_nama_paramedis1(b.dok_kirim) AS nama_dokter,b.`dok_kirim`,b.`tgl_entry`,b.`unit_pengirim`,b.id as id_header FROM ts_kunjungan a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        WHERE b.dok_kirim = ? AND b.`kode_unit` IN (4001,4002,4008) AND LEFT(a.kode_unit,1) = 1
        ORDER BY a.`kode_kunjungan`', ([$dokter]));

        $detail = db::connection('mysql')->select('SELECT d.nama_barang,c.jumlah_layanan,c.aturan_pakai,c.row_id_header FROM ts_kunjungan a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        INNER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        INNER JOIN mt_barang d ON c.kode_barang = d.kode_barang
        WHERE b.dok_kirim = ? AND b.`kode_unit` IN (4001,4002,4008) ORDER BY a.kode_kunjungan', ([$dokter]));

        return view('new_farmasi.tabel_riwaat_resep_dokter', compact([
            'header',
            'detail'
        ]));
    }
    public function simpanorderobat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $rm = $request->rm;
        $simpantemplate = 1;
        if (empty($request->template)) {
            $simpantemplate = 0;
        }
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama2) {
            $index2 = $nama2['name'];
            $value2 = $nama2['value'];
            $dataSet2[$index2] = $value2;
            if ($index2 == 'aturanpakai') {
                $arrayobat[] = $dataSet2;
            }
        }
        if ($simpantemplate == 1) {
            if ($request->namatemplate == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Nama template wajib diisi !'
                ];
                echo json_encode($data);
                die;
            }
            $ht = [
                'nama_template' => $request->namatemplate,
                'nama_dokter' => auth()->user()->nama,
                'kode_paramedis' => auth()->user()->kode_paramedis,
                'tgl_entry' => $this->get_date(),
                'status' => '1'
            ];
            $thh = model_template_resep_header::create($ht);
            foreach ($arrayobat as $r) {
                $datab = [
                    'id_header' => $thh->id,
                    'tipeanestesi' => $r['tipeanestesi'],
                    'jenisresep' => $r['jenisresep'],
                    'jumlah' => $r['jumlah'],
                    'namabarang' => $r['namabarang'],
                    'kodebarang' => $r['kodebarang'],
                    'dosis' => $r['dosis'],
                    'sediaan' => $r['sediaan'],
                    'aturanpakai' => $r['aturanpakai'],
                ];
                model_template_resep_detail::create($datab);
            }
        }
        $datakunjungan = db::connection('mysql')->select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($datakunjungan[0]->kode_penjamin == 'P01') {
            $tujuan = '4002';
        } else {
            $tujuan = '4008';
        };
        $dataheader = [
            'kode_kunjungan' => $kodekunjungan,
            'kode_paramedis' => auth()->user()->kode_paramedis,
            'no_rm' => $rm,
            'unit_tujuan' => $tujuan,
            'unit_pengirim' => auth()->user()->kode_unit,
            'tgl_kirim' => $this->get_date(),
            'nomor_antrian' => '',
            'status_antrian' => 0,
        ];
        $headeroder =  model_order_resep_header::create($dataheader);
        foreach ($arrayobat as $r) {
            $data_detail = [
                'idheader' => $headeroder->id,
                'kodebarang' => $r['kodebarang'],
                'namabarang' => $r['namabarang'],
                'jumlah' => $r['jumlah'],
                'dosis' => $r['dosis'],
                'sediaan' => $r['sediaan'],
                'aturanpakai' => $r['aturanpakai'],
                'jenisresep' => $r['jenisresep'],
                'tipeanestesi' => $r['tipeanestesi'],
            ];
            model_order_resep_detail::create($data_detail);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function batalorderobat(Request $request)
    {
        $iddetail = $request->iddetail;
        $detail = db::connection('mysql5')->select('select * from order_farmasi_detail where id = ?', [$iddetail]);
        $header = db::connection('mysql5')->select('select * from order_farmasi_header where id = ?', [$detail[0]->idheader]);

        if ($header[0]->status_antrian == 2) {
            $data = [
                'kode' => 500,
                'message' => 'Order sudah diterima farmasi, hubungi farmasi untuk membatalkan orderan !'
            ];
            echo json_encode($data);
            die;
        }
        DB::connection('mysql5')->table('order_farmasi_detail')->where('id', $iddetail)->update(['status_detail' => 0]);

        $orderfarmasi = db::connection('mysql5')->select('select * from order_farmasi_detail where idheader = ? and status_detail != 0', [$header[0]->id]);
        if (count($orderfarmasi) == 0) {
            //membatalkan order
            DB::connection('mysql5')->table('order_farmasi_header')->where('id', $header[0]->id)->update(['status_antrian' => 8]);
            $header_order = $header[0]->id;
            //cek antrian

            $header_antrian = db::connection('mysql5')->select('select * from erm_antrian_farmasi_detail where id_header_order = ?', [$header_order]);
            if (count($header_antrian) > 0) {

                $id_header_antrian = $header_antrian[0]->idheader_antrian;
                $cek_order2 = db::connection('mysql5')->select('select * from erm_antrian_farmasi_detail a inner join order_farmasi_header b on a.id_header_order = b.id where a.idheader_antrian = ? and b.status_antrian != ?', [$id_header_antrian, 8]);

                if (count($cek_order2) == 0) {
                    DB::connection('mysql5')->table('erm_antrian_farmasi')->where('id', $id_header_antrian)->delete();
                    DB::connection('mysql5')->table('erm_antrian_farmasi_detail')->where('idheader_antrian', $id_header_antrian)->delete();
                }
            }
        }
        $data = [
            'kode' => 200,
            'message' => 'Order berhasil dibatalkan !'
        ];
        echo json_encode($data);
        die;
    }
    public function kirimorderkefarmasi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = db::select('select * ,fc_nama_px(no_rm) as nama_pasein,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            $unit = '4002';
            $kodeantrian = 'DP1';
        } else {
            $unit = '4008';
            $kodeantrian = 'DP2';
        }
        $nomor_urut = $this->get_nomor_urut($unit);
        $header_antrian = [
            'nomor_urut' => $nomor_urut,
            'kode_unit' => $unit,
            'status_panggil' => 0,
            'no_rm' => $kunjungan[0]->no_rm,
            'nama_pasien' => $kunjungan[0]->nama_pasein,
            'kode_unit_asal' => $kunjungan[0]->kode_unit,
            'nama_unit_asal' => $kunjungan[0]->nama_unit,
            'kode_kunjungan' => $kodekunjungan,
            'tanggal_kirim' => $this->get_now(),
            'kode_antrian' => $kodeantrian
        ];
        $get_order_header = db::connection('mysql5')->select('select * from order_farmasi_header where status_antrian = ? and kode_kunjungan = ?', [0, $kodekunjungan]);
        if (count($get_order_header) > 0) {
            $header_antrian_1 = mt_antrian_farmasi_header::create($header_antrian);
            foreach ($get_order_header as $G) {
                $data_detail = [
                    'idheader_antrian' => $header_antrian_1->id,
                    'id_header_order' => $G->id
                ];
                $header_antrian_2 = mt_antrian_farmasi_detail::create($data_detail);
                DB::connection('mysql5')->table('order_farmasi_header')->where('kode_kunjungan', $kodekunjungan)->where('id', $G->id)->update(['status_antrian' => 1]);
            }
            $data = [
                'kode' => 200,
                'message' => 'antrian berhasil dikirim !'
            ];
            echo json_encode($data);
            die;
        } else {
            $data = [
                'kode' => 500,
                'message' => 'Semua order sudah dikirim !'
            ];
            echo json_encode($data);
            die;
        }
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_nomor_urut($kodeunit)
    {
        $q = DB::connection('mysql5')->select('SELECT id,nomor_urut as kd_max FROM erm_antrian_farmasi
        WHERE DATE(tanggal_kirim) = CURDATE() and kode_unit = ? ORDER BY id DESC LIMIT 1', [$kodeunit]);
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%1s", $tmp);
            }
        } else {
            $kd = "1";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $kd;
    }
    public function batalkirimorder_action(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $antrian = db::connection('mysql5')->select('select *,a.id as idd,b.id_header_order as idx from erm_antrian_farmasi a inner join erm_antrian_farmasi_detail b on a.id = b.idheader_antrian where a.kode_kunjungan = ? and a.status_antrian = ?', [$kodekunjungan, 0]);
        if (count($antrian) == 0) {
            $data = [
                'kode' => 500,
                'message' => 'belum ada order yang dikirim !'
            ];
            echo json_encode($data);
            die;
        } else {
            foreach ($antrian as $a) {
                DB::connection('mysql5')->table('order_farmasi_header')->where('id', $a->idx)->update(['status_antrian' => 0]);
                // DB::connection('mysql5')->table('erm_antrian_farmasi')->where('id', $a->idd)->update(['status_antrian' => 8 ]);
                DB::connection('mysql5')->table('erm_antrian_farmasi')->where('id', $a->idd)->delete();
                DB::connection('mysql5')->table('erm_antrian_farmasi_detail')->where('idheader_antrian', $a->idd)->delete();
            }
            $data = [
                'kode' => 200,
                'message' => 'Order berhasil dibatalkan !'
            ];
            echo json_encode($data);
            die;
        }
    }
    public function dataorderfarmasi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $rm = $request->nomorrm;
        $headerorder = db::connection('mysql5')->select('select * from order_farmasi_header where kode_kunjungan = ? and status_antrian != 8', [$kodekunjungan]);

        $antrian = db::connection('mysql5')->select('SELECT * FROM erm_antrian_farmasi a
        INNER JOIN erm_antrian_farmasi_detail b ON a.id = b.`idheader_antrian`
        INNER JOIN mt_unit c on a.kode_unit = c.kode_unit
        WHERE a.`kode_kunjungan` = ?', [$kodekunjungan]);

        $dataorder = db::connection('mysql5')->select('SELECT *,d.id as iddetail FROM order_farmasi_header c INNER JOIN order_farmasi_detail d ON c.id = d.idheader WHERE c.kode_kunjungan = ? AND c.status_antrian != 8 and d.status_detail != 0', [$kodekunjungan]);



        // $orderfarmasi = db::connection('mysql5')->select('select *,b.id as iddetail,a.status_antrian as status_antrian_a,c.nomor_urut as status_antrian_b,c.status_antrian as status_kirim from order_farmasi_header a
        // inner join order_farmasi_detail b on a.id = b.idheader
        // left outer join erm_antrian_farmasi c on a.kode_kunjungan = c.kode_kunjungan
        // where a.kode_kunjungan = ? and a.status_antrian != 8 and b.status_detail >= 1', [$kodekunjungan]);


        return view('new_farmasi.tabel_order_farmasi', compact([
            'antrian',
            'headerorder',
            'dataorder',
            'kodekunjungan'
        ]));
    }
    public function cariorderfarmasi(Request $request)
    {
        $unit = $request->unit;
        $tanggal = $request->tanggal;
        $dataorder = db::connection('mysql5')->select('SELECT * FROM erm_antrian_farmasi a WHERE status_antrian = 0 and kode_unit = ? and date(tanggal_kirim) = ?', [$unit, $tanggal]);
        return view('depofarmasi.tabel_order_resep', compact([
            'dataorder'
        ]));
    }
    public function cariorderfarmasidilayani(Request $request)
    {
        $unit = $request->unit;
        $tanggal = $request->tanggal;
        $dataorder = db::connection('mysql5')->select('SELECT * FROM erm_antrian_farmasi a WHERE status_antrian = 1 and kode_unit = ? and date(tanggal_kirim) = ?', [$unit, $tanggal]);
        return view('depofarmasi.tabel_order_resep_dilayani', compact([
            'dataorder'
        ]));
    }
    public function detailorderan(Request $request)
    {
        $idorder = $request->idorder;
        $tanggal = $request->tanggal;
        $header = db::connection('mysql5')->select('SELECT *,a.kode_kunjungan as kondekunjungannya FROM erm_antrian_farmasi a WHERE id = ?', [$idorder]);
        $dataorder = db::connection('mysql5')->select('SELECT *,a.id as id_antrian,c.id as id_header_order,d.id as id_detail_order FROM erm_antrian_farmasi a
        INNER JOIN erm_antrian_farmasi_detail b on a.id = b.idheader_antrian
        INNER JOIN order_farmasi_header c on b.id_header_order = c.id
        INNER JOIN order_farmasi_detail d on c.id = d.idheader where a.id = ? and a.status_antrian = 0 and c.status_antrian = 1 and d.status_detail = 1', [$idorder]);
        // dd($dataorder);
        $dataaa = [];
        if (count($dataorder) > 0) {
            foreach ($dataorder as $d) {
                if ($d->jenisresep != 'RACIKAN') {
                    $stok = db::connection('mysql')->select('SELECT kode_barang,fc_nama_barang(a.kode_barang) AS namabarang, stok_current,tgl_stok FROM ti_kartu_stok a WHERE a.no = (SELECT MAX(b.no) AS nomax FROM ti_kartu_stok b WHERE b.`kode_barang` =  ? AND kode_unit = ?)', [$d->kodebarang, $d->unit_tujuan]);
                    $index2 = 'stok';
                    $value2 = $stok[0]->stok_current;
                    $dataSet2 = [
                        'id_antrian' => $d->id_antrian,
                        'id_header_order' => $d->id_header_order,
                        'id_detail_order' => $d->id_detail_order,
                        'namabarang' => $d->namabarang,
                        'kodebarang' => $d->kodebarang,
                        'tipeanestesi' => $d->tipeanestesi,
                        'jumlah' => $d->jumlah,
                        'jenisresep' => $d->jenisresep,
                        'dosis' => $d->dosis,
                        'sediaan' => $d->sediaan,
                        'aturanpakai' => $d->aturanpakai,
                        'stok' => $stok[0]->stok_current,
                    ];
                    $dataorder2[] = $dataSet2;
                } else {
                    $dataSet2 = [
                        'id_antrian' => $d->id_antrian,
                        'id_header_order' => $d->id_header_order,
                        'id_detail_order' => $d->id_detail_order,
                        'namabarang' => $d->namabarang,
                        'kodebarang' => $d->kodebarang,
                        'tipeanestesi' => $d->tipeanestesi,
                        'jumlah' => $d->jumlah,
                        'jenisresep' => $d->jenisresep,
                        'dosis' => $d->dosis,
                        'sediaan' => $d->sediaan,
                        'aturanpakai' => $d->aturanpakai,
                        'stok' => 0,
                    ];
                    $dataorder2[] = $dataSet2;
                }
            }
        } else {
            $dataorder2 = [];
        }
        // dd($dataorder2);
        return view('depofarmasi.detail_order_resep', compact([
            'header',
            'dataorder2',
            'idorder'
        ]));
    }
    public function ambiltemplateracikan()
    {
        $templateracikan = db::connection('mysql5')->select('select * from template_racikan_header');
        return view('depofarmasi.tabel_template_racikan', compact([
            'templateracikan'
        ]));
    }
    public function riwayatracikandokter()
    {
        $templateracikan = db::connection('mysql5')->select('select * from template_racikan_header where pic = ?', [auth()->user()->id]);
        return view('depofarmasi.tabel_template_racikan', compact([
            'templateracikan'
        ]));
    }
    public function hapustemplateracik(Request $request)
    {
        $idheader = $request->idheader;
        template_racikan_header::where('id', $idheader)->delete();
        template_racikan_detail::where('idheader', $idheader)->delete();
        $data = [
            'kode' => 200,
            'message' => 'Template racikan berhasil dihapus'
        ];
        echo json_encode($data);
        die;
    }
    public function ambil_detail_template_racikan(Request $request)
    {
        $idheader = $request->idheader;
        $racikan = db::connection('mysql5')->select('select * from template_racikan_header where id =?', [$idheader]);
        $str = "";
        foreach ($racikan as $d) {
            $kemasan = strtoupper($d->kemasan);
            $str .= "<div class='form-row'><div class='form-group col-md-2 '><label for=''>Tipe Anestesi</label><select class='form-control' id='tipeanestesi' name='tipeanestesi'><option value='REG'>REGULER</option><option value='KRONIS'>KRONIS</option></select></div><div class='form-group col-md-1'><label for=''>Jumlah</label><input type='' class='form-control form-control  edit_field' id='jumlah' name='jumlah' value='$d->jumlah'></div><div class='form-group col-md-2'><label for=''>Nama Barang</label><input readonly type='' class='form-control form-control  edit_field' id='namabarang' name='namabarang' value='$d->nama_racikan'><input   hidden readonly type='' class='form-control form-control' id='kodebarang' name='kodebarang' value='$d->id'><input hidden readonly type='' class='form-control form-control' id='jenisresep' name='jenisresep' value='RACIKAN'></div><div class='form-group col-md-1'><label for=''>Dosis</label><input readonly type='' class='form-control form-control  edit_field' id='dosis' name='dosis' value='0'></div><div class='form-group col-md-1'><label for=''>Stok</label><input readonly type='' class='form-control form-control  edit_field' id='stok' name='stok' value='0'></div><div class='form-group col-md-1'><label for=''>Sediaan</label><input readonly type='' class='form-control form-control  edit_field' id='sediaan' name='sediaan' value='$kemasan'></div><div class='form-group col-md-3'><label for=''>Aturan Pakai / Keterangan </label><textarea type='' cols='8' rows='8' class='form-control form-control  edit_field' id='aturanpakai' name='aturanpakai' value=''>$d->aturanpakai / $d->keterangan</textarea></div><i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2=''></i></div>";
        }
        return $str;
    }
    public function simpandatapelayanan(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $master_jasa = db::select('select * from mt_jasa_farmasi');
        if (count($data) == 0) {
            $data = [
                'kode' => 500,
                'message' => 'Tidak ada obat yang dipilih ...'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($data as $nama2) {
            $index2 = $nama2['name'];
            $value2 = $nama2['value'];
            $dataSet2[$index2] = $value2;
            if ($index2 == 'aturanpakai') {
                $arrayobat[] = $dataSet2;
            }
        }
        //looping cek stok obat
        foreach ($arrayobat as $ab) {
            //cekstok obat
            if ($ab['jenisresep'] != 'RACIKAN') {
                $cek_stok = db::connection('mysql')->select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$ab['kodebarang'], '4008']));
                if (count($cek_stok) > 0) {
                    $stok_current = $cek_stok[0]->stok_current - $ab['jumlah'];
                    if ($stok_current < 0) {
                        $data = [
                            'kode' => 500,
                            'message' => $ab['namabarang'] . ' ' . 'Stok Tidak Mencukupi !',
                        ];
                        echo json_encode($data);
                        die;
                    }
                } else {
                    $data = [
                        'kode' => 500,
                        'message' => $ab['namabarang'] . ' ' . 'Stok Tidak ditemukan !',
                    ];
                    echo json_encode($data);
                    die;
                }
            } else {
                $koderacikan = $ab['kodebarang'];
                $get_data_racikan = db::connection('mysql5')->select('select * from template_racikan_header a inner join template_racikan_detail b on a.id = b.idheader where a.id = ?', [$koderacikan]);
                if (count($get_data_racikan) > 0) {
                    foreach ($get_data_racikan as $dr) {
                        $cek_stok_racikan = db::connection('mysql')->select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$dr->kodebarang, '4008']));
                        if (count($cek_stok_racikan) > 0) {
                            $stok_current_racikan = $cek_stok_racikan[0]->stok_current - $dr->jumlah;
                            if ($stok_current_racikan < 0) {
                                $data = [
                                    'kode' => 500,
                                    'message' => $dr->namabarang . ' ' . 'Stok komponen Tidak Mencukupi !',
                                ];
                                echo json_encode($data);
                                die;
                            }
                        } else {
                            $data = [
                                'kode' => 500,
                                'message' => $ab->namabarang . ' ' . 'Stok komponen Tidak ditemukan !',
                            ];
                            echo json_encode($data);
                            die;
                        }
                    }
                } else {
                    $data = [
                        'kode' => 500,
                        'message' => 'DATA racikan tidak ditemukan !',
                    ];
                    echo json_encode($data);
                    die;
                }
            }
        }
        //end looping cek stok obat


        $kodekunjungan = $request->kodekunjungan;
        $assdok = db::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        $ts_kunjungan = db::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if (count($assdok) > 0) {
            $diagnosa = $assdok[0]->diagnosakerja;
        } else {
            $diagnosa = $ts_kunjungan[0]->diagx;
        }
        if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
            $kode_unit = '4002';
            $kode_tipe_transaksi = 1;
        } else {
            $kode_unit = '4008';
            $kode_tipe_transaksi = 2;
        }
        $unit = mt_unit::where('kode_unit', '=', "$kode_unit")->get();
        $date = $this->get_now();
        $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
        $kode_layanan_header = $r[0]->no_trx_layanan;
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
            DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kode_unit]);
        }
        $dataheader = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' => $date,
            'kode_kunjungan' => $kodekunjungan,
            'kode_unit' => $kode_unit,
            'kode_tipe_transaksi' => $kode_tipe_transaksi,
            'kode_penjaminx' => $ts_kunjungan[0]->kode_penjamin,
            'pic' => auth()->user()->id,
            'status_layanan' => 3
        ];
        $layanan_header = ts_layanan_header_dummy::create($dataheader);
        $total_layanan_header = 0;
        $racikannya = 0;
        $nonracikannya = 0;
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamat_px from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);

        foreach ($arrayobat as $ob) {
            if ($ob['jenisresep'] != 'RACIKAN') {
                $kodebarang = $ob['kodebarang'];
                $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kodebarang]);
                $hna = $mt_barang[0]->hna;
                $persen = $hna * 30 / 100;
                $hh = $hna + $persen;
                $total_tarif = $hh * $ob['jumlah'];
                if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                    $tagihan_pribadi = $total_tarif;
                    $tagihan_penjamin = 0;
                } else {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total_tarif;
                }
                if ($ob['tipeanestesi'] == 'REG') {
                    $tipeanes = '80';
                } elseif ($ob['tipeanestesi'] == 'KRONIS') {
                    $tipeanes = '81';
                }
                $detailbarang = $this->createLayanandetail();
                $now1 = $this->get_now();
                $datadetail = [
                    'id_layanan_detail' => $detailbarang,
                    'kode_layanan_header' => $kode_layanan_header,
                    'row_id_header' => $layanan_header->id,
                    'total_tarif' => $hna,
                    'jumlah_layanan' => $ob['jumlah'],
                    'total_layanan' => $total_tarif,
                    'diskon_layanan' => '0',
                    'cyto' => 0,
                    'diskonan_global' => 0,
                    'grantotal_layanan' => $total_tarif,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'kode_dokter1' => $ts_kunjungan[0]->kode_paramedis,
                    'tipe_anestesi' => $tipeanes,
                    'kode_barang' => $ob['kodebarang'],
                    'aturan_pakai' => $ob['aturanpakai'],
                    'satuan_barang' => $mt_barang[0]->satuan,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $date,
                    'tgl_layanan_detail_2' => $date,
                ];
                $layanan_detail = ts_layanan_detail_dummy::create($datadetail);
                $tarif_embalase = $master_jasa[0]->jasa_resep + $master_jasa[0]->jasa_embalase;

                if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                    $tagihan_pribadi_embalase = $tarif_embalase;
                    $tagihan_penjamin_embalase = 0;
                } else {
                    $tagihan_pribadi_embalase = 0;
                    $tagihan_penjamin_embalase = $tarif_embalase;
                }
                $jasaembalase = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $tarif_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' =>  $tarif_embalase,
                    'diskon_layanan' => 0,
                    'grantotal_layanan' =>  $tarif_embalase,
                    'kode_dokter1' => $ts_kunjungan[0]->kode_paramedis,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $date,
                    'tgl_layanan_detail_2' => $date,
                    'satuan_barang' => '-',
                    'cyto' => 0,
                    'tagihan_pribadi' => $tagihan_pribadi_embalase,
                    'tagihan_penjamin' => $tagihan_penjamin_embalase,
                    'diskonan_global' => 0,
                    'status_layanan_detail' => 'OPN',
                    'tipe_anestesi' => $tipeanes,
                    'row_id_header' => $layanan_header->id
                ];
                $layanan_detail_embalase = ts_layanan_detail_dummy::create($jasaembalase);
                $total_layanan_header = $total_layanan_header + $total_tarif + $tarif_embalase;
                $nonracikannya = $nonracikannya + 1;
                //penguranganstok
                $cek_stok = db::connection('mysql')->select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$ob['kodebarang'], auth()->user()->unit]));
                $datastok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $detailbarang,
                    'tgl_stok' => $now1,
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $ob['kodebarang'],
                    'stok_last' => $cek_stok[0]->stok_current,
                    'stok_out' => $ob['jumlah'],
                    'stok_current' => $cek_stok[0]->stok_current - $ob['jumlah'],
                    'qty_pending' => '0',
                    'stok_global' => '0',
                    'harga_beli' => $cek_stok[0]->harga_beli,
                    'inputby' => auth()->user()->id,
                    'keterangan' => $ts_kunjungan[0]->no_rm . ' | ' . $mt_pasien[0]->nama_px . ' | ' . $mt_pasien[0]->alamat_px,
                ];
                ti_kartu_stok::create($datastok);
            } else {
                $racikannya = $racikannya + 1;
            }
        }

        if ($racikannya > 0) {
            foreach ($arrayobat as $ob) {
                if ($ob['jenisresep'] == 'RACIKAN') {
                    $koderacik = $ob['kodebarang'];
                    $get_data_racikan = db::connection('mysql5')->select('select * from template_racikan_header a inner join template_racikan_detail b on a.id = b.idheader where a.id = ?', [$koderacik]);
                    $koderacik = $this->createkoderacik();
                    //membuat mt racikan header dan mt racikan detail
                    $mt_racikan = [
                        'kode_racik' => $koderacik,
                        'tgl_racik' => $this->get_date(),
                        'nama_racik' => $ob['namabarang'],
                        'total_racik' => '0',
                        'tipe_racik' => '',
                        'qty_racik' => $ob['jumlah'],
                        'kemasan' => 'S',
                        'hrg_kemasan' => 0,
                    ];
                    $header_racikan = mt_racikan::create($mt_racikan);
                    $total_racik = 0;
                    foreach ($get_data_racikan as $gdr) {
                        $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$gdr->kodebarang]);
                        $hna = $mt_barang[0]->hna;
                        $hargajual2 = $hna * 30 / 100;
                        $hargabarang = $hna + $hargajual2;
                        // $hargabarang = $mt_barang[0]->hragajual;
                        $mt_racikan_detail = [
                            'kode_racik' => $koderacik,
                            'kode_barang' => $gdr->kodebarang,
                            'qty_barang' => $gdr->jumlah,
                            'satuan_barang' => $gdr->sediaan,
                            'harga_satuan_barang' => $hargabarang,
                            'subtotal_barang' => $hargabarang * $gdr->jumlah,
                            'grantotal_barang' => $hargabarang * $gdr->jumlah,
                            'harga_brg_embalase' => $hargabarang * $gdr->jumlah,
                        ];
                        mt_racikan_detail::create($mt_racikan_detail);
                        $mt_racikan_detail_2 = [
                            'kode_racik' => $koderacik,
                            'kode_barang' => 'TX23513',
                            'qty_barang' => 1,
                            'satuan_barang' => '-',
                            'harga_satuan_barang' => 1700,
                            'subtotal_barang' => 1700,
                            'grantotal_barang' => 1700,
                            'harga_brg_embalase' => 1700,
                        ];
                        mt_racikan_detail::create($mt_racikan_detail_2);
                        $totalbarang = $hargabarang * $gdr->jumlah;
                        $total = $totalbarang + 1700;
                        $total_racik = $total + $total_racik;
                        $now1 = $this->get_now();
                        $cek_stok2 = db::connection('mysql')->select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$gdr->kodebarang, auth()->user()->unit]));
                        $datastok = [
                            'no_dokumen' => $kode_layanan_header,
                            'no_dokumen_detail' => $koderacik,
                            'tgl_stok' => $now1,
                            'kode_unit' => auth()->user()->unit,
                            'kode_barang' => $gdr->kodebarang,
                            'stok_last' => $cek_stok2[0]->stok_current,
                            'stok_out' => $ob['jumlah'],
                            'stok_current' => $cek_stok2[0]->stok_current - $ob['jumlah'],
                            'qty_pending' => '0',
                            'stok_global' => '0',
                            'harga_beli' => $cek_stok2[0]->harga_beli,
                            'inputby' => auth()->user()->id,
                            'keterangan' => $ts_kunjungan[0]->no_rm . ' | ' . $mt_pasien[0]->nama_px . ' | ' . $mt_pasien[0]->alamat_px,
                        ];
                        ti_kartu_stok::create($datastok);
                    }
                    if ($ob['sediaan'] == 'POTSALEP') {
                        $hargakemasan = 7000;
                    } else {
                        $hargakemasan = 700 * $ob['jumlah'];
                    }
                    $update = [
                        'total_racik' => $total_racik,
                        'hrg_kemasan' => $hargakemasan
                    ];
                    mt_racikan::whereRaw('id = ?', array($header_racikan->id))->update($update);
                    $totalracikan = $total_racik;
                    //insert racikan ke ts_layanan_detail .....
                    if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                        $tagihan_pribadi = $totalracikan + $hargakemasan;
                        $tagihan_penjamin = 0;
                    } else {
                        $tagihan_pribadi = 0;
                        $tagihan_penjamin =  $totalracikan + $hargakemasan;
                    }
                    if ($ob['tipeanestesi'] == 'REG') {
                        $tipeanes = '80';
                    } elseif ($ob['tipeanestesi'] == 'KRONIS') {
                        $tipeanes = '81';
                    }
                    $datadetail_Racikan = [
                        'id_layanan_detail' => $this->createLayanandetail(),
                        'kode_layanan_header' => $kode_layanan_header,
                        'row_id_header' => $layanan_header->id,
                        'total_tarif' =>  $totalracikan + $hargakemasan,
                        'jumlah_layanan' => $ob['jumlah'],
                        'total_layanan' =>  $totalracikan + $hargakemasan,
                        'diskon_layanan' => '0',
                        'cyto' => 0,
                        'diskonan_global' => 0,
                        'grantotal_layanan' =>  $totalracikan + $hargakemasan,
                        'tagihan_pribadi' => $tagihan_pribadi,
                        'tagihan_penjamin' => $tagihan_penjamin,
                        'kode_dokter1' => $ts_kunjungan[0]->kode_paramedis,
                        'tipe_anestesi' => $tipeanes,
                        'kode_barang' => $koderacik,
                        'aturan_pakai' => $ob['aturanpakai'],
                        'satuan_barang' => '-',
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $date,
                        'tgl_layanan_detail_2' => $date,
                    ];
                    $layanan_detail = ts_layanan_detail_dummy::create($datadetail_Racikan);
                    $total_layanan_header = $total_layanan_header + $total_racik;
                }
            }
        }

        //jasa obat non racikan
        $tarif_jasa_baca = $master_jasa[0]->jasa_baca;
        if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
            $tagihan_pribadi_jasabaca = $tarif_jasa_baca;
            $tagihan_penjamin_jasabaca = 0;
        } else {
            $tagihan_pribadi_jasabaca = 0;
            $tagihan_penjamin_jasabaca = $tarif_jasa_baca;
        }
        $jasa_baca = [
            'id_layanan_detail' => $this->createLayanandetail(),
            'kode_layanan_header' => $kode_layanan_header,
            'kode_tarif_detail' => 'TX23523',
            'total_tarif' => $tarif_jasa_baca,
            'jumlah_layanan' => 1,
            'total_layanan' =>  $tarif_jasa_baca,
            'diskon_layanan' => 0,
            'grantotal_layanan' =>  $tarif_jasa_baca,
            'kode_dokter1' => $ts_kunjungan[0]->kode_paramedis,
            'status_layanan_detail' => 'OPN',
            'tgl_layanan_detail' => $date,
            'tgl_layanan_detail_2' => $date,
            'satuan_barang' => '-',
            'cyto' => 0,
            'tagihan_pribadi' => $tagihan_pribadi_jasabaca,
            'tagihan_penjamin' => $tagihan_penjamin_jasabaca,
            'diskonan_global' => 0,
            'status_layanan_detail' => 'OPN',
            'tipe_anestesi' => $tipeanes,
            'row_id_header' => $layanan_header->id
        ];
        $total_layanan_header = $total_layanan_header + $tarif_jasa_baca;
        $layanan_detail_jasa_baca = ts_layanan_detail_dummy::create($jasa_baca);
        if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
            $tagihan_penjamin_header = 0;
            $tagihan_pribadi_header = $total_layanan_header;
        } else {
            $tagihan_penjamin_header = $total_layanan_header;
            $tagihan_pribadi_header = 0;
        }
        $data_header_update = [
            'total_layanan' => $total_layanan_header,
            'status_retur' => 'OPN',
            'tagihan_penjamin' => $tagihan_penjamin_header,
            'tagihan_pribadi' => $tagihan_pribadi_header,
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $ts_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $ts_kunjungan[0]->kode_unit . ' | ' . $ts_kunjungan[0]->nama_unit,
            'diagnosa' => $diagnosa
        ];
        DB::connection('mysql4')->table('ts_layanan_header')->where('id', $layanan_header->id)->update($data_header_update);
        //end jasa obat non racikan
        foreach ($arrayobat as $ob) {
            if (empty($ob['idantrianheader'])) {
            } else {
                $id_antrian = $ob['idantrianheader'];
                $id_header_order = $ob['idheaderorder'];
                $iddetailorder = $ob['iddetailorder'];
                $cek_antrian = db::connection('mysql5')->select('select * from erm_antrian_farmasi where id = ? and status_antrian = ?', [$id_antrian, 0]);
                $cek_order_header = db::connection('mysql5')->select('select * from order_farmasi_header where id = ? and status_antrian = ?', [$id_header_order, 1]);
                $cek_order_detail = db::connection('mysql5')->select('select * from order_farmasi_detail where id = ? and status_detail = ?', [$iddetailorder, 1]);
                if (count($cek_antrian) > 0) {
                    DB::connection('mysql5')->table('erm_antrian_farmasi')->where('id', $id_antrian)->update(['status_antrian' => 1]);
                    DB::connection('mysql5')->table('erm_antrian_farmasi_detail')->where('idheader_antrian', $id_antrian)->update(['id_layanan_header' => $layanan_header->id]);
                }
                if (count($cek_order_header) > 0) {
                    DB::connection('mysql5')->table('order_farmasi_header')->where('id', $id_header_order)->update(['status_antrian' => 2]);
                }
                if (count($cek_antrian) > 0) {
                    DB::connection('mysql5')->table('order_farmasi_detail')->where('id', $iddetailorder)->update(['status_detail' => 2]);
                }
            }
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil simpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function riwayatresepdilayani(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $datalayanan = db::connection('mysql4')->select('select *,b.kode_barang as kdbrg,a.id as idheader,b.id as iddetail
        from ts_layanan_header a
        INNER JOIN ts_layanan_detail b on a.id = b.row_id_header
        LEFT OUTER JOIN mt_barang c on b.kode_barang = c.kode_barang
        LEFT OUTER JOIN mt_tarif_header d ON SUBSTR(b.kode_tarif_detail,1,6) = d.KODE_TARIF_HEADER
        LEFT OUTER JOIN mt_racikan e on b.kode_barang = e.kode_racik where a.kode_kunjungan = ? and a.kode_unit > 4000', [$kodekunjungan]);

        $dataheader = db::connection('mysql4')->select('select *,fc_nama_unit1(kode_unit) as nama_unit,fc_NAMA_PARAMEDIS1(dok_kirim) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjaminx) as nama_penjamin from ts_layanan_header where kode_kunjungan = ?', [$kodekunjungan]);
        return view('depofarmasi.tabel_riwayat_resepdilayani', compact([
            'datalayanan',
            'dataheader'
        ]));
    }
    public function detailorderanditerima(Request $request)
    {
        $idorder = $request->idorder;
        $detail =  DB::connection('mysql5')->select('select * from erm_antrian_farmasi_detail where idheader_antrian = ?', [$idorder]);
        foreach ($detail as $d) {
            $detail =  DB::connection('mysql5')->select('select * from order_farmasi_detail where idheader = ?', [$d->id_header_order]);
            $detail2 =  DB::connection('mysql4')->select("SELECT b.`kode_barang`,b.`nama_barang`,b.`sediaan`,b.`dosis`,a.`aturan_pakai`,a.jumlah_layanan FROM ts_layanan_detail a
            LEFT OUTER JOIN mt_barang b ON a.`kode_barang` = b.`kode_barang`
            LEFT OUTER JOIN mt_racikan c ON a.`kode_barang` = c.`kode_racik`
            WHERE a.row_id_header = ? AND a.`kode_barang` != ''", [$d->id_layanan_header]);
            $arrayobatorder[] = $detail;
            $arrayobatfix[] = $detail2;
        }
        return view('depofarmasi.detail_resep_sudah_dilayani', compact([
            'arrayobatorder',
            'arrayobatfix',
            'idorder'
        ]));
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
    public function createkoderacik()
    {
        $q = DB::connection('mysql4')->select('SELECT id,kode_racik,RIGHT(kode_racik,3) AS kd_max  FROM mt_racikan
        WHERE DATE(tgl_racik) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'R' . date('ymd') . $kd;
    }
    public function simpanracikan(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        if (count($data) == 0) {
            $data = [
                'kode' => 500,
                'message' => 'Tidak ada obat yang dipilih ...'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($data as $nama2) {
            $index2 = $nama2['name'];
            $value2 = $nama2['value'];
            $dataSet2[$index2] = $value2;
            if ($index2 == 'dosisracik') {
                $arrayobat[] = $dataSet2;
            }
        }
        $namaracikan =  $request->namaracikan;
        $tiperacikan = $request->tipperacikan;
        $kemasan = $request->kemasanracikan;
        $jumlah = $request->jumlahracikan;
        $aturanpakai = $request->aturanpakai;
        $kodekunjungan = $request->kodekunjungan;
        $datakunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $unitasal = $datakunjungan[0]->kode_unit;
        $dataracikanheader = [
            'kode_unit' => $unitasal,
            'pic' => auth()->user()->id,
            'tgl_dibuat' => $this->get_date(),
            'nama_racikan' => $namaracikan,
            'tiperacikan' => $tiperacikan,
            'kemasan' => $kemasan,
            'jumlah' => $jumlah,
            'aturanpakai' => $aturanpakai
        ];
        $header = template_racikan_header::create($dataracikanheader);
        $keteranganr = [];
        foreach ($arrayobat as $a) {
            $qty = $a['dosisracik'] * $jumlah / $a['dosis'];
            $dataracikandetail = [
                'idheader' => $header->id,
                'namabarang' => $a['namabarang'],
                'kodebarang' => $a['kodebarang'],
                'sediaan' => $a['sediaan'],
                'dosisawal' => $a['dosis'],
                'dosisracik' => $a['dosisracik'],
                'jumlah' => $qty
            ];
            template_racikan_detail::create($dataracikandetail);
            array_push($keteranganr, $a['namabarang'] . ' dosis racik : ' . $a['dosisracik'] . ' jumlah : ' . $qty);
        }
        $k = implode(", ", $keteranganr);
        $up = [
            'keterangan' => $k
        ];
        template_racikan_header::where('id', $header->id)->update($up);
        $data = [
            'kode' => 200,
            'message' => 'ok'
        ];
        echo json_encode($data);
        die;
    }
    public function caribarangfarmasi(Request $request)
    {
        $result = db::connection()->select('select * from mt_barang where nama_barang LIKE ?', ['%' . $request['term'] . '%']);
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_barang,
                    'kode' => $row->kode_barang,
                );
            echo json_encode($arr_result);
        }
    }
    public function caririwayatstok(Request $request)
    {
        $car = $request->kodebarang;
        if (strlen($car) < 3) {
            $stok = db::connection('mysql')->select('select a.*,b.nama_barang as nama from ti_kartu_stok a
            inner join mt_barang b on a.kode_barang = b.kode_barang
            where a.kode_unit = ? and date(a.tgl_stok) BETWEEN ? and ? ORDER BY no DESC LIMIT 1000', [$request->unit, $request->tanggalawal, $request->tanggalakhir]);
        } else {
            $stok = db::connection('mysql')->select('select a.*,b.nama_barang as nama from ti_kartu_stok a
            inner join mt_barang b on a.kode_barang = b.kode_barang
            where a.kode_unit = ? and a.kode_barang = ? and date(a.tgl_stok) BETWEEN ? and ? ORDER BY no DESC', [$request->unit, $request->kodebarang, $request->tanggalawal, $request->tanggalakhir]);
        }
        return view('depofarmasi.tabel_riwayat_kartu_stok', compact([
            'stok'
        ]));
    }
}
