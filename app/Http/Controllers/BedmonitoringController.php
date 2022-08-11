<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BedmonitoringController extends Controller
{
    public function index()
    {
        $data_bed = DB::select("CALL SP_BRIDGING_SIRANAP()");
        return view('bedmonitoring.index',[
            'title' => 'login',
            'data' => $data_bed
        ]);
    }
}
