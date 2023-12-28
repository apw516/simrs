<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\pdf;
use Codedge\Fpdf\Fpdf\printresume;
use App\Models\assesmenawalperawat;
use App\Models\assesmenawalperawat_igd;
use App\Models\assesmenawaldokter;
use App\Models\ermtht_telinga;
use App\Models\erm_tht_hidung;
use App\Models\erm_gambar_gigi;
use App\Models\erm_catatan_gambar;
use App\Models\erm_mata_kanan_kiri;
use App\Models\erm_upload_gambar;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
use App\Models\ts_layanan_header_order;
use App\Models\ts_layanan_detail_order;
use App\Models\templateresep;
use App\Models\templateresep_detail;
use App\Models\Barang;
use App\Models\erm_order_penunjang;
use App\Models\ts_kunjungan;
use App\Models\ts_kunjungan2;
use App\Models\ts_antrian_igd;
use App\Models\ts_sumarilis;
use App\Models\ts_erm_transfusi_darah_reaksi;
use App\Models\ts_erm_transfusi_darah_monitoring;
use App\Models\di_diagnosa;
use Carbon\Carbon;
use simitsdk\phpjasperxml\PHPJasperXML;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokter;
use App\Models\mt_unit;
use File;


class ErmController extends Controller
{
    public function indexDokter(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermdokter';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('ermdokter.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function indexdokter_ro(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermdokter_ro';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('ermdokter.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function indexPerawat(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermperawat';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('ermperawat.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function ambildatapasienpoli()
    {
        if (auth()->user()->unit == '1002') {
            $pasienigd = DB::connection('mysql4')->select('SELECT a.id AS id,a.nomor_antrian,a.`nama_px`,a.nomor_rm,a.`tgl_masuk`,b.id AS id_pemeriksaan,b.`namapemeriksa`,c.`id` AS id_pemeriksaan_dokter,c.`nama_dokter` AS namadokter FROM ts_antrian_igd a
            LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`id` = b.id_antrian
            LEFT OUTER JOIN assesmen_dokters c ON a.id = c.id_antrian
            WHERE DATE(a.`tgl_masuk`) = CURDATE()');
            return view('ermtemplate.tabelpasienigd', compact([
                'pasienigd'
            ]));
        } else {
            if (auth()->user()->unit == '1028') {
                $pasienpoli = DB::select('SELECT IFNULL(d.nomorantrean, TIME(a.`tgl_masuk`)) AS antrian,d.`nomorantrean`,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.ref_kunjungan,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal b WHERE b.kode_kunjungan = a.`kode_kunjungan`) AS cek ,(SELECT COUNT(id) FROM assesmen_dokters b WHERE b.id_kunjungan = a.`kode_kunjungan`) AS cek2 FROM ts_kunjungan a LEFT OUTER JOIN jkn_antrian d ON a.`kode_kunjungan` = d.`kode_kunjungan`
                 WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
                    '1', auth()->user()->unit
                ]);
                return view('ermtemplate.tabelpasien_fisio_perawat', compact([
                    'pasienpoli'
                ]));
            } else {
                $pasienpoli = DB::select('SELECT IFNULL(d.nomorantrean, TIME(a.`tgl_masuk`)) AS antrian,d.`nomorantrean`,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,b.namapemeriksa,a.ref_kunjungan,c.nama_dokter,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan LEFT OUTER JOIN jkn_antrian d ON a.`kode_kunjungan` = d.`kode_kunjungan`
                 WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
                    '1', auth()->user()->unit
                ]);
                return view('ermtemplate.tabelpasien', compact([
                    'pasienpoli'
                ]));
            }
        }
    }
    public function ambildatapasienpoli_cari(Request $request)
    {
        if (auth()->user()->unit == '1002') {
            $pasienigd = DB::select('SELECT * from mt_pasien_igd');
            return view('ermtemplate.tabelpasienigd', compact([
                'pasienigd'
            ]));
        } else {
            if (auth()->user()->unit == '1028') {
                $pasienpoli = DB::select('SELECT IFNULL(d.nomorantrean, TIME(a.`tgl_masuk`)) AS antrian,d.`nomorantrean`,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.ref_kunjungan,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal b WHERE b.kode_kunjungan = a.`kode_kunjungan`) AS cek ,(SELECT COUNT(id) FROM assesmen_dokters b WHERE b.id_kunjungan = a.`kode_kunjungan`) AS cek2 FROM ts_kunjungan a LEFT OUTER JOIN jkn_antrian d ON a.`kode_kunjungan` = d.`kode_kunjungan`
               WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != ?', [
                    auth()->user()->unit, $request->tgl_awal, $request->tgl_akhir, '8'
                ]);
                return view('ermtemplate.tabelpasien_fisio_perawat', compact([
                    'pasienpoli'
                ]));
            } else {
                $pasienpoli = DB::select('SELECT IFNULL(d.nomorantrean, TIME(a.`tgl_masuk`)) AS antrian,d.`nomorantrean`,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.ref_kunjungan,b.namapemeriksa,c.nama_dokter,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan LEFT OUTER JOIN jkn_antrian d ON a.`kode_kunjungan` = d.`kode_kunjungan`
                 WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != ?', [
                    auth()->user()->unit, $request->tgl_awal, $request->tgl_akhir, 8
                ]);
                return view('ermtemplate.tabelpasien', compact([
                    'pasienpoli'
                ]));
            }
        }
    }
    public function ambildatapasienpoli_dokter()
    {
        if (auth()->user()->hak_akses == 7) {
            $pasienpoli = DB::select('SELECT b.namapemeriksa,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,a.ref_kunjungan,d.id AS id_pk,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan LEFT OUTER JOIN erm_mata_kanan_kiri d ON b.`id` = d.id_asskep WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) =  CURDATE() AND a.`kode_unit` = ?', [
                '1', auth()->user()->unit
            ]);
            return view('ermtemplate.tabelpasien_dokter_ro', compact([
                'pasienpoli'
            ]));
        } else {
            if (auth()->user()->unit == '1028') {
                $pasienpoli = DB::select('SELECT a.ref_kunjungan,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.ref_kunjungan,a.`kode_penjamin`,(SELECT COUNT(id) FROM assesmen_dokters b WHERE b.id_kunjungan = a.`kode_kunjungan`) AS cek,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal b WHERE b.kode_kunjungan = a.`kode_kunjungan`) AS cek2 FROM ts_kunjungan a WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) =  CURDATE() AND a.`kode_unit` = ?', [
                    '1', auth()->user()->unit
                ]);
                return view('ermtemplate.tabelpasien_dokter_fisio', compact([
                    'pasienpoli'
                ]));
            } else {
                $pasienpoli = DB::select('SELECT b.namapemeriksa,a.ref_kunjungan,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.ref_kunjungan,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) =  CURDATE() AND a.`kode_unit` = ?', [
                    '1', auth()->user()->unit
                ]);
                return view('ermtemplate.tabelpasien_dokter', compact([
                    'pasienpoli'
                ]));
            }
        }
    }
    public function ambildatapasienpoli_dokter_cari(Request $request)
    {

        if (auth()->user()->hak_akses == 7) {
            $pasienpoli = DB::select('SELECT b.namapemeriksa,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,a.ref_kunjungan,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,d.id AS id_pk,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan LEFT OUTER JOIN erm_mata_kanan_kiri d ON b.`id` = d.id_asskep  WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != ?', [
                auth()->user()->unit, $request->tgl_awal, $request->tgl_akhir, 8
            ]);
            return view('ermtemplate.tabelpasien_dokter_ro', compact([
                'pasienpoli'
            ]));
        } else {
            if (auth()->user()->unit == '1028') {
                $pasienpoli = DB::select('SELECT a.ref_kunjungan,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,(SELECT COUNT(id) FROM assesmen_dokters b WHERE b.id_kunjungan = a.`kode_kunjungan`) AS cek,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal b WHERE b.kode_kunjungan = a.`kode_kunjungan`) AS cek2 FROM ts_kunjungan a  WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != ?',  [
                    auth()->user()->unit, $request->tgl_awal, $request->tgl_akhir, 8
                ]);
                return view('ermtemplate.tabelpasien_dokter_fisio', compact([
                    'pasienpoli'
                ]));
            } else {
                $pasienpoli = DB::select('SELECT b.namapemeriksa,a.ref_kunjungan,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != ?', [
                    auth()->user()->unit, $request->tgl_awal, $request->tgl_akhir, 8
                ]);
                return view('ermtemplate.tabelpasien_dokter', compact([
                    'pasienpoli'
                ]));
            }
        }
    }
    public function ambildetailpasien_dokter(Request $request)
    {
        $mt_pasien = DB::select('Select no_rm,jenis_kelamin,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kode]);
        $pic = $request->pic;
        $unit = auth()->user()->unit;
        $last_assdok = DB::select('SELECT * FROM assesmen_dokters
        WHERE id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ? ) AND id_pasien = ? AND kode_unit = ?', [$request->rm, $unit, $request->rm, $unit]);
        if (auth()->user()->hak_akses == 7) {
            return view('ermperawat.form_ro_mata', compact([
                'mt_pasien',
                'kunjungan',
                'pic',
                'last_assdok'
            ]));
        } else {
            return view('ermdokter.formdokter', compact([
                'mt_pasien',
                'kunjungan',
                'pic',
                'last_assdok'
            ]));
        }
    }
    public function ambildetailpasien(Request $request)
    {
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kode]);
        $unit = auth()->user()->unit;
        $last_assdok = DB::select('SELECT * FROM assesmen_dokters
        WHERE id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ? ) AND id_pasien = ? AND kode_unit = ?', [$request->rm, $unit, $request->rm, $unit]);
        return view('ermperawat.formperawat', compact([
            'mt_pasien',
            'kunjungan',
            'last_assdok'
        ]));
    }
    public function ambilcatatanmedis_pasien(Request $request)
    {
        $rm = $request->rm;
        // $kunjungan = DB::select('SELECT *,fc_nama_unit1(a.ref_unit) as nama_ref_unit,b.kode_unit,c.kode_unit as kode_unit_dokter,a.kode_kunjungan as kodek,a.no_rm as no_rm_k,b.id as id_1, c.id as id_2,b.signature as signature_perawat,c.signature as signature_dokter,b.keluhanutama as keluhan_perawat,a.tgl_masuk,a.counter,fc_nama_unit1(a.kode_unit) AS nama_unit FROM ts_kunjungan a
        // LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`kode_kunjungan` = b.kode_kunjungan
        // LEFT OUTER JOIN assesmen_dokters c ON a.`kode_kunjungan` = c.`id_kunjungan` where a.no_rm = ? and a.status_kunjungan != ? ORDER BY a.kode_kunjungan desc LIMIT 6', [$request->rm, 8]);
        $kunjungan = DB::select('SELECT
        b.*
        ,c.*
        ,fc_nama_unit1(a.ref_unit) AS nama_ref_unit
        ,b.kode_unit,c.kode_unit AS kode_unit_dokter
        ,a.kode_kunjungan AS kodek
        ,a.no_rm AS no_rm_k
        ,a.ref_kunjungan
        ,b.id AS id_1
        ,c.id AS id_2
        ,b.signature AS signature_perawat
        ,c.signature AS signature_dokter
        ,b.keluhanutama AS keluhan_perawat
        ,a.tgl_masuk,a.counter
        ,fc_nama_unit1(a.kode_unit) AS nama_unit FROM ts_kunjungan a
        LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`kode_kunjungan` = b.kode_kunjungan AND b.`kode_unit` = a.`kode_unit`
        LEFT OUTER JOIN assesmen_dokters c ON a.`kode_kunjungan` = c.`id_kunjungan` AND c.`kode_unit` = a.`kode_unit`
        WHERE a.no_rm = ? AND a.status_kunjungan NOT IN(8,11) ORDER BY a.kode_kunjungan DESC LIMIT 5', [$request->rm]);
        return view('ermtemplate.form_catatan_medis', compact([
            'kunjungan',
            'rm'
        ]));
    }
    public function form_pemeriksaan_ro(Request $request)
    {
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $ref_kunjungan = db::select('SELECT *,counter,kode_kunjungan FROM ts_kunjungan
        WHERE counter = (SELECT MAX(counter)-1 FROM ts_kunjungan WHERE no_rm = ? AND kode_unit = ? ) AND no_rm = ? AND kode_unit = ?', [$request->rm, auth()->user()->unit, $request->rm, auth()->user()->unit]);
        if (count($ref_kunjungan) > 0) {
            $kode_lama = $ref_kunjungan[0]->kode_kunjungan;
            $hasil_ro_lama = DB::select('SELECT * from erm_mata_kanan_kiri WHERE kode_kunjungan = ?', [$kode_lama]);
        } else {
            $kode_lama = [];
            $hasil_ro_lama = [];
        }
        if (count($resume_perawat) > 0) {
            $hasil_ro = DB::select('SELECT * from erm_mata_kanan_kiri WHERE id_asskep = ?', [$resume_perawat[0]->id]);
        } else {
            $hasil_ro = [];
        }
        $rm = $request->rm;
        return view('ermperawat.isi_form_ro_2', compact(['resume_perawat', 'hasil_ro', 'hasil_ro_lama']));
    }
    public function simpanpemeriksaan_ro(Request $request)
    {
        $data = json_decode($_POST['formro'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $kodekunjungan = $dataSet['kodekunjungan'];
        $id = $dataSet['idassesmen'];
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$kodekunjungan]);
        $datamata = [
            'no_rm' => $kunjungan[0]->no_rm,
            'kode_kunjungan' => $kodekunjungan,
            'id_asskep' => $id,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'vd_od' => $dataSet['od_visus_dasar'],
            'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
            'vd_os' => $dataSet['os_visus_dasar'],
            'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
            'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
            'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
            'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
            'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
            'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
            'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
            'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
            'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
            'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
            'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
            'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
            'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
            'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
            'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
            'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
            'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
            'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
            'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
            'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
            'tekananintraokular' => $dataSet['tekanan_intra_okular'],
            'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
            'palpebra' => $dataSet['palpebra'],
            'konjungtiva' => $dataSet['konjungtiva'],
            'kornea' => $dataSet['kornea'],
            'bilikmatadepan' => $dataSet['bilik_mata_depan'],
            'pupil' => $dataSet['pupil'],
            'iris' => $dataSet['iris'],
            'lensa' => $dataSet['lensa'],
            'funduskopi' => $dataSet['funduskopi'],
            'status_oftamologis_khusus' => $dataSet['oftamologis'],
            'masalahmedis' => $dataSet['masalahmedis'],
            'prognosis' => $dataSet['prognosis'],
        ];
        $cekmata = DB::select('select * from erm_mata_kanan_kiri where id_asskep = ?', [$id]);
        if (count($cekmata) > 0) {
            erm_mata_kanan_kiri::whereRaw('id_asskep = ?', array($id))->update($datamata);
        } else {
            erm_mata_kanan_kiri::create($datamata);
        }

        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanpemeriksaan_ro_2(Request $request)
    {
        $data = json_decode($_POST['formro'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $kodekunjungan = $dataSet['kodekunjungan'];
        $id = $dataSet['idassesmen'];
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$kodekunjungan]);
        $datamata = [
            'no_rm' => $kunjungan[0]->no_rm,
            'kode_kunjungan' => $kodekunjungan,
            'id_asskep' => $id,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'tajampenglihatandekat' => $dataSet['hasilperiksalain'],
            'tekananintraokular' => $dataSet['tekanan_intra_okular'],
            'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
            'palpebra' => $dataSet['palpebra'],
            'konjungtiva' => $dataSet['konjungtiva'],
            'kornea' => $dataSet['kornea'],
            'bilikmatadepan' => $dataSet['bilik_mata_depan'],
            'pupil' => $dataSet['pupil'],
            'iris' => $dataSet['iris'],
            'lensa' => $dataSet['lensa'],
            'funduskopi' => $dataSet['funduskopi'],
            'status_oftamologis_khusus' => $dataSet['oftamologis'],
            'masalahmedis' => $dataSet['masalahmedis'],
            'prognosis' => $dataSet['prognosis'],
        ];
        $cekmata = DB::select('select * from erm_mata_kanan_kiri where id_asskep = ?', [$id]);
        if (count($cekmata) > 0) {
            erm_mata_kanan_kiri::whereRaw('id_asskep = ?', array($id))->update($datamata);
        } else {
            erm_mata_kanan_kiri::create($datamata);
        }

        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function formpemeriksaan_perawat(Request $request)
    {
        $kunjungan = DB::select('select *,fc_umur(no_rm) as umur from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $pasien = db::select('select date(tgl_lahir) as tgl_lahir from mt_pasien where no_rm = ?', [$kunjungan[0]->no_rm]);
        $toDate = Carbon::parse($this->get_date());
        $fromDate = Carbon::parse($pasien[0]->tgl_lahir);
        $usiatahun = $toDate->diff($fromDate)->y;
        $usia_hari = $toDate->diffInDays($fromDate);
        $ref_kunjungan = $kunjungan[0]->ref_kunjungan;
        $unit = auth()->user()->unit;
        if ($ref_kunjungan != '0') {
            $p_konsul =  DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$ref_kunjungan]);
        } else {
            $p_konsul = DB::select('SELECT * FROM erm_hasil_assesmen_keperawatan_rajal
        WHERE id = (SELECT MAX(id) FROM erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = ? AND kode_unit = ? ) AND no_rm = ? AND kode_unit = ?', [$kunjungan[0]->no_rm, $unit, $kunjungan[0]->no_rm, $unit]);
            if (count($p_konsul) < 1) {
                $p_konsul = [];
            }
        }
        if (count($resume) > 0) {
            return view('ermperawat.formpemeriksaan_edit', compact([
                'kunjungan',
                'resume',
                'usia_hari',
                'usiatahun',
                'p_konsul'
            ]));
        } else {
            return view('ermperawat.formpemeriksaan', compact([
                'kunjungan',
                'resume',
                'usia_hari',
                'usiatahun',
                'p_konsul'
            ]));
            // }
        }
    }
    public function formpemeriksaan_perawat_fisio(Request $request)
    {
        $kunjungan = DB::select('select *,fc_umur(no_rm) as umur from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ? and keterangan_cppt = ?', [$request->kodekunjungan, 'FISIOTERAPI']);
        $pasien = db::select('select date(tgl_lahir) as tgl_lahir from mt_pasien where no_rm = ?', [$kunjungan[0]->no_rm]);
        $toDate = Carbon::parse($this->get_date());
        $fromDate = Carbon::parse($pasien[0]->tgl_lahir);
        $usiatahun = $toDate->diff($fromDate)->y;
        $usia_hari = $toDate->diffInDays($fromDate);
        $unit = '3009';
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $penyakit = DB::select('SELECT * from mt_penyakit');
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        if (count($resume) > 0) {
            return view('ermperawat.formpemeriksaan_fisio_edit', compact([
                'kunjungan',
                'resume',
                'usia_hari',
                'usiatahun',
                'layanan'
            ]));
        } else {
            if (auth()->user()->unit == '1028') {
                return view('ermperawat.formpemeriksaan_fisio', compact([
                    'kunjungan',
                    'resume',
                    'usia_hari',
                    'usiatahun',
                    'layanan'
                ]));
            } else {
                return view('ermperawat.formpemeriksaan', compact([
                    'kunjungan',
                    'resume',
                    'usia_hari',
                    'usiatahun'
                ]));
            }
            // }
        }
    }
    public function formpemeriksaan_perawat_wicara(Request $request)
    {
        $kunjungan = DB::select('select *,fc_umur(no_rm) as umur from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ? and keterangan_cppt = ?', [$request->kodekunjungan, 'TERAPIWICARA']);
        $pasien = db::select('select date(tgl_lahir) as tgl_lahir from mt_pasien where no_rm = ?', [$kunjungan[0]->no_rm]);
        $toDate = Carbon::parse($this->get_date());
        $fromDate = Carbon::parse($pasien[0]->tgl_lahir);
        $usiatahun = $toDate->diff($fromDate)->y;
        $usia_hari = $toDate->diffInDays($fromDate);
        $unit = '3010';
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        if (count($resume) > 0) {
            return view('ermperawat.formpemeriksaan_wicara_edit', compact([
                'kunjungan',
                'resume',
                'usia_hari',
                'usiatahun',
                'layanan'
            ]));
        } else {
            if (auth()->user()->unit == '1028') {
                return view('ermperawat.formpemeriksaan_wicara', compact([
                    'kunjungan',
                    'resume',
                    'usia_hari',
                    'usiatahun',
                    'layanan'
                ]));
            } else {
                return view('ermperawat.formpemeriksaan', compact([
                    'kunjungan',
                    'resume',
                    'usia_hari',
                    'usiatahun'
                ]));
            }
        }
    }
    public function formpemeriksaan_dokter(Request $request)
    {
        $kunjungan = DB::select('select *,fc_nama_px(no_rm) as nama_pasien,fc_nama_paramedis(ref_paramedis) AS dokter_kirim,fc_nama_unit1(ref_unit) AS poli_asal from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $ref_kunjungan = $kunjungan[0]->ref_kunjungan;
        if ($ref_kunjungan != 0) {
            $ref_resume = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$ref_kunjungan]);
        } else {
            $ref_resume = [];
        }
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $penyakit = DB::select('SELECT * from mt_penyakit');
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        $kelas = $kunjungan[0]->kelas;
        $layanan_rad = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        $layanan_lab = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        $last_assdok = DB::select('SELECT * FROM assesmen_dokters
        WHERE id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ? ) AND id_pasien = ? AND kode_unit = ?', [$kunjungan[0]->no_rm, $unit, $kunjungan[0]->no_rm, $unit]);
        $first_assdok = DB::select('SELECT * FROM assesmen_dokters
        WHERE id = (SELECT MIN(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ? ) AND id_pasien = ? AND kode_unit = ?', [$kunjungan[0]->no_rm, $unit, $kunjungan[0]->no_rm, $unit]);
        if (auth()->user()->unit != '1028') {
            if (count($resume_perawat) > 0) {
                if (count($resume) > 0) {
                    if ($unit == '1014') {
                        $k1 = DB::select('select * from erm_mata_kanan_kiri where id_assesmen_dokter = ? ', [$resume[0]->id]);
                        $k2 = [];
                    } elseif ($unit == '1019') {
                        $k1 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? ', [$resume[0]->id]);
                        $k2 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? ', [$resume[0]->id]);
                    } else {
                        $k1 = [];
                        $k2 = [];
                    }
                    if ($unit == '1026') {
                        //jika anestesi
                        return view('ermdokter.new_form_pemeriksaan_dokter_anestesi_edit', compact([
                            'kunjungan',
                            'resume',
                            'resume_perawat',
                            'layanan',
                            'last_assdok',
                            'first_assdok',
                            'ref_resume'
                        ]));
                    } else {
                        if ($unit == '1014') {
                            return view('ermdokter.form_pemeriksaan_dokter_mata_edit', compact([
                                'kunjungan',
                                'resume',
                                'resume_perawat',
                                'layanan',
                                'layanan_rad',
                                'layanan_lab',
                                'penyakit',
                                'k1',
                                'k2',
                                'ref_resume'
                            ]));
                        } else {
                            return view('ermdokter.new_formpemeriksaan_dokter_edit_2', compact([
                                'kunjungan',
                                'resume',
                                'resume_perawat',
                                'layanan',
                                'layanan_rad',
                                'layanan_lab',
                                'penyakit',
                                'k1',
                                'k2',
                                'ref_resume'
                            ]));
                        }
                    }
                } else if ($resume_perawat[0]->status == 0) {
                    return view('ermtemplate.datatidakditemukan');
                } else {
                    if ($unit == '1014') {
                        $hasil_ro = DB::select('select * from erm_mata_kanan_kiri where id_asskep = ? ', [$resume_perawat[0]->id]);
                    } else {
                        $hasil_ro = [];
                    }

                    if ($unit == '1026') {
                        //jika anestesi
                        return view('ermdokter.new_form_pemeriksaan_dokter_anestesi', compact([
                            'kunjungan',
                            'resume_perawat',
                            'layanan',
                            'last_assdok',
                            'first_assdok',
                            'penyakit',
                            'hasil_ro',
                            'ref_resume'
                        ]));
                    } else {
                        // return view('ermdokter.new_form_pemeriksaan_dokter', compact([
                        //     'kunjungan',
                        //     'resume_perawat',
                        //     'layanan',
                        //     'last_assdok',
                        //     'first_assdok',
                        //     'penyakit',
                        //     'hasil_ro',
                        //     'ref_resume'
                        // ]));
                        if ($unit == '1014') {
                            return view('ermdokter.form_pemeriksaan_dokter_mata', compact([
                                'kunjungan',
                                'resume_perawat',
                                'layanan',
                                'layanan_rad',
                                'layanan_lab',
                                'last_assdok',
                                'first_assdok',
                                'penyakit',
                                'hasil_ro',
                                'ref_resume'
                            ]));
                        } else {
                            return view('ermdokter.new_form_pemeriksaan_dokter_2', compact([
                                'kunjungan',
                                'resume_perawat',
                                'layanan',
                                'layanan_rad',
                                'layanan_lab',
                                'last_assdok',
                                'first_assdok',
                                'penyakit',
                                'hasil_ro',
                                'ref_resume'
                            ]));
                        }
                    }
                }
            } else {
                return view('ermtemplate.datatidakditemukan');
            }
        } else {
            $resume_lain = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$kunjungan[0]->ref_kunjungan]);
            $resume_now = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
            if (count($resume_now) > 0) {
                return view('ermdokter.formpemeriksaan_dokter_fisio_edit', compact([
                    'resume_lain',
                    'last_assdok',
                    'kunjungan',
                    'resume_now',
                    'ref_resume'
                ]));
            } else {
                return view('ermdokter.formpemeriksaan_dokter_fisio', compact([
                    'resume_lain',
                    'last_assdok',
                    'kunjungan',
                    'ref_resume'
                ]));
            }
        }
    }
    public function formpemeriksaan_khusus(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $penyakit = DB::select('SELECT * from mt_penyakit');
        $unit = auth()->user()->unit;
        if (count($resume) > 0) {
            if ($unit == '1019') {
                $cek = DB::SELECT('select * from erm_tht_telinga where id_assesmen_dokter = ?', [$resume[0]->id]);
                $cek2 = DB::SELECT('select * from erm_tht_hidung where id_assesmen_dokter = ?', [$resume[0]->id]);
                if (count($cek) > 0 || count($cek2) > 0) {
                    $kanan = DB::SELECT('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'telinga kanan']);
                    $kiri = DB::SELECT('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'telinga kiri']);
                    $hidungkanan = DB::SELECT('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'Hidung Kanan']);
                    $hidungkiri = DB::SELECT('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'Hidung Kiri']);
                    return view('erm_form_khusus.formpemeriksaan_khusus_tht_edit', compact([
                        'kunjungan',
                        'penyakit',
                        'resume',
                        'cek',
                        'cek2',
                        'kanan',
                        'kiri',
                        'hidungkanan',
                        'hidungkiri',
                    ]));
                } else {
                    return view('erm_form_khusus.formpemeriksaan_khusus_tht', compact([
                        'kunjungan',
                        'penyakit',
                        'resume'
                    ]));
                }
            } else if ($unit == '1014') {
                $cek = DB::SELECT('select * from erm_mata_kanan_kiri where id_assesmen_dokter = ?', [$resume[0]->id]);
                if (count($cek) > 0) {
                    return view('erm_form_khusus.form_mata_edit', compact([
                        'resume',
                        'kunjungan',
                        'cek'
                    ]));
                } else {
                    return view('erm_form_khusus.form_mata', compact([
                        'resume',
                        'kunjungan'
                    ]));
                }
            } else if ($unit == '1007') {
                return view('erm_form_khusus.form_gigi', compact([
                    'resume',
                    'kunjungan'
                ]));
            } else {
                return view('erm_form_khusus.gambarbebas', compact([
                    'resume'
                ]));
            }
        } else {
            if ($unit == '1002') {
                $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
                return view('erm_form_khusus.gambarbebas', compact([
                    'resume'
                ]));
            }
            return view('ermtemplate.data1tidakditemukan');
        }
    }
    public function simpanpemeriksaanperawat(Request $request)
    {
        //jika fisioterapi ada form keterangan
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if (auth()->user()->unit != '1028') {
            if ($dataSet['keluhanutama'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Keluhan pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            if ($dataSet['tekanandarah'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Tekanan darah pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            if ($dataSet['frekuensinadi'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Frekuensi nadi pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            if ($dataSet['frekuensinafas'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Frekuensi nafas pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            if ($dataSet['suhutubuh'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'suhu tubuh pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            if ($dataSet['beratbadan'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'berat badan pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }

            $data = [
                'counter' => $dataSet['counter'],
                'no_rm' => $dataSet['nomorrm'],
                'kode_unit' => $dataSet['unit'],
                'kode_kunjungan' => $dataSet['kodekunjungan'],
                'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
                'sumberdataperiksa' => $dataSet['sumberdata'],
                'keluhanutama' => trim($dataSet['keluhanutama']),
                'tekanandarah' => $dataSet['tekanandarah'],
                'frekuensinadi' => $dataSet['frekuensinadi'],
                'frekuensinapas' => $dataSet['frekuensinafas'],
                'suhutubuh' => $dataSet['suhutubuh'],
                'beratbadan' => $dataSet['beratbadan'],
                'Riwayatpsikologi' => $dataSet['riwayatpsikologis'],
                'keterangan_riwayat_psikolog' => $dataSet['keteranganriwayatpsikologislainnya'],
                'penggunaanalatbantu' => $dataSet['alatbantu'],
                'keterangan_alat_bantu' => $dataSet['keteranganalatbantulain'],
                'cacattubuh' => $dataSet['cacattubuh'],
                'keterangancacattubuh' => $dataSet['keterangancacattubuhlainnya'],
                'Keluhannyeri' => $dataSet['pasienmengeluhnyeri'],
                'skalenyeripasien' => $dataSet['skalanyeripasien'],
                'face' => $dataSet['Face'],
                'leg' => $dataSet['Leg'],
                'Activity' => $dataSet['Activity'],
                'Cry' => $dataSet['Cry'],
                'Consolabity' => $dataSet['Consolabity'],
                'ekspresiwajah' => $dataSet['ekspresiwajah'],
                'menangis' => $dataSet['Menangis'],
                'polanafas' => $dataSet['polanafas'],
                'lengan' => $dataSet['Lengan'],
                'kaki' => $dataSet['Kaki'],
                'keadaanterangsang' => $dataSet['Keadaan_terangsang'],
                'resikojatuh' => $dataSet['resikojatuh'],
                'Skrininggizi' => $dataSet['penurunanbb'],
                'beratskrininggizi' => $dataSet['beratpenurunan'],
                'status_asupanmkanan' => $dataSet['asupanmakanan'],
                'penyakitlainpasien' => $dataSet['keterangandiagnosalain'],
                'diagnosakhusus' => $dataSet['diagnosakhusus'],
                'resikomalnutrisi' => $dataSet['kajianlanjutgizi'],
                'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'],
                'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
                'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
                'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
                'namapemeriksa' => auth()->user()->nama,
                'idpemeriksa' => auth()->user()->id,
                'status' => '0',
                'signature' => '',
                'umur' => $dataSet['umur'],
                'jeniskelamin' => $dataSet['jeniskelamin'],
                'diagnosis' => $dataSet['diagnosis'],
                'gangguankoginitf' => $dataSet['Gangguan_Kognitif'],
                'faktorlingkungan' => $dataSet['Faktor_Lingkungan'],
                'responterhadapoperasi' => $dataSet['respon_thd_op'],
                'penggunaanobat' => $dataSet['Penggunaan_Obat'],
                'anaktampakkurus' => $dataSet['anaktampakkurus'],
                'adapenurunanbbanak' => $dataSet['adapenurunanbbanak'],
                'anakadadiare' => $dataSet['anakadadiare'],
                'faktormalnutrisianak' => $dataSet['faktormalnutrisianak'],
                'usia' => $dataSet['usia'],
            ];
        }
        try {
            if (auth()->user()->unit == '1028') {
                //fisioterapi
                $datatindakan = json_decode($_POST['data2'], true);
                //input tindakan
                if (count($datatindakan) > 0) {
                    $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
                    $dt = Carbon::now()->timezone('Asia/Jakarta');
                    $date = $dt->toDateString();
                    $time = $dt->toTimeString();
                    $now = $date . ' ' . $time;
                    $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet['kodekunjungan']]));
                    $kodekunjungan = $dataSet['kodekunjungan'];
                    $penjamin = $kunjungan[0]->kode_penjamin;
                    if ($request->keterangan == 'FISIOTERAPI') {
                        $kodeunit = '3009';
                    } else {
                        $kodeunit = '3010';
                    }
                    $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kodeunit]);
                    $prefix_kunjungan = $unit[0]->prefix_unit;
                    foreach ($datatindakan as $namatindakan) {
                        $index = $namatindakan['name'];
                        $value = $namatindakan['value'];
                        $dataSet[$index] = $value;
                        if ($index == 'cyto') {
                            $arrayindex_tindakan[] = $dataSet;
                        }
                    }
                    try {
                        $kode_unit = $kodeunit;
                        //dummy
                        $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
                        $kode_layanan_header = $r[0]->no_trx_layanan;
                        if ($kode_layanan_header == "") {
                            $year = date('y');
                            $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                            //dummy
                            DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
                        }
                        $data_layanan_header = [
                            'kode_layanan_header' => $kode_layanan_header,
                            'tgl_entry' =>   $now,
                            'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                            'kode_unit' => $kodeunit,
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
                        foreach ($arrayindex_tindakan as $d) {
                            if ($penjamin == 'P01') {
                                $tagihanpenjamin = 0;
                                $tagihanpribadi = $d['tarif'] * $d['qty'];
                            } else {
                                $tagihanpenjamin = $d['tarif'] * $d['qty'];
                                $tagihanpribadi = 0;
                            }
                            $total_tarif = $d['tarif'] * $d['qty'];
                            $id_detail = $this->createLayanandetail();
                            $save_detail = [
                                'id_layanan_detail' => $id_detail,
                                'kode_layanan_header' => $kode_layanan_header,
                                'kode_tarif_detail' => $d['kodelayanan'],
                                'total_tarif' => $d['tarif'],
                                'jumlah_layanan' => $d['qty'],
                                'diskon_layanan' => $d['disc'],
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
                    } catch (\Exception $e) {
                        $back = [
                            'kode' => 500,
                            'message' => $e->getMessage()
                        ];
                        echo json_encode($back);
                        die;
                    }
                }
                $data2 = [
                    'counter' => $dataSet['counter'],
                    'no_rm' => $dataSet['nomorrm'],
                    'kode_unit' => $dataSet['unit'],
                    'kode_kunjungan' => $dataSet['kodekunjungan'],
                    'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
                    'tindakankeperawatan' => $dataSet['hasilpemeriksaan'],
                    'namapemeriksa' => auth()->user()->nama,
                    'idpemeriksa' => auth()->user()->id,
                    'status' => '0',
                    'signature' => '',
                    'keterangan_cppt' => $request->keterangan
                ];
                $cek = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE tanggalkunjungan = ? AND no_rm = ? AND kode_unit = ? AND keterangan_cppt = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit'], $request->keterangan]);
                if (count($cek) > 0) {
                    assesmenawalperawat::whereRaw('no_rm = ? and kode_unit = ? and tanggalkunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan']))->update(['signature' => '', 'status' => 0]);
                    assesmenawalperawat::whereRaw('no_rm = ? and kode_unit = ? and tanggalkunjungan = ? and keterangan_cppt = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan'], $request->keterangan))->update($data2);
                } else {
                    $erm_assesmen = assesmenawalperawat::create($data2);
                }
                assesmenawalperawat::whereRaw('kode_kunjungan = ?', array($dataSet['kodekunjungan']))->update(['signature' => '', 'status' => '0']);
                $data = [
                    'kode' => 200,
                    'message' => 'Data berhasil disimpan !'
                ];
                echo json_encode($data);
                die;
            } else {
                $cek = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE tanggalkunjungan = ? AND no_rm = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
                if (count($cek) > 0) {
                    $cek2 = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
                    if (count($cek2) > 0) {
                        $data = [
                            'kode' => 500,
                            'message' => 'Dokter sudah mengisi assesmen awal medis ... !'
                        ];
                        echo json_encode($data);
                        die;
                    } else {
                        assesmenawalperawat::whereRaw('no_rm = ? and kode_unit = ? and tanggalkunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan']))->update($data);
                    }
                } else {
                    $erm_assesmen = assesmenawalperawat::create($data);
                }
                $data = [
                    'kode' => 200,
                    'message' => 'Data berhasil disimpan !'
                ];
                echo json_encode($data);
                die;
            }
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
        // }
    }
    public function simpanpemeriksaandokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $datatindakan = json_decode($_POST['datatindakan'], true);
        $datatindaklanjut = json_decode($_POST['datatindaklanjut'], true);
        $formobat_farmasi = json_decode($_POST['formobat_farmasi'], true);
        $formobatfarmasi2 = json_decode($_POST['formobatfarmasi2'], true);
        if (count($datatindaklanjut) == 1) {
            $data = [
                'kode' => 500,
                'message' => 'Tindak lanjut pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($datatindaklanjut as $nama_1) {
            $index =  $nama_1['name'];
            $value =  $nama_1['value'];
            $dataSet_tindaklanjut[$index] = $value;
        }
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $id_asskep = $dataSet['idasskep'];
        $diagnosakerja = preg_replace("/[^A-Za-z]/", "", $dataSet['diagnosakerja']);
        $cekdiagnosa =  strlen($diagnosakerja);
        $cekorderfarmasi = preg_replace("/[^A-Za-z]/", "", $request->resepobat);
        $cekorderfar =  strlen($cekorderfarmasi);
        if ($cekdiagnosa == '0') {
            $data = [
                'kode' => 500,
                'message' => 'Harap isi diagnosa pasien !'
            ];
            echo json_encode($data);
            die;
        }
        // ($dataSet['diagnosakerja']
        $simpantemplate = $request->simpantemplate;
        if (empty($dataSet['hipertensi'])) {
            $hipertensi = 0;
        } else {
            $hipertensi = $dataSet['hipertensi'];
        };

        if (empty($dataSet['kencingmanis'])) {
            $kencingmanis = 0;
        } else {
            $kencingmanis = $dataSet['kencingmanis'];
        };

        if (empty($dataSet['jantung'])) {
            $jantung = 0;
        } else {
            $jantung = $dataSet['jantung'];
        };

        if (empty($dataSet['stroke'])) {
            $stroke = 0;
        } else {
            $stroke = $dataSet['stroke'];
        };

        if (empty($dataSet['hepatitis'])) {
            $hepatitis = 0;
        } else {
            $hepatitis = $dataSet['hepatitis'];
        };

        if (empty($dataSet['asthma'])) {
            $asthma = 0;
        } else {
            $asthma = $dataSet['asthma'];
        };

        if (empty($dataSet['ginjal'])) {
            $ginjal = 0;
        } else {
            $ginjal = $dataSet['ginjal'];
        };

        if (empty($dataSet['tb'])) {
            $tb = 0;
        } else {
            $tb = $dataSet['tb'];
        };

        if (empty($dataSet['riwayatlain'])) {
            $riwayatlain = 0;
        } else {
            $riwayatlain = $dataSet['riwayatlain'];
            if ($dataSet['ketriwayatlain'] == '') {
                $data = [
                    'kode' => 502,
                    'message' => 'Isi keterangan riwayat lain ...'
                ];
                echo json_encode($data);
                die;
            }
        };

        if ($dataSet['kesadaran'] == 'Composmentis') {
            $kesadaran = 'Composmentis';
        } else {
            $kesadaran = $dataSet['keterangankesadaran'];
        }

        $data = [
            'counter' => $dataSet['counter'],
            'kode_unit' => $dataSet['unit'],
            'id_kunjungan' => $dataSet['kodekunjungan'],
            'id_pasien' => $dataSet['nomorrm'],
            'id_asskep' => $dataSet['idasskep'],
            'pic' => auth()->user()->id,
            'nama_dokter' => auth()->user()->nama,
            'tgl_kunjungan' => $dataSet['tanggalkunjungan'],
            'tgl_pemeriksaan' => $this->get_now(),
            'sumber_data' => $dataSet['sumberdata'],
            'tekanan_darah' => $dataSet['tekanandarah'],
            'frekuensi_nadi' => $dataSet['frekuensinadi'],
            'frekuensi_nafas' => $dataSet['frekuensinafas'],
            'beratbadan' => $dataSet['beratbadan'],
            'suhu_tubuh' => $dataSet['suhutubuh'],
            'riwayat_alergi' =>  $dataSet['alergi'],
            'keterangan_alergi' =>  $dataSet['ketalergi'],
            'riwayat_kehamilan_pasien_wanita' => $dataSet['riwayatkehamilan'],
            'riwyat_kelahiran_pasien_anak' => $dataSet['riwayatkelahiran'],
            'riwyat_penyakit_sekarang' => $dataSet['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'ket_riwayatlain' => $dataSet['ketriwayatlain'],
            'statusgeneralis' => $dataSet['statusgeneralis'],
            'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
            'keadaanumum' => $dataSet['keadaanumum'],
            'kesadaran' => $dataSet['kesadaran'],
            'diagnosakerja' => trim($dataSet['diagnosakerja']),
            'diagnosabanding' => $dataSet['diagnosabanding'],
            'rencanakerja' => trim($dataSet['rencanakerja']),
            'tindakanmedis' => trim($dataSet['tindakanmedis']),
            'keluhan_pasien' => trim($dataSet['keluhanutama']),
            'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
            'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
            'keterangan_tindak_lanjut_2' => trim($dataSet['jawabankonsul']),
            'umur' => $dataSet['usia'],
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'signature' => '',
            'evaluasi' => $request->hasilexpertisi
        ];
        $nomorrm = $dataSet['nomorrm'];
        $diagnosakerja = $dataSet['rencanakerja'];
        try {
            $data_k = [
                'keluhanutama' =>  trim($dataSet['keluhanutama'])
            ];
            assesmenawalperawat::whereRaw('id = ?', array($dataSet['idasskep']))->update($data_k);
            $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
            $kodekunjungan = $dataSet['kodekunjungan'];
            if (count($cek) > 0) {
                $data = [
                    'counter' => $dataSet['counter'],
                    'kode_unit' => $dataSet['unit'],
                    'id_kunjungan' => $dataSet['kodekunjungan'],
                    'id_pasien' => $dataSet['nomorrm'],
                    'id_asskep' => $dataSet['idasskep'],
                    'pic' => auth()->user()->id,
                    'nama_dokter' => auth()->user()->nama,
                    'tgl_kunjungan' => $dataSet['tanggalkunjungan'],
                    'updated_at' => $this->get_now(),
                    'sumber_data' => $dataSet['sumberdata'],
                    'tekanan_darah' => $dataSet['tekanandarah'],
                    'frekuensi_nadi' => $dataSet['frekuensinadi'],
                    'frekuensi_nafas' => $dataSet['frekuensinafas'],
                    'suhu_tubuh' => $dataSet['suhutubuh'],
                    'riwayat_alergi' =>  $dataSet['alergi'],
                    'keterangan_alergi' =>  $dataSet['ketalergi'],
                    'riwayat_kehamilan_pasien_wanita' => $dataSet['riwayatkehamilan'],
                    'riwyat_kelahiran_pasien_anak' => $dataSet['riwayatkelahiran'],
                    'riwyat_penyakit_sekarang' => $dataSet['riwayatpenyakitsekarang'],
                    'hipertensi' => $hipertensi,
                    'kencingmanis' => $kencingmanis,
                    'jantung' => $jantung,
                    'stroke' => $stroke,
                    'hepatitis' => $hepatitis,
                    'asthma' => $asthma,
                    'ginjal' => $ginjal,
                    'tbparu' => $tb,
                    'riwayatlain' => $riwayatlain,
                    'ket_riwayatlain' => $dataSet['ketriwayatlain'],
                    'statusgeneralis' => $dataSet['statusgeneralis'],
                    'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
                    'keadaanumum' => $dataSet['keadaanumum'],
                    'kesadaran' => $kesadaran,
                    'diagnosakerja' => trim($dataSet['diagnosakerja']),
                    'diagnosabanding' => $dataSet['diagnosabanding'],
                    'rencanakerja' => trim($dataSet['rencanakerja']),
                    'keluhan_pasien' => trim($dataSet['keluhanutama']),
                    'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
                    'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
                    'keterangan_tindak_lanjut_2' => trim($dataSet['jawabankonsul']),
                    'status' => '0',
                    'signature' => '',
                    'evaluasi' => $request->hasilexpertisi
                ];
                assesmenawaldokter::whereRaw('id_pasien = ? and kode_unit = ? and id_kunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['kodekunjungan']))->update($data);
                $id_assesmen = $cek[0]->id;
            } else {
                $erm_assesmen = assesmenawaldokter::create($data);
                $id_assesmen = $erm_assesmen->id;
            }

            //input tindakan
            if (count($datatindakan) > 0) {
                $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet['kodekunjungan']]));
                $kodekunjungan = $dataSet['kodekunjungan'];
                $penjamin = $kunjungan[0]->kode_penjamin;
                $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
                $prefix_kunjungan = $unit[0]->prefix_unit;

                foreach ($datatindakan as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan[] = $dataSet;
                    }
                }

                try {
                    $kode_unit = $kunjungan[0]->kode_unit;
                    //dummy
                    $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
                    $kode_layanan_header = $r[0]->no_trx_layanan;
                    if ($kode_layanan_header == "") {
                        $year = date('y');
                        $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                        //dummy
                        DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
                    }
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_unit' => $kunjungan['0']->kode_unit,
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
                    foreach ($arrayindex_tindakan as $d) {
                        if ($penjamin == 'P01') {
                            $tagihanpenjamin = 0;
                            $tagihanpribadi = $d['tarif'] * $d['qty'];
                        } else {
                            $tagihanpenjamin = $d['tarif'] * $d['qty'];
                            $tagihanpribadi = 0;
                        }
                        $total_tarif = $d['tarif'] * $d['qty'];
                        $id_detail = $this->createLayanandetail();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_tarif_detail' => $d['kodelayanan'],
                            'total_tarif' => $d['tarif'],
                            'jumlah_layanan' => $d['qty'],
                            'diskon_layanan' => $d['disc'],
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
                    // $back = [
                    //     'kode' => 200,
                    //     'message' => ''
                    // ];
                    // echo json_encode($back);
                    // die;
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            //end of input tindakan

            if (count($formobatfarmasi2) > 1) {
                $simpantemplate = $request->simpantemplate;
                $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
                $kodekunjungan = $request->kodekunjungan;
                $penjamin = $kunjungan[0]->kode_penjamin;
                //jika penjamin bpjs order ke dp2
                //jika penjamin umum order ke dp1
                //kodeheader dibedakan menjadi ORF
                if ($penjamin == 'P01') {
                    $unit = '4002';
                } else {
                    $unit = '4008';
                }
                $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
                $prefix_kunjungan = $mtunit[0]->prefix_unit;
                foreach ($formobatfarmasi2 as $nama) {
                    $index = $nama['name'];
                    $value = $nama['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'keterangan') {
                        $arrayindex_far[] = $dataSet;
                    }
                }
                $obatnya = '';
                foreach ($arrayindex_far as $d) {
                    if ($obatnya == '') {
                        $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                    } else {
                        $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                    }
                    $obatnya = $obatbaru;
                }
                if ($simpantemplate == 'on') {
                    if ($request->namaresep == '') {
                        $back = [
                            'kode' => 500,
                            'message' => 'Nama Resep tidak boleh kosong !'
                        ];
                        echo json_encode($back);
                        die;
                    }

                    $dataresep = [
                        'nama_resep' => $request->namaresep,
                        'keterangan' => $obatnya,
                        'user' => auth()->user()->kode_paramedis,
                        'tgl_entry' => $this->get_now()
                    ];
                    $id_resep = templateresep::create($dataresep);
                    foreach ($arrayindex_far as $d) {
                        $detailresep = [
                            'id_template' => $id_resep->id,
                            'nama_barang' => $d['namaobat'],
                            'kode_barang' => $d['kodebarang'],
                            'aturan_pakai' => $d['aturanpakai'],
                            'jumlah' => $d['jumlah'],
                            'signa' => $d['signa'],
                            'keterangan' => $d['keterangan'],
                        ];
                        $detailresep = templateresep_detail::create($detailresep);
                    }
                }
                try {
                    $kode_unit = $unit;
                    $kode_layanan_header = $this->createOrderHeader('F');
                    $data_layanan_header = [
                        'no_rm' => $kunjungan[0]->no_rm,
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_penjaminx' => $penjamin,
                        'kode_unit' => $kode_unit,
                        'kode_tipe_transaksi' => 2,
                        'pic' => auth()->user()->id,
                        'unit_pengirim' => auth()->user()->unit,
                        'tgl_periksa' => $this->get_now(),
                        'diagnosa' => $diagnosakerja,
                        'dok_kirim' => auth()->user()->kode_paramedis,
                        'status_layanan' => '3',
                        'status_retur' => 'OPN',
                        'status_pembayaran' => 'OPN',
                        'status_order' => '0',
                        'id_assdok' => $id_assesmen
                    ];
                    $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                    foreach ($arrayindex_far as $d) {
                        $id_detail = $this->createLayanandetailOrder();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'kode_barang' => $d['namaobat'],
                            'jumlah_layanan' => $d['jumlah'],
                            'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $ts_layanan_header->id,
                            'id_assdok' => $id_assesmen
                        ];
                        $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                    }
                    if ($penjamin == 'P01') {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    } else {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    }
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            //end of farmasi

            //datapemeriksaankhusus
            $gambar = $request->gambar;
            //jika poli mata
            if (auth()->user()->unit == '1014') {
                $data1 = json_decode($_POST['formpemeriksaankhusus'], true);
                foreach ($data1 as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $dataSet[$index] = $value;
                }
                $datamata = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'no_rm' => $nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'tgl_entry' => $this->get_now(),
                    'status' => '0',
                    'vd_od' => $dataSet['od_visus_dasar'],
                    'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
                    'vd_os' => $dataSet['os_visus_dasar'],
                    'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
                    'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
                    'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
                    'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
                    'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
                    'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
                    'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
                    'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
                    'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
                    'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
                    'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
                    'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
                    'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
                    'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
                    'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
                    'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
                    'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
                    'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
                    'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
                    'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
                    'tekananintraokular' => $dataSet['tekanan_intra_okular'],
                    'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
                    'palpebra' => $dataSet['palpebra'],
                    'konjungtiva' => $dataSet['konjungtiva'],
                    'kornea' => $dataSet['kornea'],
                    'bilikmatadepan' => $dataSet['bilik_mata_depan'],
                    'pupil' => $dataSet['pupil'],
                    'iris' => $dataSet['iris'],
                    'lensa' => $dataSet['lensa'],
                    'funduskopi' => $dataSet['funduskopi'],
                    'status_oftamologis_khusus' => $dataSet['oftamologis'],
                    'masalahmedis' => $dataSet['masalahmedis'],
                    'prognosis' => $dataSet['prognosis'],
                    'id_asskep' =>  $id_asskep
                ];

                $cekmata = DB::select('select * from erm_mata_kanan_kiri where id_asskep = ?', [$id_asskep]);
                if (count($cekmata) > 0) {
                    erm_mata_kanan_kiri::whereRaw('id_asskep = ?', array($id_asskep))->update($datamata);
                } else {
                    erm_mata_kanan_kiri::create($datamata);
                }
                $hasil_pemeriksaan_khusus = "visus dasar : " . " OD : " . $dataSet['od_visus_dasar'] . " OD PINHOLE : " . $dataSet['od_pinhole_visus_dasar'] . " OS : " . $dataSet['os_visus_dasar'] .  " OS PINHOLE : " . $dataSet['os_pinhole_visus_dasar'] . " | Refraktometer / streak : " . "  OD : Sph : " . $dataSet['od_sph_refraktometer'] . " Cyl : " . $dataSet['od_cyl_refraktometer'] . " X : " . $dataSet['od_x_refraktometer'] . "  OS : Sph  : " . $dataSet['os_sph_refraktometer'] . " Cyl : " . $dataSet['os_cyl_refraktometer'] . " X : " . $dataSet['os_x_refraktometer'] . " Lensometer : " . "  OD : Sph  :" . $dataSet['od_sph_Lensometer'] . " Cyl : " . $dataSet['od_cyl_Lensometer'] . " X : " . $dataSet['od_x_Lensometer'] . "  OS : Sph : " . $dataSet['os_sph_Lensometer'] . " Cyl : " . $dataSet['os_cyl_Lensometer'] . " X : " . $dataSet['os_x_Lensometer'] . " | Koreksi penglihatan jauh : " . "  VOD : Sph : " . $dataSet['vod_sph_kpj'] . " Cyl : " . $dataSet['vod_cyl_kpj'] . " X : " . $dataSet['vod_x_kpj'] . "  VOS : Sph  : " . $dataSet['vos_sph_kpj'] . " Cyl : " . $dataSet['vos_cyl_kpj'] . "X :" . $dataSet['vos_x_kpj'] . " | Tajam penglihatan dekat : " . $dataSet['penglihatan_dekat'] . " | Tekanan Intra Okular : " . $dataSet['tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['palpebra'] . " | Konjungtiva : " . $dataSet['konjungtiva'] . "| Kornea : " . $dataSet['kornea'] . " | Bilik Mata Depan : " . $dataSet['bilik_mata_depan'] . " | pupil : " . $dataSet['pupil'] . " | Iris : " . $dataSet['iris'] . " | Lensa : " . $dataSet['lensa'] . " | funduskopi : " . $dataSet['funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['oftamologis'] . "| Masalah Medis : " . $dataSet['masalahmedis'] . " | Prognosis : " . $dataSet['prognosis'];

                $data_mata = ['gambar_1' => $gambar, 'pemeriksaan_khusus' => $hasil_pemeriksaan_khusus];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($data_mata);
            } elseif (auth()->user()->unit == '1019') {
                $telingakanan = json_decode($_POST['formtelingakanan'], true);
                $telingakiri = json_decode($_POST['formtelingakiri'], true);
                $anjurantelinga = json_decode($_POST['formanjurantelinga'], true);
                $hidungkanan = json_decode($_POST['formhidungkanan'], true);
                $hidungkiri = json_decode($_POST['formhidungkiri'], true);
                $kseimpulanhidung = json_decode($_POST['formkesimpulanhidung'], true);
                foreach ($telingakanan as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrtelingakanan[$index] = $value;
                }
                foreach ($telingakiri as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrtelingakiri[$index] = $value;
                }
                foreach ($anjurantelinga as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arranjurantelinga[$index] = $value;
                }
                foreach ($hidungkanan as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrhidungkanan[$index] = $value;
                }
                foreach ($hidungkiri as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrhidungkiri[$index] = $value;
                }
                foreach ($kseimpulanhidung as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrkesimpulanhidung[$index] = $value;
                }
                //telinga kanan
                (empty($arrtelingakanan['Lapang'])) ? $a = '' : $a = ' Liang Telinga - lapang';
                (empty($arrtelingakanan['Destruksi'])) ? $b = '' : $b = ' Liang Telinga - Destruksi';
                (empty($arrtelingakanan['Sempit']))  ? $c = '' : $c = ' Liang Telinga - Sempit';
                (empty($arrtelingakanan['Serumen']))  ? $d = '' : $d = ' Liang Telinga - Serumen';
                (empty($arrtelingakanan['Kolesteatoma']))  ? $e = '' : $e = ' Liang Telinga - Kolesteatoma';
                (empty($arrtelingakanan['Sekret']))  ? $f = '' : $f = ' Liang Telinga - Sekret';
                (empty($arrtelingakanan['Massa atau Jaringan']))  ? $g = '' : $g = ' Liang Telinga - Massa atau Jaringan';
                (empty($arrtelingakanan['Jamur']))  ? $h = '' : $h = ' Liang Telinga - Jamur';
                (empty($arrtelingakanan['Benda Asing']))  ? $i = '' : $i = ' Liang Telinga - Benda Asing';
                (empty($arrtelingakanan['LT Lain-Lain']))  ? $j = '' : $j = ' Liang Telinga - Lain - lain';

                (empty($arrtelingakanan['Intak - Normal']))  ? $k = '' : $k = ' Intak - Normal';
                (empty($arrtelingakanan['Intak - Hiperemis']))  ? $l = '' : $l = ' Intak - Hiperemis';
                (empty($arrtelingakanan['Intak - Bulging']))  ? $m = '' : $m = ' Intak - Bulging';
                (empty($arrtelingakanan['Intak - Retraksi']))  ? $n = '' : $n = ' Intak - Retraksi';
                (empty($arrtelingakanan['Intak - Sklerotik']))  ? $o = '' : $o = ' Intak - Sklerotik';
                (empty($arrtelingakanan['Perforasi - Sentral']))  ? $p = '' : $p = ' Perforasi - Sentral';
                (empty($arrtelingakanan['Perforasi - Atik']))  ? $q = '' : $q = ' Perforasi - Atik';
                (empty($arrtelingakanan['Perforasi - Marginal']))  ? $r = '' : $r = ' Perforasi - Marginal';
                (empty($arrtelingakanan['Perforasi - Lain-Lain']))  ? $s = '' : $s = ' Perforasi - Lain-Lain';

                if ($arrtelingakanan['ltketeranganlain'] != '') {
                    $ltketeranganlain = ' Liang telinga keterangan : ' . $arrtelingakanan['ltketeranganlain'];
                } else {
                    $ltketeranganlain = '';
                }

                if ($arrtelingakanan['mtketeranganlain'] != '') {
                    $mtketeranganlain = ' membaran timpan keterangan lain : ' . $arrtelingakanan['mtketeranganlain'];
                } else {
                    $mtketeranganlain = '';
                }

                if ($arrtelingakanan['mukosa'] != '') {
                    $mukosa = ' mukosa : ' . $arrtelingakanan['mukosa'];
                } else {
                    $mukosa = '';
                }

                if ($arrtelingakanan['oslkel'] != '') {
                    $oslkel = ' oslkel : ' . $arrtelingakanan['oslkel'];
                } else {
                    $oslkel = '';
                }

                if ($arrtelingakanan['Isthmus'] != '') {
                    $isthmus = ' Isthmus : ' . $arrtelingakanan['Isthmus'];
                } else {
                    $isthmus = '';
                }
                if ($arrtelingakanan['keteranganlain'] != '') {
                    $keteranganlain = ' Keterangan lain : ' . $arrtelingakanan['keteranganlain'];
                } else {
                    $keteranganlain = '';
                }
                if ($arranjurantelinga['kesimpulan'] != '') {
                    $kesimpulan = ' kesimpulan : ' . $arranjurantelinga['kesimpulan'];
                } else {
                    $kesimpulan = '';
                }
                if ($arranjurantelinga['anjuran'] != '') {
                    $anjuran = ' anjuran : ' . $arranjurantelinga['anjuran'];
                } else {
                    $anjuran = '';
                }

                $data_telinga_kanan = 'Telinga Kanan : ' . $a . $b . $c . $d . $e . $f . $g . $h . $i . $j . $ltketeranganlain . $k . $l . $m . $n . $o . $p . $q . $r . $s .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
                //end telinga kanan


                //telinga kiri
                (empty($arrtelingakiri['Lapang'])) ? $a1 = '' : $a1 = ' Liang Telinga - lapang';
                (empty($arrtelingakiri['Destruksi'])) ? $b1 = '' : $b1 = ' Liang Telinga - Destruksi';
                (empty($arrtelingakiri['Sempit']))  ? $c1 = '' : $c1 = ' Liang Telinga - Sempit';
                (empty($arrtelingakiri['Serumen']))  ? $d1 = '' : $d1 = ' Liang Telinga - Serumen';
                (empty($arrtelingakiri['Kolesteatoma']))  ? $e1 = '' : $e1 = ' Liang Telinga - Kolesteatoma';
                (empty($arrtelingakiri['Sekret']))  ? $f1 = '' : $f1 = ' Liang Telinga - Sekret';
                (empty($arrtelingakiri['Massa atau Jaringan']))  ? $g1 = '' : $g1 = ' Liang Telinga - Massa atau Jaringan';
                (empty($arrtelingakiri['Jamur']))  ? $h1 = '' : $h1 = ' Liang Telinga - Jamur';
                (empty($arrtelingakiri['Benda Asing']))  ? $i1 = '' : $i1 = ' Liang Telinga - Benda Asing';
                (empty($arrtelingakiri['LT Lain-Lain']))  ? $j1 = '' : $j1 = ' Liang Telinga - Lain - lain';

                (empty($arrtelingakiri['Intak - Normal']))  ? $k1 = '' : $k1 = ' Intak - Normal';
                (empty($arrtelingakiri['Intak - Hiperemis']))  ? $l1 = '' : $l1 = ' Intak - Hiperemis';
                (empty($arrtelingakiri['Intak - Bulging']))  ? $m1 = '' : $m1 = ' Intak - Bulging';
                (empty($arrtelingakiri['Intak - Retraksi']))  ? $n1 = '' : $n1 = ' Intak - Retraksi';
                (empty($arrtelingakiri['Intak - Sklerotik']))  ? $o1 = '' : $o1 = ' Intak - Sklerotik';
                (empty($arrtelingakiri['Perforasi - Sentral']))  ? $p1 = '' : $p1 = ' Perforasi - Sentral';
                (empty($arrtelingakiri['Perforasi - Atik']))  ? $q1 = '' : $q1 = ' Perforasi - Atik';
                (empty($arrtelingakiri['Perforasi - Marginal']))  ? $r1 = '' : $r1 = ' Perforasi - Marginal';
                (empty($arrtelingakiri['Perforasi - Lain-Lain']))  ? $s1 = '' : $s1 = ' Perforasi - Lain-Lain';

                if ($arrtelingakiri['ltketeranganlain'] != '') {
                    $ltketeranganlain = ' Liang telinga keterangan : ' . $arrtelingakiri['ltketeranganlain'];
                } else {
                    $ltketeranganlain = '';
                }

                if ($arrtelingakiri['mtketeranganlain'] != '') {
                    $mtketeranganlain = ' membaran timpan keterangan lain : ' . $arrtelingakiri['mtketeranganlain'];
                } else {
                    $mtketeranganlain = '';
                }

                if ($arrtelingakiri['mukosa'] != '') {
                    $mukosa = ' mukosa : ' . $arrtelingakiri['mukosa'];
                } else {
                    $mukosa = '';
                }

                if ($arrtelingakiri['oslkel'] != '') {
                    $oslkel = ' oslkel : ' . $arrtelingakiri['oslkel'];
                } else {
                    $oslkel = '';
                }

                if ($arrtelingakiri['Isthmus'] != '') {
                    $isthmus = ' Isthmus : ' . $arrtelingakiri['Isthmus'];
                } else {
                    $isthmus = '';
                }
                if ($arrtelingakiri['keteranganlain'] != '') {
                    $keteranganlain = ' Keterangan lain : ' . $arrtelingakiri['keteranganlain'];
                } else {
                    $keteranganlain = '';
                }
                if ($arranjurantelinga['kesimpulan'] != '') {
                    $kesimpulan = ' kesimpulan : ' . $arranjurantelinga['kesimpulan'];
                } else {
                    $kesimpulan = '';
                }
                if ($arranjurantelinga['anjuran'] != '') {
                    $anjuran = ' anjuran : ' . $arranjurantelinga['anjuran'];
                } else {
                    $anjuran = '';
                }

                $data_telinga_kiri = 'Telinga Kiri : ' . $a1 . $b1 . $c1 . $d1 . $e1 . $f1 . $g1 . $h1 . $i1 . $j1 . $ltketeranganlain . $k1 . $l1 . $m1 . $n1 . $o1 . $p1 . $q1 . $r1 . $s1 .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
                //end telinga kiri


                //hidung

                $KN_Lapang = (empty($arrhidungkanan['Lapang'])) ? '' : ' Kavum nasi lapang ';
                $KN_Sempit = (empty($arrhidungkanan['Sempit'])) ? '' : ' Kavum nasi sempit ';
                $KN_Mukosa_pucat = (empty($arrhidungkanan['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
                $KN_Mukosa_hiperemis = (empty($arrhidungkanan['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
                $KN_Mukosa_edema = (empty($arrhidungkanan['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
                $KN_Massa = (empty($arrhidungkanan['Massa'])) ? '' : ' Kavum nasi massa ';
                $KN_Polip = (empty($arrhidungkanan['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
                $KI_Eutrofi = (empty($arrhidungkanan['Eutrofi'])) ? '' : ' Konka eutrofi ';
                $KN_Hipertrofi = (empty($arrhidungkanan['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
                $KN_Atrofi = (empty($arrhidungkanan['Atrofi'])) ? '' : ' Konka atrofi ';
                $MM_Terbuka  =  (empty($arrhidungkanan['Terbuka'])) ? '' : ' Meatus medius terbuka ';
                $MM_Tertutup  =  (empty($arrhidungkanan['Tertutup'])) ? '' : ' Meatus medius tertutup ';
                $MM_Mukosa_Edema  =  (empty($arrhidungkanan['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
                $S_Polip  = (empty($arrhidungkanan['Septum Polip'])) ? '' : ' Septum polip ';
                $S_Sekret  = (empty($arrhidungkanan['Sekret'])) ? '' : ' Septum sekret ';
                $S_Lurus  = (empty($arrhidungkanan['Lurus'])) ? '' : ' Septum lurus ';
                $S_Deviasi  = (empty($arrhidungkanan['Deviasi'])) ? '' : ' Septum Deviasi ';
                $S_Spina  = (empty($arrhidungkanan['Spina'])) ? '' : ' Septum Spina ';
                $N_Normal  = (empty($arrhidungkanan['Normal'])) ? '' : ' Nasofaring Normal ';
                $N_Adenoid  = (empty($arrhidungkanan['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
                $N_Keradangan  = (empty($arrhidungkanan['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
                $N_Massa  = (empty($arrhidungkanan['Massa'])) ? '' : ' Nasofaring Massa ';
                $lain_lain  = $arrhidungkanan['lain-lain'];
                $kesimpulan  = 'Kesimpulan : ' . $arrkesimpulanhidung['kesimpulanhidung'];

                $_KN_Lapang = (empty($arrhidungkiri['Lapang'])) ? '' : ' Kavum nasi lapang ';
                $_KN_Sempit = (empty($arrhidungkiri['Sempit'])) ? '' : ' Kavum nasi sempit ';
                $_KN_Mukosa_pucat = (empty($arrhidungkiri['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
                $_KN_Mukosa_hiperemis = (empty($arrhidungkiri['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
                $_KN_Mukosa_edema = (empty($arrhidungkiri['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
                $_KN_Massa = (empty($arrhidungkiri['Massa'])) ? '' : ' Kavum nasi massa ';
                $_KN_Polip = (empty($arrhidungkiri['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
                $_KI_Eutrofi = (empty($arrhidungkiri['Eutrofi'])) ? '' : ' Konka eutrofi ';
                $_KN_Hipertrofi = (empty($arrhidungkiri['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
                $_KN_Atrofi = (empty($arrhidungkiri['Atrofi'])) ? '' : ' Konka atrofi ';
                $_MM_Terbuka  =  (empty($arrhidungkiri['Terbuka'])) ? '' : ' Meatus medius terbuka ';
                $_MM_Tertutup  =  (empty($arrhidungkiri['Tertutup'])) ? '' : ' Meatus medius tertutup ';
                $_MM_Mukosa_Edema  =  (empty($arrhidungkiri['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
                $_S_Polip  = (empty($arrhidungkiri['Septum Polip'])) ? '' : ' Septum polip ';
                $_S_Sekret  = (empty($arrhidungkiri['Sekret'])) ? '' : ' Septum sekret ';
                $_S_Lurus  = (empty($arrhidungkiri['Lurus'])) ? '' : ' Septum lurus ';
                $_S_Deviasi  = (empty($arrhidungkiri['Deviasi'])) ? '' : ' Septum Deviasi ';
                $_S_Spina  = (empty($arrhidungkiri['Spina'])) ? '' : ' Septum Spina ';
                $_N_Normal  = (empty($arrhidungkiri['Normal'])) ? '' : ' Nasofaring Normal ';
                $_N_Adenoid  = (empty($arrhidungkiri['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
                $_N_Keradangan  = (empty($arrhidungkiri['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
                $_N_Massa  = (empty($arrhidungkiri['Massa'])) ? '' : ' Nasofaring Massa ';
                $_lain_lain  = $arrhidungkiri['lain-lain'];
                $_kesimpulan  = ' Kesimpulan : ' . $arrkesimpulanhidung['kesimpulanhidung'];

                $hidungkanan = 'Hidung Kanan : ' . $KN_Lapang . $KN_Sempit . $KN_Mukosa_pucat . $KN_Mukosa_pucat . $KN_Mukosa_hiperemis . $KN_Mukosa_edema . $KN_Massa . $KN_Polip . $KI_Eutrofi . $KN_Hipertrofi . $KN_Atrofi . $MM_Terbuka . $MM_Tertutup . $MM_Mukosa_Edema . $S_Polip . $S_Sekret . $S_Lurus . $S_Deviasi . $S_Spina . $N_Normal . $N_Adenoid . $N_Keradangan . $N_Massa . $lain_lain . $kesimpulan;

                $hidungkiri = 'Hidung Kiri : ' . $_KN_Lapang . $_KN_Sempit . $_KN_Mukosa_pucat . $_KN_Mukosa_pucat . $_KN_Mukosa_hiperemis . $_KN_Mukosa_edema . $_KN_Massa . $_KN_Polip . $_KI_Eutrofi . $_KN_Hipertrofi . $_KN_Atrofi . $_MM_Terbuka . $_MM_Tertutup . $_MM_Mukosa_Edema . $_S_Polip . $_S_Sekret . $_S_Lurus . $_S_Deviasi . $_S_Spina . $_N_Normal . $_N_Adenoid . $_N_Keradangan . $_N_Massa . $_lain_lain . $_kesimpulan;
                // dd($id_assesmen);
                $datatelingakanan = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'keterangan' => 'telinga kanan',
                    'LT_lapang' => (empty($arrtelingakanan['Lapang'])) ? 0 : $arrtelingakanan['Lapang'],
                    'LT_dataSetestruksi' => (empty($arrtelingakanan['Destruksi'])) ? 0 : $arrtelingakanan['Destruksi'],
                    'LT_Sempit' => (empty($arrtelingakanan['Sempit']))  ? 0 : $arrtelingakanan['Sempit'],
                    'LT_Serumen' => (empty($arrtelingakanan['Serumen']))  ? 0 : $arrtelingakanan['Serumen'],
                    'LT_Kolesteatoma' => (empty($arrtelingakanan['Kolesteatoma']))  ? 0 : $arrtelingakanan['Kolesteatoma'],
                    'LT_Sekret' => (empty($arrtelingakanan['Sekret']))  ? 0 : $arrtelingakanan['Sekret'],
                    'LT_Massa_Jaringan' => (empty($arrtelingakanan['Massa atau Jaringan']))  ? 0 : $arrtelingakanan['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($arrtelingakanan['Jamur']))  ? 0 : $arrtelingakanan['Jamur'],
                    'LT_Benda_asing' => (empty($arrtelingakanan['Benda Asing']))  ? 0 : $arrtelingakanan['Benda Asing'],
                    'LT_Lain_lain' => (empty($arrtelingakanan['LT Lain-Lain']))  ? 0 : $arrtelingakanan['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $arrtelingakanan['ltketeranganlain'],
                    'MT_intak_normal' => (empty($arrtelingakanan['Intak - Normal']))  ? 0 : $arrtelingakanan['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($arrtelingakanan['Intak - Hiperemis']))  ? 0 : $arrtelingakanan['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($arrtelingakanan['Intak - Bulging']))  ? 0 : $arrtelingakanan['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($arrtelingakanan['Intak - Retraksi']))  ? 0 : $arrtelingakanan['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($arrtelingakanan['Intak - Sklerotik']))  ? 0 : $arrtelingakanan['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($arrtelingakanan['Perforasi - Sentral']))  ? 0 : $arrtelingakanan['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($arrtelingakanan['Perforasi - Atik']))  ? 0 : $arrtelingakanan['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($arrtelingakanan['Perforasi - Marginal']))  ? 0 : $arrtelingakanan['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($arrtelingakanan['Perforasi - Lain-Lain']))  ? 0 : $arrtelingakanan['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $arrtelingakanan['mtketeranganlain'],
                    'MT_mukosa' => $arrtelingakanan['mukosa'],
                    'MT_osikal' => $arrtelingakanan['oslkel'],
                    'MT_isthmus' => $arrtelingakanan['Isthmus'],
                    'lain_lain' => $arrtelingakanan['keteranganlain'],
                    'kesimpulan' => $arranjurantelinga['kesimpulan'],
                    'anjuran' => $arranjurantelinga['anjuran'],
                    'tgl_entry' => $this->get_now()
                ];
                $datatelingakiri = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'keterangan' => 'telinga kiri',
                    'LT_lapang' => (empty($arrtelingakiri['Lapang'])) ? 0 : $arrtelingakiri['Lapang'],
                    'LT_dataSetestruksi' => (empty($arrtelingakiri['Destruksi'])) ? 0 : $arrtelingakiri['Destruksi'],
                    'LT_Sempit' => (empty($arrtelingakiri['Sempit']))  ? 0 : $arrtelingakiri['Sempit'],
                    'LT_Serumen' => (empty($arrtelingakiri['Serumen']))  ? 0 : $arrtelingakiri['Serumen'],
                    'LT_Kolesteatoma' => (empty($arrtelingakiri['Kolesteatoma']))  ? 0 : $arrtelingakiri['Kolesteatoma'],
                    'LT_Sekret' => (empty($arrtelingakiri['Sekret']))  ? 0 : $arrtelingakiri['Sekret'],
                    'LT_Massa_Jaringan' => (empty($arrtelingakiri['Massa atau Jaringan']))  ? 0 : $arrtelingakiri['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($arrtelingakiri['Jamur']))  ? 0 : $arrtelingakiri['Jamur'],
                    'LT_Benda_asing' => (empty($arrtelingakiri['Benda Asing']))  ? 0 : $arrtelingakiri['Benda Asing'],
                    'LT_Lain_lain' => (empty($arrtelingakiri['LT Lain-Lain']))  ? 0 : $arrtelingakiri['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $arrtelingakiri['ltketeranganlain'],
                    'MT_intak_normal' => (empty($arrtelingakiri['Intak - Normal']))  ? 0 : $arrtelingakiri['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($arrtelingakiri['Intak - Hiperemis']))  ? 0 : $arrtelingakiri['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($arrtelingakiri['Intak - Bulging']))  ? 0 : $arrtelingakiri['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($arrtelingakiri['Intak - Retraksi']))  ? 0 : $arrtelingakiri['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($arrtelingakiri['Intak - Sklerotik']))  ? 0 : $arrtelingakiri['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($arrtelingakiri['Perforasi - Sentral']))  ? 0 : $arrtelingakiri['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($arrtelingakiri['Perforasi - Atik']))  ? 0 : $arrtelingakiri['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($arrtelingakiri['Perforasi - Marginal']))  ? 0 : $arrtelingakiri['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($arrtelingakiri['Perforasi - Lain-Lain']))  ? 0 : $arrtelingakiri['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $arrtelingakiri['mtketeranganlain'],
                    'MT_mukosa' => $arrtelingakiri['mukosa'],
                    'MT_osikal' => $arrtelingakiri['oslkel'],
                    'MT_isthmus' => $arrtelingakiri['Isthmus'],
                    'lain_lain' => $arrtelingakiri['keteranganlain'],
                    'kesimpulan' => $arranjurantelinga['kesimpulan'],
                    'anjuran' => $arranjurantelinga['anjuran'],
                    'tgl_entry' => $this->get_now()
                ];
                $datahidungkanan = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'tgl_entry' => $this->get_now(),
                    'keterangan' => 'Hidung Kanan',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'KN_Lapang' => (empty($arrhidungkanan['Lapang'])) ? 0 : $arrhidungkanan['Lapang'],
                    'KN_Sempit' => (empty($arrhidungkanan['Sempit'])) ? 0 : $arrhidungkanan['Sempit'],
                    'KN_Mukosa_pucat' => (empty($arrhidungkanan['Mukosa Pucat'])) ? 0 : $arrhidungkanan['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($arrhidungkanan['Mukosa Hiperemis'])) ? 0 : $arrhidungkanan['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($arrhidungkanan['Kavum Nasi Mukosa Edema'])) ? 0 : $arrhidungkanan['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($arrhidungkanan['Massa'])) ? 0 : $arrhidungkanan['Massa'],
                    'KN_Polip' => (empty($arrhidungkanan['Kavum Nasi Polip'])) ? 0 : $arrhidungkanan['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($arrhidungkanan['Eutrofi'])) ? 0 : $arrhidungkanan['Eutrofi'],
                    'KI_Hipertrofi' => (empty($arrhidungkanan['Hipertrofi'])) ? 0 : $arrhidungkanan['Hipertrofi'],
                    'KI_Atrofi' => (empty($arrhidungkanan['Atrofi'])) ? 0 : $arrhidungkanan['Atrofi'],
                    'MM_Terbuka' => (empty($arrhidungkanan['Terbuka'])) ? 0 : $arrhidungkanan['Terbuka'],
                    'MM_Tertutup' => (empty($arrhidungkanan['Tertutup'])) ? 0 : $arrhidungkanan['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($arrhidungkanan['Mukosa Edema'])) ? 0 : $arrhidungkanan['Mukosa Edema'],
                    'S_Polip' => (empty($arrhidungkanan['Septum Polip'])) ? 0 : $arrhidungkanan['Septum Polip'],
                    'S_Sekret' => (empty($arrhidungkanan['Sekret'])) ? 0 : $arrhidungkanan['Sekret'],
                    'S_Lurus' => (empty($arrhidungkanan['Lurus'])) ? 0 : $arrhidungkanan['Lurus'],
                    'S_Deviasi' => (empty($arrhidungkanan['Deviasi'])) ? 0 : $arrhidungkanan['Deviasi'],
                    'S_Spina' => (empty($arrhidungkanan['Spina'])) ? 0 : $arrhidungkanan['Spina'],
                    'N_Normal' => (empty($arrhidungkanan['Normal'])) ? 0 : $arrhidungkanan['Normal'],
                    'N_Adenoid' => (empty($arrhidungkanan['Adenoid'])) ? 0 : $arrhidungkanan['Adenoid'],
                    'N_Keradangan' => (empty($arrhidungkanan['Keradangan'])) ? 0 : $arrhidungkanan['Keradangan'],
                    'N_Massa' => (empty($arrhidungkanan['Massa'])) ? 0 : $arrhidungkanan['Massa'],
                    'lain_lain' => $arrhidungkanan['lain-lain'],
                    'kesimpulan' => $arrkesimpulanhidung['kesimpulanhidung']
                ];
                $datahidungkiri = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'tgl_entry' => $this->get_now(),
                    'keterangan' => 'Hidung Kiri',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'KN_Lapang' => (empty($arrhidungkiri['Lapang'])) ? 0 : $arrhidungkiri['Lapang'],
                    'KN_Sempit' => (empty($arrhidungkiri['Sempit'])) ? 0 : $arrhidungkiri['Sempit'],
                    'KN_Mukosa_pucat' => (empty($arrhidungkiri['Mukosa Pucat'])) ? 0 : $arrhidungkiri['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($arrhidungkiri['Mukosa Hiperemis'])) ? 0 : $arrhidungkiri['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($arrhidungkiri['Kavum Nasi Mukosa Edema'])) ? 0 : $arrhidungkiri['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($arrhidungkiri['Massa'])) ? 0 : $arrhidungkiri['Massa'],
                    'KN_Polip' => (empty($arrhidungkiri['Kavum Nasi Polip'])) ? 0 : $arrhidungkiri['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($arrhidungkiri['Eutrofi'])) ? 0 : $arrhidungkiri['Eutrofi'],
                    'KI_Hipertrofi' => (empty($arrhidungkiri['Hipertrofi'])) ? 0 : $arrhidungkiri['Hipertrofi'],
                    'KI_Atrofi' => (empty($arrhidungkiri['Atrofi'])) ? 0 : $arrhidungkiri['Atrofi'],
                    'MM_Terbuka' => (empty($arrhidungkiri['Terbuka'])) ? 0 : $arrhidungkiri['Terbuka'],
                    'MM_Tertutup' => (empty($arrhidungkiri['Tertutup'])) ? 0 : $arrhidungkiri['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($arrhidungkiri['Mukosa Edema'])) ? 0 : $arrhidungkiri['Mukosa Edema'],
                    'S_Polip' => (empty($arrhidungkiri['Septum Polip'])) ? 0 : $arrhidungkiri['Septum Polip'],
                    'S_Sekret' => (empty($arrhidungkiri['Sekret'])) ? 0 : $arrhidungkiri['Sekret'],
                    'S_Lurus' => (empty($arrhidungkiri['Lurus'])) ? 0 : $arrhidungkiri['Lurus'],
                    'S_Deviasi' => (empty($arrhidungkiri['Deviasi'])) ? 0 : $arrhidungkiri['Deviasi'],
                    'S_Spina' => (empty($arrhidungkiri['Spina'])) ? 0 : $arrhidungkiri['Spina'],
                    'N_Normal' => (empty($arrhidungkiri['Normal'])) ? 0 : $arrhidungkiri['Normal'],
                    'N_Adenoid' => (empty($arrhidungkiri['Adenoid'])) ? 0 : $arrhidungkiri['Adenoid'],
                    'N_Keradangan' => (empty($arrhidungkiri['Keradangan'])) ? 0 : $arrhidungkiri['Keradangan'],
                    'N_Massa' => (empty($arrhidungkiri['Massa'])) ? 0 : $arrhidungkiri['Massa'],
                    'lain_lain' => $arrhidungkiri['lain-lain'],
                    'kesimpulan' => $arrkesimpulanhidung['kesimpulanhidung']
                ];
                $hasilpemeriksaan = $data_telinga_kanan . ' | ' . $data_telinga_kiri . ' | ' . $hidungkanan . ' | ' . $hidungkiri;
                $cektelingakanan = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'telinga kanan']);
                $cektelingakiri = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'telinga kiri']);
                $cekhidungkanan = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'Hidung Kanan']);
                $cekhidungkiri = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'Hidung Kiri']);
                $data_telinga = ['gambar_1' => $request->gambar, 'pemeriksaan_khusus' => $hasilpemeriksaan];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($data_telinga);
                if (count($cektelingakanan) > 0) {
                    ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'telinga kanan'))->update($datatelingakanan);
                } else {
                    ermtht_telinga::create($datatelingakanan);
                }
                if (count($cektelingakiri) > 0) {
                    ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'telinga kiri'))->update($datatelingakiri);
                } else {
                    ermtht_telinga::create($datatelingakiri);
                }

                if (count($cekhidungkanan) > 0) {
                    erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'Hidung Kanan'))->update($datahidungkanan);
                } else {
                    erm_tht_hidung::create($datahidungkanan);
                }
                if (count($cekhidungkiri) > 0) {
                    erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'Hidung Kiri'))->update($datahidungkiri);
                } else {
                    erm_tht_hidung::create($datahidungkiri);
                }
            } else {
                $datagambar = ['gambar_1' => $gambar];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($datagambar);
            }
            ts_kunjungan::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update([
                'kode_paramedis' => auth()->user()->kode_paramedis
            ]);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanpemeriksaandokter_2(Request $request)
    {
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        $data3 = json_decode($_POST['data3'], true);
        $data4 = json_decode($_POST['data4'], true);
        $formorder_lab = json_decode($_POST['formorder_lab'], true);
        $formtindakan_rad = json_decode($_POST['formtindakan_rad'], true);
        $datatindakan = json_decode($_POST['datatindakan'], true);
        $datatindaklanjut = json_decode($_POST['datatindaklanjut'], true);
        $formobat_farmasi = json_decode($_POST['formobat_farmasi'], true);
        $formobatfarmasi2 = json_decode($_POST['formobatfarmasi2'], true);
        if (count($datatindaklanjut) == 1) {
            $data = [
                'kode' => 500,
                'message' => 'Tindak lanjut pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($datatindaklanjut as $nama_1) {
            $index =  $nama_1['name'];
            $value =  $nama_1['value'];
            $dataSet_tindaklanjut[$index] = $value;
        }
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_1[$index] = $value;
        }
        foreach ($data2 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_2[$index] = $value;
        }
        foreach ($data3 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_3[$index] = $value;
        }
        foreach ($data4 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_4[$index] = $value;
        }
        $id_asskep = $dataSet_1['idasskep'];
        $diagnosakerja = preg_replace("/[^A-Za-z]/", "", $dataSet_3['diagnosakerja']);
        $cekdiagnosa =  strlen($diagnosakerja);
        $cekorderfarmasi = preg_replace("/[^A-Za-z]/", "", $request->resepobat);
        $cekorderfar =  strlen($cekorderfarmasi);
        if ($cekdiagnosa == '0') {
            $data = [
                'kode' => 500,
                'message' => 'Harap isi diagnosa pasien !'
            ];
            echo json_encode($data);
            die;
        }
        // ($dataSet['diagnosakerja']
        $simpantemplate = $request->simpantemplate;
        if (empty($dataSet_1['hipertensi'])) {
            $hipertensi = 0;
        } else {
            $hipertensi = $dataSet_1['hipertensi'];
        };
        if (empty($dataSet_1['kencingmanis'])) {
            $kencingmanis = 0;
        } else {
            $kencingmanis = $dataSet_1['kencingmanis'];
        };
        if (empty($dataSet_1['jantung'])) {
            $jantung = 0;
        } else {
            $jantung = $dataSet_1['jantung'];
        };
        if (empty($dataSet_1['stroke'])) {
            $stroke = 0;
        } else {
            $stroke = $dataSet_1['stroke'];
        };
        if (empty($dataSet_1['hepatitis'])) {
            $hepatitis = 0;
        } else {
            $hepatitis = $dataSet_1['hepatitis'];
        };
        if (empty($dataSet_1['asthma'])) {
            $asthma = 0;
        } else {
            $asthma = $dataSet_1['asthma'];
        };
        if (empty($dataSet_1['ginjal'])) {
            $ginjal = 0;
        } else {
            $ginjal = $dataSet_1['ginjal'];
        };
        if (empty($dataSet_1['tb'])) {
            $tb = 0;
        } else {
            $tb = $dataSet_1['tb'];
        };
        if (empty($dataSet_1['riwayatlain'])) {
            $riwayatlain = 0;
        } else {
            $riwayatlain = $dataSet_1['riwayatlain'];
            if ($dataSet_1['ketriwayatlain'] == '') {
                $data = [
                    'kode' => 502,
                    'message' => 'Isi keterangan riwayat lain ...'
                ];
                echo json_encode($data);
                die;
            }
        };
        if ($dataSet_2['kesadaran'] == 'Composmentis') {
            $kesadaran = 'Composmentis';
        } else {
            $kesadaran = $dataSet_2['keterangankesadaran'];
        }

        $data = [
            'counter' => $dataSet_1['counter'],
            'kode_unit' => $dataSet_1['unit'],
            'id_kunjungan' => $dataSet_1['kodekunjungan'],
            'id_pasien' => $dataSet_1['nomorrm'],
            'id_asskep' => $dataSet_1['idasskep'],
            'pic' => auth()->user()->id,
            'nama_dokter' => auth()->user()->nama,
            'tgl_kunjungan' => $dataSet_1['tanggalkunjungan'],
            'tgl_pemeriksaan' => $this->get_now(),
            'sumber_data' => $dataSet_1['sumberdata'],
            'tekanan_darah' => $dataSet_2['tekanandarah'],
            'frekuensi_nadi' => $dataSet_2['frekuensinadi'],
            'frekuensi_nafas' => $dataSet_2['frekuensinafas'],
            'beratbadan' => $dataSet_2['beratbadan'],
            'suhu_tubuh' => $dataSet_2['suhutubuh'],
            'riwayat_alergi' =>  $dataSet_1['alergi'],
            'keterangan_alergi' =>  $dataSet_1['ketalergi'],
            'riwayat_kehamilan_pasien_wanita' => $dataSet_1['riwayatkehamilan'],
            'riwyat_kelahiran_pasien_anak' => $dataSet_1['riwayatkelahiran'],
            'riwyat_penyakit_sekarang' => $dataSet_1['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'ket_riwayatlain' => $dataSet_1['ketriwayatlain'],
            'statusgeneralis' => $dataSet_1['statusgeneralis'],
            'pemeriksaan_fisik' => $dataSet_2['pemeriksaanfisik'],
            'keadaanumum' => $dataSet_2['keadaanumum'],
            'kesadaran' => $dataSet_2['kesadaran'],
            'diagnosakerja' => trim($dataSet_3['diagnosakerja']),
            'diagnosabanding' => $dataSet_3['diagnosabanding'],
            'rencanakerja' => trim($dataSet_4['rencanakerja']),
            'tindakanmedis' => trim($dataSet_4['tindakanmedis']),
            'keluhan_pasien' => trim($dataSet_1['keluhanutama']),
            'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
            'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
            'keterangan_tindak_lanjut_2' => trim($dataSet_3['jawabankonsul']),
            'umur' => $dataSet_2['usia'],
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'signature' => '',
            'evaluasi' => $request->hasilexpertisi
        ];
        $nomorrm = $dataSet_1['nomorrm'];
        $diagnosakerja = $dataSet_4['rencanakerja'];
        try {
            $data_k = [
                'keluhanutama' =>  trim($dataSet_1['keluhanutama'])
            ];
            assesmenawalperawat::whereRaw('id = ?', array($dataSet_1['idasskep']))->update($data_k);
            $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet_1['tanggalkunjungan'], $dataSet_1['nomorrm'], $dataSet_1['unit']]);
            $kodekunjungan = $dataSet_1['kodekunjungan'];
            if (count($cek) > 0) {
                $data = [
                    'counter' => $dataSet_1['counter'],
                    'kode_unit' => $dataSet_1['unit'],
                    'id_kunjungan' => $dataSet_1['kodekunjungan'],
                    'id_pasien' => $dataSet_1['nomorrm'],
                    'id_asskep' => $dataSet_1['idasskep'],
                    'pic' => auth()->user()->id,
                    'nama_dokter' => auth()->user()->nama,
                    'tgl_kunjungan' => $dataSet_1['tanggalkunjungan'],
                    'updated_at' => $this->get_now(),
                    'sumber_data' => $dataSet_1['sumberdata'],
                    'tekanan_darah' => $dataSet_2['tekanandarah'],
                    'frekuensi_nadi' => $dataSet_2['frekuensinadi'],
                    'frekuensi_nafas' => $dataSet_2['frekuensinafas'],
                    'suhu_tubuh' => $dataSet_2['suhutubuh'],
                    'riwayat_alergi' =>  $dataSet_1['alergi'],
                    'keterangan_alergi' =>  $dataSet_1['ketalergi'],
                    'riwayat_kehamilan_pasien_wanita' => $dataSet_1['riwayatkehamilan'],
                    'riwyat_kelahiran_pasien_anak' => $dataSet_1['riwayatkelahiran'],
                    'riwyat_penyakit_sekarang' => $dataSet_1['riwayatpenyakitsekarang'],
                    'hipertensi' => $hipertensi,
                    'kencingmanis' => $kencingmanis,
                    'jantung' => $jantung,
                    'stroke' => $stroke,
                    'hepatitis' => $hepatitis,
                    'asthma' => $asthma,
                    'ginjal' => $ginjal,
                    'tbparu' => $tb,
                    'riwayatlain' => $riwayatlain,
                    'ket_riwayatlain' => $dataSet_1['ketriwayatlain'],
                    'statusgeneralis' => $dataSet_1['statusgeneralis'],
                    'pemeriksaan_fisik' => $dataSet_2['pemeriksaanfisik'],
                    'keadaanumum' => $dataSet_2['keadaanumum'],
                    'kesadaran' => $kesadaran,
                    'diagnosakerja' => trim($dataSet_3['diagnosakerja']),
                    'diagnosabanding' => $dataSet_3['diagnosabanding'],
                    'rencanakerja' => trim($dataSet_4['rencanakerja']),
                    'keluhan_pasien' => trim($dataSet_1['keluhanutama']),
                    'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
                    'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
                    'keterangan_tindak_lanjut_2' => trim($dataSet_3['jawabankonsul']),
                    'status' => '0',
                    'signature' => '',
                    'evaluasi' => $request->hasilexpertisi
                ];
                assesmenawaldokter::whereRaw('id_pasien = ? and kode_unit = ? and id_kunjungan = ?', array($dataSet_1['nomorrm'],  $dataSet_1['unit'], $dataSet_1['kodekunjungan']))->update($data);
                $id_assesmen = $cek[0]->id;
            } else {
                $erm_assesmen = assesmenawaldokter::create($data);
                $id_assesmen = $erm_assesmen->id;
            }

            //input tindakan
            $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
            if (count($datatindakan) > 0) {
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]));
                $kodekunjungan = $dataSet_1['kodekunjungan'];
                $penjamin = $kunjungan[0]->kode_penjamin;
                $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
                $prefix_kunjungan = $unit[0]->prefix_unit;
                foreach ($datatindakan as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan[] = $dataSet;
                    }
                }

                try {
                    $kode_unit = $kunjungan[0]->kode_unit;
                    //dummy
                    $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
                    $kode_layanan_header = $r[0]->no_trx_layanan;
                    if ($kode_layanan_header == "") {
                        $year = date('y');
                        $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                        //dummy
                        DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
                    }
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_unit' => $kunjungan['0']->kode_unit,
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
                    foreach ($arrayindex_tindakan as $d) {
                        if ($penjamin == 'P01') {
                            $tagihanpenjamin = 0;
                            $tagihanpribadi = $d['tarif'] * $d['qty'];
                        } else {
                            $tagihanpenjamin = $d['tarif'] * $d['qty'];
                            $tagihanpribadi = 0;
                        }
                        $total_tarif = $d['tarif'] * $d['qty'];
                        $id_detail = $this->createLayanandetail();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_tarif_detail' => $d['kodelayanan'],
                            'total_tarif' => $d['tarif'],
                            'jumlah_layanan' => $d['qty'],
                            'diskon_layanan' => $d['disc'],
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
                    // $back = [
                    //     'kode' => 200,
                    //     'message' => ''
                    // ];
                    // echo json_encode($back);
                    // die;
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            //end of input tindakan

            if (count($formobatfarmasi2) > 1) {
                $simpantemplate = $request->simpantemplate;
                // $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
                $kodekunjungan = $request->kodekunjungan;
                $penjamin = $kunjungan[0]->kode_penjamin;
                //jika penjamin bpjs order ke dp2
                //jika penjamin umum order ke dp1
                //kodeheader dibedakan menjadi ORF
                if ($penjamin == 'P01' || $penjamin == 'P15' || $penjamin == 'P16'|| $penjamin == 'P17'|| $penjamin == 'P20'|| $penjamin == 'P22' || $penjamin == 'P28'|| $penjamin == 'P29') {
                    $unit = '4002';
                } else {
                    $unit = '4008';
                }
                $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
                $prefix_kunjungan = $mtunit[0]->prefix_unit;
                foreach ($formobatfarmasi2 as $nama) {
                    $index = $nama['name'];
                    $value = $nama['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'keterangan') {
                        $arrayindex_far[] = $dataSet;
                    }
                }
                $obatnya = '';
                foreach ($arrayindex_far as $d) {
                    if ($obatnya == '') {
                        $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                    } else {
                        $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                    }
                    $obatnya = $obatbaru;
                }
                if ($simpantemplate == 'on') {
                    if ($request->namaresep == '') {
                        $back = [
                            'kode' => 500,
                            'message' => 'Nama Resep tidak boleh kosong !'
                        ];
                        echo json_encode($back);
                        die;
                    }

                    $dataresep = [
                        'nama_resep' => $request->namaresep,
                        'keterangan' => $obatnya,
                        'user' => auth()->user()->kode_paramedis,
                        'tgl_entry' => $this->get_now()
                    ];
                    $id_resep = templateresep::create($dataresep);
                    foreach ($arrayindex_far as $d) {
                        $detailresep = [
                            'id_template' => $id_resep->id,
                            'nama_barang' => $d['namaobat'],
                            'kode_barang' => $d['kodebarang'],
                            'aturan_pakai' => $d['aturanpakai'],
                            'jumlah' => $d['jumlah'],
                            'signa' => $d['signa'],
                            'keterangan' => $d['keterangan'],
                        ];
                        $detailresep = templateresep_detail::create($detailresep);
                    }
                }
                try {
                    $kode_unit = $unit;
                    $kode_layanan_header = $this->createOrderHeader('F');
                    $data_layanan_header = [
                        'no_rm' => $kunjungan[0]->no_rm,
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_penjaminx' => $penjamin,
                        'kode_unit' => $kode_unit,
                        'kode_tipe_transaksi' => 2,
                        'pic' => auth()->user()->id,
                        'unit_pengirim' => auth()->user()->unit,
                        'tgl_periksa' => $this->get_now(),
                        'diagnosa' => $diagnosakerja,
                        'dok_kirim' => auth()->user()->kode_paramedis,
                        'status_layanan' => '3',
                        'status_retur' => 'OPN',
                        'status_pembayaran' => 'OPN',
                        'status_order' => '0',
                        'id_assdok' => $id_assesmen
                    ];
                    $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                    foreach ($arrayindex_far as $d) {
                        $id_detail = $this->createLayanandetailOrder();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'kode_barang' => $d['namaobat'],
                            'jumlah_layanan' => $d['jumlah'],
                            'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $ts_layanan_header->id,
                            'id_assdok' => $id_assesmen
                        ];
                        $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                    }
                    if ($penjamin == 'P01') {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    } else {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    }
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            //end of farmasi
            $dt = Carbon::now()->timezone('Asia/Jakarta');
            $date = $dt->toDateString();
            $time = $dt->toTimeString();
            $now = $date . ' ' . $time;
            // order ke lab
            if (count($formorder_lab) > 1) {
                foreach ($formorder_lab as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan_lab[] = $dataSet;
                    }
                }
                $penjamin = $kunjungan[0]->kode_penjamin;
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
                    'diagnosa' => $dataSet_3['diagnosakerja'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                $now = $this->get_now();
                foreach ($arrayindex_tindakan_lab as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['qty'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['qty'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodelayanan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['qty'],
                        'diskon_layanan' => $d['disc'],
                        'total_layanan' => $d['tarif'] * $d['qty'],
                        'grantotal_layanan' => $d['tarif'] * $d['qty'],
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
            // end order lab

            // order ke rad
            if (count($formtindakan_rad) > 1) {
                foreach ($formtindakan_rad as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan_rad[] = $dataSet;
                    }
                }
                $penjamin = $kunjungan[0]->kode_penjamin;
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
                    'diagnosa' => $dataSet_3['diagnosakerja'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                foreach ($arrayindex_tindakan_rad as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['qty'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['qty'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodelayanan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['qty'],
                        'diskon_layanan' => $d['disc'],
                        'total_layanan' => $d['tarif'] * $d['qty'],
                        'grantotal_layanan' => $d['tarif'] * $d['qty'],
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
            // end order lab

            //datapemeriksaankhusus
            $gambar = $request->gambar;
            //jika poli mata
            if (auth()->user()->unit == '1014') {
                $data1 = json_decode($_POST['formpemeriksaankhusus'], true);
                foreach ($data1 as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $dataSet[$index] = $value;
                }
                $datamata = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'no_rm' => $nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'tgl_entry' => $this->get_now(),
                    'status' => '0',
                    'tajampenglihatandekat' => $dataSet['hasilperiksalain'],
                    'tekananintraokular' => $dataSet['tekanan_intra_okular'],
                    'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
                    'palpebra' => $dataSet['palpebra'],
                    'konjungtiva' => $dataSet['konjungtiva'],
                    'kornea' => $dataSet['kornea'],
                    'bilikmatadepan' => $dataSet['bilik_mata_depan'],
                    'pupil' => $dataSet['pupil'],
                    'iris' => $dataSet['iris'],
                    'lensa' => $dataSet['lensa'],
                    'funduskopi' => $dataSet['funduskopi'],
                    'status_oftamologis_khusus' => $dataSet['oftamologis'],
                    'masalahmedis' => $dataSet['masalahmedis'],
                    'prognosis' => $dataSet['prognosis'],
                    'id_asskep' =>  $id_asskep
                ];

                $cekmata = DB::select('select * from erm_mata_kanan_kiri where id_asskep = ?', [$id_asskep]);
                if (count($cekmata) > 0) {
                    erm_mata_kanan_kiri::whereRaw('id_asskep = ?', array($id_asskep))->update($datamata);
                } else {
                    erm_mata_kanan_kiri::create($datamata);
                }
                $hasil_pemeriksaan_khusus = "Catatan pemeriksaan lain : " . $dataSet['hasilperiksalain'] . " | Tekanan Intra Okular : " . $dataSet['tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['palpebra'] . " | Konjungtiva : " . $dataSet['konjungtiva'] . "| Kornea : " . $dataSet['kornea'] . " | Bilik Mata Depan : " . $dataSet['bilik_mata_depan'] . " | pupil : " . $dataSet['pupil'] . " | Iris : " . $dataSet['iris'] . " | Lensa : " . $dataSet['lensa'] . " | funduskopi : " . $dataSet['funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['oftamologis'] . "| Masalah Medis : " . $dataSet['masalahmedis'] . " | Prognosis : " . $dataSet['prognosis'];
                if ($request->gambar == $this->gambar_mata() || $request->gambar == $this->gambar_mata_2() || $request->gambar == $this->blank_img() || $request->gambar == $this->another_img()) {
                    $gambar = '';
                }
                $data_mata = ['gambar_1' => $gambar, 'pemeriksaan_khusus' => $hasil_pemeriksaan_khusus];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($data_mata);
            } elseif (auth()->user()->unit == '1019') {
                $telingakanan = json_decode($_POST['formtelingakanan'], true);
                $telingakiri = json_decode($_POST['formtelingakiri'], true);
                $anjurantelinga = json_decode($_POST['formanjurantelinga'], true);
                $hidungkanan = json_decode($_POST['formhidungkanan'], true);
                $hidungkiri = json_decode($_POST['formhidungkiri'], true);
                $kseimpulanhidung = json_decode($_POST['formkesimpulanhidung'], true);
                foreach ($telingakanan as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrtelingakanan[$index] = $value;
                }
                foreach ($telingakiri as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrtelingakiri[$index] = $value;
                }
                foreach ($anjurantelinga as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arranjurantelinga[$index] = $value;
                }
                foreach ($hidungkanan as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrhidungkanan[$index] = $value;
                }
                foreach ($hidungkiri as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrhidungkiri[$index] = $value;
                }
                foreach ($kseimpulanhidung as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $arrkesimpulanhidung[$index] = $value;
                }
                //telinga kanan
                (empty($arrtelingakanan['Lapang'])) ? $a = '' : $a = ' Liang Telinga - lapang';
                (empty($arrtelingakanan['Destruksi'])) ? $b = '' : $b = ' Liang Telinga - Destruksi';
                (empty($arrtelingakanan['Sempit']))  ? $c = '' : $c = ' Liang Telinga - Sempit';
                (empty($arrtelingakanan['Serumen']))  ? $d = '' : $d = ' Liang Telinga - Serumen';
                (empty($arrtelingakanan['Kolesteatoma']))  ? $e = '' : $e = ' Liang Telinga - Kolesteatoma';
                (empty($arrtelingakanan['Sekret']))  ? $f = '' : $f = ' Liang Telinga - Sekret';
                (empty($arrtelingakanan['Massa atau Jaringan']))  ? $g = '' : $g = ' Liang Telinga - Massa atau Jaringan';
                (empty($arrtelingakanan['Jamur']))  ? $h = '' : $h = ' Liang Telinga - Jamur';
                (empty($arrtelingakanan['Benda Asing']))  ? $i = '' : $i = ' Liang Telinga - Benda Asing';
                (empty($arrtelingakanan['LT Lain-Lain']))  ? $j = '' : $j = ' Liang Telinga - Lain - lain';

                (empty($arrtelingakanan['Intak - Normal']))  ? $k = '' : $k = ' Intak - Normal';
                (empty($arrtelingakanan['Intak - Hiperemis']))  ? $l = '' : $l = ' Intak - Hiperemis';
                (empty($arrtelingakanan['Intak - Bulging']))  ? $m = '' : $m = ' Intak - Bulging';
                (empty($arrtelingakanan['Intak - Retraksi']))  ? $n = '' : $n = ' Intak - Retraksi';
                (empty($arrtelingakanan['Intak - Sklerotik']))  ? $o = '' : $o = ' Intak - Sklerotik';
                (empty($arrtelingakanan['Perforasi - Sentral']))  ? $p = '' : $p = ' Perforasi - Sentral';
                (empty($arrtelingakanan['Perforasi - Atik']))  ? $q = '' : $q = ' Perforasi - Atik';
                (empty($arrtelingakanan['Perforasi - Marginal']))  ? $r = '' : $r = ' Perforasi - Marginal';
                (empty($arrtelingakanan['Perforasi - Lain-Lain']))  ? $s = '' : $s = ' Perforasi - Lain-Lain';

                if ($arrtelingakanan['ltketeranganlain'] != '') {
                    $ltketeranganlain = ' Liang telinga keterangan : ' . $arrtelingakanan['ltketeranganlain'];
                } else {
                    $ltketeranganlain = '';
                }

                if ($arrtelingakanan['mtketeranganlain'] != '') {
                    $mtketeranganlain = ' membaran timpan keterangan lain : ' . $arrtelingakanan['mtketeranganlain'];
                } else {
                    $mtketeranganlain = '';
                }

                if ($arrtelingakanan['mukosa'] != '') {
                    $mukosa = ' mukosa : ' . $arrtelingakanan['mukosa'];
                } else {
                    $mukosa = '';
                }

                if ($arrtelingakanan['oslkel'] != '') {
                    $oslkel = ' oslkel : ' . $arrtelingakanan['oslkel'];
                } else {
                    $oslkel = '';
                }

                if ($arrtelingakanan['Isthmus'] != '') {
                    $isthmus = ' Isthmus : ' . $arrtelingakanan['Isthmus'];
                } else {
                    $isthmus = '';
                }
                if ($arrtelingakanan['keteranganlain'] != '') {
                    $keteranganlain = ' Keterangan lain : ' . $arrtelingakanan['keteranganlain'];
                } else {
                    $keteranganlain = '';
                }
                if ($arranjurantelinga['kesimpulan'] != '') {
                    $kesimpulan = ' kesimpulan : ' . $arranjurantelinga['kesimpulan'];
                } else {
                    $kesimpulan = '';
                }
                if ($arranjurantelinga['anjuran'] != '') {
                    $anjuran = ' anjuran : ' . $arranjurantelinga['anjuran'];
                } else {
                    $anjuran = '';
                }

                $data_telinga_kanan = 'Telinga Kanan : ' . $a . $b . $c . $d . $e . $f . $g . $h . $i . $j . $ltketeranganlain . $k . $l . $m . $n . $o . $p . $q . $r . $s .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
                //end telinga kanan


                //telinga kiri
                (empty($arrtelingakiri['Lapang'])) ? $a1 = '' : $a1 = ' Liang Telinga - lapang';
                (empty($arrtelingakiri['Destruksi'])) ? $b1 = '' : $b1 = ' Liang Telinga - Destruksi';
                (empty($arrtelingakiri['Sempit']))  ? $c1 = '' : $c1 = ' Liang Telinga - Sempit';
                (empty($arrtelingakiri['Serumen']))  ? $d1 = '' : $d1 = ' Liang Telinga - Serumen';
                (empty($arrtelingakiri['Kolesteatoma']))  ? $e1 = '' : $e1 = ' Liang Telinga - Kolesteatoma';
                (empty($arrtelingakiri['Sekret']))  ? $f1 = '' : $f1 = ' Liang Telinga - Sekret';
                (empty($arrtelingakiri['Massa atau Jaringan']))  ? $g1 = '' : $g1 = ' Liang Telinga - Massa atau Jaringan';
                (empty($arrtelingakiri['Jamur']))  ? $h1 = '' : $h1 = ' Liang Telinga - Jamur';
                (empty($arrtelingakiri['Benda Asing']))  ? $i1 = '' : $i1 = ' Liang Telinga - Benda Asing';
                (empty($arrtelingakiri['LT Lain-Lain']))  ? $j1 = '' : $j1 = ' Liang Telinga - Lain - lain';

                (empty($arrtelingakiri['Intak - Normal']))  ? $k1 = '' : $k1 = ' Intak - Normal';
                (empty($arrtelingakiri['Intak - Hiperemis']))  ? $l1 = '' : $l1 = ' Intak - Hiperemis';
                (empty($arrtelingakiri['Intak - Bulging']))  ? $m1 = '' : $m1 = ' Intak - Bulging';
                (empty($arrtelingakiri['Intak - Retraksi']))  ? $n1 = '' : $n1 = ' Intak - Retraksi';
                (empty($arrtelingakiri['Intak - Sklerotik']))  ? $o1 = '' : $o1 = ' Intak - Sklerotik';
                (empty($arrtelingakiri['Perforasi - Sentral']))  ? $p1 = '' : $p1 = ' Perforasi - Sentral';
                (empty($arrtelingakiri['Perforasi - Atik']))  ? $q1 = '' : $q1 = ' Perforasi - Atik';
                (empty($arrtelingakiri['Perforasi - Marginal']))  ? $r1 = '' : $r1 = ' Perforasi - Marginal';
                (empty($arrtelingakiri['Perforasi - Lain-Lain']))  ? $s1 = '' : $s1 = ' Perforasi - Lain-Lain';

                if ($arrtelingakiri['ltketeranganlain'] != '') {
                    $ltketeranganlain = ' Liang telinga keterangan : ' . $arrtelingakiri['ltketeranganlain'];
                } else {
                    $ltketeranganlain = '';
                }

                if ($arrtelingakiri['mtketeranganlain'] != '') {
                    $mtketeranganlain = ' membaran timpan keterangan lain : ' . $arrtelingakiri['mtketeranganlain'];
                } else {
                    $mtketeranganlain = '';
                }

                if ($arrtelingakiri['mukosa'] != '') {
                    $mukosa = ' mukosa : ' . $arrtelingakiri['mukosa'];
                } else {
                    $mukosa = '';
                }

                if ($arrtelingakiri['oslkel'] != '') {
                    $oslkel = ' oslkel : ' . $arrtelingakiri['oslkel'];
                } else {
                    $oslkel = '';
                }

                if ($arrtelingakiri['Isthmus'] != '') {
                    $isthmus = ' Isthmus : ' . $arrtelingakiri['Isthmus'];
                } else {
                    $isthmus = '';
                }
                if ($arrtelingakiri['keteranganlain'] != '') {
                    $keteranganlain = ' Keterangan lain : ' . $arrtelingakiri['keteranganlain'];
                } else {
                    $keteranganlain = '';
                }
                if ($arranjurantelinga['kesimpulan'] != '') {
                    $kesimpulan = ' kesimpulan : ' . $arranjurantelinga['kesimpulan'];
                } else {
                    $kesimpulan = '';
                }
                if ($arranjurantelinga['anjuran'] != '') {
                    $anjuran = ' anjuran : ' . $arranjurantelinga['anjuran'];
                } else {
                    $anjuran = '';
                }

                $data_telinga_kiri = 'Telinga Kiri : ' . $a1 . $b1 . $c1 . $d1 . $e1 . $f1 . $g1 . $h1 . $i1 . $j1 . $ltketeranganlain . $k1 . $l1 . $m1 . $n1 . $o1 . $p1 . $q1 . $r1 . $s1 .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
                //end telinga kiri


                //hidung

                $KN_Lapang = (empty($arrhidungkanan['Lapang'])) ? '' : ' Kavum nasi lapang ';
                $KN_Sempit = (empty($arrhidungkanan['Sempit'])) ? '' : ' Kavum nasi sempit ';
                $KN_Mukosa_pucat = (empty($arrhidungkanan['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
                $KN_Mukosa_hiperemis = (empty($arrhidungkanan['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
                $KN_Mukosa_edema = (empty($arrhidungkanan['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
                $KN_Massa = (empty($arrhidungkanan['Massa'])) ? '' : ' Kavum nasi massa ';
                $KN_Polip = (empty($arrhidungkanan['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
                $KI_Eutrofi = (empty($arrhidungkanan['Eutrofi'])) ? '' : ' Konka eutrofi ';
                $KN_Hipertrofi = (empty($arrhidungkanan['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
                $KN_Atrofi = (empty($arrhidungkanan['Atrofi'])) ? '' : ' Konka atrofi ';
                $MM_Terbuka  =  (empty($arrhidungkanan['Terbuka'])) ? '' : ' Meatus medius terbuka ';
                $MM_Tertutup  =  (empty($arrhidungkanan['Tertutup'])) ? '' : ' Meatus medius tertutup ';
                $MM_Mukosa_Edema  =  (empty($arrhidungkanan['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
                $S_Polip  = (empty($arrhidungkanan['Septum Polip'])) ? '' : ' Septum polip ';
                $S_Sekret  = (empty($arrhidungkanan['Sekret'])) ? '' : ' Septum sekret ';
                $S_Lurus  = (empty($arrhidungkanan['Lurus'])) ? '' : ' Septum lurus ';
                $S_Deviasi  = (empty($arrhidungkanan['Deviasi'])) ? '' : ' Septum Deviasi ';
                $S_Spina  = (empty($arrhidungkanan['Spina'])) ? '' : ' Septum Spina ';
                $N_Normal  = (empty($arrhidungkanan['Normal'])) ? '' : ' Nasofaring Normal ';
                $N_Adenoid  = (empty($arrhidungkanan['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
                $N_Keradangan  = (empty($arrhidungkanan['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
                $N_Massa  = (empty($arrhidungkanan['Massa'])) ? '' : ' Nasofaring Massa ';
                $lain_lain  = $arrhidungkanan['lain-lain'];
                $kesimpulan  = 'Kesimpulan : ' . $arrkesimpulanhidung['kesimpulanhidung'];

                $_KN_Lapang = (empty($arrhidungkiri['Lapang'])) ? '' : ' Kavum nasi lapang ';
                $_KN_Sempit = (empty($arrhidungkiri['Sempit'])) ? '' : ' Kavum nasi sempit ';
                $_KN_Mukosa_pucat = (empty($arrhidungkiri['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
                $_KN_Mukosa_hiperemis = (empty($arrhidungkiri['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
                $_KN_Mukosa_edema = (empty($arrhidungkiri['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
                $_KN_Massa = (empty($arrhidungkiri['Massa'])) ? '' : ' Kavum nasi massa ';
                $_KN_Polip = (empty($arrhidungkiri['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
                $_KI_Eutrofi = (empty($arrhidungkiri['Eutrofi'])) ? '' : ' Konka eutrofi ';
                $_KN_Hipertrofi = (empty($arrhidungkiri['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
                $_KN_Atrofi = (empty($arrhidungkiri['Atrofi'])) ? '' : ' Konka atrofi ';
                $_MM_Terbuka  =  (empty($arrhidungkiri['Terbuka'])) ? '' : ' Meatus medius terbuka ';
                $_MM_Tertutup  =  (empty($arrhidungkiri['Tertutup'])) ? '' : ' Meatus medius tertutup ';
                $_MM_Mukosa_Edema  =  (empty($arrhidungkiri['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
                $_S_Polip  = (empty($arrhidungkiri['Septum Polip'])) ? '' : ' Septum polip ';
                $_S_Sekret  = (empty($arrhidungkiri['Sekret'])) ? '' : ' Septum sekret ';
                $_S_Lurus  = (empty($arrhidungkiri['Lurus'])) ? '' : ' Septum lurus ';
                $_S_Deviasi  = (empty($arrhidungkiri['Deviasi'])) ? '' : ' Septum Deviasi ';
                $_S_Spina  = (empty($arrhidungkiri['Spina'])) ? '' : ' Septum Spina ';
                $_N_Normal  = (empty($arrhidungkiri['Normal'])) ? '' : ' Nasofaring Normal ';
                $_N_Adenoid  = (empty($arrhidungkiri['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
                $_N_Keradangan  = (empty($arrhidungkiri['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
                $_N_Massa  = (empty($arrhidungkiri['Massa'])) ? '' : ' Nasofaring Massa ';
                $_lain_lain  = $arrhidungkiri['lain-lain'];
                $_kesimpulan  = ' Kesimpulan : ' . $arrkesimpulanhidung['kesimpulanhidung'];

                $hidungkanan = 'Hidung Kanan : ' . $KN_Lapang . $KN_Sempit . $KN_Mukosa_pucat . $KN_Mukosa_pucat . $KN_Mukosa_hiperemis . $KN_Mukosa_edema . $KN_Massa . $KN_Polip . $KI_Eutrofi . $KN_Hipertrofi . $KN_Atrofi . $MM_Terbuka . $MM_Tertutup . $MM_Mukosa_Edema . $S_Polip . $S_Sekret . $S_Lurus . $S_Deviasi . $S_Spina . $N_Normal . $N_Adenoid . $N_Keradangan . $N_Massa . $lain_lain . $kesimpulan;

                $hidungkiri = 'Hidung Kiri : ' . $_KN_Lapang . $_KN_Sempit . $_KN_Mukosa_pucat . $_KN_Mukosa_pucat . $_KN_Mukosa_hiperemis . $_KN_Mukosa_edema . $_KN_Massa . $_KN_Polip . $_KI_Eutrofi . $_KN_Hipertrofi . $_KN_Atrofi . $_MM_Terbuka . $_MM_Tertutup . $_MM_Mukosa_Edema . $_S_Polip . $_S_Sekret . $_S_Lurus . $_S_Deviasi . $_S_Spina . $_N_Normal . $_N_Adenoid . $_N_Keradangan . $_N_Massa . $_lain_lain . $_kesimpulan;
                // dd($id_assesmen);
                $datatelingakanan = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'keterangan' => 'telinga kanan',
                    'LT_lapang' => (empty($arrtelingakanan['Lapang'])) ? 0 : $arrtelingakanan['Lapang'],
                    'LT_dataSetestruksi' => (empty($arrtelingakanan['Destruksi'])) ? 0 : $arrtelingakanan['Destruksi'],
                    'LT_Sempit' => (empty($arrtelingakanan['Sempit']))  ? 0 : $arrtelingakanan['Sempit'],
                    'LT_Serumen' => (empty($arrtelingakanan['Serumen']))  ? 0 : $arrtelingakanan['Serumen'],
                    'LT_Kolesteatoma' => (empty($arrtelingakanan['Kolesteatoma']))  ? 0 : $arrtelingakanan['Kolesteatoma'],
                    'LT_Sekret' => (empty($arrtelingakanan['Sekret']))  ? 0 : $arrtelingakanan['Sekret'],
                    'LT_Massa_Jaringan' => (empty($arrtelingakanan['Massa atau Jaringan']))  ? 0 : $arrtelingakanan['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($arrtelingakanan['Jamur']))  ? 0 : $arrtelingakanan['Jamur'],
                    'LT_Benda_asing' => (empty($arrtelingakanan['Benda Asing']))  ? 0 : $arrtelingakanan['Benda Asing'],
                    'LT_Lain_lain' => (empty($arrtelingakanan['LT Lain-Lain']))  ? 0 : $arrtelingakanan['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $arrtelingakanan['ltketeranganlain'],
                    'MT_intak_normal' => (empty($arrtelingakanan['Intak - Normal']))  ? 0 : $arrtelingakanan['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($arrtelingakanan['Intak - Hiperemis']))  ? 0 : $arrtelingakanan['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($arrtelingakanan['Intak - Bulging']))  ? 0 : $arrtelingakanan['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($arrtelingakanan['Intak - Retraksi']))  ? 0 : $arrtelingakanan['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($arrtelingakanan['Intak - Sklerotik']))  ? 0 : $arrtelingakanan['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($arrtelingakanan['Perforasi - Sentral']))  ? 0 : $arrtelingakanan['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($arrtelingakanan['Perforasi - Atik']))  ? 0 : $arrtelingakanan['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($arrtelingakanan['Perforasi - Marginal']))  ? 0 : $arrtelingakanan['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($arrtelingakanan['Perforasi - Lain-Lain']))  ? 0 : $arrtelingakanan['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $arrtelingakanan['mtketeranganlain'],
                    'MT_mukosa' => $arrtelingakanan['mukosa'],
                    'MT_osikal' => $arrtelingakanan['oslkel'],
                    'MT_isthmus' => $arrtelingakanan['Isthmus'],
                    'lain_lain' => $arrtelingakanan['keteranganlain'],
                    'kesimpulan' => $arranjurantelinga['kesimpulan'],
                    'anjuran' => $arranjurantelinga['anjuran'],
                    'tgl_entry' => $this->get_now()
                ];
                $datatelingakiri = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'keterangan' => 'telinga kiri',
                    'LT_lapang' => (empty($arrtelingakiri['Lapang'])) ? 0 : $arrtelingakiri['Lapang'],
                    'LT_dataSetestruksi' => (empty($arrtelingakiri['Destruksi'])) ? 0 : $arrtelingakiri['Destruksi'],
                    'LT_Sempit' => (empty($arrtelingakiri['Sempit']))  ? 0 : $arrtelingakiri['Sempit'],
                    'LT_Serumen' => (empty($arrtelingakiri['Serumen']))  ? 0 : $arrtelingakiri['Serumen'],
                    'LT_Kolesteatoma' => (empty($arrtelingakiri['Kolesteatoma']))  ? 0 : $arrtelingakiri['Kolesteatoma'],
                    'LT_Sekret' => (empty($arrtelingakiri['Sekret']))  ? 0 : $arrtelingakiri['Sekret'],
                    'LT_Massa_Jaringan' => (empty($arrtelingakiri['Massa atau Jaringan']))  ? 0 : $arrtelingakiri['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($arrtelingakiri['Jamur']))  ? 0 : $arrtelingakiri['Jamur'],
                    'LT_Benda_asing' => (empty($arrtelingakiri['Benda Asing']))  ? 0 : $arrtelingakiri['Benda Asing'],
                    'LT_Lain_lain' => (empty($arrtelingakiri['LT Lain-Lain']))  ? 0 : $arrtelingakiri['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $arrtelingakiri['ltketeranganlain'],
                    'MT_intak_normal' => (empty($arrtelingakiri['Intak - Normal']))  ? 0 : $arrtelingakiri['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($arrtelingakiri['Intak - Hiperemis']))  ? 0 : $arrtelingakiri['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($arrtelingakiri['Intak - Bulging']))  ? 0 : $arrtelingakiri['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($arrtelingakiri['Intak - Retraksi']))  ? 0 : $arrtelingakiri['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($arrtelingakiri['Intak - Sklerotik']))  ? 0 : $arrtelingakiri['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($arrtelingakiri['Perforasi - Sentral']))  ? 0 : $arrtelingakiri['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($arrtelingakiri['Perforasi - Atik']))  ? 0 : $arrtelingakiri['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($arrtelingakiri['Perforasi - Marginal']))  ? 0 : $arrtelingakiri['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($arrtelingakiri['Perforasi - Lain-Lain']))  ? 0 : $arrtelingakiri['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $arrtelingakiri['mtketeranganlain'],
                    'MT_mukosa' => $arrtelingakiri['mukosa'],
                    'MT_osikal' => $arrtelingakiri['oslkel'],
                    'MT_isthmus' => $arrtelingakiri['Isthmus'],
                    'lain_lain' => $arrtelingakiri['keteranganlain'],
                    'kesimpulan' => $arranjurantelinga['kesimpulan'],
                    'anjuran' => $arranjurantelinga['anjuran'],
                    'tgl_entry' => $this->get_now()
                ];
                $datahidungkanan = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'tgl_entry' => $this->get_now(),
                    'keterangan' => 'Hidung Kanan',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'KN_Lapang' => (empty($arrhidungkanan['Lapang'])) ? 0 : $arrhidungkanan['Lapang'],
                    'KN_Sempit' => (empty($arrhidungkanan['Sempit'])) ? 0 : $arrhidungkanan['Sempit'],
                    'KN_Mukosa_pucat' => (empty($arrhidungkanan['Mukosa Pucat'])) ? 0 : $arrhidungkanan['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($arrhidungkanan['Mukosa Hiperemis'])) ? 0 : $arrhidungkanan['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($arrhidungkanan['Kavum Nasi Mukosa Edema'])) ? 0 : $arrhidungkanan['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($arrhidungkanan['Massa'])) ? 0 : $arrhidungkanan['Massa'],
                    'KN_Polip' => (empty($arrhidungkanan['Kavum Nasi Polip'])) ? 0 : $arrhidungkanan['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($arrhidungkanan['Eutrofi'])) ? 0 : $arrhidungkanan['Eutrofi'],
                    'KI_Hipertrofi' => (empty($arrhidungkanan['Hipertrofi'])) ? 0 : $arrhidungkanan['Hipertrofi'],
                    'KI_Atrofi' => (empty($arrhidungkanan['Atrofi'])) ? 0 : $arrhidungkanan['Atrofi'],
                    'MM_Terbuka' => (empty($arrhidungkanan['Terbuka'])) ? 0 : $arrhidungkanan['Terbuka'],
                    'MM_Tertutup' => (empty($arrhidungkanan['Tertutup'])) ? 0 : $arrhidungkanan['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($arrhidungkanan['Mukosa Edema'])) ? 0 : $arrhidungkanan['Mukosa Edema'],
                    'S_Polip' => (empty($arrhidungkanan['Septum Polip'])) ? 0 : $arrhidungkanan['Septum Polip'],
                    'S_Sekret' => (empty($arrhidungkanan['Sekret'])) ? 0 : $arrhidungkanan['Sekret'],
                    'S_Lurus' => (empty($arrhidungkanan['Lurus'])) ? 0 : $arrhidungkanan['Lurus'],
                    'S_Deviasi' => (empty($arrhidungkanan['Deviasi'])) ? 0 : $arrhidungkanan['Deviasi'],
                    'S_Spina' => (empty($arrhidungkanan['Spina'])) ? 0 : $arrhidungkanan['Spina'],
                    'N_Normal' => (empty($arrhidungkanan['Normal'])) ? 0 : $arrhidungkanan['Normal'],
                    'N_Adenoid' => (empty($arrhidungkanan['Adenoid'])) ? 0 : $arrhidungkanan['Adenoid'],
                    'N_Keradangan' => (empty($arrhidungkanan['Keradangan'])) ? 0 : $arrhidungkanan['Keradangan'],
                    'N_Massa' => (empty($arrhidungkanan['Massa'])) ? 0 : $arrhidungkanan['Massa'],
                    'lain_lain' => $arrhidungkanan['lain-lain'],
                    'kesimpulan' => $arrkesimpulanhidung['kesimpulanhidung']
                ];
                $datahidungkiri = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'tgl_entry' => $this->get_now(),
                    'keterangan' => 'Hidung Kiri',
                    'kode_kunjungan' => $request->kodekunjungan,
                    'KN_Lapang' => (empty($arrhidungkiri['Lapang'])) ? 0 : $arrhidungkiri['Lapang'],
                    'KN_Sempit' => (empty($arrhidungkiri['Sempit'])) ? 0 : $arrhidungkiri['Sempit'],
                    'KN_Mukosa_pucat' => (empty($arrhidungkiri['Mukosa Pucat'])) ? 0 : $arrhidungkiri['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($arrhidungkiri['Mukosa Hiperemis'])) ? 0 : $arrhidungkiri['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($arrhidungkiri['Kavum Nasi Mukosa Edema'])) ? 0 : $arrhidungkiri['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($arrhidungkiri['Massa'])) ? 0 : $arrhidungkiri['Massa'],
                    'KN_Polip' => (empty($arrhidungkiri['Kavum Nasi Polip'])) ? 0 : $arrhidungkiri['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($arrhidungkiri['Eutrofi'])) ? 0 : $arrhidungkiri['Eutrofi'],
                    'KI_Hipertrofi' => (empty($arrhidungkiri['Hipertrofi'])) ? 0 : $arrhidungkiri['Hipertrofi'],
                    'KI_Atrofi' => (empty($arrhidungkiri['Atrofi'])) ? 0 : $arrhidungkiri['Atrofi'],
                    'MM_Terbuka' => (empty($arrhidungkiri['Terbuka'])) ? 0 : $arrhidungkiri['Terbuka'],
                    'MM_Tertutup' => (empty($arrhidungkiri['Tertutup'])) ? 0 : $arrhidungkiri['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($arrhidungkiri['Mukosa Edema'])) ? 0 : $arrhidungkiri['Mukosa Edema'],
                    'S_Polip' => (empty($arrhidungkiri['Septum Polip'])) ? 0 : $arrhidungkiri['Septum Polip'],
                    'S_Sekret' => (empty($arrhidungkiri['Sekret'])) ? 0 : $arrhidungkiri['Sekret'],
                    'S_Lurus' => (empty($arrhidungkiri['Lurus'])) ? 0 : $arrhidungkiri['Lurus'],
                    'S_Deviasi' => (empty($arrhidungkiri['Deviasi'])) ? 0 : $arrhidungkiri['Deviasi'],
                    'S_Spina' => (empty($arrhidungkiri['Spina'])) ? 0 : $arrhidungkiri['Spina'],
                    'N_Normal' => (empty($arrhidungkiri['Normal'])) ? 0 : $arrhidungkiri['Normal'],
                    'N_Adenoid' => (empty($arrhidungkiri['Adenoid'])) ? 0 : $arrhidungkiri['Adenoid'],
                    'N_Keradangan' => (empty($arrhidungkiri['Keradangan'])) ? 0 : $arrhidungkiri['Keradangan'],
                    'N_Massa' => (empty($arrhidungkiri['Massa'])) ? 0 : $arrhidungkiri['Massa'],
                    'lain_lain' => $arrhidungkiri['lain-lain'],
                    'kesimpulan' => $arrkesimpulanhidung['kesimpulanhidung']
                ];

                if ($request->gambar == $this->gambar_telinga() || $request->gambar == $this->gambar_telinga_2() || $request->gambar == $this->blank_img() || $request->gambar == $this->another_img()) {
                    $gambar = '';
                } else {
                    $gambar = $request->gambar;
                }
                $hasilpemeriksaan = $data_telinga_kanan . ' | ' . $data_telinga_kiri . ' | ' . $hidungkanan . ' | ' . $hidungkiri;
                $cektelingakanan = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'telinga kanan']);
                $cektelingakiri = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'telinga kiri']);
                $cekhidungkanan = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'Hidung Kanan']);
                $cekhidungkiri = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$id_assesmen, 'Hidung Kiri']);
                $data_telinga = ['gambar_1' => $gambar, 'pemeriksaan_khusus' => $hasilpemeriksaan];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($data_telinga);
                if (count($cektelingakanan) > 0) {
                    ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'telinga kanan'))->update($datatelingakanan);
                } else {
                    ermtht_telinga::create($datatelingakanan);
                }
                if (count($cektelingakiri) > 0) {
                    ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'telinga kiri'))->update($datatelingakiri);
                } else {
                    ermtht_telinga::create($datatelingakiri);
                }

                if (count($cekhidungkanan) > 0) {
                    erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'Hidung Kanan'))->update($datahidungkanan);
                } else {
                    erm_tht_hidung::create($datahidungkanan);
                }
                if (count($cekhidungkiri) > 0) {
                    erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($id_assesmen, 'Hidung Kiri'))->update($datahidungkiri);
                } else {
                    erm_tht_hidung::create($datahidungkiri);
                }
            } else {
                // if($request->gambar == $this->gambar_lain() || $request->gambar == $this->gambar_lain_2() || $request->gambar == $this->blank_img() || $request->gambar() == $this->another_img()){
                //     $gambar = '';
                // }
                $gambar = '';
                $datagambar = ['gambar_1' => $gambar];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($datagambar);
            }
            ts_kunjungan::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update([
                'kode_paramedis' => auth()->user()->kode_paramedis
            ]);
            try {
                $di_diagnosa = [
                    'no_rm' => $dataSet_1['nomorrm'],
                    'kode_unit' => $dataSet_1['unit'],
                    'counter' => $dataSet_1['counter'],
                    'kode_kunjungan' => $dataSet_1['kodekunjungan'],
                    'pic' => 0,
                    'input_date' => $this->get_now(),
                    'diag_00' => trim($dataSet_3['diagnosakerja']),
                    'alasan_pulang' => 0,
                    'rs_rujukan' => 'ERM RAWAT JALAN',
                    'kode_paramedis' => auth()->user()->kode_paramedis,
                ];
                $cek = DB::select('select * from di_pasien_diagnosa_frunit where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
                if (count($cek) > 0) {
                    di_diagnosa::whereRaw('kode_kunjungan = ?', array($dataSet_1['kodekunjungan']))->update($di_diagnosa);
                } else {
                    di_diagnosa::create($di_diagnosa);
                }
            } catch (\Exception $e) {
                $data = [
                    'kode' => 200,
                    'message' => 'Data berhasil disimpan !'
                ];
                echo json_encode($data);
                die;
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanpemeriksaandokter_mata(Request $request)
    {

        // gambar = matakanan
        // gambar2 = matakiri
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        $data3 = json_decode($_POST['data3'], true);
        $data4 = json_decode($_POST['data4'], true);
        $formorder_lab = json_decode($_POST['formorder_lab'], true);
        $formtindakan_rad = json_decode($_POST['formtindakan_rad'], true);
        $datatindakan = json_decode($_POST['datatindakan'], true);
        $datatindaklanjut = json_decode($_POST['datatindaklanjut'], true);
        $formobat_farmasi = json_decode($_POST['formobat_farmasi'], true);
        $formobatfarmasi2 = json_decode($_POST['formobatfarmasi2'], true);
        if (count($datatindaklanjut) == 1) {
            $data = [
                'kode' => 500,
                'message' => 'Tindak lanjut pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        foreach ($datatindaklanjut as $nama_1) {
            $index =  $nama_1['name'];
            $value =  $nama_1['value'];
            $dataSet_tindaklanjut[$index] = $value;
        }
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_1[$index] = $value;
        }
        foreach ($data2 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_2[$index] = $value;
        }
        foreach ($data3 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_3[$index] = $value;
        }
        foreach ($data4 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_4[$index] = $value;
        }
        $id_asskep = $dataSet_1['idasskep'];
        $diagnosakerja = preg_replace("/[^A-Za-z]/", "", $dataSet_3['diagnosakerja']);
        $cekdiagnosa =  strlen($diagnosakerja);
        $cekorderfarmasi = preg_replace("/[^A-Za-z]/", "", $request->resepobat);
        $cekorderfar =  strlen($cekorderfarmasi);
        if ($cekdiagnosa == '0') {
            $data = [
                'kode' => 500,
                'message' => 'Harap isi diagnosa pasien !'
            ];
            echo json_encode($data);
            die;
        }
        // ($dataSet['diagnosakerja']
        $simpantemplate = $request->simpantemplate;
        if (empty($dataSet_1['hipertensi'])) {
            $hipertensi = 0;
        } else {
            $hipertensi = $dataSet_1['hipertensi'];
        };
        if (empty($dataSet_1['kencingmanis'])) {
            $kencingmanis = 0;
        } else {
            $kencingmanis = $dataSet_1['kencingmanis'];
        };
        if (empty($dataSet_1['jantung'])) {
            $jantung = 0;
        } else {
            $jantung = $dataSet_1['jantung'];
        };
        if (empty($dataSet_1['stroke'])) {
            $stroke = 0;
        } else {
            $stroke = $dataSet_1['stroke'];
        };
        if (empty($dataSet_1['hepatitis'])) {
            $hepatitis = 0;
        } else {
            $hepatitis = $dataSet_1['hepatitis'];
        };
        if (empty($dataSet_1['asthma'])) {
            $asthma = 0;
        } else {
            $asthma = $dataSet_1['asthma'];
        };
        if (empty($dataSet_1['ginjal'])) {
            $ginjal = 0;
        } else {
            $ginjal = $dataSet_1['ginjal'];
        };
        if (empty($dataSet_1['tb'])) {
            $tb = 0;
        } else {
            $tb = $dataSet_1['tb'];
        };
        if (empty($dataSet_1['riwayatlain'])) {
            $riwayatlain = 0;
        } else {
            $riwayatlain = $dataSet_1['riwayatlain'];
            if ($dataSet_1['ketriwayatlain'] == '') {
                $data = [
                    'kode' => 502,
                    'message' => 'Isi keterangan riwayat lain ...'
                ];
                echo json_encode($data);
                die;
            }
        };
        if ($dataSet_2['kesadaran'] == 'Composmentis') {
            $kesadaran = 'Composmentis';
        } else {
            $kesadaran = $dataSet_2['keterangankesadaran'];
        }

        $data = [
            'counter' => $dataSet_1['counter'],
            'kode_unit' => $dataSet_1['unit'],
            'id_kunjungan' => $dataSet_1['kodekunjungan'],
            'id_pasien' => $dataSet_1['nomorrm'],
            'id_asskep' => $dataSet_1['idasskep'],
            'pic' => auth()->user()->id,
            'nama_dokter' => auth()->user()->nama,
            'tgl_kunjungan' => $dataSet_1['tanggalkunjungan'],
            'tgl_pemeriksaan' => $this->get_now(),
            'sumber_data' => $dataSet_1['sumberdata'],
            'tekanan_darah' => $dataSet_2['tekanandarah'],
            'frekuensi_nadi' => $dataSet_2['frekuensinadi'],
            'frekuensi_nafas' => $dataSet_2['frekuensinafas'],
            'beratbadan' => $dataSet_2['beratbadan'],
            'suhu_tubuh' => $dataSet_2['suhutubuh'],
            'riwayat_alergi' =>  $dataSet_1['alergi'],
            'keterangan_alergi' =>  $dataSet_1['ketalergi'],
            'riwayat_kehamilan_pasien_wanita' => $dataSet_1['riwayatkehamilan'],
            'riwyat_kelahiran_pasien_anak' => $dataSet_1['riwayatkelahiran'],
            'riwyat_penyakit_sekarang' => $dataSet_1['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'ket_riwayatlain' => $dataSet_1['ketriwayatlain'],
            'statusgeneralis' => $dataSet_1['statusgeneralis'],
            'pemeriksaan_fisik' => $dataSet_2['pemeriksaanfisik'],
            'keadaanumum' => $dataSet_2['keadaanumum'],
            'kesadaran' => $dataSet_2['kesadaran'],
            'diagnosakerja' => trim($dataSet_3['diagnosakerja']),
            'diagnosabanding' => $dataSet_3['diagnosabanding'],
            'rencanakerja' => trim($dataSet_4['rencanakerja']),
            'tindakanmedis' => trim($dataSet_4['tindakanmedis']),
            'keluhan_pasien' => trim($dataSet_1['keluhanutama']),
            'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
            'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
            'keterangan_tindak_lanjut_2' => trim($dataSet_3['jawabankonsul']),
            'umur' => $dataSet_2['usia'],
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'signature' => '',
            'evaluasi' => $request->hasilexpertisi
        ];
        $nomorrm = $dataSet_1['nomorrm'];
        $diagnosakerja = $dataSet_4['rencanakerja'];
        try {
            $data_k = [
                'keluhanutama' =>  trim($dataSet_1['keluhanutama'])
            ];
            assesmenawalperawat::whereRaw('id = ?', array($dataSet_1['idasskep']))->update($data_k);
            $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet_1['tanggalkunjungan'], $dataSet_1['nomorrm'], $dataSet_1['unit']]);
            $kodekunjungan = $dataSet_1['kodekunjungan'];
            if (count($cek) > 0) {
                $data = [
                    'counter' => $dataSet_1['counter'],
                    'kode_unit' => $dataSet_1['unit'],
                    'id_kunjungan' => $dataSet_1['kodekunjungan'],
                    'id_pasien' => $dataSet_1['nomorrm'],
                    'id_asskep' => $dataSet_1['idasskep'],
                    'pic' => auth()->user()->id,
                    'nama_dokter' => auth()->user()->nama,
                    'tgl_kunjungan' => $dataSet_1['tanggalkunjungan'],
                    'updated_at' => $this->get_now(),
                    'sumber_data' => $dataSet_1['sumberdata'],
                    'tekanan_darah' => $dataSet_2['tekanandarah'],
                    'frekuensi_nadi' => $dataSet_2['frekuensinadi'],
                    'frekuensi_nafas' => $dataSet_2['frekuensinafas'],
                    'suhu_tubuh' => $dataSet_2['suhutubuh'],
                    'riwayat_alergi' =>  $dataSet_1['alergi'],
                    'keterangan_alergi' =>  $dataSet_1['ketalergi'],
                    'riwayat_kehamilan_pasien_wanita' => $dataSet_1['riwayatkehamilan'],
                    'riwyat_kelahiran_pasien_anak' => $dataSet_1['riwayatkelahiran'],
                    'riwyat_penyakit_sekarang' => $dataSet_1['riwayatpenyakitsekarang'],
                    'hipertensi' => $hipertensi,
                    'kencingmanis' => $kencingmanis,
                    'jantung' => $jantung,
                    'stroke' => $stroke,
                    'hepatitis' => $hepatitis,
                    'asthma' => $asthma,
                    'ginjal' => $ginjal,
                    'tbparu' => $tb,
                    'riwayatlain' => $riwayatlain,
                    'ket_riwayatlain' => $dataSet_1['ketriwayatlain'],
                    'statusgeneralis' => $dataSet_1['statusgeneralis'],
                    'pemeriksaan_fisik' => $dataSet_2['pemeriksaanfisik'],
                    'keadaanumum' => $dataSet_2['keadaanumum'],
                    'kesadaran' => $kesadaran,
                    'diagnosakerja' => trim($dataSet_3['diagnosakerja']),
                    'diagnosabanding' => $dataSet_3['diagnosabanding'],
                    'rencanakerja' => trim($dataSet_4['rencanakerja']),
                    'keluhan_pasien' => trim($dataSet_1['keluhanutama']),
                    'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
                    'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
                    'keterangan_tindak_lanjut_2' => trim($dataSet_3['jawabankonsul']),
                    'status' => '0',
                    'signature' => '',
                    'evaluasi' => $request->hasilexpertisi
                ];
                assesmenawaldokter::whereRaw('id_pasien = ? and kode_unit = ? and id_kunjungan = ?', array($dataSet_1['nomorrm'],  $dataSet_1['unit'], $dataSet_1['kodekunjungan']))->update($data);
                $id_assesmen = $cek[0]->id;
            } else {
                $erm_assesmen = assesmenawaldokter::create($data);
                $id_assesmen = $erm_assesmen->id;
            }

            //input tindakan
            $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
            if (count($datatindakan) > 0) {
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]));
                $kodekunjungan = $dataSet_1['kodekunjungan'];
                $penjamin = $kunjungan[0]->kode_penjamin;
                $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
                $prefix_kunjungan = $unit[0]->prefix_unit;
                foreach ($datatindakan as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan[] = $dataSet;
                    }
                }

                try {
                    $kode_unit = $kunjungan[0]->kode_unit;
                    //dummy
                    $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
                    $kode_layanan_header = $r[0]->no_trx_layanan;
                    if ($kode_layanan_header == "") {
                        $year = date('y');
                        $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                        //dummy
                        DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
                    }
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_unit' => $kunjungan['0']->kode_unit,
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
                    foreach ($arrayindex_tindakan as $d) {
                        if ($penjamin == 'P01') {
                            $tagihanpenjamin = 0;
                            $tagihanpribadi = $d['tarif'] * $d['qty'];
                        } else {
                            $tagihanpenjamin = $d['tarif'] * $d['qty'];
                            $tagihanpribadi = 0;
                        }
                        $total_tarif = $d['tarif'] * $d['qty'];
                        $id_detail = $this->createLayanandetail();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_tarif_detail' => $d['kodelayanan'],
                            'total_tarif' => $d['tarif'],
                            'jumlah_layanan' => $d['qty'],
                            'diskon_layanan' => $d['disc'],
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
                    // $back = [
                    //     'kode' => 200,
                    //     'message' => ''
                    // ];
                    // echo json_encode($back);
                    // die;
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            //end of input tindakan

            if (count($formobatfarmasi2) > 1) {
                $simpantemplate = $request->simpantemplate;
                // $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
                $kodekunjungan = $request->kodekunjungan;
                $penjamin = $kunjungan[0]->kode_penjamin;
                //jika penjamin bpjs order ke dp2
                //jika penjamin umum order ke dp1
                //kodeheader dibedakan menjadi ORF
                if ($penjamin == 'P01' || $penjamin == 'P15' || $penjamin == 'P16'|| $penjamin == 'P17'|| $penjamin == 'P20'|| $penjamin == 'P22' || $penjamin == 'P28'|| $penjamin == 'P29') {
                    $unit = '4002';
                } else {
                    $unit = '4008';
                }
                $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
                $prefix_kunjungan = $mtunit[0]->prefix_unit;
                foreach ($formobatfarmasi2 as $nama) {
                    $index = $nama['name'];
                    $value = $nama['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'keterangan') {
                        $arrayindex_far[] = $dataSet;
                    }
                }
                $obatnya = '';
                foreach ($arrayindex_far as $d) {
                    if ($obatnya == '') {
                        $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                    } else {
                        $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                    }
                    $obatnya = $obatbaru;
                }
                if ($simpantemplate == 'on') {
                    if ($request->namaresep == '') {
                        $back = [
                            'kode' => 500,
                            'message' => 'Nama Resep tidak boleh kosong !'
                        ];
                        echo json_encode($back);
                        die;
                    }

                    $dataresep = [
                        'nama_resep' => $request->namaresep,
                        'keterangan' => $obatnya,
                        'user' => auth()->user()->kode_paramedis,
                        'tgl_entry' => $this->get_now()
                    ];
                    $id_resep = templateresep::create($dataresep);
                    foreach ($arrayindex_far as $d) {
                        $detailresep = [
                            'id_template' => $id_resep->id,
                            'nama_barang' => $d['namaobat'],
                            'kode_barang' => $d['kodebarang'],
                            'aturan_pakai' => $d['aturanpakai'],
                            'jumlah' => $d['jumlah'],
                            'signa' => $d['signa'],
                            'keterangan' => $d['keterangan'],
                        ];
                        $detailresep = templateresep_detail::create($detailresep);
                    }
                }
                try {
                    $kode_unit = $unit;
                    $kode_layanan_header = $this->createOrderHeader('F');
                    $data_layanan_header = [
                        'no_rm' => $kunjungan[0]->no_rm,
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_penjaminx' => $penjamin,
                        'kode_unit' => $kode_unit,
                        'kode_tipe_transaksi' => 2,
                        'pic' => auth()->user()->id,
                        'unit_pengirim' => auth()->user()->unit,
                        'tgl_periksa' => $this->get_now(),
                        'diagnosa' => $diagnosakerja,
                        'dok_kirim' => auth()->user()->kode_paramedis,
                        'status_layanan' => '3',
                        'status_retur' => 'OPN',
                        'status_pembayaran' => 'OPN',
                        'status_order' => '0',
                        'id_assdok' => $id_assesmen
                    ];
                    $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                    foreach ($arrayindex_far as $d) {
                        $id_detail = $this->createLayanandetailOrder();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'kode_barang' => $d['namaobat'],
                            'jumlah_layanan' => $d['jumlah'],
                            'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $ts_layanan_header->id,
                            'id_assdok' => $id_assesmen
                        ];
                        $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                    }
                    if ($penjamin == 'P01') {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    } else {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    }
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            //end of farmasi
            $dt = Carbon::now()->timezone('Asia/Jakarta');
            $date = $dt->toDateString();
            $time = $dt->toTimeString();
            $now = $date . ' ' . $time;
            // order ke lab
            if (count($formorder_lab) > 1) {
                foreach ($formorder_lab as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan_lab[] = $dataSet;
                    }
                }
                $penjamin = $kunjungan[0]->kode_penjamin;
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
                    'diagnosa' => $dataSet_3['diagnosakerja'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                $now = $this->get_now();
                foreach ($arrayindex_tindakan_lab as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['qty'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['qty'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodelayanan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['qty'],
                        'diskon_layanan' => $d['disc'],
                        'total_layanan' => $d['tarif'] * $d['qty'],
                        'grantotal_layanan' => $d['tarif'] * $d['qty'],
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
            // end order lab

            // order ke rad
            if (count($formtindakan_rad) > 1) {
                foreach ($formtindakan_rad as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan_rad[] = $dataSet;
                    }
                }
                $penjamin = $kunjungan[0]->kode_penjamin;
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
                    'diagnosa' => $dataSet_3['diagnosakerja'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                foreach ($arrayindex_tindakan_rad as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['qty'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['qty'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodelayanan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['qty'],
                        'diskon_layanan' => $d['disc'],
                        'total_layanan' => $d['tarif'] * $d['qty'],
                        'grantotal_layanan' => $d['tarif'] * $d['qty'],
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
            // end order lab

            //datapemeriksaankhusus
            // gambar = matakanan
            // gambar2 = matakiri
            $gambar_kanan = $request->gambar;
            $gambar_kiri = $request->gambar2;
            //jika poli mata
            if (auth()->user()->unit == '1014') {
                $data1 = json_decode($_POST['formpemeriksaankhusus'], true);
                foreach ($data1 as $nama) {
                    $index =  $nama['name'];
                    $value =  $nama['value'];
                    $dataSet[$index] = $value;
                }
                $datamata = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'no_rm' => $nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'tgl_entry' => $this->get_now(),
                    'status' => '0',
                    'tajampenglihatandekat' => $dataSet['hasilpemeriksaanro'],
                    'tekananintraokular' => $dataSet['tekanan_intra_okular'] . '|' . $dataSet['kiri_tekanan_intra_okular'],
                    'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'] . '|' . $dataSet['kiri_catatan_pemeriksaan_lainnya'],
                    'palpebra' => $dataSet['palpebra'] . '|' . $dataSet['kiri_palpebra'],
                    'konjungtiva' => $dataSet['konjungtiva'] . '|' . $dataSet['kiri_konjungtiva'],
                    'kornea' => $dataSet['kornea'] . '|' . $dataSet['kiri_kornea'],
                    'bilikmatadepan' => $dataSet['bilik_mata_depan'] . '|' . $dataSet['kiri_bilik_mata_depan'],
                    'pupil' => $dataSet['pupil'] . '|' . $dataSet['kiri_pupil'],
                    'iris' => $dataSet['iris'] . '|' . $dataSet['kiri_iris'],
                    'lensa' => $dataSet['lensa'] . '|' . $dataSet['kiri_lensa'],
                    'funduskopi' => $dataSet['funduskopi'] . '|' . $dataSet['kiri_funduskopi'],
                    'status_oftamologis_khusus' => $dataSet['oftamologis'] . '|' . $dataSet['kiri_oftamologis'],
                    'masalahmedis' => $dataSet['masalahmedis'] . '|' . $dataSet['kiri_masalahmedis'],
                    'prognosis' => $dataSet['prognosis'] . '|' . $dataSet['kiri_prognosis'],
                    'id_asskep' =>  $id_asskep
                ];

                $cekmata = DB::select('select * from erm_mata_kanan_kiri where id_asskep = ?', [$id_asskep]);
                if (count($cekmata) > 0) {
                    erm_mata_kanan_kiri::whereRaw('id_asskep = ?', array($id_asskep))->update($datamata);
                } else {
                    erm_mata_kanan_kiri::create($datamata);
                }
                $hasil_pemeriksaan_khusus = "Catatan pemeriksaan lain : HASIL RO MATA : " . $dataSet['hasilpemeriksaanro'] . " MATA KIRI : | Tekanan Intra Okular : " . $dataSet['tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['palpebra'] . " | Konjungtiva : " . $dataSet['konjungtiva'] . "| Kornea : " . $dataSet['kornea'] . " | Bilik Mata Depan : " . $dataSet['bilik_mata_depan'] . " | pupil : " . $dataSet['pupil'] . " | Iris : " . $dataSet['iris'] . " | Lensa : " . $dataSet['lensa'] . " | funduskopi : " . $dataSet['funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['oftamologis'] . "| Masalah Medis : " . $dataSet['masalahmedis'] . " | Prognosis : " . $dataSet['prognosis'] . " MATA KANAN : | Tekanan Intra Okular : " . $dataSet['kiri_tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['kiri_catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['kiri_palpebra'] . " | Konjungtiva : " . $dataSet['kiri_konjungtiva'] . "| Kornea : " . $dataSet['kiri_kornea'] . " | Bilik Mata Depan : " . $dataSet['kiri_bilik_mata_depan'] . " | pupil : " . $dataSet['kiri_pupil'] . " | Iris : " . $dataSet['kiri_iris'] . " | Lensa : " . $dataSet['kiri_lensa'] . " | funduskopi : " . $dataSet['kiri_funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['kiri_oftamologis'] . "| Masalah Medis : " . $dataSet['kiri_masalahmedis'] . " | Prognosis : " . $dataSet['kiri_prognosis'];
                if ($request->gambar == $this->gambar_mata() || $request->gambar == $this->gambar_mata_2() || $request->gambar == $this->blank_img() || $request->gambar == $this->another_img()) {
                    $gambar = '';
                }
                $data_mata = ['gambar_1' => $gambar_kanan, 'gambar_2' => $gambar_kiri, 'pemeriksaan_khusus' => $hasil_pemeriksaan_khusus];
                assesmenawaldokter::whereRaw('id = ?', array($id_assesmen))->update($data_mata);
            }
            ts_kunjungan::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update([
                'kode_paramedis' => auth()->user()->kode_paramedis
            ]);
            try {
                $di_diagnosa = [
                    'no_rm' => $dataSet_1['nomorrm'],
                    'kode_unit' => $dataSet_1['unit'],
                    'counter' => $dataSet_1['counter'],
                    'kode_kunjungan' => $dataSet_1['kodekunjungan'],
                    'pic' => 0,
                    'input_date' => $this->get_now(),
                    'diag_00' => trim($dataSet_3['diagnosakerja']),
                    'alasan_pulang' => 0,
                    'rs_rujukan' => 'ERM RAWAT JALAN',
                    'kode_paramedis' => auth()->user()->kode_paramedis,
                ];
                $cek = DB::select('select * from di_pasien_diagnosa_frunit where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
                if (count($cek) > 0) {
                    di_diagnosa::whereRaw('kode_kunjungan = ?', array($dataSet_1['kodekunjungan']))->update($di_diagnosa);
                } else {
                    di_diagnosa::create($di_diagnosa);
                }
            } catch (\Exception $e) {
                $data = [
                    'kode' => 200,
                    'message' => 'Data berhasil disimpan !'
                ];
                echo json_encode($data);
                die;
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanpemeriksaandokter_fisio(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $dataobat = json_decode($_POST['dataobat'], true);
        $datatindaklanjut = json_decode($_POST['datatindaklanjut'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($datatindaklanjut as $nama_1) {
            $index =  $nama_1['name'];
            $value =  $nama_1['value'];
            $dataSet_tindaklanjut[$index] = $value;
        }
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$kunjungan[0]->tgl_masuk, $request->nomorrm, $request->unit]);
        $assdok = [
            'id_kunjungan' => $request->kodekunjungan,
            'id_pasien' => $request->nomorrm,
            'pic' => auth()->user()->id,
            'kode_unit' => $dataSet['unit'],
            'nama_dokter' => auth()->user()->nama,
            'tgl_entry' => $this->get_now(),
            'tgl_kunjungan' => $kunjungan[0]->tgl_masuk,
            'tgl_pemeriksaan' => $this->get_now(),
            'tekanan_darah' => $dataSet['tekanandarah'],
            'frekuensi_nadi' => $dataSet['frekuensinadi'],
            'frekuensi_nafas' => $dataSet['frekuensinafas'],
            'suhu_tubuh' => $dataSet['suhutubuh'],
            'umur' => $dataSet['usia'],
            'beratbadan' => $dataSet['beratbadan'],
            'anamnesa' => $dataSet['anamnesa'],
            'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
            'diagnosakerja' => $dataSet['diagnosismedis'],
            'diagnosabanding' => $dataSet['diagnosisfungsi'],
            'rencanakerja' => $dataSet['pemeriksaanpenunjang'],
            'tatalaksana_kfr' => $dataSet['tatalaksankfr'],
            'anjuran' => $dataSet['anjuran'],
            'evaluasi' => $dataSet['evaluasi'],
            'riwayatlain' => $dataSet['supekpenyakit'],
            'ket_riwayatlain' => $dataSet['keterangansuspek'],
            'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
            'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'],
            // 'keluhan_pasien' => $dataSet['keluhanutama'],
            'keterangan_tindak_lanjut_2' => trim($dataSet['jawabankonsul']),
            'status' => '0'
        ];
        if (count($cek) > 0) {
            assesmenawaldokter::whereRaw('id_pasien = ? and kode_unit = ? and id_kunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['kodekunjungan']))->update($assdok);
            $id_assesmen = $cek[0]->id;
        } else {
            $erm_assesmen = assesmenawaldokter::create($assdok);
            $id_assesmen = $erm_assesmen->id;
        }
        $diagnosakerja = $dataSet['diagnosismedis'];
        if (count($dataobat) > 1) {
            $simpantemplate = $request->simpantemplate;
            $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
            $dt = Carbon::now()->timezone('Asia/Jakarta');
            $date = $dt->toDateString();
            $time = $dt->toTimeString();
            $now = $date . ' ' . $time;
            $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
            $kodekunjungan = $request->kodekunjungan;
            $penjamin = $kunjungan[0]->kode_penjamin;
            //jika penjamin bpjs order ke dp2
            //jika penjamin umum order ke dp1
            //kodeheader dibedakan menjadi ORF
            if ($penjamin == 'P01') {
                $unit = '4002';
            } else {
                $unit = '4008';
            }
            $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
            $prefix_kunjungan = $mtunit[0]->prefix_unit;
            foreach ($dataobat as $nama) {
                $index = $nama['name'];
                $value = $nama['value'];
                $dataSet[$index] = $value;
                if ($index == 'keterangan') {
                    $arrayindex_far[] = $dataSet;
                }
            }
            $obatnya = '';
            foreach ($arrayindex_far as $d) {
                if ($obatnya == '') {
                    $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                } else {
                    $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                }
                $obatnya = $obatbaru;
            }
            if ($simpantemplate == 'on') {
                if ($request->namaresep == '') {
                    $back = [
                        'kode' => 500,
                        'message' => 'Nama Resep tidak boleh kosong !'
                    ];
                    echo json_encode($back);
                    die;
                }

                $dataresep = [
                    'nama_resep' => $request->namaresep,
                    'keterangan' => $obatnya,
                    'user' => auth()->user()->kode_paramedis,
                    'tgl_entry' => $this->get_now()
                ];
                $id_resep = templateresep::create($dataresep);
                foreach ($arrayindex_far as $d) {
                    $detailresep = [
                        'id_template' => $id_resep->id,
                        'nama_barang' => $d['namaobat'],
                        'kode_barang' => $d['kodebarang'],
                        'aturan_pakai' => $d['aturanpakai'],
                        'jumlah' => $d['jumlah'],
                        'signa' => $d['signa'],
                        'keterangan' => $d['keterangan'],
                    ];
                    $detailresep = templateresep_detail::create($detailresep);
                }
            }
            try {
                $kode_unit = $unit;
                $kode_layanan_header = $this->createOrderHeader('F');
                $data_layanan_header = [
                    'no_rm' => $kunjungan[0]->no_rm,
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => $kode_unit,
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'tgl_periksa' => $this->get_now(),
                    'diagnosa' => $diagnosakerja,
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0',
                    'id_assdok' => $id_assesmen
                ];
                $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                foreach ($arrayindex_far as $d) {
                    $id_detail = $this->createLayanandetailOrder();
                    $save_detail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'kode_barang' => $d['namaobat'],
                        'jumlah_layanan' => $d['jumlah'],
                        'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header->id,
                        'id_assdok' => $id_assesmen
                    ];
                    $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1]);
                }
            } catch (\Exception $e) {
                $back = [
                    'kode' => 500,
                    'message' => $e->getMessage()
                ];
                echo json_encode($back);
                die;
            }
        }
        assesmenawaldokter::whereRaw('id_kunjungan = ?', array($request->kodekunjungan))->update(['signature' => '', 'status' => '0']);

        try {
            $di_diagnosa = [
                'no_rm' => $request->nomorrm,
                'kode_unit' => $dataSet['unit'],
                'counter' => $kunjungan[0]->counter,
                'kode_kunjungan' => $request->kodekunjungan,
                'pic' => 0,
                'input_date' => $this->get_now(),
                'diag_00' => trim($dataSet['diagnosismedis']),
                'alasan_pulang' => 0,
                'rs_rujukan' => 'ERM RAWAT JALAN',
                'kode_paramedis' => auth()->user()->kode_paramedis,
            ];
            $cek = DB::select('select * from di_pasien_diagnosa_frunit where kode_kunjungan = ?', [$request->kodekunjungan]);
            if (count($cek) > 0) {
                di_diagnosa::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($di_diagnosa);
            } else {
                di_diagnosa::create($di_diagnosa);
            }
        } catch (\Exception $e) {
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        }


        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanpemeriksaandokter_anesetesi(Request $request)
    {
        if (empty($dataSet['hipertensi'])) {
            $hipertensi = 0;
        } else {
            $hipertensi = $dataSet['hipertensi'];
        };

        if (empty($dataSet['kencingmanis'])) {
            $kencingmanis = 0;
        } else {
            $kencingmanis = $dataSet['kencingmanis'];
        };

        if (empty($dataSet['jantung'])) {
            $jantung = 0;
        } else {
            $jantung = $dataSet['jantung'];
        };

        if (empty($dataSet['stroke'])) {
            $stroke = 0;
        } else {
            $stroke = $dataSet['stroke'];
        };

        if (empty($dataSet['hepatitis'])) {
            $hepatitis = 0;
        } else {
            $hepatitis = $dataSet['hepatitis'];
        };

        if (empty($dataSet['asthma'])) {
            $asthma = 0;
        } else {
            $asthma = $dataSet['asthma'];
        };

        if (empty($dataSet['ginjal'])) {
            $ginjal = 0;
        } else {
            $ginjal = $dataSet['ginjal'];
        };

        if (empty($dataSet['tb'])) {
            $tb = 0;
        } else {
            $tb = $dataSet['tb'];
        };

        if (empty($dataSet['riwayatlain'])) {
            $riwayatlain = 0;
        } else {
            $riwayatlain = $dataSet['riwayatlain'];
            if ($dataSet['ketriwayatlain'] == '') {
                $data = [
                    'kode' => 502,
                    'message' => 'Isi keterangan riwayat lain ...'
                ];
                echo json_encode($data);
                die;
            }
        };

        $data = json_decode($_POST['data'], true);
        $formobatfarmasi2 = json_decode($_POST['formobatfarmasi2'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
        $data = [
            'counter' => $dataSet['counter'],
            'kode_unit' => $dataSet['unit'],
            'id_kunjungan' => $dataSet['kodekunjungan'],
            'id_pasien' => $dataSet['nomorrm'],
            'id_asskep' => $dataSet['idasskep'],
            'pic' => auth()->user()->id,
            'nama_dokter' => auth()->user()->nama,
            'tgl_kunjungan' => $dataSet['tanggalkunjungan'],
            'tgl_pemeriksaan' => $this->get_now(),
            'sumber_data' => $dataSet['sumberdata'],
            'tekanan_darah' => $dataSet['tekanandarah'],
            'frekuensi_nadi' => $dataSet['frekuensinadi'],
            'frekuensi_nafas' => $dataSet['frekuensinafas'],
            'beratbadan' => $dataSet['beratbadan'],
            'suhu_tubuh' => $dataSet['suhutubuh'],
            'riwayat_alergi' =>  $dataSet['alergi'],
            'keterangan_alergi' =>  $dataSet['ketalergi'],
            'riwayat_kehamilan_pasien_wanita' => $dataSet['riwayatkehamilan'],
            'riwyat_kelahiran_pasien_anak' => $dataSet['riwayatkelahiran'],
            'riwyat_penyakit_sekarang' => $dataSet['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'ket_riwayatlain' => $dataSet['ketriwayatlain'],
            'statusgeneralis' => $dataSet['statusgeneralis'],
            'diagnosakerja' => trim($dataSet['diagnosawd']),
            'diagnosabanding' => $dataSet['dasardiagnosa'],
            'tindak_lanjut' => $dataSet['assesmen'],
            'keterangan_tindak_lanjut' => trim($dataSet['saran']),
            'alergi' => trim($dataSet['a_alergi']),
            'medikasi' => trim($dataSet['medikasi']),
            'postillnes' => trim($dataSet['post_illnes']),
            'lastmeal' => trim($dataSet['last_meal']),
            'event' => trim($dataSet['event']),
            'cor' => trim($dataSet['cor']),
            'pulmo' => trim($dataSet['pulmo']),
            'gigi' => trim($dataSet['gigi']),
            'ekstremitas' => trim($dataSet['ekstremitas']),
            'LEMON' => trim($dataSet['L']) . ' | ' . trim($dataSet['E']) . ' | ' . trim($dataSet['M']) . ' | ' . trim($dataSet['O']) . ' | ' . trim($dataSet['N']),
            'keluhan_pasien' => trim($dataSet['keluhanutama']),
            'keterangan_tindak_lanjut_2' => trim($dataSet['jawabankonsul']),
            'umur' => $dataSet['usia'],
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'signature' => ''
        ];
        if (count($cek) > 0) {
            assesmenawaldokter::whereRaw('id_pasien = ? and kode_unit = ? and id_kunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['kodekunjungan']))->update($data);
            $id_assesmen = $cek[0]->id;
        } else {
            $erm_assesmen = assesmenawaldokter::create($data);
        }
        if (count($formobatfarmasi2) > 1) {
            $simpantemplate = $request->simpantemplate;
            $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
            $dt = Carbon::now()->timezone('Asia/Jakarta');
            $date = $dt->toDateString();
            $time = $dt->toTimeString();
            $now = $date . ' ' . $time;
            $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$dataSet['kodekunjungan']]));
            $kodekunjungan = $dataSet['kodekunjungan'];
            $penjamin = $kunjungan[0]->kode_penjamin;
            //jika penjamin bpjs order ke dp2
            //jika penjamin umum order ke dp1
            //kodeheader dibedakan menjadi ORF
            if ($penjamin == 'P01') {
                $unit = '4002';
            } else {
                $unit = '4008';
            }
            $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
            $prefix_kunjungan = $mtunit[0]->prefix_unit;
            foreach ($formobatfarmasi2 as $nama) {
                $index = $nama['name'];
                $value = $nama['value'];
                $dataSet2[$index] = $value;
                if ($index == 'keterangan') {
                    $arrayindex_far[] = $dataSet2;
                }
            }
            $obatnya = '';
            foreach ($arrayindex_far as $d) {
                if ($obatnya == '') {
                    $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                } else {
                    $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . "\n\n";
                }
                $obatnya = $obatbaru;
            }
            if ($simpantemplate == 'on') {
                if ($request->namaresep == '') {
                    $back = [
                        'kode' => 500,
                        'message' => 'Nama Resep tidak boleh kosong !'
                    ];
                    echo json_encode($back);
                    die;
                }

                $dataresep = [
                    'nama_resep' => $request->namaresep,
                    'keterangan' => $obatnya,
                    'user' => auth()->user()->kode_paramedis,
                    'tgl_entry' => $this->get_now()
                ];
                $id_resep = templateresep::create($dataresep);
                foreach ($arrayindex_far as $d) {
                    $detailresep = [
                        'id_template' => $id_resep->id,
                        'nama_barang' => $d['namaobat'],
                        'kode_barang' => $d['kodebarang'],
                        'aturan_pakai' => $d['aturanpakai'],
                        'jumlah' => $d['jumlah'],
                        'signa' => $d['signa'],
                        'keterangan' => $d['keterangan'],
                    ];
                    $detailresep = templateresep_detail::create($detailresep);
                }
            }
            try {
                $kode_unit = $unit;
                $kode_layanan_header = $this->createOrderHeader('F');
                $data_layanan_header = [
                    'no_rm' => $kunjungan[0]->no_rm,
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => $kode_unit,
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'tgl_periksa' => $this->get_now(),
                    'diagnosa' => trim($dataSet['diagnosawd']),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0',
                    'id_assdok' => $id_assesmen
                ];
                $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                foreach ($arrayindex_far as $d) {
                    $id_detail = $this->createLayanandetailOrder();
                    $save_detail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'kode_barang' => $d['namaobat'],
                        'jumlah_layanan' => $d['jumlah'],
                        'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header->id,
                        'id_assdok' => $id_assesmen
                    ];
                    $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1]);
                }
            } catch (\Exception $e) {
                $back = [
                    'kode' => 500,
                    'message' => $e->getMessage()
                ];
                echo json_encode($back);
                die;
            }
        }
        //end of farmasi

        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function resumepasien(Request $request)
    {
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ? AND no_rm = ?', [$request->kodekunjungan, $request->nomorrm]);
        if (auth()->user()->unit == '1028') {
            $riwayat_tindakan_f = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
            RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            WHERE a.`kode_kunjungan` = ? AND b.kode_unit = ?", [$request->kodekunjungan, '3009']);

            $riwayat_tindakan_w = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
            RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            WHERE a.`kode_kunjungan` = ? AND b.kode_unit = ?", [$request->kodekunjungan, '3010']);

            return view('ermperawat.resumeperawat_fisio', compact([
                'resume',
                'riwayat_tindakan_w',
                'riwayat_tindakan_f'
            ]));
        } else {
            return view('ermperawat.resumeperawat', compact([
                'resume'
            ]));
        }
    }
    public function resumepasien_dokter(Request $request)
    {
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ? AND id_pasien = ?', [$request->kodekunjungan, $request->nomorrm]);
        if (count($resume) > 0) {
            if ($resume[0]->kode_unit == '1019') {
                $kanan = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kanan']);
                $kiri = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kiri']);
                $hidungkanan = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kanan']);
                $hidungkiri = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kiri']);
                $formkhusus = [
                    'keterangan' => 'tht',
                    'telingakanan' => $kanan,
                    'cek1' => count($kanan),
                    'telingakiri' => $kiri,
                    'cek2' => count($kiri),
                    'hidungkanan' => $hidungkanan,
                    'cek3' => count($hidungkanan),
                    'hidungkiri' => $hidungkiri,
                    'cek4' => count($hidungkiri),
                ];
            } elseif ($resume[0]->kode_unit == '1014') {
                $mata = DB::SELECT('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
                $formkhusus = [
                    'keterangan' => 'mata',
                    'mata' => $mata,
                    'cek' => count($mata)
                ];
            } else if ($resume[0]->kode_unit == '1007') {
                $gigi = DB::SELECT('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
                $formkhusus = [
                    'keterangan' => 'gigi',
                    'gigi' => $gigi,
                    'cek' => count($gigi)
                ];
            } else {
                $gambar = DB::SELECT('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
                $formkhusus = [
                    'keterangan' => 'allin',
                    'gambar' => $gambar,
                    'cek' => count($gambar)
                ];
            }
        } else {
            $formkhusus = [
                'keterangan' => '',
            ];
        }
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan as status_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);

        $riwayat_order = DB::select("SELECT b.status_layanan as status_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);

        $riwayat_order_f = DB::connection('mysql4')->select("SELECT b.kode_layanan_header,b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.kode_barang,c.aturan_pakai,c.kategori_resep,c.satuan_barang,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header WHERE a.`kode_kunjungan` = ? AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$request->kodekunjungan]);
        $riwayat_upload = DB::select('select *,fc_nama_unit2(kode_unit) as nama_unit from erm_upload_gambar where kodekunjungan = ?', [$request->kodekunjungan]);
        if (count($resume) > 0) {
            if (auth()->user()->unit == '1028') {
                return view('ermdokter.resumedokter_fisio', compact([
                    'resume',
                    'riwayat_order_f'
                ]));
            } else if (auth()->user()->unit == '1026') {
                return view('ermdokter.resumedokter_anestesi', compact([
                    'resume'
                ]));
            } else {
                return view('ermdokter.resumedokter', compact([
                    'resume',
                    'formkhusus',
                    'riwayat_tindakan',
                    'riwayat_order',
                    'riwayat_upload',
                    'riwayat_order_f'
                ]));
            }
        } else {
            return view('ermtemplate.data1tidakditemukan');
        }
    }
    public function simpanttdperawat(Request $request)
    {
        $data = [
            'tanggalassemen' => $this->get_now(),
            'status' => '1',
            'signature' => 'SUDAH DIVALIDASI'
        ];
        assesmenawalperawat::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanttddokter(Request $request)
    {
        $data = [
            // 'tanggalassemen' => $this->get_now(),
            'status' => '1',
            'signature' => 'SUDAH VALIDASI'
        ];
        $data2 = [
            // 'tanggalassemen' => $this->get_now(),
            'status_order' => '1',
        ];
        assesmenawaldokter::whereRaw('id_kunjungan = ?', array($request->kodekunjungan))->update($data);
        ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_order = ?', array($request->kodekunjungan, 0))->update($data2);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function formtindakan(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        if (count($resume)  > 0) {
            return view('ermdokter.formtindakan', compact([
                'kunjungan',
                'resume',
                'layanan'
            ]));
        } else {
            return view('ermtemplate.data1tidakditemukan');
        }
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
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function simpanlayanan(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$request->kodekunjungan]));
        $kodekunjungan = $request->kodekunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }

        try {
            $kode_unit = $kunjungan[0]->kode_unit;
            //dummy
            $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                //dummy
                DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            }
            $data_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_unit' => $kunjungan['0']->kode_unit,
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
            foreach ($arrayindex as $d) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $d['tarif'] * $d['qty'];
                } else {
                    $tagihanpenjamin = $d['tarif'] * $d['qty'];
                    $tagihanpribadi = 0;
                }
                $total_tarif = $d['tarif'] * $d['qty'];
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $d['kodelayanan'],
                    'total_tarif' => $d['tarif'],
                    'jumlah_layanan' => $d['qty'],
                    'diskon_layanan' => $d['disc'],
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
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
    public function gambartht1(Request $request)
    {
        $cek1 = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.telingakanan', compact([
            'cek1'
        ]));
    }
    public function gambartht2(Request $request)
    {
        $cek1 = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.telingakiri', compact([
            'cek1'
        ]));
    }
    public function simpantht_telinga(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data2 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet2[$index] = $value;
        }

        //telinga kanan
        (empty($dataSet['Lapang'])) ? $a = '' : $a = ' Liang Telinga - lapang';
        (empty($dataSet['Destruksi'])) ? $b = '' : $b = ' Liang Telinga - Destruksi';
        (empty($dataSet['Sempit']))  ? $c = '' : $c = ' Liang Telinga - Sempit';
        (empty($dataSet['Serumen']))  ? $d = '' : $d = ' Liang Telinga - Serumen';
        (empty($dataSet['Kolesteatoma']))  ? $e = '' : $e = ' Liang Telinga - Kolesteatoma';
        (empty($dataSet['Sekret']))  ? $f = '' : $f = ' Liang Telinga - Sekret';
        (empty($dataSet['Massa atau Jaringan']))  ? $g = '' : $g = ' Liang Telinga - Massa atau Jaringan';
        (empty($dataSet['Jamur']))  ? $h = '' : $h = ' Liang Telinga - Jamur';
        (empty($dataSet['Benda Asing']))  ? $i = '' : $i = ' Liang Telinga - Benda Asing';
        (empty($dataSet['LT Lain-Lain']))  ? $j = '' : $j = ' Liang Telinga - Lain - lain';

        (empty($dataSet['Intak - Normal']))  ? $k = '' : $k = ' Intak - Normal';
        (empty($dataSet['Intak - Hiperemis']))  ? $l = '' : $l = ' Intak - Hiperemis';
        (empty($dataSet['Intak - Bulging']))  ? $m = '' : $m = ' Intak - Bulging';
        (empty($dataSet['Intak - Retraksi']))  ? $n = '' : $n = ' Intak - Retraksi';
        (empty($dataSet['Intak - Sklerotik']))  ? $o = '' : $o = ' Intak - Sklerotik';
        (empty($dataSet['Perforasi - Sentral']))  ? $p = '' : $p = ' Perforasi - Sentral';
        (empty($dataSet['Perforasi - Atik']))  ? $q = '' : $q = ' Perforasi - Atik';
        (empty($dataSet['Perforasi - Marginal']))  ? $r = '' : $r = ' Perforasi - Marginal';
        (empty($dataSet['Perforasi - Lain-Lain']))  ? $s = '' : $s = ' Perforasi - Lain-Lain';

        if ($dataSet['ltketeranganlain'] != '') {
            $ltketeranganlain = ' Liang telinga keterangan : ' . $dataSet['ltketeranganlain'];
        } else {
            $ltketeranganlain = '';
        }

        if ($dataSet['mtketeranganlain'] != '') {
            $mtketeranganlain = ' membaran timpan keterangan lain : ' . $dataSet['mtketeranganlain'];
        } else {
            $mtketeranganlain = '';
        }

        if ($dataSet['mukosa'] != '') {
            $mukosa = ' mukosa : ' . $dataSet['mukosa'];
        } else {
            $mukosa = '';
        }

        if ($dataSet['oslkel'] != '') {
            $oslkel = ' oslkel : ' . $dataSet['oslkel'];
        } else {
            $oslkel = '';
        }

        if ($dataSet['Isthmus'] != '') {
            $isthmus = ' Isthmus : ' . $dataSet['Isthmus'];
        } else {
            $isthmus = '';
        }
        if ($dataSet['keteranganlain'] != '') {
            $keteranganlain = ' Keterangan lain : ' . $dataSet['keteranganlain'];
        } else {
            $keteranganlain = '';
        }
        if ($request->kesimpulan != '') {
            $kesimpulan = ' kesimpulan : ' . $request->kesimpulan;
        } else {
            $kesimpulan = '';
        }
        if ($request->anjuran != '') {
            $anjuran = ' anjuran : ' . $request->anjuran;
        } else {
            $anjuran = '';
        }

        $data_telinga_kanan = 'Telinga Kanan : ' . $a . $b . $c . $d . $e . $f . $g . $h . $i . $j . $ltketeranganlain . $k . $l . $m . $n . $o . $p . $q . $r . $s .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
        // dd($data_telinga_kanan);
        //telinga kiri
        (empty($dataSet2['Lapang'])) ? $a1 = '' : $a1 = ' Liang Telinga - lapang';
        (empty($dataSet2['Destruksi'])) ? $b1 = '' : $b1 = ' Liang Telinga - Destruksi';
        (empty($dataSet2['Sempit']))  ? $c1 = '' : $c1 = ' Liang Telinga - Sempit';
        (empty($dataSet2['Serumen']))  ? $d1 = '' : $d1 = ' Liang Telinga - Serumen';
        (empty($dataSet2['Kolesteatoma']))  ? $e1 = '' : $e1 = ' Liang Telinga - Kolesteatoma';
        (empty($dataSet2['Sekret']))  ? $f1 = '' : $f1 = ' Liang Telinga - Sekret';
        (empty($dataSet2['Massa atau Jaringan']))  ? $g1 = '' : $g1 = ' Liang Telinga - Massa atau Jaringan';
        (empty($dataSet2['Jamur']))  ? $h1 = '' : $h1 = ' Liang Telinga - Jamur';
        (empty($dataSet2['Benda Asing']))  ? $i1 = '' : $i1 = ' Liang Telinga - Benda Asing';
        (empty($dataSet2['LT Lain-Lain']))  ? $j1 = '' : $j1 = ' Liang Telinga - Lain - lain';

        (empty($dataSet2['Intak - Normal']))  ? $k1 = '' : $k1 = ' Intak - Normal';
        (empty($dataSet2['Intak - Hiperemis']))  ? $l1 = '' : $l1 = ' Intak - Hiperemis';
        (empty($dataSet2['Intak - Bulging']))  ? $m1 = '' : $m1 = ' Intak - Bulging';
        (empty($dataSet2['Intak - Retraksi']))  ? $n1 = '' : $n1 = ' Intak - Retraksi';
        (empty($dataSet2['Intak - Sklerotik']))  ? $o1 = '' : $o1 = ' Intak - Sklerotik';
        (empty($dataSet2['Perforasi - Sentral']))  ? $p1 = '' : $p1 = ' Perforasi - Sentral';
        (empty($dataSet2['Perforasi - Atik']))  ? $q1 = '' : $q1 = ' Perforasi - Atik';
        (empty($dataSet2['Perforasi - Marginal']))  ? $r1 = '' : $r1 = ' Perforasi - Marginal';
        (empty($dataSet2['Perforasi - Lain-Lain']))  ? $s1 = '' : $s1 = ' Perforasi - Lain-Lain';

        if ($dataSet2['ltketeranganlain'] != '') {
            $ltketeranganlain = ' Liang telinga keterangan : ' . $dataSet2['ltketeranganlain'];
        } else {
            $ltketeranganlain = '';
        }

        if ($dataSet2['mtketeranganlain'] != '') {
            $mtketeranganlain = ' membaran timpan keterangan lain : ' . $dataSet2['mtketeranganlain'];
        } else {
            $mtketeranganlain = '';
        }

        if ($dataSet2['mukosa'] != '') {
            $mukosa = ' mukosa : ' . $dataSet2['mukosa'];
        } else {
            $mukosa = '';
        }

        if ($dataSet2['oslkel'] != '') {
            $oslkel = ' oslkel : ' . $dataSet2['oslkel'];
        } else {
            $oslkel = '';
        }

        if ($dataSet2['Isthmus'] != '') {
            $isthmus = ' Isthmus : ' . $dataSet2['Isthmus'];
        } else {
            $isthmus = '';
        }
        if ($dataSet2['keteranganlain'] != '') {
            $keteranganlain = ' Keterangan lain : ' . $dataSet2['keteranganlain'];
        } else {
            $keteranganlain = '';
        }
        if ($request->kesimpulan != '') {
            $kesimpulan = ' kesimpulan : ' . $request->kesimpulan;
        } else {
            $kesimpulan = '';
        }
        if ($request->anjuran != '') {
            $anjuran = ' anjuran : ' . $request->anjuran;
        } else {
            $anjuran = '';
        }

        $data_telinga_kiri = 'Telinga Kiri : ' . $a1 . $b1 . $c1 . $d1 . $e1 . $f1 . $g1 . $h1 . $i1 . $j1 . $ltketeranganlain . $k1 . $l1 . $m1 . $n1 . $o1 . $p1 . $q1 . $r1 . $s1 .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
        $datatelinga1 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'kode_kunjungan' => $kodekunjungan,
            'gambar' => $request->telingakanan,
            'keterangan' => 'telinga kanan',
            'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet['Lapang'],
            'LT_dataSetestruksi' => (empty($dataSet['Destruksi'])) ? 0 : $dataSet['Destruksi'],
            'LT_Sempit' => (empty($dataSet['Sempit']))  ? 0 : $dataSet['Sempit'],
            'LT_Serumen' => (empty($dataSet['Serumen']))  ? 0 : $dataSet['Serumen'],
            'LT_Kolesteatoma' => (empty($dataSet['Kolesteatoma']))  ? 0 : $dataSet['Kolesteatoma'],
            'LT_Sekret' => (empty($dataSet['Sekret']))  ? 0 : $dataSet['Sekret'],
            'LT_Massa_Jaringan' => (empty($dataSet['Massa atau Jaringan']))  ? 0 : $dataSet['Massa atau Jaringan'],
            'LT_Jamur' => (empty($dataSet['Jamur']))  ? 0 : $dataSet['Jamur'],
            'LT_Benda_asing' => (empty($dataSet['Benda Asing']))  ? 0 : $dataSet['Benda Asing'],
            'LT_Lain_lain' => (empty($dataSet['LT Lain-Lain']))  ? 0 : $dataSet['LT Lain-Lain'],
            'LT_Keterangan_lain' => $dataSet['ltketeranganlain'],
            'MT_intak_normal' => (empty($dataSet['Intak - Normal']))  ? 0 : $dataSet['Intak - Normal'],
            'MT_intak_hiperemis' => (empty($dataSet['Intak - Hiperemis']))  ? 0 : $dataSet['Intak - Hiperemis'],
            'MT_intak_bulging' => (empty($dataSet['Intak - Bulging']))  ? 0 : $dataSet['Intak - Bulging'],
            'MT_intak_retraksi' => (empty($dataSet['Intak - Retraksi']))  ? 0 : $dataSet['Intak - Retraksi'],
            'MT_intak_sklerotik' => (empty($dataSet['Intak - Sklerotik']))  ? 0 : $dataSet['Intak - Sklerotik'],
            'MT_perforasi_sentral' => (empty($dataSet['Perforasi - Sentral']))  ? 0 : $dataSet['Perforasi - Sentral'],
            'MT_perforasi_atik' => (empty($dataSet['Perforasi - Atik']))  ? 0 : $dataSet['Perforasi - Atik'],
            'MT_perforasi_marginal' => (empty($dataSet['Perforasi - Marginal']))  ? 0 : $dataSet['Perforasi - Marginal'],
            'MT_perforasi_lain' => (empty($dataSet['Perforasi - Lain-Lain']))  ? 0 : $dataSet['Perforasi - Lain-Lain'],
            'MT_keterangan_lain' => $dataSet['mtketeranganlain'],
            'MT_mukosa' => $dataSet['mukosa'],
            'MT_osikal' => $dataSet['oslkel'],
            'MT_isthmus' => $dataSet['Isthmus'],
            'lain_lain' => $dataSet['keteranganlain'],
            'kesimpulan' => $request->kesimpulan,
            'anjuran' => $request->anjuran,
            'tgl_entry' => $this->get_now()
        ];

        $datatelinga2 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'kode_kunjungan' => $kodekunjungan,
            'gambar' => $request->telingakiri,
            'keterangan' => 'telinga kiri',
            'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
            'LT_dataSetestruksi' => (empty($dataSet2['Destruksi'])) ? 0 : $dataSet2['Destruksi'],
            'LT_Sempit' => (empty($dataSet2['Sempit']))  ? 0 : $dataSet2['Sempit'],
            'LT_Serumen' => (empty($dataSet2['Serumen']))  ? 0 : $dataSet2['Serumen'],
            'LT_Kolesteatoma' => (empty($dataSet2['Kolesteatoma']))  ? 0 : $dataSet2['Kolesteatoma'],
            'LT_Sekret' => (empty($dataSet2['Sekret']))  ? 0 : $dataSet2['Sekret'],
            'LT_Massa_Jaringan' => (empty($dataSet2['Massa atau Jaringan']))  ? 0 : $dataSet2['Massa atau Jaringan'],
            'LT_Jamur' => (empty($dataSet2['Jamur']))  ? 0 : $dataSet2['Jamur'],
            'LT_Benda_asing' => (empty($dataSet2['Benda Asing']))  ? 0 : $dataSet2['Benda Asing'],
            'LT_Lain_lain' => (empty($dataSet2['LT Lain-Lain']))  ? 0 : $dataSet2['LT Lain-Lain'],
            'LT_Keterangan_lain' => $dataSet2['ltketeranganlain'],
            'MT_intak_normal' => (empty($dataSet2['Intak - Normal']))  ? 0 : $dataSet2['Intak - Normal'],
            'MT_intak_hiperemis' => (empty($dataSet2['Intak - Hiperemis']))  ? 0 : $dataSet2['Intak - Hiperemis'],
            'MT_intak_bulging' => (empty($dataSet2['Intak - Bulging']))  ? 0 : $dataSet2['Intak - Bulging'],
            'MT_intak_retraksi' => (empty($dataSet2['Intak - Retraksi']))  ? 0 : $dataSet2['Intak - Retraksi'],
            'MT_intak_sklerotik' => (empty($dataSet2['Intak - Sklerotik']))  ? 0 : $dataSet2['Intak - Sklerotik'],
            'MT_perforasi_sentral' => (empty($dataSet2['Perforasi - Sentral']))  ? 0 : $dataSet2['Perforasi - Sentral'],
            'MT_perforasi_atik' => (empty($dataSet2['Perforasi - Atik']))  ? 0 : $dataSet2['Perforasi - Atik'],
            'MT_perforasi_marginal' => (empty($dataSet2['Perforasi - Marginal']))  ? 0 : $dataSet2['Perforasi - Marginal'],
            'MT_perforasi_lain' => (empty($dataSet2['Perforasi - Lain-Lain']))  ? 0 : $dataSet2['Perforasi - Lain-Lain'],
            'MT_keterangan_lain' => $dataSet2['mtketeranganlain'],
            'MT_mukosa' => $dataSet2['mukosa'],
            'MT_osikal' => $dataSet2['oslkel'],
            'MT_isthmus' => $dataSet2['Isthmus'],
            'lain_lain' => $dataSet2['keteranganlain'],
            'kesimpulan' => $request->kesimpulan,
            'anjuran' => $request->anjuran,
            'tgl_entry' => $this->get_now()
        ];
        $telingakanan = $request->telingakanan;
        $telingakiri = $request->telingakiri;
        $hasilpemeriksaan = $data_telinga_kanan . ' | ' . $data_telinga_kiri;
        try {
            $cek1 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kanan']);
            $cek2 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kiri']);
            $data_telinga = ['gambar_1' => $telingakanan, 'gambar_2' => $telingakiri, 'pemeriksaan_khusus' => $hasilpemeriksaan];
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($data_telinga);
            if (count($cek1) > 0) {
                $datatelinga1 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $kodekunjungan,
                    'gambar' => $request->telingakanan,
                    'keterangan' => 'telinga kanan',
                    'LT_lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
                    'LT_dataSetestruksi' => (empty($dataSet['Destruksi'])) ? 0 : $dataSet['Destruksi'],
                    'LT_Sempit' => (empty($dataSet['Sempit']))  ? 0 : $dataSet['Sempit'],
                    'LT_Serumen' => (empty($dataSet['Serumen']))  ? 0 : $dataSet['Serumen'],
                    'LT_Kolesteatoma' => (empty($dataSet['Kolesteatoma']))  ? 0 : $dataSet['Kolesteatoma'],
                    'LT_Sekret' => (empty($dataSet['Sekret']))  ? 0 : $dataSet['Sekret'],
                    'LT_Massa_Jaringan' => (empty($dataSet['Massa atau Jaringan']))  ? 0 : $dataSet['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($dataSet['Jamur']))  ? 0 : $dataSet['Jamur'],
                    'LT_Benda_asing' => (empty($dataSet['Benda Asing']))  ? 0 : $dataSet['Benda Asing'],
                    'LT_Lain_lain' => (empty($dataSet['LT Lain-Lain']))  ? 0 : $dataSet['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $dataSet['ltketeranganlain'],
                    'MT_intak_normal' => (empty($dataSet['Intak - Normal']))  ? 0 : $dataSet['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($dataSet['Intak - Hiperemis']))  ? 0 : $dataSet['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($dataSet['Intak - Bulging']))  ? 0 : $dataSet['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($dataSet['Intak - Retraksi']))  ? 0 : $dataSet['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($dataSet['Intak - Sklerotik']))  ? 0 : $dataSet['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($dataSet['Perforasi - Sentral']))  ? 0 : $dataSet['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($dataSet['Perforasi - Atik']))  ? 0 : $dataSet['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($dataSet['Perforasi - Marginal']))  ? 0 : $dataSet['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($dataSet['Perforasi - Lain-Lain']))  ? 0 : $dataSet['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $dataSet['mtketeranganlain'],
                    'MT_mukosa' => $dataSet['mukosa'],
                    'MT_osikal' => $dataSet['oslkel'],
                    'MT_isthmus' => $dataSet['Isthmus'],
                    'lain_lain' => $dataSet['keteranganlain'],
                    'kesimpulan' => $request->kesimpulan,
                    'anjuran' => $request->anjuran,
                    'tgl_update' => $this->get_now()
                ];
                ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'telinga kanan'))->update($datatelinga1);
            } else {
                ermtht_telinga::create($datatelinga1);
            }
            if (count($cek2) > 0) {
                $datatelinga2 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $kodekunjungan,
                    'gambar' => $request->telingakiri,
                    'keterangan' => 'telinga kiri',
                    'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
                    'LT_dataSetestruksi' => (empty($dataSet2['Destruksi'])) ? 0 : $dataSet2['Destruksi'],
                    'LT_Sempit' => (empty($dataSet2['Sempit']))  ? 0 : $dataSet2['Sempit'],
                    'LT_Serumen' => (empty($dataSet2['Serumen']))  ? 0 : $dataSet2['Serumen'],
                    'LT_Kolesteatoma' => (empty($dataSet2['Kolesteatoma']))  ? 0 : $dataSet2['Kolesteatoma'],
                    'LT_Sekret' => (empty($dataSet2['Sekret']))  ? 0 : $dataSet2['Sekret'],
                    'LT_Massa_Jaringan' => (empty($dataSet2['Massa atau Jaringan']))  ? 0 : $dataSet2['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($dataSet2['Jamur']))  ? 0 : $dataSet2['Jamur'],
                    'LT_Benda_asing' => (empty($dataSet2['Benda Asing']))  ? 0 : $dataSet2['Benda Asing'],
                    'LT_Lain_lain' => (empty($dataSet2['LT Lain-Lain']))  ? 0 : $dataSet2['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $dataSet2['ltketeranganlain'],
                    'MT_intak_normal' => (empty($dataSet2['Intak - Normal']))  ? 0 : $dataSet2['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($dataSet2['Intak - Hiperemis']))  ? 0 : $dataSet2['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($dataSet2['Intak - Bulging']))  ? 0 : $dataSet2['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($dataSet2['Intak - Retraksi']))  ? 0 : $dataSet2['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($dataSet2['Intak - Sklerotik']))  ? 0 : $dataSet2['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($dataSet2['Perforasi - Sentral']))  ? 0 : $dataSet2['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($dataSet2['Perforasi - Atik']))  ? 0 : $dataSet2['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($dataSet2['Perforasi - Marginal']))  ? 0 : $dataSet2['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($dataSet2['Perforasi - Lain-Lain']))  ? 0 : $dataSet2['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $dataSet2['mtketeranganlain'],
                    'MT_mukosa' => $dataSet2['mukosa'],
                    'MT_osikal' => $dataSet2['oslkel'],
                    'MT_isthmus' => $dataSet2['Isthmus'],
                    'lain_lain' => $dataSet2['keteranganlain'],
                    'kesimpulan' => $request->kesimpulan,
                    'anjuran' => $request->anjuran,
                    'tgl_update' => $this->get_now()
                ];
                ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'telinga kiri'))->update($datatelinga2);
                $data = [
                    // 'tanggalassemen' => $this->get_now(),
                    'status' => '0',
                    'signature' => ''
                ];
                assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            } else {
                ermtht_telinga::create($datatelinga2);
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpantht_hidung(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data2 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet2[$index] = $value;
        }
        $datahidung1 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'tgl_entry' => $this->get_now(),
            'keterangan' => 'Hidung Kanan',
            'kode_kunjungan' => $kodekunjungan,
            'KN_Lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
            'KN_Sempit' => (empty($dataSet['Sempit'])) ? 0 : $dataSet['Sempit'],
            'KN_Mukosa_pucat' => (empty($dataSet['Mukosa Pucat'])) ? 0 : $dataSet['Mukosa Pucat'],
            'KN_Mukosa_hiperemis' => (empty($dataSet['Mukosa Hiperemis'])) ? 0 : $dataSet['Mukosa Hiperemis'],
            'KN_Mukosa_edema' => (empty($dataSet['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet['Kavum Nasi Mukosa Edema'],
            'KN_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
            'KN_Polip' => (empty($dataSet['Kavum Nasi Polip'])) ? 0 : $dataSet['Kavum Nasi Polip'],
            'KI_Eutrofi' => (empty($dataSet['Eutrofi'])) ? 0 : $dataSet['Eutrofi'],
            'KN_Hipertrofi' => (empty($dataSet['Hipertrofi'])) ? 0 : $dataSet['Hipertrofi'],
            'KN_Atrofi' => (empty($dataSet['Atrofi'])) ? 0 : $dataSet['Atrofi'],
            'MM_Terbuka' => (empty($dataSet['Terbuka'])) ? 0 : $dataSet['Terbuka'],
            'MM_Tertutup' => (empty($dataSet['Tertutup'])) ? 0 : $dataSet['Tertutup'],
            'MM_Mukosa_Edema' => (empty($dataSet['Mukosa Edema'])) ? 0 : $dataSet['Mukosa Edema'],
            'S_Polip' => (empty($dataSet['Septum Polip'])) ? 0 : $dataSet['Septum Polip'],
            'S_Sekret' => (empty($dataSet['Sekret'])) ? 0 : $dataSet['Sekret'],
            'S_Lurus' => (empty($dataSet['Lurus'])) ? 0 : $dataSet['Lurus'],
            'S_Deviasi' => (empty($dataSet['Deviasi'])) ? 0 : $dataSet['Deviasi'],
            'S_Spina' => (empty($dataSet['Spina'])) ? 0 : $dataSet['Spina'],
            'N_Normal' => (empty($dataSet['Normal'])) ? 0 : $dataSet['Normal'],
            'N_Adenoid' => (empty($dataSet['Adenoid'])) ? 0 : $dataSet['Adenoid'],
            'N_Keradangan' => (empty($dataSet['Keradangan'])) ? 0 : $dataSet['Keradangan'],
            'N_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
            'lain_lain' => $dataSet['lain-lain'],
            'kesimpulan' => $request->kesimpulan
        ];

        $KN_Lapang = (empty($dataSet['Lapang'])) ? '' : ' Kavum nasi lapang ';
        $KN_Sempit = (empty($dataSet['Sempit'])) ? '' : ' Kavum nasi sempit ';
        $KN_Mukosa_pucat = (empty($dataSet['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
        $KN_Mukosa_hiperemis = (empty($dataSet['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
        $KN_Mukosa_edema = (empty($dataSet['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
        $KN_Massa = (empty($dataSet['Massa'])) ? '' : ' Kavum nasi massa ';
        $KN_Polip = (empty($dataSet['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
        $KI_Eutrofi = (empty($dataSet['Eutrofi'])) ? '' : ' Konka eutrofi ';
        $KN_Hipertrofi = (empty($dataSet['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
        $KN_Atrofi = (empty($dataSet['Atrofi'])) ? '' : ' Konka atrofi ';
        $MM_Terbuka  =  (empty($dataSet['Terbuka'])) ? '' : ' Meatus medius terbuka ';
        $MM_Tertutup  =  (empty($dataSet['Tertutup'])) ? '' : ' Meatus medius tertutup ';
        $MM_Mukosa_Edema  =  (empty($dataSet['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
        $S_Polip  = (empty($dataSet['Septum Polip'])) ? '' : ' Septum polip ';
        $S_Sekret  = (empty($dataSet['Sekret'])) ? '' : ' Septum sekret ';
        $S_Lurus  = (empty($dataSet['Lurus'])) ? '' : ' Septum lurus ';
        $S_Deviasi  = (empty($dataSet['Deviasi'])) ? '' : ' Septum Deviasi ';
        $S_Spina  = (empty($dataSet['Spina'])) ? '' : ' Septum Spina ';
        $N_Normal  = (empty($dataSet['Normal'])) ? '' : ' Nasofaring Normal ';
        $N_Adenoid  = (empty($dataSet['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
        $N_Keradangan  = (empty($dataSet['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
        $N_Massa  = (empty($dataSet['Massa'])) ? '' : ' Nasofaring Massa ';
        $lain_lain  = $dataSet['lain-lain'];
        $kesimpulan  = 'Kesimpulan : ' . $request->kesimpulan;

        $_KN_Lapang = (empty($dataSet2['Lapang'])) ? '' : ' Kavum nasi lapang ';
        $_KN_Sempit = (empty($dataSet2['Sempit'])) ? '' : ' Kavum nasi sempit ';
        $_KN_Mukosa_pucat = (empty($dataSet2['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
        $_KN_Mukosa_hiperemis = (empty($dataSet2['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
        $_KN_Mukosa_edema = (empty($dataSet2['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
        $_KN_Massa = (empty($dataSet2['Massa'])) ? '' : ' Kavum nasi massa ';
        $_KN_Polip = (empty($dataSet2['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
        $_KI_Eutrofi = (empty($dataSet2['Eutrofi'])) ? '' : ' Konka eutrofi ';
        $_KN_Hipertrofi = (empty($dataSet2['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
        $_KN_Atrofi = (empty($dataSet2['Atrofi'])) ? '' : ' Konka atrofi ';
        $_MM_Terbuka  =  (empty($dataSet2['Terbuka'])) ? '' : ' Meatus medius terbuka ';
        $_MM_Tertutup  =  (empty($dataSet2['Tertutup'])) ? '' : ' Meatus medius tertutup ';
        $_MM_Mukosa_Edema  =  (empty($dataSet2['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
        $_S_Polip  = (empty($dataSet2['Septum Polip'])) ? '' : ' Septum polip ';
        $_S_Sekret  = (empty($dataSet2['Sekret'])) ? '' : ' Septum sekret ';
        $_S_Lurus  = (empty($dataSet2['Lurus'])) ? '' : ' Septum lurus ';
        $_S_Deviasi  = (empty($dataSet2['Deviasi'])) ? '' : ' Septum Deviasi ';
        $_S_Spina  = (empty($dataSet2['Spina'])) ? '' : ' Septum Spina ';
        $_N_Normal  = (empty($dataSet2['Normal'])) ? '' : ' Nasofaring Normal ';
        $_N_Adenoid  = (empty($dataSet2['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
        $_N_Keradangan  = (empty($dataSet2['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
        $_N_Massa  = (empty($dataSet2['Massa'])) ? '' : ' Nasofaring Massa ';
        $_lain_lain  = $dataSet2['lain-lain'];
        $_kesimpulan  = ' Kesimpulan : ' . $request->kesimpulan;

        $hidungkanan = 'Hidung Kanan : ' . $KN_Lapang . $KN_Sempit . $KN_Mukosa_pucat . $KN_Mukosa_pucat . $KN_Mukosa_hiperemis . $KN_Mukosa_edema . $KN_Massa . $KN_Polip . $KI_Eutrofi . $KN_Hipertrofi . $KN_Atrofi . $MM_Terbuka . $MM_Tertutup . $MM_Mukosa_Edema . $S_Polip . $S_Sekret . $S_Lurus . $S_Deviasi . $S_Spina . $N_Normal . $N_Adenoid . $N_Keradangan . $N_Massa . $lain_lain . $kesimpulan;

        $hidungkiri = 'Hidung Kiri : ' . $_KN_Lapang . $_KN_Sempit . $_KN_Mukosa_pucat . $_KN_Mukosa_pucat . $_KN_Mukosa_hiperemis . $_KN_Mukosa_edema . $_KN_Massa . $_KN_Polip . $_KI_Eutrofi . $_KN_Hipertrofi . $_KN_Atrofi . $_MM_Terbuka . $_MM_Tertutup . $_MM_Mukosa_Edema . $_S_Polip . $_S_Sekret . $_S_Lurus . $_S_Deviasi . $_S_Spina . $_N_Normal . $_N_Adenoid . $_N_Keradangan . $_N_Massa . $_lain_lain . $_kesimpulan;


        $datahidung2 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'keterangan' => 'Hidung Kiri',
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $kodekunjungan,
            'KN_Lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
            'KN_Sempit' => (empty($dataSet2['Sempit'])) ? 0 : $dataSet2['Sempit'],
            'KN_Mukosa_pucat' => (empty($dataSet2['Mukosa Pucat'])) ? 0 : $dataSet2['Mukosa Pucat'],
            'KN_Mukosa_hiperemis' => (empty($dataSet2['Mukosa Hiperemis'])) ? 0 : $dataSet2['Mukosa Hiperemis'],
            'KN_Mukosa_edema' => (empty($dataSet2['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet2['Kavum Nasi Mukosa Edema'],
            'KN_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
            'KN_Polip' => (empty($dataSet2['Kavum Nasi Polip'])) ? 0 : $dataSet2['Kavum Nasi Polip'],
            'KI_Eutrofi' => (empty($dataSet2['Eutrofi'])) ? 0 : $dataSet2['Eutrofi'],
            'KI_Hipertrofi' => (empty($dataSet2['Hipertrofi'])) ? 0 : $dataSet2['Hipertrofi'],
            'KI_Atrofi' => (empty($dataSet2['Atrofi'])) ? 0 : $dataSet2['Atrofi'],
            'MM_Terbuka' => (empty($dataSet2['Terbuka'])) ? 0 : $dataSet2['Terbuka'],
            'MM_Tertutup' => (empty($dataSet2['Tertutup'])) ? 0 : $dataSet2['Tertutup'],
            'MM_Mukosa_Edema' => (empty($dataSet2['Mukosa Edema'])) ? 0 : $dataSet2['Mukosa Edema'],
            'S_Polip' => (empty($dataSet2['Septum Polip'])) ? 0 : $dataSet2['Septum Polip'],
            'S_Sekret' => (empty($dataSet2['Sekret'])) ? 0 : $dataSet2['Sekret'],
            'S_Lurus' => (empty($dataSet2['Lurus'])) ? 0 : $dataSet2['Lurus'],
            'S_Deviasi' => (empty($dataSet2['Deviasi'])) ? 0 : $dataSet2['Deviasi'],
            'S_Spina' => (empty($dataSet2['Spina'])) ? 0 : $dataSet2['Spina'],
            'N_Normal' => (empty($dataSet2['Normal'])) ? 0 : $dataSet2['Normal'],
            'N_Adenoid' => (empty($dataSet2['Adenoid'])) ? 0 : $dataSet2['Adenoid'],
            'N_Keradangan' => (empty($dataSet2['Keradangan'])) ? 0 : $dataSet2['Keradangan'],
            'N_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
            'lain_lain' => $dataSet2['lain-lain'],
            'kesimpulan' => $request->kesimpulan,
        ];
        $hasilpemeriksaan = $hidungkanan . ' | ' . $hidungkiri;
        try {
            $cek1 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'Hidung Kanan']);
            $cek2 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'Hidung Kiri']);
            $datahidung = ['pemeriksaan_khusus_2' => $hasilpemeriksaan];
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($datahidung);
            if (count($cek1) > 0) {
                $datahidung1 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'keterangan' => 'Hidung Kanan',
                    'tgl_update' => $this->get_now(),
                    'kode_kunjungan' => $kodekunjungan,
                    'KN_Lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
                    'KN_Sempit' => (empty($dataSet['Sempit'])) ? 0 : $dataSet['Sempit'],
                    'KN_Mukosa_pucat' => (empty($dataSet['Mukosa Pucat'])) ? 0 : $dataSet['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($dataSet['Mukosa Hiperemis'])) ? 0 : $dataSet['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($dataSet['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
                    'KN_Polip' => (empty($dataSet['Kavum Nasi Polip'])) ? 0 : $dataSet['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($dataSet['Eutrofi'])) ? 0 : $dataSet['Eutrofi'],
                    'KI_Hipertrofi' => (empty($dataSet['Hipertrofi'])) ? 0 : $dataSet['Hipertrofi'],
                    'KI_Atrofi' => (empty($dataSet['Atrofi'])) ? 0 : $dataSet['Atrofi'],
                    'MM_Terbuka' => (empty($dataSet['Terbuka'])) ? 0 : $dataSet['Terbuka'],
                    'MM_Tertutup' => (empty($dataSet['Tertutup'])) ? 0 : $dataSet['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($dataSet['Mukosa Edema'])) ? 0 : $dataSet['Mukosa Edema'],
                    'S_Polip' => (empty($dataSet['Septum Polip'])) ? 0 : $dataSet['Septum Polip'],
                    'S_Sekret' => (empty($dataSet['Sekret'])) ? 0 : $dataSet['Sekret'],
                    'S_Lurus' => (empty($dataSet['Lurus'])) ? 0 : $dataSet['Lurus'],
                    'S_Deviasi' => (empty($dataSet['Deviasi'])) ? 0 : $dataSet['Deviasi'],
                    'S_Spina' => (empty($dataSet['Spina'])) ? 0 : $dataSet['Spina'],
                    'N_Normal' => (empty($dataSet['Normal'])) ? 0 : $dataSet['Normal'],
                    'N_Adenoid' => (empty($dataSet['Adenoid'])) ? 0 : $dataSet['Adenoid'],
                    'N_Keradangan' => (empty($dataSet['Keradangan'])) ? 0 : $dataSet['Keradangan'],
                    'N_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
                    'lain_lain' => $dataSet['lain-lain'],
                    'kesimpulan' => $request->kesimpulan,
                ];
                erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'Hidung Kanan'))->update($datahidung1);
            } else {
                erm_tht_hidung::create($datahidung1);
            }

            if (count($cek2) > 0) {
                $datahidung2 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'keterangan' => 'Hidung Kiri',
                    'tgl_update' => $this->get_now(),
                    'kode_kunjungan' => $kodekunjungan,
                    'KN_Lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
                    'KN_Sempit' => (empty($dataSet2['Sempit'])) ? 0 : $dataSet2['Sempit'],
                    'KN_Mukosa_pucat' => (empty($dataSet2['Mukosa Pucat'])) ? 0 : $dataSet2['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($dataSet2['Mukosa Hiperemis'])) ? 0 : $dataSet2['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($dataSet2['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet2['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
                    'KN_Polip' => (empty($dataSet2['Kavum Nasi Polip'])) ? 0 : $dataSet2['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($dataSet2['Eutrofi'])) ? 0 : $dataSet2['Eutrofi'],
                    'KI_Hipertrofi' => (empty($dataSet2['Hipertrofi'])) ? 0 : $dataSet2['Hipertrofi'],
                    'KI_Atrofi' => (empty($dataSet2['Atrofi'])) ? 0 : $dataSet2['Atrofi'],
                    'MM_Terbuka' => (empty($dataSet2['Terbuka'])) ? 0 : $dataSet2['Terbuka'],
                    'MM_Tertutup' => (empty($dataSet2['Tertutup'])) ? 0 : $dataSet2['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($dataSet2['Mukosa Edema'])) ? 0 : $dataSet2['Mukosa Edema'],
                    'S_Polip' => (empty($dataSet2['Septum Polip'])) ? 0 : $dataSet2['Septum Polip'],
                    'S_Sekret' => (empty($dataSet2['Sekret'])) ? 0 : $dataSet2['Sekret'],
                    'S_Lurus' => (empty($dataSet2['Lurus'])) ? 0 : $dataSet2['Lurus'],
                    'S_Deviasi' => (empty($dataSet2['Deviasi'])) ? 0 : $dataSet2['Deviasi'],
                    'S_Spina' => (empty($dataSet2['Spina'])) ? 0 : $dataSet2['Spina'],
                    'N_Normal' => (empty($dataSet2['Normal'])) ? 0 : $dataSet2['Normal'],
                    'N_Adenoid' => (empty($dataSet2['Adenoid'])) ? 0 : $dataSet2['Adenoid'],
                    'N_Keradangan' => (empty($dataSet2['Keradangan'])) ? 0 : $dataSet2['Keradangan'],
                    'N_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
                    'lain_lain' => $dataSet2['lain-lain'],
                    'kesimpulan' => $request->kesimpulan,
                ];
                erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'Hidung Kiri'))->update($datahidung2);
            } else {
                erm_tht_hidung::create($datahidung2);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanformmata(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $datamata = [
            'id_assesmen_dokter' => $request->idassesmen,
            'no_rm' => $request->nomorrm,
            'nama_dokter' => auth()->user()->nama,
            'id_dokter' => auth()->user()->id,
            'kode_kunjungan' => $kodekunjungan,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'vd_od' => $dataSet['od_visus_dasar'],
            'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
            'vd_os' => $dataSet['os_visus_dasar'],
            'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
            'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
            'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
            'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
            'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
            'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
            'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
            'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
            'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
            'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
            'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
            'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
            'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
            'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
            'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
            'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
            'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
            'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
            'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
            'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
            'tekananintraokular' => $dataSet['tekanan_intra_okular'],
            'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
            'palpebra' => $dataSet['palpebra'],
            'konjungtiva' => $dataSet['konjungtiva'],
            'kornea' => $dataSet['kornea'],
            'bilikmatadepan' => $dataSet['bilik_mata_depan'],
            'pupil' => $dataSet['pupil'],
            'iris' => $dataSet['iris'],
            'lensa' => $dataSet['lensa'],
            'funduskopi' => $dataSet['funduskopi'],
            'status_oftamologis_khusus' => $dataSet['oftamologis'],
            'masalahmedis' => $dataSet['masalahmedis'],
            'prognosis' => $dataSet['prognosis'],
            'matakanan' => $request->matakanan,
            'matakiri' => $request->matakiri,
        ];
        $matakanan = $request->matakanan;
        $matakiri = $request->matakiri;
        try {
            $cek = DB::select('select * from erm_mata_kanan_kiri where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
            $hasil_pemeriksaan_khusus = "visus dasar : " . " OD : " . $dataSet['od_visus_dasar'] . " OD PINHOLE : " . $dataSet['od_pinhole_visus_dasar'] . " OS : " . $dataSet['os_visus_dasar'] .  " OS PINHOLE : " . $dataSet['os_pinhole_visus_dasar'] . " | Refraktometer / streak : " . "  OD : Sph : " . $dataSet['od_sph_refraktometer'] . " Cyl : " . $dataSet['od_cyl_refraktometer'] . " X : " . $dataSet['od_x_refraktometer'] . "  OS : Sph  : " . $dataSet['os_sph_refraktometer'] . " Cyl : " . $dataSet['os_cyl_refraktometer'] . " X : " . $dataSet['os_x_refraktometer'] . " Lensometer : " . "  OD : Sph  :" . $dataSet['od_sph_Lensometer'] . " Cyl : " . $dataSet['od_cyl_Lensometer'] . " X : " . $dataSet['od_x_Lensometer'] . "  OS : Sph : " . $dataSet['os_sph_Lensometer'] . " Cyl : " . $dataSet['os_cyl_Lensometer'] . " X : " . $dataSet['os_x_Lensometer'] . " | Koreksi penglihatan jauh : " . "  VOD : Sph : " . $dataSet['vod_sph_kpj'] . " Cyl : " . $dataSet['vod_cyl_kpj'] . " X : " . $dataSet['vod_x_kpj'] . "  VOS : Sph  : " . $dataSet['vos_sph_kpj'] . " Cyl : " . $dataSet['vos_cyl_kpj'] . "X :" . $dataSet['vos_x_kpj'] . " | Tajam penglihatan dekat : " . $dataSet['penglihatan_dekat'] . " | Tekanan Intra Okular : " . $dataSet['tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['palpebra'] . " | Konjungtiva : " . $dataSet['konjungtiva'] . "| Kornea : " . $dataSet['kornea'] . " | Bilik Mata Depan : " . $dataSet['bilik_mata_depan'] . " | pupil : " . $dataSet['pupil'] . " | Iris : " . $dataSet['iris'] . " | Lensa : " . $dataSet['lensa'] . " | funduskopi : " . $dataSet['funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['oftamologis'] . "| Masalah Medis : " . $dataSet['masalahmedis'] . " | Prognosis : " . $dataSet['prognosis'];

            $data_mata = ['gambar_1' => $matakanan, 'gambar_2' => $matakiri, 'pemeriksaan_khusus' => $hasil_pemeriksaan_khusus];
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($data_mata);
            if (count($cek) > 0) {
                $datamata = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'no_rm' => $request->nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_update' => $this->get_now(),
                    'status' => '0',
                    'vd_od' => $dataSet['od_visus_dasar'],
                    'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
                    'vd_os' => $dataSet['os_visus_dasar'],
                    'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
                    'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
                    'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
                    'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
                    'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
                    'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
                    'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
                    'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
                    'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
                    'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
                    'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
                    'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
                    'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
                    'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
                    'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
                    'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
                    'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
                    'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
                    'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
                    'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
                    'tekananintraokular' => $dataSet['tekanan_intra_okular'],
                    'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
                    'palpebra' => $dataSet['palpebra'],
                    'konjungtiva' => $dataSet['konjungtiva'],
                    'kornea' => $dataSet['kornea'],
                    'bilikmatadepan' => $dataSet['bilik_mata_depan'],
                    'pupil' => $dataSet['pupil'],
                    'iris' => $dataSet['iris'],
                    'lensa' => $dataSet['lensa'],
                    'funduskopi' => $dataSet['funduskopi'],
                    'status_oftamologis_khusus' => $dataSet['oftamologis'],
                    'masalahmedis' => $dataSet['masalahmedis'],
                    'prognosis' => $dataSet['prognosis'],
                    'matakanan' => $request->matakanan,
                    'matakiri' => $request->matakiri,
                ];
                erm_mata_kanan_kiri::whereRaw('id_assesmen_dokter = ? and kode_kunjungan = ?', array($request->idassesmen, $kodekunjungan))->update($datamata);
            } else {
                erm_mata_kanan_kiri::create($datamata);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanformgigi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $datagigi = [
            'id_assesmen_dokter' => $request->idassesmen,
            'no_rm' => $request->nomorrm,
            'nama_dokter' => auth()->user()->nama,
            'id_dokter' => auth()->user()->id,
            'kode_kunjungan' => $kodekunjungan,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'gambargigi' => $request->gambargigi
        ];
        try {
            $datagigi = ['gambar_1' => $request->gambargigi];
            $cek = DB::select('select * from erm_gambar_gigi where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($datagigi);
            if (count($cek) > 0) {
                $datagigi = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'no_rm' => $request->nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_update' => $this->get_now(),
                    'status' => '0',
                    'gambargigi' => $request->gambargigi
                ];
                erm_gambar_gigi::whereRaw('id_assesmen_dokter = ? and kode_kunjungan = ?', array($request->idassesmen, $kodekunjungan))->update($datagigi);
            } else {
                erm_gambar_gigi::create($datagigi);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpangambarbebas(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $datapolos = [
            'id_assesmen_dokter' => $request->idassesmen,
            'no_rm' => $request->nomorrm,
            'nama_dokter' => auth()->user()->nama,
            'id_dokter' => auth()->user()->id,
            'kode_kunjungan' => $kodekunjungan,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'kode_unit' => auth()->user()->unit,
            'catatangambar' => $request->gambarpolos
        ];
        $gambar = [
            'gambar_1' => $request->gambarpolos
        ];
        try {
            $cek = DB::select('select * from erm_catatan_gambar where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($gambar);
            if (count($cek) > 0) {
                $datapolos = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'no_rm' => $request->nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_update' => $this->get_now(),
                    'status' => '0',
                    'kode_unit' => auth()->user()->unit,
                    'catatangambar' => $request->gambarpolos
                ];
                erm_catatan_gambar::whereRaw('id_assesmen_dokter = ? and kode_kunjungan = ?', array($request->idassesmen, $kodekunjungan))->update($datapolos);
            } else {
                erm_catatan_gambar::create($datapolos);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
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
    public function tindakanhariini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan', compact([
            'riwayat_tindakan'
        ]));
    }
    public function tindakanhariini_lab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan_lab = DB::select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? and b.kode_unit = ?", [$request->kodekunjungan, '3002']);
        return view('ermtemplate.table_order_lab', compact([
            'riwayat_tindakan_lab'
        ]));
    }
    public function tindakanhariini_rad(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan_rad = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? and b.kode_unit = ?", [$request->kodekunjungan, '3003']);
        return view('ermtemplate.table_order_rad', compact([
            'riwayat_tindakan_rad'
        ]));
    }
    public function terapi_tindakanhariini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $keterangan = $request->keterangan;
        if ($keterangan == 'FISIOTERAPI') {
            $kodeunit = '3009';
        } else {
            $kodeunit = '3010';
        }
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.kode_unit = ?", [$request->kodekunjungan, $kodeunit]);
        return view('ermperawat.riwayatterapi', compact([
            'riwayat_tindakan'
        ]));
    }
    public function orderhari_ini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder', compact([
            'riwayat_tindakan'
        ]));
    }
    public function orderobathariini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql4')->select("SELECT
        b.kode_layanan_header
        ,b.status_layanan AS status_layanan_header
        ,a.kode_kunjungan,b.id AS id_header
        ,C.id AS id_detail
        ,c.kode_barang
        ,c.aturan_pakai
        ,c.kategori_resep
        ,c.satuan_barang
        ,c.jumlah_layanan
        ,b.kode_layanan_header
        ,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        WHERE a.`kode_kunjungan` = ?
        AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder_farmasi', compact([
            'riwayat_order'
        ]));
    }
    public function riwayattindakan(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan', compact([
            'riwayat_tindakan'
        ]));
    }
    public function riwayattindakan2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan2', compact([
            'riwayat_tindakan'
        ]));
    }
    public function riwayatorder2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder2', compact([
            'riwayat_tindakan'
        ]));
    }
    public function riwayatorderfarmasi2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::select("SELECT
        b.kode_layanan_header
        ,b.status_layanan AS status_layanan_header
        ,a.kode_kunjungan,b.id AS id_header
        ,C.id AS id_detail
        ,c.kode_barang
        ,c.aturan_pakai
        ,c.kategori_resep
        ,c.satuan_barang
        ,c.jumlah_layanan
        ,b.kode_layanan_header
        ,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        WHERE a.`kode_kunjungan` = ?
        AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder_farmasi2', compact([
            'riwayat_order'
        ]));
    }
    public function pemeriksaankhususon(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        if ($kunjungan[0]->kode_unit == '1019') {
            $kanan = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kanan']);
            $kiri = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kiri']);
            $hidungkanan = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kanan']);
            $hidungkiri = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kiri']);
            return view('ermtemplate.hasilpemeriksaan_tht', compact([
                'kanan',
                'kiri',
                'hidungkanan',
                'hidungkiri',
            ]));
        } else if ($kunjungan[0]->kode_unit == '1014') {
            $mata = DB::SELECT('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
            $formkhusus = [
                'keterangan' => 'mata',
                'mata' => $mata,
                'cek' => count($mata)
            ];
            return view('ermtemplate.hasilpemeriksaan_mata', compact([
                'formkhusus'
            ]));
        } else if ($kunjungan[0]->kode_unit == '1007') {
            $gigi = DB::SELECT('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
            $formkhusus = [
                'keterangan' => 'gigi',
                'gigi' => $gigi,
                'cek' => count($gigi)
            ];
            return view('ermtemplate.hasilpemeriksaan_gigi', compact([
                'formkhusus'
            ]));
        } else {
            $gambar = DB::SELECT('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
            $formkhusus = [
                'keterangan' => 'allin',
                'gambar' => $gambar,
                'cek' => count($gambar)
            ];
            return view('ermtemplate.hasilpemeriksaan_catatangambar', compact([
                'formkhusus'
            ]));
        }
    }
    public function cetakresumeperawat($rm, $counter)
    {
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare("CALL SP_ASSESMEN_KEPERAWATAN_RAJAL_DEWASA('$rm','$counter')");
        $QUERY->execute();
        $data = $QUERY->fetchAll();
        $filename = 'C:\cetakanerm\RESUME_PERAWAT.jrxml';
        $config = ['driver' => 'array', 'data' => $data];
        $report = new PHPJasperXML();
        $report->load_xml_file($filename)
            ->setDataSource($config)
            ->export('Pdf');
    }
    public function cetakresumedokter($rm, $counter)
    {
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare("CALL SP_ASSESMEN_DOKTER_MEDIS_RAWAT_JALAN('$rm','$counter')");
        $QUERY->execute();
        $data = $QUERY->fetchAll();
        $filename = 'C:\cetakanerm\RESUME_DOKTER.jrxml';
        $config = ['driver' => 'array', 'data' => $data];
        $report = new PHPJasperXML();
        $report->load_xml_file($filename)
            ->setDataSource($config)
            ->export('Pdf');
    }
    public function cetakresume($rm, $counter)
    {
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare("CALL SP_ASSESMEN_KEPERAWATAN_RAJAL_DEWASA('$rm','$counter')");
        $QUERY->execute();
        $data = $QUERY->fetchAll();
        $filename = 'C:\cetakanerm\RESUME_PERAWAT.jrxml';
        $config = ['driver' => 'array', 'data' => $data];
        $report = new PHPJasperXML();
        $report->load_xml_file($filename)
            ->setDataSource($config)
            ->export('Pdf');
    }
    public function ambilicd10()
    {
        $icd10 = DB::select('SELECT * FROM mt_icd10 limit 50');
        return view('ermtemplate.icd10kerja', compact([
            'icd10'
        ]));
    }
    public function ambilicd10_banding()
    {
        $icd10 = DB::select('SELECT * FROM mt_icd10 limit 50');
        return view('ermtemplate.icd10kerja_banding', compact([
            'icd10'
        ]));
    }
    public function ambilicd9()
    {
        $icd9 = DB::select('SELECT * FROM mt_icd9 limit 50');
        return view('ermtemplate.icd9kerja', compact([
            'icd9'
        ]));
    }
    public function ambilicd9_banding()
    {
        $icd9 = DB::select('SELECT * FROM mt_icd9 limit 50');
        return view('ermtemplate.icd9banding', compact([
            'icd9'
        ]));
    }
    public function cariicd10(Request $request)
    {
        $icd10 = DB::table('mt_icd10')
            ->select('*')
            ->where('nama', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd10kerja_cari', compact([
            'icd10'
        ]));
    }
    public function cariicd10_banding(Request $request)
    {
        $icd10 = DB::table('mt_icd10')
            ->select('*')
            ->where('nama', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd10banding_cari', compact([
            'icd10'
        ]));
    }
    public function cariicd9(Request $request)
    {
        $icd9 = DB::table('mt_icd9')
            ->select('*')
            ->where('nama_pendek', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd9kerja_cari', compact([
            'icd9'
        ]));
    }
    public function cariicd9_banding(Request $request)
    {
        $icd9 = DB::table('mt_icd9')
            ->select('*')
            ->where('nama_pendek', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd9banding_cari', compact([
            'icd9'
        ]));
    }
    public function gambarmatakanan(Request $request)
    {
        $cek1 = DB::select('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.matakanan', compact([
            'cek1'
        ]));
    }
    public function gambarmatakiri(Request $request)
    {
        $cek1 = DB::select('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.matakiri', compact([
            'cek1'
        ]));
    }
    public function gambargigi(Request $request)
    {
        $cek1 = DB::select('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.gigi', compact([
            'cek1'
        ]));
    }
    public function gambarnyeri(Request $request)
    {
        // $cek1 = DB::select('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.gambarnyeri');
    }
    public function gambarcatatan(Request $request)
    {
        $cek1 = DB::select('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
        return view('ermtemplate.gambarkosong', compact([
            'cek1'
        ]));
    }
    public function gambarcatatan_igd(Request $request)
    {
        $cek1 = DB::select('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
        return view('ermtemplate.gambarnyeri', compact([
            'cek1'
        ]));
    }
    public function indexpelayanandokter()
    {
        $title = 'SIMRS - Riwayat Pelayanan Dokter';
        $sidebar = 'pelayanandokter';
        $sidebar_m = '2';
        return view('ermdokter.indexpelayanan', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function riwayatpemeriksaan_byrm()
    {
        $title = 'SIMRS - Riwayat Pelayanan Dokter';
        $sidebar = 'caripasien_resume';
        $sidebar_m = '2';
        return view('ermdokter.riwayatpasien_rm', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function ambilriwayat_pasien()
    {
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));

        if (auth()->user()->unit == '1002') {
            $pasienigd = DB::select('SELECT * from mt_pasien_igd');
            return view('ermtemplate.tabelpasienigd', compact([
                'pasienigd'
            ]));
        } else {
            if (auth()->user()->hak_akses == 4) {
                $pasienpoli = DB::select('SELECT IFNULL(d.nomorantrean, TIME(a.`tgl_masuk`)) AS antrian,d.`nomorantrean`,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan LEFT OUTER JOIN jkn_antrian d ON a.`kode_kunjungan` = d.`kode_kunjungan`
                 WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ?', [
                    auth()->user()->unit, $d2, $now
                ]);
                return view('ermtemplate.riwayat_tabelpasien', compact([
                    'pasienpoli'
                ]));
            } else {
                $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.`kode_unit` = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ?', [
                    auth()->user()->unit, $d2, $now
                ]);
                return view('ermtemplate.riwayat_tabelpasien_dokter', compact([
                    'pasienpoli'
                ]));
            }
        }
    }
    public function ambilriwayat_pasien_cari(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.kode_unit = ? AND DATE(a.tanggalkunjungan) BETWEEN ? AND ?', [auth()->user()->unit, $d2, $now]);
        return view('ermtemplate.riwayatpemeriksaan', compact([
            'data'
        ]));
    }
    public function ambilriwayat_pasien_byrm(Request $request)
    {
        $nomorrm = $request->nomorm;
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.no_rm = ?', [$nomorrm]);
        return view('ermtemplate.riwayatpemeriksaan', compact([
            'data'
        ]));
    }
    public function formupload()
    {
        return view('ermtemplate.upload');
    }
    public function formsumarilis(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $nomorrm = $request->nomorrm;
        $riwayat = DB::connection('mysql4')->select('select * from ts_hasil_sumarilis where no_rm = ?', [$nomorrm]);
        return view('ermtemplate.formsumarilis', compact([
            'kodekunjungan',
            'nomorrm',
            'riwayat'
        ]));
    }
    public function form_monitoring_darah(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $nomorrm = $request->nomorrm;
        $datareaksi = DB::select('select * from erm_transfusi_darah_reaksi where kode_kunjungan = ?', [$kodekunjungan]);
        $datamonitoring = DB::select('select * from erm_transfusi_darah_monitoring where kode_kunjungan = ?', [$kodekunjungan]);
        $unit = DB::select('select * from mt_unit where group_unit = ?',(['I']));
        return view('ermtemplate.form_monitoring_darah', compact([
            'kodekunjungan',
            'nomorrm',
            'datareaksi',
            'datamonitoring',
            'unit'
        ]));
    }
    public function detailsumarilis(Request $request)
    {
        $data = DB::connection('mysql4')->select('select *,date(tgl_kunjungan) as tanggal from ts_hasil_sumarilis where id = ?', [$request->id]);
        return view('ermtemplate.editsumarilis', compact([
            'data'
        ]));
    }
    public function hasilsumarilis(Request $request)
    {
        $data = DB::connection('mysql4')->select('select *,date(tgl_kunjungan) as tanggal from ts_hasil_sumarilis where no_rm = ?', [$request->nomorrm]);
        return view('ermtemplate.tabelhasilsumarilis', compact([
            'data'
        ]));
    }
    public function formorderpenunjang(Request $request)
    {
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$request->kodekunjungan]);
        if (count($assdok) > 0) {
            return view('ermtemplate.formorderpenunjang', compact([
                'assdok'
            ]));
        } else {
            return view('ermtemplate.data1tidakditemukan');
        }
    }
    public function ambilform(Request $request)
    {

        $id = $request->id;
        $kodekunjungan = $request->kodekunjungan;
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$kodekunjungan]);
        $kelas = $kunjungan[0]->kelas;
        if ($id == 1) {
            $layanan = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        } else if ($id == 2) {
            $layanan = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        }
        return view('ermtemplate.formorderpenunjang_radiologi', compact([
            'layanan',
            'resume'
        ]));
    }
    public function uploadgambarnya(Request $request)
    {
        $data = array();
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = $request->nomorrm . '_' . $request->kodekunjungan . '_' . $request->namafile . '_' . $file->getClientOriginalName();
            $cek = DB::select('select * from erm_upload_gambar where kodekunjungan = ? and no_rm = ? and kode_unit = ? and  gambar = ?', [$request->kodekunjungan, $request->nomorrm, auth()->user()->unit, $filename]);
            $uploadnya = [
                'kodekunjungan' => $request->kodekunjungan,
                'no_rm' => $request->nomorrm,
                'kode_unit' => auth()->user()->unit,
                'nama' => $request->namafile,
                'gambar' => $filename,
                'tgl_upload' => $this->get_now(),
                'pic' => auth()->user()->id,
            ];
            erm_upload_gambar::create($uploadnya);
            // File extension
            $extension = $file->getClientOriginalExtension();
            // File upload location
            $location = '../files';

            // Upload file
            $file->move($location, $filename);

            // File path
            $filepath = url('../../files/' . $filename);

            // Response
            $data['success'] = 1;
            $data['message'] = 'Uploaded Successfully!';
            $data['filepath'] = $filepath;
            $data['extension'] = $extension;
        } else {
            // Response
            $data['success'] = 2;
            $data['message'] = 'File not uploaded.';
        }

        return response()->json($data);
    }
    public function hapusgambarupload(Request $request)
    {
        $id = $request->id;
        $data = DB::select('select * from erm_upload_gambar where id = ?', [$id]);
        $deleted = DB::table('erm_upload_gambar')->where('id', '=', $id)->delete();
        if (File::exists(public_path('../../files/' . $data[0]->gambar))) {
            File::delete(public_path('../../files/' . $data[0]->gambar));
            $back = [
                'kode' => 200,
                'message' => 'Berhasil dihapus !'
            ];
            echo json_encode($back);
            die;
        } else {
            $back = [
                'kode' => 500,
                'message' => 'File tidak ditemukan !'
            ];
            echo json_encode($back);
            die;
        }
    }
    public function riwayatupload(Request $request)
    {
        $cek = DB::select('select *,fc_nama_unit2(kode_unit) as nama_unit from erm_upload_gambar where no_rm = ?', [$request->rm]);
        return view('ermdokter.riwayatupload', compact([
            'cek'
        ]));
    }
    public function batalheaderlayanan(Request $request)
    {
        $riwayat_tindakan = DB::connection('mysql4')->select('SELECT * from ts_layanan_header where id = ?', [$request->idheader]);
        if (count($riwayat_tindakan) > 0) {
            $detail = DB::connection('mysql4')->select('SELECT * from ts_layanan_detail where row_id_header = ?', [$request->idheader]);
            $data_retur_header = [
                'status_layanan' => '3',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'pic2' => 'test_user',
                'updated_at' => $this->get_now()
            ];
            ts_layanan_header_dummy::whereRaw('id = ?', array($request->idheader))->update($data_retur_header);
            foreach ($detail as $d) {
                $data_retur_detail = [
                    'jumlah_retur' => $d->jumlah_layanan,
                    'tagihan_penjamin' => '0',
                    'tagihan_pribadi' => '0',
                    'grantotal_layanan' => '0',
                    'updated_at' => $this->get_now()
                ];
                ts_layanan_detail_dummy::whereRaw('row_id_header = ? and id = ?', array($request->idheader, $d->id))->update($data_retur_detail);
            }

            $data = [
                'kode' => 200,
                'message' => 'Data berhasil diretur !'
            ];
            echo json_encode($data);
            die;
            //bpjs
            //layanandetail
            //jmlh retur diisi sesuai qty jlh layanan
            //tagihan penjamin 0
            //tagihan detail 0
            //grantotal


            //layananheader
            //tagian pribadi dan penjamin 0
            //status layanan 3

            //untuk pasien umum jika pasien sudah bayar harus input ke ts_retur

        } else {
        }
    }
    public function batalheaderlayanan_order(Request $request)
    {
        $riwayat_tindakan = DB::connection('mysql4')->select('SELECT * from ts_layanan_header_order where id = ? and  status_order != ?', [$request->idheader, 2]);
        if (count($riwayat_tindakan) > 0) {
            $detail = DB::connection('mysql4')->select('SELECT * from ts_layanan_detail_order where row_id_header = ?', [$request->idheader]);
            $data_retur_header = [
                'status_layanan' => '3',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'pic2' => 'test_user',
                'updated_at' => $this->get_now()
            ];
            ts_layanan_header_order::whereRaw('id = ?', array($request->idheader))->update($data_retur_header);
            foreach ($detail as $d) {
                $data_retur_detail = [
                    'jumlah_retur' => $d->jumlah_layanan,
                    'tagihan_penjamin' => '0',
                    'tagihan_pribadi' => '0',
                    'grantotal_layanan' => '0',
                    'updated_at' => $this->get_now()
                ];
                ts_layanan_detail_order::whereRaw('row_id_header = ? and id = ?', array($request->idheader, $d->id))->update($data_retur_detail);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($riwayat_tindakan[0]->kode_kunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil diretur !'
            ];
            echo json_encode($data);
            die;
            //bpjs
            //layanandetail
            //jmlh retur diisi sesuai qty jlh layanan
            //tagihan penjamin 0
            //tagihan detail 0
            //grantotal


            //layananheader
            //tagian pribadi dan penjamin 0
            //status layanan 3

            //untuk pasien umum jika pasien sudah bayar harus input ke ts_retur

        } else {
            $data = [
                'kode' => 500,
                'message' => 'Order sedang dalam proses !'
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanorder(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
        $kodekunjungan = $request->kodekunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        if ($request->id == 1) {
            $unit = '3003';
        } else if ($request->id == 2) {
            $unit = '3002';
        }
        $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
        $prefix_kunjungan = $mtunit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }

        try {
            $kode_unit = $unit;
            $kode_layanan_header = $this->createOrderHeader('P');
            //dummy
            // $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
            // $kode_layanan_header = $r[0]->no_trx_layanan;
            // if ($kode_layanan_header == "") {
            //     $year = date('y');
            //     $kode_layanan_header = $mtunit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
            //     //dummy
            //     DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            // }
            $data_layanan_header = [
                'no_rm' => $kunjungan[0]->no_rm,
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_penjaminx' => $penjamin,
                'kode_unit' => $kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'unit_pengirim' => auth()->user()->unit,
                'diagnosa' => $request->diagnosapenunjang,
                'tgl_periksa' => $request->tglperiksa,
                'dok_kirim' => auth()->user()->kode_paramedis,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN',
                'status_order' => '0'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            //dummy
            $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
            $grand_total_tarif = 0;
            foreach ($arrayindex as $d) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $d['tarif'] * $d['qty'];
                } else {
                    $tagihanpenjamin = $d['tarif'] * $d['qty'];
                    $tagihanpribadi = 0;
                }
                $id_detail = $this->createLayanandetailOrder();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $d['kodelayanan'],
                    'total_tarif' => $d['tarif'],
                    'jumlah_layanan' => $d['qty'],
                    'diskon_layanan' => $d['disc'],
                    'total_layanan' => $d['tarif'] * $d['qty'],
                    'grantotal_layanan' => $d['tarif'] * $d['qty'],
                    'kode_dokter1' => auth()->user()->kode_paramedis,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                $grand_total_tarif = $grand_total_tarif + $d['tarif'];
            }
            if ($penjamin == 'P01') {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
            } else {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
    public function simpanorderfarmasi(Request $request)
    {
        $simpantemplate = $request->simpantemplate;
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
        $kodekunjungan = $request->kodekunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        //jika penjamin bpjs order ke dp2
        //jika penjamin umum order ke dp1
        //kodeheader dibedakan menjadi ORF
        if ($penjamin == 'P01') {
            $unit = '4002';
        } else {
            $unit = '4008';
        }
        $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
        $prefix_kunjungan = $mtunit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'keterangan') {
                $arrayindex[] = $dataSet;
            }
        }
        if ($simpantemplate == 'on') {
            if ($request->namaresep == '') {
                $back = [
                    'kode' => 500,
                    'message' => 'Nama Resep tidak boleh kosong !'
                ];
                echo json_encode($back);
                die;
            }
            $obatnya = '';
            foreach ($arrayindex as $d) {
                if ($obatnya == '') {
                    $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " " . $d['satuan'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . " , " . " kategori resep : " . $d['jenis'];
                } else {
                    $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " " . $d['satuan'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . " , " . " kategori resep : " . $d['jenis'];
                }
                $obatnya = $obatbaru;
            }
            $dataresep = [
                'nama_resep' => $request->namaresep,
                'keterangan' => $obatnya,
                'user' => auth()->user()->kode_paramedis,
                'tgl_entry' => $this->get_now()
            ];
            $id_resep = templateresep::create($dataresep);
            foreach ($arrayindex as $d) {
                $detailresep = [
                    'id_template' => $id_resep->id,
                    'nama_barang' => $d['namaobat'],
                    'kode_barang' => $d['kodebarang'],
                    'aturan_pakai' => $d['aturanpakai'],
                    'jenis' => $d['jenis'],
                    'satuan' => $d['satuan'],
                    'jumlah' => $d['jumlah'],
                    'signa' => $d['signa'],
                    'keterangan' => $d['keterangan'],
                ];
                $detailresep = templateresep_detail::create($detailresep);
            }
        }
        try {
            $kode_unit = $unit;
            //dummy
            // $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER_ORDER('$kode_unit')");
            // $kode_layanan_header = $r[0]->no_trx_layanan;
            // if ($kode_layanan_header == "") {
            //     $year = date('y');
            //     $kode_layanan_header = $mtunit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
            //     //dummy
            //     DB::connection('mysql4')->select('insert into mt_nomor_trx_order (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            // }
            $kode_layanan_header = $this->createOrderHeader('F');
            $data_layanan_header = [
                'no_rm' => $kunjungan[0]->no_rm,
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_penjaminx' => $penjamin,
                'kode_unit' => $kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'unit_pengirim' => auth()->user()->unit,
                'tgl_periksa' => $this->get_now(),
                'diagnosa' => $kunjungan[0]->diagx,
                'dok_kirim' => auth()->user()->kode_paramedis,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN',
                'status_order' => '0'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            //dummy
            $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);

            foreach ($arrayindex as $d) {
                // if ($penjamin == 'P01') {
                //     $tagihanpenjamin = 0;
                //     $tagihanpribadi = $d['tarif'] * $d['qty'];
                // } else {
                //     $tagihanpenjamin = $d['tarif'] * $d['qty'];
                //     $tagihanpribadi = 0;
                // }
                $id_detail = $this->createLayanandetailOrder();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_dokter1' => auth()->user()->kode_paramedis,
                    'jumlah_layanan' => $d['jumlah'],
                    'kode_barang' => $d['kodebarang'],
                    'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                    'kategori_resep' => $d['jenis'],
                    'satuan_barang' => $d['satuan'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
            }
            if ($penjamin == 'P01') {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1]);
            } else {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1]);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
    public function formorderfarmasi(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        if (count($resume) > 0) {

            return view('ermdokter.formfarmasi', compact([
                'kunjungan',
                'resume',
                'layanan'
            ]));
        } else {
            return view('ermtemplate.data1tidakditemukan');
        }
    }
    public function cariobat(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $key = $request->key;
        $jlh = strlen($key);
        if ($jlh > 2) {
            if ($kunjungan[0]->kode_penjamin == 'PO1') {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4002')");
            } else {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4008')");
            }
            return view('ermtemplate.tabel_obat', compact([
                'obat'
            ]));
        }
    }
    public function createOrderHeader($kode)
    {
        //dummy
        $q = DB::select('SELECT id,kode_layanan_header,RIGHT(kode_layanan_header,6) AS kd_max  FROM ts_layanan_header_order
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
    public function ambilformasskep()
    {
        $date = $this->get_now();
        return view('ermperawat.formasskep_igd', compact([
            'date'
        ]));
    }
    public function generatekode_igd()
    {
        // erm_kode_regis_igd
        $kode = $this->generatekode();
        $back = [
            'kode' => 200,
            'kode' => $kode
        ];
        echo json_encode($back);
        die;
    }
    public function generatekode()
    {
        //dummy
        $q = DB::select('SELECT id,koderegis,RIGHT(koderegis,3) AS kd_max  FROM erm_kode_regis_igd
        WHERE DATE(tanggal_generate) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'IGD' . date('ymd') . $kd;
    }
    public function ambilresep(Request $request)
    {
        $user = auth()->user()->kode_paramedis;
        $resep = DB::SELECT('select * from ts_template_resep where user = ? and status = ?', [$user, 1]);
        return view('ermtemplate.tabel_resep', compact(
            'resep'
        ));
    }
    public function ambilresep_detail(Request $request)
    {
        $resep = DB::SELECT('select * from erm_ts_resep_detail where id_template = ?', [$request->id]);
        return view('ermtemplate.reseptemplatedetail', compact(
            'resep'
        ));
    }
    public function tindaklanjut_dokter(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $resume = db::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        if (count($resume) > 0) {

            return view('ermdokter.tindaklanjut', compact([
                'resume'
            ]));
        } else {
            return view('ermtemplate.data1tidakditemukan');
        }
    }
    public function simpantindaklanjut(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $pilihan = $request->pilih;
        $ket = $request->ket;
        $data_u = [
            'tindak_lanjut' => $pilihan,
            'keterangan_tindak_lanjut' => $ket,
        ];
        assesmenawaldokter::whereRaw('id_kunjungan = ?', $kodekunjungan)->update($data_u);
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }
    public function lihathasillab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, '3002']);
        if (count($cek) == 0) {
            echo "<h4 class='text-danger'> Tidak Ada Hasil Laboratorium ...</h5>";
        } else {
            return view('ermtemplate.view_hasil_lab', compact(
                ['cek']
            ));
        }
    }
    public function lihathasilex(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select *,date(tgl_baca) as tanggalnya,fc_acc_number_ris(id_detail) as acc_number from ts_hasil_expertisi where kode_kunjungan = ?', [$kodekunjungan]);
        if (count($cek) == 0) {
            echo "<h4 class='text-danger'> Tidak Ada Hasil Expertisi ...</h5>";
        } else {
            return view('ermtemplate.view_hasil_ex', compact(
                ['cek']
            ));
        }
    }
    public function lihathasil_scanrm(Request $request)
    {
        $rm = $request->rm;
        if (strlen($rm) == 8) {
            $rm = (substr($rm, 2));
        }
        $rm = '%' . $rm;
        // dd($rm);
        $cek = DB::select('select * from jkn_scan_file_rm where norm like ?', [$rm]);
        if (count($cek) == 0) {
            echo "<h4 class='text-danger'> Tidak Ada Hasil Scan ...</h5>";
        } else {
            return view('ermtemplate.view_hasil_scan', compact(
                ['cek']
            ));
        }
    }
    public function vberkasluar(Request $request)
    {
        $rm = $request->rm;
        $cek = DB::select('select * from erm_upload_gambar where no_rm = ?', [$rm]);
        $url = url('../../files/');
        if (count($cek) == 0) {
            echo "<h4 class='text-danger'> Tidak ada berkas dari luar yang diupload ...</h5>";
        } else {
            return view('ermtemplate.view_berkas_luar', compact(
                ['cek', 'url']
            ));
        }
    }
    public function hapustemplateresep(Request $request)
    {
        $id = $request->id;
        templateresep::whereRaw('id = ?', $id)->update(['status' => 0]);
        $back = [
            'kode' => 200,
            'message' => 'Template berhasil dihapus !'
        ];
        echo json_encode($back);
        die;
    }
    public function ambilgambarpemeriksaan(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $data = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermtemplate.formgambar', compact('unit', 'data'));
    }
    public function ambilgambarpemeriksaan_matakiri(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $data = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermtemplate.formgambar_matakiri', compact('unit', 'data'));
    }
    public function ambilgambarpemeriksaan_matakanan(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $data = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermtemplate.formgambar_matakanan', compact('unit', 'data'));
    }
    public function ambilgambarpemeriksaan_reset(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $data = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermtemplate.formgambar_reset', compact('unit', 'data'));
    }
    public function matakiri_reset(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $data = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermtemplate.matakiri_reset', compact('unit', 'data'));
    }
    public function matakanan_reset(Request $request)
    {
        $unit = auth()->user()->unit;
        $kodekunjungan = $request->kodekunjungan;
        $data = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermtemplate.matakanan_reset', compact('unit', 'data'));
    }
    public function cariobat_form(Request $request)
    {
        $r = $request['term'];
        $result = Barang::where('nama_generik', 'LIKE', "%{$r}%")->where('act', '=', '1')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row['nama_barang'],
                    'aturan' => $row['aturan_pakai']
                );
            echo json_encode($arr_result);
        }
    }
    public function formtindaklanjut(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        $cek_konsul  = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where ref_kunjungan = ? and status_kunjungan != ?', [$kodekunjungan, '8']);
        if (count($assdok) > 0) {
            return view('ermtemplate.formtindaklanjut', compact([
                'assdok',
                'cek_konsul'
            ]));
        } else {
            return view('ermtemplate.dokterbelummengisi');
        }
    }
    public function formsurkon(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $jenis = $request->jenis;
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        if ($jenis == 'konsul') {
            return view('ermtemplate.formkonsul', compact([
                'jenis',
                'assdok',
            ]));
        }
    }
    public function simpankonsul(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $kodekunjungan = $request->kodekunjungan;
        $jenis = $request->jenis;
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$dataSet['idpolitujuan']]);
        //cek ts kunjungan
        $cek_ts_kunjungan = DB::select('Select * from ts_kunjungan where ref_kunjungan = ? and kode_unit = ? and status_kunjungan != ?', [$kodekunjungan, $dataSet['idpolitujuan'], 8]);
        if (count($cek_ts_kunjungan) > 0) {
            $data = [
                'kode' => 500,
                'message' => 'Pasien sudah dikonsulkan !'
            ];
            echo json_encode($data);
            die;
        }
        $data_ts_kunjungan = [
            'counter' => $kunjungan[0]->counter,
            'no_rm' => $kunjungan[0]->no_rm,
            'ref_kunjungan' => $kodekunjungan,
            'kode_unit' => $dataSet['idpolitujuan'],
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
            'diagx' => $dataSet['diagnosakonsul'],
            'keterangan3' => $dataSet['keterangankonsul'],
            'pic' => auth()->user()->id_simrs,
            'no_sep' => '',
        ];
        $kodeunit = $dataSet['idpolitujuan'];
        $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
        $kode_layanan_header = $r[0]->no_trx_layanan;
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
            DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
        }
        $ts_kunjungan = ts_kunjungan2::create($data_ts_kunjungan);
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
        //data yg diinsert ke ts_layanan_header
        //simpan ke layanan header
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
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function batalkonsul(Request $request)
    {
        $kode = $request->kode;
        ts_kunjungan2::where('kode_kunjungan', $kode)->update(['status_kunjungan' => '8']);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function riwayatkonsul(Request $request)
    {
        $id = auth()->user()->id;
        $data = DB::select('select tindak_lanjut,keterangan_tindak_lanjut from assesmen_dokters where pic = ? and tindak_lanjut = ? ORDER BY id desc', [$id, 'KONSUL KE POLI LAIN']);
        return view('ermtemplate.tabel_riwayat_konsul', compact([
            'data'
        ]));
    }
    public function berkas_erm()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'berkas_erm';
        $sidebar_m = 'berkas_erm';
        $now = $this->get_date();
        return view('ermtemplate.index_berkas_erm', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function ambil_berkas_erm(Request $request)
    {
        if (empty($request->tglawal)) {
            $now = date('Y-m-d');
            $d2 = date('Y-m-d', strtotime('-30 days'));
        } else {
            $now = $request->tglakhir;
            $d2 = $request->tglawal;
        }
        $dataerm = db::select('SELECT b.id as id_asskep,a.id as id_assdok,a.id_pasien,fc_nama_px(a.`id_pasien`) AS nama_pasien,a.`nama_dokter`,b.`namapemeriksa` AS perawat
        ,fc_nama_unit1(a.`kode_unit`) nama_poli,a.`tgl_pemeriksaan` FROM assesmen_dokters AS a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`id_asskep` = b.id WHERE DATE(a.tgl_pemeriksaan) BETWEEN ? AND ?', [$d2, $now]);
        return view('ermtemplate.tabel_data_erm', compact([
            'dataerm'
        ]));
    }
    public function ambil_kunjungan_hari_ini(Request $request)
    {
        if (empty($request->tglawal)) {
            $now = date('Y-m-d');
            $status = 1;
        } else {
            if ($request->tglawal == $this->get_date()) {
                $status = 1;
            } else {
                $status = 2;
            }
            $now = $request->tglawal;
        }
        if (!empty($request->pilihunit)) {
            $dataerm = db::select('SELECT keterangan2,no_rm,fc_nama_px(no_rm) as nama,tgl_masuk,kode_unit,fc_nama_unit1(kode_unit) as nama_unit FROM ts_kunjungan WHERE DATE(tgl_masuk) = ? AND LEFT(kode_unit,1) = ? AND status_kunjungan = ? AND kode_unit = ?', [$now, 1, $status, $request->pilihunit]);
        } else {
            $dataerm = db::select('SELECT keterangan2,no_rm,fc_nama_px(no_rm) as nama,tgl_masuk,kode_unit,fc_nama_unit1(kode_unit) as nama_unit FROM ts_kunjungan WHERE DATE(tgl_masuk) = ? AND LEFT(kode_unit,1) = ? AND status_kunjungan = ?', [$now, 1, $status]);
        }
        return view('ermtemplate.tabel_kunjungan_tdy', compact([
            'dataerm',
        ]));
    }
    public function monitoring_berkas_erm(Request $request)
    {
        if (empty($request->tglawal)) {
            $now = date('Y-m-d');
            $status = 1;
        } else {
            if ($request->tglawal == $this->get_date()) {
                $status = 1;
            } else {
                $status = 2;
            }
            $now = $request->tglawal;
        }
        if (!empty($request->pilihunit)) {
            $dataerm = db::select('SELECT a.tgl_masuk,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.kode_unit,fc_nama_unit1(a.kode_unit) AS nama_unit,b.id AS id_asskep,b.namapemeriksa,c.nama_dokter,c.id AS id_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.`kode_kunjungan`
            LEFT OUTER JOIN assesmen_dokters c ON b.id = c.id_asskep WHERE DATE(a.`tgl_masuk`) = ? AND a.`status_kunjungan` = ? AND a.kode_unit = ?', [$now, $status, $request->pilihunit]);
        } else {
            $dataerm = db::select('SELECT a.tgl_masuk,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.kode_unit,fc_nama_unit1(a.kode_unit) AS nama_unit,b.id AS id_asskep,b.namapemeriksa,c.nama_dokter,c.id AS id_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.`kode_kunjungan`
            LEFT OUTER JOIN assesmen_dokters c ON b.id = c.id_asskep WHERE DATE(a.`tgl_masuk`) = ? AND a.`status_kunjungan` = ?', [$now, $status]);
        }
        return view('ermtemplate.tabel_monitoring_Erm', compact([
            'dataerm',
        ]));
    }
    public function ambilriwayatobat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $unit = auth()->user()->unit;
        $kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $last_assdok = DB::select('SELECT * FROM assesmen_dokters
        WHERE id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ? ) AND id_pasien = ? AND kode_unit = ?', [$kunjungan[0]->no_rm, $unit, $kunjungan[0]->no_rm, $unit]);
        if (count($last_assdok) > 0) {
            $riwayatobat = db::select('SELECT * FROM ts_layanan_header_order AS a
            LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.row_id_header WHERE LEFT(a.kode_layanan_header,3) = ? AND a.kode_kunjungan = ?', ['ORF', $last_assdok[0]->id_kunjungan]);
            return view('ermtemplate.riwayat_obat', compact([
                'riwayatobat'
            ]));
        } else {
        }
    }
    public function ambilsaran()
    {
        $id = auth()->user()->id;
        $data = DB::select('select keterangan_tindak_lanjut from assesmen_dokters where pic = ? ORDER BY id desc', [$id]);
        return view('ermtemplate.tabel_riwayat_saran', compact([
            'data'
        ]));
    }
    public function ambil_berkas_erm_pasien(Request $request)
    {
        $id_asskep = $request->id_asskep;
        $id_assdok = $request->id_assdok;
        $resume_1 = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE id = ?', [$id_asskep]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id = ?', [$id_assdok]);
        $kode_unit = $resume[0]->kode_unit;
        $kodekunjungan = $resume[0]->id_kunjungan;
        if (count($resume) > 0) {
            if ($kode_unit == '1019') {
                $kanan = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$kodekunjungan, 'telinga kanan']);
                $kiri = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$kodekunjungan, 'telinga kiri']);
                $hidungkanan = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$kodekunjungan, 'Hidung Kanan']);
                $hidungkiri = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$kodekunjungan, 'Hidung Kiri']);
                $formkhusus = [
                    'keterangan' => 'tht',
                    'telingakanan' => $kanan,
                    'cek1' => count($kanan),
                    'telingakiri' => $kiri,
                    'cek2' => count($kiri),
                    'hidungkanan' => $hidungkanan,
                    'cek3' => count($hidungkanan),
                    'hidungkiri' => $hidungkiri,
                    'cek4' => count($hidungkiri),
                ];
            } elseif ($resume[0]->kode_unit == '1014') {
                $mata = DB::SELECT('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$kodekunjungan]);
                $formkhusus = [
                    'keterangan' => 'mata',
                    'mata' => $mata,
                    'cek' => count($mata)
                ];
            } else if ($resume[0]->kode_unit == '1007') {
                $gigi = DB::SELECT('select * from erm_gambar_gigi where kode_kunjungan = ?', [$kodekunjungan]);
                $formkhusus = [
                    'keterangan' => 'gigi',
                    'gigi' => $gigi,
                    'cek' => count($gigi)
                ];
            } else {
                $gambar = DB::SELECT('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, $kode_unit]);
                $formkhusus = [
                    'keterangan' => 'allin',
                    'gambar' => $gambar,
                    'cek' => count($gambar)
                ];
            }
        } else {
            $formkhusus = [
                'keterangan' => '',
            ];
        }
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan as status_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$kodekunjungan]);

        $riwayat_order = DB::select("SELECT b.status_layanan as status_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$kodekunjungan]);

        $riwayat_order_f = DB::connection('mysql4')->select("SELECT b.kode_layanan_header,b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.kode_barang,c.aturan_pakai,c.kategori_resep,c.satuan_barang,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header WHERE a.`kode_kunjungan` = ? AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$kodekunjungan]);

        $riwayat_upload = DB::select('select *,fc_nama_unit2(kode_unit) as nama_unit from erm_upload_gambar where kodekunjungan = ?', [$kodekunjungan]);

        return view('ermtemplate.resumepasien_rm', compact([
            'resume_1',
            'resume',
            'formkhusus',
            'riwayat_tindakan',
            'riwayat_order',
            'riwayat_upload',
            'riwayat_order_f'
        ]));
    }
    public function kunjungan_pasien()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'berkas_erm';
        $sidebar_m = 'kunjungan_pasien';
        $now = $this->get_date();
        $mt_unit = db::select('select * from mt_unit where LEFT(kode_unit,2) = 10 or left(kode_unit,2) = 30');
        return view('ermtemplate.kunjungan_pasien', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'mt_unit'
        ]));
    }
    public function monitoring_erm()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'berkas_erm';
        $sidebar_m = 'Monitoring ERM';
        $now = $this->get_date();
        $mt_unit = db::select('select * from mt_unit where LEFT(kode_unit,2) = 10 or left(kode_unit,2) = 30');
        return view('ermtemplate.v_monitoringerm', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'mt_unit'
        ]));
    }
    public function lihathasilpenunjang_lab(Request $request)
    {
        $rm = $request->nomorrm;
        $hasil_lab = DB::select('SELECT * FROM ts_kunjungan a INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan` WHERE a.`no_rm` = ? AND b.`kode_unit` = ? ORDER BY a.`kode_kunjungan`DESC ', [$rm, '3002']);
        return view('ermtemplate.view_hasil_penunjang_lab', compact([
            'hasil_lab'
        ]));
    }
    public function lihathasilpenunjang_rad(Request $request)
    {
        $rm = $request->nomorrm;
        $hasil_rad = DB::select('SELECT * FROM ts_hasil_expertisi WHERE no_rm = ? ', [$rm]);
        $date = $this->get_date();
        return view('ermtemplate.view_hasil_penunjang_rad', compact([
            'hasil_rad',
            'rm',
            'date'
        ]));
    }
    public function lihathasilpenunjang_pa(Request $request)
    {
        $rm = $request->nomorrm;
        $hasil_pa = DB::select('SELECT * FROM ts_hasil_expertisi_pa  WHERE no_rm = ? ', [$rm]);
        return view('ermtemplate.view_hasil_penunjang_pa', compact([
            'hasil_pa',
            'rm'
        ]));
    }
    public function lihathasilpenunjang_uro(Request $request)
    {
        $rm = $request->nomorrm;
        $hasil_ex = DB::select('SELECT * FROM assesmen_dokters  WHERE id_pasien = ? and kode_unit =?', [$rm,'1027']);
        return view('ermtemplate.view_hasil_penunjang_uro', compact([
            'hasil_ex',
            'rm'
        ]));
    }
    public function lihathasilpenunjang_obg(Request $request)
    {
        $rm = $request->nomorrm;
        $hasil_ex = DB::select('SELECT * FROM assesmen_dokters  WHERE id_pasien = ? and kode_unit =?', [$rm,'1012']);
        return view('ermtemplate.view_hasil_penunjang_obg', compact([
            'hasil_ex',
            'rm'
        ]));
    }
    public function ambil_form_igd(Request $request)
    {
        $id_antrian = $request->id;
        $data_antrian = DB::connection('mysql4')->select('select * from ts_antrian_igd where id = ?', [$id_antrian]);
        $rm = $data_antrian[0]->nomor_rm;
        $resume = DB::connection('mysql4')->select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE id_antrian = ?', [$request->id]);
        if ($rm == '') {
            if (count($resume) > 0) {
                return view('ermtemplate.form_igd_perawat_edit', compact([
                    'id_antrian',
                    'data_antrian',
                    'resume'
                ]));
            } else {
                return view('ermtemplate.form_igd_perawat', compact([
                    'id_antrian',
                    'data_antrian'
                ]));
            }
        } else {
            $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
            return view('ermtemplate.index_form_igd', compact([
                'mt_pasien',
                'id_antrian'
            ]));
        }
    }
    public function formpemeriksaan_igd(Request $request)
    {
        $id_antrian = $request->id;
        $data_antrian = DB::connection('mysql4')->select('select * from ts_antrian_igd where id = ?', [$id_antrian]);
        $rm = $data_antrian[0]->nomor_rm;
        $resume = DB::connection('mysql4')->select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE id_antrian = ?', [$request->id]);
        if (count($resume) > 0) {
            return view('ermtemplate.form_igd_perawat_edit_2', compact([
                'id_antrian',
                'data_antrian',
                'resume'
            ]));
        } else {
            return view('ermtemplate.form_igd_perawat_2', compact([
                'id_antrian',
                'data_antrian'
            ]));
        }
    }
    public function simpanpemeriksaanperawat_igd(Request $request)
    {


        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }

        if (empty($dataSet['nyeri'])) {
            $nyeri = 0;
        } else {
            $nyeri = $dataSet['nyeri'];
        };
        if (empty($dataSet['cederajatuh'])) {
            $cederajatuh = 0;
        } else {
            $cederajatuh = $dataSet['cederajatuh'];
        };
        if (empty($dataSet['toksik'])) {
            $toksik = 0;
        } else {
            $toksik = $dataSet['toksik'];
        };
        if (empty($dataSet['aktualtakut'])) {
            $aktualtakut = 0;
        } else {
            $aktualtakut = $dataSet['aktualtakut'];
        };
        if (empty($dataSet['integritaskulit'])) {
            $integritaskulit = 0;
        } else {
            $integritaskulit = $dataSet['integritaskulit'];
        };
        if (empty($dataSet['keseimbangancairan'])) {
            $keseimbangancairan = 0;
        } else {
            $keseimbangancairan = $dataSet['keseimbangancairan'];
        };
        if (empty($dataSet['hipertermia'])) {
            $hipertermia = 0;
        } else {
            $hipertermia = $dataSet['hipertermia'];
        };
        if (empty($dataSet['jlnnafas'])) {
            $jlnnafas = 0;
        } else {
            $jlnnafas = $dataSet['jlnnafas'];
        };

        if (empty($dataSet['polanafas'])) {
            $polanafas = 0;
        } else {
            $polanafas = $dataSet['polanafas'];
        };

        if (empty($dataSet['pertukarangas'])) {
            $pertukarangas = 0;
        } else {
            $pertukarangas = $dataSet['pertukarangas'];
        };

        if (empty($dataSet['sirkulasi'])) {
            $sirkulasi = 0;
        } else {
            $sirkulasi = $dataSet['sirkulasi'];
        };

        if (empty($dataSet['perfusijaringan'])) {
            $perfusijaringan = 0;
        } else {
            $perfusijaringan = $dataSet['perfusijaringan'];
        };

        $data = [
            'kode_unit' => '1002',
            'id_antrian' => $dataSet['idantrian'],
            'nama_pasien' => $dataSet['namapasien'],
            'sumberdataperiksa' => $dataSet['sumberdata'],
            'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
            'tanggalperiksa' => $this->get_now(),
            'asalmasuk' => $dataSet['asalmasuk'] . ' | ' . $dataSet['keteranganasalmasuk'] . ' | ' . $dataSet['namakeluarga'],
            'caramasuk' => $dataSet['caramasuk'],
            'tekanandarah' => $dataSet['tekanandarah'],
            'frekuensinadi' => $dataSet['frekuensinadi'],
            'frekuensinapas' => $dataSet['frekuensinafas'],
            'suhutubuh' => $dataSet['suhutubuh'],
            'beratbadan' => $dataSet['beratbadan'],
            'Keluhannyeri' => $dataSet['adakeluhannyeri'],
            'skalenyeripasien' => $dataSet['skalanyeripasien'] . ' | ' . $dataSet['nyeriberipindah'] . ' | ' . $dataSet['lamanyeri'] . ' | ' . $dataSet['rasanyeri'] . ' | ' . $dataSet['seberapaseringnyeri'] . ' | ' . $dataSet['durasinyeri'] . ' | ' . $dataSet['peredanyeri'],
            'keterangan_riwayat_psikolog' => $dataSet['riwayat_jatuh_dewasa'] . ' | ' . $dataSet['diagnosissekunder_dewasa'] . ' | ' . $dataSet['alatbantu_dewasa'] . ' | ' . $dataSet['terpasanginfus_dewasa'] . ' | ' . $dataSet['gayaberjalan_dewasa'] . ' | ' . $dataSet['statusmental'],
            'umur' => $dataSet['umur_anak'],
            'jeniskelamin' => $dataSet['jeniskelaminanak'],
            'diagnosis' => $dataSet['diagnosa_anak'],
            'Riwayatpsikologi' => $dataSet['keadaanumum'] . ' | ' . $dataSet['kesadaran'] . ' | ' . $dataSet['tekananintrakranial'] . ' | ' . $dataSet['pupil'] . ' | ' . $dataSet['neurosensorik'] . ' | ' . $dataSet['integumen'] . ' | ' . $dataSet['turgorkulit'] . ' | ' . $dataSet['edema'] . ' | ' . $dataSet['mukosamulut'] . ' | ' . $dataSet['jumlah_perdarahan'] . ' | ' . $dataSet['warna_perdarahan'] . ' | ' . $dataSet['intoksikasi'] . ' | ' . $dataSet['frekuensibab'] . ' | ' . $dataSet['konsistensibab'] . ' | ' . $dataSet['warnabab'] . ' | ' . $dataSet['frekuensibak'] . ' | ' . $dataSet['konsistensibak'] . ' | ' . $dataSet['warnabak'] . ' | ' . $dataSet['kecemasan'] . ' | ' . $dataSet['mekanisme'] . ' | ' . $dataSet['mekanisme'],
            'gangguankoginitf' => $dataSet['gangguankognitif_anak'],
            'faktorlingkungan' => $dataSet['faktorlingkungan_anak'],
            'responterhadapoperasi' => $dataSet['responanestesi_anak'],
            'penggunaanobat' => $dataSet['penggunaanobatobatan_anak'],
            'anaktampakkurus' => $dataSet['pasientampakkurus'],
            'adapenurunanbbanak' => $dataSet['apakahadapenurunanbb'],
            'faktormalnutrisianak' => $dataSet['beratpenurunan'] . ' | ' . $dataSet['apakahasupanmakanburuk'] . ' | ' . $dataSet['Sakitberat'] . ' | ' . $dataSet['penurunanbb_anak'] . ' | ' . $dataSet['kondisilain'] . ' | ' . $dataSet['penyakitlain_anak'],
            'penyakitlainpasien' => $jlnnafas . ' | ' . $polanafas . ' | ' . $pertukarangas . ' | ' . $sirkulasi . ' | ' . $perfusijaringan . ' | ' . $hipertermia . ' | ' . $keseimbangancairan . ' | ' . $integritaskulit . ' | ' . $aktualtakut . ' | ' . $toksik . ' | ' . $cederajatuh . ' | ' . $nyeri . ' | ',
            'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'] . ' | ' . $dataSet['subyektifanamnesis'],
            'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
            'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
            'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
            'namapemeriksa' => auth()->user()->nama,
            'idpemeriksa' => auth()->user()->id,
            'status' => '0',
            'signature' => ''
        ];
        try {
            $cek = DB::connection('mysql4')->select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE id_antrian = ?', [$dataSet['idantrian']]);
            if (count($cek) > 0) {
                assesmenawalperawat::whereRaw('id_antrian = ? and kode_unit = ?', array($dataSet['idantrian'],  '1002'))->update($data);
            } else {
                $erm_assesmen = assesmenawalperawat::create($data);
            }
            $dt_antrian = [
                'nama_px' => $dataSet['namapasien']
            ];
            ts_antrian_igd::whereRaw('id = ?', array($dataSet['idantrian']))->update($dt_antrian);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function indexdokter_igd()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermdokter';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('ermdokter.index_igd', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function ambildatapasiendokter_igd()
    {
        $pasienigd = DB::connection('mysql4')->select('SELECT a.id AS id,a.nomor_antrian,a.`nama_px`,a.nomor_rm,a.`tgl_masuk`,b.id AS id_pemeriksaan,b.`namapemeriksa`,c.`id` AS id_pemeriksaan_dokter,c.`nama_dokter` AS namadokter FROM ts_antrian_igd a
        LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`id` = b.id_antrian
        LEFT OUTER JOIN assesmen_dokters c ON a.id = c.id_antrian
        WHERE DATE(a.`tgl_masuk`) = CURDATE()');
        return view('ermtemplate.tabelpasienigd_dokter', compact([
            'pasienigd'
        ]));
    }
    public function ambil_form_igd_dokter(Request $request)
    {
        $id_antrian = $request->id;
        $data_antrian = DB::connection('mysql4')->select('select * from ts_antrian_igd where id = ?', [$id_antrian]);
        $rm = $data_antrian[0]->nomor_rm;
        $resume = DB::connection('mysql4')->select('SELECT * from assesmen_dokters WHERE id_antrian = ?', [$request->id]);
        if ($rm == '') {
            if (count($resume) > 0) {
                return view('ermtemplate.form_igd_dokter_edit', compact([
                    'id_antrian',
                    'data_antrian',
                    'resume'
                ]));
            } else {
                return view('ermtemplate.form_igd_dokter', compact([
                    'id_antrian',
                    'data_antrian'
                ]));
            }
        } else {
            $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
            return view('ermtemplate.index_form_igd', compact([
                'mt_pasien',
                'id_antrian'
            ]));
        }
    }
    public function gambar_mata()
    {
        return "data:image/png;base64,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oKugr78YjJAAAQIECBAgQIAAAQIE+gmkE3QV9H6TpGcCBAgQIECAAAECBAgQWF8gnaCroK+/GIyQAAECBAgQIECAAAECBPoJpBP0qILuOeieg+456P0+yHomQIAAAQIECBAgQGB+gXSCroI+/2QbAQECBAgQIECAAAECBAiMK5BO0KMK+rhDFBkBAgQIECBAgAABAgQIEBhfIJ2gq6CPP5kiJECAAAECBAgQIECAAIF5BdIJugr6vJMscgIECBAgQIAAAQIECBAYXyCdoKugjz+ZIiRAgAABAgQIECBAgACBeQXSCboK+ryTLHICBAgQIECAAAECBAgQGF8gnaCroI8/mSIkQIAAAQIECBAgQIAAgXkF0gl6VEH3HHTPQfcc9Hk3ApETIECAAAECBAgQINBfIJ2gq6D3nywRECBAgAABAgQIECBAgMC6AukEPaqgr0tkZAQIECBAgAABAgQIECBAoL1AOkFXQW8/GXogQIAAAQIECBAgQIAAgecKpBN0FfTnLhIjJ0CAAAECBAgQIECAAIH2AukEXQW9/WTogQABAgQIECBAgAABAgSeK5BO0FXQn7tIjJwAAQIECBAgQIAAAQIE2gukE3QV9PaToQcCBAgQIECAAAECBAgQeK5AOkGPKuieg+456J6D/tyNxMgJECBAgAABAgQIELgukE7QVdCvY2uBAAECBAgQIECAAAECBAgcCaQT9KiCjpgAAQIECBAgQIAAAQIECBA4L5BO0FXQzyN7JwECBAgQIECAAAECBAgQiATSCfqrob+3xtxrHLF6nQABAgQIECBAgAABAgQIlAmkE3QV9DJYRxMgQIAAAQIECBAgQIAAgRKBdIL+alQFvUTWsQQIECBAgAABAgQIECBAoEAgnaCroBeoOpQAAQIECBAgQIAAAQIECBQKpBP0V7tfK+ieg+456P42QeGnz+EECBAgQIAAAQIECBB4E0gn6Cro1g0BAgQIECBAgAABAgQIEGgnkE7Qowp6uxC1TIAAAQIECBAgQIAAAQIE1hdIJ+gq6OsvBiMkQIAAAQIECBAgQIAAgX4C6QRdBb3fJOmZAAECBAgQIECAAAECBNYXSCfoKujrLwYjJECAAAECBAgQIECAAIF+AukEXQW93yTpmQABAgQIECBAgAABAgTWF0gn6Cro6y8GIyRAgAABAgQIECBAgACBfgLpBD2q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";
    }
    public function gambar_mata_2()
    {
        return "data:image/png;base64,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";
    }
    public function gambar_telinga()
    {
        return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAH0CAYAAACuKActAAAgAElEQVR4Xuyd0bbkJg5Fk///6MytzlRSTQqfIyEwtndeZvUAQtoSMgL71p9/8B8EIAABCEAAAhCAAAQgAAEIQAACpxP483QNUAACEIAABCAAAQhAAAIQgAAEIACBPyjQCQIIQAACEIAABCAAAQhAAAIQgMAGBCjQN3ACKkAAAhCAAAQgAAEIQAACEIAABCjQiQEIQAACEIAABCAAAQhAAAIQgMAGBCjQN3ACKkAAAhCAAAQgAAEIQAACEIAABCjQiQEIQAACEIAABCAAAQhAAAIQgMAGBCjQN3ACKkAAAhCAAAQgAAEIQAACEIAABCjQiQEIQAACEIAABCAAAQhAAAIQgMAGBCjQN3ACKkAAAhCAAAQgAAEIQAACEIAABCIF+l8vXH/99dcff/7ZH0Y7fIgP1kcvtZIfyA/kB/ID+eE7AfIj+ZH8SH4kP5IfXwTCBTpnGhCAAAQgAAEIQAACEIAABCAAAQjUE7AL9J+T3b9eJ3vvE17+9++TXjjAgThgHZAHyAPkAfIAeYA8QB4gD5AHyAMVecAu0F9vt7/PB17B1/73VqZ3hkD730kLPt8JEB/EB+uD/EB+JD9+I8DzgecDzweeDzwfeD486fkQLtCPkmT9BT8SIQABCEAAAhCAAAQgAAEIQAACzyAQLtBfWCjSnxEcWAkBCEAAAhCAAAQgAAEIQAAC6wjYBfrnN+jr1GMmCEAAAhCAAAQgAAEIQAACEIDAMwjYBfrr4vyNhBv0ZwQHVkIAAhCAAAQgAAEIQAACEIDAOgLhAp3ifJ1zmAkCEIAABCAAAQhAAAIQgAAEnkMgXKC/0FCkPydAsBQCEIAABCAAAQhAAAIQgAAE1hCwC3S+QV/jEGaBAAQgAAEIQAACEIAABCAAgWcSsAv018X5GxG/g/7fYOF3WvmdVn6nld9p7T1GyA/kB/ID+YH88J0A+ZH8SH4kP5IffycQLtB5vf2ZJzlYDQEIQAACEIAABCAAAQhAAAJzCYQL9Jc6FOlznYJ0CEAAAhCAAAQgAAEIQAACEHgeAbtA5xv05wUHFkMAAhCAAAQgAAEIQAACEIDAOgJ2gf66OH+rxQ36OgcxEwQgAAEIQAACEIAABCAAAQg8g0C4QKc4f0ZgYCUEIAABCEAAAhCAAAQgAAEIrCUQLtBf6lGkr3USs0EAAhCAAAQgAAEIQAACEIDA/QnYBTrfoN8/GLAQAhCAAAQgAAEIQAACEIAABM4jYBfor4vzt5r8Dvp/HcbvePI7nvyOJ7/j2Uvl5AfyA/mB/EB++E6A/Eh+JD+SH8mPvxMIF+i83n7eaQozQwACEIAABCAAAQhAAAIQgMB9CYQL9BcKivT7BgSWQQACEIAABCAAAQhAAAIQgMA5BOwCnW/Qz3EQs0IAAhCAAAQgAAEIQAACEIDAMwjYBfrr4vyNhBv0ZwQHVkIAAhCAAAQgAAEIQAACEIDAOgLhAp3ifJ1zmAkCEIAABCAAAQhAAAIQgAAEnkMgXKC/0FCkPydAsBQCEIAABCAAAQhAAAIQgAAE1hCwC3S+QV/jEGaBAAQgAAEIQAACEIAABCAAgWcSsAv018X5GxG/g/7fYOF3PPkdT37Hk9/x7D1GyA/kB/ID+YH88J0A+ZH8SH4kP5IffycQLtB5vf2ZJzlYDQEIQAACEIAABCAAAQhAAAJzCYQL9Jc6FOlznYJ0CEAAAhCAAAQgAAEIQAACEHgeAbtA5xv05wUHFkMAAhCAAAQgAAEIQAACEIDAOgJ2gf66OH+rxQ36OgcxEwQgAAEIQAACEIAABCAAAQg8g0C4QKc4f0ZgYCUEIAABCEAAAhCAAAQgAAEIrCUQLtBf6lGkr3USs0EAAhCAAAQgAAEIQAACEIDA/QnYBTrfoN8/GLAQAhCAAAQgAAEIQAACEIAABM4jYBfor4vzt5r8Dvp/HcbvePI7nvyOJ7/j2Uvl5AfyA/mB/EB++E6A/Eh+JD+SH8mPvxMIF+i83n7eaQozQwACEIAABCAAAQhAAAIQgMB9CYQL9BcKivT7BgSWQQACEIAABCAAAQhAAAIQgMA5BOwCnW/Qz3EQs0IAAhCAAAQgAAEIQAACEIDAMwjYBfrr4vyNhBv0ZwQHVkIAAhCAAAQgAAEIQAACEIDAOgLhAp3ifJ1zmAkCEIAABCAAAQhAAAIQgAAEnkMgXKC/0FCkPydAsBQCEIAABCAAAQhAAAIQgAAE1hCwC3S+QV/jEGaBAAQgAAEIQAACEIAABCAAgWcSsAv018X5GxG/g/7fYOF3PPkdT37Hk9/x7D1GyA/kB/ID+YH88J0A+ZH8SH4kP5IffycQLtB5vf2ZJzlYDQEIQAACEIAABCAAAQhAAAJzCYQL9Jc6FOlznYJ0CEAAAhCAAAQgAAEIQAACEHgeAbtA5xv05wUHFkMAAhCAAAQgAAEIQAACEIDAOgJ2gf66OH+rxQ36OgcxEwQgAAEIQAACEIAABCAAAQg8g0C4QKc4f0ZgYCUEIAABCEAAAhCAAAQgAAEIrCUQLtBf6lGkr3USs0EAAhCAAAQgAAEIQAACEIDA/QnYBTrfoN8/GLAQAhCAAAQgAAEIQAACEIAABM4jYBfor4vzt5r8Dvp/HcbvePI7nvyOJ7/j2Uvl5AfyA/mB/EB++E6A/Eh+JD+SH8mPvxMIF+i83n7eaQozQwACEIAABCAAAQhAAAIQgMB9CYQL9BcKivT7BgSWQQACEIAABCAAAQhAAAIQgMA5BOwCnW/Qz3EQs0IAAhCAAAQgAAEIQAACEIDAMwjYBfrr4vyNhBv0ZwQHVkIAAhCAAAQgAAEIQAACEIDAOgLhAp3ifJ1zmAkCEIAABCAAAQhAAAIQgAAEnkMgXKC/0FCkPydAsBQCEIAABCAAAQhAAAIQgAAE1hCwC3S+QV/jEGaBAAQgAAEIQAACEIAABCAAgWcSsAv018X5GxG/g/7fYOF3PPkdT37Hk9/x7D1GyA/kB/ID+YH88J0A+ZH8SH4kP5IffycQLtB5vf2ZJzlYDQEIQAACEIAABCAAAQhAAAJzCYQL9Jc6FOlznYJ0CEAAAhCAAAQgAAEIQAACEHgeAbtA5xv05wUHFkMAAhCAAAQgAAEIQAACEIDAOgJ2gf66OH+rxQ36OgcxEwQgAAEIQAACEIAABCAAAQg8g0C4QKc4f0ZgYCUEIAABCEAAAhCAAAQgAAEIrCUQLtBf6lGkr3USs0EAAhCAAAQgAAEIQAACEIDA/QnYBTrfoN8/GLAQAhCAAAQgAAEIQAACEIAABM4jYBfor4vzt5r8Dvp/HcbvePI7nvyOJ7/j2Uvl5AfyA/mB/EB++E6A/Eh+JD+SH8mPvxMIF+i83n7eaQozQwACEIAABCAAAQhAAAIQgMB9CYQL9BcKivT7BgSWQQACEIAABCAAAQhAAAIQgMA5BOwCnW/Qz3EQs0IAAhCAAAQgAAEIQAACEIDAMwjYBfrr4vyNhBv0ZwQHVkIAAhCAAAQgAAEIQAACEIDAOgLhAp3ifJ1zmAkCEIAABCAAAQhAAAIQgAAEnkMgXKC/0FCkPydAsBQCEIAABCAAAQhAAAIQgAAE1hCwC3S+QV/jEGaBAAQgAAEIQAACEIAABCAAgWcSsAv018X5GxG/g/7fYOF3PPkdT37Hk9/x7D1GyA/kB/ID+YH88J0A+ZH8SH4kP5IffycQLtB5vf2ZJzlYDQEIQAACEIAABCAAAQhAAAJzCYQL9Jc6FOlznYJ0CEAAAhCAAAQgAAEIQAACEHgeAbtA5xv05wUHFkMAAhCAAAQgAAEIQAACEIDAOgJ2gf66OH+rxQ36OgcxEwQgAAEIQAACEIAABCAAAQg8g0C4QKc4f0ZgYCUEIAABCEAAAhCAAAQgAAEIrCUQLtBf6lGkr3USs0EAAhCAAAQgAAEIQAACEIDA/QnYBTrfoN8/GLAQAhCAAAQgAAEIQAACEIAABM4jYBfor4vzt5r8Dvp/HcbvePI7nvyOJ7/j2Uvl5AfyA/mB/EB++E6A/Eh+JD+SH8mPvxMIF+i83n7eaQozQwACEIAABCAAAQhAAAIQgMB9CYQL9BcKivT7BgSWQQACEIAABCAAAQhAAAIQgMA5BOwCnW/Qz3EQs0IAAhCAAAQgAAEIQAACEIDAMwjYBfrr4vyNhBv0ZwQHVkIAAhCAAAQgAAEIQAACEIDAOgLhAp3ifJ1zmAkCEIAABCAAAQhAAAIQgAAEnkMgXKC/0FCkPydAsBQCEIAABCAAAQhAAAIQgAAE1hCwC3S+QV/jEGaBAAQgAAEIQAACEIAABCAAgWcSsAv018X5G9GM30F/Jn6shgAEIAABCEAAAhCAAAQgAAEI/E0gXKDzejuhAwEIQAACEIAABCAAAQhAAAIQqCcQLtBfKlCk1zsCiRCAAAQgAAEIQAACEIAABCDwbAJ2gc436M8OFKyHAAQgAAEIQAACEIAABCAAgbkE7AL9dXH+VoUb9LlOQToEIAABCEAAAhCAAAQgAAEIPI9AuECnOH9ekGAxBCAAAQhAAAIQgAAEIAABCMwnEC7QXypRpM93DDNAAAIQgAAEIAABCEAAAhCAwLMI2AU636A/KzCwFgIQgAAEIAABCEAAAhCAAATWErAL9NfF+Vs1fgd9rZOYDQIQgAAEIAABCEAAAhCAAATuTyBcoPN6+/2DAgshAAEIQAACEIAABCAAAQhAYD2BcIH+UpEifb2jmBECEIAABCAAAQhAAAIQgAAE7k3ALtD5Bv3egYB1EIAABCAAAQhAAAIQgAAEIHAuAbtAf12cv1XlBv1cpzE7BCAAAQhAAAIQgAAEIAABCNyPQLhApzi/XxBgEQQgAAEIQAACEIAABCAAAQicTyBcoL9Upkg/33FoAAEIQAACEIAABCAAAQhAAAL3ImAX6HyDfi/HYw0EIAABCEAAAhCAAAQgAAEI7EXALtBfF+dv1fkd9L2ciDYQgAAEIAABCEAAAhCAAAQgcH0C4QKd19uv73QsgAAEIAABCEAAAhCAAAQgAIH9CIQL9JcJFOn7ORKNIAABCEAAAhCAAAQgAAEIQODaBOwCnW/Qr+1otIcABCAAAQhAAAIQgAAEIACBvQnYBfrr4vxtCjfoezsV7SAAAQhAAAIQgAAEIAABCEDgegTCBTrF+fWcjMYQgAAEIAABCEAAAhCAAAQgsD+BcIH+MokifX/HoiEEIAABCEAAAhCAAAQgAAEIXIuAXaDzDfq1HIu2EIAABCAAAQhAAAIQgAAEIHAtAnaB/ro4f5vG76Bfy8loCwEIQAACEIAABCAAAQhAAAL7EwgX6Lzevr9T0RACEIAABCAAAQhAAAIQgAAErkcgXKC/TKRIv56j0RgCEIAABCAAAQhAAAIQgAAE9iZgF+h8g763I9EOAhCAAAQgAAEIQAACEIAABK5NwC7QXxfnb1O5Qb+209EeAhCAAAQgAAEIQAACEIAABPYjEC7QKc73cyIaQQACEIAABCAAAQhAAAIQgMD1CYQL9JfJFOnXdzwWQAACEIAABCAAAQhAAAIQgMBeBOwCnW/Q93Ic2kAAAhCAAAQgAAEIQAACEIDAvQjYBfrr4vxtOr+Dfq8gwBoIQAACEIAABCAAAQhAAAIQOJ9AuEDn9fbznYYGEIAABCAAAQhAAAIQgAAEIHA/AuEC/YWAIv1+gYBFEIAABCAAAQhAAAIQgAAEIHAuAbtA5xv0cx3F7BCAAAQgAAEIQAACEIAABCBwbwJ2gf66OH+j4Ab93kGBdRCAAAQgAAEIQAACEIAABCCwnkC4QKc4X+8kZoQABCAAAQhAAAIQgAAEIACB+xMIF+gvJBTp9w8MLIQABCAAAQhAAAIQgAAEIACBtQTsAp1v0Nc6htkgAAEIQAACEIAABCAAAQhA4FkE7AL9dXH+RsPvoD8rSLAWAhCAAAQgAAEIQAACEIAABOYTCBfovN4+3ynMAAEIQAACEIAABCAAAQhAAALPIxAu0F+IKNKfFyhYDAEIQAACEIAABCAAAQhAAAJzCdgFOt+gz3UE0iEAAQhAAAIQgAAEIAABCEDg2QTsAv11cf5GxQ36s4MG6yEAAQhAAAIQgAAEIAABCECgnkC4QKc4r3cCEiEAAQhAAAIQgAAEIAABCEAAAuEC/YWMIp3AgQAEIAABCEAAAhCAAAQgAAEI1BKwC3S+Qa8FjzQIQAACEIAABCAAAQhAAAIQgMAnAbtAf12cvwfyO+gEEQQgAAEIQAACEIAABCAAAQhAoJZAuEDn9fZaByANAhCAAAQgAAEIQAACEIAABCDwIhAu0F+DKNIJHghAAAIQgAAEIAABCEAAAhCAQC0Bu0DnG/Ra8EiDAAQgAAEIQAACEIAABCAAAQh8ErAL9NfF+XsgN+gEEQQgAAEIQAACEIAABCAAAQhAoJZAuECnOK91ANIgAAEIQAACEIAABCAAAQhAAAIvAuEC/TWIIp3ggQAEIAABCEAAAhCAAAQgAAEI1BKwC3S+Qa8FjzQIQAACEIAABCAAAQhAAAIQgMAnAbtAf12cvwfyO+gEEQQgAAGfwJ9//nn45tHd2xUpZb8aTzsEIAABCEAAAhC4C4Fwgc7r7XdxPXZAAAIQgAAEIAABCEAAAhCAwE4EwgX6S3mK9J1ciC4QgAAE/ibATTSRAAEIQAACEIAABK5NwC7Q+Qb92o5GewhAAAIQgAAEIAABCEAAAhDYm4BdoP+Ywe+g7+1LtIMABG5C4H0Tvtv/vvFyU3+TQMMMCEAAAhCAAAS2IxAu0Hm9fTsfohAEIHBDAm0RfPa/b4gYkyAAAQhAAAIQgMB2BMIF+ssCivTt/IhCEIDABQj0iuzdbsqj+nCzfoHgQ0UIQAACEIAABC5BwC7Q+Qb9Ev5ESQhA4GIEzr4Zr57/YvhRFwIQgAAEIAABCGxFwC7QXxfnb835HfStfIgyEIDAIAH1TbXbHr15flr/nptcvoNuZvhFCeweH2frd/b8Fw0r1IYABCCwLYFwgc7r7dv6EsUgAIGNCLivs79V7hXrs9tnHxJs5BJUgQAEIAABCEAAAtsTCBfoL4so0rf3KwpCAAITCLhF9+yi9+ryJ7gGkRCAAAQgAAEIQOAWBOwCnW/Qb+FvjIAABCYTqP6m++7yJrsD8RCAAAQgAAEIQOBSBOwC/XVx/raMG/RL+RhlIQCBIIGr31DfRf+g2+gOgV8Ezor/N/7qQ7WoW6PzR+XTHwIQgAAE5hIIF+gU53MdgnQIQGBPAtFN71P6t8VQW6REi6U9vY9WVyNQvf6uZj/6QgACEIDAdQmEC/SXqRTp13U4mkMAAn0C0WKS/n/+eh7M5kDMQsAhMDsOs/Id3Wf0UX/dfcacyIQABCAAgXECdoHON+jjsJEAAQhcj4Da5Kr261n8u8bVN5HuX6u/Ojf0P4fArHg9xxpmhQAEIACBJxKwC/QfOPwO+hMjBJshcAECqkjmr6+vuenO3jBmx71DM+r/C4T0rVTMFs0qLlr/q/5nt/fiNctnlrw2+NT6ulWwYgwEIACBDQiEC3Reb9/Aa6gAAQiUE6jeJEc3uWoTrNoVEDW+2v5ZhyLKTtrvScCN39VFuDokuKc3sAoCEIAABGYSCBfoL2Uo0me6BNkQgMAsAqs378y35uZ+Vrwgt5ZA9hCoXUeqKN5t3dVSRBoEIAABCNydgF2g8w363UMB+yDwDALRIuEZVOqsjPJ1+/eKtDrNkXQHArsU53dgiQ0QgAAEIHAOAbtA/1GP30E/x0fMCgEIBAnssklHjzU36KrID4YP3QcJKH/01sV7WnfdHPV/t/V+ZWB2+7d5W32r/t26y+Xfm3/Q/QyHAAQgAIFBAuECndfbB4kzHAIQOIUAm9Za7O43waNFiFusKX1qrUfabgSicbKq/26c0AcCEIAABPYnEC7QXyZRpO/vWDSEwBMJrNp0R7+JHS1Sq8dH9T+La9W8T1wLV7B59NDMiY83h+xNem/c+/9X8tkvXSES0RECEIDAXgTsAp1v0PdyHNpAAAIeAW5WPU5n9aoq0nqHGGfZxbxrCTjFuiq2j9rb+HLnW0uB2SAAAQhA4A4E7AL9x1h+B/0OHscGCFyQgFvEuZtm+q39NnwX3r3Q5xCnNimcsV7fFrQ3261l0XZ1896TX/ENenTd9A6pov5obWJ91K4PpEEAAhBQBMIFOq9rKaS0QwACZxBwN6Fn6Macf/wR9U+vf7ZowQf3JhCNi1X9q6j39K2SjxwIQAACENiHQLhAf6lOkb6PA9EEAk8mMGuTPXoTdbfxszifJffJa+ZM291Dl+j6OYqjtyx1Ex59/b3l6IxX7KvWg5qnbe/9TYqoHPpDAAIQgEANAbtA5xv0GuBIgQAEIACBPIGqm/i8BozckUBVcVstZ5RVNN5H52M8BCAAAQicT8Au0H9U5XfQz/cXGkDgkQSqN81ZeW/46nXT6Kb6rP69m7Msn6uOe+Simmi0G8+V8fI2J/qNeYvB/evsPXxH49v8of49ykfJd/PZxFBBNAQgAAEIfCEQLtB5vZ04ggAEdiCg/nCRat/BBnToE3CLPFVkqCIHH9yDgPLzWe1Zuqvz1+r5slwYBwEIQOAJBMIF+gsKRfoTQgMbIXA+gapNdfQmKdu/JaY2vdH2bNGatWfWfFV+rZZzfsTfS4NV8f0tDlqS2W/Q33La8a78yH6p6s2c3psxvfzk9r9XdGINBCAAgX0J2AU636Dv60Q0gwAEIPBUAtlDBIqSe0RM9SGNWyRH570HbayAAAQgAIEVBOwC/UcZfgd9hUeYAwIPJNArsqKb4Gj/9ma5V7Rli8BW/u7/VvZH+V69f89fvZvIBy7dryZn18tI/L0VufI36NXrJZpvFH/iGwIQgAAE1hAIF+iR17XWmMAsEIDAHQmoTf4dbcamPIGqQ568Bow8k0B1cVslr4qJutkfnUd9jjAqn/EQgAAEIOATCBfoL9EU6T5gekIAAj6B6k2xKvJH233LanqqTXS0fdT+qvHq5q4qLrJyaryHFPcQ5U3Kja8jv75lnfkNulqXyt5o3Pbk9SJwdvFP5EMAAhCAQIyAXaDzDXoMLL0hAAEIQOB8Atki73zN0cAhEC1ez+rv2OL0mVVM9w7JHJ3oAwEIQAACtQTsAv1nWn4HvZY90iAAgf8TWLVpfgN3iza3f+tIdWMWba/Wt0re7jff1XHFgvUIuPFV6Z+3ZtXfoLdyo/I/b+7dfFLFZXQ+z9v0ggAEIACBagLhAp3X26tdgDwIQOBFQG3qoQSBCAEVT24RFJmTvusJuH48u1+UjBu/Ubm9/tygV5FEDgQgAIFxAuEC/TUlRfo4eCRAAAL/FuWjm+c3S7WpbZmrm+yn+0jxPKv97Jv7p8eFa79aX734UfmgXe9H/d99z/wGPcpL2a/ae/mwl/9mvTbv2k0/CEAAAhD4nYBdoPMNOqEDAQhAAAJ3I+AWiXez+y72qGK1qj1yKPDtMMDlHT30cuW6/dShiiuHfhCAAAQgkCdgF+g/U/A76HnOjITAowlUbZKjctpN9ap/t85Wm97q9ugmv6r/2Tfb0fgY7d+Lp6ct9mz8jPL/HP9mHv1GvPVVb3xbdPd83I6PfINeyePzTUfXP2r+p8U19kIAAhA4i0C4QOf19rNcxbwQuBcBtWm8l7VYczYBFW+qOOkdPpxt11Pmdw+xon589W+L+97r8Jn/P+qfqP5R+b3+vOZeRRI5EIAABMYJhAv015QU6ePgkQCBJxKIbj7VptEtut6s1Sb/iT6J2DzKe9b4qrjKyokwfHLfnv+j3Nv1fDReFd+z27/doEeL5Cgf9zDJlfvkmMV2CEAAAmcQsAt0vkE/wz3MCQEIQAACKwm4ReRKnZirT8AtMs/ul/WhOqRs5WYPId2iPmsH4yAAAQhAwCdgF+g/IvkddJ8rPSHwaAKzNsNvqGrTWn1TG90Eq03y1dqrebryZsXRLLmPXvQfxp/h3/f0fIP+1z8/Wdkrut1DKJWniHcIQAACEJhDIFyg83r7HEcgFQIQgAAE1hGoLiLXac5M3wjMOnSpkjvba+rQUs0/Ol7Jpx0CEIAABHwC4QL9JZoi3QdMTwg8mYC7uX0zcoumXv+WNTdA50bfqD9njXfjMtvvXOr7zK7Wn+tfdRN85Kc3jerfQT/6a+3Z18WzPFSc9iJCjVP+2yfS0AQCEIDAvQjYBTrfoN/L8VgDAQhAAAKagPs6sJZEjxkE3CLz7H4zbP8mM1tUKz6r9GceCEAAAhD44w+7QP+Bxe+gEzEQgMBXAmpzl21/T+beLFX1b41cPf/ofFfVf+SmNPMTWNm4dMf14vHuacSNX5ej0+/NdNY36Fn5Z/4OulpPbXwqzr24zR4K3H0dYB8EIACBLIFwgc7r7VnUjIMABCAAgV0JVBeVu9p5Vb1UEaiKy7PbZ3Pv2efOq/i4cugHAQhAAALjBMIF+mtKivRx8EiAwB0JqE2eWwS1Nzu9f7cM1SZ+NnM1v2qfrd9s+cq+av+78tRNohu32X6zuV9Ffs9fUa5tPjga/+7rfoPe9h8dP+N30CP2H+3XstyvEm/oCQEIQOCqBOwCnW/Qr+pi9IYABCAAgSoCbpFZNR9yjglEi8yz+u/uR8Vld/3RDwIQgMCdCNgF+o/R/A76nTyPLRAYIKA2c9n29mao6t+tqbve9FbZG7VvVz5n33xn43j0deOBpbnF0OybDSO834Y/+Rv0aP6IvnnQkx8NOpWfovLoDwEIQOBuBMIFOq+33y0EsAcCEIAABNQhhXtz3jtUgPBcAiPF/Yo/MDjX+nHpLr/xmZAAAQhAAAKKQLhAfwmkSFdYaYfAMwhEN3XuzVrVTc3ZXhi9KRodf7b9av7ReJg13o3raD/F427tKn7dQ49ePnD4v8e636C3/UbHR/ZL2XhWb5r04srh941bNk6VfVm5jIMABCBwNwJ2gc436HdzPfZAAAIQgMAoAVV0qCJ1dCK0GRIAACAASURBVP6nj88WmavH7e4nxWN3/dEPAhCAwJ0I2AX6j9H8DvqdPI8tEAgQUJu3bLu6GaP9bwLRInC0fxsao/KqxqubwmwcnjWuF9+BpblF16x/K7m/QbjfoKub8h5YV36rz+dN+lm8jvLpN30//VNhj/L3FsGMEhCAAAQ2IBAu0COva21gHypAAAIQgAAEhgm4RRVFyDDqlADF/az2lDEFg6JvbkT5RFVU6ycqj/4QgAAE7kwgXKC/YFCk3zkksA0CfQLuJu4tQW3KVHurSXTTGR2v9FHzR8eP9h+1b7dYH+WRHX/Wzfxu/Gfr4/pH5Zk2vxzd9PZsam/C1b/fctyb98jvn1flyx43JV/xVu09xmqc0nd2PCIfAhCAwK4E7AKdb9B3dSF6QQACEIDALgR6RWjvEGAXva+uR7YYXDVud75RDll71CFNVi7jIAABCNyJgF2g/xjN76DfyfPYAoEAgejmTd2MqE0a7X/+9qbSbB5tKETfFFDjZ+vvFsVVcVwtJ7AUL9HV9XclxzeY7Dfi0fG9eXo38RXfoL91zHJrxx/Ja3ms+Ck6DrEusbxREgIQWEAgXKDzevsCrzAFBCAAAQhsTaCqCN3ayAsply1aV41bjVIdsvUO1UZ5RA4BKn/CbTVf5oMABCAwk0C4QH8pQ5E+0yXIhsA+BNzNmtqUue29TWOPiNqEukWUq9/u8qL89om075rsyttdF26/3f2Q1S+7Pns3qQ7Pt66zbtLVN+iVRadj77ebefUGU5vv3HlW9cvGG+MgAAEI3IWAXaDzDfpdXI4dEIAABCCwioD7+v0qfe46z6riMTtPlrs65FBy3fFZu6oP0ZQ9tEMAAhB4AgG7QP+Bwe+gPyEisPGRBNwiIrqJa29qzv539GZO3TRdrb2Kf7tIqjfpWXlR/0bjeVV/xXf3JOX6b5TnZzz3mGRv0qM35e/5K79BH+Wjxh/lL8ceJX+0vZevdo9/9IMABCAwSiBcoPN6+yhyxkMAAhCAwN0IVBWld+Oyyp7RYnD2+CgHV5+eXPc1d3XI6OpR1S/Kif4QgAAE7kggXKC/IFCk3zEUsAkCf/zhbrJ6NxtukaI2lVXyo/rQ//e/Hl+9JtTrttH2Vf5afTNfzX0Xee6bOtH1/+mf91j35lzdlPfYqd9Nz3yL7ubf0X6tTaPyZo3fJW7RAwIQgMBqAnaBzjfoq13DfBCAAAQgcHUC7iFC7xDg6vav1n9WsTh6SJPloG7Co4da6nB0FT81T5YX4yAAAQjcgYBdoP8Yy++g38Hj2ACBLwTUZsltj958ze4f3VS3+lSPdzm6m3Kl32y+arO/an63CFb+HfXPrPFXS1quPxSvaPyM3KS/58rcjL/mVeMzv4Ou+Iy2H60HZU/bPuN30q8W9+gLAQhAoIpAuEDn9fYq9MiBAAQgAIG7EqguUu/Kqcqu0WJ19viona4+vUOMXvGtDtXceVf1i3KjPwQgAIE7EAgX6C+jKdLv4HpsgMC/35z3NnNukdHbJKrXL5UPqudH3u/fmEd5KH9Vt6v4ieq/qn918VLNdRd5M/zxtq36JrxllrkxVtyr4sbN56pflT6jchQ32iEAAQjcjYBdoPMN+t1cjz0QgAAEILCagFuU9j5fWK3v1eYbLQZnjc9yVPGi5KpDrnb8LPujcpVdtEMAAhC4MwG7QP+BwO+g3zkSsO3WBHqbvOimKdq/vaEZ/XevaInqRf/vN+mK76j/zh6v7Ns9LnpJKlqErU52qsh02x3/tba5f829x6Q33v3r75/9ovE/Ox5bfT7ne7e5byK0/RWfGW8grI5r5oMABCAwi0C4QOf19lmuQC4EziWw+yb/XDrMDoExAtkilJv0GPfZRW1WfsyK/k9eZg9pVH7P2jV7XJQb/SEAAQjcgUC4QH8ZTZF+B9djAwTm/+55y9jdJLY3O2f/27m5O7opm72JVfrN4jfq39nj3aJ4lM9Z/r1aDqvyx1G8v5n0bmiz7S3rjHzlr1VvOvXW3Wv+LJ/Mjbi7bhQ32iEAAQjcjYBdoPMN+t1cjz0QgAAEIHA2AbdoVYdbZ9uxy/xu0be6X5ZP1O/R/kfF+syiW/HP8mIcBCAAgTsQsAv0H2P5HfQ7eBwbIPBDQG2Oeu1veG5RMbu/ujnO2vnUca2/FN/Z/j1b/u5xcJVkls0Xiv9RvL7bot+gq2+uW7mq/1O/Qe9x6vFyDgOuEu/oCQEIQGCUQLhA5/X2UeSMhwAEIACBpxNwi1Z1WPZ0jq39qqg/qz3qp1G/R2/Sz+Ki5o1yoz8EIACBOxAIF+gvoynS7+B6bHgiAbXpc4uG9uaqx1JtEkfny45XN8Nq07hbe+sPZV/Pf1me2bUUjY/oPKP2ZMevjo8ol1369/iq+I22f/Z/2575hvwlpx2v/v3tBl3xV/Gj1rs73jncGOXl3Ixn9VUcaYcABCBwVQJ2gc436Fd1MXpDAAIQgMBVCEQPBa5i1yo9VbF3VnvWfnWIpeRGx5/FR82r7KQdAhCAwJ0I2AX6j9H8DvqdPI8ttyKgNmFq85Ntb29yRv89cjNWcVOT5fDUcaP+3m381eNv16TmHjpE+bfxc3RT3mMT/Ua9lcM36H/9+psm7/9cHqr/t3y+a3yjFwQgAIFqAuECndfbq12APAisIaCK+DVa7DuL4rO6XRU1LUml377k0exFQPm7dwh0F3pV8bvrYVnUT6P+VvHU0+cu/KK86Q8BCEBgJwLhAv2lPEX6Ti5EFwj0CWQ3W2+JapO3S3vWzqeOa/2rbi6z8RA9RFBFWrT9qfG5a07s+aMXfyp+XHlHN+vtTe17Tvcb9R7rzA2wm4/UelRyIsV5yyP67xlvNu0a3+gFAQhAoIqAXaDzDXoVcuRAAAIQgAAEvhMYPVR4OldVnJ7VnvWLOpTKyo0U6TOK7Kgfqu1EHgQgAIGdCdgF+o8R/A76zp5ENwh8EIhufkaLgux4dXObtYNxf/5606mawzvE1Ou32Xho5e/+72q+1fJ2SYpuPKh8oOLv6Ka8xyL6zXQrxx3/+eZhlkcln2/6OPxce9+cqvrz5uYuqxk9IACBFQTCBTpJcoVbmAMCEJhNQN1MuZvo3YvI2RyRP4eAG3/u6+FztNxPavUhR7U8l5g6BHPlZPtV210lL2sP4yAAAQhciUC4QH8ZR5F+JRej65MJuJuiqiKzZe0WGdH5Xbvo592kR/nP6l+9VmfF36j9q+Kymme1vFn+idwEz/4G/c3M2Td9i4vP8dW8evk6wu+bfkfjK97sqY5D5EEAAhDYjYBdoPMN+m6uQx8IQGAFgepNsZKnDjmi7SsYMcc6Aip+1Jsh6zQ9Z6ZVhx/ReaI0zn4zImrf7P5RfvSHAAQgcGUCdoH+YyS/g35lT6P7pQmoTfeszdEbWrQo6PWfpSdyvZvy1Zza+OkVHVXxNRqvSr9o+2rear5eElT5RSVPNd71byXft87Vv3OuWPTaj/6qu/Jbrz0a7xG+WX5V35y38zv8sr5hHAQgAIHdCIQLdOc1rd2MRB8IQOD+BNwiQG1qs5vlWeOUvtn2+0fEvSx04/vsm9csdVXkR+XOWo+jcl07zvbjqJ2zxrv86AcBCEDgygTCBfrLWIr0K7sc3e9MwN0UZYs6t0iIynf1vkK/t+3uTVLFN5mruUT9+/T+kZvLmfFwdu7r5Q8Vv9H4+ZQXXY9tf/WNeo9pb/0f7Z8Uh2z+VXJbvpX8FH/FN/N78mfHOfNDAAIQGCVgF+h8gz6KmvEQgMAOBLJFgtrkzm6PFik7sEaHegLZIq1ek70lzl6PWflnU3PfVMjat2rc2RyZHwIQgMBMAnaB/qMEv4M+0xPIhsAAgapNUbYIvGrRe8Std/Mz4CZr6NHNW5Wfz5LTxpe6Wa6Ox2p5Sv+zOLvzWgFZ0Mk9VFB6R+LHXb/umy4uht4375FvqHsclP2Kn2o/kt/jGeVX1Z83Od2IpB8EIHBFAuECnaR4RTejMwTuR6Bq0682rZn2djO74rVll0evSL1fhNzbItffvUOE3em4N709OzLrduY6jdoz2t89NL0avyiX3eMc/SAAAQh8IxAu0F9CKNIJJgjsScC9eekVae6mf3T8Tpvn3s3Qag/vfHPe+lvdHI/Gx9PHz14fq2NbFYEqvqLx9tnfXd/u+quQp3jM9r97aPPq17O36ia8lc836busTvSAAATOJGAX6HyDfqabmBsCEFCbWlXUrd70rp6PCIHAi4A6ZHsKpdXrz50vyl/dGCt/q3alj2vX6n5Kb9ohAAEIXJmAXaD/GMnvoF/Z0+h+aQLuJi26SWqLWnVTFW2P6jOzf+8m6GqBseI13Jl+iOgfjU91SKPao/Gt9NuFY/TNmnZNqPyj1pAqEqs4ffrDXe/Rm+DW1t435z0mn/EfjccqTm48fHsTIWp/lK/bn7/urlYd7RCAwJUJhAt0Xm+/srvRHQL7EnA38TM2tb3NvLtZnD1+pKhVvHrt+0YKmn0j4K4f9/Xm3Sgr+3qHCrOLWkf+Z37IclX2Z4puZz/n2BfJT9XysjwZBwEIQGBnAuEC/WWMk9R3NhrdIHAXAu6mLFukuZtCJb96UxaR1yuerx4DZ26KFf82HtTNtIqfu7crPor3aPuqteDmk6g9Kt6+3QS7h2/qm+geu6Nv2ntjenyiPKL9lT4j/Hr51+WvxrMfXbV6mQcCEFhJwC7Q+QZ9pVuYCwLPJaBep525iW03g2pzXt1eWXS7Re1zI+2elrtF8D2t/9eqaJG6qn+Uu8qHrbxq/6/ikp0nypP+EIAABK5AwC7Qf4zhd9Cv4FF0fASB0c1MdBM3syiuKkp7Ny13D4gqfleQ0x46qJtn95Aiux7U/Nl1eta4WWvF5Ttq91F89Gxzb3LVYZybf67+Dbr65j7a7vLv8f3Gc1YcIxcCEIDAKgLhAp3XiVa5hnkgcG8C7qZdFWWZTb3a7O3eHimmq4rUe0fj/axz11fvkGF3IupmOZMXIusqK38WV9ffvXyg9Mrau2qc0p92CEAAAlciEC7QX8ZRpF/Jxeh6RwJq01NVlGU3fUq/yvZeMX1Hvx/ZtKK4yPrt7Hi82vxn38yvWjvVb+Y4h3k923rrp/qwLrJ/yq636Lgek29yqnlE5R3luVVxyzwQgAAEZhOwC3S+QZ/tCuRD4JkE3EOA6KaT/n/+Okx1bxqfGX33t9pdX3clUZUHnOI/ckh2Nd5VHGfJuRpP9IUABCBwRMAu0H+E8DvoxBIEJhGIFlFVmxy16VTtVXo4cno3LZNcclmxkSLB4b6zPBWfZ7ffjW92UbiHBKO8jvzd0939Btr9Bl0x2vkb9KM3N5RdLt+2X9U360eHker5mrWNcRCAAARmEQgX6JHXs2YpjVwIQOB6BGZu0nvFu7v5vtv4SFHdFjXuv9sIZBN87pp015c6tLiKH5Weo8X+7PHV0aJ4jK7X2Tyq5FdzRR4EIACBMwiEC/SXkhTpZ7iKOSHwxz+vK6vNjFtkZTf17iZf6ZlpJw48ApEiPeOHmfJXx+/Z8x3dXM7k7Prdizjdy803rl69fkf5qfowrncDrP7/b/uoHp/V8dEr5l96VPOrlsf+VK9DekAAAvsTsAt0vkHf35loCIErEHA3oZlNervZixY3avzu7RF73aL0CjGFjj4Bt0j2JZ7bU90cZ/JIZB1l5Z9LLT971t5V4/KWMRICEIDAPgTsAv1HZX4HfR+/ocnDCFRtbtyirGq+ETm9m5WHuX7Y3BXFxoifK/Vr4zt68zi6Pkbn34WjupmOBqV7KDBq/xH/Xj5xP4N5wjfoKv4//dOLgeg35a0c1x/Kn9ykR1cp/SEAgZ0IhAt0kt5O7kMXCOxLYOamXG3Ont4eKXrVptxt3zcSn6lZ9fo7m6Kyp6ffaNE/a/zZPLPzz+JRLTdrH+MgAAEI7EAgXKC/lKZI38F16PBEAupmS21iq9qrN1NH8p7o5xk2R4r2lf79fJ7sEt/uoUTVemrni978n+Wv0Tjt8Ru155Nne1inbsKj7aq/mv9oPzUrvtz4bv17dINedfM9erj6Lc+NxinjIQABCKwmYBfofIO+2jXMB4F7EJi1CR/dxFeMV5vvs9sjRfk9og0rogTc9RmVu6p/q/9RURlZDxX54Wi+VXyq55nNpUp+td3IgwAEILCSgF2g/yjF76Cv9AxzPYrArE3mG6J7M1m1OcrIeZTDTzR2pyIlEycR/Ufjf3T8bPvOlt/y6YW1exM80572sMz9d2uTuilW/T/n7fGLHppk8/tIfK9KYdFv2jOHIur5u8pW5oEABCDwT14OoPhVoPN6e4AYXSFQSGD3TcTMTbi7mVab56e2jxS10SLCLdIKlwaifgi460/5UxXJs2Cr/Ba1TxWfys5V7bN4zpa7is/oPLM5IB8CEIDADAJlN+gzlEMmBJ5OwN2cqE33aLurR0W/p/t8lf2Ror3Cr5H5VHE1Gs9XG7+af3Q+N2bdIjw6f9v/KH7UYZ/6plzFcU9+y+hTTpSfsrcqvlu9vvlF8Ty7nUslN7roBwEI7ETALtD5Bn0nt6ELBPYl4L6emdmEt5u96GZajVeb79F2NX90Mxu133n90y2i9o3AZ2sWvWl2+/eKwt1pZ/LM6Dp3xu/OTem3K1f1ur+yi3YIQAACOxCwC/QfZfkd9B08hg6PIJDd/LQ3J+qmJdqe1Sty8/IIB29kpFNMVPp95nyz43+2/KtwHi2CZh7i9eKrd/jVLsXeN8/qMKy3pF15nze9s/i08Tv675ee1f9lvzlXh5vcpFd7CnkQgMBMApHsyjfoMz2BbAhcjED25s0pQtRma3W72pyr9tX6qvkyN+muv3ub/ouF93bqqqJYvfmgDMoWhUru2e1Ovpl5aKTmz/IZ9Xd2XnVIpew9u33UbsZDAAIQWEEgXKC/lOIkcoVrmAMC//7hJ7Wp6RVFo0WVmreiHT/vQeDMIkXF0ez43k2+4qHaR+1R8lW7G9HZ/OTOr/p93gC7N+9qnajDsbY9sp9y7HFu4rPx0fr1G7+o/av7R3i7cUw/CEAAAtUE7AKdb9Cr0SMPAvcgkL15czebT+73bTO/ikdvE3+PqL2OFbvclLpF3W5kV62X7DyjvHaJj6z9q8eN8mY8BCAAgRUE7AL9Rxl+B32FR5jjkQRmFbntprrdDKn2ys3TIx17QaPVDSHtf/3zk2aV6yPD1S2aZ91UK/uj+s3MT+1hV29ptt9AR//dyj3zG3SV31V7xB9npbrsN+tHbxqcZQvzQgACEPgnLwdQ8A16ABZdIXA3Au4mX23av7X3Ns/RzXFVf/VN+Wj77vZ+2hctstz+d1sfo/b01s2o3Krx7vqvmi8qp3eTnMlHmcOS7DxRO3dbX1m7zx6X5c44CEAAAisIlN2gr1CWOSDwNAJq0x7dNGf7V26mnubDq9jbO9xYWay4cdYWKZGbvpnf6M5aX72irI0t9bpzVbvyU7aIzOa7iP/V4Vj08E31d+Zzc4TinuUXXU/f+rc2RG+21fhZh698k+5GH/0gAIGVBOwCnW/QV7qFuSBwHQLZTaNzk75jcVhp75Xsc4vE60TuHpqqomoPLddpoQ4Roprsul6jduzef1fOrK/dIwf9IACBbwTsAv1nML+DTgxBYBGB7GanV0T1bvay8zjj3rqom5RFSJnGJHClm3QnDisPQdr1Fbm5zegRXc9X7z/Tn24+UvlKrY92man+I5+TRHmp+FDyjsab6WV6N/em/dt6nK4cE0AAAhAwCYQLdF4HMsnSDQI3J6A2c0ftvc2yu7lqx6vXTDPF0Yh9u8+n+B3przb52fabL5f/mMfN3rHH1ecC0XjZdT1H7XDXV1ZudtyufJVeWXsZBwEIQGAmgXCB/lKGIn2mS5D9ZAJq0642rVXtalMTae8V43fzc/TmrbV/9vgo750OGdqiJHpz7RY1VetHzafWT29860P1OvjsdhVT0fkVF/dNIBUvn/O0+Wn0sK+X75xDL5eny6k6nnv6HfFUPFa3V/hB+Yl2CEAAAqME7AKdb9BHUTMeAvckEN0s0v/PX4ecV+fgFpH3jPq8VapozUu+58gqXrPXW+RQ4M6XHLM5z5J/z9WDVRCAwFUJ2AX6j4H8DvpVvYze2xPIbjrUplC1Z+f9Nq53E7I9fBQ8JBD5hrYynu5wiBHl0Tv0qL4J3VXeKK+j8W5+ir7J0rtx783n3OC6/pnJ6/MQIaLPbunU/Wzq6Jv0qkOi3digDwQgsC+BcIF+55Pffd2EZhA4n4D7emmkeHc3T+1md/Q11CcWf5HiJcJnVlF5fsTXatDyr5V+P2mqKIxaHC1mV/WP2tHrv0sRuYrbrHmq/IEcCEAAAiMEwgX6azKK9BHkjIVAn4C76aguitx5nX5tMX1Vf2dv0nr2Zw8jquSN+iFStDtxMlNeuz56xXFPz+h4tR7d4lwVWSOHZJ+8s0VeVL92HlV0u/Yp3kf+G11PKm6j8o9ubl1+ar0pXmp99MZ/08/NM9H82sqdlU+ddeLaSD8IQAACWQJ2gc436FnEjIPAvQi4m2jnJl1tdmm/zrfq7ib+XqtBW+MW51qS10MV0Z6UfXpV2aOK2NF2daij5O9DfEwTZedV2scoMBoCEIDAGAG7QP+Zht9BH2PNaAh0CVRtWtQmUbWP6PEU9866uXnzmy1/1E8cmtQdmvQONUYOwUb8E9VntL+6uVX5aCSf9dZB9Ga3xzu6nrPffEf8HeXl+veb3NE8kx1flT8jbzZkdWUcBCAAgR6BcIHO6+0EEwSeQcB9HVVtol/t0c1q259vzuuKwoy/RooAd5Ov4u1qq272zXn16/m78VX2RfV14j4S59XyovZU9696UyF6CFDNsVpeNWfkQQACEHAIhAv0l1CKdActfSAQJ6A2paqIqWqPbHJ6xXfc+rkjqm5W1GFD9DBBHUaMFg1KX5d6j9+ofhXjVVEQbR89VHCLc1UU7XaT7sZKNb9IPorGk7s+3Jtytf6d9e5yjub7Vq7LtefPnp6fct3nQ/bNhaj/VP+j+HH9Qj8IQAACowTsAp1v0EdRMx4C9yDgburod4/fO3f9GN3E32M1/NcKtzivsl8V+Wqe0fFK/mh7lX5uHGf7qUMgJXeU027jlb1Xa9+NL/pAAAL3JmAX6D8Y+B30e8cC1p1IILtZUZtC1Z6d99u4E/FNnXrVzfvbiFk31T35o/CiN5ZP7t87xDjrpnx0/Y/aszI/uTfbaj30bnqz8p0bW/emfNSfvcOl7Jtdr3Fn/1d1M3/0TXrVIdLZrJgfAhDYh0Ake/4q0Hm9fR/nocm9COz2kB8pGlSxqdrVZvfJRV71JtyR1/orwj9axLn9d1v9s2/O3SLtqvxaf2bt7eVRJ84jcT1L3llxrZ4/qr3nv1mczpJ7ln+YFwIQeBaBcIFOkf6sAMHauQTcTYa76R7d1Lr6fPabSygvfdXN990OE1zis276dyqS3JtDtW566zdblKr5Rtuj+UbdvEbtH9X/aLw6HOy1t75y41/Nd3Qzq9aim++reSq9Pv3d6xu92Xb5K96j7SP+crnRDwIQgIBdoPMNOsECAQi8CIxs9trN0Q7F2Ig9Z+o/WkTNttvV7+qrShXxV7fvavqrm97ZcZ+VP4uzik9V5I/qleWx+7hRLoyHAAQgcETALtB/hPA76MQSBCYRcDcjbdGjbq5cuZl+k1BMFxu9uam6iT+zmHf827tZijpkdztX6uceUjj++fy8zO0f7Teqb3S8ymdR/SP9e/EeXe+9Q8eo/Mg3zqqojnAYWQ/K3596RPNItv+q/M5NetZDjIMABBwC4QKdb9AdrPSBwPUJ9DaBzuZvdHPa2/SObCYdva8gX22Ko+2zuUT1yfZfveLUzeRqfdr51E3y2fpV67tL0Tq6nqr8ktXDXX9RPbP67D4uyoH+EIAABBwC4QL9JZQi3UFLHwhoAu7mw900nbFJ1VbW9IjebM3qf4Ui3o2rb/16hyvKi1fm0q6v0TdTeuu1V5Qqf/XYq3HZQ7ao/ko/1a54K/8oDpHxvfh384n6mxQ9Fp/j1FpTzwPFo7o94l9l/yj/2eOdPOf6j34QgAAEuvnTRcM36C4p+kHgXgSym/zqTeDd5alNd1VUneXPKv13k3O1m+rd+K3WZ9c8MouDu96rDmUixbpT7O7qr96h0iw/IhcCEHgWgbIbdLVJUe3Pwo61TyPgbpKim5F2UxUdP9L/Kj5c9U1ie3Nz9c1n1r9Xt3tEf/eQxV13Sp4rp6qf0ke1R/Wolvc5f7tee/Gu8kc7TvXv3cRnvkGP8qzur/zz7fmUzSuzxrlvRvTi5cifsw89ZjFBLgQgcD6BcIHO6+3nOw0NIDCDQO8QwTkEiG5eVP+RIql6E3q2vOgmuBcbI/6t9EfWHld/1/7RNVR96DwqT/FR9o6OV/Lb9ur5XHlnr2c1f5Sjk59H1q+S7+qr7L5ru8uHfhCAAAQ+CYQL9NdginSCCAI1BHqbktlFzMhmqFdc1xDxpcy6+WjtU9+Ujmx+R/ywal7fI7/3XKXfDvP01muvKFV+V4cManzbroqsUXkqX1XJH+Xp6NFb/+3c7k24my/v+A36N39FefTWwqr839O3l3e+xU82hzIOAhB4LgG7QOcb9OcGCZY/m4Czqd2hSLqanqqoWRV1vZvH2TxX2Vc9T6/4rZ7nLHnuTXSVfqNvDkT1mB3XWflRO6oPcaKHOll9s3yuPi7Li3EQgMAzCdgF+g8efgf9mTGC1RMIZDcbblGXlR8ZNwFLicjsN6DtzUf033c7pOjZH3XS3bgc2aPWZ2R9fb6p5o5r548WXe48Z/WrtC+6vt24j+afVo9vN+nq0OQsf6j4OvKXy7O6X9Q/VTf1R39joNpG5EEAAtcnEC7Qeb39+k7HAgg4BCKbvuxm90nFm7vJ7hV5js8ifc6+OR/loW5eR9tblr31EGH+2Vfpl5VbNW62fmfLj+S3lXmq2n+zuW5I0gAAIABJREFU7czqO1uvXeVneTEOAhB4FoFwgf7CQ5H+rCDB2nkE1Ka/uoip2LTMo3EsueomQx0mrNyMV/jDuWlti/6ReV3/u9/oXpF37+awV9Qr/qrdnc+dPzpf9KZ0tfxeTGYOodr8oP4GRbZ/q/MTvkH/Fhe9fNzjo/L32e2ZfObmVPpBAALPIWAX6HyD/pygwFIIfBIYKeYym5WrztduPt1/7xZtq/j3+OzGQxW9u+s7qt/sm+5R/bLjV8W5O0/WDnU44R5SqEOV6vXqcrlrv2p/Iw8CELgXAbtA/zH78Bt09RBX7ffCijUQ+J2Au0mKbkbUpioq76j/rj7d6ZvCSt67HW5U+X83u1x93vbv9I2wWzS5b+Ko+I3mm2h/dVOv2tV8R+29+Fb5pR2n+vfaj75RrvKf8u9oey8enedfVX6Jyon6a9abXBH/R22kPwQgcD0C4QKd19uv52Q0hoBDwNlE9YqZtnhR/3aLojv0i25aHV/N6DO6Oc+Oz/Jxi5ZZRWzUB9FDamVfdP5o/6i+Ufln98/G6+xxVVxm6zkaH6v0u9o8Vf5HDgQgcG0C4QL9ZS5F+rWdjvbnEXA3C9VFizuv028VvVk3Fe3hwRUPAaLx4fjV5dA7fFFx4cq/Qr+erSOHXCN2K/Zuuxsnbfz1brbbeV0+Ub5qPbh2vfqp/ODGfzZ/jeyvInaOxJv7JoOKu085bd9dbrZ7/nb9W8FZcaQdAhC4HwG7QOcb9Ps5H4sg8I2Au4k+azN4lXlV0bBr9J3l/x4vVeTN5ugWn64e0ZvHaH9XD7ff2fO7emb77ZpPsvb01osqqrPto3ruyv9svUa5Mh4CELg2AbtA/zGT30G/tq/RfiMC2Ye/W/Rl5R+N2wXfWTcrFTchM/xy9E30zPmy8XAFji43tR5dOdl+av6ej3qHMK08pZc7f/bQR+mv9IsUne+51M1oq5Pqr9rbeY/Ws+Id5VHdX+l31J7NJ9FxZz0/3PjqxcvRN+pRBvSHAAT2JxAu0Edev9ofBxpCYB2B3W6mspvo1zi1+bhTUaY2tdlN6rrI82ZSds5qz/JTRWdrtVp/Pfs8ev/tpeZT+kXHZ/V0+Y/KP3v8rPgdlVvFZSSfH+XrXnyM6j3K7SnjRzkzHgIQuAaBcIH+Mosi/RrORcv9CKhNvyoyqtpHNjOzqKqbpqr2Kx4WuEWTGx8j/m/59Q5n2jiJ3AxV6jfD326Rkl3vUft7a3K0qHf1cHlUH0Jki9BWX9dO5zCytx7c/PXtBt31b8SOynVR9UxYwXfUP2p8JVfXn1X8kQMBCOxDwC7Q+QZ9H6ehCQRmEnA3BfT789dhpVsUz/TZTNnZIigaH9kib6btL9lVRW5Wz9H5s/Pu6o9Re3qHBNF4nd2/2s6eP3fLX7O53kX+rPhALgQgsAcBu0D/UZffQd/DZ2hxQQLZTUG7qWrlqPbsvN/G7Yp91jeFZ9yERP210v/Zm3MVN1fgHC1ion6s6q/ioeeLWYcwqihU+Sw6foTjey51090yjOafyHpQ9it/j/DIrMuovkf6K05V7VH/qfhY1R75Jl0d8qn2KtbIgQAEfALhAp3X23249ITAlQhENnPuZvZOrzW7fNxN6m6x4RahLoeqfi5PV/+ovKrNq5IT1X91/Cj9V+tTNV9VnFbLqbIvG+8qHqv12+2wodqfq+TN8gtyIQCBtQTCBfpLPYr0tU5itvsQcB/S0U2V6u/Ou9PN+Zk3ESO8MjdPozeJM/2v7HEPa9pVrOTu3N7LSO5NdHUxEvV/NqO660Lp02tXemX5Kn0+7XLjufdGSTveffMkciOq4s/1U7afil/lx4j+UX/s1l/5f0aey/JnHAQgsA8Bu0DnG/R9nIYmEJhJILtpe9o4temf6aOVst2iqNr/Wb6jN709O7LMR/XJzss4j0B13FbJ87S/b68qjk+Vc9/IwDIIPIOAXaD/4OB30J8RE1g5gUDVJsEtWirm691ETMDzm8izvgmccZNR4YfMH6KrnteRl42XK30GsXL9ZeKx1U/5rbeW1evN6hAje6hTzVfJi9ycq5vQHkv1JlA77irr3YlPxV+1v/xT/d9Zz5deflTx0ePcyov4o5op8iAAgXoCkez3q0Dn9fZ6JyARAmcQyG6iPzdN2c2Fs5lQxcUu7WqTeYZvK+YciY9K/7p83aIyKy/KVOkTlUf/uQR2yyfV1l4tHnfxx9X1qI4j5EEAAmsIhAt0ivQ1jmGWexLI3jxli4qKImuVJ9xi/63PlW5e1Sav2r9KntJnpF35R7VXFvcjdny7yWzXQru+Wu7u/Nlxquhy1392jffsH42/3njFf4Y+bbyq+FTxrdpHvkV3/e3GZVae6z8Vd9/0VPzOblfxcWa74k07BCCwDwG7QOcb9H2chiYQqCSQ3YRFN3lX76+Kjkqf7CRrl/hYxUQVeVE9quVF56f/MYFd81KV36KHONF5Z8f3rv65ml5Rv9IfAhA4l4BdoP+oye+gn+srZr8wgezD3C0Ks/KPxu2C+6xvBs+86XCL4jY+ZsSBy6F3cxWNI3e+M/qp9Xgm/woePV9Fizw3fhWvUd5qfXy2u/Gr3vRpGWbz1+fnhC5/xfPsduXPo/ZoHnH7Z/3TixcVH1Xt7Xpv9XHyQY+3y45+EIDAPALhAp1v0Oc5A8n3JjD7piFKb2QTrTYnzubg7M1i1fx32eRcpQgY2eQ7RU8bF9F15eqXlZsdp/yblZsdt6s+VXlhVE6Wqzpk6cV3T19Xj9nPt1GejP+TvyHlBjP9ILABgXCB/tKZIn0Dz6HCpQhENwfuJl9tcqPzfus/C3TVTcIVDwuq/avkVcSBe+jS80c0jtz5VvRzD2GynJX/RtujekV9pYrCVv+sPm6+U7yO5h/NJ2q8anf+9oHiHeWr+o/wPDoUc+PsUz/Fb7f2iptu5Z/RdtcP9IMABNYRsAt0vkFf5xRmgsBKAqMP97uOV5vSlT7aaa6RNy9GiulokayKmGz7qC9m3zQq/VSRq8bftX23PFbFWfl79Oa81XN2fO/mp6vqUxVfyIEABOYQsAv0n+n5HfQ5PkDqAwi4D3G3KMxuulw9Xv3O+m/WN4EjxWGE28g8Uf+v0iszT1X8jPDM6H00n/LP6Hyt/Faeml+Nj+qXPcQ46xAna9+3cW/bo2/6tMyi450b9BX5/9s6UPE3yl8dwn27SVe8R9uz/svGT2++FXmwKmcjBwIQGCcQ2YXzO+jjvJEAgW0IjGyi283His1DdPM3q7/aRG7j4EFFzioClN9UkTDa3iuKozgVv6i86v7VN6dR/RSf2Texrb4q7la3R3n27Ike2lwlv632x93nG403xkMAArUEwgX6a3q+Qa91AtLuS8B9qI8WFWq8q8fRTdKol1bdROx4WKD802MbLWJU0TUSB1mu7WGOG0dn3iS5RfrIIde3m9Ksv934ivrf9VU0fqN6qP6V9vfi1Y3/Hgs3/x3dXCt/KE7Z9lG+6pBA2XV0mKL8tbr9Ct+cqziI+oP+EIBAPQG7QOcb9Hr4SITADgTUw/op7e4mdAefnalDVVE6Glc9f42yWX1zO6rv6Hh1KDAqX43fjfdoXFaNV9zcduVf1e7O4/ar9ncV77vLqT4kcf1NPwhAIEfALtB/xPM76DnGjHoAgd6mY/Sh7xaNo/O8xr//U9+Ar3ane/PU03+nm9jezazaJFf4170BzPabFT9n+m/2+nM3ze6bEav1nT3faNyP8I3mk15eVPn0KL6vxlfxVv4csTf7XMr6JxsfVc+zFTf1PX9kWTMOAhDwCYQLdF5v9+HSEwKfBKpvDqJ0R24+o5uRbJG347jopjHql136n3lI0MZXJA6y/lHrYdQviueo/Orx6hBg1nxZ/83SRxWRq9pH7VPxF22P6qPWV/XzcJVfnjZP1O/0hwAEagiEC/TXtBTpNfCRcn8C7sM8u0l1N1muHitv0mfdJESKuwiXSrnV/j7Ljm/z9g5zRld7JX+XV6uzKiqict31Wx0vrTyld893ikePn5pvtF3p28r/5BE9LOrFe2V+6/n/bL5uER71ZzRXfMqf7Y+o/BU33VG+0f5Rf9AfAhAYJ2AX6HyDPg4bCRDYkUD0Yf2U/u6meEefztRp1qY8Gldu0ZotsrMMo0Vrdp5Z487Wf5f5o/FY3X+Wf5Xcav7V8lz9q/1xN3nqkE5xph0CEJhLwC7Qf9Tgd9Dn+gLpNyKQfZi7RUdWfmTcWe7I3jxd4aYi6l/VP+LP1TfQs+JnpR2Kv9rkHt3Ufr6JdtZNejR+ojyifKL6RPlG5L91z+ajXvy73zx/xrk6ZIrYNXP9VPs7Gm/fbtJbdqP+PGv8Ds+3nj9m5XrkQuDJBMIFOq+3PzlcsP1OBEY2de3mdeamb0TPjF7RTeFVY6KqKMz4R8WPaj/ya9Z/1Td91fJmx5mKh+r51Xyz+fXkZ+I5k2fceaq5u0WW4u+2Rw9Rqux1+dLvz1+frbocqvyDHAhA4JhAuEB/iaNIJ6wg4BGIPvSim9Zef3feb/08y+K9qm4eIpuJEQ6ReWYVhdl4WGW3M088Ur6P6MVPxE+Ovkc3l61m7vrrMcj6tyreojzcokzZm53XHaf4qKLRnefVrz1M6tmezX+R/VZP75ZHxL5vb3pE+I0ctql4c+Ks55+sP5S8HW66o/6N9q/K6ciBAAT6BOwCnW/QCSMI3JNA9OF81/5qU39P72ur3CLy7LjQlqzpkS0q1minZ1mt/+r5FIGz43g3HoqXUyR/O0TLyo2O28WfZ+uhDmnc599d4jMaR/SHwGoCdoH+oxi/g77aO8x3GQLuTVr0IR19aEblf/Y/C7b7TeZbP/fmY+bN6gjnbze0VymCj+zu+Wd2XM30c/X6U/IiN5OZm83o/CrOo5t+Ja+6fcTeaL7J9m/Xx8jnG9H4qebtPE9G1qvy51E89vKQ+zzJ+vcs+SOcs3GhDmuy7bOfIciHwI4EwgV65HWrHQ1GJwicReDsk+eRQ4To5uSMzUF2U6E2tb1N4VlxlJ3XPQRQm+Aqzt828724aeNvpIhR9mX59oqDUXmrx/fyVHX+UvEYtTuqn7JzRpxn8mKUwy79XX6r8qurD/1+/yb96NCDemCX1YYedyQQLtBfEFiUdwwFbJpBoPewd4sEtYkdKbpVMTTKY9XNQWbTO3sT5vq3ZXyGv6v59Q5zRuOpHV+tt/PtuSoCz1rvbry58RVdH9H5R+VXj1dFyNFhUi/eq/JfZL/l+lfZq9rVoWbUP6r/aO44kr/Cf5HDyJl5TXGuah/1F+MhAIE//rALdL5BJ1wgcA8CM4r6K24q3KLiHl73raja5Fdt9rJyeharItsn9b3nbPmj+qnxSn/VruSrQ6no+Or+2XirHldt1y7yovmlWu9qP11VnjqEcZ+P1fmg2t/Ig8BVCdgF+o+B/A76Vb2M3ssJZB/a0Ydidp5v41ZBqrpZeuu70+FA1H+qf6V/Z3Nq/bE6nmbYp/yjNrnqpjEqf3b/bLz1im5lv5ovylfJU+2f8/XiOZq/Wjbt+F770Rsd0SJ31aHsbH9Vx//RzXaV/6Px0uvf5rcdn3+99b7qWcA8ELgTgXCBHnnd6k6gsAUCVycwsklTm5UZxZHaTFe1u5u+q/lf3Wy4m/wqzkeb4crNp+tPZf/V/F2tbzR+ekW6q5eaz5Xj9lPzzYj7TJ507bl6v9XrcRf/Xk2PbH69enyiPwRWEwgX6C8FKdJXu4n5rkqg9/DNPuTUJqbiYZ9lXXVTcMXDgNn+bOVX+DlTLDjzZuNndFylPT1/qiJUrXd3/Op4UvHltvfs6xXDipeb7xQvJ27d+Inmp7Z/5jDKXRtVvBTP6vaof1weqp8z76j/1Hg37q7cT/mBdghA4L8E7AKdb9AJHwjcg4CzKbnyZmB0038PL+etcDf5u8dRtsjOk/t7pLqZHZV/tfFX5XF2fF/Nz7P0XRU/Z/v77PmrDl1mxQFyIfA0AnaB/gOG30F/WnRgr02gV9SMPnSjD82R+WxjizvOunnf4ZBhpf/Otrc4LNLiKjlU+y8qL9q/Xf/t+Gh7NJ+o+arnV3wq9e8FpMpf7bjMN+jZQzPlD9Ue5be6v/J/tP1T//dY5d9d2yvz4Cy/9vzTrhl1SKPa0w8TBkLgRALhAp3X20/0FlNDYIDAyENWbVausBm4+8262qRkN/kjcVP1B4/a+IvEW3STnl1iin9W7lnjquzpFeVqE67idTaXiriPxKnKT7PtjcpX/lHtar7R8Up+r30Xv19Fj1X5NetPxkHgqgTCBfrLUIr0q7obvVcRUA/X7ENNbVrUvE57FaOqm4WKTa5jd2Qe13+jRUi13ivkVcVPVI57GOD4WW3eW/8rrm68uOt7tbxeka2Kb7foVPzU/IpHVP5R//dcvThq2yv69+yryi8r+X3jFl1PKu6iuSMyv/Jv1N9OPqqM3yvMl/Uf4yBwJwJ2gc436HdyO7Y8mcBTHvZq0/nUGMgWgVePG7fIGY2LqpvnUT12GR8tplR8rrbrrLhfbac7n/JPtN2dd9X67R16nBUHZ83rPj+Vv6P+pT8EIPA3AbtA/+nL76ATNRAwCWQfqtGHYnaeb+NM04a7Vd2svxXZ6UbgTP+t5tDyHw6MIgEzbtLVJtRdh9H4OLu/a1ePz+f4b+u1tS86n7pZj8qL6NOLf/cb8164H90wr46HKL+z+2f5OEW56+9Vz7cdn3+z/d/zb9GjAzEQ2IpAuEDn9fat/IcyGxPY7SbN2URnNxeri8OR+dxN3MahZanmFpWKx+xN19FhkfsacSQeZm3ydlvvVpAs7HS1m/Qz4t4pzhe67LepqnhUrb/V663K/qvLUc+LbPtZcc28ENiVQLhAfxlCkb6rO9FrFwLqIZx9iLlFl5r/qD3LMFvctzcB7b8jxdeI3UfzzPZXVP4sOzNye/7LxlHVuJG4cYsIl1fPJnc9R+Ojur9rZ+QQ8NM/rb6j80Xtr76JV28ORNoj+63ReGrjNOqHqv7Kf2qeqhzi8FDPK9U+kqcUh7u2z/IvciGwEwG7QOcb9J3chi4QyBO4+0M7uknNk7zHyGxRdbU4covke3h1PyuiN+juIclsS8+K89l2ufKj+XS0v6vXWf3Oioez51WHJm77WX5jXghcjYBdoP8Yxu+gX8276LuMQFWR4z7kZjysl8FqJsrevO9w83Cmv1bb/7ZV+eusOOrNO8Kp2r9ReWf3H80zn/q38TPil1G9MuPd+FfrY+SzDRUPUbuq5UXnn91f2RdtP9K3Oj5G5bVxdvX1l8kXPf+2z4p2/xZt3+2Z9zR9lP+uyiNcoEdet7oqFPSGwB0JRDZDanOQeVhG5q+UH92EXdX3ozdXZ/nnNa/aPKp4VOMzny9E4+CumwR3k6t49eKrN07Fs5qvqv3MdTGy36qOx1Uc3Hg4u4haxePq81Q9f6vjuSo/IAcCswiEC/SXIiMPjVmGIBcCOxBwH6bZh1bVTb1zEzDK071JUsVXZbHu+qftV+2vqLys3ivGKf+NxlF2fC/+nHhyiwSXb9Tfu/VX66HX3trRO4z51s/xkyr6VZHvjnf9/M2+dn0ou771V2sgot/n/i067qr9Fb9s+zceyt+j7Sp+aP/rDxWnWX8zDgIrCdgFOt+gr3QLc0FgHgH18LpLu1vkzCO9p+QVhzxX2CT24mNPr11fK1UM72rhWfkwyyPKOdq/1avqEKRqPZ5903pWvKye132+qvjIxjnjIHB3AnaB/gOC30G/ezRgXxmB7MMy+tDLznN08l8GoSMoe7O+Q9EX9Y/qX+m/2XzetkT9NzueovIjnJT/2nblz6i8s/sre1T7KB8lP9oe1edTfjb+3Tc5Wvnf4lTFw5G+kbiPcr1Kf8VvtH1mvKj445tzfXOu4tT1f/SZQ38IZAiEC3Reb89gZswTCexykp/ZlKrNomrfaTN414euuplw29Wm5Yx2FV+j7Z/xOSs3nb3+Z9mVlTt6U5udt2rcGesgst9y9Ys+D1x+vXzT6qXmd+dr+6l8l5WbHef642793Oet8hf5Mxt5jLsLgXCB/jI88tC4CyjsgIBDQG1Cow+lbP/IQ78tdhw7v/WJ3qy6N0s7FPvupiO6aXQ3tRF/rubVix8VD9k4y46LcOn52/Vvryhxx7vxpjax1e3RfNSzd5RPdD30Ysa152i+aPxH4lD5TxW7UU7Z51fVPO78o/O56zuba0b1Y/yfv+qMKg5qnUTbZ8dPNu4Ydy8CdoHON+j3cjzWPJdA1UNvNzluUfM0z7tFiNqk7ObvUX3YZJ2zElQRdo5WetbReOsdSlTziMqL9tekfu8RzT+7yY/q4x5KVcfTbHnq+eA+f1U8jPJmPATuQsAu0H8M5nfQ7+J17CgnkH04Rh9q2XmcceVQ/i9Q3aRm2ytP2B0+mW9C1aYmO+8Z4962KH/NiqMquZG4qV6fSl7Ur0pedbsqMtV8n+PbePp8M6+3iY/yUfpG5GXj331T6BsPpf+d8ktkXUb8FpGr4jfafqSnG08q31bG1yyuyP3+RkA0nnrPwDZf9g6JdhmvDmlmt+/Gp+uXwKbnV4HO6+0BYnSFwIkERja5avMQ2fSc/XB2H4InusqauuqhdbY/MvOreHSKG3VTqDY5lpPoJAkoP0gBnQ6j/lPjM3FbkSddHopr9nngzq/6RfNXVl70UEPNU9V+VvzsPq/7fK6Onyq/IgcCswiU3aDPUhC5ELgSAfdhWP1Qcuf91m8W3+zJ/0ixNcLh2x8Oi24Ksv2r9N5BTrSYnhV/Su5R8RRdn1HuPd3cIkrZFtV/Vv9WT5dTVB8lV8lT4z/bs/HtFuvf8p/yd0R/V4/KfDiqX+u/UXlqvOKdbVfz0l777XmWp4o31a7mVeNVvqpq7+Vn9/k0Oj67X6qyXx3KZtd51Ti7QOcb9CrkyIHAWgLupl89VHZvzybttd6YP1v2obe7f2frN98zzPAi0PPjLnR6m7bq+FOb9OzmMTpud3+oIiCb73rPi9VxWB1Xq+Sp+M0+j6P+XO0v5oPAKgJ2gf6jEL+DvsorzHNZAqMPx+hDbWS+91ztTfco/Kqb81a/zM3PCB++Of/bA6P+HI2n6vHuN5vON9Fqk6rib3R8Kz+aP6L9s/N9s/Pb+h7VR/GOth/5p5c/3fXS5hclz4nHqH3R/rv5J6p/tH/U3l7/Noc5eqjn32j7Ds9ThwN6zvtr9lXxHT1UqeqvnkfR+MryqN6j/KNHQDDfoAdg0RUC0ZuMamK9JOgkLfXw3/mhuVuSrfZr1D7H3zv785v+Kj5V+9HhS5W/Rtf/6PgqO2bJOfvmNrtJXL2eXP6jPEfHu3q6RaySl/WDmz/V/NXtWXvuNs71T3T9VvsLeRCYTYAb9NmEkf8oAmqTE32oZPtHHtptMZN1mHtz1JvvzCJx1qbAPSRp54/470xujp7K31XxF43bzDfo7RyO/Y5/Rv3fs10V+dH2bD6K2hddj1V+cORk49mJg9f8rXznD/MqvaP8o/Jm+6taf2Vf2x7NLW5/9/kQ1Zf+td+yq/iLxv9d+/eej+56iI7PPo+i68P1V9bO7vPbFcg36C4p+kFgLwJP2QSclUT38vZ/tXmK/6MP3VWb8N3j4yz9duGvNnlnH8pE/aMOXdQmWB0yR/WZ3V/5T/FQ7bP1V/JH89qq8auKWBW/iiftELgKgbIbdJXkVPtVgKEnBL4RyD4E3aIyK/9o3Hvu6m/QWz53ulnvFRUz/OPeuFX168VDlf92zRyZm/SrHHpE84vqH43zUXlq0x/Vp6K/ym+qvRdvav3t8A16Bb+qfHWGHBXP1e0R3m38qL9xcAa/iD1P0E/lt+r26vi8mrzd4k/xCxfozutWu27E0AsCdybg3iQ4ScrZLDpydnjI9pLg1WKh0r87+CUSP6ObTzX+k0c2Llz/3CUes5zcTWcrXx3yR9uj/lJ6R+I5sv5czqM331n9Xf2q+7mHZGoT7LZX6x+Vl/XP1cepdef6L7veo36iPwSqCIQL9NfEFOlV+JFzNwLuw7D6oeLO+61flQ+yN62RzeqInZF5dvJPRO9VfEbmUYc/VfGo5PTi1bmpVJvGET7f5o/K69keLWJ7RbLSRx1CuONnc1Z6uEXgp5w2vqPr99t4FcvKDpXP1Pho++h8o+Oj+kb7K3/Mao/qSf/ab9Fdnipvqfjepb2X/2fH9+znV5Sv6/fyfi5ovkF3SdEPAnsRyGwyo5vKM/pHk+xeXqnTxr0ZKH94/PxBqzP8PsuOKo+MFsFVelxFTuvPUb0V/yr5o3GoNvFZO7Lj7pJPlf2qfTQ+zh4/GperxmfjzX3eZYu8s/3H/BD4Z20EUPA76AFYdH0WgaqHWvShNTLvLA9lb9Lf+hzdbI7Y6xSTUf6q/2x9R+S3vKPfLEbHK//OikdX7rf4UP51iyzXT7PlRe1R/XvFdc/eqH3R/i7nin5uPDt556WPkue82aHsWs2zer5qeYqXalfro6q9zWFKL9qveXis4jvaXhV/0UMRdQgWbR+dPzv+9HXkbl5++vE76AFYdIWASkKzCfWSkpN0VPHlbjrP6Oc+lGbzH5Wffaioh7jj/zP8FtFLxadqP7Jv1G9u/J2dH0btHNVfFfG76NfTIxKvI+vJ5TDK031e9OLb1fOsfiqfnqXXrHldf66K46p51PMtm3+fFh+z4g65dQT4Br2OJZIg8IfaJEUfAqp/xUOvym3uzfnIZrXC3oqb0tFNwCw7rii3LaZ7/66K056cb38oThWhszbBo/Hlsppln1vEqXht7VD93XbFt5WjigJ3Xqfft8Ml5U8lN2qvkqfaR+dT41W70i/aruZT/jmrPWon/efcvKv84caXux+cJa+Xj8+K79F5szyrnw9df7kG8g26S4p+ENiLwKwiYvXDvOoht5d3xrW5i39Xx5M6TBv3jCdBFcmelOv22sUPUYKj8aryWW8TqPQcjSe1aVXz036vL6giAAAgAElEQVQtAsrf7vNFxXO0nSLzWnGEtvUEym7Q1UNBtdebhkQIrCOQ3axFH0LZeb6NW0XHvVl/67PTDXt0U1Hpn2oOiu/q9na+VfGo5nFu0t1N6+x4iOaP0f5Re9R8n/K+xV9kfGa9qPV9ZG8vft18p/Q9g0fUv7P7z/Z/tf5K393aq+1H3pwb+FlcVf47K17bZ7SqH7OHTFH7qv2g5g8X6J9/qERtdGiHAATWEXCTlJNk1OZTbS53au8lwXWe8WZy/SeT+s3+unomXqN/8O5bUe55rd9r1J+j868erzZRSp/sjbFaD2rebLsTl04edDfJSs+ePmqcy0/FszvPWf1G4/Msvc+ad5dDSLXO3PWj4jfaHi0iz/Ij816XQLhAf5lKkX5dh6P5XALqYRJ9CLj93Xm/9csScW+Kdiz2qzalK/zjbPJH/L+b/F68ZOPUHecU6WqTX+WHWfGpNpVV9kX1V9x6PlTjVNFasX6r81srLxKXWXuzHN1x0XiI9nf1cPup+XuHSVH+bm5y+6n1q+RcpSh3/XjVftFDBxWPKp7PalfxWN2u1of7PHB5qeetarcLdL5Brw4V5EFgDYGrPqSU3tkkuYb6vFnYRM19jbDac9GHfvX8V5HX22RG9VebsKg81V/lqap2pUcvH7rj6OcRWB1fnlb79Irmu+ihRla+u1/Av/vE0tM1sQv0H1D8DvrTowX7uwSym7DsQyM73+e4We7M3qzvcJMb9UeFH86y+23rWfOr19BnxaeSO/INehs/o/Gh4lHdnPQ2m1WbXGWf0t/l1fpMzVu16XfmaXXr5b/oOvu2PhVPR9+oHpX9lf5uPOxuZ1a/KJ/d+mftZtzcQ+cqvrvFW+9ZXvV8O9vecIHO6+1qe0c7BPYgMJKUdyveIpvEXlLdwyu+Fu5DZsTPEa5XmkfF71G776FYT9efMan36a2K6qil1Tdh6rBj9voYtV/FX1T+0/pH+an+1fG5uz96PKrXzVlFVe8QcXe/oN++BMIF+ssUivR9HYpm5xJQm0z10FZJvvph9pKX/e9KN+WrH9qtn9r5Z/jxKcV2Nl7dcc43v+4hUNbPs+JV5Zdsu4p3xUtx6vkuu+mP8j2y7y2rt/5Ue2TdqhhWHN12xSfrb/X8c/Xbff6oHWp9KL/v2p5dn1F+d++v9g9qve7SHn2+nB3X6hBttF3ZZ+/O+QZdoaQdAnsSuMtD0n3I7OmFvFbuplY9xM/exOyuX2/Tn/fc95HqoV4939XkXY1P1bpS6yPrRzf/Z+XffZzKv1H7q+VF59+tv+Kxuv1qReRu/kSfOgJ2gf4z5eE36OqhqtrrTEISBNYTyG7S3KIzK/9o3CxK2Zv1tz6RG6VRLmfyX2nni5Piq9rP1ndWvLZyd/oGfTS+d7tpVPooe9V6VeNntrfrR/1bradv63HE/sz6dg8N3EOAUf9H/af0j8pb3V/5++rtq3kyX+237mp9XT0+Z+sv4zGw6flVoPN6e4AYXSGwkEB2k3TF4u1oc7sQeelU7k2BTOoP/B30aLHjFE+lzv0iTPl79vzV8kcP4XtxXaXnqH49PVatx1EOrp6j8yhOrnz3eebKi/arnv9s/lH7z+7v8ldcdy0iW76z8tPZfmT+PIGyG/S8CoyEwH0IqIeF2pRn2915vxXjWfruTbn6a92quJrR3j60R/8d4T/DnifN3yuus3HcG+fcpKtNVtUmM3rz2ItnxUhtErP2uPqoOI7qr+SpQwE3H3/KaeNzxnp3i+BV9qsiKBq/Wb1df0X1jepTLT/7fFLrZbf2bH6J+ufu/VX8Rduz8afWo3p+RttH4zn7/FM80/HmGsQ36C4p+kHgXAJPeci5m/5zvRGfXT3UruJf9dBSD/30Q63oDYK45xhRQUAVzRVzzJAxO15HdVb6jcpX69mVn81/rnzVLzq/kqeKjKvGe9Tuqv5R/8zuX2UXcu5BILs/+2Y9N+j3iAmsOJmA2vyoh7D7EMnO823cLGTuzfp7/hk3TFW81aaz0h8rOdxB7zZ+Zsfz5+dd7nrdLX6UPtH2aBwp+Z/yvuWHdnw7v2qP6huR34vH7F93d+yP8CS//PXHqP+vNl7Fxy7t2UOMq/nj6vqq/LpLPFU9n5U9R/4s2d8GNjV8gx6ARVcIrCaQPbk7Kt6vsKnrJdHV/KPzZR8iT3vIz7A38vCM+jXbX8VDVG4rLzr+7P694jir12weM+I08pN/iourn5LTa6+Wr9ZDtT/d52fV86aaV9Zvdxk36r9ovEX7q0OIu/jhKXa461cd8h7x4gb9KdGEnUsI9BatOolTm552fDY5HBXjClD2ZjxSDFXa5XxDrDZ50YfwLP2R6//12TbeVFz32p3iKBo/apO2ys8uE9c+pbeb/1w5bpGk5LntKj8fyZmR/6L+c+08K99VP9+UPNVezSsqL9pf2RNdf258nd3PLcqjPK/WP+p/t2jM5oOrxJv7fDvi29tvRC63uvLdBcY36C4p+kFgLwJXe9hUH3Ls5Y24Nqs2IdmH6uqH+FnxHPdczQi1iaiZZT8pvU2kOuQ425JsfLqb7FH7VH6Nyo+u/6j82f2j+s9ej7Plz+Z5NflR/++ef67G/2r6jub3iL1lN+gqqaj2iNL0hcBuBEYXrfuQyM7zGtc76RtlWXWz3uoXOYHMcokWpdl5GOffgGf9Pju+v+kVjR/Vf3WcKH2i7aP6qyI1Kn+2vCP5vXjs5cvMr10o/0R5qZu1UXmrx1f7f7X+Z8+n4utq7WfzvNv8an3dKT7cfXJ2//J1nDvpTz++QQ/AouvzCJx9CNUr8p2HwhnFsaOXk+x6D4HdItA9hFEPvSpuq+RUP6Rn6B2J/7PiSuWXaHxV26H0i87X83Mrp1dUqvlm8ZoRn87nFspexS3qvyi/qPyoPaP9Xb/15rmKfW4+HuV5tfGj8Vw9vrder8b1qvq6+cB9TmU4lN2gZyZnDATuQiC6mN2H5EjR7f714KwP3Jtzp8iO8lP9R/lGxyt9aJ9/g74q3iM36dFN1oz1fqTvKv3c9RQtIqObo+w6dPXPyj8a9+3wyM3ZVfq09o/KjfKc3X/Unuh4ZY+Sp8ZX+yt7CObG6ap+q/Kr8t/Z7So+ovE1q3/V8ymq36d/3Ng82ueq+bvxEJj8r91PCF1b6AeBOxN4ykPoLj50T96rH+rqobGqXT2EXT5q0zGL325xqHjtpq/Sxy0O3H7ufKpfr706znbbd6n4Uu1ZrrPGKX1H22fp7cp19a9aP65ed+2323q9K+dZdmXz9wx9uEGfQRWZjyPgLurRosedx+lX5ST3Jv09n/sN5oyb9534z7DP8ftT5+3FX3QdjJyU7xZ/o/pED0VUf9Ueje/qIjqin8p3bfuO36BHeY/2j8bj6HxXG78bn6g+s/q369w9lFD6XC0+ztZX8dyt/YiXuy+Yup9ylfjpxzfoAVh0hcBqApU352rzODUp/fxBu0wRtJp3dL7spmH1Q3e3h+ioPrP5ReOgqn82nqrmXyXHvdnr+VkV6b34GrVvVtyN6lU13o2/nv+qbxqj8lS8ZO1bZa/yo2tfNE7VvLT/TUDFo2qH41oC0XVQ7b9v+YYb9LUxwGw3J+A+FN1NYWXRrW66lWvU+DOLdndT5G66VFGYTeaMO+9b9NFv1CNvfmTXd7sGZ6z/lx3uf2oT4uqn1pNqV0W6Wlc9rmpcNl+4cl/93v+58TnivxX2ZJ4Dyv9te4RvRp/V8l37V+UHZb+rr8ofbh7atZ+b/xTP2e1Zf2XzRXY+Fd+qPavvJ/9erB09/6P22v52A/9HOb5Bd2HRDwInErjKQ8NOUv+/UXeLnhPRp6aueKh8btqz8tyHjHpIpiBMHBSNs2z/iSYMib76Jrnnjx6UqL3R/lFnZONJHUpE9ajqX51fRvVS/put76j8Uft7+bgXP66+u8ZfNS/kPZtANj9XUTtaj2U36NEkWWUcciCwgoAb39HF7hZFUbnf+s/i5N6sv+ff6UZjJf+d7K6Ip6vb08Zj1fr45BKNr2j/UT9G51P9R/U5Kiq+5Y9WHzV/tL+SF2nvxZubP4/+Gn9vkxfR7+rreXf9neefWl+q/Wr+Vvbcrf1q/hnVV+Xb1f6t2BcvzTOBTQnfoAdg0fV5BFQRP5vIyCbN2TyMJuuq8b2kPpuvku/eTKiHUhUnNx6UPrPaW55q/UTbXfureZ918xSNPxXPq9td/1b1i8ZflMesuIrqUdXfja+jQ5ajQwalZ5anKhKU3J5eapzbrux22935RvspHu7zwrWLfhCYQWDWOlDrQ837uX7KbtBnAEQmBK5CILLoKl5HVvMdtbfFeJbxyM3PiP7OCaa7SXA3nUrebHuQv+7b9d76cOO9HR8pStzic7ToyB4iuOtFFWlK/17x3FsHSl6P66i8zPjR+Mp8gz7qD/LP3Pyjni+q/Wr+UetVFTnZPcvu49z86vLL5KeK/amK19Xtzn64jY2KvzkzvC7dgOUbdJcU/SBwLoFekh9OFuKvq1fLd5P4ubTjs896CLu8okVg3MK9R5y1PlZRubt/XfvcQwglb9Rvs/LiqF7Z8dn81ctPvcOYaBGSzX/KHsVJjVf+V/Kj7a4+Vbxc/7n+j9pLfwhECKj16LZH5vzsqw5NfusbmOSfP/0aOcENyKcrBC5LILqosw9Rd55v/d5w25PBKPTsTWI7v3MTPmJv5ptNtSms1gd5c2+mRvj21kvV+qmIz6p4Hd1ku4ceUX2j/T/9/S3fjMgbzVduPKn4ivyNAxX/Z/IY5Xm18cr/mXyg/Hu39qpDhez+62rz9w4ps3Gh8kW0fTbPo31wdt9blX+t/XBASb5BD8CiKwRWE3A3ydnkvMu4XlJfzVvN524CqrnOeuipIk7x2K29mntW3iwubvzNmn+W3N6msxefLYeeXm6/qF3ZuIjctER1cvq78RMtAtz8neUWzX9Kfzdeqp6/jm++9XHnX11EZflmOTAOAkfrI5tXos+H7Dyf65Nv0IllCBQSUJsqtelRRVB20X+Oy5rr3pyfcbMR3ZSN9q/wwxmcztL77E3hTLvftrnro+3/7UQ+WsQovsp+twhR+Wm03c2fatPv2pudT81/5I+KeHFzuFu0KV6z20fj9+76qefVbPt3l6/4uPnUXVd36af2o1dtP4rXnu/c57fzjX7ZenEDjW/QXVL0g8C5BK6yKYtucs+lmp/97IdcXvNnjNxlvTyDdp2V6kajl1/qNPAklW3Wmr8B4s2ueymOSkI0v7nyqp4P1fqpQ6isv7NFZNQ+1V/5J9o+Gl/R+egPgU8C2fVY9fxQh8BH3iq7QVeLULUTUhC4MoFsEug9lGcUDbP4uieP7/lX3hyv5LvSrmy8Ma7um/c2nnvrK/JNcbYoqfJrdL2o/soepXcr/+z+av4je3vx4sbHt/wZ5R/Vf6f+Zzw/Ku2/uv5PeL6p9fT09uh6UPl7tP1In6r97lHcK/1f+rX/hdZRwAi+QQ/AouvzCJx9CBVNnp/9d9489B6Ku0WYupkY8U/kIeFuIlp+Kn5V+27+iOoz41As9DD+/w1pVG+3v4pPV84u/dQNR/TmQsW3aldcqte/mk+1Kz4qXtz1MpqPotzc+aL2qXwZ1dPt7z7/ovao/m78ZHkr+dF2ZY9qj85H/70IuOsp2i9qZVb+t+dL2Q161Aj6Q+BOBNSizD7E3E2Qmv9bMR7lf6eb8qg/InwzRdnd5Ef5zu6/ku/blsr1MrpJV/a7uUBtcrPtUf3c/qoIbbkquUqek6+z8dGO+/wWsue/rD2Mq3vTZsbzoCpuXT9XzxfN966eVf1c/dShTbTdzcOz+mXzt8trlvxv+9vsm0nf8mwbV8reI31C+cB1NN+gu6ToB4FzCTibxFCSWPz75yqJn0tXz670n92uNaTHEQHXP1WbQVX0VXurta9a/mp5yp4oX1de1s6quMnO3yu2epvO6Dzu+lFyFacqfauLKNf+Wfa58yv+V22P2q/W+1U5PE1vtZ6y7VGOap6IPG7QI7ToC4EOAbUosw8NV67Tr8p5lTeDjt6Rw4Tepm0H/hE7qrnsIq/aP0remXa/dVPrpV2XlZ8zRO1XPKPt7fy94tDVc2R8649vf43X1aOinxsfvfgZ/WvC33hU2DWS5478u6O+Z/O62vwj63ckrqo4Kf1VfhzVQ8lf3V6d30f4VO9vv8Wb8v+n/iX5KmAU36AHYNEVArMJuEXnSNLb8aE4m6sr3+WvHprqIafGu+2uXfT7m0DPv6vXU5U/VLxWzXOWnNY+tZlSeipevflcuaNxpOZp2914duUq+0f5Zfn08qFrV/X4rB2Kr+vf7PMhOn+Ur+qv5nfjq+r5qvSNtiv7ovKe1n90XbnjXa5Recr/r3Zu0F369IOAQaC3SKsekm4SOOpnmPG1i7oJPLOYr+ar5FX44UxeatOi2hWfbHv1pjO7iZvp37eNkfXUW7POQ96Js2xOcOfPxoMrX8WrysutflH/q/FH7W08tP5S7UffokftOKu/4neWXm7+mK3/bPmKb9X6dXkqfVa3R/krXtX6Z/P36DjXn4pHtP2TX+952toWed72nie9/cmRPs7ztxsProP4Bt0lRT8InEugOvmvkucm6XPpxmevfojFNWDECIGs/6rXzYgNjP33jQhV9K9iNRofVXruwqNnj8upike1nF7+UIdKrh4qP7lydukXtUfFr5Knxisu1eNn66vs2b3dzQej/aIc1HxRea/+ZTfoKkhVe0Z5xkBgFQEVv2px9trdojQr/9vJXjUz92TyPe/QiWLwD9at5LvSrop4mKFvlHd1f7XpPZNbG//uOvz00ygvZb8qkmbPr/yn9Dsaf0b+Uby/5Wf3rw8730i2/oroMyM/jMy/o//uxHeGv1W+GImHGfreTR/Fv7p9JT/3+RntF3neOvvroTgNKM836AFYdH0eAVXEVxPpnbRmkuSOmx91klzNMypP6ef6R23ysg/RqD30/52A67/Mess8tEf9szo/jeobHa/sU4ek7XxqfSv9svpE40npofJH71BD8XDnHe2neCj7eu3KPuW/qF3Kjuh8Kj5H26N8ovr35LucRu1T45V/R8e79lfFt7Jn9/ZoXIz2j/Jw54v4s+wGPWoM/SFwJwJqcUYW5ey/LpzlvtNN+SjP6Hjl36u1t/b3NulqE6La1SZPtSv5Ve0r/fe2ueKmVPFTfh4tWt35lR7uelS5K+tHpV9WbsW4Xrx8u+np8YnqoXic3R61p7q/G6+9/FStz+7yFK+r6R/V92z7e/OrfBptX/E87umU3Z+2+XX0zSRHnh0/rgP4Bt0lRT8InEvAXvzB18Vny131EJntnaqH1Gw9kZ8jcNamO6cto3qHCK0fzyKVzatV+u7CwbXnavq6dmX7qedNVq4qKt1DGjW/0n92u9Kvlz9cPqPyo+Pv1j+bH0fHuRzdedz97We8c4PueoF+EDggMLpIV2z6qxyYPanMvNbrcs0+xKPyn97f3ZRk/bFa/kp/vm1TN+e9dZo52VebaGV/tT9mzdez88j+1h+z31xS8t34OIoD5S/Fn/Y//6h8To2uP/xR64+n81T5obq95R1ZD1X71VZO7/mbeb5+2tfL30P5JACBb9ADsOgKgdkEVhT1Q8kleUPvnjTO5qvkry5ClT601xJw/bt601dr5XnSzroJ7W0aq0ko+6riJqu30i8rd9U4d31m9VF81Pxq3qj8Vp6aX8l39auKU6WPu5+pLiIVh157j0tWXvU4xbt6vlF51XGWlefaMSpfxc+rnRt01xv0g8AXAu4idR8q7kPYnfdbv6wj3ZvzFUW9yzO6iRnhusJuJ6lnToKreGZjS22C3Pasv1v7V8bBe251s+78ddmq/FHtR8W3yr+9edT8vc1sNp5U/Lj6vOT04iPyDbqar2r9Z3lF9VN8aY/dPCv+T+c5yie6vlreav5o+6z8XvH86enm7j+dfKniuecvxflbvh7aF7qO4ht0lxT9ILCWgHvyrJLS2e0qKa6lWjebOslW7XWaIKmCgFuEzFpPFTY8WYY65FrNZjROVuv79Pnc9R8tynbh6tqXLSKVne78u/Dl+a08+nv7aL6bNT5mxb+9R58nR/FedoOuglS1Z+EwDgIrCKj4zSYN9ZDJyv02bhan7Mnm0Mni/1+fV/xUeyXfCnt200fx2609umlcyfvNSq0XtU6dm/SqQ7vZ/q3m3+p7JL/1h/pGfPb6/qbPp/4qfr7pH+Ex2z7k//VHdbwjL/amwG68zl6fZ+Z39Zyrau89b518pPgc5WdHvozHAAS+QQ/AouvzCKgivppI1Sb8JUdtDkuSjflNei8pVvOLypt9sr86fqL2P62/62/5kDXjPipn1B93jzdlX+8wJ8tVxYuSG/W/sk/NR/vvBBTPrH/UOPd5p/Qb9afSs6q9p6daP9XtrR5RvtH+o/652viqeKmWo4pul7OrV1Tep35lN+iuEvSDwB0JqMXqJoXKortXVGf5q5u/kZNKxa+3mVYPbfUQjs57lf6j8VY1Phpryp+z2s/0a3s41vt3+/87N+m9+Ff2Rv2WLTJ6eqj4c4trZac7f1ZORv6Rn1/ynDioLoJU/lXtUX+O8m7nU/pF20f1mz1e2T97/rvJj/JU8b66Xfkjm+9VnvnMV9E53L/Jop6fmcslx66efpm/AdT1jwuNb9BdUvSDwLkEVDLepd19SJ1LMz57W0TGJTBiZwIrDtGcTcXOjHbSTa1H1b7KltG8vErPp83j+sV9nqlDRsV3dry6+U0VrT0eyj7a5xKYHT+t9u76md1vFlV1CDsyLzfoI/QYC4H/E3CTS/Qh7sr91u89lzqJjDrxijfp7qZjhLdTVJ0tP7upUpvKXdvP5n00f3Z9HsVZdX7p5YYqfyv/KHva8dH4jo5X+kbbj/TtxcfRm0qK1yifqH1n8x3Vl/HX/sZ7N/+Nrj81ftTeaP5Qz4eXPtX/qf1s5T5M8fhmX+T5LP0VgMc36AFYdIXAbAJ3LTpnc6uSX1WkVOmDnFoCrn/lQ3bSN+itflHrR8dH59utf/Tmw42H3qZO2T8aR0o+7TkCo36Jjne1jK7fbPxG9Vf9XftUv6j9St7d2pUfZvNz55/dz/VrlIertzv/t36R441fBfrrv8+/FjoyOWMhcHUC0UWqHpItj4oi/HPdjpxoujfnlSeYipdKqtHxrj9X92s3/e38vaIga39WXvV6nqX/av8dzZddn9++QVf5oxdHbny58t04yPpX+c+1RxXpap5d21fzz+YL9/kW9edsfXb1+1X1Uv4dtas6HpS8qL5KnmqPztfbP7h5Q/X7lN/r6+4ne8/HyN88isZXT+dvnFv9Mt+gd/2rQH9M/pfaDLuy6AcBCNQRcDc5o0m8enwvKdWRQRIExgnMKiKr1tOohU9/ru9mf/bQYDQOGP+dQHb9q6Jq1fNP6d9arfqPthNncwlk94OztKp6zik5Wf2z+d/VJyv/ZU/ZDbpSQrVn4TIOAisIqPhVi9XddLUP7azc17iPw7Vfv78667/sSWjFTXt2EzTCtULvXeYf5bd6/C7cMnr01qP6pk6tW+evuWc3ba2ds/2t5otyH82no+Oj+n72b+OlzTuq/fNNx6z/z7R/RZ69u30j8beC/+76PT0+RvP9zH1nJv9F483xf/t8Hlk3/5lPPfw/2vkGPQCLrs8joIr4aiLZTde3JOUku2hyc/v3HgLVvEbl9XhnH2Kj+jC+loDrXzeuV/WroqDsr5pnlhyVf3dvdzaDzuZvFt+nyV29ftX6U/Hb+icqr3I/4fyhrKvHk+JbbZ/yf1W8VuldpY+Sk9W3J9eVp/Qalf/SI3Ktxjforufo9zgCarFmizgl12nPOiN7Mz6j2B/lp8Y7HJ3NcZUctVlX9lS1z9r0VemnHoJV/qiU064P99+tL5ybc9d/yj43h7ibyJ68Vo+s/r1xPf3ceRUnt13FvytHxb/ymxpf1a7sjbYrPlF5Kt+q+WiP/bX3Uf8of43Kn+3PqH6z9VH5T+WRo3zbG1u5v1Q8o/zc59NLrnp+Z/aN/9jjgv+ZhG/QXVj0g8BCAu2mM5qMzurfS6oL0TEVBP5DoLeeqjcBVetu1IXK3lH5jI8RGC2KY7PRu1dcqPW+qv1sD6n8EG0/257R+dUh5Kh8NV7Nn32uqHmz7Vl91LhqfaLylH6q3ZmPG3SHEn0gIAioxehuutqHflbu0cneqDOzJ5+Zk8TeyW50U3DVQ4wR/5f+NdH//1TYqk1ptd1nyHuziq6X6Pp0btKr4n+2/6PrXflV5dPRdjX/SHsbP5n8qfw1ol9Gn7PnU/4+W7+nza/iU7VHeVXLi86v+u8Wn4qXav/ch0afa73+zucTivO3/XFmv/TNvujz/jCPBqDxDXoAFl0hMJtA1abbSWYzN2O9JD+b36j8lv+oPMavJeAe8py9Ptz5R+kRzzGCbvzEpP7bu+d3tYnPzse43wm4/o0eKqmiZtfnoctjV/2j8e2uv6jcbH+Xv/u8UPZl9VT5aVS/6HMqOp9rd1Su2/9zfm7QXW/QDwJfCEQXnUqy7RQVRfhbZtVfi+7J650cVhT32U2N4l3B94r2uZso9TDM8h31p9oUu+vyjH7u+nET7rcb9Kh/FU9Xl9F+atPotqv4Uvb24r4qXiKb2DZeIvlG+SO7fl1+WfnKf7Pbq/y8So6Kp2i76j9qVzQ/zfb3Wfa662OUd3S8yhuq/XM+93nn3jw7N91H9jr5tGffN7mOvLQ+CvTH5HyD7sKiHwQWEtilyMw+BFQRuBAlUz2QgLtJmr2Ji66fXpH0QBeGTL5avokeSoRg0HmYwNXiadjgmwuIPg/OxlG1/5tlx+hzTeU/pbc7v5LTtiu56lDJGV92g66SlGqPwqE/BFYSUPGrFptKMlVJ1jm5rObmnnyOnjQ6J6ejSTHrx13HKR7V7b2icVc+lXq18d3796z1l1kfyv5efI15lXUAABxJSURBVPQ2K6PxpPSJto8eqoyOj+p71D+TP6P+qNTXuelXfEfbV9vDfLV/zV3x3D2+o/qr/iPtK/LHt/U683mn8sOLV/tf5E3PEflO/jvar/8aH4DHN+gBWHR9HgFVxFcTqSzqM8l75GHh/GGral6j8pR/Vfvo/Iw/JtBbD1ffxEXXWTZOdovfWfr0DpGy3LKHGOqQw9kcHh3KRO2ZxTuqx679o/nF9e+u9j5dL3d/tYpTb31Gnw+qf5U9ap5su6vfLvLV/uNIz3CB/prs9VDgPwhA4F8C0WSgFm12c/ZNj6yfsjfjFcV+lM9o/6j/Rvsr/47ac7XxvaJplPMZ49v4d/+dXaff1lvU/27Rqoq4qnYVD2r9qPHV7dVxFrVPza9iS40f5RWNx+r+Uf2jPFb3r+YzKi9qv5pPyRsdr+SPtiv9ou2j+oyOV/mjbf+crzc2u788qj+P9r+RG+2ezlXyj/zx2/PcBf9jHN+gu7DoB4GFBEaT71njFyJiqgcRiBaJbf/ev89aJ9F5H+TqlKk9nilhCwdFi8ysamr9ZOUyDgIrCKh8HtWhWl50ftU/+nxw+6t53XZ3PtVv9nyu/KPDCOfNUJVfPzlwg571CuMg8EFAJRe3/S3S7e+cxFU7auTkc9Sulo/69+h8Vxuv4kfxirZfjU+lvm9W2fUwa11mNgmqaFWb1FntqihV8a7GR9sr4ydyo1M1r1rfo/Mof6j5R9tH9b/7+Kh/duOh9N9d32h8z7SnfX45+Sijf/Q5V/WNeDtva59jv7L35R81j8P1m59fcsMFOq+3R8ON/hCYQ6C3KZ6Z1LPJ5mjcHDpIvTuBqqLwautF6XsXv6ubBmWnGt8rzpXc3qbNHdfrF9U3eqgS1S+6vqLy6X9vAiqeq61XeTGqj4r/av2j8lx7R/tF9Wrz4+j8bp6umse1151PFflHz4Nwgf4SRpHuupB+TyGgFqu7SNVDQc3TO4l7r9tvJ349H2VvBiuK+GpeUXlRzuqhFJ3/7v17D90o9x37v32n1k+77tr+0dzp3Jy3Mt18M6so7emj/KqKXLWpc+X3+KyOX5VfXHtUTCk52faqfDYaL+6hhvJvlT3Z9Xe2fmr+aJy4PLP+V/pUra+sP1U+G9VP2a/aVd448ov7PFTPy6Pn26f+aj/r7E+VP6rn6/J3wfMNukuKfhBYS8DdRKokPLt91SZ/LX1mO5vA6KboKuvHXZ9n++Nq87f+P1t/pY9bZFbZ4epzVn5X+lVxQE6OwGz/uPn7rPjMUfNHufar50c1HzVftF0RUfLUIYeSHynaj35dQ+1XPucpu0FXi1C1Z+EwDgIrCKj4VckhuqnKynNO9qp5RU4+R+3qPURU0hud96rj3YfSVe1bqfebpYr36vUVlefcpM/e1LnrUcWn8m90/Gj/6PhW/9HxiodqV/lTjV/dfjavUXuV/qPtSr+r+VutF8VL8VjdrvhH20f0b59fzk1y1B/f/BN9frX93edZb56Mne7z69VP/Tcyv5b+7+z8DrryBO2PJqCK+Go4VZvszyQzlEx+klVmfDUX5N2TQOSh6b4Ol4nXkU1Sbz61ecq0Z6Ogl8d2yW9Zu9pxPT+68kfH9/TpbdqzxYlrT1SfGevg27rt6e/On7WfcTECaj3Myh9uHCj9Ytae33vUbnf/mLW0Sj83bqrmc+3NztfL79/sDBfoL+F8g+66kH5PIRBdrO4ijcr91j/rA3VT6LZniiCXT3ZTmd3suv5Q8l373KL0bHnqpN3ldoV+bbHs/ju7DqPjjooctdlx+Ud1UkWnWi/R+Bqdb7QoVPpW26v8NspDyd+9fTQ/Rv05Op8aX63Pbv6L2j+qv5pvVru7f1H+HrVfjY/m+095vbEj+8ej/Nk+j2fsPzP77IwedoHON+jREKU/BNYQUMl11/Y1dJjlbgRmHVrsuk6yemX9ror4rNxdx/X4uvqqeHTluEW0u6mPzqsOJaJFSjZuFc9oexUH5HwncLY/snF2F3+6/FWRn80/imPWPz19e/lvdB5lh8qP0fkd3naB/iPs1yvur/+4Qc+6knF3JRBdnGpTWCFvFmv35PMzX1TY85l3sg+lKj1myWmTtnqoVrfPsuuKctv47f171jrLynW/2fu2nqJ+UpuWaFGn4l/pF53vU963fKXkKX2q28/kk7oBSn72VM3NlTfqbzW+up38n/usLrv/mu0/N07P6he1/6Vn9L/e/lI9r3rzjOQtZe+354eyN6SPEvbRzjfoAVh0hcBsAr0i9azk7c7bS3qzeSH/WgTcQ5jIQzT0cDyxuPhWLKpi0r1xcKNA8XflZPu187dyVHt0XrVp78lTRZKrh8rnPfur5ld6qnhw8//sfjxflCdz7So+3fhQ68jVriqO3PlW91P5zeWtOFX5w81PSp+qPDxrnmo7j/JV5HiDG/TVK5T5LkdAJRc3qVYWHVUQ3ZvziiJI2T+7XW16Vfts/XaXn3047jiuLZbdf1etu6wc5w9uuZtu5Zesju5mp413Vx8337ryXH2VvNH2KI9evlJ+G9XzKuNX5dNe/LhFkhvP1fac7cfReFf6R+WP8lX6qP1FdLzqr+xXeeIoL/bGjuwnj/Rtn88r9qOffJW9IX1c8HyD7pKiHwTWEqjaZKskPtree6itpcVsdyOQ3bSOxvPu46v83PKtklslp1q/qLxof2W3imf3kKAq3yp9su3RIsQtiqJ8VX/ajwlE/T/KM5t3q9bDqP7V46P8q/OVsifrL/dQ0ZVffQjRs9vVx7Gv7AZdOV21KyfTDoEzCaj4HV2U2fFH41bxOvpmaNQud1N2lUOKUR6Mr/3m8JPnO9bUyf6qdTU6z7eTerWeovGl5I22R/UZLfrUfGqTp8bPbG/j17mpUf6Zqa+j3+7zK36z2xUfFa+qXcl/evvT+EXj+RUfo/8d/U2Vb8/vdr6z8oxr96F+rpCffnyDHoBF1+cRUEV8NZHKojSzucs+nHtJvpoP8vYi0IvX6EP/ipsitb7a9tF/O6+3q+hQ/lLjR9vV/Kq9nV/l514+c+1Q8pUcN5/35Cj9q/TL5v1Z49znyWw+yr9Xb1frLdoe5TE7fqL6RPtH+UTXa7X86Py9fFvlt2jeG50369/KeSPHG3yDHvUY/R9HwF2c0aLElfutX9YJ6ibRbc+cYEb5jPaP8lVF4qg+q8e39iv7oryu1D9bHGfX2axxzl9zz26q3KIoaltVnKj4jW72sv3dTXPUbmWfkuf6Rcm5a3tV/u2tLxVPyr9V+s2KTxUXUfuUvOr2qH6q/2r9ovMp/d188S3ee2NH9o/f9G3nyew7o4d4Dueo/b/p7YLnG3SXFP0gsJaAkyQqk1V2vlmb+rW0mW02AXfTqDYV2Ti927hRf43epFTPr+Kjar6z7Fb29fRSh2yjXFRR6M7/v/bObctxWwei+f+fntPOnEkcLlG7CgApyUbeZgHEpQjiQlqdmX+0nuiqf1ftq2pf850joOZnqg+7+hE33lz+6nip1q/uF/HN/KR1aj6d5Zcsvqp9R7j3C3oW/V7fCPwg4B5C9aYuI3fVxmRuPjP+HP1/MN2mMat/9Xq3qVhtzyfL/4M1xfOqc7RLrvKSrg5NahOjNkXV59eVN+7Bu39jfCj5Rx0iq84V5QvSQ3hl5ZP+T6O7eBI/4eOup/0kOtnT9HV/I0V5ZFm9fxRvR/rdOnf2N43O/JvpUXBT4zaDr4pD6AX9R3h/g64i3HyNwAYE1KRyN75Zkt8AWavYiEDVkEZNwd3iW7HnaPg7Gw5Hflpf+Q26OpRXh5YbP6v0H71sVOs6kkf+j2uUuHu/ZHB9qLpUzjS5Z5ck5I+LpyuP+F064e3K282/6tyoca7yVeFC8RW9BL1L/nVxUvFX+Wb6j9af1UfKP1X9aXa/X3b0C7obdc3fCJwgQEU1msQpqZwluaoNo5fGzE0lDWGUnNX1Kv6zoqiur7Zntzy1aH4C31jM1X9XnatVcpQhPdpEVDUxo+9V8eTmyyi/aj+d36zfVfZTLGbt3LXexYPscvfP1Z/lJ/uurp9ZfF18SJ9Lv1o/2avufzbfU344yodqPT17Oad+7J0+2pDpS6P9XqQfP7RTBby/QVeRar5GYC8C0aRLSb+avheV1nYXBMb4nA01bpNRHZ+fKi8bB7R/Wfm716v+zJrC3fa6+txLYle+en5V/KJN8CxfZP1x16vxpNpLeLj2fRq/Gt801FXh4u7/7Py49afK/tVyXL9of6P4uf3FKlwcPMpe0ClIib4KjJbbCOxAwDl06v/X8ejnfI6eHX6/dDg3n479yjeflHRdfc1/7Td0Gfz/xIL6S48Z/65zs0vPym/Q1SaYho7Mvle8kEQvOcf8cxc/XnaM8X2EE+XPO/tXue932jfHL3f/ej8/p745cRKN78r4mtW7sV6PfKqfJF+Vc8ZHeDg4K/XfHtAz3zApBjVPI9AIaAhEm8qjJKI0c07yUZKc5mVz3QUBdciqLGIVRbUqbs/k0PmpujxQLx+Un7dTXKm4kZwoneJtlEuPAFF5s0sI8ovsIfvd9TN57osU+TWju/ES5Z/ll6jdVfJcnKP1O+vn09ercaPyRfFw8wnpUe1VL0VJ3y561C/1PK3qZ6vxieBgD+gvo3tIr966lvcpCKiHkIaYka7KPUtWLsbqMEDDSWTIUvFxm1y1KSL8XbrqDxX9Kvsz8RTZz536xnis+rd7fq7mV17O1fND+1flK+lZRXeHTpe/2m7KP64+df/U/OPqr+anfEv6CF+i0xBF+olO/rl0steVR/xZfYSPS3ftrZbvxpOr3+VX8wHxKcOzW59nvywlWzJ9yyw+KurnzO6/7SWn3sD7NSZndW3zNQKNwDoE3OR7Ff86BFryTgSilwirm6Cr4vopeqMxQvsdlbtqHdnr9jGz/V1lf7Xc1fYTnu5+EH81PtXyCA/St9v/rL3kz2o64UX01fa58slel+7qX8VfVSdnQ3GV/NXnwbFTHtB/QPn7f7P2+q9f0FeFcMt9KgLOoVN+/l0hbxWWVd8MVXwT2UPfc7+pc2+03+vP63yo/151Dp4iV3lJnzV9bh6i80h0V181/2jfu/wx3o76oGp7Rnln9s1elma/hDr7DEIdAlb7Wy2f8KvW5+5fVv/q80X4EZ38y64n+bvptB9389e1d1YDlXoyWzvrL6lfUOuxkg9nceLi48Tbkf32gN7DuRoGzfftCNzpJo6S2076t8fFU/z/1CbdKZqzc3E0rNEwd0ZXLxsyn51E4242ZETlrVpH8RrVS/ESlUvrqurHLvuVpvzoEsFtegm3q+jU1JNdLn4kj+hZe0n+ajqddzo/RF9tP8kn+4hO8nfTKQ+pdLoUeMmh+qw8kq3GR/HXHtBfRveQvnrrWv5TEaCi5xYVtWifHfYqLNXhIDLsR5u0KjxH/bOhZJW+av/JfqU4RPbxCrnR4XY8F/TLkKpztFvOWb2mJk/dzyqf1Pyp2qXKU5q+SFOn5gvXHzdfkfzo/pHcVfTqfFktj/ym/XPXu/aTfKofrj7XX5ff9Yf4yb8ZPuM5UvMr6SM81PXRc55d945XtF6r/cjMVnX92S87CYeKfP+uQx7Qf4zub9Bpd5reCFyAQMUQn0leVOyoSF0AWas0EFCLDjURapw035rPFowt/w9rn9/fcKhNeRTn2bos/nSequ1dPaSstrdaftX+VdmVvbSqsqPlfCcClI9UenW/cdVunPkrD+g/xp9+g05JiOhXgdN6G4EKBNSk4vJlklCFX4qMzDc9hMfoP/2b5DV9zfCn4Ppn79RfYsz4lZhsnn8R6G/Qf/4a7s/PHpVLyLMheYzHs5cW9VJLtauCj85f5OfnFXYp+9J6juP36npI/QnRn7avhHfTfyOgPBpRPiL6mDfUmu/km+r9PIv3I/vtAb1/3q6GQfN9OwKrL6WUJKgmI6X5jBbTWZL79vjY7b86NFBRisbBnddR/Lt0ai520yvq9up8Np4HVx/Fd/a80ctjVn61/zN5ox9Vdlfvlyuvyo9Vcig+iZ61K5p/s3p3rf+0eNmF22490Tik/X2XS/U68rlSNU4KDvaA/jKyothXO9vyGoE7IKAcushLxTg0qXpefFX/qS+f6qWAkiSpaamiz5pWaspVOg29RHftc+KjYr8cfauG06o4/1Q5lS/plI+iGDpxlIlb1361+aMhe5avdvn9Xg8y31oSflfnK8qnRCf7yX+iZ/eb7L+bfrLXxTvrH62f2RvNa73uNwJHcT/2A5m87vS7Sv/p7pvaj56d///goRrQ36CrSDVfI7AXgWyxX7W+i9zeOFC1qUWEmphVcdNytZ9juzip8XE13xifV9sz6qdLuavtJfyebv/V+Gb1q/uT1ZPN30+p34RnFY4tZw0C1fnIrYtXx8+Zvc7zWv9/0NfEZ0v9IASiyUEdmhz5u2Ct/AZ91hSo+GSbEgff7E3vp68fb8aj/94Vx5+uJ/LLHfc8ZM8v6aPz7dJd/nf7xnjegS/hk6Wv3r+sfdn1tN8kn9YTneRn6d+uvxq/7Hmg9VX2zi4RZzWNhtJov0X+nsXnUT7N4EP9htJ/uf6Unz+jKfl7QO+ftxuINetXI0BJMAtOJnkpyalK/izJZf3v9ecIRIts1b7fWQ41A9V0ahZW049+3n7387M6f2b9H+M7Ky+7ns47NY9Z/e767P6q/rp2VfGTfTP6qriqysdV+LhyXDxd+bv5o/ux285d+mZ4RPWr+EblV687srdf0KtRbnlfjYCbFNyio8p/56vakJXfoM+GeGriovip+u4qPxIHOy9ljuJPjR91WK2K62+Ro3yDPmIRjbMopqq+2flV7afzP8s7rn0ze0g/0VU71CGwaiikJtu1u4qf8FQvL9R6UGW3qo/8q7ZnFi9V9tJ+ZP1R80c0j53Zn5U51sezvyWh9k+EZ5XNan7Oxhf5Q/RofKjxT/r/oavA9zfoKlLN1wjsRSDahMlJQvxfFKlJdS86rU0tGqubotXx1vK1b9efdiKoybzKn6qhNmu/e75n5zxrx1Xryf+r7KKhOToEuP6o/YFqr6v/2/nP6tI4bNO/r/jDZrv37y55dbffR/rKXtCpiBL9DmC0DY1AFIFVw0FmaIr64q6r/AZdHfLVpmPVvnyjXGoeVLobX81fi4Dykp49X6PFNERFzxMNFVG5WXtn/rv2ZPJ/xS9mCN+r7cvi+TT7qT66eFzNT/gTPWu/G9/E/25PbdbWpUXP/Vi/I3IIH6LTftJ6opN8Ol/V8tEefdv/6m/QDbCatRFYfSmVbaKPikkkKVOSmSW1jpBaBLJDBe3jnenUXKiXB9U/w7+jvGjUUT4juquX4jkrjy4RSP7sPNC6VXTCS60XVfZF7alugqv8ceW4eK86P9m8TUOyi8sqfoq3VXpneUQZ1sf6MMoi+oxf+ZsjalzMcKuOVwXHT/4baEd4lr2g7wr+1tMI3BkBN+lRUVGL/JneVXhVvpxTU7aaTjenRCf7aL1LV+NsBd+qYXdVnLbc3wg4TRs15RRXUcxJ7o58efZNZ7aJpKF+l3+0v6v3T93nVXzZfE34VdtN9u62h/xz7c3ykz2z+hqN87M8UCUzK+fsl1LO5UHk0Wa2n65PlC9n+zDTE82vqj9qv07n9R+6Clh/g64i1XyNwF4E3OK0i38vCq1td5OzK45aj/ZtuYvTXU/M6pcZ8tvVv7r5J3uzdLcJdvW5TTE13dEmWLXb3f+ovao9WT43L2T3K2vvU9cf4fzHl6t+SXX04lwVDySnah+fnl8zOPQLega9XtsITBCg5EVNkdqEnOnZtTl3fkmP7kOv+7c0UHMxxpn7s7xdcdp6fiOw8hv01ZdEo3z3nO5eX60vK0+pF5n4WGlf5CXPjQ/iv9o/Ol9k/9V0st+lu/648on/Xf9d68vs3MzsVfs5Wh85rw7e75cP7qWSyj+7HIiud+PVHtA/+RuAux6wtuuZCGRv4slr+7AH/xp7Vg/50fQYAtuKxEVx4w4TR80SNScq/c8O0WXFXenOz7Zj0Vi/ivJnlk4Wk/xx/Wp+spfoZN/qlyrKV4Rntg6R/6Sf8KX1rv+uPlV/FsfZJUXW3qeuP8KThleVXlFPZrrUOFDWU308G9bVfZ/Zq65/Ip89oL+c7CH9iVvdNu9EQE1+VLRndEd+ld9qsVhxczo2BZ/+b2d/I3g78qn4RulVcdlyPAScYV3NP7Pz6Fn2119OXDpxT/mC9JIfavNIeqgeqEPYbIhS9VcN61F9d1+XjSfXP9JXvd+ufcSv2q/GN+mbxa97SaOce+K5mn700vyOz8w+Nb+q/qkv82fzJeVZyp+Poxvg/qoOblV38zUCjcAcAbWJdotalr/3bA8CatHJ7mevX/Mt+FW47onO52tx+x6X/24Irbbfla/Wt+gQOMO/6pLi7vur1g8VX3d/74aPa8/RsKs+ZvzRVcXvvFSrdWd2aaKuV/lU3GlIV+U8ga/sBZ0OJdGfAFbb2AhQMR+LmJqcKOlE5OzaLedm1PXDbQpc+d/EX9UM7Iqr1rMWgcg3fO55udv5JXuy/s2GOnXIdNdX1xvyn/AjOslv+mddAtJ+7o7f7Pk6sndtls5Lp8+4ZhroBT1v2X8lnP2y6yiOxn6G7F1Bp/ilfEjr7QG9f95eHZYt71sQqL6kijZ9VDSr6bMk9S37XuWn+tJRvX875FVdHlS9RHy6Pe/NSlV8VsuhfKmeB9WuKnmzIYDsIH9pvUsnfUTP6iP5O/IO/fzXeZF08XD51Uv8mVx1fTXu0frvnkfyz8Wb+N/10ZBbRY/Wt6N8f2S/OyRH7Tkbrgl3HGrNv5mj6ruCzx7QX0b2kH7FVrXOJyKgFrtZEasYwlfhVvly7vp/N366mXfpatxE+FYNn6virOWuQeCsaas6X6Pl0aEs25SRP+45ig5BMzzUob5qaCF/o0MVRSrpfSrdjS+KZ6I/FSc1flf7R3FKdGU4Jxm76e5LuvriXO2HMl+qlwvROKLzvI2ugvsDWn+DroLVfI3ARgSiSWj1uo0QfJWqiksbtfg2369lf7hs9fkj+Z9yaKjpz/pJlwpZ+Vevv7t/FMf0chqlk95d+0bxTXS6JKP11XQXt6v1n13G/aFVvSRXy6OXc6e+K5dGo/2jfPIv8ssuOqcq3Y3LHfz9gr4D5dbxdQioSWH2chJdf8XN7p1f0itwdIrYnfVRcZzRv+7wfonDys8Zt70U/P9nidQEEn33+Ttr3s/wVf0g+bQ/WTxIvksne1RcSM5V9KfbfxVuV+l14/ed/2llwn1BV4ftahycX3Yd9bvRy5KKPi8TT4ef2xjg/nrxKj8/MGQ2ayPwNQhUv1Q85SX1aza42FH15eCq5iajVy3+0WLrXkbQTf/VdNcfwjfyUlEc3uXi6Ly4Ckke5XOij/a4/K4/xH+1/hkemTxT0XSTfsI1Sie9VfHpPhLQJUT1kELyovZH9+XI/1l+HnXsqmdn+Z/2bxZ3Z+czW58Ue2m/1PPi8pHelfR+QV+Jbsv+egTUZEBFKJpUX/rV4kGbpRaXSFPk+v90frepUONI4asqphQvTb83AsqQ7g4B2SFPbQ4z+TCSn+hczXbaxWOWF1T56n5F/clG9FMulQkfyt/Z+uTqb37vr99XxfF7f5WVuXq9+4Ku5slVdiv16ezSgPzN/PIzer5n9s7k/Q9VLZJoFd9qewAAAABJRU5ErkJggg==";
    }
    public function gambar_telinga_2()
    {
        return "data:image/png;base64,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";
    }
    public function gambar_lain()
    {
        return "data:image/png;base64,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";
    }
    public function gambar_lain_2()
    {
        return "data:image/png;base64,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";
    }
    public function blank_img()
    {
        return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAH0CAYAAACuKActAAAgAElEQVR4Xu3XMREAAAgDMfBvGhn8EBT0UpbuOAIECBAgQIAAAQIECBAgQOBdYN8TCECAAAECBAgQIECAAAECBAiMge4JCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAFwrhPQAAAbMSURBVAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBA42NgB9XiesokAAAAASUVORK5CYII=";
    }
    public function another_img()
    {
        return "data:image/png;base64,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";
    }
    public function simpansumarilis(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $datasum = [
            'kode_kunjungan' => $dataSet['kodekunjungan'],
            'no_rm' => $dataSet['nomorrm'],
            'tgl_kunjungan' => $dataSet['tanggalsumarilis'],
            'diagnosa' => $dataSet['diagnosasum'],
            'siklus' => $dataSet['siklus'],
            'ket_regimen' => $dataSet['ketreg'],
            'obat' => $dataSet['obat'],
        ];
        if ($dataSet['tanggalsumarilis'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Tanggal tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        $cek = DB::connection('mysql4')->select('select * from ts_hasil_sumarilis where kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
        if (count($cek) == 0) {
            $simpan = ts_sumarilis::create($datasum);
        } else {
            ts_sumarilis::where('kode_kunjungan', $dataSet['kodekunjungan'])
                ->update($datasum);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpandarah(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if($dataSet['ruangrawat'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Silahkan Pilih Ruang Rawat !'
            ];
            echo json_encode($data);
            die;
        }
        $datasum = [
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $dataSet['kodekunjungan'],
            'no_kantong' => $dataSet['noka_darah'],
            'asal_unit' => $dataSet['ruangrawat'],
            'diag_klinis' => $dataSet['diagnosaklinis'],
            'Jenis_darah' => $dataSet['jenisdarah'],
            'isi' => $dataSet['isi_darah'],
            'tgl_transfusi' => $dataSet['tanggal'],
            'mulai_transfusi' => $dataSet['mulai_tf'],
            'selesai_transfusi' => $dataSet['selesai_tf'],
            'volume_pakai' => $dataSet['vol_tf'],
            'riwayat_alergi' => $dataSet['riw_alergi'],
            'riwayat_alergi_ket' => $dataSet['ket_alergi'],
            'pernah_transfusi' => $dataSet['per_traf'],
        ];
        if ($dataSet['tanggal'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Tanggal tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['jenisdarah'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Jenis darah tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['diagnosaklinis'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Diagnosa Klinis tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['mulai_tf'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Jam mulai transfusi tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['noka_darah'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Nomor kantong darah tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        $cek = DB::select('select * from erm_transfusi_darah_reaksi where kode_kunjungan = ? and no_kantong = ?', [$dataSet['kodekunjungan'],$dataSet['noka_darah']]);
        if (count($cek) == 0) {
            $simpan = ts_erm_transfusi_darah_reaksi::create($datasum);
        } else {
            ts_erm_transfusi_darah_reaksi::where('kode_kunjungan', $dataSet['kodekunjungan'])
                ->update($datasum);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaneditdarah(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if($dataSet['ruangrawat'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Silahkan Pilih Ruang Rawat !'
            ];
            echo json_encode($data);
            die;
        }
        $datasum = [
            'no_kantong' => $dataSet['noka_darah'],
            'asal_unit' => $dataSet['ruangrawat'],
            'diag_klinis' => $dataSet['diagnosaklinis'],
            'Jenis_darah' => $dataSet['jenisdarah'],
            'isi' => $dataSet['isi_darah'],
            'tgl_transfusi' => $dataSet['tanggal'],
            'mulai_transfusi' => $dataSet['mulai_tf'],
            'selesai_transfusi' => $dataSet['selesai_tf'],
            'volume_pakai' => $dataSet['vol_tf'],
            'riwayat_alergi' => $dataSet['riw_alergi'],
            'riwayat_alergi_ket' => $dataSet['ket_alergi'],
            'pernah_transfusi' => $dataSet['per_traf'],
        ];
        if ($dataSet['tanggal'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Tanggal tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['jenisdarah'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Jenis darah tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['diagnosaklinis'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Diagnosa Klinis tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['mulai_tf'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Jam mulai transfusi tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['noka_darah'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Nomor kantong darah tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        $cek = DB::select('select * from erm_transfusi_darah_reaksi where idx = ?', [$dataSet['id']]);
        if (count($cek) == 0) {
            $simpan = ts_erm_transfusi_darah_reaksi::create($datasum);
        } else {
            ts_erm_transfusi_darah_reaksi::where('idx', $dataSet['id'])
                ->update($datasum);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function hapusdarah(Request $request)
    {
        DB::table('erm_transfusi_darah_reaksi')->where('idx', $request->id)->delete();
        DB::table('erm_transfusi_darah_monitoring')->where('id_reaksi', $request->id)->delete();
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil dihapus !'
        ];
        echo json_encode($data);
        die;
    }
    public function hapusmonitoring(Request $request)
    {
        DB::table('erm_transfusi_darah_monitoring')->where('idx', $request->id)->delete();
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil dihapus !'
        ];
        echo json_encode($data);
        die;
    }
    public function showfile(Request $request)
    {
        $id = $request->id;
        $img = DB::select('select * from erm_upload_gambar where id = ?', [$id]);
        $url = url('../../files/');
        return view('ermtemplate.detailgbr_upload', compact([
            'img',
            'url'
        ]));
    }
    public function ambilform_monitoring(Request $request)
    {
        $id = $request->id;
        $kodekunjungan = $request->kodekunjungan;
        $nomorkantong = $request->nomorkantong;
        $isi = $request->isi;
        $jenis = $request->jenis;
        return view('ermtemplate.isi_form_monitoring_darah',compact([
            'id',
            'kodekunjungan',
            'nomorkantong',
            'isi',
            'jenis'
        ]));
    }
    public function ambilform_editmonitoring(Request $request)
    {
        $id = $request->id;
        $data_mon = DB::select('select * from erm_transfusi_darah_monitoring where idx = ?',([$id]));
        return view('ermtemplate.edit_isi_form_monitoring_darah',compact([
            'id',
           'data_mon'
        ]));
    }
    public function ambilform_input_reaksi(Request $request)
    {
        $id = $request->id;
        $data_mon = DB::select('select * from erm_transfusi_darah_monitoring where idx = ?',([$id]));
        $data_reaksi = DB::select('select * from erm_transfusi_darah_reaksi where idx = ?',([$data_mon[0]->id_reaksi]));
        $unit = DB::select('select * from mt_unit where group_unit = ?',(['I']));
        return view('ermtemplate.isi_form_input_reaksi',compact([
            'id',
            'data_mon',
            'data_reaksi',
            'unit'
        ]));
    }
    public function ambilform_edit_transfusi(Request $request)
    {
        $id = $request->id;
        $data_reaksi = DB::select('select * from erm_transfusi_darah_reaksi where idx = ?',([$id]));
        $unit = DB::select('select * from mt_unit where group_unit = ?',(['I']));
        return view('ermtemplate.isi_edit_transfusi',compact([
            'id',
            'data_reaksi',
            'unit'
        ]));
    }
    public function simpanmonitoring_darah(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $datamon = [
            'id_reaksi' => $dataSet['id_reak'],
            // 'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $dataSet['kode_kunjungan_mon'],
            'asal_unit' => '',
            'tgl_monitoring' => $dataSet['tgl_mon'],
            'jam_monitoring' => $dataSet['jm_mon'],
            'Jenis_darah' => $dataSet['jd_mon'],
            'no_kantong' => $dataSet['nomorkantong_mon'],
            // 'pernah_transfusi' => $dataSet['per_traf'],
            // 'riwayat_alergi' => $dataSet['riw_alergi'],
            // 'riwayat_alergi_ket' => $dataSet['ket_alergi'],
            'isi' => $dataSet['isda_mon'],
            'ttv_td' => $dataSet['td_mon'],
            'ttv_nadi' => $dataSet['nadi_mon'],
            'ttv_rr' => $dataSet['rr_mon'],
            'ttv_s' => $dataSet['s_mon'],
            'pic' => auth()->user()->id,
            'reaksi' => $dataSet['reaksi_mon'],
        ];
        if($dataSet['tgl_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Tanggal monitoring tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['jm_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Jam monitoring tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['td_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Tekanan Darah tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['nadi_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi nadi tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['rr_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi Nafas tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['s_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Suhu tubuh tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        $simpan = ts_erm_transfusi_darah_monitoring::create($datamon);
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpaneditmonitoring_darah(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $datamon = [
            // 'tgl_entry' => $this->get_now(),
            'asal_unit' => '',
            'tgl_monitoring' => $dataSet['tgl_mon'],
            'jam_monitoring' => $dataSet['jm_mon'],
            'Jenis_darah' => $dataSet['jd_mon'],
            'no_kantong' => $dataSet['nomorkantong_mon'],
            // 'pernah_transfusi' => $dataSet['per_traf'],
            // 'riwayat_alergi' => $dataSet['riw_alergi'],
            // 'riwayat_alergi_ket' => $dataSet['ket_alergi'],
            'isi' => $dataSet['isda_mon'],
            'ttv_td' => $dataSet['td_mon'],
            'ttv_nadi' => $dataSet['nadi_mon'],
            'ttv_rr' => $dataSet['rr_mon'],
            'ttv_s' => $dataSet['s_mon'],
            'pic' => auth()->user()->id,
            'reaksi' => $dataSet['reaksi_mon'],
        ];
        if($dataSet['tgl_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Tanggal monitoring tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['jm_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Jam monitoring tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['td_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Tekanan Darah tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['nadi_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi nadi tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['rr_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi Nafas tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        if($dataSet['s_mon'] == ''){
            $data = [
                'kode' => 500,
                'message' => 'Suhu tubuh tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        ts_erm_transfusi_darah_monitoring::where('idx', $dataSet['id_mon'])
                ->update($datamon);
        // $simpan = ts_erm_transfusi_darah_monitoring::create($datamon);
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpanhasil_reaksi(Request $request)
    {
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if (empty($dataSet['demam2'])) {
            $dataSet['demam2'] = 0;
        }
        if (empty($dataSet['menggigil'])) {
            $dataSet['menggigil'] = 0;
        }
        if (empty($dataSet['gatal'])) {
            $dataSet['gatal'] = 0;
        }
        if (empty($dataSet['lainnya'])) {
            $dataSet['lainnya'] = 0;
        }


        if (empty($dataSet['nyeripinggangbawah'])) {
            $dataSet['nyeripinggangbawah'] = 0;
        }
        if (empty($dataSet['nyeridada'])) {
            $dataSet['nyeridada'] = 0;
        }
        if (empty($dataSet['cemas'])) {
            $dataSet['cemas'] = 0;
        }
        if (empty($dataSet['sakitkepala'])) {
            $dataSet['sakitkepala'] = 0;
        }


        if (empty($dataSet['kulitbiru'])) {
            $dataSet['kulitbiru'] = 0;
        }
        if (empty($dataSet['bakgelas'])) {
            $dataSet['bakgelas'] = 0;
        }
        if (empty($dataSet['sesaknafas'])) {
            $dataSet['sesaknafas'] = 0;
        }
        if (empty($dataSet['perdarahanluka'])) {
            $dataSet['perdarahanluka'] = 0;
        }
        $datasum = [
            'no_kantong' => $dataSet['noka_darah'],
            'asal_unit' => $dataSet['ruangrawat'],
            'diag_klinis' => $dataSet['diagnosaklinis'],
            'Jenis_darah' => $dataSet['jenisdarah'],
            'isi' => $dataSet['isi_darah'],
            'tgl_transfusi' => $dataSet['tanggal'],
            'mulai_transfusi' => $dataSet['mulai_tf'],
            'selesai_transfusi' => $dataSet['selesai_tf'],
            'volume_pakai' => $dataSet['vol_tf'],
            'riwayat_alergi' => $dataSet['riw_alergi'],
            'riwayat_alergi_ket' => $dataSet['ket_alergi'],
            'pernah_transfusi' => $dataSet['per_traf'],
            'tgl_reaksi' =>  $dataSet['tanggal_reaksi'],
            'check_identitas' => $dataSet['idpasien'],
            'check_kantong' => $dataSet['status_kantong'],
            'check_suhu' => $dataSet['demam'],
            'tv_sebelum_reaksi' => $dataSet['jam_sebelum_reak'].'|'.$dataSet['ttv_s_sebelum'].'|'.$dataSet['ttv_rr_sebelum'].'|'.$dataSet['ttv_td_sebelum'].'|'.$dataSet['ttv_nadi_sebelum'],
            'tv_terjadi_reaksi' => $dataSet['jam_sesudah_reak'].'|'.$dataSet['ttv_s_sesudah'].'|'.$dataSet['ttv_rr_sesudah'].'|'.$dataSet['ttv_td_sesudah'].'|'.$dataSet['ttv_nadi_sesudah'],
            'Gejala_klinis' => $dataSet['demam2'].'|'.$dataSet['menggigil'].'|'.$dataSet['gatal'].'|'.$dataSet['lainnya'].'|'.$dataSet['nyeripinggangbawah'].'|'.$dataSet['nyeridada'].'|'.$dataSet['cemas'].'|'.$dataSet['sakitkepala'].'|'.$dataSet['kulitbiru'].'|'.$dataSet['bakgelas'].'|'.$dataSet['sesaknafas'].'|'.$dataSet['perdarahanluka'],
        ];
        ts_erm_transfusi_darah_reaksi::where('idx', $dataSet['kodereaksi'])
        ->update($datasum);
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
}
