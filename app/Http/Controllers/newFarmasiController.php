<?php

namespace App\Http\Controllers;

use App\Models\model_order_resep_detail;
use App\Models\model_order_resep_header;
use App\Models\model_template_resep_detail;
use App\Models\model_template_resep_header;
use App\Models\mt_antrian_farmasi_detail;
use App\Models\mt_antrian_farmasi_header;
use App\Models\mt_unit;
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
        return view('new_farmasi.tabel_riwayat_order_hari_ini', compact([
            'riwayat'
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
    public function riwayattemplateresep(Request $request)
    {
        $dokter = auth()->user()->kode_paramedis;
        $header = db::connection('mysql5')->select('select * from erm_template_resep_header where kode_paramedis = ?', [$dokter]);
        $detail = db::connection('mysql5')->select('select * from erm_template_resep_header a inner join erm_template_resep_detail b on a.id = b.id_header where a.kode_paramedis = ?', [$dokter]);
        return view('new_farmasi.tabel_template_resep_dokter', compact([
            'header',
            'detail'
        ]));
    }
    public function ambil_detail_template(Request $request)
    {
        $idresep = $request->id;
        $detail = db::connection('mysql5')->select('select * from erm_template_resep_header a inner join erm_template_resep_detail b on a.id = b.id_header where a.id = ?', [$idresep]);
        $str = "";
        foreach ($detail as $d) {
            $str .= "<div class='form-row text-xs'><div class='form-group col-md-2 text-xxs'><label for=''>Tipe Anestesi</label><select class='form-control' id='tipeanestesi' name='tipeanestesi'><option value='REG'>REGULER</option><option value='KRONIS'>KRONIS</option></select></div><div class='form-group col-md-1'><label for=''>Jumlah</label><input type='' class='form-control form-control-sm text-xs edit_field' id='jumlah' name='jumlah' value='$d->jumlah'></div><div class='form-group col-md-2'><label for=''>Nama Barang</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='namabarang' name='namabarang' value='$d->namabarang'><input   hidden readonly type='' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$d->kodebarang'><input hidden readonly type='' class='form-control form-control-sm' id='jenisresep' name='jenisresep' value='NON RACIK'></div><div class='form-group col-md-1'><label for=''>Dosis</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='dosis' name='dosis' value='$d->dosis'></div><div class='form-group col-md-1'><label for=''>Stok</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='stok' name='stok' value=''></div><div class='form-group col-md-1'><label for=''>Sediaan</label><input readonly type='' class='form-control form-control-sm text-xs edit_field' id='sediaan' name='sediaan' value='$d->sediaan'></div><div class='form-group col-md-3'><label for=''>Aturan Pakai</label><textarea type='' cols='3' rows='3' class='form-control form-control-sm text-xs edit_field' id='aturanpakai' name='aturanpakai' value=''>$d->aturanpakai</textarea></div><i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2=''></i></div>";
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
        ORDER BY a.`kode_kunjungan` DESC LIMIT 50', ([$dokter]));

        $detail = db::connection('mysql')->select('SELECT d.nama_barang,c.jumlah_layanan,c.aturan_pakai,c.row_id_header FROM ts_kunjungan a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        INNER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        INNER JOIN mt_barang d ON c.kode_barang = d.kode_barang
        WHERE b.dok_kirim = ? AND b.`kode_unit` IN (4001,4002,4008)', ([$dokter]));
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
            if(count($header_antrian) > 0){

                $id_header_antrian = $header_antrian[0]->idheader_antrian;
                $cek_order2 = db::connection('mysql5')->select('select * from erm_antrian_farmasi_detail a inner join order_farmasi_header b on a.id_header_order = b.id where a.idheader_antrian = ? and b.status_antrian != ?', [$id_header_antrian,8]);

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
        } else {
            $unit = '4008';
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
        $antrian = db::connection('mysql5')->select('select *,a.id as idd,b.id_header_order as idx from erm_antrian_farmasi a inner join erm_antrian_farmasi_detail b on a.id = b.idheader_antrian where a.kode_kunjungan = ? and a.status_antrian = ?', [$kodekunjungan,0]);
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
        $headerorder = db::connection('mysql5')->select('select * from order_farmasi_header where kode_kunjungan = ? and status_antrian != 8',[$kodekunjungan]);

        $antrian = db::connection('mysql5')->select('SELECT * FROM erm_antrian_farmasi a
        INNER JOIN erm_antrian_farmasi_detail b ON a.id = b.`idheader_antrian` WHERE a.`kode_kunjungan` = ?',[$kodekunjungan]);

        $dataorder = db::connection('mysql5')->select('SELECT *,d.id as iddetail FROM order_farmasi_header c INNER JOIN order_farmasi_detail d ON c.id = d.idheader WHERE c.kode_kunjungan = ? AND c.status_antrian != 8 and d.status_detail != 0',[$kodekunjungan]);



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
        $dataorder = db::connection('mysql5')->select('SELECT * FROM erm_antrian_farmasi a WHERE status_antrian != 8 and kode_unit = ? and date(tanggal_kirim) = ?', [$unit, $tanggal]);
        return view('depofarmasi.tabel_order_resep', compact([
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
        $dataaa = [];
        if(count($dataorder) > 0){
            foreach ($dataorder as $d) {
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
            }
        }else{
            $dataorder2 = [];
        }
        // dd($dataorder2);
        return view('depofarmasi.detail_order_resep', compact([
            'header',
            'dataorder2'
        ]));
    }
    public function simpandatapelayanan(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        if(count($data) == 0){
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
        foreach ($arrayobat as $ob) {
            $kodebarang = $ob['kodebarang'];
            $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kodebarang]);
            $hna = $mt_barang[0]->hna;
            $total_tarif = $hna * $ob['jumlah'];
            if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                $tagihan_pribadi = $total_tarif;
                $tagihan_penjamin = 0;
            } else {
                $tagihan_pribadi = 0;
                $tagihan_penjamin = $total_tarif;
            }
            if ($ob['tipeanestesi'] == 'REG') {
                $tipeanes = '80';
            } elseif ($ob['tipeanestesi'] == 'KRON') {
                $tipeanes = '81';
            }
            $datadetail = [
                'id_layanan_detail' => $this->createLayanandetail(),
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
            $master_jasa = db::select('select * from mt_jasa_farmasi');
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
        }
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
        foreach ($arrayobat as $ob) {
            $id_antrian = $ob['idantrianheader'];
            $id_header_order = $ob['idheaderorder'];
            $iddetailorder = $ob['iddetailorder'];
            $cek_antrian = db::connection('mysql5')->select('select * from erm_antrian_farmasi where id = ? and status_antrian = ?',[$id_antrian,0]);
            $cek_order_header = db::connection('mysql5')->select('select * from order_farmasi_header where id = ? and status_antrian = ?',[$id_header_order,1]);
            $cek_order_detail = db::connection('mysql5')->select('select * from order_farmasi_detail where id = ? and status_detail = ?',[$iddetailorder,1]);
            if(count($cek_antrian) > 0){
                DB::connection('mysql5')->table('erm_antrian_farmasi')->where('id', $id_antrian)->update(['status_antrian' => 1]);
            }
            if(count($cek_order_header) > 0){
                DB::connection('mysql5')->table('order_farmasi_header')->where('id', $id_header_order)->update(['status_antrian' => 2]);
            }
            if(count($cek_antrian) > 0){
                DB::connection('mysql5')->table('order_farmasi_detail')->where('id', $iddetailorder)->update(['status_detail' => 2]);
            }
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil simpan !'
        ];
        echo json_encode($data);
        die;
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
}
