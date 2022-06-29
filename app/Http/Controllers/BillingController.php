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
        return view('billing.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'data_pasien' => DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG('','','','3003')")
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
}
