<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Model_log_tte;
use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias
use Illuminate\Support\Facades\DB;
use App\Models\ModelBSRE;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Net\SFTP;
// use Oriceon\PdfMerger\Facades\PdfMerger;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class ResumeRajal extends Controller
{
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function indexresumemedisrajal()
    {
        $title = 'SIMRS - RESUME MEDIS RAWAT JALAN';
        $sidebar = 'indexresumemedisrajal';
        $sidebar_m = 'indexresumemedisrajal';
        $now = $this->get_date();
        return view('resumerajal.index_resume_rajal', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function indexresumemedisranap()
    {
        $title = 'SIMRS - RESUME MEDIS RAWAT INAP';
        $sidebar = 'indexresumemedisranap';
        $sidebar_m = 'indexresumemedisranap';
        $now = $this->get_date();
        return view('resumerajal.index_resume_ranap', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function cariresume_bykunjungan(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $DATA = db::select('SELECT kode_kunjungan
        ,tgl_masuk
        ,no_rm
        ,fc_nama_px(no_rm) AS nama_pasien
        ,kode_unit
        ,fc_nama_unit1(kode_unit) AS nama_unit
        ,fc_NAMA_PARAMEDIS1(kode_paramedis) AS nama_dokter
        ,fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin
        FROM ts_kunjungan WHERE DATE(tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != 8 AND kode_unit < 2000 AND kode_unit != 1002', [$awal, $akhir]);
        return view('resumerajal.tabel_kunjungan', compact([
            'DATA'
        ]));
    }
    public function cariresume_bykunjungan_ranap(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        $DATA = db::select('SELECT kode_kunjungan
        ,tgl_masuk
        ,no_rm
        ,fc_nama_px(no_rm) AS nama_pasien
        ,kode_unit
        ,fc_nama_unit1(kode_unit) AS nama_unit
        ,fc_NAMA_PARAMEDIS1(kode_paramedis) AS nama_dokter
        ,fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin
        FROM ts_kunjungan WHERE DATE(tgl_masuk) BETWEEN ? AND ? AND status_kunjungan != 8 AND kode_unit > 2000', [$awal, $akhir]);
        return view('resumerajal.tabel_kunjungan', compact([
            'DATA'
        ]));
    }
    public function cetakresumerajalbykunjungan($kodekunjungan)
    {
        $resume = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_file = 1', [$kodekunjungan]);
        $cek = DB::select('select *,date(tgl_baca) as tanggalnya,fc_acc_number_ris(id_detail) as acc_number from ts_hasil_expertisi where kode_kunjungan = ?', [$kodekunjungan]);
        return view('resumerajal.resumelengkap', compact([
            'resume',
            'cek'
        ]));
    }
    public function mergerpdf($kodekunjungan)
    {
        $date = $this->get_date();
        // ... inside a controller method or similar
        $pdf = PdfMerger::init();
        $resume = db::select('select * from log_ttd_elektronik where status_file = 1');
        // file_get_contents($d[0]->file)
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
            )
        );
        $ts_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $mt_pasien = db::select('select * from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $cek_resume = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and status_file = 1', [$kodekunjungan]);
        $cek_lab = db::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, 3002]);
        $cek_rad = db::select('select * from ts_hasil_expertisi where kode_kunjungan = ?', [$kodekunjungan]);
        $cek_far = db::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit IN (4002,4008)', [$kodekunjungan]);
        // dd($cek_lab);
        $contents = [];
        if (count($cek_resume) > 0) {
            $resume = $cek_resume[0]->file;
            $pdf->addPDF($resume, 'all');
        }
        if (count($ts_kunjungan) > 0) {
            foreach ($ts_kunjungan as $tk) {
                if (strlen($tk->no_sep) > 3) {
                    $contents_sep = file_get_contents('http://localhost/simrs/cetaksep_v2/' . $tk->no_sep);
                    Storage::disk('SEP')->put($tk->no_sep . '.pdf', $contents_sep);
                    $pdf->addPDF('\\\193.193.193.203\erm\sep/' . $tk->no_sep . '.pdf', 'all');
                    $contents[] = $contents_sep;
                }
            }
        }
        // dd($cek_lab);
        if (count($cek_lab) > 0) {
            foreach ($cek_lab as $cl) {
                $kode_layanan_header = $cl->kode_layanan_header;
                $contents_lab = file_get_contents('http://192.168.2.74/smartlab_waled/his/his_report?hisno=' . $kode_layanan_header);
                Storage::disk('LAB_1')->put($cl->kode_layanan_header . '.pdf', $contents_lab);
                $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $cl->kode_layanan_header . '.pdf', 'all');
                $contents[] = $contents_lab;
                // $contents_lab_2 = file_get_contents('http://192.168.2.74/smartlab_waled/his/his_report?hisno=' . $kode_layanan_header . '&type=MDT');
                // $contents_lab_3 = file_get_contents('http://192.168.2.74/smartlab_waled/his/his_report?hisno=' . $kode_layanan_header . '&type=KULTR');
                // $contents_lab_4 = file_get_contents('http://192.168.2.74/smartlab_waled/his/his_report?hisno=' . $kode_layanan_header . '&type=PGCT');
                // $contents_lab_5 = file_get_contents('http://192.168.2.74/smartlab_waled/his/his_report?hisno=' . $kode_layanan_header . '&type=BM');
                // if (strlen($contents_lab) > 0) {
                //     Storage::disk('LAB_1')->put($cl->kode_layanan_header . '.pdf', $contents_lab);
                //     $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $cl->kode_layanan_header . '.pdf', 'all');
                //     $contents[] = $contents_lab;
                // }
                // if (strlen($contents_lab_2) > 0) {
                //     Storage::disk('LAB_2')->put($cl->kode_layanan_header . '.pdf', $contents_lab_2);
                //     $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_2/' . $cl->kode_layanan_header . '.pdf', 'all');
                //     $contents[] = $contents_lab_2;
                // }

                // if (strlen($contents_lab_3) > 4674) {
                //     Storage::disk('LAB_3')->put($cl->kode_layanan_header . '.pdf', $contents_lab_3);
                //     $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_3/' . $cl->kode_layanan_header . '.pdf', 'all');
                //     $contents[] = $contents_lab_3;
                // }
                // if (strlen($contents_lab_4) > 4674) {
                //     Storage::disk('LAB_1')->put($cl->kode_layanan_header . '.pdf', $contents_lab_4);
                //     $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $cl->kode_layanan_header . '.pdf', 'all');
                //     $contents[] = $contents_lab_4;
                // }
                // if (strlen($contents_lab_5) > 4674) {
                //     Storage::disk('LAB_1')->put($cl->kode_layanan_header . '.pdf', $contents_lab_5);
                //     $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $cl->kode_layanan_header . '.pdf', 'all');
                //     $contents[] = $contents_lab_5;
                // }
            }
        }

        if (count($cek_rad) > 0) {
            $context = stream_context_create($opts);
            foreach ($cek_rad as $cr) {
                $contents_rad  = file_get_contents('https://192.168.2.233/expertise/cetak.php?IDs=' . $cr->id_header . '&IDd=' . $cr->id_detail . '&tgl_cetak=' . $date, FALSE, $context);
                Storage::disk('RAD')->put('RAD' . $cr->id_header . '.pdf', $contents_rad);
                $pdf->addPDF('\\\193.193.193.203\erm\expertisi_radiologi/RAD' . $cr->id_header . '.pdf', 'all');
                $contents[] = $contents_rad;
            }
        }

        if (count($cek_far) > 0) {
            $context = stream_context_create($opts);
            foreach ($cek_far as $cf) {
                $contents_resep  = file_get_contents('http://192.168.2.45/simrs/cetaknotafarmasi_2/' . $cf->kode_kunjungan . '/' . $cf->kode_layanan_header . '/' . $cf->id, FALSE, $context);
                Storage::disk('FAR')->put('FAR' . $cf->kode_layanan_header . '.pdf', $contents_resep);
                // $pdf->addPDF('\\\193.193.193.203\erm\resepfarmasi/'. $cf->kode_layanan_header . '.pdf', 'all');
                $pdf->addPDF('\\\193.193.193.203\erm\resepfarmasi/FAR' . $cf->kode_layanan_header . '.pdf', 'all');
                $contents[] = $contents_resep;
            }
        }

        if (count($contents) > 0) {
            $pdf->merge();
            $output = $pdf->Output();
            $name = $kodekunjungan . '.pdf';
            $pdf->save(Storage::disk('MER', $name)->put($name, $output));
            return Response::make(file_get_contents('\\\193.193.193.203\erm\merger_resume_rajal/' . $kodekunjungan . '.pdf'), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $mt_pasien[0]->nama_px . ' | ' . $name . '"'
            ],);
        }
    }
}
