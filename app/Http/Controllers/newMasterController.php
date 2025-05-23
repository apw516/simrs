<?php

namespace App\Http\Controllers;

use App\Models\mt_bhp_detail;
use App\Models\mt_bhp_header;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class newMasterController extends Controller
{
    public function indexmastertarif()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'indexmastertarif';
        $sidebar_m = '2';
        $now = $this->get_date();
        return view('master_tarif.index_master_tarif', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'now'
        ]));
    }
    public function carinamatarif(Request $request)
    {
        $namatarif = $request->namatarif;
        $get_tarif_header = db::select("select * from mt_tarif_header a left outer join mt_tarif_kelompok b on a.KELOMPOK_TARIF_ID = b.kelompok_tarif_id where a.NAMA_TARIF LIKE ?", ['%' . $namatarif . '%']);
        return view('master_tarif.tabel_master_tarif_header', compact(['get_tarif_header']));
    }
    public function detailmastertarif(Request $request)
    {
        $id = $request->idtarif;
        $dataheader = db::select("select * from mt_tarif_header a left outer join mt_tarif_kelompok b on a.KELOMPOK_TARIF_ID = b.kelompok_tarif_id where a.KODE_TARIF_HEADER = ?", [$id]);
        $datadetail = db::select("select * from mt_tarif_detail where KODE_TARIF_HEADER = ?", [$id]);
        return view('master_tarif.detail_tarif', compact([
            'dataheader',
            'datadetail'
        ]));
    }
    public function ambilforminsertbhp(Request $request)
    {
        $kodetarifheader = $request->kodetarifheader;
        $dataheader = db::select("select * from mt_tarif_header a left outer join mt_tarif_kelompok b on a.KELOMPOK_TARIF_ID = b.kelompok_tarif_id where a.KODE_TARIF_HEADER = ?", [$kodetarifheader]);
        return view('master_tarif.form_insert_bhp', compact([
            'dataheader'
        ]));
    }
    public function caribarangbhp(Request $request)
    {
        $namabarang = $request->namabarang;
        $masterbarang = db::select("select * from mt_barang a where a.nama_barang LIKE ?", ['%' . $namabarang . '%']);
        return view('master_tarif.tabel_bhp', compact([
            'masterbarang'
        ]));
    }
    public function simpandatabhp(Request $request)
    {
        $kodetarifheader = $request->kodetarifheader;
        $namatarif = $request->namatarif;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama2) {
            $index2 = $nama2['name'];
            $value2 = $nama2['value'];
            $dataSet2[$index2] = $value2;
            if ($index2 == 'kebutuhan') {
                $arrayobat[] = $dataSet2;
            }
        }
        $databhpheader = [
            'kode_tarif_header' => $kodetarifheader,
            'nama_tarif_header' => $namatarif,
            'tanggal_input' => $this->get_now(),
            'status' => 1,
            'input_by' => auth()->user()->id,
        ];
        $dh = mt_bhp_header::create($databhpheader);
        foreach ($arrayobat as $a) {
            $databhpdetail = [
                'id_header_bhp' => $dh->id,
                'KODE_BARANG' => $a['kodebarang'],
                'NAMA_BARANG' => $a['namabarang'],
                'satuan' => $a['satuan'],
                'sediaan' => $a['sediaan'],
                'kebutuhan' => $a['kebutuhan'],
            ];
            $dt = mt_bhp_detail::create($databhpdetail);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
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
}
