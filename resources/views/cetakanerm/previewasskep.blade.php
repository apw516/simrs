{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    {{-- <meta name="viewport" content= "width=device-width, user-scalable=no"> --}}

<title>
    cetakan
</title>
<link href='{{ asset('public/img/logo_rs.png') }}' rel='shortcut icon'>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> --}}
<!-- overlayScrollbars -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
<style>
    /* @page {
                margin: 10px 25px;
            } */
    @page {
        /* size: 21cm 29.7cm; */
        margin: 10px, 10px;
    }

    /* main {
            height: 1100px;
            width: 100%;
            background-color: rgb(255, 255, 255);
        } */


    table,
    th,
    td {
        border: 1.2px solid black;
    }
</style>
</head>

<body id="my" class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    @if($kunjungan[0]->kode_unit == '1028')
    <main @if($asskep[0]->usia > 12 )style="margin-bottom:220px" @endif>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td width="30%"><img width="100%" src="{{ asset('public/img/logo_rs.png') }}" alt="">
                    </td>
                    <td class="text-center text-bold text-xs" width="100%">PEMERINTAH KABUPATEN CIREBON <br>
                        RUMAH SAKIT UMUM DAERAH WALED<br>
                        <p class="text-xs">Jl.Prabu Kian Santang No.4 <br>Telp. 0231-661126 Fax.0231-664091 Cirebon<br>
                            e-mail : brsud.waled@gmail.com </p>
                    </td>
                    <td width="100%" rowspan="2">
                        <table class="table table-sm text-sm text-bold">
                            <tr>
                                <td width="40%">Nomor RM</td>
                                <td>: {{ $asskep[0]->no_rm }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $mt_pasien[0]->nama_px }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: @php echo date('d-M-Y',strtotime($mt_pasien[0]->tanggal_lahir)) @endphp</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: @if ($mt_pasien[0]->jenis_kelamin == 'L')
                                        Laki - Laki
                                    @elseif($mt_pasien[0]->jenis_kelamin == 'P')
                                        Perempuan
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold text-center">ASSESMEN KEPERAWATAN<br> RAWAT JALAN {{ strtoupper($kunjungan[0]->nama_unit )}}</td>
                </tr>
                <tr>
                    <td colspan="3">Tanggal kunjungan : @php echo date('d-M-Y',strtotime($kunjungan[0]->tgl_masuk)) @endphp</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-sm">
            <tr>
                <td colspan="2">{{ $asskep[0]->keterangan_cppt}}</td>
            </tr>
            <tr>
                <td>Hasil Pemeriksaan</td>
                <td>{{ $asskep[0]->tindakankeperawatan}}</td>
            </tr>
            <tr>
                <td>Riwayat Terapi</td>
                <td>
                    <table class="table table-sm">
                        <thead>
                            <th>Unit Terapi</th>
                            <th>Nama Terapi</th>
                        </thead>
                        <tbody>
                            @foreach($tindkan as $t)
                                <tr>
                                    <td>{{$t->nama_unit}}</td>
                                    <td>{{$t->NAMA_TARIF}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>Nama Pemeriksa</td>
                <td>{{ $asskep[0]->namapemeriksa}}</td>
            </tr>
        </table>
    </main>
    @else
    <main @if($asskep[0]->usia > 12 )style="margin-bottom:220px" @endif>
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td width="30%"><img width="100%" src="{{ asset('public/img/logo_rs.png') }}" alt="">
                    </td>
                    <td class="text-center text-bold text-xs" width="100%">PEMERINTAH KABUPATEN CIREBON <br>
                        RUMAH SAKIT UMUM DAERAH WALED<br>
                        <p class="text-xs">Jl.Prabu Kian Santang No.4 <br>Telp. 0231-661126 Fax.0231-664091 Cirebon<br>
                            e-mail : brsud.waled@gmail.com </p>
                    </td>
                    <td width="100%" rowspan="2">
                        <table class="table table-sm text-sm text-bold">
                            <tr>
                                <td width="40%">Nomor RM</td>
                                <td>: {{ $asskep[0]->no_rm }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $mt_pasien[0]->nama_px }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: @php echo date('d-M-Y',strtotime($mt_pasien[0]->tanggal_lahir)) @endphp</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: @if ($mt_pasien[0]->jenis_kelamin == 'L')
                                        Laki - Laki
                                    @elseif($mt_pasien[0]->jenis_kelamin == 'P')
                                        Perempuan
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold text-center">ASSESMEN KEPERAWATAN<br> RAWAT JALAN {{ strtoupper($kunjungan[0]->nama_unit )}}</td>
                </tr>
                <tr>
                    <td colspan="3">Tanggal kunjungan : @php echo date('d-M-Y',strtotime($kunjungan[0]->tgl_masuk)) @endphp</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td width="40%" class="text-bold">Sumber Data</td>
                    <td class="font-italic">{{ $asskep[0]->sumberdataperiksa }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Keluhan utama</td>
                    <td class="font-italic">{{ $asskep[0]->keluhanutama }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center text-bold bg-secondary">Skrinning nyeri</td>
                <tr>
                    <td class="text-bold">Apakah Pasien mengeluh nyeri</td>
                    <td class="font-italic">{{ $asskep[0]->Keluhannyeri }}</td>
                </tr>
                @if($asskep[0]->usia > 3)
                <tr>
                    <td class="text-bold">Skala Nyeri</td>
                    <td class="font-italic">{{ $asskep[0]->skalenyeripasien }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center"><img width="50%"
                            src="{{ asset('public/img/skalanyeri.jpg') }}" alt=""></td>
                </tr>
                @elseif($asskep[0]->usia >= 1 && $asskep[0]->usia <= 3)
                <tr>
                    <td colspan="2">
                        <table class="table table-sm">
                            <tr>
                                <td colspan="5" class="text-bold text-center bg-secondary">Metode FLACC ( PASIEN 1 - 3 Tahun )</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Kategori</td>
                                <td colspan="3">Score</td>
                                <td rowspan="2">Hasil</td>
                            </tr>
                            <tr>
                                <td>0</td>
                                <td>1</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Face ( Wajah)</td>
                                <td>Tidak ada ekspresi khusus, senyum</td>
                                <td>Menyeringai,mengerutkan dahi, tampak tidak tertarik ( kadang - kadang )</td>
                                <td>Dagu gemetar, geratu berulang( sering)</td>
                                <td>{{ $asskep[0]->face }}</td>
                            </tr>
                            <tr>
                                <td>Leg ( Posisi Kaki )</td>
                                <td>Posisi normal atau santai</td>
                                <td>Gelisah,tegang</td>
                                <td>Menendang, kaki tertekuk</td>
                                <td>{{ $asskep[0]->leg }}</td>
                            </tr>
                            <tr>
                                <td>Activity</td>
                                <td>Berbaring tengan,posisi normal, gerakan mudah</td>
                                <td>Menggeliat, tidak bisa diam, tegang</td>
                                <td>Kaku atau tegang</td>
                                <td>{{ $asskep[0]->Activity }}</td>
                            </tr>
                            <tr>
                                <td>Cry ( Menangis )</td>
                                <td>Tidak menangis</td>
                                <td>Merintih, merengek,kadang kadang,mengeluh</td>
                                <td>Terus menangis atau teriak</td>
                                <td>{{ $asskep[0]->Cry }}</td>
                            </tr>
                            <tr>
                                <td>Consolabity</td>
                                <td>Rileks</td>
                                <td>Dapat ditenangkan dengan sentuhan pelukan, bujukan, dialihkan</td>
                                <td>Sering mengeluh, sulit dibujuk</td>
                                <td>{{ $asskep[0]->Consolabity }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @elseif($asskep[0]->usia == 0)
                <tr>
                    <td colspan="2">
                        <table class="table table-sm">
                            <tr>
                                <td colspan="4" class="text-bold text-center bg-secondary">Metode NIPS ( PASIEN BAYU BARU LAHIR - 3O Hari )</td>
                            </tr>
                            <tr>
                                <td>Parameter</td>
                                <td>Nilai</td>
                                <td>Pemeriksaan Wajah</td>
                                <td>Hasil</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Ekspresi Wajah</td>
                                <td>0</td>
                                <td>Rileks</td>
                                <td rowspan="2">{{ $asskep[0]->ekspresiwajah }}</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Meringis</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Menangis</td>
                                <td>0</td>
                                <td>Tidak Menangis</td>
                                <td rowspan="3">{{ $asskep[0]->menangis }}</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Meringis</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Menangis Keras</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Pola Nafas</td>
                                <td>0</td>
                                <td>Rileks</td>
                                <td rowspan="2">{{ $asskep[0]->polanafas }}</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Perubahan pola nafas</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Lengan</td>
                                <td>0</td>
                                <td>Rileks</td>
                                <td rowspan="2">{{ $asskep[0]->lengan }}</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Fleksi</td>
                            </tr>
                            <tr>
                                <td rowspan="2">Kaki</td>
                                <td>0</td>
                                <td>Rileks</td>
                                <td rowspan="2">{{ $asskep[0]->kaki }}</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Fleksi</td>
                            </tr>
                            <tr>
                                <td rowspan="3">Keadaan Terangsang</td>
                                <td>0</td>
                                <td>Tidur</td>
                                <td rowspan="3">{{ $asskep[0]->keadaanterangsang }}</td>
                            </tr>
                            <tr>
                                <td>0</td>
                                <td>Bangun</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Rewel</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td colspan="4" class="text-center text-bold bg-secondary">Tanda Tanda vital</td>
                </tr>
                <tr>
                    <td width="40%">Tekanan Darah</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->tekanandarah }} mmHg</td>
                    <td>Frekuensi Nadi</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->frekuensinadi }} x/menit</td>
                </tr>
                <tr>
                    <td>Frekuensi Nafas</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->frekuensinapas }} x/menit</td>
                    <td>Suhu</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->suhutubuh }} °C </td>
                </tr>
                <tr>
                    <td>Berat badan / Tinggi Badan / IMT</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->beratbadan }} / {{ $asskep[0]->tinggibadan }} /
                        {{ $asskep[0]->imt }}</td>
                    <td>Umur</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->umur }}</td>
                </tr>
                <tr>
                    <td>Riwayat Psikologis</td>
                    <td colspan="3" class="text-bold font-italic">{{ $asskep[0]->Riwayatpsikologi }}
                        {{ $asskep[0]->keterangan_riwayat_psikolog }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center text-bold bg-secondary">Status Fungsional</td>
                </tr>
                <tr>
                    <td>Penggunaan alat bantu</td>
                    <td colspan="3" class="text-bold font-italic">{{ $asskep[0]->penggunaanalatbantu }}
                        {{ $asskep[0]->keterangan_alat_bantu }}</td>
                </tr>
                <tr>
                    <td>Cacat Tubuh</td>
                    <td colspan="3" class="text-bold font-italic">{{ $asskep[0]->cacattubuh }}
                        {{ $asskep[0]->keterangancacattubuh }}</td>
                </tr>
            </tbody>
        </table>
    </main>
    @if($asskep[0]->usia > 12)
    <main>
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td class="text-center text-bold bg-secondary">Assesmen Resiko Jatuh</td>
                </tr>
                <tr>
                    <td class="text-center text-bold bg-secondary">Metode Up and Go</td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-sm text-xs">
                            <thead>
                                <th>Faktor Resiko</th>
                                <th>Skala</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>a</td>
                                    <td>Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak
                                        tidak seimbang ( sempoyongan / limbung ) ?</td>
                                </tr>
                                <tr>
                                    <td>b</td>
                                    <td>Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
                                        penopang saat akan duduk ?</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Hasil : {{ $asskep[0]->resikojatuh }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-sm text-xs" style="margin-top:60px">
            <tbody>
                <tr>
                    <td class="text-center text-bold bg-secondary">Skrinning Gizi</td>
                </tr>
                <tr>
                    <td class="text-center text-bold bg-secondary">Metode Malnutrition Screnning Tools ( Pasien Dewasa )
                    </td>
                </tr>
                <tr>
                    <td>1. Apakah pasien mengalami penurunan berat badan yang tidak diinginkan dalam 6 bulan terakhir ?
                    </td>
                </tr>
                <tr>
                    <td class="text-bold font-italic bg-secondary">Hasil : {{ $asskep[0]->Skrininggizi }}</td>
                </tr>
                <tr>
                    <td>2. Apakah asupan makanan berkurang karena berkurangnya nafsu makan</td>
                </tr>
                <tr>
                    <td class="text-bold font-italic bg-secondary">Hasil : {{ $asskep[0]->status_asupanmkanan }}</td>
                </tr>
                <tr>
                    <td>3. Pasien dengan diagnosa khusus : Penyakit DM / Ginjal / Hati / Paru / Stroke / Kanker /
                        Penurunan imunitas geriatri, lain lain...</td>
                </tr>
                <tr>
                    <td class="text-bold font-italic bg-secondary">Hasil : {{ $asskep[0]->diagnosakhusus }}</td>
                </tr>
                <tr>
                    <td>4. Bila skor >= 2, pasien beresiko malnutrisi dilakukan pengkajian lanjut oleh ahli gizi</td>
                </tr>
                <tr>
                    <td class="text-bold font-italic bg-secondary">Hasil : {{ $asskep[0]->resikomalnutrisi }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td width="40%" class="font-italic">Diagnosa keperawatan / kebidanan</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->diagnosakeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Rencana Keperawatan / kebidanan</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->rencanakeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Tindakan Keperawatan / kebidanan </td>
                    <td class="text-bold font-italic">{{ $asskep[0]->tindakankeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Evaluasi Keperawatan / kebidanan</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->evaluasikeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Nama Perawat</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->namapemeriksa }}</td>
                </tr>
            </tbody>
        </table>
    </main>
    @else
    <main>
        <table class="table table-sm text-xs" style="">
            <tr>
                <td colspan="4" class="text-bold text-center bg-secondary">Assesmen resiko jatuh</td>
            </tr>
            <tr>
                <td colspan="4" class="text-bold text-center bg-secondary">Metode Humpty Dumpty</td>
            </tr>
            <tr>
                <td>Parameter</td>
                <td>Faktor Risiko</td>
                <td>Skor</td>
                <td>Hasil</td>
            </tr>
            <tr>
                <td rowspan="4">Umur</td>
                <td>Dibawah 3 tahun</td>
                <td>4</td>
                <td rowspan="4">{{ $asskep[0]->umur}}</td>
            </tr>
            <tr>
                <td>3-7 tahun</td>
                <td>3</td>
            </tr>
            <tr>
                <td>7 - 13 tahun</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Lebih dari 13 tahun</td>
                <td>1</td>
            </tr>
            <tr>
                <td rowspan="2">Jenis kelamin</td>
                <td>Laki - Laki</td>
                <td>2</td>
                <td rowspan="2">{{ $asskep[0]->jeniskelamin}}</td>
            </tr>
            <tr>
                <td>Perempuan</td>
                <td>1</td>
            </tr>
            <tr>
                <td rowspan="4">Diagnosis</td>
                <td>Gangguan neurologis</td>
                <td>4</td>
                <td rowspan="4">{{ $asskep[0]->diagnosis}}</td>
            </tr>
            <tr>
                <td>Perubahan dalam oksigenasi ( masalah saluran napas, dehidrasi, anemia, anorexia,sinkop,sakit kepala dll)</td>
                <td>3</td>
            </tr>
            <tr>
                <td>Kelainan psikis/perilaku</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Diagnosis lainnya</td>
                <td>1</td>
            </tr>
            <tr>
                <td rowspan="3">Gangguan kognitif</td>
                <td>Tidak menyadari keterbatasan diri</td>
                <td>3</td>
                <td rowspan="3">{{ $asskep[0]->gangguankoginitf}}</td>
            </tr>
            <tr>
                <td>Lupa akan adanya keterbatasan</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Orientasi baik terhadap diri sendiri</td>
                <td>1</td>
            </tr>
            <tr>
                <td rowspan="4">Faktor lingkungan</td>
                <td>Riwayat jatuh dari tempat tidur saat bayi / anak</td>
                <td>4</td>
                <td rowspan="4">{{ $asskep[0]->faktorlingkungan}}</td>
            </tr>
            <tr>
                <td>Pasien menggunakan alat bantu atau box / mebel</td>
                <td>3</td>
            </tr>
            <tr>
                <td>Pasien diletakan ditempat tidur</td>
                <td>2</td>
            </tr>
            <tr>
                <td>Diluar ruang rawat</td>
                <td>1</td>
            </tr>
            <tr>
                <td rowspan="3">Respon terhadap operasi / obat penenang / efek anestesi</td>
                <td>Dalam 24 jam</td>
                <td>3</td>
                <td rowspan="3">{{ $asskep[0]->responterhadapoperasi}}</td>
            </tr>
            <tr>
                <td>Dalam 48 jam</td>
                <td>2</td>
            </tr>
            <tr>
                <td> > 48 jam</td>
                <td>1</td>
            </tr>
        </table>
        <table class="table table-sm text-xs">
            <tr>
                <td colspan="3" class="text-bold text-center bg-secondary">Skrinning gizi</td>
            </tr>
            <tr>
                <td colspan="3" class="text-bold text-center bg-secondary">Metode Strong Kids ( Pasien anak - anak)</td>
            </tr>
            <tr>
                <td>No</td>
                <td>Pertanyaan</td>
                <td>Hasil</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Apakah pasien tampak kurus</td>
                <td>{{ $asskep[0]->anaktampakkurus}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Apakah ada penurunan BB selama satu bulan terakhir ( berdasarkan penilaian objektif data BB bila ada / penilaian subjektif dari orang tua pasien atau untuk bayi < 1 tahun : BB naik selama 3 bulan terakhir )</td>
                <td>{{ $asskep[0]->adapenurunanbbanak}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Apakah terdapat salah satu dari kondisi berikut ? <br>
                    - Diari ? kali/hari dan atau muntah > 3 kali/hari dalam seminggu terakhir <br>
                    asupan makanan berkurang selama 1 minggu terakhir.
                </td>
                <td>{{ $asskep[0]->anakadadiare}}</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Apakah terdapat penyakit atau keadaan yang mengakibatkan pasien beresiko mengalami malnutrisi</td>
                <td>{{ $asskep[0]->faktormalnutrisianak}}</td>
            </tr>
        </table>
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td width="40%" class="font-italic">Diagnosa keperawatan / kebidanan</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->diagnosakeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Rencana Keperawatan / kebidanan</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->rencanakeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Tindakan Keperawatan / kebidanan </td>
                    <td class="text-bold font-italic">{{ $asskep[0]->tindakankeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Evaluasi Keperawatan / kebidanan</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->evaluasikeperawatan }}</td>
                </tr>
                <tr>
                    <td class="font-italic">Nama Perawat</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->namapemeriksa }}</td>
                </tr>
            </tbody>
        </table>
    </main>
    @endif
    @endif
</body>

</html>
