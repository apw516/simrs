<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pemeriksaan Telinga - RSUD Waled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 15px;
        }

        /* Header Kop Surat */
        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo-text {
            text-align: center;
        }

        .logo-text h4,
        .logo-text h3,
        .logo-text p {
            margin: 2px 0;
        }

        /* Info Pasien */
        .patient-info {
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        .patient-info td {
            padding: 4px 6px;
            font-size: 12px;
        }

        /* Tabel Pemeriksaan Medis */
        .exam-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .exam-table th,
        .exam-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            vertical-align: top;
        }

        .exam-table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        /* Checkbox simulasi cetak */
        .box {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            text-align: center;
            line-height: 9px;
            font-size: 10px;
            margin-right: 4px;
            font-weight: bold;
        }

        .checked::after {
            content: "✓";
        }

        .sub-item {
            margin-left: 15px;
        }

        /* Tanda Tangan */
        .footer-section {
            width: 100%;
            margin-top: 20px;
        }

        .signature-box {
            float: right;
            text-align: center;
            width: 250px;
        }

        .clear {
            clear: both;
        }

        @media print {
            body {
                padding: 0;
            }

            .container {
                border: none;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    @php
        // Decode data detail JSON dari database
        $formData = [];
        if (isset($get_data) && !empty($get_data->data_detail)) {
            $formData = json_decode($get_data->data_detail, true);
        }

        // Helper function untuk cek status centang checkbox
        function isChecked($arrName, $val, $data)
        {
            if (isset($data[$arrName]) && is_array($data[$arrName]) && in_array($val, $data[$arrName])) {
                return '<span class="box checked"></span>';
            }
            return '<span class="box"></span>';
        }
    @endphp

    <div class="container">
        <!-- Tombol Cetak (Hilang saat diprint) -->
        <div class="no-print" style="text-align: right; margin-bottom: 15px;">
            <button onclick="window.print()"
                style="padding: 8px 15px; background: #28a745; color: #fff; border: none; cursor: pointer; font-weight: bold;">Cetak
                / Print</button>
        </div>

        <!-- KOP SURAT -->
        <table class="header-table">
            <tr>
                <td style="width: 15%; text-align: center;">
                    <!-- Placeholder Logo RSUD Waled -->
                    <img src="{{ asset('public/img/logo_rs.png') }}" alt="Logo RSUD"
                        style="width: 65px; height: auto; display: block; margin: 0 auto;">
                </td>
                <td class="logo-text" style="width: 70%;">
                    <p style="font-size: 11px; font-weight: bold;">PEMERINTAH KABUPATEN CIREBON</p>
                    <h3 style="font-size: 14px; margin: 3px 0;">RUMAH SAKIT UMUM DAERAH WALED</h3>
                    <p style="font-size: 10px;">Jl. Prabu Kiansantang No. 4 Telp. 0231-661126 Fax. 0231-664091 Cirebon
                    </p>
                    <p style="font-size: 10px;">e-mail: brsud.waled@gmail.com</p>
                </td>
                <td style="width: 15%;"></td>
            </tr>
        </table>

        <div
            style="text-align: center; font-weight: bold; font-size: 13px; margin-bottom: 15px; text-decoration: underline;">
            HASIL PEMERIKSAAN MIKROSKOPIK / ENDOSKOPI TELINGA
        </div>

        <!-- INFORMASI PASIEN (Disesuaikan dengan variabel sistem rumah sakit Anda) -->
        <table class="patient-info">
            <tr>
                <td style="width: 15%;">Nama Pasien</td>
                <td style="width: 35%;">:
                    {{ $pasien->nama_px ?? '...................................................' }}</td>
                <td style="width: 15%;">Tanggal Lahir</td>
                <td style="width: 35%;">: {{ $pasien->tgl_lahir ?? '.......................' }}</td>
            </tr>
            <tr>
                <td>No. RM</td>
                <td>: {{ $pasien->no_rm ?? '..................................' }}</td>
                <td>No. Kunjungan</td>
                <td>: {{ $kode_kunjungan ?? '.......................' }}</td>
            </tr>
        </table>

        <!-- TABEL PEMERIKSAAN UTAMA -->
        <table class="exam-table">
            <thead>
                <tr>
                    <th style="width: 25%;">TELINGA</th>
                    <th style="width: 37.5%;">Kanan</th>
                    <th style="width: 37.5%;">Kiri</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. LIANG TELINGA -->
                <tr>
                    <td style="font-weight: bold;">Liang Telinga</td>
                    <td>
                        {!! isChecked('kanan_liang_telinga', 'Lapang', $formData) !!} Lapang<br>
                        {!! isChecked('kanan_liang_telinga', 'Sempit', $formData) !!} Sempit<br>
                        {!! isChecked('kanan_liang_telinga', 'Serumen', $formData) !!} Serumen<br>
                        {!! isChecked('kanan_liang_telinga', 'Sekret', $formData) !!} Sekret<br>
                        {!! isChecked('kanan_liang_telinga', 'Jamur', $formData) !!} Jamur<br>
                        {!! isChecked('kanan_liang_telinga', 'Destruksi', $formData) !!} Destruksi<br>
                        {!! isChecked('kanan_liang_telinga', 'Kolesteatoma', $formData) !!} Kolesteatoma<br>
                        {!! isChecked('kanan_liang_telinga', 'Massa / jaringan', $formData) !!} Massa / jaringan<br>
                        {!! isChecked('kanan_liang_telinga', 'Benda asing', $formData) !!} Benda asing<br>
                        {!! isChecked('kanan_liang_telinga', 'Lain-lain', $formData) !!} Lain-lain: {{ $formData['kanan_liang_telinga_lain'] ?? '...' }}
                    </td>
                    <td>
                        {!! isChecked('kiri_liang_telinga', 'Lapang', $formData) !!} Lapang<br>
                        {!! isChecked('kiri_liang_telinga', 'Sempit', $formData) !!} Sempit<br>
                        {!! isChecked('kiri_liang_telinga', 'Serumen', $formData) !!} Serumen<br>
                        {!! isChecked('kiri_liang_telinga', 'Sekret', $formData) !!} Sekret<br>
                        {!! isChecked('kiri_liang_telinga', 'Jamur', $formData) !!} Jamur<br>
                        {!! isChecked('kiri_liang_telinga', 'Destruksi', $formData) !!} Destruksi<br>
                        {!! isChecked('kiri_liang_telinga', 'Kolesteatoma', $formData) !!} Kolesteatoma<br>
                        {!! isChecked('kiri_liang_telinga', 'Massa / jaringan', $formData) !!} Massa / jaringan<br>
                        {!! isChecked('kiri_liang_telinga', 'Benda asing', $formData) !!} Benda asing<br>
                        {!! isChecked('kiri_liang_telinga', 'Lain-lain', $formData) !!} Lain-lain: {{ $formData['kiri_liang_telinga_lain'] ?? '...' }}
                    </td>
                </tr>

                <!-- 2. MEMBRAN TIMPANI -->
                <tr>
                    <td style="font-weight: bold;">Membran Timpani</td>
                    <td>
                        {!! isChecked('kanan_membran_timpani', 'Intak', $formData) !!} Intak<br>
                        <div class="sub-item">
                            {!! isChecked('kanan_membran_timpani', 'Normal', $formData) !!} Normal<br>
                            {!! isChecked('kanan_membran_timpani', 'Hiperemis', $formData) !!} Hiperemis<br>
                            {!! isChecked('kanan_membran_timpani', 'Bulging', $formData) !!} Bulging<br>
                            {!! isChecked('kanan_membran_timpani', 'Retraksi', $formData) !!} Retraksi<br>
                            {!! isChecked('kanan_membran_timpani', 'Sklerotik', $formData) !!} Sklerotik
                        </div>
                        {!! isChecked('kanan_membran_timpani', 'Perforasi', $formData) !!} Perforasi:<br>
                        <div class="sub-item">
                            {!! isChecked('kanan_membran_timpani', 'Sentral', $formData) !!} Sentral<br>
                            {!! isChecked('kanan_membran_timpani', 'Atik', $formData) !!} Atik<br>
                            {!! isChecked('kanan_membran_timpani', 'Marginal', $formData) !!} Marginal
                        </div>
                        {!! isChecked('kanan_membran_timpani', 'Lain-lain', $formData) !!} Lain-lain: {{ $formData['kanan_membran_timpani_lain'] ?? '...' }}
                    </td>
                    <td>
                        {!! isChecked('kiri_membran_timpani', 'Intak', $formData) !!} Intak<br>
                        <div class="sub-item">
                            {!! isChecked('kiri_membran_timpani', 'Normal', $formData) !!} Normal<br>
                            {!! isChecked('kiri_membran_timpani', 'Hiperemis', $formData) !!} Hiperemis<br>
                            {!! isChecked('kiri_membran_timpani', 'Bulging', $formData) !!} Bulging<br>
                            {!! isChecked('kiri_membran_timpani', 'Retraksi', $formData) !!} Retraksi<br>
                            {!! isChecked('kiri_membran_timpani', 'Sklerotik', $formData) !!} Sklerotik
                        </div>
                        {!! isChecked('kiri_membran_timpani', 'Perforasi', $formData) !!} Perforasi:<br>
                        <div class="sub-item">
                            {!! isChecked('kiri_membran_timpani', 'Sentral', $formData) !!} Sentral<br>
                            {!! isChecked('kiri_membran_timpani', 'Atik', $formData) !!} Atik<br>
                            {!! isChecked('kiri_membran_timpani', 'Marginal', $formData) !!} Marginal
                        </div>
                        {!! isChecked('kiri_membran_timpani', 'Lain-lain', $formData) !!} Lain-lain: {{ $formData['kiri_membran_timpani_lain'] ?? '...' }}
                    </td>
                </tr>

                <!-- 3. KAVUM TIMPANI -->
                <tr>
                    <td style="font-weight: bold;">Kavum Timpani</td>
                    <td>
                        Mukosa: {{ $formData['kanan_kavum_mukosa'] ?? '-' }}<br>
                        Osikel: {{ $formData['kanan_kavum_osikel'] ?? '-' }}<br>
                        Isthmus Timpani / anterior / posterior timpani:
                        {{ $formData['kanan_kavum_isthmus'] ?? '-' }}
                    </td>
                    <td>
                        Mukosa: {{ $formData['kiri_kavum_mukosa'] ?? '-' }}<br>
                        Osikel: {{ $formData['kiri_kavum_osikel'] ?? '-' }}<br>
                        Isthmus Timpani / anterior / posterior timpani:
                        {{ $formData['kiri_kavum_isthmus'] ?? '-' }}
                    </td>
                </tr>

                <!-- 4. LAIN - LAIN -->
                <tr>
                    <td style="font-weight: bold;">Lain - Lain</td>
                    <td>{{ $formData['kanan_lain_lain'] ?? '-' }}</td>
                    <td>{{ $formData['kiri_lain_lain'] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- KESIMPULAN & ANJURAN -->
        <table class="exam-table">
            <tr>
                <td style="width: 25%; font-weight: bold;">KESIMPULAN</td>
                <td style="width: 75%;">{{ $formData['kesimpulan'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">ANJURAN</td>
                <td>{{ $formData['anjuran'] ?? '-' }}</td>
            </tr>
        </table>

        <!-- FOOTER TANDA TANGAN -->
        <div class="footer-section">
            <div style="float: left; font-size: 10px;">
                <span class="box checked"></span> Beri tanda ✓ pada kotak pilihan
            </div>
            <div class="signature-box">
                <p style="margin: 0;">Cirebon, {{ $formData['tanggal_pemeriksaan'] ?? date('d-m-Y') }}</p>
                <p style="margin: 2px 0;">Dokter Pemeriksa,</p>
                <div style="height: 8px;">
                    
                </div>
                <div style="width: 90px; height: 90px; margin: 0 auto; text-align: center;">
                    <img src="data:image/svg+xml;base64,{{ $qrtte }}"
                        style="width: 90px; height: 90px; display: block;" alt="QR Code TTE">
                </div>
                <p style="margin: 4px; font-weight: bold; text-decoration: underline;">
                    {{ $formData['search_dokter'] ?? '(...................................................)' }}</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</body>

</html>
