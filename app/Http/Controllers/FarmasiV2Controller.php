<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class FarmasiV2Controller extends Controller
{
    public function indexlayanan()
    {
        $title = 'SIMRS - Farmasi';
        $menu = 'layananfarmasi';
        $sidebar = 'layananfarmasi';
        $sidebar_m = '2';
        return view('v2_farmasi.indexlayanan',compact([
            'title','menu','sidebar','sidebar_m'
        ]));
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function index_data_pemakaian()
    {
        $title = 'Data Pemakaian Obat';
        $sidebar = 'datapemakaianobat';
        $sidebar_m = 'datapemakaianobat';
        $now = $this->get_date();
        $mt_unit = db::select('select * from mt_unit where LEFT(kode_unit,2) = 10 or left(kode_unit,2) = 40');
        return view('v2_farmasi.index_data_pemakaian_obat', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'mt_unit'
        ]));
    }
    public function ambil_data_pemakaian(Request $request)
    {
        $tglawal = $request->awal;
        $tglakhir = $request->akhir;
        $unit = $request->unit;
        return view('v2_farmasi.datapemakaian', compact([
            'tglawal',
            'tglakhir',
            'unit',
        ]));
    }
    public function Cetak_Data_pemakaian($tglawal, $tglakhir, $unit)
    {
        $data_kunjungan = db::SELECT("select kode_kunjungan,no_rm,fc_nama_px(no_rm) as nama_pasien,fc_nama_unit1(kode_unit) as nama_unit,no_sep from ts_kunjungan where date(tgl_masuk) between '$tglawal' and '$tglakhir' AND kode_unit < 2000 AND kode_unit != '1002'");
        // $order = db::select("select * from ts_layanan_header_order a
        // left outer join ts_layanan_detail_order b on a.id = b.row_id_header
        // where date(tgl_entry) between '$tglawal' and '$tglakhir' AND a.kode_unit = '$unit'");

        // $resep = db::select("select * from ts_layanan_header a
        // left outer join ts_layanan_detail b on a.id = b.row_id_header
        // inner join mt_barang c on b.kode_barang  = c.kode_barang
        // where date(a.tgl_entry) between '$tglawal' and '$tglakhir' and a.kode_unit = '$unit'");
        $pdf = PDF::loadview('v2_farmasi.pdatapemakaian',compact([
            'data_kunjungan',
            // 'order',
            // 'resep',
        ]));
        // $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('assesmen_keperawatan_rawat_jalan-pdf');
    }
}
