<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}" rel="stylesheet">
    <style>
        @page {
            margin: 30px;
            margin-top: 20px;
            margin-bottom: 30px;
            /* Adjust this value as needed */
        }

        /* Add your CSS styles here for PDF formatting */
        body {
            font-family: sans-serif;
        }

        #footer {
            position: fixed;
            /* Posisi tetap di bawah halaman */
            bottom: 0;
            /* Posisikan di paling bawah */
            width: 100%;
            /* Lebar penuh */
            /* text-align: right; */
            /* Teks di tengah */
            font-size: 6pt;
            color: #1d1c1c;
            margin-top: 10px;
        }
    </style>
    <style>
        .kop-surat {
            width: 100%;
            padding: 0px;
            border-bottom: 2px solid #000;
            text-align: center;
        }

        .logo {
            width: 60px;
            height: auto;
            float: left;
        }

        .instansi {
            font-size: 12;
            font-weight: bold;
            margin-left: 10px;
            /* Sesuaikan dengan lebar logo */
        }

        .instansi2 {
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
            /* Sesuaikan dengan lebar logo */
        }

        .instansi3 {
            font-size: 10px;
            font-weight: bold;
            margin-left: 10px;
            /* Sesuaikan dengan lebar logo */
        }

        .alamat {
            font-size: 12px;
            margin-left: 120px;
        }

        .text-xxs {
            font-size: 10px;
        }

        .text-xxxs {
            font-size: 8px;
        }
    </style>
</head>

