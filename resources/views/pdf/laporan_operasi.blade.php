@php
    $d = $data[0] ?? null;
    $pasien = $mt_pasien[0] ?? null;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasi</title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}">

    <style>
        @page {
            margin: 20px 25px;
        }

        body {
            font-family: sans-serif;
            font-size: 11.5px;
            color: #000;
            line-height: 1.25;
        }

        #footer {
            position: fixed;
            bottom: -15px;
            width: 100%;
            font-size: 7pt;
            color: #1d1c1c;
        }

        /* Reset style table agar lebih compact */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 5px;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 4px 6px;
            vertical-align: top;
        }

        .table-no-border,
        .table-no-border tr,
        .table-no-border td {
            border: none !important;
            padding: 1px;
        }

        .kop-table td {
            padding: 4px;
        }

        .logo-container {
            width: 12%;
            text-align: center;
            vertical-align: middle;
        }

        .logo {
            width: 55px;
            height: auto;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* Layout kolom tanda tangan */
        .table-ttd {
            margin-top: 10px;
            border: none !important;
            page-break-inside: avoid;
        }

        .table-ttd td {
            border: none !important;
            text-align: center;
            width: 50%;
        }

        .space-ttd {
            height: 60px;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <div class="isi-surat">
        <!-- Dokumen Kode Kanan Atas -->
        <div class="text-right text-bold" style="font-size: 10px; margin-bottom: 3px; padding-right: 2px;">
            RM.08.01-IBS/Rev.02/19
        </div>

        <!-- Bagian Header / Kop Surat -->
        <table class="kop-table">
            <tbody>
                <tr>
                    <td class="logo-container">
                        <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo">
                    </td>
                    <td class="text-center" style="width: 50%; vertical-align: middle;">
                        <span class="text-bold" style="font-size: 12px;">PEMERINTAH KABUPATEN CIREBON</span><br>
                        <span class="text-bold" style="font-size: 13.5px;">RUMAH SAKIT UMUM DAERAH WALED</span><br>
                        <span style="font-size: 9.5px;">Jl. Prabu Kian Santang No. 4 Telp.(0231)661126 Email:
                            brsud.waled@gmail.com</span>
                    </td>
                    <td style="width: 38%; padding: 0px;">
                        <!-- Tabel Identitas Pasien -->
                        <table class="table-no-border" style="width: 100%; margin: 2px; font-size: 10px;">
                            <tr>
                                <td width="35%" class="text-bold">Nomor RM</td>
                                <td width="5%">:</td>
                                <td class="text-bold">{{ $pasien->no_rm ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Nama</td>
                                <td>:</td>
                                <td>{{ $pasien->nama_px ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $pasien->tgl_lahirs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">JK</td>
                                <td>:</td>
                                <td>
                                    @if (isset($pasien->jenis_kelamin) && strtoupper($pasien->jenis_kelamin) == 'L')
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
                    <td style="text-align: center; font-size: 12px;" colspan="2" class="text-bold">LAPORAN OPERASI</td>
                    <td style="font-style: italic; font-size: 9px; text-align: center; vertical-align: middle;">
                        (Label Pasien / Affix Patient Identification Label)
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Ruang Operasi : {{ $d->ruangoperasi ?? '-' }}</td>
                    <td>Kamar : {{ $d->kamaroperasi ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Cito / Terencana : {{ $d->citoterencana ?? '-' }}</td>
                    <td>Tanggal Operasi :
                        {{ isset($d->tanggaloperasi) ? \Carbon\Carbon::parse($d->tanggaloperasi)->format('d-M-Y') : '-' }}
                        / Jam : {{ $d->jamoperasi ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 35%;">
                        Pembedah : {{ $d->pembedah ?? '-' }}<br>
                        Ahli Anestesi : {{ $d->ahlianestesi ?? '-' }}
                    </td>
                    <td style="text-align: left; width: 35%;">
                        Asisten I : {{ $d->asisten1 ?? '-' }}<br>
                        Asisten II : {{ $d->asisten2 ?? '-' }}
                    </td>
                    <td style="text-align: left; width: 30%;">
                        Perawat Instrumen : {{ $d->perawatinstrumen ?? '-' }}<br>
                        Jenis Anestesi : {{ $d->jenisanestesi ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Diagnosa Pra-bedah : {{ $d->diagnosaprabedah ?? '-' }}
                    </td>
                    <td>Indikasi Operasi : {{ $d->indikasioperasi ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Diagnosa Pasca-bedah :
                        {{ $d->diagnosapascabedah ?? '-' }}</td>
                    <td>Jenis Operasi : {{ $d->jenisoperasi ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Desinfeksi Kulit dengan :
                        {{ $d->desinfeksikulitdengan ?? '-' }}</td>
                    <td>
                        Jaringan yang dieksisi : {{ $d->jaringanyangdieksisi ?? '-' }}<br>
                        Dikirim ke PA :
                        <input type="checkbox" {{ ($d->kirimkepatologi ?? 0) == 1 ? 'checked' : '' }}> Ya
                        <input type="checkbox" {{ ($d->kirimkepatologi ?? 1) == 0 ? 'checked' : '' }}> Tidak
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Detail Operasi -->
        <table>
            <tbody>
                <tr>
                    <td style="width: 25%;">Jam mulai : {{ $d->jammulaioperasi ?? '-' }}</td>
                    <td style="width: 25%;">Jam selesai : {{ $d->jamoperasiselesai ?? '-' }}</td>
                    <td style="width: 25%;">Lama : {{ $d->lamaoperasiberlangsung ?? '-' }}</td>
                    <td style="width: 25%;">Bahan dikirim : {{ $d->jenisbahanyangdikirim ?? '-' }}<br>Pemeriksaan :
                        {{ $d->untukpemeriksaan ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 40px;">Macam Sayatan :<br>{{ $d->macamsayatan ?? '-' }}</td>
                    <td colspan="2" style="height: 40px;">Posisi Penderita :<br>{{ $d->posisipenderita ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="min-height: 100px;">
                        <span class="text-bold" style="font-size: 12px;">Teknik Operasi dan Temuan Intra Operasi</span><br>
                        @if ($kode_unit == '1014')
                            <div style="margin-left: 15px; margin-top: 4px;">
                                1. Pasien tidur terlentang di meja operasi<br>
                                2. Dilakukan tindakan aseptik dan antiseptik dengan betadine<br>
                                <div style="margin-left: 15px; margin-top: 2px; margin-bottom: 2px;">
                                    <input {{ ($d->pertanyaan2 ?? '') == 'Mata Kanan' ? 'checked' : '' }}
                                        type="radio"> Mata Kanan &nbsp;&nbsp;
                                    <input {{ ($d->pertanyaan2 ?? '') == 'Mata Kiri' ? 'checked' : '' }}
                                        type="radio"> Mata Kiri
                                </div>
                                3. Pasang Doek bolong<br>
                                4. Anestesi dengan lidokain topikal<br>
                                5. Pasang Klem<br>
                                6. Lakukan insisi dengan pisau<br>
                                7. Bersihkan hordeolum / kalazion dengan kuret<br>
                                8. Lepaskan klem<br>
                                9. Berikan Salep Antibiotik<br>
                                10. Operasi Selesai
                            </div>
                        @else
                            {{ $d->teknikoperasi ?? '-' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Penggunaan BHP khusus :
                        <input type="checkbox" {{ ($d->penggunaanBHP ?? 0) == '1' ? 'checked' : '' }}> Ya &nbsp;
                        <input type="checkbox" {{ ($d->penggunaanBHP ?? 1) == '0' ? 'checked' : '' }}> Tidak
                        <br>
                        Jenis dan Jumlah (BHP Khusus) : {{ $d->jenisjumlahBHP ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Komplikasi Intra-Operasi :
                        <input type="checkbox" {{ ($d->komplikasiintraoprasi ?? 0) == '1' ? 'checked' : '' }}> Ya
                        &nbsp;
                        <input type="checkbox" {{ ($d->komplikasiintraoprasi ?? 1) == '0' ? 'checked' : '' }}> Tidak
                    </td>
                    <td colspan="2" rowspan="2">Penjabaran Komplikasi :<br>{{ $d->penjabarankomplikasi ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Perdarahan : {{ $d->perdarahan ?? '-' }} CC</td>
                </tr>
                <tr>
                    <td colspan="2">1. Kontrol nadi / tensi / pernafasan / suhu
                        :<br>{{ $d->kontrolnaditensi ?? '-' }}</td>
                    <td colspan="2">5. Obat-obatan :<br>{{ $d->obatobatan ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2">2. Puasa :<br>{{ $d->puasa ?? '-' }}</td>
                    <td colspan="2">6. Ganti balut :<br>{{ $d->gantibalut ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2">3. Drain :<br>{{ $d->drain ?? '-' }}</td>
                    <td colspan="2" rowspan="2">7. Lain - Lain :<br>{{ $d->lainlain ?? '-' }}</td>
                </tr>
                <tr>
                    <td colspan="2">4. Infus :<br>{{ $d->infus ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian Tempat, Tanggal dan Kolom Tanda Tangan -->
        <div class="text-right font-italic text-bold" style="margin-top: 10px; padding-right: 30px; font-size: 11px;">
            Waled, {{ isset($d->tgl_entry) ? \Carbon\Carbon::parse($d->tgl_entry)->format('d-M-Y') : date('d-M-Y') }}
        </div>
        
        <table class="table-ttd">
            <tbody>
                <tr>
                    <td style="font-size: 11px; font-weight: bold;">Pembuat Laporan</td>
                    <td style="font-size: 11px; font-weight: bold;">Pembedah</td>
                </tr>
                <tr>
                    <!-- Kolom Barcode Pembuat Laporan -->
                    <td class="space-ttd" style="vertical-align: middle; text-align: center;">
                        @if (!empty($qrtte))
                            <img src="data:image/svg+xml;base64,{{ $qrtte }}"
                                style="width: 85px; height: 85px; display: inline-block;" alt="QR Code TTE">
                        @endif
                    </td>
                    <!-- Kolom Barcode Pembedah -->
                    <td class="space-ttd" style="vertical-align: middle; text-align: center;">
                        @if (!empty($qrtte))
                            <img src="data:image/svg+xml;base64,{{ $qrtte }}"
                                style="width: 85px; height: 85px; display: inline-block;" alt="QR Code TTE">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-bold" style="text-decoration: underline; font-size: 11px;">
                        {{ !empty($username) ? $username : '........................................' }}
                    </td>
                    <td class="text-bold" style="text-decoration: underline; font-size: 11px;">
                        {{ !empty($username) ? $username : '........................................' }}
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10px; font-weight: bold; margin-top: 2px;">NIP : {{ $nip ?? '-' }}</td>
                    <td style="font-size: 10px; font-weight: bold; margin-top: 2px;">NIP : {{ $nip ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <footer>
            <div id="footer"></div>
        </footer>
    </div>

    <!-- Script DomPDF Page Numbering -->
    <script type="text/php">
        if ( isset($pdf) ) {
            $x = 35;
            $y = 815;
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "normal");
            $size = 8;
            $color = array(0,0,0);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>