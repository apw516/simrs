<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\MODEL_APOTEK_ONLINE;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use App\Models\model_template_racikan;
use App\Models\model_template_racikan_detail;
use App\Models\model_mt_racikan;
use App\Models\model_mt_racikan_detail;
use App\Models\MasterBarangBPJS;
use App\Models\MasterBarang;

class newFarmasiController extends FarmasiController
{
    public function index_depo_obat()
    {
        $title = 'FARMASI - DEPO OBAT';
        $sidebar = 'indexdepo';
        $sidebar_m = '1.1';
        $awal_bulan = date('Y-m-01');
        $now = $this->get_date();
        $mt_unit = db::select('select * from mt_unit where group_unit = ?', (['J']));
        $pasien_rajal = db::select('SELECT COUNT(kode_kunjungan) as total FROM ts_kunjungan
        WHERE DATE(tgl_masuk) = CURDATE() AND LEFT(kode_unit,1) = 1 AND status_kunjungan NOT IN (8)');
        //semua poli / bulan
        $ds = DB::select('CALL erm_dasboard_03_per_tgl(?,?,?)', [$awal_bulan, $this->get_date(), '']);
        $unit = [];
        foreach ($ds as $d) {
            array_push($unit, $d->unit);
        }
        $total = [];
        foreach ($ds as $d) {
            array_push($total, $d->Total);
        }

        //berdasarkan poli
        $bypoli = DB::select('CALL erm_dasboard_03a_per_tgl(?,?,?)', [$awal_bulan, $this->get_date(), auth()->user()->unit]);
        $tgl = [];
        foreach ($bypoli as $d) {
            array_push($tgl, 'tanggal ' . $d->tgl);
        }
        $jml = [];
        foreach ($bypoli as $d) {
            array_push($jml, $d->jml);
        }
        return view('new_farmasi.index_depo_obat', compact([
            'title',
            'sidebar',
            'sidebar_m',
        ]));
    }
    public function index_log_kartu_stok()
    {
        $title = 'FARMASI - KARTU STOK';
        $sidebar = 'index_log_kartu_stok';
        $sidebar_m = '1.1';
        $units = DB::table('mt_unit')
            ->where('kode_unit', '>', 4000)
            ->where('kode_unit', '<', 4014)
            ->get(['kode_unit', 'nama_unit']);
        return view('new_farmasi.index_kartu_stok', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'units'
        ]));
    }
    public function index_mapping_barang()
    {
        $title = 'FARMASI - KARTU STOK';
        $sidebar = 'index_mapping_barang';
        $sidebar_m = '1.1';
        $units = DB::table('mt_unit')
            ->where('kode_unit', '>', 4000)
            ->where('kode_unit', '<', 4014)
            ->get(['kode_unit', 'nama_unit']);
        return view('new_farmasi.index_mapping_barang', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'units'
        ]));
    }
    public function index_riwayat_pelayanan_obat_depo()
    {
        $title = 'FARMASI - RIWAYAT PELAYANAN DEPO OBAT';
        $sidebar = 'index_riwayat_pelayanan_depo';
        $sidebar_m = '1.1';
        return view('new_farmasi.index_riwayat_pelayanan_depo_obat', compact([
            'title',
            'sidebar',
            'sidebar_m',
        ]));
    }
    public function ambildatakunjungandepo(Request $request)
    {
        $tglAwal = $request->tgl_awal;
        $tglAkhir = $request->tgl_akhir;
        $groupUnit = $request->jenis_pelayanan;

        $kunjungan = DB::table('ts_kunjungan as a')
            ->select([
                'a.counter',
                'a.tgl_masuk',
                'a.kode_kunjungan',
                'a.no_rm',
                DB::raw('fc_nama_px(a.no_rm) AS nama_pasien'),
                'b.jenis_kelamin',
                'b.tgl_lahir',
                DB::raw('fc_alamat(a.no_rm) AS alamat'),
                DB::raw('fc_NAMA_PENJAMIN2(a.kode_penjamin) AS nama_penjamin'),
                DB::raw('fc_nama_unit1(a.kode_unit) AS nama_unit'),
                DB::raw('fc_NAMA_PARAMEDIS1(a.kode_paramedis) AS nama_dokter')
            ])
            ->leftJoin('mt_pasien as b', 'a.no_rm', '=', 'b.no_rm')
            ->leftJoin('mt_unit as c', 'a.kode_unit', '=', 'c.kode_unit')
            ->whereBetween(DB::raw('DATE(a.tgl_masuk)'), [$tglAwal, $tglAkhir])
            ->when($groupUnit && $groupUnit !== 'all', function ($query) use ($groupUnit) {
                return $query->where('c.group_unit', $groupUnit);
            })
            ->get();
        return view('new_farmasi.tabel_kunjungan', compact([
            'kunjungan'
        ]));
    }
    public function ambil_data_riwayat_pelayanan_obat(Request $request)
    {
        $tglAwal = $request->tgl_awal;
        $tglAkhir = $request->tgl_akhir;
        $kodeUnit = $request->jenis_pelayanan;
        $data = DB::table('ts_layanan_header as a')
            ->select([
                'a.kode_layanan_header',
                'a.kode_kunjungan',
                'c.no_rm',
                DB::raw('fc_nama_px(c.no_rm) as nama_pasien'),
                DB::raw('fc_NAMA_PARAMEDIS1(c.kode_paramedis) as nama_dokter'),
                DB::raw('fc_nama_unit1(a.kode_unit) as nama_unit'),
                DB::raw('fc_nama_unit1(c.kode_unit) as nama_unit_asal'),
                DB::raw('fc_NAMA_PENJAMIN2(c.kode_penjamin) as nama_penjamin'),
                'b.iterasi',
                'b.NORESEP',
                'b.REFASALSJP',
                'b.Sepapotek',
                'b.Bridging',
                'a.id as id_layanan_header',
                'b.id as id_resep_bpjs',
            ])
            ->leftJoin('resep_header_bpjs as b', 'a.id', '=', 'b.id_layanan_header')
            ->leftJoin('ts_kunjungan as c', 'a.kode_kunjungan', '=', 'c.kode_kunjungan')
            ->whereBetween('a.tgl_entry', [$tglAwal . ' 00:00:00', $tglAkhir . ' 23:59:59'])
            ->where('a.status_layanan', '!=', 3) // <-- Tambahan kondisi status_layanan != 3
            ->when($kodeUnit === 'all' || empty($kodeUnit), function ($q) {
                // Jika 'all', ambil kode unit 4002 dan 4008
                return $q->whereIn('a.kode_unit', ['4002', '4008']);
            }, function ($q) use ($kodeUnit) {
                // Jika berisi nilai spesifik (misal '4008')
                return $q->where('a.kode_unit', $kodeUnit);
            })
            ->orderBy('a.id', 'desc')
            ->get();
        return view('new_farmasi.tabel_riwayat_pelayanan', compact([
            'data'
        ]));
    }
    public function ambildetailkunjunganpasiendepo(Request $request)
    {
        $kode_kunjungan = $request->kodekunjungan;
        $data_kunjungan = db::select('select *,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$kode_kunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx from mt_pasien where no_rm = ?', [$data_kunjungan[0]->no_rm]);
        $kode_paramedis = $data_kunjungan[0]->kode_paramedis;
        $dokter = db::select('select * from mt_paramedis where kode_paramedis = ?', [$kode_paramedis]);
        $kodeUnit = '4008';
        // 1. Buat Subquery terlebih dahulu
        $subQuery = DB::connection('mysql7')->table('ti_kartu_stok')
            ->select('kode_unit', 'kode_barang', DB::raw('MAX(no) AS max_id'))
            ->where('kode_unit', $kodeUnit)
            ->groupBy('kode_unit', 'kode_barang');
        $stokBarang = DB::connection('mysql7')->table('ti_kartu_stok as k')
            ->joinSub($subQuery, 'last_trans', function ($join) {
                $join->on('k.no', '=', 'last_trans.max_id');
            })
            ->join('mt_barang as b', 'k.kode_barang', '=', 'b.kode_barang')
            ->where('k.kode_unit', $kodeUnit)
            ->where('k.stok_current', '>', 0)
            ->select([
                'b.kode_barang',
                'b.nama_barang',
                'b.nama_generik',
                'k.kode_unit',
                'k.stok_current as stok_saat_ini',
                'k.tgl_stok as tanggal_transaksi_terakhir',
            ])
            ->get();
        return view('new_farmasi.detail_pasien', compact([
            'data_kunjungan',
            'mt_pasien',
            'stokBarang',
            'dokter'
        ]));
    }
    public function simpandataresepobatpasien(Request $request)
    {
        $data_obat = json_decode($_POST['data_obat'], true);
        $data_header_obat = json_decode($_POST['data_header_obat'], true);

        $dataheader = [];
        foreach ($data_header_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataheader[$index] = $value;
        }
        $arrayobat = [];
        $dataSet = [];
        foreach ($data_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'catatan') {
                $arrayobat[] = $dataSet;
            }
        }
        try {
            DB::connection('mysql7')->beginTransaction();
            $kode_unit_pelayanan = auth()->user()->unit;
            $kode_kunjungan = $dataheader['kode_kunjungan'];
            $data_kunjungan = DB::select('select *,fc_nama_px(no_rm) as nama_pasien,fc_alamat(no_rm) as alamat_pasien, fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kode_kunjungan]);
            if (empty($data_kunjungan)) {
                throw new \Exception("Data kunjungan tidak ditemukan!");
            }
            $collection = collect($arrayobat);
            $dataTerpisah = $collection->groupBy('jenis_obat');
            $reguler = $dataTerpisah->get('Reguler', []);
            $kronis = $dataTerpisah->get('Kronis', []);
            $PRB = $dataTerpisah->get('PRB', []);
            $Kemoterapi = $dataTerpisah->get('Kemoterapi', []);
            if (count($reguler) > 0) {
                $tipe_anestesi = '80';
                $this->prosesResepObat($reguler, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader);
            }
            if (count($kronis) > 0) {
                $tipe_anestesi = '81';
                $this->prosesResepObaKronis($kronis, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader);
            }
            if (count($PRB) > 0) {
                $tipe_anestesi = '84';
                $this->prosesResepObatPRB($PRB, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader);
            }
            if (count($Kemoterapi) > 0) {
                $tipe_anestesi = '82';
                $this->prosesResepObatKemo($Kemoterapi, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader);
            }
            // Jalankan Commit jika semua proses sukses tanpa Exception
            DB::connection('mysql7')->commit();
            return response()->json([
                'kode' => 200,
                'message' => 'Resep berhasil disimpan'
            ], 200);
        } catch (\Throwable $e) {
            // Rollback semua query jika ada error di proses mana pun
            DB::rollBack();
            return response()->json([
                'kode' => 500,
                'message' => 'Transaksi dibatalkan. Error: ' . $e->getMessage()
            ], 200);
        }
    }
    public function prosesResepObaKronis($dataobat, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader)
    {
        $r = DB::connection('mysql7')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit_pelayanan')");
        $PENJAMIN = $data_kunjungan[0]->kode_penjamin;
        $kode_kunjungan = $data_kunjungan[0]->kode_kunjungan;
        $unit = DB::select('select * from mt_unit where kode_unit =?', [$kode_unit_pelayanan]);
        $jsf = DB::select('select * from mt_jasa_farmasi');
        if ($PENJAMIN == 'P01') {
            $kat_resep = 'Resep Tunai';
            $tipe_tx = '1';
        } else {
            $kat_resep = 'Resep Kredit';
            $tipe_tx = '2';
        }
        $kode_layanan_header = $r[0]->no_trx_layanan ?? "";
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
            DB::connection('mysql7')->insert(
                'INSERT INTO mt_nomor_trx (tgl, no_trx_layanan, unit) VALUES (?, ?, ?)',
                [date('Y-m-d H:i:s'), $kode_layanan_header, $kode_unit_pelayanan]
            );
        }
        $cek_resep_ke = DB::connection('mysql7')->select('select id from ts_layanan_header where kode_kunjungan = ? and kode_unit = ? and status_layanan != 3', [$kode_kunjungan, $kode_unit_pelayanan]);
        $urutan = count($cek_resep_ke) + 1;
        $data_layanan_header = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $kode_kunjungan,
            'kode_unit' => auth()->user()->unit,
            'kode_tipe_transaksi' => $tipe_tx,
            'pic' => auth()->user()->id,
            'status_layanan' => '3',
            'keterangan' => 'Resep Ke :' . $urutan,
            'total_layanan' => '0',
            'kode_penjaminx' => $data_kunjungan[0]->kode_penjamin,
            'tagihan_pribadi' => 0,
            'tagihan_penjamin' => 0,
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $data_kunjungan[0]->kode_unit . ' | ' . $data_kunjungan[0]->nama_unit,
            'diagnosa' => $data_kunjungan[0]->diagx,
        ];
        $idBaru = DB::connection('mysql7')->table('ts_layanan_header')->insertGetId($data_layanan_header);
        $now = $this->get_now();
        $totalheader = 0;
        $status_iter = 0;
        $jumlah_iter = 0;
        foreach ($dataobat as $a) {
            $kode_detail_obat = $this->createLayanandetail();
            if ($a['jenis_resep'] != 'Racikan') {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang']]);
                if (empty($mt_barang)) {
                    throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                }
                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);
                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['signa2'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }
                $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                    ->where('kode_unit', auth()->user()->unit)
                    ->where('kode_barang', $a['kode_barang'])
                    ->orderBy('no', 'desc')
                    ->value('stok_current');
                if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                    $stokTersedia = $stokTerakhir ?? 0;
                    $namaBarang   = $mt_barang[0]->nama_barang;
                    throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                }
                $total      = $mt_barang[0]->harga_jual * $totalObat;
                $diskon     = 0;
                $hitung     = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total;
                } else {
                    $tagihan_pribadi = $total;
                    $tagihan_penjamin = 0;
                }
                $aturan_pakai = $a['signa1'] . ' x ' . $a['signa2'] . ' | ' . $a['catatan'];
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $mt_barang[0]->harga_jual,
                    'jumlah_layanan' => $totalObat,
                    'total_layanan' => $total,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $grandtotal,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $a['kode_barang'],
                    'aturan_pakai' => $aturan_pakai,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => $mt_barang[0]->satuan,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                $ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat,
                    'tgl_stok' => $now,
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang'],
                    'stok_last' => $stokTerakhir,
                    'stok_out' => $totalObat,
                    'stok_current' => $stokTerakhir - $totalObat,
                    'harga_beli' => $mt_barang[0]->hna_history,
                    'inputby' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                ];
                DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader += $grandtotal;
            } else {
                $kode_racikan = $a['kode_barang'];
                $get_detail_racikan = db::select('select * from template_racikan_detail where id_header = ?', [$kode_racikan]);
                $racikanheader = db::select('select * from template_racikan_header where id =?', [$a['kode_barang']]);
                if ($racikanheader[0]->sediaan == 1) {
                    $kemasan = 'KAPSUL';
                    $tiperacik = 'NS';
                    $harga = '700';
                } elseif ($racikanheader[0]->sediaan == 2) {
                    $kemasan = 'KERTAS';
                    $tiperacik = 'NS';
                    $harga = '700';
                } else {
                    $kemasan = 'POT SALEP';
                    $tiperacik = 'S';
                    $harga = 10000;
                }
                $kode_racik = $this->get_kode_racik();
                $data_mt_racikan_header = [
                    'kode_racik' => $kode_racik,
                    'tgl_racik' => $this->get_now(),
                    'nama_racik' => $racikanheader[0]->namaracikan,
                    'total_racik' => 0,
                    'tipe_racik' => $tiperacik,
                    'qty_racik' => $racikanheader[0]->qtyracikan,
                    'kemasan' => $kemasan,
                    'hrg_kemasan' => $harga,
                ];
                // dd($data_mt_racikan_header);
                $mt_racikan_header = model_mt_racikan::create($data_mt_racikan_header);
                $total_racik = 0;
                foreach ($get_detail_racikan as $or) {
                    $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$or->kode_barang]);
                    if (empty($mt_barang)) {
                        throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                    }
                    // $jumlahHari = $a['jumlahhari'];
                    $totalObat = $or->qty_barang;
                    $frekuensi  = $a['signa1'];
                    $dosis      = $a['signa2'];
                    $pemakaianSehari = $frekuensi * $dosis;
                    if ($pemakaianSehari > 0) {
                        // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                        $jumlahHari = $totalObat / $pemakaianSehari;
                    } else {
                        $jumlahHari = 0;
                    }
                    // $totalObat  = $jumlahHari * ($frekuensi * $dosis);
                    $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                        ->where('kode_unit', auth()->user()->unit)
                        ->where('kode_barang', $or->kode_barang)
                        ->orderBy('no', 'desc')
                        ->value('stok_current');
                    if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                        $stokTersedia = $stokTerakhir ?? 0;
                        $namaBarang   = $mt_barang[0]->nama_barang;
                        throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                    }
                    $totalbarang = $mt_barang[0]->harga_jual + $or->qty_barang;
                    $tt = $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $mt_racikan_detail_1 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => $or->kode_barang,
                        'qty_barang' => $or->qty_barang,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'harga_satuan_barang' => $mt_barang[0]->harga_jual,
                        'subtotal_barang' => $totalbarang,
                        'grantotal_barang' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => $or->qty_barang,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_1);
                    $ti_kartu_stok = [
                        'no_dokumen' => $kode_layanan_header,
                        'no_dokumen_detail' => $kode_detail_obat,
                        'tgl_stok' => $now,
                        'kode_unit' => auth()->user()->unit,
                        'kode_barang' => $or->kode_barang,
                        'stok_last' => $stokTerakhir,
                        'stok_out' => $totalObat,
                        'stok_current' => $stokTerakhir - $totalObat,
                        'harga_beli' => $mt_barang[0]->hna_history,
                        'inputby' => auth()->user()->id,
                        'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                    ];
                    DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                    $mt_racikan_detail_2 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => 'TX23513',
                        'qty_barang' => 1,
                        'satuan_barang' => '-',
                        'harga_satuan_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'subtotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'grantotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => 1,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_2);
                    $total_racik = $total_racik + $tt;
                }
                model_mt_racikan::where('id', $mt_racikan_header->id)->update(['total_racik' => $total_racik]);
                $kode_detail_obat = $this->createLayanandetail();
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total_racik;
                } else {
                    $tagihan_pribadi = $total_racik;
                    $tagihan_penjamin = 0;
                }
                $grandtotal = $total_racik;
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $total_racik,
                    'jumlah_layanan' =>  $a['qtyobat'],
                    'total_layanan' => $total_racik,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $total_racik,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $kode_racik,
                    'aturan_pakai' => $a['signa1'] . ' / ' . $a['signa2'] . ' / ' . $a['catatan'],
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tipe_anestesi' => 80,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' =>  $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($tiperacik == 'NS') {
                    $HARGA = $jsf[0]->jasa_racikan_powder;
                    $jumlahl = $a['qtyobat'] * $HARGA;
                    $jumlah = $a['qtyobat'];
                } else {
                    $HARGA = $jsf[0]->jasa_racikan_salep;
                    $jumlah = 1;
                    $jumlahl = $HARGA;
                }
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jumlahl;
                } else {
                    $tagihan_pribadi_js = $jumlahl;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $HARGA,
                    'jumlah_layanan' => $jumlah,
                    'total_layanan' => $jumlahl,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jumlahl,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => 80,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader = $totalheader + $grandtotal;
            }
            if ($a['iterasi'] == 1) {
                $status_iter = 1;
                if ($jumlah_iter == 0) {
                    $jumlah_iter = $a['jlh_iterasi'];
                }
            }
        }
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagian_penjamin_head = $jsf[0]->jasa_baca;
            $tagian_pribadi_head = 0;
        } else {
            $tagian_penjamin_head = 0;
            $tagian_pribadi_head = $jsf[0]->jasa_baca;
        }
        $ts_layanan_detail3 = [
            'id_layanan_detail' => $this->createLayanandetail(),
            'kode_layanan_header' => $kode_layanan_header,
            'kode_tarif_detail' => 'TX23523',
            'total_tarif' => $jsf[0]->jasa_baca,
            'diskon_layanan' => '0',
            'jumlah_layanan' => 1,
            'total_layanan' => $jsf[0]->jasa_baca,
            'grantotal_layanan' => $jsf[0]->jasa_baca,
            'status_layanan_detail' => 'OPN',
            'tgl_layanan_detail' => $now,
            'kategori_resep' => $kat_resep,
            'satuan_barang' => '-',
            'tagihan_pribadi' => $tagian_pribadi_head,
            'tagihan_penjamin' => $tagian_penjamin_head,
            'tipe_anestesi' => $tipe_anestesi,
            'tgl_layanan_detail_2' => $now,
            'row_id_header' => $idBaru,
        ];
        DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail3);
        $totalheader += $jsf[0]->jasa_baca;
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagihan_penjamin_header = $totalheader;
            $tagihan_pribadi_header = '0';
            $status_layanan = 2;
        } else {
            $tagihan_penjamin_header = '0';
            $tagihan_pribadi_header = $totalheader;
            $status_layanan = 1;
        }
        DB::connection('mysql7')->table('ts_layanan_header')
            ->where('id', $idBaru)
            ->update([
                'status_layanan' => $status_layanan,
                'total_layanan' => $totalheader,
                'tagihan_penjamin' => $tagihan_penjamin_header,
                'tagihan_pribadi' => $tagihan_pribadi_header
            ]);
        $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [$data_kunjungan[0]->kode_unit]);
        $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [$data_kunjungan[0]->kode_paramedis]);
        $noresep = $this->get_no_resep($data_kunjungan[0]->kode_kunjungan);
        $v = new MODEL_APOTEK_ONLINE();
        $header_resep_bpjs = [
            "TGLSJP" =>  $dataheader['tgl_resep'] . " 00:00:00",
            "REFASALSJP" => $dataheader['no_sep'],
            "POLIRSP" => $mt_unit[0]->KDPOLI,
            "KDJNSOBAT" => "2",
            "NORESEP" => $noresep,
            "IDUSERSJP" => 'rswld',
            "TGLRSP" => $dataheader['tgl_resep'] . " 00:00:00",
            "TGLPELRSP" => $dataheader['tgl_pel_resep'] . " 00:00:00",
            "KdDokter" => $mt_paramedis[0]->kode_dokter_jkn,
            "iterasi" => $jumlah_iter
        ];
        $header_resep_bpjs_2 = [
            "TGLSJP" =>  $dataheader['tgl_resep'] . " 00:00:00",
            "REFASALSJP" => $dataheader['no_sep'],
            "POLIRSP" => $mt_unit[0]->KDPOLI,
            "KDJNSOBAT" => "2",
            "NORESEP" => $noresep,
            "IDUSERSJP" => auth()->user()->id,
            "TGLRSP" => $dataheader['tgl_resep'] . " 00:00:00",
            "TGLPELRSP" => $dataheader['tgl_pel_resep'] . " 00:00:00",
            "KdDokter" => $mt_paramedis[0]->kode_dokter_jkn,
            "iterasi" => $jumlah_iter,
            'kode_kunjungan' => $data_kunjungan[0]->kode_kunjungan,
            'id_layanan_header' => $idBaru,
            'kode_layanan_header' => $kode_layanan_header,
        ];
        $header_bpjs = db::connection('mysql7')->table('resep_header_bpjs')->insertGetId($header_resep_bpjs_2);
        $response_data = $v->simpan_resep($header_resep_bpjs);
        if ($response_data->metaData->code == 200) {
            $sep_apotek = $response_data->response->noApotik;
            $data_update = [
                'Sepapotek' => $response_data->response->noApotik,
                'tglentry' => $response_data->response->tglEntry,
                'Bridging' => 'TERKIRIM',
            ];
            db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update($data_update);
        } else {
            throw new \Exception("Gagal kirim header resep Kronis ke BPJS: " . $response_data->metaData->message);
        }
        foreach ($dataobat as $a) {
            if ($a['jenis_resep'] == 'NonRacikan') {
                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);

                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['signa2'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }

                $kode_barang = $a['kode_barang'];
                $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kode_barang]);
                $kode_barang_bpjs = $mt_barang[0]->kode_obat_bpjs;
                $mt_barang_bpjs = db::select('select * from apt_online_ref_dpho where kodeobat = ?', [$kode_barang_bpjs]);
                if (count($mt_barang_bpjs) == 0) {
                    $v->hapus_resep([
                        "nosjp" => $sep_apotek,
                        "refasalsjp" => $dataheader['no_sep'],
                        "noresep" => $noresep
                    ]);
                    db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                    throw new \Exception("Master barang dengan nama " . $mt_barang[0]->nama_barang . " belum mempunyai kode bpjs !");
                }
                $data_detail_obat_bpjs =    [
                    "NOSJP" => $sep_apotek,
                    "NORESEP" => $noresep,
                    "KDOBT" => $kode_barang_bpjs,
                    "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    "SIGNA1OBT" => $a['signa1'],
                    "SIGNA2OBT" => $a['signa2'],
                    "JMLOBT" => $totalObat,
                    "JHO" => $jumlahHari,
                    "CatKhsObt" => $a['catatan']
                ];
                $save_dtail = [
                    "NOSJP" => $sep_apotek,
                    "NORESEP" => $noresep,
                    "KDOBT" => $kode_barang_bpjs,
                    "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    "SIGNA1OBT" => $a['signa1'],
                    "SIGNA2OBT" => $a['signa2'],
                    "JMLOBT" => $totalObat,
                    "JHO" => $jumlahHari,
                    "CatKhsObt" => $a['catatan'],
                    "id_resep_header" => $header_bpjs
                ];
                $detail = db::connection('mysql7')->table('resep_detail_bpjs')->insertGetId($save_dtail);
                $response_data_obat = $v->save_non_racik($data_detail_obat_bpjs);
                if ($response_data_obat->metaData->code == 200) {
                } else {
                    $v->hapus_resep([
                        "nosjp" => $sep_apotek,
                        "refasalsjp" => $dataheader['no_sep'],
                        "noresep" => $noresep
                    ]);
                    db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                    throw new \Exception($response_data_obat->metaData->message);
                }
            } else {
                $kode_obat = $a['kode_barang'];
                $detailracik = db::select('select * from template_racikan_detail where id_header = ?', [$kode_obat]);
                // $v->hapus_resep([
                //     "nosjp" => $sep_apotek,
                //     "refasalsjp" => $dataheader['no_sep'],
                //     "noresep" => $noresep
                // ]);
                //     db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                // dd($detailracik);
                foreach ($detailracik as $ddr) {
                    $kode_barang = $ddr->kode_barang;
                    $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kode_barang]);
                    $kode_barang_bpjs = $mt_barang[0]->kode_obat_bpjs;
                    $mt_barang_bpjs = db::select('select * from apt_online_ref_dpho where kodeobat = ?', [$kode_barang_bpjs]);
                    if (count($mt_barang_bpjs) == 0) {
                        $v->hapus_resep([
                            "nosjp" => $sep_apotek,
                            "refasalsjp" => $dataheader['no_sep'],
                            "noresep" => $noresep
                        ]);
                        db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                        throw new \Exception("Master barang dengan nama " . $mt_barang[0]->nama_barang . " didalam komponen racikan belum mempunyai kode bpjs !");
                    }
                    $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                    $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                    $dosis     = (float) ($a['signa2'] ?? 1);     // Misal: 1
                    $pemakaianSehari = $frekuensi * $dosis;
                    if ($pemakaianSehari > 0) {
                        // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                        $jumlahHari = $totalObat / $pemakaianSehari;
                    } else {
                        $jumlahHari = 0;
                    }
                    $data_detail_obat_bpjs =
                        [
                            "NOSJP" => $sep_apotek,
                            "NORESEP" => $noresep,
                            "JNSROBT" => 'R.01',
                            "KDOBT" => $kode_barang_bpjs,
                            "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                            "SIGNA1OBT" => $a['signa1'],
                            "SIGNA2OBT" => $a['signa2'],
                            "PERMINTAAN" => $ddr->qty_barang,
                            "JMLOBT" => $a['qtyobat'],
                            "JHO" => $jumlahHari,
                            "CatKhsObt" => $a['catatan']
                        ];
                    // $save_dtail = [
                    //     "NOSJP" => $sep_apotek,
                    //     "NORESEP" => $noresep,
                    //     "KDOBT" => $kode_barang_bpjs,
                    //     "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    //     "SIGNA1OBT" => $a['signa1'],
                    //     "SIGNA2OBT" => $a['signa2'],
                    //     "JMLOBT" => $totalObat,
                    //     "JHO" => $a['jumlahhari'],
                    //     "CatKhsObt" => 'RACIKAN' . $a['catatan'],
                    //     "id_resep_header" => $header_bpjs
                    // ];
                    // $detail = db::connection('mysql7')->table('resep_detail_bpjs')->insertGetId($save_dtail);
                    $response_data_obat = $v->save_racikan($data_detail_obat_bpjs);
                    if ($response_data_obat->metaData->code == 200) {
                    } else {
                        $v->hapus_resep([
                            "nosjp" => $sep_apotek,
                            "refasalsjp" => $dataheader['no_sep'],
                            "noresep" => $noresep
                        ]);
                        db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                        throw new \Exception($response_data_obat->metaData->message);
                    }
                }
            }
        }
    }
    public function prosesResepObatPRB($dataobat, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader)
    {
        $r = DB::connection('mysql7')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit_pelayanan')");
        $PENJAMIN = $data_kunjungan[0]->kode_penjamin;
        $kode_kunjungan = $data_kunjungan[0]->kode_kunjungan;
        $unit = DB::select('select * from mt_unit where kode_unit =?', [$kode_unit_pelayanan]);
        $jsf = DB::select('select * from mt_jasa_farmasi');
        if ($PENJAMIN == 'P01') {
            $kat_resep = 'Resep Tunai';
            $tipe_tx = '1';
        } else {
            $kat_resep = 'Resep Kredit';
            $tipe_tx = '2';
        }
        $kode_layanan_header = $r[0]->no_trx_layanan ?? "";
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
            DB::connection('mysql7')->insert(
                'INSERT INTO mt_nomor_trx (tgl, no_trx_layanan, unit) VALUES (?, ?, ?)',
                [date('Y-m-d H:i:s'), $kode_layanan_header, $kode_unit_pelayanan]
            );
        }
        $cek_resep_ke = DB::connection('mysql7')->select('select id from ts_layanan_header where kode_kunjungan = ? and kode_unit = ? and status_layanan != 3', [$kode_kunjungan, $kode_unit_pelayanan]);
        $urutan = count($cek_resep_ke) + 1;
        $data_layanan_header = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $kode_kunjungan,
            'kode_unit' => auth()->user()->unit,
            'kode_tipe_transaksi' => $tipe_tx,
            'pic' => auth()->user()->id,
            'status_layanan' => '3',
            'keterangan' => 'Resep Ke :' . $urutan,
            'total_layanan' => '0',
            'kode_penjaminx' => $data_kunjungan[0]->kode_penjamin,
            'tagihan_pribadi' => 0,
            'tagihan_penjamin' => 0,
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $data_kunjungan[0]->kode_unit . ' | ' . $data_kunjungan[0]->nama_unit,
            'diagnosa' => $data_kunjungan[0]->diagx,
        ];
        $idBaru = DB::connection('mysql7')->table('ts_layanan_header')->insertGetId($data_layanan_header);
        $now = $this->get_now();
        $totalheader = 0;
        $status_iter = 0;
        $jumlah_iter = 0;
        foreach ($dataobat as $a) {
            $kode_detail_obat = $this->createLayanandetail();
            if ($a['jenis_resep'] != 'Racikan') {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang']]);
                if (empty($mt_barang)) {
                    throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                }

                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);

                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }


                $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                    ->where('kode_unit', auth()->user()->unit)
                    ->where('kode_barang', $a['kode_barang'])
                    ->orderBy('no', 'desc')
                    ->value('stok_current');
                if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                    $stokTersedia = $stokTerakhir ?? 0;
                    $namaBarang   = $mt_barang[0]->nama_barang;
                    throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                }
                $total      = $mt_barang[0]->harga_jual * $totalObat;
                $diskon     = 0;
                $hitung     = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total;
                } else {
                    $tagihan_pribadi = $total;
                    $tagihan_penjamin = 0;
                }
                $aturan_pakai = $a['signa1'] . ' x ' . $a['signa2'] . ' | ' . $a['catatan'];
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $mt_barang[0]->harga_jual,
                    'jumlah_layanan' => $totalObat,
                    'total_layanan' => $total,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $grandtotal,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $a['kode_barang'],
                    'aturan_pakai' => $aturan_pakai,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => $mt_barang[0]->satuan,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                $ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat,
                    'tgl_stok' => $now,
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang'],
                    'stok_last' => $stokTerakhir,
                    'stok_out' => $totalObat,
                    'stok_current' => $stokTerakhir - $totalObat,
                    'harga_beli' => $mt_barang[0]->hna_history,
                    'inputby' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                ];
                DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader += $grandtotal;
            } else {
                $kode_racikan = $a['kode_barang'];
                $get_detail_racikan = db::select('select * from template_racikan_detail where id_header = ?', [$kode_racikan]);
                $racikanheader = db::select('select * from template_racikan_header where id =?', [$a['kode_barang']]);
                if ($racikanheader[0]->sediaan == 1) {
                    $kemasan = 'KAPSUL';
                    $tiperacik = 'NS';
                    $harga = '700';
                } elseif ($racikanheader[0]->sediaan == 2) {
                    $kemasan = 'KERTAS';
                    $tiperacik = 'NS';
                    $harga = '700';
                } else {
                    $kemasan = 'POT SALEP';
                    $tiperacik = 'S';
                    $harga = 10000;
                }
                $kode_racik = $this->get_kode_racik();
                $data_mt_racikan_header = [
                    'kode_racik' => $kode_racik,
                    'tgl_racik' => $this->get_now(),
                    'nama_racik' => $racikanheader[0]->namaracikan,
                    'total_racik' => 0,
                    'tipe_racik' => $tiperacik,
                    'qty_racik' => $racikanheader[0]->qtyracikan,
                    'kemasan' => $kemasan,
                    'hrg_kemasan' => $harga,
                ];
                // dd($data_mt_racikan_header);
                $mt_racikan_header = model_mt_racikan::create($data_mt_racikan_header);
                $total_racik = 0;
                foreach ($get_detail_racikan as $or) {
                    $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$or->kode_barang]);
                    if (empty($mt_barang)) {
                        throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                    }
                    $jumlahHari = $a['jumlahhari'];
                    $totalObat = $or->qty_barang;
                    $frekuensi  = $a['signa1'];
                    $dosis      = $a['jumlahobat'];
                    // $totalObat  = $jumlahHari * ($frekuensi * $dosis);
                    $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                        ->where('kode_unit', auth()->user()->unit)
                        ->where('kode_barang', $or->kode_barang)
                        ->orderBy('no', 'desc')
                        ->value('stok_current');
                    if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                        $stokTersedia = $stokTerakhir ?? 0;
                        $namaBarang   = $mt_barang[0]->nama_barang;
                        throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                    }
                    $totalbarang = $mt_barang[0]->harga_jual + $or->qty_barang;
                    $tt = $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $mt_racikan_detail_1 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => $or->kode_barang,
                        'qty_barang' => $or->qty_barang,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'harga_satuan_barang' => $mt_barang[0]->harga_jual,
                        'subtotal_barang' => $totalbarang,
                        'grantotal_barang' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => $or->qty_barang,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_1);
                    $ti_kartu_stok = [
                        'no_dokumen' => $kode_layanan_header,
                        'no_dokumen_detail' => $kode_detail_obat,
                        'tgl_stok' => $now,
                        'kode_unit' => auth()->user()->unit,
                        'kode_barang' => $or->kode_barang,
                        'stok_last' => $stokTerakhir,
                        'stok_out' => $totalObat,
                        'stok_current' => $stokTerakhir - $totalObat,
                        'harga_beli' => $mt_barang[0]->hna_history,
                        'inputby' => auth()->user()->id,
                        'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                    ];
                    DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                    $mt_racikan_detail_2 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => 'TX23513',
                        'qty_barang' => 1,
                        'satuan_barang' => '-',
                        'harga_satuan_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'subtotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'grantotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => 1,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_2);
                    $total_racik = $total_racik + $tt;
                }
                model_mt_racikan::where('id', $mt_racikan_header->id)->update(['total_racik' => $total_racik]);
                $kode_detail_obat = $this->createLayanandetail();
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total_racik;
                } else {
                    $tagihan_pribadi = $total_racik;
                    $tagihan_penjamin = 0;
                }
                $grandtotal = $total_racik;
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $total_racik,
                    'jumlah_layanan' =>  $a['qtyobat'],
                    'total_layanan' => $total_racik,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $total_racik,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $kode_racik,
                    'aturan_pakai' => $a['signa1'] . ' / ' . $a['signa2'] . ' / ' . $a['catatan'],
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tipe_anestesi' => 80,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' =>  $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($tiperacik == 'NS') {
                    $HARGA = $jsf[0]->jasa_racikan_powder;
                    $jumlahl = $a['qtyobat'] * $HARGA;
                    $jumlah = $a['qtyobat'];
                } else {
                    $HARGA = $jsf[0]->jasa_racikan_salep;
                    $jumlah = 1;
                    $jumlahl = $HARGA;
                }
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jumlahl;
                } else {
                    $tagihan_pribadi_js = $jumlahl;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $HARGA,
                    'jumlah_layanan' => $jumlah,
                    'total_layanan' => $jumlahl,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jumlahl,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => 80,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader = $totalheader + $grandtotal;
            }
            if ($a['iterasi'] == 1) {
                $status_iter = 1;
                if ($jumlah_iter == 0) {
                    $jumlah_iter = $a['jlh_iterasi'];
                }
            }
        }
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagian_penjamin_head = $jsf[0]->jasa_baca;
            $tagian_pribadi_head = 0;
        } else {
            $tagian_penjamin_head = 0;
            $tagian_pribadi_head = $jsf[0]->jasa_baca;
        }
        $ts_layanan_detail3 = [
            'id_layanan_detail' => $this->createLayanandetail(),
            'kode_layanan_header' => $kode_layanan_header,
            'kode_tarif_detail' => 'TX23523',
            'total_tarif' => $jsf[0]->jasa_baca,
            'diskon_layanan' => '0',
            'jumlah_layanan' => 1,
            'total_layanan' => $jsf[0]->jasa_baca,
            'grantotal_layanan' => $jsf[0]->jasa_baca,
            'status_layanan_detail' => 'OPN',
            'tgl_layanan_detail' => $now,
            'kategori_resep' => $kat_resep,
            'satuan_barang' => '-',
            'tagihan_pribadi' => $tagian_pribadi_head,
            'tagihan_penjamin' => $tagian_penjamin_head,
            'tipe_anestesi' => $tipe_anestesi,
            'tgl_layanan_detail_2' => $now,
            'row_id_header' => $idBaru,
        ];
        DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail3);
        $totalheader += $jsf[0]->jasa_baca;
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagihan_penjamin_header = $totalheader;
            $tagihan_pribadi_header = '0';
            $status_layanan = 2;
        } else {
            $tagihan_penjamin_header = '0';
            $tagihan_pribadi_header = $totalheader;
            $status_layanan = 1;
        }
        DB::connection('mysql7')->table('ts_layanan_header')
            ->where('id', $idBaru)
            ->update([
                'status_layanan' => $status_layanan,
                'total_layanan' => $totalheader,
                'tagihan_penjamin' => $tagihan_penjamin_header,
                'tagihan_pribadi' => $tagihan_pribadi_header
            ]);
        $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [$data_kunjungan[0]->kode_unit]);
        $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [$data_kunjungan[0]->kode_paramedis]);
        $noresep = $this->get_no_resep($data_kunjungan[0]->kode_kunjungan);
        $v = new MODEL_APOTEK_ONLINE();
        $header_resep_bpjs = [
            "TGLSJP" =>  $dataheader['tgl_resep'] . " 00:00:00",
            "REFASALSJP" => $dataheader['no_sep'],
            "POLIRSP" => $mt_unit[0]->KDPOLI,
            "KDJNSOBAT" => "1",
            "NORESEP" => $noresep,
            "IDUSERSJP" => 'rswld',
            "TGLRSP" => $dataheader['tgl_resep'] . " 00:00:00",
            "TGLPELRSP" => $dataheader['tgl_pel_resep'] . " 00:00:00",
            "KdDokter" => $mt_paramedis[0]->kode_dokter_jkn,
            "iterasi" => $jumlah_iter
        ];
        $header_resep_bpjs_2 = [
            "TGLSJP" =>  $dataheader['tgl_resep'] . " 00:00:00",
            "REFASALSJP" => $dataheader['no_sep'],
            "POLIRSP" => $mt_unit[0]->KDPOLI,
            "KDJNSOBAT" => "1",
            "NORESEP" => $noresep,
            "IDUSERSJP" => auth()->user()->id,
            "TGLRSP" => $dataheader['tgl_resep'] . " 00:00:00",
            "TGLPELRSP" => $dataheader['tgl_pel_resep'] . " 00:00:00",
            "KdDokter" => $mt_paramedis[0]->kode_dokter_jkn,
            "iterasi" => $jumlah_iter,
            'kode_kunjungan' => $data_kunjungan[0]->kode_kunjungan,
            'id_layanan_header' => $idBaru,
            'kode_layanan_header' => $kode_layanan_header,
        ];
        $header_bpjs = db::connection('mysql7')->table('resep_header_bpjs')->insertGetId($header_resep_bpjs_2);
        $response_data = $v->simpan_resep($header_resep_bpjs);
        if ($response_data->metaData->code == 200) {
            $sep_apotek = $response_data->response->noApotik;
            $data_update = [
                'Sepapotek' => $response_data->response->noApotik,
                'tglentry' => $response_data->response->tglEntry,
                'Bridging' => 'TERKIRIM',
            ];
            db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update($data_update);
        } else {
            throw new \Exception("Gagal kirim header resep Kronis ke BPJS: " . $response_data->metaData->message);
        }
        foreach ($dataobat as $a) {
            if ($a['jenis_resep'] == 'NonRacikan') {
                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);

                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }

                $kode_barang = $a['kode_barang'];
                $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kode_barang]);
                $kode_barang_bpjs = $mt_barang[0]->kode_obat_bpjs;
                $mt_barang_bpjs = db::select('select * from apt_online_ref_dpho where kodeobat = ?', [$kode_barang_bpjs]);

                if (count($mt_barang_bpjs) == 0) {
                    $v->hapus_resep([
                        "nosjp" => $sep_apotek,
                        "refasalsjp" => $dataheader['no_sep'],
                        "noresep" => $noresep
                    ]);
                    db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                    throw new \Exception("Master barang dengan nama " . $mt_barang[0]->nama_barang . " belum mempunyai kode bpjs !");
                }
                $data_detail_obat_bpjs =    [
                    "NOSJP" => $sep_apotek,
                    "NORESEP" => $noresep,
                    "KDOBT" => $kode_barang_bpjs,
                    "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    "SIGNA1OBT" => $a['signa1'],
                    "SIGNA2OBT" => $a['signa2'],
                    "JMLOBT" => $totalObat,
                    "JHO" => $jumlahHari,
                    "CatKhsObt" => $a['catatan']
                ];
                $save_dtail = [
                    "NOSJP" => $sep_apotek,
                    "NORESEP" => $noresep,
                    "KDOBT" => $kode_barang_bpjs,
                    "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    "SIGNA1OBT" => $a['signa1'],
                    "SIGNA2OBT" => $a['signa2'],
                    "JMLOBT" => $totalObat,
                    "JHO" => $jumlahHari,
                    "CatKhsObt" => $a['catatan'],
                    "id_resep_header" => $header_bpjs
                ];
                $detail = db::connection('mysql7')->table('resep_detail_bpjs')->insertGetId($save_dtail);
                $response_data_obat = $v->save_non_racik($data_detail_obat_bpjs);
                if ($response_data_obat->metaData->code == 200) {
                } else {
                    $v->hapus_resep([
                        "nosjp" => $sep_apotek,
                        "refasalsjp" => $dataheader['no_sep'],
                        "noresep" => $noresep
                    ]);
                    db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                    throw new \Exception($response_data_obat->metaData->message);
                }
            } else {
                $kode_obat = $a['kode_barang'];
                $detailracik = db::select('select * from template_racikan_detail where id_header = ?', [$kode_obat]);
                // $v->hapus_resep([
                //     "nosjp" => $sep_apotek,
                //     "refasalsjp" => $dataheader['no_sep'],
                //     "noresep" => $noresep
                // ]);
                //     db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                // dd($detailracik);
                foreach ($detailracik as $ddr) {
                    $kode_barang = $ddr->kode_barang;
                    $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kode_barang]);
                    $kode_barang_bpjs = $mt_barang[0]->kode_obat_bpjs;
                    $mt_barang_bpjs = db::select('select * from apt_online_ref_dpho where kodeobat = ?', [$kode_barang_bpjs]);
                    if (count($mt_barang_bpjs) == 0) {
                        $v->hapus_resep([
                            "nosjp" => $sep_apotek,
                            "refasalsjp" => $dataheader['no_sep'],
                            "noresep" => $noresep
                        ]);
                        db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                        throw new \Exception("Master barang dengan nama " . $mt_barang[0]->nama_barang . " didalam komponen racikan belum mempunyai kode bpjs !");
                    }
                    $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                    $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                    $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                    $pemakaianSehari = $frekuensi * $dosis;
                    if ($pemakaianSehari > 0) {
                        // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                        $jumlahHari = $totalObat / $pemakaianSehari;
                    } else {
                        $jumlahHari = 0;
                    }
                    $data_detail_obat_bpjs =
                        [
                            "NOSJP" => $sep_apotek,
                            "NORESEP" => $noresep,
                            "JNSROBT" => 'R.01',
                            "KDOBT" => $kode_barang_bpjs,
                            "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                            "SIGNA1OBT" => $a['signa1'],
                            "SIGNA2OBT" => $a['signa2'],
                            "PERMINTAAN" => $ddr->qty_barang,
                            "JMLOBT" => $ddr->qty_barang,
                            "JHO" => $jumlahHari,
                            "CatKhsObt" => $a['catatan']
                        ];
                    // $save_dtail = [
                    //     "NOSJP" => $sep_apotek,
                    //     "NORESEP" => $noresep,
                    //     "KDOBT" => $kode_barang_bpjs,
                    //     "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    //     "SIGNA1OBT" => $a['signa1'],
                    //     "SIGNA2OBT" => $a['signa2'],
                    //     "JMLOBT" => $totalObat,
                    //     "JHO" => $a['jumlahhari'],
                    //     "CatKhsObt" => 'RACIKAN' . $a['catatan'],
                    //     "id_resep_header" => $header_bpjs
                    // ];
                    // $detail = db::connection('mysql7')->table('resep_detail_bpjs')->insertGetId($save_dtail);
                    $response_data_obat = $v->save_racikan($data_detail_obat_bpjs);
                    if ($response_data_obat->metaData->code == 200) {
                    } else {
                        $v->hapus_resep([
                            "nosjp" => $sep_apotek,
                            "refasalsjp" => $dataheader['no_sep'],
                            "noresep" => $noresep
                        ]);
                        db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                        throw new \Exception($response_data_obat->metaData->message);
                    }
                }
            }
        }
    }
    public function prosesResepObatKemo($dataobat, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader)
    {
        $r = DB::connection('mysql7')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit_pelayanan')");
        $PENJAMIN = $data_kunjungan[0]->kode_penjamin;
        $kode_kunjungan = $data_kunjungan[0]->kode_kunjungan;
        $unit = DB::select('select * from mt_unit where kode_unit =?', [$kode_unit_pelayanan]);
        $jsf = DB::select('select * from mt_jasa_farmasi');
        if ($PENJAMIN == 'P01') {
            $kat_resep = 'Resep Tunai';
            $tipe_tx = '1';
        } else {
            $kat_resep = 'Resep Kredit';
            $tipe_tx = '2';
        }
        $kode_layanan_header = $r[0]->no_trx_layanan ?? "";
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
            DB::connection('mysql7')->insert(
                'INSERT INTO mt_nomor_trx (tgl, no_trx_layanan, unit) VALUES (?, ?, ?)',
                [date('Y-m-d H:i:s'), $kode_layanan_header, $kode_unit_pelayanan]
            );
        }
        $cek_resep_ke = DB::connection('mysql7')->select('select id from ts_layanan_header where kode_kunjungan = ? and kode_unit = ? and status_layanan != 3', [$kode_kunjungan, $kode_unit_pelayanan]);
        $urutan = count($cek_resep_ke) + 1;
        $data_layanan_header = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $kode_kunjungan,
            'kode_unit' => auth()->user()->unit,
            'kode_tipe_transaksi' => $tipe_tx,
            'pic' => auth()->user()->id,
            'status_layanan' => '3',
            'keterangan' => 'Resep Ke :' . $urutan,
            'total_layanan' => '0',
            'kode_penjaminx' => $data_kunjungan[0]->kode_penjamin,
            'tagihan_pribadi' => 0,
            'tagihan_penjamin' => 0,
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $data_kunjungan[0]->kode_unit . ' | ' . $data_kunjungan[0]->nama_unit,
            'diagnosa' => $data_kunjungan[0]->diagx,
        ];
        $idBaru = DB::connection('mysql7')->table('ts_layanan_header')->insertGetId($data_layanan_header);
        $now = $this->get_now();
        $totalheader = 0;
        $status_iter = 0;
        $jumlah_iter = 0;
        foreach ($dataobat as $a) {
            $kode_detail_obat = $this->createLayanandetail();
            if ($a['jenis_resep'] != 'Racikan') {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang']]);
                if (empty($mt_barang)) {
                    throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                }

                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);

                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }


                $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                    ->where('kode_unit', auth()->user()->unit)
                    ->where('kode_barang', $a['kode_barang'])
                    ->orderBy('no', 'desc')
                    ->value('stok_current');
                if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                    $stokTersedia = $stokTerakhir ?? 0;
                    $namaBarang   = $mt_barang[0]->nama_barang;
                    throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                }
                $total      = $mt_barang[0]->harga_jual * $totalObat;
                $diskon     = 0;
                $hitung     = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total;
                } else {
                    $tagihan_pribadi = $total;
                    $tagihan_penjamin = 0;
                }
                $aturan_pakai = $a['signa1'] . ' x ' . $a['signa2'] . ' | ' . $a['catatan'];
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $mt_barang[0]->harga_jual,
                    'jumlah_layanan' => $totalObat,
                    'total_layanan' => $total,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $grandtotal,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $a['kode_barang'],
                    'aturan_pakai' => $aturan_pakai,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => $mt_barang[0]->satuan,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                $ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat,
                    'tgl_stok' => $now,
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang'],
                    'stok_last' => $stokTerakhir,
                    'stok_out' => $totalObat,
                    'stok_current' => $stokTerakhir - $totalObat,
                    'harga_beli' => $mt_barang[0]->hna_history,
                    'inputby' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                ];
                DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader += $grandtotal;
            } else {
                $kode_racikan = $a['kode_barang'];
                $get_detail_racikan = db::select('select * from template_racikan_detail where id_header = ?', [$kode_racikan]);
                $racikanheader = db::select('select * from template_racikan_header where id =?', [$a['kode_barang']]);
                if ($racikanheader[0]->sediaan == 1) {
                    $kemasan = 'KAPSUL';
                    $tiperacik = 'NS';
                    $harga = '700';
                } elseif ($racikanheader[0]->sediaan == 2) {
                    $kemasan = 'KERTAS';
                    $tiperacik = 'NS';
                    $harga = '700';
                } else {
                    $kemasan = 'POT SALEP';
                    $tiperacik = 'S';
                    $harga = 10000;
                }
                $kode_racik = $this->get_kode_racik();
                $data_mt_racikan_header = [
                    'kode_racik' => $kode_racik,
                    'tgl_racik' => $this->get_now(),
                    'nama_racik' => $racikanheader[0]->namaracikan,
                    'total_racik' => 0,
                    'tipe_racik' => $tiperacik,
                    'qty_racik' => $racikanheader[0]->qtyracikan,
                    'kemasan' => $kemasan,
                    'hrg_kemasan' => $harga,
                ];
                // dd($data_mt_racikan_header);
                $mt_racikan_header = model_mt_racikan::create($data_mt_racikan_header);
                $total_racik = 0;
                foreach ($get_detail_racikan as $or) {
                    $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$or->kode_barang]);
                    if (empty($mt_barang)) {
                        throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                    }
                    $jumlahHari = $a['jumlahhari'];
                    $totalObat = $or->qty_barang;
                    $frekuensi  = $a['signa1'];
                    $dosis      = $a['jumlahobat'];
                    // $totalObat  = $jumlahHari * ($frekuensi * $dosis);
                    $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                        ->where('kode_unit', auth()->user()->unit)
                        ->where('kode_barang', $or->kode_barang)
                        ->orderBy('no', 'desc')
                        ->value('stok_current');
                    if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                        $stokTersedia = $stokTerakhir ?? 0;
                        $namaBarang   = $mt_barang[0]->nama_barang;
                        throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                    }
                    $totalbarang = $mt_barang[0]->harga_jual + $or->qty_barang;
                    $tt = $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $mt_racikan_detail_1 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => $or->kode_barang,
                        'qty_barang' => $or->qty_barang,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'harga_satuan_barang' => $mt_barang[0]->harga_jual,
                        'subtotal_barang' => $totalbarang,
                        'grantotal_barang' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => $or->qty_barang,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_1);
                    $ti_kartu_stok = [
                        'no_dokumen' => $kode_layanan_header,
                        'no_dokumen_detail' => $kode_detail_obat,
                        'tgl_stok' => $now,
                        'kode_unit' => auth()->user()->unit,
                        'kode_barang' => $or->kode_barang,
                        'stok_last' => $stokTerakhir,
                        'stok_out' => $totalObat,
                        'stok_current' => $stokTerakhir - $totalObat,
                        'harga_beli' => $mt_barang[0]->hna_history,
                        'inputby' => auth()->user()->id,
                        'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                    ];
                    DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                    $mt_racikan_detail_2 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => 'TX23513',
                        'qty_barang' => 1,
                        'satuan_barang' => '-',
                        'harga_satuan_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'subtotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'grantotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => 1,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_2);
                    $total_racik = $total_racik + $tt;
                }
                model_mt_racikan::where('id', $mt_racikan_header->id)->update(['total_racik' => $total_racik]);
                $kode_detail_obat = $this->createLayanandetail();
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total_racik;
                } else {
                    $tagihan_pribadi = $total_racik;
                    $tagihan_penjamin = 0;
                }
                $grandtotal = $total_racik;
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $total_racik,
                    'jumlah_layanan' =>  $a['qtyobat'],
                    'total_layanan' => $total_racik,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $total_racik,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $kode_racik,
                    'aturan_pakai' => $a['signa1'] . ' / ' . $a['signa2'] . ' / ' . $a['catatan'],
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tipe_anestesi' => 80,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' =>  $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($tiperacik == 'NS') {
                    $HARGA = $jsf[0]->jasa_racikan_powder;
                    $jumlahl = $a['qtyobat'] * $HARGA;
                    $jumlah = $a['qtyobat'];
                } else {
                    $HARGA = $jsf[0]->jasa_racikan_salep;
                    $jumlah = 1;
                    $jumlahl = $HARGA;
                }
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jumlahl;
                } else {
                    $tagihan_pribadi_js = $jumlahl;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $HARGA,
                    'jumlah_layanan' => $jumlah,
                    'total_layanan' => $jumlahl,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jumlahl,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => 80,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader = $totalheader + $grandtotal;
            }
            if ($a['iterasi'] == 1) {
                $status_iter = 1;
                if ($jumlah_iter == 0) {
                    $jumlah_iter = $a['jlh_iterasi'];
                }
            }
        }
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagian_penjamin_head = $jsf[0]->jasa_baca;
            $tagian_pribadi_head = 0;
        } else {
            $tagian_penjamin_head = 0;
            $tagian_pribadi_head = $jsf[0]->jasa_baca;
        }
        $ts_layanan_detail3 = [
            'id_layanan_detail' => $this->createLayanandetail(),
            'kode_layanan_header' => $kode_layanan_header,
            'kode_tarif_detail' => 'TX23523',
            'total_tarif' => $jsf[0]->jasa_baca,
            'diskon_layanan' => '0',
            'jumlah_layanan' => 1,
            'total_layanan' => $jsf[0]->jasa_baca,
            'grantotal_layanan' => $jsf[0]->jasa_baca,
            'status_layanan_detail' => 'OPN',
            'tgl_layanan_detail' => $now,
            'kategori_resep' => $kat_resep,
            'satuan_barang' => '-',
            'tagihan_pribadi' => $tagian_pribadi_head,
            'tagihan_penjamin' => $tagian_penjamin_head,
            'tipe_anestesi' => $tipe_anestesi,
            'tgl_layanan_detail_2' => $now,
            'row_id_header' => $idBaru,
        ];
        DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail3);
        $totalheader += $jsf[0]->jasa_baca;
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagihan_penjamin_header = $totalheader;
            $tagihan_pribadi_header = '0';
            $status_layanan = 2;
        } else {
            $tagihan_penjamin_header = '0';
            $tagihan_pribadi_header = $totalheader;
            $status_layanan = 1;
        }
        DB::connection('mysql7')->table('ts_layanan_header')
            ->where('id', $idBaru)
            ->update([
                'status_layanan' => $status_layanan,
                'total_layanan' => $totalheader,
                'tagihan_penjamin' => $tagihan_penjamin_header,
                'tagihan_pribadi' => $tagihan_pribadi_header
            ]);
        $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [$data_kunjungan[0]->kode_unit]);
        $mt_paramedis = db::select('select * from mt_paramedis where kode_paramedis = ?', [$data_kunjungan[0]->kode_paramedis]);
        $noresep = $this->get_no_resep($data_kunjungan[0]->kode_kunjungan);
        $v = new MODEL_APOTEK_ONLINE();
        $header_resep_bpjs = [
            "TGLSJP" =>  $dataheader['tgl_resep'] . " 00:00:00",
            "REFASALSJP" => $dataheader['no_sep'],
            "POLIRSP" => $mt_unit[0]->KDPOLI,
            "KDJNSOBAT" => "3",
            "NORESEP" => $noresep,
            "IDUSERSJP" => 'rswld',
            "TGLRSP" => $dataheader['tgl_resep'] . " 00:00:00",
            "TGLPELRSP" => $dataheader['tgl_pel_resep'] . " 00:00:00",
            "KdDokter" => $mt_paramedis[0]->kode_dokter_jkn,
            "iterasi" => $jumlah_iter
        ];
        $header_resep_bpjs_2 = [
            "TGLSJP" =>  $dataheader['tgl_resep'] . " 00:00:00",
            "REFASALSJP" => $dataheader['no_sep'],
            "POLIRSP" => $mt_unit[0]->KDPOLI,
            "KDJNSOBAT" => "3",
            "NORESEP" => $noresep,
            "IDUSERSJP" => auth()->user()->id,
            "TGLRSP" => $dataheader['tgl_resep'] . " 00:00:00",
            "TGLPELRSP" => $dataheader['tgl_pel_resep'] . " 00:00:00",
            "KdDokter" => $mt_paramedis[0]->kode_dokter_jkn,
            "iterasi" => $jumlah_iter,
            'kode_kunjungan' => $data_kunjungan[0]->kode_kunjungan,
            'id_layanan_header' => $idBaru,
            'kode_layanan_header' => $kode_layanan_header,
        ];
        $header_bpjs = db::connection('mysql7')->table('resep_header_bpjs')->insertGetId($header_resep_bpjs_2);
        $response_data = $v->simpan_resep($header_resep_bpjs);
        if ($response_data->metaData->code == 200) {
            $sep_apotek = $response_data->response->noApotik;
            $data_update = [
                'Sepapotek' => $response_data->response->noApotik,
                'tglentry' => $response_data->response->tglEntry,
                'Bridging' => 'TERKIRIM',
            ];
            db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update($data_update);
        } else {
            throw new \Exception("Gagal kirim header resep Kronis ke BPJS: " . $response_data->metaData->message);
        }
        foreach ($dataobat as $a) {
            if ($a['jenis_resep'] == 'NonRacikan') {
                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);

                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }

                $kode_barang = $a['kode_barang'];
                $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kode_barang]);
                $kode_barang_bpjs = $mt_barang[0]->kode_obat_bpjs;
                $mt_barang_bpjs = db::select('select * from apt_online_ref_dpho where kodeobat = ?', [$kode_barang_bpjs]);

                if (count($mt_barang_bpjs) == 0) {
                    $v->hapus_resep([
                        "nosjp" => $sep_apotek,
                        "refasalsjp" => $dataheader['no_sep'],
                        "noresep" => $noresep
                    ]);
                    db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                    throw new \Exception("Master barang dengan nama " . $mt_barang[0]->nama_barang . " belum mempunyai kode bpjs !");
                }
                $data_detail_obat_bpjs =    [
                    "NOSJP" => $sep_apotek,
                    "NORESEP" => $noresep,
                    "KDOBT" => $kode_barang_bpjs,
                    "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    "SIGNA1OBT" => $a['signa1'],
                    "SIGNA2OBT" => $a['signa2'],
                    "JMLOBT" => $totalObat,
                    "JHO" => $jumlahHari,
                    "CatKhsObt" => $a['catatan']
                ];
                $save_dtail = [
                    "NOSJP" => $sep_apotek,
                    "NORESEP" => $noresep,
                    "KDOBT" => $kode_barang_bpjs,
                    "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    "SIGNA1OBT" => $a['signa1'],
                    "SIGNA2OBT" => $a['signa2'],
                    "JMLOBT" => $totalObat,
                    "JHO" => $jumlahHari,
                    "CatKhsObt" => $a['catatan'],
                    "id_resep_header" => $header_bpjs
                ];
                $detail = db::connection('mysql7')->table('resep_detail_bpjs')->insertGetId($save_dtail);
                $response_data_obat = $v->save_non_racik($data_detail_obat_bpjs);
                if ($response_data_obat->metaData->code == 200) {
                } else {
                    $v->hapus_resep([
                        "nosjp" => $sep_apotek,
                        "refasalsjp" => $dataheader['no_sep'],
                        "noresep" => $noresep
                    ]);
                    db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                    throw new \Exception($response_data_obat->metaData->message);
                }
            } else {
                $kode_obat = $a['kode_barang'];
                $detailracik = db::select('select * from template_racikan_detail where id_header = ?', [$kode_obat]);
                // $v->hapus_resep([
                //     "nosjp" => $sep_apotek,
                //     "refasalsjp" => $dataheader['no_sep'],
                //     "noresep" => $noresep
                // ]);
                //     db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                // dd($detailracik);
                foreach ($detailracik as $ddr) {
                    $kode_barang = $ddr->kode_barang;
                    $mt_barang = db::select('select * from mt_barang where kode_barang = ?', [$kode_barang]);
                    $kode_barang_bpjs = $mt_barang[0]->kode_obat_bpjs;
                    $mt_barang_bpjs = db::select('select * from apt_online_ref_dpho where kodeobat = ?', [$kode_barang_bpjs]);
                    if (count($mt_barang_bpjs) == 0) {
                        $v->hapus_resep([
                            "nosjp" => $sep_apotek,
                            "refasalsjp" => $dataheader['no_sep'],
                            "noresep" => $noresep
                        ]);
                        db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                        throw new \Exception("Master barang dengan nama " . $mt_barang[0]->nama_barang . " didalam komponen racikan belum mempunyai kode bpjs !");
                    }
                    $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                    $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                    $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                    $pemakaianSehari = $frekuensi * $dosis;
                    if ($pemakaianSehari > 0) {
                        // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                        $jumlahHari = $totalObat / $pemakaianSehari;
                    } else {
                        $jumlahHari = 0;
                    }
                    $data_detail_obat_bpjs =
                        [
                            "NOSJP" => $sep_apotek,
                            "NORESEP" => $noresep,
                            "JNSROBT" => 'R.01',
                            "KDOBT" => $kode_barang_bpjs,
                            "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                            "SIGNA1OBT" => $a['signa1'],
                            "SIGNA2OBT" => $a['signa2'],
                            "PERMINTAAN" => $ddr->qty_barang,
                            "JMLOBT" => $ddr->qty_barang,
                            "JHO" => $jumlahHari,
                            "CatKhsObt" => $a['catatan']
                        ];
                    // $save_dtail = [
                    //     "NOSJP" => $sep_apotek,
                    //     "NORESEP" => $noresep,
                    //     "KDOBT" => $kode_barang_bpjs,
                    //     "NMOBAT" => $mt_barang_bpjs[0]->namaobat,
                    //     "SIGNA1OBT" => $a['signa1'],
                    //     "SIGNA2OBT" => $a['signa2'],
                    //     "JMLOBT" => $totalObat,
                    //     "JHO" => $a['jumlahhari'],
                    //     "CatKhsObt" => 'RACIKAN' . $a['catatan'],
                    //     "id_resep_header" => $header_bpjs
                    // ];
                    // $detail = db::connection('mysql7')->table('resep_detail_bpjs')->insertGetId($save_dtail);
                    $response_data_obat = $v->save_racikan($data_detail_obat_bpjs);
                    if ($response_data_obat->metaData->code == 200) {
                    } else {
                        $v->hapus_resep([
                            "nosjp" => $sep_apotek,
                            "refasalsjp" => $dataheader['no_sep'],
                            "noresep" => $noresep
                        ]);
                        db::connection('mysql7')->table('resep_header_bpjs')->where('id', $header_bpjs)->update(['Bridging' => 'Batal']);
                        throw new \Exception($response_data_obat->metaData->message);
                    }
                }
            }
        }
    }
    public function prosesResepObat($dataobat, $data_kunjungan, $kode_unit_pelayanan, $tipe_anestesi, $dataheader)
    {
        $r = DB::connection('mysql7')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit_pelayanan')");
        $PENJAMIN = $data_kunjungan[0]->kode_penjamin;
        $kode_kunjungan = $data_kunjungan[0]->kode_kunjungan;
        $unit = DB::select('select * from mt_unit where kode_unit =?', [$kode_unit_pelayanan]);
        $jsf = DB::select('select * from mt_jasa_farmasi');
        if ($PENJAMIN == 'P01') {
            $kat_resep = 'Resep Tunai';
            $tipe_tx = '1';
        } else {
            $kat_resep = 'Resep Kredit';
            $tipe_tx = '2';
        }
        $kode_layanan_header = $r[0]->no_trx_layanan ?? "";
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
            DB::connection('mysql7')->insert(
                'INSERT INTO mt_nomor_trx (tgl, no_trx_layanan, unit) VALUES (?, ?, ?)',
                [date('Y-m-d H:i:s'), $kode_layanan_header, $kode_unit_pelayanan]
            );
        }
        $cek_resep_ke = DB::connection('mysql7')->select('select id from ts_layanan_header where kode_kunjungan = ? and kode_unit = ? and status_layanan != 3', [$kode_kunjungan, $kode_unit_pelayanan]);
        $urutan = count($cek_resep_ke) + 1;
        $data_layanan_header = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $kode_kunjungan,
            'kode_unit' => auth()->user()->unit,
            'kode_tipe_transaksi' => $tipe_tx,
            'pic' => auth()->user()->id,
            'status_layanan' => '3',
            'keterangan' => 'Resep Ke :' . $urutan,
            'total_layanan' => '0',
            'kode_penjaminx' => $data_kunjungan[0]->kode_penjamin,
            'tagihan_pribadi' => 0,
            'tagihan_penjamin' => 0,
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $data_kunjungan[0]->kode_unit . ' | ' . $data_kunjungan[0]->nama_unit,
            'diagnosa' => $data_kunjungan[0]->diagx,
        ];
        $idBaru = DB::connection('mysql7')->table('ts_layanan_header')->insertGetId($data_layanan_header);
        $now = $this->get_now();
        $totalheader = 0;
        $status_iter = 0;
        $jumlah_iter = 0;
        foreach ($dataobat as $a) {
            $kode_detail_obat = $this->createLayanandetail();
            if ($a['jenis_resep'] != 'Racikan') {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang']]);
                if (empty($mt_barang)) {
                    throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                }

                // $jumlahHari = $a['jumlahhari'];
                // $frekuensi  = $a['signa1'];
                // $dosis      = $a['jumlahobat'];
                // $totalObat  = $jumlahHari * ($frekuensi * $dosis);

                $totalObat = (float) ($a['qtyobat'] ?? 0); // Misal: 10 tablet
                $frekuensi = (float) ($a['signa1'] ?? 0);          // Misal: 3
                $dosis     = (float) ($a['jumlahobat'] ?? 1);     // Misal: 1
                $pemakaianSehari = $frekuensi * $dosis;
                if ($pemakaianSehari > 0) {
                    // Hasilnya misal 10 / 3 = 3.33 hari (atau gunakan floor/round sesuai kebutuhan)
                    $jumlahHari = $totalObat / $pemakaianSehari;
                } else {
                    $jumlahHari = 0;
                }


                $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                    ->where('kode_unit', auth()->user()->unit)
                    ->where('kode_barang', $a['kode_barang'])
                    ->orderBy('no', 'desc')
                    ->value('stok_current');
                if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                    $stokTersedia = $stokTerakhir ?? 0;
                    $namaBarang   = $mt_barang[0]->nama_barang;
                    throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                }
                $total      = $mt_barang[0]->harga_jual * $totalObat;
                $diskon     = 0;
                $hitung     = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total;
                } else {
                    $tagihan_pribadi = $total;
                    $tagihan_penjamin = 0;
                }
                $aturan_pakai = $a['signa1'] . ' x ' . $a['signa2'] . ' | ' . $a['catatan'];
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $mt_barang[0]->harga_jual,
                    'jumlah_layanan' => $totalObat,
                    'total_layanan' => $total,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $grandtotal,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $a['kode_barang'],
                    'aturan_pakai' => $aturan_pakai,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => $mt_barang[0]->satuan,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                $ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat,
                    'tgl_stok' => $now,
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang'],
                    'stok_last' => $stokTerakhir,
                    'stok_out' => $totalObat,
                    'stok_current' => $stokTerakhir - $totalObat,
                    'harga_beli' => $mt_barang[0]->hna_history,
                    'inputby' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                ];
                DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                } else {
                    $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'jumlah_layanan' => 1,
                    'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => $tipe_anestesi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader += $grandtotal;
            } else {
                $kode_racikan = $a['kode_barang'];
                $get_detail_racikan = db::select('select * from template_racikan_detail where id_header = ?', [$kode_racikan]);
                $racikanheader = db::select('select * from template_racikan_header where id =?', [$a['kode_barang']]);
                if ($racikanheader[0]->sediaan == 1) {
                    $kemasan = 'KAPSUL';
                    $tiperacik = 'NS';
                    $harga = '700';
                } elseif ($racikanheader[0]->sediaan == 2) {
                    $kemasan = 'KERTAS';
                    $tiperacik = 'NS';
                    $harga = '700';
                } else {
                    $kemasan = 'POT SALEP';
                    $tiperacik = 'S';
                    $harga = 10000;
                }
                $kode_racik = $this->get_kode_racik();
                $data_mt_racikan_header = [
                    'kode_racik' => $kode_racik,
                    'tgl_racik' => $this->get_now(),
                    'nama_racik' => $racikanheader[0]->namaracikan,
                    'total_racik' => 0,
                    'tipe_racik' => $tiperacik,
                    'qty_racik' => $racikanheader[0]->qtyracikan,
                    'kemasan' => $kemasan,
                    'hrg_kemasan' => $harga,
                ];
                // dd($data_mt_racikan_header);
                $mt_racikan_header = model_mt_racikan::create($data_mt_racikan_header);
                $total_racik = 0;
                foreach ($get_detail_racikan as $or) {
                    $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$or->kode_barang]);
                    if (empty($mt_barang)) {
                        throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                    }
                    $jumlahHari = $a['jumlahhari'];
                    $totalObat = $or->qty_barang;
                    $frekuensi  = $a['signa1'];
                    $dosis      = $a['jumlahobat'];
                    // $totalObat  = $jumlahHari * ($frekuensi * $dosis);
                    $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
                        ->where('kode_unit', auth()->user()->unit)
                        ->where('kode_barang', $or->kode_barang)
                        ->orderBy('no', 'desc')
                        ->value('stok_current');
                    if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
                        $stokTersedia = $stokTerakhir ?? 0;
                        $namaBarang   = $mt_barang[0]->nama_barang;
                        throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
                    }
                    $totalbarang = $mt_barang[0]->harga_jual + $or->qty_barang;
                    $tt = $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
                    $mt_racikan_detail_1 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => $or->kode_barang,
                        'qty_barang' => $or->qty_barang,
                        'satuan_barang' => $mt_barang[0]->satuan,
                        'harga_satuan_barang' => $mt_barang[0]->harga_jual,
                        'subtotal_barang' => $totalbarang,
                        'grantotal_barang' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $totalbarang + $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => $or->qty_barang,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_1);
                    $ti_kartu_stok = [
                        'no_dokumen' => $kode_layanan_header,
                        'no_dokumen_detail' => $kode_detail_obat,
                        'tgl_stok' => $now,
                        'kode_unit' => auth()->user()->unit,
                        'kode_barang' => $or->kode_barang,
                        'stok_last' => $stokTerakhir,
                        'stok_out' => $totalObat,
                        'stok_current' => $stokTerakhir - $totalObat,
                        'harga_beli' => $mt_barang[0]->hna_history,
                        'inputby' => auth()->user()->id,
                        'keterangan' => $data_kunjungan[0]->no_rm . ' | ' . $data_kunjungan[0]->nama_pasien . ' | ' . $data_kunjungan[0]->alamat_pasien
                    ];
                    DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
                    $mt_racikan_detail_2 = [
                        'kode_racik' => $kode_racik,
                        'kode_barang' => 'TX23513',
                        'qty_barang' => 1,
                        'satuan_barang' => '-',
                        'harga_satuan_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'subtotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'grantotal_barang' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'harga_brg_embalase' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                        'qty_order' => 1,
                    ];
                    $save_mt_racikan_detail_2 = model_mt_racikan_detail::create($mt_racikan_detail_2);
                    $total_racik = $total_racik + $tt;
                }
                model_mt_racikan::where('id', $mt_racikan_header->id)->update(['total_racik' => $total_racik]);
                $kode_detail_obat = $this->createLayanandetail();
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $total_racik;
                } else {
                    $tagihan_pribadi = $total_racik;
                    $tagihan_penjamin = 0;
                }
                $grandtotal = $total_racik;
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => '0',
                    'total_tarif' => $total_racik,
                    'jumlah_layanan' =>  $a['qtyobat'],
                    'total_layanan' => $total_racik,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $total_racik,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kode_barang' => $kode_racik,
                    'aturan_pakai' => $a['signa1'] . ' / ' . $a['signa2'] . ' / ' . $a['catatan'],
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tipe_anestesi' => 80,
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' =>  $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
                if ($tiperacik == 'NS') {
                    $HARGA = $jsf[0]->jasa_racikan_powder;
                    $jumlahl = $a['qtyobat'] * $HARGA;
                    $jumlah = $a['qtyobat'];
                } else {
                    $HARGA = $jsf[0]->jasa_racikan_salep;
                    $jumlah = 1;
                    $jumlahl = $HARGA;
                }
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi_js = 0;
                    $tagihan_penjamin_js = $jumlahl;
                } else {
                    $tagihan_pribadi_js = $jumlahl;
                    $tagihan_penjamin_js = 0;
                }
                $ts_layanan_detail_2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => $HARGA,
                    'jumlah_layanan' => $jumlah,
                    'total_layanan' => $jumlahl,
                    'diskon_layanan' => '0',
                    'grantotal_layanan' => $jumlahl,
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'kategori_resep' => $kat_resep,
                    'satuan_barang' => '-',
                    'tagihan_pribadi' => $tagihan_pribadi_js,
                    'tagihan_penjamin' => $tagihan_penjamin_js,
                    'tipe_anestesi' => 80,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $idBaru,
                ];
                DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
                $totalheader = $totalheader + $grandtotal;
            }
            if ($a['iterasi'] == 1) {
                $status_iter = 1;
                if ($jumlah_iter == 0) {
                    $jumlah_iter = $a['jlh_iterasi'];
                }
            }
        }
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagian_penjamin_head = $jsf[0]->jasa_baca;
            $tagian_pribadi_head = 0;
        } else {
            $tagian_penjamin_head = 0;
            $tagian_pribadi_head = $jsf[0]->jasa_baca;
        }
        $ts_layanan_detail3 = [
            'id_layanan_detail' => $this->createLayanandetail(),
            'kode_layanan_header' => $kode_layanan_header,
            'kode_tarif_detail' => 'TX23523',
            'total_tarif' => $jsf[0]->jasa_baca,
            'diskon_layanan' => '0',
            'jumlah_layanan' => 1,
            'total_layanan' => $jsf[0]->jasa_baca,
            'grantotal_layanan' => $jsf[0]->jasa_baca,
            'status_layanan_detail' => 'OPN',
            'tgl_layanan_detail' => $now,
            'kategori_resep' => $kat_resep,
            'satuan_barang' => '-',
            'tagihan_pribadi' => $tagian_pribadi_head,
            'tagihan_penjamin' => $tagian_penjamin_head,
            'tipe_anestesi' => $tipe_anestesi,
            'tgl_layanan_detail_2' => $now,
            'row_id_header' => $idBaru,
        ];
        DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail3);
        $totalheader += $jsf[0]->jasa_baca;
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagihan_penjamin_header = $totalheader;
            $tagihan_pribadi_header = '0';
            $status_layanan = 2;
        } else {
            $tagihan_penjamin_header = '0';
            $tagihan_pribadi_header = $totalheader;
            $status_layanan = 1;
        }
        DB::connection('mysql7')->table('ts_layanan_header')
            ->where('id', $idBaru)
            ->update([
                'status_layanan' => $status_layanan,
                'total_layanan' => $totalheader,
                'tagihan_penjamin' => $tagihan_penjamin_header,
                'tagihan_pribadi' => $tagihan_pribadi_header
            ]);
    }
    public function createLayanandetail()
    {
        $q = DB::connection('mysql7')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
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
    public function get_no_resep($kode)
    {
        $q = DB::connection('mysql7')->select('SELECT id,NORESEP,RIGHT(NORESEP,4) AS kd_max  FROM resep_header_bpjs
        WHERE kode_kunjungan = ?
        ORDER BY id DESC
        LIMIT 1', [$kode]);
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'R' . $kd;
    }
    public function ambildetaillayanandepo(Request $request)
    {
        $idlayananheader  = $request->idlayananhheader;

        $data_header_resep = db::select('select * from resep_header_bpjs where id_layanan_header = ?', [$idlayananheader]);
        if (count($data_header_resep) > 0) {
            $bridging = '1';
            $sepobat = $data_header_resep[0]->Sepapotek;
            $v = new MODEL_APOTEK_ONLINE();
            $databpjs = $v->daftar_pelayanan_obat($sepobat);
        } else {
            $bridging = '0';
            $databpjs = [];
        }
        $data = DB::table('ts_layanan_detail as a')
            ->select([
                'b.nama_barang',
                'a.jumlah_layanan',
                'e.nama_racik',
                'a.grantotal_layanan',
                'a.tagihan_penjamin',
                'a.aturan_pakai',
                'a.kode_barang',
                'c.Bridging',
                'd.NMOBAT',
                'c.NORESEP',
                'd.SIGNA1OBT',
                'd.SIGNA2OBT',
                'd.JHO',
                'd.JMLOBT',
            ])
            ->leftjoin('mt_barang as b', 'a.kode_barang', '=', 'b.kode_barang')
            ->leftJoin('resep_header_bpjs as c', 'a.row_id_header', '=', 'c.id_layanan_header')
            ->leftJoin('resep_detail_bpjs as d', 'c.id', '=', 'd.id_resep_header')
            ->leftJoin('mt_racikan as e', 'a.kode_barang', '=', 'e.kode_racik')
            ->where('a.row_id_header', $idlayananheader)
            ->whereNotNull('a.kode_barang')
            ->get();
        // dd($data);
        return view('new_farmasi.tabel_detail_layanan', compact([
            'data',
            'databpjs',
            'bridging'
        ]));
    }
    public function ambildatastokdepokomponen(Request $request)
    {
        $keyword = $request->input('keyword');
        $kodeUnitFilter = auth()->user()->unit; // Sesuaikan logika unit Anda
        $subQuery = DB::table('ti_kartu_stok')
            ->select('kode_barang', 'kode_unit', DB::raw('MAX(NO) as max_id'))
            ->where('kode_unit', $kodeUnitFilter)
            // ->where('stok_current', '<>', 0)
            ->groupBy('kode_barang', 'kode_unit');

        $query = DB::table('ti_kartu_stok as t1')
            ->joinSub($subQuery, 't2', function ($join) {
                $join->on('t1.no', '=', 't2.max_id')
                    ->on('t1.kode_unit', '=', 't2.kode_unit');
            })
            ->join('mt_barang as mb', 't1.kode_barang', '=', 'mb.kode_barang')
            ->join('mt_unit as mu', 't1.kode_unit', '=', 'mu.kode_unit')
            ->where('t1.kode_unit', $kodeUnitFilter)
            ->where('t1.stok_current', '<>', 0)
            ->where('mb.act', 1);

        // --- TAMBAHKAN FILTERING BERDASARKAN PARAMETER ---
        if (!empty($keyword)) {
            $query->where('mb.nama_barang', 'LIKE', "%{$keyword}%");
        }
        // -------------------------------------------------

        $query->select([
            'mb.nama_barang',
            'mb.kode_obat_bpjs',
            'mu.nama_unit as unit',
            't1.stok_last',
            't1.stok_current',
            't1.tgl_stok',
            't1.kode_barang',
            't1.no',
            'mb.satuan',
            'mb.satuan_besar'
        ]);
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
    public function proseskomponenracik(Request $request)
    {
        $dataheader = json_decode($_POST['dataheader'], true);
        $datakomponen = json_decode($_POST['datakomponen'], true);
        $kode_kunjungan = $request->kode_kunjungan;
        $data_kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kode_kunjungan]);
        $kode_penjamin = DB::table('ts_kunjungan')
            ->where('kode_kunjungan', $kode_kunjungan)
            ->value('kode_penjamin');
        foreach ($dataheader as $nama) {
            $index_header = $nama['name'];
            $value = $nama['value'];
            $dataHeader[$index_header] = $value;
        }
        foreach ($datakomponen as $nama_komponen) {
            $index_komponen = $nama_komponen['name'];
            $value_komponen = $nama_komponen['value'];
            $dataKomponen[$index_komponen] = $value_komponen;
        }
        // dd($dataHeader);
        if ($dataHeader['namaracikan'] == '') {
            $response = [
                'status' => 'error',
                'message' => 'Nama racikan wajib diisi ...'
            ];
            return response()->json($response);
            die;
        }
        if ($dataHeader['sediaan'] == '0') {
            $response = [
                'status' => 'error',
                'message' => 'Sediaan belum dipilih ...'
            ];
            return response()->json($response);
            die;
        }
        if ($dataHeader['qtyracikan'] == '0' || $dataHeader['qtyracikan'] == '') {
            $response = [
                'status' => 'error',
                'message' => 'QTY racikan tidak boleh kosong ...'
            ];
            return response()->json($response);
            die;
        }
        if ($dataKomponen['komponen_kodebarang'] == '') {
            $response = [
                'status' => 'error',
                'message' => 'Tidak ada obat yang dipilih ...'
            ];
            return response()->json($response);
            die;
        }
        $cleanJumlah = filter_var(str_replace(',', '.', $dataKomponen['komponen_dosisracik']), FILTER_VALIDATE_FLOAT);
        if ($cleanJumlah === false) {
            $response = [
                'status' => 'error',
                'message' => 'Input yang dimasukkan bukan angka valid.'
            ];
            return response()->json($response);
            die;
        }
        if ($dataKomponen['komponen_dosisracik'] == '' || $dataKomponen['komponen_dosisracik'] == '0') {
            $response = [
                'status' => 'error',
                'message' => 'Isi dosis racik yang dibutuhkan ...'
            ];
            return response()->json($response);
            die;
        }
        if ($dataKomponen['komponen_dosis'] == '' || $dataKomponen['komponen_dosis'] == '0') {
            $response = [
                'status' => 'error',
                'message' => 'Isi dosis awal obat ...'
            ];
            return response()->json($response);
            die;
        }
        if ($kode_penjamin != 'P01') {
            $get_barang = db::select('select kode_obat_bpjs from master_barang_x_master_obat_bpjs where kode_barang = ?', [$dataKomponen['komponen_kodebarang']]);
            if (count($get_barang) == 0) {

            }
        }
        $stok = DB::table('ti_kartu_stok')
            ->where('kode_barang', $dataKomponen['komponen_kodebarang'])
            ->where('kode_unit', auth()->user()->unit)
            ->orderBy('no', 'desc')
            ->value('stok_current');
        $dosis_diminta = $dataKomponen['komponen_dosisracik'];
        $jumlah_racikan = $dataHeader['qtyracikan'];
        $stok_mg = $dataKomponen['komponen_dosis'];
        $ss = ($dosis_diminta / $stok_mg) * $jumlah_racikan;
        $kebutuhan = round($ss * 2) / 2;
        $lamahari = $jumlah_racikan / ($dataHeader['signa1racikan'] * $dataHeader['signa2racikan']);
        $sisa_stok = $stok - $kebutuhan;
        if (!$sisa_stok || $sisa_stok < 0) {
            $response = [
                'status' => 'error',
                'message' => 'Stok tidak cukup !',
                'data' => [
                    'nama_barang' => $dataKomponen['komponen_namabarang'] ?? 'Tanpa Nama',
                    'kode_barang' => $dataKomponen['komponen_kodebarang'] ?? 'Tanpa Nama',
                    'satuan_barang' => $dataKomponen['komponen_satuanbarang'] ?? 'Tanpa Nama',
                    'dosis_awal' => $dataKomponen['komponen_dosis'] ?? 'Tanpa Nama',
                    'dosis_racik' => $dataKomponen['komponen_dosisracik'] ?? 'Tanpa Nama',
                    'jumlah' => $kebutuhan ?? 0,
                    'stok_current' => 0,
                    // Tambahkan field lain yang ingin ditampilkan di view
                ]
            ];
        } else {
            $response = [
                'status' => 'success',
                'message' => 'Obat berhasil ditambahkan ke daftar!',
                'data' => [
                    'nama_barang' => $dataKomponen['komponen_namabarang'] ?? 'Tanpa Nama',
                    'lama_hari' => $lamahari ?? 0,
                    'kode_barang' => $dataKomponen['komponen_kodebarang'] ?? 'Tanpa Nama',
                    'satuan_barang' => $dataKomponen['komponen_satuanbarang'] ?? 'Tanpa Nama',
                    'dosis_awal' => $dataKomponen['komponen_dosis'] ?? 'Tanpa Nama',
                    'dosis_racik' => $dataKomponen['komponen_dosisracik'] ?? 'Tanpa Nama',
                    'jumlah' => $kebutuhan ?? 0,
                    'stok_current' => $stok ?? 0,
                    // Tambahkan field lain yang ingin ditampilkan di view
                ]
            ];
        }
        return response()->json($response);
    }
    public function simpanobatracikan(Request $request)
    {
        try {
            $request->validate([
                'dataheader' => 'required',
                'datakomponen' => 'required',
                'kode_kunjungan' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'kode' => 422,
                'message' => 'Parameter inputan tidak lengkap.',
                'errors' => $e->errors()
            ], 422);
        }
        // Wrap seluruh proses database dalam Try-Catch & DB Transaction
        DB::beginTransaction();
        try {
            // 2. Decode JSON & Handling Error Parse JSON
            $dataheaderRaw = json_decode($request->dataheader, true);
            $datakomponenRaw = json_decode($request->datakomponen, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($dataheaderRaw) || !is_array($datakomponenRaw)) {
                return response()->json([
                    'kode' => 400,
                    'message' => 'Format data header atau komponen tidak valid (JSON Invalid).'
                ], 400);
            }

            // 3. Cek Data Kunjungan
            $kode_kunjungan = $request->kode_kunjungan;
            $data_kunjungan = DB::table('ts_kunjungan')
                ->where('kode_kunjungan', $kode_kunjungan)
                ->first();

            if (!$data_kunjungan) {
                return response()->json([
                    'kode' => 404,
                    'message' => 'Data kunjungan dengan kode ' . $kode_kunjungan . ' tidak ditemukan.'
                ], 404);
            }

            // 4. Transform Data Header
            $dataHeader = [];
            foreach ($dataheaderRaw as $nama) {
                if (isset($nama['name'], $nama['value'])) {
                    $dataHeader[$nama['name']] = $nama['value'];
                }
            }

            // Validasi Key Header yang Wajib Ada
            $requiredHeaderKeys = ['namaracikan', 'tiperacikan', 'sediaan', 'qtyracikan', 'aturanpakai'];
            foreach ($requiredHeaderKeys as $key) {
                if (!isset($dataHeader[$key])) {
                    return response()->json([
                        'kode' => 422,
                        'message' => "Field header '{$key}' wajib diisi."
                    ], 422);
                }
            }

            // 5. Transform Data Komponen
            $dataKomponen = [];
            $arrayKomponenObat = [];
            foreach ($datakomponenRaw as $nama_komponen) {
                if (isset($nama_komponen['name'], $nama_komponen['value'])) {
                    $index_komponen = $nama_komponen['name'];
                    $value_komponen = $nama_komponen['value'];
                    $dataKomponen[$index_komponen] = $value_komponen;

                    if ($index_komponen == 'list_dosis_racik_barang') {
                        $arrayKomponenObat[] = $dataKomponen;
                    }
                }
            }

            if (empty($arrayKomponenObat)) {
                return response()->json([
                    'kode' => 422,
                    'message' => 'Komponen obat racikan tidak boleh kosong.'
                ], 422);
            }

            // 6. Simpan Header
            $headerData = [
                'namaracikan'  => $dataHeader['namaracikan'],
                'tiperacikan'  => $dataHeader['tiperacikan'],
                'sediaan'      => $dataHeader['sediaan'],
                'qtyracikan'   => $dataHeader['qtyracikan'],
                'aturanpakai'  => $dataHeader['aturanpakai'],
                'unit_layanan' => auth()->user()->unit ?? null,
                'unit_kirim'   => $data_kunjungan->kode_unit ?? null,
                'dok_kirim'    => $data_kunjungan->kode_paramedis ?? null,
                'pic'          => auth()->id(),
                'signa1'       =>$dataHeader['signa1racikan'],
                'signa2'       =>$dataHeader['signa2racikan']
            ];

            $h = model_template_racikan::create($headerData);

            // 7. Simpan Detail Komponen Obat
            foreach ($arrayKomponenObat as $d) {
                // Cek kelengkapan atribut detail obat
                if (
                    !isset($d['list_kode_barang']) ||
                    !isset($d['list_qty_barang']) ||
                    !isset($d['list_dosis_barang']) ||
                    !isset($d['list_dosis_racik_barang'])
                ) {
                    // Trigger catch jika ada array item yang corrupt
                    throw new \Exception("Struktur data komponen obat tidak lengkap.");
                }

                $detailData = [
                    'id_header'          => $h->id,
                    'kode_barang'        => $d['list_kode_barang'],
                    'qty_barang'         => $d['list_qty_barang'],
                    'dosis_awal'         => $d['list_dosis_barang'],
                    'qty_hari'         => $d['list_qty_hari'],
                    'dosis_racik'        => $d['list_dosis_racik_barang'],
                ];

                model_template_racikan_detail::create($detailData);
            }

            // Commit transaksi database jika semua berjalan lancar
            DB::commit();

            return response()->json([
                'kode' => 200,
                'message' => 'Obat racikan berhasil disimpan ...'
            ], 200);
        } catch (\Throwable $th) {
            // Rollback transaksi database jika ada error di tengah jalan
            DB::rollBack();

            // Catat detail error ke file log Laravel (storage/logs/laravel.log)
            Log::error('Gagal Simpan Racikan: ' . $th->getMessage(), [
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'request' => $request->all()
            ]);

            return response()->json([
                'kode' => 500,
                'message' => 'Terjadi kesalahan sistem saat menyimpan obat racikan.',
                'error_detail' => config('app.debug') ? $th->getMessage() : null // Hanya tampil jika mode debug aktif
            ], 500);
        }
    }
    public function ambillistobatracikan()
    {
        $data = DB::table('template_racikan_header as a')
            ->join('template_racikan_detail as b', 'a.id', '=', 'b.id_header')
            ->select([
                'a.*',
                DB::raw("fc_NAMA_PARAMEDIS1(a.dok_kirim) as nama_dokter"),
                DB::raw("fc_nama_unit1(a.unit_kirim) as nama_unit_kirim"),
                DB::raw("GROUP_CONCAT(fc_nama_barang(b.kode_barang) SEPARATOR ', ') as keterangan_detail")
            ])
            ->groupBy('a.id') // Pastikan ID header unik
            ->orderBy('a.id', 'DESC') // Move ordering to its own method
            ->get();
        return view('new_farmasi.tabel_obat_racik', compact([
            'data'
        ]));
    }
    public function ambilobatracik(Request $request)
    {
        $id = $request->idtemplate;
        $data = DB::table('template_racikan_header as a')
            ->select([
                'a.*'
            ])
            ->where('a.id', $id) // Filter berdasarkan ID Header
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['html' => '<p class="text-danger">Data tidak ditemukan.</p>']);
        }

        // Render file blade menjadi string HTML
        $view = view('new_farmasi.form_racikan', compact('data'))->render();
        return response()->json(['html' => $view]);
    }
    public function hapusracikan(Request $request)
    {
        $id = $request->idtemplate;
        model_template_racikan::where('id', $id)->delete();
        model_template_racikan_detail::where('id_header', $id)->delete();
        return response()->json([
            'kode' => 200,
            'message' => 'Data resep berhasil dihapus ..!'
        ], 200);
    }
    public function get_kode_racik()
    {
        $q = DB::select('SELECT id,kode_racik,RIGHT(kode_racik,3) AS kd_max  FROM mt_racikan
        WHERE DATE(tgl_racik) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'R' . date('ymd') . $kd;
    }
    public function indexkartustok()
    {
        // Ambil daftar unit untuk dropdown filter
        $units = DB::table('mt_unit')->get(['kode_unit', 'nama_unit']);
        return view('dashboard.kartu_stok', compact('units'));
    }

    public function getDatastok(Request $request)
    {
        // 1. Subquery untuk mencari ID transaksi terakhir (MAX id/no) per barang & unit
        $latestStok = DB::table('ti_kartu_stok')
            ->select('kode_barang', 'kode_unit', DB::raw('MAX(no) as max_id'))
            ->when($request->filled('kode_unit'), function ($q) use ($request) {
                return $q->where('kode_unit', $request->kode_unit);
            })
            ->groupBy('kode_barang', 'kode_unit');

        // 2. Query Utama: Join tabel kartu_stok dengan hasil subquery
        $query = DB::table('ti_kartu_stok as a')
            ->joinSub($latestStok, 'latest', function ($join) {
                $join->on('a.no', '=', 'latest.max_id');
            })
            ->leftJoin('mt_barang as b', 'a.kode_barang', '=', 'b.kode_barang')
            ->leftJoin('mt_unit as c', 'a.kode_unit', '=', 'c.kode_unit')
            ->select([
                'a.no',
                'a.kode_barang',
                'b.nama_barang',
                'a.kode_unit',
                'c.nama_unit',
                'a.keterangan',
                'a.stok_last as stok_awal',
                'a.stok_in as stok_masuk',
                'a.stok_out as stok_keluar',
                'a.stok_current as stok_akhir',
                'a.tgl_stok as created_at',
            ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('stok_awal', fn($row) => number_format($row->stok_awal, 0, ',', '.'))
            ->editColumn('stok_masuk', fn($row) => number_format($row->stok_masuk, 0, ',', '.'))
            ->editColumn('stok_keluar', fn($row) => number_format($row->stok_keluar, 0, ',', '.'))
            ->editColumn('stok_akhir', fn($row) => number_format($row->stok_akhir, 0, ',', '.'))
            ->toJson();
    }
    public function ambilbarangbpjs(Request $request)
    {
        if ($request->ajax()) {
            // $data = MasterBarang::query();
            $data = MasterBarangBPJS::orderBy('id', 'desc');
            return DataTables::of($data)
                ->addIndexColumn() // Untuk nomor urut otomatis
                ->make(true);
        }
    }
    public function ambilbarangmappingdepo(Request $request)
    {
        if ($request->ajax()) {
            // 1. Subquery untuk mencari ID/No transaksi kartu stok TERAKHIR per kode_barang khusus di unit 4008
            $latestStok = DB::table('ti_kartu_stok')
                ->select('kode_barang', DB::raw('MAX(no) as max_id')) // Ganti 'id' dengan nama kolom PK/No (misal 'no') jika berbeda
                ->where('kode_unit', '4008')
                ->groupBy('kode_barang');
            // 2. Query Utama: Mengambil data barang yang ada di kartu stok unit 4008

            $data = DB::table('ti_kartu_stok as ks')
                ->joinSub($latestStok, 'latest', function ($join) {
                    $join->on('ks.no', '=', 'latest.max_id'); // Ganti 'ks.no' jika PK kartu stok berupa kolom lain (misal 'ks.no')
                })
                ->join('mt_barang as b', 'ks.kode_barang', '=', 'b.kode_barang')
                ->select([
                    'b.kode_barang',
                    'b.nama_barang',
                    'b.satuan_besar',
                    'b.sediaan',
                    'b.dosis',
                    'b.aturan_pakai',
                    'b.kode_obat_bpjs',
                    'ks.kode_unit',
                    'ks.stok_current', // Opsional: jika ingin menampilkan jumlah sisa stok terakhir di unit 4008
                ])
                ->where('b.act', 1)
                ->where('ks.kode_unit', '4008')
                ->orderBy('ks.no', 'desc');

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = '<button class="editbarang btn btn-warning btn-sm" data-id="' . $row->kode_barang . '" data-bs-toggle="modal" data-bs-target="#modaleditbarang">
                       <i class="bi bi-pencil-square"></i>
                    </button>';

                    $btn .= ' <button class="deletebarang btn btn-danger btn-sm" data-id="' . $row->kode_barang . '">
                        <i class="bi bi-trash3"></i>
                    </button>';

                    return $btn;
                })
                ->rawColumns(['action']) // Pastikan tombol HTML dirender dengan benar
                ->make(true);
        }
    }
    public function simpanmappingbaru(Request $request)
    {
        try {
            $obatsimrs = json_decode($_POST['data_simrs'], true);
            $obatbpjs = json_decode($_POST['data_bpjs'], true);
            // dd($obatsimrs);
            // dd($arraybpjs);
            foreach ($obatbpjs as $nama) {
                $index = $nama['name'];
                $value = $nama['value'];
                $dataSet[$index] = $value;
            }
            foreach ($obatsimrs as $nama2) {
                $index2 = $nama2['name'];
                $value2 = $nama2['value'];
                $dataSet2[$index2] = $value2;
                if ($index2 == 'dosis') {
                    $arraydatasimrs[] = $dataSet2;
                }
            }
            foreach ($arraydatasimrs as $s) {
                MasterBarang::where('kode_barang', $s['kodebarang'])->update(['kode_obat_bpjs' => $dataSet['kodeobatbpjs']]);
            }
            $data = [
                'kode' => 200,
                'message' => 'Sukses, data berhasil disimpan ...'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $err = $e->getMessage();
            $data = [
                'kode' => 500,
                'message' => 'Ops error ! ...( ' . $err . ' )'
            ];
            echo json_encode($data);
            die;
        }
    }
}
