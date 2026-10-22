<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Etiket Farmasi</title>
    <style>
        @page {
            size: 144pt 171.78pt;
            margin: 2px 4px;
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

        /* Container halaman per etiket untuk mengunci pemisahan halaman di Dompdf */
        .etiket-page {
            width: 100%;
            height: 165pt;
            max-height: 165pt;
            box-sizing: border-box;
            overflow: hidden;
            page-break-inside: avoid;
            page-break-after: always;
        }

        /* Hilangkan page break pada elemen paling akhir */
        .etiket-page:last-child {
            page-break-after: avoid;
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
            font-size: 8.5pt;
            font-weight: bold;
            margin: 3px 0;
            border: 1px dashed #000;
            padding: 2px 2px;
            text-transform: uppercase;
        }

        .footer {
            font-size: 6pt;
            font-weight: bold;
            text-align: right;
            margin-top: 2px;
        }
    </style>
</head>

<body>
    {{-- 1. ETIKET OBAT NON-RACIKAN / UMUM ($data) --}}
    @if (isset($data) && count($data) > 0)
        @foreach ($data as $row)
            <div class="etiket-page">
                <div class="header-container">
                    <div class="header-logo">
                        <img src="{{ public_path('img/logo_rs.png') }}" alt="Logo">
                    </div>
                    <div class="header-text">
                        <div class="title">INSTALASI FARMASI</div>
                        <div class="sub-title">RSUD WALED</div>
                    </div>
                </div>

                <table class="content-table">
                    <tr style="font-size:8px">
                        <td width="30%">No. RM</td>
                        <td width="5%">:</td>
                        <td>{{ $row->no_rm ?? ($get_header->no_rm ?? '-') }}</td>
                    </tr>
                    <tr style="font-size:8px">
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                            {{ $row->nama_px ?? '-' }} /
                            @if (!empty($row->tgl_lahir) && $row->tgl_lahir != '0000-00-00')
                                {{ \Carbon\Carbon::parse($row->tgl_lahir)->age }} Thn
                            @else
                                -
                            @endif
                            / {{ isset($row->BB) && $row->BB ? $row->BB . ' Kg' : '-' }}
                        </td>
                    </tr>
                    <tr style="font-size:8px">
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
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <span
                                style="font-size:5px; color:#000; font-weight: normal;">{{ $row->alamat ?? '-' }}</span>
                        </td>
                    </tr>
                </table>

                <div class="aturan-pakai">
                    {{ $row->nama_barang ?? '-' }} <br>
                    <span style="font-size: 7.5pt">Qty : {{ $row->jumlah_layanan ?? '-' }}
                        {{ $row->satuan ?? '' }}</span><br>
                    {{ $row->aturan_pakai ?? $row->dosis . ' ' . $row->carapakai }}
                </div>

                <div class="footer">
                    @if (!empty($row->BUD))
                        {{ $row->BUD }} /
                    @endif
                    ed: {{ $row->ed_obat ?? '-' }} <br>
                    tgl entry : {{ $row->tgl_entry ?? '-' }}
                </div>
            </div>
        @endforeach
    @endif


    {{-- 2. ETIKET OBAT RACIKAN ($data_racikan) --}}
    @if (isset($data_racikan) && count($data_racikan) > 0)
        @php
            // Filter hanya data yang kode_barang-nya berawalan huruf 'R' (case-insensitive) lalu group berdasarkan kode_barang
            $groupedRacikan = collect($data_racikan)
                ->filter(function ($item) {
                    return str_starts_with(strtoupper($item->kode_barang ?? ''), 'R');
                })
                ->groupBy('kode_barang');
        @endphp

        @foreach ($groupedRacikan as $idDetail => $items)
            @php $firstRacik = $items->first(); @endphp
            <div class="etiket-page">
                <div class="header-container">
                    <div class="header-logo">
                        <img src="{{ public_path('img/logo_rs.png') }}" alt="Logo">
                    </div>
                    <div class="header-text">
                        <div class="title">INSTALASI FARMASI</div>
                        <div class="sub-title">ETIKET RACIKAN</div>
                    </div>
                </div>

                <table class="content-table">
                    <tr style="font-size:8px">
                        <td width="30%">No. RM</td>
                        <td width="5%">:</td>
                        <td>{{ $firstRacik->no_rm ?? '-' }}</td>
                    </tr>
                    <tr style="font-size:8px">
                        <td>Nama</td>
                        <td>:</td>
                        <td>
                            {{ $firstRacik->nama_px ?? '-' }} /
                            @if (!empty($firstRacik->tgl_lahir) && $firstRacik->tgl_lahir != '0000-00-00')
                                {{ \Carbon\Carbon::parse($firstRacik->tgl_lahir)->age }} Thn
                            @else
                                -
                            @endif
                            / {{ isset($firstRacik->BB) && $firstRacik->BB ? $firstRacik->BB . ' Kg' : '-' }}
                        </td>
                    </tr>
                    <tr style="font-size:8px">
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td>
                            @if (!empty($firstRacik->tgl_lahir) && $firstRacik->tgl_lahir != '0000-00-00')
                                {{ \Carbon\Carbon::parse($firstRacik->tgl_lahir)->format('d-m-Y') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>
                            <span
                                style="font-size:4.5pt; color:#000; font-weight: normal;">{{ $firstRacik->alamat ?? '-' }}</span>
                        </td>
                    </tr>
                </table>

                <div style="font-size: 7pt; margin-top: 2px;">
                    <strong>{{ $firstRacik->nama_racik ?? 'Racikan' }}</strong>
                    ({{ $firstRacik->jumlah_layanan ?? 0 }} Bungkus/Kapsul)
                    :
                </div>

                {{-- Menampilkan daftar item komposisi racikan dalam 1 baris --}}
                <div style="font-size: 5pt; margin: 1px 0; font-weight: normal; line-height: 1.0;">
                    {{ $items->map(function ($item) {
                            return $item->nm_item_racikan . ' (' . $item->qty_item_racik . ')';
                        })->implode(', ') }}
                </div>

                <div class="aturan-pakai">
                    {{ $firstRacik->aturan_pakai ?? 'SESUAI PETUNJUK DOKTER' }}
                </div>

                <div class="footer">
                    Dr: {{ $firstRacik->nama_paramedis ?? '-' }} | Entry: {{ $firstRacik->tgl_entry ?? '-' }}
                </div>
            </div>
        @endforeach
    @endif
</body>

</html>
