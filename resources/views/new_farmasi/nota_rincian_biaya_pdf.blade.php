<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rincian Biaya Farmasi</title>
    <style>
        @page {
            /* Margin Top 4cm, Bottom 5px, Left/Right 0.5cm */
            margin: 1cm 0.5cm 5px 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8.5pt;
            font-weight: bold;
            color: #000;
            line-height: 1.15;
            margin: 0;
            padding: 0;
        }

        /* Header / Kop */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }

        .header-logo {
            width: 30px;
            vertical-align: middle;
        }

        .header-logo img {
            width: 26px;
            height: auto;
        }

        .header-title {
            vertical-align: middle;
            font-weight: bold;
            font-size: 9.5pt;
            line-height: 1.1;
        }

        .header-status {
            vertical-align: middle;
            text-align: right;
            font-weight: bold;
            font-size: 9.5pt;
        }

        .divider-top {
            border-top: 1.5px solid #000;
            margin-bottom: 4px;
        }

        /* Data Pasien & Transaksi */
        .patient-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
            font-size: 8.5pt;
        }

        .patient-table td {
            vertical-align: top;
            padding: 0.5px 0;
        }

        /* Tabel Detail Obat */
        .item-table {
            width: 100%;
            border-collapse: collapse;
            border-top: 1.5px solid #000;
            border-bottom: 1.5px solid #000;
            margin-bottom: 4px;
            font-size: 8.5pt;
        }

        .item-table th {
            padding: 3px 0;
            font-weight: bold;
        }

        .item-table td {
            padding: 2px 0;
            vertical-align: top;
        }

        /* Summary / Total Section */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2px;
            font-size: 8.5pt;
        }

        .summary-table td {
            vertical-align: top;
            padding: 1px 0;
        }

        .total-box {
            border-top: 1px solid #000;
            border-bottom: 2.5px double #000;
            padding: 2px 0;
        }

        .footer-info {
            margin-top: 6px;
            font-size: 8pt;
        }
    </style>
</head>

<body>

    <!-- KOP HEADER -->
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ public_path('../public/img/logo_rs.png') }}" alt="Logo">
            </td>
            <td class="header-title">
                RINCIAN BIAYA FARMASI<br>
                RSUD WALED KAB.CIREBON
            </td>
            <td class="header-status" style="font-size:8px">
                {{ $header->jenis_resep ?? 'Resep Kredit' }} / {{ $details[0]->tiperesep}}
            </td>
        </tr>
    </table>

    <div class="divider-top"></div>

    <!-- INFORMASI PASIEN & LAYANAN -->
    <table class="patient-table">
        <tr>
            <td colspan="2"></td>
            <td colspan="5" align="right" style="font-size: 10px;">
                RM / Counter : {{ $dtpx[0]->no_rm ?? '-' }} / {{ $dtpx[0]->counter ?? '-' }}
            </td>
        </tr>
        <tr>
            <td width="27%">Kode Layanan</td>
            <td width="3%">:</td>
            <td colspan="5">{{ $header->kode_layanan_header ?? '-' }} / {{ $header->keterangan }}</td>
        </tr>
        <tr>
            <td>Nama Pasien</td>
            <td>:</td>
            <td colspan="5">{{ $dtpx[0]->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td colspan="5">
                {{ !empty($dtpx[0]->tgl_lahir) ? \Carbon\Carbon::parse($dtpx[0]->tgl_lahir)->format('d-m-Y') : '-' }}
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td colspan="5">
                {{ $dtpx[0]->alamat ?? '-' }}
            </td>
        </tr>
        <tr>
            <td colspan="7" style="height: 3px;"></td>
        </tr>
        <tr>
            <td>Penjamin</td>
            <td>:</td>
            <td colspan="5">{{ $dtpx[0]->nama_penjamin ?? '-' }}</td>
        </tr>
        <tr>
            <td>Unit Asal</td>
            <td>:</td>
            <td colspan="5">{{ $dtpx[0]->unit ?? '-' }}</td>
        </tr>
        <tr>
            <td>Dokter</td>
            <td>:</td>
            <td colspan="5">{{ $dtpx[0]->dokter ?? '-' }}</td>
        </tr>
    </table>

    <!-- RINCIAN OBAT -->
    <table class="item-table">
        <thead>
            <tr>
                <th align="left" width="52%">Nama Obat</th>
                <th align="center" width="13%">QTY</th>
                <th align="right" width="35%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
                $totalItem = count($details);
            @endphp
            @foreach ($details as $item)
                @php
                    $jumlah = $item->total_tarif * $item->jumlah_layanan;
                    $subtotal += $jumlah;
                @endphp
                <tr>
                    <td align="left">{{ $item->NAMA_TARIF }}</td>
                    <td align="center">{{ number_format($item->jumlah_layanan, 0, ',', '.') }}</td>
                    <td align="right">{{ number_format($jumlah, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- RINGKASAN BIAYA -->
    @php
        $jasaResep = $header->jasa_resep ?? 1000;
        $totalBayar = $subtotal + $jasaResep;
    @endphp
    <table class="summary-table">
        <tr>
            <td width="42%" align="left">
                Total item : {{ $totalItem }}
            </td>
            <td width="26%" align="left">Subtotal</td>
            <td width="32%" align="right">: {{ number_format($subtotal, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <td></td>
            <td align="left">Jasa Resep (1)</td>
            <td align="right">: {{ number_format($jasaResep, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" class="total-box">
                <table width="100%" style="font-weight: bold; font-size: 8.5pt;">
                    <tr>
                        <td align="left" width="45%">Total Bayar</td>
                        <td align="right" width="55%">: {{ number_format($totalBayar, 2, '.', ',') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- FOOTER INFORMASI -->
    <div class="footer-info">
        Tgl Input :
        {{ !empty($header->tgl_input) ? \Carbon\Carbon::parse($header->tgl_input)->format('Y-m-d H:i:s') : date('Y-m-d H:i:s') }}<br>
        Input by : {{ $header->petugas_input ?? (auth()->user()->name ?? '-') }}
    </div>

</body>

</html>