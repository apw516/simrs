<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hasil Ekspertisi {{ $assesmen[0]->unit_konsul ?? 'Konsultasi' }}</title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}">

    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #000;
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 7pt;
            color: #1d1c1c;
        }

        .logo {
            width: 55px;
            height: auto;
        }

        .instansi2 {
            font-size: 13px;
            font-weight: bold;
            line-height: 1.2;
        }

        .instansi3 {
            font-size: 9px;
            font-weight: normal;
            line-height: 1.2;
        }

        .table-bordered {
            border: 1px solid #000 !important;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
        }

        .text-xxxs {
            font-size: 7px;
        }

        .qr-code {
            width: 75px;
            height: 75px;
            margin: 4px 0;
        }

        .box-expertisi {
            min-height: 150px;
            padding: 8px;
            line-height: 1.4;
        }
    </style>
</head>

<body>
    <div class="isi-surat">
        <!-- Header Dokumen RM -->
        <table style="width: 100%" class="mb-1">
            <tr>
                <td>
                    <p class="float-right text-bold mb-0" style="font-size: 10px;">RM. 14-RI/Rev.02/19</p>
                </td>
            </tr>
        </table>

        <!-- Kop & Data Pasien -->
        <table class="table table-sm table-bordered text-bold mb-2" style="width: 100%; table-layout: fixed;">
            <tr>
                <td class="text-center" style="width: 45%; vertical-align: middle; padding: 10px;" colspan="1">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo mb-2"
                        style="display: block; margin: 0 auto;">
                    <div class="instansi2">PEMERINTAH KABUPATEN CIREBON</div>
                    <div class="instansi2 mb-1">RUMAH SAKIT UMUM DAERAH WALED</div>
                    <div class="instansi3">
                        Jl. Prabu Kian Santang No. 4 Waled <br>
                        Telp. (0231) 661126 Email: brsud.waled@gmail.com
                    </div>
                </td>
                <td style="width: 55%; vertical-align: middle; padding: 8px;" colspan="2">
                    <table style="width: 100%; font-size: 11px; font-weight: normal;">
                        <tr>
                            <td style="width: 35%; padding: 2px 0;">Nomor RM</td>
                            <td style="width: 5%; padding: 2px 0;">:</td>
                            <td style="width: 60%; padding: 2px 0;" class="text-bold">{{ $mt_pasien[0]->no_rm ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Nama Pasien</td>
                            <td>:</td>
                            <td style="padding: 2px 0;" class="text-bold">{{ $mt_pasien[0]->nama_px ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Tanggal Lahir</td>
                            <td>:</td>
                            <td style="padding: 2px 0;">{{ $mt_pasien[0]->tgl_lahirs ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Jenis Kelamin</td>
                            <td>:</td>
                            <td style="padding: 2px 0;">
                                @if (strtoupper($mt_pasien[0]->jenis_kelamin ?? '') == 'L')
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
                <td colspan="3" class="text-center text-bold bg-secondary" style="padding: 4px; font-size: 13px;">
                    EKSPERTISI ULTRASONOGRAPHY
                </td>
            </tr>
        </table>

        <!-- Detail Informasi Pemeriksaan/Ekspertisi -->
        <table class="table table-bordered mb-2" style="width: 100%;">
            <tr>
                <td style="padding: 8px;">
                    <table style="width: 100%; font-size: 11px;" class="mb-2">
                        <tr>
                            <td style="width: 18%;">Tanggal Pemeriksaan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 80%;">{{ $assesmen[0]->tgl_pemeriksaan ?? date('d-m-Y H:i') }} WIB</td>
                        </tr>
                        <tr>
                            <td>Dokter</td>
                            <td>:</td>
                            <td>{{ $assesmen[0]->nama_dokter ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Unit / Poliklinik</td>
                            <td>:</td>
                            <td>{{ $assesmen[0]->unit_konsul ?? '-' }}</td>
                        </tr>
                    </table>

                    <hr style="border: 0.5px solid #ccc; margin: 8px 0;">

                    <!-- KOLOM ISI EKSPERTISI -->
                    <div class="box-expertisi">
                        <strong style="font-size: 12px; text-decoration: underline;">HASIL PEMERIKSAAN /
                            KESIMPULAN:</strong>
                        <p style="margin-top: 6px; font-weight: normal; font-size: 11px;">
                            {!! nl2br(e($assesmen[0]->evaluasi ?? ($assesmen[0]->hasil_expertisi ?? 'Belum ada data ekspertisi.'))) !!}
                        </p>

                        {{-- @if (!empty($assesmen[0]->saran))
                            <strong style="font-size: 12px; text-decoration: underline; margin-top: 10px; display: block;">SARAN:</strong>
                            <p style="margin-top: 4px; font-weight: normal; font-size: 11px;">
                                {!! nl2br(e($assesmen[0]->saran)) !!}
                            </p>
                        @endif --}}
                    </div>

                    <!-- AREA TANDA TANGAN QR CODE DOKTER PARAF/EKSPERTISI -->
                    <table style="width: 100%; margin-top: 15px;">
                        <tr>
                            <td style="width: 55%;"></td>
                            <td style="width: 45%; text-align: center;">
                                <span>Cirebon, {{ $assesmen[0]->tgl_expertisi ?? date('d F Y') }}</span><br>
                                <span>Dokter Pemeriksa / Ekspertisi,</span><br>

                                <!-- QR Code Dokter Ekspertisi -->
                                {{-- @if (!empty($assesmen[0]->qr_code_dokter))
                                    <img src="{{ $assesmen[0]->qr_code_dokter }}" class="qr-code"><br>
                                @elseif(!empty($assesmen[0]->qr_dokter_pemeriksa))
                                    <img src="{{ $assesmen[0]->qr_dokter_pemeriksa }}" class="qr-code"><br>
                                @else
                                    <div style="height: 75px;"></div>
                                @endif --}}
                                <div style="width: 90px; height: 90px; margin: 0 auto; text-align: center;">
                                    <img src="data:image/svg+xml;base64,{{ $qrjawab }}"
                                        style="width: 90px; height: 90px; display: block;" alt="QR Code TTE">
                                </div>
                                <strong
                                    style="text-decoration: underline;">({{ $assesmen[0]->dokter_pemeriksa ?? ($assesmen[0]->nama_dokter ?? '.........................................') }})</strong><br>
                                <small>SIP: {{ $assesmen[0]->sip_dokter ?? '-' }}</small>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <footer>
        <div class="text-xxxs font-italic" id="footer">
            Dokumen ini dicetak secara otomatis melalui Sistem Informasi Manajemen RSUD Waled Cirebon.
        </div>
    </footer>

    <script type="text/php">
        if ( isset($pdf) ) {
            $x = 72;
            $y = 765;
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
