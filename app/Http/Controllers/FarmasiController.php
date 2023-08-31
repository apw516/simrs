<?php

namespace App\Http\Controllers;

use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FarmasiController extends Controller
{
    public function index_layanan_resep()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'farmasi_1';
        $sidebar_m = 'farmasi_1';
        $now = $this->get_date();
        return view('farmasi.index_layanan_resep', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function ambil_data_pasien_far(Request $request)
    {
        $rm = $request->rm;
        $mt_pasien = DB::select('Select no_rm,nama_px,tgl_lahir,fc_alamat(no_rm) as alamatpasien from mt_pasien where no_rm = ?', [$rm]);
        $kunjungan = DB::select('SELECT kode_kunjungan,fc_nama_unit1(kode_unit) AS nama_unit, fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin FROM ts_kunjungan WHERE no_rm = ? AND status_kunjungan = ?', [$rm, '1']);
        return view('farmasi.detail_pasien_pencarian', compact([
            'mt_pasien',
            'kunjungan'
        ]));
    }
    public function cari_obat_farmasi(Request $request)
    {
        $nama = $request->nama;
        $pencarian_obat = DB::select('CALL sp_cari_obat_semua(?,?)', [$nama, auth()->user()->unit]);
        return view('farmasi.tabel_obat', compact([
            'pencarian_obat'
        ]));
    }
    public function simpanorderan_far(Request $request)
    {
        $jsf = DB::select('select * from mt_jasa_farmasi');
        $data_obat = json_decode($_POST['data1'], true);
        foreach ($data_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'sub_total_order') {
                $arrayindex_far[] = $dataSet;
            }
        }
        foreach ($arrayindex_far as $a) {
            $cek_stok = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
            $stok_current = $cek_stok[0]->stok_current - $a['qty_order'];
            if ($stok_current < 0) {
                $data = [
                    'kode' => 500,
                    'message' => $a['nama_barang_order'] . ' ' . 'Stok Tidak Mencukupi !',
                ];
                echo json_encode($data);
            }
        }
        //pic ambil dari dd_user
        //create layanan header
        //tambah diagnosa
        //detail unit pengirim
        $data_kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kodeunit = auth()->user()->unit;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kodeunit]);
        $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kodeunit')");
        $kode_layanan_header = $r[0]->no_trx_layanan;
        if ($kode_layanan_header == "") {
            $year = date('y');
            $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
            DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kodeunit]);
        }
        $ts_layanan_header = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' => $this->get_now(),
            'kode_kunjungan' => $request->kodekunjungan,
            'kode_unit' => auth()->user()->unit,
            'kode_tipe_transaksi' => '2',
            'pic' => auth()->user()->id,
            'status_layanan' => '3',
            'keterangan' => 'FARMASI BARU',
            'status_retur' => 'OPN',
            'tagihan_pribadi' => '0',
            'tagihan_penjamin' => '0',
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $data_kunjungan[0]->kode_paramedis,
            'unit_pengirim' => $data_kunjungan[0]->kode_unit
        ];
        $header = ts_layanan_header_dummy::create($ts_layanan_header);
        $now = $this->get_now();
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagihan_penjamin = $a['harga2_order'] * $a['qty_order'] + 1200 + 500;
            $tagihan_pribadi = '0';
            $kategori_resep = 'Resep Kredit';
            $kode_tipe_transaki = 2;
            $status_layanan = 2;
        } else {
            $tagihan_penjamin = '0';
            $tagihan_pribadi = $a['harga2_order'] * $a['qty_order'] + 1200 + 500;
            $kategori_resep = 'Resep Tunai';
            $kode_tipe_transaki = 1;
            $status_layanan = 1;
        }
        $totalheader = 0;
        //end layanan header

        //create layanan detail
        foreach ($arrayindex_far as $a) {
            $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
            $total = $a['harga2_order'] * $a['qty_order'];
            $diskon = $a['disc_order'];
            $hitung = $diskon / 100 * $total;
            $grandtotal = $total - $hitung + 1200 + 500;
            $ts_layanan_detail = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => '',
                'total_tarif' => $a['harga2_order'],
                'jumlah_layanan' => $a['qty_order'],
                'total_layanan' => $total,
                'diskon_layanan' => $a['disc_order'],
                'grantotal_layanan' => $grandtotal,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'kode_barang' => $a['kode_barang_order'],
                'aturan_pakai' => $a['dosis_order'],
                'kategori_resep' => $kategori_resep,
                'satuan_barang' => $mt_barang[0]->satuan,
                'tagihan_pribadi' => $tagihan_pribadi,
                'tagihan_penjamin' => $tagihan_penjamin,
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $header->id,
            ];
            $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
            $ts_layanan_detail2 = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => 'TX23513',
                'total_tarif' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                'jumlah_layanan' => 1,
                'total_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                'grantotal_layanan' => $jsf[0]->jasa_resep + $jsf[0]->jasa_embalase,
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_pribadi' => '0',
                'tagihan_penjamin' => '0',
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $header->id,
            ];
            $detail2 = ts_layanan_detail_dummy::create($ts_layanan_detail2);
            $totalheader = $totalheader + $grandtotal;
        }
        if($data_kunjungan[0]->kode_penjamin != 'P01'){
            $tagian_penjamin_head = $jsf[0]->jasa_baca;
            $tagian_pribadi_head = 0;
        }else{
            $tagian_penjamin_head = 0;
            $tagian_pribadi_head = $jsf[0]->jasa_baca;
        }
        $ts_layanan_detail3 = [
            'id_layanan_detail' => $this->createLayanandetail(),
            'kode_layanan_header' => $kode_layanan_header,
            'kode_tarif_detail' => 'TX23523',
            'total_tarif' => $jsf[0]->jasa_baca,
            'jumlah_layanan' => 1,
            'total_layanan' => $jsf[0]->jasa_baca,
            'grantotal_layanan' => $jsf[0]->jasa_baca,
            'status_layanan_detail' => 'OPN',
            'tgl_layanan_detail' => $now,
            'tagihan_pribadi' => $tagian_pribadi_head,
            'tagihan_penjamin' => $tagian_penjamin_head,
            'tgl_layanan_detail_2' => $now,
            'row_id_header' => $header->id,
        ];
        $detail3 = ts_layanan_detail_dummy::create($ts_layanan_detail3);
        //end layanan detail


        //update layanan header
        $totalheader = $totalheader + $jsf[0]->jasa_baca;
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $tagihan_penjamin_header = $totalheader;
            $tagihan_pribadi_header = '0';
        } else {
            $tagihan_penjamin_header = '0';
            $tagihan_pribadi_header = '$totalheader';
        }
        ts_layanan_header_dummy::where('id', $header->id)
            ->update(['status_layanan' => $status_layanan, 'kode_tipe_transaksi' => $kode_tipe_transaki, 'total_layanan' => $totalheader, 'tagihan_penjamin' => $tagihan_penjamin_header, 'tagihan_pribadi' => $tagihan_pribadi_header]);
        //end update layanan header

        //next update ti kartu stok
        //next update ts resep header
        $data = [
            'kode' => 200,
            'message' => 'sukses',
        ];
        echo json_encode($data);
    }
    public function jumlah_grand_total(Request $request)
    {
        $subtot2 = $request->subtot2;
        $totalitem = $request->totalitem;
        $grandtotal = $request->grandtotal;
        $jumlahitem = $request->jumlahitem;
        if ($jumlahitem == 'null') {
            $jumlahitem = 1;
        } else {
            $jumlahitem = $request->jumlahitem + 1;
        };
        $new_total_item = $subtot2 + $totalitem;
        $grandtotal = $grandtotal + $subtot2 + 1200 + 500;
        $operator = '+';
        return view('farmasi.grand_total', compact([
            'new_total_item',
            'grandtotal',
            'operator',
            'jumlahitem'
        ]));
    }
    public function minus_grand_total(Request $request)
    {
        $subtot3 = $request->subtot3;
        $totalitem = $request->totalitem;
        $grandtotal = $request->grandtotal;
        $new_total_item = $totalitem - $subtot3;
        $nilai_min = $subtot3 + 1200 + 500;
        $grandtotal = $grandtotal - $nilai_min;
        $operator = '-';
        $jumlahitem = $request->jumlahitem;
        $jumlahitem = $jumlahitem - 1;
        return view('farmasi.grand_total', compact([
            'new_total_item',
            'grandtotal',
            'operator',
            'jumlahitem'
        ]));
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function createLayanandetail()
    {
        $q = DB::connection('mysql4')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
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
