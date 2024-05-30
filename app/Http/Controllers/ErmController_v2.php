<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\assesmenawaldokter;
use App\Models\order_racikan_detail;
use App\Models\order_racikan_header;
use App\Models\ts_antrian_farmasi;
use App\Models\ts_layanan_detail_dummy;
use App\Models\ts_layanan_detail_order;
use App\Models\ts_layanan_header_dummy;
use App\Models\ts_layanan_header_order;

class ErmController_v2 extends Controller
{
    public function formpemeriksaan_dokter(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $nomorrm = $request->nomorrm;
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$request->kodekunjungan]);
        $last_assdok = DB::connection('mysql')->select('SELECT * FROM assesmen_dokters
        WHERE id_pasien = ? AND kode_unit = ? AND id = (SELECT MAX(id) FROM assesmen_dokters WHERE id_pasien = ? AND kode_unit = ?)', [$nomorrm, auth()->user()->unit, $nomorrm, auth()->user()->unit]);
        // dd($last_assdok);
        $mt_pasien = DB::select('select *,fc_umur(no_rm) as usia from mt_pasien where no_rm = ?', [$nomorrm]);
        $assdok_now = DB::connection('mysql')->select('SELECT * from assesmen_dokters WHERE id_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = '3';
        $layanan = '';
        $unit = auth()->user()->unit;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        $layanan_rad = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD_ORDER('1','','$kelas')");
        $layanan_lab = DB::select("CALL SP_CARI_TARIF_PELAYANAN_LAB_ORDER('1','','$kelas')");
        // dd($layanan_lab);
        return view('V2_erm.form_pemeriksaan_dokter', compact([
            'kodekunjungan', 'resume_perawat', 'last_assdok', 'assdok_now', 'mt_pasien', 'nomorrm', 'layanan', 'layanan_lab', 'layanan_rad'
        ]));
    }
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function Ambil_Riwayat_kunjungan(Request $request)
    {
        $rm = $request->rm;
        $kunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit from ts_kunjungan where no_rm = ? order by kode_kunjungan desc ', [$rm]);
        $assesment = DB::connection('mysql')->select('SELECT * from erm_hasil_assesmen_keperawatan_rajal a LEFT OUTER JOIN assesmen_dokters b on a.kode_kunjungan = b.id_kunjungan WHERE a.no_rm = ? order by a.id desc', [$rm]);
        // $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = ?', [$rm]);
        return view('V2_erm.riwayat_kunjungan', compact([
            'kunjungan', 'assesment'
        ]));
    }
    public function Ambil_riwayat_order_farmasi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql2')->select('SELECT *,b.id as id_detail FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        WHERE kode_kunjungan = ? and status_layanan_detail = ? and kode_barang is not null', [$kodekunjungan, 'OPN']);
        return view('V2_erm.tabel_riwayat_order_farmasi', compact('riwayat_order'));
    }
    public function ambil_riwayat_order_lab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql2')->select("SELECT a.status_order,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3002']);
        // dd($riwayat_order);
        return view('V2_erm.tabel_riwayat_order_lab', compact('riwayat_order'));
    }
    public function ambil_riwayat_order_rad(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_order = DB::connection('mysql2')->select("SELECT a.status_order,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3003']);
        // dd($riwayat_order);
        return view('V2_erm.tabel_riwayat_order_rad', compact('riwayat_order'));
    }
    public function ambil_riwayat_tindakan_today(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $riwayat_tindakan = DB::connection('mysql')->select('SELECT *,d.NAMA_TARIF,fc_nama_tarif(b.kode_tarif_detail) as nama_tarif,b.id as id_detail FROM ts_layanan_header a
        INNER JOIN ts_layanan_detail b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE kode_kunjungan = ? and status_layanan = ?', [$kodekunjungan, '1']);
        return view('V2_erm.tabel_riwayat_tindakan', compact('riwayat_tindakan'));
    }
    public function Ambil_riwayat_pemakaian_obat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $ts_kunjungan = DB::connection('mysql')->select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $ts_kunjungan[0]->no_rm;
        $ts_kunjungan_list = DB::connection('mysql')->select('select *,fc_nama_paramedis1(kode_paramedis) as nama_dokter ,fc_nama_unit1(kode_unit) as unit from ts_kunjungan where no_rm = ? and status_kunjungan != ? order by kode_kunjungan desc', [$rm, 8]);

        $riwayat_pemakaian = DB::connection('mysql')->select("SELECT date(a.`tgl_masuk`) as tgl_masuk
        ,fc_nama_unit1(a.`kode_unit`) AS unit_asal
        ,a.`kode_kunjungan`
        ,fc_nama_barang(c.`kode_barang`) AS nama_barang
        ,c.jumlah_layanan
        ,c.aturan_pakai
        ,c.`kode_barang`
        ,fc_nama_paramedis1(a.kode_paramedis) AS nama_dokter
        ,a.`kode_paramedis`
        ,fc_nama_penjamin(a.`kode_penjamin`) AS nama_penjamin
        ,fc_nama_unit1(b.`kode_unit`) AS unit_tujuan
        ,b.id AS id_header
        FROM ts_kunjungan  a
        INNER JOIN ts_layanan_header b ON a.`kode_kunjungan` = b.`kode_kunjungan`
        INNER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        WHERE a.no_rm = ? AND b.kode_unit IN ('4002','4008') AND c.`kode_barang` IS NOT NULL AND c.kode_barang != ''", [$rm]);
        return view('V2_erm.tabel_riwayat_pemakaian_obat', compact('riwayat_pemakaian', 'ts_kunjungan_list'));
    }
    public function ambil_riwayat_racikan()
    {
        $header = DB::connection('mysql2')->select('select * from ts_header_racikan_order where pic = ? order by id desc', [auth()->user()->id]);
        $detail = db::connection('mysql2')->select('SELECT a.id AS id_header
       ,tipe_racikan
       ,jumlah_racikan
       ,kemasan
       ,aturan_pakai
       ,kode_kunjungan
       ,fc_nama_barang(kode_barang) AS nama_barang,kode_barang,qty,dosis_awal,dosis_racik
       FROM ts_header_racikan_order a
       INNER JOIN ts_detail_racikan_order b ON a.`id` = b.`id_header` where a.pic = ?', [auth()->user()->id]);
        return view('V2_erm.tabel_riwayat_racikan', compact([
            'header', 'detail'
        ]));
    }
    public function Cari_obat_reguler(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $key = $request->nama;
        $jlh = strlen($key);
        if ($jlh >= 2) {
            if ($kunjungan[0]->kode_penjamin == 'PO1') {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4002')");
            } else {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4008')");
            }
            return view('V2_erm.tabel_obat_reguler', compact([
                'obat'
            ]));
        }
    }
    public function Cari_obat_komponen(Request $request)
    {
        $kunjungan = DB::select('select * from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $key = $request->nama;
        $jlh = strlen($key);
        if ($jlh >= 2) {
            if ($kunjungan[0]->kode_penjamin == 'PO1') {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4002')");
            } else {
                $obat = DB::select("CALL sp_cari_obat_stok_all_erm('$key','4008')");
            }
            return view('V2_erm.tabel_obat_komponen', compact([
                'obat'
            ]));
        }
    }
    public function Simpan_pemeriksaan_dokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        $data_billing_tindakan = json_decode($_POST['data_billing_tindakan'], true);
        $data_order_farmasi = json_decode($_POST['data_order_farmasi'], true);
        $data_order_rad = json_decode($_POST['data_order_rad'], true);
        $data_order_lab = json_decode($_POST['data_order_lab'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        foreach ($data_order_farmasi as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet_order_farmasi[$index] = $value;
            if ($index == 'keterangan') {
                $arrayindex_far[] = $dataSet_order_farmasi;
            }
        }
        foreach ($data_billing_tindakan as $a) {
            $index =  $a['name'];
            $value =  $a['value'];
            $dataSet_tindakan[$index] = $value;
            if ($index == 'jumlah') {
                $arrayindex_tind[] = $dataSet_tindakan;
            }
        }
        foreach ($data_order_lab as $a) {
            $index =  $a['name'];
            $value =  $a['value'];
            $dataSet_lab[$index] = $value;
            if ($index == 'jumlah') {
                $arrayindex_lab[] = $dataSet_lab;
            }
        }
        foreach ($data_order_rad as $a) {
            $index =  $a['name'];
            $value =  $a['value'];
            $dataSet_rad[$index] = $value;
            if ($index == 'jumlah') {
                $arrayindex_rad[] = $dataSet_rad;
            }
        }
        $ts_kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
        $resume_perawat = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE kode_kunjungan = ?', [$dataSet['kodekunjungan']]);
        if (empty($dataSet['sumberdata'])) {
            $data = [
                'kode' => 500,
                'message' => 'Sumber data pemeriksaan belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        if (empty($dataSet['riwayatalergi'])) {
            $data = [
                'kode' => 500,
                'message' => 'Riwayat alergi belum dipilih !'
            ];
            echo json_encode($data);
            die;
        }
        $data = [
            'id_kunjungan' => $dataSet['kodekunjungan'],
            'id_pasien' => $ts_kunjungan[0]->no_rm,
            'id_asskep' => $resume_perawat[0]->id,
            'pic' => auth()->user()->id,
            'nama_dokter' => auth()->user()->nama,
            'tgl_entry' => $this->get_now(),
            'tgl_kunjungan' => $ts_kunjungan[0]->tgl_masuk,
            'tgl_pemeriksaan' => $this->get_now(),
            'sumber_data' => $dataSet['sumberdata'],
            'tekanan_darah' => $dataSet['tekanandarah'],
            'frekuensi_nadi' => $dataSet['frekuensinadi'],
            'frekuensi_nafas' => $dataSet['frekuensinafas'],
            'suhu_tubuh' => $dataSet['suhu'],
            'beratbadan' => $dataSet['bb'],
            'umur' => $dataSet['usia1'],
            'kode_unit' => auth()->user()->unit,
            'keluhan_pasien' => $dataSet['keluhanutama'],
            'ket_riwayatlain' => $dataSet['riwayatpenyakitdahulu'],
            'riwayat_alergi' => $dataSet['riwayatalergi'],
            'keterangan_alergi' => $dataSet['keteranganriwayatalergi'],
            'pemeriksaan_fisik' => $dataSet['pemeriksaanfisik'],
            'diagnosakerja' => $dataSet['diagnosaprimer'],
            'diagnosabanding' => $dataSet['diagnosasekunder'],
            'rencanakerja' => $dataSet['rencanaterapi'],
            'versi' => 2
        ];
        // dd($dataSet);
        $cek = DB::connection('mysql2')->select('select * from assesmen_dokters where id_kunjungan = ?', [$dataSet['kodekunjungan']]);
        if (count($cek) > 0) {
            $asdok = assesmenawaldokter::whereRaw('id_kunjungan = ?', array($dataSet['kodekunjungan']))->update($data);
            $id_assdok = $cek[0]->id;
        } else {
            $asdok = assesmenawaldokter::create($data);
            $id_assdok = $asdok->id;
        }
        //order farmasi
        // dd($arrayindex_far);

        if ($ts_kunjungan[0]->kode_penjamin == 'PO1') {
            $unit = '4002';
            $kode_transaksi = '1';
        } else {
            $unit = '4008';
            $kode_transaksi = '2';
        }

        $penjamin = $ts_kunjungan[0]->kode_penjamin;
        $nomorrm = $ts_kunjungan[0]->no_rm;
        $now = $this->get_now();
        $kodekunjungan = $dataSet['kodekunjungan'];
        if (count($data_billing_tindakan) > 0) {
            $dt = Carbon::now()->timezone('Asia/Jakarta');
            $date = $dt->toDateString();
            $time = $dt->toTimeString();
            $now = $date . ' ' . $time;
            $cek_layanan_header = count(DB::connection('mysql4')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$dataSet['kodekunjungan']]));
            $kodekunjungan = $dataSet['kodekunjungan'];
            $penjamin = $ts_kunjungan[0]->kode_penjamin;
            $kode_unit = $ts_kunjungan[0]->kode_unit;
            $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kode_unit]);
            $prefix_kunjungan = $unit[0]->prefix_unit;
            try {
                //dummy
                $kode_unit = $ts_kunjungan[0]->kode_unit;
                $r = DB::connection('mysql4')->select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
                $kode_layanan_header = $r[0]->no_trx_layanan;
                if ($kode_layanan_header == "") {
                    $year = date('y');
                    $kode_layanan_header = $unit[0]->prefix_unit . $year . date('m') . date('d') . '000001';
                    //dummy
                    DB::connection('mysql4')->select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kode_unit]);
                }
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $ts_kunjungan[0]->kode_kunjungan,
                    'kode_unit' => $kode_unit,
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN'
                ];
                //data yg diinsert ke ts_layanan_header
                //simpan ke layanan header
                //dummy
                $ts_layanan_header = ts_layanan_header_dummy::create($data_layanan_header);
                $grand_total_tarif = 0;
                foreach ($arrayindex_tind as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['jumlah'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['jumlah'];
                        $tagihanpribadi = 0;
                    }
                    $total_tarif = $d['tarif'] * $d['jumlah'];
                    $id_detail = $this->createLayanandetail();
                    $save_detail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_layanan_header,
                        'kode_tarif_detail' => $d['kodetindakan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['jumlah'],
                        'diskon_layanan' => '0',
                        'total_layanan' => $total_tarif,
                        'grantotal_layanan' => $total_tarif,
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_penjamin' => $tagihanpenjamin,
                        'tagihan_pribadi' => $tagihanpribadi,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header->id
                    ];
                    $ts_layanan_detail = ts_layanan_detail_dummy::create($save_detail);
                    $grand_total_tarif = $grand_total_tarif + $total_tarif;
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_dummy::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_dummy::where('id', $ts_layanan_header->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
                $data = [
                    'status' => 0,
                    'signature' => ''

                ];
                assesmenawaldokter::whereRaw('id_kunjungan = ?', array($kodekunjungan))->update($data);
            } catch (\Exception $e) {
                $back = [
                    'kode' => 500,
                    'message' => $e->getMessage()
                ];
                echo json_encode($back);
                die;
            }

            //endtindakan
        }
        try {
            if (count($data_order_farmasi) > 0) {
                if ($ts_kunjungan[0]->kode_penjamin == 'PO1') {
                    $unit_kirim = '4002';
                    $kode_transaksi = '1';
                } else {
                    $unit_kirim = '4008';
                    $kode_transaksi = '2';
                }
                $kode_layanan_header = $this->createOrderHeader('F');
                $data_order_header = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header,
                    'tgl_entry' => $this->get_now(),
                    'kode_kunjungan' => $dataSet['kodekunjungan'],
                    'kode_unit' => $unit_kirim,
                    'kode_tipe_transaksi' => $kode_transaksi,
                    'pic' => auth()->user()->id,
                    'status_layanan' => '1',
                    'keterangan' => '',
                    'kode_penjaminx' => $ts_kunjungan[0]->kode_penjamin,
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet['diagnosaprimer'],
                    'tgl_periksa' => $ts_kunjungan[0]->tgl_masuk,
                    'id_assdok' => $id_assdok,
                    'status_order' => '99',
                ];
                $header_f = ts_layanan_header_order::create($data_order_header);
                $tgl = $this->get_now();
                foreach ($arrayindex_far as $a) {
                    try {
                        if ($a['namagenerik'] == 'RACIKAN') {
                            $TIPE = 'racikan';
                        } else {
                            $TIPE = 'reguler';
                        }
                        $id_detail = $this->createLayanandetailOrder();
                        $data_detail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_tarif_detail' => $a['namaobat'],
                            'kode_layanan_header' => $kode_layanan_header,
                            'jumlah_layanan' => $a['jumlah'],
                            'kode_dokter1' => auth()->user()->kode_paramedis,
                            'tgl_layanan_detail1' => $tgl,
                            'kode_barang' => $a['kodebarang'],
                            'aturan_pakai' => $a['aturanpakai'],
                            'keterangan' => $a['keterangan'],
                            'kategori_resep' => $TIPE,
                            'satuan_barang' => $a['sediaan'],
                            'tipe_anestesi' => $a['kronis'],
                            'row_id_header' => $header_f->id,
                        ];
                        $detail_f = ts_layanan_detail_order::create($data_detail);
                    } catch (\Exception $e) {
                        $back = [
                            'kode' => 500,
                            'message' => $e->getMessage()
                        ];
                        echo json_encode($back);
                        die;
                    }
                }
            }
            if (count($data_order_lab) > 0) {
                // arrayindex_lab
                $kode_layanan_header_order = $this->createOrderHeader('P');
                $data_layanan_header_order = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header_order,
                    'tgl_entry' =>   $now,
                    'kode_kunjungan' => $kodekunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => '3002',
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet['diagnosaprimer'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '99'
                ];

                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                $now = $this->get_now();
                foreach ($arrayindex_lab as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['jumlah'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['jumlah'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodetindakan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['jumlah'],
                        'total_layanan' => $d['tarif'] * $d['jumlah'],
                        'grantotal_layanan' => $d['tarif'] * $d['jumlah'],
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_penjamin' => $tagihanpenjamin,
                        'tagihan_pribadi' => $tagihanpribadi,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header_order->id
                    ];
                    $ts_layanan_detail_order = ts_layanan_detail_order::create($save_detail_order);
                    $grand_total_tarif = $grand_total_tarif + $d['tarif'];
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
            }
            if (count($data_order_rad) > 0) {
                // arrayindex_rad
                $kode_layanan_header_order = $this->createOrderHeader('P');
                $data_layanan_header_order = [
                    'no_rm' => $nomorrm,
                    'kode_layanan_header' => $kode_layanan_header_order,
                    'tgl_entry' =>  $now,
                    'kode_kunjungan' => $kodekunjungan,
                    'kode_penjaminx' => $penjamin,
                    'kode_unit' => '3003',
                    'kode_tipe_transaksi' => 2,
                    'pic' => auth()->user()->id,
                    'unit_pengirim' => auth()->user()->unit,
                    'diagnosa' => $dataSet['diagnosaprimer'],
                    'tgl_periksa' => $this->get_date(),
                    'dok_kirim' => auth()->user()->kode_paramedis,
                    'status_layanan' => '3',
                    'status_retur' => 'OPN',
                    'status_pembayaran' => 'OPN',
                    'status_order' => '99'
                ];
                $ts_layanan_header_order = ts_layanan_header_order::create($data_layanan_header_order);
                $grand_total_tarif = 0;
                foreach ($arrayindex_rad as $d) {
                    if ($penjamin == 'P01') {
                        $tagihanpenjamin = 0;
                        $tagihanpribadi = $d['tarif'] * $d['jumlah'];
                    } else {
                        $tagihanpenjamin = $d['tarif'] * $d['jumlah'];
                        $tagihanpribadi = 0;
                    }
                    $id_detail_order = $this->createLayanandetailOrder();
                    $save_detail_order = [
                        'id_layanan_detail' => $id_detail_order,
                        'kode_layanan_header' => $kode_layanan_header_order,
                        'kode_tarif_detail' => $d['kodetindakan'],
                        'total_tarif' => $d['tarif'],
                        'jumlah_layanan' => $d['jumlah'],
                        'total_layanan' => $d['tarif'] * $d['jumlah'],
                        'grantotal_layanan' => $d['tarif'] * $d['jumlah'],
                        'kode_dokter1' => auth()->user()->kode_paramedis,
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_penjamin' => $tagihanpenjamin,
                        'tagihan_pribadi' => $tagihanpribadi,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $ts_layanan_header_order->id
                    ];
                    $ts_layanan_detail_order = ts_layanan_detail_order::create($save_detail_order);
                    $grand_total_tarif = $grand_total_tarif + $d['tarif'];
                }
                if ($penjamin == 'P01') {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
                } else {
                    //dummy
                    ts_layanan_header_order::where('id', $ts_layanan_header_order->id)
                        ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
                }
            }
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
        $data = [
            'kode' => 200,
            'message' => 'Data berhasil disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function Add_draft_komponen(Request $request)
    {

        $dataheader = json_decode($_POST['dataheader'], true);
        $datalist = json_decode($_POST['datalist'], true);
        $jumlahracikan = $request->jumlahracikan;
        foreach ($dataheader as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }

        $ts_kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        if ($ts_kunjungan[0]->kode_penjamin == 'PO1') {
            $unit_tujuan = '4002';
        } else {
            $unit_tujuan = '4008';
        }
        $jumlah_racikan = $dataSet['jumlahracikan'];

        $data_header = [
            'nama_racikan' => $dataSet['namaracikan'],
            'tipe_racikan' => $dataSet['tiperacikan'],
            'jumlah_racikan' => $dataSet['jumlahracikan'],
            'kemasan' => $dataSet['kemasanracikan'],
            'aturan_pakai' => $dataSet['aturanpakairacikan'],
            'pic' => auth()->user()->id,
            'tgl_entry' => $this->get_now(),
            'kode_unit' => auth()->user()->unit,
            'kode_kunjungan' => $request->kodekunjungan,
            'unit_tujuan' => $unit_tujuan,
        ];
        $header = order_racikan_header::create($data_header);
        foreach ($datalist as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataList[$index] = $value;
            if ($index == 'dosisracik') {
                $array_list[] = $dataList;
            }
        }
        // dd($array_list);
        $list_ket = [];
        foreach ($array_list as $arr) {
            $list_ket[] = $arr['namaobat'] . ' Dosis Awal : ' . $arr['dosis'] . ' Dosis Racik : ' . $arr['dosisracik'];
            $qty = $arr['dosisracik'] * $dataSet['jumlahracikan'] / $arr['dosis'];
            $data_detail = [
                'id_header' => $header->id,
                'kode_barang' => $arr['kodebarang'],
                'qty' => $qty,
                'dosis_awal' => $arr['dosis'],
                'dosis_racik' =>  $arr['dosisracik'],
                'tgl_entry' => $this->get_now(),
            ];
            order_racikan_detail::create($data_detail);
        }
        $ket = implode(' ', $list_ket);
        // dd($list_ket);
        if ($dataSet['kemasanracikan'] == 1) {
            $sediaan = 'KAPSUL';
        } elseif ($dataSet['kemasanracikan'] == 2) {
            $sediaan = 'KERTAS PERKAMEN';
        } elseif ($dataSet['kemasanracikan'] == 3) {
            $sediaan = 'POT SALEP';
        }
        // dd($dataSet);
        return "<div class='row mt-2 text-xs'>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Nama Obat</label>
                <input readonly type='text' class='form-control form-control-sm' id='nama_obat' name='namaobat' value='$dataSet[namaracikan]'placeholder='name@example.com'>
                <input hidden readonly type='text' class='form-control form-control-sm' id='kodebarang' name='kodebarang' value='$header->id'placeholder='name@example.com'>
            </div>
        </div>
        <div hidden class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Nama Generik</label>
                <input readonly type='text' class='form-control form-control-sm' id='namagenerik' name='namagenerik' value='RACIKAN' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Dosis</label>
                <input readonly type='text' class='form-control form-control-sm' id='dosis' name='dosis' value='-' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Sediaan</label>
                <input readonly type='text' class='form-control form-control-sm' id='sediaan' name='sediaan' value='$sediaan' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Kronis</label>
                <select class='form-control form-control-sm' id='kronis' name='kronis'><option value='0'>TIDAK</option><option value='1'>YA</option></select>
            </div>
        </div>
        <div class='col-md-1'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Jumlah</label>
                <input readonly type='text' class='form-control form-control-sm' id='jumlah' name='jumlah' value='$dataSet[jumlahracikan]' placeholder='name@example.com'>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Aturan Pakai</label>
                <textarea readonly type='text' class='form-control form-control-sm' id='aturanpakai' name='aturanpakai' value='' placeholder='name@example.com'>$dataSet[aturanpakairacikan]</textarea>
            </div>
        </div>
        <div class='col-md-2'>
            <div class='form-group'>
                <label for='exampleFormControlInput1'>Keterangan</label>
                <textarea readonly type='text' class='form-control form-control-sm' id='keterangan' name='keterangan' value='' placeholder='name@example.com'>$ket</textarea>
            </div>
        </div>
        <i class='bi bi-x-square remove_field form-group col-md-1 text-danger' kode2='' subtot='' jenis='' nama_barang='' kode_barang='' id_stok='' harga2='' satuan='' stok='' qty='' harga='' disc='' dosis='' sub='' sub2='' status='80' jenisracik='racikan'></i>
    </div>";
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
    public function createOrderHeader($kode)
    {
        //dummy
        $q = DB::connection('mysql2')->select('SELECT id,kode_layanan_header,RIGHT(kode_layanan_header,6) AS kd_max  FROM ts_layanan_header_order
        WHERE DATE(tgl_entry) = CURDATE()
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
        return 'OR' . $kode . date('ymd') . $kd;
    }
    public function createLayanandetailOrder()
    {
        //dummy
        $q = DB::connection('mysql4')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail_order
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
    public function Batal_detail_order_farmasi(Request $request)
    {
        $id = $request->id;
        $ts_layanan_detail = db::connection('mysql2')->select('select * from ts_layanan_detail_order where id = ?', [$id]);
        $row_id_header = $ts_layanan_detail[0]->row_id_header;
        $cek_header = db::connection('mysql2')->select('select * from ts_layanan_header_order where status_order = ? and id = ?', ['2', $row_id_header]);
        if (count($cek_header) > 0) {
            $data = [
                'kode' => 500,
                'message' => 'Obat sudah dilayanai farmasi !'
            ];
            echo json_encode($data);
            die;
        } else {
            $asdok = ts_layanan_detail_order::whereRaw('id = ?', array($id))->update(['status_layanan_detail' => 'CCL']);
            $DETAIL = db::connection('mysql2')->select('select * from ts_layanan_detail_order where row_id_header = ? and status_layanan_detail = ?', [$row_id_header, 'OPN']);
            if (count($DETAIL) == 0) {
                ts_layanan_header_order::whereRaw('id = ?', array($row_id_header))->update(['status_layanan' => '3']);
                $data = [
                    'kode' => 200,
                    'message' => 'Order obat  berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            } else {
                $data = [
                    'kode' => 200,
                    'message' => 'Order obat ' . $ts_layanan_detail[0]->kode_tarif_detail . ' berhasil dibatalkan !'
                ];
                echo json_encode($data);
                die;
            }
        }
    }
    public function batal_detail_order_lab(Request $request)
    {
        $id = $request->id;
        $ts_layanan_detail = db::connection('mysql2')->select('select * from ts_layanan_detail_order where id = ?', [$id]);
        $row_id_header = $ts_layanan_detail[0]->row_id_header;
        $asdok = ts_layanan_detail_order::whereRaw('id = ?', array($id))->update(['status_layanan_detail' => 'CCL']);
        $DETAIL = db::connection('mysql2')->select('select * from ts_layanan_detail_order where row_id_header = ? and status_layanan_detail = ?', [$row_id_header, 'OPN']);
        if (count($DETAIL) == 0) {
            ts_layanan_header_order::whereRaw('id = ?', array($row_id_header))->update(['status_layanan' => '3']);
            $data = [
                'kode' => 200,
                'message' => 'Order Layanan  berhasil dibatalkan !'
            ];
            echo json_encode($data);
            die;
        } else {
            $data = [
                'kode' => 200,
                'message' => 'Order Layanan ' . $ts_layanan_detail[0]->kode_tarif_detail . ' berhasil dibatalkan !'
            ];
            echo json_encode($data);
            die;
        }
    }
    public function batal_detail_order_rad(Request $request)
    {
        $id = $request->id;
        $ts_layanan_detail = db::connection('mysql2')->select('select * from ts_layanan_detail_order where id = ?', [$id]);
        $row_id_header = $ts_layanan_detail[0]->row_id_header;
        $asdok = ts_layanan_detail_order::whereRaw('id = ?', array($id))->update(['status_layanan_detail' => 'CCL']);
        $DETAIL = db::connection('mysql2')->select('select * from ts_layanan_detail_order where row_id_header = ? and status_layanan_detail = ?', [$row_id_header, 'OPN']);
        if (count($DETAIL) == 0) {
            ts_layanan_header_order::whereRaw('id = ?', array($row_id_header))->update(['status_layanan' => '3']);
            $data = [
                'kode' => 200,
                'message' => 'Order Layanan  berhasil dibatalkan !'
            ];
            echo json_encode($data);
            die;
        } else {
            $data = [
                'kode' => 200,
                'message' => 'Order Layanan ' . $ts_layanan_detail[0]->kode_tarif_detail . ' berhasil dibatalkan !'
            ];
            echo json_encode($data);
            die;
        }
    }
    public function hasilassesmentmedis(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $assdok = DB::connection('mysql2')->select('select * from assesmen_dokters where id_kunjungan = ?', [$kodekunjungan]);
        $of = DB::connection('mysql2')->select("SELECT
        a.id AS id_header
        ,b.`id` AS id_detail
        ,a.`kode_kunjungan`
        ,b.kode_tarif_detail
        ,a.`kode_unit`
        ,fc_nama_unit1(kode_unit) as unit_tujuan
        ,a.`status_layanan`
        ,b.`status_layanan_detail`
        ,b.`jumlah_layanan`
        ,b.`aturan_pakai`
        ,b.`kode_barang`
        ,fc_nama_barang(b.`kode_barang`) AS nama_barang
        ,b.`kategori_resep`
        ,b.keterangan
        ,a.`status_order`
        ,a.`tgl_entry`
        FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b on a.id = b.row_id_header
        WHERE a.`kode_kunjungan` = '$kodekunjungan' AND b.status_layanan_detail = 'OPN'
        AND a.status_layanan != '3'
        AND a.`kode_unit` IN ('4008','4002')");
        $oL = db::connection('mysql2')->select("SELECT *,fc_nama_unit1(a.kode_unit) as nama_unit,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3002']);
        $oR = db::connection('mysql2')->select("SELECT *,fc_nama_unit1(a.kode_unit) as nama_unit,a.id AS id_header,b.id AS id_detail,b.`kode_tarif_detail`,b.`jumlah_layanan`,d.`NAMA_TARIF` FROM ts_layanan_header_order a
        INNER JOIN ts_layanan_detail_order b ON a.id = b.`row_id_header`
        INNER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        INNER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ? AND b.`status_layanan_detail` = 'OPN' AND a.`status_layanan` = 1 AND a.kode_unit = ?", [$kodekunjungan, '3003']);
        $antrian = DB::connection('mysql2')->select('select * from ts_antrian_farmasi where kode_kunjungan = ?',[$kodekunjungan]);
        return view('V2_erm.hasilpemeriksaandokter', compact('assdok', 'of', 'kodekunjungan', 'oL', 'oR','antrian'));
    }
    public function kirimorderfarmasi(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            $a = ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '4002', '99'))->update(['status_order' => '1']);
        } else {
            $a = ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '4008', '99'))->update(['status_order' => '1']);
        }
        //create antrian

        $cek_antrian = db::connection('mysql2')->select('select * from ts_antrian_farmasi where kode_kunjungan = ?', [$kodekunjungan]);
        if (count($cek_antrian) > 0) {
            $data = [
                'kode' => 200,
                'message' => 'Oder berhasil dikirim!',
            ];
            echo json_encode($data);
            die;
        } else {
            $orderan = db::connection('mysql2')->select("select * from ts_layanan_header_order where kode_kunjungan = '$kodekunjungan' and kode_unit in ('4002','4008') and status_order = '1'");
            if (count($orderan) > 0) {
                $cek_racikan = DB::connection('mysql2')->select("SELECT DISTINCT b.kode_kunjungan
                ,b.`no_rm`
                ,simrs_waled.fc_nama_px(b.no_rm) AS  nama_pasien
                ,fc_nama_unit1(unit_pengirim) AS nama_unit
                ,fc_nama_paramedis1(dok_kirim) AS nama_dokter
                ,fc_hitung_racikan_(b.kode_kunjungan) AS jumlah_racikan
                ,a.status_order
                FROM ts_layanan_header_order a
                INNER JOIN simrs_waled.ts_kunjungan b ON a.kode_kunjungan = b.`kode_kunjungan`
                WHERE a.kode_kunjungan = '$kodekunjungan' and a.status_order = '1'");
                $mt_unit = db::select('select * from mt_unit where kode_unit = ?', [$orderan[0]->kode_unit]);
                $pref = $mt_unit[0]->prefix_unit;
                $kodeunit = $mt_unit[0]->kode_unit;
                if ($cek_racikan[0]->jumlah_racikan == 0) {
                    $jenis_antrian = 'REGULER';
                    $nomor_antrian = $this->get_nomor_antrian_reguler($pref, $kodeunit);
                } else {
                    $jenis_antrian = 'RACIKAN';
                    $nomor_antrian = $this->get_nomor_antrian_racikan($pref, $kodeunit);
                }
                $data_antrian = [
                    'rm' => $kunjungan[0]->no_rm,
                    'nomor_antrian' => $nomor_antrian,
                    'jenis_antrian' => $jenis_antrian,
                    'kode_unit' => $orderan[0]->kode_unit,
                    'unit_pengirim' => $kunjungan[0]->kode_unit,
                    'kode_kunjungan' => $kodekunjungan,
                    'tgl_antrian' => $this->get_now(),
                ];
                ts_antrian_farmasi::create($data_antrian);
                foreach ($orderan as $od) {
                    $update = ts_layanan_header_order::whereRaw('kode_kunjungan = ? and kode_unit = ? and status_layanan = ?', array($kodekunjungan, $kodeunit, 1))->update(['status_order' => '1']);
                }
                $data = [
                    'kode' => 200,
                    'message' => 'Nomor antrian berhasil diambil !',
                ];
                echo json_encode($data);
                die;
            } else {
                $data = [
                    'kode' => 500,
                    'message' => 'Order belum dikirim poli !',
                ];
                echo json_encode($data);
                die;
            }
        }

        $data = [
            'kode' => 200,
            'message' => 'orderan dikirim'
        ];
        echo json_encode($data);
        die;
    }
    public function kirimorderlab(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3002', '99'))->update(['status_order' => '0']);
        } else {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3002', '99'))->update(['status_order' => '0']);
        }
        $data = [
            'kode' => 200,
            'message' => 'orderan dikirim'
        ];
        echo json_encode($data);
        die;
    }
    public function kirimorderrad(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('select * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        if ($kunjungan[0]->kode_penjamin == 'P01') {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3003', '99'))->update(['status_order' => '0']);
        } else {
            ts_layanan_header_order::whereRaw('kode_kunjungan = ? and status_layanan = ? and kode_unit = ? and status_order = ?', array($kodekunjungan, '1', '3003', '99'))->update(['status_order' => '0']);
        }
        $data = [
            'kode' => 200,
            'message' => 'orderan dikirim'
        ];
        echo json_encode($data);
        die;
    }
    public function createLayanandetail()
    {
        //dummy
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
    public function get_nomor_antrian_reguler($pref, $kodeunit)
    {
        $q = DB::connection('mysql2')->select("SELECT id,nomor_antrian,RIGHT(nomor_antrian,3) AS kd_max  FROM ts_antrian_farmasi
        WHERE DATE(tgl_antrian) = CURDATE() AND jenis_antrian =  'REGULER' AND kode_unit = '$kodeunit'
        ORDER BY id DESC
        LIMIT 1");
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'A - '.$pref . $kd;
    }
    public function get_nomor_antrian_racikan($pref, $kodeunit)
    {
        $q = DB::connection('mysql2')->select("SELECT id,nomor_antrian,RIGHT(nomor_antrian,3) AS kd_max  FROM ts_antrian_farmasi
        WHERE DATE(tgl_antrian) = CURDATE() AND jenis_antrian = 'RACIKAN' and kode_unit = '$kodeunit'
        ORDER BY id DESC
        LIMIT 1");
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'B - '.$pref . $kd;
    }
}
