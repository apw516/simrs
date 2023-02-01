<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\assesmenawalperawat;
use Carbon\Carbon;

class ErmController extends Controller
{
    public function indexDokter(Request $request)
    {
    }
    public function indexPerawat(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermperawat';
        $sidebar_m = '2';
        return view('ermperawat.index', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function ambildatapasienpoli()
    {
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN erm_hasil_assesmen_dokter_rajal c ON b.`kode_kunjungan` = c.kode_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
            '1', auth()->user()->unit
        ]);
        return view('ermtemplate.tabelpasien', compact([
            'pasienpoli'
        ]));
    }
    public function ambildetailpasien(Request $request)
    {
        $mt_pasien = DB::select('Select nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kode]);
        return view('ermperawat.formperawat', compact([
            'mt_pasien',
            'kunjungan'
        ]));
    }
    public function ambilcatatanmedis_pasien(Request $request)
    {
        $kunjungan = DB::select('select a.tgl_masuk,a.counter,fc_nama_unit1(a.kode_unit) as nama_unit from ts_kunjungan a where no_rm = ? ORDER BY counter desc', [$request->rm]);
        return view('ermtemplate.form_catatan_medis', compact([
            'kunjungan'
        ]));
    }
    public function formpemeriksaan_perawat(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        if(count($resume) > 0){
            return view('ermperawat.formpemeriksaan_edit', compact([
                'kunjungan',
                'resume'
            ]));
        }else{
            return view('ermperawat.formpemeriksaan', compact([
                'kunjungan'
            ]));
        }
    }
    public function simpanpemeriksaanperawat(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $data = [
            'counter' => $dataSet['counter'],
            'no_rm' => $dataSet['nomorrm'],
            'kode_unit' => $dataSet['unit'],
            'kode_kunjungan' => $dataSet['kodekunjungan'],
            'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
            'sumberdataperiksa' => $dataSet['sumberdata'],
            'keluhanutama' => trim($dataSet['keluhanutama']),
            'tekanandarah' => $dataSet['tekanandarah'],
            'frekuensinadi' => $dataSet['frekuensinadi'],
            'frekuensinapas' => $dataSet['frekuensinafas'],
            'suhutubuh' => $dataSet['suhutubuh'],
            'Riwayatpsikologi' => $dataSet['riwayatpsikologis'],
            'keterangan_riwayat_psikolog' => $dataSet['keteranganriwayatpsikologislainnya'],
            'penggunaanalatbantu' => $dataSet['alatbantu'],
            'keterangan_alat_bantu' => $dataSet['keteranganalatbantulain'],
            'cacattubuh' => $dataSet['cacattubuh'],
            'keterangancacattubuh' => $dataSet['keterangancacattubuhlainnya'],
            'Keluhannyeri' => $dataSet['pasienmengeluhnyeri'],
            'skalenyeripasien' => $dataSet['skalanyeripasien'],
            'resikojatuh' => $dataSet['resikojatuh'],
            'Skrininggizi' => $dataSet['penurunanbb'],
            'beratskrininggizi' => $dataSet['beratpenurunan'],
            'status_asupanmkanan' => $dataSet['asupanmakanan'],
            'penyakitlainpasien' => $dataSet['keterangandiagnosalain'],
            'diagnosakhusus' => $dataSet['diagnosakhusus'],
            'resikomalnutrisi' => $dataSet['kajianlanjutgizi'],
            'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'],
            'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
            'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
            'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
            'namapemeriksa' => auth()->user()->nama,
            'idpemeriksa' => auth()->user()->id,
            'status' => '0',
            'signature' => ''
        ];
        try {
            $cek = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE tanggalkunjungan = ? AND no_rm = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
            if (count($cek) > 0) {
                if ($cek[0]->status == '2') {
                    $data = [
                        'kode' => 500,
                        'message' => 'Dokter sudah mengisi assesmen awal medis ... !'
                    ];
                    echo json_encode($data);
                    die;
                } else {
                    assesmenawalperawat::whereRaw('no_rm = ? and kode_unit = ? and tanggalkunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan']))->update($data);
                }
            } else {
                $erm_assesmen = assesmenawalperawat::create($data);
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function resumepasien(Request $request)
    {
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ? AND no_rm = ?', [$request->kodekunjungan, $request->nomorrm]);
        return view('ermperawat.resumeperawat', compact([
            'resume'
        ]));
    }
    public function simpanttdperawat(Request $request)
    {
        $data = [
            // 'tanggalassemen' => $this->get_now(),
            'status' => '1',
            'signature' => $request->signature
        ];
        assesmenawalperawat::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
}
