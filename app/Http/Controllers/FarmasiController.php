<?php

namespace App\Http\Controllers;

use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_header_dummy;
use App\Models\ti_kartu_stok;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\code128;
use \Milon\Barcode\DNS1D;

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
        $arrayindex_reguler = [];
        $arrayindex_kronis = [];
        $arrayindex_kemo = [];
        $arrayindex_hibah = [];
        foreach ($data_obat as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'sub_total_order') {
                if ($dataSet['status_order_2'] == 80) {
                    $arrayindex_reguler[] = $dataSet;
                } else if ($dataSet['status_order_2'] == 81) {
                    $arrayindex_kronis[] = $dataSet;
                } else if ($dataSet['status_order_2'] == 82) {
                    $arrayindex_kemo[] = $dataSet;
                } else if ($dataSet['status_order_2'] == 83) {
                    $arrayindex_hibah[] = $dataSet;
                }
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
                die;
            }
        }
        $cek_reg = count($arrayindex_reguler);
        $cek_kron = count($arrayindex_kronis);
        $cek_kemo = count($arrayindex_kemo);
        $cek_hib = count($arrayindex_hibah);
        $data_kunjungan = DB::select('select *,fc_nama_px(no_rm) AS nama_pasien,fc_alamat(no_rm) AS alamat_pasien from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kodeunit = auth()->user()->unit;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kodeunit]);
        if ($data_kunjungan[0]->kode_penjamin != 'P01') {
            $kategori_resep = 'Resep Kredit';
            $kode_tipe_transaki = 2;
            $status_layanan = 2;
        } else {
            $kategori_resep = 'Resep Tunai';
            $kode_tipe_transaki = 1;
            $status_layanan = 1;
        }

        //insert resep reguler
        if ($cek_reg > 0) {
            $this->test_print();
            foreach ($arrayindex_reguler as $a) {
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
            $totalheader = 0;
            //create layanan detail
            foreach ($arrayindex_reguler as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;
                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat = $this->createLayanandetail();
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat,
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
                    'tipe_anestesi' => $a['status_order_2'],
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);

                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok

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
            //end layanan detail

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

        }
        //end of reguler

        //insert resep Kronis
        if ($cek_kron > 0) {
            foreach ($arrayindex_kronis as $a) {
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
            $totalheader = 0;
            //create layanan detail
            foreach ($arrayindex_kronis as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;

                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat_kronis = $this->createLayanandetail();
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat_kronis,
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
                    'tipe_anestesi' => $a['status_order_2'],
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);

                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat_kronis,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok


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
            //end layanan detail

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
        }
        //end of Kronis

        //insert resep kemo
        if ($cek_kemo > 0) {
            foreach ($arrayindex_kemo as $a) {
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
            $totalheader = 0;
            //create layanan detail
            foreach ($arrayindex_kemo as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 1200 + 500;

                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat_kemo = $this->createLayanandetail();
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat_kemo,
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
                    'tipe_anestesi' => $a['status_order_2'],
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat_kemo,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok

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
            //end layanan detail

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
        }
        //end of kemo

        //insert resep hibah
        if ($cek_hib > 0) {
            foreach ($arrayindex_hibah as $a) {
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
            $totalheader = 0;
            //create layanan detail
            foreach ($arrayindex_hibah as $a) {
                $mt_barang = DB::select('select * from mt_barang where kode_barang = ?', [$a['kode_barang_order']]);
                $total = $a['harga2_order'] * $a['qty_order'];
                $diskon = $a['disc_order'];
                $hitung = $diskon / 100 * $total;
                $grandtotal = $total - $hitung + 0 + 0;

                if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                    $tagihan_pribadi = 0;
                    $tagihan_penjamin = $grandtotal;
                } else {
                    $tagihan_pribadi = $grandtotal;
                    $tagihan_penjamin = 0;
                }
                $kode_detail_obat_hibah = $this->createLayanandetail();
                $ts_layanan_detail = [
                    'id_layanan_detail' => $kode_detail_obat_hibah,
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
                    'tipe_anestesi' => $a['status_order_2'],
                    'tagihan_pribadi' => $tagihan_pribadi,
                    'tagihan_penjamin' => $tagihan_penjamin,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $header->id,
                ];
                $detail = ts_layanan_detail_dummy::create($ts_layanan_detail);
                //insert_ti_kartu_stok
                $cek_stok_curr = db::select('SELECT * FROM ti_kartu_stok WHERE NO = ( SELECT MAX(a.no ) AS nomor FROM ti_kartu_stok a WHERE kode_barang = ? AND kode_unit = ? )', ([$a['kode_barang_order'], auth()->user()->unit]));
                $stok_last = $cek_stok_curr[0]->stok_current;
                $stok_current = $cek_stok_curr[0]->stok_current - $a['qty_order'];

                $data_ti_kartu_stok = [
                    'no_dokumen' => $kode_layanan_header,
                    'no_dokumen_detail' => $kode_detail_obat_hibah,
                    'tgl_stok' => $this->get_now(),
                    'kode_unit' => auth()->user()->unit,
                    'kode_barang' => $a['kode_barang_order'],
                    'stok_last' => $stok_last,
                    'stok_out' => $a['qty_order'],
                    'stok_current' => $stok_current,
                    'harga_beli' => $mt_barang[0]->harga_beli,
                    'act' => '1',
                    'act_ed' => '1',
                    'input_by' => auth()->user()->id,
                    'keterangan' => $data_kunjungan[0]->no_rm . '|' . $data_kunjungan[0]->nama_pasien . '|' . $data_kunjungan[0]->alamat_pasien,
                ];
                $insert_ti_kartu_stok = ti_kartu_stok::create($data_ti_kartu_stok);
                //end of insert ti_kartu_Stok

                $ts_layanan_detail2 = [
                    'id_layanan_detail' => $this->createLayanandetail(),
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => 'TX23513',
                    'total_tarif' => 0,
                    'jumlah_layanan' => 1,
                    'total_layanan' => 0,
                    'grantotal_layanan' => 0,
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
            //end layanan detail

            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = 0;
            } else {
                $tagian_penjamin_head = 0;
                $tagian_pribadi_head = 0;
            }
            $ts_layanan_detail3 = [
                'id_layanan_detail' => $this->createLayanandetail(),
                'kode_layanan_header' => $kode_layanan_header,
                'kode_tarif_detail' => 'TX23523',
                'total_tarif' => 0,
                'jumlah_layanan' => 1,
                'total_layanan' => 0,
                'grantotal_layanan' => 0,
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
            $totalheader = $totalheader + 0;
            if ($data_kunjungan[0]->kode_penjamin != 'P01') {
                $tagihan_penjamin_header = $totalheader;
                $tagihan_pribadi_header = '0';
            } else {
                $tagihan_penjamin_header = '0';
                $tagihan_pribadi_header = $totalheader;
            }
            ts_layanan_header_dummy::where('id', $header->id)
                ->update(['status_layanan' => $status_layanan, 'kode_tipe_transaksi' => $kode_tipe_transaki, 'total_layanan' => $totalheader, 'tagihan_penjamin' => $tagihan_penjamin_header, 'tagihan_pribadi' => $tagihan_pribadi_header]);
            //end update layanan header
        }
        //end of hibah


        $data = [
            'kode' => 200,
            'message' => 'sukses',
        ];
        echo json_encode($data);
        die;
        // dd('ok');
    }
    public function jumlah_grand_total(Request $request)
    {
        $status = $request->status;
        $resep_reguler = $request->resepreguler;
        $resep_kronis = $request->resepkronis;
        $resep_kemo = $request->resephibah;
        $resep_hibah = $request->resepkemo;
        if ($status == '80') {
            $resep_reguler = $resep_reguler + 1;
        } else if ($status == '81') {
            $resep_kronis = $resep_kronis + 1;
        } else if ($status == '82') {
            $resep_kemo = $resep_kemo + 1;
        } else if ($status == '83') {
            $resep_hibah = $resep_hibah + 1;
        }

        if ($resep_reguler > 0) {
            $reguler = 1;
        } else {
            $reguler = 0;
        }
        if ($resep_kronis > 0) {
            $kronis = 1;
        } else {
            $kronis = 0;
        }
        if ($resep_kemo > 0) {
            $kemo = 1;
        } else {
            $kemo = 0;
        }
        if ($resep_hibah > 0) {
            $hibah = 0;
        } else {
            $hibah = 0;
        }

        $total_resep = $reguler + $kronis + $kemo + $hibah;
        $jasa_resep_lbr = 1000 * $total_resep;
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
            'jumlahitem',
            'resep_reguler',
            'resep_kronis',
            'resep_kemo',
            'resep_hibah',
            'jasa_resep_lbr',
            'total_resep'
        ]));
    }
    public function minus_grand_total(Request $request)
    {
        $reguler = $request->resepreguler;
        $kronis = $request->resepkronis;
        $hibah = $request->resephibah;
        $kemo = $request->resepkemo;
        $jenis = $request->jenis;
        if ($jenis == 80) {
            $reguler = $reguler - 1;
        }
        if ($jenis == 81) {
            $kronis = $kronis - 1;
        }
        if ($jenis == 82) {
            $kemo = $kemo - 1;
        }
        if ($jenis == 83) {
            $hibah = $hibah - 1;
        }
        $resep_reguler = $reguler;
        $resep_kronis = $kronis;
        $resep_kemo = $kemo;
        $resep_hibah = $hibah;

        if ($resep_reguler > 0) {
            $reguler = 1;
        } else {
            $reguler = 0;
        }
        if ($resep_kronis > 0) {
            $kronis = 1;
        } else {
            $kronis = 0;
        }
        if ($resep_kemo > 0) {
            $kemo = 1;
        } else {
            $kemo = 0;
        }
        if ($resep_hibah > 0) {
            $hibah = 0;
        } else {
            $hibah = 0;
        }

        $total_resep = $reguler + $kronis + $kemo + $hibah;
        $jasa_resep_lbr = 1000 * $total_resep;
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
            'jumlahitem',
            'resep_reguler',
            'resep_kronis',
            'resep_kemo',
            'resep_hibah',
            'jasa_resep_lbr',
            'total_resep'
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
    public function test_print()
    {
        // ambil ip client
        // dd($this->get_client_ip_env());
        // $connector = new WindowsPrintConnector("termal1");
        // // $connector = new WindowsPrintConnector("smb://computername/Receipt Printer");
        // // $connector = new FilePrintConnector("EPSON TM-T82X Receipt");
        // $printer = new Printer($connector);
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->text("Hello World!\n");
        // $printer->cut();
        // $printer->close();
        // require('code128.php');
        $pdf = new Fpdf('P', 'in', array('1.97', '2.36'));
        $pdf = new code128('P', 'in', array('1.97', '2.36'));
        // $pdf = new Fpdf('P', 'in',array('3.35','2.22'));
        $pdf->SetMargins(0, 0, 0);
        $pdf->AddPage();
        $pdf->SetTitle('Cetak nota');
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Image('public/img/logo_rs2.png', 0.08, 0.05, 0.2, 0.2);
        $pdf->SetXY(0.5, 0.05);
        $pdf->Cell(0.3, 0.10, 'INSTALASI FARMASI', 0, 0);
        $pdf->SetXY(0.3, 0.15);
        $pdf->Cell(0.3, 0.10, 'RSUD WALED KAB. CIREBON', 0, 0);
        $pdf->Line(0, 0.34, 100, 0.34);
        $pdf->SetXY(0, 0.4);
        $pdf->Cell(0.3, 0.10, '23982408', 0, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(1, 0.4);
        $pdf->Cell(0.3, 0.10, '22/28/1991' . '   ' . '56', 0, 0);
        $pdf->SetXY(0, 0.6);
        $pdf->Cell(0.3, 0.10, 'RIMBOS', 0, 0);
        $pdf->SetXY(0, 0.8);
        $pdf->Cell(0.3, 0.10, 'RT 99/99 BLOK M', 0, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(0, 1);
        $pdf->Cell(0.3, 0.10, 'SANTAGESIK INJ', 0, 0);
        //C set
        $code = '12345678901234567890';
        $pdf->Code128(50, 120, $code, 110, 20);
        $pdf->SetXY(50, 145);
        $pdf->Write(5, 'C set: "' . $code . '"');
        // $pdf->SetXY(0, 1.2);
        // $pdf->Cell(0.3, 0.10, $barcode, 0, 0);
        $pdf->SetFont('Arial', '', 5);
        $pdf->SetXY(0, 1.470);
        $pdf->Cell(0.3, 0.10, '06-09-2023', 0, 0);
        $pdf->SetXY(1.2, 1.470);
        $pdf->Cell(0.3, 0.10, 'EXP 06-09-2023', 0, 0);
        $pdf->Output();
        exit;
        // return;
    }
}
