<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
    <link rel="stylesheet" href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}" rel="stylesheet">
    <style>
        @page {
            margin: 30px;
            margin-top: 50px;
            margin-bottom: 150px;
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

        table,
        th,
        td {
            border: 1px solid;
            padding: 1;
        }

    </style>
    <style>
        .container {
            display: grid;
            grid-template-columns: auto auto auto;
            background-color: rgb(0, 0, 0);
            padding: 1;
            margin-top: 22px;
        }
        .table table,
        .table th,
        .table td {
            padding: 10px 15px;
            border: 1px solid #000000;
            /* Light gray border for cells */
            text-align: left;
            background-color: none;
        }

        .container div {
            background-color: #ffffff;
            padding: 10px;
            font-size: 14px;
            text-align: center;
        }

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

        .text-xs {
            font-size: 14px;
        }

        .text-xxxs {
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="isi-surat">
        <p class="float-right text-bold" style="margin-right:50px">RM.08.01-IBS/Rev.02/19</p>
        <div class="container">
            <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo" style="display: grid;
            grid-template-columns: auto auto auto;margin-top:35px;margin-left:20px;width: 10%">
            <div class="isi-surat">
                <table class="mt-2 " style="border: 1px solid;width:100%">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="2">
                                <div class="" style="text-align: center;">
                                    <p class="text-bold">PEMERINTAH KABUPATEN CIREBON<br>
                                        RUMAH SAKIT UMUM DAERAH WALED<br>Jl. Prabu Kian Santang No. 4<br>Telp.(0231)661126 Email: brsud.waled@gmail.com</p>
                                </div>
                            </td>
                            <td rowspan="1">
                                <table style="width:100%" class="text-bold">
                                    <tr>
                                        <td width="40%">Nomor RM</td>
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
                            <td style="text-align: center;height: 1px;" colspan="2" class="text-bold">LAPORAN OPERASI</td>
                            <td style="font-style: italic;font-size:8px;margin-top:14px" class="text-bold">(Label Pasien / Affix Patient Identification Label)</label></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px" colspan="2">Ruang Operasi : @foreach ($data as $d) {{ $d->ruangoperasi}} @endforeach</td>
                            <td>Kamar : @foreach ($data as $d) {{ $d->kamaroperasi}} @endforeach</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px" colspan="2">Cito /Terencana : @foreach ($data as $d) {{ $d->citoterencana}} @endforeach</td>
                            <td>Tanggal Operasi : @foreach ($data as $d) @DateIndo($d->tanggaloperasi) @endforeach / Jam : @foreach ($data as $d) {{ $d->jamoperasi}} @endforeach</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px">Pembedah : @foreach ($data as $d) {{ $d->pembedah}} @endforeach<br><br>
                                Ahli Anestesi : @foreach ($data as $d) {{ $d->ahlianestesi}} @endforeach
                            </td>
                            <td>Asisten I : @foreach ($data as $d) {{ $d->asisten1}} @endforeach<br><br>
                                Asisten II : @foreach ($data as $d) {{ $d->asisten2}} @endforeach
                            </td>
                            <td>Perawat Instrumen : @foreach ($data as $d) {{ $d->perawatinstrumen}} @endforeach<br><br>
                                Jenis Anestesi : @foreach ($data as $d) {{ $d->jenisanestesi}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px" colspan="2">Diagnosa Pra-bedah : @foreach ($data as $d) {{ $d->diagnosaprabedah}} @endforeach</td>
                            <td>Indikasi Operasi : @foreach ($data as $d) {{ $d->indikasioperasi}} @endforeach</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px" colspan="2">Diagnosa Pasca-bedah : @foreach ($data as $d) {{ $d->diagnosapascabedah}} @endforeach</td>
                            <td>Jenis Operasi : @foreach ($data as $d) {{ $d->jenisoperasi}} @endforeach</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px;vertical-align: top;" colspan="2">Desinfeksi Kulit dengan : @foreach ($data as $d) {{ $d->desinfeksikulitdengan}} @endforeach</td>
                            <td>Jaringan yang dieksisi : @foreach ($data as $d) {{ $d->jaringanyangdieksisi}} @endforeach<br>
                                Dikirim kebagian patologin anatomi : <input style="margin-top:21px" type="checkbox" id="ya" name="patologi" @foreach ($data as $d) @if($d->kirimkepatologi == 1) checked @endif @endforeach> Ya
                                <input style="margin-top:21px" type="checkbox" id="tidak" name="patologi" @foreach ($data as $d) @if($d->kirimkepatologi == 0) checked @endif @endforeach>Tidak
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" class="table-sm mt-2">
                    <tbody>
                        <tr>
                            <td style="text-align: left;height: 1px;vertical-align: top;" width="20%">Jam operasi dimulai : @foreach ($data as $d) {{ $d->jammulaioperasi}} @endforeach</td>
                            <td style="text-align: left;height: 1px;vertical-align: top;" width="20%">Jam operai selesai : @foreach ($data as $d) {{ $d->jamoperasiselesai}} @endforeach </td>
                            <td style="text-align: left;height: 1px;vertical-align: top;" width="20%">Lama operasi berlangsung : @foreach ($data as $d) {{ $d->lamaoperasiberlangsung}} @endforeach </td>
                            <td style="text-align: left;height: 1px;vertical-align: top;" width="20%">Jenis bahan : @foreach ($data as $d) {{ $d->jenisbahanyangdikirim}} @endforeach<br>
                                Yang dikirimkan ke laboratorium untuk pemeriksaan : @foreach ($data as $d) {{ $d->untukpemeriksaan}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 121px;vertical-align: top;" width="20%" colspan="2">Macam Sayatan (Bila perlu dengan gambar ) : <br>
                                @foreach ($data as $d) {{ $d->macamsayatan}} @endforeach</td>
                            <td style="text-align: left;height: 1px;vertical-align: top;" width="20%" colspan="2">Posisi Penderita ( Bila perlu dengan gambar) : <br>
                                @foreach ($data as $d) {{ $d->posisipenderita}} @endforeach</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 200px" width="20%" colspan="4">
                                Teknik Operasi dan Temuan Intra Operasi<br><br>
                                <p style="font-style:normal;margin-left:120px" class="text-reguler">
                                    <label for="exampleInputEmail1">1. Pasien tidur terlentang di meja operasi</label><br>
                                    <label for="exampleInputEmail1">2. Dilakukan tindakan aseptik dan antiseptik dengan betadine </label><br>
                                    <div  style="font-style:normal;margin-left:120px"class="form-check form-check-inline">
                                        <input @foreach ($data as $c )@if($c->pertanyaan2 == 'Mata Kanan') checked @endif @endforeach class="form-check-input" type="radio" name="pertanyaan2" id="pertanyaan2" value="Mata Kanan">
                                        <label class="form-check-label" for="inlineRadio1">Mata Kanan</label>
                                    </div style="font-style:normal;margin-left:120px">
                                    <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                                        <input @foreach ($data as $c )@if($c->pertanyaan2 == 'Mata Kiri') checked @endif @endforeach class="form-check-input" type="radio" name="pertanyaan2" id="pertanyaan2" value="Mata Kiri">
                                        <label class="form-check-label" for="inlineRadio2">Mata Kiri</label>
                                    </div><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">3. Pasang Doek bolong </label><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">4. Anestesi dengan lidokain topikal</label><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">5. Pasang Klem </label><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">6. Lakukan insisi dengan pisau </label><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">7. Bersihkan hordeolum / kalazion dengan kuret</label><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">8. Lepaskan klem </label><br>
                                    <label style="font-style:normal;margin-left:120px" for="exampleInputEmail1">9. Berikan Salep Antibiotik </label><br>
                                    <label style="font-style:normal;margin-left:118px" for="exampleInputEmail1">10. Operasi Selesai </label><br>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 200px;vertical-align: top;" width="20%" colspan="4">
                                Penggunaan BHP khusus : <input style="margin-top:21px" type="checkbox" id="ya" name="patologi" @foreach ($data as $c )@if($c->penggunaanBHP == '1') checked @endif @endforeach > Ya
                                <input style="margin-top:21px" type="checkbox" id="tidak" name="patologi" @foreach ($data as $c )@if($c->penggunaanBHP == '0') checked @endif @endforeach >Tidak <br><br>
                                Jenis dan Jumlah (BHP Khusus) : @foreach ($data as $d) {{ $d->jenisjumlahBHP}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 121px" width="20%" colspan="2">Komplikasi Intra-Operasi : <br>
                                <input style="margin-top:21px" type="checkbox" id="ya" name="patologi" @foreach ($data as $c )@if($c->komplikasiintraoprasi == '1') checked @endif @endforeach > Ya
                                <input style="margin-top:21px" type="checkbox" id="tidak" name="patologi" @foreach ($data as $c )@if($c->komplikasiintraoprasi == '0') checked @endif @endforeach >Tidak
                            </td>
                            <td style="text-align: left;height: 1px;vertical-align: top;" width="20%" colspan="2" rowspan="2">Penjabaran Komplikasi Intra-Operasi : @foreach ($data as $d) {{ $d->penjabarankomplikasi}} @endforeach</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 130px" width="20%" colspan="2">
                                Perdarahan : @foreach ($data as $d) {{ $d->perdarahan}} @endforeach CC
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;height: 50px" width="20%">
                                1. Kontrol nadi / tensi / pernafasan / suhu / ........... <br>
                                @foreach ($data as $d) {{ $d->kontrolnaditensi}} @endforeach
                            </td>
                            <td colspan="2" style="text-align: left;height: 1px" width="20%">
                                5. Obat obatan : ...........<br>
                                @foreach ($data as $d) {{ $d->obatobatan}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;height: 50px" width="20%">
                                2 Puasa : ...........<br>
                                @foreach ($data as $d) {{ $d->puasa}} @endforeach
                            </td>
                            <td colspan="2" style="text-align: left;height: 1px" width="20%">
                                6. Ganti balut : ...........<br>
                                @foreach ($data as $d) {{ $d->gantibalut}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;height: 50px" width="20%">
                                3. Drain : ...........<br>
                                @foreach ($data as $d) {{ $d->drain}} @endforeach
                            </td>
                            <td colspan="2" rowspan="2" style="text-align: left;height: 1px;vertical-align: top;" width="20%">
                                7. Lain - Lain : ...........<br>
                                @foreach ($data as $d) {{ $d->lainlain}} @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align: left;height: 50px" width="20%">
                                4. Infus : ...........<br>
                                @foreach ($data as $d) {{ $d->infus}} @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%" class=" table-sm mt-2  text-bold font-italic">
                    </tbody>
                    <tr>
                        <td colspan="2" style="text-align: right">
                            <p style="margin-right:135px">Waled @foreach ($data as $d) @DateIndo($d->tgl_entry) @endforeach
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">Pembuat Laporan </td>
                        <td style="text-align: center">Pembedah </td>
                    </tr>
                    <tr>
                        <td style="height: 130px;vertical-align: bottom;text-align:center">
                            @if($username != ''){{ $username }}@else  .........................  @endif
                           </td>
                        <td style="height: 130px;vertical-align: bottom;text-align:center">@if($username != ''){{ $username }}@else  .........................  @endif
</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"> Tanda Tangan dan Nama Jelas</td>
                        <td style="text-align: center">Tanda Tangan dan Nama Jelas </td>
                    </tr>
                    </tbody>
                </table>
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
        </div>
    </div>
    <script type="text/php">
        if ( isset($pdf) ) {
            // OLD
            $font = Font_Metrics::get_font("helvetica", "bold");
            $pdf->page_text(72, 18, "halaman ke {PAGE_NUM} dari {PAGE_COUNT}", $font, 6, array(255,0,0));
            v.0.7.0 and greater
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
