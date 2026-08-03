<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hasil Asesmen Risiko Bunuh Diri - {{ $mt_pasien[0]->no_rm ?? '' }}</title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}">

    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: sans-serif;
            font-size: 10px;
            color: #000;
        }

        #footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 7pt;
            color: #1d1c1c;
        }

        .logo {
            width: 55px;
            height: auto;
        }

        .instansi2 {
            font-size: 13px;
            font-weight: bold;
            line-height: 1.2;
        }

        .instansi3 {
            font-size: 9px;
            font-weight: normal;
            line-height: 1.2;
        }

        .table-bordered {
            border: 1px solid #000 !important;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
            padding: 4px 6px;
        }

        .text-xxxs {
            font-size: 7px;
        }

        .box-kriteria {
            padding: 6px;
            margin-bottom: 8px;
            border: 1px solid #000;
            background-color: #f8f9fa;
        }

        .badge-risiko {
            display: inline-block;
            padding: 3px 8px;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    @php
        // Calculation Logic
        $skor1 = $assesmen->pertanyaan1 ?? 0;
        $skor2 = $assesmen->pertanyaan2 ?? 0;
        $skor3 = $assesmen->pertanyaan3 ?? 0;
        $skor4 = $assesmen->pertanyaan4 ?? 0;
        $skor5 = $assesmen->pertanyaan5 ?? 0;
        $skor6 = $assesmen->pertanyaan6 ?? 0;
        $skor7 = $assesmen->pertanyaan7 ?? 0;
        $skor8 = $assesmen->pertanyaan8 ?? 0;
        $skor9 = $assesmen->q_skrining ?? 0;

        $totalSkor = $skor1 + $skor2 + $skor3 + $skor4 + $skor5 + $skor6 + $skor7 + $skor8 + $skor9;

        if ($totalSkor >= 10) {
            $tingkatRisiko = 'RISIKO TINGGI';
            $interval = 'Pengawasan tiap 1 jam';
        } elseif ($totalSkor >= 4 && $totalSkor <= 9) {
            $tingkatRisiko = 'RISIKO SEDANG';
            $interval = 'Pengawasan tiap 2 - 7 jam';
        } else {
            $tingkatRisiko = 'RISIKO RENDAH';
            $interval = 'Pengawasan tiap 8 jam';
        }
    @endphp
    <div class="isi-surat">
        <!-- Header Dokumen RM -->
        <table style="width: 100%" class="mb-1">
            <tr>
                <td>
                    <p class="float-right text-bold mb-0" style="font-size: 10px;margin-top:5px">RM. 03.08-RJ/26</p>
                </td>
            </tr>
        </table>

        <!-- Kop & Data Pasien -->
        <table class="table table-sm table-bordered text-bold mb-2" style="width: 100%; table-layout: fixed;">
            <tr>
                <td class="text-center" style="width: 45%; vertical-align: middle; padding: 8px;" colspan="1">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo mb-1"
                        style="display: block; margin: 0 auto;">
                    <div class="instansi2">PEMERINTAH KABUPATEN CIREBON</div>
                    <div class="instansi2 mb-1">RUMAH SAKIT UMUM DAERAH WALED</div>
                    <div class="instansi3">
                        Jl. Prabu Kian Santang No. 4 Waled <br>
                        Telp. (0231) 661126 Email: brsud.waled@gmail.com
                    </div>
                </td>
                <td style="width: 55%; vertical-align: middle; padding: 8px;" colspan="2">
                    <table style="width: 100%; font-size: 10px; font-weight: normal;">
                        <tr>
                            <td style="width: 35%; padding: 2px 0;">Nomor RM</td>
                            <td style="width: 5%; padding: 2px 0;">:</td>
                            <td style="width: 60%; padding: 2px 0;" class="text-bold">{{ $mt_pasien[0]->no_rm ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Nama Pasien</td>
                            <td>:</td>
                            <td style="padding: 2px 0;" class="text-bold">{{ $mt_pasien[0]->nama_px ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Tanggal Lahir</td>
                            <td>:</td>
                            <td style="padding: 2px 0;">{{ $mt_pasien[0]->tgl_lahirs ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0;">Jenis Kelamin</td>
                            <td>:</td>
                            <td style="padding: 2px 0;">
                                @if (strtoupper($mt_pasien[0]->jenis_kelamin ?? '') == 'L')
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
                <td colspan="3" class="text-center text-bold bg-secondary" style="padding: 4px; font-size: 12px;">
                    ASESMEN KHUSUS RISIKO BUNUH DIRI ( INPATIENT SUICIDE / SELF-HARM ASSESMENT )
                </td>
            </tr>
        </table>

        <!-- Metadata Asesmen -->
        <table style="width: 100%; font-size: 10px;" class="mb-2">
            <tr>
                <td style="width: 18%;">Tanggal Asesmen</td>
                <td style="width: 2%;">:</td>
                <td style="width: 30%;">{{ $assesmen->tgl_entry ?? date('d-m-Y H:i') }} WIB</td>
                <td style="width: 15%;">Ruangan / Unit</td>
                <td style="width: 2%;">:</td>
                <td style="width: 33%;">{{ $assesmen2[0]->unit_konsul ?? '-' }}</td>
            </tr>
            <tr>
                {{-- <td>Petugas Evaluator</td>
                <td>:</td>
                <td>{{ $assesmen->nama_petugas ?? '-' }}</td> --}}
                <td>DPJP</td>
                <td>:</td>
                <td>{{ $assesmen2[0]->nama_dokter ?? '-' }}</td>
            </tr>
        </table>
        <table class="table table-bordered align-middle mb-2">
            <tbody>
                <tr>
                    <td style="width: 70%; font-weight: bold;" class="text-left align-middle">
                        Apakah pengobatan yang sekarang diakibatkan karena percobaan bunuh diri?
                    </td>
                    <td style="width: 30%;" class="text-center align-middle">
                        <!-- Tampilan Hasil Cetak (Print / PDF) -->
                        <div class="print-only font-weight-bold">
                            @if (($assesmen->q_skrining ?? '1') == '2')
                                <span class="text-danger">[V] Ya, Skor 2</span> &nbsp;&nbsp; <span class="text-muted">[ &nbsp; ]
                                    Tidak</span>
                                <div class="small text-muted mt-1">(Skor: 2)</div>
                            @else
                                <span class="text-muted">[ &nbsp; ] Ya</span> &nbsp;&nbsp; <span>[V] Tidak, Skor 1</span>
                                <div class="small text-muted mt-1">(Skor: 1)</div>
                            @endif
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead>
                    <tr class="bg-light">
                        <th style="width: 20%;" class="text-center font-weight-bold">I. Faktor Kunci</th>
                        <th style="width: 10%;" class="text-center font-weight-bold">Skor Poin</th>
                        <th style="width: 55%;" class="text-center font-weight-bold">Indikator</th>
                        <th style="width: 15%;" class="text-center font-weight-bold">Skor Terpilih</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Pertanyaan 1 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">1. Komitmen Untuk
                            Keselamatan</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan1 ?? '') == '2' ? '[V]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Menolak membuat komitmen/tidak mampu membuat komitmen
                                karena ketidakmampuan menilai (Halusinasi, delusi, demensia, delirium,
                                disosiasi)</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan1 }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan1 ?? '') == '1' ? '[V]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Mampu membuat komitmen tapi ragu - ragu dalam
                                membuatnya</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan1 ?? '0') == '0' ? '[V]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Mampu membuat komitmen untuk keselamatan dengan
                                jelas</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 2 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">2. Rencana Bunuh Diri</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan2 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Merencanakan secara aktual ide bunuh diri dan sudah
                                mengungkapkan metode/cara bunuh diri</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan2 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan2 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Merencanakan secara aktual ide bunuh diri tapi belum
                                ada cara bunuh diri</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan2 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Tidak ada rencana</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 3 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">3. Rencana Yang Mematikan
                            (Totalitas Rencana)</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan3 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Letalitas rencana yang tinggi (dengan senapan,
                                gantung diri, melompat tebing, karbon monoksida)</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan3 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan3 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Letalitas rencana yang sedang (dengan pil tidur,
                                overdosis, aspirin, dan barbiturat)</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan3 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Letalitas rencana yang rendah (menggarukkan kuku ke
                                kulit, membenturkan kepala ke pintu, mengancam dengan benda tajam, menutup kepala dengan
                                bantal)</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 4 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">4. Riwayat Percobaan Bunuh
                            Diri (Tidak Dibatasi Waktu)</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan4 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Riwayat percobaan dengan letalitas tinggi</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan4 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan4 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Riwayat percobaan dengan letalitas sedang</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan4 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Tidak ada riwayat percobaan</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 5 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">5. Ide Bunuh Diri</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan5 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Pikiran bunuh diri terus menerus</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan5 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan5 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Pikiran bunuh diri sesekali atau singkat</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan5 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Tidak ada pikiran bunuh diri</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 6 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">6. Gejala (a. Putus asa,
                            b. Tidak berdaya, c. Anhedonia, d. Rasa bersalah/malu, e. Kemarahan, f. Impulsivitas)</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan6 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Terdapat 5-6 gejala</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan6 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan6 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Terdapat 3-4 gejala</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan6 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Terdapat 0 - 2 gejala</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 7 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">7. Pikiran Kematian Saat
                            Ini (Berfantasi yang berlebihan, selalu berbicara tentang kematian)</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan7 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Terus menerus</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan7 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan7 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Sering</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan7 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Jarang</label>
                        </td>
                    </tr>

                    <!-- Pertanyaan 8 -->
                    <tr>
                        <td colspan="4" class="bg-light font-weight-bold text-uppercase">8. Penilaian Pemeriksaan
                            Terhadap Validasi Jawaban Pasien</td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Tinggi</td>
                        <td class="text-center align-middle">2</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan8 ?? '') == '2' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Jawaban tidak dapat dipercaya tetapi beberapa syarat
                                menunjukan perilaku resiko bunuh diri ditemukan</label>
                        </td>
                        <td rowspan="3" class="text-center align-middle font-weight-bold h5">
                            {{ $assesmen->pertanyaan8 ?? '0' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Risiko Sedang</td>
                        <td class="text-center align-middle">1</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan8 ?? '') == '1' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Jawaban atas pertanyaan pasien bisa dipercaya,
                                terdapat sedikitnya isyarat risiko bunuh diri</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left align-middle">Tidak ada risiko</td>
                        <td class="text-center align-middle">0</td>
                        <td class="text-left align-middle">
                            <span
                                class="checkbox-symbol">{{ ($assesmen->pertanyaan8 ?? '0') == '0' ? '[✔]' : '[  ]' }}</span>
                            <label class="mb-0 font-weight-normal">Jawaban pasien dapat dipercaya</label>
                        </td>
                    </tr>

                    <!-- Baris Total Skor -->
                    @php
                        $totalSkor =
                            ($assesmen->pertanyaan1 ?? 0) +
                            ($assesmen->pertanyaan2 ?? 0) +
                            ($assesmen->pertanyaan3 ?? 0) +
                            ($assesmen->pertanyaan4 ?? 0) +
                            ($assesmen->pertanyaan5 ?? 0) +
                            ($assesmen->pertanyaan6 ?? 0) +
                            ($assesmen->pertanyaan7 ?? 0) +
                            ($assesmen->pertanyaan8 ?? 0) +
                            ($assesmen->q_skrining ?? 0);
                    @endphp
                    <tr class="bg-light">
                        <td colspan="3" class="text-right font-weight-bold align-middle">TOTAL SKOR KESELURUHAN :
                        </td>
                        <td class="text-center font-weight-bold h4 mb-0 align-middle">{{ $totalSkor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Ringkasan Hasil & Intervensi -->
        <table class="table table-bordered mb-2" style="width: 100%;">
            <tr class="bg-light">
                <td colspan="2" class="text-bold" style="font-size: 11px;">KESIMPULAN & TINGKAT RISIKO</td>
            </tr>
            <tr>
                <td style="width: 40%; vertical-align: middle;" class="text-center">
                    <div>TOTAL SKOR</div>
                    <div style="font-size: 22px; font-weight: bold; margin: 4px 0;">{{ $totalSkor }}</div>
                    <div class="badge-risiko">{{ $tingkatRisiko }}</div>
                </td>
                <td style="width: 60%; vertical-align: top;">
                    <strong>Rekomendasi Rencana Keperawatan:</strong>
                    <ul style="margin-top: 5px; margin-bottom: 0; padding-left: 18px;">
                        <li><strong>Interval Pengawasan:</strong> {{ $interval }}</li>
                        <li>Pastikan lingkungan aman dari benda tajam, tali, atau obat berlebih.</li>
                        <li>Lakukan edukasi keamanan pada keluarga / penunggunya.</li>
                    </ul>
                </td>
            </tr>
        </table>

        <!-- Area TTD & QR TTE -->
        <table style="width: 100%; margin-top: 15px;">
            <tr>
                <td style="width: 55%; vertical-align: top;">
                    <small> Catatan Tambahan Evaluator: </small><br>
                    <div
                        style="border: 1px solid #ccc; min-height: 50px; padding: 4px; font-size: 9px; margin-top: 3px;">
                        {!! nl2br(e($assesmen->catatan_tambahan ?? 'Tidak ada catatan khusus.')) !!}
                    </div>
                </td>
                <td style="width: 45%; text-align: center; vertical-align: top;">
                    <span>Cirebon,
                        {{ \Carbon\Carbon::parse($assesmen->tgl_entry ?? now())->translatedFormat('d F Y') }}</span><br>
                    <span>DPJP,</span><br>

                    <!-- QR Code TTE -->
                    <div style="width: 85px; height: 85px; margin: 4px auto; text-align: center;">
                        @if (!empty($qrjawab))
                            <img src="data:image/svg+xml;base64,{{ $qrjawab }}"
                                style="width: 85px; height: 85px; display: block;" alt="QR Code TTE">
                        @else
                            <div style="height: 85px; border: 1px dashed #ccc; line-height: 85px;" class="text-muted">
                                TTE / TTD</div>
                        @endif
                    </div>

                    <strong style="text-decoration: underline;">
                        ({{ $assesmen2[0]->nama_dokter ?? '.........................................' }})
                    </strong><br>
                    {{-- <small>NIP/NIK: {{ $assesmen->nip_petugas ?? '-' }}</small> --}}
                </td>
            </tr>
        </table>
    </div>

    <footer>
        <div class="text-xxxs font-italic" id="footer">
            Dokumen ini dicetak secara otomatis melalui Sistem Informasi Manajemen RSUD Waled Cirebon.
        </div>
    </footer>
    <script type="text/php">
        if ( isset($pdf) ) {
            $x = 72;
            $y = 765;
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle = 0.0;
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
