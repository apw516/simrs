@php
    $d = $trabec ?? null;
    $pasien = $mt_pasien[0] ?? null;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasi Trabekulektomi</title>
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
                    <td style="text-align: center; font-size: 12px;" colspan="2" class="text-bold">LAPORAN OPERASI
                        TRABEKULEKTOMI</td>
                    <td style="font-style: italic; font-size: 9px; text-align: center; vertical-align: middle;">
                        (Label Pasien / Affix Patient Identification Label)
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Tanggal Operasi :
                        {{ isset($d->tanggal_operasi) ? \Carbon\Carbon::parse($d->tanggal_operasi)->format('d-M-Y') : $date ?? '-' }}
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
                        Tindakan : {{ $d->tindakan ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Diagnosa Sebelum Operasi :
                        {{ $d->diagnosa_pre_ops ?? '-' }}</td>
                    <td>Diagnosa Paska Operasi : {{ $d->diagnosa_post_ops ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Detail Laporan Operasi -->
        <table>
            <tbody>
                <tr>
                    <td colspan="2" class="text-bold" style="font-size: 12px;">LAPORAN OPERASI & PROSEDUR</td>
                </tr>
                <tr>
                    <td colspan="2">1. Dilakukan tindakan aseptik dan antiseptik</td>
                </tr>
                <tr>
                    <td colspan="2">2. Dilakukan Injeksi lidocain subtenon</td>
                </tr>
                <tr>
                    <td colspan="2">3. Dilakukan jahitan kendali</td>
                </tr>
                @php
                    $periotomi_basis_split = isset($d->periotomi_basis) ? explode('|', $d->periotomi_basis) : [];
                    $per_1 = $periotomi_basis_split[0] ?? '';
                    $per_2 = $periotomi_basis_split[1] ?? '';

                    $antibiotik_split = isset($d->antibiotik) ? explode('|', $d->antibiotik) : [];
                    $ant_1 = $antibiotik_split[0] ?? '';
                    $ant_2 = $antibiotik_split[1] ?? '';
                @endphp
                <tr>
                    <td style="width:30%;">4. Peritomi basis</td>
                    <td>
                        <span style="margin-right: 15px;"><span
                                class="box-check">{{ $per_1 == '1' ? '☑' : '☐' }}</span> Fornix</span>
                        <span><span class="box-check">{{ $per_2 == '1' ? '☑' : '☐' }}</span> Limbal</span>
                    </td>
                </tr>
                <tr>
                    <td>5. Serelal flap dibuat, ukuran</td>
                    <td>{{ !empty($d->Serelalflap) ? $d->Serelalflap : '....... x .......' }} mm</td>
                </tr>
                <tr>
                    <td colspan="2">6. Parasentesis jam</td>
                </tr>
                <tr>
                    <td>7. Selerotomy dibuat, ukuran</td>
                    <td>{{ !empty($d->selerotomy) ? $d->selerotomy : '....... x .......' }} mm</td>
                </tr>
                <tr>
                    <td colspan="2">8. Iridektomi</td>
                </tr>
                <tr>
                    <td>9. Seleral Flap dijahit sebanyak</td>
                    <td>
                        {{ !empty($d->banyakjahitan) ? $d->banyakjahitan : '..............' }} jahitan
                        &nbsp;&nbsp;|&nbsp;&nbsp; Dengan benang:
                        {{ !empty($d->namabenang) ? $d->namabenang : '..............' }}
                    </td>
                </tr>
                <tr>
                    <td>10. Konjungtiva dijahit sebanyak</td>
                    <td>
                        {{ !empty($d->jlhjaitankonjungtiva) ? $d->jlhjaitankonjungtiva : '..............' }} jahitan
                        &nbsp;&nbsp;|&nbsp;&nbsp; Dengan benang:
                        {{ !empty($d->namabenangkonjungtiva) ? $d->namabenangkonjungtiva : '..............' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">11. Cek filtrasi</td>
                </tr>
                <tr>
                    <td colspan="2">12. Hidrasi sideport</td>
                </tr>
                <tr>
                    <td>13. Antibiotik</td>
                    <td>
                        <span style="margin-right: 15px;"><span
                                class="box-check">{{ $ant_1 == '1' ? '☑' : '☐' }}</span> Subkonjungtiva</span>
                        <span><span class="box-check">{{ $ant_2 == '1' ? '☑' : '☐' }}</span> Topikal</span>
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
