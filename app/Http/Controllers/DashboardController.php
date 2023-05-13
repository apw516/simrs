<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VclaimModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'SIMRS - DASHBOARD SIMRS';
        $sidebar = '1';
        $sidebar_m = '1.1';
        $query = DB::select('SELECT
        COUNT(a.kode_kunjungan) AS total_kunjungan
        ,COUNT(IF( a.kode_penjamin = ?, a.kode_penjamin, NULL)) AS Pasien_Umum
        ,COUNT(IF( a.kode_penjamin != ?, a.kode_penjamin, NULL)) AS Pasien_BPJS
        ,COUNT(IF( b.`jenis_kelamin` = ?, b.`jenis_kelamin`, NULL)) AS Pasien_pria
        ,COUNT(IF( b.`jenis_kelamin` = ?, b.`jenis_kelamin`, NULL)) AS Pasien_perempuan
        ,COUNT(IF( fc_umur(b.no_rm) <= ?, b.`no_rm`, NULL)) AS pasien_bayi
        ,COUNT(IF( fc_umur(b.no_rm) > ? && fc_umur(b.no_rm) <= ? , b.`no_rm`, NULL)) AS pasien_anak
        ,COUNT(IF( fc_umur(b.no_rm) > ?, b.`no_rm`, NULL)) AS pasien_dewasa
        ,COUNT(IF( a.counter = ?,a.counter, NULL)) AS pasien_baru
        ,COUNT(IF( a.counter > ?,a.counter, NULL)) AS pasien_lama
        FROM ts_kunjungan a INNER JOIN mt_pasien b ON a.`no_rm` = b.no_rm
        WHERE YEAR(a.tgl_masuk) = ?
        AND MONTH(a.tgl_masuk) = ?
        AND status_kunjungan = ?
        ', [
            'P01', 'P01', 'L', 'P', 1, 1, 17, 17, 1, 1, 2023, 04, 1
        ]);
        // dd($query);
        return view('dashboard.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'query'
        ]));
    }
}
