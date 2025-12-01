<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Net\SFTP;
// use Oriceon\PdfMerger\Facades\PdfMerger;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class CasemixController extends Controller
{
    public function index_merger_berkas()
    {
        $title = 'SIMRS - CASEMIX';
        $sidebar = 'mergerberkas';
        $sidebar_m = '1.1';
        return view('Casemix.indexmergerberkas', compact([
            'title',
            'sidebar',
            'sidebar_m',
        ]));
    }
    public function caridatakunjungan_casemix(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $jeniskunjungan = $request->jeniskunjungan;
        $jenispasien = $request->jenispasien;
        if ($jeniskunjungan == 1) {
            $unit = 1;
            if ($jenispasien == 1) {
                //bpjs
                $penjamin = 'P03';
            } else {
                $penjamin = 'P01';
            }
        } else {
            $unit = 2;
            if ($jenispasien == 1) {
                //bpjs
                $penjamin = 'P03';
            } else {
                $penjamin = 'P01';
            }
        }
        if ($penjamin == 'P01') {
            $data = db::connection('mysql2')->select('select no_sep,b.status_kunjungan, kode_kunjungan,date(tgl_masuk) as tgl_masuk,no_rm,fc_nama_px(no_rm) as nama_pasien,fc_NAMA_PARAMEDIS1(kode_paramedis) as nama_dokter,fc_nama_unit1(kode_unit) as nama_unit,no_Sep from ts_kunjungan left outer join mt_status_kunjungan b on ts_kunjungan.status_kunjungan = b.ID where date(tgl_masuk) between ? and  ? and substr(kode_unit,1,1) = ? and kode_penjamin = ? and ts_kunjungan.status_kunjungan != ? order by kode_kunjungan desc', [$tgl_awal, $tgl_awal, $unit, 'P01', '8']);
        } else {
            $data = db::connection('mysql2')->select('select no_sep,b.status_kunjungan, kode_kunjungan,date(tgl_masuk) as tgl_masuk,no_rm,fc_nama_px(no_rm) as nama_pasien,fc_NAMA_PARAMEDIS1(kode_paramedis) as nama_dokter,fc_nama_unit1(kode_unit) as nama_unit,no_Sep from ts_kunjungan left outer join mt_status_kunjungan b on ts_kunjungan.status_kunjungan = b.ID where date(tgl_masuk) between ? and  ? and substr(kode_unit,1,1) = ? and kode_penjamin != ? and ts_kunjungan.status_kunjungan != ? order by kode_kunjungan desc', [$tgl_awal, $tgl_akhir, $unit, 'P01', '8']);
        }
        // foreach($data as $d){
        //     $this->downloadberkas($d->kode_kunjungan);
        // }
        return view('Casemix.tabel_data_kunjungan', compact([
            'data'
        ]));
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function downloadberkas($kodekunjungan)
    {
        $pdf = PdfMerger::init();
        $date = $this->get_date();
        $ts_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $cek_far = db::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit IN (4002,4008)', [$kodekunjungan]);
        $cek_rad = db::select('select * from ts_hasil_expertisi where kode_kunjungan = ?', [$kodekunjungan]);
        $cek_lab = db::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit IN (3002)', [$kodekunjungan]);
        $cek_lab2 = db::select("CALL HASIL_PK_LAB_ERM('$kodekunjungan')");
        $mt_pasien = db::select('select * from mt_pasien where no_rm = ?', [$ts_kunjungan[0]->no_rm]);
        $contents = [];
        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
            )
        );
        //192.168.2.74/smartlab_waled/his/his_report?hisno={{ $c->kode_layanan_header }}
        if (count($ts_kunjungan) > 0) {
            foreach ($ts_kunjungan as $tk) {
                if (strlen($tk->no_sep) > 3) {
                    $context = stream_context_create($opts);
                    $contents_sep = file_get_contents('http://192.168.2.30/siramah/cetakSEPAntrian?noSep=' . $tk->no_sep, FALSE, $context);
                    Storage::disk('SEP')->put($tk->no_sep . '.pdf', $contents_sep);
                    $pdf->addPDF('\\\193.193.193.203\erm\sep/' . $tk->no_sep . '.pdf', 'all');
                    $contents[] = $contents_sep;
                }
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
        if (count($cek_rad) > 0) {
            $context = stream_context_create($opts);
            foreach ($cek_rad as $cr) {
                $contents_rad  = file_get_contents('https://192.168.2.233/expertise/cetak.php?IDs=' . $cr->id_header . '&IDd=' . $cr->id_detail . '&tgl_cetak=' . $date, FALSE, $context);
                Storage::disk('RAD')->put('RAD' . $cr->id_header . '.pdf', $contents_rad);
                $pdf->addPDF('\\\193.193.193.203\erm\expertisi_radiologi/RAD' . $cr->id_header . '.pdf', 'all');
                $contents[] = $contents_rad;
            }
        }
        if (count($cek_lab) > 0) {
            foreach ($cek_lab as $cl) {
                $kode_layanan_header = $cl->kode_layanan_header;
                $contents_lab = file_get_contents('http://192.168.2.74/smartlab_waled/his/his_report?hisno=' . $kode_layanan_header);
                Storage::disk('LAB_1')->put($kode_layanan_header . '.pdf', $contents_lab);
                $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $kode_layanan_header . '.pdf', 'all');
                $contents[] = $contents_lab;
            }
        }
        if (count($cek_lab2) > 0) {
            foreach ($cek_lab2 as $cl) {
                $kode_layanan_header = $cl->layanan;
                $contents_lab = file_get_contents($cl->link);
                Storage::disk('LAB_1')->put($kode_layanan_header . '.pdf', $contents_lab);
                $pdf->addPDF('\\\193.193.193.203\erm\hasil_lab_1/' . $kode_layanan_header . '.pdf', 'all');
                $contents[] = $contents_lab;
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
