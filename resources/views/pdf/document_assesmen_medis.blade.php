<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}" rel="stylesheet">
    <style>
        @page {
            margin: 30px;
            margin-top: 20px;
            margin-bottom: 30px;
            /* Adjust this value as needed */
        }

        /* Add your CSS styles here for PDF formatting */
        body {
            font-family: sans-serif;
        }

        #footer {
            position: fixed;
            /* Posisi tetap di bawah halaman */
            bottom: 0;
            /* Posisikan di paling bawah */
            width: 100%;
            /* Lebar penuh */
            /* text-align: right; */
            /* Teks di tengah */
            font-size: 6pt;
            color: #1d1c1c;
            margin-top: 10px;
        }
    </style>
    <style>
        .kop-surat {
            width: 100%;
            padding: 0px;
            border-bottom: 2px solid #000;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: auto;
            float: left;
        }

        .instansi {
            font-size: 12;
            font-weight: bold;
            margin-left: 10px;
            /* Sesuaikan dengan lebar logo */
        }

        .instansi2 {
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
            /* Sesuaikan dengan lebar logo */
        }

        .instansi3 {
            font-size: 10px;
            font-weight: bold;
            margin-left: 10px;
            /* Sesuaikan dengan lebar logo */
        }

        .alamat {
            font-size: 12px;
            margin-left: 120px;
        }

        .text-xxs {
            font-size: 10px;
        }

        .text-xxxs {
            font-size: 8px;
        }
    </style>
</head>

