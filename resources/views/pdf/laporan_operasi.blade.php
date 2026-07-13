<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasi</title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}">

    <style>
        @page {
            margin: 30px;
            margin-top: 40px;
            margin-bottom: 60px;
        }

        body {
            font-family: sans-serif;
            font-size: 11px;
            color: #000;
            line-height: 1.3;
        }

        #footer {
            position: fixed;
            bottom: -20px;
            width: 100%;
            font-size: 6pt;
            color: #1d1c1c;
        }

        /* Reset style table agar konsisten */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 8px;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 5px;
            vertical-align: top;
        }

        /* Khusus untuk tabel tanpa border luar jika diperlukan */
        .table-no-border,
        .table-no-border tr,
        .table-no-border td {
            border: none !important;
            padding: 2px;
        }

        .kop-table td {
            padding: 8px;
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

        /* Layout kolom tanda tangan */
        .table-ttd {
            margin-top: 20px;
            border: none !important;
        }

        .table-ttd td {
            border: none !important;
            text-align: center;
            width: 50%;
        }

        .space-ttd {
            height: 75px;
            /* Memberikan ruang untuk tanda tangan */
        }
    </style>
</head>

<body>

    <div class="isi-surat">
        <!-- Dokumen Kode Kanan Atas -->
        <div class="text-right text-bold" style="font-size: 10px; margin-bottom: 5px; padding-right: 5px;">
            RM.08.01-IBS/Rev.02/19
        </div>

        <!-- Bagian Header / Kop Surat Berbentuk Tabel Agar Pas -->
        <table class="kop-table">
            <tbody>
                <tr>
                    <td class="logo-container">
                        <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo">
                    </td>
                    <td class="text-center" style="width: 50%; vertical-align: middle;">
                        <span class="text-bold" style="font-size: 12px;">PEMERINTAH KABUPATEN CIREBON</span><br>
                        <span class="text-bold" style="font-size: 13px;">RUMAH SAKIT UMUM DAERAH WALED</span><br>
                        <span style="font-size: 10px;">Jl. Prabu Kian Santang No. 4<br>Telp.(0231)661126 Email:
                            brsud.waled@gmail.com</span>
                    </td>
                    <td style="width: 38%; padding: 0px;">
                        <!-- Tabel Identitas Pasien di Dalam Kop -->
                        <table class="table-no-border" style="width: 100%; margin: 4px; font-size: 10px;">
                            <tr>
                                <td width="35%" class="text-bold">Nomor RM</td>
                                <td width="5%">:</td>
                                <td class="text-bold">{{ $mt_pasien[0]->no_rm }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Nama</td>
                                <td>:</td>
                                <td>{{ $mt_pasien[0]->nama_px }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ $mt_pasien[0]->tgl_lahirs }}</td>
                            </tr>
                            <tr>
                                <td class="text-bold">JK</td>
                                <td>:</td>
                                <td>
                                    @if (strtoupper($mt_pasien[0]->jenis_kelamin) == 'L')
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
                    <td style="text-align: center;" colspan="2" class="text-bold">LAPORAN OPERASI</td>
                    <td style="font-style: italic; font-size: 9px; text-align: center; vertical-align: middle;">
                        (Label Pasien / Affix Patient Identification Label)
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Ruang Operasi : @foreach ($data as $d)
                            {{ $d->ruangoperasi }}
                        @endforeach
                    </td>
                    <td>Kamar : @foreach ($data as $d)
                            {{ $d->kamaroperasi }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Cito / Terencana : @foreach ($data as $d)
                            {{ $d->citoterencana }}
                        @endforeach
                    </td>
                    <td>Tanggal Operasi : @foreach ($data as $d)
                            {{ \Carbon\Carbon::parse($d->tanggaloperasi)->format('d-M-Y') }}
                            @endforeach / Jam : @foreach ($data as $d)
                                {{ $d->jamoperasi }}
                            @endforeach
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left; width: 35%;">
                        Pembedah : @foreach ($data as $d)
                            {{ $d->pembedah }}
                        @endforeach
                        <br>
                        <br>
                        Ahli Anestesi : @foreach ($data as $d)
                            {{ $d->ahlianestesi }}
                        @endforeach
                    </td>
                    <td style="text-align: left; width: 35%;">
                        Asisten I : @foreach ($data as $d)
                            {{ $d->asisten1 }}
                        @endforeach
                        <br>
                        <br>
                        Asisten II : @foreach ($data as $d)
                            {{ $d->asisten2 }}
                        @endforeach
                    </td>
                    <td style="text-align: left; width: 30%;">
                        Perawat Instrumen : @foreach ($data as $d)
                            {{ $d->perawatinstrumen }}
                        @endforeach
                        <br>
                        <br>
                        Jenis Anestesi : @foreach ($data as $d)
                            {{ $d->jenisanestesi }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Diagnosa Pra-bedah : @foreach ($data as $d)
                            {{ $d->diagnosaprabedah }}
                        @endforeach
                    </td>
                    <td>Indikasi Operasi : @foreach ($data as $d)
                            {{ $d->indikasioperasi }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Diagnosa Pasca-bedah : @foreach ($data as $d)
                            {{ $d->diagnosapascabedah }}
                        @endforeach
                    </td>
                    <td>Jenis Operasi : @foreach ($data as $d)
                            {{ $d->jenisoperasi }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="2">Desinfeksi Kulit dengan : @foreach ($data as $d)
                            {{ $d->desinfeksikulitdengan }}
                        @endforeach
                    </td>
                    <td>
                        Jaringan yang dieksisi : @foreach ($data as $d)
                            {{ $d->jaringanyangdieksisi }}
                        @endforeach
                        <br>
                        Dikirim ke bagian patologi anatomi :
                        <input type="checkbox"
                            @foreach ($data as $d) @if ($d->kirimkepatologi == 1) checked @endif @endforeach> Ya
                        <input type="checkbox"
                            @foreach ($data as $d) @if ($d->kirimkepatologi == 0) checked @endif @endforeach> Tidak
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Detail Operasi -->
        <table>
            <tbody>
                <tr>
                    <td style="width: 25%;">Jam operasi dimulai :<br>
                        @foreach ($data as $d)
                            {{ $d->jammulaioperasi }}
                        @endforeach
                    </td>
                    <td style="width: 25%;">Jam operasi selesai :<br>
                        @foreach ($data as $d)
                            {{ $d->jamoperasiselesai }}
                        @endforeach
                    </td>
                    <td style="width: 25%;">Lama operasi :<br>
                        @foreach ($data as $d)
                            {{ $d->lamaoperasiberlangsung }}
                        @endforeach
                    </td>
                    <td style="width: 25%;">Jenis bahan dikirim : @foreach ($data as $d)
                            {{ $d->jenisbahanyangdikirim }}
                        @endforeach
                        <br>
                        Untuk pemeriksaan : @foreach ($data as $d)
                            {{ $d->untukpemeriksaan }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="height: 60px;">Macam Sayatan (Bila perlu dengan gambar) :<br>
                        @foreach ($data as $d)
                            {{ $d->macamsayatan }}
                        @endforeach
                    </td>
                    <td colspan="2" style="height: 60px;">Posisi Penderita (Bila perlu dengan gambar) :<br>
                        @foreach ($data as $d)
                            {{ $d->posisipenderita }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="min-height: 150px;">
                        <span class="text-bold">Teknik Operasi dan Temuan Intra Operasi</span><br><br>
                        @if ($kode_unit == '1014')
                            <div style="margin-left: 20px;">
                                1. Pasien tidur terlentang di meja operasi<br>
                                2. Dilakukan tindakan aseptik dan antiseptik dengan betadine<br>
                                <div style="margin-left: 15px; margin-top: 2px; margin-bottom: 2px;">
                                    <input
                                        @foreach ($data as $c) @if ($c->pertanyaan2 == 'Mata Kanan') checked @endif @endforeach
                                        type="radio"> Mata Kanan &nbsp;&nbsp;
                                    <input
                                        @foreach ($data as $c) @if ($c->pertanyaan2 == 'Mata Kiri') checked @endif @endforeach
                                        type="radio"> Mata Kiri
                                </div>
                                3. Pasang Doek bolong<br>
                                4. Anestesi dengan lidokain topikal<br>
                                5. Pasang Klem<br>
                                6. Lakukan insisi dengan pisau<br>
                                7. Bersihkan hordeolum / kalazion dengan kuret<br>
                                8. Lepaskan klem<br>
                                9. Berikan Salep Antibiotik<br>
                                10. Operasi Selesai
                            </div>
                        @else
                            @foreach ($data as $d)
                                {{ $d->teknikoperasi }}
                            @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        Penggunaan BHP khusus :
                        <input type="checkbox"
                            @foreach ($data as $c) @if ($c->penggunaanBHP == '1') checked @endif @endforeach> Ya
                        &nbsp;
                        <input type="checkbox"
                            @foreach ($data as $c) @if ($c->penggunaanBHP == '0') checked @endif @endforeach> Tidak
                        <br>
                        Jenis dan Jumlah (BHP Khusus) : @foreach ($data as $d)
                            {{ $d->jenisjumlahBHP }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Komplikasi Intra-Operasi : <br>
                        <input type="checkbox"
                            @foreach ($data as $c) @if ($c->komplikasiintraoprasi == '1') checked @endif @endforeach> Ya
                        &nbsp;
                        <input type="checkbox"
                            @foreach ($data as $c) @if ($c->komplikasiintraoprasi == '0') checked @endif @endforeach> Tidak
                    </td>
                    <td colspan="2" rowspan="2">Penjabaran Komplikasi Intra-Operasi :<br>
                        @foreach ($data as $d)
                            {{ $d->penjabarankomplikasi }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Perdarahan : @foreach ($data as $d)
                            {{ $d->perdarahan }}
                        @endforeach CC</td>
                </tr>
                <tr>
                    <td colspan="2">1. Kontrol nadi / tensi / pernafasan / suhu :<br>
                        @foreach ($data as $d)
                            {{ $d->kontrolnaditensi }}
                        @endforeach
                    </td>
                    <td colspan="2">5. Obat-obatan :<br>
                        @foreach ($data as $d)
                            {{ $d->obatobatan }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">2. Puasa :<br>
                        @foreach ($data as $d)
                            {{ $d->puasa }}
                        @endforeach
                    </td>
                    <td colspan="2">6. Ganti balut :<br>
                        @foreach ($data as $d)
                            {{ $d->gantibalut }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">3. Drain :<br>
                        @foreach ($data as $d)
                            {{ $d->drain }}
                        @endforeach
                    </td>
                    <td colspan="2" rowspan="2">7. Lain - Lain :<br>
                        @foreach ($data as $d)
                            {{ $d->lainlain }}
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td colspan="2">4. Infus :<br>
                        @foreach ($data as $d)
                            {{ $d->infus }}
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Bagian Tempat, Tanggal dan Kolom Tanda Tangan -->
        <div class="text-right font-italic text-bold" style="margin-top: 15px; padding-right: 40px; font-size: 11px;">
            Waled, @foreach ($data as $d)
                {{ \Carbon\Carbon::parse($d->tgl_entry)->format('d-M-Y') }}
            @endforeach
        </div>
        <table class="table-ttd">
            <tbody>
                <tr>
                    <td>Pembuat Laporan</td>
                    <td>Pembedah</td>
                </tr>
                <tr>
                    <td class="space-ttd"></td>
                    <td class="space-ttd"></td>
                </tr>
                <tr>
                    <td class="text-bold" style="text-decoration: underline;">
                        @if ($username != '')
                            {{ $username }}
                        @else
                            ........................................
                        @endif
                    </td>
                    <td class="text-bold" style="text-decoration: underline;">
                        @if ($username != '')
                            {{ $username }}
                        @else
                            ........................................
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="font-size: 10px;font-weight:bold; color: #000000;">NIP : {{ $nip }}</td>
                    <td style="font-size: 10px;font-weight:bold; color: #000000;">NIP : {{ $nip }}</td>
                </tr>
            </tbody>
        </table>
        <footer>
            <div id="footer"></div>
        </footer>
    </div>
    <!-- Script DomPDF Page Numbering -->
    <script type="text/php">
        if ( isset($pdf) ) {
            $x = 40;
            $y = 800;
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
