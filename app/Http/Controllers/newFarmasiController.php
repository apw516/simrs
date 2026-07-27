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
        foreach ($data_header_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataheader[$index] = $value;
        }
        foreach ($data_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'catatan') {
                $arrayobat[] = $dataSet;
            }
        }
        $kode_unit_pelayanan = auth()->user()->unit;
        $kode_kunjungan = $dataheader['kode_kunjungan'];
        $data_kunjungan = db::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where kode_kunjungan = ?', [$kode_kunjungan]);
        $collection = collect($arrayobat);
        $dataTerpisah = $collection->groupBy('jenis_obat');
        $obatreguler = $dataTerpisah->get('Reguler', []);
        $obatkronis = $dataTerpisah->get('Kronis', []);
        $obatkemo = $dataTerpisah->get('Kemoterapi', []);
        $obatprb = $dataTerpisah->get('PRB', []);
        if (count($dataTerpisah->get('Reguler', [])) > 0) {
            // Panggil fungsi terpisah untuk memproses resep reguler
            $this->prosesResepReguler($dataTerpisah->get('Reguler'), $data_kunjungan, $kode_unit_pelayanan);
        }
    }
    public function prosesResepReguler($dataobat, $data_kunjungan, $kode_unit_pelayanan)
    {
        $r = DB::connection('mysql7')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit_pelayanan')");
        $PENJAMIN = $data_kunjungan[0]->kode_penjamin;
        $kode_kunjungan = $data_kunjungan[0]->kode_kunjungan;
        $unit = db::select('select * from mt_unit where kode_unit =?', [$kode_unit_pelayanan]);
        $jsf = DB::select('select * from mt_jasa_farmasi');
        if ($PENJAMIN == 'P01') {
            $kat_resep = 'Resep Tunai';
            $tipe_tx = '1';
        } else {
            $kat_resep = 'Resep Kredit';
            $tipe_tx = '2';
        }
        $kode_layanan_header = $r[0]->no_trx_layanan;
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
            DB::connection('mysql7')->insert(
                'INSERT INTO mt_nomor_trx (tgl, no_trx_layanan, unit) VALUES (?, ?, ?)',
                [date('Y-m-d H:i:s'), $kode_layanan_header, $kode_unit_pelayanan]
            );
        }
        $cek_resep_ke = db::select('select id from ts_layanan_header where kode_kunjungan = ? and kode_unit = ? and status_layanan != 3', [$kode_kunjungan, $kode_unit_pelayanan]);
        if (count($cek_resep_ke) == 0) {
            $urutan = 1;
        } else {
            $s =  count($cek_resep_ke);
            $urutan = $s + 1;
        }
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
            // 'status_retur' => '0',
            'kode_penjaminx' => $data_kunjungan[0]->kode_penjamin,
            'tagihan_pribadi' => 0,
            'tagihan_penjamin' => 0,
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $data_kunjungan[0]->kode_unit . ' | ' . $data_kunjungan[0]->nama_unit,
            'diagnosa' => $data_kunjungan[0]->diagx,
        ];
        // $idBaru = DB::connection('mysql7')->table('ts_layanan_header')->insertGetId($data_layanan_header);
        $now = $this->get_now();
        $totalheader = 0;
        

    }
}
