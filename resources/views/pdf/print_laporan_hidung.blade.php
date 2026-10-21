<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Nasoendoskopi Hidung - RSUD Waled</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
            padding-bottom: 8px;
            margin-bottom: 12px;
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
            margin: 1px 0;
        }

        /* Info Pasien */
        .patient-info {
            width: 100%;
            margin-bottom: 12px;
            border-collapse: collapse;
        }

        .patient-info td {
            padding: 3px 5px;
            font-size: 11px;
        }

        /* Tabel Pemeriksaan Medis */
        .exam-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .exam-table th,
        .exam-table td {
            border: 1px solid #000;
            padding: 5px 6px;
            vertical-align: top;
        }

        .exam-table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        /* Checkbox Simulasi Cetak */
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

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
        }

        .checkbox-item {
            width: 50%;
            margin-bottom: 3px;
        }

        .checkbox-inline {
            display: inline-block;
            margin-right: 15px;
        }

        /* Tanda Tangan */
        .footer-section {
            width: 100%;
            margin-top: 15px;
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
        <div class="no-print" style="text-align: right; margin-bottom: 12px;">
            <button onclick="window.print()"
                style="padding: 7px 15px; background: #28a745; color: #fff; border: none; cursor: pointer; font-weight: bold; border-radius: 3px;">
                🖨️ Cetak / Print
            </button>
        </div>

        <!-- KOP SURAT RSUD WALED -->
        <table class="header-table">
            <tr>
                <td style="width: 15%; text-align: center;">
                    <!-- Placeholder Logo RSUD Waled -->
                    <img src="{{ asset('public/img/logo_rs.png') }}" alt="Logo RSUD"
                        style="width: 65px; height: auto; display: block; margin: 0 auto;">
                </td>
                <td class="logo-text" style="width: 70%;">
                    <p style="font-size: 11px; font-weight: bold;">PEMERINTAH KABUPATEN CIREBON</p>
                    <h3 style="font-size: 14px; margin: 2px 0;">RUMAH SAKIT UMUM DAERAH WALED</h3>
                    <p style="font-size: 10px;">Jl. Prabu Kiansantang No. 4 Telp. 0231-661126 Fax. 0231-664091 Cirebon
                    </p>
                    <p style="font-size: 10px;">e-mail: brsud.waled@gmail.com</p>
                </td>
                <td style="width: 15%;"></td>
            </tr>
        </table>

        <div
            style="text-align: center; font-weight: bold; font-size: 12px; margin-bottom: 12px; text-decoration: underline;">
            HASIL PEMERIKSAAN NASOENDOSKOPI / ENDOSKOPI HIDUNG
        </div>

        <!-- INFORMASI PASIEN -->
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

        <div style="font-weight: bold; font-size: 11px; margin-bottom: 5px;">Hasil Pemeriksaan Nasolaringoskopi</div>

        <!-- TABEL HASIL PEMERIKSAAN NASOENDOSKOPI -->
        <table class="exam-table">
            <thead>
                <tr>
                    <th style="width: 25%;">HIDUNG</th>
                    <th style="width: 37.5%;">Kanan</th>
                    <th style="width: 37.5%;">Kiri</th>
                </tr>
            </thead>
            <tbody>
                <!-- KAVUM NASI -->
                <tr>
                    <td style="font-weight: bold;">- Kavum Nasi</td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Lapang', $formData) !!} Lapang</div>
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Mukosa pucat', $formData) !!} Mukosa pucat</div>
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Sempit', $formData) !!} Sempit</div>
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Mukosa Hiperemis', $formData) !!} Mukosa Hiperemis</div>
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Mukosa edema', $formData) !!} Mukosa edema</div>
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Massa', $formData) !!} Massa</div>
                            <div class="checkbox-item"></div>
                            <div class="checkbox-item">{!! isChecked('kanan_kavum_nasi', 'Polip', $formData) !!} Polip</div>
                        </div>
                    </td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Lapang', $formData) !!} Lapang</div>
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Mukosa pucat', $formData) !!} Mukosa pucat</div>
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Sempit', $formData) !!} Sempit</div>
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Mukosa Hiperemis', $formData) !!} Mukosa Hiperemis</div>
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Mukosa edema', $formData) !!} Mukosa edema</div>
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Massa', $formData) !!} Massa</div>
                            <div class="checkbox-item"></div>
                            <div class="checkbox-item">{!! isChecked('kiri_kavum_nasi', 'Polip', $formData) !!} Polip</div>
                        </div>
                    </td>
                </tr>

                <!-- KONKA INFERIOR -->
                <tr>
                    <td style="font-weight: bold;">- Konka inferior</td>
                    <td>
                        <div class="checkbox-inline">{!! isChecked('kanan_konka_inferior', 'Eutrofi', $formData) !!} Eutrofi</div>
                        <div class="checkbox-inline">{!! isChecked('kanan_konka_inferior', 'Hipertrofi', $formData) !!} Hipertrofi</div>
                        <div class="checkbox-inline">{!! isChecked('kanan_konka_inferior', 'Atrofi', $formData) !!} Atrofi</div>
                    </td>
                    <td>
                        <div class="checkbox-inline">{!! isChecked('kiri_konka_inferior', 'Eutrofi', $formData) !!} Eutrofi</div>
                        <div class="checkbox-inline">{!! isChecked('kiri_konka_inferior', 'Hipertrofi', $formData) !!} Hipertrofi</div>
                        <div class="checkbox-inline">{!! isChecked('kiri_konka_inferior', 'Atrofi', $formData) !!} Atrofi</div>
                    </td>
                </tr>

                <!-- MEATUS MEDIUS -->
                <tr>
                    <td style="font-weight: bold;">- Meatus Medius</td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">{!! isChecked('kanan_meatus_medius', 'Terbuka', $formData) !!} Terbuka</div>
                            <div class="checkbox-item">{!! isChecked('kanan_meatus_medius', 'Polip', $formData) !!} Polip</div>
                            <div class="checkbox-item">{!! isChecked('kanan_meatus_medius', 'Tertutup', $formData) !!} Tertutup</div>
                            <div class="checkbox-item">{!! isChecked('kanan_meatus_medius', 'Sekret', $formData) !!} Sekret</div>
                            <div class="checkbox-item">{!! isChecked('kanan_meatus_medius', 'Mukosa edema', $formData) !!} Mukosa edema</div>
                            <div class="checkbox-item">{!! isChecked('kanan_meatus_medius', 'Spina', $formData) !!} Spina</div>
                        </div>
                    </td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">{!! isChecked('kiri_meatus_medius', 'Terbuka', $formData) !!} Terbuka</div>
                            <div class="checkbox-item">{!! isChecked('kiri_meatus_medius', 'Polip', $formData) !!} Polip</div>
                            <div class="checkbox-item">{!! isChecked('kiri_meatus_medius', 'Tertutup', $formData) !!} Tertutup</div>
                            <div class="checkbox-item">{!! isChecked('kiri_meatus_medius', 'Sekret', $formData) !!} Sekret</div>
                            <div class="checkbox-item">{!! isChecked('kiri_meatus_medius', 'Mukosa edema', $formData) !!} Mukosa edema</div>
                            <div class="checkbox-item">{!! isChecked('kiri_meatus_medius', 'Spina', $formData) !!} Spina</div>
                        </div>
                    </td>
                </tr>

                <!-- SEPTUM -->
                <tr>
                    <td style="font-weight: bold;">Septum</td>
                    <td>
                        <div class="checkbox-inline">{!! isChecked('septum', 'Lurus', $formData) !!} Lurus</div>
                        <div class="checkbox-inline">{!! isChecked('septum', 'Deviasi', $formData) !!} Deviasi</div>
                    </td>
                    <td>
                        <div class="checkbox-inline">{!! isChecked('septum', 'Lurus', $formData) !!} Lurus</div>
                        <div class="checkbox-inline">{!! isChecked('septum', 'Deviasi', $formData) !!} Deviasi</div>
                    </td>
                </tr>

                <!-- NASOFARING -->
                <tr>
                    <td style="font-weight: bold;">- Nasofaring</td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Normal', $formData) !!} Normal</div>
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Adenoid', $formData) !!} Adenoid</div>
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Keradangan', $formData) !!} Keradangan</div>
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Massa', $formData) !!} Massa</div>
                        </div>
                    </td>
                    <td>
                        <div class="checkbox-group">
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Normal', $formData) !!} Normal</div>
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Adenoid', $formData) !!} Adenoid</div>
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Keradangan', $formData) !!} Keradangan</div>
                            <div class="checkbox-item">{!! isChecked('nasofaring', 'Massa', $formData) !!} Massa</div>
                        </div>
                    </td>
                </tr>

                <!-- LAIN - LAIN -->
                <tr>
                    <td style="font-weight: bold;">- Lain-lain</td>
                    <td>{{ $formData['kanan_lain_lain'] ?? '-' }}</td>
                    <td>{{ $formData['kiri_lain_lain'] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- KESIMPULAN -->
        <table class="exam-table">
            <tr>
                <td style="width: 25%; font-weight: bold;">KESIMPULAN</td>
                <td style="width: 75%;">{{ $formData['kesimpulan'] ?? '-' }}</td>
            </tr>
        </table>

        <!-- FOOTER TANDA TANGAN -->
        <div class="footer-section">
            <div style="float: left; font-size: 10px;">
                <span class="box checked"></span> Beri tanda ✓ pada kotak pilihan
            </div>
            <div class="signature-box">
                <p style="margin: 0;">Cirebon, {{ $formData['tanggal_pemeriksaan'] ?? date('d-m-Y') }}</p>
                <div style="height: 50px;"></div>
                <p style="margin: 0; font-weight: bold; text-decoration: underline;">
                    {{ $formData['search_dokter'] ?? '(...................................................)' }}
                </p>
                <p style="margin: 0; font-size: 10px;">Tanda tangan dan Nama jelas</p>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</body>

</html>
