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
            margin: 0px;
            margin-top: 0px;
            margin-bottom: 10px;
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

        hr {
            border: none;
            height: 1px;
            color: #333;
            background-color: #333;
        }
    </style>
</head>

<body>
    <div class="scaled-content">
        <table style="font-size: 12px; margin-top:0px; width:100%;" class="table-sm">
            <tr>
                <td colspan="2" style="padding-left:50px;">
                    <table>
                        <td>
                            <img src="{{ public_path('img/logobpjs.png') }}" style="height:100px; padding-right:0px;">
                        </td>
                        <td><span style="font-size: 15px; padding-left:10px; padding-bottom:0px;font-weight:bold">SURAT
                                ELEGIBILITAS PESERTA
                                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RSUD WALED KAB CIREBON</span></td>
                        <td>
                            <img src="{{ public_path('img/logo_rs.png') }}"
                                style="height:70px; padding-right:0px; margin-top:10px;margin-left:160px">
                        </td>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-left:50px; width:60%;">
                    <table cellspacing="0" cellpadding="5" style="width:100%">
                        <tr style="font-weight: bold;font-size: 18px">
                            <td width="120px">No. SEP</td>
                            <td>: {{ strtoupper($sep->response->noSep)}}</td>
                            <td></td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Tgl. SEP</td>
                            <td>: {{ strtoupper($sep->response->tglSep)}}</td>
                            <td>

                            </td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>No. Kartu</td>
                            <td>: {{ strtoupper($sep->response->peserta->noKartu)}}</td>
                            <td></td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Nama Peserta</td>
                            <td>: {{ strtoupper($sep->response->peserta->nama)}}</td>
                            <td></td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Tgl. Lahir</td>
                            <td>: {{ strtoupper($sep->response->peserta->tglLahir)}}</td>
                            <td style="font-size:13px">
                                jns kelamin : {{ $sep->response->peserta->kelamin }}</td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>No. Telepon</td>
                            <td>:{{ $peserta->response->peserta->mr->noTelepon}}</td>
                            <td></td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Dokter</td>
                            <td colspan="2">: {{ strtoupper($sep->response->dpjp->nmDPJP)}}</td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Poli Tujuan</td>
                            <td>: {{ strtoupper($sep->response->poli)}}</td>
                            <td></td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Faskes Perujuk</td>
                            <td>: </td>
                            <td></td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Diagnosa Awal</td>
                            <td colspan="2">: {{ strtoupper($sep->response->diagnosa)}}</td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>: {{$sep->response->catatan}}</td>
                        </tr>
                    </table>
                </td>
                <td style="width:40%;">
                    <table cellspacing="0" cellpadding="5" style="width:60%">
                        <tr style="font-size:13px">
                            <td>Nomor RM</td>
                            <td colspan="2">: {{ strtoupper($sep->response->peserta->noMr)}}</td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Peserta</td>
                            <td colspan="2">: {{ strtoupper($sep->response->peserta->jnsPeserta)}}</td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Jns. Rawat</td>
                            <td colspan="2">:{{ strtoupper($sep->response->jnsPelayanan)}}</td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Kls. Rawat</td>
                            <td colspan="2">: {{ strtoupper($sep->response->kelasRawat)}}</td>
                        </tr>
                        <tr style="font-size:13px">
                            <td>Penjamin</td>
                            <td colspan="2">: {{ strtoupper($sep->response->penjamin)}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-left:50px; width:60%;">
                    <table style="font-size: 7px; ">
                        <tr>
                            <td colspan="2">*Saya menyetujui BPJS Kesehatan untuk :</td>
                        </tr>
                        <tr>
                            <td style="width:4px;">a. </td>
                            <td>membuka dan atau menggunakan informasi medis Pasien untuk keperluan administrasi,
                                pembayaran
                                asuransi atau jaminan pembiayaan kesehatan</td>
                        </tr>
                        <tr>
                            <td>b. </td>
                            <td>memberikan akses informasi medis atau riwayat pelayanan kepada dokter/tenaga medis pada
                                RSUD
                                WALED untuk kepentingan pemeliharaan kesehatan, pengobatan, penyembuhan, dan perawatan
                                pasien.</td>
                        </tr>
                        <tr>
                            <td colspan="2">*Saya mengetahui dan memahami :</td>
                        </tr>
                        <tr>
                            <td>a. </td>
                            <td>Rumah Sakit dapat melakukan koordinasi dengan PT Jasa Raharja / PT Taspen / PT ASABRI /
                                BPJS
                                Ketenagakerjaan atau Penjamin lainnya, jika Peserta merupakan pasien yang mengalami
                                kecelakaan lalulintas dan / atau kecelakaan kerja.</td>
                        </tr>
                        <tr>
                            <td>b. </td>
                            <td>SEP bukan sebagai bukti penjamin peserta.</td>
                        </tr>
                    </table>
                </td>
                <td style="width:40%;">
                    <table style="font-size: 12px; width:60%">
                        <tr>
                            <td colspan="2" style="text-align: center; ">Persetujuan <br>Pasien/Keluarga Pasien <br>
                                <img
                                src="data:image/png;base64, {{ base64_encode(QrCode::generate($sep->response->peserta->noKartu)) }} ">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: center; padding-top:10px; font-size: 8px;">Waktu:{{$now}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }


    </style>
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
