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
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
            '1', auth()->user()->unit
        ]);
        return view('ermtemplate.tabelpasien', compact([
            'pasienpoli'
        ]));
    }
    public function ambildatapasienpoli_dokter()
    {
        $pasienpoli = DB::select('SELECT a.kode_kunjungan,fc_nama_unit1(a.kode_unit) as nama_unit,a.no_rm,fc_nama_px(a.no_rm) as nama_pasien,a.`kode_kunjungan`,a.`tgl_masuk`,fc_NAMA_PENJAMIN2(a.`kode_penjamin`) AS nama_penjamin,a.`kode_penjamin`,b.`id` AS id_pemeriksaan_perawat,c.id AS id_pemeriksaan_dokter,b.status as status_asskep,c.status as status_assdok,c.nama_dokter as nama_dokter,c.pic as id_dokter FROM ts_kunjungan a LEFT OUTER JOIN erm_hasil_assesmen_keperawatan_rajal b ON a.kode_kunjungan = b.kode_kunjungan LEFT OUTER JOIN assesmen_dokters c ON b.`kode_kunjungan` = c.id_kunjungan WHERE a.status_kunjungan = ? AND DATE(a.tgl_masuk) = CURDATE() AND a.`kode_unit` = ?', [
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
            if ($kunjungan[0]->kode_unit == '1002') {
                $resume2 = DB::select('SELECT * from erm_assesmen_keperawatan_igd WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
                if (count($resume2) > 0) {
                    return view('ermperawat.formpemeriksaanigd_edit', compact([
                        'kunjungan',
                        'resume2'
                    ]));
                } else {
                    return view('ermperawat.formpemeriksaanigd', compact([
                        'kunjungan'
                    ]));
                }
            } else {
                return view('ermperawat.formpemeriksaan', compact([
                    'kunjungan'
                ]));
            }
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
                $resume = DB::select('SELECT * from erm_assesmen_keperawatan_igd WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
                return view('erm_form_khusus.formgambar_igd', compact([
                    'resume'
                ]));
            }
            return view('ermtemplate.data1tidakditemukan');
        }
    }
    public function simpanpemeriksaanperawat(Request $request)
    {
        if (auth()->user()->unit == '1002') {
            $data = json_decode($_POST['data'], true);
            foreach ($data as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet[$index] = $value;
            }
            if (isset($dataSet['jlnnafas']) == true) {
                $jalan_nafas = '1';
            } else {
                $jalan_nafas = '0';
            }
            if (isset($dataSet['polanafas']) == true) {
                $pola_nafas = '1';
            } else {
                $pola_nafas = '0';
            }
            if (isset($dataSet['pertukarangas']) == true) {
                $pertukaran_gas = '1';
            } else {
                $pertukaran_gas = '0';
            }
            if (isset($dataSet['sirkulasi']) == true) {
                $sirkulasi = '1';
            } else {
                $sirkulasi = '0';
            }
            if (isset($dataSet['perfusijaringan']) == true) {
                $perfusijaringan = '1';
            } else {
                $perfusijaringan = '0';
            }
            if (isset($dataSet['hipertermia']) == true) {
                $hipertermia = '1';
            } else {
                $hipertermia = '0';
            }
            if (isset($dataSet['keseimbangancairan']) == true) {
                $keseimbangancairan = '1';
            } else {
                $keseimbangancairan = '0';
            }
            if (isset($dataSet['integritaskulit']) == true) {
                $integritaskulit = '1';
            } else {
                $integritaskulit = '0';
            }
            if (isset($dataSet['aktualtakut']) == true) {
                $aktualtakut = '1';
            } else {
                $aktualtakut = '0';
            }
            if (isset($dataSet['toksik']) == true) {
                $toksik = '1';
            } else {
                $toksik = '0';
            }
            if (isset($dataSet['cederajatuh']) == true) {
                $cederajatuh = '1';
            } else {
                $cederajatuh = '0';
            }
            if (isset($dataSet['nyeri']) == true) {
                $nyeri = '1';
            } else {
                $nyeri = '0';
            }

            if (isset($dataSet['infus']) == true) {
                $infus = '1';
            } else {
                $infus = '0';
            }
            if (isset($dataSet['lab']) == true) {
                $lab = '1';
            } else {
                $lab = '0';
            }
            if (isset($dataSet['ekg']) == true) {
                $ekg = '1';
            } else {
                $ekg = '0';
            }
            if (isset($dataSet['oksigenasi']) == true) {
                $oksigenasi = '1';
            } else {
                $oksigenasi = '0';
            }
            if (isset($dataSet['nebulizer']) == true) {
                $nebulizer = '1';
            } else {
                $nebulizer = '0';
            }
            if (isset($dataSet['saturasioksigen']) == true) {
                $saturasioksigen = '1';
            } else {
                $saturasioksigen = '0';
            }
            if (isset($dataSet['ngt']) == true) {
                $ngt = '1';
            } else {
                $ngt = '0';
            }
            if (isset($dataSet['mengumbahlambung']) == true) {
                $mengumbahlambung = '1';
            } else {
                $mengumbahlambung = '0';
            }
            if (isset($dataSet['kateter']) == true) {
                $kateter = '1';
            } else {
                $kateter = '0';
            }
            if (isset($dataSet['defibrilasi']) == true) {
                $defibrilasi = '1';
            } else {
                $defibrilasi = '0';
            }
            if (isset($dataSet['mayo']) == true) {
                $mayo = '1';
            } else {
                $mayo = '0';
            }
            if (isset($dataSet['ett']) == true) {
                $ett = '1';
            } else {
                $ett = '0';
            }
            if (isset($dataSet['suction']) == true) {
                $suction = '1';
            } else {
                $suction = '0';
            }
            if (isset($dataSet['eksplorasi']) == true) {
                $eksplorasi = '1';
            } else {
                $eksplorasi = '0';
            }
            if (isset($dataSet['obat']) == true) {
                $obat = '1';
            } else {
                $obat = '0';
            }
            $data = [
                'counter' => $dataSet['counter'],
                'no_rm' => $dataSet['nomorrm'],
                'kode_unit' => $dataSet['unit'],
                'kode_kunjungan' => $dataSet['kodekunjungan'],
                'tanggal_kunjungan' => $dataSet['tanggalkunjungan'],
                'tanggal_periksa' => $dataSet['tanggalassesmen'],
                'sumberdata' => $dataSet['sumberdata'],
                'keterangan_sumberdata' => $dataSet['namakeluarga'],
                'asalmasuk' => $dataSet['asalmasuk'],
                'keterangan_asal_masuk' => $dataSet['keteranganasalmasuk'],
                'caramasuk' => $dataSet['caramasuk'],
                'subyektifanamnesis' => $dataSet['subyektifanamnesis'],
                'tekanan_darah' => $dataSet['tekanandarah'],
                'frekuensi_nadi' => $dataSet['frekuensinadi'],
                'frekuensi_nafas' => $dataSet['frekuensinafas'],
                'suhu' => $dataSet['suhutubuh'],
                'berat_badan' => $dataSet['beratbadan'],
                'tinggi_badan' => $dataSet['tinggibadan'],
                'keadaan_umum' => $dataSet['keadaanumum'],
                'kesadaran' => $dataSet['kesadaran'],
                'tekanan_intrakranial' => $dataSet['tekananintrakranial'],
                'pupil' => $dataSet['pupil'],
                'neurosensorik' => $dataSet['neurosensorik'],
                'integumen' => $dataSet['integumen'],
                'turgorkulit' => $dataSet['turgorkulit'],
                'edema' => $dataSet['edema'],
                'mukosa_mulut' => $dataSet['mukosamulut'],
                'jumlahperdarahan' => $dataSet['jumlah_perdarahan'],
                'warnaperdarahan' => $dataSet['warna_perdarahan'],
                'intoksikasi' => $dataSet['intoksikasi'],
                'frekuensi_bab' => $dataSet['frekuensibab'],
                'frekuensi_bak' => $dataSet['frekuensibak'],
                'konsistensi_bab' => $dataSet['konsistensibab'],
                'konsistensi_bak' => $dataSet['konsistensibak'],
                'warna_bab' => $dataSet['warnabab'],
                'warna_bak' => $dataSet['warnabak'],
                'kecemasan' => $dataSet['kecemasan'],
                'mekanisme' => $dataSet['mekanisme'],
                'keluhan_nyeri' => $dataSet['adakeluhannyeri'],
                'skalanyeri' => $dataSet['skalanyeripasien'],
                'nyeri_berpindah' => $dataSet['nyeriberipindah'],
                'lama_nyeri' => $dataSet['lamanyeri'],
                'rasa_nyeri' => $dataSet['rasanyeri'],
                'seberapa_sering_nyeri' => $dataSet['seberapaseringnyeri'],
                'durasi_nyeri' => $dataSet['durasinyeri'],
                'yang_meredakan_nyeri' => $dataSet['peredanyeri'],
                'riwayat_jatuh_dewasa' => $dataSet['riwayat_jatuh_dewasa'],
                'diagnosis_sekunder_dewasa' => $dataSet['diagnosissekunder_dewasa'],
                'alat_bantu_dewasa' => $dataSet['alatbantu_dewasa'],
                'terpasang_infus_dewasa' => $dataSet['terpasanginfus_dewasa'],
                'gaya_berjalan' => $dataSet['gayaberjalan_dewasa'],
                'status_mental' => $dataSet['statusmental'],
                'umur_anak' => $dataSet['umur_anak'],
                'jeniskelamin_anak' => $dataSet['jeniskelaminanak'],
                'diagnosa_anak' => $dataSet['diagnosa_anak'],
                'gangguan_kognitif_anak' => $dataSet['gangguankognitif_anak'],
                'faktorlingkungan_anak' => $dataSet['faktorlingkungan_anak'],
                'responanestesi_anak' => $dataSet['responanestesi_anak'],
                'penggunaanobat_anak' => $dataSet['penggunaanobatobatan_anak'],
                'penurunan_bb_dewasa' => $dataSet['apakahadapenurunanbb'],
                'berat_penurunan_bb_dewasa' => $dataSet['beratpenurunan'],
                'apakah_asupan_makanan_buruk_dewasa' => $dataSet['apakahasupanmakanburuk'],
                'sakit_berat_dewasa' => $dataSet['Sakitberat'],
                'apakahpasienkurus_anak' => $dataSet['pasientampakkurus'],
                'penurunanbb_anak' => $dataSet['penurunanbb_anak'],
                'diaremuntahkurangmakanan_anak' => $dataSet['kondisilain'],
                'penyakitlain_anak' => $dataSet['penyakitlain_anak'],
                'keterangan_diagnosa' => $dataSet['diagnosakeperawatan'],
                'rencana_keperawatan' => $dataSet['rencanakeperawatan'],
                'tindakan_keperawatan' => $dataSet['tindakankeperawatan'],
                'evaluasi_keperawatan' => $dataSet['evaluasikeperawatan'],
                'risiko_bersihan_jalan_nafas_tidak_efektif' => $jalan_nafas,
                'risikopolanafastidakefektif' => $pola_nafas,
                'risikogangguanpertukarangas' => $pertukaran_gas,
                'risikogangguansirkulasi' => $sirkulasi,
                'risikogangguanperfusijaringan' => $perfusijaringan,
                'hipertermia' => $hipertermia,
                'risikogangguankeseimbangancairan' => $keseimbangancairan,
                'risikogangguanintegritaskulit' => $integritaskulit,
                'risikocemas' => $aktualtakut,
                'Risikopenyebarantoksik' => $toksik,
                'Risikocedera' => $cederajatuh,
                'Nyeri' => $nyeri,
                'kol_infus' => $infus,
                'kol_lab' => $lab,
                'kol_ekg' => $ekg,
                'kol_oksigenasi' => $oksigenasi,
                'kol_nebulizer' => $nebulizer,
                'kol_saturasi_oksigen' => $saturasioksigen,
                'kol_ngt' => $ngt,
                'kol_mengumbah_lambung' => $mengumbahlambung,
                'kol_kateter' => $kateter,
                'kol_defibrilasi' => $defibrilasi,
                'kol_mayo' => $mayo,
                'kol_ett' => $ett,
                'kol_suction' => $suction,
                'kol_explorasi' => $eksplorasi,
                'kol_obat' => $obat,
                'id_pemeriksa' => auth()->user()->id,
                'nama_pemeriksa' => auth()->user()->nama,
                'status' => '0',
                'signature' => ''
            ];
            try {
                $cek = DB::select('SELECT * from erm_assesmen_keperawatan_igd WHERE tanggal_kunjungan = ? AND no_rm = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
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
                        assesmenawalperawat_igd::whereRaw('no_rm = ? and kode_unit = ? and tanggal_kunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan']))->update($data);
                        $data = [
                            'kode' => 200,
                            'message' => 'Data berhasil diupdate !'
                        ];
                        echo json_encode($data);
                        die;
                    }
                } else {
                    $erm_assesmen = assesmenawalperawat_igd::create($data);
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
            //igd
        } else {
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
        try {
            $cek = DB::select('select * from erm_mata_kanan_kiri where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
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
            $cek = DB::select('select * from erm_gambar_gigi where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
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
        try {
            $cek = DB::select('select * from erm_catatan_gambar where id_assesmen_dokter = ? and kode_kunjungan = ?', [$request->idassesmen, $kodekunjungan]);
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
        $filename = 'C:\xampp\htdocs\simrs\public\report/cppt_fix.jrxml';
        // dd($filename);
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
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.kode_unit = ? AND DATE(a.tanggalkunjungan) BETWEEN ? AND ?',[ auth()->user()->unit,$d2,$now]);
        return view('ermtemplate.riwayatpemeriksaan',compact([
            'data'
        ]));
    }
    public function ambilriwayat_pasien_cari(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.kode_unit = ? AND DATE(a.tanggalkunjungan) BETWEEN ? AND ?',[ auth()->user()->unit,$d2,$now]);
        return view('ermtemplate.riwayatpemeriksaan',compact([
            'data'
        ]));
    }
    public function ambilriwayat_pasien_byrm(Request $request)
    {
        $nomorrm = $request->nomorm;
        $data = DB::select('SELECT a.tanggalkunjungan,a.no_rm,fc_nama_px(a.no_rm) AS nama,a.keluhanutama,a.namapemeriksa AS nama_perawat,b.nama_dokter AS nama_dokter FROM erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b ON a.id = b.id_asskep WHERE a.no_rm = ?',[$nomorrm]);
        return view('ermtemplate.riwayatpemeriksaan',compact([
            'data'
        ]));
    }
    public function formupload()
    {
        return view('ermtemplate.upload');
    }
    public function formorderpenunjang()
    {
        return view('ermtemplate.formorderpenunjang');
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
}
