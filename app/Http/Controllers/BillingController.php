<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ts_layanan_detail;
use App\Models\ts_layanan_header;
use Barryvdh\DomPDF\Facade\Pdf; // If you added the facade alias

class BillingController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function Billing()
    {
        $title = 'SIMRS - Billing Penunjang';
        $sidebar = 'billingpenunjang';
        $sidebar_m = 'billingpenunjang';
        $unit = auth()->user()->unit;
        return view('billing.index', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            // 'data_pasien' => DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('','','')")
        ]);
    }
    public function indexexpertisipa()
    {
        $title = 'SIMRS - Expertisi Patologi Anatomi';
        $sidebar = 'expertisipatologi';
        $sidebar_m = 'expertisipatologi';
        $unit = auth()->user()->unit;
        return view('billing.index_expertisi_pat', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            // 'data_pasien' => DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('','','')")
        ]);
    }
    public function indexriwayatpasienpenunjang()
    {
        $title = 'SIMRS - Billing Penunjang';
        $sidebar = 'riwayatpasienpenunjang';
        $sidebar_m = 'riwayatpasienpenunjang';
        $unit = auth()->user()->unit;
        return view('billing.riwayatpasienpenunjang', [
            'title' => $title,
            'sidebar' => $sidebar,
            'sidebar_m' => $sidebar_m,
            // 'data_pasien' => DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('','','')")
        ]);
    }
    public function cari_hasil_expertisi_pa(Request $request)
    {
        $tgl_awal = $request->tanggalawal;
        $tgl_akhir = $request->tanggalakhir;
        $data = DB::table('ts_hasil_expertisi_pa as a')
            ->join('ts_kunjungan as b', 'a.kode_kunjungan', '=', 'b.kode_kunjungan')
            ->join('ts_layanan_detail as c', 'a.id_detail', '=', 'c.id')
            ->join('mt_tarif_detail as d', 'c.kode_tarif_detail', '=', 'd.KODE_TARIF_DETAIL')
            ->join('mt_tarif_header as e', 'd.KODE_TARIF_HEADER', '=', 'e.KODE_TARIF_HEADER')
            ->select([
                'a.kode_kunjungan',
                'a.id as id_Ex',
                'b.tgl_masuk',
                'b.status_kunjungan',
                'b.no_rm',
                DB::raw('fc_nama_px(b.no_rm) AS nama_pasien'),
                DB::raw('fc_alamat(b.no_rm) AS alamat_pasien'),
                DB::raw('fc_NAMA_PENJAMIN2(b.kode_penjamin) AS nama_penjamin'),
                'a.kode_header AS kode_layanan_header',
                'a.id_detail',
                'a.unit_asal',
                'a.kode_dokter',
                DB::raw('fc_NAMA_PARAMEDIS1(a.kode_dokter) AS nama_dokter'),
                'c.kode_tarif_detail',
                'e.NAMA_TARIF',
                'a.*',
            ])
            ->whereBetween(DB::raw('DATE(tgl_input_layanan)'), [$tgl_awal, $tgl_akhir])
            ->get();
        return view('billing.tabel_hasil_expertisi_pa', compact([
            'data'
        ]));
    }
    public function cari_pasien_penunjang(Request $request)
    {
        $tgl_awal = $request->tanggalawal;
        $tgl_akhir = $request->tanggalakhir;
        $jenispasien = $request->jenispasien;
        $datakunjungan = DB::table('ts_kunjungan')
            ->select([
                'counter',
                'kode_kunjungan',
                'no_rm',
                DB::raw('fc_nama_px(no_rm) AS nama_pasien'),
                DB::raw('fc_alamat(no_rm) AS alamat_pasien'),
                DB::raw('fc_nama_unit1(kode_unit) AS nama_unit'),
                'tgl_masuk',
                'status_kunjungan',
                DB::raw('fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin'),
            ])
            ->whereBetween(DB::raw('DATE(tgl_masuk)'), [$tgl_awal, $tgl_akhir])
            ->where('status_kunjungan', '!=', 8)
            // Kondisi dinamis berdasarkan jenis pasien
            ->when($jenispasien == 1, function ($query) {
                return $query->where('kode_unit', '<', 2000);
            })
            ->when($jenispasien == 2, function ($query) {
                return $query->where('kode_unit', '>', 2000);
            })
            ->get();
        return view('billing.tabel_kunjungan', compact([
            'datakunjungan'
        ]));
    }
    public function cari_riwayat_pasien_penunjang(Request $request)
    {
        $tgl_awal = $request->tanggalawal;
        $tgl_akhir = $request->tanggalakhir;
        $data = DB::table('ts_layanan_header as a')
            ->join('ts_kunjungan as b', 'a.kode_kunjungan', '=', 'b.kode_kunjungan')
            ->select([
                'a.kode_kunjungan',
                'a.id as id_layanan_header',
                'a.kode_layanan_header',
                'b.no_rm',
                DB::raw('fc_nama_px(b.no_rm) as nama_pasien'),
                DB::raw('fc_alamat(b.no_rm) as alamat_pasien'),
                'a.tgl_entry as tgl_entry',
                'b.tgl_masuk as tgl_kunjungan',
                DB::raw('fc_NAMA_PENJAMIN2(b.kode_penjamin) as nama_penjamin'),
                DB::raw('fc_nama_unit1(b.kode_unit) as unit_pengirim'),
                'b.status_kunjungan',
            ])
            ->whereBetween(DB::raw('DATE(a.tgl_entry)'), [$tgl_awal, $tgl_akhir])
            ->where('a.kode_unit', '3020')
            ->where('a.status_layanan', '!=', 3)
            ->get();
        return view('billing.tabel_riwayat_pasien_penunjang', compact([
            'data'
        ]));
    }
    public function ambil_form_billing_penunjang(Request $request)
    {
        $noRm = $request->noRm;
        $nama = $request->nama;
        $kodeKunjungan = $request->kodeKunjungan;
        $unit = $request->unit;
        $kunjungan = db::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodeKunjungan]);
        $tarif = db::select('CALL SP_CARI_TARIF_PELAYANAN_LAB_PA_ORDER(?,?,?)', [$kunjungan[0]->kelas, '', $kunjungan[0]->kelas]);
        $datakunjungan = DB::table('ts_kunjungan')
            ->select([
                'counter',
                'kode_kunjungan',
                'no_rm',
                DB::raw('fc_nama_px(no_rm) AS nama_pasien'),
                DB::raw('fc_alamat(no_rm) AS alamat_pasien'),
                DB::raw('fc_nama_unit1(kode_unit) AS nama_unit'),
                'tgl_masuk',
                'status_kunjungan',
                DB::raw('fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin'),
            ])
            ->where('kode_kunjungan', '=', $kodeKunjungan)
            ->get();
        return view('billing.form_penunjang', compact([
            'tarif',
            'datakunjungan'
        ]));
    }
    public function simpanPenunjang(Request $request)
    {
        $kodeKunjungan = $request->kode_kunjungan;
        $noRm = $request->no_rm;
        $items = $request->items; // Berisi array item tarif, qty, dan harga
        $kunjungan = db::select('select *,fc_nama_unit1(kode_unit) as unit_kirim from ts_kunjungan where kode_kunjungan = ?', [$kodeKunjungan]);
        DB::beginTransaction();
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $kodekunjungan = $kodeKunjungan;
        $penjamin = $kunjungan[0]->kode_penjamin;
        $kode_unit = 3020;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kode_unit]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $kode_layanan_header = $this->get_layanan_header($kode_unit);
        $data_layanan_header = [
            'kode_layanan_header' => $kode_layanan_header,
            'tgl_entry' =>   $now,
            'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
            'kode_unit' => $kode_unit,
            'kode_tipe_transaksi' => 2,
            'pic' => auth()->user()->id_simrs,
            'status_layanan' => '3',
            'status_retur' => 'OPN',
            'status_pembayaran' => 'OPN',
            'dok_kirim' => $kunjungan[0]->kode_paramedis,
            'qty_header' => 1,
            'unit_pengirim' => $kunjungan[0]->kode_unit . ' | ' . $kunjungan[0]->unit_kirim,
        ];
        $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
        try {
            $grand_total_tarif = 0;
            foreach ($items as $item) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $item['harga'] * $item['qty'];
                } else {
                    $tagihanpenjamin = $item['harga'] * $item['qty'];
                    $tagihanpribadi = 0;
                }
                $total_tarif = $item['harga'] * $item['qty'];
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $item['kode_tarif'],
                    'total_tarif' => $item['harga'],
                    'jumlah_layanan' => $item['qty'],
                    'diskon_layanan' => '0',
                    'total_layanan' => $total_tarif,
                    'grantotal_layanan' => $total_tarif,
                    'kode_dokter1' => 'DOK602',
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail);
                $grand_total_tarif = $grand_total_tarif + $total_tarif;
            }
            if ($penjamin == 'P01') {
                //dummy
                ts_layanan_header::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 2, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif, 'tagihan_penjamin' => 0]);
            } else {
                //dummy
                ts_layanan_header::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 2, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif, 'tagihan_pribadi' => 0]);
            }
            DB::commit();
            // return redirect()->back()->with('success', 'Tagihan penunjang berhasil disimpan!');
            return response()->json([
                'status'       => 'success',
                'message'      => 'Data order & billing penunjang berhasil disimpan!',
                'redirect_url' => route('indexbillingpenunjang') // Ganti sesuai route tujuan Anda (opsional)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function Formlayanan(Request $request)
    {
        $datapasien = [
            'nama' => $request->nama,
            'nomorm' => $request->nomorrm,
            'alamat' => $request->alamat,
            'jk' => $request->jk,
            'dokter' => $request->dokter,
            'kodekunjungan' => $request->dokter,
            'penjamin' => $request->npenjamin,
            'kelas' => $request->kelas,
            'unit' => $request->unit,
            'kode_unit' => $request->kode_unit
        ];
        return view('billing.formlayanan', [
            'pasien' => $datapasien,
            'tarif' => DB::select("CALL sp_MASTER_TARIF_RAD")
        ]);
    }
    public function billingformlayanan(Request $request)
    {
        $jlh = $request->jnslayanan;
        if ($jlh == 1) {
            return view('billing.formlayanan.layanan1');
        } else if ($jlh == 2) {
            return view('billing.formlayanan.layanan2');
        } else if ($jlh == 3) {
            return view('billing.formlayanan.layanan3');
        } else if ($jlh == 4) {
            return view('billing.formlayanan.layanan4');
        } else if ($jlh == 5) {
            return view('billing.formlayanan.layanan5');
        }
    }
    public function carilayanan_penunjang(Request $request)
    {
        $unit = auth()->user()->unit;
        $result = DB::table('view_panggil_tarif')->where('Tindakan', 'LIKE', '%' . $request->q . '%')->where('kelas_tarif', '=', $request->kelas)->where('kode_unit', '=', $unit)->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => "kelas " . $row->kelas_tarif . " " . $row->Tindakan,
                    'kode' => $row->kode,
                    'tarif' => $row->tarif
                );
            echo json_encode($arr_result);
        }
    }
    public function caripasienrajal(Request $request)
    {
        $data_pasien = DB::select("CALL SP_PANGGIL_PASIEN_RAWAT_JALAN('$request->rm','','','$request->kodeunit','$request->tgl')");
        $datapasien = [
            'nama' => $data_pasien[0]->nama_px,
            'nomorm' => $data_pasien[0]->no_rm,
            'alamat' => $data_pasien[0]->alamat,
            'jk' => $data_pasien[0]->jenis_kelamin,
            'dokter' => $data_pasien[0]->nama_paramedis,
            'kodekunjungan' => $data_pasien[0]->kode_kunjungan,
            'penjamin' => $data_pasien[0]->nama_penjamin,
            'kelas' => $data_pasien[0]->KELAS_UNIT,
            'unit' => $data_pasien[0]->nama_unit,
            'kode_unit' => $request->kodeunit
        ];
        return view('billing.formlayanan', [
            'pasien' => $datapasien,
            'tarif' => DB::select("CALL sp_MASTER_TARIF_RAD")
        ]);
    }
    public function get_layanan_header($kode_unit)
    {
        $q = DB::select('SELECT id,kode_layanan_header,RIGHT(kode_layanan_header,6) AS kd_max  FROM ts_layanan_header
        WHERE DATE(tgl_entry) = CURDATE() AND kode_unit = ?
        ORDER BY id DESC
        LIMIT 1', [$kode_unit]);
        $UNIT = db::select('select * from mt_unit where kode_unit = ? ', [$kode_unit]);
        $kd = "";
        $PREFIX = $UNIT[0]->prefix_unit;
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $PREFIX . date('ymd') . $kd;
    }
    public function createLayanandetail()
    {
        $q = DB::connection('mysql')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail
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
    public function ambil_hasil_expertisi_pa(Request $request)
    {
        $ID_HEADER = $request->id_layanan_header;
        $expertisi = db::select('select * from ts_hasil_expertisi_pa where id_header = ?', [$ID_HEADER]);
        if ($expertisi) {
            $data_2 = DB::table('ts_hasil_expertisi_pa as a')
                ->join('ts_kunjungan as b', 'a.kode_kunjungan', '=', 'b.kode_kunjungan')
                ->join('ts_layanan_detail as c', 'a.id_detail', '=', 'c.id')
                ->join('mt_tarif_detail as d', 'c.kode_tarif_detail', '=', 'd.KODE_TARIF_DETAIL')
                ->join('mt_tarif_header as e', 'd.KODE_TARIF_HEADER', '=', 'e.KODE_TARIF_HEADER')
                ->select([
                    'a.kode_kunjungan',
                    'a.id as id_Ex',
                    'b.tgl_masuk',
                    'b.status_kunjungan',
                    'b.no_rm',
                    DB::raw('fc_nama_px(b.no_rm) AS nama_pasien'),
                    DB::raw('fc_alamat(b.no_rm) AS alamat_pasien'),
                    DB::raw('fc_NAMA_PENJAMIN2(b.kode_penjamin) AS nama_penjamin'),
                    'a.kode_header AS kode_layanan_header',
                    'a.id_detail',
                    'a.unit_asal',
                    'a.kode_dokter',
                    DB::raw('fc_NAMA_PARAMEDIS1(a.kode_dokter) AS nama_dokter'),
                    'c.kode_tarif_detail',
                    'e.NAMA_TARIF',
                    'a.*',
                ])
                ->where('b.kode_kunjungan', '=', $expertisi[0]->kode_kunjungan)
                ->first();
        } else {
            $data_2 = [];
        }
        $result = DB::table('ts_layanan_header as a')
            ->join('ts_layanan_detail as b', 'a.id', '=', 'b.row_id_header')
            ->join('mt_tarif_detail as c', 'b.kode_tarif_detail', '=', 'c.KODE_TARIF_DETAIL')
            ->join('mt_tarif_header as d', 'c.KODE_TARIF_HEADER', '=', 'd.KODE_TARIF_HEADER')
            ->join('ts_kunjungan as e', 'a.kode_kunjungan', '=', 'e.kode_kunjungan')
            ->select(
                'a.kode_kunjungan',
                'e.no_rm',
                DB::raw('fc_nama_px(e.no_rm) AS nama_pasien'),
                DB::raw('fc_NAMA_PENJAMIN2(e.kode_penjamin) AS nama_penjamin'),
                DB::raw('fc_NAMA_PARAMEDIS1(e.kode_paramedis) AS dokter_pengirim'),
                DB::raw('fc_NAMA_PARAMEDIS1(b.kode_dokter1) AS dokter_pemeriksa'),
                'a.kode_layanan_header',
                'a.total_layanan',
                'a.status_layanan',
                'b.grantotal_layanan as total_detail',
                'b.jumlah_layanan',
                'b.kode_tarif_detail',
                'd.NAMA_TARIF'
            )
            ->where('a.id', $ID_HEADER)
            ->get();
        return view('billing.form_expertisi_pa', compact([
            'expertisi',
            'ID_HEADER',
            'data_2',
            'result'
        ]));
    }
    public function generatenomorsediaan(Request $request)
    {
        $id_header = $request->id_header;
        $jenis = $request->jenis_pemeriksaan;
        $get_sediaan = $this->getnomorsediaan($jenis);
        $data_sediaan = [
            'no_sediaan' => $get_sediaan,
            'tanggal' => $this->get_date(),
            'jenis_pemeriksaan' => $jenis,
        ];
        $lyheader = db::select('select * from ts_layanan_header where id = ?', [$id_header]);
        $lydetail = db::select('select * from ts_layanan_detail where row_id_header = ?', [$id_header]);
        $kode_kunjungan = $lyheader[0]->kode_kunjungan;
        $kunjungan = db::select('select *,fc_nama_unit1(kode_unit) as unit_asal from ts_kunjungan where kode_kunjungan = ?', [$kode_kunjungan]);
        DB::table('mt_nomor_sediaan_pa')->insert($data_sediaan);
        $ts_expertisi = [
            'kode_unit' => '3020',
            'kode_kunjungan' => $kode_kunjungan,
            'no_rm' => $kunjungan[0]->no_rm,
            'counter' => $kunjungan[0]->counter,
            'kode_header' => $lyheader[0]->kode_layanan_header,
            'id_header' => $id_header,
            'id_detail' => $lydetail[0]->id,
            'unit_asal' => $kunjungan[0]->unit_asal,
            'validasi' => '0',
            'cetak' => '0',
            'no_periksa' => $get_sediaan,
            'tgl_input_layanan' => $this->get_now()
        ];
        DB::table('ts_hasil_expertisi_pa')->insert($ts_expertisi);
        return response()->json([
            'success'       => 'success',
            'status'       => 'success',
            'no_sediaan'       => $get_sediaan,
            'message'      => 'Data order & billing penunjang berhasil disimpan!',
            'redirect_url' => route('indexbillingpenunjang') // Ganti sesuai route tujuan Anda (opsional)
        ], 200);
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function getnomorsediaan($jenis)
    {
        $q = DB::connection('mysql')->select('SELECT id,no_sediaan,RIGHT(no_sediaan,3) AS kd_max  FROM mt_nomor_sediaan_pa
        WHERE DATE(tanggal) = CURDATE() AND jenis_pemeriksaan = ?
        ORDER BY id DESC
        LIMIT 1', [$jenis]);
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }

        if ($jenis == '1') {
            $prefix = 'H';
        } else if ($jenis == '2') {
            $prefix = 'F';
        } else if ($jenis == '3') {
            $prefix = 'S';
        }

        date_default_timezone_set('Asia/Jakarta');
        return $prefix . '-' . date('ym') . $kd;
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function ambil_form_expertisi_pa(Request $request)
    {
        $id_ex = $request->id_expertisi;
        $data = DB::table('ts_hasil_expertisi_pa')
            ->where('id', $id_ex)
            ->first();
        $kode_kunjungan = $data->kode_kunjungan;
        $datakunjungan = DB::table('ts_kunjungan')
            ->select([
                'counter',
                'kode_kunjungan',
                'no_rm',
                DB::raw('fc_nama_px(no_rm) AS nama_pasien'),
                DB::raw('fc_alamat(no_rm) AS alamat_pasien'),
                DB::raw('fc_nama_unit1(kode_unit) AS nama_unit'),
                'tgl_masuk',
                'status_kunjungan',
                DB::raw('fc_NAMA_PENJAMIN2(kode_penjamin) AS nama_penjamin'),
            ])
            ->where('kode_kunjungan', '=', $kode_kunjungan)
            // Kondisi dinamis berdasarkan jenis pasien
            ->get();

        $data_2 = DB::table('ts_hasil_expertisi_pa as a')
            ->join('ts_kunjungan as b', 'a.kode_kunjungan', '=', 'b.kode_kunjungan')
            ->join('ts_layanan_detail as c', 'a.id_detail', '=', 'c.id')
            ->join('mt_tarif_detail as d', 'c.kode_tarif_detail', '=', 'd.KODE_TARIF_DETAIL')
            ->join('mt_tarif_header as e', 'd.KODE_TARIF_HEADER', '=', 'e.KODE_TARIF_HEADER')
            ->select([
                'a.kode_kunjungan',
                'a.id as id_Ex',
                'b.tgl_masuk',
                'b.status_kunjungan',
                'b.no_rm',
                DB::raw('fc_nama_px(b.no_rm) AS nama_pasien'),
                DB::raw('fc_alamat(b.no_rm) AS alamat_pasien'),
                DB::raw('fc_NAMA_PENJAMIN2(b.kode_penjamin) AS nama_penjamin'),
                'a.kode_header AS kode_layanan_header',
                'a.id_detail',
                'a.unit_asal',
                'a.kode_dokter',
                DB::raw('fc_NAMA_PARAMEDIS1(a.kode_dokter) AS nama_dokter'),
                'c.kode_tarif_detail',
                'e.NAMA_TARIF',
                'a.*',
            ])
            ->where('b.kode_kunjungan', '=', $kode_kunjungan)
            ->first();
        return view('billing.form_expertisi_pa2', compact([
            'data',
            'datakunjungan',
            'data_2'
        ]));
    }
    public function simpanExpertisi(Request $request, $id)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'makroskopis' => 'nullable|string',
            'mikroskopis' => 'nullable|string',
            'kesimpulan'  => 'nullable|string',
        ]);
        // try {
        // Update data menggunakan Query Builder DB::table
        DB::table('ts_hasil_expertisi_pa')
            ->where('id', $id)
            ->update([
                'tipe'          => $request->jenis_sampel,
                'kritis'             => $request->has('is_kritis') ? 1 : 0,
                'cito'               => $request->has('is_cyto') ? 1 : 0,
                'hasil'           => $request->makroskopis . ' | ' . $request->mikroskopis . ' | ' . $request->kesimpulan,
                'kode_dokter' => auth()->user()->kode_paramedis,
                'diagnostik_klinik'     => $request->diagnostik_klinik,
                'diagnostik_pasca_bedah' => $request->diagnostik_pasca_bedah,
                'validasi'           => $request->has('is_validasi') ? 2 : 1,
                'tgl_baca'            => now(), // Sesuaikan jika ada timestamp
            ]);

        return redirect()->back()->with('success', 'Data hasil expertisi PA berhasil disimpan.');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        // }
    }
    public function cetakexpa($id)
    {
        $data = DB::table('ts_layanan_header as a')
            ->join('ts_hasil_expertisi_pa as b', 'a.id', '=', 'b.id_header')
            ->join('ts_kunjungan as e', 'a.kode_kunjungan', '=', 'e.kode_kunjungan')
            ->select(
                'a.id as id_header',
                'a.kode_kunjungan',
                'e.no_rm',
                DB::raw('fc_nama_px(e.no_rm) AS nama_pasien'),
                DB::raw('fc_NAMA_PENJAMIN2(e.kode_penjamin) AS nama_penjamin'),
                DB::raw('fc_NAMA_PARAMEDIS1(e.kode_paramedis) AS dokter_pengirim'),
                DB::raw('fc_NAMA_PARAMEDIS1(b.kode_dokter) AS dokter_pemeriksa'),
                'b.no_periksa',
                'b.tipe as jenis_sampel',
                'b.hasil',
                'b.tgl_baca',
                'b.diagnostik_klinik',
                'b.diagnostik_pasca_bedah'
            )
            ->where('a.id', $id)
            ->first();
        $mt_pasien = db::select('select *,fc_alamat(no_rm) as alamat_pasien from mt_pasien where no_rm = ?',[$data->no_rm]);
        // Safety check jika data tidak ditemukan
        if (!$data) {
            abort(404, 'Data Expertisi tidak ditemukan.');
        }

        // Parsing field hasil (Makroskopis | Mikroskopis | Kesimpulan)
        $hasil_split = isset($data->hasil) ? array_map('trim', explode('|', $data->hasil)) : [];
        $data->makroskopis = $hasil_split[0] ?? '-';
        $data->mikroskopis = $hasil_split[1] ?? '-';
        $data->kesimpulan  = $hasil_split[2] ?? '-';
        // Render PDF menggunakan Dompdf
        $pdf = Pdf::loadView('billing.cetak_expertisi_PA', compact('data','mt_pasien'))
            ->setPaper('a4', 'portrait');

        // Stream langsung di browser (tab baru)
        return $pdf->stream('Expertisi_PA_' . ($data->no_periksa ?? $id) . '.pdf');
    }
}
