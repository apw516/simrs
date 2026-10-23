@php
    $d = $inj ?? null;
    $pasien = $mt_pasien[0] ?? null;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasi Injeksi Intraocular</title>
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

        /* Simbol Centang Unicode Dompdf */
        .box-check {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
            width: 14px;
            text-align: center;
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
                    <td style="text-align: center; font-size: 12px;" colspan="2" class="text-bold">LAPORAN OPERASI INJEKSI INTRAOCULAR</td>
                    <td style="font-style: italic; font-size: 9px; text-align: center; vertical-align: middle;">
                        (Label Pasien / Affix Patient Identification Label)
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Tanggal Operasi :
                        {{ isset($d->tanggal_operasi) ? \Carbon\Carbon::parse($d->tanggal_operasi)->format('d-M-Y') : ($date ?? '-') }}
                    </td>
                    <td>Jam Operasi : {{ $d->jam_mulai ?? '00:00' }} s.d {{ $d->jam_selesai ?? '00:00' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 50%;" colspan="2">
                        Nama Ahli Bedah : {{ $d->ahli_bedah ?? '-' }} <br>
                        Nama Ahli Anestesi : {{ $d->ahli_anestesi ?? '-' }}
                    </td>
                    <td style="text-align: left; width: 50%;">
                        Nama Asisten : {{ $d->nama_asisten ?? '-' }} <br>
                        Jenis Anestesi : {{ $d->jenis_anestesi ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Diagnosa sebelum Operasi : {{ $d->diagnosa_pre_ops ?? '-' }}</td>
                    <td>Diagnosa paska Operasi : {{ $d->diagnosa_post_ops ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Detail Laporan Operasi Injeksi Intraocular -->
        <table>
            <tbody>
                <tr>
                    <td colspan="2" class="text-bold" style="font-size: 12px; text-align: center; background-color: #f4f6f9;">
                        Laporan Operasi Injeksi Intraocular
                    </td>
                </tr>
                @php
                    $inj_tindakan_split = isset($d->tindakan) ? explode('|', $d->tindakan) : [];
                    $inj_1 = $inj_tindakan_split[0] ?? '';
                    $inj_2 = $inj_tindakan_split[1] ?? '';
                    $inj_3 = $inj_tindakan_split[2] ?? '';
                    $inj_4 = $inj_tindakan_split[3] ?? '';
                    $inj_5 = $inj_tindakan_split[4] ?? '';
                    $inj_6 = $inj_tindakan_split[5] ?? '';
                    $inj_7 = $inj_tindakan_split[6] ?? '';
                @endphp
                <tr>
                    <td colspan="2">
                        <span class="box-check">{{ $inj_1 == '1' ? '☑' : '☐' }}</span> Injeksi Antibiotik
                    </td>
                </tr>
                <tr>
                    <td style="width:50%;">
                        <span class="box-check">{{ $inj_2 == '1' ? '☑' : '☐' }}</span> Injeksi anti VEGF
                    </td>
                    <td>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $inj_3 == '1' ? '☑' : '☐' }}</span> Avastine</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $inj_4 == '1' ? '☑' : '☐' }}</span> Patizra</span>
                        <span><span class="box-check">{{ $inj_5 == '1' ? '☑' : '☐' }}</span> Eylea</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="box-check">☑</span> Tindakan aseptik dan antiseptik dengan betadine
                    </td>
                </tr>
                <tr>
                    <td>Lokasi injeksi dari limbus:</td>
                    <td>
                        <span style="margin-right: 15px;"><span class="box-check">{{ $inj_6 == '1' ? '☑' : '☐' }}</span> 4 mm dari limbus</span>
                        <span><span class="box-check">{{ $inj_7 == '1' ? '☑' : '☐' }}</span> 3 mm dari limbus</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Jumlah Injeksi anti VEGF:</strong> {{ !empty($d->jumlah_injeksiantivegf) ? $d->jumlah_injeksiantivegf : '-' }} ml
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Jumlah Injeksi antibiotik:</strong> {{ !empty($d->jumlah_injeksiantibiotik) ? $d->jumlah_injeksiantibiotik : '-' }} ml
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="box-check">☑</span> Tetes mata antibiotik
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="box-check">☑</span> Balut
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian Tempat, Tanggal dan Kolom Tanda Tangan TTE -->
        <div class="text-right font-italic text-bold" style="margin-top: 10px; padding-right: 30px; font-size: 11px;">
            Waled, {{ isset($d->tgl_entry) ? \Carbon\Carbon::parse($d->tgl_entry)->format('d-M-Y') : date('d-M-Y') }}
        </div>

         <table class="table-no-border" style="width: 100%; margin-top: 8px; page-break-inside: avoid;">
            <tr>
                <td style="width: 50%;"></td>
                <td style="width: 50%; text-align: center;">
                    <div style="font-size: 10.5px; font-style: italic; font-weight: bold; margin-bottom: 2px;">
                        Waled,
                        {{ isset($katarak->tgl_entry) ? \Carbon\Carbon::parse($katarak->tgl_entry)->format('d-M-Y') : date('d-M-Y') }}
                    </div>
                    <div style="font-size: 11px; font-weight: bold;">Dokter</div>
                    <div class="space-ttd" style="height: 50px; margin: 4px 0;">
                        @if ($qrtte)
                            <img src="data:image/svg+xml;base64,{{ $qrtte }}"
                                style="width: 85px; height: 85px; display: inline-block;" alt="QR Code TTE">
                        @endif
                    </div>
                    <div class="text-bold" style="text-decoration: underline; font-size: 11px; margin-top: 35px;">
                        {{ !empty($katarak->nama_pembedah) ? $katarak->nama_pembedah : (!empty($username) ? $username : '........................................') }}
                    </div>
                    <div style="font-size: 10px; font-weight: bold; margin-top: 2px;">
                        NIP : {{ $katarak->nip_pembedah ?? ($nip ?? '-') }}
                    </div>
                </td>
            </tr>
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