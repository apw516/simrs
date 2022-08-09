<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function Billing()
    {
        $title = 'SIMRS - PENDAFTARAN';
        $sidebar = '2';
        $sidebar_m = '2';
        $unit = auth()->user()->unit;
        return view('billing.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'data_pasien' => DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('','','')")
        ]);
    }
    public function Formlayanan(Request $request)
    {
        $datapasien = [
            'nama' => $request->nama,
            'nomorm' => $request->nomorrm,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'dokter' => $request->dokter,
            'kodekunjungan' => $request->dokter,
            'penjamin' => $request->npenjamin,
            'kelas' => $request->kelas,
            'unit' => $request->unit,
            'kode_unit' => $request->kode_unit
        ];
        return view('billing.formlayanan', [
            'pasien' => $datapasien,
            'tarif' => DB::select("CALL sp_MASTER_TARIF_RAD")
        ]);
    }
    public function billingformlayanan(Request $request)
    {
        $jlh = $request->jnslayanan;
        if($jlh == 1){
            return view('billing.formlayanan.layanan1');
        }else if($jlh == 2){
            return view('billing.formlayanan.layanan2');
        }else if($jlh == 3){
            return view('billing.formlayanan.layanan3');
        }else if($jlh == 4){
            return view('billing.formlayanan.layanan4');
        }else if($jlh == 5){
            return view('billing.formlayanan.layanan5');
        }
    }
    public function carilayanan_penunjang(Request $request)
    {
        $unit = auth()->user()->unit;
        $result = DB::table('view_panggil_tarif')->where('Tindakan', 'LIKE', '%' . $request->q . '%')->where('kelas_tarif', '=', $request->kelas)->where('kode_unit', '=', $unit)->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => "kelas " .$row->kelas_tarif." ".$row->Tindakan,
                    'kode' => $row->kode,
                    'tarif' => $row->tarif
                );
            echo json_encode($arr_result);
        }
    }
    public function caripasienrajal(Request $request)
    {
        $data_pasien = DB::select("CALL SP_PANGGIL_PASIEN_RAWAT_JALAN('$request->rm','','','$request->kodeunit','$request->tgl')");   
        $datapasien = [
            'nama' => $data_pasien[0]->nama_px,
            'nomorm' => $data_pasien[0]->no_rm,
            'alamat' => $data_pasien[0]->alamat,
            'jk' => $data_pasien[0]->jenis_kelamin,
            'dokter' => $data_pasien[0]->nama_paramedis,
            'kodekunjungan' => $data_pasien[0]->kode_kunjungan,
            'penjamin' => $data_pasien[0]->nama_penjamin,
            'kelas' => $data_pasien[0]->KELAS_UNIT,                                                                         
            'unit' => $data_pasien[0]->nama_unit,
            'kode_unit' => $request->kodeunit
        ];
        return view('billing.formlayanan', [
            'pasien' => $datapasien,
            'tarif' => DB::select("CALL sp_MASTER_TARIF_RAD")
        ]);
    }
}
