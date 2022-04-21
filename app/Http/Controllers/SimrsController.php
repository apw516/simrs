<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\VclaimModel;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\ts_kunjungan;
use App\Models\mt_unit;
use App\Models\ts_layanan_detail;
use App\Models\ts_layanan_header;
use App\Models\ts_sep;
use App\Models\Agama;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Hubkeluarga;
use App\Models\Negara;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\mt_keluarga;
use App\Models\mt_domisili;;

use App\Models\tracer;;

class SimrsController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function pendaftaran()
    {
        $title = 'SIMRS - PENDAFTARAN';
        $sidebar = '2';
        $sidebar_m = '2';
   
        return view('pendaftaran.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'data_pasien' => Pasien::limit(200)->orderBy('tgl_entry','desc')->get(),
            'sidebar_m' => $sidebar_m,
            'agama' => Agama::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan' => Pendidikan::all(),
            'hubkel' => Hubkeluarga::all(),
            'negara' => Negara::all(),
            'provinsi' => Provinsi::all(),
        ]);
    }
    public function Formbpjs(Request $request)
    {
        $v = new VclaimModel();
        $noka = $v->get_peserta_noka($request->nomorbpjs, date('Y-m-d'));
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ? and status_kunjungan = 1', [$request->nomorrm]);
        $total = count($cek_rm);
        return view('pendaftaran.form_pasien_bpjs', [
            'data_peserta' => $noka,
            'riwayat_kunjungan' => DB::select("CALL SP_RIWAYAT_KUNJUNGAN_PX('$request->nomorrm')"),
            'alasan_masuk' => DB::select('select * from mt_alasan_masuk'),
            'nomorrm' => $request->nomorrm,
            'mt_pasien' => Pasien::where('no_rm', $request->nomorrm)->get(),
            'mt_unit' => mt_unit::where('kelas_unit', 2)->get(),
            'provinsi' => $v->referensi_propinsi(),
            'cek_kunjungan' => $total
        ]);
    }
    public function Caripasien(Request $request)
    {
        return view('pendaftaran.pencarianpasien', [
            'data_pasien' =>  DB::select("CALL WSP_PANGGIL_DATAPASIEN('$request->nomorrm','$request->nama','$request->alamat','$request->nomorktp','$request->nomorbpjs')")
        ]);
    }
    public function Caripoli(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_poli($request['term']);
        if (count($result->response->poli) > 0) {
            foreach ($result->response->poli as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function Caridokter(Request $request)
    {
        $r = $request['term'];
        $result = Dokter::where('nama_dokter', 'LIKE', "%{$r}%")->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row['nama_dokter'],
                    'kode' => $row['kode_dpjp'],
                );
            echo json_encode($arr_result);
        }
    }
    public function Caridiagnosa(Request $request)
    {
        $v = new VclaimModel();
        $result = $v->referensi_diagnosa($request['term']);
        if (count($result->response->diagnosa) > 0) {
            foreach ($result->response->diagnosa as $row)
                $arr_result[] = array(
                    'label' => $row->nama,
                    'kode' => $row->kode,
                );
            echo json_encode($arr_result);
        }
    }
    public function Cariruangranap(Request $request)
    {
        $cekruangan = $request->hakkelaspenuh;
        $naikkelas = $request->naikkelas;
        $hakkelas = $request->hakkelas;
        $kode_unit = $request->kode_unit;
        if ($cekruangan == 1) {
        } else if ($naikkelas == 1) {
        } else {
            $ruangan = DB::select('SELECT DISTINCT nama_kamar FROM mt_ruangan WHERE id_kelas = ?  AND kode_unit = ? AND status = ?', [$hakkelas, $kode_unit, 1]);
        }
        echo "<option value=> -- Silahkan Pilih Ruangan -- </option>";
        foreach ($ruangan as $j) {
            echo "<option value=$j->nama_kamar>$j->nama_kamar</option>";
        }
    }
    public function Carikabupaten(Request $request)
    {
        $v = new VclaimModel();
        $prov = $request->prov;
        $kabupaten = $v->referensi_kabupaten($prov);
        echo "<option value=> -- Silahkan Pilih Kabupaten -- </option>";
        foreach ($kabupaten->response->list as $j) {
            echo "<option value=$j->kode>$j->nama</option>";
        }
    }
    public function Carikecamatan(Request $request)
    {
        $v = new VclaimModel();
        $kab = $request->kab;
        $kec = $v->referensi_kecamatan($kab);
        echo "<option value=> -- Silahkan Pilih Kecamatan -- </option>";
        foreach ($kec->response->list as $j) {
            echo "<option value=$j->kode>$j->nama</option>";
        }
    }
    public function carikab_local(Request $request)
    {
        $v = new VclaimModel();
        $prov = $request->provinsi;
        $kec = Kabupaten::where('province_id', $prov)->get();
        echo "<option value=> -- Silahkan Pilih Kabupaten -- </option>";
        foreach ($kec as $j) {
            echo "<option value=$j->id>$j->name</option>";
        }
    }
    public function carikec_local(Request $request)
    {
        $v = new VclaimModel();
        $kabupaten = $request->kabupaten;
        $kec = Kecamatan::where('regency_id', $kabupaten)->get();
        echo "<option value=> -- Silahkan Pilih Kecamatan -- </option>";
        foreach ($kec as $j) {
            echo "<option value=$j->id>$j->name</option>";
        }
    }
    public function caridesa_local(Request $request)
    {
        $v = new VclaimModel();
        $kecamatan = $request->kecamatan;
        $des = Desa::where('district_id', $kecamatan)->get();
        echo "<option value=> -- Silahkan Pilih Desa -- </option>";
        foreach ($des as $j) {
            echo "<option value=$j->id>$j->name</option>";
        }
    }
    public function Caribedranap(Request $request)
    {
        $ruanganranap = $request->kamarranap;
        $ruangan = DB::select('SELECT id_ruangan,no_bed FROM mt_ruangan WHERE nama_kamar = ? AND status_incharge = ?', [$ruanganranap, 0]);
        echo "<option value=> -- Silahkan Pilih Ruangan -- </option>";
        foreach ($ruangan as $j) {
            echo "<option id-ruangan=$j->id_ruangan value=$j->no_bed>$j->no_bed</option>";
        }
    }
    public function Caripolikontrol(Request $request)
    {
        $v = new VclaimModel();
        $poli = $v->Datapoli($request->jenis, $request->nomor, $request->tanggal);
        return view('pendaftaran.tabelpolikontrol', [
            'poli' => $poli
        ]);
    }
    public function Caridokterkontrol(Request $request)
    {
        $v = new VclaimModel();
        $dokter = $v->Datadokter($request->jenis, $request->kodepoli, $request->tanggal);
        return view('pendaftaran.tabeldokterkontrol', [
            'poli' => $dokter
        ]);
    }
    public function Buatsuratkontrol(Request $request)
    {
        if ($request->jenissurat == 1) {
            $datasurat = [
                "request" =>
                [
                    "noKartu" => "$request->nomorkartu",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs

                ]
            ];
            $v = new VclaimModel();
            $poli = $v->InsertSPRI($datasurat);
        } else {
            $datasurat = [
                "request" =>
                [
                    "noSEP" => "$request->nomorkartu",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ];
            $v = new VclaimModel();
            $poli = $v->InserRencanakontrol($datasurat);
        }
        echo json_encode($poli);
    }
    public function updatesuratkontrol(Request $request)
    {
        if ($request->jenissurat == 1) {
            $datasurat = [
                "request" =>
                [
                    "noSPRI" => "$request->nomorsurat",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs

                ]
            ];
            $v = new VclaimModel();
            $poli = $v->UpdateSPRI($datasurat);
        } else {
            $datasurat = [
                "request" =>
                [
                    "noSuratKontrol" => "$request->nomorsurat",
                    "noSEP" => "$request->nomorkartu",
                    "kodeDokter" => "$request->kodedokterkontrol",
                    "poliKontrol" => "$request->kodepolikontrol",
                    "tglRencanaKontrol" => "$request->tanggalkontrol",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ];
            $v = new VclaimModel();
            $poli = $v->updateRencanakontrol($datasurat);
        }
        echo json_encode($poli);
    }
    public function Carisuratkontrol(Request $request)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $nomorkartu = $request->nomorkartu;
        $filter = 1;
        $v = new VclaimModel();
        $suratkontrol = $v->ListRencanaKontrol_bycard($bulan, $tahun, $nomorkartu, $filter);
        return view('pendaftaran.tabelsuratkontrol_peserta', [
            'suratkontrol' => $suratkontrol
        ]);
    }
    public function Carirujukan(Request $request)
    {
        $nomorkartu = $request->nomorkartu;
        $v = new VclaimModel();
        $r1 = $v->Listrujukan_bycard_faskes1($nomorkartu);
        $r2 = $v->Listrujukan_bycard_faskes2($nomorkartu);
        return view('pendaftaran.tabelrujukan_peserta', [
            'f1' => $r1,
            'f2' => $r2
        ]);
    }
    public function Simpansep(Request $request)
    {
        // kamarranap
        // bedranap
        // $d = $this->createLayanandetail();
        // dd($d);
        //cek sudah daftar belum
        //cek_kronis sp_cari_riwayat_kronis_terakhir
        //cek pasien aktif
        if($request->jenispelayanan == 2){
            if($request->kodedokterlayan == ''){
                $data = [
                    'kode' => 500,
                    'message' => 'Dokter belum dipilih !'
                ];
                echo json_encode($data);
                die;
            }else if($request->kodepolitujuan ==''){
                $data = [
                    'kode' => 500,
                    'message' => 'Poli belum dipilih !'
                ];
                echo json_encode($data);
                die;
            }
        }
        $tgl_masuk = $request->tglsep;
        $tgl_masuk_time = $request->tglsep .' '.date('h:i:s');
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [$request->norm]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] + 1;
        }
        //end of get counter
        //mapping penjamin bpjs dan db simrs
        $mt_penjamin = DB::select('select * from mt_penjamin_bpjs where nama_penjamin_bpjs = ?', [$request->penjamin]);
        //end
        // dd($mt_penjamin);
        //jenis pelayanan
        if ($request->jenispelayanan == 1) {
            //jika pasien rawat inap
            //data yang akan disimpan ke ts kunjungan
            $paramedis = Dokter::where('kode_dpjp', '=', "$request->kodedpjp")->get();
            $unit = mt_unit::where('kode_unit', '=', "$request->namaunitranap")->get();
            $mt_ruangan = DB::select('select * from mt_ruangan where kode_unit = ?  and nama_kamar = ? and no_bed = ?', [$request->namaunitranap, $request->kamarranap, $request->bedranap]);
            $idruangan = $mt_ruangan[0]->id_ruangan;
            $crad = 1;
            if ($request->naikkelas == '') {
                $crad = 0;
            }
            $data_ts_kunjungan = [
                'counter' => $counter,
                'no_rm' => $request->norm,
                'kode_unit' => $request->namaunitranap,
                'kode_paramedis' => $paramedis[0]['kode_dokter'],
                'prefix_kunjungan' => $unit[0]['prefix_unit'],
                'tgl_masuk' => $tgl_masuk_time,
                'status_kunjungan' => '8',
                'kode_penjamin' => $mt_penjamin[0]->kode_penjamin_simrs,
                'id_alasan_masuk' => $request->alasanmasuk,
                'id_ruangan' => $idruangan,
                'kamar' => $request->kamarranap,
                'no_bed' => $request->bedranap,
                'kelas' => $request->hakkelas,
                'hak_kelas' => $request->hakkelas,
                'crad' => $crad,
                'pic' => auth()->user()->id_simrs,
                'no_sep' => '',
            ];
            $kodeunit = $request->namaunitranap;
            $kelas_unit = $unit['0']['kelas_unit'];
        } else {
            //jika pasien rawat jalan
            //data yang akan disimpan ke ts kunjungan
            $paramedis = Dokter::where('kode_dpjp', '=', "$request->kodedokterlayan")->get();
            $unit = mt_unit::where('KDPOLI', '=', "$request->kodepolitujuan")->get();
            $data_ts_kunjungan = array(
                'counter' => $counter,
                'no_rm' => $request->norm,
                'kode_unit' => $unit[0]['kode_unit'],
                'kode_paramedis' => $paramedis[0]['kode_dokter'],
                'prefix_kunjungan' => $unit[0]['prefix_unit'],
                'tgl_masuk' => $tgl_masuk_time,
                'status_kunjungan' => '8',
                'kode_penjamin' => $mt_penjamin[0]->kode_penjamin_simrs,
                'kelas' => 3,
                'hak_kelas' => 3,
                'pic' => auth()->user()->id_simrs,
                'no_sep' => '',
                'id_alasan_masuk' => $request->alasanmasuk
            );
            $kodeunit = $unit[0]['kode_unit'];
            $kelas_unit = $unit['0']['kelas_unit'];
            // $tgl_masuk = date('Y-m-d');
            if($kodeunit != '1002'){
                //jika pasien rawat jalan dan bukan igd maka dilakukan cek kronis
                $r = DB::select("CALL sp_cari_riwayat_kronis_terakhir('$request->norm','$kodeunit','$tgl_masuk')");
                if(count($r) > 0){
                    if($r[0]->status_daftar == 'Tidak boleh daftar'){
                        $data = [
                            'kode' => 500,
                            'message' => 'Pasien Kronis'
                        ];
                        echo json_encode($data);
                        die;
                    }
                }
            }
        }
        //insert ke ts_kunjungan
        $ts_kunjungan = ts_kunjungan::create($data_ts_kunjungan);
        //membuat kode layanan header menggunakan store procedure
        if ($kelas_unit == 1 || $kelas_unit == 2) {
            //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
            $r = DB::select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
            }
            $data_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $tgl_masuk_time,
                'kode_kunjungan' => $ts_kunjungan->id,
                'kode_unit' => $ts_kunjungan['kode_unit'],
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id_simrs,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN'
            ]; //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
            //menentukan tarif
            if ($request->jenispelayanan == 1) {
                //jika pasien rawat inap maka hanya memakai tarif admin ranap
                $tarif = $unit[0]->mt_tarif_detail3->TOTAL_TARIF_CURRENT;
                $id_detail = $this->createLayanandetail();
                $tgl_detail = date('Y-m-d h:i:s');
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_adm'],
                    'total_tarif' => $tarif,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif,
                    'grantotal_layanan' => $tarif,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_masuk_time,
                    'tagihan_penjamin' => $tarif,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
                $grand_total_tarif = $tarif;
            } else {
                //jika pasien rawat jalan
                $tarif1 = $unit[0]->mt_tarif_detail->TOTAL_TARIF_CURRENT;
                $tarif2 = $unit[0]->mt_tarif_detail2->TOTAL_TARIF_CURRENT;
                $tgl_detail = $tgl_masuk_time;
                $id_detail1 = $this->createLayanandetail();
                $save_detail1 = [
                    'id_layanan_detail' => $id_detail1,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_adm'],
                    'total_tarif' => $tarif1,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif1,
                    'grantotal_layanan' => $tarif1,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_detail,
                    'tagihan_penjamin' => $tarif1,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail1);
                $id_detail2 = $this->createLayanandetail();
                $save_detail2 = [
                    'id_layanan_detail' => $id_detail2,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $unit[0]['kode_tarif_karcis'],
                    'total_tarif' => $tarif2,
                    'jumlah_layanan' => '1',
                    'diskon_layanan' => '0',
                    'total_layanan' => $tarif2,
                    'grantotal_layanan' => $tarif2,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $tgl_detail,
                    'tagihan_penjamin' => $tarif2,
                    'tgl_layanan_detail_2' => $tgl_detail,
                    'row_id_header' => $ts_layanan_header->id
                ];
                ts_layanan_detail::create($save_detail2);
                $grand_total_tarif = $tarif1 + $tarif2;
            }
        }

        //create sep  bridging bpjs
        $keterangansuplesi = 1;
        $katarak = 1;
        $cob = 1;
        $polieksekutif = 1;
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->keterangansuplesi == '') {
            $keterangansuplesi = 0;
        }
        if ($request->katarak == '') {
            $katarak = 0;
        }
        if ($request->cob == '') {
            $cob = 0;
        }
        if ($request->polieksekutif == '') {
            $polieksekutif = 0;
        }
        $poli = $request->kodepolitujuan;
        if ($request->jenispelayanan == 1) {
            $poli = '';
        }
        $get_sep = [
            "request" => [
                "t_sep" => [
                    "noKartu" => "$request->nomorkartu",
                    "tglSep" => "$request->tglsep",
                    "ppkPelayanan" => "1018R001",
                    "jnsPelayanan" => "$request->jenispelayanan",
                    "klsRawat" => [
                        "klsRawatHak" => "$request->hakkelas",
                        "klsRawatNaik" => "$request->kelasrawatnaik",
                        "pembiayaan" => "$request->pembiayaan",
                        "penanggungJawab" => "$request->penanggugjawab"
                    ],
                    "noMR" => "$request->norm",
                    "rujukan" => [
                        "asalRujukan" => "$request->asalrujukan",
                        "tglRujukan" => "$request->tglrujukan",
                        "noRujukan" => "$request->nomorrujukan",
                        "ppkRujukan" => "$request->kodeppkrujukan"
                    ],
                    "catatan" => "$request->catatan",
                    "diagAwal" => "$request->kodediagnosa",
                    "poli" => [
                        "tujuan" => "$poli",
                        "eksekutif" => "$polieksekutif"
                    ],
                    "cob" => [
                        "cob" => "$cob"
                    ],
                    "katarak" => [
                        "katarak" => "$katarak"
                    ],
                    "jaminan" => [
                        "lakaLantas" => "$request->keterangan_kll",
                        "noLP" => "$request->nomorlp",
                        "penjamin" => [
                            "tglKejadian" => "$request->tglkejadianlaka",
                            "keterangan" => "$request->keteranganlaka",
                            "suplesi" => [
                                "suplesi" => "$keterangansuplesi",
                                "noSepSuplesi" => "$request->sepsuplesi",
                                "lokasiLaka" => [
                                    "kdPropinsi" => "$request->provinsikejadian",
                                    "kdKabupaten" => "$request->kabupatenkejadian",
                                    "kdKecamatan" => "$request->kecamatankejadian"
                                ]
                            ]
                        ]
                    ],
                    "tujuanKunj" => "$request->tujuankunjungan",
                    "flagProcedure" => "$request->flagprocedure",
                    "kdPenunjang" => "$request->penunjang",
                    "assesmentPel" => "$request->asessment",
                    "skdp" => [
                        "noSurat" => "$request->suratkontrol",
                        "kodeDPJP" => "$request->kodedpjp"
                    ],
                    "dpjpLayan" => "$request->kodedokterlayan",
                    "noTelp" => "$request->nomortelepon",
                    "user" => "waled | " . auth()->user()->id_simrs
                ]
            ]
        ];
        $v = new VclaimModel();
        $datasep = $v->insertsep2($get_sep);
        if ($datasep == 'RTO') {
            DB::table('ts_kunjungan')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
            if ($kelas_unit == 1 || $kelas_unit == 2){
                //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                DB::table('ts_layanan_header')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                DB::table('ts_layanan_detail')->where('row_id_header', $ts_layanan_header->id)->delete();
            }
            $data = [
                'kode' => 500,
                'message' => 'Connection lost'
            ];
            echo json_encode($data);
        } else if ($datasep->metaData->code == 200) {
            ts_kunjungan::whereRaw('kode_kunjungan = ? and no_rm = ? and kode_unit = ?', array($ts_kunjungan->id, $request->norm, $kodeunit))->update([
                'status_kunjungan' => 1, 'no_sep' => $datasep->response->sep->noSep
            ]);
            if ($kelas_unit == 1 || $kelas_unit == 2){
                //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                if ($request->jenispelayanan == 1) {
                    DB::table('mt_ruangan')->where('id_ruangan', $idruangan)->update(['status_incharge' => 1]);
                }
                //update ts_layanan_header
                ts_layanan_header::where('kode_kunjungan', $ts_kunjungan->id)
                    ->update(['status_layanan' => 2, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            //update mt_ruangan
            //insert ts_sep
            $sep = $datasep->response->sep;
            if ($request->keterangan_kll == '0') {
                $CATKLL = "";
            } else if ($request->keterangan_kll == '1') {
                $CATKLL = "KLL dan bukan kecelakaan Kerja [BKK]";
            } else if ($request->keterangan_kll == '2') {
                $CATKLL = "KLL dan kecelakaan Kerja [KK]";
            } else if ($request->keterangan_kll == '3') {
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
                'poli_tujuan' => $kodeunit . ' |' . $sep->poli,
                'asal_faskes' => $request->kodeppkrujukan,
                'nama_asal_faskes' => $request->namappkrujukan,
                'diagnosa_awal' => $sep->diagnosa,
                'peserta' => $sep->peserta->jnsPeserta,
                'cob' => $request->cob,
                'jenis_rawat' => $sep->jnsPelayanan,
                'kls_rawat' => $sep->peserta->hakKelas,
                'no_rm' => $request->norm,
                'catatan' => $sep->catatan . "  " . $CATKLL,
                'act' => 1,
                'alasan_masuk' => '',
                'no_tlp' => $request->nomortelepon,
                'kode_kunjungan' => "$ts_kunjungan->id",
                'tgl_rujukan' => $request->tglrujukan,
                'no_skdp' => "",
                'dpjp' => $request->kodedokterlayan . ' | ' . $request->namadokterlayan,
                'no_rujukan' => $request->nomorrujukan,
                'katarak' => $request->katarak,
                'tgl_kll' => $request->tglkejadianlaka,
                'prop_kll' => $request->provinsikejadian,
                'kab_kll' => $request->kabupatenkejadian,
                'kec_kll' => $request->kecamatankejadian,
                'ket_kll' => $request->keteranganlaka,
                'pic1' => auth()->user()->id_simrs,
                'tingkat_faskes' => $request->asalrujukan,
            ];
            $ts_sep = ts_sep::create($data_ts_sep);
            //insert tracer
            $data_tracer = [
                'kode_kunjungan' => $ts_kunjungan->id,
                'tgl_tracer' => $tgl_masuk,
                'id_status_tracer' => 1,
                'cek_tracer' => 'N'
            ];
            //insert ke tracer
            tracer::create($data_tracer);
            $data = [
                'kode' => 200,
                'message' => 'sukses',
                'kode_kunjungan' => $ts_kunjungan->id
            ];
            echo json_encode($data);
        } else if ($datasep->metaData->code != 200) {
            DB::table('ts_kunjungan')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
            if ($kelas_unit == 1 || $kelas_unit == 2){
                //jika kelas penunjang  seperti hd,lab dll tidak akan tebentuk layanan header
                DB::table('ts_layanan_header')->where('kode_kunjungan', $ts_kunjungan->id)->delete();
                DB::table('ts_layanan_detail')->where('row_id_header', $ts_layanan_header->id)->delete();
            }
            $data = [
                'kode' => 201,
                'message' => $datasep->metaData->message
            ];
            echo json_encode($data);
        }
    }
    public function createLayanandetail()
    {
        $q = DB::select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail 
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
    public function get_rm()
    {
        $y = DB::select('SELECT MAX(RIGHT(no_rm,6)) AS kd_max FROM mt_pasien');
        if (count($y) > 0) {
            foreach ($y as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('y') . $kd;
    }
    public function datakunjungan()
    {
        $title = 'SIMRS - Riwayat Pendaftaran';
        $sidebar = '3';
        $sidebar_m = '3.2';
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        $alasan_pulang = DB::select("select * FROM mt_alasan_pulang");
        return view('simrs.datakunjungan', [
            'datakunjungan' => $data_kunjungan,
            'alasan' => $alasan_pulang,
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function riwayatpelayanan_user()
    {
        $title = 'SIMRS - Riwayat Pelayanan User';
        $sidebar = '3';
        $sidebar_m = '3.1';
        $now = date('Y-m-d');
        $d2 = date('Y-m-d', strtotime('-7 days'));
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        $alasan_pulang = DB::select("select * FROM mt_alasan_pulang");
        return view('simrs.riwayatpelayanan_user', [
            'datakunjungan' => $data_kunjungan,
            'alasan' => $alasan_pulang,
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
        ]);
    }
    public function caririwayatpelayanan_user(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        return view('simrs.caririwayatpelayanan_user', [
            'datakunjungan' => $data_kunjungan
        ]);
    }
    public function caridatakunjungan(Request $request)
    {
        $now = $request->tanggalakhir;
        $d2 = $request->tanggalawal;
        $data_kunjungan = DB::select("CALL SP_RIWAYAT_KUNJUNGAN_RS('$d2','$now')");
        return view('simrs.caridatakunjungan', [
            'datakunjungan' => $data_kunjungan
        ]);
    }
    public function detailkunjungan(Request $request)
    {
        // $data_kunjungan = DB::select('select * from view_ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $data_kunjungan = DB::select("CALL SP_DETAIL_KUNJUNGAN_PX('$request->kodekunjungan')");
        // dd($data_kunjungan);
        $data_layanan = DB::select('select distinct * from view_ts_layanan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $cek = count($data_layanan);
        if ($cek == 0) {
            $data_layanan = DB::select('select distinct * from view_ts_layanan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        }
        return view('simrs.detailkunjungan', [
            'datakunjungan' => $data_kunjungan,
            'data_layanan' => $data_layanan,
        ]);
    }
    public function batalperiksa(Request $request)
    {
        ts_kunjungan::where('kode_kunjungan', $request->kodekunjungan)->update(['status_kunjungan' => 8, 'pic2' => auth()->user()->id_simrs]);
        ts_layanan_header::where('kode_kunjungan', $request->kodekunjungan)->update(['status_layanan' => 3, 'pic2' => auth()->user()->id_simrs]);
        $ts_kunjungan = ts_kunjungan::where('kode_kunjungan', $request->kodekunjungan)->get();
        $id_ruangan = $ts_kunjungan[0]['id_ruangan'];
        $sep = $ts_kunjungan[0]['no_sep'];
        if ($id_ruangan) {
            DB::table('mt_ruangan')->where('id_ruangan', $id_ruangan)->update(['status_incharge' => 0]);
        }
        if ($sep) {
            DB::table('ts_sep')->where('kode_kunjungan', $request->kodekunjungan)->update(['status' => 8, 'pic2' => auth()->user()->id_simrs]);
            $v = new VclaimModel();
            $data_sep = [
                "request" => [
                    "t_sep" => [
                        "noSep" => $sep,
                        "user" => "waled | " . auth()->user()->id_simrs
                    ]
                ]
            ];
            $delete = $v->hapussep($data_sep);
        }
        $data = [
            'metaData' =>
            [
                'code' => 200,
            ]
        ];
        echo json_encode($data);
    }
    public function updatepulang(Request $request)
    {
        $v = new VclaimModel();
        $status_pulang_simrs = $request->status;
        if ($status_pulang_simrs == 6 || $status_pulang_simrs == 6) {
            $status_pulang_bpjs = 4;
        } else if ($status_pulang_simrs == 9) {
            $status_pulang_bpjs = 3;
        } else if ($status_pulang_simrs == 2) {
            $status_pulang_bpjs = 1;
        } else {
            $status_pulang_bpjs = 5;
        }
        $status_kunjungan = 2;
        $status_layanan = 2;
        if ($status_pulang_simrs == 8) {
            $status_kunjungan = 8;
            $status_layanan = 3;
        }
        ts_kunjungan::where('kode_kunjungan', $request->kodekunjungan)->update(['status_kunjungan' => $status_kunjungan, 'id_alasan_pulang' => $status_pulang_simrs, 'tgl_keluar' => $request->tanggalpulang, 'pic2' => auth()->user()->id_simrs]);
        ts_layanan_header::where('kode_kunjungan', $request->kodekunjungan)->update(['status_layanan' => $status_layanan, 'pic2' => auth()->user()->id_simrs]);
        $sep = DB::select('select * FROM ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $id_ruangan = $sep[0]->id_ruangan;
        if ($id_ruangan) {
            DB::table('mt_ruangan')->where('id_ruangan', $id_ruangan)->update(['status_incharge' => 0]);
        }
        if ($sep[0]->no_sep) {
            $data =   [
                "request" =>  [
                    "t_sep" =>  [
                        "noSep" =>  $sep[0]->no_sep,
                        "statusPulang" => "$status_pulang_bpjs",
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
        } else {
            $data = [
                'metaData' => [
                    'code' => '200',
                    'message' => 'OK'
                ]
            ];
            echo json_encode($data);
        }
    }
    public function Cetaksep($kodekunjungan)
    {
        //ambil data sep
        $sep = ts_sep::where('kode_kunjungan', $kodekunjungan)->get();
        //update cetakan
        $cetakan = $sep['0']['cetakan'] + 1;
        ts_sep::where('kode_kunjungan', $kodekunjungan)->update(['cetakan' => $cetakan]);
        $pdf = new Fpdf('L', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Cetak SEP');
        $pdf->SetMargins('15', '20', '10');
        $pdf->SetFont('Arial', '', 15);
        $pdf->Image('public/img/logobpjs.png', 1, -5, 60, 40);
        $pdf->Image('public/img/logo_rs.png', 170, 4, 35, 25);
        $pdf->SetXY(70, 8);
        $pdf->Cell(10, 7, 'SURAT ELIGIBILITAS PESERTA', 0, 1);
        $pdf->SetXY(73, 14);
        $pdf->Cell(10, 7, 'RSUD WALED KAB.CIREBON', 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 30);
        $pdf->Cell(10, 7, 'No. SEP', 0, 1);
        $pdf->SetXY(40, 30);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetXY(45, 30);
        $pdf->Cell(10, 7, $sep[0]->no_SEP, 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 35);
        $pdf->Cell(10, 7, 'Tgl. SEP', 0, 1);
        $pdf->SetXY(40, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 35);
        $pdf->Cell(10, 7, $sep['0']['tgl_SEP'], 0, 1);

        $pdf->SetXY(10, 40);
        $pdf->Cell(10, 7, 'No. Kartu', 0, 1);
        $pdf->SetXY(40, 40);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 40);
        $pdf->Cell(10, 7, $sep['0']['no_kartu'], 0, 1);

        $pdf->SetXY(100, 35);
        $pdf->Cell(10, 7, 'No. MR', 0, 1);
        $pdf->SetXY(115, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(120, 35);
        $pdf->Cell(10, 7, $sep['0']['no_rm'], 0, 1);

        $pdf->SetXY(100, 40);
        $pdf->Cell(10, 7, 'Kelamin', 0, 1);
        $pdf->SetXY(115, 40);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(120, 40);
        $pdf->Cell(10, 7, $sep['0']['jenis_kelamin'], 0, 1);

        $pdf->SetXY(140, 35);
        $pdf->Cell(10, 7, 'Peserta', 0, 1);
        $pdf->SetXY(160, 35);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 35);
        $pdf->Cell(10, 7, $sep['0']['peserta'], 0, 1);


        $pdf->SetXY(140, 40);
        $pdf->Cell(10, 7, 'COB', 0, 1);
        $pdf->SetXY(160, 40);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 40);
        $pdf->Cell(10, 7, $sep['0']['cob'], 0, 1);

        $pdf->SetXY(140, 45);
        $pdf->Cell(10, 7, 'Jns Rawat', 0, 1);
        $pdf->SetXY(160, 45);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 45);
        $pdf->Cell(10, 7, $sep['0']['jenis_rawat'], 0, 1);

        $pdf->SetXY(140, 50);
        $pdf->Cell(10, 7, 'Kls Rawat', 0, 1);
        $pdf->SetXY(160, 50);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 50);
        $pdf->Cell(10, 7, $sep['0']['kls_rawat'], 0, 1);

        $pdf->SetXY(140, 55);
        $pdf->Cell(10, 7, 'Penjamin', 0, 1);
        $pdf->SetXY(160, 55);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(165, 55);
        $pdf->Cell(10, 7, '', 0, 1);


        $pdf->SetXY(10, 45);
        $pdf->Cell(10, 7, 'Nama Peserta', 0, 1);
        $pdf->SetXY(40, 45);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 46);
        $pdf->MultiCell(60, 5, $sep['0']['nama_peserta']);
        // $pdf->Cell(10,7,$sep['0']['nama_peserta'],0,1);
        $y = $pdf->GetY();
        $pdf->SetXY(10, $y);
        $pdf->Cell(10, 7, 'Tgl Lahir', 0, 1);
        $pdf->SetXY(40, $y);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, $y);
        $pdf->Cell(10, 7, $sep['0']['tgl_lahir'], 0, 1);

        $pdf->SetXY(10, 60);
        $pdf->Cell(10, 7, 'No.Telepon', 0, 1);
        $pdf->SetXY(40, 60);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 60);
        $pdf->Cell(10, 7, $sep['0']['no_tlp'], 0, 1);

        $pdf->SetXY(10, 65);
        $pdf->Cell(10, 7, 'Poli Tujuan', 0, 1);
        $pdf->SetXY(40, 65);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 65);
        $poli = $sep['0']['poli_tujuan'];
        $arr = explode('|', $poli, 2);
        $pdf->Cell(10, 7, $arr[1], 0, 1);


        $pdf->SetXY(10, 70);
        $pdf->Cell(10, 7, 'Faskes Perujuk', 0, 1);
        $pdf->SetXY(40, 70);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 70);
        $pdf->Cell(10, 7, $sep['0']['nama_asal_faskes'], 0, 1);
        $diag = $sep['0']['diagnosa_awal'];
        $arr = explode('-', $diag, 2);
        $pdf->SetXY(10, 75);
        $pdf->Cell(10, 7, 'Diagnosa Awal', 0, 1);
        $pdf->SetXY(40, 75);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 75);
        $pdf->Cell(10, 7, $arr[1], 0, 1);

        $pdf->SetXY(10, 80);
        $pdf->Cell(10, 7, 'Catatan', 0, 1);
        $pdf->SetXY(40, 80);
        $pdf->Cell(10, 7, ':', 0, 1);
        $pdf->SetXY(45, 80);
        $pdf->Cell(10, 7, $sep['0']['catatan'], 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 85);
        $pdf->Cell(10, 7, '*Saya menyetujui BPJS Kesehatan menggunakan informasi Medis Pasien jika diperlukan', 0, 1);

        $pdf->SetFont('Arial', '', 9);
        $pdf->SetXY(150, 85);
        $pdf->Cell(10, 7, 'Pasien / Keluarga Pasien', 0, 1);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 90);
        $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY(10, 100);
        $pdf->Cell(10, 7, 'Cetakan ke -' . $sep['0']['cetakan'] . ' ,.Tanggal cetak ' . date('y-m-d h:i:s'), 0, 1);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 90);
        $pdf->Cell(10, 7, '*SEP bukan sebagai penjaminan peserta', 0, 1);
        $pdf->SetFont('Arial', 'I', 7);
        $pdf->SetXY(12, 100);
        $pdf->Cell(10, 7, '..', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Line(150, 100, 190, 100);
        $pdf->Output();

        exit;
    }
    public function simpanpasien(Request $request)
    {
        $rm = $this->get_rm();
        if ($request->sesuaiktp == 1) {
            $desa = $request->desa;
            $kecamatan = $request->kecamatan;
            $kab = $request->kabupaten;
            $prop = $request->provinsi;
            $alamat = $request->alamat;
        } else {
            $desa = $request->desadom;
            $kecamatan = $request->kecamatandom;
            $kab = $request->kabupatendom;
            $prop = $request->provinsidom;
            $alamat = $request->alamatdom;
        }
        $nobpjs = $request->nomorbpjs;
        if($request->nomorbpjs == ''){
            $nobpjs = '0';
        }
        $data_pasien = [
            'no_rm' => $rm,
            'no_Bpjs' => $nobpjs,
            'nik_bpjs' => $request->nomorktp,
            'nama_px' => $request->namapasien,
            'jenis_kelamin' => $request->jeniskelamin,
            'tempat_lahir' => $request->tempatlahir,
            'tgl_lahir' => $request->tanggallahir,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'kewarganegaraan' => $request->kewarganegaraan,
            'negara' => $request->negara,
            'propinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat' => $request->alamat,
            'no_tlp' => $request->nomortelp,
            'tgl_entry' => date('Y-m-d h:i:s'),
            'pic' => auth()->user()->id_simrs,
            'kode_propinsi' => $request->provinsi,
            'kode_kabupaten' => $request->kabupaten,
            'kode_kecamatan' => $request->kecamatan,
            'kode_desa' => $desa
        ];
        $data_keluarga = [
            'no_rm' => $rm,
            'nama_keluarga' => $request->nama_keluarga,
            'hubungan_keluarga' => $request->hubungankeluarga,
            'alamat_keluarga' => $request->alamatkeluarga,
            'tlp_keluarga' => $request->telpkeluarga,
            'input_date' => date('Y-m-d h:i:s'),
            'pic1' => auth()->user()->id_simrs
        ];
        $data_domisili = [
            'no_rm' => $rm,
            'negara' => $request->negara,
            'kd_desa' => $desa,
            'kd_kecamatan' => $kecamatan,
            'kd_kabupaten' => $kab,
            'kd_prop' => $prop,
            'alamat' => $alamat
        ];
        Pasien::create($data_pasien);
        mt_keluarga::create($data_keluarga);
        mt_domisili::create($data_domisili);
        $data = [
            'code' => 200,
            'message' => 'ok'
        ];
        echo json_encode($data);
    }
    public function cekkunjungan_rujukan(Request $request)
    {
        $v = new VclaimModel();
        $pulang = $v->jumlahseprujukan($request->faskes,$request->nomorrujukan);
        if($pulang->metaData->code == 200){
            $jumlah = $pulang->response->jumlahSEP + 1;
            echo "<div class='alert alert-success alert-dismissible fade show' role=alert>Nomor rujukan : $request->nomorrujukan <strong>Kunjungan ke-$jumlah</strong><button type=button class=close data-dismiss=alert aria-label=Close><span aria-hidden=true>&times;</span></button></div>";
        }
    }
    public function updatepasien(Request $request)
    {
        Pasien::where('no_rm', $request->rm)->update(['no_Bpjs' => $request->bpjs, 'nama_px' => $request->nama, 'nik_bpjs' => $request->ktp]);
        echo json_encode('ok');
    }
}
