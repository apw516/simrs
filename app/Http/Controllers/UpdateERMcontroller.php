<?php

namespace App\Http\Controllers;

use App\Models\assesmenawaldokter;
use App\Models\assesmenawalperawat;
use App\Models\di_diagnosa;
use App\Models\erm_mata_kanan_kiri;
use App\Models\templateresep;
use App\Models\templateresep_detail;
use App\Models\ts_header_iter;
use App\Models\ts_kunjungan;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_detail_order;
use App\Models\ts_layanan_header_dummy;
use App\Models\ts_layanan_header_order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\VclaimModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class UpdateERMcontroller extends Controller
{
    public function formassesmenbundir(Request $request)
    {
        $kunjungan = DB::select('select *,fc_nama_px(no_rm) as nama_pasien,fc_nama_paramedis(ref_paramedis) AS dokter_kirim,fc_nama_unit1(ref_unit) AS poli_asal from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $request->nomorrm;
        $asesmen = DB::table('erm_assesmen_risiko_bunuh_diri')
            ->where('nomor_rm', $rm)
            ->orderByDesc('id')
            ->first();
        return view('update_erm_dokter.form_assesmen_bundir', compact([
            'kunjungan',
            'rm',
            'asesmen'
        ]));
    }
    public function form_pemeriksaan_dokter(Request $request)
    {
        $kunjungan = DB::select('select *,fc_nama_px(no_rm) as nama_pasien,fc_nama_paramedis(ref_paramedis) AS dokter_kirim,fc_nama_unit1(ref_unit) AS poli_asal from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        //cek konsul
        $ref_kunjungan = $kunjungan[0]->ref_kunjungan;
        $poli_pengirim_konsul = DB::table('ts_kunjungan as a')
            ->select([
                'a.*',
                DB::raw('fc_nama_px(a.no_rm) as nama_pasien'),
                DB::raw('fc_NAMA_PARAMEDIS1(a.kode_paramedis) as nama_dokter'),
                DB::raw('fc_nama_unit1(a.kode_unit) as nama_unit')
            ])
            ->where('a.kode_kunjungan', $ref_kunjungan)
            ->get();
        $catatan_konsul = db::table('assesmen_dokters as a')->select('tindak_lanjut', 'keterangan_tindak_lanjut', 'diagnosakerja')->where('id_kunjungan', $ref_kunjungan)->get();
        //end cek konsul
        $nomor_rujukan = $kunjungan[0]->no_rujukan;
        $rujukan = $nomor_rujukan;
        $detailrujukan = '';
        $selisih = 0;
        $daterujukan = 0;
        $status_cek_rujukan = 0;
        $jenisrujukan = 'Tidak ditemukan no rujukan !';
        $alertClass = 'alert-info';
        $alertIcon = 'fas fa-info-circle';
        $borderClass = 'border-left: 6px solid #117a8b;';
        $pesan_rujukan = 'Gagal memproses: Nomor rujukan kosong atau tidak valid.';
        if (strlen($rujukan) > 5) {
            $cekrujukan2 = substr($rujukan, 0, 8);
            if ($cekrujukan2 == '1018R001') {
                $jenisrujukan = 'FASKES 2';
                $status_cek_rujukan = 1;
                $alertClass = 'alert-success'; // Hijau aman karena pasca rawat inap
                $alertIcon = 'fas fa-check-circle';
                $borderClass = 'border-left: 6px solid #28a745;';
                $pesan_rujukan = "Pasien merupakan pasien pasca rawat inap (Faskes 2 Intern).";
            } else {
                $jenisrujukan = 'FASKES 1';
                $v = new VclaimModel();
                try {
                    $res = $v->carirujukan_byno($rujukan);
                    if ($res->metaData->code != 200) {
                        $res = $v->carirujukanRS_byno_($rujukan);
                        $jenisrujukan = 'FASKES 2 (RS)';
                    }
                    if ($res->metaData->code == 200) {
                        $detailrujukan = $res; // Simpan data response asli BPJS
                        $tglkunjungan = $res->response->rujukan->tglKunjungan;
                        $date1 = date_create($tglkunjungan);
                        $date2 = date_create($this->get_date());
                        $selisih = date_diff($date1, $date2)->days;
                        $daterujukan = $tglkunjungan;
                        $status_cek_rujukan = 1;
                        $sisa_hari = 90 - $selisih;
                        if ($selisih >= 60) {
                            $alertClass = 'alert-danger';
                            $alertIcon = 'fas fa-times-circle';
                            $borderClass = 'border-left: 6px solid #dc3545;';
                            $pesan_rujukan = "Masa berlaku rujukan Kritis! Sudah berjalan <strong>{$selisih} Hari</strong> (Sisa waktu {$sisa_hari} hari lagi). <br>
                            ⚠️ <strong>REKOMENDASI PROGRAM BPJS:</strong> Pasien wajib dievaluasi! Jika kondisi klinis sudah STABIL, segera daftarkan sebagai peserta <strong>PRB (Program Rujuk Balik)</strong> ke Faskes 1. Jika BELUM LAYAK PRB, berikan alasan medis yang jelas pada berkas kontrol (misal: Dosis obat belum stabil / Butuh observasi spesialistik berkelanjutan).";
                        } else {
                            $alertClass = 'alert-warning';
                            $alertIcon = 'fas fa-exclamation-triangle';
                            $borderClass = 'border-left: 6px solid #ffc107;';
                            $pesan_rujukan = "Rujukan Aktif Biasa. Berjalan <strong>{$selisih} Hari</strong> (Sisa masa berlaku {$sisa_hari} hari). <br>
                            💡 <strong>EVALUASI KONDISI PASIEN:</strong> Persiapkan kestabilan kondisi pasien. Jika tujuan kunjungan hanya untuk mengambil obat rutin tanpa perubahan terapi, pertimbangkan opsi <strong>Iterasi Obat</strong> agar pasien dapat mengambil obat secara efektif tanpa memperpanjang antrean rujukan baru jika nanti masa berlakunya habis.";
                        }
                    } else {
                        $pesan_rujukan = "Gagal memvalidasi data ke web service BPJS: " . $res->metaData->message;
                    }
                } catch (\Exception $e) {
                    $pesan_rujukan = "Terjadi kesalahan sistem bridging: " . $e->getMessage();
                }
            }
        }
        $no_rm = $kunjungan[0]->no_rm;
        $kode_unit = $kunjungan[0]->kode_unit;
        $asesmen_terakhir = DB::table('assesmen_dokters as b')
            ->join('ts_kunjungan as a', 'b.id_kunjungan', '=', 'a.kode_kunjungan')
            ->select([
                'b.*',                   // Mengambil semua data dokumen asesmen dokter
                'a.tgl_masuk',           // Diperlukan untuk validasi urutan waktu
                'a.status_kunjungan',
                'a.no_rm'
            ])
            ->where('a.no_rm', $no_rm)
            ->where('a.kode_unit', $kode_unit)
            ->where('a.status_kunjungan', '!=', 8)
            ->orderBy('a.tgl_masuk', 'DESC')
            ->orderBy('b.id', 'DESC')
            ->first();

        $asesmen_perawat = DB::table('erm_hasil_assesmen_keperawatan_rajal')
            ->where('kode_kunjungan', $request->kodekunjungan)
            ->first();
        $layanan_rad = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','3')");
        $layanan_lab = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','3')");
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan = $this->carilayanan(3, $layanan, $unit);
        $hasil_ro = DB::select('select * from erm_mata_kanan_kiri where kode_kunjungan = ? ', [$request->kodekunjungan]);
        if (auth()->user()->unit == '1028') {
            return view('update_erm_dokter.form_pemeriksaan_dokter_fisio', compact([
                'kunjungan',
                'pesan_rujukan',
                'alertClass',
                'alertIcon',
                'borderClass',
                'asesmen_terakhir',
                'asesmen_perawat',
                'layanan_rad',
                'layanan_lab',
                'hasil_ro',
                'poli_pengirim_konsul',
                'catatan_konsul',
                'layanan'
            ]));
        } else {
            return view('update_erm_dokter.form_pemeriksaan_dokter', compact([
                'kunjungan',
                'pesan_rujukan',
                'alertClass',
                'alertIcon',
                'borderClass',
                'asesmen_terakhir',
                'asesmen_perawat',
                'layanan_rad',
                'layanan_lab',
                'hasil_ro',
                'poli_pengirim_konsul',
                'catatan_konsul',
                'layanan'
            ]));
        }
    }
    public function simpanpemeriksaandokter(Request $request)
    {
        DB::beginTransaction();
        try {
            $pasieniter = $request->pasieniter;
            $jumlahiter = $request->jumlahiter;
            $keterangan_iter = '';
            if ($pasieniter == 1) {
                $keterangan_iter = 'PASIEN ITER ' . $jumlahiter . ' x';
            }
            $data1 = json_decode($_POST['data1'], true);
            $data2 = json_decode($_POST['data2'], true);
            $data3 = json_decode($_POST['data3'], true);
            $data4 = json_decode($_POST['data4'], true);
            $data5 = json_decode($_POST['data5'], true);
            $jawabankonsul = json_decode($_POST['jawabankonsul'], true);
            $formorder_lab = json_decode($_POST['formorder_lab'], true);
            $formtindakan_rad = json_decode($_POST['formtindakan_rad'], true);
            $datatindakan = json_decode($_POST['datatindakan'], true);
            $datatindaklanjut = json_decode($_POST['datatindaklanjut'], true);
            $formobat_farmasi = json_decode($_POST['formobat_farmasi'], true);
            $formobatfarmasi2 = json_decode($_POST['formobatfarmasi2'], true);
               foreach ($formobatfarmasi2 as $nama) {
                    $index = $nama['name'];
                    $value = $nama['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'keterangan') {
                        $arrayindex_far[] = $dataSet;
                    }
                }
            if (count($datatindaklanjut) == 1) {
                $data = [
                    'kode' => 500,
                    'message' => 'Tindak lanjut pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            foreach ($datatindaklanjut as $nama_1) {
                $index =  $nama_1['name'];
                $value =  $nama_1['value'];
                $dataSet_tindaklanjut[$index] = $value;
            }
            foreach ($data1 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_1[$index] = $value;
            }
            foreach ($data2 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_2[$index] = $value;
            }
            foreach ($data3 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_3[$index] = $value;
            }
            foreach ($data4 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_4[$index] = $value;
            }
            foreach ($data5 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_5[$index] = $value;
            }
            foreach ($jawabankonsul as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_jawabankonsul[$index] = $value;
            }
            if ($pasieniter == 1) {
                if ($jumlahiter == '') {
                    $data = [
                        'kode' => 500,
                        'message' => 'Jumlah iter harus diisi ...'
                    ];
                    echo json_encode($data);
                    die;
                }
                $ts_header_iter = [
                    'kode_kunjungan' => $request->kodekunjungan,
                    'no_rm' => $dataSet_1['nomorrm'],
                    'jumlah' => $jumlahiter,
                    'kode_unit' => auth()->user()->unit,
                    'kode_paramedis' => auth()->user()->kode_paramedis,
                    'tgl_iter' => $this->get_now()
                ];
                $cek = db::select('select * from ts_header_iter_bpjs where kode_kunjungan = ?', [$request->kodekunjungan]);
                if (count($cek) == 0) {
                    ts_header_iter::create($ts_header_iter);
                } else {
                    ts_header_iter::whereRaw('id = ?', array($cek['0']->id))->update($ts_header_iter);
                }
            } else {
                $cek = db::select('select * from ts_header_iter_bpjs where kode_kunjungan = ?', [$request->kodekunjungan]);
                if (count($cek) > 0) {
                    ts_header_iter::whereRaw('id = ?', array($cek['0']->id))->delete();
                }
            }
            $id_asskep = $dataSet_1['idasskep'];
            $DATAASKEP = [
                'keluhanutama' => trim($dataSet_1['keluhanutama']),
                'tekanandarah' => $dataSet_2['tekanandarah'],
                'frekuensinadi' => $dataSet_2['frekuensinadi'],
                'frekuensinapas' => $dataSet_2['frekuensinafas'],
                'imt' => $dataSet_2['imt'],
                'tinggibadan' => $dataSet_2['tinggibadan'],
                'beratbadan' => $dataSet_2['beratbadan'],
                'suhutubuh' => $dataSet_2['suhutubuh'],
            ];
            assesmenawalperawat::where('id', $id_asskep)->update($DATAASKEP);
            $diagnosakerja = preg_replace("/[^A-Za-z]/", "", $dataSet_3['diagnosakerja']);
            $cekdiagnosa =  strlen($diagnosakerja);
            $cekorderfarmasi = preg_replace("/[^A-Za-z]/", "", $request->resepobat);
            $cekorderfar =  strlen($cekorderfarmasi);
            if ($cekdiagnosa == '0') {
                $data = [
                    'kode' => 500,
                    'message' => 'Harap isi diagnosa pasien !'
                ];
                echo json_encode($data);
                die;
            }
            $pasieniter = $request->pasieniter;
            $jumlahiter = $request->jumlahiter;
            $simpantemplate = $request->simpantemplate;
            if (empty($dataSet_1['hipertensi'])) {
                $hipertensi = 0;
            } else {
                $hipertensi = $dataSet_1['hipertensi'];
            };
            if (empty($dataSet_1['kencingmanis'])) {
                $kencingmanis = 0;
            } else {
                $kencingmanis = $dataSet_1['kencingmanis'];
            };
            if (empty($dataSet_1['jantung'])) {
                $jantung = 0;
            } else {
                $jantung = $dataSet_1['jantung'];
            };
            if (empty($dataSet_1['stroke'])) {
                $stroke = 0;
            } else {
                $stroke = $dataSet_1['stroke'];
            };
            if (empty($dataSet_1['hepatitis'])) {
                $hepatitis = 0;
            } else {
                $hepatitis = $dataSet_1['hepatitis'];
            };
            if (empty($dataSet_1['asthma'])) {
                $asthma = 0;
            } else {
                $asthma = $dataSet_1['asthma'];
            };
            if (empty($dataSet_1['ginjal'])) {
                $ginjal = 0;
            } else {
                $ginjal = $dataSet_1['ginjal'];
            };
            if (empty($dataSet_1['tb'])) {
                $tb = 0;
            } else {
                $tb = $dataSet_1['tb'];
            };
            if (empty($dataSet_1['riwayatlain'])) {
                $riwayatlain = 0;
            } else {
                $riwayatlain = $dataSet_1['riwayatlain'];
                if ($dataSet_1['ketriwayatlain'] == '') {
                    $data = [
                        'kode' => 502,
                        'message' => 'Isi keterangan riwayat lain ...'
                    ];
                    echo json_encode($data);
                    die;
                }
            };
            if ($dataSet_2['kesadaran'] == 'Composmentis') {
                $kesadaran = 'Composmentis';
            } else {
                $kesadaran = $dataSet_2['keterangankesadaran'];
            }

            $data = [
                'counter' => $dataSet_1['counter'],
                'kode_unit' => $dataSet_1['unit'],
                'id_kunjungan' => $dataSet_1['kodekunjungan'],
                'id_pasien' => $dataSet_1['nomorrm'],
                'id_asskep' => $dataSet_1['idasskep'],
                'pic' => auth()->user()->id,
                'nama_dokter' => auth()->user()->nama,
                'tgl_kunjungan' => $dataSet_1['tanggalkunjungan'],
                'tgl_pemeriksaan' => $this->get_now(),
                'sumber_data' => $dataSet_1['sumberdata'],
                'tekanan_darah' => $dataSet_2['tekanandarah'],
                'frekuensi_nadi' => $dataSet_2['frekuensinadi'],
                'frekuensi_nafas' => $dataSet_2['frekuensinafas'],
                'beratbadan' => $dataSet_2['beratbadan'],
                'tinggibadan' => $dataSet_2['tinggibadan'],
                'imt' => $dataSet_2['imt'],
                'suhu_tubuh' => $dataSet_2['suhutubuh'],
                'riwayat_alergi' =>  $dataSet_1['alergi'],
                'keterangan_alergi' =>  $dataSet_1['ketalergi'],
                'riwayat_kehamilan_pasien_wanita' => $dataSet_1['riwayatkehamilan'],
                'riwyat_kelahiran_pasien_anak' => $dataSet_1['riwayatkelahiran'],
                'riwyat_penyakit_sekarang' => $dataSet_1['riwayatpenyakitsekarang'],
                'hipertensi' => $hipertensi,
                'kencingmanis' => $kencingmanis,
                'jantung' => $jantung,
                'stroke' => $stroke,
                'hepatitis' => $hepatitis,
                'asthma' => $asthma,
                'ginjal' => $ginjal,
                'tbparu' => $tb,
                'riwayatlain' => $riwayatlain,
                'ket_riwayatlain' => $dataSet_1['ketriwayatlain'],
                'statusgeneralis' => $dataSet_1['statusgeneralis'],
                'pemeriksaan_fisik' => $dataSet_2['pemeriksaanfisik'],
                'keadaanumum' => $dataSet_2['keadaanumum'],
                'kesadaran' => $dataSet_2['kesadaran'],
                'keterangan_kesadaran' => $kesadaran,
                'diagnosakerja' => trim($dataSet_3['diagnosakerja']),
                'diagnosabanding' => $dataSet_3['diagnosabanding'],
                'rencanakerja' => trim($dataSet_4['rencanakerja']),
                'renjana_tindakan' => trim($dataSet_4['rencanatindakan']),
                'tindakanmedis' => trim($dataSet_4['tindakanmedis']),
                'tindakanpenunjang' => trim($dataSet_4['tindakanpenunjang']),
                'keluhan_pasien' => trim($dataSet_1['keluhanutama']),
                'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
                'keterangan_tindak_lanjut' => trim($dataSet_tindaklanjut['keterangantindaklanjut'] . ' ' . $keterangan_iter),
                'keterangan_tindak_lanjut_2' => trim($dataSet_jawabankonsul['isi_jawaban_konsul']),
                'umur' => $dataSet_2['usia'],
                'tgl_entry' => $this->get_now(),
                'status' => '0',
                'signature' => '',
                'evaluasi' => $request->hasilexpertisi
            ];
            $assdok = assesmenawaldokter::updateOrCreate(
                ['id_kunjungan' => $dataSet_1['kodekunjungan']],
                $data
            );
            $id_assesmen = $assdok->id;
            $nomorrm = $dataSet_1['nomorrm'];
            //pemeriksaan khusus
            if (auth()->user()->unit == '1014') {
                $datamata = [
                    'id_assesmen_dokter' => $id_assesmen,
                    'no_rm' => $nomorrm,
                    'nama_dokter' => auth()->user()->nama,
                    'id_dokter' => auth()->user()->id,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'tgl_entry' => $this->get_now(),
                    'status' => '0',
                    'tajampenglihatandekat' => $dataSet_5['hasilpemeriksaanro'],
                    'tekananintraokular' => $dataSet_5['tekanan_intra_okular'] . '|' . $dataSet_5['kiri_tekanan_intra_okular'],
                    'catatanpemeriksaanlain' => $dataSet_5['catatan_pemeriksaan_lainnya'] . '|' . $dataSet_5['kiri_catatan_pemeriksaan_lainnya'],
                    'palpebra' => $dataSet_5['palpebra'] . '|' . $dataSet_5['kiri_palpebra'],
                    'konjungtiva' => $dataSet_5['konjungtiva'] . '|' . $dataSet_5['kiri_konjungtiva'],
                    'kornea' => $dataSet_5['kornea'] . '|' . $dataSet_5['kiri_kornea'],
                    'bilikmatadepan' => $dataSet_5['bilik_mata_depan'] . '|' . $dataSet_5['kiri_bilik_mata_depan'],
                    'pupil' => $dataSet_5['pupil'] . '|' . $dataSet_5['kiri_pupil'],
                    'iris' => $dataSet_5['iris'] . '|' . $dataSet_5['kiri_iris'],
                    'lensa' => $dataSet_5['lensa'] . '|' . $dataSet_5['kiri_lensa'],
                    'funduskopi' => $dataSet_5['funduskopi'] . '|' . $dataSet_5['kiri_funduskopi'],
                    'status_oftamologis_khusus' => $dataSet_5['oftamologis'] . '|' . $dataSet_5['kiri_oftamologis'],
                    'masalahmedis' => $dataSet_5['masalahmedis'] . '|' . $dataSet_5['kiri_masalahmedis'],
                    'prognosis' => $dataSet_5['prognosis'] . '|' . $dataSet_5['kiri_prognosis'],
                    'id_asskep' =>  $id_asskep
                ];
                erm_mata_kanan_kiri::updateOrCreate(
                    ['kode_kunjungan' => $request->kodekunjungan],
                    $datamata
                );
            }
            $diagnosakerja = $dataSet_4['rencanakerja'];
            $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
            $kodekunjungan = $kunjungan[0]->kode_kunjungan;
            $ref_kunjungan = $kunjungan[0]->ref_kunjungan;
            if ($ref_kunjungan != '' || $ref_kunjungan != '0') {
                $datajawab = [
                    'jawaban_konsul' => trim($dataSet_jawabankonsul['isi_jawaban_konsul']),
                    'dokter_jawab' => auth()->user()->nama
                ];
                assesmenawaldokter::where('id_kunjungan', $ref_kunjungan)->update($datajawab);
            }
            if (count($datatindakan) > 0) {
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]));
                $kodekunjungan = $request->kodekunjungan;
                $penjamin = $kunjungan[0]->kode_penjamin;
                $kode_unit = $kunjungan[0]->kode_unit;
                //jika dokter faris
                if (auth()->user()->id == '220') {
                    $kode_unit = '3012';
                } //1
                $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kode_unit]);
                $prefix_kunjungan = $unit[0]->prefix_unit;
                foreach ($datatindakan as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan[] = $dataSet;
                    }
                }
                try {
                    //dummy
                    $kode_unit = $kunjungan[0]->kode_unit;
                    //jika dokter faris
                    if (auth()->user()->id == '220') {
                        $kode_unit = '3012';
                    } //1
                    $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
                    $kode_layanan_header = $r[0]->no_trx_layanan;
                    if ($kode_layanan_header == "") {
                        $year = date('y');
                        $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                        //dummy
                        DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kode_unit]);
                    }
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_layanan_header,
                        'tgl_entry' =>   $now,
                        'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                        'kode_unit' => $kode_unit,
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
                    foreach ($arrayindex_tindakan as $d) {
                        if ($penjamin == 'P01') {
                            $tagihanpenjamin = 0;
                            $tagihanpribadi = $d['tarif'] * $d['qty'];
                        } else {
                            $tagihanpenjamin = $d['tarif'] * $d['qty'];
                            $tagihanpribadi = 0;
                        }
                        $total_tarif = $d['tarif'] * $d['qty'];
                        $id_detail = $this->createLayanandetail();
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_tarif_detail' => $d['kodelayanan'],
                            'total_tarif' => $d['tarif'],
                            'jumlah_layanan' => $d['qty'],
                            'diskon_layanan' => $d['disc'],
                            'total_layanan' => $total_tarif,
                            'grantotal_layanan' => $total_tarif,
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tagihan_penjamin' => $tagihanpenjamin,
                            'tagihan_pribadi' => $tagihanpribadi,
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $ts_layanan_header->id
                        ];
                        $ts_layanan_detail = ts_layanan_detail_dummy::create($save_detail);
                        $grand_total_tarif = $grand_total_tarif + $total_tarif;
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
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            if (count($formobatfarmasi2) > 1) {
                $simpantemplate = $request->simpantemplate;
                // $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                // $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$kodekunjungan]));
                $penjamin = $kunjungan[0]->kode_penjamin;
                //jika penjamin bpjs order ke dp2
                //jika penjamin umum order ke dp1
                //kodeheader dibedakan menjadi ORF
                if (auth()->user()->unit == '3007') {
                    $unit = '4002';
                } else {
                    if ($penjamin == 'P01' || $penjamin == 'P15' || $penjamin == 'P16' || $penjamin == 'P17' || $penjamin == 'P20' || $penjamin == 'P22' || $penjamin == 'P28' || $penjamin == 'P29') {
                        $unit = '4002';
                    } else {
                        $unit = '4008';
                    }
                }
                $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
                $prefix_kunjungan = $mtunit[0]->prefix_unit;
                foreach ($formobatfarmasi2 as $nama) {
                    $index = $nama['name'];
                    $value = $nama['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'keterangan') {
                        $arrayindex_far[] = $dataSet;
                    }
                }
                $list_obat = [];
                foreach ($arrayindex_far as $key => $d) {
                    if ($d['kode_kunjungan'] != $kodekunjungan) {
                        $no = $key + 1;
                        $aturan_pakai_bersih = str_replace('|', ' ', $d['aturanpakai']);
                        $aturan_pakai_bersih = preg_replace('/\s+/', ' ', $aturan_pakai_bersih);
                        $list_obat[] = "{$no}. Nama Obat: " . $d['namaobat'] .
                            ", Jumlah: " . $d['jumlah'] .
                            ", Aturan Pakai: " . trim($aturan_pakai_bersih) .
                            ", Signa: " . $d['signa'] .
                            ", Keterangan: " . $d['keterangan'];
                    }
                }
                $obatnya = implode("\n", $list_obat);
                if ($simpantemplate == 'on') {
                    if ($request->namaresep == '') {
                        $back = [
                            'kode' => 500,
                            'message' => 'Nama Resep tidak boleh kosong !'
                        ];
                        echo json_encode($back);
                        die;
                    }
                    $dataresep = [
                        'nama_resep' => $request->namaresep,
                        'keterangan' => $obatnya,
                        'user' => auth()->user()->kode_paramedis,
                        'tgl_entry' => $this->get_now()
                    ];
                    $id_resep = templateresep::create($dataresep);
                    foreach ($arrayindex_far as $d) {
                        $detailresep = [
                            'id_template' => $id_resep->id,
                            'nama_barang' => $d['namaobat'],
                            'kode_barang' => $d['kodebarang'],
                            'aturan_pakai' => $d['aturanpakai'],
                            'jumlah' => $d['jumlah'],
                            'signa' => $d['signa'],
                            'keterangan' => $d['keterangan'],
                        ];
                        $detailresep = templateresep_detail::create($detailresep);
                    }
                }
                try {
                    if ($pasieniter == 1) {
                        $itt = 'RESEP ITER_ ' . $jumlahiter . ' x';
                    } else {
                        $itt = '';
                    }
                    $kode_unit = $unit;
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
                        'diagnosa' => $diagnosakerja,
                        'dok_kirim' => auth()->user()->kode_paramedis,
                        'status_layanan' => '3',
                        'keterangan' => $itt,
                        'status_retur' => 'OPN',
                        'status_pembayaran' => 'OPN',
                        'status_order' => '0',
                        'id_assdok' => $id_assesmen
                    ];
                    $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                    $cekorder = 0;
                    $racikan = 0;
                    foreach ($arrayindex_far as $d) {
                        if ($d['kode_kunjungan'] != $kodekunjungan) {
                            $id_detail = $this->createLayanandetailOrder();
                            $aturan = trim(str_replace('|', ' ', $d['aturanpakai']));
                            $signa  = trim(str_replace('|', ' ', $d['signa']));
                            $ket    = trim(str_replace('|', ' ', $d['keterangan']));
                            $komponen = array_filter([$aturan, $signa, $ket]);
                            $aturan_pakai_bersih = implode(' | ', $komponen);
                            $save_detail = [
                                'id_layanan_detail' => $id_detail,
                                'kode_layanan_header' => $kode_layanan_header,
                                'kode_dokter1' => auth()->user()->kode_paramedis,
                                'kode_barang' => $d['namaobat'],
                                'jumlah_layanan' => $d['jumlah'],
                                'aturan_pakai' => $aturan_pakai_bersih,
                                'status_layanan_detail' => 'OPN',
                                'tgl_layanan_detail' => $now,
                                'tgl_layanan_detail_2' => $now,
                                'kategori_resep' => $d['jenisresep'],
                                'row_id_header' => $ts_layanan_header->id,
                                'id_assdok' => $id_assesmen
                            ];
                            $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                            $cekorder = $cekorder + 1;
                            if ($d['jenisresep'] == 'RACIKAN') {
                                $racikan = $racikan + 1;
                            }
                        }
                    }
                    if ($racikan > 0) {
                        $jenisantrian = 'RACIKAN';
                    } else {
                        $jenisantrian = 'NON - RACIKAN';
                    }
                    if ($cekorder > 0) {
                        if ($penjamin == 'P01') {
                            //dummy
                            ts_layanan_header_order::where('id', $ts_layanan_header->id)
                                ->update(['status_layanan' => 1, 'jenis_antrian' => $jenisantrian]);
                        } else {
                            //dummy
                            ts_layanan_header_order::where('id', $ts_layanan_header->id)
                                ->update(['status_layanan' => 1, 'jenis_antrian' => $jenisantrian]);
                        }
                    } else {
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->delete();
                    }
                } catch (\Exception $e) {
                    $back = [
                        'kode' => 500,
                        'message' => $e->getMessage()
                    ];
                    echo json_encode($back);
                    die;
                }
            }
            $now = $this->get_now();
            if (count($formorder_lab) > 1) {
                foreach ($formorder_lab as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan_lab[] = $dataSet;
                    }
                }
                $penjamin = $kunjungan[0]->kode_penjamin;
                $kode_layanan_header_order = $this->createOrderHeader('P');
                $data_layanan_header_order = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header_order,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $kodekunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => '3002',
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet_3['diagnosakerja'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0'
                ];
                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                $now = $this->get_now();
                foreach ($arrayindex_tindakan_lab as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['qty'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['qty'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
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
                        'row_id_header' => $ts_layanan_header_order->id
                    ];
                    $ts_layanan_detail_order = ts_layanan_detail_order::create($save_detail_order);
                    $grand_total_tarif = $grand_total_tarif + $d['tarif'];
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
            }
            if (count($formtindakan_rad) > 1) {
                foreach ($formtindakan_rad as $namatindakan) {
                    $index = $namatindakan['name'];
                    $value = $namatindakan['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'cyto') {
                        $arrayindex_tindakan_rad[] = $dataSet;
                    }
                }
                $penjamin = $kunjungan[0]->kode_penjamin;
                $kode_layanan_header_order = $this->createOrderHeader('P');
                $data_layanan_header_order = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header_order,
                    'tgl_entry' =>  $now,
                    'kode_kunjungan' => $kodekunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => '3003',
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet_3['diagnosakerja'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                foreach ($arrayindex_tindakan_rad as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['qty'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['qty'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
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
                        'row_id_header' => $ts_layanan_header_order->id
                    ];
                    $ts_layanan_detail_order = ts_layanan_detail_order::create($save_detail_order);
                    $grand_total_tarif = $grand_total_tarif + $d['tarif'];
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
            }
            ts_kunjungan::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update([
                'kode_paramedis' => auth()->user()->kode_paramedis
            ]);
            $di_diagnosa = [
                'no_rm' => $dataSet_1['nomorrm'],
                'kode_unit' => $dataSet_1['unit'],
                'counter' => $dataSet_1['counter'],
                'kode_kunjungan' => $dataSet_1['kodekunjungan'],
                'pic' => 0,
                'input_date' => $this->get_now(),
                'diag_00' => trim($dataSet_3['diagnosakerja']),
                'alasan_pulang' => 0,
                'rs_rujukan' => 'ERM RAWAT JALAN',
                'kode_paramedis' => auth()->user()->kode_paramedis,
            ];
            $cek = DB::select('select * from di_pasien_diagnosa_frunit where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
            if (count($cek) > 0) {
                di_diagnosa::whereRaw('kode_kunjungan = ?', array($dataSet_1['kodekunjungan']))->update($di_diagnosa);
            } else {
                di_diagnosa::create($di_diagnosa);
            }
            DB::commit();
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanhasilpemeriksaandokterfisio(Request $request)
    {
        DB::beginTransaction();
        try {
            $pasieniter = $request->pasieniter;
            $got = $request->got;
            $jumlahiter = $request->jumlahiter;
            $keterangan_iter = '';
            if ($pasieniter == 1) {
                $keterangan_iter = 'PASIEN ITER ' . $jumlahiter . ' x';
            }
            $data1 = json_decode($_POST['data1'], true);
            $formorder_lab = json_decode($_POST['formorder_lab'], true);
            $formtindakan_rad = json_decode($_POST['formtindakan_rad'], true);
            $datatindakan = json_decode($_POST['datatindakan'], true);
            $datatindaklanjut = json_decode($_POST['datatindaklanjut'], true);
            $formobat_farmasi = json_decode($_POST['formobat_farmasi'], true);
            $formobatfarmasi2 = json_decode($_POST['formobatfarmasi2'], true);
            $jawabankonsul = json_decode($_POST['jawabankonsul'], true);
            foreach ($jawabankonsul as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_jawabankonsul[$index] = $value;
            }
            if (count($datatindaklanjut) == 1) {
                $data = [
                    'kode' => 500,
                    'message' => 'Tindak lanjut pasien harus diisi !'
                ];
                echo json_encode($data);
                die;
            }
            foreach ($datatindaklanjut as $nama_1) {
                $index =  $nama_1['name'];
                $value =  $nama_1['value'];
                $dataSet_tindaklanjut[$index] = $value;
            }
            foreach ($data1 as $nama) {
                $index =  $nama['name'];
                $value =  $nama['value'];
                $dataSet_1[$index] = $value;
            }
            $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
            $data = [
                'id_kunjungan' => $request->kodekunjungan,
                'id_pasien' => $kunjungan[0]->no_rm,
                'pic' => auth()->user()->id,
                'kode_unit' => $dataSet_1['unit'],
                'nama_dokter' => auth()->user()->nama,
                'tgl_entry' => $this->get_now(),
                'tgl_kunjungan' => $kunjungan[0]->tgl_masuk,
                'tgl_pemeriksaan' => $this->get_now(),
                'tekanan_darah' => $dataSet_1['tekanandarah'],
                'frekuensi_nadi' => $dataSet_1['frekuensinadi'],
                'frekuensi_nafas' => $dataSet_1['frekuensinafas'],
                'suhu_tubuh' => $dataSet_1['suhutubuh'],
                'umur' => $dataSet_1['usia'],
                'beratbadan' => $dataSet_1['beratbadan'],
                'anamnesa' => $dataSet_1['anamnesa'],
                'pemeriksaan_fisik' => $dataSet_1['pemeriksaanfisik'],
                'diagnosakerja' => $dataSet_1['diagnosismedis'],
                'diagnosabanding' => $dataSet_1['diagnosisfungsi'],
                'rencanakerja' => $dataSet_1['pemeriksaanpenunjang'],
                'tatalaksana_kfr' => $dataSet_1['tatalaksankfr'],
                'anjuran' => $dataSet_1['anjuran'],
                'evaluasi' => $dataSet_1['evaluasi'],
                'riwayatlain' => $dataSet_1['supekpenyakit'],
                'ket_riwayatlain' => $dataSet_1['keterangansuspek'],
                'keluhan_pasien' => $dataSet_1['keluhanutama'],
                'tindak_lanjut' => $dataSet_tindaklanjut['pilihtindaklanjut'],
                'keterangan_tindak_lanjut' => $dataSet_tindaklanjut['keterangantindaklanjut'] . ' ' . $keterangan_iter,
                'keterangan_tindak_lanjut_2' => trim($dataSet_jawabankonsul['isi_jawaban_konsul']),
                'status' => '0',
                'signature' => '',
                'keterangan5' => $got
            ];
            if ($pasieniter == 1) {
                if ($jumlahiter == '') {
                    $data = [
                        'kode' => 500,
                        'message' => 'Jumlah iter harus diisi ...'
                    ];
                    echo json_encode($data);
                    die;
                }
                $ts_header_iter = [
                    'kode_kunjungan' => $request->kodekunjungan,
                    'no_rm' => $dataSet_1['nomorrm'],
                    'jumlah' => $jumlahiter,
                    'kode_unit' => auth()->user()->unit,
                    'kode_paramedis' => auth()->user()->kode_paramedis,
                    'tgl_iter' => $this->get_now()
                ];
                $cek = db::select('select * from ts_header_iter_bpjs where kode_kunjungan = ?', [$request->kodekunjungan]);
                if (count($cek) == 0) {
                    ts_header_iter::create($ts_header_iter);
                } else {
                    ts_header_iter::whereRaw('id = ?', array($cek['0']->id))->update($ts_header_iter);
                }
            } else {
                $cek = db::select('select * from ts_header_iter_bpjs where kode_kunjungan = ?', [$request->kodekunjungan]);
                if (count($cek) > 0) {
                    ts_header_iter::whereRaw('id = ?', array($cek['0']->id))->delete();
                }
            }
            $assdok = assesmenawaldokter::updateOrCreate(
                ['id_kunjungan' => $dataSet_1['kodekunjungan']],
                $data
            );
            $id_assesmen = $assdok->id;
            $diagnosakerja = $dataSet_1['diagnosismedis'];
            $pasieniter = $request->pasieniter;
            $jumlahiter = $request->jumlahiter;
            $simpantemplate = $request->simpantemplate;
            $kodekunjungan = $request->kodekunjungan;
            $ref_kunjungan = $kunjungan[0]->ref_kunjungan;
            if ($ref_kunjungan != '' || $ref_kunjungan != '0') {
                $datajawab = [
                    'jawaban_konsul' => trim($dataSet_jawabankonsul['isi_jawaban_konsul']),
                    'dokter_jawab' => auth()->user()->nama
                ];
                assesmenawaldokter::where('id_kunjungan', $ref_kunjungan)->update($datajawab);
            }
            if (count($formobatfarmasi2) > 1) {
                $simpantemplate = $request->simpantemplate;
                // $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
                $dt = Carbon::now()->timezone('Asia/Jakarta');
                $date = $dt->toDateString();
                $time = $dt->toTimeString();
                $now = $date . ' ' . $time;
                // $cek_layanan_header = count(DB::SELECT('select id from ts_layanan_header_order where kode_kunjungan = ?', [$kodekunjungan]));
                $penjamin = $kunjungan[0]->kode_penjamin;
                //jika penjamin bpjs order ke dp2
                //jika penjamin umum order ke dp1
                //kodeheader dibedakan menjadi ORF
                if (auth()->user()->unit == '3007') {
                    $unit = '4002';
                } else {
                    if ($penjamin == 'P01' || $penjamin == 'P15' || $penjamin == 'P16' || $penjamin == 'P17' || $penjamin == 'P20' || $penjamin == 'P22' || $penjamin == 'P28' || $penjamin == 'P29') {
                        $unit = '4002';
                    } else {
                        $unit = '4008';
                    }
                }
                $mtunit = DB::select('select * from mt_unit where kode_unit = ?', [$unit]);
                $prefix_kunjungan = $mtunit[0]->prefix_unit;
                foreach ($formobatfarmasi2 as $nama) {
                    $index = $nama['name'];
                    $value = $nama['value'];
                    $dataSet[$index] = $value;
                    if ($index == 'keterangan') {
                        $arrayindex_far[] = $dataSet;
                    }
                }
                $list_obat = [];
                foreach ($arrayindex_far as $key => $d) {
                    if ($d['kode_kunjungan'] != $kodekunjungan) {
                        $no = $key + 1;
                        $aturan_pakai_bersih = str_replace('|', ' ', $d['aturanpakai']);
                        $aturan_pakai_bersih = preg_replace('/\s+/', ' ', $aturan_pakai_bersih);
                        $list_obat[] = "{$no}. Nama Obat: " . $d['namaobat'] .
                            ", Jumlah: " . $d['jumlah'] .
                            ", Aturan Pakai: " . trim($aturan_pakai_bersih) .
                            ", Signa: " . $d['signa'] .
                            ", Keterangan: " . $d['keterangan'];
                    }
                }
                $obatnya = implode("\n", $list_obat);
                if ($simpantemplate == 'on') {
                    if ($request->namaresep == '') {
                        $back = [
                            'kode' => 500,
                            'message' => 'Nama Resep tidak boleh kosong !'
                        ];
                        echo json_encode($back);
                        die;
                    }
                    $dataresep = [
                        'nama_resep' => $request->namaresep,
                        'keterangan' => $obatnya,
                        'user' => auth()->user()->kode_paramedis,
                        'tgl_entry' => $this->get_now()
                    ];
                    $id_resep = templateresep::create($dataresep);
                    foreach ($arrayindex_far as $d) {
                        $detailresep = [
                            'id_template' => $id_resep->id,
                            'nama_barang' => $d['namaobat'],
                            'kode_barang' => $d['kodebarang'],
                            'aturan_pakai' => $d['aturanpakai'],
                            'jumlah' => $d['jumlah'],
                            'signa' => $d['signa'],
                            'keterangan' => $d['keterangan'],
                        ];
                        $detailresep = templateresep_detail::create($detailresep);
                    }
                }
                if ($pasieniter == 1) {
                    $itt = 'RESEP ITER_ ' . $jumlahiter . ' x';
                } else {
                    $itt = '';
                }
                $kode_unit = $unit;
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
                    'diagnosa' => $diagnosakerja,
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'keterangan' => $itt,
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '0',
                    'id_assdok' => $id_assesmen
                ];
                $ts_layanan_header = ts_layanan_header_order::create($data_layanan_header);
                $cekorder = 0;
                foreach ($arrayindex_far as $d) {
                    if ($d['kode_kunjungan'] != $kodekunjungan) {
                        $id_detail = $this->createLayanandetailOrder();
                        $aturan = trim(str_replace('|', ' ', $d['aturanpakai']));
                        $signa  = trim(str_replace('|', ' ', $d['signa']));
                        $ket    = trim(str_replace('|', ' ', $d['keterangan']));
                        $komponen = array_filter([$aturan, $signa, $ket]);
                        $aturan_pakai_bersih = implode(' | ', $komponen);
                        $save_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_layanan_header,
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'kode_barang' => $d['namaobat'],
                            'jumlah_layanan' => $d['jumlah'],
                            'aturan_pakai' => $aturan_pakai_bersih,
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $ts_layanan_header->id,
                            'id_assdok' => $id_assesmen
                        ];
                        $ts_layanan_detail = ts_layanan_detail_order::create($save_detail);
                        $cekorder = $cekorder + 1;
                    }
                }
                if ($cekorder > 0) {
                    if ($penjamin == 'P01') {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    } else {
                        //dummy
                        ts_layanan_header_order::where('id', $ts_layanan_header->id)
                            ->update(['status_layanan' => 1]);
                    }
                } else {
                    ts_layanan_header_order::where('id', $ts_layanan_header->id)
                        ->delete();
                }
            }
            $di_diagnosa = [
                'no_rm' => $dataSet_1['nomorrm'],
                'kode_unit' => $dataSet_1['unit'],
                'counter' => $dataSet_1['counter'],
                'kode_kunjungan' => $dataSet_1['kodekunjungan'],
                'pic' => 0,
                'input_date' => $this->get_now(),
                'diag_00' => trim($diagnosakerja),
                'alasan_pulang' => 0,
                'rs_rujukan' => 'ERM RAWAT JALAN',
                'kode_paramedis' => auth()->user()->kode_paramedis,
            ];
            $cek = DB::select('select * from di_pasien_diagnosa_frunit where kode_kunjungan = ?', [$dataSet_1['kodekunjungan']]);
            if (count($cek) > 0) {
                di_diagnosa::whereRaw('kode_kunjungan = ?', array($dataSet_1['kodekunjungan']))->update($di_diagnosa);
            } else {
                di_diagnosa::create($di_diagnosa);
            }
            DB::commit();
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function v_berkas_scan_kunjungan(Request $request)
    {
        $kode_kunjungan = $request->kodekunjungan;
        $data_file = db::select('select * from erm_upload_gambar where kodekunjungan = ?', [$kode_kunjungan]);
        return view('ermtemplate.v_berkas_scan_by_kunjungan', compact([
            'data_file'
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
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
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
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS_2('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function ambilhasillab(Request $request)
    {
        $rm = $request->nomorrm;
        // Query counter kunjungan (tetap dipertahankan sesuai kode Anda)
        $ts_kunjungan = db::select('select counter from ts_kunjungan where no_rm = ? and status_kunjungan != 8 ORDER BY kode_kunjungan DESC limit 8', [$rm]);
        // Panggil Stored Procedure hasil lab umum/non-spesial
        $hasil_lab = db::select("CALL LIHAT_HASIL_LAB_XXX(?)", [$rm]);
        if (empty($hasil_lab)) {
            return response()->json(['status' => 'empty', 'message' => 'Tidak ada data hasil lab untuk RM ini.']);
        }
        $berhasil = 0;
        $gagal = 0;
        $list_file = [];
        if (count($hasil_lab) > 0) {
            foreach ($hasil_lab as $c) {
                $urlDokumen = $c->link;
                $no_rm = $c->no_rm;
                $kodeKunjungan = $c->kode_kunjungan;
                $kode_layanan = $c->KODE;
                $noLab = $c->KODE ?? uniqid(); // Gunakan nomor lab sebagai nama file agar unik
                $namaFile = $noLab . '.pdf';
                if (!$urlDokumen) {
                    $gagal++;
                    continue;
                }
                try {
                    // --- KONDISI 1: JIKA FILE SUDAH PERNAH DIDOWNLOAD (ADA DI DISK) ---
                    if (Storage::disk('LAB_1')->exists($namaFile)) {
                        $urlFileTersimpan = '\\\\192.168.2.14\\erm\\hasil_lab_1/' . $namaFile;
                        // Pastikan log databasenya aman/sinkron
                        \DB::table('ts_hasil_lab_dokumen_lab')->updateOrInsert(
                            [
                                'kode_kunjungan' => $kodeKunjungan,
                                'no_lab'         => $noLab,
                            ],
                            [
                                'no_rm'          => $no_rm,
                                'url_file'       => $urlFileTersimpan,
                                'nama_file'      => $namaFile,
                                'updated_at'     => now(),
                                'keterangan'     => 'NON - SPESIAL ORDER'
                            ]
                        );

                        $berhasil++;
                        $list_file[] = Storage::disk('LAB_1')->path($namaFile);
                        continue; // LANGSUNG LANJUT KE LOOPING BERIKUTNYA (TANPA HIT API DOWNLOAD)
                    }

                    // --- KONDISI 2: JIKA FILE BELUM ADA, JALANKAN PROSES DOWNLOAD ---
                    $response = Http::timeout(10)->get($urlDokumen);

                    if ($response->successful()) {
                        $fileContent = $response->body();
                        try {
                            // Simpan file fisik ke disk LAB_1
                            $simpan = Storage::disk('LAB_1')->put($namaFile, $fileContent);

                            if ($simpan) {
                                $berhasil++;
                                $urlFileTersimpan = '\\\\192.168.2.14\\erm\\hasil_lab_1/' . $namaFile;

                                \DB::table('ts_hasil_lab_dokumen_lab')->updateOrInsert(
                                    [
                                        'kode_kunjungan' => $kodeKunjungan,
                                        'no_lab'         => $noLab,
                                    ],
                                    [
                                        'no_rm'          => $no_rm,
                                        'url_file'       => $urlFileTersimpan,
                                        'nama_file'      => $namaFile,
                                        'updated_at'     => now(),
                                        'keterangan'     => 'NON - SPESIAL ORDER'
                                    ]
                                );

                                $list_file[] = Storage::disk('LAB_1')->path($namaFile);
                            } else {
                                $gagal++;
                            }
                        } catch (\Exception $e) {
                            $gagal++;
                            \Log::error("Gagal menulis file ke disk LAB_1 untuk No Lab " . $noLab . ": " . $e->getMessage());
                        }
                    } else {
                        $gagal++;
                    }
                } catch (\Exception $e) {
                    $gagal++;
                    \Log::error("Gagal memproses/mendownload hasil lab " . $noLab . ": " . $e->getMessage());
                }
            }
        }

        // Ambil semua data rekaman berkas untuk dikirim ke view Blade
        $datahasil = db::select('select * from ts_hasil_lab_dokumen_lab where no_rm = ? and keterangan = ? ORDER BY kode_kunjungan desc', [$rm, 'NON - SPESIAL ORDER']);

        return view('update_erm_dokter.view_hasil_lab', compact([
            'datahasil'
        ]));
    }
    public function ambilhasillabspesial(Request $request)
    {
        $rm = $request->nomorrm;

        // Mengambil data counter kunjungan (tidak merusak query bawaan Anda)
        $ts_kunjungan = db::select('select counter from ts_kunjungan where no_rm = ? and status_kunjungan != 8 ORDER BY kode_kunjungan DESC limit 8', [$rm]);

        // Panggil Stored Procedure hasil lab spesial
        $hasil_lab = db::select("CALL LIHAT_HASIL_LAB_SPESIAL(?)", [$rm]);

        if (empty($hasil_lab)) {
            return response()->json(['status' => 'empty', 'message' => 'Tidak ada data hasil lab untuk RM ini.']);
        }

        $berhasil = 0;
        $gagal = 0;
        $list_file = [];

        foreach ($hasil_lab as $c) {
            $urlDokumen = $c->link;
            $no_rm = $c->no_rm;
            $kodeKunjungan = $c->kode_kunjungan;
            $noLab = $c->KODE ?? uniqid(); // Gunakan nomor lab sebagai nama file agar unik
            $namaFile = $noLab . '.pdf';

            if (!$urlDokumen) {
                $gagal++;
                continue;
            }

            try {
                // --- TRIK UTAMA: CEK APAKAH FILE FISIK SUDAH ADA DI STORAGE ---
                if (Storage::disk('LAB_2')->exists($namaFile)) {
                    // Jika file sudah ada, skip download! Langsung pastikan DB ter-update/insert aman
                    $urlFileTersimpan = '\\\\192.168.2.14\\erm\\hasil_lab_2/' . $namaFile;
                    \DB::table('ts_hasil_lab_dokumen_lab_spesial')->updateOrInsert(
                        ['kode_kunjungan' => $kodeKunjungan, 'no_lab' => $noLab],
                        [
                            'no_rm'      => $no_rm,
                            'url_file'   => $urlFileTersimpan,
                            'nama_file'  => $namaFile,
                            'updated_at' => now(),
                            'keterangan' => 'SPESIAL ORDER'
                        ]
                    );

                    $berhasil++;
                    $list_file[] = Storage::disk('LAB_2')->path($namaFile);
                    continue; // Lanjutkan ke looping item lab berikutnya tanpa mendownload!
                }

                // --- JIKA FILE BELUM ADA, BARU JALANKAN PROSES DOWNLOAD ---
                $response = Http::timeout(10)->get($urlDokumen);

                if ($response->successful()) {
                    $fileContent = $response->body();

                    try {
                        $simpan = Storage::disk('LAB_2')->put($namaFile, $fileContent);

                        if ($simpan) {
                            $berhasil++;
                            $urlFileTersimpan = '\\\\192.168.2.14\\erm\\hasil_lab_2/' . $namaFile;

                            \DB::table('ts_hasil_lab_dokumen_lab_spesial')->updateOrInsert(
                                ['kode_kunjungan' => $kodeKunjungan, 'no_lab' => $noLab],
                                [
                                    'no_rm'      => $no_rm,
                                    'url_file'   => $urlFileTersimpan,
                                    'nama_file'  => $namaFile,
                                    'updated_at' => now(),
                                    'keterangan' => 'SPESIAL ORDER'
                                ]
                            );

                            $list_file[] = Storage::disk('LAB_2')->path($namaFile);
                        } else {
                            $gagal++;
                        }
                    } catch (\Exception $e) {
                        $gagal++;
                        \Log::error("Gagal menulis file ke disk LAB_2 untuk No Lab " . $noLab . ": " . $e->getMessage());
                    }
                } else {
                    $gagal++;
                }
            } catch (\Exception $e) {
                $gagal++;
                \Log::error("Gagal memproses/mendownload hasil lab " . $noLab . ": " . $e->getMessage());
            }
        }

        // Ambil data gabungan hasil untuk dikirim ke view Blade
        $datahasil = db::select('select * from ts_hasil_lab_dokumen_lab_spesial where no_rm = ? and keterangan = ? ORDER BY kode_kunjungan desc', [$rm, 'SPESIAL ORDER']);

        return view('update_erm_dokter.view_hasil_lab_spesial', compact([
            'datahasil'
        ]));
    }
    public function bukaPdfLokal($namaFile)
    {
        // 1. Pastikan file ada di dalam disk LAB_1
        if (!Storage::disk('LAB_1')->exists($namaFile)) {
            return response("<p style='font-family:sans-serif; text-align:center; margin-top:50px; color:red;'>
                            <strong>Berkas Tidak Ditemukan:</strong> File PDF " . $namaFile . " tidak ada di folder arsip lab.</p>", 404);
        }

        try {
            // 2. Ambil mentahan konten file dari folder sharing
            $fileContent = Storage::disk('LAB_1')->get($namaFile);

            // 3. Stream langsung ke browser sebagai PDF resmi (First-Party)
            return response($fileContent, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Length', strlen($fileContent))
                ->header('Content-Disposition', 'inline; filename="' . $namaFile . '"')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        } catch (\Exception $e) {
            return response("Gagal membaca file dari server storage: " . $e->getMessage(), 500);
        }
    }
    public function bukaPdfLokal2($namaFile)
    {
        // 1. Pastikan file ada di dalam disk LAB_1
        if (!Storage::disk('LAB_2')->exists($namaFile)) {
            return response("<p style='font-family:sans-serif; text-align:center; margin-top:50px; color:red;'>
                            <strong>Berkas Tidak Ditemukan:</strong> File PDF " . $namaFile . " tidak ada di folder arsip lab.</p>", 404);
        }

        try {
            // 2. Ambil mentahan konten file dari folder sharing
            $fileContent = Storage::disk('LAB_2')->get($namaFile);

            // 3. Stream langsung ke browser sebagai PDF resmi (First-Party)
            return response($fileContent, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Length', strlen($fileContent))
                ->header('Content-Disposition', 'inline; filename="' . $namaFile . '"')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        } catch (\Exception $e) {
            return response("Gagal membaca file dari server storage: " . $e->getMessage(), 500);
        }
    }
    public function liathasilpenunjangradiologi(Request $request)
    {
        $nomorrm = $request->nomorrm;
        $data = db::connection('mysql6')->select('select * from order_table where PID = ? ORDER BY ID DESC', [$nomorrm]);
        return view('update_erm_dokter.hasil_radiologi', compact([
            'data'
        ]));
    }
    public function lihatberkasscanrm(Request $request)
    {
        $rm = $request->nomorrm;
        $rmEnamDigit = substr($rm, -6);
        $cek = DB::select('
            select * from jkn_scan_file_rm 
            where RIGHT(norm, 6) = ?
        ', [$rmEnamDigit]);
        return view('update_erm_dokter.hasil_scan_berkas_rm', compact([
            'cek'
        ]));
    }
    public function lihatriwayatsumarilispasien(Request $request)
    {
        $rm = $request->nomorrm;
        $cek = db::select('select * from ts_hasil_sumarilis where no_rm = ? order by id desc', [$rm]);
        return view('update_erm_dokter.hasil_sumarilis', compact([
            'cek'
        ]));
    }
    public function lihatberkaslain(Request $request)
    {
        $rm = $request->nomorrm;
        $cek = DB::select('select * from erm_upload_gambar where no_rm = ? order by id DESC', [$rm]);
        $url = "https://192.168.2.45/files/";
        return view('update_erm_dokter.scan_berkas_luar', compact([
            'cek',
            'url'
        ]));
    }
    public function lihatcatatanHD(Request $request)
    {
        $rm = $request->nomorrm;
        $cek = DB::select('select * from erm_upload_gambar where no_rm = ? order by id DESC', [$rm]);
        $url = "http://192.168.2.45/files/";
        return view('update_erm_dokter.scan_berkas_luar', compact([
            'cek',
            'url'
        ]));
    }
    public function viewPanduanTte(Request $request)
    {
        $namaFile = 'panduan.pdf';

        // 2. Tentukan jalur lokasi penyimpanan file secara aman
        // Direkomendasikan disimpan di folder: storage/app/public/dokumen/
        $path = storage_path('app/public/' . $namaFile);

        // 3. Validasi: Jika file fisik tidak ditemukan di server, berikan return eror estetik
        if (!file_exists($path)) {
            abort(404, 'Berkas dokumen panduan PDF tidak ditemukan di server. Silahkan hubungi IT SIMRS.');
        }

        // 4. Ambil tipe konten file (MIME Type)
        $contentType = mime_content_type($path);

        // 5. Kembalikan respons file agar langsung di-render oleh PDF Viewer bawaan Browser
        return Response::file($path, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . $namaFile . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
    public function simpanaktivasitte(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $arraydata[$index] = $value;
        }
        $acc = $arraydata['setuju_simpan'] ?? '';
        if (empty($acc)) {
            // Kondisi jika index 'setuju_simpan' tidak ditemukan atau nilainya kosong
            $persetujuan = 0;
            $passwordtte = 0;
        } else {
            $persetujuan = 1;
            $passwordtte = $arraydata['password_tte'];
        }
        $data_tte = [
            'status_tte' => 1,
            'nik' => $arraydata['nik'],
            'password_tte' => $passwordtte,
            'persetujuan_simpan' => $persetujuan,
        ];
        User::where('id', auth()->user()->id)->update($data_tte);
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function storeassbun(Request $request)
    {
        $data = json_decode($_POST['dataisi'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $arraydata[$index] = $value;
        }
        $attributes = [
            'kode_kunjungan' => $arraydata['kode_kunjungan'] ?? null
        ];
        $arraydata['tgl_entry'] = $this->get_now();
        DB::table('erm_assesmen_risiko_bunuh_diri')->updateOrInsert(
            $attributes, // Parameter 1: Kriteria pencarian
            $arraydata   // Parameter 2: Data yang akan di-insert atau di-update
        );
        return response()->json([
            'status'  => 'success',
            'message' => 'Data Asesmen Risiko Bunuh Diri berhasil disimpan secara Server-Side!',
            'data'    => '',
            // 'html' => $html // Opsional jika update tabel tanpa reload
        ], 200);
    }
}
