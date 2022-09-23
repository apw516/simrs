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


class RanapController extends Controller
{
    public function index()
    {
        $oneweek = (Carbon::now()->subWeek(1)->toDateString());
        $now = (Carbon::now()->toDateString());
        $user = auth()->user()->unit;        
        $title = 'SIMRS -SEP RAWAT INAP';
        $sidebar = 'RANAP';
        $sidebar_m = 'SEP RANAP';
        return view('ranap.datasep', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'datapasien' => DB::select('SELECT no_rm,no_sep,fc_nama_px(no_rm) AS nama ,tgl_masuk,tgl_keluar,fc_nama_unit1(kode_unit) AS unit,kamar,no_bed FROM ts_kunjungan WHERE kode_unit = ? AND tgl_masuk BETWEEN ? AND ?', [$user,$oneweek,$now])
        ]);
    }
}