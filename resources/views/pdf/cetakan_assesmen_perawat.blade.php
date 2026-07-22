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
            margin-top: 20px;
            margin-bottom: 30px;
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
    </style>
    <style>
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
</head>

<body>
    <div class="isi-surat">
        <table class="mb-2" style="width: 100%">
            <tr>
                <td>
                    <p class="float-right text-bold mb-0" style="font-size: 11px; font-weight: bold;">RM. 07.02-RJ/25
                    </p>
                </td>
            </tr>
        </table>
        <table class="table table-sm table-bordered text-bold font-italic align-middle"
            style="width: 100%; border-collapse: collapse; margin-top: 0;">
            <tr>
                <td style="width: 45%; padding: 10px; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo"
                        style="max-height: 60px; margin-bottom: 5px; display: inline-block;">

                    <div class="instansi2" style="font-size: 11px; line-height: 1.2; font-weight: bold; color: #000;">
                        PEMERINTAH KABUPATEN CIREBON
                    </div>
                    <div class="instansi2"
                        style="font-size: 13px; line-height: 1.2; font-weight: bold; margin-bottom: 3px; color: #000;">
                        RUMAH SAKIT UMUM DAERAH WALED
                    </div>
                    <div class="instansi3" style="font-size: 9px; font-weight: normal; line-height: 1.3; color: #555;">
                        Jl. Prabu Kian Santang No. 4 Waled <br>
                        Telp.(0231)661126 Email: brsud.waled@gmail.com
                    </div>
                </td>
                <td style="width: 55%; padding: 8px; vertical-align: middle;">
                    <table style="width: 100%; font-size: 11px; border: none;">
                        <tr>
                            <td style="width: 35%; padding: 2px 0; border: none;">Nomor RM</td>
                            <td style="width: 5%; padding: 2px 0; border: none;">:</td>
                            <td style="width: 60%; padding: 2px 0; border: none; font-weight: bold;">
                                {{ $mt_pasien[0]->no_rm }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0; border: none;">Nama Pasien</td>
                            <td style="padding: 2px 0; border: none;">:</td>
                            <td style="padding: 2px 0; border: none; font-weight: bold;">
                                {{ strtoupper($mt_pasien[0]->nama_px) }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0; border: none;">Tanggal Lahir</td>
                            <td style="padding: 2px 0; border: none;">:</td>
                            <td style="padding: 2px 0; border: none;">{{ $mt_pasien[0]->tgl_lahirs }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 2px 0; border: none;">Jenis Kelamin</td>
                            <td style="padding: 2px 0; border: none;">:</td>
                            <td style="padding: 2px 0; border: none;">
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
                <td colspan="2" class="text-center text-bold bg-success text-white py-2"
                    style="font-size: 14px; background-color: #7c8e86 !important; color: #fff !important; font-weight: bold;">
                    ASSESMEN KEPERAWATAN RAWAT JALAN
                </td>
            </tr>

            <tr style="font-size: 11px;">
                <td style="padding: 6px 10px; width: 45%;">
                    POLIKLINIK: <span style="font-weight: bold;">{{ strtoupper($ts_kunjungan[0]->nama_unit) }}</span>
                </td>
                <td style="padding: 6px 10px; width: 55%;">
                    <table style="width: 100%; border: none; margin: 0; padding: 0;">
                        <tr>
                            <td style="border: none; padding: 0;">Tgl Kunjungan: <span
                                    style="font-weight: bold;">{{ $tglperiksa }}</span></td>
                            <td style="border: none; padding: 0; text-align: right;">Tgl Pengkajian: <span
                                    style="font-weight: bold;">{{ $tglperiksa2 }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        @foreach ($assesmen as $k)
            @if ($k->kode_unit != '1028')
                <table class="table table-sm table-bordered align-middle"
                    style="width: 100%; border-collapse: collapse; font-size: 11px; color: #000; margin-top: 15px;">
                    <tr>
                        <td style="width: 25%; padding: 5px 8px; font-weight: bold; background-color: #f8f9fa;">Sumber
                            Data</td>
                        <td colspan="3" style="padding: 5px 8px;">{{ $k->sumberdataperiksa }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keluhan Utama</td>
                        <td colspan="3" style="padding: 5px 8px;">{{ $k->keluhanutama }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Tekanan Darah</td>
                        <td style="width: 25%; padding: 5px 8px;">{{ $k->tekanandarah }} <span
                                style="color: #555;">mmHg</span></td>
                        <td style="width: 15%; font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">
                            Frekuensi Nadi</td>
                        <td style="width: 35%; padding: 5px 8px;">{{ $k->frekuensinadi }} <span
                                style="color: #555;">x/menit</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Frekuensi Napas
                        </td>
                        <td style="padding: 5px 8px;">{{ $k->frekuensinapas }} <span
                                style="color: #555;">x/menit</span></td>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Suhu</td>
                        <td style="padding: 5px 8px;">{{ $k->suhutubuh }} <span style="color: #555;">°C</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Berat Badan</td>
                        <td style="width: 25%; padding: 5px 8px;">{{ $k->beratbadan }} <span
                                style="color: #555;"></span></td>
                        <td style="width: 15%; font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">
                            Tinggi Badan</td>
                        <td style="width: 35%; padding: 5px 8px;">{{ $k->tinggibadan }} <span
                                style="color: #555;"></span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">IMT</td>
                        <td colspan="3" style="padding: 5px 8px;">{{ $k->imt }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Umur</td>
                        <td colspan="3" style="padding: 5px 8px;">
                            @php
                                $birthDate = \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahirs);
                                $now = \Carbon\Carbon::now();
                                $years = $birthDate->diffInYears($now);
                                $months = $birthDate->diffInMonths($now->copy()->subYears($years));
                                $days = $birthDate->diffInDays($now->copy()->subYears($years)->subMonths($months));
                            @endphp
                            {{ $years }} Tahun, {{ $months }} Bulan, {{ $days }} Hari
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Riwayat Psikologis
                        </td>
                        <td style="padding: 5px 8px;">{{ $k->Riwayatpsikologi }}</td>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keterangan</td>
                        <td style="padding: 5px 8px;">{{ $k->keterangan_riwayat_psikolog }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"
                            style="background-color: #e9ecef; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px;">
                            Status Fungsional
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Penggunaan Alat
                            Bantu</td>
                        <td style="padding: 5px 8px;">{{ $k->penggunaanalatbantu }}</td>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keterangan</td>
                        <td style="padding: 5px 8px;">{{ $k->keterangan_alat_bantu }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Cacat Tubuh</td>
                        <td style="padding: 5px 8px;">{{ $k->cacattubuh }}</td>
                        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keterangan</td>
                        <td style="padding: 5px 8px;">{{ $k->keterangancacattubuh }}</td>
                    </tr>
                    @if ($usiatahun >= 0 && $usiatahun <= 3 && $usia_hari > 30)
                        <tr>
                            <td colspan="4"
                                style="background-color: #ffc107; color: #000; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px;">
                                Assesmen Nyeri (Metode FLACC Scale - Pasien 1 - 3 Tahun)
                            </td>
                        </tr>
                        <!-- KRITERIA: FACE -->
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Face (Wajah)</td>
                            <td colspan="3" style="padding: 6px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Face" id="face_0" value="Tidak ada"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->face == 'Tidak ada') checked @endif>
                                    <label for="face_0"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 0:
                                        Tidak ada ekspresi khusus, senyum</label>
                                </div>
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Face" id="face_1"
                                        value="Menyeringai,Mengerutkan dahi, tampak tidak tertarik ( kadang - kadang )"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->face == 'Menyeringai,Mengerutkan dahi, tampak tidak tertarik ( kadang - kadang )') checked @endif>
                                    <label for="face_1"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 1:
                                        Menyeringai, mengerutkan dahi, tampak tidak tertarik (kadang-kadang)</label>
                                </div>
                                <div>
                                    <input type="radio" name="Face" id="face_2"
                                        value="Dagu gemetar,gerutu,berulang ( sering )"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->face == 'Dagu gemetar,gerutu,berulang ( sering )') checked @endif>
                                    <label for="face_2"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 2:
                                        Dagu gemetar, gerutu berulang (sering)</label>
                                </div>
                            </td>
                        </tr>

                        <!-- KRITERIA: LEG -->
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Leg (Kaki)</td>
                            <td colspan="3" style="padding: 6px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Leg" id="leg_0"
                                        value="Posisi normal atau santai"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->leg == 'Posisi normal atau santai' || $k->leg == 'Tidak ada') checked @endif>
                                    <label for="leg_0"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 0:
                                        Posisi normal atau santai</label>
                                </div>
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Leg" id="leg_1" value="Gelisah,tegang"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->leg == 'Gelisah,tegang') checked @endif>
                                    <label for="leg_1"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 1:
                                        Gelisah, tegang</label>
                                </div>
                                <div>
                                    <input type="radio" name="Leg" id="leg_2"
                                        value="Menendang, kaki tertekuk"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->leg == 'Menendang, kaki tertekuk') checked @endif>
                                    <label for="leg_2"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 2:
                                        Menendang atau kaki tertekuk</label>
                                </div>
                            </td>
                        </tr>

                        <!-- KRITERIA: ACTIVITY -->
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Activity (Aktivitas)</td>
                            <td colspan="3" style="padding: 6px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Activity" id="act_0"
                                        value="Berbaring tenang,posisi normal, gerakan mudah"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Activity == 'Berbaring tenang,posisi normal, gerakan mudah' || $k->Activity == 'Tidak ada') checked @endif>
                                    <label for="act_0"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 0:
                                        Berbaring tenang, posisi normal, gerakan mudah</label>
                                </div>
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Activity" id="act_1"
                                        value="Menggeliat, tidak bisa diam, tegang"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Activity == 'Menggeliat, tidak bisa diam, tegang') checked @endif>
                                    <label for="act_1"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 1:
                                        Menggeliat, tidak bisa diam, tegang</label>
                                </div>
                                <div>
                                    <input type="radio" name="Activity" id="act_2" value="Kaku atau tegang"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Activity == 'Kaku atau tegang') checked @endif>
                                    <label for="act_2"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 2:
                                        Posisi kaku atau tegang (fleksi ekstrem)</label>
                                </div>
                            </td>
                        </tr>

                        <!-- KRITERIA: CRY -->
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Cry (Menangis)</td>
                            <td colspan="3" style="padding: 6px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Cry" id="cry_0" value="Tidak menangis"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Cry == 'Tidak menangis' || $k->Cry == 'Tidak ada') checked @endif>
                                    <label for="cry_0"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 0:
                                        Tidak menangis (terjaga atau tertidur)</label>
                                </div>
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Cry" id="cry_1"
                                        value="Merintih, merengek,kadang - kadang mengeluh "
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Cry == 'Merintih, merengek,kadang - kadang mengeluh ') checked @endif>
                                    <label for="cry_1"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 1:
                                        Merintih, merengek, kadang-kadang mengeluh</label>
                                </div>
                                <div>
                                    <input type="radio" name="Cry" id="cry_2"
                                        value="Terus menanis atau teriak"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Cry == 'Terus menanis atau teriak') checked @endif>
                                    <label for="cry_2"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 2:
                                        Terus menangis, menjerit, atau teriak</label>
                                </div>
                            </td>
                        </tr>

                        <!-- KRITERIA: CONSOLABILITY -->
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Consolability</td>
                            <td colspan="3" style="padding: 6px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Consolabity" id="cons_0" value="Rileks"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Consolabity == 'Rileks' || $k->Consolabity == 'Tidak ada') checked @endif>
                                    <label for="cons_0"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 0:
                                        Tenang, rileks</label>
                                </div>
                                <div style="margin-bottom: 5px;">
                                    <input type="radio" name="Consolabity" id="cons_1"
                                        value="Dapat ditenangkan dengan sentuhan pelukan, bujukan, dialihkan"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Consolabity == 'Dapat ditenangkan dengan sentuhan pelukan, bujukan, dialihkan') checked @endif>
                                    <label for="cons_1"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 1:
                                        Dapat ditenangkan dengan sentuhan, pelukan, atau dialihkan</label>
                                </div>
                                <div>
                                    <input type="radio" name="Consolabity" id="cons_2"
                                        value="Sering mengeluh,sulit dibujuk"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        @if ($k->Consolabity == 'Sering mengeluh,sulit dibujuk') checked @endif>
                                    <label for="cons_2"
                                        style="font-weight: normal; display: inline; vertical-align: middle;">Skor 2:
                                        Sulit ditenangkan dengan pelukan atau bujukan</label>
                                </div>
                            </td>
                        </tr>
                    @elseif($usia_hari < 30)
                        <tr>
                            <td colspan="4" class="bg-light text-center text-white font-weight-bold">Assesmen
                                Nyeri - Metode NIPS (Pasien
                                bayi baru lahir - 30 hari)</td>
                        </tr>
                        <tr>
                            <td>Ekspresi wajah</td>
                            <td colspan="3" style="padding: 5px 8px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ekspresiwajah"
                                        id="ekspresiwajah_rileks" value="Rileks"
                                        @if ($k->ekspresiwajah == 'Rileks') checked @endif>
                                    <label class="form-check-label" for="ekspresiwajah_rileks">Rileks</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ekspresiwajah"
                                        id="ekspresiwajah_meringis" value="Meringis"
                                        @if ($k->ekspresiwajah == 'Meringis') checked @endif>
                                    <label class="form-check-label" for="ekspresiwajah_meringis">Meringis</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Menangis</td>
                            <td colspan="3" style="padding: 5px 8px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Menangis"
                                        id="menangis_tidak" value="Tidak menangis"
                                        @if ($k->menangis == 'Tidak menangis') checked @endif>
                                    <label class="form-check-label" for="menangis_tidak">Tidak menangis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Menangis"
                                        id="menangis_meringis" value="Meringis"
                                        @if ($k->menangis == 'Meringis') checked @endif>
                                    <label class="form-check-label" for="menangis_meringis">Meringis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Menangis"
                                        id="menangis_keras" value="Menangis keras"
                                        @if ($k->menangis == 'Menangis keras') checked @endif>
                                    <label class="form-check-label" for="menangis_keras">Menangis keras</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Pola nafas</td>
                            <td colspan="3" style="padding: 5px 8px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="polanafas"
                                        id="polanafas_rileks" value="Rileks"
                                        @if ($k->polanafas == 'Rileks') checked @endif>
                                    <label class="form-check-label" for="polanafas_rileks">Rileks</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="polanafas"
                                        id="polanafas_perubahan" value="Perubahan pola nafas"
                                        @if ($k->polanafas == 'Perubahan pola nafas') checked @endif>
                                    <label class="form-check-label" for="polanafas_perubahan">Perubahan pola
                                        nafas</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Lengan</td>
                            <td colspan="3" style="padding: 5px 8px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Lengan" id="lengan_rileks"
                                        value="Rileks" @if ($k->lengan == 'Rileks') checked @endif>
                                    <label class="form-check-label" for="lengan_rileks">Rileks</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Lengan" id="lengan_fleksi"
                                        value="Fleksi" @if ($k->lengan == 'Fleksi') checked @endif>
                                    <label class="form-check-label" for="lengan_fleksi">Fleksi</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Kaki</td>
                            <td colspan="3" style="padding: 5px 8px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Kaki" id="kaki_rileks"
                                        value="Rileks" @if ($k->kaki == 'Rileks') checked @endif>
                                    <label class="form-check-label" for="kaki_rileks">Rileks</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Kaki" id="kaki_fleksi"
                                        value="Fleksi" @if ($k->kaki == 'Fleksi') checked @endif>
                                    <label class="form-check-label" for="kaki_fleksi">Fleksi</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Keadaan terangsang</td>
                            <td colspan="3" style="padding: 5px 8px;">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Keadaan_terangsang"
                                        id="terangsang_strip" value="-"
                                        @if ($k->keadaanterangsang == '-') checked @endif>
                                    <label class="form-check-label" for="terangsang_strip">-</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Keadaan_terangsang"
                                        id="terangsang_tidur" value="Tidur"
                                        @if ($k->keadaanterangsang == 'Tidur') checked @endif>
                                    <label class="form-check-label" for="terangsang_tidur">Tidur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Keadaan_terangsang"
                                        id="terangsang_bangun" value="Bangun"
                                        @if ($k->keadaanterangsang == 'Bangun') checked @endif>
                                    <label class="form-check-label" for="terangsang_bangun">Bangun</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="Keadaan_terangsang"
                                        id="terangsang_rewel" value="Rewel"
                                        @if ($k->keadaanterangsang == 'Rewel') checked @endif>
                                    <label class="form-check-label" for="terangsang_rewel">Rewel</label>
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4"
                                style="background-color: #e9ecef; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px;">
                                Assesmen Nyeri
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keluhan Nyeri
                            </td>
                            <td style="padding: 5px 8px;">{{ $k->Keluhannyeri }}</td>
                            <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Skala Nyeri
                            </td>
                            <td style="padding: 5px 8px;">{{ $k->skalenyeripasien }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td colspan="4"
                            style="background-color: #e9ecef; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px;">
                            Assesmen Resiko Jatuh
                        </td>
                    </tr>
                    @if ($usia_hari >= 4383)
                        <tr class="bg-light">
                            <td colspan="4" class="text-center text-bold font-italic">Metode Up and Go
                            </td>
                        </tr>
                        <tr>
                            <td>Faktor Resiko</td>
                            <td colspan="3">Skala</td>
                        </tr>
                        <tr>
                            <td>a</td>
                            <td colspan="3">Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien
                                tampak tidak seimbang
                                (
                                sempoyongan / limbung ) ?</td>
                        </tr>
                        <tr>
                            <td>b</td>
                            <td colspan="3">Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                                penopang saat akan
                                duduk ?</td>
                        </tr>
                        <tr class="bg-light">
                            <td colspan="4" class="text-center text-bold font-italic">Hasil</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="resikojatuh"
                                        id="resikojatuh" value="Tidak Beresiko"
                                        @if ($k->resikojatuh == 'Tidak Beresiko') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Tidak Beresiko (
                                        Tidak ditemukan a
                                        dan
                                        b )</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="resikojatuh"
                                        id="resikojatuh" value="Risiko Rendah"
                                        @if ($k->resikojatuh == 'Risiko Rendah') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1"> Risiko rendah (
                                        ditemukan a atau
                                        b)
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="resikojatuh"
                                        id="resikojatuh" value="Risiko Tinggi"
                                        @if ($k->resikojatuh == 'Risiko Tinggi') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1"> Risiko tinggi ( a
                                        dan b ditemukan
                                        )
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Pendampingan</td>
                            <td colspan="3" style="padding: 8px 12px;">
                                <div style="display: block; margin-bottom: 2px;">
                                    <input type="checkbox"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        id="pendampinganpasien" name="pendampinganpasien"
                                        @if ($k->pendampinganpasien == 1) checked @endif>
                                    <label style="font-weight: bold; display: inline; vertical-align: middle;"
                                        for="pendampinganpasien">Memberikan pendampingan khusus atau menyediakan alat
                                        bantu
                                        jalan
                                        (Kursi Roda / Tongkat)
                                        bagi yang membutuhkan.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Edukasi Pasien & Keluarga</td>
                            <td colspan="3" style="padding: 8px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="checkbox"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        id="edukasipasien1" name="edukasipasien1"
                                        @if ($k->edukasipasien1 == 1) checked @endif>
                                    <label style="font-weight: normal; display: inline; vertical-align: middle;"
                                        for="edukasipasien1">Mengajarkan cara penggunaan alat bantu dan mengunci rem
                                        kursi
                                        roda.</label>
                                </div>
                                <div>
                                    <input type="checkbox"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        id="edukasipasien2" name="edukasipasien2"
                                        @if ($k->edukasipasien2 == 1) checked @endif>
                                    <label style="font-weight: normal; display: inline; vertical-align: middle;"
                                        for="edukasipasien2">Memastikan alas kaki yang digunakan aman, nyaman dan tidak
                                        licin.</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
                                Manajemen Lingkungan</td>
                            <td colspan="3" style="padding: 8px 12px;">
                                <div style="margin-bottom: 5px;">
                                    <input type="checkbox"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        id="edukasipasien3" name="edukasipasien3"
                                        @if ($k->edukasipasien3 == 1) checked @endif>
                                    <label style="font-weight: normal; display: inline; vertical-align: middle;"
                                        for="edukasipasien3">Membantu memindahkan pasien ke area tunggu yang aman,
                                        dekat
                                        dengan pos perawat (*nurse station*).</label>
                                </div>
                                <div>
                                    <input type="checkbox"
                                        style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                                        id="edukasipasien4" name="edukasipasien4"
                                        @if ($k->edukasipasien4 == 1) checked @endif>
                                    <label style="font-weight: normal; display: inline; vertical-align: middle;"
                                        for="edukasipasien4">Memastikan pencahayaan ruang poli cukup dan lantai tidak
                                        basah.</label>
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="4" class="bg-light">Metode Humpty Dumpty</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umur"
                                        value="Dibawah 3 tahun" @if ($k->umur == 'Dibawah 3 tahun') checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Dibawah 3 tahun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umur"
                                        value="3 - 7 tahun" @if ($k->umur == '3 - 7 tahun') checked @endif>
                                    <label class="form-check-label" for="exampleRadios2">
                                        3 - 7 tahun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umur"
                                        value="7 - 13 tahun" @if ($k->umur == '7 - 13 tahun') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        7 - 13 tahun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umur"
                                        value="Lebih dari 13 tahun" @if ($k->umur == 'Tidak Lebih dari 13 tahun') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Lebih dari 13 tahun
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="umur" id="umur"
                                        value="-" @if ($k->umur == '-') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        -
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jeniskelamin"
                                        id="jeniskelamin" value="Laki - Laki"
                                        @if ($k->jeniskelamin == 'Laki - Laki') checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Laki - Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jeniskelamin"
                                        id="jeniskelamin" value="Perempuan"
                                        @if ($k->jeniskelamin == 'Perempuan') checked @endif>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jeniskelamin"
                                        id="jeniskelamin" value="-"
                                        @if ($k->jeniskelamin == '-') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        -
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosis</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="diagnosis" id="diagnosis"
                                        value="Gangguan neurologis" @if ($k->diagnosis == 'Gangguan neurologis') checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Gangguan neurologis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="diagnosis" id="diagnosis"
                                        value="Perubahan dalam oksigenasi ( masalah saluran napas,dehidrasi,anemia,anorexia,sinkop,sakit kepala,dll )"
                                        @if (
                                            $k->diagnosis ==
                                                'Perubahan dalam oksigenasi ( masalah saluran napas,dehidrasi,anemia,anorexia,sinkop,sakit kepala,dll )') checked @endif>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Perubahan dalam oksigenasi ( masalah saluran
                                        napas,dehidrasi,anemia,anorexia,sinkop,sakit kepala,dll )
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="diagnosis" id="diagnosis"
                                        value="Kelainan psikis / perilaku"
                                        @if ($k->diagnosis == 'Kelainan psikis / perilaku') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Kelainan psikis / perilaku
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="diagnosis" id="diagnosis"
                                        value="Diagnosis lainnya" @if ($k->diagnosis == 'Diagnosis lainnya') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Diagnosis lainnya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="diagnosis" id="diagnosis"
                                        value="-" @if ($k->diagnosis == '-') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        -
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Gangguan Kognitif</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                        id="Gangguan_Kognitif" value="Tidak menyadari keterbatasan diri"
                                        @if ($k->gangguankoginitf == 'Tidak menyadari keterbatasan diri') checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Tidak menyadari keterbatasan diri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                        id="Gangguan_Kognitif" value="Lupa adanya keterbatasan"
                                        @if ($k->gangguankoginitf == 'Lupa adanya keterbatasan') checked @endif>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Lupa adanya keterbatasan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                        id="Gangguan_Kognitif" value="Orientasi baik terhadap diri sendiri"
                                        @if ($k->gangguankoginitf == 'Orientasi baik terhadap diri sendiri') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Orientasi baik terhadap diri sendiri
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                        id="Gangguan_Kognitif" value="-"
                                        @if ($k->gangguankoginitf == '-') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        -
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Faktor Lingkungan</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                        id="Faktor_Lingkungan"
                                        value="Riwayat jatuh dari tempat tidur saat bayi / anak"
                                        @if ($k->faktorlingkungan == 'Riwayat jatuh dari tempat tidur saat bayi / anak') checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Riwayat jatuh dari tempat tidur saat bayi / anak
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                        id="Faktor_Lingkungan" value="Pasien menggunakan alat bantu atau box mebel"
                                        @if ($k->faktorlingkungan == 'Pasien menggunakan alat bantu atau box mebel') checked @endif>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Pasien menggunakan alat bantu atau box mebel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                        id="Faktor_Lingkungan" value="Pasien diletakan ditempat tidur"
                                        @if ($k->faktorlingkungan == 'Pasien diletakan ditempat tidur') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Pasien diletakan ditempat tidur
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                        id="Faktor_Lingkungan" value="Diluar ruang rawat"
                                        @if ($k->faktorlingkungan == 'Diluar ruang rawat') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        Diluar ruang rawat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                        id="Faktor_Lingkungan" value="-"
                                        @if ($k->faktorlingkungan == '-') checked @endif>
                                    <label class="form-check-label" for="exampleRadios3">
                                        -
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Respon terhadap operasi / obat penenang / efek anestersi</td>
                            <td colspan="3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respon_thd_op"
                                        id="respon_thd_op" value="Dalam 24 Jam"
                                        @if ($k->responterhadapoperasi == 'Dalam 24 Jam') checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Dalam 24 Jam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respon_thd_op"
                                        id="respon_thd_op" value="Dalam 48 jam"
                                        @if ($k->responterhadapoperasi == 'Dalam 48 jam') checked @endif>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Dalam 48 jam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="respon_thd_op"
                                        id="respon_thd_op" value="> 48 Jam" @if ($k->responterhadapoperasi == '> 48 Jam')
                                    checked
                    @endif>
                    <label class="form-check-label" for="exampleRadios3">> 48 Jam</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="respon_thd_op" id="respon_thd_op" value="-"
            @if ($k->responterhadapoperasi == '-') checked @endif>
        <label class="form-check-label" for="exampleRadios3">
            -
        </label>
    </div>
    </td>
    </tr>
    <tr>
        <td>Penggunaan Obat</td>
        <td colspan="3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Penggunaan_Obat" id="Penggunaan_Obat"
                    value="Bermacam obat yang digunakan : obat sedative ( Kecuali pasien icu,yang menggunakan sedasi dan paralisis ),hipnotik,barbiturate,fenotiazen, antidepresan,laksatif/diuretik,narkotik."
                    @if (
                        $k->penggunaanobat ==
                            'Bermacam obat yang digunakan : obat sedative ( Kecuali pasien icu,yang menggunakan sedasi dan paralisis ),hipnotik,barbiturate,fenotiazen, antidepresan,laksatif/diuretik,narkotik.') checked @endif>
                <label class="form-check-label" for="exampleRadios1">
                    Bermacam obat yang digunakan : obat sedative ( Kecuali pasien icu,
                    yang menggunakan sedasi dan paralisis ),hipnotik,barbiturate,
                    fenotiazen, antidepresan,laksatif/diuretik,narkotik.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Penggunaan_Obat" id="Penggunaan_Obat"
                    value="Penggunaan salah satu obat diatas" @if ($k->penggunaanobat == 'Penggunaan salah satu obat diatas') checked @endif>
                <label class="form-check-label" for="exampleRadios2">
                    Penggunaan salah satu obat diatas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Penggunaan_Obat" id="Penggunaan_Obat"
                    value="penggunaan obat lainnya" @if ($k->penggunaanobat == 'penggunaan obat lainnya') checked @endif>
                <label class="form-check-label" for="exampleRadios3">
                    penggunaan obat lainnya
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Penggunaan_Obat" id="Penggunaan_Obat"
                    value="-" @if ($k->penggunaanobat == '-') checked @endif>
                <label class="form-check-label" for="exampleRadios3">
                    -
                </label>
            </div>
        </td>
    </tr>
    <tr>
        <td style="background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
            Pendampingan</td>
        <td colspan="3" style="padding: 8px 12px;">
            <div style="display: block; margin-bottom: 2px;">
                <input type="checkbox" style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                    id="pendampinganpasien" name="pendampinganpasien"
                    @if ($k->pendampinganpasien == 1) checked @endif>
                <label style="font-weight: bold; display: inline; vertical-align: middle;"
                    for="pendampinganpasien">Memberikan pendampingan khusus atau menyediakan alat bantu
                    jalan
                    (Kursi Roda / Tongkat)
                    bagi yang membutuhkan.
                </label>
            </div>
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
            Edukasi Pasien & Keluarga</td>
        <td colspan="3" style="padding: 8px 12px;">
            <div style="margin-bottom: 5px;">
                <input type="checkbox" style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                    id="edukasipasien1" name="edukasipasien1" @if ($k->edukasipasien1 == 1) checked @endif>
                <label style="font-weight: normal; display: inline; vertical-align: middle;"
                    for="edukasipasien1">Mengajarkan cara penggunaan alat bantu dan mengunci rem kursi
                    roda.</label>
            </div>
            <div>
                <input type="checkbox" style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                    id="edukasipasien2" name="edukasipasien2" @if ($k->edukasipasien2 == 1) checked @endif>
                <label style="font-weight: normal; display: inline; vertical-align: middle;"
                    for="edukasipasien2">Memastikan alas kaki yang digunakan aman, nyaman dan tidak
                    licin.</label>
            </div>
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: top;">
            Manajemen Lingkungan</td>
        <td colspan="3" style="padding: 8px 12px;">
            <div style="margin-bottom: 5px;">
                <input type="checkbox" style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                    id="edukasipasien3" name="edukasipasien3" @if ($k->edukasipasien3 == 1) checked @endif>
                <label style="font-weight: normal; display: inline; vertical-align: middle;"
                    for="edukasipasien3">Membantu memindahkan pasien ke area tunggu yang aman, dekat
                    dengan pos perawat (*nurse station*).</label>
            </div>
            <div>
                <input type="checkbox" style="margin-right: 5px; transform: scale(1.1); vertical-align: middle;"
                    id="edukasipasien4" name="edukasipasien4" @if ($k->edukasipasien4 == 1) checked @endif>
                <label style="font-weight: normal; display: inline; vertical-align: middle;"
                    for="edukasipasien4">Memastikan pencahayaan ruang poli cukup dan lantai tidak
                    basah.</label>
            </div>
        </td>
    </tr>
    @endif
    <tr>
        <td colspan="4"
            style="background-color: #e9ecef; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px;">
            Skrinning Gizi
        </td>
    </tr>
    @if ($usia_hari <= 4383)
        <tr>
            <td colspan="4" class="bg-light">Metode Strong Kids ( Pasien anak - anak )
            </td>
        </tr>
        <tr>
            <td>Apakah Pasien tampak kurus ? </td>
            <td colspan="3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anaktampakkurus" id="anaktampakkurus"
                        value="Ya" @if ($k->anaktampakkurus == 'Ya') checked @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anaktampakkurus" id="anaktampakkurus"
                        value="Tidak" @if ($k->anaktampakkurus == 'Tidak') checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Apakah ada penurunan BB Selama satu bulan terkahir ( berdasarakan penilaian
                objektif data BB bila ada / penilaian subjektif dari orang tua pasien atau
                unutuk bayi kurang dari 1 tahun : BB Naik selama 3 bulan terakhir) </td>
            <td colspan="3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adapenurunanbbanak" id="adapenurunanbbanak"
                        value="Ya" @if ($k->adapenurunanbbanak == 'Ya') checked @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adapenurunanbbanak" id="adapenurunanbbanak"
                        value="Tidak" @if ($k->adapenurunanbbanak == 'Tidak') checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Apaka terdapat salah satu dari kondisi berikut ? <br>
                Diare > kali/hari dan atau muntah > 3 kali/ hari dalam seminggu terakhir
                <br>
                Asupan makanan berkurang selama 1 minggu terakhir
            </td>
            <td colspan="3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anakadadiare" id="anakadadiare"
                        value="Ya" @if ($k->anakadadiare == 'Ya') checked @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="anakadadiare" id="anakadadiare"
                        value="Tidak" @if ($k->anakadadiare == 'Tidak') checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </td>
        </tr>
        <tr>
            <td>Apakah terdapat penyakit atau keadaan umum yang mengakibatkan pasien
                beresiko mengalami malnutrisi</td>
            <td colspan="3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="faktormalnutrisianak"
                        id="faktormalnutrisianak" value="Ya" @if ($k->faktormalnutrisianak == 'Ya') checked @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="faktormalnutrisianak"
                        id="faktormalnutrisianak" value="Tidak" @if ($k->faktormalnutrisianak == 'Tidak') checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </td>
        </tr>
    @endif
    <tr>
        <td colspan="3" style="padding: 5px 8px;">1. Apakah pasien mengalami penurunan berat badan
            yang tidak diinginkan dalam 6 bulan terakhir?</td>
        <td style="padding: 5px 8px; font-weight: bold;">{{ $k->Skrininggizi }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keterangan
            Skor/Beban</td>
        <td colspan="3" style="padding: 5px 8px;">{{ $k->beratskrininggizi }}</td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 5px 8px;">2. Apakah asupan makanan berkurang karena
            berkurangnya nafsu makan?</td>
        <td style="padding: 5px 8px; font-weight: bold;">{{ $k->status_asupanmkanan }}</td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 5px 8px;">3. Pasien dengan diagnosa khusus (DM / Ginjal /
            Hati / Paru / Stroke / Kanker / Geriatri, dll)</td>
        <td style="padding: 5px 8px; font-weight: bold;">{{ $k->diagnosakhusus }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Keterangan Diagnosa
        </td>
        <td colspan="3" style="padding: 5px 8px;">{{ $k->penyakitlainpasien }}</td>
    </tr>
    <tr>
        <td colspan="3" style="padding: 5px 8px;">4. Bila skor &ge; 2, lakukan pengkajian lanjut
            oleh Ahli Gizi</td>
        <td style="padding: 5px 8px; font-weight: bold;">{{ $k->resikomalnutrisi }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Tgl Pengkajian
            Lanjut</td>
        <td colspan="3" style="padding: 5px 8px;">{{ $k->tglpengkajianlanjutgizi ?? '-' }}</td>
    </tr>
    <tr>
        <td colspan="4"
            style="background-color: #e9ecef; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.5px; padding: 6px;">
            Rencana & Tindakan Asuhan Keperawatan
        </td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Diagnosa
            Keperawatan</td>
        <td colspan="3" style="padding: 5px 8px; white-space: pre-line;">
            {{ $k->diagnosakeperawatan }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Rencana Keperawatan
        </td>
        <td colspan="3" style="padding: 5px 8px; white-space: pre-line;">
            {{ $k->rencanakeperawatan }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px;">Tindakan
            Keperawatan</td>
        <td colspan="3" style="padding: 5px 8px; white-space: pre-line;">
            {{ $k->tindakankeperawatan }}</td>
    </tr>
    <tr>
        <td style="font-weight: bold; background-color: #f8f9fa; padding: 5px 8px; vertical-align: middle;">
            Evaluasi Keperawatan
        </td>
        <td colspan="3" style="padding: 5px 8px; white-space: pre-line; font-weight: normal;">
            {{ $k->evaluasikeperawatan }}
        </td>
    </tr>
    <tr>
        <td
            style="font-weight: bold; background-color: #f8f9fa; padding: 10px 8px; vertical-align: bottom; border-right: none;">
            <div style="font-size: 10px; font-weight: normal; color: #666; line-height: 1.3; font-style: italic;">
                *Dokumen Asuhan Keperawatan ini disahkan secara elektronik<br>
                melalui Sistem Informasi Manajemen Rumah Sakit.
            </div>
        </td>
        <td colspan="3"
            style="height: 190px;padding: 10px 8px; vertical-align: middle; border-left: none; text-align: right;">
            <table
                style="width: 200px; text-align: center; font-size: 13px; font-style: normal; display: inline-table; float: right; border: none; background: transparent;">
                <tr>
                    <td style="padding-bottom: 8px; border: none;">
                        <strong>Pemeriksa (Perawat),</strong>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px 0; border: none; text-align: center;">
                        {{-- <div
                            style="width: 90px; height: 90px; border: 1px dashed #ccc; margin: 0 auto; text-align: center; line-height: 90px; background-color: #fff;">
                            <span
                                style="font-size: 9px; color: #aaa; font-weight: normal; display: inline-block; vertical-align: middle;">[
                                TTE / QR CODE ]</span>
                        </div> --}}
                        <div style="width: 90px; height: 90px; margin: 0 auto; text-align: center;">
                            <img src="data:image/svg+xml;base64,{{ $qrcode }}"
                                style="width: 90px; height: 90px; display: block;" alt="QR Code TTE">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 8px; line-height: 1.3; border: none; text-transform: uppercase;">
                        <u><strong>{{ $k->namapemeriksa }}</strong></u>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    </table>
@else
    <table class="table table-sm table-bordered align-middle"
        style="width: 100%; border-collapse: collapse; font-size: 11px; color: #000; margin-top: 15px;">
        <tr>
            <td style="width: 25%; padding: 5px 8px; font-weight: bold; background-color: #f8f9fa;">Hasil Pemeriksaan
            </td>
            <td colspan="3" style="padding: 5px 8px;">{{ $k->keterangan_cppt }} <br>{{ $k->tindakankeperawatan }}
            </td>
        </tr>
        <tr>
            <td
                style="font-weight: bold; background-color: #f8f9fa; padding: 10px 8px; vertical-align: bottom; border-right: none;">
                <div style="font-size: 10px; font-weight: normal; color: #666; line-height: 1.3; font-style: italic;">
                    *Dokumen Asuhan Keperawatan ini disahkan secara elektronik<br>
                    melalui Sistem Informasi Manajemen Rumah Sakit.
                </div>
            </td>
            <td colspan="3"
                style="height: 190px;padding: 10px 8px; vertical-align: middle; border-left: none; text-align: right;">
                <table
                    style="width: 200px; text-align: center; font-size: 13px; font-style: normal; display: inline-table; float: right; border: none; background: transparent;">
                    <tr>
                        <td style="padding-bottom: 8px; border: none;">
                            <strong>Pemeriksa (Perawat),</strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0; border: none; text-align: center;">
                            {{-- <div
                            style="width: 90px; height: 90px; border: 1px dashed #ccc; margin: 0 auto; text-align: center; line-height: 90px; background-color: #fff;">
                            <span
                                style="font-size: 9px; color: #aaa; font-weight: normal; display: inline-block; vertical-align: middle;">[
                                TTE / QR CODE ]</span>
                        </div> --}}
                            <div style="width: 90px; height: 90px; margin: 0 auto; text-align: center;">
                                <img src="data:image/svg+xml;base64,{{ $qrcode }}"
                                    style="width: 90px; height: 90px; display: block;" alt="QR Code TTE">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 8px; line-height: 1.3; border: none; text-transform: uppercase;">
                            <u><strong>{{ $k->namapemeriksa }}</strong></u>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @endif
    @endforeach
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
    <script type="text/php">
        if ( isset($pdf) ) {
            // OLD
            // $font = Font_Metrics::get_font("helvetica", "bold");
            // $pdf->page_text(72, 18, "halaman ke {PAGE_NUM} dari {PAGE_COUNT}", $font, 6, array(255,0,0));
            // v.0.7.0 and greater
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
