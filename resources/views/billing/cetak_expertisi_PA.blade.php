<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Expertisi Patologi Anatomi</title>
    <style>
        @page {
            margin: 0.8cm 1.2cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9.5pt;
            line-height: 1.35;
            color: #000;
        }

        /* Kop Surat */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .kop-table td {
            vertical-align: middle;
        }

        .logo-left {
            width: 65px;
            text-align: left;
        }

        .logo-right {
            width: 75px;
            text-align: right;
        }

        .kop-header {
            text-align: center;
        }

        .kop-header .instansi {
            font-size: 11pt;
            font-weight: bold;
            margin: 0;
        }

        .kop-header .unit {
            font-size: 11pt;
            font-weight: bold;
            margin: 2px 0;
        }

        .kop-header .alamat {
            font-size: 8.5pt;
            margin: 0;
        }

        /* Border Garis Kop */
        .line-double {
            border-top: 1px solid #000;
            border-bottom: 2px solid #000;
            height: 2px;
            margin-bottom: 8px;
        }

        /* Informasi Pasien & Pemeriksaan */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-bottom: 6px;
        }

        .info-table td {
            padding: 1.5px 0;
            vertical-align: top;
        }

        .info-table td.lbl {
            font-weight: bold;
            white-space: nowrap;
        }

        .info-table td.sep {
            width: 12px;
            text-align: center;
        }

        /* Title Pemeriksaan */
        .title-box {
            text-align: center;
            margin: 12px 0;
            font-weight: bold;
        }

        .title-box .main-title {
            font-size: 10.5pt;
            text-transform: uppercase;
        }

        .title-box .sub-title {
            font-size: 10pt;
            margin-top: 2px;
        }

        /* Detail Hasil Expertisi */
        .content-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
        }

        .content-table td {
            padding: 4px 0;
            vertical-align: top;
        }

        .content-table td.label-column {
            width: 130px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content-table td.value-column {
            text-align: justify;
        }

        /* Tanda Tangan Dokter */
        .ttd-container {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }

        .ttd-container td {
            text-align: right;
            vertical-align: top;
        }

        .ttd-space {
            height: 55px;
        }

        .sip-text {
            font-size: 8pt;
            margin-top: 2px;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT RSUD WALED -->
    <table class="kop-table">
        <tr>
            <td class="logo-left">
                <!-- Sesuaikan path logo Pemkab/Kabupaten Cirebon -->
                <img src="{{ public_path('../public/img/logo_rs.png') }}" style="width: 100px;" alt="Logo Kab">
            </td>
            <td class="kop-header">
                <div class="instansi">RUMAH SAKIT UMUM DAERAH WALED</div>
                <div class="unit">INSTALASI LABORATORIUM PATOLOGI KLINIK DAN KEDOKTERAN LABORATORIUM</div>
                <div class="alamat">Jl. Prabu Kiansantang No.4, Waled Kota, Waled, Cirebon, Jawa Barat 45187</div>
            </td>
            <td class="logo-right">
                <!-- Sesuaikan path logo RSUD Waled -->
                {{-- <img src="{{ public_path('../public/img/logo_rs.png') }}" style="width: 85px;" alt="Logo RS"> --}}
            </td>
        </tr>
    </table>

    <div class="line-double"></div>

    <!-- DATA PASIEN & PEMERIKSAAN HEADER -->
    <table class="info-table">
        <tr>
            <td class="lbl" style="width: 90px;">Tanggal</td>
            <td class="sep">:</td>
            <td style="width: 32%;">
                {{ isset($data->tgl_baca) ? date('d-m-Y', strtotime($data->tgl_baca)) : date('d-m-Y') }}</td>

            <td class="lbl" style="width: 130px;">Nomor pemeriksaan</td>
            <td class="sep">:</td>
            <td><strong>[{{ $data->no_periksa ?? '-' }}]</strong></td>
        </tr>
        <tr>
            <td class="lbl">Nomor RM</td>
            <td class="sep">:</td>
            <td><strong>{{ $data->no_rm ?? '-' }}</strong></td>

            <td class="lbl">Asal / Ruangan</td>
            <td class="sep">:</td>
            <td>{{ strtoupper($data->nama_ruangan ?? 'PENYAKIT DALAM (KLINIK)') }}</td>
        </tr>
        <tr>
            <td class="lbl">Nama</td>
            <td class="sep">:</td>
            <td><strong>{{ strtoupper($data->nama_pasien ?? '-') }}</strong></td>

            <td class="lbl">Tanggal selesai</td>
            <td class="sep">:</td>
            <td>{{ isset($data->tgl_selesai) ? date('d-m-Y', strtotime($data->tgl_selesai)) : date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td class="lbl">Tanggal lahir</td>
            <td class="sep">:</td>
            <td>
                @if (!empty($mt_pasien[0]->tgl_lahir))
                    {{ date('d-m-Y', strtotime($mt_pasien[0]->tgl_lahir)) }}
                    ({{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }} Th)
                @else
                    -
                @endif
            </td>
            <td class="lbl">Dokter PA</td>
            <td class="sep">:</td>
            <td>{{ $data->dokter_pemeriksa ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">Alamat</td>
            <td class="sep">:</td>
            <td>{{ strtoupper($mt_pasien[0]->alamat_pasien ?? '-') }}</td>

            <td class="lbl">Dokter Pengirim</td>
            <td class="sep">:</td>
            <td>{{ $data->dokter_pengirim ?? '-' }}</td>
        </tr>
        <tr>
            <td class="lbl">Diagnostik Klinik</td>
            <td class="sep">:</td>
            <td>{{ $data->diagnostik_klinik ?? '-' }}</td>

            <td class="lbl">Diagnostik Pasca Bedah</td>
            <td class="sep">:</td>
            <td>{{ $data->diagnostik_pasca_bedah ?? '' }}</td>
        </tr>
    </table>

    <hr style="border: none; border-top: 1px solid #000; margin: 4px 0 10px 0;">

    <!-- TITLE PATOLOGI ANATOMI -->
    <div class="title-box">
        <div class="main-title">PATOLOGI ANATOMI</div>
        <div class="sub-title">[{{ $data->no_periksa ?? '-' }}]</div>
    </div>

    <!-- DETAIL EXPERTISI -->
    <table class="content-table">
        <tr>
            <td class="label-column">Jenis sampel</td>
            <td class="value-column">{{ $data->jenis_sampel ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-column">MAKROSKOPIS</td>
            <td class="value-column">{{ $data->makroskopis ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-column">MIKROSKOPIS</td>
            <td class="value-column">{{ $data->mikroskopis ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-column">KESIMPULAN</td>
            <td class="value-column">
                <strong>{{ $data->kesimpulan ?? '-' }}</strong>
            </td>
        </tr>
    </table>

    <hr style="border: none; border-top: 1px solid #000; margin-top: 15px;">

    <!-- TANDA TANGAN DOKTER -->
    <table class="ttd-container">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                <div>Cirebon, {{ \Carbon\Carbon::parse($data->tgl_baca)->locale('id')->translatedFormat('d F Y') }}
                </div>
                <div style="font-weight: bold; margin-top: 2px;">DPJP Laboratorium PA</div>

                <div class="ttd-space"></div>

                <div style="font-weight: bold; text-decoration: underline;">
                    {{ $data->dokter_pemeriksa ?? 'dr. Hani Andriani, Sp.PA' }}
                </div>
                <div class="sip-text">
                    {{ $data->sip_dokter ?? '449 / SIP.Dsp-176 / SDK / DINKES / V / 2021' }}
                </div>
            </td>
        </tr>
    </table>

</body>

</html>
