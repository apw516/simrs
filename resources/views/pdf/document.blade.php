<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style>
        /* Add your CSS styles here for PDF formatting */
        body {
            font-family: sans-serif;
        }
    </style>
    <style>
        .kop-surat {
            width: 100%;
            padding: 10px;
            border-bottom: 2px solid #000;
            text-align: center;
        }

        .logo {
            width: 100px;
            height: auto;
            float: left;
        }

        .instansi {
            font-size: 16px;
            font-weight: bold;
            margin-left: 120px;
            /* Sesuaikan dengan lebar logo */
        }
        .instansi2 {
            font-size: 20px;
            font-weight: bold;
            margin-left: 120px;
            /* Sesuaikan dengan lebar logo */
        }
        .instansi3 {
            font-size: 12px;
            font-weight: bold;
            margin-left: 120px;
            /* Sesuaikan dengan lebar logo */
        }

        .alamat {
            font-size: 12px;
            margin-left: 120px;
        }
    </style>
</head>

<body>
    {{-- <h1>{{ $title }}</h1>
    <p>{{ $content }}</p> --}}
    <div class="kop-surat">
        <img src="{{ asset('public/img/logouser.png')}}" class="logo">
        <div class="instansi">
            PEMERINTAH KABUPATEN CIREBON
        </div>
        <div class="instansi2">
            RUMAH SAKIT UMUM DAERAH WALED
        </div>
        <div class="instansi3">
           Jl. Prabu Kian Santang No. 4 Waled Telp.(0231)661126 Email: brsud.waled@gmail.com
        </div>
    </div>

    <div class="isi-surat">
        <p>Ini adalah contoh isi surat.</p>
    </div>
</body>

</html>
