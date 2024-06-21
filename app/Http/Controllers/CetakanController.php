<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;

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
    public function cetakanassdok(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        return view('cetakanerm.urlcetakanassdok',compact('kodekunjungan'));
    }
    public function pdfcetakanasskep($kodekunjungan)
    {

        $kunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?',[$kodekunjungan]);
        $mt_pasien = DB::select('select *,date(tgl_lahir) as tanggal_lahir from mt_pasien where no_rm = ?',[$kunjungan[0]->no_rm]);
        $asskep = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?',[$kodekunjungan]);
        if($kunjungan[0]->kode_unit == '1028'){
            $tindkan = db::select("SELECT fc_nama_unit1(a.`kode_unit`) AS nama_unit,a.`kode_kunjungan`,b.`jumlah_layanan`,a.kode_unit,b.`kode_tarif_detail`,d.`NAMA_TARIF` FROM ts_layanan_header a
            INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
            INNER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL`
            INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
            WHERE a.kode_kunjungan = '$kodekunjungan'
            AND a.kode_unit IN ('3010','3009')
            AND a.status_layanan != 3");
        }else{
            $tindkan = [];
        }
        $pdf = PDF::loadview('cetakanerm.previewasskep',compact(['asskep','kunjungan','mt_pasien','tindkan']));
        // $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('assesmen_keperawatan_rawat_jalan-pdf');
    }
    public function pdfcetakanassdok($kodekunjungan)
    {
        $kunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?',[$kodekunjungan]);
        $mt_pasien = DB::select('select *,date(tgl_lahir) as tanggal_lahir from mt_pasien where no_rm = ?',[$kunjungan[0]->no_rm]);
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?',[$kodekunjungan]);
        $data_obat = DB::select("SELECT a.`kode_kunjungan`,b.`kode_barang`,c.`nama_barang`,b.`jumlah_layanan`,b.`aturan_pakai` FROM ts_layanan_header a
        INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
        INNER JOIN mt_barang c ON b.`kode_barang` = c.`kode_barang`
        WHERE a.kode_kunjungan = '$kodekunjungan'
        AND a.kode_unit IN ('4002','4003','4004','4005','4006','4007','4008','4009','4010','4011','4012','4013')
        AND a.status_layanan != 3 AND b.kode_barang != ''");

        $data_penunjang = DB::select("SELECT fc_nama_unit1(a.`kode_unit`) AS nama_unit,a.`kode_kunjungan`,b.`jumlah_layanan`,a.kode_unit,b.`kode_tarif_detail`,d.`NAMA_TARIF` FROM ts_layanan_header a
        INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.kode_kunjungan = '$kodekunjungan'
        AND a.kode_unit IN ('3003','3002')
        AND a.status_layanan != 3");
        $pdf = PDF::loadview('cetakanerm.previewassdok',compact(['assdok','kunjungan','mt_pasien','data_obat','data_penunjang']));
        // $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('assesmen_medis_rawat_jalan-pdf');
    }
}
