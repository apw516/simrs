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


class RanapController extends Controller
{
    public function index()
    {
        $oneweek = (Carbon::now()->subMonth(1)->toDateString());
        $now = (Carbon::now()->toDateString());
        $user = auth()->user()->unit;
        $title = 'SIMRS -SEP RAWAT INAP';
        $sidebar = 'RANAP';
        $sidebar_m = 'SEP RANAP';
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
            AND b.kode_kelompok <> 3', [$user, $oneweek, $now])
        ]);
    }
    public function UpdateSEP(Request $request)
    {
        $v = new VclaimModel();
        $sep = $request->nomorsurat;
        $alasan = $request->alasan;
        $kodekunjungan = $request->kodekunjungan;
        $stm = '';
        $dtm = '';
        $nolp = $request->nolp;
        if($alasan == '6' || $alasan == 7){
            $alasanbrid = '4';//meninggal
            $stm = $request->suratmeninggal;
            $dtm = $request->tglmeninggal;
            $keterangan2 = 'SEP sudah dipulangkan, Pasien meninggal | ' . $stm;
            DB::table('mt_pasien')->where('no_rm', $request->rm)->update(['DoL' => 0]);
        }else if($alasan == '9'){
            $alasanbrid = '3';
            $keterangan2 = 'SEP sudah dipulangkan';
        }else if($alasan == '2'){
            $alasanbrid = '1';
            $keterangan2 = 'SEP sudah dipulangkan';
        }else{
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
        if($pulang->metaData->code == 200 ){
            DB::table('ts_kunjungan')->where('kode_kunjungan', $kodekunjungan)->update(['keterangan2' => $keterangan2]);
        }
        echo json_encode($pulang);
    }
    public function Infopasien(Request $request)
    {
        $rm = $request->rm;
        $bpjs = $request->bpjs;
        $periode = DB::select('SELECT DISTINCT DATE(tgl_masuk) as tgl_masuk from ts_kunjungan where no_rm = ? ORDER BY tgl_masuk desc LIMIT 5',[$rm]);
        $COUNTER = DB::select('SELECT DISTINCT counter from ts_kunjungan where no_rm = ?',[$rm]);
        $all_licencies = collect();
        foreach($COUNTER as $key => $column ){
            $layanan = DB::select("CALL RINCIAN_BIAYA_FINAL('$rm','$column->counter','1','1')");
            $all_licencies = $all_licencies->merge($layanan);
        }

        return view('ranap.infopasien',[
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
        $detail = $v->ListRencanaKontrol_bycard($request->bulan, $request->tahun, $request->nobpjs, '2');
        return view('ranap.tabelsurkonranap', [
            'list' => $detail
        ]);
    }
    public function editkunjungan(Request $request){
        ts_kunjungan::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update(['no_sep' => $request->sep ]);
        echo json_encode('oke');
    }
}
