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
        /* Add your CSS styles here for PDF formatting */
        body {
            font-family: sans-serif;
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

        .text-xxs {
            font-size: 10px;
        }
    </style>
</head>

<body>
    {{-- <h1>{{ $title }}</h1>
    <p>{{ $content }}</p> --}}
    <div class="kop-surat">
        <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo">
        <div class="instansi2">
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
        <table class="table table-sm mt-2 table-bordered text-xxs text-bold font-italic">
            <tr>
                <td width="20%">Nomor RM</td>
                <td>{{ $mt_pasien[0]->no_rm }}</td>
                <td rowspan="2" colspan="2">Alamat : {{ $mt_pasien[0]->alamatpx }}</td>
            </tr>
            <tr>
                <td>Nama Pasien</td>
                <td>{{ $mt_pasien[0]->nama_px }}</td>
            </tr>
            <tr>
                <td>Tanggal lahir</td>
                <td>{{ $mt_pasien[0]->tgl_lahirs }}</td>
                <td>Jenis Kelamin</td>
                <td>
                    @if (strtoupper($mt_pasien[0]->jenis_kelamin) == 'L')
                        Laki - Laki
                    @else
                        Perempuan
                    @endif
                </td>
            </tr>
            <tr>
                <td>Tanggal Kunjungan</td>
                <td>{{ $ts_kunjungan[0]->tgl_msk }}</td>
                <td>Penjamin</td>
                <td>{{ $ts_kunjungan[0]->nama_penjamin }}</td>
            </tr>
            <tr>
                <td>Unit Pemeriksa</td>
                <td>{{ $ts_kunjungan[0]->nama_unit }}</td>
                <td>SEP</td>
                <td>{{ $ts_kunjungan[0]->no_sep }}</td>
            </tr>
        </table>
        @foreach ($assesmen as $cp)
            @if ($cp->kode_unit != '1028')
                <table class="table table-sm table-bordered table-striped text-xxs font-italic text-bold">
                    <tr>
                        <td>Sumber Data</td>
                        <td>{{ $cp->sumber_data }}
                        </td>
                    </tr>
                    <tr>
                        <td>Keluhan Utama</td>
                        <td>{{ $cp->keluhan_pasien }}</td>
                    </tr>
                    <tr hidden>
                        <td>Riwayat Penyakit Dahulu</td>
                        <td>{{ $cp->riwayat_kehamilan_pasien_wanita }}
                            <br>
                            {{ $cp->riwyat_kelahiran_pasien_anak }}
                            <br>
                            {{ $cp->riwyat_penyakit_sekarang }}
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Riwayat Alergi</td>
                        <td>{{ $cp->riwayat_alergi }} |
                            {{ $cp->keterangan_alergi }} </td>
                    </tr>
                    <tr hidden>
                        <td>Riwayat Obat yang diminum</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Kesadaran</td>
                        <td colspan="3">{{ $cp->kesadaran }}</td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Fisik ( O )</td>
                        <td>{{ $cp->pemeriksaan_fisik }}</td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="2">Diagnosis ( A ) <br></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Utama</td>
                        <td>{{ $cp->diagnosakerja }}<br>
                        </td>
                    </tr>
                    <tr>
                        <td>Diagnosa Sekunder</td>
                        <td>{{ $cp->diagnosabanding }}<br>
                        </td>
                    </tr>
                    <tr>
                        <td>Tindakan</td>
                        <td>
                            {{ $cp->tindakanmedis }}<br>
                            @foreach ($tindakan as $t)
                                @if ($t->kode_kunjungan == $cp->id_kunjungan)
                                    {{ $t->NAMA_TARIF }}<br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Rencana Terapi ( P )</td>
                        <td>{{ $cp->rencanakerja }}</td>
                    </tr>
                    <tr>
                        <td>Tindak Lanjut</td>
                        <td>{{ $cp->tindak_lanjut }}<br>
                            {{ $cp->keterangan_tindak_lanjut }}
                        </td>
                    </tr>
                    {{-- <tr>
                    <td>Pemeriksaan Penunjang</td>
                    <td>{{ $cp->evaluasi }}</td>
                    </tr> --}}
                    <tr hidden>
                        <td>Obat obatan</td>
                        <td>
                            <table class="table table-sm">
                                <thead>
                                    <th>Nama Obat</th>
                                    <th>qty</th>
                                    <th>Aturan Pakai</th>
                                </thead>
                                <tbody>
                                    @foreach ($orderfarmasi as $t)
                                        <tr>
                                            <td>{{ $t->kode_barang }}
                                            </td>
                                            <td>{{ $t->jumlah_layanan }}
                                            </td>
                                            <td>{{ $t->aturan_pakai }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Penunjang</td>
                        <td>

                            @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                Hasil Expertisi : <br>
                                {{ $cp->evaluasi }}
                                <br>
                            @endif
                            {{-- <table class="table table-sm table-bordered">
                                <thead>
                                    <th>Nama Unit</th>
                                    <th>Nama Layanan</th>
                                </thead>
                                <tbody>
                                    @foreach ($order_penunjang as $d)
                                        <tr>
                                            <td>{{ $d->nama_unit }}</td>
                                            <td>{{ $d->NAMA_TARIF }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Jawaban Konsul Ke poli lain</td>
                        <td>{{ $cp->keterangan_tindak_lanjut_2 }} <br><br>

                        </td>
                    </tr>
                    <tr>
                        <td>Hasil Pemeriksaan Khusus</td>
                        <td>

                            {{ $cp->pemeriksaan_khusus }} <br><br>
                            {{ $cp->pemeriksaan_khusus_2 }}<br><br>
                            <img width="80%"src="{{ $cp->gambar_1 }}" alt=""><br><br>

                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Periksa</td>
                        <td>{{ $cp->tgl_pemeriksaan }}</td>
                    </tr>
                    <tr>
                        <td>Tanda Tangan</td>
                        <td>#</td>
                    </tr>
                    <tr>
                        <td>Dokter pemeriksa</td>
                        <td>{{ $cp->nama_dokter }}</td>
                    </tr>
                </table>
            @else
                <table class="table table-sm">
                    <tr>
                        <td>
                            <div class="card">
                                <table class="table table-bordered table-striped font-italic">
                                    <tr>
                                        <td>Anamnesa</td>
                                        <td>: {{ $cp->anamnesa }}</td>
                                        <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Fisik dan Uji Fungsi</td>
                                        <td>: {{ $cp->pemeriksaan_fisik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Medis ( ICD 10 )</td>
                                        <td>: {{ $cp->diagnosakerja }}</td>
                                        <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Fungsi ( ICD 10 )</td>
                                        <td>: {{ $cp->diagnosabanding }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Penunjang</td>
                                        <td>: {{ $cp->rencanakerja }}

                                            <br>
                                            @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                                Hasil Expertisi : <br>
                                                {{ $cp->evaluasi }}
                                                <br>
                                            @endif

                                                    <table class="table table-sm">
                                                        <thead>
                                                            <th>Unit</th>
                                                            <th>Nama Pemeriksaan</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($penunjang as $p)
                                                                @if ($p->kode_kunjungan == $cp->id_kunjungan)
                                                                    {{-- @if ($p->kode_unit == '3009' && $p->kode_unit == '3010') --}}
                                                                    <tr>
                                                                        <td>{{ $p->nama_unit }}
                                                                        </td>
                                                                        <td>{{ $p->NAMA_TARIF }}
                                                                        </td>
                                                                    </tr>
                                                                    {{-- @endif --}}
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-sm table-bordered">
                                                        <thead>
                                                            <th>Nama Unit</th>
                                                            <th>Nama Layanan</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order_penunjang as $d)
                                                                <tr>
                                                                    <td>{{ $d->nama_unit }}</td>
                                                                    <td>{{ $d->NAMA_TARIF }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tata laksana KFR </td>
                                        <td>: {{ $cp->tatalaksana_kfr }}</td>
                                    </tr>
                                    <tr>
                                        <td>Anjuran </td>
                                        <td>: {{ $cp->anjuran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Evaluasi</td>
                                        <td>: {{ $cp->evaluasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Suspek Penyakit akibat kerja</td>
                                        <td>: {{ $cp->riwayatlain }}
                                            <br>
                                            ketereangan :
                                            {{ $cp->ket_riwayatlain }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tindak Lanjut</td>
                                        <td>
                                            @if ($cp->versidk != 2)
                                                : {{ $cp->tindak_lanjut }} |
                                                {{ $cp->keterangan_tindak_lanjut }}
                                            @else
                                                @php $tinjut = explode('|',$cp->tindak_lanjut ) @endphp
                                                @if ($tinjut[0] == 1)
                                                    Kontrol <br>
                                                @endif
                                                @if ($tinjut[1] == 1)
                                                    Konsul <br>
                                                @endif
                                                @if ($tinjut[2] == 1)
                                                    Rujuk Internal <br>
                                                @endif
                                                @if ($tinjut[3] == 1)
                                                    Rujuak Keluar <br>
                                                @endif
                                                @if ($tinjut[4] == 1)
                                                    Rawat Inap <br>
                                                @endif
                                                @if ($tinjut[5] == 1)
                                                    Dipulangkan <br>
                                                @endif
                                            @endif
                                            Keterangan :
                                            {{ $cp->keterangan_tindak_lanjut }}<br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Obat obatan</td>
                                        <td>

                                                    <table class="table table-sm">
                                                        <thead>
                                                            <th>Nama Obat</th>
                                                            <th>qty</th>
                                                            <th>Aturan Pakai</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orderfarmasi as $t)
                                                                <tr>
                                                                    <td>{{ $t->kode_barang }}
                                                                    </td>
                                                                    <td>{{ $t->jumlah_layanan }}
                                                                    </td>
                                                                    <td>{{ $t->aturan_pakai }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jawaban Konsul Ke poli lain</td>
                                        <td>{{ $cp->keterangan_tindak_lanjut_2 }} <br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Periksa</td>
                                        <td>{{ $cp->tgl_pemeriksaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dokter Pemeriksa</td>
                                        <td>{{ $cp->nama_dokter }}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            @endif
        @endforeach
    </div>
                   <h1>#</h1>

</body>
</html>
