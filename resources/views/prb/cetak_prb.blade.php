<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat PRB - {{ $prb->no_srb ?? $noSrb }}</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            /* Memperbesar ukuran teks utama dari 11pt menjadi 13pt */
            font-size: 13pt;
            line-height: 1.4;
            margin: 0;
            padding: 25px;
            /* Margin tampilan layar */
            color: #000;
        }
        /* Utility Layout */
        .w-100 {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .align-top {
            vertical-align: top;
        }

        .fw-bold {
            font-weight: bold;
        }

        /* Header Style */
        .header-table {
            width: 100%;
            margin-bottom: 25px;
        }

        /* Memperbesar ukuran Logo BPJS dari 45px ke 65px */
        .logo-bpjs {
            height: 65px;
            width: auto;
        }

        .header-title {
            font-size: 16pt;
            font-weight: bold;
            line-height: 1.2;
        }

        .header-srb {
            font-size: 14pt;
        }

        /* Content Layout Grid (Two Columns) */
        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .left-col {
            width: 58%;
            padding-right: 20px;
        }

        .right-col {
            width: 42%;
            padding-left: 15px;
        }

        /* Data Alignment Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .label-col {
            width: 150px;
        }

        .colon-col {
            width: 15px;
        }

        /* Resep Obat Section */
        .resep-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .resep-list {
            margin: 0;
            padding-left: 22px;
        }

        .resep-list li {
            margin-bottom: 6px;
        }

        /* Tanda Tangan */
        .signature-container {
            margin-top: 50px;
            text-align: center;
            float: right;
            width: 240px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            margin-top: 65px;
            width: 100%;
        }

        .footer-print {
            font-size: 10pt;
            margin-top: 30px;
        }

        /* CSS Khusus Cetak Printer */
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
            /* Mengatur Margin Cetak Printer (Atas, Kanan, Bawah, Kiri) */
            @page {
                size: A4 landscape;
                margin: 150mm 150mm 150mm 150mm;
            }
        }
    </style>
</head>

<body>

    <!-- Tombol Kontrol (Hilang Saat Diprint) -->
    <div class="no-print" style="margin-bottom: 15px; background: #e9ecef; padding: 10px; border-radius: 5px;">
        <button onclick="window.print()"
            style="padding: 8px 16px; background: #28a745; color: white; border: none; border-radius: 3px; cursor: pointer; font-weight: bold; font-size: 11pt;">
            🖨️ Cetak Surat
        </button>
        <button onclick="window.close()"
            style="padding: 8px 16px; background: #dc3545; color: white; border: none; border-radius: 3px; cursor: pointer; color: white; font-size: 11pt;">
            Tutup Tab
        </button>
    </div>

    <!-- HEADER SURAT -->
    <table class="header-table">
        <tr>
            <td style="width: 35%;" class="align-top">
                <img src="{{ asset('public/img/logobpjs.png') }}" alt="BPJS Kesehatan" class="logo-bpjs"
                    onerror="this.outerHTML='<h2 style=\'margin:0;color:#009640;\'>BPJS Kesehatan</h2>'">
            </td>
            <td style="width: 40%;" class="align-top">
                <div class="header-title">SURAT RUJUK BALIK (PRB)</div>
                <div class="header-title">{{ $prb->nama_faskes ?? 'RSUD WALED' }}</div>
            </td>
            <td style="width: 25%;" class="align-top text-right">
                <div class="header-srb">No.SRB. {{ $noSrb }}</div><br>
                <div class="header-srb">Tanggal.
                    {{ isset($prb->tgl_srb) ? \Carbon\Carbon::parse($prb->tgl_srb)->translatedFormat('d F Y') : date('d F Y') }}
                </div>
            </td>
        </tr>
    </table>

    <!-- KEPADA YTH -->
    <table class="data-table" style="margin-bottom: 15px;">
        <tr>
            <td style="width: 110px;">Kepada Yth</td>
            <td style="width: 15px;">:</td>
            <td><strong>{{ $info->response->peserta->provUmum->nmProvider }}</strong></td>
        </tr>
    </table>

    <!-- MAIN BODY (DUA KOLOM: DATA PASIEN & RESEP OBAT) -->
    <table class="content-table">
        <tr>
            <!-- KOLOM KIRI: DATA PASIEN -->
            <td class="left-col align-top">
                <div style="margin-bottom: 8px;">Mohon Pemeriksaan dan Penanganan Lebih Lanjut :</div>

                <table class="data-table">
                    <tr>
                        <td class="label-col">No.Kartu</td>
                        <td class="colon-col">:</td>
                        <td>{{ $noka ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Nama Peserta</td>
                        <td class="colon-col">:</td>
                        <td>{{ $nama ?? '-' }} ({{ $prb->jk ?? 'L' }})</td>
                    </tr>
                    <tr>
                        <td class="label-col">Tgl.Lahir</td>
                        <td class="colon-col">:</td>
                        <td>{{ $info->response->peserta->tglLahir }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Diagnosa</td>
                        <td class="colon-col">:</td>
                        <td>{{ $prb->diagnosa ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Program PRB</td>
                        <td class="colon-col">:</td>
                        <td>{{ $namaProgram }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">Keterangan</td>
                        <td class="colon-col">:</td>
                        <td>{{ $keterangan }}</td>
                    </tr>
                </table>

                <div style="margin-top: 15px;">Saran Pengelolaan lanjutan di FKTP :</div>
                <div style="padding-left: 20px; font-weight: bold;">
                    {{ $saran }}
                </div>

                <div style="margin-top: 20px;">
                    Demikian atas bantuannya, diucapkan banyak terima kasih.
                </div>
            </td>
            <!-- KOLOM KANAN: RESEP OBAT & TTD -->
            <td class="right-col align-top">
                <div class="resep-title">R/.</div>
                <ol class="resep-list">
                        @foreach ($detail->response->prb->obat->obat as $obat)
                            <li>
                                <strong>{{ $obat->signa1}} x{{ $obat->signa2}} </strong>
                                {{ $obat->nmObat ?? $obat['kdObat'] }}
                            </li>
                        @endforeach
                </ol>
                <div class="signature-container">
                    <div>Mengetahui,</div>
                    <div class="signature-line"></div>
                    <div style="font-size: 11pt; margin-top: 4px;">{{ $mt_paramedis->nama_paramedis ?? '' }}</div>
                </div>
            </td>
        </tr>
    </table>
    <div class="footer-print">
        Tgl.Cetak.{{ now()->timezone(config('app.timezone'))->format('d-m-Y H:i') }}
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
