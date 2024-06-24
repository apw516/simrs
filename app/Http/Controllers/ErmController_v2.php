<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\assesmenawaldokter;
use App\Models\order_racikan_detail;
use App\Models\order_racikan_header;
use App\Models\ts_antrian_farmasi;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_detail_order;
use App\Models\ts_layanan_header_dummy;
use App\Models\ts_layanan_header_order;
use App\Models\VclaimModel;
use App\Models\ts_kunjungan;

class ErmController_v2 extends Controller
{
    public function formpemeriksaan_dokter(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $nomorrm = $request->nomorrm;
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $last_assdok = DB::connection('mysql2')->select('SELECT * FROM assesmen_dokters
        WHERE id_pasien = ? AND kode_unit = ? AND id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ?)', [$nomorrm, auth()->user()->unit, $nomorrm, auth()->user()->unit]);
        // dd($last_assdok);
        $mt_pasien = DB::select('select *,fc_umur(no_rm) as usia from mt_pasien where no_rm = ?', [$nomorrm]);
        $assdok_now = DB::connection('mysql2')->select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = '3';
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        $layanan_rad = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        $layanan_lab = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        // dd($layanan_lab);
        return view('V2_erm.form_pemeriksaan_dokter', compact([
            'kodekunjungan', 'resume_perawat', 'last_assdok', 'assdok_now', 'mt_pasien', 'nomorrm', 'layanan', 'layanan_lab', 'layanan_rad'
        ]));
    }
    public function ambil_form_pemeriksaan_dokter_V2(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $nomorrm = $request->rm;
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $last_assdok = DB::connection('mysql2')->select('SELECT * FROM assesmen_dokters
        WHERE id_pasien = ? AND kode_unit = ? AND id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ?)', [$nomorrm, auth()->user()->unit, $nomorrm, auth()->user()->unit]);
        // dd($last_assdok);
        $mt_pasien = DB::select('select *,fc_umur(no_rm) as usia from mt_pasien where no_rm = ?', [$nomorrm]);
        $assdok_now = DB::connection('mysql2')->select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = '3';
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        $layanan_rad = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        $layanan_lab = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        if ($unit == '1028') {
            return view('V2_erm.form_pemeriksaan_dokter_rehabilitasi_medis', compact([
                'kodekunjungan', 'resume_perawat', 'last_assdok', 'assdok_now', 'mt_pasien', 'nomorrm', 'layanan', 'layanan_lab', 'layanan_rad'
            ]));
        }elseif($unit == '1026'){
            return view('V2_erm.form_pemeriksaan_dokter_anestesi', compact([
                'kodekunjungan', 'resume_perawat', 'last_assdok', 'assdok_now', 'mt_pasien', 'nomorrm', 'layanan', 'layanan_lab', 'layanan_rad'
            ]));
        }
        else {
            return view('V2_erm.form_pemeriksaan_dokter_poli', compact([
                'kodekunjungan', 'resume_perawat', 'last_assdok', 'assdok_now', 'mt_pasien', 'nomorrm', 'layanan', 'layanan_lab', 'layanan_rad'
            ]));
        }
    }
    public function ambil_form_order_tindakan_V2(Request $request)
    {
        $kelas = '3';
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        return view('V2_erm.form_order_tindakan', compact([
            'layanan'
        ]));
    }
    public function ambil_form_order_laboratorium_V2(Request $request)
    {
        $kelas = '3';
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan_lab = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        return view('V2_erm.form_order_lab', compact([
            'layanan_lab'
        ]));
    }
    public function ambil_form_order_radiologi_V2(Request $request)
    {
        $kelas = '3';
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan_rad = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        return view('V2_erm.form_order_rad', compact([
            'layanan_rad'
        ]));
    }
    public function ambil_form_order_farmasi_V2(Request $request)
    {
        return view('V2_erm.form_order_farmasi', compact([]));
    }
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function Ambil_Riwayat_kunjungan(Request $request)
    {
        $rm = $request->rm;
        $kunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where no_rm = ? order by kode_kunjungan desc ', [$rm]);
        $data_h = [];
        foreach ($kunjungan as $k) {
            $header = db::select("SELECT a.`kode_kunjungan`,b.`kode_barang`,c.`nama_barang`,b.`jumlah_layanan`,b.`aturan_pakai`,b.keterangan01 FROM ts_layanan_header a
            INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
            INNER JOIN mt_barang c ON b.`kode_barang` = c.`kode_barang`
            WHERE a.kode_kunjungan = '$k->kode_kunjungan'
            AND a.kode_unit IN ('4002','4003','4004','4005','4006','4007','4008','4009','4010','4011','4012','4013')
            AND a.status_layanan != 3 AND b.kode_barang != ''");
            array_push($data_h,$header);
        }
        $assesment = DB::connection('mysql')->select('SELECT * from erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? order by a.id desc', [$rm]);
        // $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = ?', [$rm]);
        return view('V2_erm.riwayat_kunjungan', compact([
            'kunjungan', 'assesment','data_h'
        ]));
    }
    public function Ambil_riwayat_order_farmasi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql2')->select('SELECT *,b.id as id_detail FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        WHERE kode_kunjungan = ? and status_layanan_detail = ? and kode_barang is not null', [$kodekunjungan, 'OPN']);
        return view('V2_erm.tabel_riwayat_order_farmasi', compact('riwayat_order'));
    }
    public function ambil_riwayat_order_lab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql2')->select("SELECT a.status_order,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3002']);
        // dd($riwayat_order);
        return view('V2_erm.tabel_riwayat_order_lab', compact('riwayat_order'));
    }
    public function ambil_riwayat_order_rad(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql2')->select("SELECT a.status_order,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3003']);
        // dd($riwayat_order);
        return view('V2_erm.tabel_riwayat_order_rad', compact('riwayat_order'));
    }
    public function ambil_riwayat_tindakan_today(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql2')->select('SELECT *,d.NAMA_TARIF,fc_nama_tarif(b.kode_tarif_detail) as nama_tarif,b.id as id_detail FROM ts_layanan_header a
        INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE kode_kunjungan = ? and status_layanan = ? and status_layanan_detail = ?', [$kodekunjungan, '1', 'OPN']);
        return view('V2_erm.tabel_riwayat_tindakan', compact('riwayat_tindakan'));
    }
    public function Ambil_riwayat_pemakaian_obat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $ts_kunjungan = DB::connection('mysql')->select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $ts_kunjungan[0]->no_rm;
        $ts_kunjungan_list = DB::connection('mysql')->select('select *,fc_nama_paramedis1(kode_paramedis) as nama_dokter ,fc_nama_unit1(a.kode_unit) as unit,b.id as id_header from ts_kunjungan a inner join ts_layanan_header b on a.kode_kunjungan = b.kode_kunjungan where a.no_rm = ? and status_kunjungan != ? order by a.kode_kunjungan desc', [$rm, 8]);

        $riwayat_pemakaian = DB::connection('mysql')->select("SELECT date(a.`tgl_masuk`) as tgl_masuk
        ,fc_nama_unit1(a.`kode_unit`) AS unit_asal
        ,a.`kode_kunjungan`
        ,fc_nama_barang(c.`kode_barang`) AS nama_barang
        ,c.jumlah_layanan
        ,c.aturan_pakai
        ,c.`kode_barang`
        ,fc_nama_paramedis1(a.kode_paramedis) AS nama_dokter
        ,a.`kode_paramedis`
        ,fc_nama_penjamin(a.`kode_penjamin`) AS nama_penjamin
        ,fc_nama_unit1(b.`kode_unit`) AS unit_tujuan
        ,b.id AS id_header
        FROM ts_kunjungan  a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        INNER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        WHERE a.no_rm = ? AND b.kode_unit IN ('4002','4008') AND c.`kode_barang` IS NOT NULL AND c.kode_barang != ''", [$rm]);
        return view('V2_erm.tabel_riwayat_pemakaian_obat', compact('riwayat_pemakaian', 'ts_kunjungan_list'));
    }
    public function v2_add_riwayat_pemakaian_obat(Request $request)
    {
        $detail = DB::select('select * from ts_layanan_detail where row_id_header = ?', [$request->id]);
        $rm = $request->rm;
        $kode_kunjungan = $request->kodekunjungan;
        // dd($kode_kunjungan);
        $riwayat_pemakaian = DB::connection('mysql')->select("SELECT date(a.`tgl_masuk`) as tgl_masuk
       ,fc_nama_unit1(a.`kode_unit`) AS unit_asal
       ,a.`kode_kunjungan`
       ,fc_nama_barang(c.`kode_barang`) AS nama_barang
       ,c.jumlah_layanan
       ,c.aturan_pakai
       ,c.`kode_barang`
       ,fc_nama_paramedis1(a.kode_paramedis) AS nama_dokter
       ,a.`kode_paramedis`
       ,fc_nama_penjamin(a.`kode_penjamin`) AS nama_penjamin
       ,fc_nama_unit1(b.`kode_unit`) AS unit_tujuan
       ,b.id AS id_header
       ,d.dosis
       ,d.satuan
       ,d.nama_generik
       FROM ts_kunjungan  a
       INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
       INNER JOIN ts_layanan_detail c ON b.id = c.row_id_header
       INNER JOIN mt_barang d on c.kode_barang = d.kode_barang
       WHERE a.no_rm = ? AND b.kode_unit IN ('4002','4008') AND c.`kode_barang` IS NOT NULL AND c.kode_barang != '' AND a.kode_kunjungan = ?", [$rm, $kode_kunjungan]);
        $str = "";
        foreach ($riwayat_pemakaian as $d) {
            $str .=   "<div class='row mt-2 text-xs'><div class='col-md-2'>
                        <div class='form-group'>
                            <label for='exampleFormControlInput1'>Nama Obat</label>
                            <input readonly type='text' class='form-control form-control-sm' id='nama_obat' name='namaobat' value='$d->nama_barang'placeholder='name@example.com'>
                            <input hidden readonly type='text' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$d->kode_barang'placeholder='name@example.com'>
                        </div>
                        </div>
                        <div hidden class='col-md-2'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Nama Generik</label>
                                <input readonly type='text' class='form-control form-control-sm' id='namagenerik' name='namagenerik' value='$d->nama_generik' placeholder='name@example.com'>
                            </div>
                        </div>
                        <div class='col-md-1'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Dosis</label>
                                <input readonly type='text' class='form-control form-control-sm' id='dosis' name='dosis' value='$d->dosis' placeholder='name@example.com'>
                            </div>
                        </div>
                        <div class='col-md-1'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Sediaan</label>
                                <input readonly type='text' class='form-control form-control-sm' id='sediaan' name='sediaan' value='$d->satuan' placeholder='name@example.com'>
                            </div>
                        </div>
                        <div class='col-md-1'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Kronis</label>
                                <select class='form-control form-control-sm' id='kronis' name='kronis'><option value='0'>TIDAK</option><option value='1'>YA</option></select>
                            </div>
                        </div>
                        <div class='col-md-1'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Jumlah</label>
                                <input type='text' class='form-control form-control-sm' id='jumlah' name='jumlah' value='$d->jumlah_layanan' placeholder='name@example.com'>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Aturan Pakai</label>
                                <textarea type='text' class='form-control form-control-sm' id='aturanpakai' name='aturanpakai' value='' placeholder='name@example.com'>$d->aturan_pakai</textarea>
                            </div>
                        </div>
                        <div class='col-md-2'>
                            <div class='form-group'>
                                <label for='exampleFormControlInput1'>Keterangan</label>
                                <textarea type='text' class='form-control form-control-sm' id='keterangan' name='keterangan' value='' placeholder='name@example.com'></textarea>
                            </div>
                        </div>
                        <i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2='' subtot='' jenis='' nama_barang='' kode_barang='' id_stok='' harga2='' satuan='' stok='' qty='' harga='' disc='' dosis='' sub='' sub2='' status='80' jenisracik='racikan'></i></div>";
        }
        // $str .= "</div>";
        return $str;
    }
    public function v2_add_riwayat_racik(Request $request)
    {
        $header = DB::connection('mysql2')->select('select * from ts_header_racikan_order where id =?', [$request->id]);
        // dd($header);
        $id_header = $request->id;
        $header = DB::connection('mysql2')->select('select * from ts_header_racikan_order where id =?', [$id_header]);
        $detail = DB::connection('mysql2')->select('select *,b.nama_barang from ts_detail_racikan_order a
        inner join mt_barang b on a.kode_barang = b.kode_barang
        where id_header =?', [$id_header]);
        $nama_racikan = $header[0]->nama_racikan;
        $kode_racik = $header[0]->id;
        $jumlah_racik = $header[0]->jumlah_racikan;
        $aturan_pakai = $header[0]->aturan_pakai;
        if ($header[0]->kemasan == 1) {
            $sediaan = 'KAPSUL';
        } elseif ($header[0]->kemasan == 2) {
            $sediaan = 'KERTAS PERKAMEN';
        } elseif ($header[0]->kemasan == 3) {
            $sediaan = 'POT SALEP';
        }

        $list_ket = [];
        foreach ($detail as $arr) {
            $qty = $arr->dosis_racik * $jumlah_racik / $arr->dosis_awal;
            $list_ket[] = $arr->nama_barang . ' Dosis Awal : ' . $arr->dosis_awal . ' Dosis Racik : ' . $arr->dosis_racik . ' Kebutuhan obat :' . $qty;
        }
        $ket = implode(' ', $list_ket);

        return "<div class='row mt-2 text-xs'>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Nama Obat</label>
                <input readonly type='text' class='form-control form-control-sm' id='nama_obat' name='namaobat' value='$nama_racikan'placeholder='name@example.com'>
                <input hidden readonly type='text' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$kode_racik' placeholder='name@example.com'>
            </div>
        </div>
        <div hidden class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Nama Generik</label>
                <input readonly type='text' class='form-control form-control-sm' id='namagenerik' name='namagenerik' value='RACIKAN' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Dosis</label>
                <input readonly type='text' class='form-control form-control-sm' id='dosis' name='dosis' value='-' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Sediaan</label>
                <input readonly type='text' class='form-control form-control-sm' id='sediaan' name='sediaan' value='$sediaan' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Kronis</label>
                <select class='form-control form-control-sm' id='kronis' name='kronis'><option value='0'>TIDAK</option><option value='1'>YA</option></select>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Jumlah</label>
                <input readonly type='text' class='form-control form-control-sm' id='jumlah' name='jumlah' value='$jumlah_racik' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Aturan Pakai</label>
                <textarea readonly type='text' class='form-control form-control-sm' id='aturanpakai' name='aturanpakai' value='' placeholder='name@example.com'>$aturan_pakai</textarea>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Keterangan</label>
                <textarea readonly type='text' class='form-control form-control-sm' id='keterangan' name='keterangan' value='' placeholder='name@example.com'>$ket</textarea>
            </div>
        </div>
        <i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2='' subtot='' jenis='' nama_barang='' kode_barang='' id_stok='' harga2='' satuan='' stok='' qty='' harga='' disc='' dosis='' sub='' sub2='' status='80' jenisracik='racikan'></i>
    </div>";
    }
    public function ambil_riwayat_racikan()
    {
        $header = DB::connection('mysql2')->select('select * from ts_header_racikan_order where pic = ? order by id desc', [auth()->user()->id]);
        $detail = db::connection('mysql2')->select('SELECT a.id AS id_header
       ,tipe_racikan
       ,jumlah_racikan
       ,kemasan
       ,aturan_pakai
       ,kode_kunjungan
       ,fc_nama_barang(kode_barang) AS nama_barang,kode_barang,qty,dosis_awal,dosis_racik
       FROM ts_header_racikan_order a
       INNER JOIN ts_detail_racikan_order b ON a.`id` = b.`id_header` where a.pic = ?', [auth()->user()->id]);
        return view('V2_erm.tabel_riwayat_racikan', compact([
            'header', 'detail'
        ]));
    }
    public function Cari_obat_reguler(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $key = $request->nama;
        $jlh = strlen($key);
        if ($jlh >= 2) {
            if ($kunjungan[0]->kode_penjamin == 'PO1') {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4002')");
            } else {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4008')");
            }
            return view('V2_erm.tabel_obat_reguler', compact([
                'obat'
            ]));
        }
    }
    public function Cari_obat_komponen(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $key = $request->nama;
        $jlh = strlen($key);
        if ($jlh >= 2) {
            if ($kunjungan[0]->kode_penjamin == 'PO1') {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4002')");
            } else {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4008')");
            }
            return view('V2_erm.tabel_obat_komponen', compact([
                'obat'
            ]));
        }
    }
    public function Simpan_pemeriksaan_dokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $data_billing_tindakan = json_decode($_POST['data_billing_tindakan'], true);
        $data_order_farmasi = json_decode($_POST['data_order_farmasi'], true);
        $data_order_rad = json_decode($_POST['data_order_rad'], true);
        $data_order_lab = json_decode($_POST['data_order_lab'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data_order_farmasi as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_order_farmasi[$index] = $value;
            if ($index == 'keterangan') {
                $arrayindex_far[] = $dataSet_order_farmasi;
            }
        }
        foreach ($data_billing_tindakan as $a) {
            $index =  $a['name'];
            $value =  $a['value'];
            $dataSet_tindakan[$index] = $value;
            if ($index == 'jumlah') {
                $arrayindex_tind[] = $dataSet_tindakan;
            }
        }
        foreach ($data_order_lab as $a) {
            $index =  $a['name'];
            $value =  $a['value'];
            $dataSet_lab[$index] = $value;
            if ($index == 'jumlah') {
                $arrayindex_lab[] = $dataSet_lab;
            }
        }
        foreach ($data_order_rad as $a) {
            $index =  $a['name'];
            $value =  $a['value'];
            $dataSet_rad[$index] = $value;
            if ($index == 'jumlah') {
                $arrayindex_rad[] = $dataSet_rad;
            }
        }
        $ts_kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
        if (count($resume_perawat) > 0) {
            $id_asskep = $resume_perawat[0]->id;
        } else {
            $id_asskep = 0;
        }
        $pulang = (empty($dataSet['pulangsembuh'])) ? 0 : $dataSet['pulangsembuh'];
        $kontrol = (empty($dataSet['kontrol'])) ? 0 : $dataSet['kontrol'];
        $konsul = (empty($dataSet['konsulpoli'])) ? 0 : $dataSet['konsulpoli'];
        $rawatinap = (empty($dataSet['rawatinap'])) ? 0 : $dataSet['rawatinap'];
        $rujukkeluar = (empty($dataSet['rujukekluar'])) ? 0 : $dataSet['rujukekluar'];
        if (auth()->user()->unit == '1028') {
            //fisioterapi
            $data = [
                'counter' => $ts_kunjungan[0]->counter,
                'id_kunjungan' => $dataSet['kodekunjungan'],
                'id_pasien' => $ts_kunjungan[0]->no_rm,
                'id_asskep' => $id_asskep,
                'pic' => auth()->user()->id,
                'kode_unit' => auth()->user()->unit,
                'nama_dokter' => auth()->user()->nama,
                'tgl_entry' => $this->get_now(),
                'tgl_kunjungan' => $ts_kunjungan[0]->tgl_masuk,
                'tgl_pemeriksaan' => $this->get_now(),
                'tekanan_darah' => $dataSet['tekanandarah'],
                'frekuensi_nadi' => $dataSet['frekuensinadi'],
                'frekuensi_nafas' => $dataSet['frekuensinafas'],
                'suhu_tubuh' => $dataSet['suhu'],
                'umur' => $dataSet['umur'],
                'beratbadan' => $dataSet['beratbadan'],
                'anamnesa' => $dataSet['anamnesa'],
                'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
                'diagnosakerja' => $dataSet['diagnosaprimer'],
                'diagnosabanding' => $dataSet['diagnosabanding'],
                'rencanakerja' => $dataSet['pemeriksaanpenunjang'],
                'anjuran' => $dataSet['anjuran'],
                'evaluasi' => $dataSet['evaluasi'],
                'riwayatlain' => $dataSet['suspekpenyakit'],
                'ket_riwayatlain' => $dataSet['keterangansuspek'],
                'tindak_lanjut' => $pulang . '|' . $kontrol . '|' . $konsul . '|' . $rawatinap . '|' . $rujukkeluar . '|' . trim($dataSet['keterangantindaklanjut']),
                'versi' => '2',
                'status' => '1',
                'signature' => 'SUDAH VALIDASI'
            ];
        } elseif(auth()->user()->unit == '1026'){
            if (empty($dataSet['sumberdata'])) {
                $data = [
                    'kode' => 500,
                    'message' => 'Sumber data pemeriksaan belum dipilih !'
                ];
                echo json_encode($data);
                die;
            }
            if (empty($dataSet['assesmen'])) {
                $data = [
                    'kode' => 500,
                    'message' => 'assesmen pemeriksaan belum dipilih !'
                ];
                echo json_encode($data);
                die;
            }
            $data = [
                'counter' => $ts_kunjungan[0]->counter,
                'id_kunjungan' => $dataSet['kodekunjungan'],
                'id_pasien' => $ts_kunjungan[0]->no_rm,
                'id_asskep' => $resume_perawat[0]->id,
                'pic' => auth()->user()->id,
                'nama_dokter' => auth()->user()->nama,
                'tgl_entry' => $this->get_now(),
                'tgl_kunjungan' => $ts_kunjungan[0]->tgl_masuk,
                'tgl_pemeriksaan' => $this->get_now(),
                'sumber_data' => trim($dataSet['sumberdata']),
                'tekanan_darah' => trim($dataSet['tekanandarah']),
                'frekuensi_nadi' => trim($dataSet['frekuensinadi']),
                'frekuensi_nafas' => trim($dataSet['frekuensinafas']),
                'suhu_tubuh' => trim($dataSet['suhu']),
                'beratbadan' => trim($dataSet['bb']),
                'umur' => trim($dataSet['usia1']),
                'kode_unit' => auth()->user()->unit,
                'keluhan_pasien' => trim($dataSet['keluhanutama']),
                'ket_riwayatlain' => trim($dataSet['riwayatpenyakitdahulu']),
                'diagnosakerja' => trim($dataSet['diagnosakerja']),
                'diagnosabanding' => trim($dataSet['diagnosabanding']),
                'alergi' => trim($dataSet['alergi']),
                'medikasi' => trim($dataSet['medikasi']),
                'postillnes' => trim($dataSet['post']),
                'lastmeal' => trim($dataSet['lastmeal']),
                'event' => trim($dataSet['event']),
                'cor' => trim($dataSet['cor']),
                'pulmo' => trim($dataSet['pulmo']),
                'gigi' => trim($dataSet['gigi']),
                'ekstremitas' => trim($dataSet['ekstremitas']),
                'LEMON' => trim($dataSet['L']) . ' | ' . trim($dataSet['E']) . ' | ' . trim($dataSet['M']) . ' | ' . trim($dataSet['O']) . ' | ' . trim($dataSet['N']),
                // 'rencanakerja' => trim($dataSet['rencanaterapi']),
                'tindak_lanjut' => $dataSet['assesmen'],
                // 'tindak_lanjut' => $pulang . '|' . $kontrol . '|' . $konsul . '|' . $rawatinap . '|' . $rujukkeluar . '|' . trim(trim($dataSet['keterangantindaklanjut'])),
                'keterangan_tindak_lanjut' => trim($dataSet['saran']),
                'keterangan_tindak_lanjut_2' => trim($dataSet['jawabankonsul']),
                'versi' => 2,
                'status' => '1',
                'signature' => 'SUDAH VALIDASI'
            ];
        }else {
            if (empty($dataSet['sumberdata'])) {
                $data = [
                    'kode' => 500,
                    'message' => 'Sumber data pemeriksaan belum dipilih !'
                ];
                echo json_encode($data);
                die;
            }
            if (empty($dataSet['riwayatalergi'])) {
                $data = [
                    'kode' => 500,
                    'message' => 'Riwayat alergi belum dipilih !'
                ];
                echo json_encode($data);
                die;
            }

            // pulangsembuh
            // kontrol
            // konsulpoli
            // rawatinap
            // rujukekluar
            // keterangantindaklanjut
            $data = [
                'counter' => $ts_kunjungan[0]->counter,
                'id_kunjungan' => $dataSet['kodekunjungan'],
                'id_pasien' => $ts_kunjungan[0]->no_rm,
                'id_asskep' => $resume_perawat[0]->id,
                'pic' => auth()->user()->id,
                'nama_dokter' => auth()->user()->nama,
                'tgl_entry' => $this->get_now(),
                'tgl_kunjungan' => $ts_kunjungan[0]->tgl_masuk,
                'tgl_pemeriksaan' => $this->get_now(),
                'sumber_data' => trim($dataSet['sumberdata']),
                'tekanan_darah' => trim($dataSet['tekanandarah']),
                'frekuensi_nadi' => trim($dataSet['frekuensinadi']),
                'frekuensi_nafas' => trim($dataSet['frekuensinafas']),
                'suhu_tubuh' => trim($dataSet['suhu']),
                'beratbadan' => trim($dataSet['bb']),
                'umur' => trim($dataSet['usia1']),
                'kode_unit' => auth()->user()->unit,
                'keluhan_pasien' => trim($dataSet['keluhanutama']),
                'ket_riwayatlain' => trim($dataSet['riwayatpenyakitdahulu']),
                'riwayat_alergi' => trim($dataSet['riwayatalergi']),
                'keterangan_alergi' => trim($dataSet['keteranganriwayatalergi']),
                'pemeriksaan_fisik' => trim($dataSet['pemeriksaanfisik']),
                'diagnosakerja' => trim($dataSet['diagnosaprimer']),
                'diagnosabanding' => trim($dataSet['diagnosasekunder']),
                'rencanakerja' => trim($dataSet['rencanaterapi']),
                'tindak_lanjut' => $pulang . '|' . $kontrol . '|' . $konsul . '|' . $rawatinap . '|' . $rujukkeluar . '|' . trim(trim($dataSet['keterangantindaklanjut'])),
                'versi' => 2,
                'status' => '1',
                'signature' => 'SUDAH VALIDASI'
            ];
        }
        // dd($dataSet);
        $cek = DB::connection('mysql2')->select('select * from assesmen_dokters where id_kunjungan = ?', [$dataSet['kodekunjungan']]);
        if (count($cek) > 0) {
            $asdok = assesmenawaldokter::whereRaw('id_kunjungan = ?', array($dataSet['kodekunjungan']))->update($data);
            $id_assdok = $cek[0]->id;
        } else {
            $asdok = assesmenawaldokter::create($data);
            $id_assdok = $asdok->id;
        }
        //order farmasi
        // dd($arrayindex_far);

        if ($ts_kunjungan[0]->kode_penjamin == 'PO1') {
            $unit = '4002';
            $kode_transaksi = '1';
        } else {
            $unit = '4008';
            $kode_transaksi = '2';
        }

        $penjamin = $ts_kunjungan[0]->kode_penjamin;
        $nomorrm = $ts_kunjungan[0]->no_rm;
        $now = $this->get_now();
        $kodekunjungan = $dataSet['kodekunjungan'];
        if (count($data_billing_tindakan) > 0) {
            $dt = Carbon::now()->timezone('Asia/Jakarta');
            $date = $dt->toDateString();
            $time = $dt->toTimeString();
            $now = $date . ' ' . $time;
            $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet['kodekunjungan']]));
            $kodekunjungan = $dataSet['kodekunjungan'];
            $penjamin = $ts_kunjungan[0]->kode_penjamin;
            $kode_unit = $ts_kunjungan[0]->kode_unit;
            $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kode_unit]);
            $prefix_kunjungan = $unit[0]->prefix_unit;
            try {
                //dummy
                $kode_unit = $ts_kunjungan[0]->kode_unit;
                $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
                $kode_layanan_header = $r[0]->no_trx_layanan;
                if ($kode_layanan_header == "") {
                    $year = date('y');
                    $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
                    //dummy
                    DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kode_unit]);
                }
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $ts_kunjungan[0]->kode_kunjungan,
                    'kode_unit' => $kode_unit,
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                //data yg diinsert ke ts_layanan_header
                //simpan ke layanan header
                //dummy
                $ts_layanan_header = ts_layanan_header_dummy::create($data_layanan_header);
                $grand_total_tarif = 0;
                foreach ($arrayindex_tind as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['jumlah'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['jumlah'];
                        $tagihanpribadi = 0;
                    }
                    $total_tarif = $d['tarif'] * $d['jumlah'];
                    $id_detail = $this->createLayanandetail();
                    $save_detail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_tarif_detail' => $d['kodetindakan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['jumlah'],
                        'diskon_layanan' => '0',
                        'total_layanan' => $total_tarif,
                        'grantotal_layanan' => $total_tarif,
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_penjamin' => $tagihanpenjamin,
                        'tagihan_pribadi' => $tagihanpribadi,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header->id
                    ];
                    $ts_layanan_detail = ts_layanan_detail_dummy::create($save_detail);
                    $grand_total_tarif = $grand_total_tarif + $total_tarif;
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_dummy::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_dummy::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
                $data = [
                    'status' => 0,
                    'signature' => ''

                ];
                assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            } catch (\Exception $e) {
                $back = [
                    'kode' => 500,
                    'message' => $e->getMessage()
                ];
                echo json_encode($back);
                die;
            }

            //endtindakan
        }
        try {
            if (count($data_order_farmasi) > 0) {
                if ($ts_kunjungan[0]->kode_penjamin == 'P01') {
                    $unit_kirim = '4002';
                    $kode_transaksi = '1';
                } else {
                    $unit_kirim = '4008';
                    $kode_transaksi = '2';
                }
                $kode_layanan_header = $this->createOrderHeader('F');
                $data_order_header = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' => $this->get_now(),
                    'kode_kunjungan' => $dataSet['kodekunjungan'],
                    'kode_unit' => $unit_kirim,
                    'kode_tipe_transaksi' => $kode_transaksi,
                    'pic' => auth()->user()->id,
                    'status_layanan' => '1',
                    'keterangan' => '',
                    'kode_penjaminx' => $ts_kunjungan[0]->kode_penjamin,
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet['diagnosaprimer'],
                    'tgl_periksa' => $ts_kunjungan[0]->tgl_masuk,
                    'id_assdok' => $id_assdok,
                    'status_order' => '99',
                ];
                $header_f = ts_layanan_header_order::create($data_order_header);
                $tgl = $this->get_now();
                foreach ($arrayindex_far as $a) {
                    try {
                        if ($a['namagenerik'] == 'RACIKAN') {
                            $TIPE = 'racikan';
                        } else {
                            $TIPE = 'reguler';
                        }
                        $id_detail = $this->createLayanandetailOrder();
                        $data_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_tarif_detail' => $a['namaobat'],
                            'kode_layanan_header' => $kode_layanan_header,
                            'jumlah_layanan' => $a['jumlah'],
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'tgl_layanan_detail1' => $tgl,
                            'kode_barang' => $a['kodebarang'],
                            'aturan_pakai' => $a['aturanpakai'],
                            'keterangan' => $a['keterangan'],
                            'kategori_resep' => $TIPE,
                            'status_layanan_detail' => 'OPN',
                            'satuan_barang' => $a['sediaan'],
                            'tipe_anestesi' => $a['kronis'],
                            'row_id_header' => $header_f->id,
                            'keterangan' => $a['keterangan']
                        ];
                        $detail_f = ts_layanan_detail_order::create($data_detail);
                    } catch (\Exception $e) {
                        $back = [
                            'kode' => 500,
                            'message' => $e->getMessage()
                        ];
                        echo json_encode($back);
                        die;
                    }
                }
            }
            if (count($data_order_lab) > 0) {
                // arrayindex_lab
                $kode_layanan_header_order = $this->createOrderHeader('P');
                $data_layanan_header_order = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header_order,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $kodekunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => '3002',
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet['diagnosaprimer'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '99'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                $now = $this->get_now();
                foreach ($arrayindex_lab as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['jumlah'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['jumlah'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodetindakan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['jumlah'],
                        'total_layanan' => $d['tarif'] * $d['jumlah'],
                        'grantotal_layanan' => $d['tarif'] * $d['jumlah'],
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_penjamin' => $tagihanpenjamin,
                        'tagihan_pribadi' => $tagihanpribadi,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header_order->id
                    ];
                    $ts_layanan_detail_order = ts_layanan_detail_order::create($save_detail_order);
                    $grand_total_tarif = $grand_total_tarif + $d['tarif'];
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
            }
            if (count($data_order_rad) > 0) {
                // arrayindex_rad
                $kode_layanan_header_order = $this->createOrderHeader('P');
                $data_layanan_header_order = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header_order,
                    'tgl_entry' =>  $now,
                    'kode_kunjungan' => $kodekunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => '3003',
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet['diagnosaprimer'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '99'
                ];
                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                foreach ($arrayindex_rad as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['jumlah'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['jumlah'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodetindakan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['jumlah'],
                        'total_layanan' => $d['tarif'] * $d['jumlah'],
                        'grantotal_layanan' => $d['tarif'] * $d['jumlah'],
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_penjamin' => $tagihanpenjamin,
                        'tagihan_pribadi' => $tagihanpribadi,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header_order->id
                    ];
                    $ts_layanan_detail_order = ts_layanan_detail_order::create($save_detail_order);
                    $grand_total_tarif = $grand_total_tarif + $d['tarif'];
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
            }
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function Add_draft_komponen(Request $request)
    {

        $dataheader = json_decode($_POST['dataheader'], true);
        $datalist = json_decode($_POST['datalist'], true);
        $jumlahracikan = $request->jumlahracikan;
        foreach ($dataheader as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }

        $ts_kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        if ($ts_kunjungan[0]->kode_penjamin == 'PO1') {
            $unit_tujuan = '4002';
        } else {
            $unit_tujuan = '4008';
        }
        $jumlah_racikan = $dataSet['jumlahracikan'];
        $data_header = [
            'nama_racikan' => $dataSet['namaracikan'],
            'tipe_racikan' => $dataSet['tiperacikan'],
            'jumlah_racikan' => $dataSet['jumlahracikan'],
            'kemasan' => $dataSet['kemasanracikan'],
            'aturan_pakai' => $dataSet['aturanpakairacikan'],
            'pic' => auth()->user()->id,
            'tgl_entry' => $this->get_now(),
            'kode_unit' => auth()->user()->unit,
            'kode_kunjungan' => $request->kodekunjungan,
            'unit_tujuan' => $unit_tujuan,
        ];
        $header = order_racikan_header::create($data_header);
        foreach ($datalist as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataList[$index] = $value;
            if ($index == 'dosisracik') {
                $array_list[] = $dataList;
            }
        }
        // dd($array_list);
        $list_ket = [];
        foreach ($array_list as $arr) {
            $qty = $arr['dosisracik'] * $dataSet['jumlahracikan'] / $arr['dosis'];
            $list_ket[] = $arr['namaobat'] . ' Dosis Awal : ' . $arr['dosis'] . ' Dosis Racik : ' . $arr['dosisracik'] . ' Kebutuhan obat :' . $qty;
            $data_detail = [
                'id_header' => $header->id,
                'kode_barang' => $arr['kodebarang'],
                'qty' => $qty,
                'dosis_awal' => $arr['dosis'],
                'dosis_racik' =>  $arr['dosisracik'],
                'tgl_entry' => $this->get_now(),
            ];
            order_racikan_detail::create($data_detail);
        }
        $ket = implode(' ', $list_ket);
        // dd($list_ket);
        if ($dataSet['kemasanracikan'] == 1) {
            $sediaan = 'KAPSUL';
        } elseif ($dataSet['kemasanracikan'] == 2) {
            $sediaan = 'KERTAS PERKAMEN';
        } elseif ($dataSet['kemasanracikan'] == 3) {
            $sediaan = 'POT SALEP';
        }
        // dd($dataSet);
        return "<div class='row mt-2 text-xs'>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Nama Obat</label>
                <input readonly type='text' class='form-control form-control-sm' id='nama_obat' name='namaobat' value='$dataSet[namaracikan]'placeholder='name@example.com'>
                <input hidden readonly type='text' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$header->id'placeholder='name@example.com'>
            </div>
        </div>
        <div hidden class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Nama Generik</label>
                <input readonly type='text' class='form-control form-control-sm' id='namagenerik' name='namagenerik' value='RACIKAN' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Dosis</label>
                <input readonly type='text' class='form-control form-control-sm' id='dosis' name='dosis' value='-' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Sediaan</label>
                <input readonly type='text' class='form-control form-control-sm' id='sediaan' name='sediaan' value='$sediaan' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Kronis</label>
                <select class='form-control form-control-sm' id='kronis' name='kronis'><option value='0'>TIDAK</option><option value='1'>YA</option></select>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Jumlah</label>
                <input readonly type='text' class='form-control form-control-sm' id='jumlah' name='jumlah' value='$dataSet[jumlahracikan]' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Aturan Pakai</label>
                <textarea readonly type='text' class='form-control form-control-sm' id='aturanpakai' name='aturanpakai' value='' placeholder='name@example.com'>$dataSet[aturanpakairacikan]</textarea>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Keterangan</label>
                <textarea readonly type='text' class='form-control form-control-sm' id='keterangan' name='keterangan' value='' placeholder='name@example.com'>$ket</textarea>
            </div>
        </div>
        <i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2='' subtot='' jenis='' nama_barang='' kode_barang='' id_stok='' harga2='' satuan='' stok='' qty='' harga='' disc='' dosis='' sub='' sub2='' status='80' jenisracik='racikan'></i>
    </div>";
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
    public function createOrderHeader($kode)
    {
        //dummy
        $q = DB::connection('mysql2')->select('SELECT id,kode_layanan_header,RIGHT(kode_layanan_header,6) AS kd_max  FROM ts_layanan_header_order
        WHERE DATE(tgl_entry) = CURDATE()
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
        return 'OR' . $kode . date('ymd') . $kd;
    }
    public function createLayanandetailOrder()
    {
        //dummy
        $q = DB::connection('mysql4')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail_order
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
    public function Batal_detail_order_farmasi(Request $request)
    {
        $id = $request->id;
        $ts_layanan_detail = db::connection('mysql2')->select('select * from ts_layanan_detail_order where id = ?', [$id]);
        $row_id_header = $ts_layanan_detail[0]->row_id_header;
        $cek_header = db::connection('mysql2')->select('select * from ts_layanan_header_order where status_order = ? and id = ?', ['2', $row_id_header]);
        if (count($cek_header) > 0) {
            $data = [
                'kode' => 500,
                'message' => 'Obat sudah dilayanai farmasi !'
            ];
            echo json_encode($data);
            die;
        } else {
            $asdok = ts_layanan_detail_order::whereRaw('id = ?', array($id))->update(['status_layanan_detail' => 'CCL']);
            $DETAIL = db::connection('mysql2')->select('select * from ts_layanan_detail_order where row_id_header = ? and status_layanan_detail = ?', [$row_id_header, 'OPN']);
            if (count($DETAIL) == 0) {
                ts_layanan_header_order::whereRaw('id = ?', array($row_id_header))->update(['status_layanan' => '3']);
                $data = [
                    'kode' => 200,
                    'message' => 'Order obat  berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            } else {
                $data = [
                    'kode' => 200,
                    'message' => 'Order obat ' . $ts_layanan_detail[0]->kode_tarif_detail . ' berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            }
        }
    }
    public function batal_detail_order_lab(Request $request)
    {
        $id = $request->id;
        $ts_layanan_detail = db::connection('mysql2')->select('select * from ts_layanan_detail_order where id = ?', [$id]);
        $row_id_header = $ts_layanan_detail[0]->row_id_header;
        $header = db::connection('mysql2')->select('select * from ts_layanan_header_order where id = ?', [$row_id_header]);
        if ($header[0]->status_order == 1) {
            $data = [
                'kode' => 500,
                'message' => 'Gagal, order sedang diproses !'
            ];
            echo json_encode($data);
            die;
        } else {
            $asdok = ts_layanan_detail_order::whereRaw('id = ?', array($id))->update(['status_layanan_detail' => 'CCL']);
            $DETAIL = db::connection('mysql2')->select('select * from ts_layanan_detail_order where row_id_header = ? and status_layanan_detail = ?', [$row_id_header, 'OPN']);
            if (count($DETAIL) == 0) {
                ts_layanan_header_order::whereRaw('id = ?', array($row_id_header))->update(['status_layanan' => '3']);
                $data = [
                    'kode' => 200,
                    'message' => 'Order Layanan  berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            } else {
                $data = [
                    'kode' => 200,
                    'message' => 'Order Layanan ' . $ts_layanan_detail[0]->kode_tarif_detail . ' berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            }
        }
    }
    public function batal_detail_order_rad(Request $request)
    {
        $id = $request->id;
        $ts_layanan_detail = db::connection('mysql2')->select('select * from ts_layanan_detail_order where id = ?', [$id]);
        $row_id_header = $ts_layanan_detail[0]->row_id_header;
        $header = db::connection('mysql2')->select('select * from ts_layanan_header_order where id = ?', [$row_id_header]);
        if ($header[0]->status_order == 1) {
            $data = [
                'kode' => 500,
                'message' => 'Gagal, order sedang diproses !'
            ];
            echo json_encode($data);
            die;
        } else {

            $asdok = ts_layanan_detail_order::whereRaw('id = ?', array($id))->update(['status_layanan_detail' => 'CCL']);
            $DETAIL = db::connection('mysql2')->select('select * from ts_layanan_detail_order where row_id_header = ? and status_layanan_detail = ?', [$row_id_header, 'OPN']);
            if (count($DETAIL) == 0) {
                ts_layanan_header_order::whereRaw('id = ?', array($row_id_header))->update(['status_layanan' => '3']);
                $data = [
                    'kode' => 200,
                    'message' => 'Order Layanan  berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            } else {
                $data = [
                    'kode' => 200,
                    'message' => 'Order Layanan ' . $ts_layanan_detail[0]->kode_tarif_detail . ' berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            }
        }
    }
    public function hasilassesmentmedis(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;

        $assdok = DB::connection('mysql2')->select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        $data_kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $of = DB::connection('mysql2')->select("SELECT
        a.id AS id_header
        ,b.`id` AS id_detail
        ,a.`kode_kunjungan`
        ,b.kode_tarif_detail
        ,a.`kode_unit`
        ,fc_nama_unit1(kode_unit) as unit_tujuan
        ,a.`status_layanan`
        ,b.`status_layanan_detail`
        ,b.`jumlah_layanan`
        ,b.`aturan_pakai`
        ,b.`kode_barang`
        ,fc_nama_barang(b.`kode_barang`) AS nama_barang
        ,b.`kategori_resep`
        ,b.keterangan
        ,a.`status_order`
        ,a.`tgl_entry`
        FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b on a.id = b.row_id_header
        WHERE a.`kode_kunjungan` = '$kodekunjungan' AND b.status_layanan_detail = 'OPN'
        AND a.status_layanan != '3'
        AND a.`kode_unit` IN ('4008','4002')");

        $oL = db::connection('mysql2')->select("SELECT *,fc_nama_unit1(a.kode_unit) as nama_unit,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3002']);

        $oR = db::connection('mysql2')->select("SELECT *,fc_nama_unit1(a.kode_unit) as nama_unit,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3003']);
        $antrian = DB::connection('mysql2')->select('select * from ts_antrian_farmasi where kode_kunjungan = ?', [$kodekunjungan]);

        $mt_pasien = DB::select('select * from mt_pasien where no_rm = ?', [$data_kunjungan[0]->no_rm]);
        $unit = DB::select('select * from mt_unit where group_unit = ?', ['J']);
        return view('V2_erm.hasilpemeriksaandokter', compact('assdok', 'of', 'kodekunjungan', 'oL', 'oR', 'antrian', 'data_kunjungan', 'mt_pasien', 'unit'));
    }
    public function kirimorderfarmasi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            $a = ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '4002', '99'))->update(['status_order' => '98']);
        } else {
            $a = ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '4008', '99'))->update(['status_order' => '98']);
        }
        //create antrian
        $cek_antrian = db::connection('mysql2')->select('select * from ts_antrian_farmasi where kode_kunjungan = ?', [$kodekunjungan]);
        if (count($cek_antrian) > 0) {
            $status_antrian = $cek_antrian[0]->status_antrian;
            $orderan = db::connection('mysql2')->select("select * from ts_layanan_header_order where kode_kunjungan = '$kodekunjungan' and kode_unit in ('4002','4008') and status_order = '98'");
            if (count($orderan) > 0) {
                if ($status_antrian == 1) {
                    // ts_antrian_farmasi::create($data_antrian);
                    ts_antrian_farmasi::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update(['status_antrian' => '0']);
                }
            }
            $data = [
                'kode' => 200,
                'message' => 'Oder berhasil dikirim!',
            ];
            echo json_encode($data);
            die;
        } else {
            $orderan = db::connection('mysql2')->select("select * from ts_layanan_header_order where kode_kunjungan = '$kodekunjungan' and kode_unit in ('4002','4008') and status_order = '98'");
            if (count($orderan) > 0) {
                $cek_racikan = DB::connection('mysql2')->select("SELECT DISTINCT b.kode_kunjungan
                ,b.`no_rm`
                ,simrs_waled.fc_nama_px(b.no_rm) AS  nama_pasien
                ,fc_nama_unit1(unit_pengirim) AS nama_unit
                ,fc_nama_paramedis1(dok_kirim) AS nama_dokter
                ,fc_hitung_racikan_(b.kode_kunjungan) AS jumlah_racikan
                ,a.status_order
                FROM ts_layanan_header_order a
                INNER JOIN simrs_waled.ts_kunjungan b ON a.kode_kunjungan = b.`kode_kunjungan`
                WHERE a.kode_kunjungan = '$kodekunjungan' and a.status_order = '98'");
                $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [$orderan[0]->kode_unit]);
                $pref = $mt_unit[0]->prefix_unit;
                $kodeunit = $mt_unit[0]->kode_unit;
                if ($cek_racikan[0]->jumlah_racikan == 0) {
                    $jenis_antrian = 'REGULER';
                    $nomor_antrian = $this->get_nomor_antrian_reguler($pref, $kodeunit);
                } else {
                    $jenis_antrian = 'RACIKAN';
                    $nomor_antrian = $this->get_nomor_antrian_racikan($pref, $kodeunit);
                }
                $data_antrian = [
                    'rm' => $kunjungan[0]->no_rm,
                    'nomor_antrian' => $nomor_antrian,
                    'jenis_antrian' => $jenis_antrian,
                    'kode_unit' => $orderan[0]->kode_unit,
                    'unit_pengirim' => $kunjungan[0]->kode_unit,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_antrian' => $this->get_now(),
                ];
                ts_antrian_farmasi::create($data_antrian);
                foreach ($orderan as $od) {
                    $update = ts_layanan_header_order::whereRaw('kode_kunjungan = ? and kode_unit = ? and status_layanan = ?', array($kodekunjungan, $kodeunit, 1))->update(['status_order' => '98']);
                }
                $data = [
                    'kode' => 200,
                    'message' => 'Nomor antrian berhasil diambil !',
                ];
                echo json_encode($data);
                die;
            } else {
                $data = [
                    'kode' => 500,
                    'message' => 'Order belum dikirim ke poli !',
                ];
                echo json_encode($data);
                die;
            }
        }

        $data = [
            'kode' => 200,
            'message' => 'orderan dikirim'
        ];
        echo json_encode($data);
        die;
    }
    public function kirimorderlab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3002', '99'))->update(['status_order' => '0']);
        } else {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3002', '99'))->update(['status_order' => '0']);
        }
        $data = [
            'kode' => 200,
            'message' => 'orderan dikirim'
        ];
        echo json_encode($data);
        die;
    }
    public function kirimorderrad(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3003', '99'))->update(['status_order' => '0']);
        } else {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3003', '99'))->update(['status_order' => '0']);
        }
        $data = [
            'kode' => 200,
            'message' => 'orderan dikirim'
        ];
        echo json_encode($data);
        die;
    }
    public function batal_tindakan_poli(request $Request)
    {
        $detail = DB::connection('mysql2')->select('select * from ts_layanan_detail where id = ?', [$Request->id]);
        $update = [
            'total_tarif' => 0,
            'jumlah_retur' => $detail[0]->jumlah_layanan,
            'total_layanan' => 0,
            'grantotal_layanan' => 0,
            'status_layanan_detail' => 'CCL',
            'tagihan_pribadi' => '0',
            'tagihan_penjamin' => '0',
        ];
        ts_layanan_detail_dummy::whereRaw('id = ?', array($Request->id))->update($update);

        $id_header = $detail[0]->row_id_header;
        $header = DB::connection('mysql2')->select('select * from ts_layanan_header where id = ?', [$id_header]);
        if ($header[0]->tagihan_pribadi == 0) {
            $tagihan_penjamin = $header[0]->tagihan_penjamin - $detail[0]->grantotal_layanan;
            $total_layanan = $tagihan_penjamin;
            $tagihan_pribadi = 0;
        } else {
            $tagihan_pribadi = $header[0]->tagihan_pribadi - $detail[0]->grantotal_layanan;
            $total_layanan = $tagihan_pribadi;
            $tagihan_penjamin = 0;
        }
        if ($total_layanan == 0) {
            $status_layanan = 3;
            $status_retur = 'CLS';
            $data_header = [
                'tagihan_pribadi' => $tagihan_pribadi,
                'tagihan_penjamin' => $tagihan_penjamin,
                'total_layanan' => $total_layanan,
                'status_layanan' => $status_layanan,
                'status_retur' => $status_retur,
            ];
        } else {
            $data_header = [
                'tagihan_pribadi' => $tagihan_pribadi,
                'tagihan_penjamin' => $tagihan_penjamin,
                'total_layanan' => $total_layanan
            ];
        }
        ts_layanan_header_dummy::whereRaw('id = ?', array($id_header))->update($data_header);
        $data = [
            'kode' => 200,
            'message' => 'Tindakan berhasil dibatalkan'
        ];
        echo json_encode($data);
        die;
    }
    public function createLayanandetail()
    {
        //dummy
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
    public function get_nomor_antrian_reguler($pref, $kodeunit)
    {
        $q = DB::connection('mysql2')->select("SELECT id,nomor_antrian,RIGHT(nomor_antrian,3) AS kd_max  FROM ts_antrian_farmasi
        WHERE DATE(tgl_antrian) = CURDATE() AND jenis_antrian =  'REGULER' AND kode_unit = '$kodeunit'
        ORDER BY id DESC
        LIMIT 1");
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
        return 'A - ' . $pref . $kd;
    }
    public function get_nomor_antrian_racikan($pref, $kodeunit)
    {
        $q = DB::connection('mysql2')->select("SELECT id,nomor_antrian,RIGHT(nomor_antrian,3) AS kd_max  FROM ts_antrian_farmasi
        WHERE DATE(tgl_antrian) = CURDATE() AND jenis_antrian = 'RACIKAN' and kode_unit = '$kodeunit'
        ORDER BY id DESC
        LIMIT 1");
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
        return 'B - ' . $pref . $kd;
    }
    public function v2_carisep_kontrol(Request $request)
    {
        $sep = $request->sep;
        $idpic = $request->idpic;
        $nomorkartu = $request->nomorkartu;
        $dokter = DB::select('select a.kode_paramedis,b.kode_dpjp,b.nama_dokter from user a inner join mt_kuota_dokter_poli b on a.kode_paramedis = b.kode_dokter where a.id = ?', [$idpic]);
        $bulan = date('m');
        $tahun = date('Y');
        if (count($dokter) > 0) {
            $dpjp = $dokter[0]->kode_dpjp;
            $nama = $dokter[0]->nama_dokter;
        } else {
            $dpjp = 0;
            $nama = 'Dokter belum mengisi';
        }
        if (strlen($sep) > 1) {
            $v = new VclaimModel();
            $hasilsep = $v->carisep($sep);
            $nosep = $hasilsep->response->noSep;
            // $poli = $v->Datapoli(2, $nosep, $request->tanggal);
            $rujukan = $hasilsep->response->noRujukan;
            $cek_rujukan = substr($rujukan, 0, 8);
            if ($cek_rujukan == '1018R001') {
                $jenis_rujukan = '1';
                $kunjungan = 'Kunjungan pasca rawat inap, silahkan cari sep sebelum rawat inap untuk dibuatkan surat kontrol';
                return view('V2_erm.cari_sep_bpjs', compact([
                    'kunjungan', 'nomorkartu'
                ]));
            } else {
                $jenis_rujukan = '2';
                return view('V2_erm.form_buat_suratkontrol', compact([
                    'nosep', 'dpjp', 'nama', 'nomorkartu', 'bulan', 'tahun'
                ]));
            }
        } else {
            $jenis_rujukan = '1';
            $kunjungan = 'Tidak ada nomor sep atau nomor sep';
            return view('V2_erm.cari_sep_bpjs', compact('kunjungan', 'nomorkartu'));
        }
    }
    public function v2_cari_poli_kontrol(request $request)
    {
        $v = new VclaimModel();
        $poli = $v->Datapoli(2, $request->sep, $request->tgl);
        if ($poli->metaData->code == 200) {
            return view('V2_erm.tabel_poli_kontrol', compact([
                'poli'
            ]));
        } else {
            echo $poli->metaData->message;
        }
    }
    public function v2_cari_dokter_kontrol(request $request)
    {
        $v = new VclaimModel();
        $dokter = $v->Datadokter(2, $request->kode, $request->tgl);
        if ($dokter->metaData->code == 200) {
            return view('V2_erm.tabel_dokter_kontrol', compact([
                'dokter'
            ]));
        } else {
            echo $dokter->metaData->message;
        }
    }
    public function v2_cari_riwayat_sep(Request $request)
    {
        $v = new VclaimModel();
        $data = $v->get_data_kunjungan_peserta($request->nomorkartubpjs, $request->tglawal, $request->tglakhir);
        if ($data->metaData->code == 200) {
            return view('V2_erm.riwayat_sep', compact([
                'data'
            ]));
        }
    }
    public function v2_cari_riwayat_surat_kontrol(Request $request)
    {
        $v = new VclaimModel();
        $data = $v->ListRencanaKontrol_peserta($request->bulan, $request->tahun, $request->nomorkartu, $request->jenis);
        if ($data->metaData->code == 200) {
            return view('V2_erm.riwayat_surat_kontrol', compact([
                'data'
            ]));
        }
    }
    public function v2_simpankonsul(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $kodekunjungan = $request->kodekunjungan;
        $keterangan = $request->keterangankonsul;
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $datakonsul[$index] = $value;
            if ($index == 'kodeunitkonsul') {
                $arraykonsul[] = $datakonsul;
            }
        }
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        foreach ($arraykonsul as $ar) {
            $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
            $unit = DB::select('select * from mt_unit where kode_unit = ?', [$ar['kodeunitkonsul']]);
            //cek ts kunjungan
            $cek_ts_kunjungan = DB::connection('mysql2')->select('Select * from ts_kunjungan where ref_kunjungan = ? and kode_unit = ? and status_kunjungan != ?', [$kodekunjungan, $ar['kodeunitkonsul'], 8]);
            if (count($cek_ts_kunjungan) == 0) {
                $data_ts_kunjungan = [
                    'counter' => $kunjungan[0]->counter,
                    'no_rm' => $kunjungan[0]->no_rm,
                    'ref_kunjungan' => $kodekunjungan,
                    'kode_unit' => $ar['kodeunitkonsul'],
                    'kode_paramedis' => '0',
                    'ref_unit' => $kunjungan[0]->kode_unit,
                    'ref_paramedis' => $kunjungan[0]->kode_paramedis,
                    'prefix_kunjungan' => $unit[0]->prefix_unit,
                    'tgl_masuk' => $this->get_now(),
                    'status_kunjungan' => '1',
                    'kelas' => 3,
                    'kode_penjamin' => $kunjungan[0]->kode_penjamin,
                    'id_alasan_masuk' => '7',
                    'hak_kelas' => $kunjungan[0]->hak_kelas,
                    'diagx' => $assdok[0]->diagnosakerja,
                    'keterangan3' => $keterangan,
                    'pic' => auth()->user()->id_simrs,
                    'no_sep' => '',
                ];
                $kodeunit = $ar['kodeunitkonsul'];
                $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
                $kode_layanan_header = $r[0]->no_trx_layanan;
                if ($kode_layanan_header == "") {
                    $year = date('y');
                    $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
                    DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
                }
                $ts_kunjungan = ts_kunjungan::create($data_ts_kunjungan);
                $tarif = DB::select('select * from mt_tarif_detail where KODE_TARIF_DETAIL = ?', [$unit[0]->kode_tarif_konsul . '3']);
                //bpjs kode tipe transaksi 2 kalo umum 1
                $get_kunjungan_pref = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
                if ($get_kunjungan_pref[0]->kode_penjamin == 'P01') {
                    $kode_tipe_transaksi = 1;
                    $tagihan_pribadi =  $tarif[0]->TOTAL_TARIF_CURRENT;
                    $tagihan_penjamin = 0;
                } else {
                    $kode_tipe_transaksi = 2;
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin =  $tarif[0]->TOTAL_TARIF_CURRENT;
                }
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $this->get_now(),
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'kode_unit' => $kodeunit,
                    'kode_tipe_transaksi' => $kode_tipe_transaksi,
                    'pic' => auth()->user()->id_simrs,
                    'status_layanan' => '1',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                $ts_layanan_header = ts_layanan_header_dummy::create($data_layanan_header);
                $id_detail1 = $this->createLayanandetail();
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail1,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]->kode_tarif_konsul . '3',
                    'total_tarif' => $tarif[0]->TOTAL_TARIF_CURRENT,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif[0]->TOTAL_TARIF_CURRENT,
                    'grantotal_layanan' => $tarif[0]->TOTAL_TARIF_CURRENT,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $this->get_now(),
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tgl_layanan_detail_2' => $this->get_now(),
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail_dummy::create($save_detail1);
                ts_layanan_header_dummy::where('kode_kunjungan', $ts_kunjungan->id)
                    ->update(['status_layanan' => 2, 'total_layanan' => $tarif[0]->TOTAL_TARIF_CURRENT, 'tagihan_penjamin' => $tagihan_penjamin, 'tagihan_pribadi' => $tagihan_pribadi]);
            }
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    function ambilriwayatkonsul(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $list = DB::connection('mysql2')->select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where ref_kunjungan = ? and status_kunjungan != ?', [$kodekunjungan, 8]);
        return view('V2_erm.tabel_riwayat_konsul', compact([
            'list'
        ]));
    }
    function ambilcatatanmedis_pasien2(Request $request)
    {
        $rm = $request->rm;
        $kunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where no_rm = ? order by kode_kunjungan desc ', [$rm]);
        $data_h = [];
        foreach ($kunjungan as $k) {
            $header = db::select("SELECT a.`kode_kunjungan`,b.`kode_barang`,c.`nama_barang`,b.`jumlah_layanan`,b.`aturan_pakai`,b.keterangan01 FROM ts_layanan_header a
            INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
            INNER JOIN mt_barang c ON b.`kode_barang` = c.`kode_barang`
            WHERE a.kode_kunjungan = '$k->kode_kunjungan'
            AND a.kode_unit IN ('4002','4003','4004','4005','4006','4007','4008','4009','4010','4011','4012','4013')
            AND a.status_layanan != 3 AND b.kode_barang != ''");
            array_push($data_h,$header);
        }
        $assesment = DB::connection('mysql')->select('SELECT * from erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? order by a.id desc', [$rm]);
        // $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = ?', [$rm]);
        return view('V2_erm.riwayat_kunjungan_diperawat', compact([
            'kunjungan', 'assesment', 'rm','data_h'
        ]));
    }
    function batal_konsul(Request $request)
    {
        $kode = $request->id;
        ts_kunjungan::where('kode_kunjungan', $kode)->update(['status_kunjungan' => '8', 'pic2' => auth()->user()->id_simrs]);
        $data = [
            'kode' => 200,
            'message' => 'Konsul berhasil dibatalkan !'
        ];
        echo json_encode($data);
        die;
    }
}
