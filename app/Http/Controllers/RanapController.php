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
use App\Models\ts_kunjungan;
use App\Models\ajuan_buka_kunjungan;


class RanapController extends VclaimController
{
    public function index()
    {
        $oneweek = (Carbon::now()->subMonth(1)->toDateString());
        $now = (Carbon::now()->toDateString());
        $user = auth()->user()->unit;
        $title = 'SIMRS -SEP RAWAT INAP';
        $sidebar = 'RANAP';
        $sidebar_m = 'SEP RANAP';
        // $this->get_app();
        return view('ranap.datasep', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'datapasien' => DB::select('SELECT kode_kunjungan,keterangan2,a.no_rm,d.no_Bpjs,no_sep,fc_nama_px(a.no_rm) AS nama ,tgl_masuk,DATE(tgl_keluar) as tgl_keluar,fc_nama_unit1(kode_unit) AS unit,kamar,no_bed,b.nama_penjamin,c.alasan_pulang,c.kode
            FROM ts_kunjungan a
            INNER JOIN mt_penjamin b ON b.kode_penjamin = a.kode_penjamin
            INNER JOIN mt_alasan_pulang c ON c.kode = a.id_alasan_pulang
            INNER JOIN mt_pasien d ON a.no_rm = d.no_rm
            WHERE kode_unit = ? AND DATE(tgl_keluar) BETWEEN ? AND ?
            AND b.kode_kelompok < 3 ', [$user, $oneweek, $now])
        ]);
    }
    public function UpdateSEP(Request $request)
    {
        // return redirect()->intended('logout');
        $v = new VclaimModel();
        // dd($request->rm);
        $mt_pasien = DB::select('select * from mt_pasien where no_rm = ?',[$request->rm]);
        $no_bpjs = $mt_pasien[0]->no_Bpjs;
        $sep = $request->nomorsurat;
        $cek_sep = $v->carisep($sep);
        // $this->get_app();
        if($no_bpjs != $cek_sep->response->peserta->noKartu){
            $data = [
                'metaData' =>
                [
                    'code' => 500,
                    'message' => 'Nomor SEP Tidak Sesuai !'
                ]
            ];
            echo json_encode($data);
            die;
        }
        if($cek_sep->response->jnsPelayanan == 'Rawat Jalan'){
            $data = [
                'metaData' =>
                [
                    'code' => 500,
                    'message' => 'Nomor SEP Tidak Sesuai !'
                ]
            ];
            echo json_encode($data);
            die;
        }
        $alasan = $request->alasan;
        $kodekunjungan = $request->kodekunjungan;
        $stm = '';
        $dtm = '';
        $nolp = $request->nolp;
        if ($alasan == '6' || $alasan == 7) {
            $alasanbrid = '4'; //meninggal
            $stm = $request->suratmeninggal;
            $dtm = $request->tglmeninggal;
            $keterangan2 = 'SEP sudah dipulangkan, Pasien meninggal | ' . $stm;
            DB::table('mt_pasien')->where('no_rm', $request->rm)->update(['DoL' => 0]);
        } else if ($alasan == '9') {
            $alasanbrid = '3';
            $keterangan2 = 'SEP sudah dipulangkan';
        } else if ($alasan == '2') {
            $alasanbrid = '1';
            $keterangan2 = 'SEP sudah dipulangkan';
        } else {
            $alasanbrid = '5';
            $keterangan2 = 'SEP sudah dipulangkan';
        }
        $tglpulang = $request->tglpulang;
        $data = [
            "request" =>  [
                "t_sep" => [
                    "noSep" =>  "$sep",
                    "statusPulang" => "$alasanbrid",
                    "noSuratMeninggal" => "$stm",
                    "tglMeninggal" => "$dtm",
                    "tglPulang" => "$tglpulang",
                    "noLPManual" => "$nolp",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $pulang = $v->updatetglpulang($data);
        if ($pulang->metaData->code == 200) {
            DB::table('ts_kunjungan')->where('kode_kunjungan', $kodekunjungan)->update(['keterangan2' => $keterangan2]);
        }
        echo json_encode($pulang);
    }
    public function Infopasien(Request $request)
    {
        $rm = $request->rm;
        $bpjs = $request->bpjs;
        $periode = DB::select('SELECT DISTINCT DATE(tgl_masuk) as tgl_masuk from ts_kunjungan where no_rm = ? ORDER BY tgl_masuk desc LIMIT 5', [$rm]);
        $COUNTER = DB::select('SELECT DISTINCT counter from ts_kunjungan where no_rm = ?', [$rm]);
        $all_licencies = collect();
        foreach ($COUNTER as $key => $column) {
            $layanan = DB::select("CALL RINCIAN_BIAYA_FINAL('$rm','$column->counter','1','1')");
            $all_licencies = $all_licencies->merge($layanan);
        }

        return view('ranap.infopasien', [
            'datapasien' => DB::select('SELECT fc_alamat(no_rm) as alamat,no_rm,nama_px,no_tlp,DATE(tgl_lahir) as tgl_lahir,no_Bpjs,nik_bpjs FROM mt_pasien a
            -- INNER JOIN mt_penjamin b ON b.kode_penjamin = a.kode_penjamin
            -- INNER JOIN mt_alasan_pulang c ON c.kode = a.id_alasan_pulang
            -- INNER JOIN mt_pasien d ON a.no_rm = d.no_rm
            WHERE no_rm = ?', [$rm]),
            'kunjungan' => $all_licencies,
            'periode' => $periode,
        ]);
    }
    public function Carisurkonranap(Request $request)
    {
        $v = new VclaimModel();
        // dd($request->bulan);
        $detail = $v->ListRencanaKontrol_bycard($request->bulan, $request->tahun, $request->nobpjs, '1');
        return view('ranap.tabelsurkonranap', [
            'list' => $detail
        ]);
    }
    public function editkunjungan(Request $request)
    {
        ts_kunjungan::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update(['no_sep' => $request->sep]);
        echo json_encode('oke');
    }
    public function menucaripasien(Request $request)
    {
        $oneweek = (Carbon::now()->subMonth(1)->toDateString());
        $now = (Carbon::now()->toDateString());
        $title = 'SIMRS - PENCARIAN PASIEN';
        $sidebar = 'RANAP';
        $sidebar_m = 'SEP RANAP';
        $user = auth()->user()->unit;
        $kunjungan = DB::select('SELECT *,a.kode_kunjungan as ts_kode_kunjungan, a.no_rm as ts_no_rm,a.counter as ts_counter,fc_nama_px(a.no_rm) as nama,fc_alamat(a.no_rm) as alamat,fc_nama_alasan_pulang(a.id_alasan_pulang ) as alasan FROM ts_kunjungan a
        LEFT OUTER JOIN tb_buka_data b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        WHERE a.kode_unit = ? AND DATE(a.tgl_masuk) BETWEEN ? AND ?', [$user, $oneweek, $now]);
        return view('ranap.pencarian_pasien', compact(
            'title',
            'sidebar',
            'sidebar_m',
            'kunjungan'
        ));
    }
    public function simpanajuan(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        if ($dataSet['keterangan_buka'] == '') {
            $back = [
                'kode' => 500,
                'message' => 'Keterangan tidak boleh kosong !'
            ];
            echo json_encode($back);
            die;
        }
        $data_ajuan = [
            'tgl_buka' => $this->get_now(),
            'counter' => $dataSet['counter'],
            'no_rm' => $dataSet['norm_buka'],
            'kode_kunjungan' => $dataSet['kode_kunjungan'],
            'unit' => auth()->user()->unit,
            'keperluan' => $dataSet['keterangan_buka'],
            'pic1' => auth()->user()->id_simrs,
            'status' => 1,
        ];
        try {
            $cek = DB::select('select * from tb_buka_data where kode_kunjungan = ? and status = ?', [$dataSet['kode_kunjungan'],1]);
            if (count($cek) > 0) {
                $status = $cek['0']->status;
                if ($status == '1') {
                    $back = [
                        'kode' => 500,
                        'message' => 'Sedang dalam proses pengajuan ...'
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            $cek2 = DB::select('select * from tb_buka_data where kode_kunjungan = ? and status = ?', [$dataSet['kode_kunjungan'],2]);
            if (count($cek2) > 0) {
                $status = $cek2['0']->status;
                if ($status == '2') {
                    $back = [
                        'kode' => 500,
                        'message' => 'Kunjungan masih dibuka ...'
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            ajuan_buka_kunjungan::create($data_ajuan);
            $back = [
                'kode' => 200,
                'message' => 'Form berhasil dikirim ...'
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
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function indexberkaserm()
    {
        $user = auth()->user()->unit;
        $title = 'SIMRS - Berkas ERM';
        $sidebar = 'RANAP';
        $sidebar_m = 'SEP RANAP';
        return view('ranap.indexberkaserm', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m
        ]);
    }
    public function cariberkasnya_pasien(Request $request)
    {
        $rm = $request->rm;
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
        WHERE a.no_rm = ? AND a.status_kunjungan NOT IN(8,11) ORDER BY a.kode_kunjungan DESC LIMIT 15', [$request->rm]);
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        return view('ermtemplate.form_catatan_medis_ranap_2', compact([
            'kunjungan',
            'rm',
            'mt_pasien'
        ]));
    }
}
