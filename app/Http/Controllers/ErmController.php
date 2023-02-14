<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\assesmenawalperawat;
use App\Models\assesmenawaldokter;
use App\Models\ermtht_telinga;
use App\Models\erm_tht_hidung;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
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
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
            '1', auth()->user()->unit
        ]);
        return view('ermtemplate.tabelpasien', compact([
            'pasienpoli'
        ]));
    }
    public function ambildatapasienpoli_dokter()
    {
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
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
            }
        } else {
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
        }

        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        // dd($formkhusus);
        return view('ermdokter.resumedokter', compact([
            'resume',
            'formkhusus',
            'riwayat_tindakan'
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
        //dummy
        $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$request->kodekunjungan]));
        // if ($cek_layanan_header > 0) {
        //     $back = [
        //         'kode' => 500,
        //         'message' => 'Layanan sudah diinput, silahkan cek riwayat tindakan !'
        //     ];
        //     echo json_encode($back);
        //     die;
        // }
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
        $cek1 = DB::select('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kanan']);
        return view('ermtemplate.telingakanan', compact([
            'cek1'
        ]));
    }
    public function gambartht2(Request $request)
    {
        $cek1 = DB::select('select * from erm_tht_telinga where kode_kunjungan = ? and keterangan = ?', [$request->kodekunjungan, 'telinga kiri']);
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
        try {
            $cek1 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kanan']);
            $cek2 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kiri']);
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
            'kesimpulan' => $request->kesimpulan,
        ];
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
        try {
            $cek1 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'Hidung Kanan']);
            $cek2 = DB::select('select * from erm_tht_hidung where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'Hidung Kiri']);
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
        // try {
        //     $cek1 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kanan']);
        //     $cek2 = DB::select('select * from erm_tht_telinga where id_assesmen_dokter = ? and keterangan = ?', [$request->idassesmen, 'telinga kiri']);
        //     if (count($cek1) > 0) {
        //         $datatelinga1 = [
        //             'id_assesmen_dokter' => $request->idassesmen,
        //             'nama_dokter' => auth()->user()->nama,
        //             'no_rm' => $request->nomorrm,
        //             'id_dokter' => auth()->user()->id,
        //             'status' => '0',
        //             'kode_kunjungan' => $kodekunjungan,
        //             'gambar' => $request->telingakanan,
        //             'keterangan' => 'telinga kanan',
        //             'LT_lapang' => (empty($dataSet['Lapang'])) ? 0 : $dataSet['Lapang'],
        //             'LT_dataSetestruksi' => (empty($dataSet['Destruksi'])) ? 0 : $dataSet['Destruksi'],
        //             'LT_Sempit' => (empty($dataSet['Sempit']))  ? 0 : $dataSet['Sempit'],
        //             'LT_Serumen' => (empty($dataSet['Serumen']))  ? 0 : $dataSet['Serumen'],
        //             'LT_Kolesteatoma' => (empty($dataSet['Kolesteatoma']))  ? 0 : $dataSet['Kolesteatoma'],
        //             'LT_Sekret' => (empty($dataSet['Sekret']))  ? 0 : $dataSet['Sekret'],
        //             'LT_Massa_Jaringan' => (empty($dataSet['Massa atau Jaringan']))  ? 0 : $dataSet['Massa atau Jaringan'],
        //             'LT_Jamur' => (empty($dataSet['Jamur']))  ? 0 : $dataSet['Jamur'],
        //             'LT_Benda_asing' => (empty($dataSet['Benda Asing']))  ? 0 : $dataSet['Benda Asing'],
        //             'LT_Lain_lain' => (empty($dataSet['LT Lain-Lain']))  ? 0 : $dataSet['LT Lain-Lain'],
        //             'LT_Keterangan_lain' => $dataSet['ltketeranganlain'],
        //             'MT_intak_normal' => (empty($dataSet['Intak - Normal']))  ? 0 : $dataSet['Intak - Normal'],
        //             'MT_intak_hiperemis' => (empty($dataSet['Intak - Hiperemis']))  ? 0 : $dataSet['Intak - Hiperemis'],
        //             'MT_intak_bulging' => (empty($dataSet['Intak - Bulging']))  ? 0 : $dataSet['Intak - Bulging'],
        //             'MT_intak_retraksi' => (empty($dataSet['Intak - Retraksi']))  ? 0 : $dataSet['Intak - Retraksi'],
        //             'MT_intak_sklerotik' => (empty($dataSet['Intak - Sklerotik']))  ? 0 : $dataSet['Intak - Sklerotik'],
        //             'MT_perforasi_sentral' => (empty($dataSet['Perforasi - Sentral']))  ? 0 : $dataSet['Perforasi - Sentral'],
        //             'MT_perforasi_atik' => (empty($dataSet['Perforasi - Atik']))  ? 0 : $dataSet['Perforasi - Atik'],
        //             'MT_perforasi_marginal' => (empty($dataSet['Perforasi - Marginal']))  ? 0 : $dataSet['Perforasi - Marginal'],
        //             'MT_perforasi_lain' => (empty($dataSet['Perforasi - Lain-Lain']))  ? 0 : $dataSet['Perforasi - Lain-Lain'],
        //             'MT_keterangan_lain' => $dataSet['mtketeranganlain'],
        //             'MT_mukosa' => $dataSet['mukosa'],
        //             'MT_osikal' => $dataSet['oslkel'],
        //             'MT_isthmus' => $dataSet['Isthmus'],
        //             'lain_lain' => $dataSet['keteranganlain'],
        //             'kesimpulan' => $request->kesimpulan,
        //             'anjuran' => $request->anjuran,
        //             'tgl_update' => $this->get_now()
        //         ];
        //         ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'telinga kanan'))->update($datatelinga1);
        //     } else {
        //         ermtht_telinga::create($datatelinga1);
        //     }
        //     if (count($cek2) > 0) {
        //         $datatelinga2 = [
        //             'id_assesmen_dokter' => $request->idassesmen,
        //             'nama_dokter' => auth()->user()->nama,
        //             'no_rm' => $request->nomorrm,
        //             'id_dokter' => auth()->user()->id,
        //             'status' => '0',
        //             'kode_kunjungan' => $kodekunjungan,
        //             'gambar' => $request->telingakiri,
        //             'keterangan' => 'telinga kiri',
        //             'LT_lapang' => (empty($dataSet2['Lapang'])) ? 0 : $dataSet2['Lapang'],
        //             'LT_dataSetestruksi' => (empty($dataSet2['Destruksi'])) ? 0 : $dataSet2['Destruksi'],
        //             'LT_Sempit' => (empty($dataSet2['Sempit']))  ? 0 : $dataSet2['Sempit'],
        //             'LT_Serumen' => (empty($dataSet2['Serumen']))  ? 0 : $dataSet2['Serumen'],
        //             'LT_Kolesteatoma' => (empty($dataSet2['Kolesteatoma']))  ? 0 : $dataSet2['Kolesteatoma'],
        //             'LT_Sekret' => (empty($dataSet2['Sekret']))  ? 0 : $dataSet2['Sekret'],
        //             'LT_Massa_Jaringan' => (empty($dataSet2['Massa atau Jaringan']))  ? 0 : $dataSet2['Massa atau Jaringan'],
        //             'LT_Jamur' => (empty($dataSet2['Jamur']))  ? 0 : $dataSet2['Jamur'],
        //             'LT_Benda_asing' => (empty($dataSet2['Benda Asing']))  ? 0 : $dataSet2['Benda Asing'],
        //             'LT_Lain_lain' => (empty($dataSet2['LT Lain-Lain']))  ? 0 : $dataSet2['LT Lain-Lain'],
        //             'LT_Keterangan_lain' => $dataSet2['ltketeranganlain'],
        //             'MT_intak_normal' => (empty($dataSet2['Intak - Normal']))  ? 0 : $dataSet2['Intak - Normal'],
        //             'MT_intak_hiperemis' => (empty($dataSet2['Intak - Hiperemis']))  ? 0 : $dataSet2['Intak - Hiperemis'],
        //             'MT_intak_bulging' => (empty($dataSet2['Intak - Bulging']))  ? 0 : $dataSet2['Intak - Bulging'],
        //             'MT_intak_retraksi' => (empty($dataSet2['Intak - Retraksi']))  ? 0 : $dataSet2['Intak - Retraksi'],
        //             'MT_intak_sklerotik' => (empty($dataSet2['Intak - Sklerotik']))  ? 0 : $dataSet2['Intak - Sklerotik'],
        //             'MT_perforasi_sentral' => (empty($dataSet2['Perforasi - Sentral']))  ? 0 : $dataSet2['Perforasi - Sentral'],
        //             'MT_perforasi_atik' => (empty($dataSet2['Perforasi - Atik']))  ? 0 : $dataSet2['Perforasi - Atik'],
        //             'MT_perforasi_marginal' => (empty($dataSet2['Perforasi - Marginal']))  ? 0 : $dataSet2['Perforasi - Marginal'],
        //             'MT_perforasi_lain' => (empty($dataSet2['Perforasi - Lain-Lain']))  ? 0 : $dataSet2['Perforasi - Lain-Lain'],
        //             'MT_keterangan_lain' => $dataSet2['mtketeranganlain'],
        //             'MT_mukosa' => $dataSet2['mukosa'],
        //             'MT_osikal' => $dataSet2['oslkel'],
        //             'MT_isthmus' => $dataSet2['Isthmus'],
        //             'lain_lain' => $dataSet2['keteranganlain'],
        //             'kesimpulan' => $request->kesimpulan,
        //             'anjuran' => $request->anjuran,
        //             'tgl_update' => $this->get_now()
        //         ];
        //         ermtht_telinga::whereRaw('id_assesmen_dokter = ? and keterangan = ?', array($request->idassesmen, 'telinga kiri'))->update($datatelinga2);
        //     } else {
        //         ermtht_telinga::create($datatelinga2);
        //     }
        //     $data = [
        //         'kode' => 200,
        //         'message' => 'Data berhasil disimpan !'
        //     ];
        //     echo json_encode($data);
        //     die;
        // } catch (\Exception $e) {
        //     $data = [
        //         'kode' => 500,
        //         'message' => $e->getMessage()
        //     ];
        //     echo json_encode($data);
        //     die;
        // }
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
    public function tindakanhariini(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql4')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('ermdokter.riwayattindakan', compact([
            'riwayat_tindakan'
        ]));
    }
}
