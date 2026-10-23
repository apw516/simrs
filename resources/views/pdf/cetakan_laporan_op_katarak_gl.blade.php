@php
    $d = $glaukoma ?? null;
    $pasien = $mt_pasien[0] ?? null;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasi Glaukoma / Katarak</title>
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
            margin: 15px 20px;
        }

        body {
            font-family: sans-serif;
            font-size: 10px;
            color: #000;
            line-height: 1.15;
        }

        #footer {
            position: fixed;
            bottom: -10px;
            width: 100%;
            font-size: 6pt;
            color: #1d1c1c;
        }

        /* Reset style table agar compact dan solid */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 4px;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 3px 5px;
            vertical-align: top;
        }

        .table-no-border,
        .table-no-border tr,
        .table-no-border td {
            border: none !important;
            padding: 1px;
        }

        .kop-table td {
            padding: 3px;
        }

        .logo-container {
            width: 12%;
            text-align: center;
            vertical-align: middle;
        }

        .logo {
            width: 45px;
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

        /* Kustomisasi Simbol Centang agar sangat jelas di Dompdf */
        .box-check {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
            width: 12px;
            text-align: center;
        }

        /* Layout kolom tanda tangan */
        .table-ttd {
            margin-top: 8px;
            border: none !important;
            page-break-inside: avoid;
        }

        .table-ttd td {
            border: none !important;
            text-align: center;
            width: 50%;
        }

        .space-ttd {
            height: 50px;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <div class="isi-surat">
        <!-- Dokumen Kode Kanan Atas -->
        <div class="text-right text-bold" style="font-size: 8.5px; margin-bottom: 2px; padding-right: 2px;">
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
                        <span class="text-bold" style="font-size: 10.5px;">PEMERINTAH KABUPATEN CIREBON</span><br>
                        <span class="text-bold" style="font-size: 11.5px;">RUMAH SAKIT UMUM DAERAH WALED</span><br>
                        <span style="font-size: 8.5px;">Jl. Prabu Kian Santang No. 4 Telp.(0231)661126 Email:
                            brsud.waled@gmail.com</span>
                    </td>
                    <td style="width: 38%; padding: 0px;">
                        <!-- Tabel Identitas Pasien -->
                        <table class="table-no-border" style="width: 100%; margin: 2px; font-size: 8.5px;">
                            <tr>
                                <td width="30%" class="text-bold">Nomor RM</td>
                                <td width="5%">:</td>
                                <td width="65%" class="text-bold">{{ $pasien->no_rm ?? '-' }}</td>
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
                    <td style="text-align: center;" colspan="2" class="text-bold">LAPORAN OPERASI GLAUKOMA / KATARAK
                    </td>
                    <td style="font-style: italic; font-size: 8px; text-align: center; vertical-align: middle;">
                        (Label Pasien / Affix Patient Identification Label)
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Tanggal Operasi :
                        {{ $glaukoma->tanggal_operasi ?? ($date ?? '-') }}</td>
                    <td>Jam Operasi : {{ $glaukoma->jam_mulai ?? '00:00' }} s.d
                        {{ $glaukoma->jam_selesai ?? '00:00' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 50%;" colspan="2">
                        Nama Ahli Bedah : {{ $glaukoma->ahli_bedah ?? '-' }} <br>
                        Nama Ahli Anestesi : {{ $glaukoma->ahli_anestesi ?? '-' }}
                    </td>
                    <td style="text-align: left; width: 50%;">
                        Nama Asisten : {{ $glaukoma->nama_asisten ?? '-' }} <br>
                        Nama Perawat : {{ $glaukoma->nama_perawat ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        @php
                            $anestesi_split = isset($glaukoma->anestesi) ? explode('|', $glaukoma->anestesi) : [];
                            $an_1 = $anestesi_split[0] ?? '';
                            $an_2 = $anestesi_split[1] ?? '';
                            $an_3 = $anestesi_split[2] ?? '';
                            $an_4 = $anestesi_split[3] ?? '';
                            $an_5 = $anestesi_split[4] ?? '';
                            $an_6 = $anestesi_split[5] ?? '';
                        @endphp
                        <span class="text-bold">Jenis Anestesi:</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $an_1 == '1' ? '☑' : '☐' }}</span>
                            NU</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $an_2 == '1' ? '☑' : '☐' }}</span>
                            RETROBULAR</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $an_3 == '1' ? '☑' : '☐' }}</span>
                            Peribular</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $an_4 == '1' ? '☑' : '☐' }}</span>
                            Topikal</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $an_5 == '1' ? '☑' : '☐' }}</span>
                            Subtenon</span>
                        <span><span class="box-check">{{ $an_6 == '1' ? '☑' : '☐' }}</span> Subkonjungtiva</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Visus Pre - Operasi :
                        {{ $glaukoma->visus_pre_ops ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Diagnosa sebelum Operasi :
                        {{ $glaukoma->diagnosa_pre_ops ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Diagnosa paska Operasi :
                        {{ $glaukoma->diagnosa_post_ops ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 50%;" colspan="2">
                        Nama / Macam Operasi : {{ $glaukoma->macam_operasi ?? '-' }}
                    </td>
                    <td style="text-align: left; width: 50%;">
                        Komplikasi atau penyulit :
                        <strong>{{ !isset($glaukoma->komplikasi) || $glaukoma->komplikasi == '0' || empty($glaukoma->komplikasi) ? 'Tidak Ada' : 'Ada' }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Rincian Detail Laporan Operasi -->
        <table>
            <tbody>
                <tr>
                    <td colspan="2" class="text-bold">LAPORAN OPERASI & TEHNIK</td>
                </tr>
                <tr>
                    <td style="width:20%">Anestesis</td>
                    <td>
                        @php
                            $anestesis_split = isset($glaukoma->Anestesis) ? explode('|', $glaukoma->Anestesis) : [];
                            $ans_1 = $anestesis_split[0] ?? '';
                            $ans_2 = $anestesis_split[1] ?? '';
                            $ans_3 = $anestesis_split[2] ?? '';
                            $ans_4 = $anestesis_split[3] ?? '';
                            $ans_5 = $anestesis_split[4] ?? '';
                            $ans_6 = $anestesis_split[5] ?? '';
                            $ans_7 = $anestesis_split[6] ?? '';
                        @endphp
                        <span style="margin-right: 8px;"><span class="box-check">{{ $ans_1 == '1' ? '☑' : '☐' }}</span>
                            Retrobuller</span>
                        <span style="margin-right: 8px;"><span class="box-check">{{ $ans_2 == '1' ? '☑' : '☐' }}</span>
                            Peribuller</span>
                        <span style="margin-right: 8px;"><span class="box-check">{{ $ans_3 == '1' ? '☑' : '☐' }}</span>
                            Topikal</span>
                        <span style="margin-right: 8px;"><span class="box-check">{{ $ans_4 == '1' ? '☑' : '☐' }}</span>
                            Subtenon</span>
                        <span style="margin-right: 8px;"><span class="box-check">{{ $ans_5 == '1' ? '☑' : '☐' }}</span>
                            Lidocain 2%</span>
                        <span style="margin-right: 8px;"><span class="box-check">{{ $ans_6 == '1' ? '☑' : '☐' }}</span>
                            Marcain 0,5%</span>
                        <span><span class="box-check">{{ $ans_7 == '1' ? '☑' : '☐' }}</span> Lain-lain</span>
                    </td>
                </tr>
                <tr>
                    <td>Akinese</td>
                    <td>
                        @php
                            $akinese_split = isset($glaukoma->Akinese) ? explode('|', $glaukoma->Akinese) : [];
                            $ak_1 = $akinese_split[0] ?? '';
                            $ak_2 = $akinese_split[1] ?? '';
                            $ak_3 = $akinese_split[2] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span class="box-check">{{ $ak_1 == '1' ? '☑' : '☐' }}</span>
                            O’brien</span>
                        <span style="margin-right: 10px;"><span class="box-check">{{ $ak_2 == '1' ? '☑' : '☐' }}</span>
                            Van Lint</span>
                        <span><span class="box-check">{{ $ak_3 == '1' ? '☑' : '☐' }}</span> Lain-lain</span>
                    </td>
                </tr>
                <tr>
                    <td>Flap konjungtiva</td>
                    <td>
                        @php
                            $flap_split = isset($glaukoma->flapkonjungtiva)
                                ? explode('|', $glaukoma->flapkonjungtiva)
                                : [];
                            $fl_1 = $flap_split[0] ?? '';
                            $fl_2 = $flap_split[1] ?? '';
                        @endphp
                        <span style="margin-right: 15px;"><span class="box-check">{{ $fl_1 == '1' ? '☑' : '☐' }}</span>
                            Basis Formiks</span>
                        <span><span class="box-check">{{ $fl_2 == '1' ? '☑' : '☐' }}</span> Basis Limbus</span>
                    </td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>
                        @php
                            $lokasi_split = isset($glaukoma->lokasi) ? explode('|', $glaukoma->lokasi) : [];
                            $lok_1 = $lokasi_split[0] ?? '';
                            $lok_2 = $lokasi_split[1] ?? '';
                            $lok_3 = $lokasi_split[2] ?? '';
                            $lok_4 = $lokasi_split[3] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $lok_1 == '1' ? '☑' : '☐' }}</span> Superonasal</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $lok_2 == '1' ? '☑' : '☐' }}</span> Superior</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $lok_3 == '1' ? '☑' : '☐' }}</span> Superotemporal</span>
                        <span><span class="box-check">{{ $lok_4 == '1' ? '☑' : '☐' }}</span> Lain - lain</span>
                    </td>
                </tr>
                <tr>
                    <td>Flap Sklera</td>
                    <td>{{ $glaukoma->flapsklera ?? '-' }} mm</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold">JENIS BEDAH & TINDAKAN</td>
                </tr>
                <tr>
                    <td>Glaukoma</td>
                    <td>
                        @php
                            $glaukoma_split = isset($glaukoma->glaukoma) ? explode('|', $glaukoma->glaukoma) : [];
                            $gl_1 = $glaukoma_split[0] ?? '';
                            $gl_2 = $glaukoma_split[1] ?? '';
                            $gl_3 = $glaukoma_split[2] ?? '';
                            $gl_4 = $glaukoma_split[3] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $gl_1 == '1' ? '☑' : '☐' }}</span> Goniotomi</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $gl_2 == '1' ? '☑' : '☐' }}</span> Trabekulektomi</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $gl_3 == '1' ? '☑' : '☐' }}</span> Triple Prosedur</span>
                        <span><span class="box-check">{{ $gl_4 == '1' ? '☑' : '☐' }}</span> Lain-lain</span>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Insisi</td>
                    <td>
                        @php
                            $jenis_insisi_split = isset($glaukoma->jenis_insisi)
                                ? explode('|', $glaukoma->jenis_insisi)
                                : [];
                            $jn_1 = $jenis_insisi_split[0] ?? '';
                            $jn_2 = $jenis_insisi_split[1] ?? '';
                            $jn_3 = $jenis_insisi_split[2] ?? '';
                            $jn_4 = $jenis_insisi_split[3] ?? '';
                            $jn_5 = $jenis_insisi_split[4] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $jn_1 == '1' ? '☑' : '☐' }}</span> Kornea</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $jn_2 == '1' ? '☑' : '☐' }}</span> Limbus</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $jn_3 == '1' ? '☑' : '☐' }}</span> Sklera</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $jn_4 == '1' ? '☑' : '☐' }}</span> Skleratunnel</span>
                        <span><span class="box-check">{{ $jn_5 == '1' ? '☑' : '☐' }}</span> Side Port</span>
                    </td>
                </tr>
                <tr>
                    <td>Alat</td>
                    <td>
                        @php
                            $alat_split = isset($glaukoma->alat) ? explode('|', $glaukoma->alat) : [];
                            $alat_1 = $alat_split[0] ?? '';
                            $alat_2 = $alat_split[1] ?? '';
                            $alat_3 = $alat_split[2] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $alat_1 == '1' ? '☑' : '☐' }}</span> Jarum</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $alat_2 == '1' ? '☑' : '☐' }}</span> Crescent</span>
                        <span><span class="box-check">{{ $alat_3 == '1' ? '☑' : '☐' }}</span> Diamond</span>
                    </td>
                </tr>
                <tr>
                    <td>Capsulectomy Anterior</td>
                    <td>
                        @php
                            $Capsulectomy_split = isset($glaukoma->Capsulectomy)
                                ? explode('|', $glaukoma->Capsulectomy)
                                : [];
                            $Capsulectomy_1 = $Capsulectomy_split[0] ?? '';
                            $Capsulectomy_2 = $Capsulectomy_split[1] ?? '';
                            $Capsulectomy_3 = $Capsulectomy_split[2] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $Capsulectomy_1 == '1' ? '☑' : '☐' }}</span> Can Oponer</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $Capsulectomy_2 == '1' ? '☑' : '☐' }}</span> Envelope</span>
                        <span><span class="box-check">{{ $Capsulectomy_3 == '1' ? '☑' : '☐' }}</span> CCC</span>
                    </td>
                </tr>
                <tr>
                    <td>Ekstraksi Lensa</td>
                    <td>
                        @php
                            $ekstraksi_lensa_split = isset($glaukoma->ekstraksi_lensa)
                                ? explode('|', $glaukoma->ekstraksi_lensa)
                                : [];
                            $ekstraksi_1 = $ekstraksi_lensa_split[0] ?? '';
                            $ekstraksi_2 = $ekstraksi_lensa_split[1] ?? '';
                            $ekstraksi_3 = $ekstraksi_lensa_split[2] ?? '';
                            $ekstraksi_4 = $ekstraksi_lensa_split[3] ?? '';
                            $ekstraksi_5 = $ekstraksi_lensa_split[4] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $ekstraksi_1 == '1' ? '☑' : '☐' }}</span> ICCE</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $ekstraksi_2 == '1' ? '☑' : '☐' }}</span> ECCE</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $ekstraksi_3 == '1' ? '☑' : '☐' }}</span> SICE</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $ekstraksi_4 == '1' ? '☑' : '☐' }}</span> PHACO</span>
                        <span><span class="box-check">{{ $ekstraksi_5 == '1' ? '☑' : '☐' }}</span> Lain-lain</span>
                    </td>
                </tr>
                <tr>
                    <td>Tindakan Tambahan</td>
                    <td>
                        @php
                            $tindakan_tambahan_split = isset($glaukoma->tindakan_tambahan)
                                ? explode('|', $glaukoma->tindakan_tambahan)
                                : [];
                            $tindakant_1 = $tindakan_tambahan_split[0] ?? '';
                            $tindakant_2 = $tindakan_tambahan_split[1] ?? '';
                            $tindakant_3 = $tindakan_tambahan_split[2] ?? '';
                            $tindakant_4 = $tindakan_tambahan_split[3] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $tindakant_1 == '1' ? '☑' : '☐' }}</span> Shincterotomy</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $tindakant_2 == '1' ? '☑' : '☐' }}</span> Sinechiolysisis</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $tindakant_3 == '1' ? '☑' : '☐' }}</span> Virektomi
                            Anterior</span>
                        <span><span class="box-check">{{ $tindakant_4 == '1' ? '☑' : '☐' }}</span> Jahitan Iris</span>
                    </td>
                </tr>
                <tr>
                    <td>Cairan Irigasi</td>
                    <td>
                        @php
                            $cairan_irigasi_split = isset($glaukoma->cairan_irigasi)
                                ? explode('|', $glaukoma->cairan_irigasi)
                                : [];
                            $cairan_1 = $cairan_irigasi_split[0] ?? '';
                            $cairan_2 = $cairan_irigasi_split[1] ?? '';
                            $cairan_3 = $cairan_irigasi_split[2] ?? '';
                        @endphp
                        <span style="margin-right: 15px;"><span
                                class="box-check">{{ $cairan_1 == '1' ? '☑' : '☐' }}</span> R.L</span>
                        <span style="margin-right: 15px;"><span
                                class="box-check">{{ $cairan_2 == '1' ? '☑' : '☐' }}</span> BSS</span>
                        <span><span class="box-check">{{ $cairan_3 == '1' ? '☑' : '☐' }}</span> Lain-lain</span>
                    </td>
                </tr>
                <tr>
                    <td>L.I.O</td>
                    <td>
                        @php
                            $LIO_split = isset($glaukoma->LIO) ? explode('|', $glaukoma->LIO) : [];
                            $lio_1 = $LIO_split[0] ?? '';
                            $lio_2 = $LIO_split[1] ?? '';
                            $lio_3 = $LIO_split[2] ?? '';
                            $lio_4 = $LIO_split[3] ?? '';
                            $lio_5 = $LIO_split[4] ?? '';
                            $lio_6 = $LIO_split[5] ?? '';
                            $lio_7 = $LIO_split[6] ?? '';
                            $lio_8 = $LIO_split[7] ?? '';
                            $lio_9 = $LIO_split[8] ?? '';
                            $lio_10 = $LIO_split[9] ?? '';
                        @endphp
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_1 == '1' ? '☑' : '☐' }}</span> B.M.B</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_2 == '1' ? '☑' : '☐' }}</span> B.M.D</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_3 == '1' ? '☑' : '☐' }}</span> Diputar</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_4 == '1' ? '☑' : '☐' }}</span> Tidak Diputar</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_5 == '1' ? '☑' : '☐' }}</span> Horisontal</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_6 == '1' ? '☑' : '☐' }}</span> J Loop</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_7 == '1' ? '☑' : '☐' }}</span> C Loop</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_8 == '1' ? '☑' : '☐' }}</span> Dilipat</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $lio_9 == '1' ? '☑' : '☐' }}</span> Sulvus Siliaris</span>
                        <span><span class="box-check">{{ $lio_10 == '1' ? '☑' : '☐' }}</span> Dalam/Diluar Kantung
                            Kapsul</span>
                    </td>
                </tr>
                <tr>
                    <td>Fiksasi L.I.O</td>
                    <td>
                        @php
                            $FIKSASILIO_split = isset($glaukoma->Fiksasi_LIO)
                                ? explode('|', $glaukoma->Fiksasi_LIO)
                                : [];
                            $flio_1 = $FIKSASILIO_split[0] ?? '';
                            $flio_2 = $FIKSASILIO_split[1] ?? '';
                        @endphp
                        <span style="margin-right: 15px;"><span
                                class="box-check">{{ $flio_1 == '1' ? '☑' : '☐' }}</span> Vertikal</span>
                        <span><span class="box-check">{{ $flio_2 == '1' ? '☑' : '☐' }}</span> Horisontal</span>
                    </td>
                </tr>
                <tr>
                    <td>Cairan Viscoelastik</td>
                    <td>
                        @php
                            $visco_split = isset($glaukoma->Viscoelastik) ? explode('|', $glaukoma->Viscoelastik) : [];
                            $visco_1 = $visco_split[0] ?? '';
                            $visco_2 = $visco_split[1] ?? '';
                            $visco_3 = $visco_split[2] ?? '';
                            $visco_4 = $visco_split[3] ?? '';
                            $visco_5 = $visco_split[4] ?? '';
                        @endphp
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $visco_1 == '1' ? '☑' : '☐' }}</span> Survisc</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $visco_2 == '1' ? '☑' : '☐' }}</span> Starvisc</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $visco_3 == '1' ? '☑' : '☐' }}</span> Rohtovisc</span>
                        <span style="margin-right: 10px;"><span
                                class="box-check">{{ $visco_4 == '1' ? '☑' : '☐' }}</span> Catgel</span>
                        <span><span class="box-check">{{ $visco_5 == '1' ? '☑' : '☐' }}</span> IMD Gel</span>
                    </td>
                </tr>
                <tr>
                    <td>Benang</td>
                    <td>
                        @php
                            $benang_split = isset($glaukoma->Benang) ? explode('|', $glaukoma->Benang) : [];
                            $benang_1 = $benang_split[0] ?? '';
                            $benang_2 = $benang_split[1] ?? '';
                        @endphp
                        <span style="margin-right: 15px;"><span
                                class="box-check">{{ $benang_1 == '1' ? '☑' : '☐' }}</span> Vicryl 8-0</span>
                        <span><span class="box-check">{{ $benang_2 == '1' ? '☑' : '☐' }}</span> Nylon 10-0</span>
                    </td>
                </tr>
                <tr>
                    <td>TIO Pra Bedah</td>
                    <td>
                        OD: {{ $glaukoma->OD_PRA_BEDAH ?? '-' }} mmHg &nbsp;|&nbsp; OS:
                        {{ $glaukoma->OS_PRA_BEDAH ?? '-' }} mmHg
                    </td>
                </tr>
                <tr>
                    <td>Komplikasi</td>
                    <td>
                        @php
                            $komplikasi2_split = isset($glaukoma->komplikasi_2)
                                ? explode('|', $glaukoma->komplikasi_2)
                                : [];
                            $komplikasi2_1 = $komplikasi2_split[0] ?? '';
                            $komplikasi2_2 = $komplikasi2_split[1] ?? '';
                            $komplikasi2_3 = $komplikasi2_split[2] ?? '';
                            $komplikasi2_4 = $komplikasi2_split[3] ?? '';
                            $komplikasi2_5 = $komplikasi2_split[4] ?? '';
                        @endphp
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $komplikasi2_1 == '1' ? '☑' : '☐' }}</span> Ada</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $komplikasi2_2 == '1' ? '☑' : '☐' }}</span> Tidak Ada</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $komplikasi2_3 == '1' ? '☑' : '☐' }}</span> Prolaps
                            vitreus</span>
                        <span style="margin-right: 8px;"><span
                                class="box-check">{{ $komplikasi2_4 == '1' ? '☑' : '☐' }}</span> Perdarahan</span>
                        <span><span class="box-check">{{ $komplikasi2_5 == '1' ? '☑' : '☐' }}</span> Lain -
                            lain</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian Tempat, Tanggal dan Kolom Tanda Tangan TTE -->
        <div class="text-right font-italic text-bold" style="margin-top: 6px; padding-right: 20px; font-size: 9px;">
            Waled,
            {{ isset($glaukoma->tgl_entry) ? \Carbon\Carbon::parse($glaukoma->tgl_entry)->format('d-M-Y') : date('d-M-Y') }}
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
            $size = 7;
            $color = array(0,0,0);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
