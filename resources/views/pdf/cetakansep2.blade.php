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
            margin: 10px;
            margin-top: -0px;
            margin-bottom: 0px;

            /* Adjust this value as needed */
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>

<body style="font-weight: bold">
    <div class="scaled-content">
        <table>
            <tr>
                <td><img src="{{ public_path('img/logobpjs.png') }}" style="height:100px; padding-right:0px;"></td>
                <td style=>SURAT ELIGIBILITAS PESERTA <br> RSUD WALED KABUPATEN.CIREBON</td>
                <td><img src="{{ public_path('img/logo_rs.png') }}"
                        style="height:40px; padding-right:0px; margin-top:0px;margin-left:40px"></td>
            </tr>
        </table>
        <table style="font-size:12px">
            <tr>
                <td width="110px">NO SEP</td>
                <td colspan="2">: {{ strtoupper($sep->response->noSep) }}</td>
            </tr>
            <tr>
                <td>Tgl SEP</td>
                <td colspan="2">: {{ strtoupper($sep->response->tglSep) }}</td>

            </tr>
            <tr>
                <td>No. Kartu</td>
                <td>: {{ strtoupper($sep->response->peserta->noKartu) }}</td>
                <td width="80px">Nomor RM</td>
                <td width="150px">: {{ strtoupper($sep->response->peserta->noMr) }}</td>
            </tr>
            <tr>
                <td>Nama Peserta</td>
                <td>: {{ strtoupper($sep->response->peserta->nama) }}</td>
                <td>Peserta</td>
                <td>: {{ strtoupper($sep->response->peserta->jnsPeserta) }}</td>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td>: {{ strtoupper($sep->response->peserta->tglLahir) }} / Jenis Kelamin :
                    {{ $sep->response->peserta->kelamin }}</td>
                <td>Jns Rawat</td>
                <td>: {{ strtoupper($sep->response->jnsPelayanan) }}</td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td>: {{ $peserta->response->peserta->mr->noTelepon }}</td>
                <td>Kelas Rawat</td>
                <td>: {{ strtoupper($sep->response->kelasRawat) }}</td>
            </tr>
            <tr>
                <td>Dokter</td>
                <td>: {{ strtoupper($sep->response->dpjp->nmDPJP) }}</td>
                <td>Penjamin</td>
                <td>: {{ strtoupper($sep->response->penjamin) }}</td>
            </tr>
            <tr>
                <td>Poli Tujuan</td>
                <td>: {{ strtoupper($sep->response->poli) }}</td>
            </tr>
            <tr>
                <td>Diagnosa awal</td>
                <td colspan="8">: {{ strtoupper($sep->response->diagnosa) }}</td>
            </tr>
            <tr>
                <td>Catatan</td>
                <td colspan="2">: {{ $sep->response->catatan }}</td>
            </tr>
        </table>
        <table>

            <tr>
                <td width="600px">
                    <p style="font-size:8px">*Saya menyetujui BPJS Kesehatan untuk :
                        <br>
                        a.membuka dan atau menggunakan informasi medis Pasien untuk keperluan administrasi,
                        pembayaran
                        asuransi atau jaminan pembiayaan kesehatan
                        <br>
                        b.memberikan akses informasi medis atau riwayat pelayanan kepada dokter/tenaga medis pada
                        RSUD
                        WALED untuk kepentingan pemeliharaan kesehatan, pengobatan, penyembuhan, dan perawatan
                        pasien.<br>
                        *Saya mengetahui dan memahami :
                        <br>. Rumah Sakit dapat melakukan koordinasi dengan PT Jasa Raharja / PT Taspen / PT ASABRI /
                        BPJS
                        Ketenagakerjaan atau Penjamin lainnya, jika Peserta merupakan pasien yang mengalami
                        kecelakaan lalulintas dan / atau kecelakaan kerja. <br>
                        b.SEP bukan sebagai bukti penjamin peserta.
                    </p>
                </td>
                <td style="font-size:8px">
                    Persetujuan Pasien/Keluarga Pasien <br><img width="40%" src="data:image/png;base64, {{ base64_encode(QrCode::generate($sep->response->peserta->noKartu)) }}"><br>Waktu:{{ $now }}
                </td>
            </tr>

        </table>
    </div>
</body>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
    }
    .scaled-content {
        transform: scale(1);
        transform-origin: 0 0;
        /* Ensure scaling starts from the top-left */
        width: 100%;
        /* Adjust width to compensate for scaling */
    }
</style>

</html>
