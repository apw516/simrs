<?php

namespace App\Http\Controllers;

use App\Models\assesmenawalperawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportingController extends ErmController
{
    public function index()
    {

        $title = 'SIMRS - BERKAS RESEP';
        $sidebar = 'berkas_erm';
        $sidebar_m = 'berkas_eresep';
        return view('Reporting.index_eresep', compact([
            'title',
            'sidebar',
            'sidebar_m',
        ]));
    }
    public function ambilDataEresep(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // $header = DB::connection('mysql')->select('SELECT a.kode_kunjungan, a.tgl_entry
        // ,fc_NAMA_PARAMEDIS1(a.dok_kirim) as nama_dokter
        // ,fc_nama_unit1(a.kode_unit) as nama_unit
        // ,fc_nama_unit1(a.unit_pengirim) as nama_unit_pengirim
        // ,a.kode_unit
        // ,a.unit_pengirim
        // ,a.dok_kirim
        // ,a.diagnosa FROM ts_layanan_header_order a
        // LEFT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        // WHERE MONTH(a.tgl_entry) = ?
        // AND YEAR(a.tgl_entry) = ?
        // AND a.kode_unit IN (?,?)', [$bulan, $tahun, 4002, 4008]);


        // $Layani = DB::connection('mysql')->select('SELECT *,fc_nama_barang(b.`kode_barang`) AS namabarang
        // FROM ts_layanan_header a
        // LEFT OUTER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
        // WHERE MONTH(a.`tgl_entry`) = ? AND YEAR(a.`tgl_entry`) = ?
        // AND a.kode_unit IN (?,?) AND b.`kode_barang` != ?', [$bulan, $tahun, 4002, 4008,'']);

        // $Order = DB::connection('mysql')->select('SELECT * FROM ts_layanan_header_order a
        // LEFT OUTER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        // WHERE MONTH(a.`tgl_entry`) = ? AND YEAR(a.`tgl_entry`) = ?
        // AND a.kode_unit IN (?,?)', [$bulan, $tahun, 4002, 4008]);

        $resep = DB::connection('mysql')->select('SELECT a.`kode_kunjungan`,c.`kode_kunjungan`,a.`tgl_entry`,b.`kode_barang`,fc_nama_barang(d.`kode_barang`) AS nama_barang_layani,e.`nama_generik`
        FROM ts_layanan_header_order a
        LEFT OUTER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        LEFT OUTER JOIN ts_layanan_header c ON a.`kode_kunjungan` = c.`kode_kunjungan`
        LEFT OUTER JOIN ts_layanan_detail d ON c.`id` = d.`row_id_header`
        LEFT OUTER JOIN mt_barang e ON d.`kode_barang` = e.`kode_barang`
        WHERE MONTH(a.tgl_entry) = ? AND YEAR(a.tgl_entry) AND a.`kode_unit` IN (?,?)
        AND d.`kode_barang` != ?', [$bulan, $tahun, 4002, 4008, '']);
        dd($resep);

        return view('Reporting.view_reporing_resep', compact([
            'header',
            'Layani',
            'Order'
        ]));
    }
    public function dataermrajal()
    {
        $title = 'SIMRS - BERKAS ERM RAWAT JALAN';
        $sidebar = 'berkas_erm';
        $sidebar_m = 'berkas erm rajal';
        return view('Reporting.index_berkas_erm_rajal', compact([
            'title',
            'sidebar',
            'sidebar_m',
        ]));
    }
    public function ambilberkasermrajal(request $request)
    {
        $rm = $request->rm;
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $first = DB::connection('mysql')->select('SELECT *,fc_nama_unit1(kode_unit) as nama_unit,date(tanggalkunjungan) as tgl FROM `erm_hasil_assesmen_keperawatan_rajal` WHERE no_rm = ? AND id = (select min(id) from erm_hasil_assesmen_keperawatan_rajal where no_rm = ?) limit 1', [$rm, $rm]);
        $datakonsul = db::select('select *,fc_nama_unit1(unit_pengirim) as poli_pengirim,fc_nama_unit1(unit_tujuan) as poli_konsul,fc_nama_paramedis1(dokter_penerima) as dokter_penerima_2 from ts_konsul_antar_poli where no_rm = ?', [$rm]);
        if (count($first) > 0) {
            $assesmen_perawat = DB::connection('mysql')->select('select *,date(tanggalkunjungan) as tgl_k from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan > ? and no_rm = ?', [$first[0]->kode_kunjungan, $rm]);
            $tanggal = date_create($first[0]->tgl);
            $arr_date = [$first[0]->id];
            foreach ($assesmen_perawat as $ap) {
                $akhir = date_create($ap->tgl_k);
                $bulan = date_diff($tanggal, $akhir);
                $days = $bulan->days;
                if ($days > 91) {
                    $tanggal = $akhir;
                    array_push($arr_date, $ap->id);
                }
            }
            foreach ($arr_date as $as) {
                assesmenawalperawat::whereRaw('id = ?', array($as))->update(['jenis_berkas' => 1]);
                assesmenawalperawat::whereRaw('id > ? and no_rm = ?', array($as, $rm))->update(['jenis_berkas' => 2, 'id_header' => $as]);
                // Model_assesmen_perawat::whereRaw('id > ? and no_rm = ? and kode_kunjungan != ? and jenis_berkas != ?', array($as, $rm, $request->kode_kunjungan,1))->update(['jenis_berkas' => 2,'id_header' => $as]);
            }
            $header = DB::connection('mysql')->select('SELECT *,a.id as idasskep,date(a.tanggalkunjungan) as tglk,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a left outer join assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? and a.jenis_berkas = ? order  by a.id desc', [$rm, 1]);
            $cppt = DB::connection('mysql')->select('SELECT *,a.id as idasskep,b.versi as versidk,date(a.tanggalkunjungan) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan
            LEFT OUTER JOIN ts_kunjungan c on a.kode_kunjungan = c.kode_kunjungan
            WHERE a.no_rm = ? and c.status_kunjungan != 8 and a.jenis_berkas = ? order  by a.id desc', [$rm, 2]);


            $cek = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm]);
            $url = url('../../files/');
            $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm]);

            $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.no_rm = ?", [$rm]);

            $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm]);
            return view('ermtemplate.detail_berkas_erm_rajal', compact([
                'header',
                'cppt',
                'cek',
                'url',
                'tindakan',
                'farmasi',
                'penunjang',
                'mt_pasien',
                'datakonsul'
            ]));
        }
    }
    public function ambilcatatanmedis_pasien2(request $request)
    {
        $rm = $request->rm;
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $first = DB::connection('mysql')->select('SELECT *,fc_nama_unit1(kode_unit) as nama_unit,date(tanggalkunjungan) as tgl FROM `erm_hasil_assesmen_keperawatan_rajal` WHERE no_rm = ? AND id = (select min(id) from erm_hasil_assesmen_keperawatan_rajal where no_rm = ?) limit 1', [$rm, $rm]);
        $datakonsul = db::select('select *,fc_nama_unit1(unit_pengirim) as poli_pengirim,fc_nama_unit1(unit_tujuan) as poli_konsul,fc_nama_paramedis1(dokter_penerima) as dokter_penerima_2 from ts_konsul_antar_poli where no_rm = ?', [$rm]);
        if (count($first) > 0) {
            $assesmen_perawat = DB::connection('mysql')->select('select *,date(tanggalkunjungan) as tgl_k from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan > ? and no_rm = ?', [$first[0]->kode_kunjungan, $rm]);
            $tanggal = date_create($first[0]->tgl);
            $arr_date = [$first[0]->id];
            foreach ($assesmen_perawat as $ap) {
                $akhir = date_create($ap->tgl_k);
                $bulan = date_diff($tanggal, $akhir);
                $days = $bulan->days;
                if ($days > 91) {
                    $tanggal = $akhir;
                    array_push($arr_date, $ap->id);
                }
            }
            foreach ($arr_date as $as) {
                assesmenawalperawat::whereRaw('id = ?', array($as))->update(['jenis_berkas' => 1]);
                assesmenawalperawat::whereRaw('id > ? and no_rm = ?', array($as, $rm))->update(['jenis_berkas' => 2, 'id_header' => $as]);
                // Model_assesmen_perawat::whereRaw('id > ? and no_rm = ? and kode_kunjungan != ? and jenis_berkas != ?', array($as, $rm, $request->kode_kunjungan,1))->update(['jenis_berkas' => 2,'id_header' => $as]);
            }
            $header = DB::connection('mysql')->select('SELECT *,a.id as idasskep,date(a.tanggalkunjungan) as tglk,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a left outer join assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? and a.jenis_berkas = ? order  by a.id desc', [$rm, 1]);
            // $cppt = DB::connection('mysql')->select('SELECT *,b.versi as versidk,date(a.tanggalkunjungan) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? and a.jenis_berkas = ? order  by a.id asc', [$rm, 2]);

            $cppt = DB::connection('mysql')->select('SELECT *,a.id as idasskep,b.versi as versidk,date(a.tanggalkunjungan) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan
            LEFT OUTER JOIN ts_kunjungan c on a.kode_kunjungan = c.kode_kunjungan
             WHERE a.no_rm = ? and c.status_kunjungan != 8 and a.jenis_berkas = ? order  by a.id desc', [$rm, 2]);

            $cek = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm]);
            $url = url('../../files/');
            $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm]);

            $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.no_rm = ?", [$rm]);

            $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm]);
            return view('ermtemplate.detail_berkas_erm_rajal', compact([
                'header',
                'cppt',
                'cek',
                'url',
                'tindakan',
                'farmasi',
                'penunjang',
                'mt_pasien',
                'datakonsul'
            ]));
        }
    }
    public function hasillab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $jlh = $request->jlh;
        $rm = $request->rm;
        $hasil_lab = DB::select('SELECT * FROM ts_kunjungan a INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan` WHERE a.`kode_kunjungan` = ? AND b.`kode_unit` = ? ORDER BY a.`kode_kunjungan` DESC', [$kodekunjungan, '3002']);
        return view('erm_form_khusus.hasil_labbb', compact([
            'hasil_lab'
        ]));
    }
    public function hasilrad(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $hasil_rad = DB::select('SELECT * FROM ts_hasil_expertisi WHERE kode_kunjungan = ? ORDER BY id DESC', [$kodekunjungan]);
        $kunjungan = db::Select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $date = $this->get_date();
        $rm = $kunjungan[0]->no_rm;
        return view('ermtemplate.view_hasil_penunjang_rad', compact([
            'hasil_rad',
            'date',
            'rm'
        ]));
    }
    public function hasilpa(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $hasil_pa = DB::select('SELECT * FROM ts_hasil_expertisi_pa  WHERE kode_kunjungan = ? ', [$kodekunjungan]);
        $kunjungan = db::Select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $kunjungan[0]->no_rm;
        return view('ermtemplate.view_hasil_penunjang_pa', compact([
            'hasil_pa',
            'rm'
        ]));
    }
}
