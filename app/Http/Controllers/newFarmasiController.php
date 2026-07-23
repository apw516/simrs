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
        return view('new_farmasi.index_depo_obat', compact([
            'title',
            'sidebar',
            'sidebar_m'
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

        return view('new_farmasi.detail_pasien', compact([
            'data_kunjungan',
            'mt_pasien'
        ]));
    }
}
