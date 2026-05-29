<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\VclaimModel;
use Illuminate\Http\Request;

class UpdateERMcontroller extends Controller
{
    public function form_pemeriksaan_dokter(Request $request)
    {
        $kunjungan = DB::select('select *,fc_nama_px(no_rm) as nama_pasien,fc_nama_paramedis(ref_paramedis) AS dokter_kirim,fc_nama_unit1(ref_unit) AS poli_asal from ts_kunjungan a where kode_kunjungan = ?', [$request->kodekunjungan]);
        $nomor_rujukan = $kunjungan[0]->no_rujukan;
        $rujukan = $nomor_rujukan;
        $detailrujukan = '';
        $selisih = 0;
        $daterujukan = 0;
        $status_cek_rujukan = 0;
        $jenisrujukan = 'Tidak ditemukan no rujukan !';
        $alertClass = 'alert-info';
        $alertIcon = 'fas fa-info-circle';
        $borderClass = 'border-left: 6px solid #117a8b;';
        $pesan_rujukan = 'Gagal memproses: Nomor rujukan kosong atau tidak valid.';
        if (strlen($rujukan) > 5) {
            $cekrujukan2 = substr($rujukan, 0, 8);
            if ($cekrujukan2 == '1018R001') {
                $jenisrujukan = 'FASKES 2';
                $status_cek_rujukan = 1;
                $alertClass = 'alert-success'; // Hijau aman karena pasca rawat inap
                $alertIcon = 'fas fa-check-circle';
                $borderClass = 'border-left: 6px solid #28a745;';
                $pesan_rujukan = "Pasien merupakan pasien pasca rawat inap (Faskes 2 Intern).";
            } else {
                $jenisrujukan = 'FASKES 1';
                $v = new VclaimModel();
                try {
                    $res = $v->carirujukan_byno($rujukan);
                    if ($res->metaData->code != 200) {
                        $res = $v->carirujukanRS_byno_($rujukan);
                        $jenisrujukan = 'FASKES 2 (RS)';
                    }
                    if ($res->metaData->code == 200) {
                        $detailrujukan = $res; // Simpan data response asli BPJS
                        $tglkunjungan = $res->response->rujukan->tglKunjungan;
                        $date1 = date_create($tglkunjungan);
                        $date2 = date_create($this->get_date());
                        $selisih = date_diff($date1, $date2)->days;
                        $daterujukan = $tglkunjungan;
                        $status_cek_rujukan = 1;
                        $sisa_hari = 90 - $selisih;
                        if ($selisih >= 60) {
                            $alertClass = 'alert-danger';
                            $alertIcon = 'fas fa-times-circle';
                            $borderClass = 'border-left: 6px solid #dc3545;';
                            $pesan_rujukan = "Masa berlaku rujukan Kritis! Sudah berjalan <strong>{$selisih} Hari</strong> (Sisa waktu {$sisa_hari} hari lagi). <br>
                            ⚠️ <strong>REKOMENDASI PROGRAM BPJS:</strong> Pasien wajib dievaluasi! Jika kondisi klinis sudah STABIL, segera daftarkan sebagai peserta <strong>PRB (Program Rujuk Balik)</strong> ke Faskes 1. Jika BELUM LAYAK PRB, berikan alasan medis yang jelas pada berkas kontrol (misal: Dosis obat belum stabil / Butuh observasi spesialistik berkelanjutan).";
                        } else {
                            $alertClass = 'alert-warning';
                            $alertIcon = 'fas fa-exclamation-triangle';
                            $borderClass = 'border-left: 6px solid #ffc107;';
                            $pesan_rujukan = "Rujukan Aktif Biasa. Berjalan <strong>{$selisih} Hari</strong> (Sisa masa berlaku {$sisa_hari} hari). <br>
                            💡 <strong>EVALUASI KONDISI PASIEN:</strong> Persiapkan kestabilan kondisi pasien. Jika tujuan kunjungan hanya untuk mengambil obat rutin tanpa perubahan terapi, pertimbangkan opsi <strong>Iterasi Obat</strong> agar pasien dapat mengambil obat secara efektif tanpa memperpanjang antrean rujukan baru jika nanti masa berlakunya habis.";
                        }
                    } else {
                        $pesan_rujukan = "Gagal memvalidasi data ke web service BPJS: " . $res->metaData->message;
                    }
                } catch (\Exception $e) {
                    $pesan_rujukan = "Terjadi kesalahan sistem bridging: " . $e->getMessage();
                }
            }
        }

        $no_rm = $kunjungan[0]->no_rm;
        $kode_unit = $kunjungan[0]->kode_unit;
        $asesmen_terakhir = DB::table('assesmen_dokters as b')
            ->join('ts_kunjungan as a', 'b.id_kunjungan', '=', 'a.kode_kunjungan')
            ->select([
                'b.*',                   // Mengambil semua data dokumen asesmen dokter
                'a.tgl_masuk',           // Diperlukan untuk validasi urutan waktu
                'a.status_kunjungan',
                'a.no_rm'
            ])
            ->where('a.no_rm', $no_rm)
            ->where('a.kode_unit', $kode_unit)
            ->where('a.status_kunjungan', '!=', 8)
            ->orderBy('a.tgl_masuk', 'DESC')
            ->orderBy('b.id', 'DESC')
            ->first();

        $asesmen_perawat = DB::table('erm_hasil_assesmen_keperawatan_rajal')
            ->where('kode_kunjungan', $request->kodekunjungan)
            ->first();
        return view('update_erm_dokter.form_pemeriksaan_dokter', compact([
            'kunjungan',
            'pesan_rujukan',
            'alertClass',
            'alertIcon',
            'borderClass',
            'asesmen_terakhir',
            'asesmen_perawat'
        ]));
    }
}
