<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Etiket Farmasi</title>
    <style>
        @page {
            margin: 2px 4px;
            /* Margin tipis untuk memaksimalkan area cetak thermal */
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 7.5pt;
            font-weight: bold;
            line-height: 1.15;
            margin: 0;
            padding: 0;
            color: #000;
        }

        /* Container Header dengan Logo */
        .header-container {
            display: table;
            width: 100%;
            border-bottom: 1.5px solid #000;
            padding-bottom: 2px;
            margin-bottom: 3px;
        }

        .header-logo {
            display: table-cell;
            width: 28px;
            vertical-align: middle;
            text-align: left;
        }

        .header-logo img {
            width: 26px;
            height: auto;
        }

        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .title {
            font-size: 8.5pt;
        }

        .sub-title {
            font-size: 7.5pt;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-table td {
            vertical-align: top;
            padding: 1px 0;
            font-weight: bold;
        }

        /* Box Aturan Pakai / Dosis */
        .aturan-pakai {
            text-align: center;
            font-size: 9pt;
            font-weight: bold;
            margin: 4px 0;
            border: 1px dashed #000;
            padding: 3px 2px;
            text-transform: uppercase;
        }

        .footer {
            font-size: 6.5pt;
            font-weight: bold;
            text-align: right;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    @foreach ($data as $row)
        <div class="header-container">
            <div class="header-logo">
                {{-- Opsi 1: Menggunakan file logo lokal dari folder public/img/logo.png --}}
                <img src="{{ public_path('../public/img/logo_rs.png') }}" alt="Logo">

                {{-- Opsi 2 (Jika gambar dikirim dari Controller sebagai Base64): --}}
                {{-- <img src="{{ $logoBase64 }}" alt="Logo"> --}}
            </div>
            <div class="header-text">
                <div class="title">INSTALASI FARMASI</div>
                <div class="sub-title">RSUD WALED</div>
            </div>
        </div>

        <table class="content-table">
            <tr>
                <td width="30%">No. RM</td>
                <td width="5%">:</td>
                <td>{{ $row->no_rm ?? ($get_header->no_rm ?? '-') }}</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $row->nama_px ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td>:</td>
                <td>
                    @if (!empty($row->tgl_lahir) && $row->tgl_lahir != '0000-00-00')
                        {{ \Carbon\Carbon::parse($row->tgl_lahir)->format('d-m-Y') }}
                    @else
                        -
                    @endif
                </td> 
            </tr>
            <tr>
                <td>Usia / BB</td>
                <td>:</td>
                <td>
                    @if (!empty($row->tgl_lahir) && $row->tgl_lahir != '0000-00-00')
                        {{ \Carbon\Carbon::parse($row->tgl_lahir)->age }} Thn
                    @else
                        -
                    @endif
                    / {{ $row->BB ? $row->BB . ' Kg' : '-' }}
                </td>
            </tr>
            <tr>
                <td>Obat</td>
                <td>:</td>
                <td>{{ $row->nama_barang ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td>:</td>
                <td>{{ $row->jumlah_layanan ?? '-' }} {{ $row->satuan ?? '' }} {{ $row->sediaan }}</td>
            </tr>
        </table>

        <!-- Box Aturan Pakai / Dosis -->
        <div class="aturan-pakai">
            {{ $row->dosis }} {{ $row->carapakai }}
        </div>

        <div class="footer">
            @if (!empty($row->BUD))
                BUD : {{ $row->BUD }} /
            @endif ed: {{ $row->ed_obat ?? '-' }}
        </div>

        {{-- Jika ada multiple obat/etiket dalam 1 kueri, beri page break --}}
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
</body>

</html>