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
    {{-- 1. ETIKET OBAT NON-RACIKAN / UMUM ($data) --}}
    @if (isset($data) && count($data) > 0)
        @foreach ($data as $row)
            <div class="etiket-box">
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
                    <tr>
                        <td width="30%">No. RM</td>
                        <td width="5%">:</td>
                        <td>{{ $row->no_rm ?? ($get_header->no_rm ?? '-') }}</td>
                    </tr>
                    <tr>
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
                        <td>Alamat</td>
                        <td>:</td>
                        <td><span style="font-size: 5pt; font-weight: normal;">{{ $row->alamat ?? '-' }}</span></td>
                    </tr>
                </table>

                <div class="aturan-pakai">
                    {{ $row->nama_barang ?? 'OBAT' }}<br>
                    <span style="font-size: 7.5pt;">Qty : {{ $row->jumlah_layanan ?? '-' }}
                        {{ $row->satuan ?? '' }}</span><br>
                    {{ $row->aturan_pakai ?? $row->dosis . ' ' . $row->carapakai }}
                </div>

                <div class="footer">
                    @if (!empty($row->BUD))
                        {{ $row->BUD }} /
                    @endif
                    @if (!empty($row->ed_obat))
                        ed: {{ $row->ed_obat }} <br>
                    @endif
                    Par/Dr: {{ $get_header->nama_paramedis ?? '-' }} | Entry: {{ $row->tgl_entry ?? '-' }}
                </div>
            </div>
        @endforeach
    @endif

    {{-- 2. ETIKET OBAT RACIKAN ($data_racikan) --}}
    @if (isset($data_racikan) && count($data_racikan) > 0)
        @php
            $groupedRacikan = collect($data_racikan)->groupBy('kode_layanan_header');
        @endphp
        @foreach ($groupedRacikan as $idDetail => $items)
            @php $firstRacik = $items->first(); @endphp
            <div class="etiket-box">
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
                    <tr>
                        <td width="30%">No. RM</td>
                        <td width="5%">:</td>
                        <td>{{ $firstRacik->no_rm ?? '-' }}</td>
                    </tr>
                    <tr>
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
                    <tr>
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
                        <td><span
                                style="font-size: 4.5pt; font-weight: normal;">{{ $firstRacik->alamat ?? '-' }}</span>
                        </td>
                    </tr>
                </table>

                <div style="font-size: 7pt; margin-top: 2px;">
                    <strong>{{ $firstRacik->nama_racik ?? 'Racikan' }}</strong>
                    ({{ $firstRacik->jumlah_layanan ?? 0 }} Bungkus/Kapsul)
                    :
                </div>

                {{-- Menampilkan komposisi item obat racikan digabung dalam satu baris --}}
                <div style="font-size: 5.5pt; margin: 1px 0; font-weight: normal;">
                    {{ $items->map(function ($item) {
                            return $item->nm_item_racikan . ' (' . $item->qty_item_racik . ')';
                        })->implode(', ') }}
                </div>

                <div class="aturan-pakai">
                    {{ $firstRacik->aturan_pakai ?? 'Sesuai Petunjuk Dokter' }}
                </div>

                <div class="footer">
                    Dr: {{ $firstRacik->nama_paramedis ?? '-' }} | Entry: {{ $firstRacik->tgl_entry ?? '-' }}
                </div>
            </div>
        @endforeach
    @endif
</body>

</html>
