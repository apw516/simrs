<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\mt_pasien_igd;

class AntrianIgd extends Controller
{
    public function index()
    {
        return view('antrianigd.index');
    }
    public function datapasien_igd()
    {
        $now = $this->get_date();
        $pasien_igd = DB::select('select * from mt_pasien_igd where date(tanggal_entry) = ?', [$now]);
        return view('antrianigd.tabelpasien', compact(['pasien_igd']));
    }
    public function simpanpasien(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $datapasien = [
            'nama_px' => $dataSet['namapasien'],
            'alamat' => $dataSet['alamat'],
            'tanggal_entry' => $this->get_now(),
        ];
        try {
            mt_pasien_igd::create($datapasien);
            $data = [
                'kode' => 200,
                'message' => 'berhasil'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
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
