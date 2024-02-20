<div class="card">
    <div class="card-header bg-info">CPPT
        <button class="btn btn-warning ml-2" idrp="{{ $resume_perawat[0]->id }}" data-toggle="modal"
            data-target="#modalresumeperawat"><i class="bi bi-eye mr-1"></i> Hasil Assesmen Keperawatan</button>
        {{-- <button class="btn btn-danger ml-2 lihathasilpenunjang_lab" nomorrm="{{ $kunjungan[0]->no_rm }}" data-toggle="modal"
            data-target="#modalhasilpenunjang_lab"><i class="bi bi-eye mr-1"></i> Hasil Pemeriksaan Laboratorium</button>
        <button class="btn btn-danger ml-2 lihathasilpenunjang_rad" nomorrm="{{ $kunjungan[0]->no_rm }}" data-toggle="modal"
            data-target="#modalhasilpenunjang_rad"><i class="bi bi-eye mr-1"></i> Hasil Pemeriksaan Radiologi</button>
        @if ($kunjungan[0]->ref_kunjungan != '0')
            <button class="btn btn-warning ml-2" idrp="{{ $resume_perawat[0]->id }}" data-toggle="modal"
                data-target="#modalcatatankonsul"><i class="bi bi-eye mr-1"></i> Catatan Konsul</button>
        @endif --}}
    </div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if ($kunjungan[0]->ref_kunjungan != '0')
            <div class="jumbotron">
                <h1 class="display-4">Hello {{ auth()->user()->nama }} </h1><br>
                <p class="lead">Dokter Pengirim : {{ $kunjungan[0]->dokter_kirim }}</p>
                <p class="lead">Poliklinik Pengirim : {{ $kunjungan[0]->poli_asal }}</p>
                <p class="lead">Mohon Konsul</p>
                <p class="lead">Pasien dengan : <br>RM {{ $kunjungan[0]->no_rm }} |
                    {{ $kunjungan[0]->nama_pasien }} | {{ $kunjungan[0]->diagx }} <br><br>
                    Keterangan <br>
                    @if (count($ref_resume) > 0)
                        {{ $ref_resume[0]->keterangan_tindak_lanjut }}@endif
                </p>
                <hr class="my-4">
            </div>
        @endif
        <div class="card">
            <div class="card-header text-bold bg-success">+ SUBJECT ( S )</div>
            <div class="card-body">
                <form action="" class="form_pemeriksaan_1">
                {{-- riwayatkesehatan --}}
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header bg-secondary" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left text-light font-weight" type="button"
                                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <i class="bi bi-ticket-detailed mr-1 ml-1"></i> Riwayat Kesehatan
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body bg-light">
                                <table>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Kehamilan (bagi pasien wanita) </td>
                                        <td colspan="3">
                                            <textarea name="riwayatkehamilan" cols="10" rows="4" class="form-control">@if (count($last_assdok) > 0){{ $last_assdok[0]->riwayat_kehamilan_pasien_wanita }}@endif</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Kelahiran (bagi pasien anak) </td>
                                        <td colspan="3">
                                            <textarea name="riwayatkelahiran" cols="10" rows="4" class="form-control">@if (count($last_assdok) > 0){{ $last_assdok[0]->riwyat_kelahiran_pasien_anak }}@endif</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Penyakit Sekarang</td>
                                        <td colspan="3">
                                            <textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control">@if (count($last_assdok) > 0){{ $last_assdok[0]->riwyat_penyakit_sekarang }}@endif</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Penyakit Dahulu</td>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="hipertensi"
                                                            name="hipertensi" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->hipertensi == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Hipertensi</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="kencingmanis" name="kencingmanis" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->kencingmanis == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label" for="exampleCheck1">Kencing
                                                            Manis</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="jantung"
                                                            name="jantung" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->jantung == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Jantung</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="stroke"
                                                            name="stroke" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->stroke == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Stroke</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="hepatitis"
                                                            name="hepatitis" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->hepatitis == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Hepatitis</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="asthma" name="asthma" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->asthma == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Asthma</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="ginjal" name="ginjal" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->ginjal == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Ginjal</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="tb" name="tb" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->tbparu == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label" for="exampleCheck1">TB
                                                            Paru</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="riwayatlain" name="riwayatlain" value="1"
                                                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->riwayatlain == '1') checked @endif
                                                            @endif>
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Lain-lain</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="ketriwayatlain" id="ketriwayatlain" class="form-control" placeholder="keterangan lain - lain">@if (count($last_assdok) > 0){{ $last_assdok[0]->ket_riwayatlain }}@endif</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Alergi</td>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input ml-2 mr-3" type="radio"
                                                        name="alergi" id="alergi" value="Tidak Ada"
                                                        @if (count($last_assdok) > 0) @if ($last_assdok[0]->riwayat_alergi == 'Tidak Ada') checked @endif
                                                    @else checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak
                                                        Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input mr-3" type="radio"
                                                        name="alergi" id="alergi" value="Ada"
                                                        @if (count($last_assdok) > 0) @if ($last_assdok[0]->riwayat_alergi == 'Ada') checked @endif
                                                        @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Ada</label>
                                                    <div class="form-group form-check">
                                                        <input class="form-control" id="ketalergi" name="ketalergi"
                                                            placeholder="keterangan alergi ..."
                                                            value="@if (count($last_assdok) > 0) {{ $last_assdok[0]->keterangan_alergi }} @endif">
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
                                                value="@if (count($last_assdok) > 0) {{ $last_assdok[0]->statusgeneralis }} @endif">
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
                    value="{{ $resume_perawat[0]->id }}">
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
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                    value="Pasien Sendiri" @if ($resume_perawat[0]->sumberdataperiksa == 'Pasien Sendiri') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Pasien Sendiri /
                                    Autoanamase</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                    value="Keluarga" @if ($resume_perawat[0]->sumberdataperiksa == 'Keluarga') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Keluhan Utama</td>
                        <td colspan="3">
                            <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ...">{{ $resume_perawat[0]->keluhanutama }}</textarea>
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
                                    <input type="text" class="form-control" placeholder="Tekanan darah pasien ..."
                                        aria-label="Recipient's username" id="tekanandarah" name="tekanandarah"
                                        aria-describedby="basic-addon2"
                                        value="{{ $resume_perawat[0]->tekanandarah }}">
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
                                        value="{{ $resume_perawat[0]->frekuensinadi }}">
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
                                        value="{{ $resume_perawat[0]->frekuensinapas }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">x/menit</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-bold font-italic">Suhu</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Suhu tubuh pasien ..."
                                        aria-label="Suhu tubuh pasien" name="suhutubuh" id="suhutubuh"
                                        aria-describedby="basic-addon2" value="{{ $resume_perawat[0]->suhutubuh }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">°C</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Berat Badan / tinggi badan / IMT</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Berat badan Pasien ..."
                                        name="beratbadan" id="beratbadan" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" value="{{ $resume_perawat[0]->beratbadan }}">
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
                                        aria-describedby="basic-addon2" value="{{ $resume_perawat[0]->usia }}">
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
                                <textarea class="form-control" rows="5" name="pemeriksaanfisik">@if (count($last_assdok) > 0){{ $last_assdok[0]->pemeriksaan_fisik }} @endif</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="bg-secondary">Pemeriksaan Umum</td>
                        </tr>
                        <tr hidden>
                            <td class="text-bold font-italic">Keadaan Umum</td>
                            <td colspan="3">
                                <textarea class="form-control" name="keadaanumum">@if (count($last_assdok) > 0){{ $last_assdok[0]->keadaanumum }} @endif</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Kesadaran</td>
                            <td colspan="3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kesadaran" id="kesadaran"
                                        value="Composmentis" checked>
                                    <label class="form-check-label" for="inlineRadio1">Composmentis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kesadaran" id="kesadaran"
                                        value="Lainnya">
                                    <label class="form-check-label" for="inlineRadio2">Lain - Lain</label>
                                </div>
                                <textarea class="form-control mt-2" name="keterangankesadaran" placeholder="keterangan lain - lain ..."></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
                {{-- formpemeriksaankhusus --}}
                <div class="card">
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
                            @if (auth()->user()->unit == '1014')
                                <form action="" class="formpemeriksaankhusus">
                                    @if (count($hasil_ro) == 0)
                                        <input hidden type="text" class="form-control" id="id_asskep"
                                            name="id_asskep" value="">
                                        <table class="table table-sm">
                                            <tr>
                                                <td colspan="4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="gambar1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hasil pemerikssaan RO</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" rows="8" id="hasilperiksalain" name="hasilperiksalain"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tekanan Intra Okular</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Catatan Pemeriksaan Lainnya</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Palpebra</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        id="palpebra" name="palpebra"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Konjungtiva</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        id="konjungtiva" name="konjungtiva"></input>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Kornea</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        name="kornea" id="kornea"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Bilik Mata Depan</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Pupil</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        id="pupil" name="pupil"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Iris</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        name="iris" id="iris"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Lensa</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        name="lensa" id="lensa"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Funduskopi</td>
                                                <td colspan="3"><input class="form-control" value=""
                                                        name="funduskopi" id="funduskopi"></input>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Status Oftalmologis Khusus</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" value="" name="oftamologis" id="oftamologis"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Masalah Medis</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" value="" name="masalahmedis" id="masalahmedis"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Prognosis</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" value="" name="prognosis" id="prognosis"></textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    @else
                                        <input hidden type="text" class="form-control" id="id_asskep"
                                            name="id_asskep" value="{{ $hasil_ro[0]->id_asskep }}">
                                        <table class="table table-sm">
                                            <tr>
                                                <td colspan="4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="gambar1">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hasil pemerikssaan RO</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" rows="8" id="hasilperiksalain" name="hasilperiksalain">{{ $hasil_ro[0]->tajampenglihatandekat }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tekanan Intra Okular</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $hasil_ro[0]->tekananintraokular }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Catatan Pemeriksaan Lainnya</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $hasil_ro[0]->catatanpemeriksaanlain }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Palpebra</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->palpebra }}" id="palpebra"
                                                        name="palpebra"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Konjungtiva</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->konjungtiva }}" id="konjungtiva"
                                                        name="konjungtiva"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Kornea</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->kornea }}" name="kornea"
                                                        id="kornea"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Bilik Mata Depan</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->bilikmatadepan }}"
                                                        name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Pupil</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->pupil }}" id="pupil"
                                                        name="pupil"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Iris</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->iris }}" name="iris"
                                                        id="iris"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Lensa</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->lensa }}" name="lensa"
                                                        id="lensa"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Funduskopi</td>
                                                <td colspan="3"><input class="form-control"
                                                        value="{{ $hasil_ro[0]->funduskopi }}" name="funduskopi"
                                                        id="funduskopi"></input></td>
                                            </tr>
                                            <tr>
                                                <td>Status Oftalmologis Khusus</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" name="oftamologis" id="oftamologis">{{ $hasil_ro[0]->status_oftamologis_khusus }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Masalah Medis</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" name="masalahmedis" id="masalahmedis">{{ $hasil_ro[0]->masalahmedis }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Prognosis</td>
                                                <td colspan="3">
                                                    <textarea class="form-control" name="prognosis" id="prognosis">{{ $hasil_ro[0]->prognosis }}</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </form>
                            @elseif(auth()->user()->unit == '1019')
                                {{-- <form class="formpemeriksaankhusus"> --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="gambar1">

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header bg-dark">Telinga Kanan</div>
                                        <div class="card-body">
                                            <form action="" class="formtelingakanan">
                                                <table class="table table-sm table-responsive">
                                                    <tr>
                                                        <td>Liang Telinga</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Liang Telinga')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="ltketeranganlain">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Membran Timpan</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Membran Timpani')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    id=""
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="mtketeranganlain">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kavum Timpani</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Mukosa</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mukosa">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Oslkel</label>
                                                                    <input type="text" class="form-control"
                                                                        name="oslkel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Isthmus timpani/anterior
                                                                        timpani/posterior timpani</label>
                                                                    <input type="text" class="form-control"
                                                                        name="Isthmus">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lain - Lain</td>
                                                        <td>
                                                            <textarea class="form-control" name="keteranganlain"></textarea>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header bg-dark">Telinga Kiri</div>
                                        <div class="card-body">
                                            <form action="" class="formtelingakiri">
                                                <table class="table table-sm table-responsive">
                                                    <tr>
                                                        <td>Liang Telinga</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Liang Telinga')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="ltketeranganlain">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Membran Timpan</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Membran Timpani')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    id=""
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="mtketeranganlain">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kavum Timpani</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Mukosa</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mukosa">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Oslkel</label>
                                                                    <input type="text" class="form-control"
                                                                        name="oslkel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Isthmus timpani/anterior
                                                                        timpani/posterior timpani</label>
                                                                    <input type="text" class="form-control"
                                                                        name="Isthmus">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lain - Lain</td>
                                                        <td>
                                                            <textarea class="form-control" name="keteranganlain"></textarea>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <form action="" class="formanjurantelinga">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td>Kesimpulan</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea class="form-control" id="kesimpulan" name="kesimpulan"></textarea>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Anjuran</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea class="form-control" id="anjuran" name="anjuran"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header text-bold bg-dark">Hidung Kanan</div>
                                            <div class="card-body">
                                                <form action="" class="formhidungkanan">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>Kavum Nasi</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Kavum Nasi')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Konka Inferior</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Konka Interior')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Meatus Medius</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Meatus Medius')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Septum</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Septum')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nasofaring</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Nasofaring')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lain - Lain</td>
                                                            <td>
                                                                <textarea class="form-control" name="lain-lain" id="lain-lain"></textarea>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header text-bold bg-dark">Hidung Kiri</div>
                                            <div class="card-body">
                                                <form action="" class="formhidungkiri">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>Kavum Nasi</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Kavum Nasi')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Konka Inferior</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Konka Interior')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Meatus Medius</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Meatus Medius')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Septum</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Septum')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nasofaring</td>
                                                            <td>
                                                                <div class="row">
                                                                    @foreach ($penyakit as $p)
                                                                        @if ($p->sub_organ == 'Nasofaring')
                                                                            <div class="col-md-4">
                                                                                <div class="form-group form-check">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input"
                                                                                        id=""
                                                                                        name="{{ $p->nama_pemeriksaan }}"
                                                                                        value="1">
                                                                                    <label class="form-check-label"
                                                                                        for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Lain - Lain</td>
                                                            <td>
                                                                <textarea class="form-control" name="lain-lain" id="lain-lain"></textarea>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <form action="" class="formkesimpulanhidung">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td>Kesimpulan</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <textarea class="form-control" id="kesimpulanhidung" name="kesimpulanhidung"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <form action="" class="formpemeriksaankhusus">
                                    <div class="col-md-12">
                                        <div class="gambar1">

                                        </div>
                                    </div>
                                </form>
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
                            <td class="text-bold font-italic">Diagnosa Primer</td>
                            <td colspan="2">
                                <textarea name="diagnosakerja" id="diagnosakerja" class="form-control">@if (count($last_assdok) > 0){{ $last_assdok[0]->diagnosakerja }}@endif</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Diagnosa Sekunder</td>
                            <td colspan="2">
                                <textarea name="diagnosabanding" id="diagnosabanding" class="form-control">@if (count($last_assdok) > 0){{ $last_assdok[0]->diagnosabanding }}@endif</textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div @if ($kunjungan[0]->ref_kunjungan == '0') hidden @endif class="card">
                    <div class="card-header bg-warning">Jawaban Konsul</div>
                    <div class="card-body">
                        <textarea name="jawabankonsul" id="jawabankonsul" rows="10"class="form-control"></textarea>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-bold bg-success">+ PLANNING ( P )
                <button class="btn btn-danger ml-2 lihathasilpenunjang_lab" nomorrm="{{ $kunjungan[0]->no_rm }}"
                    data-toggle="modal" data-target="#modalhasilpenunjang_lab"><i class="bi bi-eye mr-1"></i>
                    Hasil Laboratorium</button>
                <button class="btn btn-danger ml-2 lihathasilpenunjang_rad" nomorrm="{{ $kunjungan[0]->no_rm }}"
                    data-toggle="modal" data-target="#modalhasilpenunjang_rad"><i class="bi bi-eye mr-1"></i>
                    Hasil Radiologi</button>
                <button class="btn btn-danger ml-2 lihathasilpenunjang_pa" nomorrm="{{ $kunjungan[0]->no_rm }}"
                    data-toggle="modal" data-target="#modalhasilpenunjang_pa"><i class="bi bi-eye mr-1"></i>
                    Hasil LAB PA</button>
                <button class="btn btn-warning ml-2 scanrm_liat" rm="{{ $kunjungan[0]->no_rm }}" data-toggle="modal"
                    data-target="#modalscan_rm"><i class="bi bi-journal-text"></i> BERKAS RM SCAN</button>
                    <button class="btn btn-warning ml-2 liatsumarilis" rm="{{ $kunjungan[0]->no_rm }}"
                        data-toggle="modal" data-target="#modalsumarilis"><i class="bi bi-journal-text"></i> SUMARILIS</button>

                <button class="btn btn-danger ml-2 liatberkasluar" rm="{{ $kunjungan[0]->no_rm }}" data-toggle="modal"
                    data-target="#modalberkasluar"><i class="bi bi-journal-text"></i> BERKAS LAIN</button>
                @if ($kunjungan[0]->ref_kunjungan != '0')
                    <button class="btn btn-warning ml-2" idrp="{{ $resume_perawat[0]->id }}" data-toggle="modal"
                        data-target="#modalcatatankonsul"><i class="bi bi-eye mr-1"></i> Catatan Konsul</button>
                @endif
            </div>
            <div class="card-body">
                <form action="" class="form_pemeriksaan_4">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td class="text-bold font-italic">Rencana Terapi</td>
                            <td colspan="3">
                                <textarea class="form-control" name="rencanakerja">@if (count($last_assdok) > 0){{ $last_assdok[0]->rencanakerja }} @endif</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Tindakan Medis</td>
                            <td colspan="3">
                                <textarea class="form-control" name="tindakanmedis">@if (count($last_assdok) > 0){{ $last_assdok[0]->tindakanmedis }} @endif</textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
                {{-- formfarmasi --}}
                <div class="card">
                    <div class="card-header bg-light">Order Farmasi <button type="button"
                            class="btn btn-success float-right" data-toggle="modal" data-target="#modaltemplate"
                            onclick="ambilresep()">Template resep</button></div>
                    <div class="card-body">
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-success tambahobat" onclick="addform()">+ Tambah
                                Obat</button>
                        </div>
                        <input hidden type="text" value="" id="jumlahform">
                        <form action="" method="post" class="arrayobat">
                            <div class="formobatfarmasi2">

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
                    </div>
                </div>
                {{-- formtindaknlanjut --}}
                <form action="" class="formtindaklanjut">
                    <div class="card">
                        <div class="card-header bg-light">Tindak Lanjut <button type="button"
                                class="btn btn-success float-right riwayatkonsul" data-toggle="modal"
                                data-target="#modalriwayatkonsul">Riwayat Konsul</button></div>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                    id="pilihtindaklanjut" value="KONSUL KE POLI LAIN">
                                <label class="form-check-label" for="inlineRadio1">KONSUL KE POLI LAIN</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                    id="pilihtindaklanjut" value="KONTROL">
                                <label class="form-check-label" for="inlineRadio2">KONTROL</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                    id="pilihtindaklanjut" value="PASIEN DIPULANGKAN">
                                <label class="form-check-label" for="inlineRadio2">PULANG</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                    id="pilihtindaklanjut" value="RUJUK KELUAR">
                                <label class="form-check-label" for="inlineRadio2">RUJUK KELUAR</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                    id="pilihtindaklanjut" value="RUJUK RAWAT INAP">
                                <label class="form-check-label" for="inlineRadio2">RAWAT INAP</label>
                            </div>
                            <div class="form-check form-check-inline mb-2">
                                <input class="form-check-input" type="radio" name="pilihtindaklanjut"
                                    id="pilihtindaklanjut" value="PASIEN MENINGGAL">
                                <label class="form-check-label" for="inlineRadio2">PASIEN MENINGGAL</label>
                            </div>
                            <div class="form-group mt-2">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea type="text" class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut"
                                    aria-describedby="emailHelp"></textarea>
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
                                    <div @if(auth()->user()->unit != '1012' && auth()->user()->unit != '1027' && auth()->user()->id != '220' ) hidden @endif class="col-md-12">
                                        <div class="card">
                                            <div class="card-header text-bold bg-dark">Hasil Expertisi</div>
                                            <div class="card-body">
                                                <textarea class="form-control" id="hasilexpertisi" name="hasilexpertisi" cols="30" rows="10" placeholder="Silahkan isi hasil expertisi ...">@if (count($last_assdok) > 0){{ $last_assdok[0]->evaluasi }}@endif</textarea>
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
                                            <label for="exampleFormControlSelect1">Diagnosa Pemeriksaan Penunjang</label>
                                            <input type="text" id="diagnosapemeriksaanpenunjang" class="form-control"
                                                value="@if (count($last_assdok) > 0){{ $last_assdok[0]->diagnosakerja }}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Tanggal Pemeriksaan Penunjang</label>
                                            <input type="date" id="tanggalperiksapenunjang" value="03/06/2023" class="form-control">
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
                                            <label for="exampleFormControlSelect1">Diagnosa Pemeriksaan Penunjang</label>
                                            <input type="text" id="diagnosapemeriksaanpenunjang" class="form-control"
                                                value="@if (count($last_assdok) > 0){{ $last_assdok[0]->diagnosakerja }}@endif">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Tanggal Pemeriksaan Penunjang</label>
                                            <input type="date" id="tanggalperiksapenunjang" value="03/06/2023" class="form-control">
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
        {{-- <form action="" class="formpemeriksaandokter">

        </form> --}}


        <button type="button" class="btn btn-danger float-right ml-2" onclick="batalisi()">Batal</button>
        <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalsumarilis" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="modalhasilpenunjang_lab" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_penunjang_lab">

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
    <div class="modal-dialog modal-lg">
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
<div class="modal fade" id="modalresumeperawat" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Resume Perawat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <table class="table table-sm text-sm">
                        <tr>
                            <td class="text-bold font-italic">Sumber Data</td>
                            <td>{{ $resume_perawat[0]->sumberdataperiksa }}</td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Keluhan Utama</td>
                            <td>{{ $resume_perawat[0]->keluhanutama }}</td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Tekanan Darah</td>
                            <td>{{ $resume_perawat[0]->tekanandarah }} mmHg</td>
                            <td class="text-bold font-italic">Frekuensi Nadi</td>
                            <td>{{ $resume_perawat[0]->frekuensinadi }} x/menit</td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Frekuensi Nafas</td>
                            <td>{{ $resume_perawat[0]->frekuensinapas }} x/menit</td>
                            <td class="text-bold font-italic">Suhu</td>
                            <td>{{ $resume_perawat[0]->suhutubuh }} °C</td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Riwayat Psikologis</td>
                            <td>{{ $resume_perawat[0]->Riwayatpsikologi }}</td>
                            <td class="text-bold font-italic">Keterangan</td>
                            <td>{{ $resume_perawat[0]->keterangan_riwayat_psikolog }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="bg-warning text-bold">Status
                                Fungsional</td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Penggunaan Alat Bantu</td>
                            <td>{{ $resume_perawat[0]->penggunaanalatbantu }}</td>
                            <td class="text-bold font-italic">Keterangan Alat Bantu</td>
                            <td>{{ $resume_perawat[0]->keterangan_alat_bantu }}</td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Cacat Tubuh</td>
                            <td>{{ $resume_perawat[0]->cacattubuh }}</td>
                            <td class="text-bold font-italic">Keterangan Cacat Tubuh</td>
                            <td>{{ $resume_perawat[0]->keterangancacattubuh }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="bg-warning text-bold">Assesmen Nyeri
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Keluhan Nyeri</td>
                            <td>{{ $resume_perawat[0]->Keluhannyeri }}</td>
                            <td class="text-bold font-italic">Keterangan</td>
                            <td>{{ $resume_perawat[0]->skalenyeripasien }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-bold bg-warning">Assesmen resiko
                                jatuh</td>
                        </tr>
                        <tr>
                            <td>Resiko Jatuh</td>
                            <td>{{ $resume_perawat[0]->resikojatuh }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-bold bg-warning">Skrinning Gizi
                            </td>
                        </tr>
                        <tr>
                            <td>1. Apakah pasien mengalami penurunan berat badan yang tidak
                                diinginkan dalam 6 bulan terakhir ? </td>
                            <td>{{ $resume_perawat[0]->Skrininggizi }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan </td>
                            <td>{{ $resume_perawat[0]->beratskrininggizi }}</td>
                        </tr>
                        <tr>
                            <td>2. Apakah asupan makanan berkurang karena berkurangnya nafsu
                                makan</td>
                            <td>{{ $resume_perawat[0]->status_asupanmkanan }}</td>
                        </tr>
                        <tr>
                            <td>3. Pasien dengan diagnosa khusus : Penyakit DM / Ginjal /
                                Hati / Paru / Stroke / Kanker / Penurunan imunitas geriatri,
                                lain lain...</td>
                            <td>{{ $resume_perawat[0]->diagnosakhusus }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan </td>
                            <td>{{ $resume_perawat[0]->penyakitlainpasien }}</td>
                        </tr>
                        <tr>
                            <td>4. Bila skor >= 2, pasien beresiko malnutrisi dilakukan
                                pengkajian lanjut oleh ahli gizi</td>
                            <td>{{ $resume_perawat[0]->resikomalnutrisi }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan </td>
                            <td>{{ $resume_perawat[0]->tglpengkajianlanjutgizi }}</td>
                        </tr>
                        <tr>
                            <td>Diagnosa Keperawatan</td>
                            <td>{{ $resume_perawat[0]->diagnosakeperawatan }}</td>
                        </tr>
                        <tr>
                            <td>Rencana Keperawatan/Kebidanan</td>
                            <td>{{ $resume_perawat[0]->rencanakeperawatan }}</td>
                        </tr>
                        <tr>
                            <td>Tindakan Keperawatan/Kebidanan</td>
                            <td>{{ $resume_perawat[0]->tindakankeperawatan }}</td>
                        </tr>
                        <tr>
                            <td>Evaluasi Keperawatan/Kebidanan</td>
                            <td>{{ $resume_perawat[0]->evaluasikeperawatan }}</td>
                        </tr>
                    </table>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <th>Tanggal assesmen</th>
                            <th>Nama Pemeriksa</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $resume_perawat[0]->tanggalassemen }}</td>
                                <td>
                                    <img src="" alt=""><br>
                                    <p class="text-center">{{ $resume_perawat[0]->namapemeriksa }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
<div class="modal fade" id="modalcatatankonsul" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Konsul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="jumbotron">
                    <h1 class="display-4">Hello {{ auth()->user()->nama }} </h1><br>
                    <p class="lead">Dokter Pengirim : {{ $kunjungan[0]->dokter_kirim }}</p>
                    <p class="lead">Poliklinik Pengirim : {{ $kunjungan[0]->poli_asal }}</p>
                    <p class="lead">Mohon Konsul</p>
                    <p class="lead">Pasien dengan : <br>RM {{ $kunjungan[0]->no_rm }} |
                        {{ $kunjungan[0]->nama_pasien }} | {{ $kunjungan[0]->diagx }} <br><br>
                        Keterangan <br>
                        @if (count($ref_resume) > 0)
                            {{ $ref_resume[0]->keterangan_tindak_lanjut }}@endif
                    </p>
                    <hr class="my-4">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
<div class="modal fade" id="modalscan_rm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="modalberkasluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<link rel="stylesheet" href="{{ asset('public/dist/css/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('public/dist/js/bootstrap-datepicker.js') }}"></script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());
    });

    function simpanhasil() {
        var canvas1 = document.getElementById("myCanvas1");
        var ctx1 = canvas1.getContext("2d");
        var img1 = document.getElementById("gambarnya1");
        ctx1.drawImage(img1, 10, 10);
        var dataUrl1 = canvas1.toDataURL();
        $('#gambarcoret').val(dataUrl1)
        gambar = $('#gambarcoret').val()
        var data1 = $('.form_pemeriksaan_1').serializeArray();
        var data2 = $('.form_pemeriksaan_2').serializeArray();
        var data3 = $('.form_pemeriksaan_3').serializeArray();
        var data4 = $('.form_pemeriksaan_4').serializeArray();
        var formorder_lab = $('.formorder_lab').serializeArray();
        var formtindakan_rad = $('.formtindakan_rad').serializeArray();
        var datatindakan = $('.formtindakan').serializeArray();
        var formobat_farmasi = $('.formobat_farmasi').serializeArray();
        var formobatfarmasi2 = $('.arrayobat').serializeArray();
        var datatindaklanjut = $('.formtindaklanjut').serializeArray();
        var formpemeriksaankhusus = $('.formpemeriksaankhusus').serializeArray();
        var formtelingakanan = $('.formtelingakanan').serializeArray();
        var formtelingakiri = $('.formtelingakiri').serializeArray();
        var formanjurantelinga = $('.formanjurantelinga').serializeArray();
        var formhidungkanan = $('.formhidungkanan').serializeArray();
        var formhidungkiri = $('.formhidungkiri').serializeArray();
        var formkesimpulanhidung = $('.formkesimpulanhidung').serializeArray();
        var simpantemplate = $('#simpantemplate:checked').val()
        var namaresep = $('#namaresep').val()
        var kodekunjungan = $('#kodekunjungan').val()
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
                datatindakan: JSON.stringify(datatindakan),
                datatindaklanjut: JSON.stringify(datatindaklanjut),
                formobat_farmasi: JSON.stringify(formobat_farmasi),
                formobatfarmasi2: JSON.stringify(formobatfarmasi2),
                formpemeriksaankhusus: JSON.stringify(formpemeriksaankhusus),
                simpantemplate,
                namaresep,
                kodekunjungan,
                gambar,
                formtelingakanan: JSON.stringify(formtelingakanan),
                formtelingakiri: JSON.stringify(formtelingakiri),
                formanjurantelinga: JSON.stringify(formanjurantelinga),
                formhidungkanan: JSON.stringify(formhidungkanan),
                formhidungkiri: JSON.stringify(formhidungkiri),
                formkesimpulanhidung: JSON.stringify(formkesimpulanhidung),
                formorder_lab: JSON.stringify(formorder_lab),
                formtindakan_rad: JSON.stringify(formtindakan_rad),
                hasilexpertisi
            },
            url: '<?= route('simpanpemeriksaandokter_2') ?>',
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
                    resume()
                }
            }
        });
    }
    $(".riwayatkonsul").click(function() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}"
            },
            url: '<?= route('riwayatkonsul') ?>',
            success: function(response) {
                $('.view_riwayat_konsul').html(response);
                spinner.hide()
            }
        });
    })

    $(".lihathasilpenunjang_lab").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_lab') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_lab').html(response);
                spinner.hide()
            }
        });
    })
    $(".lihathasilpenunjang_rad").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_rad') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_rad').html(response);
                spinner.hide()
            }
        });
    })
    $(".lihathasilpenunjang_pa").click(function() {
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
            success: function(response) {
                $('.v_hasil_penunjang_pa').html(response);
                spinner.hide()
            }
        });
    })
    $(".liatsumarilis").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('hasilsumarilis') ?>',
            success: function(response) {
                $('.v_sumarilis').html(response);
                spinner.hide()
            }
        });
    })

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
                '" name="aturanpakai" value=""></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
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
</script>
<script src="{{ asset('public/marker/markerjs2.js') }}"></script>
