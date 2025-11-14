<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            margin: 0px;
            margin-top: 0px;
            margin-bottom: 10px;
            /* Adjust this value as needed */
        }

        @media print {
            .page-break-row {
                page-break-after: always;
                margin-top: 2cm;
            }

        }

        .container {
            /* Menambahkan clearfix untuk mengatasi collapsing parent element akibat float */
            /* overflow: hidden; */
        }

        .kolom-kiri {
            float: left;
            width: 18%;
            /* Sesuaikan lebar sesuai kebutuhan, beri ruang untuk margin */
            /* Margin antar kolom */
        }

        .kolom-tengah {
            float: center;
            width: 60%;
            margin-left: 22%;

            /* Sesuaikan lebar */
        }

        .kolom-kanan {
            float: right;
            width: 18%;
            /* Sesuaikan lebar */
        }

        /* Clear float setelah kolom jika diperlukan di bagian lain */
        /* .clearfix::after {
            content: "";
            clear: both;
            display: table;
        } */

    </style>
</head>
<body>
    <div class="container">
        <div class="kolom-kiri">
            <h3><img src="{{ public_path('../public/img/logokab.jpg') }}" style="width: 160%;margin-top:8px"></h3>
        </div>
        <div class="kolom-tengah" style="margin-top: 14px">
            <h3>
                <p class="text-bold" style="text-align: center;font-weight:bold;font-size:20px">PEMERINTAH KABUPATEN CIREBON
                    RUMAH SAKIT UMUM DAERAH WALED<a style="font-size: 12px"><br>Jl. Prabu Kian Santang No. 4 Telp.(0231) 661126 Email: brsud.waled@gmail.com <br>CIREBON</a></p>
            </h3>
        </div>
        <div class="kolom-kanan">
            <h3><img src="{{ public_path('../public/img/logo_rs.png') }}" style="width: 77%;margin-top:23px;margin-left:10px"></h3>
        </div>
    </div>
    <hr style="width:90%;text-align:left;margin-center0;margin-top:160px">
    <p clas="kolom-tengah" style="margin-left:290px;font-weight:bold">FORMULIR RUJUKAN INTERNAL</p>
    <p clas="kolom-tengah" style="float:right;margin-right:60px">NO : ................</p>
    <p style="margin-left:40px">Kepada Yth ....... <br> Poli {{ $cek[0]->namaunittujuan}}</p>
    <br>
    <br>
    <p>Berikut kami kirimkan pasien : </p>
    <p>Nama Pasien : </p>
    <p>Tanggal lahir / Umur : </p>
    <p>No RM : </p>
    <p>Keterangan klinis / diagnosis : </p>
    <p>Mohon untuk dapat dilakukan : </p>
     <input type="checkbox" @if($cek[0]->konsul1 == 1) checked @endif readonly>
                    <label class="form-check-label" for="exampleCheck1">Konsultasi / Konseling</label> ,
                    <input type="checkbox" @if($cek[0]->konsul2 == 1) checked @endif readonly>
                    <label class="form-check-label" for="exampleCheck1">Fisioterapi</label>,
                    <input type="checkbox" @if($cek[0]->konsul3 == 1) checked @endif readonly>
                    <label class="form-check-label" for="exampleCheck1">Rawat Luka</label> <br>
                    <input type="checkbox" @if($cek[0]->konsul3 == 1) checked @endif readonly>
                    <label class="form-check-label" for="exampleCheck1">Tindakan lain : .........................</label>
                    <p>Keterangan : </p>
</body>
</html>
