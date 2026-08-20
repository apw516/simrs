<?php

namespace App\Http\Controllers;

use App\Models\assesmenawaldokter;
use App\Models\assesmenawalperawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
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
        $first = DB::connection('mysql')->select('SELECT *,fc_nama_unit1(kode_unit) as nama_unit,date(tanggalkunjungan) as tgl FROM `erm_hasil_assesmen_keperawatan_rajal` WHERE no_rm = ? AND id = (select min(id) from erm_hasil_assesmen_keperawatan_rajal where no_rm = ?) limit 1', [$rm, $rm]);
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
            $cppt = DB::connection('mysql')->select('SELECT *,b.versi as versidk,date(a.tanggalkunjungan) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? and a.jenis_berkas = ? order  by a.id asc', [$rm, 2]);
            return view('ermtemplate.detail_berkas_erm_rajal', compact([
                'header',
                'cppt'
            ]));
        }
    }
    public function ambilcatatanmedis_pasien2(request $request)
    {
        $rm = trim($request->rm);
        $cek_assdok = DB::select('SELECT * FROM assesmen_dokters WHERE id_pasien = ?', [$rm]);
        foreach ($cek_assdok as $d) {
            $count1 = db::select('select id from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$d->id_kunjungan]);
            if (count($count1) == 0) {
                $asskep = [
                    'no_rm' => $rm,
                    'kode_unit' => $d->kode_unit,
                    'kode_kunjungan' => $d->id_kunjungan,
                    'tanggal_kunjungan' => $d->tgl_kunjungan,
                ];
                if ($d->kode_unit != '1015') {
                    $erm_assesmen = assesmenawalperawat::create($asskep);
                }
            }
        }
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

            $cppt = DB::connection('mysql')->select('SELECT *,a.id as idasskep,b.versi as versidk,date(c.tgl_masuk) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan
            LEFT OUTER JOIN ts_kunjungan c on a.kode_kunjungan = c.kode_kunjungan
             WHERE a.no_rm = ? and c.status_kunjungan != 8 and a.jenis_berkas = ? order  by c.kode_kunjungan desc', [$rm, 0]);

            // $cek = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm]);
            $rm2 = $rm;
            $rm = $request->rm;
            if (strlen($rm) == 8) {
                $rm = (substr($rm, 2));
            }
            $rm = '%' . $rm;
            // dd($rm);
            $cek = DB::select('select * from jkn_scan_file_rm where norm like ?', [$rm]);
            $cek2 = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm2]);
            $url = url('../../files/');
            $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm2]);

            $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.no_rm = ?", [$rm2]);

            $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`,b.kode_unit
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm2]);

            $order_penunjang = db::select('SELECT fc_nama_unit1(a.`kode_unit`)AS nama_unit,a.kode_unit,SUBSTR(kode_tarif_detail,1,6) AS kode_tarif_header,c.`NAMA_TARIF` FROM ts_layanan_header_order a
            INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
            INNER JOIN mt_tarif_header c ON SUBSTR(b.kode_tarif_detail,1,6) = c.`KODE_TARIF_HEADER`
            WHERE a.`no_rm` = ? AND a.`kode_unit` < ?', [$rm2, '4000']);

            $orderfarmasi = db::select('SELECT kode_kunjungan,a.keterangan as keteranganresep,kode_barang,aturan_pakai,jumlah_layanan FROM ts_layanan_header_order a INNER JOIN ts_layanan_detail_order b ON a.id = b.row_id_header WHERE a.no_rm = ? and  kode_unit > ?', [$rm2, '4000']);

            return view('ermtemplate.detail_berkas_erm_rajal_2', compact([
                'orderfarmasi',
                'header',
                'cppt',
                'cek',
                'cek2',
                'url',
                'tindakan',
                'farmasi',
                'penunjang',
                'mt_pasien',
                'datakonsul',
                'order_penunjang'
            ]));
        }
    }
    public function ambilcatatanmedis_pasien23(request $request)
    {
        $rm = trim($request->rm);
        $kunjungan = db::select('select a.counter, date(a.`tgl_masuk`) as tgl_masuk,a.kode_kunjungan, b.id as idassdok,c.id as idasskep from ts_kunjungan a left outer join assesmen_dokters b on a.`kode_kunjungan` = b.id_kunjungan left outer join erm_hasil_assesmen_keperawatan_rajal c on a.`kode_kunjungan` = c.`kode_kunjungan` where a.no_rm =  ? and substr(a.kode_unit,1,1) != 2 and a.kode_unit != 1002 order by a.kode_kunjungan asc', [$rm]);
        if (count($kunjungan) > 0) {
            $tanggal_awal = date_create($kunjungan[0]->tgl_masuk);
            $dataSet['tgl_masuk'] = $kunjungan[0]->tgl_masuk;
            $dataSet['kode_kunjungan'] = $kunjungan[0]->kode_kunjungan;
            $arrayindex_reguler[] = $dataSet;
            foreach ($kunjungan as $f) {
                $akhir = date_create($f->tgl_masuk);
                $bulan = date_diff($tanggal_awal, $akhir);
                $days = $bulan->days;
                if ($days > 30 ) {
                    $dataSet['tgl_masuk'] = $f->tgl_masuk;
                    $dataSet['kode_kunjungan'] = $f->kode_kunjungan;
                    $arrayindex_reguler[] = $dataSet;
                    $tanggal_awal = date_create($f->tgl_masuk);
                }
            }
            foreach ($arrayindex_reguler as $dd) {
                assesmenawalperawat::whereRaw('kode_kunjungan = ?', array($dd['kode_kunjungan']))->update(['jenis_berkas' => 1]);
                assesmenawalperawat::whereRaw('kode_kunjungan > ? and no_rm = ?', array($dd['kode_kunjungan'], $rm))->update(['jenis_berkas' => 0, 'id_header' => $dd['kode_kunjungan']]);
                assesmenawaldokter::whereRaw('id_kunjungan > ? and id_pasien = ?', array($dd['kode_kunjungan'], $rm))->update(['ref_kunjungan' => $dd['kode_kunjungan']]);
            }
            $header = DB::connection('mysql')->select('SELECT *,a.id AS idasskep,DATE(a.tanggalkunjungan) AS tglk,fc_nama_unit1(a.kode_unit) AS nama_unit FROM ts_kunjungan c LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal a 
            ON a.`kode_kunjungan` = c.`kode_kunjungan`
            LEFT OUTER JOIN assesmen_dokters b ON a.kode_kunjungan = b.id_kunjungan 
            WHERE a.no_rm = ? AND a.jenis_berkas = ? ORDER  BY a.id DESC', [$rm, 1]);

            $cppt = DB::connection('mysql')->select('SELECT *,a.id AS idasskep,b.versi AS versidk,DATE(c.tgl_masuk) AS tglk,a.kode_unit AS unitpoli ,fc_nama_unit1(a.kode_unit) AS nama_unit ,c.kode_kunjungan,a.kode_kunjungan as kode_kunjungan_asskep,b.id_kunjungan as kode_kunjungan_assdok
            FROM ts_kunjungan c LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal a ON c.kode_kunjungan = a.`kode_kunjungan`
            LEFT OUTER JOIN assesmen_dokters b ON a.kode_kunjungan = b.id_kunjungan
            WHERE a.no_rm = ? AND c.status_kunjungan != 8 AND a.jenis_berkas = ? ORDER  BY c.kode_kunjungan ASC', [$rm, 0]);
        }
        $rm = $request->rm;
        $rm2 = $rm;
        if (strlen($rm) == 8) {
            $rm = (substr($rm, 2));
        }
        $rm = '%' . $rm;
        // dd($rm);
        $cek = DB::select('select * from jkn_scan_file_rm where norm like ?', [$rm]);
        $cek2 = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm2]);
        $url = url('../../files/');


        $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm2]);

        $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.no_rm = ?", [$rm2]);

        $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`,b.kode_unit
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm2]);

        $order_penunjang = db::select('SELECT fc_nama_unit1(a.`kode_unit`)AS nama_unit,a.kode_unit,SUBSTR(kode_tarif_detail,1,6) AS kode_tarif_header,c.`NAMA_TARIF` FROM ts_layanan_header_order a
            INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
            INNER JOIN mt_tarif_header c ON SUBSTR(b.kode_tarif_detail,1,6) = c.`KODE_TARIF_HEADER`
            WHERE a.`no_rm` = ? AND a.`kode_unit` < ?', [$rm2, '4000']);

        $orderfarmasi = db::select('SELECT kode_kunjungan,a.keterangan as keteranganresep,kode_barang,aturan_pakai,jumlah_layanan FROM ts_layanan_header_order a INNER JOIN ts_layanan_detail_order b ON a.id = b.row_id_header WHERE a.no_rm = ? and  kode_unit > ?', [$rm2, '4000']);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $datakonsul = db::select('select *,fc_nama_unit1(unit_pengirim) as poli_pengirim,fc_nama_unit1(unit_tujuan) as poli_konsul,fc_nama_paramedis1(dokter_penerima) as dokter_penerima_2 from ts_konsul_antar_poli where no_rm = ?', [$rm]);
        return view('ermtemplate.detail_berkas_erm_rajal_23', compact([
            'orderfarmasi',
            'header',
            'cppt',
            'cek',
            'cek2',
            'url',
            'tindakan',
            'farmasi',
            'penunjang',
            'mt_pasien',
            'datakonsul',
            'order_penunjang'
        ]));
    }

    public function ambilcatatanmedis_pasien232(request $request)
    {
        $rm = trim($request->rm);
        $cek_assdok = DB::select('SELECT * FROM assesmen_dokters WHERE id_pasien = ?', [$rm]);
        foreach ($cek_assdok as $d) {
            $count1 = db::select('select id from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$d->id_kunjungan]);
            if (count($count1) == 0) {
                $asskep = [
                    'no_rm' => $rm,
                    'kode_unit' => $d->kode_unit,
                    'kode_kunjungan' => $d->id_kunjungan,
                    'tanggal_kunjungan' => $d->tgl_kunjungan,
                ];
                if ($d->kode_unit != '1015') {
                    $erm_assesmen = assesmenawalperawat::create($asskep);
                }
            }
        }
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
            }
            $header = DB::connection('mysql')->select('SELECT *,a.id as idasskep,date(a.tanggalkunjungan) as tglk,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a left outer join assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? and a.jenis_berkas = ? order  by a.id desc', [$rm, 1]);
            // $cppt = DB::connection('mysql')->select('SELECT *,b.versi as versidk,date(a.tanggalkunjungan) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? and a.jenis_berkas = ? order  by a.id asc', [$rm, 2]);

            $cppt = DB::connection('mysql')->select('SELECT *,a.id as idasskep,b.versi as versidk,date(c.tgl_masuk) as tglk,a.kode_unit as unitpoli ,fc_nama_unit1(a.kode_unit) as nama_unit FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan
            LEFT OUTER JOIN ts_kunjungan c on a.kode_kunjungan = c.kode_kunjungan
             WHERE a.no_rm = ? and c.status_kunjungan != 8 and a.jenis_berkas = ? order  by c.kode_kunjungan desc', [$rm, 2]);

            // $cek = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm]);
            $rm = $request->rm;
            $rm2 = $rm;
            if (strlen($rm) == 8) {
                $rm = (substr($rm, 2));
            }
            $rm = '%' . $rm;
            // dd($rm);
            $cek = DB::select('select * from jkn_scan_file_rm where norm like ?', [$rm]);
            $cek2 = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm2]);
            $url = url('../../files/');

            $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm2]);

            $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.no_rm = ?", [$rm2]);

            $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`,b.kode_unit
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$rm2]);

            $order_penunjang = db::select('SELECT fc_nama_unit1(a.`kode_unit`)AS nama_unit,a.kode_unit,SUBSTR(kode_tarif_detail,1,6) AS kode_tarif_header,c.`NAMA_TARIF` FROM ts_layanan_header_order a
            INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
            INNER JOIN mt_tarif_header c ON SUBSTR(b.kode_tarif_detail,1,6) = c.`KODE_TARIF_HEADER`
            WHERE a.`no_rm` = ? AND a.`kode_unit` < ?', [$rm2, '4000']);

            $orderfarmasi = db::select('SELECT kode_kunjungan,a.keterangan as keteranganresep,kode_barang,aturan_pakai,jumlah_layanan FROM ts_layanan_header_order a INNER JOIN ts_layanan_detail_order b ON a.id = b.row_id_header WHERE a.no_rm = ? and  kode_unit > ?', [$rm2, '4000']);

            return view('ermtemplate.detail_berkas_erm_rajal_23', compact([
                'orderfarmasi',
                'header',
                'cppt',
                'cek',
                'cek2',
                'url',
                'tindakan',
                'farmasi',
                'penunjang',
                'mt_pasien',
                'datakonsul',
                'order_penunjang'
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
