<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class newFarmasiController extends FarmasiController
{
    public function index_order_resep()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'dataorder';
        $sidebar_m = 'dataorder';
        $mt_unit = DB::select('select * from mt_unit where group_unit = ?', (['J']));
        $now = $this->get_date();
        return view('newfarmasi.index_data_order', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now',
            'mt_unit'
        ]));
    }
    public function getDataOrderPoli(Request $request)
    {
        // 1. Ambil input tanggal atau gunakan tanggal hari ini sebagai default
        $tglAwal  = $request->input('tgl_awal', Carbon::now()->format('Y-m-d'));
        $tglAkhir = $request->input('tgl_akhir', Carbon::now()->format('Y-m-d'));

        // Ambil unit poli dokter yang sedang login
        // $kodeUnitPoli = auth()->user()->unit ?? null;
        $kodeUnitPoli = auth()->user()->unit ?? null;

        // 2. Query Data Order Header + Aggregasi Total Item
        $dataOrder = DB::table('erm_order_farmasi_header as a')
            ->leftJoin('erm_order_farmasi_detail as b', 'a.id', '=', 'b.id_header')
            ->leftJoin('ts_kunjungan as k', 'a.kode_kunjungan', '=', 'k.kode_kunjungan')
            ->select([
                'a.id',
                'a.kode_kunjungan',
                'a.tgl_entry as tgl_order',
                'a.status_order',
                'a.unit_penerima',
                'k.no_rm',
                DB::raw('fc_NAMA_PARAMEDIS1(a.pic) AS nama_dokter'),
                DB::raw('fc_nama_unit1(a.unit_penerima) AS unit_penerima'),
                DB::raw('fc_nama_unit1(a.unit_pengirim) AS unit_pengirim'),
                DB::raw('fc_nama_px(k.no_rm) AS nama_pasien'), // Atau ambil dari tabel master pasien
                DB::raw('COUNT(b.id) as total_item')
            ])
            // Filter Berdasarkan Rentang Tanggal (menggunakan DATE agar jam tidak mengganggu filter)
            ->whereDate('a.tgl_entry', '>=', $tglAwal)
            ->whereDate('a.tgl_entry', '<=', $tglAkhir)
            ->where('b.status_obat', '=', 1)

            // Opsional: Filter berdasarkan unit poli pengirim
            ->when($kodeUnitPoli, function ($query, $kodeUnitPoli) {
                return $query->where('a.unit_penerima', $kodeUnitPoli);
            })
            ->groupBy(
                'a.id',
                'a.kode_kunjungan',
                'a.tgl_entry',
                'a.status_order',
                'a.unit_penerima',
                'a.pic',
                'k.no_rm'
            )
            ->orderBy('a.tgl_entry', 'desc') // Diurutkan dari order terbaru
            ->get();

        // 3. Render Partial View dan kirim sebagai respon AJAX
        return view('newfarmasi.tabel_order_poli', compact('dataOrder', 'tglAwal', 'tglAkhir'));
    }
    public function getDetailOrder(Request $request)
    {
        $idHeader      = $request->input('id_header');
        $kodeKunjungan = $request->input('kode_kunjungan');
        // // 1. Ambil Data Header Order & Informasi Pasien/Dokter
        $orderHeader = DB::table('erm_order_farmasi_header as a')
            ->leftJoin('ts_kunjungan as k', 'a.kode_kunjungan', '=', 'k.kode_kunjungan')
            ->where('a.id', $idHeader)
            ->select([
                'a.id',
                'a.kode_kunjungan',
                'a.tgl_entry as tgl_order',
                'a.status_order',
                'a.unit_pengirim',
                'a.unit_penerima',
                'k.no_sep',
                'k.no_rm',
                'a.iterasi',
                'a.jumlah_iterasi',
                DB::raw('fc_NAMA_PARAMEDIS1(a.pic) AS nama_dokter'),
                DB::raw('fc_NAMA_PENJAMIN2(k.kode_penjamin) AS nama_penjamin'),
                DB::raw('fc_nama_px(k.no_rm) AS nama_pasien'),
                DB::raw('fc_nama_unit1(a.unit_pengirim) AS nama_unit_pengirim')
            ])
            ->first();


        $subKartuStok = DB::table('ti_kartu_stok')
            ->select('kode_barang', 'stok_current')
            ->where('kode_unit', $orderHeader->unit_penerima)
            ->whereIn('no', function ($q) use ($orderHeader) {
                $q->select(DB::raw('MAX(no)')) // atau MAX(tgl_entry)
                    ->from('ti_kartu_stok')
                    ->where('kode_unit', $orderHeader->unit_penerima)
                    ->groupBy('kode_barang');
            });

        // Query Utama
        $orderDetail = DB::table('erm_order_farmasi_detail as b')
            ->join('mt_barang as m', 'b.kode_barang', '=', 'm.kode_barang')
            ->leftJoinSub($subKartuStok, 's', function ($join) {
                $join->on('b.kode_barang', '=', 's.kode_barang');
            })
            ->where('b.id_header', $idHeader)
            ->where('b.status_obat', 1)
            ->select([
                'b.id',
                'b.id_header',
                'b.kode_barang',
                'm.nama_barang',
                'b.jumlah_hari',
                'b.jumlah_obat',
                'b.signa_1',
                'b.signa_2',
                'm.sediaan',
                'b.catatan',
                DB::raw('IFNULL(s.stok_current, 0) as stok_akhir_unit')
            ])
            ->get();
        return view('newfarmasi.detail_order_partial', compact('orderHeader', 'orderDetail'));
    }
    public function ambilstokobatfarmasi()
    {
        $kodeUnit = '4008';
        // 1. Buat Subquery terlebih dahulu
        $subQuery = DB::table('ti_kartu_stok')
            ->select('kode_unit', 'kode_barang', DB::raw('MAX(no) AS max_id'))
            ->where('kode_unit', $kodeUnit)
            ->groupBy('kode_unit', 'kode_barang');

        // 2. Main Query
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
                'b.aturan_pakai',
                'b.sediaan',
                'k.stok_current as stok_saat_ini',
                'k.tgl_stok as tanggal_transaksi_terakhir',
            ])
            ->get();
        return view('newfarmasi.tabel_stok_farmasi', compact([
            'stokBarang'
        ]));
    }
    public function simpandatapelayananobat(Request $request)
    {
        $dataobat = json_decode($_POST['dataobat'], true);
        $kode_kunjungan = $request->kode_kunjungan;
        dd($kode_kunjungan);
        $simpantemplate = $request->is_simpan_template;
        $nama_resep = $request->nama_resep;
        $tgl_resep = $request->tgl_resep;
        $tgl_pelayanan = $request->tgl_pelayanan;
        $iterasi_tidak = $request->iterasi_tidak;
        $iterasi_ya = $request->iterasi_ya;
        $jumlah_iterasi = $request->jumlah_iterasi;
        if ($jumlah_iterasi > 0) {
            $iterasi = $iterasi_ya;
        } else {
            $iterasi = $iterasi_tidak;
        }
        foreach ($dataobat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'catatan') {
                $arrayindex_far[] = $dataSet;
            }
        }
        dd($arrayindex_far);
    }
}
