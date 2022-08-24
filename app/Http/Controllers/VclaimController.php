<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VclaimModel;
use App\Models\Pasien;
use App\Models\ts_kunjungan;
use App\Models\ts_sep;
use Codedge\Fpdf\Fpdf\Fpdf;

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
                            "cob" => "$request->cob"
                        ],
                        "katarak" => [
                            "katarak" => "$request->katarak"
                        ],
                        "jaminan" => [
                            "lakaLantas" => "$request->lakaLantas",
                            "penjamin" => [
                                "tglKejadian" => "$request->tglkejadian",
                                "keterangan" => "$request->keterangan",
                                "suplesi" => [
                                    "suplesi" => "$request->suplesi",
                                    "noSepSuplesi" => "$request->nosuplesi",
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
        $data = $v->updatesep($data);
        echo json_encode($data);
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
        $rujukan = $v->carirujukan_khusus($bulan, $tahun);
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
    public function vclaimambil_formjenisobat(Request $request)
    {
        $jlh = $request->jlhjns_obat;
        if ($jlh == 1) {
            return view('prb.obt1');
        } else if ($jlh == 2) {
            return view('prb.obt2');
        } else if ($jlh == 3) {
            return view('prb.obt3');
        } else if ($jlh == 4) {
            return view('prb.obt4');
        } else if ($jlh == 5) {
            return view('prb.obt5');
        } else if ($jlh == 6) {
            return view('prb.obt6');
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
        } else {
            $diagnosa = [
                ["kode" => ";"]
            ];
        }

        if ($jlhproce == 1) {
            $procedure = [
                ["kode" =>  "$p1"]
            ];
        } else if ($jlhproce == 2) {
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"]
            ];
        } else if ($jlhproce == 3) {
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"],
                ["kode" =>  "$p3"]
            ];
        } else if ($jlhproce == 4) {
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"],
                ["kode" =>  "$p3"],
                ["kode" =>  "$p4"]
            ];
        } else if ($jlhproce == 5) {
            $procedure = [
                ["kode" =>  "$p1"],
                ["kode" =>  "$p2"],
                ["kode" =>  "$p3"],
                ["kode" =>  "$p4"],
                ["kode" =>  "$p5"]
            ];
        } else {
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
            "user" => auth()->user()->id_simrs
        ];
        $v = new VclaimModel();
        $rujukan = $v->insertrujukankhusus($data);
        $data1 = [
            'kode' => $rujukan->metaData->code,
            'message' => $rujukan->metaData->message
        ];
        echo json_encode($data1);
    }
    public function vclaimsimpan_prb(Request $request)
    {
        $sep = $request->sep_prb;
        $noka_prb = $request->noka_prb;
        $email_prb = $request->email_prb;
        $kodeprogramprb = $request->kodeprogramprb;
        $kodedokter_prb = $request->kodedokter_prb;
        $alamatpx_prb = $request->alamatpx_prb;
        $keterangan_prb = $request->keterangan_prb;
        $saran_prb = $request->saran_prb;
        $jlhobat = $request->jlhobat;
        $kodeobat1 = $request->kodeobat1;
        $signa1_1 = $request->signa1_1;
        $signa2_1 = $request->signa2_1;
        $jmlhobt1 = $request->jmlhobt1;
        $kodeobat2 = $request->kodeobat2;
        $signa1_2 = $request->signa1_2;
        $signa2_2 = $request->signa2_2;
        $jmlhobt2 = $request->jmlhobt2;
        $kodeobat3 = $request->kodeobat3;
        $signa1_3 = $request->signa1_3;
        $signa2_3 = $request->signa2_3;
        $jmlhobt3 = $request->jmlhobt3;
        $kodeobat4 = $request->kodeobat4;
        $signa1_4 = $request->signa1_4;
        $signa2_4 = $request->signa2_4;
        $jmlhobt4 = $request->jmlhobt4;
        $kodeobat5 = $request->kodeobat5;
        $signa1_5 = $request->signa1_5;
        $signa2_5 = $request->signa2_5;
        $jmlhobt5 = $request->jmlhobt5;
        $kodeobat6 = $request->kodeobat6;
        $signa1_6 = $request->signa1_6;
        $signa2_6 = $request->signa2_6;
        $jmlhobt6 = $request->jmlhobt6;

        if ($jlhobat == 1) {
            $obat = [
                [
                    "kdObat" => "$kodeobat1",
                    "signa1" => "$signa1_1",
                    "signa2" => "$signa2_1",
                    "jmlObat" => "$jmlhobt1"
                ]
            ];
        } else if ($jlhobat == 2) {
            $obat = [
                [
                    "kdObat" => "$kodeobat1",
                    "signa1" => "$signa1_1",
                    "signa2" => "$signa2_1",
                    "jmlObat" => "$jmlhobt1"
                ],
                [
                    "kdObat" => "$kodeobat2",
                    "signa1" => "$signa1_2",
                    "signa2" => "$signa2_2",
                    "jmlObat" => "$jmlhobt2"
                ],
            ];
        } else if ($jlhobat == 3) {
            $obat = [
                [
                    "kdObat" => "$kodeobat1",
                    "signa1" => "$signa1_1",
                    "signa2" => "$signa2_1",
                    "jmlObat" => "$jmlhobt1"
                ],
                [
                    "kdObat" => "$kodeobat2",
                    "signa1" => "$signa1_2",
                    "signa2" => "$signa2_2",
                    "jmlObat" => "$jmlhobt2"
                ],
                [
                    "kdObat" => "$kodeobat3",
                    "signa1" => "$signa1_3",
                    "signa2" => "$signa2_3",
                    "jmlObat" => "$jmlhobt3"
                ],
            ];
        } else if ($jlhobat == 4) {
            $obat = [
                [
                    "kdObat" => "$kodeobat1",
                    "signa1" => "$signa1_1",
                    "signa2" => "$signa2_1",
                    "jmlObat" => "$jmlhobt1"
                ],
                [
                    "kdObat" => "$kodeobat2",
                    "signa1" => "$signa1_2",
                    "signa2" => "$signa2_2",
                    "jmlObat" => "$jmlhobt2"
                ],
                [
                    "kdObat" => "$kodeobat3",
                    "signa1" => "$signa1_3",
                    "signa2" => "$signa2_3",
                    "jmlObat" => "$jmlhobt3"
                ],
                [
                    "kdObat" => "$kodeobat4",
                    "signa1" => "$signa1_4",
                    "signa2" => "$signa2_4",
                    "jmlObat" => "$jmlhobt4"
                ]
            ];
        } else if ($jlhobat == 5) {
            $obat = [
                [
                    "kdObat" => "$kodeobat1",
                    "signa1" => "$signa1_1",
                    "signa2" => "$signa2_1",
                    "jmlObat" => "$jmlhobt1"
                ],
                [
                    "kdObat" => "$kodeobat2",
                    "signa1" => "$signa1_2",
                    "signa2" => "$signa2_2",
                    "jmlObat" => "$jmlhobt2"
                ],
                [
                    "kdObat" => "$kodeobat3",
                    "signa1" => "$signa1_3",
                    "signa2" => "$signa2_3",
                    "jmlObat" => "$jmlhobt3"
                ],
                [
                    "kdObat" => "$kodeobat4",
                    "signa1" => "$signa1_4",
                    "signa2" => "$signa2_4",
                    "jmlObat" => "$jmlhobt4"
                ],
                [
                    "kdObat" => "$kodeobat5",
                    "signa1" => "$signa1_5",
                    "signa2" => "$signa2_5",
                    "jmlObat" => "$jmlhobt5"
                ]
            ];
        } else if ($jlhobat == 6) {
            $obat = [
                [
                    "kdObat" => "$kodeobat1",
                    "signa1" => "$signa1_1",
                    "signa2" => "$signa2_1",
                    "jmlObat" => "$jmlhobt1"
                ],
                [
                    "kdObat" => "$kodeobat2",
                    "signa1" => "$signa1_2",
                    "signa2" => "$signa2_2",
                    "jmlObat" => "$jmlhobt2"
                ],
                [
                    "kdObat" => "$kodeobat3",
                    "signa1" => "$signa1_3",
                    "signa2" => "$signa2_3",
                    "jmlObat" => "$jmlhobt3"
                ],
                [
                    "kdObat" => "$kodeobat4",
                    "signa1" => "$signa1_4",
                    "signa2" => "$signa2_4",
                    "jmlObat" => "$jmlhobt4"
                ],
                [
                    "kdObat" => "$kodeobat5",
                    "signa1" => "$signa1_5",
                    "signa2" => "$signa2_5",
                    "jmlObat" => "$jmlhobt5"
                ],
                [
                    "kdObat" => "$kodeobat6",
                    "signa1" => "$signa1_6",
                    "signa2" => "$signa2_6",
                    "jmlObat" => "$jmlhobt6"
                ]
            ];
        }
        $data = [
            "request" => [
                "t_prb" => [
                    "noSep" => "$sep",
                    "noKartu" => "$noka_prb",
                    "alamat" => "$alamatpx_prb",
                    "email" => "$email_prb",
                    "programPRB" => "$kodeprogramprb",
                    "kodeDPJP" => "$kodedokter_prb",
                    "keterangan" => "$keterangan_prb",
                    "saran" => "$saran_prb",
                    "user" => auth()->user()->id_simrs,
                    "obat" => $obat
                ]
            ]
        ];    
        $v = new VclaimModel();
        $prb = $v->InsertPRB($data);
        $data1 = [
            'kode' => $prb->metaData->code,
            'message' => $prb->metaData->message
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
        $detail = $v->ListRencanaKontrol_bycard($request->bulan, $request->tahun, $request->nomorpencarian, $request->filter);
        return view('vclaim.tabelsurkon', [
            'list' => $detail
        ]);
    }
    public function vclaimcarisuratkontrol_byrs(Request $request)
    {
        $v = new VclaimModel();
        $detail = $v->ListRencanaKontrol_rs($request->tglawalcari_surkon, $request->tglakhircari_surkon, $request->filter);
        return view('vclaim.tabelsurkon_rs', [
            'list' => $detail
        ]);
    }
    public function vclaimcarisrb(Request $request)
    {
        $v = new VclaimModel();
        $detail = $v->cariprb($request->srb, $request->sep);
        return view('vclaim.detailsrb', [
            'list' => $detail
        ]);
    }
    public function vclaimcarisrb_date(Request $request)
    {
        $v = new VclaimModel();
        $detail = $v->cariprb_date($request->tglawal, $request->tglakhir);
        return view('vclaim.tabelsrb', [
            'list' => $detail
        ]);
    }
    public function vclaimcaridatakunjungan(Request $request)
    {
        $v = new VclaimModel();
        $datakunjungan = $v->get_data_kunjungan($request->tanggalsep, $request->jenislayan);
        if($request->jenislayan == 1){
            $jenis = 'Rawat Inap';
        }else {
            $jenis = 'Rawat Jalan';
        }
        return view('vclaim.tabeldatakunjungan', [
            'datakunjungan' => $datakunjungan,
            'jenis' => $jenis
        ]);
    }
    public function vclaimcaridataklaim(Request $request)
    {
        $v = new VclaimModel();
        $dataklaim = $v->get_data_klaim($request->tanggalpulangsep, $request->jenislayan,$request->status);
        return view('vclaim.tabeldataklaim', [
            'data' => $dataklaim
        ]);
    }
    public function vclaimcaririwayatpeserta(Request $request)
    {
        $v = new VclaimModel();
        $riwayat = $v->get_data_kunjungan_peserta($request->nomorkartu_peserta, $request->tanggalawal,$request->tanggalakhir);
        return view('vclaim.tabelriwayatpeserta', [
            'data' => $riwayat
        ]);
    }
    public function vclaimcaridataklaimjr(Request $request)
    {
        $v = new VclaimModel();
        $data = $v->get_data_klaim_jr($request->jenis,$request->tanggalawal, $request->tanggalakhir);
        return view('vclaim.tabelklaimjr', [
            'data' => $data
        ]);
    }
    public function caririwayatkunjungan(Request $request)
    {
        return view('vclaim.riwayatkunjunganpasien', [
            'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX('$request->nomorrm')"),
        ]);
    }
    public function caririwayatkunjungan2(Request $request)
    {
        return view('vclaim.riwayatkunjunganpasien2', [
            'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX_ALL('$request->nomorrm')"),
        ]);
    }
    public function formbuatsep_manual(Request $request)
    {
        $rm = $request->rm;
        $v = new VclaimModel();
        $pasien = Pasien::where('no_rm', $rm)->get();
        $noka = $pasien[0]->no_Bpjs;
        $info = $v->get_peserta_noka($noka, date('Y-m-d'));
        $kode = $request->kode;
        return view('vclaim.formsepmanual', [
            'data_peserta' => $info,
            'kode' => $kode,
            'rm' => $rm,
            'alasan_masuk' => DB::select('select * from mt_alasan_masuk'),
            'provinsi' => $v->referensi_propinsi()
        ]);
    }
    public function buatsep_manual(Request $request)
    {
                $kodekunjungan = $request->kodekunjungan;
                $a = $request->jenispelayanan_ranap;
                $hakkelasbpjs = $request->hakkelasbpjs;
                $keterangan_naik = $request->naikkelas;
                $pembiayaan = $request->pembiayaan;
                $penanggungjwb = $request->penanggugjawab;
                $kelasrawat = $request->niakkelasranap;
                $tgl_masuk = $request->tglmasukranap;
                $nomorspri = $request->nomorspri;
                $tglspri = $request->tglspri;
                $kode_dpjp = $request->kodedpjp;
                $kodediagnosa_ranap = $request->kodediagnosaranap;
                $catatan = $request->catatan;
                $keterangankll = $request->keterangan_kll;
                $keterangansuplesi = $request->keterangansuplesi;
                $suplesi = $request->sepsuplesi;
                $tgllaka = $request->tglkejadianlaka;
                $laporanpolisi = $request->nomorlp;
                $provlaka = $request->provinsikejadian;
                $kablaka = $request->kabupatenkejadian;
                $keclaka = $request->kecamatankejadian;
                $ketlaka = $request->keteranganlaka;
                $nomorrm = $request->nomorrm;
                $nomorkartu = $request->nomorkartu;
                $nomortelp = $request->nomortelp;
                $alasanmasuk = $request->alasanmasuk;
                $get_sep = [
                    "request" => [
                        "t_sep" => [
                            "noKartu" => "$nomorkartu",
                            "tglSep" => "$tgl_masuk",
                            "ppkPelayanan" => "1018R001",
                            "jnsPelayanan" => "1",
                            "klsRawat" => [
                                "klsRawatHak" => "$hakkelasbpjs",
                                "klsRawatNaik" => "$kelasrawat",
                                "pembiayaan" => "$pembiayaan",
                                "penanggungJawab" => "$penanggungjwb"
                            ],
                            "noMR" => "$nomorrm",
                            "rujukan" => [
                                "asalRujukan" => "2",
                                "tglRujukan" => "$tglspri",
                                "noRujukan" => "$nomorspri",
                                "ppkRujukan" => "1018R001"
                            ],
                            "catatan" => "$catatan",
                            "diagAwal" => "$kodediagnosa_ranap",
                            "poli" => [
                                "tujuan" => "",
                                "eksekutif" => ""
                            ],
                            "cob" => [
                                "cob" => "0"
                            ],
                            "katarak" => [
                                "katarak" => "0"
                            ],
                            "jaminan" => [
                                "lakaLantas" => "$keterangankll",
                                "noLP" => "$laporanpolisi",
                                "penjamin" => [
                                    "tglKejadian" => "$tgllaka",
                                    "keterangan" => "$ketlaka",
                                    "suplesi" => [
                                        "suplesi" => "$keterangansuplesi",
                                        "noSepSuplesi" => "$suplesi",
                                        "lokasiLaka" => [
                                            "kdPropinsi" => "$provlaka",
                                            "kdKabupaten" => "$kablaka",
                                            "kdKecamatan" => "$keclaka"
                                        ]
                                    ]
                                ]
                            ],
                            "tujuanKunj" => "0",
                            "flagProcedure" => "",
                            "kdPenunjang" => "",
                            "assesmentPel" => "",
                            "skdp" => [
                                "noSurat" => "$nomorspri",
                                "kodeDPJP" => "$kode_dpjp"
                            ],
                            "dpjpLayan" => "",
                            "noTelp" => "$nomortelp",
                            "user" => "waled | " . auth()->user()->id_simrs
                        ]
                    ]
                ];
                $v = new VclaimModel();
                $datasep = $v->insertsep2($get_sep);
                if ($datasep == 'RTO') {                  
                    $data = [
                        'kode' => 500,
                        'message' => 'The Network connection lost, please try again ...'
                    ];
                    echo json_encode($data);
                } else if ($datasep->metaData->code == 200) {
                    ts_kunjungan::whereRaw('kode_kunjungan = ? and no_rm = ?', array($kodekunjungan, $nomorrm ))->update(['no_sep' => $datasep->response->sep->noSep
                    ]);   
                    //insert ts_sep
                    $sep = $datasep->response->sep;
                    if ($keterangankll == '0') {
                        $CATKLL = "";
                    } else if ($keterangankll == '1') {
                        $CATKLL = "KLL dan bukan kecelakaan Kerja [BKK]";
                    } else if ($keterangankll == '2') {
                        $CATKLL = "KLL dan kecelakaan Kerja [KK]";
                    } else if ($keterangankll == '3') {
                        $CATKLL = "Kecelakaan Kerja [KK]";
                    }
                    $jk = $sep->peserta->kelamin;
                    if ($jk == 'Laki-Laki') {
                        $jk = 'L';
                    } else {
                        $jk = 'P';
                    }
                    $data_ts_sep = [
                        'no_SEP' => $sep->noSep,
                        'tgl_SEP' => $sep->tglSep,
                        'no_kartu' => $sep->peserta->noKartu,
                        'nama_peserta' => $sep->peserta->nama,
                        'tgl_lahir' => $sep->peserta->tglLahir,
                        'jenis_kelamin' => $jk,
                        'poli_tujuan' => "",
                        'asal_faskes' => "1018R001",
                        'nama_asal_faskes' => "Rsud Waled",
                        'diagnosa_awal' => $sep->diagnosa,
                        'peserta' => $sep->peserta->jnsPeserta,
                        'cob' => "",
                        'jenis_rawat' => "Rawat Inap",
                        'kls_rawat' => $sep->peserta->hakKelas,
                        'no_rm' => $nomorrm,
                        'catatan' => $sep->catatan . "  " . $CATKLL,
                        'act' => 1,
                        'alasan_masuk' => "$alasanmasuk",
                        'no_tlp' => "$nomortelp",
                        'kode_kunjungan' => "$kodekunjungan",
                        'tgl_rujukan' => $tglspri,
                        'no_skdp' => "",
                        'dpjp' => '',
                        'no_rujukan' => $nomorspri,
                        'pic1' => auth()->user()->id_simrs,
                        'tingkat_faskes' => $request->asalrujukan,
                    ];
                    $ts_sep = ts_sep::create($data_ts_sep);                    
                    $pasien = Pasien::where('no_rm', '=', "$nomorrm")->get();
                    $data = [
                        'kode' => 200,
                        'jenis' => 'BPJS',
                        'message' => 'sukses',
                        'kode_kunjungan' => $kodekunjungan,
                        'nama' => $pasien[0]['nama_px']
                    ];
                    echo json_encode($data);
                } else if ($datasep->metaData->code != 200) {
                    $data = [
                        'kode' => 201,
                        'message' => $datasep->metaData->message
                    ];
                    echo json_encode($data);
                }
    }
     public function Cetaksurkon($nomorsurat)
    {
        //ambil data sep
        // $sep = $request->sep;
        // $sep = ts_sep::where('no_SEP', $sep)->get();
        // $cek = count($sep);
        // if($cek == 0){
        $v = new VclaimModel();
        $s = $v->carisuratkontrol($nomorsurat);
        // $peserta = $v->get_peserta_noka($sep->response->peserta->noKartu, date('Y-m-d'));
        // $cetakan = $sep['0']['cetakan'] + 1;
        // ts_sep::where('kode_kunjungan', $sep)->update(['no_SEP' => $cetakan]);
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Cetak Surat Kontrol');
        $pdf->SetMargins('15', '20', '10');
        $pdf->SetFont('Arial', '', 15);
        $pdf->Image('public/img/logobpjs.png', 1, -5, 60, 40);
        $pdf->Image('public/img/logo_rs.png', 158, 4, 30, 25);
        $pdf->SetXY(70, 8);
        $pdf->Cell(10, 7, 'SURAT RENCANA KONTROL', 0, 1);
        $pdf->SetXY(70, 14);
        $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->SetXY(120, 36);
        $pdf->Cell(10, 7, 'NO.'.' '.$s->response->noSuratKontrol , 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 30);
        $pdf->Cell(10, 7, 'Kepada Yth', 0, 1);
        $pdf->SetXY(40, 30);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(45, 30);
        $pdf->Cell(10, 7, $s->response->namaDokter.','.$s->response->namaPoliTujuan, 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 38);
        $pdf->Cell(10, 7, 'Mohon Pemeriksaan dan Penanganan Lebih Lanjut :', 0, 1);
        $pdf->SetXY(40, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 35);
        $pdf->Cell(10, 7, " ", 0, 1);

        $pdf->SetXY(10, 45);
        $pdf->Cell(10, 7, 'No.Kartu', 0, 1);
        $pdf->SetXY(40, 45);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 46);
        $pdf->MultiCell(60, 5, $s->response->sep->peserta->noKartu);
        // $pdf->Cell(10,7,$sep['0']['nama_peserta'],0,1);
        $y = $pdf->GetY();
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Nama Peserta', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, $y);
        $pdf->Cell(10, 7, $s->response->sep->peserta->nama, 0, 1);

        $pdf->SetXY(10, 60);
        $pdf->Cell(10, 7, 'Tgl Lahir', 0, 1);
        $pdf->SetXY(40, 60);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 60);
        $pdf->Cell(10, 7, $s->response->sep->peserta->tglLahir, 0, 1);

        $pdf->SetXY(10, 65);
        $pdf->Cell(10, 7, 'Diagnosa', 0, 1);
        $pdf->SetXY(40, 65);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 65);
        $pdf->Cell(10, 7,$s->response->sep->diagnosa, 0, 1);

        $pdf->SetXY(10, 70);
        $pdf->Cell(10, 7, 'Rencana Kontrol', 0, 1);
        $pdf->SetXY(40, 70);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 70);
        $pdf->Cell(10, 7, $s->response->tglRencanaKontrol, 0, 1);
        $pdf->SetXY(10, 75);
        $pdf->Cell(10, 7, 'Demikian atas bantuannya,diucapkan banyak terima kasih.', 0, 1);
        $pdf->SetXY(40, 75);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 75);
        $pdf->Cell(10, 7, "", 0, 1);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(150, 85);
        $pdf->Cell(10, 7, 'Mengetahui DPJP', 0, 1);
        $pdf->SetXY(138, 100);
        $pdf->Cell(10, 7, $s->response->namaDokter, 0, 1);

     
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetXY(10, 100);
        $pdf->Cell(10, 7, 'tgl entry -' . $s->response->tglTerbit . ' ,.Tanggal cetak ' . date('y-m-d h:i:s'), 0, 1);
        $pdf->SetFont('Arial', '', 8);
    
        $pdf->SetFont('Arial', '', 12);
        $pdf->Line(150, 100, 190, 100);
        $pdf->Output();

        exit;     
    }
}

