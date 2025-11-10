<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="{{ public_path('../public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
    <link rel="stylesheet" href="{{ public_path('../public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('../public/dist/css/datepicker.css') }}" rel="stylesheet">
    <style>
        /* CSS for print media */
        @media print {
            .page-break-row {
                page-break-after: always;
                margin-top: 2cm;
            }

        }

    </style>
    <style>
        @page {
            margin: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
            /* Adjust this value as needed */
        }

        .page-break-row {
            page-break-after: always;
            margin-top: 2cm;
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
</head>

<body>
    <div class="isi-surat">
        <p class="float-right text-bold" style="margin-right:70px">RM.11-RI/Rev.02/19</p>
        <div class="container">
            <img src="{{ public_path('../public/img/logo_rs.png') }}" class="logo" style="display: grid;
            grid-template-columns: auto auto auto;margin-top:35px;margin-left:20px;width: 10%">
            <div class="isi-surat">
                <table class="mt-2 " style="border: 1px solid;width:100%">
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="2">
                                <div class="" style="text-align: center;">
                                    <p class="text-bold">PEMERINTAH KABUPATEN CIREBON<br>
                                        RUMAH SAKIT UMUM DAERAH WALED<br>
                                        <p>Jl. Prabu Kian Santang No.
                                            4<br>Telp.(0231)661126 Email: brsud.waled@gmail.com</p>
                                    </p>
                                </div>
                            </td>
                            <td rowspan="1" colspan="2">
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
                            <td style="text-align: center;height: 1px;" colspan="2" class="text-bold">ASSESMEN AWAL</td>
                            <td style="font-style: italic;font-size:8px;margin-top:14px" colspan="2" class="text-bold">
                                (Label Pasien / Affix Patient Identification Label)</label></td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px;" colspan="4" class="text-bold">POLI KLINIK : {{
                                $header[0]->NAMAUNIT}} | Tanggal Periksa :{{ \Carbon\Carbon::parse($header[0]->tanggalkunjungan)->format('d / M / Y') }}</td>
                        </tr>
                        <tr>
                            <td width="50%" style="text-align: left;height: 1px;" colspan="1" class="text-bold">ASSESMEN AWAL
                                KEPERAWATAN</td>
                            <td width="50%" style="text-align: left;height: 1px;" colspan="3" class="text-bold">ASSESMEN AWAL MEDIS
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;height: 1px;vertical-align: top;" colspan="1">
                                @if($header[0]->kode_unit != 1028)
                                Sumber Data : {{ $header[0]->sumberdataperiksa }}<br>
                                Keluhan : {{ $header[0]->keluhanutama }}<br>

                                Tekanan Darah : {{ $header[0]->tekanandarah }} mmHg<br>
                                Frekuensi Nadi : {{ $header[0]->frekuensinadi }} x/menit<br>
                                Frekuensi Nafas : {{ $header[0]->frekuensinapas }} x/menit<br>
                                Suhu tubuh: {{ $header[0]->suhutubuh }} °C<br>
                                Berat badan: {{ $header[0]->beratbadan }} kg<br>
                                Tinggi badan: {{ $header[0]->tinggibadan }}<br>
                                IMT: {{ $header[0]->imt }}<br>
                                Umur: {{ $header[0]->umur }}<br><br>


                                Diagnosa Keperawatan : {{ $header[0]->diagnosakeperawatan }}<br><br>
                                Rencana Keperawatan : {{ $header[0]->rencanakeperawatan }}<br><br>
                                Tindakan Keperawatan : {{ $header[0]->tindakankeperawatan }}<br><br>
                                Evaluasi Keperawatan : {{ $header[0]->evaluasikeperawatan }}<br><br>
                                @else
                                Hasil Pemeriksaan : {{ $header[0]->tindakankeperawatan }}<br>
                                @endif
                            </td>
                            <td style="text-align: left;height: 1px;font-size:12px" colspan="3">
                                @if($header[0]->kode_unit != 1028)
                                Sumber data : {{ $header[0]->sumber_data }}<br>
                                Keluhan Utama : {{ $header[0]->keluhan_pasien }}<br>
                                Riwayat Penyakit Dahulu : {{ $header[0]->riwayat_kehamilan_pasien_wanita }}<br>
                                {{ $header[0]->riwyat_kelahiran_pasien_anak }}<br>{{ $header[0]->riwyat_penyakit_sekarang }}<br>
                                Riwayat Alergi : {{ $header[0]->riwayat_alergi }} | {{ $header[0]->keterangan_alergi }}<br>
                                Riwayat Obat yang diminum : <br>
                                Kesadaran : {{ $header[0]->kesadaran }}<br><br>
                                Pemeriksaan Fisik ( O ) : {{ $header[0]->pemeriksaan_fisik }}<br><br>
                                Diagnosis ( A )<br>
                                Diagnosa Utama : {{ $header[0]->diagnosakerja }}<br>
                                Diagnosa Sekunder : {{ $header[0]->diagnosabanding }}<br><br>
                                Tindakan : {{ $header[0]->tindakanmedis }}<br><br>
                                @foreach ($tindakan as $t)
                                @if ($t->kode_kunjungan == $header[0]->kode_kunjungan)
                                {{ $t->NAMA_TARIF }}<br>
                                @endif
                                @endforeach
                                Rencana Terapi ( P ) : {{ $header[0]->rencanakerja }}<br><br>
                                Tindak Lanjut : {{ $header[0]->tindak_lanjut }}<br>{{ $header[0]->keterangan_tindak_lanjut }}<br><br>
                                @foreach ($datakonsul as $dk)
                                @if ($dk->kode_kunjungan == $header[0]->kode_kunjungan)
                                @if ($dk->jenis == 'KONSUL')
                                KONSUL KE POLI
                                {{ $dk->poli_konsul }} <br>
                                keterangan :
                                {{ $dk->catatan }}
                                <br><br><br>
                                JAWABAN KONSUL <br>
                                {{ $dk->dokter_penerima_2 }}
                                <br><br>
                                {{ $dk->jawaban_konsul }}<br>
                                @else
                                RUJUK POLI LAIN (
                                {{ $dk->poli_konsul }}) <br>
                                @endif
                                <br>
                                @endif
                                @endforeach
                                Obat obatan :
                                <br>
                                Order yang dikirim<br>
                                @foreach ($orderfarmasi as $of)
                                @if ($of->kode_kunjungan == $header[0]->kode_kunjungan)
                                {{ $of->kode_barang }} {{ $of->keteranganresep }} | qty : {{ $of->jumlah_layanan }} | {{ $of->aturan_pakai }}<br>
                                @endif
                                @endforeach
                                <br>
                                <br>
                                Pemeriksaan Penunjang : <br>
                                @if ($header[0]->kode_unit == '1012' || $header[0]->kode_unit == '1027')
                                hasil expertisi : <br>@endif

                                {{ $header[0]->evaluasi }} <br>
                                @foreach ($penunjang as $p)
                                @if ($p->kode_kunjungan == $header[0]->kode_kunjungan)
                                {{ $p->nama_unit }} | {{ $p->NAMA_TARIF }}<br>
                                @endif
                                @endforeach
                                <br>
                                Jawaban Konsul Ke poli lain : {{ $header[0]->keterangan_tindak_lanjut_2 }}<br>
                                @else
                                Anamnesa : {{ $header[0]->anamnesa }} <br>
                                Pemeriksaan Fisik dan Uji Fungsi : {{ $header[0]->pemeriksaan_fisik }} <br>
                                Diagnosis Medis ( ICD 10 ) : {{ $header[0]->diagnosakerja }} <br>
                                Diagnosis Fungsi ( ICD 10 ) : {{ $header[0]->diagnosabanding }} <br>
                                Pemeriksaan Penunjang : {{ $header[0]->rencanakerja }} <br>
                                Terapi yang dilakukan :
                                @foreach ($penunjang as $p)
                                @if ($p->kode_kunjungan == $header[0]->id_kunjungan)
                                {{ $p->nama_unit }} | {{ $p->NAMA_TARIF }} <br>
                                @endif
                                @endforeach
                                <br>
                                Obat Obatan : Order yang dikirim<br>
                                    @foreach ($orderfarmasi as $of)
                                    @if ($of->kode_kunjungan == $header[0]->kode_kunjungan)
                                    {{ $of->kode_barang }} | {{ $of->keteranganresep }} | qty :{{ $of->jumlah_layanan }} | {{ $of->aturan_pakai }} <br>
                                    @endif
                                    @endforeach
                                    <br>
                                    Tata laksana KFR : {{ $header[0]->tatalaksana_kfr }}
                                    Anjuran : {{ $header[0]->anjuran }}
                                    Evaluasi : {{ $header[0]->evaluasi }}
                                    Suspek Penyakit akibat kerja : {{ $header[0]->riwayatlain }}
                                    ketereangan : {{ $header[0]->ket_riwayatlain }}
                                    Tindak Lanjut :
                                    : {{ $header[0]->tindak_lanjut }} |
                                    {{ $header[0]->keterangan_tindak_lanjut }}
                                    Keterangan :
                                    {{ $header[0]->keterangan_tindak_lanjut }}
                                @endif
                            </td>
                        </tr>
                        <tr class="page-break-row">
                            <td colspan="1"><br><br><br>Pemeriksa : {{ $header[0]->namapemeriksa}} <br></td>
                            <td colspan="3"><br><br><br>Dokter pemeriksa : {{ $header[0]->nama_dokter }}<br></td>
                        </tr>
                    </tbody>
                </table>
                <table style="font-size: 10px">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center;height: 1px;">Catatan
                                Perkembangan Pasien Terintegrasi</th>
                        </tr>
                        <tr>
                            <th>Tanggal dan jam</th>
                            <th>Hasil Pemeriksaan, Analisa, Rencana Penatalaksanaan pasien( ditulis dengan
                                format SOAP, disertai target yang terukur, evaluasi hasil, tata laksana
                                dituliskan dalam assesmen )</th>
                            <th>Instruksi tenaga kesehatan termasuk pasca bedah / prosedur </th>
                            <th>nama Dpjp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cppt as $cp)
                        @if ($header[0]->kode_kunjungan == $cp->id_header || $header[0]->kode_kunjungan == $cp->ref_kunjungan)
                        <tr>
                            <td style="vertical-align: top;">{{ \Carbon\Carbon::parse($cp->tglk)->format('d / M / Y') }}</td>
                            <td width="40%" style="vertical-align:top">
                                @if($cp->kode_unit != 1028)
                                Sumber Data : {{ $cp->sumberdataperiksa }}<br>
                                Keluhan : {{ $cp->keluhanutama }}<br><br>

                                Tekanan Darah : {{ $cp->tekanandarah }} mmHg <br>
                                Frekuensi Nadi : {{ $cp->frekuensinadi }} x/menit<br>
                                Frekuensi Nafas : {{ $cp->frekuensinapas }} x/menit<br>
                                Suhu tubuh: {{ $cp->suhutubuh }} °C<br>
                                Berat badan: {{ $cp->beratbadan }} kg<br>
                                Tinggi badan: {{ $cp->tinggibadan }} cm<br>
                                IMT: {{ $cp->imt }}<br>
                                Umur: {{ $cp->usia }}<br>
                                Diagnosa Keperawatan :
                                {{ $cp->diagnosakeperawatan }}<br>
                                Rencana Keperawatan : {{ $cp->rencanakeperawatan }}<br>
                                Tindakan Keperawatan :
                                {{ $cp->tindakankeperawatan }}<br>
                                Evaluasi Keperawatan :
                                {{ $cp->evaluasikeperawatan }}<br>
                                <br>
                                Pemeriksa : {{ $cp->namapemeriksa }}
                                @else
                                Hasil Pemeriksaan : {{ $cp->tindakankeperawatan }}<br>
                                Pemeriksa : {{ $cp->namapemeriksa }}
                                @endif
                            </td>
                            <td width="40%" style="vertical-align:top">
                                @if($cp->kode_unit != 1028)
                                Sumber Data : {{ $cp->sumber_data }} <br>
                                Keluhan Utama : {{ $cp->keluhan_pasien }} <br>
                                Riwayat Penyakit Dahulu : {{ $cp->riwayat_kehamilan_pasien_wanita }} <br> {{ $cp->riwyat_kelahiran_pasien_anak }} <br> {{ $cp->riwyat_penyakit_sekarang }} <br>

                                Riwayat Alergi : {{ $cp->riwayat_alergi }} | {{ $cp->keterangan_alergi }}<br>
                                Pemeriksaan Fisik ( O ) : {{ $cp->pemeriksaan_fisik }} <br>
                                Diagnosis ( A ) <br>
                                Diagnosa Utama : {{ $cp->diagnosakerja }} <br>
                                Diagnosa Sekunder : {{ $cp->diagnosabanding }} <br>
                                Tindakan :{{ $cp->tindakanmedis }}<br>
                                @foreach ($tindakan as $t)
                                @if ($t->kode_kunjungan == $cp->kode_kunjungan)
                                {{ $t->NAMA_TARIF }}<br>
                                @endif
                                @endforeach
                                Rencana Terapi ( P ) : {{ $cp->rencanakerja }} <br>
                                Tindak Lanjut : {{ $cp->tindak_lanjut }}<br>
                                {{ $cp->keterangan_tindak_lanjut }}<br>
                                @foreach ($datakonsul as $dk)
                                @if ($dk->kode_kunjungan == $cp->kode_kunjungan)
                                @if ($dk->jenis == 'KONSUL')
                                KONSUL KE POLI
                                {{ $dk->poli_konsul }} <br>
                                keterangan :
                                {{ $dk->catatan }}
                                <br><br><br>
                                JAWABAN KONSUL <br>
                                {{ $dk->dokter_penerima_2 }}
                                <br><br>
                                {{ $dk->jawaban_konsul }}<br>
                                @else
                                RUJUK POLI LAIN (
                                {{ $dk->poli_konsul }}) <br>
                                @endif
                                <br>
                                <br>
                                @endif
                                @endforeach
                                Obat Obatan : Order yang dikirim<<br>
                                    @foreach ($orderfarmasi as $of)
                                    @if ($of->kode_kunjungan == $cp->kode_kunjungan)
                                    {{ $of->kode_barang }} | {{ $of->keteranganresep }} | qty :{{ $of->jumlah_layanan }} | {{ $of->aturan_pakai }} <br>
                                    @endif
                                    @endforeach
                                    <br>
                                    Pemeriksaan Penunjang : @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                    hasil expertisi : <br>
                                    {{ $cp->evaluasi }} <br> @endif
                                    <br>

                                    @foreach ($penunjang as $p)
                                    @if ($p->kode_kunjungan == $cp->kode_kunjungan)
                                    {{ $p->nama_unit }} | {{ $p->NAMA_TARIF }} <br>
                                    @endif
                                    @endforeach
                                    <br>
                                    Jawaban Konsul Ke poli lain : {{ $cp->keterangan_tindak_lanjut_2 }}<br><br>
                                    @foreach ($datakonsul as $dk)
                                    @if ($dk->kode_kunjungan_2 == $cp->kode_kunjungan)
                                    @if ($dk->jenis == 'KONSUL')
                                    KONSUL DARI POLI
                                    {{ $dk->poli_pengirim }} <br>
                                    {{ $dk->catatan }}
                                    <br><br><br>
                                    JAWABAN KONSUL <br>
                                    {{ $dk->jawaban_konsul }}
                                    @endif
                                    @endif
                                    @endforeach
                                    Tanggal Periksa : {{ $cp->tgl_pemeriksaan }} <br>
                                    @else
                                    Anamnesa : {{ $cp->anamnesa }} <br>
                                    Pemeriksaan Fisik dan Uji Fungsi : {{ $cp->pemeriksaan_fisik }} <br>
                                    Diagnosis Medis ( ICD 10 ) : {{ $cp->diagnosakerja }} <br>
                                    Diagnosis Fungsi ( ICD 10 ) : {{ $cp->diagnosabanding }} <br>
                                    Pemeriksaan Penunjang : {{ $cp->rencanakerja }} <br>
                                    Terapi yang dilakukan :
                                    @foreach ($penunjang as $p)
                                    @if ($p->kode_kunjungan == $cp->id_kunjungan)
                                    {{ $p->nama_unit }} | {{ $p->NAMA_TARIF }} <br>
                                    @endif
                                    @endforeach
                                    Obat Obatan : Order yang dikirim<<br>
                                        @foreach ($orderfarmasi as $of)
                                        @if ($of->kode_kunjungan == $cp->kode_kunjungan)
                                        {{ $of->kode_barang }} | {{ $of->keteranganresep }} | qty :{{ $of->jumlah_layanan }} | {{ $of->aturan_pakai }} <br>
                                        @endif
                                        @endforeach
                                        <br>
                                        Tata laksana KFR : {{ $cp->tatalaksana_kfr }}
                                        Anjuran : {{ $cp->anjuran }}
                                        Evaluasi : {{ $cp->evaluasi }}
                                        Suspek Penyakit akibat kerja : {{ $cp->riwayatlain }}
                                        ketereangan : {{ $cp->ket_riwayatlain }}
                                        Tindak Lanjut :
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
                                        {{ $cp->keterangan_tindak_lanjut }}
                                        @endif

                            </td>
                            <td> {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer>
                <div class="text-xxxs font-italic" id="footer">
                </div>
            </footer>
        </div>
    </div>
    <script type="text/php">
        if ( isset($pdf) ) {
            // OLD 
            // $font = Font_Metrics::get_font("helvetica", "bold");
            // $pdf->page_text(72, 18, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(255,0,0));
            // v.0.7.0 and greater
            $x = 72;
            $y = 1118;
            $text = "{PAGE_NUM} of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 14;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>

    </script>
</body>

</html>
