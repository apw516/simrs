<?php

namespace App\Http\Controllers;

use App\Models\headersurat;
use App\Models\Pasien;
use App\Models\suratnapsa;
use App\Models\suratjasmani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class McuController extends Controller
{
    public function index_mcu()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'index_mcu';
        $sidebar_m = '2';
        $paramedis = DB::select('select *,fc_nama_unit1(unit) as nama_unit from mt_paramedis');
        return view('mcu.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'paramedis'
        ]));
    }
    public function caripasien_mcu(request $request)
    {
        $r = $request['term'];
        if (strlen($r) > 6) {
            $result = Pasien::where('no_rm', 'LIKE', "%{$r}%")->get();
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label' => $row['no_rm'] . ' | ' . $row['nama_px'] . ' | ' . $row['tgl_lahir'],
                        'rm' => $row['no_rm'],
                        'nama' => strtoupper($row['nama_px']),
                    );
                echo json_encode($arr_result);
            }
        }
    }
    public function simpanheader(Request $request)
    {
        $dataheader = json_decode($_POST['data'], true);
        foreach ($dataheader as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_s = [
            'no_rm' => $dataSet['nomorrm2'],
            'nama_px' => strtoupper($dataSet['namapasien']),
            'alamat' => $dataSet['alamat'],
            'pekerjaan' => $dataSet['pekerjaan'],
            'tb' => $dataSet['tinggibadan'],
            'bb' => $dataSet['beratbadan'],
            'td' => $dataSet['tekanandarah'],
        ];
        $cek = DB::select('select * from ts_header_surat_mcu where no_rm = ?', [$dataSet['nomorrm2']]);
        if (count($cek) > 0) {
            $data = [
                'kode' => 500,
                'message' => 'Header Sudah Ada ! Untuk perubahan silahkan update header ...',
            ];
            echo json_encode($data);
            die;
        } else {
            headersurat::create($data_s);
            $data = [
                'kode' => 200,
                'message' => 'Data Berhasil disimpan',
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpaneditheader(Request $request)
    {
        $dataheader = json_decode($_POST['data'], true);
        foreach ($dataheader as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }
        $data_s = [
            'no_rm' => $dataSet['nomorrm'],
            'nama_px' => strtoupper($dataSet['namapasien']),
            'alamat' => $dataSet['alamat'],
            'pekerjaan' => $dataSet['pekerjaan'],
            'tb' => $dataSet['tinggibadan'],
            'bb' => $dataSet['beratbadan'],
            'td' => $dataSet['tekanandarah'],
        ];
        $id = $dataSet['id'];
        headersurat::whereRaw('id = ?', array($id))->update($data_s);
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil Diedit',
        ];
        echo json_encode($data);
        die;
    }
    public function simpanjasmani(Request $request)
    {
        $dataheader = json_decode($_POST['data'], true);
        foreach ($dataheader as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }

        $rm = $dataSet['no_rm'];
        $p = DB::select("SELECT mt_pasien.*,date(tgl_lahir) as tanggal_lahir,mt_lokasi_provinces.name AS nama_propinsi
        ,IF(mt_lokasi_regencies.name LIKE '%KABUPATEN%'
        ,CONCAT('KABUPATEN ',LEFT(mt_lokasi_regencies.name
        ,LOCATE(' ',mt_lokasi_regencies.name) - 1))
        ,CONCAT('KOTA ',LEFT(mt_lokasi_regencies.name
        ,LOCATE(' ',mt_lokasi_regencies.name) - 1))) AS nama_kabupaten_kota,mt_lokasi_districts.name AS nama_kecamatan
        ,IF(mt_lokasi_regencies.name LIKE '%KABUPATEN%'
        ,CONCAT('Desa ',mt_lokasi_villages.name)
        ,CONCAT('Kelurahan ',mt_lokasi_villages.name)) AS nama_desa_kelurahan
        FROM mt_pasien
        JOIN mt_lokasi_provinces ON mt_lokasi_provinces.id = mt_pasien.kode_propinsi
        JOIN mt_lokasi_regencies ON mt_lokasi_regencies.id = mt_pasien.kode_kabupaten
        JOIN mt_lokasi_districts ON mt_lokasi_districts.id = mt_pasien.kode_kecamatan
        JOIN mt_lokasi_villages ON mt_lokasi_villages.id = mt_pasien.kode_desa
        WHERE mt_pasien.no_rm = ?", [$rm]);
        $h = DB::select('select * from ts_header_surat_mcu where no_rm = ?', [$rm]);
        $data = [
            'no_rm'          => $rm,
            'no_surat'       => $dataSet['nomorsurat'],
            'nama_px'        => strtoupper($p[0]->nama_px),
            'tempat_lahir'   => ucwords(strtolower($p[0]->tempat_lahir)),
            'tgl_lahir'      => $p[0]->tanggal_lahir,
            'alamat'         => $h[0]->alamat,
            'desa'           => ucwords(strtolower($p[0]->nama_desa_kelurahan)),
            'kecamatan'      => ucwords(strtolower($p[0]->nama_kecamatan)),
            'kabupaten'      => ucwords(strtolower($p[0]->nama_kabupaten_kota)),
            'result'         => 'SEHAT',
            'keterangan'         => 'Jasmani',
            'pekerjaan'      => $h[0]->pekerjaan,
            'bb'             => $h[0]->bb,
            'tb'             => $h[0]->tb,
            'td'             => $h[0]->td,
            'keperluan'      => $dataSet['keperluan'],
            'tgl_surat'      => $dataSet['tglsurat'],
            'kode_paramedis' => 'DOK065',
            'status'         => 'A',
            'data_created'   => date('Y-m-d H:i:s'),
            'id_user'        => '37',
        ];
        // dd($data);
        suratjasmani::create($data);
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan',
        ];
        echo json_encode($data);
        die;
    }
    public function simpannapsa(Request $request)
    {
        $dataheader = json_decode($_POST['data'], true);
        foreach ($dataheader as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
        }

        $rm = $dataSet['no_rm'];
        $p = DB::select("SELECT mt_pasien.*,date(tgl_lahir) as tanggal_lahir,mt_lokasi_provinces.name AS nama_propinsi
        ,IF(mt_lokasi_regencies.name LIKE '%KABUPATEN%'
        ,CONCAT('KABUPATEN ',LEFT(mt_lokasi_regencies.name
        ,LOCATE(' ',mt_lokasi_regencies.name) - 1))
        ,CONCAT('KOTA ',LEFT(mt_lokasi_regencies.name
        ,LOCATE(' ',mt_lokasi_regencies.name) - 1))) AS nama_kabupaten_kota,mt_lokasi_districts.name AS nama_kecamatan
        ,IF(mt_lokasi_regencies.name LIKE '%KABUPATEN%'
        ,CONCAT('Desa ',mt_lokasi_villages.name)
        ,CONCAT('Kelurahan ',mt_lokasi_villages.name)) AS nama_desa_kelurahan
        FROM mt_pasien
        JOIN mt_lokasi_provinces ON mt_lokasi_provinces.id = mt_pasien.kode_propinsi
        JOIN mt_lokasi_regencies ON mt_lokasi_regencies.id = mt_pasien.kode_kabupaten
        JOIN mt_lokasi_districts ON mt_lokasi_districts.id = mt_pasien.kode_kecamatan
        JOIN mt_lokasi_villages ON mt_lokasi_villages.id = mt_pasien.kode_desa
        WHERE mt_pasien.no_rm = ?", [$rm]);
        $h = DB::select('select * from ts_header_surat_mcu where no_rm = ?', [$rm]);

        $data = [
            'no_rm'          => $rm,
            'no_surat'       => $dataSet['nomorsurat'],
            'nama_px'        => strtoupper($p[0]->nama_px),
            'umur'           => date_diff(date_create($p[0]->tgl_lahir), date_create(date('Y-m-d')))->format('%y'),
            'tempat_lahir'   => ucwords(strtolower($p[0]->tempat_lahir)),
            'tgl_lahir'      => $p[0]->tanggal_lahir,
            'pekerjaan'      => $h[0]->pekerjaan,
            'alamat'         => $h[0]->alamat,
            'desa'           => ucwords(strtolower($p[0]->nama_desa_kelurahan)),
            'kecamatan'      => ucwords(strtolower($p[0]->nama_kecamatan)),
            'kabupaten'      => ucwords(strtolower($p[0]->nama_kabupaten_kota)),
            'result'         => 'SEHAT',
            'dipergunakan'   => $dataSet['keperluan'],
            'bb'             => $h[0]->bb,
            'tb'             => $h[0]->tb,
            'td'             => $h[0]->td,
            'jenis_kelamin'  => strtoupper($p[0]->jenis_kelamin),
            'tgl_surat'      => $dataSet['tglsurat'],
            'kode_paramedis' => 'DOK065',
            'status'         => 'A',
            'data_created'   => $this->get_now(),
            'id_user'        => '37',
            'data_updated'   => $this->get_now(),
            'user_updated'   => '37',
        ];

        suratnapsa::create($data);
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan',
        ];
        echo json_encode($data);
        die;
    }
    public function ambildataheader_mcu()
    {
        $dh = DB::select('select *,fc_alamat4(b.no_rm) as alamat_px,date(b.tgl_lahir) as tgl_lahir from ts_header_surat_mcu a inner join mt_pasien b on a.no_rm = b.no_rm');
        return view('mcu.tabel_header', compact(
            [
                'dh'
            ]
        ));
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function ambil_v_jasmani(request $request)
    {
        $rm = $request->rm;
        $date = $this->get_date();
        $p = DB::select('select * from mt_pasien where no_rm = ?', [$rm]);
        return view('mcu.form_jasmani', compact([
            'rm',
            'p',
            'date'
        ]));
    }
    public function ambil_v_napsa(request $request)
    {
        $rm = $request->rm;
        $date = $this->get_date();
        $p = DB::select('select * from mt_pasien where no_rm = ?', [$rm]);
        return view('mcu.form_napsa', compact([
            'rm',
            'p',
            'date'
        ]));
    }
    public function ambil_v_edit_header(request $request)
    {
        $p = DB::select('select * from ts_header_surat_mcu where id = ?', [$request->id]);
        return view('mcu.form_edit_header', compact([
            'p'
        ]));
    }
}
