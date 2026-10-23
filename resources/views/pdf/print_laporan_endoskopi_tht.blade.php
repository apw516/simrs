<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Endoskopi THT-KL - RSUD Waled</title>
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
            padding: 4px 6px;
            vertical-align: top;
        }

        .exam-table th {
            background-color: #f2f2f2;
            text-align: center;
            font-size: 11px;
        }

        /* Checkbox Simulasi Cetak */
        .box {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            text-align: center;
            line-height: 9px;
            font-size: 9px;
            margin-right: 4px;
            font-weight: bold;
        }

        .checked::after {
            content: "✓";
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

        // Helper untuk radio button biopsi
        function isCheckedRadio($name, $val, $data)
        {
            if (isset($data[$name]) && $data[$name] == $val) {
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
                    <p style="font-size: 10px; font-weight: bold;">PEMERINTAH KABUPATEN CIREBON</p>
                    <h3 style="font-size: 13px; margin: 2px 0;">RUMAH SAKIT UMUM DAERAH WALED</h3>
                    <p style="font-size: 9px;">Jl. Prabu Kiansantang No. 4 Telp. 0231-661126 Fax. 0231-664091 Cirebon
                    </p>
                    <p style="font-size: 9px;">e-mail: brsud.waled@gmail.com</p>
                </td>
                <td style="width: 15%;"></td>
            </tr>
        </table>

        <div
            style="text-align: center; font-weight: bold; font-size: 12px; margin-bottom: 10px; text-decoration: underline;">
            LAPORAN HASIL PEMERIKSAAN ENDOSKOPI THT-KL
        </div>

        <!-- INFORMASI PASIEN -->
        <table class="patient-info">
            <tr>
                <td style="width: 18%;">Nama Pasien</td>
                <td style="width: 32%;">: {{ $pasien->nama_px ?? '........................................' }}</td>
                <td style="width: 18%;">No. Rekam Medis</td>
                <td style="width: 32%;">: {{ $pasien->no_rm ?? '....................' }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ $pasien->tgl_lahir ?? '........................................' }}</td>
                <td>L/P</td>
                <td>: {{ $pasien->jenis_kelamin ?? '....' }}</td>
            </tr>
            <tr>
                <td>Tanggal Pemeriksaan</td>
                <td colspan="3">:
                    {{ $formData['tanggal_pemeriksaan'] ?? '........................................' }}</td>
            </tr>
        </table>

        <!-- TABEL HASIL PEMERIKSAAN ENDOSKOPI THT-KL -->
        <table class="exam-table">
            <thead>
                <tr>
                    <th style="width: 35%;">KOMPONEN PEMERIKSAAN</th>
                    <th style="width: 65%;">HASIL / URAIAN PEMERIKSAAN</th>
                </tr>
            </thead>
            <tbody>
                <!-- 1. Kanalis & Telinga -->
                <tr>
                    <td><strong>Kanalis akustikus externus</strong></td>
                    <td>{{ $formData['kanalis_akustikus'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Sekret (Telinga)</strong></td>
                    <td>{{ $formData['sekret_telinga'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Serumen</strong></td>
                    <td>{{ $formData['serumen'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Membran Timpani</strong></td>
                    <td>{{ $formData['membran_timpani'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Mukosa</strong></td>
                    <td>{{ $formData['mukosa'] ?? '-' }}</td>
                </tr>

                <!-- 2. Hidung & Nasofaring -->
                <tr>
                    <td><strong>Konka inferior</strong></td>
                    <td>{{ $formData['konka_inferior'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Konka media</strong></td>
                    <td>{{ $formData['konka_media'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Ostium sinus maxila</strong></td>
                    <td>{{ $formData['ostium_sinus_maxila'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Septum nasi</strong></td>
                    <td>{{ $formData['septum_nasi'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Sekret (Hidung)</strong></td>
                    <td>{{ $formData['sekret_hidung'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Dinding posterior</strong></td>
                    <td>{{ $formData['dinding_posterior'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Dinding lateral</strong></td>
                    <td>{{ $formData['dinding_lateral'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Fossa rosenmuller</strong></td>
                    <td>{{ $formData['fossa_rosenmuller'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Torus tubarius</strong></td>
                    <td>{{ $formData['torus_tubarius'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Tuba eustachius</strong></td>
                    <td>{{ $formData['tuba_eustachius'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Adenoid</strong></td>
                    <td>{{ $formData['adenoid'] ?? '-' }}</td>
                </tr>

                <!-- 3. Orofaring -->
                <tr>
                    <td><strong>Arkus faring</strong></td>
                    <td>{{ $formData['arkus_faring'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Uvula</strong></td>
                    <td>{{ $formData['uvula'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Dinding faring posterior</strong></td>
                    <td>{{ $formData['dinding_faring_posterior'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Tonsil palatina</strong></td>
                    <td>{{ $formData['tonsil_palatina'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Palatum</strong></td>
                    <td>{{ $formData['palatum'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Post nasal drip</strong></td>
                    <td>{{ $formData['post_nasal_drip'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Tonsila lingualis</strong></td>
                    <td>{{ $formData['tonsila_lingualis'] ?? '-' }}</td>
                </tr>

                <!-- 4. Laring -->
                <tr>
                    <td><strong>Plica ariepiglotika</strong></td>
                    <td>{{ $formData['plica_ariepiglotika'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Plica vocalis</strong></td>
                    <td>{{ $formData['plica_vocalis'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Plica ventrikularis</strong></td>
                    <td>{{ $formData['plica_ventrikularis'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Aritenoid</strong></td>
                    <td>{{ $formData['aritenoid'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Fossa piriformis</strong></td>
                    <td>{{ $formData['fossa_piriformis'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Trakea</strong></td>
                    <td>{{ $formData['trakea'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Endolaring sekret</strong></td>
                    <td>{{ $formData['endolaring_sekret'] ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Granuloma</strong></td>
                    <td>{{ $formData['granuloma'] ?? '-' }}</td>
                </tr>

                <!-- 5. Biopsi -->
                <tr>
                    <td><strong>Tindakan Biopsi</strong></td>
                    <td>
                        {!! isCheckedRadio('status_biopsi', 'Dilakukan', $formData) !!} Dilakukan &nbsp;&nbsp;&nbsp;
                        {!! isCheckedRadio('status_biopsi', 'Tidak Dilakukan', $formData) !!} Tidak Dilakukan
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- KESIMPULAN & SARAN -->
        <table class="exam-table">
            <tr>
                <td style="width: 35%; font-weight: bold;">KESIMPULAN</td>
                <td style="width: 65%;">{{ $formData['kesimpulan'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">SARAN</td>
                <td>{{ $formData['saran'] ?? '-' }}</td>
            </tr>
        </table>

        <!-- FOOTER TANDA TANGAN -->
        <div class="footer-section">
            <div class="signature-box">
                <p style="margin: 0;">Cirebon, {{ $formData['tanggal_pemeriksaan'] ?? date('d-m-Y') }}</p>
                <p style="margin: 2px 0;">Dokter Pemeriksa,</p>
                <div style="height: 8px;">

                </div>
                <div style="width: 90px; height: 90px; margin: 0 auto; text-align: center;">
                    <img src="data:image/svg+xml;base64,{{ $qrtte }}"
                        style="width: 90px; height: 90px; display: block;" alt="QR Code TTE">
                </div>
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
