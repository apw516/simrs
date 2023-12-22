<?php

namespace App\Http\Controllers;

use App\Models\headersurat;
use App\Models\Pasien;
use App\Models\suratnapsa;
use App\Models\suratjasmani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Codedge\Fpdf\Fpdf\PDF;

class McuController extends Controller
{
    public function index_mcu()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'index_mcu';
        $sidebar_m = '2';
        $date = $this->get_date();
        $paramedis = DB::select('select *,fc_nama_unit1(unit) as nama_unit from mt_paramedis');
        return view('mcu.index', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'paramedis',
            'date'
        ]));
    }
    public function suratkejiwaan_index()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'suratkejiwaan';
        $sidebar_m = '2';
        $date = $this->get_date();
        $paramedis = DB::select('select *,fc_nama_unit1(unit) as nama_unit from mt_paramedis');
        return view('mcu.tabel_surat_kejiwaan', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'paramedis',
            'date'
        ]));
    }
    public function suratnapsa_index()
    {
        $title = 'SIMRS - ERM';
        $sidebar = 'suratnapsa';
        $sidebar_m = '2';
        $date = $this->get_date();
        $paramedis = DB::select('select *,fc_nama_unit1(unit) as nama_unit from mt_paramedis');
        return view('mcu.tabel_surat_napsa', compact([
            'title',
            'sidebar',
            'sidebar_m',
            'paramedis',
            'date'
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
                        'alamat' => $row['alamat']
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
        $rm = $dataSet['nomorrm2'];
        if (count($cek) > 0) {
            $data = [
                'kode' => 500,
                'message' => 'Header Sudah Ada ! Untuk perubahan silahkan update header ...',
            ];
            echo json_encode($data);
            die;
        } else {
            headersurat::create($data_s);
        }

        //surat jasmani
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
            'no_surat'       => "400.7.22.1 / " . $dataSet['suratjasmani'] . " / MCU / 2023",
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
        if ($dataSet['suratjasmani'] != '') {
            suratjasmani::create($data);
        }
        $data = [
            'no_rm'          => $rm,
            'no_surat'       => "400.7.22.1 / " . $dataSet['suratrohani'] . " / MCU / 2023",
            'nama_px'        => strtoupper($p[0]->nama_px),
            'tempat_lahir'   => ucwords(strtolower($p[0]->tempat_lahir)),
            'tgl_lahir'      => $p[0]->tanggal_lahir,
            'alamat'         => $h[0]->alamat,
            'desa'           => ucwords(strtolower($p[0]->nama_desa_kelurahan)),
            'kecamatan'      => ucwords(strtolower($p[0]->nama_kecamatan)),
            'kabupaten'      => ucwords(strtolower($p[0]->nama_kabupaten_kota)),
            'result'         => 'SEHAT',
            'keterangan'         => 'Rohani',
            'pekerjaan'      => $h[0]->pekerjaan,
            'bb'             => $h[0]->bb,
            'tb'             => $h[0]->tb,
            'td'             => $h[0]->td,
            'keperluan'      => $dataSet['keperluan'],
            'tgl_surat'      => $dataSet['tglsurat'],
            'kode_paramedis' => 'DOK334',
            'status'         => 'A',
            'data_created'   => date('Y-m-d H:i:s'),
            'id_user'        => '37',
        ];
        if ($dataSet['suratrohani'] != '') {
            suratjasmani::create($data);
        }
        //suratnapsa
        $data = [
            'no_rm'          => $rm,
            'no_surat'       => "400.7.22.1 / " . $dataSet['suratnapsa'] . " / MCU / 2023",
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
        if ($dataSet['suratnapsa'] != '') {
            suratnapsa::create($data);
        }
        $data = [
            'kode' => 200,
            'message' => 'Data Berhasil disimpan',
        ];
        echo json_encode($data);
        die;
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
    public function ambildatasurat()
    {
        $dh = DB::select('select * from ts_mcu_jasroh where keterangan = ? order by id_surat desc', ['jasmani']);
        return view('mcu.tabel_data_rohani', compact(
            [
                'dh'
            ]
        ));
    }
    public function ambildatasuratnapsa()
    {
        $dh = DB::select('select * from ts_mcu_narkoba  order by id_surat desc');
        return view('mcu.tabel_data_napsa', compact(
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
    public function cetak_rohani($id)
    {
        $surat = DB::select('select * from ts_mcu_jasroh where id_surat = ?', [$id]);
        $tgl_lahir = Carbon::parse($surat[0]->tgl_lahir)->isoFormat('D MMMM Y');
        $tgl_surat = Carbon::parse($surat[0]->tgl_surat)->isoFormat('D MMMM Y');
        $pdf = new Fpdf('P', 'mm', 'Legal');
        $pdf->AddPage();
        $pdf->SetTitle('Cetak Rohani');
        $pdf->SetAutoPageBreak(true, 1);
        $pdf->SetFont('Times', 'BU', 16);
        $pdf->SetXY(32, 45);
        $pdf->Cell(40, 10, 'SURAT KETERANGAN PEMERIKSAAN KESEHATAN JIWA');
        $pdf->SetFont('Times', 'B', 16);
        $pdf->SetXY(75, 52);
        $pdf->Cell(35, 10, 'No : ' . $surat[0]->no_surat);

        $pdf->SetFont('Times', '', 15);
        $pdf->SetXY(94, 52);
        $pdf->Cell(40, 10, '');
        $pdf->SetXY(20, 65);
        $pdf->Cell(40, 10, 'Yang Bertanda Tangan Di bawah ini :   ');

        $pdf->SetXY(20, 75);
        $pdf->Cell(40, 10, 'Nama');
        $pdf->SetXY(85, 75);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, 75);
        $pdf->Cell(40, 10, "dr. HERMANSYAH SUWARNO,Sp. KJ");

        $pdf->SetXY(20, 82.5);
        $pdf->Cell(40, 10, 'NIP');
        $pdf->SetXY(85, 82.5);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, 82.5);
        $pdf->Cell(40, 10, "19780130 201101 1 001");


        $pdf->SetXY(20, 90);
        $pdf->Cell(40, 10, 'Jabatan');
        $pdf->SetXY(85, 90);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, 90);
        $pdf->Cell(40, 10, "Dokter Spesialis Kedokteran Jiwa");



        $pdf->SetXY(20, 97.5);
        $pdf->Cell(40, 10, 'Instansi');
        $pdf->SetXY(85, 97.5);
        $pdf->Cell(40, 10, ':  RSUD Waled Kabupaten Cirebon');

        $pdf->SetXY(20, 115);
        $pdf->MultiCell(165, 5, 'Telah melakukan pemeriksaan psikiatri / MMPI pada Tanggal ' . $tgl_surat . ' terhadap : ');

        $y = $pdf->GetY() + 5;

        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Nama');
        $pdf->SetXY(85, $y);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, $y + 2);
        $pdf->MultiCell(95, 7, $surat[0]->nama_px);


        $y = $pdf->GetY();

        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Tempat / Tgl Lahir');
        $pdf->SetXY(85, $y);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, $y + 2);
        $pdf->MultiCell(95, 7, $surat[0]->tempat_lahir . ' ,' . $tgl_lahir);
        $y = $pdf->GetY();

        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Pekerjaan');
        $pdf->SetXY(85, $y);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, $y + 2);
        $pdf->MultiCell(95, 7, $surat[0]->pekerjaan);
        $y = $pdf->GetY();

        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Alamat');
        $pdf->SetXY(85, $y);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, $y + 2);
        $pdf->MultiCell(95, 7, $surat[0]->alamat . ' ' . $surat[0]->desa . ' Kec. ' . $surat[0]->kecamatan . '  ' . $surat[0]->kabupaten);

        $y = $pdf->GetY();

        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Keperluan');
        $pdf->SetXY(85, $y);
        $pdf->Cell(40, 10, ':');
        $pdf->SetXY(90, $y + 2);
        $pdf->MultiCell(95, 7, "Persyaratan Pemberkasan PPPK");



        $y = $pdf->GetY() + 4;
        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Dengan Hasil Pemeriksaan Kesehatan Jiwa pada saat ini :');

        $y = $pdf->GetY() + 10;
        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, '1. Psikopatologi');
        $y = $pdf->GetY() + 8;
        $pdf->SetXY(30, $y);
        $pdf->Cell(40, 10, '-');

        $y = $pdf->GetY();

        $pdf->SetXY(35, $y + 2);
        $pdf->MultiCell(152, 7, "Saat ini Ditemukan / Tidak Ditemukan tanda / gejala gangguan mental emosional yang bermakna dan berpengaruh terhadap emosi, pikiran dan perilaku serta dapat mengganggu aktivitas kehidupan sehari - hari");


        $y = $pdf->GetY() + 5;
        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, '2. Ciri Kepribadian');
        $y = $pdf->GetY() + 8;
        $pdf->SetXY(30, $y);
        $pdf->Cell(40, 10, '-');

        $y = $pdf->GetY();
        $pdf->SetXY(35, $y + 2);
        $pdf->MultiCell(152, 7, "Tidak didapatkan ciri kepribadian khusus");
        $pdf->SetFont('Times', '', 15);

        $y = $pdf->GetY() + 4;
        $pdf->SetXY(20, $y);
        $pdf->Cell(40, 10, 'Demikian Surat Keterangan Pemeriksaan Kesehatan Jiwa ini dibuat dengan sebenarnya');

        $y = $pdf->GetY() + 25;
        $pdf->SetFont('Times', '', 15);

        $pdf->SetXY(125, $y);
        $pdf->Cell(40, 10, 'Cirebon, ' . $tgl_surat);
        $y = $pdf->GetY() + 6;
        $pdf->SetXY(135, $y);
        $pdf->Cell(40, 10, 'Dokter Pemeriksa');

        $pdf->SetFont('Times', 'U', 16);
        $pdf->SetXY(110, 315);
        $pdf->Cell(40, 10, 'dr. HERMANSYAH SUWARNO,Sp.Kj');

        $pdf->SetFont('Times', '', 16);
        $pdf->SetXY(122, 322);
        $pdf->Cell(40, 10, 'NIP. 19780130 201101 1 001');

        $pdf->Output();

        exit;
    }
}