<body>
    <div class="isi-surat">
        <table class="mb-2" style="width: 100%; border: none;">
            <tr>
                <td style="text-align: right; border: none;">
                    <span style="font-weight: bold; font-size: 11px; letter-spacing: 0.5px;">RM. 07.02-RJ/25</span>
                </td>
            </tr>
        </table>

        <table class="table table-sm table-bordered text-xs"
            style="width: 100%; table-layout: fixed; margin-bottom: 15px;">
            <tr>
                <td class="text-center" style="width: 55%; padding: 10px; vertical-align: middle;">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo"
                        style="width: 60px; max-height: 60px; margin-bottom: 5px;">
                    <div class="instansi2" style="font-weight: bold; font-size: 12px; line-height: 1.2;">
                        PEMERINTAH KABUPATEN CIREBON
                    </div>
                    <div class="instansi2"
                        style="font-weight: bold; font-size: 13px; line-height: 1.2; margin-bottom: 2px;">
                        RUMAH SAKIT UMUM DAERAH WALED
                    </div>
                    <div class="instansi3"
                        style="font-weight: normal; font-size: 10px; color: #444; line-height: 1.3; font-style: normal;">
                        Jl. Prabu Kian Santang No. 4 Waled <br>
                        Telp. (0231) 661126 | Email: brsud.waled@gmail.com
                    </div>
                </td>

                <td style="width: 45%; padding: 8px; vertical-align: middle;">
                    <table style="width: 100%; border: none; background: transparent;">
                        <tr style="font-weight: bold;">
                            <td style="width: 35%; padding: 2px 0; border: none;">No. RM</td>
                            <td style="width: 5%; padding: 2px 0; border: none; text-align: center;">:</td>
                            <td
                                style="width: 60%; padding: 2px 0; border: none; font-size: 13px; letter-spacing: 0.5px;">
                                {{ $mt_pasien[0]->no_rm }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 2px 0; border: none;">Nama Pasien</td>
                            <td style="padding: 2px 0; border: none; text-align: center;">:</td>
                            <td style="padding: 2px 0; border: none; text-transform: uppercase;">
                                {{ $mt_pasien[0]->nama_px }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 2px 0; border: none;">Tgl. Lahir</td>
                            <td style="padding: 2px 0; border: none; text-align: center;">:</td>
                            <td style="padding: 2px 0; border: none;">
                                {{ $mt_pasien[0]->tgl_lahirs }}
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 2px 0; border: none;">Jenis Kelamin</td>
                            <td style="padding: 2px 0; border: none; text-align: center;">:</td>
                            <td style="padding: 2px 0; border: none;">
                                @if (strtoupper($mt_pasien[0]->jenis_kelamin) == 'L')
                                    Laki-Laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center text-bold bg-success"
                    style="padding: 6px; font-size: 13px; color: #fff; background-color: #198754 !important;">
                    RESUME MEDIS RAWAT JALAN
                </td>
            </tr>

            <tr style="font-weight: bold;">
                <td style="padding: 6px 10px;">
                    POLIKLINIK: <span style="font-weight: normal;">{{ strtoupper($ts_kunjungan[0]->nama_unit) }}</span>
                </td>
                <td style="padding: 6px 10px;">
                    Tanggal Periksa: <span style="font-weight: normal;">{{ $tglperiksa }}</span>
                </td>
            </tr>
        </table>
        @foreach ($assesmen as $cp)
            @if ($cp->kode_unit != '1028')
                <table class="table table-sm table-bordered"
                    style="width: 100%; table-layout: fixed; background-color: #fff; word-wrap: break-word; font-size: 11px;">

                    <!-- Keluhan Utama -->
                    <tr>
                        <td
                            style="width: 30%; max-width: 30%; padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Keluhan Utama</td>
                        <td style="width: 70%; max-width: 70%; padding: 5px; white-space: pre-line;">
                            {{ $cp->keluhan_pasien }}</td>
                    </tr>

                    <!-- Riwayat Alergi -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Riwayat Alergi</td>
                        <td style="padding: 5px;">
                            @if (!empty($cp->riwayat_alergi) || !empty($cp->keterangan_alergi))
                                {{ $cp->riwayat_alergi }} | {{ $cp->keterangan_alergi }}
                            @else
                                Tidak Ada Riwayat Alergi
                            @endif
                        </td>
                    </tr>

                    <!-- Kesadaran -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Kesadaran</td>
                        <td style="padding: 5px;">{{ $cp->kesadaran }}</td>
                    </tr>

                    <!-- Pemeriksaan Tanda Tanda Vital -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Pemeriksaan Tanda Vital</td>
                        <td style="padding: 5px; line-height: 1.5;">
                            <table
                                style="width: 100%; table-layout: fixed; border: none; background: transparent; font-size: 11px;">
                                <tr>
                                    <td style="border: none; padding: 2px 0; width: 50%;">• Tekanan Darah:
                                        {{ $cp->tekanan_darah }} mmHg</td>
                                    <td style="border: none; padding: 2px 0; width: 50%;">• Frekuensi Nadi:
                                        {{ $cp->frekuensi_nadi }} x/menit</td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 2px 0;">• Frekuensi Nafas:
                                        {{ $cp->frekuensi_nafas }} x/menit</td>
                                    <td style="border: none; padding: 2px 0;">• Suhu Tubuh: {{ $cp->suhu_tubuh }} °C
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"
                                        style="border: none; padding-top: 5px; margin-top: 5px; border-top: 1px dashed #ddd;">
                                        • BB / TB / IMT: {{ $cp->beratbadan }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; •
                                        Umur: {{ $cp->umur }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Pemeriksaan Fisik (O) -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Pemeriksaan Fisik ( O )</td>
                        <td style="padding: 5px; white-space: pre-line;">{{ $cp->pemeriksaan_fisik }}</td>
                    </tr>

                    <!-- Hasil Laboratorium -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Hasil Laboratorium</td>
                        <td style="padding: 5px; color: #777;">-</td>
                    </tr>

                    <!-- Hasil Radiologi -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Hasil Radiologi</td>
                        <td style="padding: 5px; color: #777;">-</td>
                    </tr>

                    <!-- Kondisional USG Kebidanan -->
                    @if ($cp->kode_unit == '1012')
                        <tr>
                            <td
                                style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                                Hasil USG Kebidanan</td>
                            <td style="padding: 5px;">
                                <strong>Hasil Expertisi :</strong><br>
                                {{ $cp->evaluasi }}
                            </td>
                        </tr>
                    @endif

                    <!-- Kondisional USG Urologi -->
                    @if ($cp->kode_unit == '1027')
                        <tr>
                            <td
                                style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                                Hasil USG Urologi</td>
                            <td style="padding: 5px;">
                                <strong>Hasil Expertisi :</strong><br>
                                {{ $cp->evaluasi }}
                            </td>
                        </tr>
                    @endif

                    <!-- Section Divider Diagnosis -->
                    <tr>
                        <td colspan="2" class="text-center"
                            style="padding: 6px; font-weight: bold; background-color: #e9ecef; letter-spacing: 0.5px;">
                            DIAGNOSIS ( A )
                        </td>
                    </tr>

                    <!-- Diagnosa Utama -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: middle;">
                            Diagnosa Utama</td>
                        <td style="padding: 0;">
                            <table style="width: 100%; table-layout: fixed; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding: 5px; width: 75%;">{{ $cp->diagnosakerja }}</td>
                                    <td
                                        style="border: none; border-left: 1px solid #dee2e6; padding: 5px; width: 25%; text-align: left; font-weight: bold; background-color: #fafafa; color: #555;">
                                        ICD X : </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Diagnosa Sekunder -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: middle;">
                            Diagnosa Sekunder</td>
                        <td style="padding: 0;">
                            <table style="width: 100%; table-layout: fixed; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding: 5px; width: 75%;">
                                        {{ $cp->diagnosabanding ?? '-' }}</td>
                                    <td
                                        style="border: none; border-left: 1px solid #dee2e6; padding: 5px; width: 25%; text-align: left; font-weight: bold; background-color: #fafafa; color: #555;">
                                        ICD X :</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Tindakan / Prosedur -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Tindakan / Prosedur</td>
                        <td style="padding: 0;">
                            <table style="width: 100%; table-layout: fixed; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding: 5px; width: 75%; line-height: 1.4;">
                                        {{ $cp->tindakanmedis }}
                                        @foreach ($tindakan as $t)
                                            @if ($t->kode_kunjungan == $cp->id_kunjungan)
                                                <div style="margin-top: 2px;">• {{ $t->NAMA_TARIF }}</div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td
                                        style="border: none; border-left: 1px solid #dee2e6; padding: 5px; width: 25%; text-align: left; font-weight: bold; vertical-align: middle; background-color: #fafafa; color: #555;">
                                        ICD 9 CM : </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Tindakan Operasi -->
                    <tr>
                        <td
                            style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: middle;">
                            Tindakan Operasi</td>
                        <td style="padding: 0;">
                            <table style="width: 100%; table-layout: fixed; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding: 5px; width: 75%; color: #777;">-</td>
                                    <td
                                        style="border: none; border-left: 1px solid #dee2e6; padding: 5px; width: 25%; text-align: left; font-weight: bold; background-color: #fafafa; color: #555;">
                                        ICD 9 CM :</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Rencana Terapi (P) -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Rencana Terapi ( P )</td>
                        <td style="padding: 5px; white-space: pre-line;">{{ $cp->rencanakerja }}</td>
                    </tr>

                    <!-- Tindak Lanjut -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Tindak Lanjut</td>
                        <td style="padding: 5px; line-height: 1.4;">
                            <strong>Status:</strong> {{ $cp->tindak_lanjut }}
                            @if (!empty($cp->keterangan_tindak_lanjut))
                                <br><span style="color: #444;"><strong>Ket:</strong>
                                    {{ $cp->keterangan_tindak_lanjut }}</span>
                            @endif
                        </td>
                    </tr>

                    <!-- Obat-obatan -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Obat-obatan</td>
                        <td style="padding: 5px; line-height: 1.5;">
                            @if (count($orderfarmasi) > 0)
                                @foreach ($orderfarmasi as $t)
                                    <div style="margin-bottom: 2px;">
                                        • <strong>{{ $t->kode_barang }}</strong> (Qty: {{ $t->jumlah_layanan }}),
                                        Aturan Pakai: <em>{{ $t->aturan_pakai }}</em>
                                    </div>
                                @endforeach
                            @else
                                <span style="color: #777;">-</span>
                            @endif
                        </td>
                    </tr>
                    <!-- Pemeriksaan Penunjang -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Pemeriksaan Penunjang<br><small style="font-weight: normal; color: #666;">(Lab, Rad,
                                dll)</small></td>
                        <td style="padding: 0;">
                            <table style="width: 100%; table-layout: fixed; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding: 5px; width: 75%; line-height: 1.4;">
                                        <strong>Order Pemeriksaan:</strong><br>
                                        @if (count($order_penunjang) > 0)
                                            @foreach ($order_penunjang as $d)
                                                • {{ $d->nama_unit }} ({{ $d->NAMA_TARIF }})<br>
                                            @endforeach
                                        @else
                                            <span style="color: #777;">Tidak ada order penunjang</span>
                                        @endif
                                    </td>
                                    <td
                                        style="border: none; border-left: 1px solid #dee2e6; padding: 5px; width: 25%; text-align: left; font-weight: bold; vertical-align: middle; background-color: #fafafa; color: #555;">
                                        ICD 9 CM :</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Jawaban Konsul -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Jawaban Konsul Poli Lain</td>
                        <td style="padding: 5px;">{{ $cp->keterangan_tindak_lanjut_2 ?? '-' }}</td>
                    </tr>

                    <!-- Hasil Pemeriksaan Khusus -->
                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Hasil Pemeriksaan Khusus</td>
                        <td style="padding: 5px; line-height: 1.4;">
                            {{ $cp->pemeriksaan_khusus }}
                            @if (!empty($cp->pemeriksaan_khusus_2))
                                <br>{{ $cp->pemeriksaan_khusus_2 }}
                            @endif
                        </td>
                    </tr>

                    <!-- Autentikasi TTE Dokter Pemeriksa -->
                    <tr>
                        <td
                            style="padding: 10px; vertical-align: bottom; background-color: #f8f9fa; border-right: none;">
                            <div style="font-size: 10px; color: #666; font-style: italic; line-height: 1.3;">

                            </div>
                        </td>
                        <td style="height:190px;padding: 10px; vertical-align: middle; border-left: none;">
                            <table
                                style="width: 200px; text-align: center; font-size: 11px; float: right; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding-bottom: 5px;">
                                        Waled, {{ $today }}<br>
                                        <strong>Dokter Pemeriksa,</strong><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 3px 0; text-align: center;">
                                        <div
                                            style="width: 80px; height: 60px; border: none; margin: 0 auto; background-color: #fff; overflow: hidden; position: relative;">
                                            #
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="border: none; padding-top: 2px; text-transform: uppercase; line-height: 1.3;">
                                        <u><strong>{{ $mt_paramedis[0]->nama_paramedis }}</strong></u><br>
                                        <span style="font-size: 9px; text-transform: none; color: #555;">NIP.
                                            {{ $mt_paramedis[0]->nip }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="text-xxxs font-italic">
                    <img class="mr-1 ml-1 mt-2" width="4%" src="{{ public_path('../public/img/logobsre.png') }}"
                        alt=""> *Dokumen ini telah ditanda tangani secara elektronik menggunakan sertifikat
                    elektronik
                    yang
                    telah diterbitkan oleh Balai Besar Sertifikasi ( BSrE ), Badan Siber dan Sandi Negara.(
                    cetakan..,ke-{{ $cetakanke }})
                </div>
            @else
                <table class="table table-sm table-bordered"
                    style="width: 100%; table-layout: fixed; background-color: #fff; word-wrap: break-word; font-size: 11px; border-collapse: collapse;">
                    <tr>
                        <td
                            style="width: 30%; max-width: 30%; padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Anamnesa</td>
                        <td style="width: 70%; max-width: 70%; padding: 5px; white-space: pre-line;">
                            {{ $cp->anamnesa }}
                            <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Pemeriksaan Fisik dan Uji Fungsi</td>
                        <td style="padding: 5px; white-space: pre-line;">{{ $cp->pemeriksaan_fisik }}</td>
                    </tr>

                    <tr>
                        <td
                            style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: middle;">
                            Diagnosis Medis (ICD 10)</td>
                        <td style="padding: 5px; font-weight: bold;">
                            {{ $cp->diagnosakerja }}
                            <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: middle;">
                            Diagnosis Fungsi (ICD 10)</td>
                        <td style="padding: 5px;">{{ $cp->diagnosabanding ?? '-' }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Pemeriksaan Penunjang</td>
                        <td style="padding: 5px; line-height: 1.5;">
                            <div style="margin-bottom: 5px;">{{ $cp->rencanakerja }}</div>

                            @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                <div
                                    style="background-color: #f1f3f5; padding: 4px; border-radius: 3px; margin-bottom: 5px;">
                                    <strong>Hasil Expertisi :</strong><br>
                                    {{ $cp->evaluasi }}
                                </div>
                            @endif

                            <strong>Order Pemeriksaan Penunjang :</strong><br>
                            @if (count($order_penunjang) > 0)
                                @foreach ($order_penunjang as $d)
                                    • {{ $d->nama_unit }} ({{ $d->NAMA_TARIF }})<br>
                                @endforeach
                            @else
                                <span style="color: #777;">-</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Tata laksana KFR</td>
                        <td style="padding: 5px; white-space: pre-line;">{{ $cp->tatalaksana_kfr }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Anjuran</td>
                        <td style="padding: 5px; white-space: pre-line;">{{ $cp->anjuran }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Evaluasi</td>
                        <td style="padding: 5px; white-space: pre-line;">{{ $cp->evaluasi }}</td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Suspek Penyakit Akibat Kerja</td>
                        <td style="padding: 5px; line-height: 1.4;">
                            <strong>Riwayat:</strong> {{ $cp->riwayatlain ?? '-' }}<br>
                            <strong>Keterangan:</strong> {{ $cp->ket_riwayatlain ?? '-' }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Tindak Lanjut</td>
                        <td style="padding: 5px; line-height: 1.4;">
                            @if ($cp->versidk != 2)
                                {{ $cp->tindak_lanjut }}
                            @else
                                @php $tinjut = explode('|', $cp->tindak_lanjut) @endphp
                                @if (isset($tinjut[0]) && $tinjut[0] == 1)
                                    • Kontrol<br>
                                @endif
                                @if (isset($tinjut[1]) && $tinjut[1] == 1)
                                    • Konsul<br>
                                @endif
                                @if (isset($tinjut[2]) && $tinjut[2] == 1)
                                    • Rujuk Internal<br>
                                @endif
                                @if (isset($tinjut[3]) && $tinjut[3] == 1)
                                    • Rujuk Keluar<br>
                                @endif
                                @if (isset($tinjut[4]) && $tinjut[4] == 1)
                                    • Rawat Inap<br>
                                @endif
                                @if (isset($tinjut[5]) && $tinjut[5] == 1)
                                    • Dipulangkan<br>
                                @endif
                            @endif
                            <div style="margin-top: 3px; color: #444;">
                                <strong>Keterangan:</strong> {{ $cp->keterangan_tindak_lanjut ?? '-' }}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Obat-obatan</td>
                        <td style="padding: 5px; line-height: 1.5;">
                            @if (count($orderfarmasi) > 0)
                                @foreach ($orderfarmasi as $t)
                                    <div>• <strong>{{ $t->kode_barang }}</strong> (Qty: {{ $t->jumlah_layanan }}),
                                        Aturan Pakai: {{ $t->aturan_pakai }}</div>
                                @endforeach
                            @else
                                <span style="color: #777;">-</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                            Jawaban Konsul Poli Lain</td>
                        <td style="padding: 5px;">{{ $cp->keterangan_tindak_lanjut_2 ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 10px; vertical-align: bottom; background-color: #f8f9fa; border-right: none;">
                            <div style="font-size: 10px; color: #666; font-style: italic; line-height: 1.3;">

                            </div>
                        </td>
                        <td style="height:190px;padding: 10px; vertical-align: middle; border-left: none;">
                            <table
                                style="width: 400px; text-align: center; font-size: 11px; float: right; border: none; background: transparent;">
                                <tr>
                                    <td style="border: none; padding-bottom: 5px;">
                                        Waled, {{ $today }}<br>
                                        <strong>Dokter Pemeriksa,</strong><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: none; padding: 3px 0; text-align: center;">
                                        <div
                                            style="width: 80px; height: 60px; border: none; margin: 0 auto; background-color: #fff; overflow: hidden; position: relative;">
                                            #
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="border: none; padding-top: 2px; text-transform: uppercase; line-height: 1.3;">
                                        <u><strong>{{ $mt_paramedis[0]->nama_paramedis }}</strong></u><br>
                                        <span style="font-size: 9px; text-transform: none; color: #555;">NIP.
                                            {{ $mt_paramedis[0]->nip }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="text-xxxs font-italic">
                    <img class="mr-1 ml-1 mt-2" width="4%" src="{{ public_path('../public/img/logobsre.png') }}"
                        alt=""> *Dokumen ini telah ditanda tangani secara elektronik menggunakan sertifikat
                    elektronik
                    yang
                    telah diterbitkan oleh Balai Besar Sertifikasi ( BSrE ), Badan Siber dan Sandi Negara.(
                    cetakan..,ke-{{ $cetakanke }})
                </div>
            @endif
        @endforeach
    </div>
    <footer>
        {{-- <div class="text-xxxs font-italic" id="footer">
            <img class="mr-1 ml-1 mt-2" width="4%" src="{{ public_path('../public/img/logobsre.png') }}"
                alt=""> *Dokumen ini telah ditanda tangani secara elektronik menggunakan sertifikat elektronik
            yang
            telah diterbitkan oleh Balai Besar Sertifikasi ( BSrE ), Badan Siber dan Sandi Negara.(
            cetakan..,ke-{{ $cetakanke }})
        </div> --}}
    </footer>
    <script type="text/php">
        if ( isset($pdf) ) {
            // OLD
            // $font = Font_Metrics::get_font("helvetica", "bold");
            // $pdf->page_text(72, 18, "halaman ke {PAGE_NUM} dari {PAGE_COUNT}", $font, 6, array(255,0,0));
            // v.0.7.0 and greater
            $x = 72;
            $y = 763;
            $text = "halaman ke {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
