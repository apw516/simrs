<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function generatePDF()
    {
        // Example data to pass to the view
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', ['14746881']);
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', ['22606292']);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select * from assesmen_dokters where id_kunjungan = ?', ['22606292']);
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
            'data',
            'mt_pasien',
            'ts_kunjungan',
            'assesmen',
            'tindakan',
            'farmasi',
            'penunjang',
            'orderfarmasi',
            'order_penunjang'
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
    public function cetakresumedokterblank($kodekunjungan)
    {
        // Example data to pass to the view
        $kodekunjungan = $kodekunjungan;
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select *,date(tgl_pemeriksaan) as tglk2 ,versi as versidk from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
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
        $today = Carbon::now()->isoFormat('D MMMM Y');
        if (count($assesmen) > 0) {
            $tglll =  $assesmen[0]->tglk2;
            $carbonDate = Carbon::parse($tglll);
            $tglperiksa = $carbonDate->isoFormat('dddd, D MMMM Y');
        } else {
            $tglperiksa = Carbon::now()->isoFormat('dddd, D MMMM Y');
        }
        $cek2 = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_code = ?', [$kodekunjungan, 200]);
        $hitung = count($cek2);
        $cetakanke = $hitung + 1;
        if (strlen($ts_kunjungan[0]->kode_paramedis) < 2) {
            $kode_par = $ts_kunjungan[0]->ref_paramedis;
            if (count($assesmen) > 0) {
                $pic = $assesmen[0]->pic;
                $user = db::select('select * from user a where a.id = ?', [$pic]);
                $kode_par = $user[0]->kode_paramedis;
            } else {
                $kode_par = '';
            }
        } else {
            $kode_par = $ts_kunjungan[0]->kode_paramedis;
        }
        $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [$kode_par]);
        $pdf = Pdf::loadView('pdf.document_blank', compact([
            'data',
            'tglperiksa',
            'mt_pasien',
            'ts_kunjungan',
            'assesmen',
            'tindakan',
            'farmasi',
            'penunjang',
            'orderfarmasi',
            'order_penunjang',
            'mt_paramedis',
            'today',
            'cetakanke'
        ]));
        return $pdf->download('document.pdf');
        return $pdf->stream('document.pdf');

        // $pdf->set_option("isPhpEnabled", true);
        // $pdf->setPaper('Letter', 'portrait');
        // $d = $pdf->output();
        // $name = $kodekunjungan . '.pdf';
        // $pdf->save(Storage::disk('shared', $name)->put($name, $d));
    }
    public function cetakresumeblank_perawat($kodekunjungan)
    {
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', ['14746881']);
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', ['22606292']);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select *,date(tanggalperiksa) as tglk2  from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$kodekunjungan]);
        $today = Carbon::now()->isoFormat('D MMMM Y');
        if (count($assesmen) > 0) {
            $tglll =  $assesmen[0]->tglk2;
            $carbonDate = Carbon::parse($tglll);
            $tglperiksa = $carbonDate->isoFormat('dddd, D MMMM Y');
        } else {
            $tglperiksa = Carbon::now()->isoFormat('dddd, D MMMM Y');
        }
        $pdf = Pdf::loadView('pdf.document_blank_perawat', compact([
            'mt_pasien',
            'ts_kunjungan',
            'tglperiksa',
            'assesmen'
        ]));
        return $pdf->download('document.pdf');
        return $pdf->stream('document.pdf');
    }
}
