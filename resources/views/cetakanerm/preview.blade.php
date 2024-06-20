{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    {{-- <meta name="viewport" content= "width=device-width, user-scalable=no"> --}}

<title>
    cetakan
</title>
<link href='{{ asset('public/img/logo_rs.png') }}' rel='shortcut icon'>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> --}}
<!-- overlayScrollbars -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
<style>
    #my {
        zoom: 90%;
    }

    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
        opacity: 0.9;
    }

    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font: 14px arial;
    }

    .datepicker {
        z-index: 1600 !important;
        /* has to be larger than 1050 */
    }

    .modal {
        overflow: auto !important;
    }
</style>
<style>
    /* @page {
            margin: 10px 25px;
        } */
    @page {
        size: 21cm 29.7cm;
        margin: 1px, 1px;
    }

    main {
        height: 1090px;
        width: 100%;
        background-color: rgb(255, 255, 255);
    }

    header {
        /* position: ab; */
        top: 8px;
        height: 30;
        color: rgb(0, 0, 0);
        text-align: left;
        line-height: 35px;
    }

    footer {
        position: fixed;
        bottom: 8px;
        height: 50px;
        color: rgb(8, 8, 8);
        text-align: center;
        line-height: 35px;
    }

    table,
    th,
    td {
        border: 1.2px solid black;
    }
</style>
</head>

<body id="my"
    class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    @foreach ($kunjungan as $k)
        {{-- <header>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td width="200px" rowspan="2"><img width="80%" src="{{ asset('public/img/logo_rs.png') }}" alt="">
                    </td>
                    <td style="font-size:15px" class="text-bold"><p>RUMAH SAKIT UMUM DAERAH WALED</p>
                    <p>Jl. Prabu Kiansantang No.4, Waled Kota, Kec. Waled, Kabupaten Cirebon, Jawa Barat 45187</p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </header> --}}

        {{-- <footer>
        Footer
    </footer> --}}
        <main>
            <table class="table table-sm">
                <tbody>
                    <tr>
                        {{-- <td width="200px" rowspan="2">
                        </td> --}}
                        <td rowspan="1" style="font-size:12px" class="text-bold text-center" width="30%"><img
                                width="20%" src="{{ asset('public/img/logo_rs.png') }}" alt="">
                            <p>Jl. Prabu Kiansantang No.4, Waled Kota, Kec. Waled, Kabupaten Cirebon, Jawa Barat 45187
                            </p>
                        </td>
                        <td style="font-size:10px">
                           <table class="table">
                            <tbody>
                                <tr>
                                    <td>Nomor RM</td>
                                    <td>Nama</td>
                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td>Nama</td>
                                </tr>
                                <tr>
                                    <td>Tempat/ tgl lahir</td>
                                    <td>Nama</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>Nama</td>
                                </tr>
                            </tbody>
                           </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-sm text-bold" style="font-size:12px; font-family:calibri">
                <tbody>
                    <tr class="bg-secondary">
                        <td colspan="4">Assesment Keperawatan Jalan</td>
                    </tr>
                    <tr>
                        <td width="150px">Sumber Data</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Keluhan utama</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Riwayat Penyakit Dahulu</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Riwayat Alergi</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Fisik</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Primer</td>
                        <td width="180px"></td>
                        <td width="150px" class="text-right">Diagnosa Sekunder</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Rencana Terapi</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Tindak Lanjut</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Riwayat Pemakaian Obat</td>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-sm text-bold" style="font-size:12px; font-family:calibri">
                <tbody>
                    <tr class="bg-secondary">
                        <td colspan="4">Assesment Medis Rawat Jalan</td>
                    </tr>
                    <tr>
                        <td width="150px">Sumber Data</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Keluhan utama</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Riwayat Penyakit Dahulu</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Riwayat Alergi</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Fisik</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Primer</td>
                        <td width="180px"></td>
                        <td width="150px" class="text-right">Diagnosa Sekunder</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Rencana Terapi</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Tindak Lanjut</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Riwayat Pemakaian Obat</td>
                        <td colspan="3"></td>
                    </tr>
                </tbody>
            </table>
        </main>
    @endforeach
</body>

</html>
