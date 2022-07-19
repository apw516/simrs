<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VclaimModel;
use App\Models\Pasien;

class VclaimController extends Controller
{
    public function index()
    {
        $title = 'SIMRS - DATA SEP';
        $sidebar = '4';
        $sidebar_m = '4.1';
        $v = new VclaimModel();
        $tgl = date('Y-m-d');
        $kunjunganranap = $v->get_data_kunjungan_ranap($tgl);
        $kunjunganrajal = $v->get_data_kunjungan_rajal($tgl);
        $listajuansep = $v->get_data_finger($tgl);
        return view('simrs.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'ranap' => $kunjunganranap,
            'rajal' => $kunjunganrajal,
            'sidebar_m' => $sidebar_m,
            'listajuan' => $listajuansep
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function Suratkontrol()
    {
        $title = 'SIMRS - DATA SURAT KONTROL';
        $sidebar = '4';
        $sidebar_m = '4.2';
        $v = new VclaimModel();
        $tgl = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));
        $suratkontrol_rs = $v->ListRencanaKontrol_rs($d2, $tgl, 2);
        return view('suratkontrol.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'list' => $suratkontrol_rs,
            'sidebar_m' => $sidebar_m
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function rujukan()
    {
        $title = 'SIMRS - RUJUKAN';
        $sidebar = '4';
        $sidebar_m = '4.3';
        $v = new VclaimModel();
        // $tgl = date('Y-m-d');
        // $d2 = date('Y-m-d', strtotime('-7 days'));
        // $suratkontrol_rs = $v->ListRencanaKontrol_rs($d2,$tgl,2);
        return view('rujukan.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            // 'list' => $suratkontrol_rs,
            'sidebar_m' => $sidebar_m
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function Referensi()
    {
        $title = 'SIMRS - DATA SURAT KONTROL';
        $sidebar = '4';
        $sidebar_m = '4.4';
        return view('referensi.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            'poli' => DB::select('select * from mt_unit')
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function Referensidokter(Request $request)
    {
        $v = new VclaimModel();
        $dokter = $v->referensi_dpjp($request->filter, $request->tanggal, $request->poli);
        if ($dokter->metaData->code == 200) {
            foreach ($dokter->response->list as $d) {
                $kodedpjp = $d->kode;
                $tb = DB::table('mt_kuota_dokter_poli')->where('kode_dpjp', $kodedpjp)->get();
                if (count($tb) == 0) {
                    DB::select('insert into mt_kuota_dokter_poli (nama_dokter,kode_poli_bpjs,kode_dpjp) values (?,?,?)', [$d->nama, $request->poli, $kodedpjp]);
                };
            };
        }
        return view('referensi.tabeldokter', [
            'dokter' => $dokter
        ]);
    }
    public function listsuratkontrol_rs(Request $request)
    {
        $v = new VclaimModel();
        $suratkontrol_rs = $v->ListRencanaKontrol_rs($request->tanggalawal, $request->tanggalakhir, $request->filter);
        // dd($listsuratkontrol_peserta);
        return view('suratkontrol.listsurat_rs', [
            'list' => $suratkontrol_rs
        ]);
    }
    public function listsuratkontrol_peserta(Request $request)
    {
        $v = new VclaimModel();
        $listsuratkontrol_peserta = $v->ListRencanaKontrol_peserta($request->bulan, $request->tahun, $request->noka, $request->filter);
        // dd($listsuratkontrol_peserta);
        return view('suratkontrol.listsurat_peserta', [
            'list' => $listsuratkontrol_peserta
        ]);
    }
    public function datakunjungansep(Request $request)
    {
        $v = new VclaimModel();
        $tgl = $request->tanggalsep;
        $kunjunganranap = $v->get_data_kunjungan_ranap($tgl);
        $kunjunganrajal = $v->get_data_kunjungan_rajal($tgl);
        return view('simrs.tabelriwayatkunjungan', [
            'ranap' => $kunjunganranap,
            'rajal' => $kunjunganrajal,
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function datakunjungansep_peserta(Request $request)
    {
        $v = new VclaimModel();
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $nomorkartu = $request->nomorkartu;
        $datakunjungan = $v->get_data_kunjungan_peserta($nomorkartu, $tglawal, $tglakhir);
        return view('simrs.tabelriwayatkunjungan_peserta', [
            'datakunjungan' => $datakunjungan,
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function datalisttanggalpulang(Request $request)
    {
        $v = new VclaimModel();
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $listtgl_pulang = $v->get_data_list_tanggal_pulang($bulan, $tahun);
        return view('simrs.tabeltanggal_pulang', [
            'datakunjungan' => $listtgl_pulang,
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function detailsep(Request $request)
    {
        $v = new VclaimModel();
        $sep = $request->nomorsep;
        $detailsep = $v->carisep($sep);
        $sepinternal = $v->carisep_internal($sep);
        // dd($sepinternal);
        return view('simrs.detailsep', [
            'detailsep' => $detailsep,
            'sepinternal' => $sepinternal
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function hapussep(Request $request)
    {
        $v = new VclaimModel();
        $sep = $request->nomorsep;
        $data_sep = [
            "request" => [
                "t_sep" => [
                    "noSep" => $sep,
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $delete = $v->hapussep($data_sep);
        echo json_encode($delete);
    }
    public function updatesep(Request $request)
    {
        $v = new VclaimModel();
        $sep = $request->nomorsep;
        $detailsep = $v->carisep($sep);
        $propinsi = $v->referensi_propinsi();
        $kdstatuslaka = $detailsep->response->kdStatusKecelakaan;
        if ($kdstatuslaka == 0) {
            $kdprop = '16';
            $kdkab = '0227';
        } else {
            $kdprop = $detailsep->response->lokasiKejadian->kdProp;
            $kdkab = $detailsep->response->lokasiKejadian->kdKab;
        }
        $kabupaten = $v->referensi_kabupaten($kdprop);
        $kecamatan = $v->referensi_kecamatan($kdkab);
        $carisepkontrol = $v->carisep_kontrol($sep);
        $politujuan = $carisepkontrol->response->poli;
        $kodepoli = substr($politujuan, 0, 3);
        return view('simrs.updatesep', [
            'detailsep' => $detailsep,
            'propinsi' => $propinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kodepoli' => $kodepoli,
            'sepkontrol' => $carisepkontrol
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function updatepulang(Request $request)
    {
        $v = new VclaimModel();
        $data =   [
            "request" =>  [
                "t_sep" =>  [
                    "noSep" =>  "$request->sep",
                    "statusPulang" => "$request->status",
                    "noSuratMeninggal" => "$request->suratmeninggal",
                    "tglMeninggal" => "$request->tanggalmeninggal",
                    "tglPulang" => "$request->tanggalpulang",
                    "noLPManual" => "$request->nomorlp",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $pulang = $v->updatetglpulang($data);
        echo json_encode($pulang);
    }
    public function simpanupdatesep(Request $request)
    {
        $v = new VclaimModel();
        $data =
            [
                "request" => [
                    "t_sep" => [
                        "noSep" => "$request->nomorsep",
                        "klsRawat" => [
                            "klsRawatHak" => "$request->kelasrawathak",
                            "klsRawatNaik" => "$request->klsRawatNaik",
                            "pembiayaan" => "$request->pembiayaan",
                            "penanggungJawab" => "$request->penanggungjawab"
                        ],
                        "noMR" => "$request->nomorrm",
                        "catatan" => "$request->catatan",
                        "diagAwal" => "$request->diagnosa",
                        "poli" => [
                            "tujuan" => "$request->politujuan",
                            "eksekutif" => "0"
                        ],
                        "cob" => [
                            "cob" => "0"
                        ],
                        "katarak" => [
                            "katarak" => "0"
                        ],
                        "jaminan" => [
                            "lakaLantas" => "$request->lakaLantas",
                            "penjamin" => [
                                "tglKejadian" => "$request->tglkejadian",
                                "keterangan" => "$request->keterangan",
                                "suplesi" => [
                                    "suplesi" => "0",
                                    "noSepSuplesi" => "",
                                    "lokasiLaka" => [
                                        "kdPropinsi" => "$request->kdprop",
                                        "kdKabupaten" => "$request->kdkab",
                                        "kdKecamatan" => "$request->kdkec"
                                    ]
                                ]
                            ]
                        ],
                        "dpjpLayan" => "$request->dpjpLayan",
                        "noTelp" => "$request->notelp",
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
        // dd($data);
        $delete = $v->updatesep($data);
        echo json_encode($delete);
    }
    public function pengajuansep(Request $request)
    {
        $v = new VclaimModel();
        $data = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "$request->noka",
                    "tglSep" => "$request->tgl",
                    "jnsPelayanan" => "$request->jenispelayanan",
                    "jnsPengajuan" => "$request->jenispengajuan",
                    "keterangan" => "$request->keterangan",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $ajuan = $v->pengajuansep($data);
        if ($ajuan->metaData->code == 200) {
            $data = [
                "request" => [
                    "t_sep" => [
                        "noKartu" => "$request->noka",
                        "tglSep" => "$request->tgl",
                        "jnsPelayanan" => "$request->jenispelayanan",
                        "jnsPengajuan" => "$request->jenispengajuan",
                        "keterangan" => "$request->keterangan",
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
            // dd($request->jenispengajuan);
            if ($request->jenispengajuan > 1) {
                $ajuan = $v->aprrovalpengajuan($data);
                echo json_encode($ajuan);
            } else {
                echo json_encode($ajuan);
            }
        } else {
            echo json_encode($ajuan);
        }
    }
    public function carilistfinger(Request $request)
    {
        $v = new VclaimModel();
        $listajuansep = $v->get_data_finger($request->tanggalpelayanan);
        return view('simrs.tabellistfinger', [
            'listajuan' => $listajuansep
        ]);
    }
    public function hapus_suratkontrol(Request $request)
    {
        $v = new VclaimModel();
        $data =   [
            "request" =>  [
                "t_suratkontrol" => [
                    "noSuratKontrol" => "$request->nomorsurat",
                    "user" => "waled | " . auth()->user()->id
                ]
            ]
        ];
        $hapus = $v->hapus_suratkontrol($data);
        echo json_encode($hapus);
    }
    public function datarujukan_bycard(Request $request)
    {
        $nomorkartu = $request->noka;
        $v = new VclaimModel();
        $r1 = $v->Listrujukan_bycard_faskes1($nomorkartu);
        $r2 = $v->Listrujukan_bycard_faskes2($nomorkartu);
        return view('rujukan.tabelrujukan_peserta', [
            'f1' => $r1,
            'f2' => $r2
        ]);
    }
    public function listrujukan_keluar(Request $request)
    {
        dd('Belum jadi');
    }
    public function vclaimcarisep(Request $request)
    {
        $v = new VclaimModel();
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $noka = strlen($request->nomorkartu);
        if ($noka >= 13) {
            $datakunjungan = $v->get_data_kunjungan_peserta($request->nomorkartu, $tglawal, $tglakhir);
        } else {
            $pasien = DB::select('SELECT * FROM mt_pasien WHERE no_rm = ?', [$request->nomorkartu]);
            $noka = $pasien[0]->no_Bpjs;
            $datakunjungan = $v->get_data_kunjungan_peserta($noka, $tglawal, $tglakhir);
        }
        return view('vclaim.tabelcarisep', [
            'datakunjungan' => $datakunjungan,
        ]);
    }
    public function sepinternal(Request $request)
    {
        $v = new VclaimModel();
        $sep = $request->nosep;
        $sepinternal = $v->carisep_internal($sep);
        // dd($sepinternal);
        return view('vclaim.tabelsepinternal', [
            'sepinternal' => $sepinternal
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function vclaimlistfinger(Request $request)
    {
        $v = new VclaimModel();
        $listajuansep = $v->get_data_finger($request->tanggal);
        return view('vclaim.tabellistfinger', [
            'list' => $listajuansep
            // 'data_pasien' => Pasien::where('tgl_entry', date('Y-m-d'))->get()
        ]);
    }
    public function vclaimcarirujukanpeserta(Request $request)
    {
        $v = new VclaimModel();
        $nomorcari = $request->nomorpencarian;
        $count = strlen($nomorcari);
        if ($count > 15) {
            $rujukan = $v->carirujukan_byno($request->nomorpencarian);
            if ($rujukan->metaData->code == 200) {
            } else {
                $rujukan = $v->carirujukanRS_byno_($request->nomorpencarian);
            }
            return view('pendaftaran.inforujukan', [
                'rujukan' => $rujukan
            ]);
        } else if ($count == 13) {
            $r1 = $v->Listrujukan_bycard_faskes1($nomorcari);
            $r2 = $v->Listrujukan_bycard_faskes2($nomorcari);
            return view('rujukan.tabelrujukan_peserta2', [
                'f1' => $r1,
                'f2' => $r2
            ]);
        } else {
            $pasien = Pasien::where('no_rm', $request->nomorpencarian)->get();
            $noka = $pasien[0]['no_Bpjs'];
            $r1 = $v->Listrujukan_bycard_faskes1($noka);
            $r2 = $v->Listrujukan_bycard_faskes2($noka);
            return view('rujukan.tabelrujukan_peserta2', [
                'f1' => $r1,
                'f2' => $r2
            ]);
        }
    }
    public function vclaimcarirujukankhusus(Request $request)
    {
        $v = new VclaimModel();
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $rujukan = $v->carirujukan_khusus($bulan,$tahun);
        return view('vclaim.tabelrujukan_khusus', [
            'list' => $rujukan
        ]);     
    }
    public function vclaimcarirujukankeluar(Request $request)
    {
        $v = new VclaimModel();
        $list = $v->carirujukan_keluar($request->tglawal, $request->tglakhir);
        return view('vclaim.tabelrujukan_keluar', [
            'list' => $list
        ]);
    }
    public function detailrujukankeluar(Request $request)
    {
        $v = new VclaimModel();
        $rujukan = $v->detailrujukan_keluar($request->noRujukan);
        return view('vclaim.detailrujukan_keluar', [
            'data' => $rujukan
        ]);
    }
    public function updaterujukankeluar(Request $request)
    {
        $v = new VclaimModel();
        $rujukan = $v->detailrujukan_keluar($request->noRujukan);
        return view('vclaim.updaterujukan_keluar', [
            'data' => $rujukan
        ]);
    }
    public function caripolirujukan(Request $request)
    {
        $v = new VclaimModel();
        $rujukan = $v->list_sarana($request->kodeppk, $request->tglrujukan);
        return view('vclaim.tabelpolispesialistik', [
            'f1' => $rujukan
        ]);
    }
    public function vclaimsimpanupdate_rujukan(Request $request)
    {
        $v = new VclaimModel();
        $data = [
            "request" => [
                "t_rujukan" => [
                    "noRujukan" => "$request->rujukan",
                    "tglRujukan" => "$request->tglrujukan",
                    "tglRencanaKunjungan" => "$request->tglrencanakunjungan",
                    "ppkDirujuk" => "$request->kodeppk",
                    "jnsPelayanan" => "$request->jnspelyanan",
                    "catatan" => "$request->catatan",
                    "diagRujukan" => "$request->kodediag",
                    "tipeRujukan" => "$request->tiperujukan",
                    "poliRujukan" => "$request->kodepoli",
                    "user" => "waled | " . auth()->user()->id
                ]
            ]
        ];
        $rujukan = $v->updaterujukan($data);
        $data = [
            'kode' => $rujukan->metaData->code,
            'message' => $rujukan->metaData->message
        ];
        echo json_encode($data);
    }
    public function vclaimsimpan_rujukan(Request $request)
    {
        $v = new VclaimModel();
        $datarujukan = [
            "request" => [
                "t_rujukan" => [
                    "noSep" => "$request->sep",
                    "tglRujukan" => "$request->tanggalrujukan",
                    "tglRencanaKunjungan" => "$request->tglrencanakunjungan",
                    "ppkDirujuk" => "$request->kodefaskes_rujukan",
                    "jnsPelayanan" => "$request->jenispelayanan_rujukan",
                    "catatan" => "$request->catatan_rujukan",
                    "diagRujukan" => "$request->kodediagnosa_rujukan",
                    "tipeRujukan" => "$request->tiperujukan",
                    "poliRujukan" => "$request->kodepoli_rujukan",
                    "user" => "waled | " . auth()->user()->id
                ]
            ]
        ];
        $rujukan = $v->insertrujukan($datarujukan);
        $data = [
            'kode' => $rujukan->metaData->code,
            'message' => $rujukan->metaData->message
        ];
        echo json_encode($data);
    }
    public function deleterujukan(Request $request)
    {
        $v = new VclaimModel();
        $data = [
            "request" => [
                "t_rujukan" => [
                    "noRujukan" => "$request->noRujukan",
                    "user" => "waled | " . auth()->user()->id
                ]
            ]
        ];
        $rujukan = $v->deleterujukan($data);
        $data1 = [
            'kode' => $rujukan->metaData->code,
            'message' => $rujukan->metaData->message
        ];
        echo json_encode($data1);
    }
    public function vclaimambil_formdiagnosa(Request $request)
    {
        $jlh = $request->jumlah_diagnosa;
        if ($jlh == 1) {
            return view('rujukankhusus.diagnosa1');
        } else if ($jlh == 2) {
            return view('rujukankhusus.diagnosa2');
        } else if ($jlh == 3) {
            return view('rujukankhusus.diagnosa3');
        } else if ($jlh == 4) {
            return view('rujukankhusus.diagnosa4');
        } else if ($jlh == 5) {
            return view('rujukankhusus.diagnosa5');
        }
    }
    public function vclaimambil_formprocedure(Request $request)
    {
        $jlh = $request->jumlah_procedure;
        if ($jlh == 1) {
            return view('rujukankhusus.procedure1');
        } else if ($jlh == 2) {
            return view('rujukankhusus.procedure2');
        } else if ($jlh == 3) {
            return view('rujukankhusus.procedure3');
        } else if ($jlh == 4) {
            return view('rujukankhusus.procedure4');
        } else if ($jlh == 5) {
            return view('rujukankhusus.procedure5');
        }
    }
    public function vclaimsimpan_rujukankhusus(Request $request)
    {
        $nomorrujukan = $request->rujukan;
        $jlhdiagnosa = $request->jlhdiag;
        $jlhproce = $request->jlhproc;
        $s1 = $request->s1;
        $s2 = $request->s2;
        $s3 = $request->s3;
        $s4 = $request->s4;
        $s5 = $request->s5;
        $d1 = $request->diag1;
        $d2 = $request->diag2;
        $d3 = $request->diag3;
        $d4 = $request->diag4;
        $d5 = $request->diag5;
        $p1 = $request->proc1;
        $p2 = $request->proc2;
        $p3 = $request->proc3;
        $p4 = $request->proc4;
        $p5 = $request->proc5;
        if ($jlhdiagnosa == 1) {
            $diagnosa = [
                ["kode" => "$s1;$d1"]
            ];
        } else if ($jlhdiagnosa == 2) {
            $diagnosa = [
                ["kode" => "$s1;$d1"],
                ["kode" => "$s2;$d2"]
            ];
        } else if ($jlhdiagnosa == 3) {
            $diagnosa = [
                ["kode" => "$s1;$d1"],
                ["kode" => "$s2;$d2"],
                ["kode" => "$s3;$d3"]
            ];
        } else if ($jlhdiagnosa == 4) {
            $diagnosa = [
                ["kode" => "$s1;$d1"],
                ["kode" => "$s2;$d2"],
                ["kode" => "$s3;$d3"],
                ["kode" => "$s4;$d4"]
            ];
        } else if ($jlhdiagnosa == 5) {
            $diagnosa = [
                ["kode" => "$s1;$d1"],
                ["kode" => "$s2;$d2"],
                ["kode" => "$s3;$d3"],
                ["kode" => "$s4;$d4"],
                ["kode" => "$s5;$d5"]
            ];
        }else{
            $diagnosa = [
                ["kode" => ";"]
            ];
        }

        if( $jlhproce == 1){
            $procedure = [
                ["kode" =>  "$p1"]
            ];
        }
        else if($jlhproce == 2){
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"]
            ];
        }
        else if($jlhproce == 3){
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"],
                ["kode" =>  "$p3"]
            ];
        }
        else if($jlhproce == 4){
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"],
                ["kode" =>  "$p3"],
                ["kode" =>  "$p4"]
            ];
        }
        else if($jlhproce == 5){
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"],
                ["kode" =>  "$p3"],
                ["kode" =>  "$p4"],
                ["kode" =>  "$p5"]
            ];
        }else{
            $procedure = [
                ["kode" =>  ""]
            ];
        }      
        $data = [
            "noRujukan" => "$nomorrujukan",
            "diagnosa" =>
            $diagnosa,
            "procedure" =>
            $procedure,
            "user" => "Coba Ws"
        ];
        $v = new VclaimModel();
        $rujukan = $v->insertrujukankhusus($data);
        $data1 = [
            'kode' => $rujukan->metaData->code,
            'message' => $rujukan->metaData->message
        ];
        echo json_encode($data1);
    }
    public function vclaimcarisuratkontrolpeserta(Request $request)
    {        
        $v = new VclaimModel();
        $detail = $v->carisuratkontrol($request->nomorpencarian);
        return view('vclaim.detailsurkon', [
            'detail' => $detail
        ]);
    }
    public function vclaimcarisuratkontrolpeserta_bycard(Request $request)
    {        
        $v = new VclaimModel();
        $detail = $v->ListRencanaKontrol_bycard($request->bulan,$request->tahun,$request->nomorpencarian,$request->filter);
        return view('vclaim.tabelsurkon', [
            'list' => $detail
        ]);
    }
    public function vclaimcarisuratkontrol_byrs(Request $request)
    {        
        $v = new VclaimModel();
        $detail = $v->ListRencanaKontrol_rs($request->tglawalcari_surkon,$request->tglakhircari_surkon,$request->filter);
        return view('vclaim.tabelsurkon_rs', [
            'list' => $detail
        ]);
    }
}