<body>
    <div class="isi-surat">
        <table class="mb-4" style="width: 100%">
            <tr>
                <td>
                    <p class="float-right text-bold">RM. 07.02-RJ/25</p>
                </td>
            </tr>
        </table>

        <table class="table table-sm mt-2 table-bordered text-bold font-italic"
            style="width: 100%; table-layout: fixed;">
            <tr>
                <td class="text-center" style="width: 40%; vertical-align: middle; padding: 15px;" colspan="1">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo"
                        style="display: block; margin: 0 auto 10px auto;">
                    <div class="instansi2" style="font-size: 16px; line-height: 1.2;">
                        PEMERINTAH KABUPATEN CIREBON
                    </div>
                    <div class="instansi2"
                        style="font-size: 16px; font-weight: bold; line-height: 1.2; margin-bottom: 5px;">
                        RUMAH SAKIT UMUM DAERAH WALED
                    </div>
                    <div class="instansi3"
                        style="font-size: 11px; font-weight: normal; font-style: normal; line-height: 1.3;">
                        Jl. Prabu Kian Santang No. 4 Waled <br>
                        Telp. (0231) 661126 Email: brsud.waled@gmail.com
                    </div>
                </td>

                <td style="width: 60%; vertical-align: middle; padding: 10px;" colspan="2">
                    <table style="width: 100%; font-size: 14px;">
                        <tr>
                            <td style="width: 30%; padding: 4px 0;">Nomor RM</td>
                            <td style="width: 5%; padding: 4px 0;">:</td>
                            <td style="width: 65%; padding: 4px 0;">{{ $mt_pasien[0]->no_rm }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 4px 0;">Nama</td>
                            <td>:</td>
                            <td style="padding: 4px 0;">{{ $mt_pasien[0]->nama_px }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 4px 0;">Tanggal Lahir</td>
                            <td>:</td>
                            <td style="padding: 4px 0;">{{ $mt_pasien[0]->tgl_lahirs }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 4px 0;">Jenis Kelamin</td>
                            <td>:</td>
                            <td style="padding: 4px 0;">
                                @if (strtoupper($mt_pasien[0]->jenis_kelamin) == 'L')
                                    Laki - Laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="3" class="text-center text-bold bg-secondary" style="padding: 8px; font-size: 16px;">
                    Assesmen Medis Rawat Jalan
                </td>
            </tr>
            <tr>
                <td style="width: 33.33%; padding: 8px; vertical-align: top;">
                    POLIKLINIK : <br><span
                        style="font-weight: normal;">{{ strtoupper($ts_kunjungan[0]->nama_unit) }}</span>
                </td>
                <td style="width: 33.33%; padding: 8px; vertical-align: top;">
                    Tanggal Kunjungan : <br><span style="font-weight: normal;">{{ $tglperiksa }}</span>
                </td>
                <td style="width: 33.33%; padding: 8px; vertical-align: top;">
                    Tanggal Pemeriksaan : <br><span style="font-weight: normal;">{{ $tglperiksa2 }}</span>
                </td>
            </tr>
        </table>
        @foreach ($assesmen as $cp)
            @if ($cp->kode_unit != '1028')
                <table class="table table-sm table-bordered text-bold font-italic"
                    style="width: 100%; table-layout: fixed; margin-top: -1px;">
                    <tr>
                        <td style="width: 30%; padding: 6px;">Sumber Data</td>
                        <td colspan="2" style="width: 70%; padding: 6px; font-weight: normal;">
                            {{ $cp->sumber_data }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Selesai Asesmen</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">
                            Tanggal: {{ \Carbon\Carbon::parse($cp->tgl_pemeriksaan)->isoFormat('D MMMM Y') }}
                            &nbsp;|&nbsp;
                            Jam: {{ \Carbon\Carbon::parse($cp->tgl_pemeriksaan)->format('H:i') }} WIB
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Keluhan Utama</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">{{ $cp->keluhan_pasien }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Riwayat Penyakit Dahulu</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal; line-height: 1.4;">
                            @if (!empty($cp->riwayat_kehamilan_pasien_wanita))
                                • Riwayat Kehamilan: {{ $cp->riwayat_kehamilan_pasien_wanita }} <br>
                            @endif
                            @if (!empty($cp->riwyat_kelahiran_pasien_anak))
                                • Riwayat Kelahiran Anak: {{ $cp->riwyat_kelahiran_pasien_anak }} <br>
                            @endif
                            @if (!empty($cp->riwyat_penyakit_sekarang))
                                • Riwayat Penyakit Sekarang: {{ $cp->riwyat_penyakit_sekarang }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Riwayat Alergi</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">
                            {{ $cp->riwayat_alergi }} @if (!empty($cp->keterangan_alergi))
                                | {{ $cp->keterangan_alergi }}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Riwayat Obat yang Diminum</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">
                            {{-- @if (count($orderfarmasi) > 0)
                                @foreach ($orderfarmasi as $t)
                                    {{ $t->kode_barang }} (qty : {{ $t->jumlah_layanan }}), aturan pakai :
                                    {{ $t->aturan_pakai }} /
                                @endforeach
                            @else --}}
                            -
                            {{-- @endif --}}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 6px; vertical-align: top;">Pemeriksaan Fisik ( O )</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal; line-height: 1.4;">
                            <strong>Kesadaran:</strong> {{ $cp->kesadaran }} <br>
                            <table style="width: 100%; font-size: 12px; margin-top: 5px; font-style: italic;">
                                <tr>
                                    <td style="width: 50%;">Tekanan Darah : {{ $cp->tekanan_darah }} mmHg</td>
                                    <td style="width: 50%;">Suhu Tubuh : {{ $cp->suhu_tubuh }} °C</td>
                                </tr>
                                <tr>
                                    <td>Frekuensi Nadi : {{ $cp->frekuensi_nadi }} x/menit</td>
                                    <td>Berat Badan : {{ $asskep[0]->beratbadan ?? '-' }} kg</td>
                                </tr>
                                <tr>
                                    <td>Frekuensi Nafas : {{ $cp->frekuensi_nafas }} x/menit</td>
                                    <td>Tinggi Badan : {{ $asskep[0]->tinggibadan ?? '-' }} cm</td>
                                </tr>
                                <tr>
                                    <td>Usia : {{ $asskep[0]->usia ?? '-' }}</td>
                                    <td>IMT : {{ $asskep[0]->imt ?? '-' }}</td>
                                </tr>
                            </table>
                            <div style="margin-top: 8px;">
                                <strong>Hasil Pemeriksaan:</strong> {{ $cp->pemeriksaan_fisik }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px; vertical-align: top;">Diagnosis ( A )</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">
                            <strong>Diagnosa Utama:</strong> {{ $cp->diagnosakerja }} <br>
                            <strong>Diagnosa Sekunder:</strong> {{ $cp->diagnosabanding ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Rencana Terapi ( P )</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">{{ $cp->renjana_tindakan }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Rencana Pemeriksaan Penunjang</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">
                            {{ $cp->tindakanpenunjang ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Tindak Lanjut</td>
                        <td colspan="2" style="padding: 6px; font-weight: normal;">
                            {{ $cp->tindak_lanjut }} <br>
                            <span style="font-size: 11px; color: #555;">{{ $cp->keterangan_tindak_lanjut }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 40%; padding: 10px; vertical-align: bottom; border-right: none;">
                            <div style="font-size: 11px; font-weight: normal; color: #666; line-height: 1.3;">
                                *Dokumen ini disahkan secara elektronik<br>
                                melalui Sistem Informasi Manajemen RS.
                            </div>
                        </td>
                        <td colspan="2"
                            style="height: 190px;width: 60%; padding: 10px; vertical-align: middle; border-left: none; text-align: right;">
                            <table
                                style="width: 200px; text-align: center; font-size: 13px; font-style: normal; display: inline-table; float: right; border: none;">
                                <tr>
                                    <td style="padding-bottom: 8px; border: none;">
                                        <strong>Dokter Pemeriksa,</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; border: none; text-align: center;">
                                        <div
                                            style="width: 90px; height: 90px; border: 1px dashed #ccc; margin: 0 auto; text-align: center; line-height: 90px;">
                                            <span
                                                style="font-size: 9px; color: #aaa; font-weight: normal; display: inline-block; vertical-align: middle;">[
                                                TTE / QR CODE ]</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 8px; line-height: 1.3; border: none;">
                                        <u>{{ $mt_paramedis[0]->nama_paramedis }}</u><br>
                                        <span style="font-size: 11px; font-weight: normal;">NIP.
                                            {{ $mt_paramedis[0]->nip }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            @else
                <table class="table table-sm table-bordered table-striped font-italic text-bold"
                    style="width: 100%; table-layout: fixed; margin-top: -1px;">
                    <tr>
                        <td style="width: 30%; padding: 6px;">Anamnesa</td>
                        <td style="width: 70%; padding: 6px; font-weight: normal;">{{ $cp->anamnesa }}</td>
                        <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Pemeriksaan Fisik dan Uji Fungsi</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->pemeriksaan_fisik }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Diagnosis Medis ( ICD 10 )</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->diagnosakerja }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Diagnosis Fungsi ( ICD 10 )</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->diagnosabanding }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px; vertical-align: top;">Pemeriksaan Penunjang</td>
                        <td style="padding: 6px; font-weight: normal; line-height: 1.4;">
                            {{ $cp->rencanakerja }}

                            @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                <div style="margin-top: 5px; font-style: italic; color: #333;">
                                    <strong>Hasil Expertisi:</strong> {{ $cp->evaluasi }}
                                </div>
                            @endif

                            @if (count($order_penunjang) > 0)
                                <div style="margin-top: 5px;">
                                    <strong>Order Pemeriksaan Penunjang:</strong><br>
                                    @foreach ($order_penunjang as $d)
                                        • {{ $d->nama_unit }} ({{ $d->NAMA_TARIF }}) <br>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Tata laksana KFR</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->tatalaksana_kfr }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Anjuran</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->anjuran }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Evaluasi</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->evaluasi }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 6px; vertical-align: top;">Suspek Penyakit akibat kerja</td>
                        <td style="padding: 6px; font-weight: normal;">
                            {{ $cp->riwayatlain }}
                            @if (!empty($cp->ket_riwayatlain))
                                <br><span style="font-size: 11px; color: #555;">Keterangan:
                                    {{ $cp->ket_riwayatlain }}</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px; vertical-align: top;">Tindak Lanjut</td>
                        <td style="padding: 6px; font-weight: normal; line-height: 1.4;">
                            @if ($cp->versidk != 2)
                                {{ $cp->tindak_lanjut }}
                            @else
                                @php $tinjut = explode('|', $cp->tindak_lanjut) @endphp
                                <div style="display: block;">
                                    @if (($tinjut[0] ?? 0) == 1)
                                        • Kontrol <br>
                                    @endif
                                    @if (($tinjut[1] ?? 0) == 1)
                                        • Konsul <br>
                                    @endif
                                    @if (($tinjut[2] ?? 0) == 1)
                                        • Rujuk Internal <br>
                                    @endif
                                    @if (($tinjut[3] ?? 0) == 1)
                                        • Rujuk Keluar <br>
                                    @endif
                                    @if (($tinjut[4] ?? 0) == 1)
                                        • Rawat Inap <br>
                                    @endif
                                    @if (($tinjut[5] ?? 0) == 1)
                                        • Dipulangkan <br>
                                    @endif
                                </div>
                            @endif

                            @if (!empty($cp->keterangan_tindak_lanjut))
                                <div style="font-size: 11px; color: #555; margin-top: 2px;">
                                    Keterangan: {{ $cp->keterangan_tindak_lanjut }}
                                </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px; vertical-align: top;">Obat obatan</td>
                        <td style="padding: 6px; font-weight: normal;">
                            @if (count($orderfarmasi) > 0)
                                @foreach ($orderfarmasi as $t)
                                    {{ $t->kode_barang }} (qty : {{ $t->jumlah_layanan }}), aturan pakai :
                                    {{ $t->aturan_pakai }} /
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">Jawaban Konsul Ke poli lain</td>
                        <td style="padding: 6px; font-weight: normal;">{{ $cp->keterangan_tindak_lanjut_2 ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td style="height: 190px;padding: 10px; vertical-align: bottom; border-right: none;">
                            <div style="font-size: 11px; font-weight: normal; color: #666; line-height: 1.3;">
                                *Dokumen Rekam Medis KFR ini disahkan secara elektronik<br>
                                melalui Sistem Informasi Manajemen Rumah Sakit.
                            </div>
                        </td>
                        <td style="padding: 10px; vertical-align: middle; border-left: none; text-align: right;">
                            <table
                                style="width: 200px; text-align: center; font-size: 13px; font-style: normal; display: inline-table; float: right; border: none; background: transparent;">
                                <tr>
                                    <td style="padding-bottom: 8px; border: none;">
                                        <strong>Dokter Pemeriksa,</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; border: none; text-align: center;">
                                        <div
                                            style="width: 90px; height: 90px; border: 1px dashed #ccc; margin: 0 auto; text-align: center; line-height: 90px; background-color: #fff;">
                                            <span
                                                style="font-size: 9px; color: #aaa; font-weight: normal; display: inline-block; vertical-align: middle;">[
                                                TTE / QR CODE ]</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 8px; line-height: 1.3; border: none;">
                                        <u>{{ $mt_paramedis[0]->nama_paramedis }}</u><br>
                                        <span style="font-size: 11px; font-weight: normal;">NIP.
                                            {{ $mt_paramedis[0]->nip }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            @endif
        @endforeach
    </div>
    <footer>
        <div class="text-xxxs font-italic" id="footer">
        </div>
    </footer>
    <script type="text/php">
        if ( isset($pdf) ) {
            // OLD
            // $font = Font_Metrics::get_font("helvetica", "bold");
            // $pdf->page_text(72, 18, "halaman ke {PAGE_NUM} dari {PAGE_COUNT}", $font, 6, array(255,0,0));
            // v.0.7.0 and greater
            $x = 72;
            $y = 763;
            $text = "halaman ke {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
