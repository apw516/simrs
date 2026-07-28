<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
    public function ambildetailkunjunganpasiendepo(Request $request)
    {
        $kode_kunjungan = $request->kodekunjungan;
        $data_kunjungan = db::select('select *,fc_NAMA_PENJAMIN2(kode_penjamin) as nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$kode_kunjungan]);
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamatpx from mt_pasien where no_rm = ?', [$data_kunjungan[0]->no_rm]);
        $kode_paramedis = $data_kunjungan[0]->kode_paramedis;
        $dokter = db::select('select * from mt_paramedis where kode_paramedis = ?', [$kode_paramedis]);
        $kodeUnit = '4002';
        // 1. Buat Subquery terlebih dahulu
        $subQuery = DB::table('ti_kartu_stok')
            ->select('kode_unit', 'kode_barang', DB::raw('MAX(no) AS max_id'))
            ->where('kode_unit', $kodeUnit)
            ->groupBy('kode_unit', 'kode_barang');
        $stokBarang = DB::table('ti_kartu_stok as k')
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
                $this->prosesResepObat($reguler, $data_kunjungan, $kode_unit_pelayanan,$tipe_anestesi);
            }
            if (count($kronis) > 0) {
                $tipe_anestesi = '81';
                $this->prosesResepObat($kronis, $data_kunjungan, $kode_unit_pelayanan,$tipe_anestesi);
            }
            if (count($PRB) > 0) {
                $tipe_anestesi = '84';
                $this->prosesResepObat($PRB, $data_kunjungan, $kode_unit_pelayanan,$tipe_anestesi);
            }
            if (count($Kemoterapi) > 0) {
                $tipe_anestesi = '82';
                $this->prosesResepObat($Kemoterapi, $data_kunjungan, $kode_unit_pelayanan,$tipe_anestesi);
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

    public function prosesResepObat($dataobat, $data_kunjungan, $kode_unit_pelayanan,$tipe_anestesi)
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
        foreach ($dataobat as $a) {
            $kode_detail_obat = $this->createLayanandetail();
            if ($a['jenis_resep'] != 'Racikan') {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang']]);
                if (empty($mt_barang)) {
                    throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
                }
                $jumlahHari = $a['jumlahhari'];
                $frekuensi  = $a['signa1'];
                $dosis      = $a['jumlahobat'];
                $totalObat  = $jumlahHari * ($frekuensi * $dosis);
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
                    'keterangan' => $data_kunjungan[0]->no_rm.' | '. $data_kunjungan[0]->nama_pasien.' | '.$data_kunjungan[0]->alamat_pasien
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
                dd('ok');
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
    // public function prosesResepKronis($dataobat, $data_kunjungan, $kode_unit_pelayanan,$tipe_anestesi)
    // {
    //     $r = DB::connection('mysql7')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit_pelayanan')");
    //     $PENJAMIN = $data_kunjungan[0]->kode_penjamin;
    //     $kode_kunjungan = $data_kunjungan[0]->kode_kunjungan;
    //     $unit = DB::select('select * from mt_unit where kode_unit =?', [$kode_unit_pelayanan]);
    //     $jsf = DB::select('select * from mt_jasa_farmasi');
    //     if ($PENJAMIN == 'P01') {
    //         $kat_resep = 'Resep Tunai';
    //         $tipe_tx = '1';
    //     } else {
    //         $kat_resep = 'Resep Kredit';
    //         $tipe_tx = '2';
    //     }
    //     $kode_layanan_header = $r[0]->no_trx_layanan ?? "";
    //     if ($kode_layanan_header == "") {
    //         $year = date('y');
    //         $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
    //         DB::connection('mysql7')->insert(
    //             'INSERT INTO mt_nomor_trx (tgl, no_trx_layanan, unit) VALUES (?, ?, ?)',
    //             [date('Y-m-d H:i:s'), $kode_layanan_header, $kode_unit_pelayanan]
    //         );
    //     }
    //     $cek_resep_ke = DB::select('select id from ts_layanan_header where kode_kunjungan = ? and kode_unit = ? and status_layanan != 3', [$kode_kunjungan, $kode_unit_pelayanan]);
    //     $urutan = count($cek_resep_ke) + 1;
    //     $data_layanan_header = [
    //         'kode_layanan_header' => $kode_layanan_header,
    //         'tgl_entry' => $this->get_now(),
    //         'kode_kunjungan' => $kode_kunjungan,
    //         'kode_unit' => auth()->user()->unit,
    //         'kode_tipe_transaksi' => $tipe_tx,
    //         'pic' => auth()->user()->id,
    //         'status_layanan' => '3',
    //         'keterangan' => 'Resep Ke :' . $urutan,
    //         'total_layanan' => '0',
    //         'kode_penjaminx' => $data_kunjungan[0]->kode_penjamin,
    //         'tagihan_pribadi' => 0,
    //         'tagihan_penjamin' => 0,
    //         'status_pembayaran' => 'OPN',
    //         'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
    //         'unit_pengirim' => $data_kunjungan[0]->kode_unit . ' | ' . $data_kunjungan[0]->nama_unit,
    //         'diagnosa' => $data_kunjungan[0]->diagx,
    //     ];
    //     $idBaru = DB::connection('mysql7')->table('ts_layanan_header')->insertGetId($data_layanan_header);
    //     $now = $this->get_now();
    //     $totalheader = 0;
    //     foreach ($dataobat as $a) {
    //         $kode_detail_obat = $this->createLayanandetail();
    //         if ($a['jenis_resep'] != 'Racikan') {
    //             $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang']]);
    //             if (empty($mt_barang)) {
    //                 throw new \Exception("Master barang dengan kode " . $a['kode_barang'] . " tidak ditemukan!");
    //             }
    //             $jumlahHari = $a['jumlahhari'];
    //             $frekuensi  = $a['signa1'];
    //             $dosis      = $a['jumlahobat'];
    //             $totalObat  = $jumlahHari * ($frekuensi * $dosis);
    //             $stokTerakhir = DB::connection('mysql7')->table('ti_kartu_stok')
    //                 ->where('kode_unit', auth()->user()->unit)
    //                 ->where('kode_barang', $a['kode_barang'])
    //                 ->orderBy('no', 'desc')
    //                 ->value('stok_current');
    //             if (is_null($stokTerakhir) || $stokTerakhir < $totalObat) {
    //                 $stokTersedia = $stokTerakhir ?? 0;
    //                 $namaBarang   = $mt_barang[0]->nama_barang;
    //                 throw new \Exception("Obat Out of Stock! Stok '{$namaBarang}' tidak mencukupi (Sisa: {$stokTersedia}, Butuh: {$totalObat}).");
    //             }
    //             $total      = $mt_barang[0]->harga_jual * $totalObat;
    //             $diskon     = 0;
    //             $hitung     = $diskon / 100 * $total;
    //             $grandtotal = $total - $hitung + 1200 + 500;
    //             if ($data_kunjungan[0]->kode_penjamin != 'P01') {
    //                 $tagihan_pribadi = 0;
    //                 $tagihan_penjamin = $total;
    //             } else {
    //                 $tagihan_pribadi = $total;
    //                 $tagihan_penjamin = 0;
    //             }
    //             $aturan_pakai = $a['signa1'] . ' x ' . $a['signa2'] . ' | ' . $a['catatan'];
    //             $ts_layanan_detail = [
    //                 'id_layanan_detail' => $kode_detail_obat,
    //                 'kode_layanan_header' => $kode_layanan_header,
    //                 'kode_tarif_detail' => '0',
    //                 'total_tarif' => $mt_barang[0]->harga_jual,
    //                 'jumlah_layanan' => $totalObat,
    //                 'total_layanan' => $total,
    //                 'diskon_layanan' => '0',
    //                 'grantotal_layanan' => $grandtotal,
    //                 'status_layanan_detail' => 'OPN',
    //                 'tgl_layanan_detail' => $now,
    //                 'kode_barang' => $a['kode_barang'],
    //                 'aturan_pakai' => $aturan_pakai,
    //                 'kategori_resep' => $kat_resep,
    //                 'satuan_barang' => $mt_barang[0]->satuan,
    //                 'tipe_anestesi' => $tipe_anestesi,
    //                 'tagihan_pribadi' => $tagihan_pribadi,
    //                 'tagihan_penjamin' => $tagihan_penjamin,
    //                 'tgl_layanan_detail_2' => $now,
    //                 'row_id_header' => $idBaru,
    //             ];
    //             $ti_kartu_stok = [
    //                 'no_dokumen' => $kode_layanan_header,
    //                 'no_dokumen_detail' => $kode_detail_obat,
    //                 'tgl_stok' => $now,
    //                 'kode_unit' => auth()->user()->unit,
    //                 'kode_barang' => $a['kode_barang'],
    //                 'stok_last' => $stokTerakhir,
    //                 'stok_out' => $totalObat,
    //                 'stok_current' => $stokTerakhir - $totalObat,
    //                 'harga_beli' => $mt_barang[0]->hna_history,
    //                 'inputby' => auth()->user()->id,
    //                 'keterangan' => $data_kunjungan[0]->no_rm.' | '. $data_kunjungan[0]->nama_pasien.' | '.$data_kunjungan[0]->alamat_pasien
    //             ];
    //             DB::connection('mysql7')->table('ti_kartu_stok')->insert($ti_kartu_stok);
    //             DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail);
    //             if ($data_kunjungan[0]->kode_penjamin != 'P01') {
    //                 $tagihan_pribadi_js = 0;
    //                 $tagihan_penjamin_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
    //             } else {
    //                 $tagihan_pribadi_js = $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase;
    //                 $tagihan_penjamin_js = 0;
    //             }
    //             $ts_layanan_detail_2 = [
    //                 'id_layanan_detail' => $this->createLayanandetail(),
    //                 'kode_layanan_header' => $kode_layanan_header,
    //                 'kode_tarif_detail' => 'TX23513',
    //                 'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
    //                 'jumlah_layanan' => 1,
    //                 'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
    //                 'diskon_layanan' => '0',
    //                 'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
    //                 'status_layanan_detail' => 'OPN',
    //                 'tgl_layanan_detail' => $now,
    //                 'kategori_resep' => $kat_resep,
    //                 'satuan_barang' => '-',
    //                 'tagihan_pribadi' => $tagihan_pribadi_js,
    //                 'tagihan_penjamin' => $tagihan_penjamin_js,
    //                 'tipe_anestesi' => $tipe_anestesi,
    //                 'tgl_layanan_detail_2' => $now,
    //                 'row_id_header' => $idBaru,
    //             ];
    //             DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail_2);
    //             $totalheader += $grandtotal;
    //         } else {
    //             dd('ok');
    //         }
    //     }
    //     if ($data_kunjungan[0]->kode_penjamin != 'P01') {
    //         $tagian_penjamin_head = $jsf[0]->jasa_baca;
    //         $tagian_pribadi_head = 0;
    //     } else {
    //         $tagian_penjamin_head = 0;
    //         $tagian_pribadi_head = $jsf[0]->jasa_baca;
    //     }
    //     $ts_layanan_detail3 = [
    //         'id_layanan_detail' => $this->createLayanandetail(),
    //         'kode_layanan_header' => $kode_layanan_header,
    //         'kode_tarif_detail' => 'TX23523',
    //         'total_tarif' => $jsf[0]->jasa_baca,
    //         'diskon_layanan' => '0',
    //         'jumlah_layanan' => 1,
    //         'total_layanan' => $jsf[0]->jasa_baca,
    //         'grantotal_layanan' => $jsf[0]->jasa_baca,
    //         'status_layanan_detail' => 'OPN',
    //         'tgl_layanan_detail' => $now,
    //         'kategori_resep' => $kat_resep,
    //         'satuan_barang' => '-',
    //         'tagihan_pribadi' => $tagian_pribadi_head,
    //         'tagihan_penjamin' => $tagian_penjamin_head,
    //         'tipe_anestesi' => $tipe_anestesi,
    //         'tgl_layanan_detail_2' => $now,
    //         'row_id_header' => $idBaru,
    //     ];
    //     DB::connection('mysql7')->table('ts_layanan_detail')->insert($ts_layanan_detail3);
    //     $totalheader += $jsf[0]->jasa_baca;
    //     if ($data_kunjungan[0]->kode_penjamin != 'P01') {
    //         $tagihan_penjamin_header = $totalheader;
    //         $tagihan_pribadi_header = '0';
    //         $status_layanan = 2;
    //     } else {
    //         $tagihan_penjamin_header = '0';
    //         $tagihan_pribadi_header = $totalheader;
    //         $status_layanan = 1;
    //     }
    //     DB::connection('mysql7')->table('ts_layanan_header')
    //         ->where('id', $idBaru)
    //         ->update([
    //             'status_layanan' => $status_layanan,
    //             'total_layanan' => $totalheader,
    //             'tagihan_penjamin' => $tagihan_penjamin_header,
    //             'tagihan_pribadi' => $tagihan_pribadi_header
    //         ]);
    // }
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
}
