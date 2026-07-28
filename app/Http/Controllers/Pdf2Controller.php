<?php

namespace App\Http\Controllers;

use App\Models\assesmenawaldokter;
use App\Models\Model_log_tte;
use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ModelBSRE;
use App\Models\ts_layanan_header_order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Net\SFTP;

class Pdf2Controller extends Controller
{
    public function tandatangancatatanhd(Request $request)
    {
        DB::beginTransaction();
        $kodekunjungan = $request->kode;

        $header = db::table('ts_header_catatan_hemodialisis')->where('kode_kunjungan', $kodekunjungan)->get()->first();
        $rm = $header->no_rm;
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$rm]);

        // dd($rm);
        // if(!!$request->jenis){
        $jenis = 1;
        // }else{
        //     $jenis = 0;
        // }
        $kode_kunjungan = $header->kode_kunjungan;
        $datah = db::select('select * from ts_header_catatan_hemodialisis where kode_kunjungan = ? ORDER BY id DESC', [$kodekunjungan]);
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
        $cek2 = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_code = ? and jenis_dokumen = ?', [$kodekunjungan, 200, 'CATATAN HD']);
        $hitung = count($cek2);
        $cetakanke = $hitung + 1;
        $pdf = Pdf::loadView('pdf.catatan_hemodialisa', compact([
            'mt_pasien',
            'header',
            'datah',
            'arrayBaru',
            'arrayBaru2',
            'arrayBaru3',
            'arrayBaru4',
            'jenis'
        ]));
        $pdf->set_option("isPhpEnabled", true);
        $pdf->setPaper('Letter', 'portrait');
        $d = $pdf->output();
        $name = 'CATATAN_HD_' . $kodekunjungan . '.pdf';
        $pdf->save(Storage::disk('shared', $name)->put($name, $d));
        $search_criteria = [
            'kode_kunjungan' => $kodekunjungan,
            'jenis_dokumen'  => 'CATATAN HD'
        ];

        $save_report = [
            'status' => 0
            // Anda bisa menambahkan field lain di sini yang nilainya ingin di-update
        ];

        // Jika kombinasi kode_kunjungan & jenis_dokumen ADA -> Update status menjadi 0
        // Jika TIDAK ADA -> Buat data baru dengan semua field di atas
        $idreport = Model_log_tte::updateOrCreate($search_criteria, $save_report);
        $nik = auth()->user()->nik;
        // $nik = '3209330506940001';
        $password = trim(auth()->user()->password_tte);
        // $password = 'Kinan221122!!!';

        $data2 = [
            'nik' => $nik,
            'passphrase' => $password,
            'tampilan' => 'visible',
            'halaman' => '',
            'page' => '',
            'image' => 'false',
            'linkQR' => "https://siramah.rsudwaled.com/filetandatangan?id=" . $idreport->id,
            'width' => '80',
            'height' => '60',
            'reason' => '',
            'location' => 'Tanda Tangan',
            'text' => '',
            'tag_koordinat' => '#',
        ];
        $v = new ModelBSRE();
        $DD = $v->send_pdf_kosong2($data2, $kodekunjungan);
        if ($DD['code'] == 200) {
            $id_dokumen = $DD['messagee'];
            $name2 = $id_dokumen . '.pdf';
            $DD2 = $v->downloadpdf($id_dokumen, $kodekunjungan);
            $urlfile = '\\\\192.168.2.14\\erm\\resume_medis_rawat_jalan/';
            $cek = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status = 1 and jenis_dokumen = ?', [$kodekunjungan, 'CATATAN HD']);
            if (count($cek) > 0) {
                Model_log_tte::whereRaw('id = ?', $cek[0]->id)->update(['status_file' => 0, 'status' => 2]);
            }
            $save_report = [
                'status_code' => $DD['code'],
                'response' => $DD['messagee'],
                'kode_kunjungan' => $kodekunjungan,
                'tgl_kirim' => $this->get_now(),
                'file' => $urlfile . $name2,
                'cetakan_ke' => $cetakanke,
                'status_file' => 1,
                'status' => 1
            ];
            Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
            $kinan = $this->verifikasi_berkas2($idreport->id);
            // $kinan2 = Model_log_tte::create($save_report);
            $datawebsiramah = [
                'id_dokumen' => $idreport->id,
                'nama_user' => auth()->user()->nama,
                'tanggal_verifikasi' => $this->get_now(),
                'jabatan' => "Perawat",
            ];
            $DD = $v->sendpdftosiramah($datawebsiramah);
            DB::commit();
            $data1 = [
                'kode' => 200,
                'message' => 'Berkas berhasil ditanda tangan !',
                'id' => $id_dokumen
            ];
            return $data1;
        } else {
            $save_report = [
                'status_code' => $DD['code'],
                'response' => $DD['messagee'],
                'kode_kunjungan' => $kodekunjungan,
                'tgl_kirim' => $this->get_now(),
                'status_file' => 0,
                'status' => 3
            ];
            Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
            DB::commit();
            $data = [
                'kode' => 500,
                'message' => 'Berkas gagal ditanda tangan ! ' . $DD['messagee']
            ];
            return $data;
        }
    }
    public function simpanttddokter(Request $request)
    {
        $data = [
            // 'tanggalassemen' => $this->get_now(),
            'status' => '1',
            'signature' => 'SUDAH VALIDASI'
        ];
        $data2 = [
            // 'tanggalassemen' => $this->get_now(),
            'status_order' => '1',
        ];
        assesmenawaldokter::whereRaw('id_kunjungan = ?', array($request->kodekunjungan))->update($data);
        ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_order = ?', array($request->kodekunjungan, 0))->update($data2);
        // if (auth()->user()->persetujuan_simpan == 1) {
        //     $send = $this->sendtte($request->kodekunjungan);
        // }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function sendtte($kodekunjungan)
    {
        DB::beginTransaction();
        try {
            $nik = auth()->user()->nik;
            $password = auth()->user()->password_tte;
            // $nik = '1234567890123452';
            // $nik='';
            // $password = 'Bsre2025.#!';
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
            $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [auth()->user()->kode_paramedis]);
            $pdf = Pdf::loadView('pdf.document', compact([
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
            $pdf->set_option("isPhpEnabled", true);
            $pdf->setPaper('Letter', 'portrait');
            $d = $pdf->output();
            $name = $kodekunjungan . '.pdf';
            $pdf->save(Storage::disk('shared', $name)->put($name, $d));
            $save_report = [
                'kode_kunjungan' => $kodekunjungan,
                'status' => 0
            ];
            $idreport = Model_log_tte::create($save_report);
            $data2 = [
                'nik' => $nik,
                'passphrase' => $password,
                'tampilan' => 'visible',
                'halaman' => '',
                'page' => '',
                'image' => 'false',
                'linkQR' => "https://siramah.rsudwaled.com/filetandatangan?id=" . $idreport->id,
                'width' => '80',
                'height' => '60',
                'reason' => '',
                'location' => 'Tanda Tangan',
                'text' => '',
                'tag_koordinat' => '#',
            ];
            $v = new ModelBSRE();
            $DD = $v->send_pdf_kosong($data2, $kodekunjungan);
            if ($DD['code'] == 200) {
                $id_dokumen = $DD['messagee'];
                $name2 = $id_dokumen . '.pdf';
                $DD2 = $v->downloadpdf($id_dokumen, $kodekunjungan);
                $urlfile = '\\\\192.168.2.14\\erm\\resume_medis_rawat_jalan/';
                $cek = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status = 1', [$kodekunjungan]);
                if (count($cek) > 0) {
                    Model_log_tte::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update(['status_file' => 0, 'status' => 2]);
                }
                $save_report = [
                    'status_code' => $DD['code'],
                    'response' => $DD['messagee'],
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_kirim' => $this->get_now(),
                    'file' => $urlfile . $name2,
                    'cetakan_ke' => $cetakanke,
                    'status_file' => 1,
                    'status' => 1
                ];
                Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
                $kinan = $this->verifikasi_berkas2($idreport->id);
                // $kinan2 = Model_log_tte::create($save_report);
                $datawebsiramah = [
                    'id_dokumen' => $idreport->id,
                    'nama_user' => auth()->user()->nama,
                    'tanggal_verifikasi' => $this->get_now(),
                    'jabatan' => "Dokter",
                ];
                $DD = $v->sendpdftosiramah($datawebsiramah);
                DB::commit();
                $data1 = [
                    'kode' => 200,
                    'message' => 'Berkas berhasil ditanda tangan !',
                    'id' => $id_dokumen
                ];
                return $data1;
            } else {
                $save_report = [
                    'status_code' => $DD['code'],
                    'response' => $DD['messagee'],
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_kirim' => $this->get_now(),
                    'status_file' => 0,
                    'status' => 3
                ];
                Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
                DB::commit();
                $data = [
                    'kode' => 500,
                    'message' => 'Berkas gagal ditanda tangan ! ' . $DD['messagee']
                ];
                return $data;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data2 = [
                'message' => 'gagal'
            ];
            return  $data;
        }
    }
    public function generatePDF()
    {
        // Example data to pass to the view
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', ['14746881']);
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', ['22606292']);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select *,versi as versidk from assesmen_dokters where id_kunjungan = ?', ['22606292']);
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
    public function simpanttddokter_bsre(Request $request)
    {
        // Example data to pass to the view
        $kodekunjungan = $request->kodekunjungan;
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
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
        // return $pdf->stream('document.pdf');
        // return view('pdf.document',compact([
        //     'data'
        // ]));

        // Or download the PDF

        // Or save the PDF to a file
        // $pdf->save(storage_path('app/public/document.pdf'));
    }
    public function generatePDF2($kodekunjungan)
    {
        // Example data to pass to the view
        $ts_kunjungan = db::select('select *,date(tgl_masuk) as tgl_msk ,fc_nama_paramedis1(kode_paramedis) as nama_dokter,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx,date(tgl_lahir) as tgl_lahirs from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $data = ['title' => 'My PDF Document', 'content' => 'This is some content for the PDF.', $mt_pasien];
        $assesmen = db::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
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
        $name = $kodekunjungan . '.pdf';
        $pdf->save(storage_path('app/downloaded_pdfs/' . $name));
        // Load a Blade view to be converted to PDF
        $data2 = [
            'nik' => '1234567890123452',
            'passphrase' => 'Bsre2025.#!',
            'tampilan' => 'visible',
            'halaman' => '',
            'page' => '',
            'image' => 'false',
            'linkQR' => 'https://drive.google.com/file/d/1sNftJQC7fxqKR87-pVaEzTvEiuKkku4U/view?usp=sharing',
            'width' => '80',
            'height' => '60',
            'reason' => '',
            'location' => 'Tanda Tangan',
            'text' => '',
            'tag_koordinat' => '#'
        ];
        $v = new ModelBSRE();
        $DD = $v->send_pdf_kosong($data2, $kodekunjungan);
        if ($DD['code'] == 200) {
            $id_dokumen = $DD['messagee'];
            $DD2 = $v->downloadpdf($id_dokumen, $kodekunjungan);
        }
        return response()->file(
            storage_path('app/downloaded_pdfs/' . $name)
        );
        // return $pdf->stream($kodekunjungan . 'pdf');
    }
    public function simpantandatanganbsre(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        // dd('ok');
        // $nik = auth()->user()->nip;
        // $password = auth()->user()->password_t;
        // $nik = '1234567890123452';
        // $nik = '3209330506940001';
        $nik = auth()->user()->nik;
        $password = trim(auth()->user()->password_tte);
        // $password = 'Bsre2025.#!';
        // $password = 'Kinan221122!!!';
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
        $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [auth()->user()->kode_paramedis]);
        $pdf = Pdf::loadView('pdf.document', compact([
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
        $pdf->set_option("isPhpEnabled", true);
        $pdf->setPaper('Letter', 'portrait');
        $d = $pdf->output();
        $name = $kodekunjungan . '.pdf';
        $pdf->save(Storage::disk('shared', $name)->put($name, $d));
        // $pdf->save(storage_path('app/downloaded_pdfs/' . $name));
        // $nik = '1234567890123452';
        // $password = 'Bsre2025.#!';
        $save_report = [
            'kode_kunjungan' => $kodekunjungan,
            'status' => 0
        ];
        $idreport = Model_log_tte::create($save_report);
        $data2 = [
            'nik' => $nik,
            'passphrase' => $password,
            'tampilan' => 'visible',
            'halaman' => '',
            'page' => '',
            'image' => 'false',
            'linkQR' => "https://siramah.rsudwaled.com/filetandatangan?id=" . $idreport->id,
            'width' => '80',
            'height' => '60',
            'reason' => '',
            'location' => 'Tanda Tangan',
            'text' => '',
            'tag_koordinat' => '#',
        ];
        $v = new ModelBSRE();
        // $DD = $v->cek_status_user($nik);
        // dd($DD);
        $DD = $v->send_pdf_kosong($data2, $kodekunjungan);
        if ($DD['code'] == 200) {
            $id_dokumen = $DD['messagee'];
            $name2 = $id_dokumen . '.pdf';
            $DD2 = $v->downloadpdf($id_dokumen, $kodekunjungan);
            $urlfile = '\\\\192.168.2.14\\erm\\resume_medis_rawat_jalan/';
            $cek = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status = 1', [$kodekunjungan]);
            if (count($cek) > 0) {
                Model_log_tte::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update(['status_file' => 0, 'status' => 2]);
            }
            $save_report = [
                'status_code' => $DD['code'],
                'response' => $DD['messagee'],
                'kode_kunjungan' => $kodekunjungan,
                'tgl_kirim' => $this->get_now(),
                'file' => $urlfile . $name2,
                'cetakan_ke' => $cetakanke,
                'status_file' => 1,
                'status' => 1
            ];
            Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
            $kinan = $this->verifikasi_berkas2($idreport->id);
            // $kinan2 = Model_log_tte::create($save_report);
            $datawebsiramah = [
                'id_dokumen' => $idreport->id,
                'nama_user' => auth()->user()->nama,
                'tanggal_verifikasi' => $this->get_now(),
                'jabatan' => "Dokter",
            ];
            $DD = $v->sendpdftosiramah($datawebsiramah);
            $data1 = [
                'kode' => 200,
                'message' => 'Berkas berhasil ditanda tangan !',
                'id' => $id_dokumen
            ];
            echo json_encode($data1);
            die;
        } else {
            $save_report = [
                'status_code' => $DD['code'],
                'response' => $DD['messagee'],
                'kode_kunjungan' => $kodekunjungan,
                'tgl_kirim' => $this->get_now(),
                'status_file' => 0,
                'status' => 3
            ];
            Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
            $data = [
                'kode' => 500,
                'message' => 'Berkas gagal ditanda tangan ! ' . $DD['messagee']
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpantandatanganbsre_manual(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $simpaninfo = $request->simpaninfo;
        if ($simpaninfo == 'on') {
            $simpan = '1';
        } else {
            $simpan = '0';
        }

        // dd('ok');
        // $nik = auth()->user()->nip;
        // $password = auth()->user()->password_t;
        // $nik = '1234567890123452';
        // $nik = '3209330506940001';
        $nik = $request->nik;
        $password = $request->password;
        // $password = 'Bsre2025.#!';
        // $password = 'Kinan221122!!!';
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
        $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [auth()->user()->kode_paramedis]);
        $pdf = Pdf::loadView('pdf.document', compact([
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
        $pdf->set_option("isPhpEnabled", true);
        $pdf->setPaper('Letter', 'portrait');
        $d = $pdf->output();
        $name = $kodekunjungan . '.pdf';
        $pdf->save(Storage::disk('shared', $name)->put($name, $d));
        // $pdf->save(storage_path('app/downloaded_pdfs/' . $name));
        // $nik = '1234567890123452';
        // $password = 'Bsre2025.#!';
        $save_report = [
            'kode_kunjungan' => $kodekunjungan,
            'status' => 0
        ];
        $idreport = Model_log_tte::create($save_report);
        $data2 = [
            'nik' => $nik,
            'passphrase' => $password,
            'tampilan' => 'visible',
            'halaman' => '',
            'page' => '',
            'image' => 'false',
            'linkQR' => "https://siramah.rsudwaled.com/filetandatangan?id=" . $idreport->id,
            'width' => '80',
            'height' => '60',
            'reason' => '',
            'location' => 'Tanda Tangan',
            'text' => '',
            'tag_koordinat' => '#',
        ];
        $v = new ModelBSRE();
        // $DD = $v->cek_status_user($nik);
        // dd($DD);
        $DD = $v->send_pdf_kosong($data2, $kodekunjungan);
        if ($DD['code'] == 200) {
            $id_dokumen = $DD['messagee'];
            $name2 = $id_dokumen . '.pdf';
            $DD2 = $v->downloadpdf($id_dokumen, $kodekunjungan);
            $urlfile = '\\\\192.168.2.14\\erm\\resume_medis_rawat_jalan/';
            $cek = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status = 1', [$kodekunjungan]);
            if (count($cek) > 0) {
                Model_log_tte::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update(['status_file' => 0, 'status' => 2]);
            }
            $save_report = [
                'status_code' => $DD['code'],
                'response' => $DD['messagee'],
                'kode_kunjungan' => $kodekunjungan,
                'tgl_kirim' => $this->get_now(),
                'file' => $urlfile . $name2,
                'cetakan_ke' => $cetakanke,
                'status_file' => 1,
                'status' => 1
            ];
            Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
            $kinan = $this->verifikasi_berkas2($idreport->id);
            // $kinan2 = Model_log_tte::create($save_report);
            $datawebsiramah = [
                'id_dokumen' => $idreport->id,
                'nama_user' => auth()->user()->nama,
                'tanggal_verifikasi' => $this->get_now(),
                'jabatan' => "Dokter",
            ];
            $DD = $v->sendpdftosiramah($datawebsiramah);
            $datatte = [
                'nik' => $request->nik,
                'password_tte' => $request->password,
                'persetujuan_simpan' => $simpan,
            ];
            User::where('id', auth()->user()->id)->update($datatte);
            $data1 = [
                'kode' => 200,
                'message' => 'Berkas berhasil ditanda tangan !',
                'id' => $id_dokumen
            ];
            echo json_encode($data1);
            die;
        } else {
            $save_report = [
                'status_code' => $DD['code'],
                'response' => $DD['messagee'],
                'kode_kunjungan' => $kodekunjungan,
                'tgl_kirim' => $this->get_now(),
                'status_file' => 0,
                'status' => 3
            ];
            Model_log_tte::whereRaw('id = ?', array($idreport->id))->update($save_report);
            $data = [
                'kode' => 500,
                'message' => 'Berkas gagal ditanda tangan ! ' . $DD['messagee']
            ];
            echo json_encode($data);
            die;
        }
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function cetakcatatanhd($kodekunjungan)
    {
        $d = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_code = ? and jenis_dokumen = ?', [$kodekunjungan, '200', 'CATATAN HD']);
        if (empty($d)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Berkas TTE tidak ditemukan atau belum diverifikasi.'
            ], 404);
        }

        // Jika ada, proses file
        return Response::make(file_get_contents($d[0]->file), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $d[0]->response . '"'
        ]);
    }
    public function cetakresumettd($kodekunjungan)
    {
        $d = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_code = ? order by id DESC', [$kodekunjungan, '200']);
        if (empty($d)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Berkas TTE tidak ditemukan atau belum diverifikasi.'
            ], 404);
        }

        // Jika ada, proses file
        return Response::make(file_get_contents($d[0]->file), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $d[0]->response . '"'
        ]);
    }
    public function cetak_dokumen_tte($kodekunjungan)
    {
        $d = db::select('select * from log_ttd_elektronik where response = ? and status_code = ?', [$kodekunjungan, '200']);
        return Response::make(file_get_contents($d[0]->file), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $d[0]->response . '"'
        ]);
    }
    public function cetak_dokumen_tte_v2($kodekunjungan)
    {
        $d = db::select('select * from log_ttd_elektronik where kode_kunjungan   = ? and status_code = ? ORDER BY id DESC', [$kodekunjungan, '200']);
        if (count($d) > 0) {
            return Response::make(file_get_contents($d[0]->file), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $d[0]->response . '"'
            ],);
        } else {
            return 'berkas tidak ditemukan!';
        }
    }
    public function form_login_tte()
    {
        return view('pdf.form_login_tte');
    }
    public function uploadgambar_ttd(Request $request)
    {
        $urlfile = '\\\\193.193.193.203\\erm\\image_ttd_dokter/';
        $data = array();
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = auth()->user()->kode_paramedis . '.png';
            $url = $urlfile . $filename;
            User::whereRaw('kode_paramedis = ?', array(auth()->user()->kode_paramedis))->update([
                'image_ttd' => $url
            ]);
            // File extension
            $extension = $file->getClientOriginalExtension();
            // File upload location
            $location = $urlfile;

            // Upload file
            $file->move($location, $filename);

            // File path
            $filepath = url($urlfile . $filename);

            // Response
            $data['success'] = 1;
            $data['message'] = 'Uploaded Successfully!';
            $data['filepath'] = $filepath;
            $data['extension'] = $extension;
        } else {
            // Response
            $data['success'] = 2;
            $data['message'] = 'File not uploaded.';
        }
        return response()->json($data);
    }
    public function index_verif_tte()
    {
        $title = 'SIMRS - VERIFIKASI TTE';
        $sidebar = 'verifikasitte';
        $sidebar_m = 'verifikasitte';
        return view('pdf.index_verifikasi_berkas_tte', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function ambildataberkastte()
    {
        $data = db::select('select *,fc_nama_px(b.no_rm) as nama_pasien,fc_NAMA_UNIT1(b.kode_unit) as nama_unit,fc_NAMA_PARAMEDIS1(b.kode_paramedis) as nama_dokter from log_ttd_elektronik a inner join ts_kunjungan b on a.kode_kunjungan = b.kode_kunjungan');
        return view('pdf.tabel_data_berkas', compact([
            'data'
        ]));
    }
    public function verifikasi_berkas2($id)
    {
        $data = db::select('select * from log_ttd_elektronik where id = ?', [$id]);
        $file = $data[0]->file;
        $id = $data[0]->id;
        $v = new ModelBSRE();
        $DD = $v->send_verifikasi($file, $id);
        if ($DD['code'] == 200) {
            $notes = $DD['messagee']->notes;
        } else {
            $notes = 'GAGAL VERIFIKASI';
        }
        Model_log_tte::whereRaw('id = ?', array($id))->update(['status_verif' => $notes]);
        $data = [
            'kode' => $DD['code'],
            'message' => $notes
        ];
        // echo json_encode($data);
        // die;
    }
    public function verifikasi_berkas(Request $request)
    {
        $data = db::select('select * from log_ttd_elektronik where id = ?', [$request->id_table]);
        $file = $data[0]->file;
        $id = $data[0]->id;
        $v = new ModelBSRE();
        $DD = $v->send_verifikasi($file, $id);
        if ($DD['code'] == 200) {
            $notes = $DD['messagee']->notes;
        } else {
            $notes = 'GAGAL VERIFIKASI';
        }
        Model_log_tte::whereRaw('id = ?', array($id))->update(['status_verif' => $notes]);
        $data = [
            'kode' => $DD['code'],
            'message' => $notes
        ];
        echo json_encode($data);
        die;
    }
    public function indexcekstatususertte()
    {
        $title = 'SIMRS - VERIFIKASI TTE';
        $sidebar = 'cekstatususertte';
        $sidebar_m = 'cekstatususertte';
        return view('pdf.index_cek_status_user_tte', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function ambildatauser()
    {
        $data = db::select('select * from mt_paramedis');
        return view('pdf.tabel_user_tte', compact([
            'data'
        ]));
    }
    public function cekstatususer(Request $request)
    {
        $nik = $request->nik;
        $v = new ModelBSRE();
        $DD = $v->cek_status_user($nik);
        if ($DD['code'] == 200) {
            return '<h5>' . $DD['messagee']->message . '</h5>';
        } else {
            return 'ERROR';
        }
    }
}
