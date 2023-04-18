<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ts_layanan_header_order;

class PenunjangController extends Controller
{
    public function index()
    {
        $title = 'SIMRS - PENUNJANG';
        $sidebar = '6';
        $sidebar_m = '6';
        return view('penunjang.index', compact([
            'title',
            'sidebar',
            'sidebar_m'
        ]));
    }
    public function ambildataorderan()
    {
        $unit = auth()->user()->unit;
        $order = DB::select('SELECT id,kode_penjaminx,tagihan_penjamin,tagihan_pribadi,status_order,tgl_entry,tgl_periksa,kode_layanan_header,no_rm,fc_nama_px(no_rm) AS nama,fc_nama_unit1(unit_pengirim) as unit_kirim FROM ts_layanan_header_order WHERE status_layanan = ? AND status_order != ? AND kode_unit = ?', [1, 0,$unit]);
        return view('penunjang.tableorder', compact([
            'order'
        ]));
    }
    public function reloadorder()
    {
        $order = DB::select('SELECT tgl_entry,tgl_periksa,kode_layanan_header,no_rm,fc_nama_px(no_rm) AS nama,fc_nama_unit1(unit_pengirim) as unit_kirim FROM ts_layanan_header_order WHERE status_layanan = ? AND status_order = ?', [1, 1]);
        $count = count($order);
        if ($count > 0) {
            $data = [
                'kode' => 200,
                'total' => $count
            ];
            echo json_encode($data);
            die;
        } else {
            $data = [
                'kode' => 500,
                'total' => $count
            ];
            echo json_encode($data);
            die;
        }
    }
    public function ambildetailorder(Request $request)
    {
        $id = $request->id;
        $unit = auth()->user()->unit;
        if($unit == '4008' || $unit == '4002'){
            $detail = DB::select('SELECT *,a.id as id_heaeder,a.tagihan_pribadi as tagihan_pribadi_header,a.tagihan_penjamin as tagihan_penjamin_header,fc_nama_tarif(LEFT(b.kode_tarif_detail,6)) as nama_tarif, fc_nama_unit1(a.kode_unit) as unit_tujuan, fc_nama_unit1(a.unit_pengirim) as unit_asal,b.jumlah_layanan as jlh_layanan, b.grantotal_layanan as total,fc_NAMA_PENJAMIN2(a.kode_penjaminx) as nama_penjamin,fc_NAMA_PARAMEDIS(a.dok_kirim) as dok_kirim,fc_nama_barang(b.kode_barang) as nama_barang,b.aturan_pakai,b.kategori_resep,b.satuan_barang FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.row_id_header WHERE a.`id` = ?', [$id]);
            return view('penunjang.detailorder_farmasi', compact([
                'detail'
            ]));
        }else{
            $detail = DB::select('SELECT *,a.id as id_heaeder,a.tagihan_pribadi as tagihan_pribadi_header,a.tagihan_penjamin as tagihan_penjamin_header,fc_nama_tarif(LEFT(b.kode_tarif_detail,6)) as nama_tarif, fc_nama_unit1(a.kode_unit) as unit_tujuan, fc_nama_unit1(a.unit_pengirim) as unit_asal,b.jumlah_layanan as jlh_layanan, b.grantotal_layanan as total,fc_NAMA_PENJAMIN2(a.kode_penjaminx) as nama_penjamin,fc_NAMA_PARAMEDIS(a.dok_kirim) as dok_kirim FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.row_id_header WHERE a.`id` = ?', [$id]);
            return view('penunjang.detailorder', compact([
                'detail'
            ]));
        }
    }
    public function terimaordernya(Request $request)
    {
        $data1 = [
            'status_order' => 2
        ];
        try {
            $a = ts_layanan_header_order::whereRaw('id = ?', array($request->idorder))->update($data1);
            $data = [
                'code' => 200,
                'message' => 'Data berhasil diupdate !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'code' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
}
