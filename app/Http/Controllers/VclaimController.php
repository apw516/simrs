<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VclaimModel;


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
        $suratkontrol_rs = $v->ListRencanaKontrol_rs($d2,$tgl,2);
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
        $dokter = $v->referensi_dpjp($request->filter, $request->tanggal,$request->poli);
        if($dokter->metaData->code == 200){
            foreach($dokter->response->list as $d){
                $kodedpjp = $d->kode;
                 $tb = DB::table('mt_kuota_dokter_poli')->where('kode_dpjp', $kodedpjp)->get();
                if(count($tb) == 0){
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
        $suratkontrol_rs = $v->ListRencanaKontrol_rs($request->tanggalawal,$request->tanggalakhir,$request->filter);
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
        // dd($request->nomortelp);
        $v = new VclaimModel();
        $data =
            [
                "request" => [
                    "t_sep" => [
                        "noSep" => "$request->sep",
                        "klsRawat" => [
                            "klsRawatHak" => "$request->hakkelas",
                            "klsRawatNaik" => "$request->kelasnaik",
                            "pembiayaan" => "$request->pembiayaan",
                            "penanggungJawab" => "$request->penanggung"
                        ],
                        "noMR" => "$request->rm",
                        "catatan" => "$request->sep",
                        "diagAwal" => "$request->kodediagnosa",
                        "poli" => [
                            "tujuan" => "$request->kodepoli",
                            "eksekutif" => "$request->ekspoli"
                        ],
                        "cob" => [
                            "cob" => "$request->cob"
                        ],
                        "katarak" => [
                            "katarak" => "$request->katarak"
                        ],
                        "jaminan" => [
                            "lakaLantas" => "$request->statuslaka",
                            "penjamin" => [
                                "tglKejadian" => "$request->tgllaka",
                                "keterangan" => "$request->ketlaka",
                                "suplesi" => [
                                    "suplesi" => "",
                                    "noSepSuplesi" => "$request->sepsuplsei",
                                    "lokasiLaka" => [
                                        "kdPropinsi" => "$request->prov",
                                        "kdKabupaten" => "$request->kab",
                                        "kdKecamatan" => "$request->kec"
                                    ]
                                ]
                            ]
                        ],
                        "dpjpLayan" => "$request->kodedokter",
                        "noTelp" => "$request->nomortelp",
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
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
            if($request->jenispengajuan > 1){
                $ajuan = $v->aprrovalpengajuan($data);
                echo json_encode($ajuan);
            }else{
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
    public function datarujukan_bycard(Request $request){
        $nomorkartu = $request->noka;
        $v = new VclaimModel();
        $r1 = $v->Listrujukan_bycard_faskes1($nomorkartu);
        $r2 = $v->Listrujukan_bycard_faskes2($nomorkartu);
        return view('rujukan.tabelrujukan_peserta', [
            'f1' => $r1,
            'f2' => $r2
        ]);
    }
}
