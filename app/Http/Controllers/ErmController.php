<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\assesmenawalperawat;
use App\Models\assesmenawaldokter;
use Carbon\Carbon;

class ErmController extends Controller
{
    public function indexDokter(Request $request)
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'ermdokter';
        $sidebar_m = '2';
        return view('ermdokter.index', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
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
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
            '1', auth()->user()->unit
        ]);
        return view('ermtemplate.tabelpasien', compact([
            'pasienpoli'
        ]));
    }
    public function ambildatapasienpoli_dokter()
    {
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
            '1', auth()->user()->unit
        ]);
        return view('ermtemplate.tabelpasien_dokter', compact([
            'pasienpoli'
        ]));
    }
    public function ambildetailpasien_dokter(Request $request)
    {
        $mt_pasien = DB::select('Select nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kode]);
        return view('ermdokter.formdokter', compact([
            'mt_pasien',
            'kunjungan'
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
        $kunjungan = DB::select('SELECT *,b.id as id_1, c.id as id_2,b.signature as signature_perawat,c.signature as signature_dokter,b.keluhanutama as keluhan_perawat,a.tgl_masuk,a.counter,fc_nama_unit1(a.kode_unit) AS nama_unit FROM ts_kunjungan a
        LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.`kode_kunjungan` = b.kode_kunjungan
        LEFT OUTER JOIN assesmen_dokters c ON b.`id` = c.`id_asskep` where a.no_rm = ? ORDER BY a.counter desc', [$request->rm]);
        return view('ermtemplate.form_catatan_medis', compact([
            'kunjungan'
        ]));
    }
    public function formpemeriksaan_perawat(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        if (count($resume) > 0) {
            return view('ermperawat.formpemeriksaan_edit', compact([
                'kunjungan',
                'resume'
            ]));
        } else {
            return view('ermperawat.formpemeriksaan', compact([
                'kunjungan'
            ]));
        }
    }
    public function formpemeriksaan_dokter(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        if (count($resume_perawat) > 0) {
            if (count($resume) > 0) {
                return view('ermdokter.formpemeriksaan_dokter_edit', compact([
                    'kunjungan',
                    'resume',
                    'resume_perawat'
                ]));
            } else {
                return view('ermdokter.formpemeriksaan_dokter', compact([
                    'kunjungan',
                    'resume_perawat'
                ]));
            }
        } else {
            return view('ermtemplate.datatidakditemukan');
        }
    }
    public function formpemeriksaan_khusus(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $penyakit = DB::select('SELECT * from mt_penyakit');
        return view('erm_form_khusus.formpemeriksaan_khusus_tht', compact([
            'kunjungan',
            'penyakit',
            'resume'
        ]));
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
    public function simpanpemeriksaandokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }

        if (empty($dataSet['hipertensi'])) {
            $hipertensi = 0;
        } else {
            $hipertensi = $dataSet['hipertensi'];
        };

        if (empty($dataSet['kencingmanis'])) {
            $kencingmanis = 0;
        } else {
            $kencingmanis = $dataSet['kencingmanis'];
        };

        if (empty($dataSet['jantung'])) {
            $jantung = 0;
        } else {
            $jantung = $dataSet['jantung'];
        };

        if (empty($dataSet['stroke'])) {
            $stroke = 0;
        } else {
            $stroke = $dataSet['stroke'];
        };

        if (empty($dataSet['hepatitis'])) {
            $hepatitis = 0;
        } else {
            $hepatitis = $dataSet['hepatitis'];
        };

        if (empty($dataSet['asthma'])) {
            $asthma = 0;
        } else {
            $asthma = $dataSet['asthma'];
        };

        if (empty($dataSet['ginjal'])) {
            $ginjal = 0;
        } else {
            $ginjal = $dataSet['ginjal'];
        };

        if (empty($dataSet['tb'])) {
            $tb = 0;
        } else {
            $tb = $dataSet['tb'];
        };

        if (empty($dataSet['riwayatlain'])) {
            $riwayatlain = 0;
        } else {
            $riwayatlain = $dataSet['riwayatlain'];
            if ($dataSet['ketriwayatlain'] == '') {
                $data = [
                    'kode' => 502,
                    'message' => 'Isi keterangan riwayat lain ...'
                ];
                echo json_encode($data);
                die;
            }
        };
        $data = [
            'counter' => $dataSet['counter'],
            'kode_unit' => $dataSet['unit'],
            'id_kunjungan' => $dataSet['kodekunjungan'],
            'id_pasien' => $dataSet['nomorrm'],
            'id_asskep' => $dataSet['idasskep'],
            'pic' => auth()->user()->id,
            'nama_dokter' => auth()->user()->nama,
            'tgl_kunjungan' => $dataSet['tanggalkunjungan'],
            'tgl_pemeriksaan' => $this->get_now(),
            'sumber_data' => $dataSet['sumberdata'],
            'tekanan_darah' => $dataSet['tekanandarah'],
            'frekuensi_nadi' => $dataSet['frekuensinadi'],
            'frekuensi_nafas' => $dataSet['frekuensinafas'],
            'suhu_tubuh' => $dataSet['suhutubuh'],
            'riwayat_alergi' =>  $dataSet['alergi'],
            'keterangan_alergi' =>  $dataSet['ketalergi'],
            'riwayat_kehamilan_pasien_wanita' => $dataSet['riwayatkehamilan'],
            'riwyat_kelahiran_pasien_anak' => $dataSet['riwayatkelahiran'],
            'riwyat_penyakit_sekarang' => $dataSet['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'ket_riwayatlain' => $dataSet['ketriwayatlain'],
            'statusgeneralis' => $dataSet['statusgeneralis'],
            'keadaanumum' => $dataSet['keadaanumum'],
            'kesadaran' => $dataSet['kesadaran'],
            'diagnosakerja' => trim($dataSet['diagnosakerja']),
            'diagnosabanding' => $dataSet['diagnosabanding'],
            'rencanakerja' => trim($dataSet['rencanakerja']),
            'keluhan_pasien' => trim($dataSet['keluhanutama']),
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'signature' => ''
        ];
        try {
            $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
            if (count($cek) > 0) {
                assesmenawaldokter::whereRaw('id_pasien = ? and kode_unit = ? and id_kunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['kodekunjungan']))->update($data);
            } else {
                $erm_assesmen = assesmenawaldokter::create($data);
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
    public function resumepasien_dokter(Request $request)
    {
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ? AND id_pasien = ?', [$request->kodekunjungan, $request->nomorrm]);
        return view('ermdokter.resumedokter', compact([
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
    public function simpanttddokter(Request $request)
    {
        $data = [
            // 'tanggalassemen' => $this->get_now(),
            'status' => '1',
            'signature' => $request->signature
        ];
        assesmenawaldokter::whereRaw('id_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function formtindakan(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);

        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        return view('ermdokter.formtindakan', compact([
            'kunjungan',
            'resume',
            'layanan'
        ]));
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function simpanlayanan(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek_layanan_header = count(DB::connection('mysql2')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$request->kodekunjungan]));
        if ($cek_layanan_header > 0) {
            $back = [
                'kode' => 500,
                'message' => 'Layanan sudah diinput, silahkan cek riwayat tindakan !'
            ];
            echo json_encode($back);
            die;
        }
        $kodekunjungan = $request->kodekunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }
    }
    public function gambartht1(Request $request)
    {
        return view('ermtemplate.telingakanan');
    }
    public function gambartht2(Request $request)
    {
        return view('ermtemplate.telingakiri');
    }
    public function simpantht_telingakanan(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $telingakanan = $request->telingakanan;
        $data = json_decode($_POST['data'], true);
        dd($data);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        dd($dataSet);
        $datatelinga = [
            'kode_kunjungan' => $kodekunjungan,
            'gambar' => $request->telingakanan,
            'keterangan' => 'telinga kanan',
            'LT_lapang' => (empty($dataSet['Lapang '])) ? 0 : $dataSet['Lapang '],
            'LT_dataSetestruksi' => (empty($dataSet['Lapang '])) ? $dataSet['Lapang '] : 0,
            'LT_Sempit' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Serumen' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Kolesteatoma' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Sekret' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Massa_Jaringan' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Jamur' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_BendataSeta_asing' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Lain_lain' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'LT_Keterangan_lain' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_intak_normal' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_intak_hiperemis' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_intak_bulging' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_intak_retraksi' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_intak_sklerotik' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_perforasi_sentral' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_perforasi_atik' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_perforasi_marginal' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_perforasi_lain' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_keterangan_lain' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_mukosa' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_osikal' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'MT_isthmus' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
            'lain_lain' =>($dataSet['Lapang ']) ? $dataSet['Lapang '] : 0,
        ];
        dd($datatelinga);
    }
}
