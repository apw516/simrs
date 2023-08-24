<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VclaimModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'SIMRS - DASHBOARD SIMRS';
        $sidebar = '1';
        $sidebar_m = '1.1';
        $awal_bulan = date('Y-m-01');
        $now = $this->get_date();
        $mt_unit = db::select('select * from mt_unit where group_unit = ?',(['J']));
        //semua poli / bulan
        $ds = DB::select('CALL erm_dasboard_03_per_tgl(?,?,?)', [$awal_bulan,$this->get_date(), '']);
        $unit = [];
        foreach ($ds as $d) {
            array_push($unit, $d->unit);
        }
        $total = [];
        foreach ($ds as $d) {
            array_push($total, $d->Total);
        }

        //berdasarkan poli
        $bypoli = DB::select('CALL erm_dasboard_03a_per_tgl(?,?,?)', [$awal_bulan,$this->get_date(), auth()->user()->unit]);
        $tgl = [];
        foreach ($bypoli as $d) {
            array_push($tgl, 'tanggal '.$d->tgl);
        }
        $jml = [];
        foreach ($bypoli as $d) {
            array_push($jml, $d->jml);
        }
        return view('dashboard.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'unit',
            'total',
            'now',
            'awal_bulan',
            'tgl',
            'jml',
            'mt_unit'
        ]));
    }
    public function ambil_grafik_all_poli(Request $request)
    {
        $ds = DB::select('CALL erm_dasboard_03_per_tgl(?,?,?)', [$request->awal,$request->akhir, '']);
        $unit = [];
        foreach ($ds as $d) {
            array_push($unit, $d->unit);
        }
        $total = [];
        foreach ($ds as $d) {
            array_push($total, $d->Total);
        }
        return view('dashboard.grafik_semua_poli', compact([
            'unit',
            'total',
        ]));
    }
    public function ambil_grafik_by_poli(Request $request)
    {
        $ds = DB::select('CALL erm_dasboard_03a_per_tgl(?,?,?)', [$request->awal,$request->akhir,$request->poli]);
        $tgl = [];
        foreach ($ds as $d) {
            array_push($tgl, 'tanggal '.$d->tgl);
        }
        $jml = [];
        foreach ($ds as $d) {
            array_push($jml, $d->jml);
        }
        return view('dashboard.grafik_by_poli', compact([
            'tgl',
            'jml',
        ]));
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
}
