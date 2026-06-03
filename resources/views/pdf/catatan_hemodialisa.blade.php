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
    <style>
        .table-layout {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 10px;
            /* Membuat semua teks di dalam tabel menjadi bold */
            font-weight: bold;
        }

        .table-layout td {
            vertical-align: top;
            padding: 5px 2px;
            border: none;
            /* Membuat semua teks di dalam sel menjadi rata kanan */
            text-align: right;
            font-size: 12px;
        }

        .col-2 {
            width: 16.6%;
        }

        .col-4 {
            width: 33.3%;
        }

        .form-group-label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
    </style>
    <style>
        .table-kolom {
            width: 100%;
            border-collapse: collapse;
            border: none;
            font-family: sans-serif;
        }

        .table-kolom td {
            vertical-align: top;
            padding: 5px;
            border: none;
            /* Jika ingin teks rata kiri (standard) atau kanan (sesuai request sebelumnya) */
            text-align: left;
            font-size: 11px;
        }

        .w-33 {
            width: 33.3%;
        }

        .bold {
            font-weight: bold;
        }

        /* Font khusus simbol agar tidak "?" */
        .symbol {
            font-family: 'DejaVu Sans', sans-serif;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="isi-surat">
        <p class="float-right text-bold" style="margin-right:50px">RM.05.RJ/Rev.02/19</p>
        <div class="container">
            <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo"
                style="display: grid;
            grid-template-columns: auto auto auto;margin-top:35px;margin-left:20px;width: 10%">
            <div class="isi-surat">
                <table class="mt-2 " style="border: 1px solid;width:100%">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="2">
                                <div class="" style="text-align: center;">
                                    <p class="text-bold">PEMERINTAH KABUPATEN CIREBON<br>
                                        RUMAH SAKIT UMUM DAERAH WALED<br>Jl. Prabu Kian Santang No.
                                        4<br>Telp.(0231)661126 Email: brsud.waled@gmail.com</p>
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
                            <td style="text-align: center;height: 1px;" colspan="2" class="text-bold">CATATAN
                                HEMODIALISIS
                            </td>
                            <td style="font-style: italic;font-size:8px;margin-top:14px" class="text-bold">(Label Pasien
                                / Affix Patient Identification Label)</label>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px" colspan="2">
                                Preskripsi HD :
                                {{-- <div class="form-group-label">Preskripsi HD :</div> --}}
                                <table class="table-layout">
                                    <tr>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->inisiasi == 1) checked @endif>
                                            Inisiasi
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->akut == 1) checked @endif>
                                            Akut
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->rutin == 1) checked @endif>
                                            Rutin
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->preop == 1) checked @endif>
                                            Pre-OP
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->sled == 1) checked @endif>
                                            SLED
                                        </td>
                                    </tr>
                                </table>
                                <table class="table-layout">
                                    <tr>
                                        <td class="col-4">QB : {{ $header->qb }} ml/menit</td>
                                        <td class="col-4">QD : {{ $header->qd }} ml/menit</td>
                                        <td class="col-4">UF GOAL : {{ $header->ufgoal }} ml</td>
                                    </tr>
                                </table>
                                Prog. Profiling :
                                <table class="table-layout">
                                    <tr>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->NA == 1) checked @endif> Na
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->UF == 2) checked @endif> UF
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->bicarbonat == 3) checked @endif>
                                            Bicarbonat
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                Dialist :
                                <table class="table-layout">
                                    <tr>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->dialist == 1) checked @endif>
                                            Bicarbonat
                                        </td>
                                        <td class="col-2">
                                            <input type="checkbox" @if ($header->dialist == 2) checked @endif>
                                            Acetat
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px" colspan="3">
                                <table class="table-kolom bold">
                                    <tr>
                                        <!-- KOLOM 1: HEPARINISASI -->
                                        <td class="w-33">
                                            HEPARINISASI<br>
                                            Dosis sirkulasi : {{ $header->dosissirkulasi }} iu<br>
                                            Dosis awal : {{ $header->dosisawal }} iu<br>
                                            Dosis Maintenance:<br>
                                            - Continues : {{ $header->continues }} iu/jam<br>
                                            - Intermitten : {{ $header->intermitten }} iu/jam<br>
                                            LWMH : {{ $header->LWMH }}<br>
                                            Tanpa Heparin, Penyebab: {{ $header->tanpaheparin }}<br>
                                            Prog. bilas NaCl 0.9% 100cc/ jam/ 1/2 jam: {{ $header->programbilas }}
                                        </td>

                                        <!-- KOLOM 2: DIALIZER & BB -->
                                        <td class="w-33">
                                            Lama HD : {{ $header->lamahd }}<br><br>
                                            DIALIZER:<br>
                                            <span class="symbol">{!! $header->dializer == 1 ? '&#9745;' : '&#9744;' !!}</span> Baru
                                            <span class="symbol">{!! $header->dializer == 2 ? '&#9745;' : '&#9744;' !!}</span> Reuse<br>
                                            HD Ke : {{ $header->hd_ke }} <br><br>
                                            BB Pre HD : {{ $header->bb_pre_hd }} kg<br>
                                            BB Post HD : {{ $header->bb_post_hd }} kg
                                        </td>

                                        <!-- KOLOM 3: WAKTU & TARGET -->
                                        <td class="w-33">
                                            Jam Mulai HD : {{ $header->jam_mulai_hd }}<br>
                                            Jam Selesai HD : {{ $header->jam_selesai_hd }}<br>
                                            Ke : {{ $header->ke }}<br><br>
                                            Target BB Kering : {{ $header->target_bb_kering }} kg<br>
                                            BB Observasi : {{ $header->bb_observasi }} kg
                                        </td>
                                    </tr>
                                </table>
                                {{-- <div class="row">
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Heparinisasi</label><br>
                                        <label for="exampleInputEmail1">Dosis sirkulasi : {{ $header->dosissirkulasi }}
                                            iu</label><br>
                                        <label for="exampleInputEmail1">Dosis awal : {{ $header->dosisawal }}
                                            iu</label><br>
                                        <label for="exampleInputEmail1">dosis maintenance</label><br>
                                        <label for="exampleInputEmail1">continues : {{ $header->continues }}
                                            iu/jam</label><br>
                                        <label for="exampleInputEmail1">intermitten : {{ $header->intermitten }}
                                            iu/jam</label><br>
                                        <label for="exampleInputEmail1">LWMH : {{ $header->LWMH }} </label><br>
                                        <label for="exampleInputEmail1">Tanpa Heparin, penyebab :
                                            {{ $header->tanpaheparin }} </label><br>
                                        <label for="exampleInputEmail1">Program bilas NaCl 0.9 % 100cc/ jam/ 1/2 jam :
                                            {{ $header->programbilas }} </label><br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Lama HD : {{ $header->lamahd }} jam</label><br>
                                        <label for="exampleInputEmail1">Dializer</label>
                                        <div class="input-group mb-3">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="1" id="dializer" name="dializer"
                                                    @if ($header->dializer == 1) checked @endif>
                                                <label class="form-check-label" for="checkDefault">
                                                    Baru
                                                </label>
                                            </div>
                                            <div class="form-check ml-2 mr-2">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="2" id="dializer" name="dializer"
                                                    @if ($header->dializer == 2) checked @endif>
                                                <label class="form-check-label" for="checkDefault">
                                                    Reuse
                                                </label>
                                            </div><br><br>
                                        </div>
                                        <label for="exampleInputEmail1" class="mr-2 ml-2">Ke :
                                            {{ $header->hd_ke }} </label>
                                        <br>
                                        <label for="exampleInputEmail1">BB pre HD :
                                            {{ $header->bb_pre_hd }}</label><br>
                                        <label for="exampleInputEmail1">BB Post HD :
                                            {{ $header->bb_post_hd }}</label><br>

                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Jam mulai HD :
                                            {{ $header->jam_mulai_hd }}</label><br>
                                        <label for="exampleInputEmail1">Jam Selesai HD :
                                            {{ $header->jam_selesai_hd }}</label><br>
                                        <label for="exampleInputEmail1">ke : {{ $header->ke }}</label><br>
                                        <label for="exampleInputEmail1">Target BB kering :
                                            {{ $header->target_bb_kering }}</label><br>
                                        <label for="exampleInputEmail1">BB Observasi :
                                            {{ $header->bb_observasi }}</label><br>
                                    </div>
                                </div> --}}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;font-weight:bold;height: 1px;" colspan="3">
                                TINDAKAN KEPERAWATAN
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <style>
                                    .table-pdf {
                                        width: 100%;
                                        border-collapse: collapse;
                                        font-family: sans-serif;
                                        font-size: 10px;
                                        /* Ukuran standar PDF agar muat banyak kolom */
                                    }

                                    .table-pdf th,
                                    .table-pdf td {
                                        border: 1px solid #000;
                                        padding: 4px;
                                        text-align: center;
                                        vertical-align: middle;
                                    }

                                    .thead-dark {
                                        background-color: #f2f2f2;
                                    }

                                    /* Solusi Teks Vertikal untuk dompdf */
                                    .vertical-container {
                                        height: 80px;
                                        width: 20px;
                                        position: relative;
                                    }

                                    .text-vertikal {
                                        transform: rotate(-90deg);
                                        white-space: nowrap;
                                        display: block;
                                        width: 80px;
                                        /* Sesuai tinggi container */
                                        position: absolute;
                                        bottom: 30px;
                                        left: -30px;
                                    }

                                    .text-left {
                                        text-align: left;
                                    }

                                    .bg-light {
                                        background-color: #fafafa;
                                    }
                                </style>
                                <table class="table-pdf">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th rowspan="2" style="width: 30px;">
                                                <div class="vertical-container">
                                                    <span class="text-vertikal">Observation</span>
                                                </div>
                                            </th>
                                            <th rowspan="2">Jam</th>
                                            <th rowspan="2">QB<br>(ml/mnt)</th>
                                            <th rowspan="2">UF Rate<br>(ml)</th>
                                            <th rowspan="2">Tek Darah<br>(mmHg)</th>
                                            <th rowspan="2">Nadi<br>(x/mnt)</th>
                                            <th rowspan="2">Suhu<br>(c)</th>
                                            <th rowspan="2">Resp<br>(x/mnt)</th>
                                            <th colspan="4">Intake (ml)</th>
                                            <th>Output (ml)</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">PIC</th>
                                        </tr>
                                        <tr>
                                            <th>NaCl</th>
                                            <th>Dext40</th>
                                            <th>Mkn/Min</th>
                                            <th>Lain</th>
                                            <th>UF Terapi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- SECTION 1: PRE-HD --}}
                                        @php
                                            $preHdData = array_filter(
                                                $arrayBaru,
                                                fn($val) => $val->idheader == $header->id,
                                            );
                                            $totalPre = count($preHdData);
                                            $isFirstPre = true;
                                        @endphp
                                        @foreach ($preHdData as $dd)
                                            <tr>
                                                @if ($isFirstPre)
                                                    <td rowspan="{{ $totalPre }}" class="bg-light"><b>Pre-HD</b>
                                                    </td>
                                                    @php $isFirstPre = false; @endphp
                                                @endif
                                                <td>{{ \Carbon\Carbon::parse($dd->tgl_entry)->format('d/m/y') }}<br>{{ $dd->jam }}
                                                </td>
                                                <td>{{ $dd->qb }}</td>
                                                <td>{{ $dd->ufrate }}</td>
                                                <td>{{ $dd->tekanandarah }}</td>
                                                <td>{{ $dd->frekuensinadi }}</td>
                                                <td>{{ $dd->suhu }}</td>
                                                <td>{{ $dd->resep }}</td>
                                                <td>{{ $dd->intake_nacl }}</td>
                                                <td>{{ $dd->intake_dextrose }}</td>
                                                <td>{{ $dd->intake_makanan_minuman }}</td>
                                                <td>{{ $dd->intake_lainlain }}</td>
                                                <td>{{ $dd->output }}</td>
                                                <td class="text-left">{{ $dd->keteranganlain }}</td>
                                                <td>{{ $dd->nama_pic }}</td>
                                            </tr>
                                        @endforeach

                                        {{-- SECTION 2: INTRA-HD --}}
                                        @php
                                            $intraHdData = array_filter(
                                                $arrayBaru2,
                                                fn($val) => $val->idheader == $header->id,
                                            );
                                            $totalIntra = count($intraHdData);
                                            $isFirstIntra = true;
                                        @endphp
                                        @foreach ($intraHdData as $dd)
                                            <tr>
                                                @if ($isFirstIntra)
                                                    <td rowspan="{{ $totalIntra }}" class="bg-light"><b>Intra-HD</b>
                                                    </td>
                                                    @php $isFirstIntra = false; @endphp
                                                @endif
                                                <td>{{ $dd->jam }}</td>
                                                <td>{{ $dd->qb }}</td>
                                                <td>{{ $dd->ufrate }}</td>
                                                <td>{{ $dd->tekanandarah }}</td>
                                                <td>{{ $dd->frekuensinadi }}</td>
                                                <td>{{ $dd->suhu }}</td>
                                                <td>{{ $dd->resep }}</td>
                                                <td>{{ $dd->intake_nacl }}</td>
                                                <td>{{ $dd->intake_dextrose }}</td>
                                                <td>{{ $dd->intake_makanan_minuman }}</td>
                                                <td>{{ $dd->intake_lainlain }}</td>
                                                <td>{{ $dd->output }}</td>
                                                <td class="text-left">{{ $dd->keteranganlain }}</td>
                                                <td>{{ $dd->nama_pic }}</td>
                                            </tr>
                                        @endforeach
                                        @php
                                            // 1. Filter data yang sesuai dengan idheader terlebih dahulu
                                            $filteredData = array_filter($arrayBaru3, function ($val) use ($header) {
                                                return $val->idheader == $header->id;
                                            });
                                            $totalData3 = count($filteredData);
                                            $isFirst = true; // Penanda baris pertama
                                        @endphp
                                        @foreach ($arrayBaru3 as $dd)
                                            @if ($dd->idheader == $header->id)
                                                <tr>
                                                    @if ($isFirst)
                                                        <td rowspan="{{ $totalData3 }}"
                                                            class="align-middle text-center">
                                                            POST-HD
                                                        </td>
                                                        @php $isFirst = false; @endphp {{-- Set ke false agar tidak muncul di baris berikutnya --}}
                                                    @endif
                                                    <td>{{ $dd->jam }}</td>
                                                    <td>{{ $dd->qb }}</td>
                                                    <td>{{ $dd->ufrate }}</td>
                                                    <td>{{ $dd->tekanandarah }}</td>
                                                    <td>{{ $dd->frekuensinadi }}</td>
                                                    <td>{{ $dd->suhu }}</td>
                                                    <td>{{ $dd->resep }}</td>
                                                    <td>{{ $dd->intake_nacl }}</td>
                                                    <td>{{ $dd->intake_dextrose }}</td>
                                                    <td>{{ $dd->intake_makanan_minuman }}</td>
                                                    <td>{{ $dd->intake_lainlain }}</td>
                                                    <td>{{ $dd->output }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->nama_pic }}</td>
                                                 
                                                </tr>
                                            @endif
                                        @endforeach
                                        {{-- FOOTER: SUMMARY --}}
                                        @php
                                            $lastData = collect($arrayBaru3)->where('idheader', $header->id)->last();
                                        @endphp
                                        @if ($lastData)
                                            <tr style="background-color: #f9f9f9; font-weight: bold;">
                                                <td colspan="8" class="text-left">RINGKASAN</td>
                                                <td colspan="4">Total Intake: {{ $lastData->jmlhintake }}</td>
                                                <td>Tot UF: {{ $lastData->jmlhuf }}</td>
                                                <td colspan="2">Balance: {{ $lastData->balance }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="8"></td>
                                                <td colspan="7" class="text-left"><b>Total UF Keseluruhan:
                                                        {{ $lastData->totaluf }} ml</b></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p>
                                    Penyulit selama HD
                                    <br>
                                    @foreach ($arrayBaru4 as $dd)
                                        @if ($dd->idheader == $header->id)
                                            <style>
                                                .komplikasi-table {
                                                    width: 100%;
                                                    border-collapse: collapse;
                                                    margin-top: 5px;
                                                }

                                                .komplikasi-table td {
                                                    vertical-align: middle;
                                                    font-size: 10px;
                                                    /* Ukuran font sedikit dikecilkan karena kolom banyak */
                                                    padding: 3px 2px;
                                                    width: 25%;
                                                    /* Membagi menjadi 4 kolom per baris agar teks tidak numpuk */
                                                }

                                                .cb-box {
                                                    display: inline-block;
                                                    width: 9px;
                                                    /* Ukuran kotak diperkecil */
                                                    height: 9px;
                                                    /* Ukuran kotak diperkecil */
                                                    border: 0.5pt solid #000;
                                                    /* Garis border lebih tipis agar tidak terlihat tebal saat kotak kecil */
                                                    text-align: center;
                                                    line-height: 8px;
                                                    /* Menyesuaikan posisi vertikal centang di dalam kotak */
                                                    font-family: DejaVu Sans, sans-serif;
                                                    font-size: 8px;
                                                    /* Ukuran simbol centang (tick) diperkecil */
                                                    margin-right: 3px;
                                                    vertical-align: middle;
                                                }

                                                .label-text {
                                                    vertical-align: middle;
                                                }
                                            </style>
                                            {{-- <div class="row">
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;"
                                                            style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="1" id="inisiasi"
                                                            name="inisiasi"
                                                            @if ($dd->masalahakses == 1) checked @endif>
                                                        <label class="form-check-label" for="checkDefault">
                                                            Masalah akses
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="1" id="akut"
                                                            @if ($dd->perdarahan == 1) checked @endif
                                                            name="akut">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Perdarahan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="rutin"
                                                            @if ($dd->fus == 1) checked @endif
                                                            name="rutin">
                                                        <label class="form-check-label" for="checkDefault">
                                                            First use syndrome
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="preop"
                                                            @if ($dd->sakitkepala == 1) checked @endif
                                                            name="preop">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Sakit kepala
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->mualmuntah == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Mual dan muntah
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->kramototo == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            kram otot
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->hiperkalemia == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Hiperkalemia
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->hipotensi == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Hipotensi
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->hipertensi == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Hipertensi
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->nyeridada == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Nyeri dada
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->aritmia == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Aritmia
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->gatalgatal == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Gatal gatal
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->demam == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Demam
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check">
                                                        <input style="pointer-events: none;" class="form-check-input"
                                                            type="checkbox" value="" id="sled"
                                                            @if ($dd->menggigil == 1) checked @endif
                                                            name="sled">
                                                        <label class="form-check-label" for="checkDefault">
                                                            Menggigil / dingin
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <table class="komplikasi-table">
                                                <!-- Baris 1 -->
                                                <tr>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->masalahakses == 1) checked @endif>
                                                        <span class="label-text">Masalah Akses</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->perdarahan == 1) checked @endif>
                                                        <span class="label-text">Perdarahan</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->fus == 1) checked @endif>
                                                        <span class="label-text">First Use Syndrome</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->sakitkepala == 1) checked @endif>
                                                        <span class="label-text">Sakit Kepala</span>
                                                    </td>
                                                </tr>
                                                <!-- Baris 2 -->
                                                <tr>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->mualmuntah == 1) checked @endif>
                                                        <span class="label-text">Mual & Muntah</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->kramototo == 1) checked @endif>
                                                        <span class="label-text">Kram Otot</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->hiperkalemia == 1) checked @endif>
                                                        <span class="label-text">Hiperkalemia</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->hipotensi == 1) checked @endif>
                                                        <span class="label-text">Hipotensi</span>
                                                    </td>
                                                </tr>
                                                <!-- Baris 3 -->
                                                <tr>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->hipertensi == 1) checked @endif>
                                                        <span class="label-text">Hipertensi</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->nyeridada == 1) checked @endif>
                                                        <span class="label-text">Nyeri Dada</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->aritmia == 1) checked @endif>
                                                        <span class="label-text">Aritmia</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->gatalgatal == 1) checked @endif>
                                                        <span class="label-text">Gatal-gatal</span>
                                                    </td>
                                                </tr>
                                                <!-- Baris 4 -->
                                                <tr>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->demam == 1) checked @endif>
                                                        <span class="label-text">Demam</span>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox"
                                                            @if ($dd->menggigil == 1) checked @endif>
                                                        <span class="label-text">Menggigil</span>
                                                    </td>
                                                    <td colspan="2"></td> <!-- Kosongkan sisa kolom -->
                                                </tr>
                                            </table>
                                            Lainnya : {{ $dd->lainnya }}
                                </p>
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <p>
                                    Evaluasi Keperawatan : {{ $header->evaluasi_keperawatan }} <br>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <style>
                                    .access-table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-bottom: 10px;
                                    }

                                    .access-table td {
                                        vertical-align: top;
                                        font-size: 11px;
                                        width: 20%;
                                        /* Membagi 5 kolom sama rata */
                                        padding: 5px;
                                    }

                                    /* Styling Checkbox Custom untuk PDF */
                                    .checkbox-box {
                                        display: inline-block;
                                        width: 12px;
                                        height: 12px;
                                        border: 1px solid #000;
                                        text-align: center;
                                        line-height: 10px;
                                        font-family: DejaVu Sans, sans-serif;
                                        /* Support simbol check */
                                        margin-right: 5px;
                                    }
                                </style>
                                <p>
                                    Akses Vaskuler
                                <table class="access-table">
                                    <tr>
                                        <!-- Akses 1: AV Shunt -->
                                        <td>
                                            <input type="checkbox" @if ($header->avshunt == 1) checked @endif>
                                            <span>AV Shunt</span>
                                        </td>

                                        <!-- Akses 2: AV Femoral -->
                                        <td>
                                            <input type="checkbox" @if ($header->avfemoral == 1) checked @endif>
                                            <span>AV Femoral</span>
                                        </td>

                                        <!-- Akses 3: Subclavia -->
                                        <td>
                                            <input type="checkbox" @if ($header->cateterdoublelumensubclavia == 1) checked @endif>
                                            <span>Cateter Double Lumen Subclavia</span>
                                        </td>

                                        <!-- Akses 4: Jugularis -->
                                        <td>
                                            <input type="checkbox" @if ($header->cataterdoublelumenjugularis == 1) checked @endif>
                                            <span>Cateter Double Lumen Jugularis</span>
                                        </td>

                                        <!-- Akses 5: Femoralis -->
                                        <td> <input type="checkbox" @if ($header->cateterdoublelumenfemoralis == 1) checked @endif>
                                            <span>Cateter Double Lumen Femoralis</span>
                                        </td>
                                    </tr>
                                </table>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-weight:bolder;font-size:12px">
                                    Akses Vaskuler Oleh : {{ $header->akses_vaskuler_oleh }}
                                </p>
                            </td>
                            <td colspan="2">
                                <p class="text-center" style="font-weight: bolder">
                                    {{-- <h5 class="text-center"> --}}
                                    diperiksa :
                                    {{ \Carbon\Carbon::parse($header->tgl_periksa)->locale('id')->translatedFormat('d F Y') }}
                                    <br>Nama dan tanda tangan perawat yang bertugas :
                                    <br>
                                    <br>
                                    <br>
                                    <br>

                                    {{ strtoupper($header->akses_vaskuler_oleh) }}
                                    {{-- </h5> --}}
                                </p>
                            </td>
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
