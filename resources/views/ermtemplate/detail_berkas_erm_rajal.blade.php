{{-- <div  class="accordion" id="accordionExample">
    @foreach ($header as $h)
        <div class="card">
            <div class="card-header" id="headingOne{{ $h->id }}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left text-dark text-bold" type="button"
                        data-toggle="collapse" data-target="#collapseOne{{ $h->id }}" aria-expanded="true"
                        aria-controls="collapseOne{{ $h->id }}">
                        Assesmen Awal {{ $h->tglk }} {{ $h->nama_unit }}
                    </button>
                </h2>
            </div>
            <div id="collapseOne{{ $h->id }}" class="collapse" aria-labelledby="headingOne{{ $h->id }}"
                data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link" href="#askep{{ $h->id }}"
                                        data-toggle="tab">Assesmen Awal keperawatan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#asdok{{ $h->id }}"
                                        data-toggle="tab">Assesmen Awal
                                        Medis</a>
                                </li>
                                <li class="nav-item"><a class="nav-link active" href="#cppt{{ $h->id }}"
                                        data-toggle="tab">CPPT</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="askep{{ $h->id }}">
                                    <div class="assesmenawal">
                                        <form action="" class="formassesmenawal">
                                            <div class="accordion" id="accordionExampleSUB">
                                                <div class="card">
                                                    <div class="card-header" id="headingOne">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-link btn-block text-left text-dark text-bold"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#SUBJECT" aria-expanded="true"
                                                                aria-controls="SUBJECT">
                                                                <i
                                                                    class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                SUBJECT
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="SUBJECT" class="collapse" aria-labelledby="headingOne"
                                                        data-parent="#accordionExampleSUB">
                                                        <div class="card-body">
                                                            <table class="table table-sm table-bordered table-striped">
                                                                <tr>
                                                                    <td class="text-bold">Tanggal Kunjungan</td>
                                                                    <td>{{ $h->tanggalkunjungan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-bold">Tanggal Pemeriksaan</td>
                                                                    <td>{{ $h->tanggalperiksa }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-bold">Sumber Data</td>
                                                                    <td>
                                                                        {{ $h->sumberdataperiksa }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-bold">Keluhan Utama</td>
                                                                    <td>
                                                                        {{ $h->keluhanutama }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="text-center text-bold">
                                                                        Assesmen Nyeri</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-bold">Pasien Mengeluh Nyeri</td>
                                                                    <td>
                                                                        @if ($h->Keluhannyeri == 1)
                                                                            Ada
                                                                        @else
                                                                            Tidak Ada
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-bold text-center" colspan="2">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div class="accordion" id="accordionExample1">
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingOne">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left text-dark text-bold"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#keluhannyeri1"
                                                                                            aria-expanded="true"
                                                                                            aria-controls="keluhannyeri1">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode Wong Baker Faces
                                                                                            Scale (
                                                                                            Paien > 3 Tahun)
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="keluhannyeri1" class="collapse"
                                                                                    aria-labelledby="headingOne"
                                                                                    data-parent="#accordionExample1">
                                                                                    <div class="card-body">
                                                                                        <table>
                                                                                            <tr>
                                                                                                <td class="text-bold"
                                                                                                    rowspan="2">
                                                                                                    Skala
                                                                                                    Nyeri</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '0') checked @endif
                                                                                                            id="a"
                                                                                                            value="0">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">0</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '1') checked @endif
                                                                                                            id="a"
                                                                                                            value="1">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">1</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '2') checked @endif
                                                                                                            id="a"
                                                                                                            value="2">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">2</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '3') checked @endif
                                                                                                            id="a"
                                                                                                            value="3">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">3</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '4') checked @endif
                                                                                                            id="a"
                                                                                                            value="4">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">4</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '5') checked @endif
                                                                                                            id="a"
                                                                                                            value="5">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">5</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '6') checked @endif
                                                                                                            id="a"
                                                                                                            value="6">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">6</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '7') checked @endif
                                                                                                            id="a"
                                                                                                            value="7"f>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">7</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '8') checked @endif
                                                                                                            id="a"
                                                                                                            value="8">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">8</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '9') checked @endif
                                                                                                            id="a"
                                                                                                            value="9">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">9</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="a"
                                                                                                            @if ($h->skalenyeripasien == '10') checked @endif
                                                                                                            id="a"
                                                                                                            value="10">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">10</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img width="50%"
                                                                                                        src="{{ asset('public/newfolder/skalanyeri.jpg') }}"
                                                                                                        alt="">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingTwo">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left collapsed text-dark text-bold"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#keluhannyeri2"
                                                                                            aria-expanded="false"
                                                                                            aria-controls="keluhannyeri2">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode FLACC Scale ( Pasien
                                                                                            1 -
                                                                                            3
                                                                                            Tahun)
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="keluhannyeri2"
                                                                                    class="collapse"
                                                                                    aria-labelledby="headingTwo"
                                                                                    data-parent="#accordionExample1">
                                                                                    <div class="card-body">
                                                                                        <div class="card">
                                                                                            <div
                                                                                                class="card-header bg-light">
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <table
                                                                                                    class="table table-sm text-sm">
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            Kategori
                                                                                                        </td>
                                                                                                        <td
                                                                                                            colspan="3">
                                                                                                            Score</td>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            Nilai Score
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>0</td>
                                                                                                        <td>1</td>
                                                                                                        <td>2</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Face<br> (
                                                                                                            Wajah )</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="face"
                                                                                                                id="face"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">
                                                                                                                Tidak
                                                                                                                ada
                                                                                                                ekspresi
                                                                                                                khusus,
                                                                                                                senyum
                                                                                                            </label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="face"
                                                                                                                id="face"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Menyeringai,
                                                                                                                mengerutkan
                                                                                                                dahi,
                                                                                                                tampak
                                                                                                                tidak
                                                                                                                tertarik
                                                                                                                (kadang
                                                                                                                -
                                                                                                                kadang)
                                                                                                            </label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="face"
                                                                                                                id="face"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Dagu
                                                                                                                Gemetar,
                                                                                                                gerutu
                                                                                                                berulang
                                                                                                                ( sering
                                                                                                                )</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodeflac_1"
                                                                                                                id="skormetodeflac_1"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Leg<br> (
                                                                                                            Posisi Kaki
                                                                                                            )</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="kaki"
                                                                                                                id="kaki"
                                                                                                                onclick="cek_metode_flac2()"
                                                                                                                value="0"S>
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Posisi
                                                                                                                normal
                                                                                                                atau
                                                                                                                santai</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="kaki"
                                                                                                                id="kaki">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Gelisah,
                                                                                                                tegang</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="kaki"
                                                                                                                id="kaki"
                                                                                                                onclick="cek_metode_flac2()"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Menendang,
                                                                                                                kaki
                                                                                                                tertekuk</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodeflac_2"
                                                                                                                id="skormetodeflac_2"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Activity
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Activity"
                                                                                                                id="Activity"
                                                                                                                onclick="cek_metode_flac3()"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Berbaring
                                                                                                                tenang,
                                                                                                                posisi
                                                                                                                normal,
                                                                                                                gerakan
                                                                                                                mudah</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Activity"
                                                                                                                id="Activity"
                                                                                                                onclick="cek_metode_flac3()"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Menggeliat,
                                                                                                                tidak
                                                                                                                bisa
                                                                                                                diam,
                                                                                                                tegang</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Activity"
                                                                                                                id="Activity"
                                                                                                                onclick="cek_metode_flac3()"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Kaku
                                                                                                                atau
                                                                                                                tegang</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodeflac_3"
                                                                                                                id="skormetodeflac_3"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Cry</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Cry"
                                                                                                                id="Cry"
                                                                                                                onclick="cek_metode_flac4()"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Tidak
                                                                                                                Menangis</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Cry"
                                                                                                                id="Cry"
                                                                                                                onclick="cek_metode_flac4()"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Merintih,
                                                                                                                merengek,
                                                                                                                kadang
                                                                                                                kadang
                                                                                                                mengeluh</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Cry"
                                                                                                                id="Cry"
                                                                                                                onclick="cek_metode_flac4()"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Terus
                                                                                                                menangis
                                                                                                                atau
                                                                                                                teriak</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodeflac_4"
                                                                                                                id="skormetodeflac_4"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Consolabity
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Consolabity"
                                                                                                                id="Consolabity"
                                                                                                                onclick="cek_metode_flac5()"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Rileks</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Consolabity"
                                                                                                                id="Consolabity"
                                                                                                                onclick="cek_metode_flac5()"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Dapat
                                                                                                                ditenangkan
                                                                                                                dengan
                                                                                                                sentuhan
                                                                                                                pelukan,
                                                                                                                bujukan,
                                                                                                                dialihkan</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="Consolabity"
                                                                                                                id="Consolabity"
                                                                                                                onclick="cek_metode_flac5()"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Sering
                                                                                                                mengeluh,
                                                                                                                suliit
                                                                                                                dibujuk</label>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodeflac_5"
                                                                                                                id="skormetodeflac_5"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingThree">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left collapsed text-dark text-bold"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#keluhannyeri3"
                                                                                            aria-expanded="false"
                                                                                            aria-controls="keluhannyeri3">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode NIPS ( Pasien bayi
                                                                                            baru
                                                                                            lahir
                                                                                            - 30
                                                                                            hari)
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="keluhannyeri3"
                                                                                    class="collapse"
                                                                                    aria-labelledby="headingThree"
                                                                                    data-parent="#accordionExample1">
                                                                                    <div class="card-body">
                                                                                        <div class="card">
                                                                                            <div
                                                                                                class="card-header bg-light">
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <table
                                                                                                    class="table table-sm table-bordered">
                                                                                                    <tr>
                                                                                                        <td>Parameter
                                                                                                        </td>
                                                                                                        <td>Nilai</td>
                                                                                                        <td>Pemeriksaan
                                                                                                            Fisik</td>
                                                                                                        <td>Skor Pasien
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            Ekspresi
                                                                                                            wajah</td>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="ekspresiwajah"
                                                                                                                id="ekspresiwajah"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Rileks</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodenips_1"
                                                                                                                id="skormetodenips_1"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="ekspresiwajah"
                                                                                                                id="ekspresiwajah"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Meringis</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="3">
                                                                                                            Menangis
                                                                                                        </td>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="menangis"
                                                                                                                id="menangis"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Tidak
                                                                                                                menangis</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="3">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodenips_2"
                                                                                                                id="skormetodenips_2"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="menangis"
                                                                                                                id="menangis"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">meringis</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>2</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="menangis"
                                                                                                                id="menangis"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">menangis
                                                                                                                keras</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            Pola nafas
                                                                                                        </td>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="polanafas"
                                                                                                                id="polanafas"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Rileks</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodenips_3"
                                                                                                                id="skormetodenips_3"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="polanafas"
                                                                                                                id="polanafas"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Perubahan
                                                                                                                pola
                                                                                                                nafas</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            Lengan</td>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="lengan"
                                                                                                                id="lengan"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Rileks</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodenips_4"
                                                                                                                id="skormetodenips_4"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="lengan"
                                                                                                                id="lengan"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Fleksi</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            Kaki</td>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="kaki2"
                                                                                                                id="kaki2"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Rileks</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodenips_5"
                                                                                                                id="skormetodenips_5"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="kaki2"
                                                                                                                id="kaki2"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Fleksi</label>
                                                                                                        </td>
                                                                                                    </tr>

                                                                                                    <tr>
                                                                                                        <td
                                                                                                            rowspan="3">
                                                                                                            Keadaan
                                                                                                            terangsang
                                                                                                        </td>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="keadaanterangsang"
                                                                                                                id="keadaanterangsang"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Tidur</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="3">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skormetodenips_6"
                                                                                                                id="skormetodenips_6"
                                                                                                                value="">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>0</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="keadaanterangsang"
                                                                                                                id="keadaanterangsang"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Bangun</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="keadaanterangsang"
                                                                                                                id="keadaanterangsang"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">Rewel</label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingTwo">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-link btn-block text-left text-dark  text-bold collapsed"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#OBJECT" aria-expanded="false"
                                                                aria-controls="OBJECT">
                                                                <i
                                                                    class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                OBJECT
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="OBJECT" class="collapse" aria-labelledby="headingTwo"
                                                        data-parent="#accordionExampleSUB">
                                                        <div class="card-body">
                                                            <table class="table table-bordered table-sm">
                                                                <tr>
                                                                    <td colspan="2"
                                                                        class="text-center text-bold bg-light">Tanda
                                                                        Tanda Vital
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Tekanan
                                                                                darah</label>
                                                                            <div class="input-group mb-3">
                                                                                <input readononly type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan tekanan darah pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="tekanandarah"
                                                                                    id="tekanandarah"
                                                                                    value="{{ $h->tekanandarah }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2">mmHg</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Frekuensi
                                                                                nadi</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan frekuensi nadi pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="frekuensinadi"
                                                                                    id="frekuensinadi"
                                                                                    value="{{ $h->frekuensinadi }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2">x/menit</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Frekuensi
                                                                                Nafas</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan frekuensi nafas pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="frekuensinafas"
                                                                                    id="frekuensinafas"
                                                                                    value="{{ $h->frekuensinapas }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2">x/menit</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleInputEmail1">Suhu</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan suhu tubuh pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="suhu" id="suhu"
                                                                                    value="{{ $h->suhutubuh }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2">°C</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Berat
                                                                                Badan</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan berat badan pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="beratbadanpasien"
                                                                                    id="beratbadanpasien"
                                                                                    value="{{ $h->beratbadan }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">Tinggi
                                                                                Badan</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan tinggi badan pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="tinggibadan"
                                                                                    id="tinggibadan"
                                                                                    value="{{ $h->tinggibadan }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">IMT</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan IMT pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="imt" id="imt"
                                                                                    value="{{ $h->imt }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleInputEmail1">Umur</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    placeholder="masukan Umur pasien ..."
                                                                                    aria-label="Recipient's username"
                                                                                    aria-describedby="basic-addon2"
                                                                                    name="umurpasien" id="umurpasien"
                                                                                    value="{{ $h->usia }}">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text"
                                                                                        id="basic-addon2"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Riwayat Psikologis</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="riwayatpsikologis"
                                                                                id="riwayatpsikologis"
                                                                                value="Tidak Ada">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio1">Tidak ada</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="riwayatpsikologis"
                                                                                id="riwayatpsikologis" value="Cemas">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Cemas</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="riwayatpsikologis"
                                                                                id="riwayatpsikologis" value="Sedih">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Sedih</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="riwayatpsikologis"
                                                                                id="riwayatpsikologis" value="Lain">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Lain - Lain</label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleFormControlTextarea1">Keterangan</label>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">Status Fungsional</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Penggunaan alat bantu</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="penggunaanalatbantu"
                                                                                id="penggunaanalatbantu"
                                                                                value="Tidak Ada">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio1">Tidak ada</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="penggunaanalatbantu"
                                                                                id="penggunaanalatbantu"
                                                                                value="tongkat">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Tongkat</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="penggunaanalatbantu"
                                                                                id="penggunaanalatbantu"
                                                                                value="kursi roda">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Kursi roda</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio"
                                                                                name="penggunaanalatbantu"
                                                                                id="penggunaanalatbantu"
                                                                                value="lain - lain">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Lain - Lain</label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleFormControlTextarea1">Keterangan</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cacat Tubuh</td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="cacattubuh"
                                                                                id="cacattubuh" value="Tidak Ada">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio1">Tidak ada</label>
                                                                        </div>
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input"
                                                                                type="radio" name="cacattubuh"
                                                                                id="cacattubuh" value="ada">
                                                                            <label class="form-check-label"
                                                                                for="inlineRadio2">Ada</label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="exampleFormControlTextarea1">Keterangan</label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">Assesmen Resiko Jatuh</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div class="accordion" id="accordionExample3">
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingOne">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left text-bold text-dark"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#assesmenresiko1"
                                                                                            aria-expanded="true"
                                                                                            aria-controls="assesmenresiko1">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode Up and
                                                                                            Go
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="assesmenresiko1"
                                                                                    class="collapse"
                                                                                    aria-labelledby="headingOne"
                                                                                    data-parent="#accordionExample3">
                                                                                    <div class="card-body">
                                                                                        <div class="card">
                                                                                            <div class="card-header">
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <table
                                                                                                    class="table table-sm table-bordered">
                                                                                                    <thead>
                                                                                                        <th>Faktor
                                                                                                            resiko</th>
                                                                                                        <th>Skala</th>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>a</td>
                                                                                                            <td>Perhatikan
                                                                                                                cara
                                                                                                                berjalan
                                                                                                                pasien
                                                                                                                saat
                                                                                                                akan
                                                                                                                duduk
                                                                                                                dikursi.
                                                                                                                Apakah
                                                                                                                pasien
                                                                                                                tampak
                                                                                                                tidak
                                                                                                                seimbang
                                                                                                                (sempoyongan
                                                                                                                /
                                                                                                                limbung)
                                                                                                                ?</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>b</td>
                                                                                                            <td>Apakah
                                                                                                                pasien
                                                                                                                memegang
                                                                                                                pinggiran
                                                                                                                kursi
                                                                                                                atau
                                                                                                                meja
                                                                                                                atau
                                                                                                                benda
                                                                                                                lain
                                                                                                                sebagai
                                                                                                                penopang
                                                                                                                saat
                                                                                                                akan
                                                                                                                duduk ?
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td colspan="2"
                                                                                                                class="text-center">
                                                                                                                Hasil
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                colspan="2">
                                                                                                                <div
                                                                                                                    class="form-check">
                                                                                                                    <input
                                                                                                                        class="form-check-input"
                                                                                                                        type="radio"
                                                                                                                        name="resikojatuh"
                                                                                                                        id="resikojatuh"
                                                                                                                        value="0">
                                                                                                                    <label
                                                                                                                        class="form-check-label"
                                                                                                                        for="exampleRadios1">
                                                                                                                        Tidak
                                                                                                                        Beresiko
                                                                                                                        (
                                                                                                                        Tidak
                                                                                                                        ditemukan
                                                                                                                        a
                                                                                                                        dan
                                                                                                                        b
                                                                                                                        )
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="form-check">
                                                                                                                    <input
                                                                                                                        class="form-check-input"
                                                                                                                        type="radio"
                                                                                                                        name="resikojatuh"
                                                                                                                        id="resikojatuh"
                                                                                                                        value="1">
                                                                                                                    <label
                                                                                                                        class="form-check-label"
                                                                                                                        for="exampleRadios1">
                                                                                                                        Risiko
                                                                                                                        rendah
                                                                                                                        (
                                                                                                                        ditemukan
                                                                                                                        a
                                                                                                                        atau
                                                                                                                        b)
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="form-check">
                                                                                                                    <input
                                                                                                                        class="form-check-input"
                                                                                                                        type="radio"
                                                                                                                        name="resikojatuh"
                                                                                                                        id="resikojatuh"
                                                                                                                        value="2">
                                                                                                                    <label
                                                                                                                        class="form-check-label"
                                                                                                                        for="exampleRadios1">
                                                                                                                        Risiko
                                                                                                                        tinggi
                                                                                                                        (
                                                                                                                        a
                                                                                                                        dan
                                                                                                                        b
                                                                                                                        ditemukan
                                                                                                                        )
                                                                                                                    </label>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingTwo">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left collapsed text-dark text-bold"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#assesmenresiko2"
                                                                                            aria-expanded="false"
                                                                                            aria-controls="assesmenresiko2">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode Humpty
                                                                                            Dumpty
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="assesmenresiko2"
                                                                                    class="collapse"
                                                                                    aria-labelledby="headingTwo"
                                                                                    data-parent="#accordionExample3">
                                                                                    <div class="card-body">

                                                                                        <div class="card">
                                                                                            <div class="card-header">
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <table
                                                                                                    class="table table-sm table-bordered">
                                                                                                    <thead>
                                                                                                        <th>Parameter
                                                                                                        </th>
                                                                                                        <th>Faktor
                                                                                                            risiko</th>
                                                                                                        <th>Skor</th>
                                                                                                        <th>Nilai Skor
                                                                                                        </th>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="5">
                                                                                                                Umur
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="umuranak"
                                                                                                                    id="umuranak"
                                                                                                                    value="4">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Dibawah
                                                                                                                    3
                                                                                                                    tahun</label>
                                                                                                            </td>
                                                                                                            <td>4</td>
                                                                                                            <td
                                                                                                                rowspan="5">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_1"
                                                                                                                    id="skormetodehumpty_1"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="umuranak"
                                                                                                                    id="umuranak">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">3
                                                                                                                    -
                                                                                                                    7
                                                                                                                    tahun</label>
                                                                                                            </td>
                                                                                                            <td>3</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="umuranak"
                                                                                                                    id="umuranak">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">7
                                                                                                                    -
                                                                                                                    13
                                                                                                                    tahun</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="umuranak"
                                                                                                                    id="umuranak">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Lebih
                                                                                                                    dari
                                                                                                                    13
                                                                                                                    tahun</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="umuranak"
                                                                                                                    id="umuranak"
                                                                                                                    onclick="cekmetodehumpty_1()"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">-</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="3">
                                                                                                                Jenis
                                                                                                                Kelamin
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="jeniskelamin"
                                                                                                                    id="jeniskelamin"
                                                                                                                    value="2">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Laki
                                                                                                                    -
                                                                                                                    Laki</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                            <td
                                                                                                                rowspan="3">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_2"
                                                                                                                    id="skormetodehumpty_2"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="jeniskelamin"
                                                                                                                    id="jeniskelamin"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Perempuan</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="jeniskelamin"
                                                                                                                    id="jeniskelamin"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">-</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="5">
                                                                                                                Diagnosis
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="diagnosis"
                                                                                                                    id="diagnosis">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Gangguan
                                                                                                                    neurologis</label>
                                                                                                            </td>
                                                                                                            <td>4</td>
                                                                                                            <td
                                                                                                                rowspan="5">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_3"
                                                                                                                    id="skormetodehumpty_3"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="diagnosis"
                                                                                                                    id="diagnosis">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Perubahan
                                                                                                                    dalam
                                                                                                                    oksigenisasi
                                                                                                                    (
                                                                                                                    masalah
                                                                                                                    saluran
                                                                                                                    napas,
                                                                                                                    dehidrasi,
                                                                                                                    anemia,
                                                                                                                    anorexia,
                                                                                                                    sinkop,
                                                                                                                    sakit
                                                                                                                    kepala,
                                                                                                                    dll
                                                                                                                    )</label>
                                                                                                            </td>
                                                                                                            <td>3</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="diagnosis"
                                                                                                                    id="diagnosis">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Kelainan
                                                                                                                    psikis/perilaku</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                            <td></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="diagnosis"
                                                                                                                    id="diagnosis">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Diagnosis
                                                                                                                    lainnya</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="diagnosis"
                                                                                                                    id="diagnosis"
                                                                                                                    onclick="cekmetodehumpty_3()"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">-</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="4">
                                                                                                                Gangguan
                                                                                                                kognitif
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="gangguankognitif"
                                                                                                                    id="gangguankognitif">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Tidak
                                                                                                                    menyadari
                                                                                                                    keterbatasan
                                                                                                                    diri</label>
                                                                                                            </td>
                                                                                                            <td>3</td>
                                                                                                            <td
                                                                                                                rowspan="4">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_4"
                                                                                                                    id="skormetodehumpty_4"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="gangguankognitif"
                                                                                                                    id="gangguankognitif"
                                                                                                                    onclick="cekmetodehumpty_4()"
                                                                                                                    value="2">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Lupa
                                                                                                                    akan
                                                                                                                    adanya
                                                                                                                    keterbatasan</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="gangguankognitif"
                                                                                                                    id="gangguankognitif"
                                                                                                                    onclick="cekmetodehumpty_4()"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Orientasi
                                                                                                                    baik
                                                                                                                    terhadap
                                                                                                                    diri
                                                                                                                    sendiri</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="gangguankognitif"
                                                                                                                    id="gangguankognitif"
                                                                                                                    onclick="cekmetodehumpty_4()"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">-</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="5">
                                                                                                                Faktor
                                                                                                                lingkungan
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="faktorlingkungan"
                                                                                                                    id="faktorlingkungan"
                                                                                                                    onclick="cekmetodehumpty_5()"
                                                                                                                    value="4">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Riwayat
                                                                                                                    jatuh
                                                                                                                    dari
                                                                                                                    tempat
                                                                                                                    tidur
                                                                                                                    saay
                                                                                                                    bayi
                                                                                                                    /
                                                                                                                    anak</label>
                                                                                                            </td>
                                                                                                            <td>4</td>
                                                                                                            <td
                                                                                                                rowspan="5">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_5"
                                                                                                                    id="skormetodehumpty_5"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="faktorlingkungan"
                                                                                                                    id="faktorlingkungan"
                                                                                                                    onclick="cekmetodehumpty_5()"
                                                                                                                    value="3">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Pasien
                                                                                                                    menggunakan
                                                                                                                    alat
                                                                                                                    bantu
                                                                                                                    atau
                                                                                                                    box
                                                                                                                    /
                                                                                                                    mebel</label>
                                                                                                            </td>
                                                                                                            <td>3</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="faktorlingkungan"
                                                                                                                    id="faktorlingkungan"
                                                                                                                    onclick="cekmetodehumpty_5()"
                                                                                                                    value="2">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Pasien
                                                                                                                    diletakan
                                                                                                                    ditempat
                                                                                                                    tidur</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="faktorlingkungan"
                                                                                                                    id="faktorlingkungan"
                                                                                                                    onclick="cekmetodehumpty_5()"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Diluar
                                                                                                                    ruang
                                                                                                                    rawat</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="faktorlingkungan"
                                                                                                                    id="faktorlingkungan"
                                                                                                                    onclick="cekmetodehumpty_5()"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">-</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="4">
                                                                                                                Respon
                                                                                                                terhadap
                                                                                                                operasi
                                                                                                                / obat
                                                                                                                penenang
                                                                                                                /
                                                                                                                efek
                                                                                                                anestesi
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="responterhadapoperasi"
                                                                                                                    id="responterhadapoperasi"
                                                                                                                    value="3"
                                                                                                                    onclick="cekmetodehumpty_6()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Dalam
                                                                                                                    24
                                                                                                                    jam</label>
                                                                                                            </td>
                                                                                                            <td>3</td>
                                                                                                            <td
                                                                                                                rowspan="4">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_6"
                                                                                                                    id="skormetodehumpty_6"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="responterhadapoperasi"
                                                                                                                    id="responterhadapoperasi"
                                                                                                                    value="2"
                                                                                                                    onclick="cekmetodehumpty_6()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Dalam
                                                                                                                    48
                                                                                                                    jam
                                                                                                                    rawat</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="responterhadapoperasi"
                                                                                                                    id="responterhadapoperasi"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">
                                                                                                                    >
                                                                                                                    48
                                                                                                                    jam
                                                                                                                    rawat</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="responterhadapoperasi"
                                                                                                                    id="responterhadapoperasi"
                                                                                                                    value="0"
                                                                                                                    onclick="cekmetodehumpty_6()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">
                                                                                                                    -</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>

                                                                                                        <tr>
                                                                                                            <td
                                                                                                                rowspan="4">
                                                                                                                Penggunaan
                                                                                                                Obat
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="penggunaanobat"
                                                                                                                    id="penggunaanobat"
                                                                                                                    value="3"
                                                                                                                    onclick="cekmetodehumpty_7()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">
                                                                                                                    Bermacam
                                                                                                                    obat
                                                                                                                    yang
                                                                                                                    digunakan
                                                                                                                    :
                                                                                                                    obat
                                                                                                                    sedative
                                                                                                                    (
                                                                                                                    kecuali
                                                                                                                    pasien
                                                                                                                    icu,
                                                                                                                    yang
                                                                                                                    menggunakan
                                                                                                                    sedasi
                                                                                                                    dan
                                                                                                                    paralisis
                                                                                                                    ),
                                                                                                                    hiponotik,
                                                                                                                    barbiturate,
                                                                                                                    fenotiazen,
                                                                                                                    antidepresan,
                                                                                                                    laksatif/diuretik,
                                                                                                                    narkotik</label>
                                                                                                            </td>
                                                                                                            <td>3</td>
                                                                                                            <td
                                                                                                                rowspan="4">
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="skormetodehumpty_7"
                                                                                                                    id="skormetodehumpty_7"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="penggunaanobat"
                                                                                                                    id="penggunaanobat"
                                                                                                                    value="2"
                                                                                                                    onclick="cekmetodehumpty_7()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">
                                                                                                                    Penggunaan
                                                                                                                    salah
                                                                                                                    satu
                                                                                                                    obat
                                                                                                                    diatas</label>
                                                                                                            </td>
                                                                                                            <td>2</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="penggunaanobat"
                                                                                                                    id="penggunaanobat"
                                                                                                                    value="1"
                                                                                                                    onclick="cekmetodehumpty_7()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">
                                                                                                                    Penggunaan
                                                                                                                    obat
                                                                                                                    lainnya</label>
                                                                                                            </td>
                                                                                                            <td>1</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="penggunaanobat"
                                                                                                                    id="penggunaanobat"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">
                                                                                                                    -</label>
                                                                                                            </td>
                                                                                                            <td>0</td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                colspan="3">
                                                                                                                Total
                                                                                                                Skor
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                <input
                                                                                                                    readonly
                                                                                                                    type="text"
                                                                                                                    class="form-control"
                                                                                                                    name="totalskormetodehumpty"
                                                                                                                    id="totalskormetodehumpty"
                                                                                                                    value="0">
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                                <div
                                                                                                    class="form-group mt-2">
                                                                                                    <label
                                                                                                        for="exampleInputEmail1">Tingkat
                                                                                                        risiko</label>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input r1"
                                                                                                            type="radio"
                                                                                                            name="tingkatrisiko"
                                                                                                            id="tingkatrisiko1"
                                                                                                            value="1">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="tingkatrisiko1">
                                                                                                            Skor 7 - 11
                                                                                                            Risiko
                                                                                                            rendah
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input r2"
                                                                                                            type="radio"
                                                                                                            name="tingkatrisiko"
                                                                                                            id="tingkatrisiko2"
                                                                                                            value="2">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="tingkatrisiko2">
                                                                                                            Skor lebih
                                                                                                            dari atau
                                                                                                            sama dengan
                                                                                                            12
                                                                                                            risiko
                                                                                                            tinggi
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">Skrinning Gizi</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <div class="accordion"
                                                                            id="accordionExample4">
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingOne">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left text-dark text-bold"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#skrininggizi1"
                                                                                            aria-expanded="true"
                                                                                            aria-controls="skrininggizi1">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode
                                                                                            Malnutrition Screnning Tools
                                                                                            (
                                                                                            Pasien
                                                                                            Dewasa
                                                                                            )
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="skrininggizi1"
                                                                                    class="collapse"
                                                                                    aria-labelledby="headingOne"
                                                                                    data-parent="#accordionExample4">
                                                                                    <div class="card-body">
                                                                                        <div class="card">
                                                                                            <div class="card-header ">
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <table
                                                                                                    class="table table-sm table-bordered">
                                                                                                    <tr>
                                                                                                        <td>1. Apakah
                                                                                                            pasien
                                                                                                            mengalami
                                                                                                            penurunan
                                                                                                            berat badan
                                                                                                            yang
                                                                                                            tidak
                                                                                                            diinginkan
                                                                                                            dalam 6
                                                                                                            bulan
                                                                                                            terkahir ?
                                                                                                        </td>
                                                                                                        <td>Skor</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="mengalaminpenurunanbb"
                                                                                                                id="mengalaminpenurunanbb"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">
                                                                                                                Tidak
                                                                                                                ada
                                                                                                                penurunan
                                                                                                                berat
                                                                                                                badan</label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="4">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skorskrininggizi_dewasa1"
                                                                                                                id="skorskrininggizi_dewasa1"
                                                                                                                value="0">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="mengalaminpenurunanbb"
                                                                                                                id="mengalaminpenurunanbb"
                                                                                                                onclick="cekskrinnginggizi_dewasa1()"
                                                                                                                value="2">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">
                                                                                                                Tidak
                                                                                                                yakin /
                                                                                                                tidak
                                                                                                                tahu /
                                                                                                                terasa
                                                                                                                baju
                                                                                                                lebih
                                                                                                                longgar
                                                                                                            </label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>

                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">
                                                                                                                Jika
                                                                                                                YA ,
                                                                                                                berapa
                                                                                                                berat
                                                                                                                badan
                                                                                                                tersebut
                                                                                                            </label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            colspan="">
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="mengalaminpenurunanbb"
                                                                                                                    id="mengalaminpenurunanbb"
                                                                                                                    onclick="cekskrinnginggizi_dewasa1()"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">
                                                                                                                    1-
                                                                                                                    5
                                                                                                                    Kg</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="mengalaminpenurunanbb"
                                                                                                                    id="mengalaminpenurunanbb"
                                                                                                                    onclick="cekskrinnginggizi_dewasa1()"
                                                                                                                    value="2">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">
                                                                                                                    6
                                                                                                                    - 10
                                                                                                                    Kg</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="mengalaminpenurunanbb"
                                                                                                                    id="mengalaminpenurunanbb"
                                                                                                                    onclick="cekskrinnginggizi_dewasa1()"
                                                                                                                    value="3">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">
                                                                                                                    11-
                                                                                                                    15
                                                                                                                    Kg</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="mengalaminpenurunanbb"
                                                                                                                    id="mengalaminpenurunanbb"
                                                                                                                    onclick="cekskrinnginggizi_dewasa1()"
                                                                                                                    value="4">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">
                                                                                                                    >
                                                                                                                    15
                                                                                                                    Kg</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="mengalaminpenurunanbb"
                                                                                                                    id="mengalaminpenurunanbb"
                                                                                                                    onclick="cekskrinnginggizi_dewasa1()"
                                                                                                                    value="2">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">
                                                                                                                    Tidak
                                                                                                                    Yakin
                                                                                                                    penurunannya</label>
                                                                                                            </div>

                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            colspan="2">
                                                                                                            2. Apakah
                                                                                                            asupan
                                                                                                            makanan
                                                                                                            berkurang
                                                                                                            karena
                                                                                                            berkurangnya
                                                                                                            nafsu makan
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="asupanmakananberkurang"
                                                                                                                id="asupanmakananberkurang"
                                                                                                                onclick="cekskrinnginggizi_dewasa2()"
                                                                                                                value="0">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">
                                                                                                                Tidak
                                                                                                                ada
                                                                                                            </label>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            rowspan="2">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skorskrininggizi_dewasa2"
                                                                                                                id="skorskrininggizi_dewasa2"
                                                                                                                value="0">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                class="form-check-input"
                                                                                                                type="radio"
                                                                                                                name="asupanmakananberkurang"
                                                                                                                id="asupanmakananberkurang"
                                                                                                                onclick="cekskrinnginggizi_dewasa2()"
                                                                                                                value="1">
                                                                                                            <label
                                                                                                                class="form-check-label"
                                                                                                                for="inlineRadio2">ada
                                                                                                            </label>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            class="text-center">
                                                                                                            Total Skor
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="totalskorskrininggizi"
                                                                                                                id="totalskorskrininggizi"
                                                                                                                value="0">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            colspan="2">
                                                                                                            3. Pasien
                                                                                                            dengan
                                                                                                            diagnosa
                                                                                                            khusus :
                                                                                                            Penyakit
                                                                                                            DM /
                                                                                                            Ginjal /
                                                                                                            Hati / Paru
                                                                                                            / Stroke /
                                                                                                            Kanker /
                                                                                                            Penurunan
                                                                                                            imunitas
                                                                                                            geriatri,
                                                                                                            lain lain...
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="pasiendiagnosakhusus"
                                                                                                                    id="pasiendiagnosakhusus"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Tidak</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="pasiendiagnosakhusus"
                                                                                                                    id="pasiendiagnosakhusus"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Ya</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            colspan="2">
                                                                                                            4. Bila skor
                                                                                                            >= 2,
                                                                                                            pasien
                                                                                                            beresiko
                                                                                                            malnutrisi
                                                                                                            dilakukan
                                                                                                            pengkajian
                                                                                                            lanjut
                                                                                                            oleh ahli
                                                                                                            gizi
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="kajianlanjutgizi"
                                                                                                                    id="kajianlanjutgizi1"
                                                                                                                    value="0">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Tidak</label>
                                                                                                            </div>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="kajianlanjutgizi"
                                                                                                                    id="kajianlanjutgizi2"
                                                                                                                    value="1">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio2">Ya</label>
                                                                                                            </div><br>
                                                                                                            <label
                                                                                                                class="form-check-label"for="inlineRadio2">Tanggal
                                                                                                                Pengkajian</label>
                                                                                                            <input
                                                                                                                type="date"
                                                                                                                class="form-control col-md-4"
                                                                                                                name="tanggalpengkajiangizi">
                                                                                                        </td>
                                                                                                        <td></td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card">
                                                                                <div class="card-header"
                                                                                    id="headingTwo">
                                                                                    <h2 class="mb-0">
                                                                                        <button
                                                                                            class="btn btn-link btn-block text-left collapsed text-dark text-bold"
                                                                                            type="button"
                                                                                            data-toggle="collapse"
                                                                                            data-target="#skrinninggizi2"
                                                                                            aria-expanded="false"
                                                                                            aria-controls="skrinninggizi2">
                                                                                            <i
                                                                                                class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                                            Metode Strong
                                                                                            Kids ( pasien anak - anak)
                                                                                        </button>
                                                                                    </h2>
                                                                                </div>
                                                                                <div id="skrinninggizi2"
                                                                                    class="collapse"
                                                                                    aria-labelledby="headingTwo"
                                                                                    data-parent="#accordionExample4">
                                                                                    <div class="card-body">
                                                                                        <div class="card">
                                                                                            <div class="card-header">
                                                                                            </div>
                                                                                            <div class="card-body">
                                                                                                <table
                                                                                                    class="table table-sm table-bordered">
                                                                                                    <thead>
                                                                                                        <th>No</th>
                                                                                                        <th>Pertanyaan
                                                                                                        </th>
                                                                                                        <th>Ya</th>
                                                                                                        <th>Tidak</th>
                                                                                                    </thead>
                                                                                                    <tr>
                                                                                                        <td>1</td>
                                                                                                        <td>Apakah
                                                                                                            pasien
                                                                                                            tampak kurus
                                                                                                            ?</td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahpasientampakkurus"
                                                                                                                    id="apakahpasientampakkurus"
                                                                                                                    value="1"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Ya</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahpasientampakkurus"
                                                                                                                    id="apakahpasientampakkurus"
                                                                                                                    value="0"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Tidak</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>2</td>
                                                                                                        <td>Apakah ada
                                                                                                            penurunan BB
                                                                                                            Selama satu
                                                                                                            bulan
                                                                                                            terkahir (
                                                                                                            berdasarkan
                                                                                                            penilaian
                                                                                                            objektif
                                                                                                            data BB
                                                                                                            bila ada /
                                                                                                            Penilaian
                                                                                                            subjektif
                                                                                                            dari orang
                                                                                                            tua pasien
                                                                                                            atau
                                                                                                            untuk bayi
                                                                                                            kurang
                                                                                                            dari
                                                                                                            1 tahun : BB
                                                                                                            naik selama
                                                                                                            3 bulan
                                                                                                            terakhir )
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahadapenurunanbb"
                                                                                                                    id="apakahadapenurunanbb"
                                                                                                                    value="1"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Ya</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahadapenurunanbb"
                                                                                                                    id="apakahadapenurunanbb"
                                                                                                                    value="0"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Tidak</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>3</td>
                                                                                                        <td>Apakah
                                                                                                            terdapat
                                                                                                            salah satu
                                                                                                            dari kondisi
                                                                                                            berikut ?
                                                                                                            <br>
                                                                                                            diare
                                                                                                            > kali/hari
                                                                                                            dan atau
                                                                                                            muntah > 3
                                                                                                            kali/hari
                                                                                                            dalam
                                                                                                            seminggu
                                                                                                            terakhir
                                                                                                            <br> Asupan
                                                                                                            makan
                                                                                                            berkurang
                                                                                                            selama 1
                                                                                                            minggu
                                                                                                            terkahir
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahterdapatkondisitertentu"
                                                                                                                    id="apakahterdapatkondisitertentu"
                                                                                                                    value="1"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Ya</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahterdapatkondisitertentu"
                                                                                                                    id="apakahterdapatkondisitertentu"
                                                                                                                    value="0"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Tidak</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>4</td>
                                                                                                        <td>Apakah
                                                                                                            terdapat
                                                                                                            penyakit
                                                                                                            atau keadaan
                                                                                                            yang
                                                                                                            mengakibatkan
                                                                                                            pasien
                                                                                                            beresiko
                                                                                                            mengalami
                                                                                                            malnutrisi
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahterdapatpenyakitmalnutrisi"
                                                                                                                    id="apakahterdapatpenyakitmalnutrisi"
                                                                                                                    value="2"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Ya</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div
                                                                                                                class="form-check form-check-inline">
                                                                                                                <input
                                                                                                                    class="form-check-input"
                                                                                                                    type="radio"
                                                                                                                    name="apakahterdapatpenyakitmalnutrisi"
                                                                                                                    id="apakahterdapatpenyakitmalnutrisi"
                                                                                                                    value="0"
                                                                                                                    onclick="hitungtotalskorskrinninggizianak()">
                                                                                                                <label
                                                                                                                    class="form-check-label"
                                                                                                                    for="inlineRadio1">Tidak</label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td
                                                                                                            colspan="2">
                                                                                                            Total Skor
                                                                                                        </td>
                                                                                                        <td
                                                                                                            colspan="2">
                                                                                                            <input
                                                                                                                readonly
                                                                                                                type="text"
                                                                                                                class="form-control"
                                                                                                                name="skorskrinninggizianak"
                                                                                                                id="skorskrinninggizianak"
                                                                                                                value="0">
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                                <div
                                                                                                    class="form-group mt-2">
                                                                                                    <label
                                                                                                        for="exampleInputEmail1">Hasil
                                                                                                        total
                                                                                                        skor</label>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="skorahligizi"
                                                                                                            id="skorahligizi1"
                                                                                                            value="0"
                                                                                                            checked>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="skorahligizi1">
                                                                                                            0 berisiko
                                                                                                            rendah
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="skorahligizi"
                                                                                                            id="skorahligizi2"
                                                                                                            value="1">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="skorahligizi2">
                                                                                                            1-3 berisiko
                                                                                                            menengah
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="skorahligizi"
                                                                                                            id="skorahligizi2"
                                                                                                            value="2">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            4 - 5
                                                                                                            berisiko
                                                                                                            tinggi
                                                                                                            dikonsulkan
                                                                                                            ke
                                                                                                            ahli gizi
                                                                                                            untuk
                                                                                                            monitor
                                                                                                            asupan gizi
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-link btn-block text-left text-dark  text-bold collapsed"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#ASSESMENT" aria-expanded="false"
                                                                aria-controls="ASSESMENT">
                                                                <i
                                                                    class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                ASSESMENT
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="ASSESMENT" class="collapse"
                                                        aria-labelledby="headingThree"
                                                        data-parent="#accordionExampleSUB">
                                                        <div class="card-body">
                                                            <div class="card">
                                                                <div class="card-header">Diagnosa Keperawatan</div>
                                                                <div class="card-body">
                                                                    {{ $h->diagnosakeperawatan }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header" id="headingThree">
                                                        <h2 class="mb-0">
                                                            <button
                                                                class="btn btn-link btn-block text-left text-dark  text-bold collapsed"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#PLANNING" aria-expanded="false"
                                                                aria-controls="PLANNING">
                                                                <i
                                                                    class="bi bi-arrow-down-square mr-1 ml-1 text-bold"></i>
                                                                PLANNING
                                                            </button>
                                                        </h2>
                                                    </div>
                                                    <div id="PLANNING" class="collapse"
                                                        aria-labelledby="headingFour"
                                                        data-parent="#accordionExampleSUB">
                                                        <div class="card-body">
                                                            <div class="card">
                                                                <div class="card-header">Rencana Keperawatan /
                                                                    Kebidanan</div>
                                                                <div class="card-body">
                                                                    {{ $h->rencanakeperawatan }}
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header">Tindakan Keperawatan /
                                                                    Kebidanan</div>
                                                                <div class="card-body">
                                                                    {{ $h->tindakankeperawatan }}
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header">Evaluasi Keperawatan /
                                                                    Kebidanan</div>
                                                                <div class="card-body">
                                                                    {{ $h->evaluasikeperawatan }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="asdok{{ $h->id }}">
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <td>Sumber Data</td>
                                            <td>{{ $h->sumber_data }}</td>
                                        </tr>
                                        <tr>
                                            <td>Keluhan Utama</td>
                                            <td>{{ $h->keluhan_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>Riwayat Penyakit Dahulu</td>
                                            <td>{{ $h->riwayat_kehamilan_pasien_wanita }} <br>
                                                {{ $h->riwyat_kelahiran_pasien_anak }} <br>
                                                {{ $h->riwyat_penyakit_sekarang }} <br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Riwayat Alergi</td>
                                            <td>{{ $h->riwayat_alergi }} | {{ $h->keterangan_alergi }} </td>
                                        </tr>
                                        <tr>
                                            <td>Riwayat Obat yang diminum</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Pemeriksaan Fisik ( O )</td>
                                            <td>{{ $h->pemeriksaan_fisik }}</td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosis ( A )</td>
                                            <td>{{ $h->diagnosakerja }}<br>

                                                Diagnosa sekunder : {{ $h->diagnosabanding }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Terapi ( P )</td>
                                            <td>{{ $h->rencanakerja }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Permeriksaan Penunjang</td>
                                            <td>{{ $h->rencanakerja }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tindak Lanjut</td>
                                            <td>{{ $h->tindak_lanjut }}<br>
                                                {{ $h->keterangan_tindak_lanjut }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Periksa</td>
                                            <td>{{ $h->tgl_pemeriksaan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama DPJP</td>
                                            <td>{{ $h->nama_dokter }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="active tab-pane" id="cppt{{ $h->id }}">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <th>Tanggal & Jam</th>
                                            <th>Hasil Pemeriksaan, Analisa, Rencana Penatalaksanaan pasien( ditulis
                                                dengan format SOAP, disertai target yang terukur, evaluasi hasil, tata
                                                laksana dituliskan dalam assesmen )</th>
                                            <th>
                                                Instruksi tenaga kesehatan termasuk pasca bedah / prosedur
                                            </th>
                                            <th>
                                                nama Dpjp
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($cppt as $cp)
                                                @if ($h->idasskep == $cp->id_header)
                                                    @if ($cp->unitpoli != '1028')
                                                        <tr>
                                                            <td>
                                                                {{ $cp->tgl_pemeriksaan }}
                                                            </td>
                                                            <td>
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
                                                                <br>
                                                                <br>
                                                                Diagnosa Keperawatan :
                                                                {{ $cp->diagnosakeperawatan }}<br>
                                                                Rencana Keperawatan : {{ $cp->rencanakeperawatan }}<br>
                                                                Tindakan Keperawatan :
                                                                {{ $cp->tindakankeperawatan }}<br>
                                                                Evaluasi Keperawatan :
                                                                {{ $cp->evaluasikeperawatan }}<br>

                                                                <br>
                                                                Pemeriksa : {{ $cp->namapemeriksa }}
                                                            </td>
                                                            <td>
                                                                <div class="card">
                                                                    <table class="table table-sm table-bordered">
                                                                        <tr>
                                                                            <td>Sumber Data</td>
                                                                            <td>{{ $cp->sumber_data }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Keluhan Utama</td>
                                                                            <td>{{ $cp->keluhan_pasien }}</td>
                                                                        </tr>
                                                                        <tr>
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
                                                                        <tr>
                                                                            <td>Riwayat Obat yang diminum</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pemeriksaan Fisik ( O )</td>
                                                                            <td>{{ $cp->pemeriksaan_fisik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Diagnosis ( A )</td>
                                                                            <td>{{ $cp->diagnosakerja }}<br>

                                                                                Diagnosa sekunder :
                                                                                {{ $cp->diagnosabanding }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Rencana Terapi ( P )</td>
                                                                            <td>{{ $cp->rencanakerja }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Rencana Permeriksaan Penunjang</td>
                                                                            <td>{{ $cp->rencanakerja }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tindak Lanjut</td>
                                                                            <td>{{ $cp->tindak_lanjut }}<br>
                                                                                {{ $cp->keterangan_tindak_lanjut }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tanggal Periksa</td>
                                                                            <td>{{ $cp->tgl_pemeriksaan }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>
                                                                {{ $cp->tgl_pemeriksaan }}
                                                            </td>
                                                            <td>
                                                                Hasil Pemeriksaan : {{ $cp->tindakankeperawatan }}<br>

                                                                <br>
                                                                Pemeriksa : {{ $cp->namapemeriksa }}
                                                            </td>
                                                            <td>
                                                                <div class="card">
                                                                    <table
                                                                        class="table table-bordered table-striped font-italic">
                                                                        <tr>
                                                                            <td>Anamnesa</td>
                                                                            <td>: {{ $cp->anamnesa }}</td>
                                                                            <input hidden id="diagnosa"
                                                                                type="text"
                                                                                value="{{ $cp->diagnosakerja }}">
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pemeriksaan Fisik dan Uji Fungsi</td>
                                                                            <td>: {{ $cp->pemeriksaan_fisik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Diagnosis Medis ( ICD 10 )</td>
                                                                            <td>: {{ $cp->diagnosakerja }}</td>
                                                                            <input hidden id="diagnosa"
                                                                                type="text"
                                                                                value="{{ $cp->diagnosakerja }}">
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Diagnosis Fungsi ( ICD 10 )</td>
                                                                            <td>: {{ $cp->diagnosabanding }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pemeriksaan Penunjang</td>
                                                                            <td>: {{ $cp->rencanakerja }}</td>
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
                                                                                {{ $cp->keterangan_tindak_lanjut }}
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div> --}}
<div class="col-md-12">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">ASSESMEN
                        KEPERAWATAN</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">ASSESMEN MEDIS</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">BERKAS LAIN</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="active tab-pane" id="activity">

                </div>
                <div class="tab-pane" id="timeline">
                    @foreach ($header as $h)
                        <div class="card">
                            <div class="card-header bg-info">Assesmen Awal Medis <br>
                                {{ \Carbon\Carbon::parse($h->tglk)->format('d / M / Y') }} {{ $h->nama_unit }}</div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered table-striped">
                                    <tr>
                                        <td>Sumber Data</td>
                                        <td>{{ $h->sumber_data }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keluhan Utama</td>
                                        <td>{{ $h->keluhan_pasien }}</td>
                                    </tr>
                                    <tr>
                                        <td>Riwayat Penyakit Dahulu</td>
                                        <td>{{ $h->riwayat_kehamilan_pasien_wanita }} <br>
                                            {{ $h->riwyat_kelahiran_pasien_anak }} <br>
                                            {{ $h->riwyat_penyakit_sekarang }} <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Riwayat Alergi</td>
                                        <td>{{ $h->riwayat_alergi }} | {{ $h->keterangan_alergi }} </td>
                                    </tr>
                                    <tr>
                                        <td>Riwayat Obat yang diminum</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Fisik ( O )</td>
                                        <td>{{ $h->pemeriksaan_fisik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis ( A )</td>
                                        <td>{{ $h->diagnosakerja }}<br>

                                            Diagnosa sekunder : {{ $h->diagnosabanding }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rencana Terapi ( P )</td>
                                        <td>{{ $h->rencanakerja }}</td>
                                    </tr>
                                    <tr>
                                        <td>Rencana Permeriksaan Penunjang</td>
                                        <td>{{ $h->rencanakerja }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tindak Lanjut</td>
                                        <td>{{ $h->tindak_lanjut }}<br>
                                            {{ $h->keterangan_tindak_lanjut }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Periksa</td>
                                        <td> {{ \Carbon\Carbon::parse($h->tglk)->format('d / M / Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jawaban Konsul Ke Poli lain</td>
                                        <td>{{ $h->keterangan_tindak_lanjut_2}} </td>
                                    </tr>
                                    <tr>
                                        <td>Billing Tindakan</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Farmasi</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Billing Pemeriksaan Penunjang</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Nama DPJP</td>
                                        <td>{{ $h->nama_dokter }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-warning">CPPT</div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <th width="8%">Tanggal & Jam</th>
                                        <th>Hasil Pemeriksaan, Analisa, Rencana Penatalaksanaan pasien( ditulis
                                            dengan format SOAP, disertai target yang terukur, evaluasi hasil, tata
                                            laksana dituliskan dalam assesmen )</th>
                                        <th>
                                            Instruksi tenaga kesehatan termasuk pasca bedah / prosedur
                                        </th>
                                        <th>
                                            nama Dpjp
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($cppt as $cp)
                                            @if ($h->idasskep == $cp->id_header)
                                                @if ($cp->unitpoli != '1028')
                                                    <tr>
                                                        <td>
                                                            {{-- {{ $cp->tgl_pemeriksaan }} --}}
                                                            {{ \Carbon\Carbon::parse($cp->tgl_pemeriksaan)->format('d / M / Y') }}
                                                        </td>
                                                        <td>
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
                                                            <br>
                                                            <br>
                                                            Diagnosa Keperawatan :
                                                            {{ $cp->diagnosakeperawatan }}<br>
                                                            Rencana Keperawatan : {{ $cp->rencanakeperawatan }}<br>
                                                            Tindakan Keperawatan :
                                                            {{ $cp->tindakankeperawatan }}<br>
                                                            Evaluasi Keperawatan :
                                                            {{ $cp->evaluasikeperawatan }}<br>

                                                            <br>
                                                            Pemeriksa : {{ $cp->namapemeriksa }}
                                                        </td>
                                                        <td>
                                                            <div class="card">
                                                                <table class="table table-sm table-bordered table-striped">
                                                                    <tr>
                                                                        <td>Sumber Data</td>
                                                                        <td>{{ $cp->sumber_data }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Keluhan Utama</td>
                                                                        <td>{{ $cp->keluhan_pasien }}</td>
                                                                    </tr>
                                                                    <tr>
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
                                                                    <tr>
                                                                        <td>Riwayat Obat yang diminum</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pemeriksaan Fisik ( O )</td>
                                                                        <td>{{ $cp->pemeriksaan_fisik }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diagnosis ( A )</td>
                                                                        <td>{{ $cp->diagnosakerja }}<br>

                                                                            Diagnosa sekunder :
                                                                            {{ $cp->diagnosabanding }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Rencana Terapi ( P )</td>
                                                                        <td>{{ $cp->rencanakerja }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Rencana Permeriksaan Penunjang</td>
                                                                        <td>{{ $cp->rencanakerja }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tindak Lanjut</td>
                                                                        <td>{{ $cp->tindak_lanjut }}<br>
                                                                            {{ $cp->keterangan_tindak_lanjut }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Jawaban Konsul Ke poli lain</td>
                                                                        <td>{{ $cp->keterangan_tindak_lanjut_2 }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tanggal Periksa</td>
                                                                        <td>{{ $cp->tgl_pemeriksaan }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            {{-- {{ $cp->tgl_pemeriksaan }} --}}
                                                            {{ \Carbon\Carbon::parse($cp->tgl_pemeriksaan)->format('d / M / Y') }}
                                                        </td>
                                                        <td>
                                                            Hasil Pemeriksaan : {{ $cp->tindakankeperawatan }}<br>
                                                            <br>
                                                            Pemeriksa : {{ $cp->namapemeriksa }}
                                                        </td>
                                                        <td>
                                                            <div class="card">
                                                                <table
                                                                    class="table table-bordered table-striped font-italic">
                                                                    <tr>
                                                                        <td>Anamnesa</td>
                                                                        <td>: {{ $cp->anamnesa }}</td>
                                                                        <input hidden id="diagnosa" type="text"
                                                                            value="{{ $cp->diagnosakerja }}">
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pemeriksaan Fisik dan Uji Fungsi</td>
                                                                        <td>: {{ $cp->pemeriksaan_fisik }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diagnosis Medis ( ICD 10 )</td>
                                                                        <td>: {{ $cp->diagnosakerja }}</td>
                                                                        <input hidden id="diagnosa" type="text"
                                                                            value="{{ $cp->diagnosakerja }}">
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diagnosis Fungsi ( ICD 10 )</td>
                                                                        <td>: {{ $cp->diagnosabanding }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pemeriksaan Penunjang</td>
                                                                        <td>: {{ $cp->rencanakerja }}</td>
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
                                                                            {{ $cp->keterangan_tindak_lanjut }}
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="tab-pane" id="settings">
                    BERKAS LAIN
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
