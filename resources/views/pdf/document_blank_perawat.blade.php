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
        <table class="mb-4" style="width: 100%">
            <tr>
                <td>
                    <p class="float-right text-bold">RM. 07.02-RJ/25</p>
                </td>
            </tr>
        </table>
        <table class="table table-sm mt-2 table-bordered text-xs text-bold font-italic">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo">
                    <div class="instansi2">
                        PEMERINTAH KABUPATEN CIREBON
                    </div>
                    <div class="instansi2">
                        RUMAH SAKIT UMUM DAERAH WALED
                    </div>
                    <div class="instansi3">
                        Jl. Prabu Kian Santang No. 4 Waled <br> Telp.(0231)661126 Email: brsud.waled@gmail.com
                    </div>
                </td>
                <td>
                    <table style="width:100%">
                        <tr>
                            <td>Nomor RM</td>
                            <td>{{ $mt_pasien[0]->no_rm }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $mt_pasien[0]->nama_px }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>{{ $mt_pasien[0]->tgl_lahirs }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
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
                <td colspan="2" class="text-center text-bold bg-success">
                    RESUME KEPERAWATAN RAWAT JALAN
                </td>
            </tr>
            <tr>
                <td>
                    POLIKLINIK : {{ strtoupper($ts_kunjungan[0]->nama_unit) }}
                </td>
                <td>
                    Tanggal Periksa : {{ $tglperiksa }}
                    {{-- $registeredAt = $user->created_at->isoFormat('dddd, D MMMM Y'); --}}
                </td>
            </tr>
        </table>
        @foreach ($assesmen as $cp)
            @if ($cp->kode_unit != '1028')
                <table class="table table-sm table-bordered text-xxxs font-italic text-bold">
                    <tr>
                        <td width="30%">Sumber Data</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Keluhan Utama</td>
                        <td  colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td  colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Tekanan Darah</td>
                        <td></td>
                        <td width="15%">Frekuensi Nadi</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>BB / TB / IMT</td>
                        <td  colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Frekuensi Nafas</td>
                        <td></td>
                        <td>Suhu</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Riwayat Psikologis</td>
                        <td></td>
                        <td>Keterangan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-center">Status Fungsional</td>
                    </tr>
                    <tr>
                        <td>Penggunaan Alat Bantu</td>
                        <td></td>
                        <td width="15%">Keterangan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Cacat Tubuh</td>
                        <td></td>
                        <td width="15%">Keterangan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-center">Assesmen Nyeri</td>
                    </tr>
                    <tr>
                        <td>Keluhan Nyeri</td>
                        <td></td>
                        <td width="15%">Keterangan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-center">Assesmen Resiko Jatuh</td>
                    </tr>
                    <tr>
                        <td>Resiko Jatuh</td>
                        <td></td>
                        <td width="15%">Keterangan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center">Skrinning Gizi</td>
                    </tr>
                    <tr>
                        <td>1. Apakah pasien mengalami penurunan berat badan yang tidak diinginkan dalam 6 bulan terakhir ? </td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>2. Apakah asupan makanan berkurang karena berkurangnya nafsu makan</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>3. Pasien dengan diagnosa khusus : Penyakit DM / Ginjal / Hati / Paru / Stroke / Kanker / Penurunan imunitas geriatri, lain lain...</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>4. Bila skor >= 2, pasien beresiko malnutrisi dilakukan pengkajian lanjut oleh ahli gizi</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Keperawatan</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Rencana Keperawatan/Kebidanan/Terapis</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Tindakan Keperawatan/Kebidanan/Terapis</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Evaluasi Keperawatan/Kebidanan/Terapis</td>
                        <td colspan="3"></td>
                    </tr>
                </table>
            @else
            @endif
        @endforeach
    </div>
    <footer>
        <div class="text-xxxs font-italic" id="footer">
            {{-- <img class="mr-1 ml-1 mt-2" width="8%" src="{{ public_path('../public/img/logobsre.png') }}"
                alt=""> *Dokumen ini telah ditanda tangani secara elektronik menggunakan sertifikat elektronik
            yang
            telah diterbitkan oleh Balai Besar Sertifikasi ( BSrE ), Badan Siber dan Sandi Negara.(
            cetakan..,ke-{{ $cetakanke }}) --}}
        </div>
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
