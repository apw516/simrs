<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
    Public function generatePDF()
    {
        // Example data to pass to the view
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?',['14746881']);
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?',['22606292']);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.',$mt_pasien];
        $assesmen = db::select('select * from assesmen_dokters where id_kunjungan = ?',['22606292']);
        $kodekunjungan = '22606292';

           $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.kode_kunjungan = ?", [$kodekunjungan]);

        $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.kode_kunjungan = ?", [$kodekunjungan]);

        $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`,b.kode_unit
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.kode_kunjungan = ?", [$kodekunjungan]);

              $orderfarmasi = db::select('SELECT kode_barang,aturan_pakai,jumlah_layanan FROM ts_layanan_header_order a INNER JOIN ts_layanan_detail_order b ON a.id = b.row_id_header WHERE a.kode_kunjungan = ? and  kode_unit > ?', [$kodekunjungan, '4000']);

        $order_penunjang = db::select('SELECT fc_nama_unit1(a.`kode_unit`)AS nama_unit,a.kode_unit,SUBSTR(kode_tarif_detail,1,6) AS kode_tarif_header,c.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_header c ON SUBSTR(b.kode_tarif_detail,1,6) = c.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND a.`kode_unit` < ?', [$kodekunjungan, '4000']);

        // Load a Blade view to be converted to PDF
        $pdf = Pdf::loadView('pdf.document', compact([
            'data','mt_pasien','ts_kunjungan','assesmen','tindakan','farmasi','penunjang','orderfarmasi','order_penunjang'
        ]));

        // Stream the PDF to the browser
        return $pdf->download('document.pdf');
        return $pdf->stream('document.pdf');
        // return view('pdf.document',compact([
        //     'data'
        // ]));

        // Or download the PDF

        // Or save the PDF to a file
        // $pdf->save(storage_path('app/public/document.pdf'));
    }
}
