<?php

namespace App\Http\Controllers;

use App\Models\DiagnosaKunjungan;
use App\Models\TindakanKunjungan;
use App\Models\ts_kunjungan;
use Illuminate\Http\Request;
use App\Models\VclaimModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

class VerifikasiBerkasRajalController extends UpdateERMcontroller
{
    public function index()
    {
        $title = 'SIMRS - VERIFIKASI BERKAS PASIEN RAWAT JALAN';
        $sidebar = 'indexverifikasiberkasrajal';
        $sidebar_m = '1.1';
        $now = date('Y-m-d', strtotime('-1 day', strtotime($this->get_date())));
        $unit = db::select('select * from mt_unit where group_unit = ?', ['J']);
        return view('Casemix.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'unit'
        ]));
    }
    public function indexverifikasiberkasirajaladmincasemix()
    {
        $title = 'SIMRS - VERIFIKASI BERKAS PASIEN RAWAT JALAN';
        $sidebar = 'indexverifikasiberkasirajaladmincasemix';
        $sidebar_m = '1.1';
        $now = date('Y-m-d', strtotime('-1 day', strtotime($this->get_date())));
        $unit = db::select('select * from mt_unit where group_unit = ?', ['J']);
        return view('Casemix.indexberkas', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'unit'
        ]));
    }
    public function getDataKunjungan(Request $request)
    {
        $tanggalAwal = $request->tanggalawal;
        $tanggalAkhir = $request->tanggalakhir;
        $jenisKunjungan = $request->jeniskunjungan;
        $unit = $request->unit;
        $awal  = Carbon::parse($tanggalAwal)->startOfDay();
        $akhir = Carbon::parse($tanggalAkhir)->endOfDay();

        $query = ts_kunjungan::select(
            'ts_kunjungan.*',
            'ts_verifikasi_berkas.catatan_verifikasi_awal',
            DB::raw('COALESCE(ts_verifikasi_berkas.status_verifikasi, 0) as status_verifikasi'),
            DB::raw('fc_nama_unit1(ts_kunjungan.kode_unit) as nama_unit'),
            DB::raw('fc_NAMA_PARAMEDIS1(ts_kunjungan.kode_paramedis) as nama_dokter'),
            DB::raw('fc_nama_px(ts_kunjungan.no_rm) as nama_pasien')
        )
            ->leftJoin('ts_verifikasi_berkas', 'ts_kunjungan.kode_kunjungan', '=', 'ts_verifikasi_berkas.kode_kunjungan')
            ->whereBetween('ts_kunjungan.tgl_masuk', [$awal, $akhir])
            ->where('ts_kunjungan.status_kunjungan', '!=', '8');

        if ($unit != '1') {
            $query->where('ts_kunjungan.kode_unit', $unit);
        }

        $data = $query->get();
        return view('Casemix.tabel_data_kunjungan', compact('data'));
    }
    public function getDataKunjungan2(Request $request)
    {
        $tanggalAwal = $request->tanggalawal;
        $tanggalAkhir = $request->tanggalakhir;
        $jenisKunjungan = $request->jeniskunjungan;
        $unit = $request->unit;
        $awal  = Carbon::parse($tanggalAwal)->startOfDay();
        $akhir = Carbon::parse($tanggalAkhir)->endOfDay();

        $query = ts_kunjungan::select(
            'ts_kunjungan.*',
            'ts_verifikasi_berkas.catatan_verifikasi_awal',
            DB::raw('COALESCE(ts_verifikasi_berkas.status_verifikasi, 0) as status_verifikasi'),
            DB::raw('fc_nama_unit1(ts_kunjungan.kode_unit) as nama_unit'),
            DB::raw('fc_NAMA_PARAMEDIS1(ts_kunjungan.kode_paramedis) as nama_dokter'),
            DB::raw('fc_nama_px(ts_kunjungan.no_rm) as nama_pasien')
        )
            ->leftJoin('ts_verifikasi_berkas', 'ts_kunjungan.kode_kunjungan', '=', 'ts_verifikasi_berkas.kode_kunjungan')
            ->whereBetween('ts_kunjungan.tgl_masuk', [$awal, $akhir])
            ->where('ts_kunjungan.status_kunjungan', '!=', '8');

        if ($unit != '1') {
            $query->where('ts_kunjungan.kode_unit', $unit);
        }

        $data = $query->get();
        return view('Casemix.tabel_data_kunjungan_admin', compact('data'));
    }
    public function ambilformverifikasi(Request $request)
    {
        $data = ts_kunjungan::select(
            'ts_kunjungan.*',
            DB::raw('fc_nama_unit1(kode_unit) as nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) as nama_dokter,fc_nama_px(no_rm) as nama_pasien')
        )
            ->where('kode_kunjungan', $request->kode_kunjungan);
        $kunjungan = $data->first();
        $kodekunjungan = $request->kode_kunjungan;
        $kode_kunjungan = $request->kode_kunjungan;
        // dd($kunjungan);
        try {
            // Ambil data layanan header
            $layananheader = DB::select('SELECT * FROM ts_layanan_header WHERE kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, '4008']);
            $layananheaderPA = DB::select('SELECT * FROM ts_layanan_header WHERE kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, '3020']);
            $idresep = '';
            $detail_obat = '';
            $urlCetakNota = '';
            if ($layananheader) {
                $idresep = $layananheader[0]->id;
                $detail_obat = DB::select('SELECT * FROM ts_layanan_detail WHERE row_id_header = ?', [$layananheader[0]->id]);
                $urlCetakNota = url('cetaknotafarmasi/' . $layananheader[0]->id);
            }

            $gambarscan = DB::select('SELECT * FROM erm_upload_gambar WHERE kodekunjungan = ?', [$kode_kunjungan]);
            $ts_kunjungan = DB::select('SELECT * FROM ts_kunjungan WHERE kode_kunjungan = ?', [$kode_kunjungan]);
            $no_sep = !empty($ts_kunjungan) ? $ts_kunjungan[0]->no_sep : null;
            $ref_kunjungan = $ts_kunjungan[0]->ref_kunjungan;
            $rm = $ts_kunjungan[0]->no_rm;
            // Ambil detail rincian obat/layanan (opsional, disesuaikan tabel detail Anda)
            // URL Cetak SEP untuk dipanggil di frontend/blade
            $urlCetakSEP = $no_sep ? "http://192.168.2.30/siramah/cetakSEPAntrian?noSep={$no_sep}" : null;
            $urlLembarKonsul = url('cetaklembarkonsul/' . $kode_kunjungan);
            $urlExpertisiPoli = url('cetakhasilexpertisipoli/' . $kode_kunjungan);
            $headerhd = db::select('select * from ts_header_catatan_hemodialisis where kode_kunjungan = ?', [$kode_kunjungan]);
            if (count($headerhd) > 0) {
                // dd($headerhd);
                $urlCetakHD = url('cetakcatatanhemodialisa/' . $headerhd[0]->id);
            } else {
                $urlCetakHD = '';
            }
            $hasil_lab = db::select("CALL LIHAT_HASIL_LAB_XXX(?)", [$rm]);
            $hasil_lab_spesial = db::select("CALL LIHAT_HASIL_LAB_SPESIAL(?)", [$rm]);
            $semua_hasil_lab = array_merge($hasil_lab, $hasil_lab_spesial);
            $lab_terpilih = array_values(array_filter($semua_hasil_lab, function ($item) use ($kode_kunjungan) {
                return isset($item->kode_kunjungan) && $item->kode_kunjungan == $kode_kunjungan;
            }));
            // Query Radiologi
            $rad_terpilih = DB::connection('mysql6')->select('SELECT * FROM order_table WHERE KODE_KUNJUNGAN = ?', [$kode_kunjungan]);
            $LINK_RADIOLOGI = [];
            foreach ($rad_terpilih as $rad) {
                if (!empty($rad->ACCESSIONNUMBER)) {
                    $LINK_RADIOLOGI[] = "http://196.196.196.251/SIRAMAH/cetakexp/" . trim($rad->ACCESSIONNUMBER);
                }
            }
            //resumerajal
            $getresume_rajal = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and jenis_dokumen = ?', [$kode_kunjungan, 'Resume-medis22']);
            if ($getresume_rajal) {
                $urlCetakResume1 = $getresume_rajal[0]->file;
                $urlCetakResume =  response($urlCetakResume1)
                    ->header('Content-Security-Policy', "frame-ancestors 'self' http://192.168.2.14")
                    ->header('Content-Type', 'application/pdf');
            } else {
                $urlCetakResume = '';
            }
            $icd10 = db::select('select * from mt_icd10');
            $icd9 = db::select('select * from mt_icd9');
            $diagnosakunjungan = db::select('select * from ts_kunjungan_diagnosa_utama where kode_kunjungan = ?', [$kode_kunjungan]);
            $diagnosatindakan = db::select('select * from ts_kunjungan_diagnosa_tindakn where kode_kunjungan = ?', [$kode_kunjungan]);
            $get_cek_ver = db::table('ts_verifikasi_berkas')->where('kode_kunjungan', $kode_kunjungan)->first();

            return view('Casemix.form_coder', compact([
                'kunjungan',
                'layananheader',
                'ts_kunjungan',
                'detail_obat',
                'urlCetakSEP',
                'urlCetakNota',
                'lab_terpilih',
                'LINK_RADIOLOGI',
                'idresep',
                'urlCetakResume',
                'urlLembarKonsul',
                'urlExpertisiPoli',
                'urlCetakHD',
                'gambarscan',
                'layananheaderPA',
                'icd10',
                'icd9',
                'diagnosakunjungan',
                'diagnosatindakan',
                'get_cek_ver'
            ]));
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function ambilformberkas(Request $request)
    {
        $data = ts_kunjungan::select(
            'ts_kunjungan.*',
            DB::raw('fc_nama_unit1(kode_unit) as nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) as nama_dokter,fc_nama_px(no_rm) as nama_pasien')
        )
            ->where('kode_kunjungan', $request->kode_kunjungan);
        $kunjungan = $data->first();
        $kodekunjungan = $request->kode_kunjungan;
        $kode_kunjungan = $request->kode_kunjungan;
        // dd($kunjungan);
        try {
            // Ambil data layanan header
            $layananheader = DB::select('SELECT * FROM ts_layanan_header WHERE kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, '4008']);
            $layananheaderPA = DB::select('SELECT * FROM ts_layanan_header WHERE kode_kunjungan = ? and kode_unit = ?', [$kodekunjungan, '3020']);
            $idresep = '';
            $detail_obat = '';
            $urlCetakNota = '';
            if ($layananheader) {
                $idresep = $layananheader[0]->id;
                $detail_obat = DB::select('SELECT * FROM ts_layanan_detail WHERE row_id_header = ?', [$layananheader[0]->id]);
                $urlCetakNota = url('cetaknotafarmasi/' . $layananheader[0]->id);
            }

            $gambarscan = DB::select('SELECT * FROM erm_upload_gambar WHERE kodekunjungan = ?', [$kode_kunjungan]);
            $ts_kunjungan = DB::select('SELECT * FROM ts_kunjungan WHERE kode_kunjungan = ?', [$kode_kunjungan]);
            $ref_kunjungan = $ts_kunjungan[0]->ref_kunjungan;
            $no_sep = !empty($ts_kunjungan) ? $ts_kunjungan[0]->no_sep : null;
            $rm = $ts_kunjungan[0]->no_rm;
            // Ambil detail rincian obat/layanan (opsional, disesuaikan tabel detail Anda)
            // URL Cetak SEP untuk dipanggil di frontend/blade
            $urlCetakSEP = $no_sep ? "http://192.168.2.30/siramah/cetakSEPAntrian?noSep={$no_sep}" : null;
            $urlLembarKonsul = url('cetaklembarkonsul/' . $kode_kunjungan);
            $urlExpertisiPoli = url('cetakhasilexpertisipoli/' . $kode_kunjungan);
            $headerhd = db::select('select * from ts_header_catatan_hemodialisis where kode_kunjungan = ?', [$kode_kunjungan]);
            if (count($headerhd) > 0) {
                // dd($headerhd);
                $urlCetakHD = url('cetakcatatanhemodialisa/' . $headerhd[0]->id);
            } else {
                $urlCetakHD = '';
            }
            $hasil_lab = db::select("CALL LIHAT_HASIL_LAB_XXX(?)", [$rm]);
            $hasil_lab_spesial = db::select("CALL LIHAT_HASIL_LAB_SPESIAL(?)", [$rm]);
            $semua_hasil_lab = array_merge($hasil_lab, $hasil_lab_spesial);
            $lab_terpilih = array_values(array_filter($semua_hasil_lab, function ($item) use ($kode_kunjungan) {
                return isset($item->kode_kunjungan) && $item->kode_kunjungan == $kode_kunjungan;
            }));
            // Query Radiologi
            $rad_terpilih = DB::connection('mysql6')->select('SELECT * FROM order_table WHERE KODE_KUNJUNGAN = ?', [$kode_kunjungan]);
            $LINK_RADIOLOGI = [];
            foreach ($rad_terpilih as $rad) {
                if (!empty($rad->ACCESSIONNUMBER)) {
                    $LINK_RADIOLOGI[] = "http://196.196.196.251/SIRAMAH/cetakexp/" . trim($rad->ACCESSIONNUMBER);
                }
            }
            //resumerajal
            $getresume_rajal = db::select('select * from log_ttd_elektronik where kode_kunjungan = ? and jenis_dokumen = ?', [$kode_kunjungan, 'Resume-medis22']);
            if ($getresume_rajal) {
                $urlCetakResume1 = $getresume_rajal[0]->file;
                $urlCetakResume =  response($urlCetakResume1)
                    ->header('Content-Security-Policy', "frame-ancestors 'self' http://192.168.2.14")
                    ->header('Content-Type', 'application/pdf');
            } else {
                $urlCetakResume = '';
            }
            $icd10 = db::select('select * from mt_icd10');
            $icd9 = db::select('select * from mt_icd9');
            $diagnosakunjungan = db::select('select * from ts_kunjungan_diagnosa_utama where kode_kunjungan = ?', [$kode_kunjungan]);
            $diagnosatindakan = db::select('select * from ts_kunjungan_diagnosa_tindakn where kode_kunjungan = ?', [$kode_kunjungan]);

            $get_cek_ver = db::table('ts_verifikasi_berkas')->where('kode_kunjungan', $kode_kunjungan)->first();
            return view('Casemix.list_berkas_klaim', compact([
                'kunjungan',
                'layananheader',
                'ts_kunjungan',
                'detail_obat',
                'urlCetakSEP',
                'urlCetakNota',
                'lab_terpilih',
                'LINK_RADIOLOGI',
                'idresep',
                'urlCetakResume',
                'urlLembarKonsul',
                'urlExpertisiPoli',
                'urlCetakHD',
                'gambarscan',
                'layananheaderPA',
                'icd10',
                'icd9',
                'diagnosakunjungan',
                'diagnosatindakan',
                'ref_kunjungan',
                'get_cek_ver'
            ]));
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan server.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function referensiicd10(Request $request)
    {
        $search = $request->get('q');

        $data = DB::table('mt_icd10')
            ->select('diag', 'nama')
            ->where(function ($query) use ($search) {
                $query->where('diag', 'LIKE', "%{$search}%")
                    ->orWhere('nama', 'LIKE', "%{$search}%");
            })
            ->limit(20) // Batasi maksimal 20 hasil per pencarian
            ->get();

        return response()->json($data);
    }
    public function referensiicd9(Request $request)
    {
        $search = $request->get('q');
        $data = DB::table('mt_icd9')
            ->select('diag', 'nama_panjang')
            ->where(function ($query) use ($search) {
                $query->where('diag', 'LIKE', "%{$search}%")
                    ->orWhere('nama_panjang', 'LIKE', "%{$search}%");
            })
            ->limit(20)
            ->get();
        return response()->json($data);
    }
    public function savediagnosatindakanstore(Request $request)
    {
        DB::beginTransaction();
        try {
            $kodeKunjungan = $request->kode_kunjungan;
            if ($request->has('diagnosa_utama')) {
                foreach ($request->diagnosa_utama as $kode) {
                    DiagnosaKunjungan::create([
                        'kode_kunjungan' => $kodeKunjungan,
                        'kategori'       => 'Utama',
                        'kode_icd10'     => $kode,
                    ]);
                }
            }
            // 2. Diagnosa Sekunder
            if ($request->has('diagnosa_sekunder')) {
                foreach ($request->diagnosa_sekunder as $kode) {
                    DiagnosaKunjungan::create([
                        'kode_kunjungan' => $kodeKunjungan,
                        'kategori'       => 'Sekunder',
                        'kode_icd10'     => $kode,
                    ]);
                }
            }
            // -----------------------------------------------------------------
            // B. SIMPAN DATA TINDAKAN / PROSEDUR (ICD-9)
            // -----------------------------------------------------------------
            // 1. Prosedur
            if ($request->has('tindakan_prosedur')) {
                foreach ($request->tindakan_prosedur as $kode) {
                    TindakanKunjungan::create([
                        'kode_kunjungan' => $kodeKunjungan,
                        'kategori'       => 'Prosedur',
                        'kode_icd9'      => $kode,
                    ]);
                }
            }
            // 2. Operasi
            if ($request->has('tindakan_operasi')) {
                foreach ($request->tindakan_operasi as $kode) {
                    TindakanKunjungan::create([
                        'kode_kunjungan' => $kodeKunjungan,
                        'kategori'       => 'Operasi',
                        'kode_icd9'      => $kode,
                    ]);
                }
            }
            // 3. Penunjang
            if ($request->has('tindakan_penunjang')) {
                foreach ($request->tindakan_penunjang as $kode) {
                    TindakanKunjungan::create([
                        'kode_kunjungan' => $kodeKunjungan,
                        'kategori'       => 'Penunjang',
                        'kode_icd9'      => $kode,
                    ]);
                }
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data Diagnosa & Prosedur berhasil disimpan!'
            ], 200);
        } catch (\Exception $e) {
            // Batalkan transaksi jika terjadi kesalahan
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function destroyDiagnosa($id)
    {
        try {
            $diagnosa = DiagnosaKunjungan::findOrFail($id);
            $diagnosa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Diagnosa berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus diagnosa: ' . $e->getMessage()
            ], 500);
        }
    }
    public function destroyTindakan($id)
    {
        try {
            $tindakan = TindakanKunjungan::findOrFail($id);
            $tindakan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tindakan berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus tindakan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function verifikasisimpan(Request $request)
    {
        $request->validate([
            'kode_kunjungan'    => 'required',
            'status_verifikasi' => 'required',
            'catatan'           => 'nullable|string',
        ]);

        $kode_kunjungan = $request->kode_kunjungan;

        // 1. Ambil Data Kunjungan & Validasi
        $ts_kunjungan = DB::select('SELECT * FROM ts_kunjungan WHERE kode_kunjungan = ?', [$kode_kunjungan]);
        if (empty($ts_kunjungan)) {
            return response()->json([
                'success' => false,
                'message' => 'Data kunjungan tidak ditemukan!'
            ], 404);
        }

        $no_sep = $ts_kunjungan[0]->no_sep ?? null;
        $rm     = $ts_kunjungan[0]->no_rm ?? null;

        // 2. Kumpulkan Semua URL Berkas PDF
        $pdfUrls = [];

        // a. URL SEP
        if ($no_sep) {
            $pdfUrls[] = "http://192.168.2.30/siramah/cetakSEPAntrian?noSep={$no_sep}";
        }

        // b. Lembar Konsul & Expertisi Poli
        // $pdfUrls[] = url('cetaklembarkonsul/' . $kode_kunjungan);
        // $pdfUrls[] = url('cetakhasilexpertisipoli/' . $kode_kunjungan);

        // c. Catatan Hemodialisa
        $headerhd = DB::select('SELECT * FROM ts_header_catatan_hemodialisis WHERE kode_kunjungan = ?', [$kode_kunjungan]);
        if (!empty($headerhd)) {
            $pdfUrls[] = url('cetakcatatanhemodialisa/' . $headerhd[0]->id);
        }

        // d. Resume Medis Rajal
        $getresume_rajal = DB::select('SELECT * FROM log_ttd_elektronik WHERE kode_kunjungan = ? AND jenis_dokumen = ?', [$kode_kunjungan, 'Resume-medis22']);
        if (!empty($getresume_rajal[0]->file)) {
            $pdfUrls[] = $getresume_rajal[0]->file;
        } else {
            $pdfUrls[] = url('cetakresumedmedisttelokal/' . $kode_kunjungan);
        }

        // e. Hasil Radiologi
        $rad_terpilih = DB::connection('mysql6')->select('SELECT * FROM order_table WHERE KODE_KUNJUNGAN = ?', [$kode_kunjungan]);
        foreach ($rad_terpilih as $rad) {
            if (!empty($rad->ACCESSIONNUMBER)) {
                $pdfUrls[] = "http://196.196.196.251/SIRAMAH/cetakexp/" . trim($rad->ACCESSIONNUMBER);
            }
        }

        // 3. Download dan Validasi Setiap PDF
        $merger = PDFMerger::init();
        $tempFiles = [];

        // Ambil cookie dari request saat ini agar endpoint internal yang butuh login tetap bisa diakses
        $cookies = $request->cookies->all();

        foreach ($pdfUrls as $index => $url) {
            try {
                $httpClient = Http::withoutVerifying()
                    ->timeout(30)
                    ->withCookies($cookies, parse_url('http://localhost/simrs/cetakresumedmedisttelokal/22776317', PHP_URL_HOST) ?? '');
                $response = $httpClient->get('http://localhost/simrs/cetakresumedmedisttelokal/22776317');
                if ($response->successful()) {
                    $body = $response->body();
                    // Cek apakah konten benar-benar berkas PDF (header %PDF- berada di awal file)
                    if (strlen($body) > 100 && strpos(substr($body, 0, 1024), '%PDF-') !== false) {
                        $tempPath = storage_path('app/temp_merger_' . uniqid() . '_' . $index . '.pdf');
                        file_put_contents($tempPath, $body);
                        dd($tempPath);
                        $merger->addPDF($tempPath, 'all');
                        $tempFiles[] = $tempPath;
                    } else {
                        dd($url);
                        // Jika bukan PDF (misal mengembalikan halaman HTML login / 404 custom)
                        Log::warning("URL tidak mengembalikan berkas PDF valid (Kemungkinan HTML/Login): {$url} | Awal Respon: " . substr(strip_tags($body), 0, 150));
                    }
                } else {
                    Log::warning("Gagal mengunduh PDF dari URL: {$url} | Status Code: " . $response->status());
                }
            } catch (\Exception $e) {
                Log::error("Eksepsi saat mengunduh PDF dari URL ({$url}): " . $e->getMessage());
            }
        }

        // Cek jika tidak ada 1 pun PDF yang berhasil diunduh
        if (empty($tempFiles)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada berkas PDF valid yang dapat diunduh/digabungkan.'
            ], 422);
        }

        // 4. Simpan Berkas Merger Final
        $fileName = 'merger_' . $kode_kunjungan . '_' . time() . '.pdf';
        $outputFolderPath = storage_path('app/public/berkas_merger/');

        if (!file_exists($outputFolderPath)) {
            mkdir($outputFolderPath, 0755, true);
        }

        $finalPath = $outputFolderPath . $fileName;

        $merger->merge();
        $merger->save($finalPath);

        // 5. Bersihkan File Temporary
        foreach ($tempFiles as $file) {
            if (file_exists($file)) {
                @unlink($file);
            }
        }

        // 6. Response JSON
        return response()->json([
            'success' => true,
            'message' => 'Verifikasi dan merger berkas berhasil!',
            'pdf_url' => asset('storage/berkas_merger/' . $fileName)
        ]);
    }
    public function simpan(Request $request)
    {
        $request->validate([
            'kode_kunjungan'    => 'required',
            'status_verifikasi' => 'required',
        ]);

        // Mengambil array berkas beserta URL-nya (hanya yang dicentang)
        $berkasChecked = $request->input('berkas_checked', []);
        if ($request->status_verifikasi == 2) {
            $pesan = 'Berkas Lengkap';
        } else {
            $pesan = $request->catatan;
        }
        DB::table('ts_verifikasi_berkas')->updateOrInsert(
            ['kode_kunjungan' => $request->kode_kunjungan],
            [
                'status_verifikasi' => $request->status_verifikasi,
                'catatan_verifikasi_awal' => $pesan,
                'detail_berkas'     => json_encode($berkasChecked), // Disimpan sebagai JSON jika perlu
                'pic' => auth()->user()->id,
                'tgl_verif' => $this->get_now()
            ]
        );

        return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);
    }
}
