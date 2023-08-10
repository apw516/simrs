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
        $kunjungan = DB::select('SELECT *,fc_nama_unit1(a.ref_unit) as nama_ref_unit,b.kode_unit,c.kode_unit as kode_unit_dokter,a.kode_kunjungan as kodek,a.no_rm as no_rm_k,b.id as id_1, c.id as id_2,b.signature as signature_perawat,c.signature as signature_dokter,b.keluhanutama as keluhan_perawat,a.tgl_masuk,a.counter,fc_nama_unit1(a.kode_unit) AS nama_unit FROM ts_kunjungan a
        LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`kode_kunjungan` = b.kode_kunjungan
        LEFT OUTER JOIN assesmen_dokters c ON a.`kode_kunjungan` = c.`id_kunjungan` where a.no_rm = ? and a.status_kunjungan != ? ORDER BY a.kode_kunjungan desc', [$request->rm, 8]);
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

        // dd($request->gambar);
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
                    'tgl_periksa' => '2023-07-07',
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
                    'tgl_periksa' => '2023-07-07',
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
                $hasil_pemeriksaan_khusus = "Catatan pemeriksaan lain : ". $dataSet['hasilperiksalain']. " | Tekanan Intra Okular : " . $dataSet['tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['palpebra'] . " | Konjungtiva : " . $dataSet['konjungtiva'] . "| Kornea : " . $dataSet['kornea'] . " | Bilik Mata Depan : " . $dataSet['bilik_mata_depan'] . " | pupil : " . $dataSet['pupil'] . " | Iris : " . $dataSet['iris'] . " | Lensa : " . $dataSet['lensa'] . " | funduskopi : " . $dataSet['funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['oftamologis'] . "| Masalah Medis : " . $dataSet['masalahmedis'] . " | Prognosis : " . $dataSet['prognosis'];
                if($request->gambar == $this->gambar_mata() || $request->gambar == $this->gambar_mata_2() || $request->gambar == $this->blank_img()){
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

                if($request->gambar == $this->gambar_telinga() || $request->gambar == $this->gambar_telinga_2() || $request->gambar == $this->blank_img()){
                   $gambar = '';
                }else{
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
                if($request->gambar == $this->gambar_lain() || $request->gambar == $this->gambar_lain_2() || $request->gambar == $this->blank_img()){
                    $gambar = '';
                }
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
    public function simpanpemeriksaandokter_fisio(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $dataobat = json_decode($_POST['dataobat'], true);

        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
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
        $riwayat_tindakan_lab = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
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
        $cek = DB::select('select *,fc_nama_unit2(kode_unit) as nama_unit from erm_upload_gambar where kodekunjungan = ?', [$request->kodekunjungan]);
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
        $hasil_rad = DB::select('SELECT *,DATE(b.tgl_baca ) AS tanggalnya,fc_acc_number_ris(b.id_detail) AS acc_number FROM ts_kunjungan a LEFT OUTER JOIN
        ts_hasil_expertisi b ON a.kode_kunjungan = b.kode_kunjungan
        WHERE a.no_rm = ? ', [$rm]);
        return view('ermtemplate.view_hasil_penunjang_rad', compact([
            'hasil_rad',
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
        return "data:image/png;base64,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";
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
        return "data:image/png;base64,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IH8LePN4nuDI9+rXtd8Y/fRnGm8Hqm0bz/3keZ/cbqaeZx+w/VTY1Nb5d9dfHxdmPrqu8/Hb2Kf+Ph2Ec982z8v6yoC5vecWbrPOc/vL+ZvXpU/+zNjMZ5/g6vHmdtdG57nffoYyjzVdn3MMnO0/w/jMbx5D+v23kyg5v+e/t+9ImH1dOuZ/Z63PNnb+7jPonyrd3wgQIEDgVxb43QP6r4xh7AQIECBAgAABAgQIECBA4P9LQED//5L3vgQIECBAgAABAgQIECBAIAQEdOVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgICArgYIECBAgAABAgQIECBAgMADAgL6A5NgCAQIECBAgAABAgQIECBAQEBXAwQIECBAgAABAgQIECBA4AEBAf2BSTAEAgQIECBAgAABAgQIECAgoKsBAgQIECBAgAABAgQIECDwgICA/sAkGAIBAgQIECBAgAABAgQIEBDQ1QABAgQIECBAgAABAgQIEHhAQEB/YBIMgQABAgQIECBAgAABAgQICOhqgAABAgQIECBAgAABAgQIPCAgoD8wCYZAgAABAgQIECBAgAABAgQEdDVAgAABAgQIECBAgAABAgQeEBDQH5gEQyBAgAABAgQIECBAgAABAgK6GiBAgAABAgQIECBAgAABAg8ICOgPTIIhECBAgAABAgQIECBAgAABAV0NECBAgAABAgQIECBAgACBBwQE9AcmwRAIECBAgAABAgQIECBAgMC/A1W9mo3LmCzZAAAAAElFTkSuQmCC";
    }
    public function blank_img()
    {
        return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA+gAAAH0CAYAAACuKActAAAgAElEQVR4Xu3XMREAAAgDMfBvGhn8EBT0UpbuOAIECBAgQIAAAQIECBAgQOBdYN8TCECAAAECBAgQIECAAAECBAiMge4JCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAFwrhPQAAAbMSURBVAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBAw0P0AAQIECBAgQIAAAQIECBAICBjogRJEIECAAAECBAgQIECAAAECBrofIECAAAECBAgQIECAAAECAQEDPVCCCAQIECBAgAABAgQIECBAwED3AwQIECBAgAABAgQIECBAICBgoAdKEIEAAQIECBAgQIAAAQIECBjofoAAAQIECBAgQIAAAQIECAQEDPRACSIQIECAAAECBAgQIECAAAED3Q8QIECAAAECBAgQIECAAIGAgIEeKEEEAgQIECBAgAABAgQIECBgoPsBAgQIECBAgAABAgQIECAQEDDQAyWIQIAAAQIECBAgQIAAAQIEDHQ/QIAAAQIECBAgQIAAAQIEAgIGeqAEEQgQIECAAAECBAgQIECAgIHuBwgQIECAAAECBAgQIECAQEDAQA+UIAIBAgQIECBAgAABAgQIEDDQ/QABAgQIECBAgAABAgQIEAgIGOiBEkQgQIAAAQIECBAgQIAAAQIGuh8gQIAAAQIECBAgQIAAAQIBAQM9UIIIBAgQIECAAAECBAgQIEDAQPcDBAgQIECAAAECBAgQIEAgIGCgB0oQgQABAgQIECBAgAABAgQIGOh+gAABAgQIECBAgAABAgQIBAQM9EAJIhAgQIAAAQIECBAgQIAAAQPdDxAgQIAAAQIECBAgQIAAgYCAgR4oQQQCBAgQIECAAAECBAgQIGCg+wECBAgQIECAAAECBAgQIBAQMNADJYhAgAABAgQIECBAgAABAgQMdD9AgAABAgQIECBAgAABAgQCAgZ6oAQRCBAgQIAAAQIECBAgQICAge4HCBAgQIAAAQIECBAgQIBAQMBAD5QgAgECBAgQIECAAAECBAgQMND9AAECBAgQIECAAAECBAgQCAgY6IESRCBAgAABAgQIECBAgAABAga6HyBAgAABAgQIECBAgAABAgEBAz1QgggECBAgQIAAAQIECBAgQMBA9wMECBAgQIAAAQIECBAgQCAgYKAHShCBAAECBAgQIECAAAECBAgY6H6AAAECBAgQIECAAAECBAgEBAz0QAkiECBAgAABAgQIECBAgAABA90PECBAgAABAgQIECBAgACBgICBHihBBAIECBAgQIAAAQIECBAgYKD7AQIECBAgQIAAAQIECBAgEBAw0AMliECAAAECBAgQIECAAAECBAx0P0CAAAECBAgQIECAAAECBAICBnqgBBEIECBAgAABAgQIECBAgICB7gcIECBAgAABAgQIECBAgEBAwEAPlCACAQIECBAgQIAAAQIECBA42NgB9XiesokAAAAASUVORK5CYII=";
    }
}


