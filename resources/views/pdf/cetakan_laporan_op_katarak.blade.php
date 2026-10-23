<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasi Katarak</title>
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
            font-size: 11.5px;
            color: #000;
            line-height: 1.2;
        }

        #footer {
            position: fixed;
            bottom: -10px;
            width: 100%;
            font-size: 7pt;
            color: #1d1c1c;
        }

        /* Reset style table agar lebih compact dan solid */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 4px;
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
            width: 50px;
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
            /* Mendukung simbol unicode dengan baik di Dompdf */
            font-size: 13px;
            font-weight: bold;
            display: inline-block;
            width: 14px;
            text-align: center;
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
        <div class="text-right text-bold" style="font-size: 10px; margin-bottom: 2px; padding-right: 2px;">
            RM.08.03-IBS / 24
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
                                <td width="30%" class="text-bold">Nomor RM</td>
                                <td width="5%">:</td>
                                <td width="65%">{{ $mt_pasien[0]->no_rm ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Nama</td>
                                <td>:</td>
                                <td>{{ $mt_pasien[0]->nama_px ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $mt_pasien[0]->tgl_lahirs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">JK</td>
                                <td>:</td>
                                <td>{{ $mt_pasien[0]->jenis_kelamin ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-size: 12px;" colspan="3" class="text-bold">LAPORAN OPERASI KATARAK</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Tanggal Operasi :
                        {{ $katarak->tanggal_operasi ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Jam Operasi Dimulai : {{ $katarak->jam_mulai ?? '-' }}
                    </td>
                    <td style="text-align: left;" colspan="1">Jam Operasi Selesai :
                        {{ $katarak->jam_selesai ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">
                        Nama Ahli Bedah : {{ $katarak->ahli_bedah ?? '-' }} <br><br>
                        Nama Ahli Anestesi : {{ $katarak->ahli_anestesi ?? '-' }}
                    </td>
                    <td style="text-align: left;" colspan="1">
                        Nama Asisten : {{ $katarak->nama_asisten ?? '-' }} <br>
                        Nama Perawat : {{ $katarak->nama_perawat ?? '-' }} <br>
                        @php
                            $anestesi_spli = isset($katarak->anestesi) ? explode('|', $katarak->anestesi) : [];
                            $anestesi_1 = $anestesi_spli[0] ?? '';
                            $anestesi_2 = $anestesi_spli[1] ?? '';
                            $anestesi_3 = $anestesi_spli[2] ?? '';
                            $anestesi_4 = $anestesi_spli[3] ?? '';
                            $anestesi_5 = $anestesi_spli[4] ?? '';
                            $anestesi_6 = $anestesi_spli[5] ?? '';
                        @endphp
                        
                        <label style="margin-top:6px; display:block;">Tindakan : Jenis Anestesi</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="anestesi_nu" name="anestesi_nu"
                                value="NU" {{ $anestesi_1 == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anestesi_nu">NU</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="anestesi_retrobular"
                                name="anestesi_retrobular" value="RETROBULAR"
                                {{ $anestesi_2 == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anestesi_retrobular">RETROBULAR</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="anestesi_peribular"
                                name="anestesi_peribular" value="Peribular" {{ $anestesi_3 == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anestesi_peribular">Peribular</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="anestesi_topikal"
                                name="anestesi_topikal" value="Topikal" {{ $anestesi_4 == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anestesi_topikal">Topikal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="anestesi_subtenon"
                                name="anestesi_subtenon" value="Subtenon" {{ $anestesi_5 == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anestesi_subtenon">Subtenon</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="anestesi_subkonjungtiva"
                                name="anestesi_subkonjungtiva" value="Subkonjungtiva"
                                {{ $anestesi_6 == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="anestesi_subkonjungtiva">Subkonjungtiva</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Visus Pre Operasi :
                        {{ $katarak->visus_pre_ops ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Diagnosa Sebelum Operasi :
                        {{ $katarak->diagnosa_pre_ops ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="3">Diagnosa Paska Operasi :
                        {{ $katarak->diagnosa_post_ops ?? '-' }}</td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 50%;" colspan="2">
                        Nama / macam operasi : {{ $katarak->macam_operasi ?? '-' }} <br><br>
                        Komplikasi atau penyulit :
                        {{ !isset($katarak->komplikasi) || $katarak->komplikasi == 'Tidak Ada' || empty($katarak->komplikasi) ? 'checked' : '' }}
                    </td>
                    <td style="text-align: left; width: 50%; height: 45px;">
                        Stiker IOL :
                    </td>
                </tr>
                <tr>
                    @php
                        $insisi_split = isset($katarak->insisi) ? explode('|', $katarak->insisi) : [];
                        $insisi_1 = $insisi_split[0] ?? '';
                        $insisi_2 = $insisi_split[1] ?? '';
                        $insisi_3 = $insisi_split[2] ?? '';
                        $insisi_4 = $insisi_split[3] ?? '';
                        $insisi_5 = $insisi_split[4] ?? '';
                    @endphp
                    <td style="text-align: left;" colspan="3">
                        <span style="font-weight: bold; font-size: 12px;">Laporan Operasi :</span><br>

                        <!-- Tindakan Aseptik dan Antiseptik -->
                        <div style="margin-bottom: 4px; margin-top: 2px;">
                            <strong>Tindakan Aseptik dan Antiseptik</strong>
                        </div>

                        <!-- Insisi main port -->
                        @php
                            $insisi_split = isset($katarak->insisi) ? explode('|', $katarak->insisi) : [];
                            $insisi_1 = $insisi_split[0] ?? '';
                            $insisi_2 = $insisi_split[1] ?? '';
                            $insisi_3 = $insisi_split[2] ?? '';
                            $insisi_4 = $insisi_split[3] ?? '';
                        @endphp
                        <div style="margin-bottom: 4px;">
                            <label style="font-weight: bold;">Insisi main port :</label>
                            <label style="display: inline-block; margin-right: 12px;">
                                <span class="box-check">{{ $insisi_1 == '1' ? '☑' : '☐' }}</span> Sklera
                            </label>
                            <label style="display: inline-block; margin-right: 12px;">
                                <span class="box-check">{{ $insisi_2 == '1' ? '☑' : '☐' }}</span> Kornea
                            </label>
                        </div>

                        <!-- Injeksi tryphan blue -->
                        <div style="margin-bottom: 2px;">
                            Lokasi & Ukuran :
                            <label style="display: inline-block; margin-right: 10px;">
                                <span class="box-check">{{ $insisi_3 == '1' ? '☑' : '☐' }}</span> Superior
                            </label>
                            <label style="display: inline-block;">
                                <span class="box-check">{{ $insisi_4 == '1' ? '☑' : '☐' }}</span> Temporal
                            </label>
                            &nbsp;&nbsp; Ukuran .......mm
                        </div>
                        <div style="margin-bottom: 5px;">
                            Injeksi tryphan blue kedalam bilik mata depan &nbsp;|&nbsp; Irigasi bilik mata depan dan
                            injeksi viscoelastic
                        </div>

                        <!-- Kapsulotomi anterior -->
                        <div style="margin-bottom: 4px;">
                            <label style="font-weight: bold;">Kapsulotomi anterior &nbsp;|&nbsp; Hidrodiseksi:</label>
                            <label style="margin-right: 8px;">
                                <span
                                    class="box-check">{{ isset($katarak->hidrodiseksi) && $katarak->hidrodiseksi == 'Ya' ? '☒' : '☐' }}</span>
                                Ya
                            </label>
                            <label style="margin-right: 12px;">
                                <span
                                    class="box-check">{{ !isset($katarak->hidrodiseksi) || $katarak->hidrodiseksi == 'Tidak' ? '☒' : '☐' }}</span>
                                Tidak
                            </label>

                            <strong style="margin-left: 5px;">Hidrodelineasi:</strong>
                            <label style="margin-right: 8px;">
                                <span
                                    class="box-check">{{ isset($katarak->hidrodelineasi) && $katarak->hidrodelineasi == 'Ya' ? '☒' : '☐' }}</span>
                                Ya
                            </label>
                            <label>
                                <span
                                    class="box-check">{{ !isset($katarak->hidrodelineasi) || $katarak->hidrodelineasi == 'Tidak' ? '☒' : '☐' }}</span>
                                Tidak
                            </label>
                        </div>

                        <!-- Teknik ekstraksi nukleus -->
                        @php
                            $nukleus_split = isset($katarak->teknik_ekstraksi_nukleus)
                                ? explode('|', $katarak->teknik_ekstraksi_nukleus)
                                : [];
                            $nukleus_1 = $nukleus_split[0] ?? '';
                            $nukleus_2 = $nukleus_split[1] ?? '';
                            $nukleus_3 = $nukleus_split[2] ?? '';
                            $nukleus_4 = $nukleus_split[3] ?? '';
                            $nukleus_5 = $nukleus_split[4] ?? '';
                        @endphp
                        <div style="margin-bottom: 4px;">
                            <label style="font-weight: bold;">Teknik ekstraksi nukleus :</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $nukleus_1 == '1' ? '☑' : '☐' }}</span> SICS</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $nukleus_2 == '1' ? '☑' : '☐' }}</span> Phaco</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $nukleus_3 == '1' ? '☑' : '☐' }}</span> Aspirasi
                                Irigasi</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $nukleus_4 == '1' ? '☑' : '☐' }}</span> ICCE</label>
                            <label><span class="box-check">{{ $nukleus_5 == '1' ? '☑' : '☐' }}</span> ECCE</label>
                        </div>

                        <!-- Pemasangan lensa intraocular -->
                        @php
                            $lensa_split = isset($katarak->pemasangan_lensa_intraocular)
                                ? explode('|', $katarak->pemasangan_lensa_intraocular)
                                : [];
                            $lensa_1 = $lensa_split[0] ?? '';
                            $lensa_2 = $lensa_split[1] ?? '';
                            $lensa_3 = $lensa_split[2] ?? '';
                            $lensa_4 = $lensa_split[3] ?? '';
                            $lensa_5 = $lensa_split[4] ?? '';
                            $lensa_6 = $lensa_split[5] ?? '';
                        @endphp
                        <div style="margin-bottom: 4px;">
                            <label style="font-weight: bold;">Pemasangan lensa intraocular :</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $lensa_1 == '1' ? '☑' : '☐' }}</span> BMD</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $lensa_2 == '1' ? '☑' : '☐' }}</span> BMB</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $lensa_3 == '1' ? '☑' : '☐' }}</span> Sulkus</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $lensa_4 == '1' ? '☑' : '☐' }}</span> Fiksasi Sklera</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ $lensa_5 == '1' ? '☑' : '☐' }}</span> Fiksasi Iris</label>
                            <label><span class="box-check">{{ $lensa_6 == '1' ? '☑' : '☐' }}</span> Afakia</label>
                        </div>

                        <!-- Dilakukan hidrasi & Jahitan -->
                        @php
                            $hidrasi_split = isset($katarak->hidrasi) ? explode('|', $katarak->hidrasi) : [];
                            $hidrasi_1 = $hidrasi_split[0] ?? '';
                            $hidrasi_2 = $hidrasi_split[1] ?? '';

                            $jahitan_split = isset($katarak->jahitan) ? explode('|', $katarak->jahitan) : [];
                            $jahitan_1 = $jahitan_split[0] ?? '';
                            $jahitan_2 = $jahitan_split[1] ?? '';
                        @endphp
                        <div style="margin-bottom: 4px;">
                            <label style="font-weight: bold;">Hidrasi:</label>
                            <label style="margin-right: 6px;"><span
                                    class="box-check">{{ $hidrasi_1 == '1' ? '☑' : '☐' }}</span> Side Port</label>
                            <label style="margin-right: 15px;"><span
                                    class="box-check">{{ $hidrasi_2 == '1' ? '☑' : '☐' }}</span> Main Port</label>

                            <label style="font-weight: bold;">Jahitan:</label>
                            <label style="margin-right: 6px;"><span
                                    class="box-check">{{ !isset($jahitan_1) || $jahitan_1 == 'Tidak' ? '☒' : '☐' }}</span>
                                Tidak</label>
                            <label style="margin-right: 8px;"><span
                                    class="box-check">{{ isset($jahitan_1) && $jahitan_1 == 'Ya' ? '☒' : '☐' }}</span>
                                Ya
                                ({{ !empty($jahitan_2) ? $jahitan_2 : '...' }})</label>
                        </div>

                        <!-- Injeksi antibiotik & Tindakan tambahan -->
                        @php
                            $ab_split = isset($katarak->injeksi_antibiotik)
                                ? explode('|', $katarak->injeksi_antibiotik)
                                : [];
                            $ab_1 = $ab_split[0] ?? '';
                            $ab_2 = $ab_split[1] ?? '';

                            $tindakan_split = isset($katarak->keterangan_tambahan)
                                ? explode('|', $katarak->keterangan_tambahan)
                                : [];
                            $tt_1 = $tindakan_split[0] ?? '';
                            $tt_2 = $tindakan_split[1] ?? '';
                        @endphp
                        <div>
                            <label style="font-weight: bold;">Injeksi & Tambahan:</label>
                            <label style="margin-right: 6px;"><span
                                    class="box-check">{{ $ab_1 == '1' ? '☑' : '☐' }}</span> Steroid
                                Subkonjungtiva</label>
                            <label style="margin-right: 6px;"><span
                                    class="box-check">{{ $ab_2 == '1' ? '☑' : '☐' }}</span> AB Intrakameral</label>
                            <label style="margin-right: 6px;"><span
                                    class="box-check">{{ $tt_1 == '1' ? '☑' : '☐' }}</span> Vitrektomi</label>
                            <label><span class="box-check">{{ $tt_2 == '1' ? '☑' : '☐' }}</span> Sinekiolisis</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian Tanggal dan Kolom Tanda Tangan TTE di Sebelah Kanan -->
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
</body>

</html>