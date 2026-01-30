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
use App\Models\model_master_barang_x_master_dpho_bpjs;
use App\Models\model_signa_barang;
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
    public function indexmasterbarangbpjs()
    {
        $title = 'SIMRS - Master Barang Mapping';
        $sidebar = 'SIMRS - Master Barang Mapping';
        $sidebar_m = '2';
        $now = $this->get_date();
        $master_barang = db::select('select a.kode_barang
        ,a.kode_obat_bpjs
        ,a.nama_barang
        ,b.generik as nama_zat_aktif
        ,b.namaobat as nama_generik
        ,a.dosis
        ,a.sediaan
        ,b.restriksi
        ,a.aturan_pakai
        ,a.pic
        ,a.tgl_entry
        from master_barang_x_master_obat_bpjs a 
        inner join apt_online_ref_dpho b on a.kode_obat_bpjs = b.kodeobat');
        return view('apotekonline.index_master_barang_x_bpjs', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'master_barang',
        ]));
    }
    public function indexmappingobat()
    {
        $title = 'SIMRS - MAPPING OBAT';
        $sidebar = 'SIMRS - MAPPING OBAT';
        $sidebar_m = '2';
        $now = $this->get_date();
        $master_barang = db::select('select a.kode_barang,a.nama_barang,a.dosis,a.sediaan,a.aturan_pakai,b.id as id_bpjs from mt_barang a 
        inner join mt_tipe_barang c on a.kode_tipe = c.kode_tipe
        left outer join master_barang_x_master_obat_bpjs b on a.kode_barang = b.kode_barang 
        where a.nama_barang != ? and a.act = ? and c.kode_kelompok != 2 order by a.nama_barang DESC', ['', 1]);
        $master_generik = db::select('select * from apt_online_ref_dpho');
        return view('apotekonline.indexmappingobat', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'master_barang',
            'master_generik'
        ]));
    }
    public function simpandatamappingobat(Request $request)
    {
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        $data3 = json_decode($_POST['data3'], true);
        try {
            if (count($data1) == 0) {
                $data = [
                    'kode' => '500',
                    'message' => 'Tidak ada barang yang dipilih !'
                ];
                echo json_encode($data);
                die;
            }
            if (count($data3) == 0) {
                $data = [
                    'kode' => 500,
                    'message' => 'Tidak ada signa yang dimasukan !'
                ];
                echo json_encode($data);
                die;
            }
            foreach ($data1 as $barang) {
                $index = $barang['name'];
                $value = $barang['value'];
                $array_data_barang[$index] = $value;
                if ($index == 'aturanpakai') {
                    $data_barang[] = $array_data_barang;
                }
            }
            foreach ($data2 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $data_generik[$index] = $value;
            }
            if ($data_generik['kodeobatbpjs'] == '') {
                $data = [
                    'kode' => 500,
                    'message' => 'Tidak ada nama generik yang dipilih !'
                ];
                echo json_encode($data);
                die;
            }
            foreach ($data3 as $signa) {
                $index = $signa['name'];
                $value = $signa['value'];
                $array_data_signa[$index] = $value;
                if ($index == 'keterangansigna') {
                    $data_signa[] = $array_data_signa;
                }
            }
            foreach ($data_barang as $db) {
                $save_1 = [
                    'kode_barang' => $db['kodebarang'],
                    'kode_obat_bpjs' => $data_generik['kodeobatbpjs'],
                    'nama_barang' => $db['namabarang'],
                    'nama_zat_aktif' => $data_generik['namazataktif'],
                    'nama_generik' => $data_generik['namageneriklengkap'],
                    'dosis' => $db['dosis'],
                    'sediaan' => $db['sediaan'],
                    'restriksi' => $data_generik['restriksi'],
                    'aturan_pakai' => $db['aturanpakai'],
                    'tgl_entry' => $this->get_now(),
                    'pic' => auth()->user()->id . ' | ' . auth()->user()->nama,
                ];
                $cek = db::select('select * from master_barang_x_master_obat_bpjs where kode_barang = ?', [$db['kodebarang']]);
                if (count($cek) > 0) {
                    $xxx = $cek[0]->id;
                    // model_master_barang_x_master_dpho_bpjs::where('id', $xxx)
                    //     ->update($save_1);
                    model_master_barang_x_master_dpho_bpjs::whereRaw('ID = ?', array($xxx))->update($save_1);
                    model_signa_barang::whereRaw('id_barang_dpho = ?', array($xxx))->delete($save_1);
                } else {
                    $xxx2 = model_master_barang_x_master_dpho_bpjs::create($save_1);
                    $xxx = $xxx2->id;
                }
                $header_hasil[] = $xxx;
            }
            foreach ($data_signa as $ds) {
                foreach ($header_hasil as $d) {
                    $data_simpan_signa = [
                        'id_barang_dpho' => $d,
                        'signa' => $ds['signa'],
                        'keterangan' => $ds['keterangansigna']
                    ];
                    model_signa_barang::create($data_simpan_signa);
                }
            }
            $data = [
                'kode' => 200,
                'message' => 'Mapping obat berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
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
    public function simpanresep()
    {
        $data_resep = [
            "TGLSJP" => "2021-08-05 18:13:11",
            "REFASALSJP" => "1202R0010318V000092",
            "POLIRSP" => "IPD",
            "KDJNSOBAT" => "3", //(1. Obat PRB, 2. Obat Kronis Blm Stabil, 3. Obat Kemoterapi)
            "NORESEP" => "12346",
            "IDUSERSJP" => "USR-01",
            "TGLRSP" => "2021-08-05 00:00:00",
            "TGLPELRSP" => "2021-08-05 00:00:00",
            "KdDokter" => "0",
            "iterasi" => "0" //(0. Non Iterasi, 1. Iterasi)
        ];
        $v = new MODEL_APOTEK_ONLINE();
        $response_data = $v->simpan_resep($data_resep);
        dd($response_data);
    }
    public function hapusresep()
    {
        $dataresep =    [
            "nosjp" => "1202A00201210000032",
            "refasalsjp" => "1202R0010121V000325",
            "noresep" => "0SI44"
        ];
        $v = new MODEL_APOTEK_ONLINE();
        $response_data = $v->hapus_resep($dataresep);
        dd($response_data);
    }
    public function data_riwayat_resep()
    {
        $dataresep = [
            "kdppk" => "0112A017",
            "KdJnsObat" => "0",
            "JnsTgl" => "TGLPELSJP", //format -> TGLPELSJP,TGLRSP
            "TglMulai" => "2019-03-01 08:49:45",
            "TglAkhir" => "2019-03-31 06:18:33"
        ];
        $v = new MODEL_APOTEK_ONLINE();
        $response_data = $v->daftar_resep($dataresep);
        dd($response_data);
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
    }
    // public function post_racikan()
    // {
    //     $dataAPOTEK = [
    //         'NOSJP' => '0112A01704190000001',
    //         'NORESEP' => '01236',
    //         'JNSROBT' => 'R.01',
    //         'KDOBT' => '123456',
    //         'NMOBAT' => 'IVAN',
    //         'SIGNA1OBT' => '1',
    //         'SIGNA2OBT' => '1',
    //         'PERMINTAAN' => '1',
    //         'JMLOBT' => '1',
    //         'JHO' => '1',
    //         'CatKhsObt' => 'TEST',
    //     ];
    //     $v = new MODEL_APOTEK_ONLINE();
    //     $DATA = $v->save_racikan($dataAPOTEK);
    // }
    // public function riwayatpelayananobat()
    // {
    //     $v = new MODEL_APOTEK_ONLINE();
    //     $v2 = new VclaimModel();
    //     // return view('pendaftaran.profilpeserta', [
    //     // ]);
    //     $awal = $this->get_date();
    //     $akhir = $this->get_date();
    //     $nokartu = '0002083363874';
    //     $data_peserta = $v2->get_peserta_noka($nokartu, date('Y-m-d'));
    //     dd($data_peserta);
    //     $DATA = $v->riwayat_obat($awal, $akhir, $nokartu);
    // }
    public function monitoringklaim()
    {
        $v = new MODEL_APOTEK_ONLINE();
        $bulan = '12';
        $tahun = '2025';
        $jenisobat = '0';
        $status = '1';
        $DATA = $v->caridataklaim($bulan, $tahun, $jenisobat, $status);
        dd($DATA);
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
