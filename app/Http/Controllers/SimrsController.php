<?php

namespace App\Http\Controllers;

use PDF;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\GdEscposImage;
use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\VclaimModel;
use App\Models\antrianmarwan;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\ts_kunjungan;
use App\Models\mt_unit;
use App\Models\ts_layanan_detail;
use App\Models\ts_layanan_header;
use App\Models\ts_sep;
use App\Models\Agama;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Hubkeluarga;
use App\Models\Negara;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\mt_keluarga;
use App\Models\mt_domisili;
use App\Models\ts_rujukan;
use App\Models\jkn_antrian;
use App\Models\Status;
use App\Models\tracer;

class SimrsController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function pendaftaran()
    {
        $title = 'SIMRS - PENDAFTARAN';
        $sidebar = '2';
        $sidebar_m = '2';

        return view('pendaftaran.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'data_pasien' => Pasien::limit(200)->orderBy('tgl_entry', 'desc')->get(),
            'sidebar_m' => $sidebar_m,
            'status' => Status::all(),
            'agama' => Agama::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan' => Pendidikan::all(),
            'hubkel' => Hubkeluarga::all(),
            'negara' => Negara::all(),
            'provinsi' => Provinsi::all(),
        ]);
    }
    public function pendaftaran2()
    {
        $title = 'SIMRS - PENDAFTARAN2';
        $sidebar = '2.9';
        $sidebar_m = '2';

        return view('pendaftaran2.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'data_pasien' => Pasien::limit(200)->orderBy('tgl_entry', 'desc')->get(),
            'sidebar_m' => $sidebar_m,
            'agama' => Agama::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan' => Pendidikan::all(),
            'hubkel' => Hubkeluarga::all(),
            'negara' => Negara::all(),
            'provinsi' => Provinsi::all(),
        ]);
    }
    public function Menucarisep()
    {
        $title = 'SIMRS - CARI SEP';
        $sidebar = 'SEP';
        $sidebar_m = 'CARI SEP';
        return view('vclaim.carisep', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menulisttglpulang()
    {
        $title = 'SIMRS - LIST TANGGAL PULANG SEP';
        $sidebar = 'SEP';
        $sidebar_m = 'LIST TANGGAL PULANG SEP';
        return view('vclaim.listtanggalpulang', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menulistfinger()
    {
        $title = 'SIMRS - LIST fINGER PRINT';
        $sidebar = 'SEP';
        $sidebar_m = 'LIST FINGER PRINT';
        return view('vclaim.listfingerprint', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menucarirujukan()
    {
        $title = 'SIMRS - CARI RUJUKAN';
        $sidebar = 'RUJUKAN';
        $sidebar_m = 'CARI RUJUKAN';
        return view('vclaim.carirujukan', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuinsertrujukan()
    {
        $title = 'SIMRS - INSERT RUJUKAN';
        $sidebar = 'RUJUKAN';
        $sidebar_m = 'INSERT RUJUKAN';
        return view('vclaim.insertrujukan', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menulistrujukankeluar()
    {
        $title = 'SIMRS - DATA RUJUKAN KELUAR RS';
        $sidebar = 'RUJUKAN';
        $sidebar_m = 'DATA RUJUKAN KELUAR RS';
        return view('vclaim.datarujukankeluar', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuinsertrujukankhusus()
    {
        $title = 'SIMRS - INSERT RUJUKAN KHUSUS';
        $sidebar = 'RUJUKAN';
        $sidebar_m = 'INSERT RUJUKAN KHUSUS';
        return view('vclaim.insertrujukan_khusus', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menulistrujukankhusus()
    {
        $title = 'SIMRS - LIST RUJUKAN KHUSUS';
        $sidebar = 'RUJUKAN';
        $sidebar_m = 'LIST RUJUKAN KHUSUS';
        return view('vclaim.listrujukan_khusus', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menucarisuratkontrol()
    {
        $title = 'SIMRS - CARI SURAT KONTROL & SPRI';
        $sidebar = 'SURAT KONTROL';
        $sidebar_m = 'CARI SURAT KONTROL & SPRI';
        return view('vclaim.carisuratkontrol', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuinsertrencanakontrol()
    {
        $title = 'SIMRS - INSERT SURAT KONTROL';
        $sidebar = 'SURAT KONTROL';
        $sidebar_m = 'INSERT SURAT KONTROL';
        return view('vclaim.insertsuratkontrol', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuinsertspri()
    {
        $title = 'SIMRS - INSERT SPRI';
        $sidebar = 'SURAT KONTROL';
        $sidebar_m = 'INSERT SPRI';
        return view('vclaim.insertspri', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuinsertprb()
    {
        $title = 'SIMRS - INSERT PRB';
        $sidebar = 'PRB';
        $sidebar_m = 'INSERT PRB';
        $v = new VclaimModel();
        $p = $v->referensi_diagnosa_prb();
        // dd($p);
        return view('vclaim.insertprb', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'program_prb' => $p
        ]);
    }
    public function menucariprb()
    {
        $title = 'SIMRS - PENCARIAN PRB';
        $sidebar = 'PRB';
        $sidebar_m = 'CARI PRB';
        $v = new VclaimModel();
        $p = $v->referensi_diagnosa_prb();
        // dd($p);
        return view('vclaim.cariprb', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'program_prb' => $p
        ]);
    }
    public function menudatakunjungan()
    {
        $title = 'SIMRS - DATA KUNJUNGAN';
        $sidebar = 'MONITORING';
        $sidebar_m = 'DATA KUNJUNGAN';
        return view('vclaim.datakunjungan', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menudataklaim()
    {
        $title = 'SIMRS - DATA KLAIM';
        $sidebar = 'MONITORING';
        $sidebar_m = 'DATA KLAIM';
        return view('vclaim.dataklaim', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuhispelpes()
    {
        $title = 'SIMRS - History Pelayanan Peserta';
        $sidebar = 'MONITORING';
        $sidebar_m = 'History Pelayanan Peserta';
        return view('vclaim.historypelayananpeserta', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menudataklaimjr()
    {
        $title = 'SIMRS - DATA KLAIM JR';
        $sidebar = 'MONITORING';
        $sidebar_m = 'DATA KLAIM JR';
        return view('vclaim.dataklaimjr', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menusepvalidasi()
    {
        $title = 'SIMRS - INSERT SEP';
        $sidebar = 'SEP';
        $sidebar_m = 'INSERT SEP';
        return view('vclaim.sepvalidasi', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function menuriwayatpasien()
    {
        $title = 'SIMRS - RIWAYAT PELAYANAN PASIEN';
        $sidebar = 'riwayatpasien';
        $sidebar_m = '';
        return view('vclaim.caririrwayatpasien', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function ValidasiRanap()
    {
        $title = 'SIMRS - Validasi Ranap';
        $sidebar = '2.1';
        $sidebar_m = '2.1';
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-12 days'));
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS_RANAP('$d2','$now')");
        return view('pendaftaran.validasi', [
            'title' => $title,
            'sidebar' => $sidebar,
            'datakunjungan' => $data_kunjungan,
            'sidebar_m' => $sidebar_m
        ]);
    }
    public function formvalidasi(Request $request)
    {
        $v = new VclaimModel();
        $rm = $request->nomorrm;
        $kodekunjungan = $request->kodekunjungan;
        $tglmasuk = $request->tglmasuk;
        $date = str_replace('/', '-', $tglmasuk);
        $tglmasuk2 = date("Y-m-d", strtotime($date));
        // dd($tglmasuk2);
        $naikkelas = $request->naikkelas;
        $mt_pasien = Pasien::where('no_rm', $rm)->get();
        $noka = $mt_pasien[0]->no_Bpjs;
        $v = new VclaimModel();
        $noka = $v->get_peserta_noka($noka, date('Y-m-d'));
        return view('pendaftaran.form_validasi', [
            'tglmasuk' => $tglmasuk2,
            'data_peserta' => $noka,
            'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX('$rm')"),
            // 'alasan_masuk' => DB::select('select * from mt_alasan_masuk'),
            'kode_kunjungan' => $kodekunjungan,
            'nomorrm' => $rm,
            'mt_pasien' => Pasien::where('no_rm', $rm)->get(),
            'ts_kunjungan' => ts_kunjungan::where('kode_kunjungan', $kodekunjungan)->get(),
            'provinsi' => $v->referensi_propinsi(),
            'crad' => $naikkelas,
            // 'cek_kunjungan' => $total
        ]);
    }
    public function Formranap(Request $request)
    {
        $v = new VclaimModel();
        // $noka = $v->get_peserta_noka($request->nomorbpjs, date('Y-m-d'));
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ? and status_kunjungan = 1', [$request->nomorrm]);
        $total = count($cek_rm);
        if ($total > 0) {
            $tanggal_k = $cek_rm[0]->tgl_masuk;
        } else {
            $tanggal_k = 0;
        }
        return view('pendaftaran.formranap', [
            // 'data_peserta' => $noka,
            'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX('$request->nomorrm')"),
            'alasan_masuk' => DB::select('select * from mt_alasan_masuk'),
            'mt_penjamin' => DB::select('select * from mt_penjamin'),
            'nomorrm' => $request->nomorrm,
            'mt_pasien' => Pasien::where('no_rm', $request->nomorrm)->get(),
            'mt_unit' => mt_unit::where('kelas_unit', 2)->get(),
            'provinsi' => $v->referensi_propinsi(),
            // 'cek_kunjungan' => $total,
            'kunjungan_aktif' => $tanggal_k
        ]);
    }
    public function Formbpjs(Request $request)
    {
        $v = new VclaimModel();
        $noka = $v->get_peserta_noka($request->nomorbpjs, date('Y-m-d'));
        try {
            $noka = $v->get_peserta_noka($request->nomorbpjs, date('Y-m-d'));
        } catch (\Exception $e) {
            $err = $e->getMessage();
            echo "<div class='alert alert-danger' role='alert'> $err </div>";
            die;
        }

        $status_code = $noka->metaData->code;
        $status_message = $noka->metaData->message;
        if($status_code != 200){
            echo "<div class='alert alert-danger' role='alert'> $status_message </div>";
            die;
        }
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ? and status_kunjungan = 1', [$request->nomorrm]);
        $total = count($cek_rm);
        if ($total > 0) {
            $tanggal_k = $cek_rm[0]->tgl_masuk;
        } else {
            $tanggal_k = 0;
        }

        return view('pendaftaran.form_pasien_bpjs', [
            'data_peserta' => $noka,
            'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX('$request->nomorrm')"),
            'alasan_masuk' => DB::select('select * from mt_alasan_masuk'),
            'nomorrm' => $request->nomorrm,
            'mt_pasien' => Pasien::where('no_rm', $request->nomorrm)->get(),
            'mt_unit' => mt_unit::where('kelas_unit', 2)->get(),
            'provinsi' => $v->referensi_propinsi(),
            'cek_kunjungan' => $total,
            'kunjungan_aktif' => $tanggal_k
        ]);
    }
    public function Formumum(Request $request)
    {
        // $noka = $v->get_peserta_noka($request->nomorrm, date('Y-m-d'));
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ? and status_kunjungan = 1', [$request->nomorrm]);
        $total = count($cek_rm);
        return view(
            'pendaftaran.form_pasien_umum',
            [
                // 'data_peserta' => $noka,
                'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX('$request->nomorrm')"),
                'alasan_masuk' => DB::select('select * from mt_alasan_masuk'),
                'mt_penjamin' => DB::select('select * from mt_penjamin'),
                'mt_unit' => mt_unit::where('kelas_unit', '=', "2")->get()
                // 'nomorrm' => $request->nomorrm,
                // 'mt_pasien' => Pasien::where('no_rm', $request->nomorrm)->get(),
                // 'mt_unit' => mt_unit::where('kelas_unit', 2)->get(),
                // 'provinsi' => $v->referensi_propinsi(),
                // 'cek_kunjungan' => $total
            ]
        );
    }
    public function Caripasien(Request $request)
    {
        return view('pendaftaran.pencarianpasien', [
            'data_pasien' =>  DB::select("CALL WSP_PANGGIL_DATAPASIEN('$request->nomorrm','$request->nama','$request->alamat','$request->nomorktp','$request->nomorbpjs')")
        ]);
    }
    public function Caripoli(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_poli($request['term']);
        if (count($result->response->poli) > 0) {
            foreach ($result->response->poli as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function Caripoli_rs(Request $request)
    {
        $v = new VclaimModel();
        // $result = $v->referensi_poli($request['term']);
        $r = 'JANTUNG';
        $result = DB::table('mt_unit')->where('nama_unit', 'LIKE', '%' . $request['term'] . '%')->where('kelas_unit', '=', '1')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_unit,
                    'kode' => $row->kode_unit,
                );
            echo json_encode($arr_result);
        }
    }
    public function Caridokter(Request $request)
    {
        $r = $request['term'];
        $result = Dokter::where('nama_dokter', 'LIKE', "%{$r}%")->where('act', '=', '1')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row['nama_dokter'],
                    'kode' => $row['kode_dpjp'],
                );
            echo json_encode($arr_result);
        }
    }
    public function Caridokter_rs(Request $request)
    {
        $result = DB::table('mt_paramedis')->where('nama_paramedis', 'LIKE', '%' . $request['term'] . '%')->where('keilmuan', '=', 'dr')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_paramedis,
                    'kode' => $row->kode_paramedis,
                );
            echo json_encode($arr_result);
        }
    }
    public function Caridiagnosa(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_diagnosa($request['term']);
        if (count($result->response->diagnosa) > 0) {
            foreach ($result->response->diagnosa as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function cariobat(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_obat_generik_prb($request['term']);
        if (count($result->response->list) > 0) {
            foreach ($result->response->list as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function cariprocedure(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_procedure_prb($request['term']);
        if (count($result->response->procedure) > 0) {
            foreach ($result->response->procedure as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function Carippkrujukan(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_faskes($request['term'], $request['faskes']);
        if (count($result->response->faskes) > 0) {
            foreach ($result->response->faskes as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function Cariruangranap(Request $request)
    {
        $cekruangan = $request->hakkelaspenuh;
        $naikkelas = $request->naikkelas;
        $hakkelas = $request->hakkelas;
        $kode_unit = $request->kode_unit;
        if ($cekruangan == 1) {
        } else if ($naikkelas == 1) {
        } else {
            $ruangan = DB::select('SELECT DISTINCT nama_kamar FROM mt_ruangan WHERE id_kelas = ?  AND kode_unit = ? AND status = ?', [$hakkelas, $kode_unit, 1]);
        }
        echo "<option value=> -- Silahkan Pilih Ruangan -- </option>";
        foreach ($ruangan as $j) {
            echo "<option value=$j->nama_kamar>$j->nama_kamar</option>";
        }
    }
    public function Cariruangranap2(Request $request)
    {
        $kelas = $request->kelas;
        $unit = $request->unit;
        return view(
            'pendaftaran.tabelruangan',
            [
                'ruangan' => DB::select('SELECT * FROM mt_ruangan WHERE id_kelas = ?  AND kode_unit = ? AND status = ?', [$kelas, $unit, 1])
            ]
        );
    }
    public function Carikabupaten(Request $request)
    {
        $v = new VclaimModel();
        $prov = $request->prov;
        $kabupaten = $v->referensi_kabupaten($prov);
        echo "<option value=> -- Silahkan Pilih Kabupaten -- </option>";
        foreach ($kabupaten->response->list as $j) {
            echo "<option value=$j->kode>$j->nama</option>";
        }
    }
    public function Carikecamatan(Request $request)
    {
        $v = new VclaimModel();
        $kab = $request->kab;
        $kec = $v->referensi_kecamatan($kab);
        echo "<option value=> -- Silahkan Pilih Kecamatan -- </option>";
        foreach ($kec->response->list as $j) {
            echo "<option value=$j->kode>$j->nama</option>";
        }
    }
    public function carikab_local(Request $request)
    {
        $v = new VclaimModel();
        $prov = $request->provinsi;
        $kec = Kabupaten::where('province_id', $prov)->get();
        echo "<option value=> -- Silahkan Pilih Kabupaten -- </option>";
        foreach ($kec as $j) {
            echo "<option value=$j->id>$j->name</option>";
        }
    }
    public function carikec_local(Request $request)
    {
        $v = new VclaimModel();
        $kabupaten = $request->kabupaten;
        $kec = Kecamatan::where('regency_id', $kabupaten)->get();
        echo "<option value=> -- Silahkan Pilih Kecamatan -- </option>";
        foreach ($kec as $j) {
            echo "<option value=$j->id>$j->name</option>";
        }
    }
    public function caridesa_local(Request $request)
    {
        $v = new VclaimModel();
        $kecamatan = $request->kecamatan;
        $des = Desa::where('district_id', $kecamatan)->get();
        echo "<option value=> -- Silahkan Pilih Desa -- </option>";
        foreach ($des as $j) {
            echo "<option value=$j->id>$j->name</option>";
        }
    }
    public function Caribedranap(Request $request)
    {
        $ruanganranap = $request->kamarranap;
        $ruangan = DB::select('SELECT id_ruangan,no_bed FROM mt_ruangan WHERE nama_kamar = ? AND status_incharge = ?', [$ruanganranap, 0]);
        echo "<option value=> -- Silahkan Pilih Ruangan -- </option>";
        foreach ($ruangan as $j) {
            echo "<option id-ruangan=$j->id_ruangan value=$j->no_bed>$j->no_bed</option>";
        }
    }
    public function Caripolikontrol(Request $request)
    {
        $v = new VclaimModel();
        $poli = $v->Datapoli($request->jenis, $request->nomor, $request->tanggal);
        return view('pendaftaran.tabelpolikontrol', [
            'poli' => $poli
        ]);
    }
    public function Caridokterkontrol(Request $request)
    {
        $v = new VclaimModel();
        $dokter = $v->Datadokter($request->jenis, $request->kodepoli, $request->tanggal);
        return view('pendaftaran.tabeldokterkontrol', [
            'poli' => $dokter
        ]);
    }
    public function Buatsuratkontrol(Request $request)
    {
        if ($request->jenissurat == 1) {
            $datasurat = [
                "request" =>
                [
                    "noKartu" => "$request->nomorkartu",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs

                ]
            ];
            $v = new VclaimModel();
            $poli = $v->InsertSPRI($datasurat);
        } else {
            $datasurat = [
                "request" =>
                [
                    "noSEP" => "$request->nomorkartu",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ];
            $v = new VclaimModel();
            $poli = $v->InserRencanakontrol($datasurat);
        }
        echo json_encode($poli);
    }
    public function Buatsuratkontrol2(Request $request)
    {
        $v = new VclaimModel();
        $sep = $request->nosep;
        $kode_paramedis = $request->kodedokter;
        $kode_unit = $request->kodepoli;
        $kode_poli = mt_unit::where('kode_unit', $kode_unit)->get();
        $kode_dokter = Dokter::where('kode_dokter', $kode_paramedis)->get();
        $politujuan = $kode_poli['0']->KDPOLI;
        $dpjp = $kode_dokter['0']->kode_dpjp;
        $datasurat = [
            "request" =>
            [
                "noSEP" => "$sep",
                "kodeDokter" => "$dpjp",
                "poliKontrol" => "$politujuan",
                "tglRencanaKontrol" => date('Y-m-d'),
                "user" => "waled | " . "test"
            ]
        ];
        $v = new VclaimModel();
        $suratkontrol = $v->InserRencanakontrol($datasurat);
        $data_kontrol = [
            'kode_dokter' => $dpjp,
            'kode_poli' => $politujuan,
            'surat_kontrol' => $suratkontrol
        ];
        echo json_encode($data_kontrol);
    }
    public function updatesuratkontrol(Request $request)
    {
        if ($request->jenissurat == 1) {
            $datasurat = [
                "request" =>
                [
                    "noSPRI" => "$request->nomorsurat",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs

                ]
            ];
            $v = new VclaimModel();
            $poli = $v->UpdateSPRI($datasurat);
        } else {
            $datasurat = [
                "request" =>
                [
                    "noSuratKontrol" => "$request->nomorsurat",
                    "noSEP" => "$request->nomorkartu",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ];
            $v = new VclaimModel();
            $poli = $v->updateRencanakontrol($datasurat);
        }
        echo json_encode($poli);
    }
    public function Carisuratkontrol(Request $request)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $nomorkartu = $request->nomorkartu;
        $filter = 2;
        $v = new VclaimModel();
        $suratkontrol = $v->ListRencanaKontrol_bycard($bulan, $tahun, $nomorkartu, $filter);
        return view('pendaftaran.tabelsuratkontrol_peserta', [
            'suratkontrol' => $suratkontrol
        ]);
    }
    public function Caripoli_ppk(Request $request)
    {
        $kode = $request->kodeppk;
        $tgl = $request->tgl;
        $v = new VclaimModel();
        $r1 = $v->list_sarana($kode, $tgl);
        return view('rujukan.tabel_list_spesialistik', [
            'f1' => $r1,
        ]);
    }
    public function Carirujukan(Request $request)
    {
        $nomorkartu = $request->nomorkartu;
        $v = new VclaimModel();
        $r1 = $v->Listrujukan_bycard_faskes1($nomorkartu);
        $r2 = $v->Listrujukan_bycard_faskes2($nomorkartu);
        return view('pendaftaran.tabelrujukan_peserta', [
            'f1' => $r1,
            'f2' => $r2
        ]);
    }
    public function Simpansep(Request $request)
    {
        //antrian
        // $mw = new antrianmarwan();
        // $day = $request->tglsep;
        // $today = strtoupper(Carbon::parse($day)->dayName);
        // $jampraktek = DB::select('select * from jkn_jadwal_dokter where kodedokter = ? and namahari = ?', [$request->kodedokterlayan, $today]);
        // if (empty($jampraktek)) {
        //     $data = [
        //         'kode' => 500,
        //         'message' => 'Jadwal Dokter tidak ditemukan !'
        //     ];
        //     echo json_encode($data);
        //     die;
        // }
        //end antrian
        //ambil antrian
        // if ($request->tujuankunjungan == 0) {
        //     $nomorreferensi = $request->nomorrujukan;
        //     $tujuan = 1;
        // } else if ($request->tujuankunjungan == 2) {
        //     $nomorreferensi = $request->suratkontrol;
        //     $tujuan = 3;
        // }
        // $data_antrian = [
        //     "nomorkartu" => "$request->nomorkartu",
        //     "nik" => "$request->nik",
        //     "nohp" => "$request->nomortelepon",
        //     "kodepoli" => "$request->kodepolitujuan",
        //     "norm" => "$request->norm",
        //     "tanggalperiksa" => "$request->tglsep",
        //     "kodedokter" => $request->kodedokterlayan,
        //     "jampraktek" => $jampraktek[0]->jadwal,
        //     "jeniskunjungan" => "$tujuan",
        //     "nomorreferensi" => "$nomorreferensi",
        //     "method" => "Bridging",
        //     "kode_kunjungan" => "",
        //     "nomorsep" => "",
        //     "user" => auth()->user()->nama
        // ];
        // if ($request->kodepolitujuan != 'HDL') {
        //     $antrian = $mw->ambilantrean($data_antrian);
        //     $kodebooking = 0;
        //     if (isset($antrian->metadata->code)) {
        //         $status_a = $antrian->metadata->code;
        //         if ($status_a == 200) {
        //             $time = Carbon::now();
        //             $timestamp = $time->timestamp * 1000;
        //             $kodebooking = $antrian->response->kodebooking;
        //             $taskid = [
        //                 "kodebooking" => "$kodebooking",
        //                 "taskid" => "3",
        //                 "waktu" => $timestamp
        //             ];
        //             $taskid_r = $mw->update_antrian($taskid);
        //         }
        //     }
        // }
        //END OF AMBIL ANTRIAN
        $dt = Carbon::now();
        $v = new VclaimModel();
        $nomorrujukan = trim($request->nomorrujukan);
        // kamarranap
        // bedranap
        // $d = $this->createLayanandetail();
        // dd($d);
        //cek sudah daftar belum
        //cek_kronis
        //cek pasien aktif
        $cekrujukan = $v->carirujukan_byno($request->nomorrujukan);
        if ($cekrujukan->metaData->code == 201) {
            $cekrujukan = $v->carirujukan_byno_rs($request->nomorrujukan);
        }
        if ($cekrujukan->metaData->code == 201) {
            $ceksurkon = $v->carisuratkontrol($request->suratkontrol);
            if ($ceksurkon->response->sep->noSep == $request->nomorrujukan) {
            } else {
                $data = [
                    'kode' => 500,
                    'message' => 'Rujukan dan Surat Kontrol tidak sesuai !'
                ];
                echo json_encode($data);
                die;
            }
        }
        $cek_kunjungan_aktif = DB::select('select * from ts_kunjungan where no_rm = ? AND status_kunjungan = ?', [$request->norm, '1']);
        if ($request->jenispelayanan == 2) {
            $paramedis = Dokter::where('kode_dpjp', '=', "$request->kodedokterlayan")->get();
            $cek_paramedis = count($paramedis);
            if ($request->kodedokterlayan == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Dokter belum dipilih !'
                ];
                echo json_encode($data);
                die;
            } else if ($request->kodepolitujuan == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Poli belum dipilih !'
                ];
                echo json_encode($data);
                die;
            } else if ($cek_paramedis == 0) {
                $data = [
                    'kode' => 500,
                    'message' => 'Data paramedis belum update,silahkan hubungi IT'
                ];
                echo json_encode($data);
                die;
            }
            // else if (count($cek_kunjungan_aktif) > 0)
            // {
            //     $data = [
            //         'kode' => 500,
            //         'message' => 'status kunjungan pasien masih aktif ! Sudah didaftarkan'
            //     ];
            //     echo json_encode($data);
            //     die;
            // }
        }
        $tgl_masuk = $request->tglsep;
        $time = $dt->toTimeString();
        $tgl_masuk_time = $request->tglsep . ' ' . $time;
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [$request->norm]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] + 1;
        }
        //end of get counter
        //mapping penjamin bpjs dan db simrs
        $mt_penjamin = DB::select('select * from mt_penjamin_bpjs where nama_penjamin_bpjs = ?', [$request->penjamin]);
        //end
        // dd($mt_penjamin);
        //jenis pelayanan
        if ($request->jenispelayanan == 1) {
            //jika pasien rawat inap
            //data yang akan disimpan ke ts kunjungan
            $paramedis = Dokter::where('kode_dpjp', '=', "$request->kodedpjp")->get();
            $unit = mt_unit::where('kode_unit', '=', "$request->namaunitranap")->get();
            $mt_ruangan = DB::select('select * from mt_ruangan where kode_unit = ?  and nama_kamar = ? and no_bed = ?', [$request->namaunitranap, $request->kamarranap, $request->bedranap]);
            $idruangan = $mt_ruangan[0]->id_ruangan;
            $crad = 1;
            if ($request->naikkelas == '') {
                $crad = 0;
            }
            $data_ts_kunjungan = [
                'counter' => $counter,
                'no_rm' => $request->norm,
                'kode_unit' => $request->namaunitranap,
                'kode_paramedis' => $paramedis[0]['kode_dokter'],
                'prefix_kunjungan' => $unit[0]['prefix_unit'],
                'tgl_masuk' => $tgl_masuk_time,
                'status_kunjungan' => '8',
                'kode_penjamin' => $mt_penjamin[0]->kode_penjamin_simrs,
                'id_alasan_masuk' => $request->alasanmasuk,
                'id_ruangan' => $idruangan,
                'kamar' => $request->kamarranap,
                'no_bed' => $request->bedranap,
                'kelas' => $request->hakkelas,
                'hak_kelas' => $request->hakkelas,
                'crad' => $crad,
                'diagx' => $request->kodediagnosa . ' | ' . $request->namadiagnosa,
                'pic' => auth()->user()->id_simrs,
                'no_sep' => '',
            ];
            $kodeunit = $request->namaunitranap;
            $kelas_unit = $unit['0']['kelas_unit'];
        } else {
            //jika pasien rawat jalan
            //data yang akan disimpan ke ts kunjungan
            $paramedis = Dokter::where('kode_dpjp', '=', "$request->kodedokterlayan")->get();
            $unit = mt_unit::where('KDPOLI', '=', "$request->kodepolitujuan")->get();
            if ($request->kodepolitujuan == "HIV") {
                $unit = mt_unit::where('kode_unit', '=', "1016")->get();
            }
            $data_ts_kunjungan = array(
                'counter' => $counter,
                'no_rm' => $request->norm,
                'kode_unit' => $unit[0]['kode_unit'],
                'kode_paramedis' => $paramedis[0]['kode_dokter'],
                'prefix_kunjungan' => $unit[0]['prefix_unit'],
                'tgl_masuk' => $tgl_masuk_time,
                'status_kunjungan' => '8',
                'kode_penjamin' => $mt_penjamin[0]->kode_penjamin_simrs,
                'kelas' => 3,
                'hak_kelas' => 3,
                'pic' => auth()->user()->id_simrs,
                'diagx' => $request->kodediagnosa . ' | ' . $request->namadiagnosa,
                'no_sep' => '',
                'no_rujukan' => $request->nomorrujukan,
                'id_alasan_masuk' => $request->alasanmasuk
            );
            $kodeunit = $unit[0]['kode_unit'];
            $kelas_unit = $unit['0']['kelas_unit'];
            // $tgl_masuk = date('Y-m-d');
            if ($kodeunit != '1002') {
                //jika pasien rawat jalan dan bukan igd maka dilakukan cek kronis
                $r = DB::select("CALL sp_cari_riwayat_kronis_terakhir('$request->norm','$kodeunit','$tgl_masuk')");
                if (count($r) > 0) {
                    if ($r[0]->status_daftar == 'Tidak boleh daftar') {
                        $data = [
                            'kode' => 500,
                            'message' => 'Pasien Kronis'
                        ];
                        echo json_encode($data);
                        die;
                    }
                }
            }
        }
        //insert ke ts_kunjungan
        $ts_kunjungan = ts_kunjungan::create($data_ts_kunjungan);
        //membuat kode layanan header menggunakan store procedure
        if ($kelas_unit == 1 || $kelas_unit == 2) {
            //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
            $r = DB::select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            $data_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $tgl_masuk_time,
                'kode_kunjungan' => $ts_kunjungan->id,
                'kode_unit' => $ts_kunjungan['kode_unit'],
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id_simrs,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN'
            ]; //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
            //menentukan tarif
            if ($request->jenispelayanan == 1) {
                //jika pasien rawat inap maka hanya memakai tarif admin ranap
                $tarif = $unit[0]->mt_tarif_detail3->TOTAL_TARIF_CURRENT;
                $id_detail = $this->createLayanandetail();
                $tgl_detail = date('Y-m-d h:i:s');
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_adm'],
                    'total_tarif' => $tarif,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif,
                    'grantotal_layanan' => $tarif,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_masuk_time,
                    'tagihan_penjamin' => $tarif,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
                $grand_total_tarif = $tarif;
            } else {
                //jika pasien rawat jalan
                $tarif1 = $unit[0]->mt_tarif_detail->TOTAL_TARIF_CURRENT;
                $tarif2 = $unit[0]->mt_tarif_detail2->TOTAL_TARIF_CURRENT;
                $tgl_detail = $tgl_masuk_time;
                $id_detail1 = $this->createLayanandetail();
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail1,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_adm'],
                    'total_tarif' => $tarif1,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif1,
                    'grantotal_layanan' => $tarif1,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_detail,
                    'tagihan_penjamin' => $tarif1,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
                $id_detail2 = $this->createLayanandetail();
                $save_detail2 = [
                    'id_layanan_detail' => $id_detail2,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_karcis'],
                    'total_tarif' => $tarif2,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif2,
                    'grantotal_layanan' => $tarif2,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_detail,
                    'tagihan_penjamin' => $tarif2,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                ts_layanan_detail::create($save_detail2);
                $grand_total_tarif = $tarif1 + $tarif2;
            }
        }

        //create sep  bridging bpjs
        $keterangansuplesi = 1;
        $katarak = 1;
        $cob = 1;
        $polieksekutif = 1;
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->katarak == '') {
            $katarak = 0;
        }
        if ($request->cob == '') {
            $cob = 0;
        }
        if ($request->polieksekutif == '') {
            $polieksekutif = 0;
        }
        $poli = $request->kodepolitujuan;
        if ($request->jenispelayanan == 1) {
            $poli = '';
        }
        $get_sep = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "$request->nomorkartu",
                    "tglSep" => "$request->tglsep",
                    "ppkPelayanan" => "1018R001",
                    "jnsPelayanan" => "$request->jenispelayanan",
                    "klsRawat" => [
                        "klsRawatHak" => "$request->hakkelas",
                        "klsRawatNaik" => "$request->kelasrawatnaik",
                        "pembiayaan" => "$request->pembiayaan",
                        "penanggungJawab" => "$request->penanggugjawab"
                    ],
                    "noMR" => "$request->norm",
                    "rujukan" => [
                        "asalRujukan" => "$request->asalrujukan",
                        "tglRujukan" => "$request->tglrujukan",
                        "noRujukan" => "$nomorrujukan",
                        "ppkRujukan" => "$request->kodeppkrujukan"
                    ],
                    "catatan" => "$request->catatan",
                    "diagAwal" => "$request->kodediagnosa",
                    "poli" => [
                        "tujuan" => "$poli",
                        "eksekutif" => "$polieksekutif"
                    ],
                    "cob" => [
                        "cob" => "$cob"
                    ],
                    "katarak" => [
                        "katarak" => "$katarak"
                    ],
                    "jaminan" => [
                        "lakaLantas" => "$request->keterangan_kll",
                        "noLP" => "$request->nomorlp",
                        "penjamin" => [
                            "tglKejadian" => "$request->tglkejadianlaka",
                            "keterangan" => "$request->keteranganlaka",
                            "suplesi" => [
                                "suplesi" => "$keterangansuplesi",
                                "noSepSuplesi" => "$request->sepsuplesi",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "$request->provinsikejadian",
                                    "kdKabupaten" => "$request->kabupatenkejadian",
                                    "kdKecamatan" => "$request->kecamatankejadian"
                                ]
                            ]
                        ]
                    ],
                    "tujuanKunj" => "$request->tujuankunjungan",
                    "flagProcedure" => "$request->flagprocedure",
                    "kdPenunjang" => "$request->penunjang",
                    "assesmentPel" => "$request->asessment",
                    "skdp" => [
                        "noSurat" => "$request->suratkontrol",
                        "kodeDPJP" => "$request->kodedpjp"
                    ],
                    "dpjpLayan" => "$request->kodedokterlayan",
                    "noTelp" => "$request->nomortelepon",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $datasep = $v->insertsep2($get_sep);
        if ($datasep == 'RTO') {
            DB::table('ts_kunjungan')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
            if ($kelas_unit == 1 || $kelas_unit == 2) {
                //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                DB::table('ts_layanan_header')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                DB::table('ts_layanan_detail')->where('row_id_header', $ts_layanan_header->id)->delete();
            }
            //batal antrian
            // if ($request->kodepolitujuan != 'HDL') {
            //     if (isset($antrian->metadata->code)) {
            //         $status_a = $antrian->metadata->code;
            //         if ($status_a == 200) {
            //             $kodebooking = $antrian->response->kodebooking;
            //             $batal = [
            //                 "kodebooking" => "$kodebooking",
            //                 "keterangan" => "system error"
            //             ];
            //             $mw->batalantrian($batal);
            //         }
            //     }
            // }
            //end of batal antrian
            $data = [
                'kode' => 500,
                'message' => 'The Network connection lost, please try again ...'
            ];
            echo json_encode($data);
        } else if ($datasep->metaData->code == 200) {
            ts_kunjungan::whereRaw('kode_kunjungan = ? and no_rm = ? and kode_unit = ?', array($ts_kunjungan->id, $request->norm, $kodeunit))->update([
                'status_kunjungan' => 1, 'no_sep' => $datasep->response->sep->noSep
            ]);
            if ($kelas_unit == 1 || $kelas_unit == 2) {
                //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                if ($request->jenispelayanan == 1) {
                    DB::table('mt_ruangan')->where('id_ruangan', $idruangan)->update(['status_incharge' => 1]);
                }
                //update ts_layanan_header
                ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                    ->update(['status_layanan' => 2, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            //update mt_ruangan
            //insert ts_sep
            $sep = $datasep->response->sep;
            if ($request->keterangan_kll == '0') {
                $CATKLL = "";
            } else if ($request->keterangan_kll == '1') {
                $CATKLL = "KLL dan bukan kecelakaan Kerja [BKK]";
            } else if ($request->keterangan_kll == '2') {
                $CATKLL = "KLL dan kecelakaan Kerja [KK]";
            } else if ($request->keterangan_kll == '3') {
                $CATKLL = "Kecelakaan Kerja [KK]";
            }
            $jk = $sep->peserta->kelamin;
            if ($jk == 'Laki-Laki') {
                $jk = 'L';
            } else {
                $jk = 'P';
            }
            $data_ts_sep = [
                'no_SEP' => $sep->noSep,
                'tgl_SEP' => $sep->tglSep,
                'no_kartu' => $sep->peserta->noKartu,
                'nama_peserta' => $sep->peserta->nama,
                'tgl_lahir' => $sep->peserta->tglLahir,
                'jenis_kelamin' => $jk,
                'poli_tujuan' => $kodeunit . ' |' . $sep->poli,
                'asal_faskes' => $request->kodeppkrujukan,
                'nama_asal_faskes' => $request->namappkrujukan,
                'diagnosa_awal' => $sep->diagnosa,
                'peserta' => $sep->peserta->jnsPeserta,
                'cob' => $request->cob,
                'jenis_rawat' => $sep->jnsPelayanan,
                'kls_rawat' => $sep->peserta->hakKelas,
                'no_rm' => $request->norm,
                'catatan' => $sep->catatan . "  " . $CATKLL,
                'act' => 1,
                'alasan_masuk' => '',
                'no_tlp' => $request->nomortelepon,
                'kode_kunjungan' => "$ts_kunjungan->id",
                'tgl_rujukan' => $request->tglrujukan,
                'no_skdp' => "",
                'dpjp' => $request->kodedokterlayan . ' | ' . $request->namadokterlayan,
                'no_rujukan' => $request->nomorrujukan,
                'katarak' => $request->katarak,
                'tgl_kll' => $request->tglkejadianlaka,
                'prop_kll' => $request->provinsikejadian,
                'kab_kll' => $request->kabupatenkejadian,
                'kec_kll' => $request->kecamatankejadian,
                'ket_kll' => $request->keteranganlaka,
                'pic1' => auth()->user()->id_simrs,
                'tingkat_faskes' => $request->asalrujukan,
            ];
            $ts_sep = ts_sep::create($data_ts_sep);
            //insert tracer
            $data_tracer = [
                'kode_kunjungan' => $ts_kunjungan->id,
                'tgl_tracer' => $tgl_masuk,
                'id_status_tracer' => 1,
                'cek_tracer' => 'N'
            ];
            //insert ke tracer
            tracer::create($data_tracer);
            //update antrian marwan
            // if ($request->kodepolitujuan != 'HDL') {
            //     if (isset($antrian->metadata->code)) {
            //         $status_a = $antrian->metadata->code;
            //         if ($status_a == 200) {
            //             $kodebooking = $antrian->response->kodebooking;
            //             jkn_antrian::where('kodebooking', $kodebooking)
            //                 ->update(['nomorsep' => $sep->noSep, 'kode_kunjungan' => $ts_kunjungan->id]);
            //         }
            //     }
            // }
            //end of update antrian
            $pasien = Pasien::where('no_rm', '=', "$request->norm")->get();
            $data = [
                'kode' => 200,
                'message' => 'sukses',
                'kode_kunjungan' => $ts_kunjungan->id,
                'nama' => $pasien[0]['nama_px']
            ];
            echo json_encode($data);
        } else if ($datasep->metaData->code != 200) {
            DB::table('ts_kunjungan')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
            if ($kelas_unit == 1 || $kelas_unit == 2) {
                //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                DB::table('ts_layanan_header')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                DB::table('ts_layanan_detail')->where('row_id_header', $ts_layanan_header->id)->delete();
            }
            //batal antrian
        //     if($request->kodepolitujuan != 'HDL'){
        //     if (isset($antrian->metadata->code)) {
        //         $status_a = $antrian->metadata->code;
        //         if ($status_a == 200) {
        //             $kodebooking = $antrian->response->kodebooking;
        //             $batal = [
        //                 "kodebooking" => "$kodebooking",
        //                 "keterangan" => "system error"
        //             ];
        //             $mw->batalantrian($batal);
        //         }
        //     }
        // }
            //end of batal antrian
            $data = [
                'kode' => 201,
                'message' => $datasep->metaData->message
            ];
            echo json_encode($data);
        }
    }
    public function Simpansepranap(Request $request)
    {
        //create sep  bridging bpjs
        $keterangansuplesi = 1;
        $katarak = 1;
        $cob = 1;
        $polieksekutif = 1;
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->katarak == '') {
            $katarak = 0;
        }
        if ($request->cob == '') {
            $cob = 0;
        }
        $get_sep = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "$request->nomorkartu",
                    "tglSep" => "$request->tglsep",
                    "ppkPelayanan" => "1018R001",
                    "jnsPelayanan" => "$request->jenispelayanan",
                    "klsRawat" => [
                        "klsRawatHak" => "$request->hakkelas",
                        "klsRawatNaik" => "$request->kelasrawatnaik",
                        "pembiayaan" => "$request->pembiayaan",
                        "penanggungJawab" => "$request->penanggugjawab"
                    ],
                    "noMR" => "$request->norm",
                    "rujukan" => [
                        "asalRujukan" => "$request->asalrujukan",
                        "tglRujukan" => "$request->tglrujukan",
                        "noRujukan" => "$request->nomorrujukan",
                        "ppkRujukan" => "$request->kodeppkrujukan"
                    ],
                    "catatan" => "$request->catatan",
                    "diagAwal" => "$request->kodediagnosa",
                    "poli" => [
                        "tujuan" => "",
                        "eksekutif" => "0"
                    ],
                    "cob" => [
                        "cob" => "$cob"
                    ],
                    "katarak" => [
                        "katarak" => "$katarak"
                    ],
                    "jaminan" => [
                        "lakaLantas" => "$request->keterangan_kll",
                        "noLP" => "$request->nomorlp",
                        "penjamin" => [
                            "tglKejadian" => "$request->tglkejadianlaka",
                            "keterangan" => "$request->keteranganlaka",
                            "suplesi" => [
                                "suplesi" => "$keterangansuplesi",
                                "noSepSuplesi" => "$request->sepsuplesi",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "$request->provinsikejadian",
                                    "kdKabupaten" => "$request->kabupatenkejadian",
                                    "kdKecamatan" => "$request->kecamatankejadian"
                                ]
                            ]
                        ]
                    ],
                    "tujuanKunj" => "$request->tujuankunjungan",
                    "flagProcedure" => "$request->flagprocedure",
                    "kdPenunjang" => "$request->penunjang",
                    "assesmentPel" => "$request->asessment",
                    "skdp" => [
                        "noSurat" => "$request->suratkontrol",
                        "kodeDPJP" => "$request->kodedpjp"
                    ],
                    "dpjpLayan" => "",
                    "noTelp" => "$request->nomortelepon",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $v = new VclaimModel();
        $datasep = $v->insertsep2($get_sep);
        if ($datasep == 'RTO') {
            $data = [
                'kode' => 500,
                'message' => 'The Network connection lost, please try again ...'
            ];
            echo json_encode($data);
        } else if ($datasep->metaData->code == 200) {
            //update ts_kunjungan
            $sep = $datasep->response->sep;
            ts_kunjungan::where('kode_kunjungan', $request->kode_kunjungan)
                ->update(['no_sep' => $sep->noSep]);
            //insert ts_sep
            if ($request->keterangan_kll == '0') {
                $CATKLL = "";
            } else if ($request->keterangan_kll == '1') {
                $CATKLL = "KLL dan bukan kecelakaan Kerja [BKK]";
            } else if ($request->keterangan_kll == '2') {
                $CATKLL = "KLL dan kecelakaan Kerja [KK]";
            } else if ($request->keterangan_kll == '3') {
                $CATKLL = "Kecelakaan Kerja [KK]";
            }
            $jk = $sep->peserta->kelamin;
            if ($jk == 'Laki-Laki') {
                $jk = 'L';
            } else {
                $jk = 'P';
            }
            $data_ts_sep = [
                'no_SEP' => $sep->noSep,
                'tgl_SEP' => $sep->tglSep,
                'no_kartu' => $sep->peserta->noKartu,
                'nama_peserta' => $sep->peserta->nama,
                'tgl_lahir' => $sep->peserta->tglLahir,
                'jenis_kelamin' => $jk,
                'asal_faskes' => $request->kodeppkrujukan,
                'nama_asal_faskes' => $request->namappkrujukan,
                'diagnosa_awal' => $sep->diagnosa,
                'peserta' => $sep->peserta->jnsPeserta,
                'cob' => $request->cob,
                'jenis_rawat' => $sep->jnsPelayanan,
                'kls_rawat' => $sep->peserta->hakKelas,
                'no_rm' => $request->norm,
                'catatan' => $sep->catatan . "  " . $CATKLL,
                'act' => 1,
                'alasan_masuk' => '',
                'no_tlp' => $request->nomortelepon,
                'kode_kunjungan' => "$request->kode_kunjungan",
                'tgl_rujukan' => $request->tglrujukan,
                'no_skdp' => "",
                'dpjp' => $request->kodedpjp . ' | ' . $request->namadpjp,
                'no_rujukan' => $request->nomorrujukan,
                'katarak' => $request->katarak,
                'tgl_kll' => $request->tglkejadianlaka,
                'prop_kll' => $request->provinsikejadian,
                'kab_kll' => $request->kabupatenkejadian,
                'kec_kll' => $request->kecamatankejadian,
                'ket_kll' => $request->keteranganlaka,
                'pic1' => auth()->user()->id_simrs,
                'tingkat_faskes' => $request->asalrujukan,
            ];
            $ts_sep = ts_sep::create($data_ts_sep);
            $data = [
                'kode' => 200,
                'message' => 'sukses',
                'kode_kunjungan' => $request->kode_kunjungan,
            ];
            echo json_encode($data);
        } else if ($datasep->metaData->code != 200) {
            $data = [
                'kode' => 201,
                'message' => $datasep->metaData->message
            ];
            echo json_encode($data);
        }
    }
    public function daftarpasien_umum(Request $request)
    {
        //cek counter
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [
            $request->nomorrm,
        ]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] + 1;
        }
        $tgl_masuk_time = $request->tglmasuk . ' ' . date('h:i:s');
        if ($request->jenispelayanan == 2) {
            //jika rawat jalan
            $unit = mt_unit::where('kode_unit', '=', "$request->kodepolitujuan")->get();
            // $mt_penjamin = DB::select('select * from mt_penjamin_bpjs where kode_penjamin_simrs = ?', [$request->penjamin]);
            $data_ts_kunjungan = array(
                'counter' => $counter,
                'no_rm' => $request->nomorrm,
                'kode_unit' => $request->kodepolitujuan,
                'kode_paramedis' => 0,
                'prefix_kunjungan' => $unit[0]['prefix_unit'],
                'tgl_masuk' => $tgl_masuk_time,
                'status_kunjungan' => '8',
                'kode_penjamin' => $request->penjamin,
                'kelas' => 3,
                'hak_kelas' => 3,
                'pic' => auth()->user()->id_simrs,
                'no_sep' => '',
                'id_alasan_masuk' => $request->alasanmasuk
            );
            // if ($request->kodepolitujuan != '1002') {
            //     //jika pasien rawat jalan dan bukan igd maka dilakukan cek kronis
            //     $r = DB::select("CALL sp_cari_riwayat_kronis_terakhir('$request->nomorrm','$request->kodepolitujuan','$request->tgl_masuk')");
            //     if (count($r) > 0) {
            //         if ($r[0]->status_daftar == 'Tidak boleh daftar') {
            //             $data = [
            //                 'kode' => 500,
            //                 'message' => 'Pasien Kronis'
            //             ];
            //             echo json_encode($data);
            //             die;
            //         }
            //     }
            // }
        } else {
            // kelasranap
            // unitranap
            // namaruanganranap
            // kodebedranap
            $unit = mt_unit::where('kode_unit', '=', "$request->unitranap")->get();
            // $mt_penjamin = DB::select('select * from mt_penjamin_bpjs where kode_penjamin_simrs = ?', [$request->penjamin]);
            // dd($request->koderef);
            $data_ts_kunjungan = array(
                'counter' => $counter,
                'no_rm' => $request->nomorrm,
                'kode_unit' => $request->unitranap,
                'id_ruangan' => $request->idruangan,
                'kamar' => $request->namaruanganranap,
                'no_bed' => $request->kodebedranap,
                'kode_paramedis' => 0,
                'prefix_kunjungan' => $unit[0]['prefix_unit'],
                'tgl_masuk' => $tgl_masuk_time,
                'status_kunjungan' => '8',
                'ref_kunjungan' => $request->koderef,
                'kode_penjamin' => $request->penjamin,
                'kelas' => $request->kelasranap,
                'hak_kelas' => $request->kelasranap,
                'pic' => auth()->user()->id_simrs,
                'no_sep' => '',
                'id_alasan_masuk' => $request->alasanmasuk
            );
        }
        $ts_kunjungan = ts_kunjungan::create($data_ts_kunjungan);
        $kelas_unit = $unit['0']['kelas_unit'];
        if ($request->jenispelayanan == 2) {
            $kodeunit = $request->kodepolitujuan;
            //jika rajal
        } else {
            $kodeunit = $request->unitranap;
            //jika ranap
        }
        //membuat kode layanan header menggunakan store procedure
        if ($kelas_unit == 1 || $kelas_unit == 2) {
            //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
            $r = DB::select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            if ($request->penjamin == "P01") {
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $tgl_masuk_time,
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'kode_unit' => $ts_kunjungan['kode_unit'],
                    'kode_tipe_transaksi' => 1,
                    'pic' => auth()->user()->id_simrs,
                    'status_layanan' => '1',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                //data yg diinsert ke ts_layanan_header
            } else {
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $tgl_masuk_time,
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'kode_unit' => $ts_kunjungan['kode_unit'],
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id_simrs,
                    'status_layanan' => '1',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                //data yg diinsert ke ts_layanan_header
            }
            //simpan ke layanan header
            $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
            //menentukan tarif
            if ($request->jenispelayanan == 1) {
                //jika pasien rawat inap maka hanya memakai tarif admin ranap
                $tarif = $unit[0]->mt_tarif_detail3->TOTAL_TARIF_CURRENT;
                $id_detail = $this->createLayanandetail();
                $tgl_detail = date('Y-m-d h:i:s');
                $tagihanpribadi = $tarif;
                $tagihanpenjamin = $tarif;
                if ($request->penjamin == "P01") {
                    $tagihanpribadi = $tarif;
                    $tagihanpenjamin = (NULL);
                } else {
                    $tagihanpribadi = (NULL);
                    $tagihanpenjamin = $tarif;
                }
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_adm'],
                    'total_tarif' => $tarif,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif,
                    'grantotal_layanan' => $tarif,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_masuk_time,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
                $grand_total_tarif = $tarif;
            } else {
                //jika pasien rawat jalan
                $tarif1 = $unit[0]->mt_tarif_detail->TOTAL_TARIF_CURRENT;
                $tarif2 = $unit[0]->mt_tarif_detail2->TOTAL_TARIF_CURRENT;
                $tagihanpribadi1 = $tarif1;
                $tagihanpenjamin1 = $tarif1;
                $tagihanpribadi2 = $tarif2;
                $tagihanpenjamin2 = $tarif2;
                if ($request->penjamin == "P01") {
                    $tagihanpribadi1 = $tarif1;
                    $tagihanpenjamin1 = '0';
                    $tagihanpribadi2 = $tarif2;
                    $tagihanpenjamin2 = '0';
                } else {
                    $tagihanpribadi1 = '0';
                    $tagihanpenjamin1 = $tarif1;
                    $tagihanpribadi2 = '0';
                    $tagihanpenjamin2 = $tarif2;
                }
                $tgl_detail = $tgl_masuk_time;
                $id_detail1 = $this->createLayanandetail();
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail1,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_adm'],
                    'total_tarif' => $tarif1,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif1,
                    'grantotal_layanan' => $tarif1,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_detail,
                    'tagihan_pribadi' => $tagihanpribadi1,
                    'tagihan_penjamin' => $tagihanpenjamin1,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
                $id_detail2 = $this->createLayanandetail();
                $save_detail2 = [
                    'id_layanan_detail' => $id_detail2,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_karcis'],
                    'total_tarif' => $tarif2,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif2,
                    'grantotal_layanan' => $tarif2,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_detail,
                    'tagihan_pribadi' => $tagihanpribadi2,
                    'tagihan_penjamin' => $tagihanpenjamin2,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                ts_layanan_detail::create($save_detail2);
                $grand_total_tarif = $tarif1 + $tarif2;
            }
        }
        ts_kunjungan::whereRaw('kode_kunjungan = ? and no_rm = ? and kode_unit = ?', array($ts_kunjungan->id, $request->nomorrm, $kodeunit))->update([
            'status_kunjungan' => 1
        ]);
        if ($kelas_unit == 1 || $kelas_unit == 2) {
            //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
            if ($request->jenispelayanan == 1) {
                DB::table('mt_ruangan')->where('id_ruangan', $request->idruangan)->update(['status_incharge' => 1]);
            }
            //update ts_layanan_header
            ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
        }
        $data_tracer = [
            'kode_kunjungan' => $ts_kunjungan->id,
            'tgl_tracer' => $request->tglmasuk,
            'id_status_tracer' => 1,
            'cek_tracer' => 'N'
        ];
        // insert ke tracer
        tracer::create($data_tracer);
        $data = [
            'kode' => 200,
            'message' => 'sukses',
            'kode_kunjungan' => $ts_kunjungan->id,
        ];
        echo json_encode($data);
    }
    public function daftarpasien_ranap(Request $request)
    {
        $rm = $request->nomorrm_ranap;
        $nik = $request->nik_ranap;
        $noka = $request->bpjs_ranap;
        $namapasien = $request->namapasien_ranap;
        $jenispelayanan = $request->jenispelayanan_ranap;
        $statusbridging = $request->pakebridgingga;
        $penjamin = $request->penjamin_ranap;
        $kelas_ranap = $request->kelasranap;
        $unitranap = $request->unitranap;
        $ruangranap = $request->namaruanganranap;
        $bedranap = $request->kodebedranap;
        $idruangan_ranap = $request->idruangan;
        $unitref_ranap = $request->unitref;
        $dokter_ref = $request->dokterref;
        $kodedokter_ref = $request->kodedokter_ref;
        $kodeunit_ref = $request->kodeunit_ref;
        $kodekunjungan_ref = $request->kodekunjunganref;
        $tgl_masuk = $request->tglmasukranap;
        $hakkelasbpjs = $request->hakkelasbpjs;
        $naik_kelas = $request->naikkelas;
        $pembiayaan = $request->pembiayaan;
        $penanggungjwb = $request->penanggugjawab;
        $nomorspri = $request->nomorspri;
        $tglspri = $request->tglspri;
        $dpjp = $request->dpjp;
        $kode_dpjp = $request->kodedpjp;
        $diagnosa = $request->diagnosaranap;
        $kodediagnosa_ranap = $request->kodediagnosaranap;
        $catatan = $request->catatan;
        $keterangankll = $request->keterangan_kll;
        $alasanmasuk = $request->alasanmasuk;
        $notelp_ranap = $request->notelp_ranap;
        $keterangansuplesi = $request->keterangansuplesi;
        $suplesi = $request->sepsuplesi;
        $tgllaka = $request->tglkejadianlaka;
        $laporanpolisi = $request->nomorlp;
        $provlaka = $request->provinsikejadian;
        $kablaka = $request->kabupatenkejadian;
        $keclaka = $request->kecamatankejadian;
        $ketlaka = $request->keteranganlaka;
        if ($penjamin == '') {
            $data = [
                'kode' => 201,
                'message' => 'Data penjamin belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($hakkelasbpjs == '') {
            $data = [
                'kode' => 201,
                'message' => 'Hak kelas belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($kelas_ranap == '') {
            $data = [
                'kode' => 201,
                'message' => 'Kelas Perawatan belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($unitranap == '') {
            $data = [
                'kode' => 201,
                'message' => 'Unit ruangan belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($idruangan_ranap == '') {
            $data = [
                'kode' => 201,
                'message' => 'ruangan belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($bedranap == '') {
            $data = [
                'kode' => 201,
                'message' => 'Bed belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if ($kodekunjungan_ref == '') {
            $data = [
                'kode' => 201,
                'message' => 'Refernsi Kunjungan rawat jalan tidak boleh kosong !'
            ];
            echo json_encode($data);
            die;
        }
        //ambilcounter
        $cek_rm = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [
            $kodekunjungan_ref,
        ]);
        $counter = $cek_rm[0]->counter;
        $penjamin_lama = $cek_rm[0]->kode_penjamin;
        $tgl_masuk_time = $tgl_masuk . ' ' . date('h:i:s');
        $unit = mt_unit::where('kode_unit', '=', "$unitranap")->get();
        // $mt_penjamin = DB::select('select * from mt_penjamin_bpjs where kode_penjamin_simrs = ?', [$request->penjamin]);
        // dd($request->koderef);
        $data_ts_kunjungan = array(
            'counter' => $counter,
            'no_rm' => $rm,
            'kode_unit' => $unitranap,
            'id_ruangan' => $idruangan_ranap,
            'kamar' => $ruangranap,
            'no_bed' => $bedranap,
            'kode_paramedis' => 0,
            'prefix_kunjungan' => $unit[0]['prefix_unit'],
            'tgl_masuk' => $tgl_masuk_time,
            'status_kunjungan' => '8',
            'ref_kunjungan' => $kodekunjungan_ref,
            'ref_paramedis' => $kodedokter_ref,
            'ref_unit' => $kodeunit_ref,
            'kode_penjamin' => $penjamin,
            'kelas' => $kelas_ranap,
            'hak_kelas' => $hakkelasbpjs,
            'pic' => auth()->user()->id_simrs,
            'no_sep' => '',
            'id_alasan_masuk' => $alasanmasuk
        );
        $ts_kunjungan = ts_kunjungan::create($data_ts_kunjungan);
        $kelas_unit = $unit['0']['kelas_unit'];
        // $kodeunit = $request->unitranap;
        //membuat kode layanan header menggunakan store procedure
        if ($kelas_unit == 1 || $kelas_unit == 2) {
            //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
            $r = DB::select("CALL GET_NOMOR_LAYANAN_HEADER('$unitranap')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $unitranap]);
            }
            if ($penjamin == "P01") {
                dd($penjamin);
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $tgl_masuk_time,
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'kode_unit' => $ts_kunjungan['kode_unit'],
                    'kode_tipe_transaksi' => 1,
                    'pic' => auth()->user()->id_simrs,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                //data yg diinsert ke ts_layanan_header
            } else {
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $tgl_masuk_time,
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'kode_unit' => $ts_kunjungan['kode_unit'],
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id_simrs,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                //data yg diinsert ke ts_layanan_header
            }
            //simpan ke layanan header
            $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
            //menentukan tarif
            //jika pasien rawat inap maka hanya memakai tarif admin ranap
            $tarif = $unit[0]->mt_tarif_detail3->TOTAL_TARIF_CURRENT;
            $id_detail = $this->createLayanandetail();
            $tgl_detail = date('Y-m-d h:i:s');
            $tagihanpribadi = $tarif;
            $tagihanpenjamin = $tarif;
            if ($penjamin == "P01") {
                $tagihanpribadi = $tarif;
                $tagihanpenjamin = '0';
            } else {
                $tagihanpribadi = '0';
                $tagihanpenjamin = $tarif;
            }
            $save_detail1 = [
                'id_layanan_detail' => $id_detail,
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => $unit[0]['kode_tarif_adm'] . $kelas_ranap,
                'total_tarif' => $tarif,
                'jumlah_layanan' => '1',
                'diskon_layanan' => '0',
                'total_layanan' => $tarif,
                'grantotal_layanan' => $tarif,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $tgl_masuk_time,
                'tagihan_pribadi' => $tagihanpribadi,
                'tagihan_penjamin' => $tagihanpenjamin,
                'tgl_layanan_detail_2' => $tgl_detail,
                'row_id_header' => $ts_layanan_header->id
            ];
            $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
            $grand_total_tarif = $tarif;
        }
        if ($naik_kelas == 1) {
            $kelasrawat = $kelas_ranap;
            if ($kelas_ranap == 1) {
                $kelasrawat = 3;
            }
            if ($kelas_ranap == 2) {
                $kelasrawat = 4;
            }
            if ($kelas_ranap == 3) {
                $kelasrawat = 5;
            }
            if ($kelas_ranap == 4) {
                $kelasrawat = 1;
            }
            if ($kelas_ranap == 5) {
                $kelasrawat = 2;
            }
        } else {
            $kelasrawat = "";
        }
        //jika menggunakan bridging
        if ($statusbridging == '1') {
            //jika pakai
            $get_sep = [
                "request" => [
                    "t_sep" => [
                        "noKartu" => "$noka",
                        "tglSep" => "$tgl_masuk",
                        "ppkPelayanan" => "1018R001",
                        "jnsPelayanan" => "1",
                        "klsRawat" => [
                            "klsRawatHak" => "$hakkelasbpjs",
                            "klsRawatNaik" => "$kelasrawat",
                            "pembiayaan" => "$pembiayaan",
                            "penanggungJawab" => "$penanggungjwb"
                        ],
                        "noMR" => "$rm",
                        "rujukan" => [
                            "asalRujukan" => "2",
                            "tglRujukan" => "$tglspri",
                            "noRujukan" => "$nomorspri",
                            "ppkRujukan" => "1018R001"
                        ],
                        "catatan" => "$catatan",
                        "diagAwal" => "$kodediagnosa_ranap",
                        "poli" => [
                            "tujuan" => "",
                            "eksekutif" => ""
                        ],
                        "cob" => [
                            "cob" => "0"
                        ],
                        "katarak" => [
                            "katarak" => "0"
                        ],
                        "jaminan" => [
                            "lakaLantas" => "$keterangankll",
                            "noLP" => "$laporanpolisi",
                            "penjamin" => [
                                "tglKejadian" => "$tgllaka",
                                "keterangan" => "$ketlaka",
                                "suplesi" => [
                                    "suplesi" => "$keterangansuplesi",
                                    "noSepSuplesi" => "$suplesi",
                                    "lokasiLaka" => [
                                        "kdPropinsi" => "$provlaka",
                                        "kdKabupaten" => "$kablaka",
                                        "kdKecamatan" => "$keclaka"
                                    ]
                                ]
                            ]
                        ],
                        "tujuanKunj" => "0",
                        "flagProcedure" => "",
                        "kdPenunjang" => "",
                        "assesmentPel" => "",
                        "skdp" => [
                            "noSurat" => "$nomorspri",
                            "kodeDPJP" => "$kode_dpjp"
                        ],
                        "dpjpLayan" => "",
                        "noTelp" => "$notelp_ranap",
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
            $v = new VclaimModel();
            $datasep = $v->insertsep2($get_sep);
            if ($datasep == 'RTO') {
                DB::table('ts_kunjungan')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                if ($kelas_unit == 1 || $kelas_unit == 2) {
                    //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                    DB::table('ts_layanan_header')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                    DB::table('ts_layanan_detail')->where('row_id_header', $ts_layanan_header->id)->delete();
                }
                $data = [
                    'kode' => 500,
                    'message' => 'The Network connection lost, please try again ...'
                ];
                echo json_encode($data);
            } else if ($datasep->metaData->code == 200) {
                ts_kunjungan::whereRaw('kode_kunjungan = ? and no_rm = ? and kode_unit = ?', array($ts_kunjungan->id, $rm, $unitranap))->update([
                    'status_kunjungan' => 1, 'no_sep' => $datasep->response->sep->noSep
                ]);

                DB::table('mt_ruangan')->where('id_ruangan', $idruangan_ranap)->update(['status_incharge' => 1]);

                //update jika perubahan penjamin
                if ($penjamin_lama != $penjamin && $penjamin != 'P01') {
                    ts_kunjungan::whereRaw('kode_kunjungan = ?', array($kodekunjungan_ref))->update([
                        'kode_penjamin' => $penjamin, 'his_penjamin' => $penjamin_lama
                    ]);
                }

                //update ts_layanan_header
                if ($penjamin == "P01") {
                    ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                        ->update(['status_layanan' => 2, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
                //insert ts_sep
                $sep = $datasep->response->sep;
                if ($keterangankll == '0') {
                    $CATKLL = "";
                } else if ($keterangankll == '1') {
                    $CATKLL = "KLL dan bukan kecelakaan Kerja [BKK]";
                } else if ($keterangankll == '2') {
                    $CATKLL = "KLL dan kecelakaan Kerja [KK]";
                } else if ($keterangankll == '3') {
                    $CATKLL = "Kecelakaan Kerja [KK]";
                }
                $jk = $sep->peserta->kelamin;
                if ($jk == 'Laki-Laki') {
                    $jk = 'L';
                } else {
                    $jk = 'P';
                }
                $data_ts_sep = [
                    'no_SEP' => $sep->noSep,
                    'tgl_SEP' => $sep->tglSep,
                    'no_kartu' => $sep->peserta->noKartu,
                    'nama_peserta' => $sep->peserta->nama,
                    'tgl_lahir' => $sep->peserta->tglLahir,
                    'jenis_kelamin' => $jk,
                    'poli_tujuan' => $unitranap . ' |' . $sep->poli,
                    'asal_faskes' => "1018R001",
                    'nama_asal_faskes' => "Rsud Waled",
                    'diagnosa_awal' => $sep->diagnosa,
                    'peserta' => $sep->peserta->jnsPeserta,
                    'cob' => "",
                    'jenis_rawat' => "Rawat Inap",
                    'kls_rawat' => $sep->peserta->hakKelas,
                    'no_rm' => $rm,
                    'catatan' => $sep->catatan . "  " . $CATKLL,
                    'act' => 1,
                    'alasan_masuk' => '',
                    'no_tlp' => "$notelp_ranap",
                    'kode_kunjungan' => "$ts_kunjungan->id",
                    'tgl_rujukan' => $tglspri,
                    'no_skdp' => "",
                    'dpjp' => '',
                    'no_rujukan' => $nomorspri,
                    'pic1' => auth()->user()->id_simrs,
                    'tingkat_faskes' => $request->asalrujukan,
                ];
                $ts_sep = ts_sep::create($data_ts_sep);
                //insert tracer
                $data_tracer = [
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'tgl_tracer' => $tgl_masuk,
                    'id_status_tracer' => 1,
                    'cek_tracer' => 'N'
                ];
                //insert ke tracer
                // tracer::create($data_tracer);
                $pasien = Pasien::where('no_rm', '=', "$rm")->get();
                $data = [
                    'kode' => 200,
                    'jenis' => 'BPJS',
                    'message' => 'sukses',
                    'kode_kunjungan' => $ts_kunjungan->id,
                    'nama' => $pasien[0]['nama_px']
                ];
                echo json_encode($data);
            } else if ($datasep->metaData->code != 200) {
                DB::table('ts_kunjungan')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                if ($kelas_unit == 1 || $kelas_unit == 2) {
                    //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                    DB::table('ts_layanan_header')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                    DB::table('ts_layanan_detail')->where('row_id_header', $ts_layanan_header->id)->delete();
                }
                $data = [
                    'kode' => 201,
                    'message' => $datasep->metaData->message
                ];
                echo json_encode($data);
            }
        } else {
            //jika tidak
            ts_kunjungan::whereRaw('kode_kunjungan = ? and no_rm = ? and kode_unit = ?', array($ts_kunjungan->id, $rm, $unitranap))->update([
                'status_kunjungan' => 1
            ]);

            //update jika perubahan penjamin
            if ($penjamin_lama != $penjamin && $penjamin != 'P01') {
                ts_kunjungan::whereRaw('kode_kunjungan = ?', array($kodekunjungan_ref))->update([
                    'kode_penjamin' => $penjamin, 'his_penjamin' => $penjamin_lama
                ]);
            }

            DB::table('mt_ruangan')->where('id_ruangan', $idruangan_ranap)->update(['status_incharge' => 1]);
            //update ts_layanan_header
            if ($penjamin == "P01") {
                ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
            } else {
                ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                    ->update(['status_layanan' => 2, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            $pasien = Pasien::where('no_rm', '=', "$rm")->get();
            $data = [
                'kode' => 200,
                'jenis' => 'UMUM',
                'message' => 'sukses',
                'kode_kunjungan' => $ts_kunjungan->id,
                'nama' => $pasien[0]['nama_px']
            ];
            echo json_encode($data);
        }
    }
    public function createLayanandetail()
    {
        $q = DB::select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
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
    public function get_rm()
    {
        $y = DB::select('SELECT MAX(RIGHT(no_rm,6)) AS kd_max FROM mt_pasien');
        if (count($y) > 0) {
            foreach ($y as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('y') . $kd;
    }
    public function datakunjungan()
    {
        $title = 'SIMRS - Riwayat Pendaftaran';
        $sidebar = '3';
        $sidebar_m = '3.2';
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        $alasan_pulang = DB::select("select * FROM mt_alasan_pulang");
        return view('simrs.datakunjungan', [
            'datakunjungan' => $data_kunjungan,
            'alasan' => $alasan_pulang,
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function riwayatpelayanan_user()
    {
        $title = 'SIMRS - Riwayat Pelayanan User';
        $sidebar = '3';
        $sidebar_m = '3.1';
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        $alasan_pulang = DB::select("select * FROM mt_alasan_pulang");
        return view('simrs.riwayatpelayanan_user', [
            'datakunjungan' => $data_kunjungan,
            'alasan' => $alasan_pulang,
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function caririwayatpelayanan_user(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        return view('simrs.caririwayatpelayanan_user', [
            'datakunjungan' => $data_kunjungan
        ]);
    }
    public function caridatakunjungan(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        return view('simrs.caridatakunjungan', [
            'datakunjungan' => $data_kunjungan
        ]);
    }
    public function detailkunjungan(Request $request)
    {
        // $data_kunjungan = DB::select('select * from view_ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $data_kunjungan = DB::select("CALL SP_DETAIL_KUNJUNGAN_PX('$request->kodekunjungan')");
        // dd($data_kunjungan);
        $data_layanan = DB::select('select distinct * from view_ts_layanan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $cek = count($data_layanan);
        if ($cek == 0) {
            $data_layanan = DB::select('select distinct * from view_ts_layanan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        }
        return view('simrs.detailkunjungan', [
            'datakunjungan' => $data_kunjungan,
            'data_layanan' => $data_layanan,
        ]);
    }
    public function batalperiksa(Request $request)
    {
        ts_kunjungan::where('kode_kunjungan', $request->kodekunjungan)->update(['status_kunjungan' => 8, 'pic2' => auth()->user()->id_simrs]);
        ts_layanan_header::where('kode_kunjungan', $request->kodekunjungan)->update(['status_layanan' => 3, 'pic2' => auth()->user()->id_simrs]);
        $ts_kunjungan = ts_kunjungan::where('kode_kunjungan', $request->kodekunjungan)->get();
        $id_ruangan = $ts_kunjungan[0]['id_ruangan'];
        $sep = $ts_kunjungan[0]['no_sep'];
        if ($id_ruangan) {
            DB::table('mt_ruangan')->where('id_ruangan', $id_ruangan)->update(['status_incharge' => 0]);
        }
        if ($sep) {
            DB::table('ts_sep')->where('kode_kunjungan', $request->kodekunjungan)->update(['status' => 8, 'pic2' => auth()->user()->id_simrs]);
            $v = new VclaimModel();
            $data_sep = [
                "request" => [
                    "t_sep" => [
                        "noSep" => $sep,
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
            $delete = $v->hapussep($data_sep);
        }
        $data = [
            'metaData' =>
            [
                'code' => 200,
            ]
        ];
        echo json_encode($data);
    }
    public function updatepulang(Request $request)
    {
        $v = new VclaimModel();
        $status_pulang_simrs = $request->status;
        if ($status_pulang_simrs == 6 || $status_pulang_simrs == 6) {
            $status_pulang_bpjs = 4;
        } else if ($status_pulang_simrs == 9) {
            $status_pulang_bpjs = 3;
        } else if ($status_pulang_simrs == 2) {
            $status_pulang_bpjs = 1;
        } else {
            $status_pulang_bpjs = 5;
        }
        $status_kunjungan = 2;
        $status_layanan = 2;
        if ($status_pulang_simrs == 8) {
            $status_kunjungan = 8;
            $status_layanan = 3;
        }
        ts_kunjungan::where('kode_kunjungan', $request->kodekunjungan)->update(['status_kunjungan' => $status_kunjungan, 'id_alasan_pulang' => $status_pulang_simrs, 'tgl_keluar' => $request->tanggalpulang, 'pic2' => auth()->user()->id_simrs]);
        ts_layanan_header::where('kode_kunjungan', $request->kodekunjungan)->update(['status_layanan' => $status_layanan, 'pic2' => auth()->user()->id_simrs]);
        $sep = DB::select('select * FROM ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $id_ruangan = $sep[0]->id_ruangan;
        if ($id_ruangan) {
            DB::table('mt_ruangan')->where('id_ruangan', $id_ruangan)->update(['status_incharge' => 0]);
        }
        if ($sep[0]->no_sep) {
            $data =   [
                "request" =>  [
                    "t_sep" =>  [
                        "noSep" =>  $sep[0]->no_sep,
                        "statusPulang" => "$status_pulang_bpjs",
                        "noSuratMeninggal" => "$request->suratmeninggal",
                        "tglMeninggal" => "$request->tanggalmeninggal",
                        "tglPulang" => "$request->tanggalpulang",
                        "noLPManual" => "$request->nomorlp",
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
            $pulang = $v->updatetglpulang($data);
            echo json_encode($pulang);
        } else {
            $data = [
                'metaData' => [
                    'code' => '200',
                    'message' => 'OK'
                ]
            ];
            echo json_encode($data);
        }
    }
    function manipulasiTanggal($tgl, $jumlah = 1, $format = 'days')
    {
        $currentDate = $tgl;
        return date('Y-m-d', strtotime($jumlah . ' ' . $format, strtotime($currentDate)));
    }
    public function cetakrujukan($nomorrujukan)
    {
        $v = new VclaimModel();

        $rujukan = $v->detailrujukan_keluar($nomorrujukan);
        $tgl = $rujukan->response->rujukan->tglRujukan;
        $masaberlakurujukan = $this->manipulasiTanggal($tgl, '+3', 'months');
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Cetak Rujukan');
        $pdf->SetMargins('15', '20', '10');
        $pdf->SetFont('Arial', '', 15);
        $pdf->Image('public/img/logobpjs.png', 1, -5, 60, 40);
        $pdf->Image('public/img/logo_rs.png', 240, 4, 35, 25);
        $pdf->SetXY(70, 8);
        $pdf->Cell(10, 7, 'SURAT RUJUKAN', 0, 1);
        $pdf->SetXY(70, 14);
        $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);
        $pdf->SetXY(155, 8);
        $pdf->Cell(10, 7, 'NO.', 0, 1);
        $pdf->SetXY(168, 8);
        $pdf->Cell(10, 7, $rujukan->response->rujukan->noRujukan, 0, 1);
        $pdf->SetXY(70, 14);
        $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);
        $pdf->SetXY(155, 14);
        $pdf->Cell(10, 7, 'Tgl.   ' . $rujukan->response->rujukan->tglRujukan, 0, 1);
        // dd($rujukan);

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, 30);
        $pdf->Cell(10, 7, 'Kepada', 0, 1);
        $pdf->SetXY(40, 30);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, 32);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->namaPpkDirujuk);

        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Mohon Pemeriksaan dan Penanganan Lebih Lanjunt :', 0, 1);

        $pdf->SetXY(150, 40);
        $pdf->Cell(10, 7, "===" . $rujukan->response->rujukan->namaTipeRujukan . "===", 0, 1);
        $pdf->SetXY(150, 44);
        if ($rujukan->response->rujukan->jnsPelayanan == 2) {
            $jns = "rawat jalan";
        } else {
            $jns = "rawat inap";
        }
        $pdf->Cell(10, 7, $jns, 0, 1);

        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Nomor Kartu', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, $y + 2);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->noKartu);

        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Nama Peserta', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, $y + 2);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->nama);


        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Tanggal lahir', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, $y + 2);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->tglLahir);


        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Poli', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, $y + 2);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->namaPoliRujukan);

        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Diagnosa', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, $y + 2);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->namaDiagRujukan);

        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Keterangan', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(45, $y + 2);
        $pdf->MultiCell(80, 4, $rujukan->response->rujukan->catatan);

        $y = $pdf->GetY() + 2;

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Demikian atas bantuannya, diucapkan banyak terima kasih.', 0, 1);

        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, '- Rujukan Berlaku Sampai Dengan ' . $masaberlakurujukan, 0, 1);


        $y = $pdf->GetY();

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, '- Tgl Rencana Berkunjung ' . $rujukan->response->rujukan->tglRencanaKunjungan, 0, 1);

        $y = $pdf->GetY() + 5;

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Tgl Cetak ' . date('y-m-d h:i:s'), 0, 1);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(150, 85);
        $pdf->Cell(10, 7, 'Mengetahui', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Line(150, 100, 190, 100);
        $pdf->Output();

        exit;
    }
    public function Cetaksep($kodekunjungan)
    {
        //ambil data sep
        $sep = ts_sep::where('kode_kunjungan', $kodekunjungan)->get();
        $cek = count($sep);
        if ($cek == 0) {
            $kj = ts_kunjungan::where('kode_kunjungan', $kodekunjungan)->get();
            $sep = $kj['0']['no_sep'];
            $v = new VclaimModel();
            $sep = $v->carisep($sep);
            $peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
            // $cetakan = $sep['0']['cetakan'] + 1;
            // ts_sep::where('kode_kunjungan', $sep)->update(['no_SEP' => $cetakan]);
            $pdf = new Fpdf('L', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetTitle('Cetak SEP');
            $pdf->SetMargins('15', '20', '10');
            $pdf->SetFont('Arial', '', 15);
            $pdf->Image('public/img/logobpjs.png', 1, -5, 60, 40);
            $pdf->Image('public/img/logo_rs.png', 170, 4, 35, 25);
            $pdf->SetXY(70, 8);
            $pdf->Cell(10, 7, 'SURAT ELIGIBILITAS PESERTA', 0, 1);
            $pdf->SetXY(73, 14);
            $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 30);
            $pdf->Cell(10, 7, 'No. SEP', 0, 1);
            $pdf->SetXY(40, 30);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(45, 30);
            $pdf->Cell(10, 7, $sep->response->noSep, 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 35);
            $pdf->Cell(10, 7, 'Tgl. SEP', 0, 1);
            $pdf->SetXY(40, 35);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 35);
            $pdf->Cell(10, 7, $sep->response->tglSep, 0, 1);

            $pdf->SetXY(10, 40);
            $pdf->Cell(10, 7, 'No. Kartu', 0, 1);
            $pdf->SetXY(40, 40);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 40);
            $pdf->Cell(10, 7, $sep->response->peserta->noKartu, 0, 1);

            $pdf->SetXY(100, 35);
            $pdf->Cell(10, 7, 'No. MR', 0, 1);
            $pdf->SetXY(115, 35);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(120, 35);
            $pdf->Cell(10, 7, $sep->response->peserta->noMr, 0, 1);

            $pdf->SetXY(100, 40);
            $pdf->Cell(10, 7, 'Kelamin', 0, 1);
            $pdf->SetXY(115, 40);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(120, 40);
            $pdf->Cell(10, 7, $sep->response->peserta->kelamin, 0, 1);

            $pdf->SetXY(140, 35);
            $pdf->Cell(10, 7, 'Peserta', 0, 1);
            $pdf->SetXY(160, 35);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 35);
            $pdf->Cell(10, 7, $sep->response->peserta->jnsPeserta, 0, 1);


            $pdf->SetXY(140, 40);
            $pdf->Cell(10, 7, 'COB', 0, 1);
            $pdf->SetXY(160, 40);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 40);
            $pdf->Cell(10, 7, $sep->response->cob, 0, 1);

            $pdf->SetXY(140, 45);
            $pdf->Cell(10, 7, 'Jns Rawat', 0, 1);
            $pdf->SetXY(160, 45);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 45);
            $pdf->Cell(10, 7, $sep->response->jnsPelayanan, 0, 1);

            $pdf->SetXY(140, 50);
            $pdf->Cell(10, 7, 'Kls Rawat', 0, 1);
            $pdf->SetXY(160, 50);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 50);
            $pdf->Cell(10, 7, $sep->response->kelasRawat, 0, 1);

            $pdf->SetXY(140, 55);
            $pdf->Cell(10, 7, 'Penjamin', 0, 1);
            $pdf->SetXY(160, 55);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 55);
            $pdf->Cell(10, 7, $sep->response->penjamin, 0, 1);


            $pdf->SetXY(10, 45);
            $pdf->Cell(10, 7, 'Nama Peserta', 0, 1);
            $pdf->SetXY(40, 45);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 46);
            $pdf->MultiCell(60, 5, $sep->response->peserta->nama);
            // $pdf->Cell(10,7,$sep['0']['nama_peserta'],0,1);
            $y = $pdf->GetY();
            $pdf->SetXY(10, $y);
            $pdf->Cell(10, 7, 'Tgl Lahir', 0, 1);
            $pdf->SetXY(40, $y);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, $y);
            $pdf->Cell(10, 7, $sep->response->peserta->tglLahir, 0, 1);

            $pdf->SetXY(10, 55);
            $pdf->Cell(10, 7, 'No.Telepon', 0, 1);
            $pdf->SetXY(40, 55);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 55);
            $pdf->Cell(10, 7, $peserta->response->peserta->mr->noTelepon, 0, 1);

            $pdf->SetXY(10, 60);
            $pdf->Cell(10, 7, 'Dokter', 0, 1);
            $pdf->SetXY(40, 60);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 60);
            $pdf->Cell(10, 7, $sep->response->kontrol->nmDokter, 0, 1);

            $pdf->SetXY(10, 65);
            $pdf->Cell(10, 7, 'Poli Tujuan', 0, 1);
            $pdf->SetXY(40, 65);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 65);
            $pdf->Cell(10, 7, $sep->response->poli, 0, 1);

            $pdf->SetXY(10, 70);
            $pdf->Cell(10, 7, 'Faskes Perujuk', 0, 1);
            $pdf->SetXY(40, 70);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 70);
            $pdf->Cell(10, 7, $peserta->response->peserta->provUmum->nmProvider, 0, 1);
            $pdf->SetXY(10, 75);
            $pdf->Cell(10, 7, 'Diagnosa Awal', 0, 1);
            $pdf->SetXY(40, 75);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 75);
            $pdf->Cell(10, 7, $sep->response->diagnosa, 0, 1);

            $pdf->SetXY(10, 80);
            $pdf->Cell(10, 7, 'Catatan', 0, 1);
            $pdf->SetXY(40, 80);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 80);
            $pdf->Cell(10, 7, $sep->response->catatan, 0, 1);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 85);
            $pdf->Cell(10, 7, '*Saya menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan', 0, 1);

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(150, 85);
            $pdf->Cell(10, 7, 'Pasien / Keluarga Pasien', 0, 1);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 90);
            $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
            $pdf->SetFont('Arial', 'I', 7);
            $pdf->SetXY(10, 100);
            $pdf->Cell(10, 7, 'Cetakan ke -' . " " . ' ,.Tanggal cetak ' . date('y-m-d h:i:s'), 0, 1);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 90);
            $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
            $pdf->SetFont('Arial', 'I', 7);
            $pdf->SetXY(12, 100);
            $pdf->Cell(10, 7, '..', 0, 1);

            $pdf->SetFont('Arial', '', 12);
            $pdf->Line(150, 100, 190, 100);
            $pdf->Output();

            exit;
        } else {
            //update cetakan
            $cetakan = $sep['0']['cetakan'] + 1;
            ts_sep::where('kode_kunjungan', $kodekunjungan)->update(['cetakan' => $cetakan]);
            $pdf = new Fpdf('L', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetTitle('Cetak SEP');
            $pdf->SetMargins('15', '20', '10');
            $pdf->SetFont('Arial', '', 15);
            $pdf->Image('public/img/logobpjs.png', 1, -5, 60, 40);
            $pdf->Image('public/img/logo_rs.png', 170, 4, 35, 25);
            $pdf->SetXY(70, 8);
            $pdf->Cell(10, 7, 'SURAT ELIGIBILITAS PESERTA', 0, 1);
            $pdf->SetXY(73, 14);
            $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 30);
            $pdf->Cell(10, 7, 'No. SEP', 0, 1);
            $pdf->SetXY(40, 30);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetXY(45, 30);
            $pdf->Cell(10, 7, $sep[0]->no_SEP, 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 35);
            $pdf->Cell(10, 7, 'Tgl. SEP', 0, 1);
            $pdf->SetXY(40, 35);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 35);
            $pdf->Cell(10, 7, $sep[0]->tgl_SEP, 0, 1);

            $pdf->SetXY(10, 40);
            $pdf->Cell(10, 7, 'No. Kartu', 0, 1);
            $pdf->SetXY(40, 40);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 40);
            $pdf->Cell(10, 7, $sep['0']['no_kartu'], 0, 1);

            $pdf->SetXY(100, 35);
            $pdf->Cell(10, 7, 'No. MR', 0, 1);
            $pdf->SetXY(115, 35);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(120, 35);
            $pdf->Cell(10, 7, $sep['0']['no_rm'], 0, 1);

            $pdf->SetXY(100, 40);
            $pdf->Cell(10, 7, 'Kelamin', 0, 1);
            $pdf->SetXY(115, 40);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(120, 40);
            $pdf->Cell(10, 7, $sep['0']['jenis_kelamin'], 0, 1);

            $pdf->SetXY(140, 35);
            $pdf->Cell(10, 7, 'Peserta', 0, 1);
            $pdf->SetXY(160, 35);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 35);
            $pdf->Cell(10, 7, $sep['0']['peserta'], 0, 1);


            $pdf->SetXY(140, 40);
            $pdf->Cell(10, 7, 'COB', 0, 1);
            $pdf->SetXY(160, 40);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 40);
            $pdf->Cell(10, 7, $sep['0']['cob'], 0, 1);

            $pdf->SetXY(140, 45);
            $pdf->Cell(10, 7, 'Jns Rawat', 0, 1);
            $pdf->SetXY(160, 45);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 45);
            $pdf->Cell(10, 7, $sep['0']['jenis_rawat'], 0, 1);

            $pdf->SetXY(140, 50);
            $pdf->Cell(10, 7, 'Kls Rawat', 0, 1);
            $pdf->SetXY(160, 50);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 50);
            $pdf->Cell(10, 7, $sep['0']['kls_rawat'], 0, 1);

            $pdf->SetXY(140, 55);
            $pdf->Cell(10, 7, 'Penjamin', 0, 1);
            $pdf->SetXY(160, 55);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(165, 55);
            $pdf->Cell(10, 7, $sep['0']['peserta'], 0, 1);


            $pdf->SetXY(10, 45);
            $pdf->Cell(10, 7, 'Nama Peserta', 0, 1);
            $pdf->SetXY(40, 45);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 46);
            $pdf->MultiCell(60, 5, $sep['0']['nama_peserta']);
            // $pdf->Cell(10,7,$sep['0']['nama_peserta'],0,1);
            $y = $pdf->GetY();
            $pdf->SetXY(10, $y);
            $pdf->Cell(10, 7, 'Tgl Lahir', 0, 1);
            $pdf->SetXY(40, $y);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, $y);
            $pdf->Cell(10, 7, $sep['0']['tgl_lahir'], 0, 1);

            $pdf->SetXY(10, 55);
            $pdf->Cell(10, 7, 'No.Telepon', 0, 1);
            $pdf->SetXY(40, 55);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 55);
            $pdf->Cell(10, 7, $sep['0']['no_tlp'], 0, 1);

            $str = $sep['0']['dpjp'];
            $start = strpos($str, '|');
            $doktert = substr($str, $start + 1);

            $pdf->SetXY(10, 60);
            $pdf->Cell(10, 7, 'Dokter', 0, 1);
            $pdf->SetXY(40, 60);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(44, 60);
            $pdf->Cell(10, 7, $doktert, 0, 1);

            $pdf->SetXY(10, 65);
            $pdf->Cell(10, 7, 'Poli Tujuan', 0, 1);
            $pdf->SetXY(40, 65);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 65);
            if ($sep['0']['jenis_rawat'] == "R.Inap" || $sep['0']['jenis_rawat'] == "Rawat Inap") {
                // $poli = $sep['0']['poli_tujuan'];
                // $arr = explode('|', $poli, 2);
                $pdf->Cell(10, 7, '', 0, 1);
            } else {
                $poli = $sep['0']['poli_tujuan'];
                $arr = explode('|', $poli, 2);
                $pdf->Cell(10, 7, $arr[1], 0, 1);
            }


            $pdf->SetXY(10, 70);
            $pdf->Cell(10, 7, 'Faskes Perujuk', 0, 1);
            $pdf->SetXY(40, 70);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 70);
            $pdf->Cell(10, 7, $sep['0']['nama_asal_faskes'], 0, 1);
            $diag = $sep['0']['diagnosa_awal'];
            $arr = explode('-', $diag, 2);
            if (count($arr) > 1) {
                $diag1 = $arr[1];
            } else {
                $diag1 = $arr[0];
            }
            $pdf->SetXY(10, 75);
            $pdf->Cell(10, 7, 'Diagnosa Awal', 0, 1);
            $pdf->SetXY(40, 75);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 75);
            $pdf->Cell(10, 7, $diag1, 0, 1);

            $pdf->SetXY(10, 80);
            $pdf->Cell(10, 7, 'Catatan', 0, 1);
            $pdf->SetXY(40, 80);
            $pdf->Cell(10, 7, ':', 0, 1);
            $pdf->SetXY(45, 80);
            $pdf->Cell(10, 7, $sep['0']['catatan'], 0, 1);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 85);
            $pdf->Cell(10, 7, '*Saya menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan', 0, 1);

            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(150, 85);
            $pdf->Cell(10, 7, 'Pasien / Keluarga Pasien', 0, 1);

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 90);
            $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
            $pdf->SetFont('Arial', 'I', 7);
            $pdf->SetXY(10, 100);
            $pdf->Cell(10, 7, 'Cetakan ke -' . $sep['0']['cetakan'] . ' ,.Tanggal cetak ' . date('y-m-d h:i:s'), 0, 1);
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY(10, 90);
            $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
            $pdf->SetFont('Arial', 'I', 7);
            $pdf->SetXY(12, 100);
            $pdf->Cell(10, 7, '..', 0, 1);

            $pdf->SetFont('Arial', '', 12);
            $pdf->Line(150, 100, 190, 100);
            $pdf->Output();

            exit;
        }
    }
    public function Cetaksep_v(Request $request)
    {
        //ambil data sep
        $sep = $request->sep;
        // $sep = ts_sep::where('no_SEP', $sep)->get();
        // $cek = count($sep);
        // if($cek == 0){
        $v = new VclaimModel();
        $sep = $v->carisep($request->sep);
        $peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
        // $cetakan = $sep['0']['cetakan'] + 1;
        // ts_sep::where('kode_kunjungan', $sep)->update(['no_SEP' => $cetakan]);
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Cetak SEP');
        $pdf->SetMargins('15', '20', '10');
        $pdf->SetFont('Arial', '', 15);
        $pdf->Image('public/img/logobpjs.png', 1, -5, 60, 40);
        $pdf->Image('public/img/logo_rs.png', 170, 4, 35, 25);
        $pdf->SetXY(70, 8);
        $pdf->Cell(10, 7, 'SURAT ELIGIBILITAS PESERTA', 0, 1);
        $pdf->SetXY(73, 14);
        $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 30);
        $pdf->Cell(10, 7, 'No. SEP', 0, 1);
        $pdf->SetXY(40, 30);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(45, 30);
        $pdf->Cell(10, 7, $sep->response->noSep, 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 35);
        $pdf->Cell(10, 7, 'Tgl. SEP', 0, 1);
        $pdf->SetXY(40, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 35);
        $pdf->Cell(10, 7, $sep->response->tglSep, 0, 1);

        $pdf->SetXY(10, 40);
        $pdf->Cell(10, 7, 'No. Kartu', 0, 1);
        $pdf->SetXY(40, 40);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 40);
        $pdf->Cell(10, 7, $sep->response->peserta->noKartu, 0, 1);

        $pdf->SetXY(100, 35);
        $pdf->Cell(10, 7, 'No. MR', 0, 1);
        $pdf->SetXY(115, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(120, 35);
        $pdf->Cell(10, 7, $sep->response->peserta->noMr, 0, 1);

        $pdf->SetXY(100, 40);
        $pdf->Cell(10, 7, 'Kelamin', 0, 1);
        $pdf->SetXY(115, 40);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(120, 40);
        $pdf->Cell(10, 7, $sep->response->peserta->kelamin, 0, 1);

        $pdf->SetXY(140, 35);
        $pdf->Cell(10, 7, 'Peserta', 0, 1);
        $pdf->SetXY(160, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 35);
        $pdf->Cell(10, 7, $sep->response->peserta->jnsPeserta, 0, 1);


        $pdf->SetXY(140, 40);
        $pdf->Cell(10, 7, 'COB', 0, 1);
        $pdf->SetXY(160, 40);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 40);
        $pdf->Cell(10, 7, $sep->response->cob, 0, 1);

        $pdf->SetXY(140, 45);
        $pdf->Cell(10, 7, 'Jns Rawat', 0, 1);
        $pdf->SetXY(160, 45);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 45);
        $pdf->Cell(10, 7, $sep->response->jnsPelayanan, 0, 1);

        $pdf->SetXY(140, 50);
        $pdf->Cell(10, 7, 'Kls Rawat', 0, 1);
        $pdf->SetXY(160, 50);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 50);
        $pdf->Cell(10, 7, $sep->response->kelasRawat, 0, 1);

        $pdf->SetXY(140, 55);
        $pdf->Cell(10, 7, 'Penjamin', 0, 1);
        $pdf->SetXY(160, 55);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 55);
        $pdf->Cell(10, 7, $sep->response->penjamin, 0, 1);


        $pdf->SetXY(10, 45);
        $pdf->Cell(10, 7, 'Nama Peserta', 0, 1);
        $pdf->SetXY(40, 45);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 46);
        $pdf->MultiCell(60, 5, $sep->response->peserta->nama);
        // $pdf->Cell(10,7,$sep['0']['nama_peserta'],0,1);
        $y = $pdf->GetY();
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Tgl Lahir', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, $y);
        $pdf->Cell(10, 7, $sep->response->peserta->tglLahir, 0, 1);

        $pdf->SetXY(10, 55);
        $pdf->Cell(10, 7, 'No.Telepon', 0, 1);
        $pdf->SetXY(40, 55);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 55);
        $pdf->Cell(10, 7, $peserta->response->peserta->mr->noTelepon, 0, 1);

        $pdf->SetXY(10, 60);
        $pdf->Cell(10, 7, 'Dokter', 0, 1);
        $pdf->SetXY(40, 60);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 60);
        $pdf->Cell(10, 7, $sep->response->kontrol->nmDokter, 0, 1);

        $pdf->SetXY(10, 65);
        $pdf->Cell(10, 7, 'Poli Tujuan', 0, 1);
        $pdf->SetXY(40, 65);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 65);
        $pdf->Cell(10, 7, $sep->response->poli, 0, 1);

        $pdf->SetXY(10, 70);
        $pdf->Cell(10, 7, 'Faskes Perujuk', 0, 1);
        $pdf->SetXY(40, 70);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 70);
        $pdf->Cell(10, 7, $peserta->response->peserta->provUmum->nmProvider, 0, 1);
        $pdf->SetXY(10, 75);
        $pdf->Cell(10, 7, 'Diagnosa Awal', 0, 1);
        $pdf->SetXY(40, 75);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 75);
        $pdf->Cell(10, 7, $sep->response->diagnosa, 0, 1);

        $pdf->SetXY(10, 80);
        $pdf->Cell(10, 7, 'Catatan', 0, 1);
        $pdf->SetXY(40, 80);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 80);
        $pdf->Cell(10, 7, $sep->response->catatan, 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 85);
        $pdf->Cell(10, 7, '*Saya menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan', 0, 1);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(150, 85);
        $pdf->Cell(10, 7, 'Pasien / Keluarga Pasien', 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 90);
        $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY(10, 100);
        $pdf->Cell(10, 7, 'Cetakan ke -' . " " . ' ,.Tanggal cetak ' . date('y-m-d h:i:s'), 0, 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 90);
        $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY(12, 100);
        $pdf->Cell(10, 7, '..', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Line(150, 100, 190, 100);
        $pdf->Output();

        exit;
    }
    public function simpanpasien(Request $request)
    {
        $rm = $this->get_rm();
        if ($request->sesuaiktp == 1) {
            $desa = $request->desa;
            $kecamatan = $request->kecamatan;
            $kab = $request->kabupaten;
            $prop = $request->provinsi;
            $alamat = $request->alamat;
        } else {
            $desa = $request->desadom;
            $kecamatan = $request->kecamatandom;
            $kab = $request->kabupatendom;
            $prop = $request->provinsidom;
            $alamat = $request->alamatdom;
        }
        $nobpjs = $request->nomorbpjs;
        if ($request->nomorbpjs == '') {
            $nobpjs = '0';
        }
        $data_pasien = [
            'no_rm' => $rm,
            'no_Bpjs' => $nobpjs,
            'nik_bpjs' => $request->nomorktp,
            'nama_px' => strtoupper($request->namapasien),
            'jenis_kelamin' => $request->jeniskelamin,
            'tempat_lahir' => $request->tempatlahir,
            'tgl_lahir' => $request->tanggallahir,
            'gol_darah' => '',
            'status_px' => $request->status,
            'DoL' => $request->statuspasien,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'kewarganegaraan' => $request->kewarganegaraan,
            'negara' => $request->negara,
            'propinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->nomortelp,
            'no_hp' => $request->nomortelp,
            'tgl_entry' => date('Y-m-d h:i:s'),
            'pic' => auth()->user()->id_simrs,
            'kode_propinsi' => $request->provinsi,
            'kode_kabupaten' => $request->kabupaten,
            'kode_kecamatan' => $request->kecamatan,
            'kode_desa' => $desa
        ];
        $data_keluarga = [
            'no_rm' => $rm,
            'nama_keluarga' => $request->namakeluarga,
            'hubungan_keluarga' => $request->hubungankeluarga,
            'alamat_keluarga' => $request->alamatkeluarga,
            'tlp_keluarga' => $request->telpkeluarga,
            'input_date' => date('Y-m-d h:i:s'),
            'pic1' => auth()->user()->id_simrs
        ];
        $data_domisili = [
            'no_rm' => $rm,
            'negara' => $request->negara,
            'kd_desa' => $desa,
            'kd_kecamatan' => $kecamatan,
            'kd_kabupaten' => $kab,
            'kd_prop' => $prop,
            'alamat' => $alamat
        ];
        Pasien::create($data_pasien);
        mt_keluarga::create($data_keluarga);
        mt_domisili::create($data_domisili);
        $data = [
            'code' => 200,
            'message' => 'ok'
        ];
        echo json_encode($data);
    }
    public function updatenpasien(Request $request)
    {
        if ($request->sesuaiktp == 1) {
            $desa = $request->desa;
            $kecamatan = $request->kecamatan;
            $kab = $request->kabupaten;
            $prop = $request->provinsi;
            $alamat = $request->alamat;
        } else {
            $desa = $request->desadom;
            $kecamatan = $request->kecamatandom;
            $kab = $request->kabupatendom;
            $prop = $request->provinsidom;
            $alamat = $request->alamatdom;
        }
        $nobpjs = $request->nomorbpjs;
        if ($request->nomorbpjs == '') {
            $nobpjs = '0';
        }
        $data_pasien = [
            'no_Bpjs' => $nobpjs,
            'nik_bpjs' => $request->nomorktp,
            'nama_px' => strtoupper($request->namapasien),
            'jenis_kelamin' => $request->jeniskelamin,
            'tempat_lahir' => $request->tempatlahir,
            'tgl_lahir' => $request->tanggallahir,
            'gol_darah' => '',
            'status_px' => $request->status,
            'DoL' => $request->statuspasien,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'kewarganegaraan' => $request->kewarganegaraan,
            'negara' => $request->negara,
            'propinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->nomortelp,
            'no_hp' => $request->nomortelp,
            'update_date' => date('Y-m-d h:i:s'),
            'update_by' => auth()->user()->id_simrs,
            'kode_propinsi' => $request->provinsi,
            'kode_kabupaten' => $request->kabupaten,
            'kode_kecamatan' => $request->kecamatan,
            'kode_desa' => $desa
        ];
        $data_keluarga = [
            'nama_keluarga' => $request->namakeluarga,
            'hubungan_keluarga' => $request->hubungankeluarga,
            'alamat_keluarga' => $request->alamatkeluarga,
            'tlp_keluarga' => $request->telpkeluarga,
            'input_date' => date('Y-m-d h:i:s'),
            'pic1' => auth()->user()->id_simrs
        ];
        $data_domisili = [
            'negara' => $request->negara,
            'kd_desa' => $desa,
            'kd_kecamatan' => $kecamatan,
            'kd_kabupaten' => $kab,
            'kd_prop' => $prop,
            'alamat' => $alamat
        ];
        Pasien::where('no_rm', $request->nomorrm)->update($data_pasien);
        mt_keluarga::where('no_rm', $request->nomorrm)->update($data_keluarga);
        mt_domisili::where('no_rm', $request->nomorrm)->update($data_domisili);
        $data = [
            'code' => 200,
            'message' => 'ok'
        ];
        echo json_encode($data);
    }
    public function cekkunjungan_rujukan(Request $request)
    {
        $v = new VclaimModel();
        $pulang = $v->jumlahseprujukan($request->faskes, $request->nomorrujukan);
        if ($pulang->metaData->code == 200) {
            $jumlah = $pulang->response->jumlahSEP + 1;
            echo "<div class='alert alert-success alert-dismissible fade show' role=alert>Nomor rujukan : $request->nomorrujukan <strong>Kunjungan ke-$jumlah</strong><button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button></div>";
        }
    }
    public function updatepasien(Request $request)
    {
        Pasien::where('no_rm', $request->rm)->update(['no_Bpjs' => $request->bpjs, 'nama_px' => $request->nama, 'nik_bpjs' => $request->ktp]);
        echo json_encode('ok');
    }
    public function detailpasien(Request $request)
    {
        $rm = $request->nomorrm;
        $pasien = Pasien::where('no_rm', $rm)->get();
        $keluarga = mt_keluarga::where('no_rm', $rm)->get();
        $domisili = mt_domisili::where('no_rm', $rm)->get();
        if (count($keluarga) > 0) {
            $dkeluarga = 1;
        } else {
            $dkeluarga = 0;
        }
        if (count($domisili) > 0) {
            $s_dom = 1;
            $prop_DOM = $domisili[0]['kd_prop'];
            $kab_DOM = $domisili[0]['kd_kabupaten'];
            $ds_DOM = $domisili[0]['kd_kecamatan'];
            $status = 1;
        } else {
            $s_dom = 0;
            $prop_DOM = $pasien[0]['kode_propinsi'];
            $kab_DOM = $pasien[0]['kode_kabupaten'];
            $ds_DOM = $pasien[0]['kode_kecamatan'];
            $status = 0;
        }
        $prop = $pasien[0]['kode_propinsi'];
        $kab = $pasien[0]['kode_kabupaten'];
        $ds = $pasien[0]['kode_kecamatan'];
        $kabupatenDOM = Kabupaten::where('province_id', $prop_DOM)->get();
        $kecamatanDOM = Kecamatan::where('regency_id', $kab_DOM)->get();
        $desaDOM = Desa::where('district_id', $ds_DOM)->get();
        $kabupaten = Kabupaten::where('province_id', $prop)->get();
        $kecamatan = Kecamatan::where('regency_id', $kab)->get();
        $desa = Desa::where('district_id', $ds)->get();
        // dd($pasien);
        return view('pendaftaran.detailpasien', [
            'status_dom' => $s_dom,
            'status_k' => $dkeluarga,
            'status' => $status,
            'data_pasien' => $pasien,
            'domisili' => $domisili,
            'data_keluarga' => $keluarga,
            'agama' => Agama::all(),
            'status' => Status::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan' => Pendidikan::all(),
            'hubkel' => Hubkeluarga::all(),
            'negara' => Negara::all(),
            'provinsi' => Provinsi::all(),
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'desa' => $desa,
            'kabupatendom' => $kabupatenDOM,
            'kecamatandom' => $kecamatanDOM,
            'desadom' => $desaDOM,
        ]);
        // }else{
        //     $status_update = 0;
        //     return view('eror_pasien');
        // }
    }
    public function carifaskes(Request $request)
    {
        $faskes = $request->faskes;
        $r = $request->q;
        $v = new VclaimModel();
        $result = $v->referensi_faskes($r, $faskes);
        if (count($result->response->faskes) > 0) {
            foreach ($result->response->faskes as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function carirujukan_nomor(Request $request)
    {
        $nomorrujukan = $request->nomorrujukan;
        $v = new VclaimModel();
        $result = $v->carirujukan_byno($nomorrujukan);
        dd($result);
    }
    public function Cetakstruk($kodekunjungan)
    {
        $t = ts_layanan_header::where('kode_kunjungan', $kodekunjungan)->get();
        $kode = $t[0]['kode_layanan_header'];
        $id = $t[0]['id'];
        $nota = DB::select("CALL SP_NOTA_TINDAKAN_NEW('$kode','$id')");
        // dd($nota);
        // $p = Pasien::where('no_rm', $t[0]['no_rm'])->get();
        $pdf = new Fpdf('P', 'mm');
        $pdf->AddPage();
        $pdf->SetTitle('Cetak nota');
        $pdf->SetMargins('15', '20', '10');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Image('public/img/logo_rs.png', 5, 2, 18, 12);
        $pdf->SetXY(23, 3);
        $pdf->Cell(10, 7, 'PENDAFTARAN RAWAT JALAN', 0, 1);
        $pdf->SetXY(23, 7);
        $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);
        $pdf->Line(5, 15, 78, 15);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(4, 15);
        $pdf->Cell(10, 7, 'Kode Layanan', 0, 1);
        $pdf->SetXY(30, 15);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(35, 15);
        $pdf->Cell(10, 7, $nota[0]->kode_layanan_header, 0, 1);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(4, 18);
        $pdf->Cell(10, 7, 'Tgl Entry', 0, 1);
        $pdf->SetXY(30, 18);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, 18);
        $pdf->Cell(10, 7, $nota[0]->tgl_entry, 0, 1);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(4, 22);
        $pdf->Cell(10, 7, 'Unit', 0, 1);
        $pdf->SetXY(30, 22);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, 22);
        $pdf->Cell(10, 7, $nota[0]->nama_unit, 0, 1);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(4, 26);
        $pdf->Cell(10, 7, 'RM / Kunjungan', 0, 1);
        $pdf->SetXY(30, 26);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, 26);
        $pdf->Cell(10, 7, $nota[0]->no_rm . " / " . $nota[0]->counter, 0, 1);

        $pdf->SetFont('Arial', 'B', 7);
        $pdf->SetXY(4, 30);
        $pdf->Cell(10, 7, 'Nama Pasien', 0, 1);
        $pdf->SetXY(30, 30);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, 32);
        $pdf->MultiCell(30, 3, $nota[0]->nama_px);
        // $pdf->Cell(10, 7, "Agyl Putera Wibowo", 0, 1);

        $y = $pdf->GetY() - 2;
        $pdf->SetXY(4, $y);
        $pdf->Cell(10, 7, 'Tgl lahir /JK/ umur', 0, 1);
        $pdf->SetXY(30, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, $y);
        $pdf->Cell(10, 7, $nota[0]->tgl_lahir . " / " . $nota[0]->JK . " / " . $nota[0]->umur, 0, 1);

        $pdf->SetFont('Arial', 'B', 7);
        $y = $pdf->GetY() - 2;
        $pdf->SetXY(4, $y);
        $pdf->Cell(10, 7, 'Alamat', 0, 1);
        $pdf->SetXY(30, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, $y + 2);
        $pdf->MultiCell(30, 3, $nota[0]->alamat);

        $y = $pdf->GetY() - 1;
        $pdf->SetXY(4, $y);
        $pdf->Cell(10, 7, 'Penjamin', 0, 1);
        $pdf->SetXY(30, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(35, $y);
        $pdf->Cell(10, 7, $nota[0]->nama_penjamin, 0, 1);

        $y = $pdf->GetY() - 1;
        $pdf->SetXY(4, $y);
        $pdf->Cell(10, 7, 'Nama Layanan', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, 'Tarif', 0, 1);
        $pdf->SetXY(50, $y);
        $pdf->Cell(10, 7, "Jml", 0, 1);
        $pdf->SetXY(60, $y);
        $pdf->Cell(10, 7, "Sub Total", 0, 1);
        $y = $pdf->GetY() - 1;
        $pdf->Line(5, $y, 78, $y);
        $total = 0;
        foreach ($nota as $n) {
            $y = $pdf->GetY() - 1;
            $pdf->SetXY(4, $y + 2);
            $pdf->MultiCell(30, 3, $n->NAMA_TARIF);
            $pdf->SetXY(40, $y);
            $pdf->Cell(10, 7, $n->total_layanan, 0, 1);
            $pdf->SetXY(50, $y);
            $pdf->Cell(10, 7, $n->jumlah_layanan, 0, 1);
            $pdf->SetXY(60, $y);
            $pdf->Cell(10, 7, $n->grantotal_layanan, 0, 1);
            $total = $n->total_layanan + $total;
        }

        // $y = $pdf->GetY()+2;
        // $pdf->SetXY(4, $y+2);
        // $pdf->MultiCell(30, 3, "Karcis Konsul Poliklinik");
        // $pdf->SetXY(40, $y);
        // $pdf->Cell(10, 7, '25000', 0, 1);
        // $pdf->SetXY(50, $y);
        // $pdf->Cell(10, 7, "1", 0, 1);
        // $pdf->SetXY(60, $y);
        // $pdf->Cell(10, 7, "25,000", 0, 1);

        $y = $pdf->GetY() + 2;
        $pdf->Line(5, $y, 78, $y);

        $y = $pdf->GetY() + 2;
        $pdf->SetXY(30, $y);
        $pdf->Cell(10, 7, 'Tunai total bayar', 0, 1);
        $pdf->SetXY(60, $y);
        $pdf->Cell(10, 7, $total, 0, 1);

        $pdf->SetFont('Arial', 'B', 5);
        $y = $pdf->GetY();
        $pdf->SetXY(30, $y);
        $pdf->Cell(10, 7, auth()->user()->nama, 0, 1);
        $pdf->SetXY(50, $y);
        $pdf->Cell(10, 7, date('Y-m-d h:i:s'), 0, 1);

        $pdf->Output();
        exit;
    }
    public function simpanrujukan(Request $request)
    {
        $data_rujukan = [
            "request" => [
                "t_rujukan" => [
                    "noSep" => "$request->nosep",
                    "tglRujukan" => "$request->tglRujukan",
                    "tglRencanaKunjungan" => "$request->tglRencanaKunjungan",
                    "ppkDirujuk" => "$request->ppkDirujuk",
                    "jnsPelayanan" => "$request->jnsPelayanan",
                    "catatan" => "$request->catatan",
                    "diagRujukan" => "$request->diagRujukan",
                    "tipeRujukan" => "$request->tipeRujukan",
                    "poliRujukan" => "$request->poliRujukan",
                    "user" => "Coba Ws"
                ]
            ]
        ];
        $v = new VclaimModel();
        $r = $v->insertrujukan($data_rujukan);
        if ($r == 'RTO') {
            $data = [
                'kode' => 500,
                'message' => 'The Network connection lost, please try again ...'
            ];
            echo json_encode($data);
        } else if ($r->metaData->code == 200) {
            $data = [
                'kode' => 200,
                'message' => $r->metaData->message
            ];
            $dr = $r->response->rujukan;
            $data_rujukan = [
                'asal_rujukan' => $dr->AsalRujukan->kode,
                'nama_asal_rujukan' => $dr->AsalRujukan->nama,
                'no_rujukan' => $dr->noRujukan,
                'no_sep' => $request->nosep,
                'tglBerlakuKunjungan' => $dr->tglBerlakuKunjungan,
                'tglRencanaKunjungan' => $dr->tglRencanaKunjungan,
                'tglRujukan' => $dr->tglRujukan,
                'tujuanRujukan' => $dr->tujuanRujukan->kode,
                'namaTujuanRujukan' => $dr->tujuanRujukan->nama,
                'nama_px' => $dr->peserta->nama,
                'no_rm' => $dr->peserta->noMr,
                'no_bpjs' => $dr->peserta->noKartu,
                'kelamin' => $dr->peserta->kelamin,
                'jenis_peserta' => $dr->peserta->jnsPeserta
            ];
            ts_rujukan::create($data_rujukan);
            echo json_encode($data);
        } else {
            $data = [
                'kode' => $r->metaData->code,
                'message' => $r->metaData->message
            ];
            echo json_encode($data);
        }
    }
    public function infopasienbpjs(Request $request)
    {
        $v = new VclaimModel();
        return view('pendaftaran.profilpeserta', [
            'data_peserta' => $v->get_peserta_noka($request->noka, date('Y-m-d'))
        ]);
    }
    public function infopasienbpjs2(Request $request)
    {
        $v = new VclaimModel();
        $data_peserta = $v->get_peserta_noka($request->noka, date('Y-m-d'));
        $mt_penjamin = DB::select('select * from mt_penjamin_bpjs where nama_penjamin_bpjs = ?', [$data_peserta->response->peserta->jenisPeserta->keterangan]);
        $data = [
            'kode' => 201,
            'data_peserta' => $data_peserta,
            'penjamin' => $mt_penjamin[0]
        ];
        echo json_encode($data);
    }
    public function infosep(Request $request)
    {
        $v = new VclaimModel();
        $sep = $v->carisep($request->nosep);
        $sepkontrol = $v->carisep_kontrol($request->nosep);
        $diagnosa = $sepkontrol->response->diagnosa;
        $kodediagnosa = (explode('-', $diagnosa));
        $kode = trim($kodediagnosa[0]);
        $data_peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
        $kodeprop = $sep->response->lokasiKejadian->kdProp;
        $kodekab = $sep->response->lokasiKejadian->kdKab;
        $prop = $v->referensi_propinsi();
        if ($kodeprop != null) {
            $kab = $v->referensi_kabupaten($kodeprop);
            $datakab = $kab->response->list;
        } else {
            $datakab = 0;
        }
        if ($kodekab != null) {
            $kec = $v->referensi_kecamatan($kodekab);
            $datakec = $kec->response->list;
        } else {
            $datakec = 0;
        }
        return view('pendaftaran.infosep', [
            'sep' => $v->carisep($request->nosep),
            'prop' => $prop->response->list,
            'kab' => $datakab,
            'kec' => $datakec,
            'datapeserta' => $data_peserta,
            'diagnosa' => $kode
        ]);
    }
    public function inforujukan(Request $request)
    {
        $v = new VclaimModel();
        $rujukan = $v->carirujukan_byno($request->norujukan);
        if ($rujukan->metaData->code == 200) {
        } else {
            $rujukan = $v->carirujukanRS_byno_($request->norujukan);
        }
        return view('pendaftaran.inforujukan', [
            'rujukan' => $rujukan
        ]);
    }
    public function cariunit_kelas(Request $request)
    {
        $kelas = $request->kelas;
        $unit = DB::select('SELECT distinct fc_nama_unit1(kode_unit) as unit,kode_unit  FROM mt_ruangan WHERE id_kelas = ? AND status = ?', [$kelas, 1]);
        // dd($unit);
        echo "<option value=> -- Silahkan Pilih Unit -- </option>";
        foreach ($unit as $j) {
            echo "<option value=$j->kode_unit>$j->unit</option>";
        }
    }
    public function formedit_kunjungan(Request $request)
    {
        $data = [
            'kode' => "$request->kode",
            'rm' => "$request->rm",
            'sep' => "$request->sep",
            'rujukan' => "$request->rujukan",
            'status' => "$request->status",
            'kronis' => "$request->kronis"
        ];
        return view('pendaftaran.editkunjungan', [
            'data' => $data
        ]);
    }
    public function savedit_kunjungan(Request $request)
    {
        $data = [
            'no_sep' => "$request->nomorsep",
            'no_rujukan' => "$request->nomorrujukan",
            'status_kunjungan' => "$request->status_kunjungan",
            'catatan' => "$request->kronis",
        ];
        $update = ts_kunjungan::where('kode_kunjungan', $request->kode)->update($data);
        echo json_encode('ok');
    }
}
