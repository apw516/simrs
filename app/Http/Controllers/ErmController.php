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
use App\Models\ts_layanan_header_order;
use App\Models\ts_layanan_detail_order;
use App\Models\templateresep;
use App\Models\templateresep_detail;
use App\Models\erm_order_penunjang;
use Carbon\Carbon;
use simitsdk\phpjasperxml\PHPJasperXML;
use Illuminate\Support\Facades\Storage;

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
        if (auth()->user()->unit == '1002') {
            $pasienigd = DB::select('SELECT * from mt_pasien_igd');
            return view('ermtemplate.tabelpasienigd', compact([
                'pasienigd'
            ]));
        } else {
            $pasienpoli = DB::select('SELECT IFNULL(d.nomorantrean, TIME(a.`tgl_masuk`)) AS antrian,d.`nomorantrean`,a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan LEFT OUTER JOIN jkn_antrian d ON a.`kode_kunjungan` = d.`kode_kunjungan`
             WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
                '1',auth()->user()->unit
            ]);
            return view('ermtemplate.tabelpasien', compact([
                'pasienpoli'
            ]));
        }
    }
    public function ambildatapasienpoli_dokter()
    {
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) =  CURDATE() AND a.`kode_unit` = ?', [
            '1', auth()->user()->unit
        ]);

        return view('ermtemplate.tabelpasien_dokter', compact([
            'pasienpoli'
        ]));
    }
    public function ambildetailpasien_dokter(Request $request)
    {
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kode]);
        $pic = $request->pic;
        return view('ermdokter.formdokter', compact([
            'mt_pasien',
            'kunjungan',
            'pic'
        ]));
    }
    public function ambildetailpasien(Request $request)
    {
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$request->rm]);
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kode]);
        return view('ermperawat.formperawat', compact([
            'mt_pasien',
            'kunjungan'
        ]));
    }
    public function ambilcatatanmedis_pasien(Request $request)
    {
        $kunjungan = DB::select('SELECT *,a.kode_kunjungan as kodek,a.no_rm as no_rm_k,b.id as id_1, c.id as id_2,b.signature as signature_perawat,c.signature as signature_dokter,b.keluhanutama as keluhan_perawat,a.tgl_masuk,a.counter,fc_nama_unit1(a.kode_unit) AS nama_unit FROM ts_kunjungan a
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
            // if ($kunjungan[0]->kode_unit == '1002') {
            //     $resume2 = DB::select('SELECT * from erm_assesmen_keperawatan_igd WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
            //     if (count($resume2) > 0) {
            //         return view('ermperawat.formpemeriksaanigd_edit', compact([
            //             'kunjungan',
            //             'resume2'
            //         ]));
            //     } else {
            //         return view('ermperawat.formpemeriksaanigd', compact([
            //             'kunjungan'
            //         ]));
            //     }
            // } else {
            return view('ermperawat.formpemeriksaan', compact([
                'kunjungan'
            ]));
            // }
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
            } else if ($resume_perawat[0]->status == 0) {
                return view('ermtemplate.datatidakditemukan');
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
        $unit = auth()->user()->unit;
        if (count($resume) > 0) {
            if ($unit == '1019') {
                $cek = DB::SELECT('select * from erm_tht_telinga where id_assesmen_dokter = ?', [$resume[0]->id]);
                $cek2 = DB::SELECT('select * from erm_tht_hidung where id_assesmen_dokter = ?', [$resume[0]->id]);
                if (count($cek) > 0 || count($cek2) > 0) {
                    $kanan = DB::SELECT('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'telinga kanan']);
                    $kiri = DB::SELECT('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'telinga kiri']);
                    $hidungkanan = DB::SELECT('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'Hidung Kanan']);
                    $hidungkiri = DB::SELECT('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$resume[0]->id, 'Hidung Kiri']);
                    return view('erm_form_khusus.formpemeriksaan_khusus_tht_edit', compact([
                        'kunjungan',
                        'penyakit',
                        'resume',
                        'cek',
                        'cek2',
                        'kanan',
                        'kiri',
                        'hidungkanan',
                        'hidungkiri',
                    ]));
                } else {
                    return view('erm_form_khusus.formpemeriksaan_khusus_tht', compact([
                        'kunjungan',
                        'penyakit',
                        'resume'
                    ]));
                }
            } else if ($unit == '1014') {
                $cek = DB::SELECT('select * from erm_mata_kanan_kiri where id_assesmen_dokter = ?', [$resume[0]->id]);
                if (count($cek) > 0) {
                    return view('erm_form_khusus.form_mata_edit', compact([
                        'resume',
                        'kunjungan',
                        'cek'
                    ]));
                } else {
                    return view('erm_form_khusus.form_mata', compact([
                        'resume',
                        'kunjungan'
                    ]));
                }
            } else if ($unit == '1007') {
                return view('erm_form_khusus.form_gigi', compact([
                    'resume',
                    'kunjungan'
                ]));
            } else {
                return view('erm_form_khusus.gambarbebas', compact([
                    'resume'
                ]));
            }
        } else {
            if ($unit == '1002') {
                $resume = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
                return view('erm_form_khusus.gambarbebas', compact([
                    'resume'
                ]));
            }
            return view('ermtemplate.data1tidakditemukan');
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
        if ($dataSet['keluhanutama'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Keluhan pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['tekanandarah'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Tekanan darah pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['frekuensinadi'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi nadi pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['frekuensinafas'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Frekuensi nafas pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
        }
        if ($dataSet['suhutubuh'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'suhu tubuh pasien harus diisi !'
            ];
            echo json_encode($data);
            die;
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
                $cek2 = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
                if (count($cek2) > 0) {
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
        // }
    }
    public function simpanpemeriksaanperawat_igd(Request $request)
    {

        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $data = [
            // 'counter' => $dataSet['counter'],
            'nama_pasien' => $dataSet['namapasien'],
            'alamat' => $dataSet['alamat'],
            'no_rm' => $dataSet['koderegistrasi'],
            'kode_unit' => '1002',
            // 'kode_kunjungan' => $dataSet['kodekunjungan'],
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
            $cek = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE tanggalkunjungan = ? AND no_rm = ?', [$dataSet['tanggalkunjungan'], $dataSet['koderegistrasi']]);
            if (count($cek) > 0) {
                $cek2 = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
                if (count($cek2) > 0) {
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
        if ($dataSet['diagnosakerja'] == '') {
            $data = [
                'kode' => 500,
                'message' => 'Harap isi diagnosa pasien !'
            ];
            echo json_encode($data);
            die;
        }
        // ($dataSet['diagnosakerja']
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
            'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
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
            $data_k = [
                'keluhanutama' =>  trim($dataSet['keluhanutama'])
            ];
            assesmenawalperawat::whereRaw('id = ?', array($dataSet['idasskep']))->update($data_k);
            $cek = DB::select('SELECT * from assesmen_dokters WHERE tgl_kunjungan = ? AND id_pasien = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
            if (count($cek) > 0) {
                $data = [
                    'counter' => $dataSet['counter'],
                    'kode_unit' => $dataSet['unit'],
                    'id_kunjungan' => $dataSet['kodekunjungan'],
                    'id_pasien' => $dataSet['nomorrm'],
                    'id_asskep' => $dataSet['idasskep'],
                    'pic' => auth()->user()->id,
                    'nama_dokter' => auth()->user()->nama,
                    'tgl_kunjungan' => $dataSet['tanggalkunjungan'],
                    'updated_at' => $this->get_now(),
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
                    'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
                    'keadaanumum' => $dataSet['keadaanumum'],
                    'kesadaran' => $dataSet['kesadaran'],
                    'diagnosakerja' => trim($dataSet['diagnosakerja']),
                    'diagnosabanding' => $dataSet['diagnosabanding'],
                    'rencanakerja' => trim($dataSet['rencanakerja']),
                    'keluhan_pasien' => trim($dataSet['keluhanutama']),
                    'status' => '0',
                    'signature' => ''
                ];
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
        if (count($resume) > 0) {
            if ($resume[0]->kode_unit == '1019') {
                $kanan = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kanan']);
                $kiri = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kiri']);
                $hidungkanan = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kanan']);
                $hidungkiri = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kiri']);
                $formkhusus = [
                    'keterangan' => 'tht',
                    'telingakanan' => $kanan,
                    'cek1' => count($kanan),
                    'telingakiri' => $kiri,
                    'cek2' => count($kiri),
                    'hidungkanan' => $hidungkanan,
                    'cek3' => count($hidungkanan),
                    'hidungkiri' => $hidungkiri,
                    'cek4' => count($hidungkiri),
                ];
            } elseif ($resume[0]->kode_unit == '1014') {
                $mata = DB::SELECT('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
                $formkhusus = [
                    'keterangan' => 'mata',
                    'mata' => $mata,
                    'cek' => count($mata)
                ];
            } else if ($resume[0]->kode_unit == '1007') {
                $gigi = DB::SELECT('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
                $formkhusus = [
                    'keterangan' => 'gigi',
                    'gigi' => $gigi,
                    'cek' => count($gigi)
                ];
            } else {
                $gambar = DB::SELECT('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
                $formkhusus = [
                    'keterangan' => 'allin',
                    'gambar' => $gambar,
                    'cek' => count($gambar)
                ];
            }
        } else {
            $formkhusus = [
                'keterangan' => '',
            ];
        }
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan as status_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);

        $riwayat_order = DB::select("SELECT b.status_layanan as status_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);

        $riwayat_order_f = DB::select("SELECT b.kode_layanan_header,b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header
,C.id AS id_detail
,c.kode_barang
,c.aturan_pakai
,c.kategori_resep
,c.satuan_barang
,c.jumlah_layanan
,b.kode_layanan_header
,d.`nama_barang`
,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a
RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
RIGHT OUTER JOIN mt_barang d ON c.kode_barang = d.kode_barang
WHERE a.`kode_kunjungan` = ?
AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$request->kodekunjungan]);

        $riwayat_upload = DB::select('select *,fc_nama_unit2(kode_unit) as nama_unit from erm_upload_gambar where kodekunjungan = ?', [$request->kodekunjungan]);
        return view('ermdokter.resumedokter', compact([
            'resume',
            'formkhusus',
            'riwayat_tindakan',
            'riwayat_order',
            'riwayat_upload',
            'riwayat_order_f'
        ]));
    }
    public function simpanttdperawat(Request $request)
    {
        $data = [
            'tanggalassemen' => $this->get_now(),
            'status' => '1',
            'signature' => 'SUDAH DIVALIDASI'
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
            'signature' => 'SUDAH VALIDASI'
        ];
        $data2 = [
            // 'tanggalassemen' => $this->get_now(),
            'status_order' => '1',
        ];
        assesmenawaldokter::whereRaw('id_kunjungan = ?', array($request->kodekunjungan))->update($data);
        ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_order = ?', array($request->kodekunjungan, 0))->update($data2);
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
        $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$request->kodekunjungan]));
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

        try {
            $kode_unit = $kunjungan[0]->kode_unit;
            //dummy
            $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                //dummy
                DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            }
            $data_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_unit' => $kunjungan['0']->kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            //dummy
            $ts_layanan_header = ts_layanan_header_dummy::create($data_layanan_header);
            $grand_total_tarif = 0;
            foreach ($arrayindex as $d) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $d['tarif'] * $d['qty'];
                } else {
                    $tagihanpenjamin = $d['tarif'] * $d['qty'];
                    $tagihanpribadi = 0;
                }
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $d['kodelayanan'],
                    'total_tarif' => $d['tarif'],
                    'jumlah_layanan' => $d['qty'],
                    'diskon_layanan' => $d['disc'],
                    'total_layanan' => $d['tarif'] * $d['qty'],
                    'grantotal_layanan' => $d['tarif'] * $d['qty'],
                    'kode_dokter1' => auth()->user()->kode_paramedis,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail_dummy::create($save_detail);
                $grand_total_tarif = $grand_total_tarif + $d['tarif'];
            }
            if ($penjamin == 'P01') {
                //dummy
                ts_layanan_header_dummy::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
            } else {
                //dummy
                ts_layanan_header_dummy::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
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
    public function gambartht1(Request $request)
    {
        $cek1 = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.telingakanan', compact([
            'cek1'
        ]));
    }
    public function gambartht2(Request $request)
    {
        $cek1 = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.telingakiri', compact([
            'cek1'
        ]));
    }
    public function simpantht_telinga(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data2 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet2[$index] = $value;
        }

        //telinga kanan
        (empty($dataSet['Lapang'])) ? $a = '' : $a = ' Liang Telinga - lapang';
        (empty($dataSet['Destruksi'])) ? $b = '' : $b = ' Liang Telinga - Destruksi';
        (empty($dataSet['Sempit']))  ? $c = '' : $c = ' Liang Telinga - Sempit';
        (empty($dataSet['Serumen']))  ? $d = '' : $d = ' Liang Telinga - Serumen';
        (empty($dataSet['Kolesteatoma']))  ? $e = '' : $e = ' Liang Telinga - Kolesteatoma';
        (empty($dataSet['Sekret']))  ? $f = '' : $f = ' Liang Telinga - Sekret';
        (empty($dataSet['Massa atau Jaringan']))  ? $g = '' : $g = ' Liang Telinga - Massa atau Jaringan';
        (empty($dataSet['Jamur']))  ? $h = '' : $h = ' Liang Telinga - Jamur';
        (empty($dataSet['Benda Asing']))  ? $i = '' : $i = ' Liang Telinga - Benda Asing';
        (empty($dataSet['LT Lain-Lain']))  ? $j = '' : $j = ' Liang Telinga - Lain - lain';

        (empty($dataSet['Intak - Normal']))  ? $k = '' : $k = ' Intak - Normal';
        (empty($dataSet['Intak - Hiperemis']))  ? $l = '' : $l = ' Intak - Hiperemis';
        (empty($dataSet['Intak - Bulging']))  ? $m = '' : $m = ' Intak - Bulging';
        (empty($dataSet['Intak - Retraksi']))  ? $n = '' : $n = ' Intak - Retraksi';
        (empty($dataSet['Intak - Sklerotik']))  ? $o = '' : $o = ' Intak - Sklerotik';
        (empty($dataSet['Perforasi - Sentral']))  ? $p = '' : $p = ' Perforasi - Sentral';
        (empty($dataSet['Perforasi - Atik']))  ? $q = '' : $q = ' Perforasi - Atik';
        (empty($dataSet['Perforasi - Marginal']))  ? $r = '' : $r = ' Perforasi - Marginal';
        (empty($dataSet['Perforasi - Lain-Lain']))  ? $s = '' : $s = ' Perforasi - Lain-Lain';

        if ($dataSet['ltketeranganlain'] != '') {
            $ltketeranganlain = ' Liang telinga keterangan : ' . $dataSet['ltketeranganlain'];
        } else {
            $ltketeranganlain = '';
        }

        if ($dataSet['mtketeranganlain'] != '') {
            $mtketeranganlain = ' membaran timpan keterangan lain : ' . $dataSet['mtketeranganlain'];
        } else {
            $mtketeranganlain = '';
        }

        if ($dataSet['mukosa'] != '') {
            $mukosa = ' mukosa : ' . $dataSet['mukosa'];
        } else {
            $mukosa = '';
        }

        if ($dataSet['oslkel'] != '') {
            $oslkel = ' oslkel : ' . $dataSet['oslkel'];
        } else {
            $oslkel = '';
        }

        if ($dataSet['Isthmus'] != '') {
            $isthmus = ' Isthmus : ' . $dataSet['Isthmus'];
        } else {
            $isthmus = '';
        }
        if ($dataSet['keteranganlain'] != '') {
            $keteranganlain = ' Keterangan lain : ' . $dataSet['keteranganlain'];
        } else {
            $keteranganlain = '';
        }
        if ($request->kesimpulan != '') {
            $kesimpulan = ' kesimpulan : ' . $request->kesimpulan;
        } else {
            $kesimpulan = '';
        }
        if ($request->anjuran != '') {
            $anjuran = ' anjuran : ' . $request->anjuran;
        } else {
            $anjuran = '';
        }

        $data_telinga_kanan = 'Telinga Kanan : ' . $a . $b . $c . $d . $e . $f . $g . $h . $i . $j . $ltketeranganlain . $k . $l . $m . $n . $o . $p . $q . $r . $s .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
        // dd($data_telinga_kanan);
        //telinga kiri
        (empty($dataSet2['Lapang'])) ? $a1 = '' : $a1 = ' Liang Telinga - lapang';
        (empty($dataSet2['Destruksi'])) ? $b1 = '' : $b1 = ' Liang Telinga - Destruksi';
        (empty($dataSet2['Sempit']))  ? $c1 = '' : $c1 = ' Liang Telinga - Sempit';
        (empty($dataSet2['Serumen']))  ? $d1 = '' : $d1 = ' Liang Telinga - Serumen';
        (empty($dataSet2['Kolesteatoma']))  ? $e1 = '' : $e1 = ' Liang Telinga - Kolesteatoma';
        (empty($dataSet2['Sekret']))  ? $f1 = '' : $f1 = ' Liang Telinga - Sekret';
        (empty($dataSet2['Massa atau Jaringan']))  ? $g1 = '' : $g1 = ' Liang Telinga - Massa atau Jaringan';
        (empty($dataSet2['Jamur']))  ? $h1 = '' : $h1 = ' Liang Telinga - Jamur';
        (empty($dataSet2['Benda Asing']))  ? $i1 = '' : $i1 = ' Liang Telinga - Benda Asing';
        (empty($dataSet2['LT Lain-Lain']))  ? $j1 = '' : $j1 = ' Liang Telinga - Lain - lain';

        (empty($dataSet2['Intak - Normal']))  ? $k1 = '' : $k1 = ' Intak - Normal';
        (empty($dataSet2['Intak - Hiperemis']))  ? $l1 = '' : $l1 = ' Intak - Hiperemis';
        (empty($dataSet2['Intak - Bulging']))  ? $m1 = '' : $m1 = ' Intak - Bulging';
        (empty($dataSet2['Intak - Retraksi']))  ? $n1 = '' : $n1 = ' Intak - Retraksi';
        (empty($dataSet2['Intak - Sklerotik']))  ? $o1 = '' : $o1 = ' Intak - Sklerotik';
        (empty($dataSet2['Perforasi - Sentral']))  ? $p1 = '' : $p1 = ' Perforasi - Sentral';
        (empty($dataSet2['Perforasi - Atik']))  ? $q1 = '' : $q1 = ' Perforasi - Atik';
        (empty($dataSet2['Perforasi - Marginal']))  ? $r1 = '' : $r1 = ' Perforasi - Marginal';
        (empty($dataSet2['Perforasi - Lain-Lain']))  ? $s1 = '' : $s1 = ' Perforasi - Lain-Lain';

        if ($dataSet2['ltketeranganlain'] != '') {
            $ltketeranganlain = ' Liang telinga keterangan : ' . $dataSet2['ltketeranganlain'];
        } else {
            $ltketeranganlain = '';
        }

        if ($dataSet2['mtketeranganlain'] != '') {
            $mtketeranganlain = ' membaran timpan keterangan lain : ' . $dataSet2['mtketeranganlain'];
        } else {
            $mtketeranganlain = '';
        }

        if ($dataSet2['mukosa'] != '') {
            $mukosa = ' mukosa : ' . $dataSet2['mukosa'];
        } else {
            $mukosa = '';
        }

        if ($dataSet2['oslkel'] != '') {
            $oslkel = ' oslkel : ' . $dataSet2['oslkel'];
        } else {
            $oslkel = '';
        }

        if ($dataSet2['Isthmus'] != '') {
            $isthmus = ' Isthmus : ' . $dataSet2['Isthmus'];
        } else {
            $isthmus = '';
        }
        if ($dataSet2['keteranganlain'] != '') {
            $keteranganlain = ' Keterangan lain : ' . $dataSet2['keteranganlain'];
        } else {
            $keteranganlain = '';
        }
        if ($request->kesimpulan != '') {
            $kesimpulan = ' kesimpulan : ' . $request->kesimpulan;
        } else {
            $kesimpulan = '';
        }
        if ($request->anjuran != '') {
            $anjuran = ' anjuran : ' . $request->anjuran;
        } else {
            $anjuran = '';
        }

        $data_telinga_kiri = 'Telinga Kiri : ' . $a1 . $b1 . $c1 . $d1 . $e1 . $f1 . $g1 . $h1 . $i1 . $j1 . $ltketeranganlain . $k1 . $l1 . $m1 . $n1 . $o1 . $p1 . $q1 . $r1 . $s1 .  $mtketeranganlain . $mukosa . $oslkel . $isthmus . $keteranganlain . $kesimpulan . $anjuran;
        $datatelinga1 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'kode_kunjungan' => $kodekunjungan,
            'gambar' => $request->telingakanan,
            'keterangan' => 'telinga kanan',
            'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet['Lapang'],
            'LT_dataSetestruksi' => (empty($dataSet['Destruksi'])) ? 0 : $dataSet['Destruksi'],
            'LT_Sempit' => (empty($dataSet['Sempit']))  ? 0 : $dataSet['Sempit'],
            'LT_Serumen' => (empty($dataSet['Serumen']))  ? 0 : $dataSet['Serumen'],
            'LT_Kolesteatoma' => (empty($dataSet['Kolesteatoma']))  ? 0 : $dataSet['Kolesteatoma'],
            'LT_Sekret' => (empty($dataSet['Sekret']))  ? 0 : $dataSet['Sekret'],
            'LT_Massa_Jaringan' => (empty($dataSet['Massa atau Jaringan']))  ? 0 : $dataSet['Massa atau Jaringan'],
            'LT_Jamur' => (empty($dataSet['Jamur']))  ? 0 : $dataSet['Jamur'],
            'LT_Benda_asing' => (empty($dataSet['Benda Asing']))  ? 0 : $dataSet['Benda Asing'],
            'LT_Lain_lain' => (empty($dataSet['LT Lain-Lain']))  ? 0 : $dataSet['LT Lain-Lain'],
            'LT_Keterangan_lain' => $dataSet['ltketeranganlain'],
            'MT_intak_normal' => (empty($dataSet['Intak - Normal']))  ? 0 : $dataSet['Intak - Normal'],
            'MT_intak_hiperemis' => (empty($dataSet['Intak - Hiperemis']))  ? 0 : $dataSet['Intak - Hiperemis'],
            'MT_intak_bulging' => (empty($dataSet['Intak - Bulging']))  ? 0 : $dataSet['Intak - Bulging'],
            'MT_intak_retraksi' => (empty($dataSet['Intak - Retraksi']))  ? 0 : $dataSet['Intak - Retraksi'],
            'MT_intak_sklerotik' => (empty($dataSet['Intak - Sklerotik']))  ? 0 : $dataSet['Intak - Sklerotik'],
            'MT_perforasi_sentral' => (empty($dataSet['Perforasi - Sentral']))  ? 0 : $dataSet['Perforasi - Sentral'],
            'MT_perforasi_atik' => (empty($dataSet['Perforasi - Atik']))  ? 0 : $dataSet['Perforasi - Atik'],
            'MT_perforasi_marginal' => (empty($dataSet['Perforasi - Marginal']))  ? 0 : $dataSet['Perforasi - Marginal'],
            'MT_perforasi_lain' => (empty($dataSet['Perforasi - Lain-Lain']))  ? 0 : $dataSet['Perforasi - Lain-Lain'],
            'MT_keterangan_lain' => $dataSet['mtketeranganlain'],
            'MT_mukosa' => $dataSet['mukosa'],
            'MT_osikal' => $dataSet['oslkel'],
            'MT_isthmus' => $dataSet['Isthmus'],
            'lain_lain' => $dataSet['keteranganlain'],
            'kesimpulan' => $request->kesimpulan,
            'anjuran' => $request->anjuran,
            'tgl_entry' => $this->get_now()
        ];

        $datatelinga2 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'kode_kunjungan' => $kodekunjungan,
            'gambar' => $request->telingakiri,
            'keterangan' => 'telinga kiri',
            'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
            'LT_dataSetestruksi' => (empty($dataSet2['Destruksi'])) ? 0 : $dataSet2['Destruksi'],
            'LT_Sempit' => (empty($dataSet2['Sempit']))  ? 0 : $dataSet2['Sempit'],
            'LT_Serumen' => (empty($dataSet2['Serumen']))  ? 0 : $dataSet2['Serumen'],
            'LT_Kolesteatoma' => (empty($dataSet2['Kolesteatoma']))  ? 0 : $dataSet2['Kolesteatoma'],
            'LT_Sekret' => (empty($dataSet2['Sekret']))  ? 0 : $dataSet2['Sekret'],
            'LT_Massa_Jaringan' => (empty($dataSet2['Massa atau Jaringan']))  ? 0 : $dataSet2['Massa atau Jaringan'],
            'LT_Jamur' => (empty($dataSet2['Jamur']))  ? 0 : $dataSet2['Jamur'],
            'LT_Benda_asing' => (empty($dataSet2['Benda Asing']))  ? 0 : $dataSet2['Benda Asing'],
            'LT_Lain_lain' => (empty($dataSet2['LT Lain-Lain']))  ? 0 : $dataSet2['LT Lain-Lain'],
            'LT_Keterangan_lain' => $dataSet2['ltketeranganlain'],
            'MT_intak_normal' => (empty($dataSet2['Intak - Normal']))  ? 0 : $dataSet2['Intak - Normal'],
            'MT_intak_hiperemis' => (empty($dataSet2['Intak - Hiperemis']))  ? 0 : $dataSet2['Intak - Hiperemis'],
            'MT_intak_bulging' => (empty($dataSet2['Intak - Bulging']))  ? 0 : $dataSet2['Intak - Bulging'],
            'MT_intak_retraksi' => (empty($dataSet2['Intak - Retraksi']))  ? 0 : $dataSet2['Intak - Retraksi'],
            'MT_intak_sklerotik' => (empty($dataSet2['Intak - Sklerotik']))  ? 0 : $dataSet2['Intak - Sklerotik'],
            'MT_perforasi_sentral' => (empty($dataSet2['Perforasi - Sentral']))  ? 0 : $dataSet2['Perforasi - Sentral'],
            'MT_perforasi_atik' => (empty($dataSet2['Perforasi - Atik']))  ? 0 : $dataSet2['Perforasi - Atik'],
            'MT_perforasi_marginal' => (empty($dataSet2['Perforasi - Marginal']))  ? 0 : $dataSet2['Perforasi - Marginal'],
            'MT_perforasi_lain' => (empty($dataSet2['Perforasi - Lain-Lain']))  ? 0 : $dataSet2['Perforasi - Lain-Lain'],
            'MT_keterangan_lain' => $dataSet2['mtketeranganlain'],
            'MT_mukosa' => $dataSet2['mukosa'],
            'MT_osikal' => $dataSet2['oslkel'],
            'MT_isthmus' => $dataSet2['Isthmus'],
            'lain_lain' => $dataSet2['keteranganlain'],
            'kesimpulan' => $request->kesimpulan,
            'anjuran' => $request->anjuran,
            'tgl_entry' => $this->get_now()
        ];
        $telingakanan = $request->telingakanan;
        $telingakiri = $request->telingakiri;
        $hasilpemeriksaan = $data_telinga_kanan . ' | ' . $data_telinga_kiri;
        try {
            $cek1 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kanan']);
            $cek2 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kiri']);
            $data_telinga = ['gambar_1' => $telingakanan, 'gambar_2' => $telingakiri, 'pemeriksaan_khusus' => $hasilpemeriksaan];
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($data_telinga);
            if (count($cek1) > 0) {
                $datatelinga1 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $kodekunjungan,
                    'gambar' => $request->telingakanan,
                    'keterangan' => 'telinga kanan',
                    'LT_lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
                    'LT_dataSetestruksi' => (empty($dataSet['Destruksi'])) ? 0 : $dataSet['Destruksi'],
                    'LT_Sempit' => (empty($dataSet['Sempit']))  ? 0 : $dataSet['Sempit'],
                    'LT_Serumen' => (empty($dataSet['Serumen']))  ? 0 : $dataSet['Serumen'],
                    'LT_Kolesteatoma' => (empty($dataSet['Kolesteatoma']))  ? 0 : $dataSet['Kolesteatoma'],
                    'LT_Sekret' => (empty($dataSet['Sekret']))  ? 0 : $dataSet['Sekret'],
                    'LT_Massa_Jaringan' => (empty($dataSet['Massa atau Jaringan']))  ? 0 : $dataSet['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($dataSet['Jamur']))  ? 0 : $dataSet['Jamur'],
                    'LT_Benda_asing' => (empty($dataSet['Benda Asing']))  ? 0 : $dataSet['Benda Asing'],
                    'LT_Lain_lain' => (empty($dataSet['LT Lain-Lain']))  ? 0 : $dataSet['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $dataSet['ltketeranganlain'],
                    'MT_intak_normal' => (empty($dataSet['Intak - Normal']))  ? 0 : $dataSet['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($dataSet['Intak - Hiperemis']))  ? 0 : $dataSet['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($dataSet['Intak - Bulging']))  ? 0 : $dataSet['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($dataSet['Intak - Retraksi']))  ? 0 : $dataSet['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($dataSet['Intak - Sklerotik']))  ? 0 : $dataSet['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($dataSet['Perforasi - Sentral']))  ? 0 : $dataSet['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($dataSet['Perforasi - Atik']))  ? 0 : $dataSet['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($dataSet['Perforasi - Marginal']))  ? 0 : $dataSet['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($dataSet['Perforasi - Lain-Lain']))  ? 0 : $dataSet['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $dataSet['mtketeranganlain'],
                    'MT_mukosa' => $dataSet['mukosa'],
                    'MT_osikal' => $dataSet['oslkel'],
                    'MT_isthmus' => $dataSet['Isthmus'],
                    'lain_lain' => $dataSet['keteranganlain'],
                    'kesimpulan' => $request->kesimpulan,
                    'anjuran' => $request->anjuran,
                    'tgl_update' => $this->get_now()
                ];
                ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'telinga kanan'))->update($datatelinga1);
            } else {
                ermtht_telinga::create($datatelinga1);
            }
            if (count($cek2) > 0) {
                $datatelinga2 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'kode_kunjungan' => $kodekunjungan,
                    'gambar' => $request->telingakiri,
                    'keterangan' => 'telinga kiri',
                    'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
                    'LT_dataSetestruksi' => (empty($dataSet2['Destruksi'])) ? 0 : $dataSet2['Destruksi'],
                    'LT_Sempit' => (empty($dataSet2['Sempit']))  ? 0 : $dataSet2['Sempit'],
                    'LT_Serumen' => (empty($dataSet2['Serumen']))  ? 0 : $dataSet2['Serumen'],
                    'LT_Kolesteatoma' => (empty($dataSet2['Kolesteatoma']))  ? 0 : $dataSet2['Kolesteatoma'],
                    'LT_Sekret' => (empty($dataSet2['Sekret']))  ? 0 : $dataSet2['Sekret'],
                    'LT_Massa_Jaringan' => (empty($dataSet2['Massa atau Jaringan']))  ? 0 : $dataSet2['Massa atau Jaringan'],
                    'LT_Jamur' => (empty($dataSet2['Jamur']))  ? 0 : $dataSet2['Jamur'],
                    'LT_Benda_asing' => (empty($dataSet2['Benda Asing']))  ? 0 : $dataSet2['Benda Asing'],
                    'LT_Lain_lain' => (empty($dataSet2['LT Lain-Lain']))  ? 0 : $dataSet2['LT Lain-Lain'],
                    'LT_Keterangan_lain' => $dataSet2['ltketeranganlain'],
                    'MT_intak_normal' => (empty($dataSet2['Intak - Normal']))  ? 0 : $dataSet2['Intak - Normal'],
                    'MT_intak_hiperemis' => (empty($dataSet2['Intak - Hiperemis']))  ? 0 : $dataSet2['Intak - Hiperemis'],
                    'MT_intak_bulging' => (empty($dataSet2['Intak - Bulging']))  ? 0 : $dataSet2['Intak - Bulging'],
                    'MT_intak_retraksi' => (empty($dataSet2['Intak - Retraksi']))  ? 0 : $dataSet2['Intak - Retraksi'],
                    'MT_intak_sklerotik' => (empty($dataSet2['Intak - Sklerotik']))  ? 0 : $dataSet2['Intak - Sklerotik'],
                    'MT_perforasi_sentral' => (empty($dataSet2['Perforasi - Sentral']))  ? 0 : $dataSet2['Perforasi - Sentral'],
                    'MT_perforasi_atik' => (empty($dataSet2['Perforasi - Atik']))  ? 0 : $dataSet2['Perforasi - Atik'],
                    'MT_perforasi_marginal' => (empty($dataSet2['Perforasi - Marginal']))  ? 0 : $dataSet2['Perforasi - Marginal'],
                    'MT_perforasi_lain' => (empty($dataSet2['Perforasi - Lain-Lain']))  ? 0 : $dataSet2['Perforasi - Lain-Lain'],
                    'MT_keterangan_lain' => $dataSet2['mtketeranganlain'],
                    'MT_mukosa' => $dataSet2['mukosa'],
                    'MT_osikal' => $dataSet2['oslkel'],
                    'MT_isthmus' => $dataSet2['Isthmus'],
                    'lain_lain' => $dataSet2['keteranganlain'],
                    'kesimpulan' => $request->kesimpulan,
                    'anjuran' => $request->anjuran,
                    'tgl_update' => $this->get_now()
                ];
                ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'telinga kiri'))->update($datatelinga2);

                $data = [
                    // 'tanggalassemen' => $this->get_now(),
                    'status' => '0',
                    'signature' => ''
                ];
                assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            } else {
                ermtht_telinga::create($datatelinga2);
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
    public function simpantht_hidung(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $data1 = json_decode($_POST['data1'], true);
        $data2 = json_decode($_POST['data2'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data2 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet2[$index] = $value;
        }
        $datahidung1 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'tgl_entry' => $this->get_now(),
            'keterangan' => 'Hidung Kanan',
            'kode_kunjungan' => $kodekunjungan,
            'KN_Lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
            'KN_Sempit' => (empty($dataSet['Sempit'])) ? 0 : $dataSet['Sempit'],
            'KN_Mukosa_pucat' => (empty($dataSet['Mukosa Pucat'])) ? 0 : $dataSet['Mukosa Pucat'],
            'KN_Mukosa_hiperemis' => (empty($dataSet['Mukosa Hiperemis'])) ? 0 : $dataSet['Mukosa Hiperemis'],
            'KN_Mukosa_edema' => (empty($dataSet['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet['Kavum Nasi Mukosa Edema'],
            'KN_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
            'KN_Polip' => (empty($dataSet['Kavum Nasi Polip'])) ? 0 : $dataSet['Kavum Nasi Polip'],
            'KI_Eutrofi' => (empty($dataSet['Eutrofi'])) ? 0 : $dataSet['Eutrofi'],
            'KN_Hipertrofi' => (empty($dataSet['Hipertrofi'])) ? 0 : $dataSet['Hipertrofi'],
            'KN_Atrofi' => (empty($dataSet['Atrofi'])) ? 0 : $dataSet['Atrofi'],
            'MM_Terbuka' => (empty($dataSet['Terbuka'])) ? 0 : $dataSet['Terbuka'],
            'MM_Tertutup' => (empty($dataSet['Tertutup'])) ? 0 : $dataSet['Tertutup'],
            'MM_Mukosa_Edema' => (empty($dataSet['Mukosa Edema'])) ? 0 : $dataSet['Mukosa Edema'],
            'S_Polip' => (empty($dataSet['Septum Polip'])) ? 0 : $dataSet['Septum Polip'],
            'S_Sekret' => (empty($dataSet['Sekret'])) ? 0 : $dataSet['Sekret'],
            'S_Lurus' => (empty($dataSet['Lurus'])) ? 0 : $dataSet['Lurus'],
            'S_Deviasi' => (empty($dataSet['Deviasi'])) ? 0 : $dataSet['Deviasi'],
            'S_Spina' => (empty($dataSet['Spina'])) ? 0 : $dataSet['Spina'],
            'N_Normal' => (empty($dataSet['Normal'])) ? 0 : $dataSet['Normal'],
            'N_Adenoid' => (empty($dataSet['Adenoid'])) ? 0 : $dataSet['Adenoid'],
            'N_Keradangan' => (empty($dataSet['Keradangan'])) ? 0 : $dataSet['Keradangan'],
            'N_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
            'lain_lain' => $dataSet['lain-lain'],
            'kesimpulan' => $request->kesimpulan
        ];

        $KN_Lapang = (empty($dataSet['Lapang'])) ? '' : ' Kavum nasi lapang ';
        $KN_Sempit = (empty($dataSet['Sempit'])) ? '' : ' Kavum nasi sempit ';
        $KN_Mukosa_pucat = (empty($dataSet['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
        $KN_Mukosa_hiperemis = (empty($dataSet['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
        $KN_Mukosa_edema = (empty($dataSet['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
        $KN_Massa = (empty($dataSet['Massa'])) ? '' : ' Kavum nasi massa ';
        $KN_Polip = (empty($dataSet['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
        $KI_Eutrofi = (empty($dataSet['Eutrofi'])) ? '' : ' Konka eutrofi ';
        $KN_Hipertrofi = (empty($dataSet['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
        $KN_Atrofi = (empty($dataSet['Atrofi'])) ? '' : ' Konka atrofi ';
        $MM_Terbuka  =  (empty($dataSet['Terbuka'])) ? '' : ' Meatus medius terbuka ';
        $MM_Tertutup  =  (empty($dataSet['Tertutup'])) ? '' : ' Meatus medius tertutup ';
        $MM_Mukosa_Edema  =  (empty($dataSet['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
        $S_Polip  = (empty($dataSet['Septum Polip'])) ? '' : ' Septum polip ';
        $S_Sekret  = (empty($dataSet['Sekret'])) ? '' : ' Septum sekret ';
        $S_Lurus  = (empty($dataSet['Lurus'])) ? '' : ' Septum lurus ';
        $S_Deviasi  = (empty($dataSet['Deviasi'])) ? '' : ' Septum Deviasi ';
        $S_Spina  = (empty($dataSet['Spina'])) ? '' : ' Septum Spina ';
        $N_Normal  = (empty($dataSet['Normal'])) ? '' : ' Nasofaring Normal ';
        $N_Adenoid  = (empty($dataSet['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
        $N_Keradangan  = (empty($dataSet['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
        $N_Massa  = (empty($dataSet['Massa'])) ? '' : ' Nasofaring Massa ';
        $lain_lain  = $dataSet['lain-lain'];
        $kesimpulan  = 'Kesimpulan : ' . $request->kesimpulan;

        $_KN_Lapang = (empty($dataSet2['Lapang'])) ? '' : ' Kavum nasi lapang ';
        $_KN_Sempit = (empty($dataSet2['Sempit'])) ? '' : ' Kavum nasi sempit ';
        $_KN_Mukosa_pucat = (empty($dataSet2['Mukosa Pucat'])) ? '' : ' Kavum nasi mukosa pucat ';
        $_KN_Mukosa_hiperemis = (empty($dataSet2['Mukosa Hiperemis'])) ? '' : ' Kavum nasi mukosa hiperemis ';
        $_KN_Mukosa_edema = (empty($dataSet2['Kavum Nasi Mukosa Edema'])) ? '' : ' Kavum nasi mukosa edema ';
        $_KN_Massa = (empty($dataSet2['Massa'])) ? '' : ' Kavum nasi massa ';
        $_KN_Polip = (empty($dataSet2['Kavum Nasi Polip'])) ? '' : ' Kavum nasi polip ';
        $_KI_Eutrofi = (empty($dataSet2['Eutrofi'])) ? '' : ' Konka eutrofi ';
        $_KN_Hipertrofi = (empty($dataSet2['Hipertrofi'])) ? '' : ' Konka hipertrofi ';
        $_KN_Atrofi = (empty($dataSet2['Atrofi'])) ? '' : ' Konka atrofi ';
        $_MM_Terbuka  =  (empty($dataSet2['Terbuka'])) ? '' : ' Meatus medius terbuka ';
        $_MM_Tertutup  =  (empty($dataSet2['Tertutup'])) ? '' : ' Meatus medius tertutup ';
        $_MM_Mukosa_Edema  =  (empty($dataSet2['Mukosa Edema'])) ? '' : ' Meatus medius mukosa edema ';
        $_S_Polip  = (empty($dataSet2['Septum Polip'])) ? '' : ' Septum polip ';
        $_S_Sekret  = (empty($dataSet2['Sekret'])) ? '' : ' Septum sekret ';
        $_S_Lurus  = (empty($dataSet2['Lurus'])) ? '' : ' Septum lurus ';
        $_S_Deviasi  = (empty($dataSet2['Deviasi'])) ? '' : ' Septum Deviasi ';
        $_S_Spina  = (empty($dataSet2['Spina'])) ? '' : ' Septum Spina ';
        $_N_Normal  = (empty($dataSet2['Normal'])) ? '' : ' Nasofaring Normal ';
        $_N_Adenoid  = (empty($dataSet2['Adenoid'])) ? '' : ' Nasofaring Adenoid ';
        $_N_Keradangan  = (empty($dataSet2['Keradangan'])) ? '' : ' Nasofaring Keradangan ';
        $_N_Massa  = (empty($dataSet2['Massa'])) ? '' : ' Nasofaring Massa ';
        $_lain_lain  = $dataSet2['lain-lain'];
        $_kesimpulan  = ' Kesimpulan : ' . $request->kesimpulan;

        $hidungkanan = 'Hidung Kanan : ' . $KN_Lapang . $KN_Sempit . $KN_Mukosa_pucat . $KN_Mukosa_pucat . $KN_Mukosa_hiperemis . $KN_Mukosa_edema . $KN_Massa . $KN_Polip . $KI_Eutrofi . $KN_Hipertrofi . $KN_Atrofi . $MM_Terbuka . $MM_Tertutup . $MM_Mukosa_Edema . $S_Polip . $S_Sekret . $S_Lurus . $S_Deviasi . $S_Spina . $N_Normal . $N_Adenoid . $N_Keradangan . $N_Massa . $lain_lain . $kesimpulan;

        $hidungkiri = 'Hidung Kiri : ' . $_KN_Lapang . $_KN_Sempit . $_KN_Mukosa_pucat . $_KN_Mukosa_pucat . $_KN_Mukosa_hiperemis . $_KN_Mukosa_edema . $_KN_Massa . $_KN_Polip . $_KI_Eutrofi . $_KN_Hipertrofi . $_KN_Atrofi . $_MM_Terbuka . $_MM_Tertutup . $_MM_Mukosa_Edema . $_S_Polip . $_S_Sekret . $_S_Lurus . $_S_Deviasi . $_S_Spina . $_N_Normal . $_N_Adenoid . $_N_Keradangan . $_N_Massa . $_lain_lain . $_kesimpulan;


        $datahidung2 = [
            'id_assesmen_dokter' => $request->idassesmen,
            'nama_dokter' => auth()->user()->nama,
            'no_rm' => $request->nomorrm,
            'id_dokter' => auth()->user()->id,
            'status' => '0',
            'keterangan' => 'Hidung Kiri',
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $kodekunjungan,
            'KN_Lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
            'KN_Sempit' => (empty($dataSet2['Sempit'])) ? 0 : $dataSet2['Sempit'],
            'KN_Mukosa_pucat' => (empty($dataSet2['Mukosa Pucat'])) ? 0 : $dataSet2['Mukosa Pucat'],
            'KN_Mukosa_hiperemis' => (empty($dataSet2['Mukosa Hiperemis'])) ? 0 : $dataSet2['Mukosa Hiperemis'],
            'KN_Mukosa_edema' => (empty($dataSet2['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet2['Kavum Nasi Mukosa Edema'],
            'KN_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
            'KN_Polip' => (empty($dataSet2['Kavum Nasi Polip'])) ? 0 : $dataSet2['Kavum Nasi Polip'],
            'KI_Eutrofi' => (empty($dataSet2['Eutrofi'])) ? 0 : $dataSet2['Eutrofi'],
            'KI_Hipertrofi' => (empty($dataSet2['Hipertrofi'])) ? 0 : $dataSet2['Hipertrofi'],
            'KI_Atrofi' => (empty($dataSet2['Atrofi'])) ? 0 : $dataSet2['Atrofi'],
            'MM_Terbuka' => (empty($dataSet2['Terbuka'])) ? 0 : $dataSet2['Terbuka'],
            'MM_Tertutup' => (empty($dataSet2['Tertutup'])) ? 0 : $dataSet2['Tertutup'],
            'MM_Mukosa_Edema' => (empty($dataSet2['Mukosa Edema'])) ? 0 : $dataSet2['Mukosa Edema'],
            'S_Polip' => (empty($dataSet2['Septum Polip'])) ? 0 : $dataSet2['Septum Polip'],
            'S_Sekret' => (empty($dataSet2['Sekret'])) ? 0 : $dataSet2['Sekret'],
            'S_Lurus' => (empty($dataSet2['Lurus'])) ? 0 : $dataSet2['Lurus'],
            'S_Deviasi' => (empty($dataSet2['Deviasi'])) ? 0 : $dataSet2['Deviasi'],
            'S_Spina' => (empty($dataSet2['Spina'])) ? 0 : $dataSet2['Spina'],
            'N_Normal' => (empty($dataSet2['Normal'])) ? 0 : $dataSet2['Normal'],
            'N_Adenoid' => (empty($dataSet2['Adenoid'])) ? 0 : $dataSet2['Adenoid'],
            'N_Keradangan' => (empty($dataSet2['Keradangan'])) ? 0 : $dataSet2['Keradangan'],
            'N_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
            'lain_lain' => $dataSet2['lain-lain'],
            'kesimpulan' => $request->kesimpulan,
        ];
        $hasilpemeriksaan = $hidungkanan . ' | ' . $hidungkiri;
        try {
            $cek1 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'Hidung Kanan']);
            $cek2 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'Hidung Kiri']);
            $datahidung = ['pemeriksaan_khusus_2' => $hasilpemeriksaan];
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($datahidung);
            if (count($cek1) > 0) {
                $datahidung1 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'keterangan' => 'Hidung Kanan',
                    'tgl_update' => $this->get_now(),
                    'kode_kunjungan' => $kodekunjungan,
                    'KN_Lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
                    'KN_Sempit' => (empty($dataSet['Sempit'])) ? 0 : $dataSet['Sempit'],
                    'KN_Mukosa_pucat' => (empty($dataSet['Mukosa Pucat'])) ? 0 : $dataSet['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($dataSet['Mukosa Hiperemis'])) ? 0 : $dataSet['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($dataSet['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
                    'KN_Polip' => (empty($dataSet['Kavum Nasi Polip'])) ? 0 : $dataSet['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($dataSet['Eutrofi'])) ? 0 : $dataSet['Eutrofi'],
                    'KI_Hipertrofi' => (empty($dataSet['Hipertrofi'])) ? 0 : $dataSet['Hipertrofi'],
                    'KI_Atrofi' => (empty($dataSet['Atrofi'])) ? 0 : $dataSet['Atrofi'],
                    'MM_Terbuka' => (empty($dataSet['Terbuka'])) ? 0 : $dataSet['Terbuka'],
                    'MM_Tertutup' => (empty($dataSet['Tertutup'])) ? 0 : $dataSet['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($dataSet['Mukosa Edema'])) ? 0 : $dataSet['Mukosa Edema'],
                    'S_Polip' => (empty($dataSet['Septum Polip'])) ? 0 : $dataSet['Septum Polip'],
                    'S_Sekret' => (empty($dataSet['Sekret'])) ? 0 : $dataSet['Sekret'],
                    'S_Lurus' => (empty($dataSet['Lurus'])) ? 0 : $dataSet['Lurus'],
                    'S_Deviasi' => (empty($dataSet['Deviasi'])) ? 0 : $dataSet['Deviasi'],
                    'S_Spina' => (empty($dataSet['Spina'])) ? 0 : $dataSet['Spina'],
                    'N_Normal' => (empty($dataSet['Normal'])) ? 0 : $dataSet['Normal'],
                    'N_Adenoid' => (empty($dataSet['Adenoid'])) ? 0 : $dataSet['Adenoid'],
                    'N_Keradangan' => (empty($dataSet['Keradangan'])) ? 0 : $dataSet['Keradangan'],
                    'N_Massa' => (empty($dataSet['Massa'])) ? 0 : $dataSet['Massa'],
                    'lain_lain' => $dataSet['lain-lain'],
                    'kesimpulan' => $request->kesimpulan,
                ];
                erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'Hidung Kanan'))->update($datahidung1);
            } else {
                erm_tht_hidung::create($datahidung1);
            }

            if (count($cek2) > 0) {
                $datahidung2 = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'nama_dokter' => auth()->user()->nama,
                    'no_rm' => $request->nomorrm,
                    'id_dokter' => auth()->user()->id,
                    'status' => '0',
                    'keterangan' => 'Hidung Kiri',
                    'tgl_update' => $this->get_now(),
                    'kode_kunjungan' => $kodekunjungan,
                    'KN_Lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
                    'KN_Sempit' => (empty($dataSet2['Sempit'])) ? 0 : $dataSet2['Sempit'],
                    'KN_Mukosa_pucat' => (empty($dataSet2['Mukosa Pucat'])) ? 0 : $dataSet2['Mukosa Pucat'],
                    'KN_Mukosa_hiperemis' => (empty($dataSet2['Mukosa Hiperemis'])) ? 0 : $dataSet2['Mukosa Hiperemis'],
                    'KN_Mukosa_edema' => (empty($dataSet2['Kavum Nasi Mukosa Edema'])) ? 0 : $dataSet2['Kavum Nasi Mukosa Edema'],
                    'KN_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
                    'KN_Polip' => (empty($dataSet2['Kavum Nasi Polip'])) ? 0 : $dataSet2['Kavum Nasi Polip'],
                    'KI_Eutrofi' => (empty($dataSet2['Eutrofi'])) ? 0 : $dataSet2['Eutrofi'],
                    'KI_Hipertrofi' => (empty($dataSet2['Hipertrofi'])) ? 0 : $dataSet2['Hipertrofi'],
                    'KI_Atrofi' => (empty($dataSet2['Atrofi'])) ? 0 : $dataSet2['Atrofi'],
                    'MM_Terbuka' => (empty($dataSet2['Terbuka'])) ? 0 : $dataSet2['Terbuka'],
                    'MM_Tertutup' => (empty($dataSet2['Tertutup'])) ? 0 : $dataSet2['Tertutup'],
                    'MM_Mukosa_Edema' => (empty($dataSet2['Mukosa Edema'])) ? 0 : $dataSet2['Mukosa Edema'],
                    'S_Polip' => (empty($dataSet2['Septum Polip'])) ? 0 : $dataSet2['Septum Polip'],
                    'S_Sekret' => (empty($dataSet2['Sekret'])) ? 0 : $dataSet2['Sekret'],
                    'S_Lurus' => (empty($dataSet2['Lurus'])) ? 0 : $dataSet2['Lurus'],
                    'S_Deviasi' => (empty($dataSet2['Deviasi'])) ? 0 : $dataSet2['Deviasi'],
                    'S_Spina' => (empty($dataSet2['Spina'])) ? 0 : $dataSet2['Spina'],
                    'N_Normal' => (empty($dataSet2['Normal'])) ? 0 : $dataSet2['Normal'],
                    'N_Adenoid' => (empty($dataSet2['Adenoid'])) ? 0 : $dataSet2['Adenoid'],
                    'N_Keradangan' => (empty($dataSet2['Keradangan'])) ? 0 : $dataSet2['Keradangan'],
                    'N_Massa' => (empty($dataSet2['Massa'])) ? 0 : $dataSet2['Massa'],
                    'lain_lain' => $dataSet2['lain-lain'],
                    'kesimpulan' => $request->kesimpulan,
                ];
                erm_tht_hidung::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'Hidung Kiri'))->update($datahidung2);
            } else {
                erm_tht_hidung::create($datahidung2);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
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
    public function simpanformmata(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $data1 = json_decode($_POST['data'], true);
        foreach ($data1 as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $datamata = [
            'id_assesmen_dokter' => $request->idassesmen,
            'no_rm' => $request->nomorrm,
            'nama_dokter' => auth()->user()->nama,
            'id_dokter' => auth()->user()->id,
            'kode_kunjungan' => $kodekunjungan,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'vd_od' => $dataSet['od_visus_dasar'],
            'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
            'vd_os' => $dataSet['os_visus_dasar'],
            'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
            'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
            'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
            'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
            'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
            'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
            'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
            'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
            'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
            'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
            'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
            'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
            'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
            'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
            'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
            'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
            'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
            'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
            'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
            'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
            'tekananintraokular' => $dataSet['tekanan_intra_okular'],
            'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
            'palpebra' => $dataSet['palpebra'],
            'konjungtiva' => $dataSet['konjungtiva'],
            'kornea' => $dataSet['kornea'],
            'bilikmatadepan' => $dataSet['bilik_mata_depan'],
            'pupil' => $dataSet['pupil'],
            'iris' => $dataSet['iris'],
            'lensa' => $dataSet['lensa'],
            'funduskopi' => $dataSet['funduskopi'],
            'status_oftamologis_khusus' => $dataSet['oftamologis'],
            'masalahmedis' => $dataSet['masalahmedis'],
            'prognosis' => $dataSet['prognosis'],
            'matakanan' => $request->matakanan,
            'matakiri' => $request->matakiri,
        ];
        $matakanan = $request->matakanan;
        $matakiri = $request->matakiri;
        try {
            $cek = DB::select('select * from erm_mata_kanan_kiri where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
            $hasil_pemeriksaan_khusus = "visus dasar : " . " OD : " . $dataSet['od_visus_dasar'] . " OD PINHOLE : " . $dataSet['od_pinhole_visus_dasar'] . " OS : " . $dataSet['os_visus_dasar'] .  " OS PINHOLE : " . $dataSet['os_pinhole_visus_dasar'] . " | Refraktometer / streak : " . "  OD : Sph : " . $dataSet['od_sph_refraktometer'] . " Cyl : " . $dataSet['od_cyl_refraktometer'] . " X : " . $dataSet['od_x_refraktometer'] . "  OS : Sph  : " . $dataSet['os_sph_refraktometer'] . " Cyl : " . $dataSet['os_cyl_refraktometer'] . " X : " . $dataSet['os_x_refraktometer'] . " Lensometer : " . "  OD : Sph  :" . $dataSet['od_sph_Lensometer'] . " Cyl : " . $dataSet['od_cyl_Lensometer'] . " X : " . $dataSet['od_x_Lensometer'] . "  OS : Sph : " . $dataSet['os_sph_Lensometer'] . " Cyl : " . $dataSet['os_cyl_Lensometer'] . " X : " . $dataSet['os_x_Lensometer'] . " | Koreksi penglihatan jauh : " . "  VOD : Sph : " . $dataSet['vod_sph_kpj'] . " Cyl : " . $dataSet['vod_cyl_kpj'] . " X : " . $dataSet['vod_x_kpj'] . "  VOS : Sph  : " . $dataSet['vos_sph_kpj'] . " Cyl : " . $dataSet['vos_cyl_kpj'] . "X :" . $dataSet['vos_x_kpj'] . " | Tajam penglihatan dekat : " . $dataSet['penglihatan_dekat'] . " | Tekanan Intra Okular : " . $dataSet['tekanan_intra_okular'] . " | Catatan Pemeriksaan Lainnya : " . $dataSet['catatan_pemeriksaan_lainnya'] . " | Palpebra : " . $dataSet['palpebra'] . " | Konjungtiva : " . $dataSet['konjungtiva'] . "| Kornea : " . $dataSet['kornea'] . " | Bilik Mata Depan : " . $dataSet['bilik_mata_depan'] . " | pupil : " . $dataSet['pupil'] . " | Iris : " . $dataSet['iris'] . " | Lensa : " . $dataSet['lensa'] . " | funduskopi : " . $dataSet['funduskopi'] . " | Status Oftalmologis Khusus : " . $dataSet['oftamologis'] . "| Masalah Medis : " . $dataSet['masalahmedis'] . " | Prognosis : " . $dataSet['prognosis'];

            $data_mata = ['gambar_1' => $matakanan, 'gambar_2' => $matakiri, 'pemeriksaan_khusus' => $hasil_pemeriksaan_khusus];
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($data_mata);
            if (count($cek) > 0) {
                $datamata = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'no_rm' => $request->nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_update' => $this->get_now(),
                    'status' => '0',
                    'vd_od' => $dataSet['od_visus_dasar'],
                    'vd_od_pinhole' => $dataSet['od_pinhole_visus_dasar'],
                    'vd_os' => $dataSet['os_visus_dasar'],
                    'vd_os_pinhole' => $dataSet['os_pinhole_visus_dasar'],
                    'refraktometer_od_sph' => $dataSet['od_sph_refraktometer'],
                    'refraktometer_od_cyl' => $dataSet['od_cyl_refraktometer'],
                    'refraktometer_od_x' => $dataSet['od_x_refraktometer'],
                    'refraktometer_os_sph' => $dataSet['os_sph_refraktometer'],
                    'refraktometer_os_cyl' => $dataSet['os_cyl_refraktometer'],
                    'refraktometer_os_x' => $dataSet['os_x_refraktometer'],
                    'Lensometer_od_sph' => $dataSet['od_sph_Lensometer'],
                    'Lensometer_od_cyl' => $dataSet['od_cyl_Lensometer'],
                    'Lensometer_od_x' => $dataSet['od_x_Lensometer'],
                    'Lensometer_os_sph' => $dataSet['os_sph_Lensometer'],
                    'Lensometer_os_cyl' => $dataSet['os_cyl_Lensometer'],
                    'Lensometer_os_x' => $dataSet['os_x_Lensometer'],
                    'koreksipenglihatan_vod_sph' => $dataSet['vod_sph_kpj'],
                    'koreksipenglihatan_vod_cyl' => $dataSet['vod_cyl_kpj'],
                    'koreksipenglihatan_vod_x' => $dataSet['vod_x_kpj'],
                    'koreksipenglihatan_vos_sph' => $dataSet['vos_sph_kpj'],
                    'koreksipenglihatan_vos_cyl' => $dataSet['vos_cyl_kpj'],
                    'koreksipenglihatan_vos_x' => $dataSet['vos_x_kpj'],
                    'tajampenglihatandekat' => $dataSet['penglihatan_dekat'],
                    'tekananintraokular' => $dataSet['tekanan_intra_okular'],
                    'catatanpemeriksaanlain' => $dataSet['catatan_pemeriksaan_lainnya'],
                    'palpebra' => $dataSet['palpebra'],
                    'konjungtiva' => $dataSet['konjungtiva'],
                    'kornea' => $dataSet['kornea'],
                    'bilikmatadepan' => $dataSet['bilik_mata_depan'],
                    'pupil' => $dataSet['pupil'],
                    'iris' => $dataSet['iris'],
                    'lensa' => $dataSet['lensa'],
                    'funduskopi' => $dataSet['funduskopi'],
                    'status_oftamologis_khusus' => $dataSet['oftamologis'],
                    'masalahmedis' => $dataSet['masalahmedis'],
                    'prognosis' => $dataSet['prognosis'],
                    'matakanan' => $request->matakanan,
                    'matakiri' => $request->matakiri,
                ];
                erm_mata_kanan_kiri::whereRaw('id_assesmen_dokter = ? and kode_kunjungan = ?', array($request->idassesmen, $kodekunjungan))->update($datamata);
            } else {
                erm_mata_kanan_kiri::create($datamata);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
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
    public function simpanformgigi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $datagigi = [
            'id_assesmen_dokter' => $request->idassesmen,
            'no_rm' => $request->nomorrm,
            'nama_dokter' => auth()->user()->nama,
            'id_dokter' => auth()->user()->id,
            'kode_kunjungan' => $kodekunjungan,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'gambargigi' => $request->gambargigi
        ];
        try {
            $datagigi = ['gambar_1' => $request->gambargigi];
            $cek = DB::select('select * from erm_gambar_gigi where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($datagigi);
            if (count($cek) > 0) {
                $datagigi = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'no_rm' => $request->nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_update' => $this->get_now(),
                    'status' => '0',
                    'gambargigi' => $request->gambargigi
                ];
                erm_gambar_gigi::whereRaw('id_assesmen_dokter = ? and kode_kunjungan = ?', array($request->idassesmen, $kodekunjungan))->update($datagigi);
            } else {
                erm_gambar_gigi::create($datagigi);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
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
    public function simpangambarbebas(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $datapolos = [
            'id_assesmen_dokter' => $request->idassesmen,
            'no_rm' => $request->nomorrm,
            'nama_dokter' => auth()->user()->nama,
            'id_dokter' => auth()->user()->id,
            'kode_kunjungan' => $kodekunjungan,
            'tgl_entry' => $this->get_now(),
            'status' => '0',
            'kode_unit' => auth()->user()->unit,
            'catatangambar' => $request->gambarpolos
        ];
        $gambar = [
            'gambar_1' => $request->gambarpolos
        ];
        try {
            $cek = DB::select('select * from erm_catatan_gambar where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
            assesmenawaldokter::whereRaw('id = ?', array($request->idassesmen))->update($gambar);
            if (count($cek) > 0) {
                $datapolos = [
                    'id_assesmen_dokter' => $request->idassesmen,
                    'no_rm' => $request->nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_update' => $this->get_now(),
                    'status' => '0',
                    'kode_unit' => auth()->user()->unit,
                    'catatangambar' => $request->gambarpolos
                ];
                erm_catatan_gambar::whereRaw('id_assesmen_dokter = ? and kode_kunjungan = ?', array($request->idassesmen, $kodekunjungan))->update($datapolos);
            } else {
                erm_catatan_gambar::create($datapolos);
            }
            $data = [
                // 'tanggalassemen' => $this->get_now(),
                'status' => '0',
                'signature' => ''
            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
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
    public function createLayanandetail()
    {
        //dummy
        $q = DB::connection('mysql4')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    public function createLayanandetailOrder()
    {
        //dummy
        $q = DB::connection('mysql4')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail_order
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    public function tindakanhariini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan', compact([
            'riwayat_tindakan'
        ]));
    }
    public function orderhari_ini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder', compact([
            'riwayat_tindakan'
        ]));
    }
    public function orderobathariini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::select("SELECT
        b.kode_layanan_header
        ,b.status_layanan AS status_layanan_header
        ,a.kode_kunjungan,b.id AS id_header
        ,C.id AS id_detail
        ,c.kode_barang
        ,c.aturan_pakai
        ,c.kategori_resep
        ,c.satuan_barang
        ,c.jumlah_layanan
        ,b.kode_layanan_header
        ,d.`nama_barang`
        ,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_barang d ON c.kode_barang = d.kode_barang
        WHERE a.`kode_kunjungan` = ?
        AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder_farmasi', compact([
            'riwayat_order'
        ]));
    }
    public function riwayattindakan(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan', compact([
            'riwayat_tindakan'
        ]));
    }
    public function riwayattindakan2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan2', compact([
            'riwayat_tindakan'
        ]));
    }
    public function riwayatorder2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::select("SELECT b.status_layanan AS status_layanan_header,a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder2', compact([
            'riwayat_tindakan'
        ]));
    }
    public function riwayatorderfarmasi2(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::select("SELECT
        b.kode_layanan_header
        ,b.status_layanan AS status_layanan_header
        ,a.kode_kunjungan,b.id AS id_header
        ,C.id AS id_detail
        ,c.kode_barang
        ,c.aturan_pakai
        ,c.kategori_resep
        ,c.satuan_barang
        ,c.jumlah_layanan
        ,b.kode_layanan_header
        ,d.`nama_barang`
        ,c.`kode_tarif_detail` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header_order b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail_order c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_barang d ON c.kode_barang = d.kode_barang
        WHERE a.`kode_kunjungan` = ?
        AND LEFT(b.kode_layanan_header,3) = 'ORF'", [$request->kodekunjungan]);
        return view('ermdokter.riwayatorder_farmasi2', compact([
            'riwayat_order'
        ]));
    }
    public function pemeriksaankhususon(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        if ($kunjungan[0]->kode_unit == '1019') {
            $kanan = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kanan']);
            $kiri = DB::SELECT('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kiri']);
            $hidungkanan = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kanan']);
            $hidungkiri = DB::SELECT('select * from erm_tht_hidung where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'Hidung Kiri']);
            return view('ermtemplate.hasilpemeriksaan_tht', compact([
                'kanan',
                'kiri',
                'hidungkanan',
                'hidungkiri',
            ]));
        } else if ($kunjungan[0]->kode_unit == '1014') {
            $mata = DB::SELECT('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
            $formkhusus = [
                'keterangan' => 'mata',
                'mata' => $mata,
                'cek' => count($mata)
            ];
            return view('ermtemplate.hasilpemeriksaan_mata', compact([
                'formkhusus'
            ]));
        } else if ($kunjungan[0]->kode_unit == '1007') {
            $gigi = DB::SELECT('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
            $formkhusus = [
                'keterangan' => 'gigi',
                'gigi' => $gigi,
                'cek' => count($gigi)
            ];
            return view('ermtemplate.hasilpemeriksaan_gigi', compact([
                'formkhusus'
            ]));
        } else {
            $gambar = DB::SELECT('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
            $formkhusus = [
                'keterangan' => 'allin',
                'gambar' => $gambar,
                'cek' => count($gambar)
            ];
            return view('ermtemplate.hasilpemeriksaan_catatangambar', compact([
                'formkhusus'
            ]));
        }
    }
    public function cetakresume($kodekunjungan)
    {
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare("SELECT *,fc_nama_px(a.`no_rm`) AS nama_pasien,fc_alamat(a.`no_rm`) AS alamat,fc_nama_unit1(a.`kode_unit`) AS unit  FROM erm_hasil_assesmen_keperawatan_rajal a
        LEFT OUTER JOIN assesmen_dokters b ON a.id = b.`id_asskep` WHERE a.`kode_kunjungan` = $kodekunjungan");
        $QUERY->execute();
        $data = $QUERY->fetchAll();
        // $filename = __DIR__ . '/cppt_fix.jrxml';
        $filename = 'C:\cetakanerm\cppt_fix.jrxml';
        $config = ['driver' => 'array', 'data' => $data];
        $report = new PHPJasperXML();
        $report->load_xml_file($filename)
            ->setDataSource($config)
            ->export('Pdf');
    }
    public function cetakresumeperawat($rm,$counter)
    {
        $PDO = DB::connection()->getPdo();
        $QUERY = $PDO->prepare("CALL SP_ASSESMEN_KEPERAWATAN_RAJAL_DEWASA('$rm','$counter')");
        $QUERY->execute();
        $data = $QUERY->fetchAll();
        $filename = 'C:\cetakanerm\RESUME_PERAWAT.jrxml';
        $config = ['driver' => 'array', 'data' => $data];
        $report = new PHPJasperXML();
        $report->load_xml_file($filename)
            ->setDataSource($config)
            ->export('Pdf');
    }
    public function ambilicd10()
    {
        $icd10 = DB::select('SELECT * FROM mt_icd10 limit 50');
        return view('ermtemplate.icd10kerja', compact([
            'icd10'
        ]));
    }
    public function ambilicd10_banding()
    {
        $icd10 = DB::select('SELECT * FROM mt_icd10 limit 50');
        return view('ermtemplate.icd10kerja_banding', compact([
            'icd10'
        ]));
    }
    public function ambilicd9()
    {
        $icd9 = DB::select('SELECT * FROM mt_icd9 limit 50');
        return view('ermtemplate.icd9kerja', compact([
            'icd9'
        ]));
    }
    public function ambilicd9_banding()
    {
        $icd9 = DB::select('SELECT * FROM mt_icd9 limit 50');
        return view('ermtemplate.icd9banding', compact([
            'icd9'
        ]));
    }
    public function cariicd10(Request $request)
    {
        $icd10 = DB::table('mt_icd10')
            ->select('*')
            ->where('nama', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd10kerja_cari', compact([
            'icd10'
        ]));
    }
    public function cariicd10_banding(Request $request)
    {
        $icd10 = DB::table('mt_icd10')
            ->select('*')
            ->where('nama', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd10banding_cari', compact([
            'icd10'
        ]));
    }
    public function cariicd9(Request $request)
    {
        $icd9 = DB::table('mt_icd9')
            ->select('*')
            ->where('nama_pendek', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd9kerja_cari', compact([
            'icd9'
        ]));
    }
    public function cariicd9_banding(Request $request)
    {
        $icd9 = DB::table('mt_icd9')
            ->select('*')
            ->where('nama_pendek', 'like', '%' . $request->key . '%')
            ->orWhere('diag', 'like', '%' . $request->key . '%')
            ->limit('50')
            ->get();
        // $icd10 = DB::select('SELECT * FROM mt_icd10 where nama LIKE ?',['%'.$request->key.'%']);
        return view('ermtemplate.icd9banding_cari', compact([
            'icd9'
        ]));
    }
    public function gambarmatakanan(Request $request)
    {
        $cek1 = DB::select('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.matakanan', compact([
            'cek1'
        ]));
    }
    public function gambarmatakiri(Request $request)
    {
        $cek1 = DB::select('select * from erm_mata_kanan_kiri where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.matakiri', compact([
            'cek1'
        ]));
    }
    public function gambargigi(Request $request)
    {
        $cek1 = DB::select('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.gigi', compact([
            'cek1'
        ]));
    }
    public function gambarnyeri(Request $request)
    {
        // $cek1 = DB::select('select * from erm_gambar_gigi where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.gambarnyeri');
    }
    public function gambarcatatan(Request $request)
    {
        $cek1 = DB::select('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
        return view('ermtemplate.gambarkosong', compact([
            'cek1'
        ]));
    }
    public function gambarcatatan_igd(Request $request)
    {
        $cek1 = DB::select('select * from erm_catatan_gambar where kode_kunjungan = ? and kode_unit = ?', [$request->kodekunjungan, auth()->user()->unit]);
        return view('ermtemplate.gambarnyeri', compact([
            'cek1'
        ]));
    }
    public function indexpelayanandokter()
    {
        $title = 'SIMRS - Riwayat Pelayanan Dokter';
        $sidebar = 'pelayanandokter';
        $sidebar_m = '2';
        return view('ermdokter.indexpelayanan', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function riwayatpemeriksaan_byrm()
    {
        $title = 'SIMRS - Riwayat Pelayanan Dokter';
        $sidebar = 'caripasien_resume';
        $sidebar_m = '2';
        return view('ermdokter.riwayatpasien_rm', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function ambilriwayat_pasien()
    {
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));
        if (auth()->user()->unit == '1002') {
            $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,a.nama_pasien AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.kode_unit = ? AND DATE(a.tanggalkunjungan) BETWEEN ? AND ?', [auth()->user()->unit, $d2, $now]);
        } else {
            $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.kode_unit = ? AND DATE(a.tanggalkunjungan) BETWEEN ? AND ?', [auth()->user()->unit, $d2, $now]);
        }
        return view('ermtemplate.riwayatpemeriksaan', compact([
            'data'
        ]));
    }
    public function ambilriwayat_pasien_cari(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.kode_unit = ? AND DATE(a.tanggalkunjungan) BETWEEN ? AND ?', [auth()->user()->unit, $d2, $now]);
        return view('ermtemplate.riwayatpemeriksaan', compact([
            'data'
        ]));
    }
    public function ambilriwayat_pasien_byrm(Request $request)
    {
        $nomorrm = $request->nomorm;
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.no_rm = ?', [$nomorrm]);
        return view('ermtemplate.riwayatpemeriksaan', compact([
            'data'
        ]));
    }
    public function formupload()
    {
        return view('ermtemplate.upload');
    }
    public function formorderpenunjang(Request $request)
    {
        $assdok = DB::select('select * from assesmen_dokters where id_kunjungan = ?', [$request->kodekunjungan]);
        return view('ermtemplate.formorderpenunjang', compact([
            'assdok'
        ]));
    }
    public function ambilform(Request $request)
    {

        $id = $request->id;
        $kodekunjungan = $request->kodekunjungan;
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$kodekunjungan]);
        $kelas = $kunjungan[0]->kelas;
        if ($id == 1) {
            $layanan = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        } else if ($id == 2) {
            $layanan = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        }
        return view('ermtemplate.formorderpenunjang_radiologi', compact([
            'layanan',
            'resume'
        ]));
    }
    public function uploadgambarnya(Request $request)
    {
        $data = array();
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = $request->nomorrm . '_' . $request->kodekunjungan . '_' . $file->getClientOriginalName();

            $cek = DB::select('select * from erm_upload_gambar where kodekunjungan = ? and no_rm = ? and kode_unit = ? and  gambar = ?', [$request->kodekunjungan, $request->nomorrm, auth()->user()->unit, $filename]);
            $uploadnya = [
                'kodekunjungan' => $request->kodekunjungan,
                'no_rm' => $request->nomorrm,
                'kode_unit' => auth()->user()->unit,
                'gambar' => $filename,
                'tgl_upload' => $this->get_now(),
                'pic' => auth()->user()->id,
            ];

            if (count($cek) > 0) {
                erm_upload_gambar::whereRaw('kodekunjungan = ? and no_rm = ? and kode_unit = ? and gambar = ?', array([$request->kodekunjungan, $request->nomorrm, auth()->user()->unit, $filename]))->update($uploadnya);
            } else {
                erm_upload_gambar::create($uploadnya);
            }
            // File extension
            $extension = $file->getClientOriginalExtension();
            // File upload location
            $location = '../files';

            // Upload file
            $file->move($location, $filename);

            // File path
            $filepath = url('../../files/' . $filename);

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
    public function riwayatupload(Request $request)
    {
        $cek = DB::select('select *,fc_nama_unit2(kode_unit) as nama_unit from erm_upload_gambar where kodekunjungan = ?', [$request->kodekunjungan]);
        return view('ermdokter.riwayatupload', compact([
            'cek'
        ]));
    }
    public function batalheaderlayanan(Request $request)
    {
        $riwayat_tindakan = DB::connection('mysql4')->select('SELECT * from ts_layanan_header where id = ?', [$request->idheader]);
        if (count($riwayat_tindakan) > 0) {
            $detail = DB::connection('mysql4')->select('SELECT * from ts_layanan_detail where row_id_header = ?', [$request->idheader]);
            $data_retur_header = [
                'status_layanan' => '3',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'pic2' => 'test_user',
                'updated_at' => $this->get_now()
            ];
            ts_layanan_header_dummy::whereRaw('id = ?', array($request->idheader))->update($data_retur_header);
            foreach ($detail as $d) {
                $data_retur_detail = [
                    'jumlah_retur' => $d->jumlah_layanan,
                    'tagihan_penjamin' => '0',
                    'tagihan_pribadi' => '0',
                    'grantotal_layanan' => '0',
                    'updated_at' => $this->get_now()
                ];
                ts_layanan_detail_dummy::whereRaw('row_id_header = ? and id = ?', array($request->idheader, $d->id))->update($data_retur_detail);
            }

            $data = [
                'kode' => 200,
                'message' => 'Data berhasil diretur !'
            ];
            echo json_encode($data);
            die;
            //bpjs
            //layanandetail
            //jmlh retur diisi sesuai qty jlh layanan
            //tagihan penjamin 0
            //tagihan detail 0
            //grantotal


            //layananheader
            //tagian pribadi dan penjamin 0
            //status layanan 3

            //untuk pasien umum jika pasien sudah bayar harus input ke ts_retur

        } else {
        }
    }
    public function batalheaderlayanan_order(Request $request)
    {
        $riwayat_tindakan = DB::select('SELECT * from ts_layanan_header_order where id = ? and  status_order != ?', [$request->idheader, 2]);
        if (count($riwayat_tindakan) > 0) {
            $detail = DB::select('SELECT * from ts_layanan_detail_order where row_id_header = ?', [$request->idheader]);
            $data_retur_header = [
                'status_layanan' => '3',
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'pic2' => 'test_user',
                'updated_at' => $this->get_now()
            ];
            ts_layanan_header_order::whereRaw('id = ?', array($request->idheader))->update($data_retur_header);
            foreach ($detail as $d) {
                $data_retur_detail = [
                    'jumlah_retur' => $d->jumlah_layanan,
                    'tagihan_penjamin' => '0',
                    'tagihan_pribadi' => '0',
                    'grantotal_layanan' => '0',
                    'updated_at' => $this->get_now()
                ];
                ts_layanan_detail_order::whereRaw('row_id_header = ? and id = ?', array($request->idheader, $d->id))->update($data_retur_detail);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($riwayat_tindakan[0]->kode_kunjungan))->update($data);
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil diretur !'
            ];
            echo json_encode($data);
            die;
            //bpjs
            //layanandetail
            //jmlh retur diisi sesuai qty jlh layanan
            //tagihan penjamin 0
            //tagihan detail 0
            //grantotal


            //layananheader
            //tagian pribadi dan penjamin 0
            //status layanan 3

            //untuk pasien umum jika pasien sudah bayar harus input ke ts_retur

        } else {
            $data = [
                'kode' => 500,
                'message' => 'Order sedang dalam proses !'
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanorder(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
        $kodekunjungan = $request->kodekunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        if ($request->id == 1) {
            $unit = '3003';
        } else if ($request->id == 2) {
            $unit = '3002';
        }
        $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
        $prefix_kunjungan = $mtunit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }

        try {
            $kode_unit = $unit;
            $kode_layanan_header = $this->createOrderHeader('P');
            //dummy
            // $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
            // $kode_layanan_header = $r[0]->no_trx_layanan;
            // if ($kode_layanan_header == "") {
            //     $year = date('y');
            //     $kode_layanan_header = $mtunit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
            //     //dummy
            //     DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            // }
            $data_layanan_header = [
                'no_rm' => $kunjungan[0]->no_rm,
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_penjaminx' => $penjamin,
                'kode_unit' => $kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'unit_pengirim' => auth()->user()->unit,
                'diagnosa' => $request->diagnosapenunjang,
                'tgl_periksa' => $request->tglperiksa,
                'dok_kirim' => auth()->user()->kode_paramedis,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN',
                'status_order' => '0'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            //dummy
            $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
            $grand_total_tarif = 0;
            foreach ($arrayindex as $d) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $d['tarif'] * $d['qty'];
                } else {
                    $tagihanpenjamin = $d['tarif'] * $d['qty'];
                    $tagihanpribadi = 0;
                }
                $id_detail = $this->createLayanandetailOrder();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $d['kodelayanan'],
                    'total_tarif' => $d['tarif'],
                    'jumlah_layanan' => $d['qty'],
                    'diskon_layanan' => $d['disc'],
                    'total_layanan' => $d['tarif'] * $d['qty'],
                    'grantotal_layanan' => $d['tarif'] * $d['qty'],
                    'kode_dokter1' => auth()->user()->kode_paramedis,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                $grand_total_tarif = $grand_total_tarif + $d['tarif'];
            }
            if ($penjamin == 'P01') {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
            } else {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
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
    public function simpanorderfarmasi(Request $request)
    {
        $simpantemplate = $request->simpantemplate;
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$request->kodekunjungan]));
        $kodekunjungan = $request->kodekunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        //jika penjamin bpjs order ke dp2
        //jika penjamin umum order ke dp1
        //kodeheader dibedakan menjadi ORF
        if ($penjamin == 'P01') {
            $unit = '4002';
        } else {
            $unit = '4008';
        }
        $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
        $prefix_kunjungan = $mtunit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'keterangan') {
                $arrayindex[] = $dataSet;
            }
        }
        if ($simpantemplate == 'on') {
            if ($request->namaresep == '') {
                $back = [
                    'kode' => 500,
                    'message' => 'Nama Resep tidak boleh kosong !'
                ];
                echo json_encode($back);
                die;
            }
            $obatnya = '';
            foreach ($arrayindex as $d) {
                if ($obatnya == '') {
                    $obatbaru = $obatnya . "nama obat : " . $d['namaobat'] . " , jumlah : " . $d['jumlah'] . " " . $d['satuan'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . " , " . " kategori resep : " . $d['jenis'];
                } else {
                    $obatbaru = $obatnya . " | " . "nama obat : " . $d['namaobat'] . ", jumlah : " . $d['jumlah'] . " " . $d['satuan'] . " , " . "aturan pakai : " . $d['aturanpakai'] . " , " . " signa : " . $d['signa'] . " , " . " keterangan : " . $d['keterangan'] . " , " . " kategori resep : " . $d['jenis'];
                }
                $obatnya = $obatbaru;
            }
            $dataresep = [
                'nama_resep' => $request->namaresep,
                'keterangan' => $obatnya,
                'user' => auth()->user()->kode_paramedis,
                'tgl_entry' => $this->get_now()
            ];
            $id_resep = templateresep::create($dataresep);
            foreach ($arrayindex as $d) {
                $detailresep = [
                    'id_template' => $id_resep->id,
                    'nama_barang' => $d['namaobat'],
                    'kode_barang' => $d['kodebarang'],
                    'aturan_pakai' => $d['aturanpakai'],
                    'jenis' => $d['jenis'],
                    'satuan' => $d['satuan'],
                    'jumlah' => $d['jumlah'],
                    'signa' => $d['signa'],
                    'keterangan' => $d['keterangan'],
                ];
                $detailresep = templateresep_detail::create($detailresep);
            }
        }
        try {
            $kode_unit = $unit;
            //dummy
            // $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER_ORDER('$kode_unit')");
            // $kode_layanan_header = $r[0]->no_trx_layanan;
            // if ($kode_layanan_header == "") {
            //     $year = date('y');
            //     $kode_layanan_header = $mtunit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
            //     //dummy
            //     DB::connection('mysql4')->select('insert into mt_nomor_trx_order (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            // }
            $kode_layanan_header = $this->createOrderHeader('F');
            $data_layanan_header = [
                'no_rm' => $kunjungan[0]->no_rm,
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_penjaminx' => $penjamin,
                'kode_unit' => $kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'unit_pengirim' => auth()->user()->unit,
                'tgl_periksa' => $this->get_now(),
                'diagnosa' => $kunjungan[0]->diagx,
                'dok_kirim' => auth()->user()->kode_paramedis,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN',
                'status_order' => '0'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            //dummy
            $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);

            foreach ($arrayindex as $d) {
                // if ($penjamin == 'P01') {
                //     $tagihanpenjamin = 0;
                //     $tagihanpribadi = $d['tarif'] * $d['qty'];
                // } else {
                //     $tagihanpenjamin = $d['tarif'] * $d['qty'];
                //     $tagihanpribadi = 0;
                // }
                $id_detail = $this->createLayanandetailOrder();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_dokter1' => auth()->user()->kode_paramedis,
                    'jumlah_layanan' => $d['jumlah'],
                    'kode_barang' => $d['kodebarang'],
                    'aturan_pakai' => $d['aturanpakai'] . ' | ' . $d['signa'] . ' | ' . $d['keterangan'],
                    'kategori_resep' => $d['jenis'],
                    'satuan_barang' => $d['satuan'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
            }
            if ($penjamin == 'P01') {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1]);
            } else {
                //dummy
                ts_layanan_header_order::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1]);
            }
            $data = [
                'status' => 0,
                'signature' => ''

            ];
            assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
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
    public function formorderfarmasi(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $resume = DB::select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $kelas = $kunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        return view('ermdokter.formfarmasi', compact([
            'kunjungan',
            'resume',
            'layanan'
        ]));
    }
    public function cariobat(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $key = $request->key;
        $jlh = strlen($key);
        if ($jlh > 2) {
            if ($kunjungan[0]->kode_penjamin == 'PO1') {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4002')");
            } else {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4008')");
            }
            return view('ermtemplate.tabel_obat', compact([
                'obat'
            ]));
        }
    }
    public function createOrderHeader($kode)
    {
        //dummy
        $q = DB::select('SELECT id,kode_layanan_header,RIGHT(kode_layanan_header,6) AS kd_max  FROM ts_layanan_header_order
        WHERE DATE(tgl_entry) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'OR' . $kode . date('ymd') . $kd;
    }
    public function ambilformasskep()
    {
        $date = $this->get_now();
        return view('ermperawat.formasskep_igd', compact([
            'date'
        ]));
    }
    public function generatekode_igd()
    {
        // erm_kode_regis_igd
        $kode = $this->generatekode();
        $back = [
            'kode' => 200,
            'kode' => $kode
        ];
        echo json_encode($back);
        die;
    }
    public function generatekode()
    {
        //dummy
        $q = DB::select('SELECT id,koderegis,RIGHT(koderegis,3) AS kd_max  FROM erm_kode_regis_igd
        WHERE DATE(tanggal_generate) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'IGD' . date('ymd') . $kd;
    }
    public function ambilresep(Request $request)
    {
        $user = auth()->user()->kode_paramedis;
        $resep = DB::SELECT('select * from ts_template_resep where user = ?', [$user]);
        return view('ermtemplate.tabel_resep', compact(
            'resep'
        ));
    }
    public function ambilresep_detail(Request $request)
    {
        $resep = DB::SELECT('select * from erm_ts_resep_detail where id_template = ?', [$request->id]);
        return view('ermtemplate.reseptemplatedetail', compact(
            'resep'
        ));
    }
    public function tindaklanjut_dokter(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $resume = db::select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        return view('ermdokter.tindaklanjut', compact([
            'resume'
        ]));
    }
    public function simpantindaklanjut(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $pilihan = $request->pilih;
        $ket = $request->ket;
        $data_u = [
            'tindak_lanjut' => $pilihan,
            'keterangan_tindak_lanjut' => $ket,
        ];
        assesmenawaldokter::whereRaw('id_kunjungan = ?', $kodekunjungan)->update($data_u);
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }
    public function lihathasillab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select * from ts_layanan_header where kode_kunjungan = ? and kode_unit = ?',[$kodekunjungan,'3002']);
        if(count($cek) == 0){
            echo "<h4 class='text-danger'> Tidak Ada Hasil Laboratorium ...</h5>";
        }else{
            return view('ermtemplate.view_hasil_lab',compact(
                ['cek']
            ));
        }
    }
    public function lihathasilex(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $cek = DB::select('select * from ts_hasil_expertisi where kode_kunjungan = ?',[$kodekunjungan]);
        // if(count($cek) == 0){
        //     echo "<h4 class='text-danger'> Tidak Ada Hasil Expertisi ...</h5>";
        // }else{
            return view('ermtemplate.view_hasil_ex',compact(
                ['cek']
            ));
        // }
    }
}
