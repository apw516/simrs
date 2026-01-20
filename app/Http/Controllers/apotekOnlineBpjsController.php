<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\pdf;
use Codedge\Fpdf\Fpdf\printresume;
use App\Models\assesmenawalperawat;
use App\Models\assesmenawalperawat_igd;
use App\Models\assesmenawaldokter;
use App\Models\ermtht_telinga;
use App\Models\erm_tht_hidung;
use App\Models\erm_gambar_gigi;
use App\Models\erm_catatan_gambar;
use App\Models\erm_mata_kanan_kiri;
use App\Models\erm_upload_gambar;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
use App\Models\ts_header_iter;
use App\Models\mt_surat;
use App\Models\ts_layanan_header_order;
use App\Models\ts_layanan_detail_order;
use App\Models\templateresep;
use App\Models\templateresep_detail;
use App\Models\Barang;
use App\Models\erm_order_penunjang;
use App\Models\ts_kunjungan;
use App\Models\ts_kunjungan2;
use App\Models\antrianmarwan;
use App\Models\ts_antrian_igd;
use App\Models\ts_sumarilis;
use App\Models\ts_erm_transfusi_darah_reaksi;
use App\Models\ts_erm_transfusi_darah_monitoring;
use App\Models\di_diagnosa;
use App\Models\laporan_operasi_poli_mata;
use App\Models\VclaimModel;
use Carbon\Carbon;
use simitsdk\phpjasperxml\PHPJasperXML;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokter;
use App\Models\mt_unit;
use App\Models\MODEL_APOTEK_ONLINE;
use App\Models\model_apotek_ref_dpho;
use App\Models\model_apotek_set_apotek;
use File;

class apotekOnlineBpjsController extends Controller
{
    public function indexreferensidpho()
    {
        $title = 'SIMRS - Referensi DPHO';
        $sidebar = 'SIMRS - Referensi DPHO';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('apotekonline.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function indexsettingapotek()
    {
        $title = 'SIMRS - DATA APOTEK';
        $sidebar = 'SIMRS - DATA APOTEK';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('apotekonline.index_setting_apotek', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function downloadrefdpho()
    {
        $v = new MODEL_APOTEK_ONLINE();
        try {
            $DATA = $v->referensi_dpho();
            if ($DATA->metaData->code == 200 && $DATA->metaData->message == 'OK') {
                $cek = db::select('select id from apt_online_ref_dpho');
                if (count($cek) > 0) {
                    model_apotek_ref_dpho::truncate();
                    $cek = db::select('select id from apt_online_ref_dpho');
                }
                foreach ($DATA->response->list as $d) {
                    $data2 = [
                        'kodeobat' => $d->kodeobat,
                        'namaobat' => $d->namaobat,
                        'prb' => $d->prb,
                        'kronis' => $d->kronis,
                        'kemo' => $d->kemo,
                        'harga' => $d->harga,
                        'restriksi' => $d->restriksi,
                        'generik' => $d->generik,
                        'aktif' => $d->aktif,
                        'sedia' => $d->sedia,
                        'stok' => $d->stok,
                        'tgl_download' => $this->get_now(),
                    ];
                    model_apotek_ref_dpho::create($data2);
                }
                $data = [
                    'kode' => 200,
                    'message' => 'Data berhasil diperbaharui ...'
                ];
                echo json_encode($data);
                die;
            }
        } catch (\Exception $e) {
            $err = $e->getMessage();
            $data = [
                'kode' => 500,
                'message' => $err
            ];
            echo json_encode($data);
            die;
        }
    }
    public function getsetapotek()
    {
        $v = new MODEL_APOTEK_ONLINE();
        // $ddd = $this->post_non_racikan();
        // $ddd = $this->post_racikan();
        $ddd = $this->riwayatpelayananobat();
        dd($ddd);
        $kodeapotek = '0125A016';
        try {
            $DATA = $v->setting_apotek($kodeapotek);
            if ($DATA->metaData->code == 200 && $DATA->metaData->message == 'OK') {
                $d = $DATA->response;
                $dataup = [
                    'kode' => $d->kode,
                    'namaapoteker' => $d->namaapoteker,
                    'namakepala' => $d->namakepala,
                    'jabatankepala' => $d->jabatankepala,
                    'nipkepala' => $d->nipkepala,
                    'siup' => $d->siup,
                    'alamat' => $d->alamat,
                    'kota' => $d->kota,
                    'namaverifikator' => $d->namaverifikator,
                    'nppverifikator' => $d->nppverifikator,
                    'namapetugasapotek' => $d->namapetugasapotek,
                    'nippetugasapotek' => $d->nippetugasapotek,
                    'checkstock' => $d->checkstock,
                    'last_update' => $this->get_now()
                ];
                model_apotek_set_apotek::create($dataup);
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil diupdate ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $err = $e->getMessage();
            $data = [
                'kode' => 500,
                'message' => $err
            ];
            echo json_encode($data);
            die;
        }
    }
    public function ambilsetapotek()
    {
        $data = db::select('select * from apt_online_setting_apotek order by id asc');
        return view('apotekonline.tabel_Set_apotek', compact([
            'data'
        ]));
    }
    public function ambilrefdpholokal()
    {
        $data = db::select('select * from apt_online_ref_dpho order by kodeobat asc');
        return view('apotekonline.tabel_ref_dpho', compact([
            'data'
        ]));
    }
    public function post_non_racikan()
    {
        $dataAPOTEK = [
            'NOSJP' => '0112A01704190000001',
            'NORESEP' => '01236',
            'KDOBT' => '123456',
            'NMOBAT' => 'IVAN',
            'SIGNA1OBT' => '1',
            'SIGNA2OBT' => '1',
            'JMLOBT' => '1',
            'JHO' => '1',
            'CatKhsObt' => 'TEST',
        ];
        $v = new MODEL_APOTEK_ONLINE();
        $DATA = $v->save_non_racik($dataAPOTEK);
        DD($DATA);
    }
    public function post_racikan()
    {
        $dataAPOTEK = [
            'NOSJP' => '0112A01704190000001',
            'NORESEP' => '01236',
            'JNSROBT' => 'R.01',
            'KDOBT' => '123456',
            'NMOBAT' => 'IVAN',
            'SIGNA1OBT' => '1',
            'SIGNA2OBT' => '1',
            'PERMINTAAN' => '1',
            'JMLOBT' => '1',
            'JHO' => '1',
            'CatKhsObt' => 'TEST',
        ];
        $v = new MODEL_APOTEK_ONLINE();
        $DATA = $v->save_racikan($dataAPOTEK);
        dd($DATA);
    }
    public function riwayatpelayananobat()
    {
        $v = new MODEL_APOTEK_ONLINE();
        $v2 = new VclaimModel();
        // return view('pendaftaran.profilpeserta', [
        // ]);
        $awal = $this->get_date();
        $akhir = $this->get_date();
        $nokartu = '0002083363874';
        $data_peserta = $v2->get_peserta_noka($nokartu, date('Y-m-d'));
        dd($data_peserta);
        $DATA = $v->riwayat_obat($awal, $akhir, $nokartu);
    }

    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
}
