<?php

namespace App\Http\Controllers;

use App\Models\ts_kunjungan;
use App\Models\ts_sep;
use App\Models\VclaimModel;
use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function cetaksep($sep)
    {
        $v = new VclaimModel();
        $sep = $v->carisep($sep);
        $peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
        $now = $this->get_now();
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $pdf = Pdf::loadView('pdf.cetakansep2', compact([
            'sep',
            'qrcode',
            'now',
            'peserta'
        ]));
        $pdf->set_paper(array(0, 0, 600, 300), 'portrait');
        return $pdf->stream('document.pdf');
    }
    public function cetaksep22($sep)
    {
        $v = new VclaimModel();
        $sep = $v->carisep($sep);
        $peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
        // $qr = QrCode::format('png')->generate('2312');
        // $qrImageName = $sep . '.png';
        // Storage::put('public/qr/' . $qrImageName, $qr);
        $now = $this->get_now();
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $pdf = Pdf::loadView('pdf.cetakansep2', compact([
            'sep',
            'qrcode',
            'now',
            'peserta'
        ]));

        $pdf->set_paper(array(0, 0, 420, 300), 'portrait');

        // $width_cm = 21; // 10 cm width
        // $height_cm = 14; // 15 cm height

        // $width_points = $width_cm * (72 / 2.54);
        // $height_points = $height_cm * (72 / 2.54);

        // $customPaper = [0, 0, $width_points, $height_points];
        // $pdf->setPaper($customPaper, 'portrait'); // Or 'landscape'
        return $pdf->stream('document.pdf');
    }
    public function cetaksep2($kodekunjungan)
    {
        $kj = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $sep = $kj['0']->no_sep;
        $v = new VclaimModel();
        $sep = $v->carisep($sep);
        $peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
        // $qr = QrCode::format('png')->generate('2312');
        // $qrImageName = $sep . '.png';
        // Storage::put('public/qr/' . $qrImageName, $qr);
        $now = $this->get_now();
        $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate('string'));
        $pdf = Pdf::loadView('pdf.cetakansep2', compact([
            'sep',
            'qrcode',
            'now',
            'peserta'
        ]));

        // $width_cm = 21; // 10 cm width
        // $height_cm = 14; // 15 cm height

        // $width_points = $width_cm * (72 / 2.54);
        // $height_points = $height_cm * (72 / 2.54);

        // $customPaper = [0, 0, $width_points, $height_points];
        // $pdf->setPaper($customPaper, 'portrait'); // Or 'landscape'
        return $pdf->stream('document.pdf');
    }
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
            $tglll =  $assesmen[0]->tgl_kunjungan;
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
        return $pdf->stream('document.pdf');

        // $pdf->set_option("isPhpEnabled", true);
        // $pdf->setPaper('Letter', 'portrait');
        // $d = $pdf->output();
        // $name = $kodekunjungan . '.pdf';
        // $pdf->save(Storage::disk('shared', $name)->put($name, $d));
    }
    public function cetakcppt($idheader)
    {
        $kode_kunjungan = $idheader;

        $header = db::select('SELECT (a.id) AS idasskep ,a.kode_kunjungan,a.no_rm, fc_NAMA_UNIT1(a.kode_unit) AS NAMAUNIT
        ,a.kode_unit,a.tanggalkunjungan
        ,a.sumberdataperiksa,keluhanutama,tekanandarah,frekuensinadi,frekuensinapas,a.imt,a.tinggibadan
        ,a.beratbadan,a.suhutubuh,a.umur,a.diagnosakeperawatan,a.rencanakeperawatan,a.tindakankeperawatan,a.evaluasikeperawatan,a.namapemeriksa ,b.* 
        FROM ts_kunjungan c 
        LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal a ON a.`kode_kunjungan` = c.`kode_kunjungan`
        LEFT OUTER JOIN assesmen_dokters b ON c.kode_kunjungan = b.id_kunjungan WHERE c.kode_kunjungan = ?', [$kode_kunjungan]);

        $no_rm = $header[0]->no_rm;

        $cppt = DB::connection('mysql')->select('SELECT *,a.id AS idasskep,b.versi AS versidk,DATE(c.tgl_masuk) AS tglk,a.kode_unit AS unitpoli ,fc_nama_unit1(a.kode_unit) AS nama_unit ,c.kode_kunjungan,a. kode_kunjungan as kode_kunjungan_asskep,b.id_kunjungan as kode_kunjungan_assdok
        FROM ts_kunjungan c LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal a ON c.kode_kunjungan = a.`kode_kunjungan`
        LEFT OUTER JOIN assesmen_dokters b ON a.kode_kunjungan = b.id_kunjungan
        WHERE a.no_rm = ? AND c.status_kunjungan != 8 AND a.jenis_berkas = ? ORDER  BY c.kode_kunjungan DESC', [$no_rm, 0]);

        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$no_rm]);
        $datakonsul = db::select('select *,fc_nama_unit1(unit_pengirim) as poli_pengirim,fc_nama_unit1(unit_tujuan) as poli_konsul,fc_nama_paramedis1(dokter_penerima) as dokter_penerima_2 from ts_konsul_antar_poli where no_rm = ?', [$no_rm]);
        $tindakan = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 1
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$no_rm]);
        $farmasi = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`nama_barang`,C.`jumlah_layanan`,C.`aturan_pakai`
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_barang d ON c.`kode_barang` = d.`kode_barang`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 4
            AND a.no_rm = ?", [$no_rm]);
        $penunjang = db::select("SELECT a.`kode_kunjungan`,fc_nama_unit1(b.`kode_unit`) AS nama_unit
            ,c.`kode_tarif_detail`,d.`NAMA_TARIF`,b.kode_unit
            FROM ts_kunjungan a
            INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
            INNER JOIN ts_layanan_detail c ON b.`id` = c.`row_id_header`
            INNER JOIN mt_tarif_header d ON SUBSTR(c.`kode_tarif_detail`,1,6) = d.`KODE_TARIF_HEADER`
            WHERE SUBSTR(b.`kode_unit`,1,1) = 3
            AND c.`kode_tarif_detail` NOT IN ('TX06733','TX23543','TX03413','TX25573','TX23803','TX50683','TX46883')
            AND a.no_rm = ?", [$no_rm]);
        $orderfarmasi = db::select('SELECT kode_kunjungan,a.keterangan as keteranganresep,kode_barang,aturan_pakai,jumlah_layanan FROM ts_layanan_header_order a INNER JOIN ts_layanan_detail_order b ON a.id = b.row_id_header WHERE a.no_rm = ? and  kode_unit > ?', [$no_rm, '4000']);
        $dompdf = Pdf::loadView('pdf.cetakan_cppt', compact([
            'mt_pasien',
            'header',
            'datakonsul',
            'tindakan',
            'farmasi',
            'orderfarmasi',
            'penunjang',
            'cppt'
        ]));
        $dompdf->setPaper('A4', 'portrait'); // 'A4' for paper size, 'portrait' or 'landscape' for orientation
        $dompdf->set_option("isPhpEnabled", true);
        // Render the HTML as PDF
        $dompdf->render();
        $namaberkas = 'CPPT_' . $mt_pasien[0]->nama_px;
        return $dompdf->download($namaberkas . '.pdf');
        // Output the generated PDF to Browser
        return $dompdf->stream($namaberkas . ".pdf", array("Attachment" => false));
    }
    public function cetakresumeblank_perawat($kodekunjungan)
    {
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select *,date(tanggalperiksa) as tglk2  from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$kodekunjungan]);
        $today = Carbon::now()->isoFormat('D MMMM Y');
        if (count($assesmen) > 0) {
            $tglll =  $assesmen[0]->tanggalkunjungan;
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
    public function cetaklaporanoperasi($kodekunjungan)
    {
        $data = db::select('select * from laporan_operasi_poli_mata where kode_kunjungan = ?', [$kodekunjungan]);
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        if (count($data) > 0) {
            $user = db::select('select * from user where id = ?', [$data[0]->pic]);
            $username = $user[0]->nama;
        } else {
            $username = '';
        }
        $kode_unit = $ts_kunjungan[0]->kode_unit;
        $dompdf = Pdf::loadView('pdf.laporan_operasi', compact([
            'data',
            'mt_pasien',
            'username',
            'kode_unit'
        ]));
        $dompdf->setPaper('A4', 'portrait'); // 'A4' for paper size, 'portrait' or 'landscape' for orientation

        // Render the HTML as PDF
        $dompdf->render();
        $namaberkas = 'LAPORAN_OPERASI_' . $mt_pasien[0]->nama_px;
        // return $dompdf->download($namaberkas . '.pdf');
        // Output the generated PDF to Browser
        return $dompdf->stream($namaberkas . ".pdf", array("Attachment" => false));
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function cetaksuratpengantar($id)
    {
        $cek = db::select('select *,fc_NAMA_UNIT1(unit_tujuan) as namaunittujuan,fc_NAMA_UNIT1(unit_asal) as unitasal from mt_surat_tindak_lanjut where id = ?', [$id]);
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$cek[0]->kode_kunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        if ($cek[0]->jenis_surat == 'SURAT KONSUL') {
            $dompdf = Pdf::loadView('pdf.cetakan_surat_konsul', compact([
                'cek',
                'mt_pasien',
                'ts_kunjungan'
            ]));
        } else {
            $dompdf = Pdf::loadView('pdf.cetakan_surat_rujin', compact([
                'cek',
                'mt_pasien',
                'ts_kunjungan'
            ]));
        }
        $dompdf->setPaper('A4', 'portrait'); // 'A4' for paper size, 'portrait' or 'landscape' for orientation

        // Render the HTML as PDF
        $dompdf->render();
        $namaberkas = 'surat';
        // Output the generated PDF to Browser
        return $dompdf->stream($namaberkas . ".pdf", array("Attachment" => false));
    }
    public function cetakcatatanhemodialisa($id)
    {
        $header = db::table('ts_header_catatan_hemodialisis')->where('id',$id)->get()->first();
        $rm = $header->no_rm;
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$rm]);

        // dd($rm);
        // if(!!$request->jenis){
            $jenis = 1;
        // }else{
        //     $jenis = 0;
        // }
        $kode_kunjungan = $header->kode_kunjungan;
        $datah = db::select('select * from ts_header_catatan_hemodialisis where id = ? ORDER BY id DESC', [$id]);
        // Ambil semua ID header terlebih dahulu
        $ids = collect($datah)->pluck('id')->toArray();
        // dd($datah);
        if (!empty($ids)) {
            // Gunakan WHERE IN untuk mengambil semua data sekaligus
            $placeholder = implode(',', array_fill(0, count($ids), '?'));
            $arrayBaru = db::select("select * from ts_catatan_pre_hemodialisa where idheader IN ($placeholder) and jenis = 1 ORDER BY id asc", $ids);
            $arrayBaru2 = db::select("select * from ts_catatan_pre_hemodialisa where idheader IN ($placeholder) and jenis = 2 ORDER BY id asc", $ids);
            $arrayBaru3 = db::select("select * from ts_catatan_pre_hemodialisa where idheader IN ($placeholder) and jenis = 3 ORDER BY id asc", $ids);
            $arrayBaru4 = db::select("select * from ts_catatan_penyulit_hemodialisa where idheader IN ($placeholder) ORDER BY id asc", $ids);
        } else {
            $arrayBaru = [];
            $arrayBaru2 = [];
            $arrayBaru3 = [];
            $arrayBaru4 = [];
        }
        $dompdf = Pdf::loadView('pdf.catatan_hemodialisa', compact([
           'mt_pasien','header','datah','arrayBaru','arrayBaru2','arrayBaru3','arrayBaru4','jenis'
        ]));
        $dompdf->setPaper('A4', 'portrait'); // 'A4' for paper size, 'portrait' or 'landscape' for orientation
        // Render the HTML as PDF
        $dompdf->render();
        $namaberkas = 'HD ';
        return $dompdf->stream($namaberkas. $mt_pasien[0]->nama_px . ".pdf", array("Attachment" => false));
    }
}
