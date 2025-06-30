<button class="btn btn-danger" onclick="kembali()">Kembali</button>
<div class="card mt-4">
    <div class="card-header">Detail SEP {{ $data[0]->no_sep }}</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            {{-- <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture"> --}}
                        </div>
                        <h3 class="profile-username text-center">{{ strtoupper($data[0]->nama_px) }}</h3>

                        <p class="text-muted text-center">{{ $data[0]->rm }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nomor Kartu</b> <a class="float-right text-dark">{{ $mt_pasien[0]->no_Bpjs }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Alamat Pasien</b> <a class="float-right text-dark">{{ $mt_pasien[0]->alamatpx }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Nomor SEP</b> <a class="float-right text-dark">{{ $data[0]->no_sep }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>DPJP UTAMA</b> <a class="float-right text-dark">{{ $data[0]->dpjp }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>DPJP Lainnya</b> <a class="float-right text-dark">
                                    @foreach ($datadokter as $dd)
                                        @if ($dd->lay_det_dokter1 != $data[0]->dpjp)
                                            {{ $dd->lay_det_dokter1 }} <br>
                                        @endif
                                    @endforeach
                                </a>
                            </li>
                        </ul>
                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Data Dokter</div>
                    <div class="card-body">
                        @if (count($status_sep) > 0)
                            @if ($status_sep[0]->Prosedur != '-')
                                Prosedur
                            @elseif ($status_sep[0]->Prosedur == '-')
                                Non Prosedur
                            @endif
                        @endif
                        <table id="tabeldetail2" class="table table-sm table-bordered">
                            <thead>
                                <th>Nama Dokter</th>
                                <th>Detail Layanan</th>
                            </thead>
                            <tbody>
                                @foreach ($datadokter as $dd)
                                    <tr>
                                        <td>{{ $dd->lay_det_dokter1 }}</td>
                                        <td>
                                            @foreach ($data as $d)
                                                @if ($dd->lay_det_dokter1 == $d->lay_det_dokter1)
                                                    {{ strtoupper($d->lay_det_nm_tindakan) }} <br>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        Tarif Jasa Medis Pasien BPJS
                        JENIS SEP @if (count($status_sep) > 0)
                            @if ($status_sep[0]->Prosedur != '-')
                                Prosedur
                                Dengan Jumlah dokter lain sebanyak {{ count($datadokterlain) }}.
                                <br>
                                Maka jasa yang diperoleh adalah : <br><br>
                                Total Klaim INACBGs <p class="font-italic text-bold"> RP.
                                    {{ number_format($data[0]->Total_klaim, 2) }} </p> <br>

                                @if (count($datadokterlain) == 0)
                                    <p class="font-italic text-danger">
                                        A. Bila tidak konsul atau rawat bersama ke bagian lain DPJP mendapat 15% dari
                                        INACBGs bila menggunakan anestesi, atau 20% dari INACBGs bila tidak menggunakan
                                        anestesi (anestesi lokal)
                                        DPJP = Dokter Primer di reg. masuk inap.
                                        Tidak konsul, artinya dokter primer merawat sendiri (tindakan visite atas nama
                                        DPJP sendiri, tidak ada visite dokter lain)</p><br><br>
                                    DPJP Mendapat 20 % dari INACBGs.
                                    <p class="font-italic text-bold">
                                        Rp
                                        .{{ number_format(($data[0]->Total_klaim * 20) / 100) }} (
                                        *tanpa anestesi )</p>
                                    </p>
                                @elseif(count($datadokterlain) == 1)
                                    @foreach ($dataSet as $dr)
                                        @if ($dr > 1)
                                            <p class="font-italic text-danger">
                                                D. Bila dirawat bersama dengan satu bagian lain menggunakan anestesi
                                                DPJP
                                                mendapat 11%, anestesi 5% dan dokter spesialis bagian lain mendapat 4%
                                                bila
                                                menggunakan anestesi. DPJP mendapat 16% dan dokter spesialis bagian lain
                                                mendapat 4% bila tidak menggunakan anestesi.
                                                (artinya jika ada visite dokter lain (1 dokter lain) sebanyak lebih dari
                                                1
                                                kali visite)
                                            </p>
                                            <br>
                                            DPJP Mendapat 16 % dari INACBGs. <p class="font-italic text-bold">
                                                Rp
                                                .{{ number_format(($data[0]->Total_klaim * 16) / 100) }} (
                                                *tanpa anestesi )</p>

                                            Dokter Lain Mendapat 1% dari INACBGs <br>
                                            <p class="font-italic text-bold"> Rp.
                                                {{ number_format(($data[0]->Total_klaim * 4) / 100) }} ( *tanpa
                                                anestesi ) </p>
                                        @else
                                            @foreach ($dataSet as $dr)
                                                @if ($dr == 1)
                                                    @php
                                                        $p = 10 - $jlhdokterlain;
                                                        $p2 = $jlhdokterlain;
                                                    @endphp
                                                    <p class="font-italic text-danger">
                                                        B. Bila konsul/toleransi operasi ke bagian lain, DPJP mendapat
                                                        14% ,
                                                        anestesi mendapat 5%, dan konsulen mendapat 1% bila menggunakan
                                                        anestesi. DPJP mendapat 19% , konsulen mendapat 1% bila tidak
                                                        menggunakan anestesi
                                                        (artinya jika ada visite dokter lain (1 dokter lain) sebanyak 1
                                                        kali
                                                        visite atau konsultasi toleransi operasi)
                                                    </p>
                                                    <br><br>

                                                    DPJP Mendapat 19 % dari INACBGs. <p class="font-italic text-bold">
                                                        Rp
                                                        .{{ number_format(($data[0]->Total_klaim * 19) / 100) }} (
                                                        *tanpa anestesi )</p>
                                                    <br>
                                                @endif
                                            @endforeach
                                            Dokter Lain Mendapat 1% dari INACBGs <br>
                                            <p class="font-italic text-bold"> Rp.
                                                {{ number_format(($data[0]->Total_klaim * 1) / 100) }} ( *tanpa
                                                anestesi ) </p>
                                        @endif
                                    @endforeach
                                @elseif(count($datadokterlain) > 1)
                                    @php
                                        $jlhvisit = 0;
                                        $p3 = $jlhdokterlain;
                                    @endphp
                                    @foreach ($dataSet as $dr)
                                        @php $jlhvisit = $jlhvisit + $dr @endphp
                                    @endforeach
                                    @if ($jlhvisit == $jlhdokterlain)
                                        @php
                                            $dd = 20 - $p3;
                                        @endphp
                                        <p class="font-italic text-danger">
                                            C. Bila konsul/toleransi operasi ke beberapa bagian lain, DPJP mendapat 15%
                                            ,anestesi 5%, dan konsulen lain masing-masing mendapatkan 1% dengan
                                            mengurangi
                                            proporsi dpjp bila menggunakan anestesi. lain, DPJP mendapat 20% dan
                                            konsulen
                                            lain masing-masing mendapatkan 1% dengan mengurangi proporsi dpjp bila tidak
                                            menggunakan anestesi
                                            (artinya jika ada visite dokter lain (lebih dari 1 dokter lain) sebanyak 1
                                            kali
                                            visite atau konsul toleransi operasi, dibatasi konsul toleransi operasi atau
                                            konsul sewaktu maksimal 2 bagian dalam 1 episode rawat)</p><br><br>

                                        DPJP Mendapat {{ 20 - $jlhdokterlain }} % dari INACBGs. <p
                                            class="font-italic text-bold"> Rp
                                            .{{ number_format(($data[0]->Total_klaim * $dd) / 100) }} ( *tanpa
                                            anestesi ) </p> <br>

                                        Dokter Lain Masing masing mendapat 1 % dari INACBGs.
                                        <p class="font-italic text-bold"> Rp
                                            .{{ number_format(($data[0]->Total_klaim * 1) / 100) }} ( *tanpa
                                            anestesi ) </p> <br>
                                    @elseif($jlhvisit > $jlhdokterlain)
                                        <p class="font-italic text-danger">
                                            E . Bila dirawat bersama dengan beberpa bagian lain menggunakan anestesi
                                            DPJP
                                            mendapat 11%, anestesi 5% dan dokter spesialis bagian lain berbagi dari 4%
                                            bila
                                            menggunakan anestesi. DPJP mendapat 16% dan dokter spesialis bagian lain
                                            berbagi
                                            dari 4% bila tidak menggunakan anestesi.
                                            (artinya jika ada visite dokter lain (lebih dari 1 dokter lain) sebanyak
                                            lebih
                                            dari 1 kali visite, dibatasi rawat bersama maksimal 2 bagian dalam 1 episode
                                            rawat)</p><br><br>

                                        DPJP Mendapat 16 % dari INACBGs. <p class="font-italic text-bold"> Rp
                                            .{{ number_format(($data[0]->Total_klaim * 16) / 100) }} ( *tanpa
                                            anestesi ) </p> <br>
                                        Dokter Lain Masing masing berbagi dari 4% INACBGs.
                                        <p class="font-italic text-bold"> Rp
                                            .{{ number_format(($data[0]->Total_klaim * 4) / 100) }} ( *tanpa
                                            anestesi ) </p> <br>
                                        @php
                                            $ttt = $data[0]->Total_klaim * 4 / 100;
                                            $perdokter = $ttt / $jlhdokterlain;
                                        @endphp

                                        @foreach ($datadokterlain as $d )
                                               {{ $d->lay_det_dokter1 }} : <a class="text-bold font-italic">Rp.{{ number_format($perdokter,2) }} ( *tanpa
                                            anestesi ) </a><br>
                                        @endforeach
                                    @endif
                                @endif
                            @elseif ($status_sep[0]->Prosedur == '-')
                                Non Prosedur

                                Dengan Jumlah dokter lain sebanyak {{ count($datadokterlain) }}.
                                <br>
                                Maka jasa yang diperoleh adalah : <br><br>

                                Total Klaim INACBGs <p class="font-italic text-bold"> RP.
                                    {{ number_format($data[0]->Total_klaim, 2) }} </p> <br>

                                @if (count($datadokterlain) == 0)
                                    DPJP mendapat 10% dari INACBGs.
                                    <p class="font-italic text-bold"> Rp.
                                        {{ number_format(($data[0]->Total_klaim * 10) / 100) }} </p>
                                @elseif(count($datadokterlain) == 1)
                                    @foreach ($dataSet as $dr)
                                        @if ($dr > 1)
                                            DPJP Mendapat 6 % dari INACBGs.
                                            <p class="font-italic text-bold"> Rp.
                                                {{ number_format(($data[0]->Total_klaim * 6) / 100) }} </p>
                                        @else
                                            @foreach ($dataSet as $dr)
                                                @if ($dr == 1)
                                                    @php
                                                        $p = 10 - $jlhdokterlain;
                                                        $p2 = $jlhdokterlain;
                                                    @endphp
                                                    DPJP Mendapat {{ 10 - $jlhdokterlain }} % dari INACBGs. <p
                                                        class="font-italic text-bold"> Rp
                                                        .{{ number_format(($data[0]->Total_klaim * $p) / 100) }}
                                                    </p>
                                                    <br>

                                                    Dokter Lain Mendapat 1% dari INACBGs <br>
                                                    <p class="font-italic text-bold"> Rp.
                                                        {{ number_format(($data[0]->Total_klaim * $p2) / 100) }}
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @elseif(count($datadokterlain) > 1)
                                    @php
                                        $jlhvisit = 0;
                                        $p3 = $jlhdokterlain;
                                    @endphp
                                    @foreach ($dataSet as $dr)
                                        @php $jlhvisit = $jlhvisit + $dr @endphp
                                    @endforeach
                                    @if ($jlhvisit == $jlhdokterlain)
                                        DPJP Mendapat {{ 10 - $jlhdokterlain }} % dari INACBGs. <p
                                            class="font-italic text-bold"> Rp
                                            .{{ number_format(($data[0]->Total_klaim * $p3) / 100) }} </p> <br>
                                    @elseif($jlhvisit > $jlhdokterlain)
                                        DPJP Mendapat 6 % dari INACBGs.
                                        <p class="font-italic text-bold"> Rp.
                                            {{ number_format(($data[0]->Total_klaim * 6) / 100) }} </p>
                                    @endif
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function kembali() {
        $('.v_utama').removeAttr('hidden', true)
        $('.v_kedua').attr('hidden', true)
    }
</script>
<script>
    $(function() {
        $("#tabeldetail").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 12,
            "searching": true,
            "ordering": false,
        })
    });
    $(function() {
        $("#tabeldetail2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 12,
            "searching": true,
            "ordering": false,
        })
    });
