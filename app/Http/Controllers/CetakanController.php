<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CetakanController extends Controller
{
    public function index()
    {
        $kunjungan = DB::select('select * from ts_kunjungan where no_rm = 17833869');
        return view('cetakanerm.preview',compact([
            'kunjungan'
        ]));
    }
    public function cetakanerm()
    {
        $kunjungan = DB::select('select * from ts_kunjungan where no_rm = 17833869');
        $pdf = PDF::loadview('cetakanerm.preview',compact(['kunjungan']));
        // $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('catatan_perkembangan_pasien-pdf');
    }
    public function cetakanasskep(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        return view('cetakanerm.urlcetakanasskep',compact('kodekunjungan'));
    }
    public function pdfcetakanasskep($kodekunjungan)
    {
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?',[$kodekunjungan]);
        $mt_pasien = DB::select('select *,date(tgl_lahir) as tanggal_lahir from mt_pasien where no_rm = ?',[$kunjungan[0]->no_rm]);
        $asskep = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?',[$kodekunjungan]);
        $pdf = PDF::loadview('cetakanerm.previewasskep',compact(['asskep','kunjungan','mt_pasien']));
        // $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('assesmen_keperawatan_rawat_jalan-pdf');
    }
    public function cetakanassdok()
    {

    }
}
