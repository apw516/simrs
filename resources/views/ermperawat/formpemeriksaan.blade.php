<div class="card">
    <div class="card-header bg-info">Catatan Perkembangan Pasien Terintegrasi ( CPPT )</div>
    <div class="card-body">
        <form action="" class="formpemeriksaanperawat">
            <input hidden type="text" name="kodekunjungan" class="form-control"
                value="{{ $kunjungan[0]->kode_kunjungan }}">
            <input hidden type="text" name="counter" class="form-control" value="{{ $kunjungan[0]->counter }}">
            <input hidden type="text" name="unit" class="form-control" value="{{ $kunjungan[0]->kode_unit }}">
            <input hidden type="text" name="nomorrm" class="form-control" value="{{ $kunjungan[0]->no_rm }}">
            <input hidden type="text" name="usiahari" id="usiahari" class="form-control"
                value="{{ $usia_hari }}">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" style="background-color: rgba(110, 245, 137, 0.745)" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left text-lg text-bold text-dark" type="button"
                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <i class="bi bi-plus-lg text-bold mr-3"></i> ( S ) SUBJECTIVE
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
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
                                            <input class="form-check-input" type="radio" name="sumberdata"
                                                id="sumberdata" value="Pasien Sendiri" @if(count($p_konsul) > 0) @if($p_konsul[0]->sumberdataperiksa == 'Pasien Sendiri') checked @endif @endif>
                                            <label class="form-check-label" for="inlineRadio1">Pasien Sendiri /
                                                Autoanamase</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="sumberdata"
                                                id="sumberdata" value="Keluarga" @if(count($p_konsul) > 0) @if($p_konsul[0]->sumberdataperiksa == 'Keluarga') checked @endif @endif>
                                            <label class="form-check-label" for="inlineRadio2">Keluarga /
                                                Alloanamnesa</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold font-italic">Keluhan Utama</td>
                                    <td colspan="3">
                                        <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ...">@if(count($p_konsul) > 0) {{ $p_konsul[0]->keluhanutama }} @endif</textarea>
                                    </td>
                                </tr>
                            </table>
                            <table  @if($usia_hari < 30 || $usia_hari >= 1095) hidden @endif class="table text-md">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Assesmen Nyeri</th>
                                </thead>
                                <tbody>
                                    {{-- @elseif($usia_hari >= 30 || $usia_hari == 1095) --}}
                                    <tr>
                                        <td colspan="2" class="bg-secondary">Metode FLACC Scale ( Pasien 1 - 3
                                            tahun )</td>
                                    </tr>
                                    <tr>
                                        <td>Face</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Face"
                                                    id="Face" value="Tidak ada" checked>
                                                <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Face"
                                                    id="Face" value="Tidak ada ekspresi khusus , senyum">
                                                <label class="form-check-label" for="inlineRadio1">Tidak ada
                                                    ekspresi khusus , senyum</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="Face"
                                                    id="Face" value="Menyeringai,Mengerutkan dahi, tampak tidak tertarik ( kadang - kadang )">
                                                <label class="form-check-label" for="inlineRadio2">Menyeringai,Mengerutkan dahi, tampak tidak tertarik ( kadang - kadang )</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Face" id="Face" value="Dagu gemetar,gerutu,berulang ( sering )">
                                                <label class="form-check-label" for="inlineRadio2">Dagu
                                                    gemetar,gerutu,berulang ( sering )</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leg ( Posisi Kaki )</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Leg" id="Leg" value="Tidak ada" checked>
                                                <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Leg" id="Leg" value="Posisi normal atau santai">
                                                <label class="form-check-label" for="inlineRadio1">Posisi normal atau
                                                    santai</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Leg" id="Leg" value="Gelisah,tegang">
                                                <label class="form-check-label" for="inlineRadio2">Gelisah,
                                                    tegang</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Leg" id="Leg" value="Menendang, kaki tertekuk">
                                                <label class="form-check-label" for="inlineRadio2">Menendang, kaki
                                                    tertekuk</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Activity</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Activity" id="Activity" value="Tidak ada" checked>
                                                <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Activity" id="Activity" value="Berbaring tenang,posisi normal, gerakan mudah">
                                                <label class="form-check-label" for="inlineRadio1">Berbaring tenang,
                                                    posisi normal, gerakan mudah</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Activity" id="Activity" value="Menggeliat, tidak bisa diam, tegang">
                                                <label class="form-check-label" for="inlineRadio2">Menggeliat, tidak
                                                    bisa diam, tegang</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Activity" id="Activity" value="Kaku atau tegang">
                                                <label class="form-check-label" for="inlineRadio2">Kaku atau
                                                    tegang</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cry ( Menangis )</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Cry" id="Cry" value="Tidak ada" checked>
                                                <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Cry" id="Cry" value="Tidak menangis">
                                                <label class="form-check-label" for="inlineRadio1">Tidak
                                                    menangis</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Cry" id="Cry" value="Merintih, merengek,kadang - kadang mengeluh ">
                                                <label class="form-check-label" for="inlineRadio2">Merintih, merengek,
                                                    kadang - kadang mengeluh </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Cry" id="Cry" value="Terus menanis atau teriak">
                                                <label class="form-check-label" for="inlineRadio2">Terus menanis atau
                                                    teriak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Consolabity</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Consolabity" id="Consolabity" value="Tidak ada" checked>
                                                <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Consolabity" id="Consolabity" value="Rileks">
                                                <label class="form-check-label" for="inlineRadio1">Rileks</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Consolabity" id="Consolabity" value="Dapat ditenangkan dengan sentuhan pelukan, bujukan, dialihkan">
                                                <label class="form-check-label" for="inlineRadio2">Dapat ditenangkan
                                                    dengan sentuhan pelukan, bujukan, dialihkan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Consolabity" id="Consolabity" value="Sering mengeluh,sulit dibujuk">
                                                <label class="form-check-label" for="inlineRadio2">Sering mengeluh,
                                                    sulit dibujuk</label>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                            <table  @if($usia_hari < 1095) hidden @endif class="table text-md">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Assesmen Nyeri</th>
                                </thead>
                                <tbody>
                                    {{-- @if ($usia_hari > 1095) --}}
                                    <tr>
                                        <td class="text-bold font-italic">Pasien Mengeluh Nyeri </td>
                                        <td colspan="3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="pasienmengeluhnyeri" id="pasienmengeluhnyeri"
                                                    value="Tidak Ada" @if(count($p_konsul) > 0) @if($p_konsul[0]->Keluhannyeri == 'Tidak Ada') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="pasienmengeluhnyeri" id="pasienmengeluhnyeri"
                                                    value="Ada" @if(count($p_konsul) > 0) @if($p_konsul[0]->Keluhannyeri == 'Ada') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3">
                                            <textarea class="form-control" placeholder="Keterangan skala nyeri pasien ..." name="skalanyeripasien"
                                                id="skalanyeripasien">@if(count($p_konsul) > 0) {{ $p_konsul[0]->skalenyeripasien }} @endif</textarea>
                                            <img width="50%" src="{{ asset('public/img/skalanyeri.jpg') }}"
                                                alt="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table @if($usia_hari > 30) hidden @endif  class="table text-md">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Assesmen Nyeri</th>
                                </thead>
                                <tbody>
                                     <tr>
                                        <td colspan="2" class="bg-secondary">Metode NIPS ( Pasien bayi baru lahir
                                            -30 hari )</td>
                                    </tr>
                                    <tr>
                                        <td>Ekspresi wajah</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="ekspresiwajah" id="ekspresiwajah" value="Rileks" checked>
                                                <label class="form-check-label" for="inlineRadio1">Rileks</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="ekspresiwajah" id="ekspresiwajah" value="Meringis">
                                                <label class="form-check-label" for="inlineRadio2">Meringis</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Menangis</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Menangis" id="Menangis" value="Tidak menangis" checked>
                                                <label class="form-check-label" for="inlineRadio1">Tidak menangis</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Menangis" id="Menangis" value="Meringis">
                                                <label class="form-check-label" for="inlineRadio2">Meringis</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Menangis" id="Menangis" value="Menangis keras">
                                                <label class="form-check-label" for="inlineRadio2">Menangis keras</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pola nafas</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="polanafas" id="polanafas" value="Rileks" checked>
                                                <label class="form-check-label" for="inlineRadio1">Rileks</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="polanafas" id="polanafas" value="Perubahan pola nafas">
                                                <label class="form-check-label" for="inlineRadio2">Perubahan pola nafas</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lengan</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Lengan" id="Lengan" value="Rileks" checked>
                                                <label class="form-check-label" for="inlineRadio1">Rileks</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Lengan" id="Lengan" value="Fleksi">
                                                <label class="form-check-label" for="inlineRadio2">Fleksi</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kaki</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Kaki" id="Kaki" value="Rileks" checked>
                                                <label class="form-check-label" for="inlineRadio1">Rileks</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Kaki" id="Kaki" value="Fleksi">
                                                <label class="form-check-label" for="inlineRadio2">Fleksi</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keadaan terangsang</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Keadaan_terangsang" id="Keadaan_terangsang" value="-" checked>
                                                <label class="form-check-label" for="inlineRadio2">-</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Keadaan_terangsang" id="Keadaan_terangsang" value="Tidur">
                                                <label class="form-check-label" for="inlineRadio1">Tidur</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Keadaan_terangsang" id="Keadaan_terangsang" value="Bangun">
                                                <label class="form-check-label" for="inlineRadio2">Bangun</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="Keadaan_terangsang" id="Keadaan_terangsang" value="Rewel">
                                                <label class="form-check-label" for="inlineRadio2">Rewel</label>
                                            </div>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="background-color: rgba(110, 245, 137, 0.745)" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed text-lg text-bold text-dark"
                                type="button" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-plus-lg text-bold mr-3"></i> ( O ) OBJECTIVE
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionExample">
                        <div class="card-body">
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
                                                    name="tekanandarah" aria-describedby="basic-addon2" @if(count($p_konsul) > 0) value="{{ $p_konsul[0]->tekanandarah }}" @endif>
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
                                                    aria-describedby="basic-addon2" @if(count($p_konsul) > 0) value="{{ $p_konsul[0]->frekuensinadi }}" @endif>
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
                                                    aria-describedby="basic-addon2" @if(count($p_konsul) > 0) value="{{ $p_konsul[0]->frekuensinapas }}" @endif>
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
                                                    name="suhutubuh" id="suhutubuh" aria-describedby="basic-addon2" @if(count($p_konsul) > 0) value="{{ $p_konsul[0]->suhutubuh }}" @endif>
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
                                                    placeholder="Berat badan ..." name="beratbadan" id="beratbadan"
                                                    aria-label="Recipient's username" aria-describedby="basic-addon2" @if(count($p_konsul) > 0) value="{{ $p_konsul[0]->beratbadan }}" @endif>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Kg</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-bold font-italic">Umur</td>
                                        <td>
                                            <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Umur pasien ..."
                                                aria-label="Suhu tubuh pasien" name="usia" id="usia"
                                                aria-describedby="basic-addon2" value="{{ $usiatahun }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2"></span>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Psikologis</td>
                                        <td colspan="3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="riwayatpsikologis" id="riwayatpsikologis" value="Tidak Ada"
                                                    @if(count($p_konsul) > 0) @if($p_konsul[0]->Riwayatpsikologi == 'Tidak Ada') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="riwayatpsikologis" id="riwayatpsikologis" value="Cemas" @if(count($p_konsul) > 0) @if($p_konsul[0]->Riwayatpsikologi == 'Cemas') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Cemas</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="riwayatpsikologis" id="riwayatpsikologis" value="Takut" @if(count($p_konsul) > 0) @if($p_konsul[0]->Riwayatpsikologi == 'Takut') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Takut</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="riwayatpsikologis" id="riwayatpsikologis" value="Sedih" @if(count($p_konsul) > 0) @if($p_konsul[0]->Riwayatpsikologi == 'Sedih') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Sedih</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="riwayatpsikologis" id="riwayatpsikologis"
                                                    value="Lain - lain" @if(count($p_konsul) > 0) @if($p_konsul[0]->Riwayatpsikologi == 'Lain - lain') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Lain - lain</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3">
                                            <textarea class="form-control" id="keteranganriwayatpsikologislainnya" name="keteranganriwayatpsikologislainnya"
                                                placeholder="Keterangan riwayat psikologis lain ...">@if(count($p_konsul) > 0) {{ $p_konsul[0]->keterangan_riwayat_psikolog }}@endif</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table text-sm">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Status Fungsional</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold font-italic">Penggunaan Alat Bantu</td>
                                        <td colspan="3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="alatbantu"
                                                    id="alatbantu" value="Tidak Ada" @if(count($p_konsul) > 0) @if($p_konsul[0]->penggunaanalatbantu == 'Tidak Ada') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="alatbantu"
                                                    id="alatbantu" value="Tongkat" @if(count($p_konsul) > 0) @if($p_konsul[0]->penggunaanalatbantu == 'Tongkat') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Tongkat</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="alatbantu"
                                                    id="alatbantu" value="Kursi Roda" @if(count($p_konsul) > 0) @if($p_konsul[0]->penggunaanalatbantu == 'Kursi Roda') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Kursi Roda</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="alatbantu"
                                                    id="alatbantu" value="Lain - lain" @if(count($p_konsul) > 0) @if($p_konsul[0]->penggunaanalatbantu == 'Lain - lain') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Lain - lain</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3">
                                            <textarea class="form-control" name="keteranganalatbantulain" id="keteranganalatbantulain"
                                                placeholder="Keterangan alat bantu lainnya ...">@if(count($p_konsul) > 0) {{ $p_konsul[0]->keterangan_alat_bantu }}@endif</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Cacat Tubuh</td>
                                        <td colspan="3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cacattubuh"
                                                    id="cacattubuh" value="Tidak Ada" @if(count($p_konsul) > 0) @if($p_konsul[0]->cacattubuh == 'Tidak Ada') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="cacattubuh"
                                                    id="cacattubuh" value="Ada" @if(count($p_konsul) > 0) @if($p_konsul[0]->cacattubuh == 'Ada') checked @endif @endif>
                                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3">
                                            <textarea class="form-control" placeholder="Keterangan cacat tubuh lainnya ..." id="keterangancacattubuhlainnya"
                                                name="keterangancacattubuhlainnya">@if(count($p_konsul) > 0) {{ $p_konsul[0]->keterangancacattubuh }}@endif</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                <table @if($usia_hari < 4383) hidden @endif class="table">
                                    <thead>
                                        <th colspan="4" class="text-center bg-warning">Assesmen Resiko Jatuh</th>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-secondary">
                                            <td colspan="4" class="text-center text-bold font-italic">Metode Up and
                                                Go
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Faktor Resiko</td>
                                            <td>Skala</td>
                                        </tr>
                                        <tr>
                                            <td>a</td>
                                            <td>Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien
                                                tampak tidak seimbang
                                                (
                                                sempoyongan / limbung ) ?</td>
                                        </tr>
                                        <tr>
                                            <td>b</td>
                                            <td>Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai
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
                                                        id="resikojatuh" value="Tidak Beresiko" checked>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Beresiko
                                                        (
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
                                                        id="resikojatuh" value="Risiko Rendah">
                                                    <label class="form-check-label" for="inlineRadio1"> Risiko rendah
                                                        (
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
                                                        id="resikojatuh" value="Risiko Tinggi">
                                                    <label class="form-check-label" for="inlineRadio1"> Risiko tinggi
                                                        ( a
                                                        dan b ditemukan
                                                        )
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table @if($usia_hari < 4383) hidden @endif  class="table">
                                    <thead>
                                        <th colspan="4" class="text-center bg-warning">Skrinning Gizi</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center text-bold font-italic bg-secondary">
                                                Metode Malnutrition
                                                Screnning Tools ( Pasien Dewasa )</td>
                                        </tr>
                                        <tr class="bg-light text-bold font-italic">
                                            <td colspan="3">1. Apakah pasien mengalami penurunan berat badan yang
                                                tidak
                                                diinginkan dalam
                                                6
                                                bulan terakhir ?
                                            </td>
                                            <td>Skor</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="penurunanbb"
                                                        id="penurunanbb" value="Tidak ada penurunan" checked>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak ada
                                                        penurunan
                                                        berat badan
                                                    </label>
                                                </div>
                                            </td>
                                            <td rowspan="3">
                                                <textarea class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="penurunanbb"
                                                        id="penurunanbb" value="Tidak yakin ada penurunan">
                                                    <label class="form-check-label" for="inlineRadio1">Tidak yakin /
                                                        tidak
                                                        tahu / terasa
                                                        baju lebih longgar
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="penurunanbb"
                                                        id="penurunanbb" value="Ya, ada penurunan">
                                                    <label class="form-check-label" for="inlineRadio1">Jika YA ,
                                                        berapa
                                                        berat badan
                                                        tersebut
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="beratpenurunan" id="beratpenurunan" value="Tidak"
                                                        checked>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak</label>
                                                    <input class="form-check-input ml-2" type="radio"
                                                        name="beratpenurunan" id="beratpenurunan" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">1 - 5
                                                        Kg</label>
                                                    <input class="form-check-input  ml-2" type="radio"
                                                        name="beratpenurunan" id="beratpenurunan" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">6 - 10
                                                        Kg</label>
                                                    <input class="form-check-input  ml-2" type="radio"
                                                        name="beratpenurunan" id="beratpenurunan" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">11 - 15
                                                        Kg</label>
                                                    <input class="form-check-input  ml-2" type="radio"
                                                        name="beratpenurunan" id="beratpenurunan" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">> 15 Kg</label>
                                                    <input class="form-check-input  ml-2" type="radio"
                                                        name="beratpenurunan" id="beratpenurunan" value="option1">
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Yakin
                                                        Penurunannya</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-light text-bold font-italic">
                                            <td colspan="4">2. Apakah asupan makanan berkurang karena berkurangnya
                                                nafsu
                                                makan</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="asupanmakanan" id="asupanmakanan" value="Tidak Ada"
                                                        checked>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada
                                                    </label>
                                                </div>
                                            </td>
                                            <td rowspan="2">
                                                <textarea class="form-control"></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="asupanmakanan" id="asupanmakanan" value="Ada">
                                                    <label class="form-check-label" for="inlineRadio1"> Ada
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="bg-light text-bold font-italic">
                                            <td colspan="3">Total Skor</td>
                                            <td><input class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table @if($usia_hari >= 4383) hidden @endif class="table">
                                    <tr>
                                        <td colspan="2" class="bg-secondary">Assesmen Resiko Jatuh</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-light">Metode Humpty Dumpty</td>
                                    </tr>
                                    <tr>
                                        <td>Umur</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="umur"
                                                    id="umur" value="Dibawah 3 tahun">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Dibawah 3 tahun
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="umur"
                                                    id="umur" value="3 - 7 tahun">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    3 - 7 tahun
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="umur"
                                                    id="umur" value="7 - 13 tahun">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    7 - 13 tahun
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="umur"
                                                    id="umur" value="Lebih dari 13 tahun">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Lebih dari 13 tahun
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="umur"
                                                    id="umur" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jeniskelamin"
                                                    id="jeniskelamin" value="Laki - Laki">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Laki - Laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jeniskelamin"
                                                    id="jeniskelamin" value="Perempuan">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Perempuan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jeniskelamin"
                                                    id="jeniskelamin" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diagnosis"
                                                    id="diagnosis" value="Gangguan neurologis">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Gangguan neurologis
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diagnosis"
                                                    id="diagnosis" value="Perubahan dalam oksigenasi ( masalah saluran napas,dehidrasi,anemia,anorexia,sinkop,sakit kepala,dll )">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Perubahan dalam oksigenasi ( masalah saluran
                                                    napas,dehidrasi,anemia,anorexia,sinkop,sakit kepala,dll )
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diagnosis"
                                                    id="diagnosis" value="Kelainan psikis / perilaku">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Kelainan psikis / perilaku
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diagnosis"
                                                    id="diagnosis" value="Diagnosis lainnya">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Diagnosis lainnya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="diagnosis"
                                                    id="diagnosis" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gangguan Kognitif</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                                    id="Gangguan_Kognitif" value="Tidak menyadari keterbatasan diri">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Tidak menyadari keterbatasan diri
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                                    id="Gangguan_Kognitif" value="Lupa adanya keterbatasan">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Lupa adanya keterbatasan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                                    id="Gangguan_Kognitif" value="Orientasi baik terhadap diri sendiri">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Orientasi baik terhadap diri sendiri
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Gangguan_Kognitif"
                                                    id="Gangguan_Kognitif" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Faktor Lingkungan</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                                    id="Faktor_Lingkungan" value="Riwayat jatuh dari tempat tidur saat bayi / anak">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Riwayat jatuh dari tempat tidur saat bayi / anak
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                                    id="Faktor_Lingkungan" value="Pasien menggunakan alat bantu atau box mebel">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Pasien menggunakan alat bantu atau box mebel
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                                    id="Faktor_Lingkungan" value="Pasien diletakan ditempat tidur">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Pasien diletakan ditempat tidur
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                                    id="Faktor_Lingkungan" value="Diluar ruang rawat">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Diluar ruang rawat
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Faktor_Lingkungan"
                                                    id="Faktor_Lingkungan" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Respon terhadap operasi / obat penenang / efek anestersi</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="respon_thd_op"
                                                    id="respon_thd_op" value="Dalam 24 Jam">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Dalam 24 Jam
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="respon_thd_op"
                                                    id="respon_thd_op" value="Dalam 48 jam">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Dalam 48 jam
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="respon_thd_op"
                                                    id="respon_thd_op" value="> 48 Jam">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    > 48 Jam
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="respon_thd_op"
                                                    id="respon_thd_op" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penggunaan Obat</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Penggunaan_Obat"
                                                    id="Penggunaan_Obat" value="Bermacam obat yang digunakan : obat sedative ( Kecuali pasien icu,yang menggunakan sedasi dan paralisis ),hipnotik,barbiturate,fenotiazen, antidepresan,laksatif/diuretik,narkotik.">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Bermacam obat yang digunakan : obat sedative ( Kecuali pasien icu,
                                                    yang menggunakan sedasi dan paralisis ),hipnotik,barbiturate,
                                                    fenotiazen, antidepresan,laksatif/diuretik,narkotik.
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Penggunaan_Obat"
                                                    id="Penggunaan_Obat" value="Penggunaan salah satu obat diatas">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Penggunaan salah satu obat diatas
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Penggunaan_Obat"
                                                    id="Penggunaan_Obat" value="penggunaan obat lainnya">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    penggunaan obat lainnya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="Penggunaan_Obat"
                                                    id="Penggunaan_Obat" value="-" checked>
                                                <label class="form-check-label" for="exampleRadios3">
                                                    -
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table @if($usia_hari >= 4383) hidden @endif class="table">
                                    <tr>
                                        <td colspan="2" class="bg-secondary">Skrining Gizi</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="bg-light">Metode Strong Kids ( Pasien anak - anak )
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah Pasien tampak kurus ? </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="anaktampakkurus" id="anaktampakkurus" value="Ya">
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="anaktampakkurus" id="anaktampakkurus" value="Tidak" checked>
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah ada penurunan BB Selama satu bulan terkahir ( berdasarakan penilaian
                                            objektif data BB bila ada / penilaian subjektif dari orang tua pasien atau
                                            unutuk bayi kurang dari 1 tahun : BB Naik selama 3 bulan terakhir) </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="adapenurunanbbanak" id="adapenurunanbbanak" value="Ya">
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="adapenurunanbbanak" id="adapenurunanbbanak" value="Tidak" checked>
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
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="anakadadiare" id="anakadadiare" value="Ya">
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="anakadadiare" id="anakadadiare" value="Tidak" checked>
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apakah terdapat penyakit atau keadaan umum yang mengakibatkan pasien
                                            beresiko mengalami malnutrisi</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="faktormalnutrisianak" id="faktormalnutrisianak" value="Ya">
                                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="faktormalnutrisianak" id="faktormalnutrisianak" value="Tidak" checked>
                                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            <table class="table">
                                <tr>
                                    <td class="bg-light text-bold font-italic" colspan="4">3. Pasien dengan
                                        diagnosa khusus :
                                        Penyakit DM / Ginjal / Hati / Paru / Stroke /
                                        Kanker / Penurunan
                                        imunitas geriatri, lain lain...</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="diagnosakhusus"
                                                id="diagnosakhusus" value="Tidak Ada" checked>
                                            <label class="form-check-label" for="inlineRadio1">Tidak Ada
                                            </label>
                                            <input class="form-check-input ml-2" type="radio" name="diagnosakhusus"
                                                id="diagnosakhusus" value="Tidak Ada">
                                            <label class="form-check-label" for="inlineRadio1"> Ada
                                            </label>
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control"
                                            placeholder="Keterangan diagnosa lain ..." name="keterangandiagnosalain">
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td class="bg-light text-bold font-italic" colspan="4">4. Bila skor >= 2,
                                        pasien beresiko
                                        malnutrisi dilakukan pengkajian lanjut oleh ahli gizi</td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="kajianlanjutgizi"
                                                id="kajianlanjutgizi" value="Tidak Ada" checked>
                                            <label class="form-check-label" for="inlineRadio1">Tidak Ada
                                            </label>
                                            <input class="form-check-input ml-2" type="radio"
                                                name="kajianlanjutgizi" id="kajianlanjutgizi" value="Ada">
                                            <label class="form-check-label" for="inlineRadio1">Ada
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control" name="tglpengkajianlanjut"
                                            id="tglpengkajianlanjut"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="background-color: rgba(110, 245, 137, 0.745)"
                        id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed text-lg text-bold text-dark"
                                type="button" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-plus-lg text-bold mr-3"></i> ( A ) ASSESMENT
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Diagnosa Keperawatan/Kebidanan
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea class="form-control" placeholder="Masukan diagnosa keperawatan ..." name="diagnosakeperawatan"
                                            id="diagnosakeperawatan">@if(count($p_konsul) > 0) {{ $p_konsul[0]->diagnosakeperawatan }}@endif</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" style="background-color: rgba(110, 245, 137, 0.745)"
                        id="headingFour">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed text-lg text-bold text-dark"
                                type="button" data-toggle="collapse" data-target="#collapseFour"
                                aria-expanded="false" aria-controls="collapseFour">
                                <i class="bi bi-plus-lg text-bold mr-3"></i> ( P ) PLANNING
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Rencana Keperawatan/Kebidanan
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea class="form-control" placeholder="Masukan rencana keperawatan" id="rencanakeperawatan"
                                            name="rencanakeperawatan">@if(count($p_konsul) > 0) {{ $p_konsul[0]->rencanakeperawatan }}@endif</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Tindakan Keperawatan/Kebidanan
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea class="form-control" placeholder="Masukan tindakan keperawatan" id="tindakankeperawatan"
                                            name="tindakankeperawatan">@if(count($p_konsul) > 0) {{ $p_konsul[0]->tindakankeperawatan }}@endif</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Evaluasi Keperawatan/Kebidanan
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea class="form-control" placeholder="Masukan evaluasi keperawatan" name="evaluasikeperawatan"
                                            id="evaluasikeperawatan">@if(count($p_konsul) > 0) {{ $p_konsul[0]->evaluasikeperawatan }}@endif</textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-danger float-right ml-2" onclick="batalisi()">Batal</button>
            <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
        </form>
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
        spinner = $('#loader')
        spinner.show();
        var data = $('.formpemeriksaanperawat').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpemeriksaanperawat') ?>',
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

    function batalisi() {
        rm = $('#nomorrm').val()
        formcatatanmedis(rm)
    }
</script>
