<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    public function index()
    {

        $title = 'SIMRS - BERKAS RESEP';
        $sidebar = 'berkas_erm';
        $sidebar_m = 'berkas_eresep';
        return view('Reporting.index_eresep', compact([
            'title',
            'sidebar',
            'sidebar_m',
        ]));
    }
    public function ambilDataEresep(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // $header = DB::connection('mysql')->select('SELECT a.kode_kunjungan, a.tgl_entry
        // ,fc_NAMA_PARAMEDIS1(a.dok_kirim) as nama_dokter
        // ,fc_nama_unit1(a.kode_unit) as nama_unit
        // ,fc_nama_unit1(a.unit_pengirim) as nama_unit_pengirim
        // ,a.kode_unit
        // ,a.unit_pengirim
        // ,a.dok_kirim
        // ,a.diagnosa FROM ts_layanan_header_order a
        // LEFT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        // WHERE MONTH(a.tgl_entry) = ?
        // AND YEAR(a.tgl_entry) = ?
        // AND a.kode_unit IN (?,?)', [$bulan, $tahun, 4002, 4008]);


        // $Layani = DB::connection('mysql')->select('SELECT *,fc_nama_barang(b.`kode_barang`) AS namabarang
        // FROM ts_layanan_header a
        // LEFT OUTER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
        // WHERE MONTH(a.`tgl_entry`) = ? AND YEAR(a.`tgl_entry`) = ?
        // AND a.kode_unit IN (?,?) AND b.`kode_barang` != ?', [$bulan, $tahun, 4002, 4008,'']);

        // $Order = DB::connection('mysql')->select('SELECT * FROM ts_layanan_header_order a
        // LEFT OUTER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        // WHERE MONTH(a.`tgl_entry`) = ? AND YEAR(a.`tgl_entry`) = ?
        // AND a.kode_unit IN (?,?)', [$bulan, $tahun, 4002, 4008]);

        $resep = DB::connection('mysql')->select('SELECT a.`kode_kunjungan`,c.`kode_kunjungan`,a.`tgl_entry`,b.`kode_barang`,fc_nama_barang(d.`kode_barang`) AS nama_barang_layani,e.`nama_generik`
        FROM ts_layanan_header_order a
        LEFT OUTER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        LEFT OUTER JOIN ts_layanan_header c ON a.`kode_kunjungan` = c.`kode_kunjungan`
        LEFT OUTER JOIN ts_layanan_detail d ON c.`id` = d.`row_id_header`
        LEFT OUTER JOIN mt_barang e ON d.`kode_barang` = e.`kode_barang`
        WHERE MONTH(a.tgl_entry) = ? AND YEAR(a.tgl_entry) AND a.`kode_unit` IN (?,?)
        AND d.`kode_barang` != ?', [$bulan, $tahun, 4002, 4008,'']);
        dd($resep);

        return view('Reporting.view_reporing_resep',compact([
            'header','Layani','Order'
        ]));
    }
}
