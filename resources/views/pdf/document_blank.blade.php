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

        .text-xxs {
            font-size: 10px;
        }

        .text-xxxs {
            font-size: 8px;
        }
    </style>
</head>

<body>
    <div class="isi-surat">
        <table class="mb-4" style="width: 100%">
            <tr>
                <td>
                    <p class="float-right text-bold">RM. 07.02-RJ/25</p>
                </td>
            </tr>
        </table>
        <table class="table table-sm mt-2 table-bordered text-bold font-italic">
            <tr>
                <td class="text-center">
                    <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo">
                    <div class="instansi2">
                        PEMERINTAH KABUPATEN CIREBON
                    </div>
                    <div class="instansi2">
                        RUMAH SAKIT UMUM DAERAH WALED
                    </div>
                    <div class="instansi3">
                        Jl. Prabu Kian Santang No. 4 Waled <br> Telp.(0231)661126 Email: brsud.waled@gmail.com
                    </div>
                </td>
                <td>
                    <table style="width:100%" style="font-size: 14px">
                        <tr>
                            <td>Nomor RM</td>
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
                <td colspan="2" class="text-center text-bold bg-success">
                    FORMULIR HASIL PEMERIKSAAN RAWAT JALAN
                </td>
            </tr>
            <tr>
                <td>
                    POLIKLINIK : {{ strtoupper($ts_kunjungan[0]->nama_unit) }}
                </td>
                <td>
                    Tanggal Periksa : {{ $tglperiksa }}
                    {{-- $registeredAt = $user->created_at->isoFormat('dddd, D MMMM Y'); --}}
                </td>
            </tr>
        </table>
        @foreach ($assesmen as $cp)
            @if ($cp->kode_unit != '1028')
                <table class="table table-sm table-bordered font-italic text-bold">
                    <tr hidden>
                        <td>Sumber Data</td>
                        <td colspan="3">{{ $cp->sumber_data }}
                        </td>
                    </tr>
                    <tr>
                        <td>Keluhan Utama</td>
                        <td colspan="3">{{ $cp->keluhan_pasien }}</td>
                    </tr>
                    <tr hidden>
                        <td>Riwayat Penyakit Dahulu</td>
                        <td colspan="3">{{ $cp->riwayat_kehamilan_pasien_wanita }}
                            <br>
                            {{ $cp->riwyat_kelahiran_pasien_anak }}
                            <br>
                            {{ $cp->riwyat_penyakit_sekarang }}
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>Riwayat Alergi</td>
                        <td colspan="3">{{ $cp->riwayat_alergi }} |
                            {{ $cp->keterangan_alergi }} </td>
                    </tr>
                    <tr hidden>
                        <td>Riwayat Obat yang diminum</td>
                        <td colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Kesadaran</td>
                        <td colspan="3">{{ $cp->kesadaran }}</td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Tanda Tanda Vital</td>
                        <td colspan="3">
                            Tekanan Darah : {{ $cp->tekanan_darah }} / Frekuensi Nadi : {{ $cp->frekuensi_nadi }} /
                            Frekuensi Nafas : {{ $cp->frekuensi_nafas }} / Suhu Tubuh : {{ $cp->suhu_tubuh }} <br> Bb
                            / TB / IMT : {{ $cp->beratbadan }} | Umur : {{ $cp->umur }} </td>
                    </tr>
                    <tr>
                        <td>Pemeriksaan Fisik ( O )</td>
                        <td colspan="3">{{ $cp->pemeriksaan_fisik }}</td>
                    </tr>
                    <tr>
                        <td>Layanan Laboratorium</td>
                        <td colspan="2">
                            @foreach($penunjang as $pp)
                                @if($pp->kode_unit == 3002)
                                {{ $pp->NAMA_TARIF }} <br>
                                @endif
                            @endforeach
                        </td>
                        <td colspan="2">ICD 9 CM :</td>
                    </tr>
                    <tr>
                        <td>Layanan Radiologi</td>
                        <td colspan="2">
                             @foreach($penunjang as $pp)
                                @if($pp->kode_unit == 3003)
                                {{ $pp->NAMA_TARIF }} <br>
                                @endif
                            @endforeach
                        </td>
                        <td colspan="2">ICD 9 CM :</td>
                    </tr>
                    @if ($cp->kode_unit == '1012')
                        <tr>
                            <td>Hasil USG Kebidanan</td>
                            <td colspan="3">
                                Hasil Expertisi : <br>
                                {{ $cp->evaluasi }}
                            </td>
                        </tr>
                    @endif
                    @if ($cp->kode_unit == '1027')
                        <tr>
                            <td>Hasil USG Urologi</td>
                            <td colspan="3">
                                Hasil Expertisi : <br>
                                {{ $cp->evaluasi }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="text-center" colspan="4">Diagnosis ( A ) <br></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Utama</td>
                        <td>{{ $cp->diagnosakerja }}<br></td>
                        <td class="text-left" colspan="2">ICD X :</td>
                    </tr>
                    <tr>
                        <td>Diagnosa Sekunder</td>
                        <td>{{ $cp->diagnosabanding }}<br></td>
                        <td class="text-left" colspan="2">ICD X :</td>
                    </tr>
                    <tr>
                        <td>Tindakan / Prosedur</td>
                        <td>
                            {{ $cp->tindakanmedis }}<br>
                            @foreach ($tindakan as $t)
                                @if ($t->kode_kunjungan == $cp->id_kunjungan)
                                    {{ $t->NAMA_TARIF }}<br>
                                @endif
                            @endforeach
                        </td>
                        <td class="text-left" colspan="2">ICD 9 CM :</td>
                    </tr>
                    <tr>
                        <td>Tindakan Operasi</td>
                        <td></td>
                        <td class="text-left" colspan="2">ICD 9 CM :</td>
                    </tr>
                    {{-- <tr>
                        <td>Rencana Tindakan ( P )</td>
                        <td colspan="3">{{ $cp->renjana_tindakan }}</td>
                    </tr> --}}
                    <tr>
                        <td>Tindak Lanjut</td>
                        <td colspan="3">{{ $cp->tindak_lanjut }}<br>
                            {{ $cp->keterangan_tindak_lanjut }}
                        </td>
                    </tr>
                    {{-- <tr>
                    <td>Pemeriksaan Penunjang</td>
                    <td>{{ $cp->evaluasi }}</td>
                    </tr> --}}
                    <tr>
                        <td>Obat obatan</td>
                        <td colspan="3">
                            {{-- <table class="table table-sm">
                                <thead>
                                    <th>Nama Obat</th>
                                    <th>qty</th>
                                    <th>Aturan Pakai</th>
                                </thead>
                                <tbody> --}}
                            @foreach ($orderfarmasi as $t)
                                {{ $t->kode_barang }}(qty : {{ $t->jumlah_layanan }}) , aturan pakai :
                                {{ $t->aturan_pakai }}
                                /
                            @endforeach
                            {{-- </tbody>
                            </table> --}}
                        </td>
                    </tr>
                    <tr hidden>
                        <td>Pemeriksaan Penunjang termasuk lab, rad, dll</td>
                        <td>
                            Order Pemeriksasan Penunjang <br>
                            {{-- <table class="table table-sm table-bordered">
                                <thead>
                                    <th>Nama Unit</th>
                                    <th>Nama Layanan</th>
                                </thead>
                                <tbody> --}}
                            @foreach ($order_penunjang as $d)
                                {{-- <tr>
                                            <td> --}}
                                {{ $d->nama_unit }} ({{ $d->NAMA_TARIF }}) ,
                            @endforeach
                            {{-- </tbody>
                            </table> --}}
                        </td>
                        <td colspan="2">ICD 9 CM :</td>
                    </tr>
                    <tr>
                        <td>Jawaban Konsul Ke poli lain</td>
                        <td colspan="3">{{ $cp->keterangan_tindak_lanjut_2 }} <br><br>

                        </td>
                    </tr>
                    <tr>
                        <td>Hasil Pemeriksaan Khusus</td>
                        <td colspan="3">
                            {{ $cp->pemeriksaan_khusus }} <br>
                            {{ $cp->pemeriksaan_khusus_2 }}
                            {{-- <img width="80%"src="{{ $cp->gambar_1 }}" alt=""><br><br> --}}
                        </td>
                    </tr>
                    <tr>
                        <td>Dokter Pemeriksa</td>
                        <td style="height:50px" colspan="3" class="">
                            <table class="float-left text-bold float-right">
                                {{-- <tr>
                                    <td style="height:90px" class="text-center">
                                        <br>
                                        <br>
                                        #
                                    </td>
                                </tr> --}}
                                <tr>
                                    <td>{{ $mt_paramedis[0]->nama_paramedis }} <br> NIP {{ $mt_paramedis[0]->nip }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td>Tanggal Periksa</td>
                        <td>{{ $cp->tgl_pemeriksaan }}</td>
                    </tr>
                    <tr>
                        <td>Tanda Tangan</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Dokter pemeriksa</td>
                        <td>{{ $cp->nama_dokter }}</td>
                    </tr> --}}
                </table>
            @else
                <table class="table table-sm">
                    <tr>
                        <td>
                            <div class="card">
                                <table class="table table-sm table-bordered table-striped font-italic">
                                    <tr>
                                        <td>Anamnesa</td>
                                        <td>: {{ $cp->anamnesa }}</td>
                                        <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                                    </tr>
                                    {{-- <tr>
                                        <td>Pemeriksaan Tanda Tanda Vital</td>
                                        <td>
                                            Tekanan Darah : {{ $cp->tekanan_darah }}<br>
                                            Frekuensi Nadi : {{ $cp->frekuensi_nadi }} <br>
                                            Frekuensi Nafas : {{ $cp->frekuensi_nafas }} <br>
                                            Suhu Tubuh : {{ $cp->suhu_tubuh }} <br>
                                            Bb / TB / IMT : {{ $cp->beratbadan }} <br>
                                            Umur : {{ $cp->umur }} <br>
                                        </td>
                                    </tr> --}}
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
                                            Order Pemeriksaan Penunjang <br>
                                            @foreach ($order_penunjang as $d)
                                                {{ $d->nama_unit }} ({{ $d->NAMA_TARIF }}) ,
                                            @endforeach
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
                                            keterangan :
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
                                            @foreach ($orderfarmasi as $t)
                                                {{ $t->kode_barang }}(qty : {{ $t->jumlah_layanan }}) , aturan pakai :
                                                {{ $t->aturan_pakai }}
                                                /
                                            @endforeach
                                            {{-- <table class="table table-sm">
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
                                        </table> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jawaban Konsul Ke poli lain</td>
                                        <td>{{ $cp->keterangan_tindak_lanjut_2 }} <br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dokter Pemeriksa</td>
                                        <td style="height:50px">
                                            <table class="text-xxs float-left text-bold float-right">
                                                {{-- <tr>
                                                    <td style="height:90px" class="text-center">
                                                        <br>
                                                        <br>
                                                        #
                                                    </td>
                                                </tr> --}}
                                                <tr>
                                                    <td>{{ $mt_paramedis[0]->nama_paramedis }} <br> NIP
                                                        {{ $mt_paramedis[0]->nip }}
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Tanggal Periksa</td>
                                        <td>{{ $cp->tgl_pemeriksaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dokter Pemeriksa</td>
                                        <td>{{ $cp->nama_dokter }}</td>
                                    </tr> --}}
                                </table>
                            </div>
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
