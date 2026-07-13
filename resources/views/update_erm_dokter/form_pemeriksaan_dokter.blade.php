<div class="card">
    <div class="card-header bg-light">
        <h3>Form Pemeriksaan</h3>
        <br>
        <div class="btn-group mb-3" role="group" aria-label="Basic outlined example">
            <button type="button" nomorrm="{{ $kunjungan[0]->no_rm }}" class="btn btn-warning btn-outline-dark"
                onclick="showmodalpenunjanglab()" data-toggle="modal" data-target="#modalhasillab"><i
                    class="bi bi-clipboard-data"></i> Hasil
                Pemeriksaan
                Laboratorium</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalpenunjanglabspesial()" data-toggle="modal" data-target="#modalhasillab"><i
                    class="bi bi-clipboard-data"></i> Hasil Laboratorium Spesial
                Order</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalpenunjangRAD()" data-toggle="modal" data-target="#modalhasilpenunjang_rad"><i
                    class="bi bi-clipboard-data"></i> Hasil
                Pemeriksaan
                Radiologi</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalpenunjangPA()" data-toggle="modal" data-target="#modalhasilpenunjang_pa"><i
                    class="bi bi-clipboard-data"></i> Hasil
                Pemeriksaan PA</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalberkasrm()" data-toggle="modal" data-target="#modalscan_rm"><i
                    class="bi bi-clipboard-data"></i> Berkas
                Rekamedis</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalriwayatsumarilis()" data-toggle="modal" data-target="#modalsumarilis"><i
                    class="bi bi-clipboard-data"></i>
                SUMARILIS</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalscanberkaslain()" data-toggle="modal" data-target="#modalberkaslain"><i
                    class="bi bi-clipboard-data"></i> Berkas
                Lain</button>
            <button type="button" class="btn btn-warning btn-outline-dark" nomorrm="{{ $kunjungan[0]->no_rm }}"
                onclick="showmodalcatatanhemodialisa()" data-toggle="modal" data-target="#modalcatatanhemodialisa"><i
                    class="bi bi-clipboard-data"></i> Catatan Hemodialisa</button>           
        </div>
        <div class="btn-group mb-3 mt-4" role="group" aria-label="Basic outlined example">
            <button type="button" nomorrm="{{ $kunjungan[0]->no_rm }}" class="btn btn-success btn-outline-dark text-light"
                onclick="ambildatakunjungan()" data-toggle="modal" data-target="#modalcppt"><i
                    class="bi bi-clipboard-data"></i> Data Pemeriksaan Sebelumnya</button>
        </div>
    </div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        <style>
            .alert-blink-danger {
                animation: pulse-danger 2s infinite;
            }

            .alert-blink-warning {
                animation: pulse-warning 2s infinite;
            }

            @keyframes pulse-danger {

                0%,
                100% {
                    background-color: #f8d7da;
                    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
                }

                50% {
                    background-color: #f5b3b7;
                    box-shadow: 0 0 12px rgba(220, 53, 69, 0.4);
                }
            }

            @keyframes pulse-warning {

                0%,
                100% {
                    background-color: #fff3cd;
                }

                50% {
                    background-color: #ffe89e;
                    box-shadow: 0 0 12px rgba(255, 193, 7, 0.4);
                }
            }
        </style>
        @php
            // Menentukan class animasi berkedip secara otomatis
            $blinkClass = '';
            if (($alertClass ?? '') == 'alert-danger') {
                $blinkClass = 'alert-blink-danger';
            } elseif (($alertClass ?? '') == 'alert-warning') {
                $blinkClass = 'alert-blink-warning';
            }
        @endphp
        @if ($asesmen_perawat)
            <div class="alert {{ $alertClass }} {{ $blinkClass }} alert-dismissible fade show p-3 mb-3 shadow-sm border-0"
                role="alert" style="{{ $borderClass }} color: #212529;">
                <div class="row align-items-top">
                    <div class="col-auto pr-0 pt-1">
                        <i class="{{ $alertIcon }} fa-2x mx-2"></i>
                    </div>
                    <div class="col pl-3">
                        <strong class="text-uppercase font-weight-bold d-block mb-2"
                            style="letter-spacing: 1px; font-size: 0.9rem;">
                            SISTEM MONITORING PROGRAM PRB & RUJUKAN BPJS
                        </strong>
                        <p class="mb-0 font-weight-normal text-justify" style="font-size: 1.1rem; line-height: 1.5;">
                            {!! $pesan_rujukan !!}
                        </p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                    style="color: inherit; opacity: 0.6; position: absolute; top: 15px; right: 15px;">
                    <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>
            @if (count($poli_pengirim_konsul) > 0)
                <div class="card border-info border-start border-4 shadow-sm rounded-3 mb-4 bg-info-subtle">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start">
                            <div class="text-info me-4 mt-1">
                                <i class="bi bi-arrow-left-right fs-1"
                                    style="filter: drop-shadow(0px 2px 4px rgba(13, 202, 240, 0.2));margin-right:20px"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    <h4 class="fw-bold text-dark mb-0" style="letter-spacing: -0.5px;">
                                        Pasien Konsul
                                    </h4>
                                </div>
                                <p class="text-secondary mb-3 fs-6" style="line-height: 1.5;">
                                    Pasien ini dikirim untuk dilakukan tata laksana/pemeriksaan lebih lanjut di unit
                                    Anda, dikirim langsung oleh:
                                    <span
                                        class="fw-bold text-dark bg-white border border-info-subtle px-2 py-0.5 rounded text-uppercase"
                                        style="font-size: 0.95rem;">
                                        <i class="bi bi-door-open-fill text-info me-1"></i>
                                        {{ $poli_pengirim_konsul[0]->nama_unit ?? $poli_pengirim_konsul }}
                                    </span>
                                </p>

                                <div
                                    class="row g-3 bg-white bg-opacity-75 rounded-3 p-3 border border-info-subtle mx-0">
                                    <div class="col-md-6 border-end-md">
                                        <small
                                            class="text-muted d-block text-uppercase fw-bold style-label-konsul">Dokter
                                            Pengirim</small>
                                        <span class="text-dark fw-semibold">
                                            <i class="bi bi-person-badge text-secondary me-1"></i>
                                            {{ $poli_pengirim_konsul[0]->nama_dokter }}
                                        </span>
                                    </div>
                                    <div class="col-md-6 ps-md-3">
                                        @if (count($catatan_konsul) > 0)
                                            <small
                                                class="text-muted d-block text-uppercase fw-bold style-label-konsul">Alasan
                                                / Catatan Konsul</small>
                                            <span class="text-dark fw-medium text-break italic">
                                                "diagnosa kerja : {{ $catatan_konsul[0]->diagnosakerja }} <br> Tindak
                                                lanjut : {{ $catatan_konsul[0]->tindak_lanjut }} /
                                                {{ $catatan_konsul[0]->keterangan_tindak_lanjut }}"
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .bg-info-subtle {
                        background-color: #e0f7fa !important;
                        /* Biru muda tenang khas indikator info medis */
                    }

                    .style-label-konsul {
                        font-size: 0.65rem;
                        letter-spacing: 0.5px;
                        margin-bottom: 3px;
                    }

                    .italic {
                        font-style: italic;
                    }

                    @media (min-width: 768px) {
                        .border-end-md {
                            border-right: 1px solid #dee2e6 !important;
                        }
                    }
                </style>
            @endif
            <div class="card">
                <div class="card-header text-bold bg-success">+ SUBJECT ( S )</div>
                <div class="card-body">
                    <form action="" class="form_pemeriksaan_1">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header bg-secondary" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-light font-weight"
                                            type="button" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            <i class="bi bi-ticket-detailed mr-1 ml-1"></i> Riwayat Kesehatan
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body bg-light">
                                        <table>
                                            <tr>
                                                <td class="text-bold font-italic">Riwayat Kehamilan (bagi pasien
                                                    wanita)
                                                </td>
                                                <td colspan="3">
                                                    <textarea name="riwayatkehamilan" cols="10" rows="4" class="form-control">{{ $asesmen_terakhir ? $asesmen_terakhir->riwayat_kehamilan_pasien_wanita : '' }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold font-italic">Riwayat Kelahiran (bagi pasien anak)
                                                </td>
                                                <td colspan="3">
                                                    <textarea name="riwayatkelahiran" cols="10" rows="4" class="form-control">{{ $asesmen_terakhir ? $asesmen_terakhir->riwyat_kelahiran_pasien_anak : '' }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold font-italic">Riwayat Penyakit Sekarang</td>
                                                <td colspan="3">
                                                    <textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control">{{ $asesmen_terakhir ? $asesmen_terakhir->riwyat_penyakit_sekarang : '' }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold font-italic">Riwayat Penyakit Dahulu</td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="hipertensi" name="hipertensi" value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Hipertensi</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="kencingmanis" name="kencingmanis"
                                                                    value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Kencing
                                                                    Manis</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="jantung" name="jantung" value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Jantung</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="stroke" name="stroke" value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Stroke</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="hepatitis" name="hepatitis" value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Hepatitis</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="asthma" name="asthma" value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Asthma</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="ginjal" name="ginjal" value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Ginjal</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="tb" name="tb" value="1">
                                                                <label class="form-check-label" for="exampleCheck1">TB
                                                                    Paru</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-check">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="riwayatlain" name="riwayatlain"
                                                                    value="1">
                                                                <label class="form-check-label"
                                                                    for="exampleCheck1">Lain-lain</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <textarea name="ketriwayatlain" id="ketriwayatlain" class="form-control" placeholder="keterangan lain - lain"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold font-italic">Riwayat Alergi</td>
                                                <td colspan="3">
                                                    <div class="row">
                                                        @php
                                                            // Ambil nilai dari database, jika null atau kosong set default ke
                                                            $nilai_alergi =
                                                                $asesmen_terakhir &&
                                                                !empty($asesmen_terakhir->riwayat_alergi)
                                                                    ? $asesmen_terakhir->riwayat_alergi
                                                                    : 'Tidak Ada';
                                                        @endphp
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input ml-2 mr-3" type="radio"
                                                                name="alergi" id="alergi" value="Tidak Ada"
                                                                {{ $nilai_alergi == 'Tidak Ada' ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="inlineRadio1">Tidak
                                                                Ada</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input mr-3" type="radio"
                                                                name="alergi" id="alergi" value="Ada"
                                                                {{ $nilai_alergi == 'Ada' ? 'checked' : '' }}>
                                                            <label class="form-check-label"
                                                                for="inlineRadio2">Ada</label>
                                                            <div class="form-group form-check">
                                                                <input class="form-control" id="ketalergi"
                                                                    name="ketalergi"
                                                                    placeholder="keterangan alergi ..."
                                                                    value="{{ trim($asesmen_terakhir ? $asesmen_terakhir->keterangan_alergi : '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold font-italic">Status Generalis</td>
                                                <td>
                                                    <input type="text" class="form-control" name="statusgeneralis"
                                                        id="statusgeneralis"
                                                        value="{{ $asesmen_terakhir ? $asesmen_terakhir->statusgeneralis : '' }}">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input hidden type="text" name="kodekunjungan" class="form-control"
                            value="{{ $kunjungan[0]->kode_kunjungan }}">
                        <input hidden type="text" name="counter" class="form-control"
                            value="{{ $kunjungan[0]->counter }}">
                        <input hidden type="text" name="unit" class="form-control"
                            value="{{ $kunjungan[0]->kode_unit }}">
                        <input hidden type="text" name="nomorrm" class="form-control"
                            value="{{ $kunjungan[0]->no_rm }}">
                        <input hidden type="text" name="idasskep" class="form-control"
                            value="{{ $asesmen_perawat ? $asesmen_perawat->id : '' }}">
                        <table class="table">
                            <tr hidden>
                                <td class="text-bold font-italic">Tanggal Kunjungan</td>
                                <td><input readonly type="text" name="tanggalkunjungan" class="form-control"
                                        value="{{ $kunjungan[0]->tgl_masuk }}"></td>
                                <td class="text-bold font-italic">Tanggal Assesmen</td>
                                <td><input type="text" name="tanggalassesmen" class="form-control datepicker"
                                        data-date-format="yyyy-mm-dd"></td>
                            </tr>
                            <tr>
                                <td class="text-bold font-italic">Sumber Data</td>
                                <td colspan="3">
                                    @php
                                        $sumber_data =
                                            $asesmen_perawat && !empty($asesmen_perawat->sumberdataperiksa)
                                                ? $asesmen_perawat->sumberdataperiksa
                                                : 'Pasien Sendiri';
                                    @endphp
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sumberdata"
                                            id="sumberdata" value="Pasien Sendiri"
                                            {{ $sumber_data == 'Pasien Sendiri' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">Pasien Sendiri /
                                            Autoanamase</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sumberdata"
                                            id="sumberdata" value="Keluarga"
                                            {{ $sumber_data == 'Keluarga' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Keluarga /
                                            Alloanamnesa</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold font-italic">Keluhan Utama</td>
                                <td colspan="3">
                                    <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ...">{{ $asesmen_perawat ? $asesmen_perawat->keluhanutama : '' }}</textarea>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bold bg-success">+ OBJECT ( O )</div>
                <div class="card-body">
                    <form action="" class="form_pemeriksaan_2">
                        <table class="table text-sm">
                            <thead>
                                <th colspan="4" class="text-center bg-warning">Tanda - Tanda Vital</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-bold font-italic">Tekanan Darah</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Tekanan darah pasien ..."
                                                aria-label="Recipient's username" id="tekanandarah"
                                                name="tekanandarah" aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->tekanandarah : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-bold font-italic">Frekuensi Nadi</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Frekuensi nadi pasien ..." id="frekuensinadi"
                                                name="frekuensinadi" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->frekuensinadi : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">x/menit</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Frekuensi Nafas</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Frekuensi Nafas Pasien ..." name="frekuensinafas"
                                                id="frekuensinafas" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->frekuensinapas : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">x/menit</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-bold font-italic">Suhu</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Suhu tubuh pasien ..." aria-label="Suhu tubuh pasien"
                                                name="suhutubuh" id="suhutubuh" aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->suhutubuh : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">°C</span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Berat Badan</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Berat badan Pasien ..." name="beratbadan"
                                                id="beratbadan" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->beratbadan : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-bold font-italic">Tinggi Badan</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Tinggi badan pasien ..."
                                                aria-label="Suhu tubuh pasien" name="tinggibadan" id="tinggibadan"
                                                aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->tinggibadan : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">IMT</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="IMT Pasien ..." name="imt" id="imt"
                                                aria-label="Recipient's username" aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->imt : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-bold font-italic">Umur</td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Umur pasien ..."
                                                aria-label="Suhu tubuh pasien" name="usia" id="usia"
                                                aria-describedby="basic-addon2"
                                                value="{{ $asesmen_perawat ? $asesmen_perawat->usia : '' }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="bg-secondary">Pemeriksaan Fisik</td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <textarea class="form-control" rows="5" name="pemeriksaanfisik">{{ $asesmen_terakhir ? $asesmen_terakhir->pemeriksaan_fisik : '' }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="bg-secondary">Pemeriksaan Umum</td>
                                </tr>
                                <tr hidden>
                                    <td class="text-bold font-italic">Keadaan Umum</td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="keadaanumum">{{ $asesmen_terakhir ? $asesmen_terakhir->keadaanumum : '' }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Kesadaran</td>
                                    <td colspan="3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kesadaran"
                                                id="kesadaran" value="Composmentis" checked>
                                            <label class="form-check-label" for="inlineRadio1">Composmentis</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kesadaran"
                                                id="kesadaran" value="Lainnya">
                                            <label class="form-check-label" for="inlineRadio2">Lain - Lain</label>
                                        </div>
                                        <textarea class="form-control mt-2" name="keterangankesadaran" placeholder="keterangan lain - lain ..."></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    {{-- formpemeriksaankhusus --}}
                    <div class="card" @if (auth()->user()->unit != '1014') hidden @endif>
                        <div class="card-header bg-danger" id="headingTwo2">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left text-light collapsed" type="button"
                                    data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="false"
                                    aria-controls="collapseTwo2">
                                    <i class="bi bi-ticket-detailed mr-1 ml-1"></i> PEMERIKSAAN KHUSUS
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo2"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                @if (!empty($hasil_ro) && isset($hasil_ro[0]))
                                    @php
                                        $data_mata = $hasil_ro[0]; // Ambil baris pertama object
                                    @endphp
                                    @php
                                        $a = explode('|', $hasil_ro[0]->catatanpemeriksaanlain);
                                        $b = explode('|', $hasil_ro[0]->palpebra);
                                        $c = explode('|', $hasil_ro[0]->konjungtiva);
                                        $d = explode('|', $hasil_ro[0]->kornea);
                                        $e = explode('|', $hasil_ro[0]->bilikmatadepan);
                                        $f = explode('|', $hasil_ro[0]->pupil);
                                        $g = explode('|', $hasil_ro[0]->iris);
                                        $h = explode('|', $hasil_ro[0]->lensa);
                                        $i = explode('|', $hasil_ro[0]->funduskopi);
                                        $j = explode('|', $hasil_ro[0]->status_oftamologis_khusus);
                                        $k = explode('|', $hasil_ro[0]->masalahmedis);
                                        $l = explode('|', $hasil_ro[0]->prognosis);
                                        $m = explode('|', $hasil_ro[0]->tekananintraokular);
                                    @endphp
                                    <form action="" class="formpemeriksaankhusus">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header bg-light">Hasil Pemeriksaan RO</div>
                                                    <div class="card-body">
                                                        <textarea class="form-control" rows="8" id="hasilpemeriksaanro" name="hasilpemeriksaanro">{{ trim($data_mata->tajampenglihatandekat ?? '-') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header bg-danger">Mata Kiri</div>
                                                    <div class="card-body">
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <td colspan="4">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="gambarmatakanan">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tekanan Intra Okular</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $m[0] }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Catatan Pemeriksaan Lainnya</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $a[0] }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Palpebra</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $b[0] }}" id="palpebra"
                                                                        name="palpebra"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Konjungtiva</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $c[0] }}" id="konjungtiva"
                                                                        name="konjungtiva"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kornea</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $d[0] }}" name="kornea"
                                                                        id="kornea"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bilik Mata Depan</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $e[0] }}"
                                                                        name="bilik_mata_depan"
                                                                        id="bilik_mata_depan"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pupil</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $f[0] }}" id="pupil"
                                                                        name="pupil"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Iris</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $g[0] }}" name="iris"
                                                                        id="iris"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Lensa</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $h[0] }}" name="lensa"
                                                                        id="lensa"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Funduskopi</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $i[0] }}" name="funduskopi"
                                                                        id="funduskopi"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status Oftalmologis Khusus</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" name="oftamologis" id="oftamologis">{{ $j[0] }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Masalah Medis</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" name="masalahmedis" id="masalahmedis">{{ $k[0] }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Prognosis</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" name="prognosis" id="prognosis">{{ $l[0] }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header bg-danger">Mata Kanan</div>
                                                    <div class="card-body">
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <td>Tekanan Intra Okular</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" id="kiri_tekanan_intra_okular" name="kiri_tekanan_intra_okular">{{ $m[1] ?? '' }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Catatan Pemeriksaan Lainnya</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" name="kiri_catatan_pemeriksaan_lainnya" id="kiri_catatan_pemerikssaan_lainnya">{{ $a[1] ?? '' }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Palpebra</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $b[1] ?? '' }}"
                                                                        id="kiri_palpebra"
                                                                        name="kiri_palpebra"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Konjungtiva</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $c[1] ?? '' }}"
                                                                        id="kiri_konjungtiva"
                                                                        name="kiri_konjungtiva"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kornea</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $d[1] ?? '' }}"
                                                                        name="kiri_kornea" id="kiri_kornea"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Bilik Mata Depan</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $e[1] ?? '' }}"
                                                                        name="kiri_bilik_mata_depan"
                                                                        id="kiri_bilik_mata_depan"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pupil</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $f[1] ?? '' }}" id="kiri_pupil"
                                                                        name="kiri_pupil"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Iris</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $g[1] ?? '' }}" name="kiri_iris"
                                                                        id="kiri_iris"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Lensa</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $h[1] ?? '' }}" name="kiri_lensa"
                                                                        id="kiri_lensa"></input></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Funduskopi</td>
                                                                <td colspan="3"><input class="form-control"
                                                                        value="{{ $i[1] ?? '' }}"
                                                                        name="kiri_funduskopi"
                                                                        id="kiri_funduskopi"></input>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status Oftalmologis Khusus</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" value="" name="kiri_oftamologis" id="kiri_oftamologis">{{ $j[1] ?? '' }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Masalah Medis</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" value="" name="kiri_masalahmedis" id="kiri_masalahmedis">{{ $k[1] ?? '' }}</textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Prognosis</td>
                                                                <td colspan="3">
                                                                    <textarea class="form-control" value="" name="kiri_prognosis" id="kiri_prognosis">{{ $l[1] ?? '' }}</textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                    <div class="text-center py-5 my-2">
                                        <div class="text-muted mb-3">
                                            <i class="bi bi-eye-slash text-secondary opacity-50"
                                                style="font-size: 3rem;"></i>
                                        </div>
                                        <h6 class="fw-bold text-secondary mb-1">Belum Ada Pemeriksaan Spesifik Mata
                                        </h6>
                                        <p class="text-muted small mb-0">Petugas RO atau Perawat belum menginputkan
                                            hasil
                                            pemeriksaan penunjang mata untuk kunjungan ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bold bg-success">+ ASSESMENT ( A )</div>
                <div class="card-body">
                    <form action="" class="form_pemeriksaan_3">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td class="text-bold font-italic">Diagnosa Utama</td>
                                    <td colspan="2">
                                        <textarea name="diagnosakerja" id="diagnosakerja" class="form-control">{{ $asesmen_terakhir ? $asesmen_terakhir->diagnosakerja : '' }}</textarea>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Diagnosa Sekunder</td>
                                    <td colspan="2">
                                        <textarea name="diagnosabanding" id="diagnosabanding" class="form-control">{{ $asesmen_terakhir ? $asesmen_terakhir->diagnosabanding : '' }}</textarea>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        {{-- <div @if ($kunjungan[0]->ref_kunjungan == '0') hidden @endif class="card">
                        <div class="card-header bg-warning">Jawaban Konsul</div>
                        <div class="card-body">
                            <textarea name="jawabankonsul" id="jawabankonsul" rows="10"class="form-control"></textarea>
                        </div>
                    </div> --}}
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bold bg-success">+ PLANNING ( P )

                </div>
                <div class="card-body">
                    <form action="" class="form_pemeriksaan_4">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td class="text-bold font-italic">Tindakan Medis</td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="tindakanmedis">{{ $asesmen_terakhir ? $asesmen_terakhir->tindakanmedis : '' }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Rencana Tindakan</td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="rencanatindakan">{{ $asesmen_terakhir ? $asesmen_terakhir->renjana_tindakan : '' }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Rencana Terapi</td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="rencanakerja">{{ $asesmen_terakhir ? $asesmen_terakhir->rencanakerja : '' }}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Tindakan Penunjang</td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="tindakanpenunjang">{{ $asesmen_terakhir ? $asesmen_terakhir->tindakanpenunjang : '' }}</textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div @if(auth()->user()->unit != '1012' || auth()->user()->unit != '1027' || auth()->user()->unit != '1032') hidden @endif class="col-md-12">
                        <div class="card">
                            <div class="card-header text-bold bg-dark">FORMULIR HASIL EKSPERTISI MEDIS</div>
                            <div class="card-body">
                                <textarea class="form-control" id="hasilexpertisi" name="hasilexpertisi" cols="30" rows="10"
                                    placeholder="Silahkan isi hasil expertisi ...">{{ $asesmen_terakhir ? $asesmen_terakhir->evaluasi : '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- formfarmasi --}}
                    <div class="card">
                        <div class="card-header bg-light">Order Farmasi
                            <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                data-target="#modaltemplate" onclick="ambilresep()">Template resep</button>
                            <button type="button" class="btn btn-success float-right mr-1 ml-1" data-toggle="modal"
                                data-target="#modaltemplate" onclick="ambilriwayatresep()">Riwayat Resep
                                Pasien</button>
                        </div>
                        <div class="card-body">
                            <div class="form-group mt-2">
                                <button type="button" class="btn btn-success tambahobat" onclick="addform()">+
                                    Tambah
                                    Obat</button>
                            </div>
                            <input hidden type="text" id="selisih" value="">
                            <input hidden type="text" value="" id="jumlahform">
                            <form action="" method="post" class="arrayobat">
                                <div class="formobatfarmasi2">

                                </div>
                                <div class="formobatfarmasiriwayat">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="simpantemplate"
                                        onclick="showname()">
                                    <label class="form-check-label" for="exampleCheck1">ceklis, untuk
                                        simpan
                                        resep sebagai template</label>
                                </div>
                                <input hidden type="text" class="form-control col-md-3 mb-3" id="namaresep"
                                    name="namaresep" placeholder="isi nama resep ...">
                            </form>
                            <div class="v_itterasi_obat">

                            </div>
                        </div>
                    </div>
                    {{-- formtindaknlanjut --}}
                    <style>
                        .alert-blink-danger {
                            animation: pulse-danger 2s infinite;
                        }

                        .alert-blink-warning {
                            animation: pulse-warning 2s infinite;
                        }

                        @keyframes pulse-danger {

                            0%,
                            100% {
                                background-color: #f8d7da;
                                box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
                            }

                            50% {
                                background-color: #f5b3b7;
                                box-shadow: 0 0 12px rgba(220, 53, 69, 0.4);
                            }
                        }

                        @keyframes pulse-warning {

                            0%,
                            100% {
                                background-color: #fff3cd;
                            }

                            50% {
                                background-color: #ffe89e;
                                box-shadow: 0 0 12px rgba(255, 193, 7, 0.4);
                            }
                        }
                    </style>
                    <form action="" class="formtindaklanjut">
                        <div class="card">
                            <div class="card-header bg-light">Tindak Lanjut
                                {{-- <button type="button"
                                    class="btn btn-success float-right riwayatkonsul" data-toggle="modal"
                                    data-target="#modalriwayatkonsul">Riwayat Konsul</button> --}}
                            </div>
                            <div class="card-body">
                                @php
                                    // Menentukan class animasi berkedip secara otomatis
                                    $blinkClass = '';
                                    if (($alertClass ?? '') == 'alert-danger') {
                                        $blinkClass = 'alert-blink-danger';
                                    } elseif (($alertClass ?? '') == 'alert-warning') {
                                        $blinkClass = 'alert-blink-warning';
                                    }
                                @endphp
                                <div class="alert {{ $alertClass }} {{ $blinkClass }} alert-dismissible fade show p-3 mb-3 shadow-sm border-0"
                                    role="alert" style="{{ $borderClass }} color: #212529;">
                                    <div class="row align-items-top">
                                        <div class="col-auto pr-0 pt-1">
                                            <i class="{{ $alertIcon }} fa-2x mx-2"></i>
                                        </div>
                                        <div class="col pl-3">
                                            <strong class="text-uppercase font-weight-bold d-block mb-2"
                                                style="letter-spacing: 1px; font-size: 0.9rem;">
                                                SISTEM MONITORING PROGRAM PRB & RUJUKAN BPJS
                                            </strong>
                                            <p class="mb-0 font-weight-normal text-justify"
                                                style="font-size: 1.1rem; line-height: 1.5;">
                                                {!! $pesan_rujukan !!}
                                            </p>
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                                        style="color: inherit; opacity: 0.6; position: absolute; top: 15px; right: 15px;">
                                        <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                                    </button>
                                </div>
                                @php
                                    // Ambil nilai tindak lanjut dari database, jika null atau kosong set default ke 'PASIEN DIPULANGKAN'
                                    $tindak_lanjut =
                                        $asesmen_terakhir && !empty($asesmen_terakhir->tindak_lanjut)
                                            ? $asesmen_terakhir->tindak_lanjut
                                            : 'PASIEN DIPULANGKAN';
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_konsul" value="KONSUL KE POLI LAIN"
                                        {{ $tindak_lanjut == 'KONSUL KE POLI LAIN' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_konsul">KONSUL KE POLI LAIN</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_kontrol" value="KONTROL"
                                        {{ $tindak_lanjut == 'KONTROL' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_kontrol">KONTROL</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_rujuk_int" value="RUJUK INTERNAL"
                                        {{ $tindak_lanjut == 'RUJUK INTERNAL' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_rujuk_int">RUJUK INTERNAL</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_pulang" value="PASIEN DIPULANGKAN"
                                        {{ $tindak_lanjut == 'PASIEN DIPULANGKAN' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_pulang">PULANG</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_rujuk_out" value="RUJUK KELUAR"
                                        {{ $tindak_lanjut == 'RUJUK KELUAR' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_rujuk_out">RUJUK KELUAR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_rawat_inap" value="RUJUK RAWAT INAP"
                                        {{ $tindak_lanjut == 'RUJUK RAWAT INAP' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_rawat_inap">RAWAT INAP</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                        id="tl_meninggal" value="PASIEN MENINGGAL"
                                        {{ $tindak_lanjut == 'PASIEN MENINGGAL' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tl_meninggal">PASIEN MENINGGAL</label>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="exampleInputEmail1">Keterangan</label>
                                    <textarea type="text" class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut"
                                        aria-describedby="emailHelp">{{ $asesmen_terakhir ? $asesmen_terakhir->keterangan_tindak_lanjut : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form @if (count($poli_pengirim_konsul) == 0) hidden @endif action="" class="jawabankonsul">
                        <style>
                            .shadow-xs {
                                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
                            }

                            .bg-opacity-10 {
                                background-color: rgba(255, 193, 7, 0.1) !important;
                            }

                            .me-1\.5 {
                                margin-right: 0.35rem !important;
                            }

                            .me-3 {
                                margin-right: 1rem !important;
                            }

                            .rounded-3 {
                                border-radius: 0.5rem !important;
                            }
                        </style>
                        <div
                            class="alert alert-warning border-start border-warning border-4 rounded-3 p-4 mb-4 bg-warning bg-opacity-10 shadow-sm animate__animated animate__fadeIn">
                            <div class="d-flex align-items-start">
                                <div class="text-warning me-3 mt-1">
                                    <i
                                        class="fas fa-exclamation-triangle fa-2x animate__animated animate__flash animate__infinite animate__slower"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1" style="letter-spacing: -0.3px;">
                                        PENGINGAT: Silahkan isi lembar jawaban konsul ...
                                    </h5>
                                    <p class="text-secondary mb-0" style="font-size: 0.95rem; line-height: 1.5;">
                                        Pasien ini merupakan pasien konsulan internal. Mohon pastikan Dokter Spesialis
                                        (DPJP) memberikan catatan ekspertisi, rekomendasi tindakan, atau advis terapi
                                        pada kolom di bawah ini sebelum menyelesaikan pelayanan kunjungan.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0 shadow-sm rounded-3">
                            <div class="card-body p-4">
                                <div class="form-group mb-0">
                                    <label for="isi_jawaban_konsul" class="fw-bold text-dark mb-2 fs-5">
                                        <i class="fas fa-file-medical text-primary me-2"></i>Isi Jawaban Konsul Medis
                                        <span class="text-danger">*</span>
                                    </label>

                                    <textarea class="form-control border-secondary-subtle rounded-3 p-3 shadow-xs" id="isi_jawaban_konsul"
                                        name="isi_jawaban_konsul" rows="6"
                                        placeholder="Tuliskan temuan klinis, diagnosis penunjang, saran tindakan, atau rencana terapi untuk poliklinik pengirim di sini..."
                                        required style="font-size: 1.05rem; line-height: 1.6; min-height: 150px;">{{ $asesmen_terakhir ? $asesmen_terakhir->keterangan_tindak_lanjut_2 : '' }}</textarea>

                                    <div class="d-flex align-items-center text-muted mt-2 small">
                                        <i class="fas fa-info-circle me-1.5"></i>
                                        <span>Catatan jawaban ini wajib diisi dan akan otomatis terintegrasi ke dalam
                                            berkas <strong>Resume Medis Rawat Jalan</strong> pasien.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- formtindakan --}}
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-danger" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-light text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne_1" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <i class="bi bi-ticket-detailed mr-1 ml-1"></i> TINDAKAN MEDIS YANG DILAKUKAN
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne_1" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5" style="margin-top:20px">
                                            <h5>Terapi / Tindakan Medis</h5>
                                            <table id="tabeltindakan" class="table table-hover table-sm">
                                                <thead>
                                                    <th>Nama tindakan</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($layanan as $t)
                                                        <tr class="pilihlayanan" namatindakan="{{ $t->Tindakan }}"
                                                            tarif="{{ $t->tarif }}" kode="{{ $t->kode }}"
                                                            id="{{ $t->kode }}">
                                                            <td>{{ $t->Tindakan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-7" style="margin-top:20px">
                                            <div class="card">
                                                <div class="card-header bg-dark">Tindakan / Layanan Pasien</div>
                                                <div class="card-body">
                                                    <form action="" method="post" class="formtindakan">
                                                        <div class="input_fields_wrap">
                                                            <div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-footer">
                                                    <p>pilih layanan untuk pasien</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-danger" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-light text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne_2" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <i class="bi bi-ticket-detailed mr-1 ml-1"></i> ORDER LABORATORIUM
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne_2" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Diagnosa Pemeriksaan
                                                    Penunjang</label>
                                                <input type="text" id="diagnosapemeriksaanpenunjang"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tanggal Pemeriksaan
                                                    Penunjang</label>
                                                <input type="date" id="tanggalperiksapenunjang" value="03/06/2023"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5" style="margin-top:20px">
                                            <h5>Pilih layanan laboratorium</h5>
                                            <table id="tabeltindakan_lab" class="table table-hover table-sm">
                                                <thead>
                                                    <th>Nama tindakan</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($layanan_lab as $t)
                                                        <tr class="pilihlayanan" namatindakan="{{ $t->Tindakan }}"
                                                            tarif="{{ $t->tarif }}" kode="{{ $t->kode }}"
                                                            id="{{ $t->kode }}">
                                                            <td>{{ $t->Tindakan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-7" style="margin-top:20px">
                                            <div class="card">
                                                <div class="card-header bg-dark">Tindakan / Layanan Laboratorium</div>
                                                <div class="card-body">
                                                    <form action="" method="post" class="formorder_lab">
                                                        <div class="input_fields_wrap_lab">
                                                            <div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-footer">
                                                    <p>pilih layanan untuk pasien</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-danger" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-light text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne_3" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <i class="bi bi-ticket-detailed mr-1 ml-1"></i> ORDER RADIOLOGI
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne_3" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Diagnosa Pemeriksaan
                                                    Penunjang</label>
                                                <input type="text" id="diagnosapemeriksaanpenunjang"
                                                    class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tanggal Pemeriksaan
                                                    Penunjang</label>
                                                <input type="date" id="tanggalperiksapenunjang" value="03/06/2023"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5" style="margin-top:20px">
                                            <h5>Terapi / Tindakan Medis</h5>
                                            <table id="tabeltindakan_rad" class="table table-hover table-sm">
                                                <thead>
                                                    <th>Nama tindakan</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($layanan_rad as $t)
                                                        <tr class="pilihlayanan" namatindakan="{{ $t->Tindakan }}"
                                                            tarif="{{ $t->tarif }}" kode="{{ $t->kode }}"
                                                            id="{{ $t->kode }}">
                                                            <td>{{ $t->Tindakan }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-7" style="margin-top:20px">
                                            <div class="card">
                                                <div class="card-header bg-dark">Tindakan / Layanan Pasien</div>
                                                <div class="card-body">
                                                    <form action="" method="post" class="formtindakan_rad">
                                                        <div class="input_fields_wrap_rad">
                                                            <div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="card-footer">
                                                    <p>pilih layanan untuk pasien</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header bg-danger" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-block text-light text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne_4" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <i class="bi bi-ticket-detailed mr-1 ml-1"></i> ORDER LAB PATOLOGI ANATOMI
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne_4" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger float-right ml-2" onclick="batalisi()">Batal</button>
            <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
        @else
            <style>
                .bg-danger-subtle {
                    background-color: #f8d7da !important;
                    /* Warna merah muda lembut penanda error */
                }

                .shadow-xs {
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
                }
            </style>
            <div
                class="card border-danger border-2 shadow-sm rounded-3 mb-4 bg-danger-subtle animate__animated animate__headShake">
                <div class="card-body p-5 text-center">
                    <div class="text-danger mb-4">
                        <i class="bi bi-exclamation-octagon-fill"
                            style="font-size: 4.5rem; filter: drop-shadow(0px 4px 8px rgba(220, 53, 69, 0.2));"></i>
                    </div>

                    <h3 class="fw-bold text-danger mb-2" style="letter-spacing: -0.5px;">
                        AKSES FORM DOKTER DIKUNCI!
                    </h3>

                    <p class="text-dark mx-auto mb-4 fs-5" style="max-width: 600px; line-height: 1.6;">
                        Formulir pemeriksaan medis Dokter belum dapat diakses karena <span
                            class="fw-bold text-danger">Asesmen Keperawatan (Tanda-Tanda Vital & Keluhan Awal)</span>
                        untuk kunjungan pasien ini belum diisi oleh Perawat Poliklinik.
                    </p>

                    <div
                        class="d-inline-flex align-items-center bg-white border border-danger-subtle px-4 py-2 rounded-pill shadow-xs">
                        <span class="spinner-grow spinner-grow-sm text-danger me-2" role="status"></span>
                        <small class="text-secondary fw-medium">
                            Silakan hubungi perawat penanggung jawab poli untuk melengkapi pemeriksaan pra-konsultasi.
                        </small>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalcatatanhemodialisa" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Catatan Hemodialisa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="v_catatan_hd">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasillab" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hasil Pemeriksaan Laboratorium</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_lab_baru">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsumarilis" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUMARILIS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_sumarilis">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilpenunjang_rad" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Radiologi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_penunjang_rad">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilpenunjang_pa" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Patologi Anatomi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_penunjang_pa">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalicare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Icare Pasien BPJS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_icare2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplate" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vtemplateresep">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatkonsul" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Konsul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="view_riwayat_konsul">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalscan_rm" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BERKAS RM SCAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vrm_lama">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalberkaslain" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BERKAS DARI LUAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vberkasluar">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-xl {
        max-width: 80%;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalcppt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Perkembangan Pasien Terintegrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_cppt">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="hasil_lab_by_form_dokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <div class="row">
            <div class="col-md-2">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah data</label>
                    <input type="email" class="form-control" id="jumlahdatahasil" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Masukan jumlah data yang ingin ditampilkan ...</small>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" style="margin-top:32px" onclick="tampilkanhasilnya()">Tampilkan</button>
            </div>
        </div> --}}
                <div class="v_hasil_lab_by_dokter mt-2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" id="statuslihatcppt" value="0">
<link rel="stylesheet" href="{{ asset('public/dist/css/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('public/dist/js/bootstrap-datepicker.js') }}"></script>
<script>
    function showmodalpenunjanglab() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('ambilhasillab') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.v_hasil_lab_baru').html(response);
                spinner.hide()
            }
        });
    }

    function showmodalpenunjanglabspesial() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('ambilhasillabspesial') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.v_hasil_lab_baru').html(response);
                spinner.hide()
            }
        });
    }

    function showmodalpenunjangPA() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_pa') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.v_hasil_penunjang_pa').html(response);
                spinner.hide()
            }
        });
    }

    function showmodalpenunjangRAD() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('liathasilpenunjangradiologi') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.v_hasil_penunjang_rad').html(response);
                spinner.hide()
            }
        });
    }

    function showmodalberkasrm() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihatberkasscanrm') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.vrm_lama').html(response);
                spinner.hide()
            }
        });
    }
    function showmodalriwayatsumarilis() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihatriwayatsumarilispasien') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.v_sumarilis').html(response);
                spinner.hide()
            }
        });
    }

    function showmodalscanberkaslain() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihatberkaslain') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.vberkasluar').html(response);
                spinner.hide()
            }
        });
    }

    function showmodalcatatanhemodialisa() {
        spinner = $('#loader')
        spinner.show();
        rm = $(this).attr('nomorrm')
        jenis = '1'
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                jenis
            },
            url: '<?= route('ambilriwayatcatatanhemodialisa') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.v_catatan_hd').html(response);
                spinner.hide()
            }
        });
    }
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());
    });

    function simpanhasil() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Pastikan data sudah diisi dengan benar !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan !"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanhasil2()
            }
        });
    }

    function tampilkanhasilnya() {
        jlh = $('#jumlahdatahasil').val()
        rm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jlh,
                rm
            },
            url: '<?= route('ambilhasillab_by_limit') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_hasil_lab_by_dokter').html(response);
                spinner.hide()
            }
        });
    }

    function simpanhasil2() {
        var data1 = $('.form_pemeriksaan_1').serializeArray();
        var data2 = $('.form_pemeriksaan_2').serializeArray();
        var data3 = $('.form_pemeriksaan_3').serializeArray();
        var data4 = $('.form_pemeriksaan_4').serializeArray();
        var data5 = $('.formpemeriksaankhusus').serializeArray();
        var formorder_lab = $('.formorder_lab').serializeArray();
        var formtindakan_rad = $('.formtindakan_rad').serializeArray();
        var datatindakan = $('.formtindakan').serializeArray();
        var formobat_farmasi = $('.formobat_farmasi').serializeArray();
        var formobatfarmasi2 = $('.arrayobat').serializeArray();
        var datatindaklanjut = $('.formtindaklanjut').serializeArray();
        var jawabankonsul = $('.jawabankonsul').serializeArray();
        var simpantemplate = $('#simpantemplate:checked').val()
        var namaresep = $('#namaresep').val()
        var kodekunjungan = $('#kodekunjungan').val()
        var pasieniter = $('#iterasipilih:checked').val()
        var jumlahiter = $('#jumlahiterasi').val()
        var hasilexpertisi = $('#hasilexpertisi').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data1: JSON.stringify(data1),
                data2: JSON.stringify(data2),
                data3: JSON.stringify(data3),
                data4: JSON.stringify(data4),
                data5: JSON.stringify(data5),
                datatindakan: JSON.stringify(datatindakan),
                datatindaklanjut: JSON.stringify(datatindaklanjut),
                jawabankonsul: JSON.stringify(jawabankonsul),
                formobat_farmasi: JSON.stringify(formobat_farmasi),
                formobatfarmasi2: JSON.stringify(formobatfarmasi2),
                simpantemplate,
                namaresep,
                kodekunjungan,
                formorder_lab: JSON.stringify(formorder_lab),
                formtindakan_rad: JSON.stringify(formtindakan_rad),
                hasilexpertisi,
                pasieniter,
                jumlahiter
            },
            url: '<?= route('simpanhasilpemeriksaandokter') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    resume2()
                }
            }
        });
    }

    function ambilformiterasiobat() {
        var kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_formiterasiobat') ?>',
            success: function(response) {
                $('.v_itterasi_obat').html(response);
                spinner.hide()
            }
        });
    }

    function batalisi() {
        rm = $('#nomorrm').val()
        formcatatanmedis(rm)
    }
    $(function() {
        $("#tabeltindakan_rad").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltindakan_rad').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_rad"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                    kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });
    $(function() {
        $("#tabeltindakan_lab").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltindakan_lab').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_lab"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                    kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });
    $(function() {
        $("#tabeltindakan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltindakan').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                    kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });

    function showname() {
        a = $('#simpantemplate:checked').val()
        if (a == 'on') {
            $('#namaresep').removeAttr('Hidden', true)
        } else {
            $('#namaresep').attr('Hidden', true)
        }
    }

    function ambilresep() {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilresep') ?>',
            error: function(data) {
                alert('ok')
                spinner.hide()
            },
            success: function(response) {
                $('.vtemplateresep').html(response)
                spinner.hide()
            }
        });
    }

    function ambilriwayatresep() {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilriwayatreseppasien') ?>',
            error: function(data) {
                alert('ok')
                spinner.hide()
            },
            success: function(response) {
                $('.vtemplateresep').html(response)
                spinner.hide()
            }
        });
    }
    $('#pencarianobat').on('input', function() {
        var kodekunjungan = $('#kodekunjungan').val()
        // spinner = $('#loader')
        // spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                key: $('#pencarianobat').val(),
                kodekunjungan
            },
            url: '<?= route('cariobat') ?>',
            success: function(response) {
                $('.tableobat').html(response);
                // spinner.hide()
            }
        });
    });

    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
        markerArea.show();
    }
    $(document).ready(function() {
        ambilgambar()
        ambilriwayatobat()
        ambilformiterasiobat()
    })

    function ambilriwayatobat() {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilriwayatobat') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.formobatfarmasi2').html(response)
                spinner.hide()
            }
        });
    }

    function resetgambar() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilgambarpemeriksaan_reset') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.gambar1').html(response)
            }
        });
    }

    function ambilgambar() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilgambarpemeriksaan') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.gambar1').html(response)
            }
        });
    }

    function showicare2() {
        var kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_icarepasien') ?>',
            success: function(response) {
                $('.v_icare2').html(response);
                spinner.hide()
            }
        });
    }

    function addform() {
        var max_fields = 10;
        var wrapper = $(".formobatfarmasi2"); //Fields wrapper
        var x = 1
        jlh = $('#jumlahform').val()
        cek = document.getElementById('jumlahform').value
        if (cek === '') {
            jlh1 = $('#jumlahform').val(1)
        } else {
            cek = parseInt(document.getElementById('jumlahform').value)
            jlh2 = $('#jumlahform').val(cek + 1)
        }
        nomor = parseInt(document.getElementById('jumlahform').value)
        if (x < max_fields) { //max input box allowed
            nama = 'namaobat' + nomor
            aturan = 'aturanpakai' + nomor
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Obat</label><input type="" class="form-control form-control-sm text-xs" id="' +
                nama +
                '" name="namaobat" value=""><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodebarang" value="""></div><div class="form-group col-md-2"><label for="inputPassword4">Aturan Pakai</label><input type="" class="form-control form-control-sm" id="' +
                aturan +
                '" name="aturanpakai" value=""></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"><input hidden type="" class="form-control form-control-sm" id="" name="kode_kunjungan" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                kode = $(this).attr('kode2')
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
            // $('#'+nama).autocomplete({
            //     source: "<?= route('cariobat') ?>",
            //     select: function(event, ui) {
            //         $('[id="namaobat"]').val(ui.item.label);
            //         $('[id="'+aturan+'"]').val(ui.item.aturan);
            //     }
            // });
        }
    }
    $(".scanrm_liat").on('click', function(event) {
        rm = $(this).attr('rm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('lihathasil_scanrm') ?>',
            error: function(data) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                spinner.hide();
                $('.vrm_lama').html(response);
            }
        });
    })
    $(".liatberkasluar").on('click', function(event) {
        rm = $(this).attr('rm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('vberkasluar') ?>',
            error: function(data) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                spinner.hide();
                $('.vberkasluar').html(response);
            }
        });
    })
    $(".liathasil_lab2").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('rm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_lab2') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_lab').html(response);
                spinner.hide()
            }
        });
    })
     function ambildatakunjungan() {
        rm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambilcatatanmedis_pasien_xx') ?>',
            success: function(response) {
                $('.v_cppt').html(response);
                spinner.hide()
            }
        });
    }

</script>
<script src="{{ asset('public/marker/markerjs2.js') }}"></script>
