<div class="container-fluid">
    <div class="card mt-2">
        <div class="card-header bg-info">CPPT</div>
        <div class="card-body">
            <form action="" class="formpemeriksaanperawat">
                <input hidden type="text" name="idantrian" name="idantrian" class="form-control" value="{{ $id_antrian }}">
                <table class="table">
                    <tr hidden>
                        <td class="text-bold font-italic">Tanggal Kunjungan</td>
                        <td><input readonly type="text" name="tanggalkunjungan" class="form-control"
                                value="{{ $data_antrian[0]->tgl_masuk }}"></td>
                        <td class="text-bold font-italic">Tanggal Assesmen</td>
                        <td><input type="text" name="tanggalassesmen" class="form-control datepicker"
                                data-date-format="yyyy-mm-dd"></td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Nama Pasien</td>
                        <td colspan="3"><input type="text" class="form-control" name="namapasien" id="namapasien" value="{{ $resume[0]->nama_pasien }}"></td>
                    </tr>
                    <tr>
                        @php $as = explode('|',$resume[0]->asalmasuk ) @endphp
                        <td class="text-bold font-italic">Sumber Data</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                    value="Pasien Sendiri" @if($resume[0]->sumberdataperiksa == 'Pasien Sendiri') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                    value="Keluarga" @if($resume[0]->sumberdataperiksa == 'Keluarga') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-control" name="namakeluarga" id="namakeluarga"
                                    placeholder="Nama Keluarga ..." value="{{ $as[2]}}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Asal Masuk</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asalmasuk" id="asalmasuk"
                                    value="Non Rujukan" @if($as[0] == 'Non Rujukan ') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Non Rujukan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asalmasuk" id="asalmasuk"
                                    value="Rujukan" @if($as[0] == 'Rujukan ') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Rujukan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <textarea class="form-control" name="keteranganasalmasuk" id="keteranganasalmasuk" placeholder="Keterangan ...">{{ $as[1]}}</textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Cara Masuk</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="caramasuk" id="caramasuk"
                                    value="Jalan Kaki" @if($resume[0]->caramasuk == 'Jalan Kaki') checked @endif>
                                <label class="form-check-label" for="inlineRadio1">Jalan Kaki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="caramasuk" id="caramasuk"
                                    value="Kursi Roda" @if($resume[0]->caramasuk == 'Kursi Roda') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Kursi Roda</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="caramasuk" id="caramasuk"
                                    value="Brankar" @if($resume[0]->caramasuk == 'Brankar') checked @endif>
                                <label class="form-check-label" for="inlineRadio2">Brankar</label>
                            </div>
                        </td>
                    </tr>
                </table>
                @php $dg = explode('|',$resume[0]->diagnosakeperawatan ) @endphp
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header bg-warning" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left" type="button" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    SUBYEKTIF ANAMNESIS
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <textarea class="form-control" id="subyektifanamnesis" name="subyektifanamnesis" placeholder="ketik subyektif anamnesis ...">{{ $dg[1] }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-warning" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    OBYEKTIF
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table text-sm">
                                    <tbody>
                                        <tr>
                                            <td class="text-bold font-italic">Tekanan Darah</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Tekanan darah pasien ..."
                                                        aria-label="Recipient's username" id="tekanandarah"
                                                        name="tekanandarah" aria-describedby="basic-addon2" value="{{ $resume[0]->tekanandarah }}">
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
                                                        aria-describedby="basic-addon2" value="{{ $resume[0]->frekuensinadi }}">
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
                                                        aria-describedby="basic-addon2" value="{{ $resume[0]->frekuensinapas }}">
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
                                                        name="suhutubuh" id="suhutubuh" aria-describedby="basic-addon2" value="{{ $resume[0]->suhutubuh }}">
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
                                                        placeholder="Berat Badan Pasien ..." name="beratbadan"
                                                        id="beratbadan" aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2" value="{{ $resume[0]->beratbadan }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">x/menit</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-bold font-italic">Tinggi Badan</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Tinggi badan pasien ..." aria-label="Suhu tubuh pasien"
                                                        name="tinggibadan" id="tinggibadan" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">°C</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Keadaan Umum</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="keadaanumum" id="keadaanumum" value="Baik"
                                                        checked>
                                                    <label class="form-check-label" for="inlineRadio1">Baik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="keadaanumum" id="keadaanumum" value="Sedang">
                                                    <label class="form-check-label" for="inlineRadio2">Sedang</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="keadaanumum" id="keadaanumum" value="Buruk">
                                                    <label class="form-check-label" for="inlineRadio2">Buruk</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Kesadaran ( GCS )</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kesadaran" id="kesadaran" value="13 -15"
                                                        checked>
                                                    <label class="form-check-label" for="inlineRadio1">13 -15</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kesadaran" id="kesadaran" value="9 - 12">
                                                    <label class="form-check-label" for="inlineRadio2">9 - 12</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kesadaran" id="kesadaran" value="3 - 8">
                                                    <label class="form-check-label" for="inlineRadio2">3 - 8</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-warning" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    PEMERIKSAAN FISIK
                                </button>
                            </h2>
                        </div>
                        @php $nt = explode('|',$resume[0]->Riwayatpsikologi ) @endphp
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table text-sm">
                                    <tbody>
                                        <tr>
                                            <td class="text-bold font-italic">Tekanan Intrakranial</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Tidak Ada" @if($nt[2] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Sakit Kepala" @if($nt[2] == ' Sakit Kepala ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Sakit
                                                        Kepala</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Muntah" @if($nt[2] == ' Muntah ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Muntah</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Pusing" @if($nt[2] == ' Pusing ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Pusing</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Bingung" @if($nt[2] == ' Bingung ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Bingung</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Hypertensi" @if($nt[2] == ' Hypertensi ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Hypertensi</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="tekananintrakranial"
                                                        id="tekananintrakranial" value="Hipotensi" @if($nt[2] == ' Hipotensi ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Hipotensi</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Pupil</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pupil"
                                                        id="pupil" value="Normal" @if($nt[3] == ' Normal ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Normal</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pupil"
                                                        id="pupil" value="Miosis" @if($nt[3] == ' Miosis ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Miosis</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pupil"
                                                        id="pupil" value="Midriasis" @if($nt[3] == ' Midriasis ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Midriasis</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pupil"
                                                        id="pupil" value="Isokor" @if($nt[3] == ' Isokor ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Isokor</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="pupil"
                                                        id="pupil" value="Anisokor" @if($nt[3] == ' Anisokor ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Anisokor</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Neuro Sensorik / Muskulo Skeletal</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="Tidak Ada" @if($nt[4] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="spasme otot" @if($nt[4] == ' spasme otot ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Spasme Otot</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="perubahan sensorik" @if($nt[4] == ' perubahan sensorik ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Perubahan
                                                        Sensorik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="perubahan motorik" @if($nt[4] == ' perubahan motorik ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Perubahan
                                                        Motorik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="kerusakan jaringan / luka" @if($nt[4] == ' kerusakan jaringan / luka ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Kerusakan Jaringan
                                                        / Luka</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="perubahan bentuk ekstermitas" @if($nt[4] == ' perubahan bentuk ekstermitas ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Perubahan bentuk
                                                        ekstermitas</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="penurunan tingkat kesadaran" @if($nt[4] == ' penurunan tingkat kesadaran ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Penurunan tingkat
                                                        kesadaran</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="neurosensorik"
                                                        id="neurosensorik" value="fraktur / dislokasi / luksasio" @if($nt[4] == ' fraktur / dislokasi / luksasio ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Fraktur / Dislokasi
                                                        / Luksasio
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Integumen</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="integumen"
                                                        id="integumen" value="Tidak Ada" @if($nt[5] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="integumen"
                                                        id="integumen" value="luka bakar" @if($nt[5] == ' luka bakar ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Luka Bakar</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="integumen"
                                                        id="integumen" value="luka robek" @if($nt[5] == ' luka robek ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Luka Robek</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="integumen"
                                                        id="integumen" value="lecet" @if($nt[5] == ' lecet ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Lecet</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="integumen"
                                                        id="integumen" value="luka dekubitus" @if($nt[5] == ' luka dekubitus ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Luka
                                                        dekubitus</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="integumen"
                                                        id="integumen" value="luka gangren" @if($nt[5] == ' luka gangren ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Luka
                                                        gangren</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Turgor Kulit</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="turgorkulit"
                                                        id="turgorkulit" value="baik" @if($nt[6] == ' baik ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Baik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="turgorkulit"
                                                        id="turgorkulit" value="menurun" @if($nt[6] == ' menurun ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Menurun</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Edema</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="edema"
                                                        id="edema" value="Tidak Ada" @if($nt[7] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="edema"
                                                        id="edema" value="ekstremitas" @if($nt[7] == ' ekstremitas ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Ekstremitas</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="edema"
                                                        id="edema" value="seluruh tubuh" @if($nt[7] == ' seluruh tubuh ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seluruh
                                                        tubuh</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="edema"
                                                        id="edema" value="ascites" @if($nt[7] == ' ascites ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Ascites</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="edema"
                                                        id="edema" value="palpebra" @if($nt[7] == ' palpebra ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Palpebra</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Mukosa Mulut</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mukosamulut"
                                                        id="mukosamulut" value="Tidak Ada" @if($nt[8] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mukosamulut"
                                                        id="mukosamulut" value="Kering" @if($nt[8] == ' Kering ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Kering</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mukosamulut"
                                                        id="mukosamulut" value="Lembab" @if($nt[8] == ' Lembab ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Lembab</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mukosamulut"
                                                        id="mukosamulut" value="Ascites" @if($nt[8] == ' Ascites ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Ascites</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="mukosamulut"
                                                        id="mukosamulut" value="palpebra" @if($nt[8] == ' palpebra ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Palpebra</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Perdarahan</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineRadio1">Jumlah</label>
                                                    <input class="form-control" name="jumlah_perdarahan" id="jumlah_perdarahan" value="{{ $nt[9] }}">
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineRadio2">Warna</label>
                                                    <input class="form-control" name="warna_perdarahan" id="warna_perdarahan" value="{{ $nt[10] }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Intoksikasi</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="intoksikasi"
                                                        id="intoksikasi" value="Tidak Ada" @if($nt[11] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="intoksikasi"
                                                        id="intoksikasi" value="makanan" @if($nt[11] == ' makanan ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Makanan</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="intoksikasi"
                                                        id="intoksikasi" value="gigitan" @if($nt[11] == ' gigitan ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Gigitan
                                                        Binatang</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="intoksikasi"
                                                        id="intoksikasi" value="zat kimia" @if($nt[11] == ' zat kimia ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Zat Kimia</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="intoksikasi"
                                                        id="intoksikasi" value="gas" @if($nt[11] == ' gas ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Gas</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="intoksikasi"
                                                        id="intoksikasi" value="obat" @if($nt[11] == ' obat ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Obat</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" class="text-bold font-italic">Eliminasi</td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineRadio1">BAB</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Frekuensi BAB ..." name="frekuensibab"
                                                            id="frekuensibab" aria-label="Recipient's username"
                                                            aria-describedby="basic-addon2" value="{{ $nt[12] }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">x</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label mr-1"
                                                        for="inlineRadio2">Konsistensi</label>
                                                    <input class="form-control" name="konsistensibab" id="konsistensibab" value="{{ $nt[13] }}">
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label mr-1" for="inlineRadio2">Warna</label>
                                                    <input class="form-control" name="warnabab" id="warnabab" value="{{ $nt[14] }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineRadio1">BAK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"
                                                            placeholder="Frekuensi BAK ..." name="frekuensibak"
                                                            id="frekuensibak" aria-label="Recipient's username"
                                                            aria-describedby="basic-addon2" value="{{ $nt[15] }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">x</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label mr-1"
                                                        for="inlineRadio2">Konsistensi</label>
                                                    <input class="form-control" name="konsistensibak" id="konsistensibak" value="{{ $nt[16] }}">
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label mr-1" for="inlineRadio2">Warna</label>
                                                    <input class="form-control" name="warnabak" id="warnabak" value="{{ $nt[17] }}">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-warning" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    PSIKOSIAL, EKONOMI, DAN SPIRITUAL
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table text-sm">
                                    <tbody>
                                        <tr>
                                            <td class="text-bold font-italic">Kecemasan</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kecemasan" id="kecemasan"
                                                        value="Tidak Ada" @if($nt[18] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kecemasan" id="kecemasan"
                                                        value="sedang" @if($nt[18] == ' sedang ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Sedang</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kecemasan" id="kecemasan"
                                                        value="berat" @if($nt[18] == ' berat ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Berat</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="kecemasan" id="kecemasan"
                                                        value="panik" @if($nt[18] == ' panik ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Panik</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">.Mekanisme</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="mekanisme" id="mekanisme"
                                                        value="Tidak Ada" @if($nt[19] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="mekanisme" id="mekanisme"
                                                        value="merusak diri" @if($nt[19] == ' merusak diri ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Merusak
                                                        diri</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="mekanisme" id="mekanisme"
                                                        value="menarik diri" @if($nt[19] == ' menarik diri ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Menarik diri /
                                                        isolasi
                                                        sosial</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="mekanisme" id="mekanisme"
                                                        value="perilaku kekerasan" @if($nt[19] == ' perilaku kekerasan ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Perilaku
                                                        kekerasan</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @php $n = explode('|',$resume[0]->skalenyeripasien ) @endphp
                    <div class="card">
                        <div class="card-header bg-warning" id="headingFive">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    SKRINING NYERI
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="text-bold font-italic">Ada Keluhan nyeri ?</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="adakeluhannyeri" id="adakeluhannyeri"
                                                        value="Tidak Ada" @if($resume[0]->Keluhannyeri == 'Tidak Ada') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="adakeluhannyeri" id="adakeluhannyeri"
                                                        value="Ada" @if($resume[0]->Keluhannyeri == 'Ada') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Ada</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic"></td>
                                            <td colspan="3">
                                                <textarea class="form-control" placeholder="Keterangan skala nyeri pasien ..." name="skalanyeripasien"
                                                    id="skalanyeripasien">{{ $n[0] }}</textarea>
                                                <img width="50%" src="{{ asset('public/img/skalanyeri.png') }}"
                                                    alt="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Apakah nyerinya berpindah dari satu tempat ke
                                                tempat lain ?
                                            </td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="nyeriberipindah" id="nyeriberipindah"
                                                        value="Tidak" @if($n[1] == ' Tidak ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">Tidak</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="nyeriberipindah" id="nyeriberipindah"
                                                        value="Ada" @if($n[1] == ' Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Ya</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Berapa lama nyeri ini ?</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="lamanyeri" id="lamanyeri"
                                                        value="Tidak"  @if($n[2] == ' Tidak ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Tidak</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="lamanyeri" id="lamanyeri"
                                                        value="< 3 bulan=akut"  @if($n[2] == ' < 3 bulan=akut ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        < 3 bulan=akut</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="lamanyeri" id="lamanyeri"
                                                        value="> 3 bulan = kronik"  @if($n[2] == ' > 3 bulan = kronik ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2"> > 3 bulan =
                                                        kronik</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Rasa nyeri</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="Tidak Ada" @if($n[3] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Tidak Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="Tajam" @if($n[3] == ' Tajam ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Tajam</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="Nyeri tumpul" @if($n[3] == ' Nyeri tumpul ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Nyeri tumpul
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti ditarik" @if($n[3] == ' seperti ditarik ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seperti
                                                        ditarik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti ditusuk" @if($n[3] == ' seperti ditusuk ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Seperti ditusuk</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti dipukul" @if($n[3] == ' seperti dipukul ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seperti
                                                        dipukul</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti dibakar" @if($n[3] == ' seperti dibakar ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seperti
                                                        dibakar</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti berdenyut" @if($n[3] == ' seperti berdenyut ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seperti
                                                        berdenyut</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti ditikam" @if($n[3] == ' seperti ditikam ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seperti
                                                        ditikam</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="rasanyeri" id="rasanyeri"
                                                        value="seperti kram" @if($n[3] == ' seperti kram ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Seperti
                                                        kram</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" class="text-bold font-italic">Seberapa sering anda
                                                mengalami nyeri ini ?
                                                berapa lama ?</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Setiap</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="seberapaseringnyeri" id="seberapaseringnyeri"
                                                        value="1 - 2 jam"  @if($n[4] == ' 1 - 2 jam ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        1 - 2 jam</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="seberapaseringnyeri" id="seberapaseringnyeri"
                                                        value="3 -4 jam" @if($n[4] == ' 3 -4 jam ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">3 -4 jam</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="seberapaseringnyeri" id="seberapaseringnyeri"
                                                        value="Tidak Ada" @if($n[4] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Tidak Ada</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        selama</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="durasinyeri" id="durasinyeri"
                                                        value="< 30 menit"  @if($n[5] == ' < 30 menit ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        < 30 menit </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="durasinyeri" id="durasinyeri"
                                                        value="> 30 menit"  @if($n[5] == ' > 30 menit ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2"> > 30 menit</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="durasinyeri" id="durasinyeri"
                                                        value="Tidak Ada"  @if($n[5] == ' Tidak Ada ') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio2">Tidak Ada</label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold font-italic">Apa yang membuat nyeri berkurang atau
                                                bertambah parah ?</td>
                                            <td colspan="3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="peredanyeri" id="peredanyeri"
                                                        value="kompres hangat / dingin" @if($n[6] == ' kompres hangat / dingin') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Kompres hangat / dingin</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="peredanyeri" id="peredanyeri"
                                                        value="aktivitas dikurangi / bertambah" @if($n[6] == ' aktivitas dikurangi / bertambah') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Aktivitas dikurangi / bertambah </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="peredanyeri" id="peredanyeri"
                                                        value="Tidak" @if($n[6] == ' Tidak') checked @endif>
                                                    <label class="form-check-label" for="inlineRadio1">
                                                        Tidak</label>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="text-bold font-italic">Lokasi Nyeri</td>
                                            <td colspan="3">
                                                <div class="gambarnyeri">

                                                </div>
                                            </td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @php $jth = explode('|',$resume[0]->keterangan_riwayat_psikolog ) @endphp
                    <div class="card">
                        <div class="card-header bg-warning" id="headingSix">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    PENILAIAN RISIKO JATUH
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-danger">PASIEN DEWASA MENGGUNAKAN SKALA MORSE FALLS SCALE
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-sm  table-bordered table-striped">
                                                    <thead>
                                                        <th>Faktor risiko</th>
                                                        <th>Skala</th>
                                                        <th>Poin</th>
                                                        <th>Skor</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="2">Riwayat Jatuh</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="riwayat_jatuh_dewasa"
                                                                        id="riwayat_jatuh_dewasa" value="Ya"
                                                                        @if($jth[0] == 'Ya ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>25</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="riwayat_jatuh_dewasa"
                                                                        id="riwayat_jatuh_dewasa" value="Tidak"
                                                                        @if($jth[0] == 'Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Diagnosis sekunder ( >= 2 diagnosis medis )
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosissekunder_dewasa"
                                                                        id="diagnosissekunder_dewasa" value="Ya"
                                                                        @if($jth[1] == ' Ya ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>15</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosissekunder_dewasa"
                                                                        id="diagnosissekunder_dewasa" value="Tidak"
                                                                        @if($jth[1] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Alat bantu</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="alatbantu_dewasa"
                                                                        id="alatbantu_dewasa" value="berpegangan pada perabot"
                                                                        @if($jth[2] == ' berpegangan pada perabot ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Berpegangan pada perabot</label>
                                                                </div>
                                                            </td>
                                                            <td>30</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="alatbantu_dewasa"
                                                                        id="alatbantu_dewasa" value="Tidak"
                                                                        @if($jth[2] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Terpasang infus</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="terpasanginfus_dewasa"
                                                                        id="terpasanginfus_dewasa" value="Ya"
                                                                        @if($jth[3] == ' Ya ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>20</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="terpasanginfus_dewasa"
                                                                        id="terpasanginfus_dewasa" value="Tidak"
                                                                        @if($jth[3] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="3">Gaya berjalan</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gayaberjalan_dewasa"
                                                                        id="gayaberjalan_dewasa" value="Terganggu"
                                                                        @if($jth[4] == ' Terganggu ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Terganggu</label>
                                                                </div>
                                                            </td>
                                                            <td>20</td>
                                                            <td rowspan="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gayaberjalan_dewasa"
                                                                        id="gayaberjalan_dewasa" value="Lemah"
                                                                        @if($jth[4] == ' Lemah ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Lemah</label>
                                                                </div>
                                                            </td>
                                                            <td>10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gayaberjalan_dewasa"
                                                                        id="gayaberjalan_dewasa" value="Normal / Tirah baring / imobilisasi"
                                                                        @if($jth[4] == ' Normal / Tirah baring / imobilisasi ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Normal / Tirah baring / imobilisasi</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Status Mental</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="statusmental"
                                                                        id="statusmental" value="Sering Lupa akan keterbatasan yang dimiliki"
                                                                        @if($jth[5] == ' Sering Lupa akan keterbatasan yang dimiliki') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Sering Lupa akan keterbatasan yang dimiliki</label>
                                                                </div>
                                                            </td>
                                                            <td>15</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="statusmental"
                                                                        id="statusmental" value="Sadar akan kemampuan diri sendiri"
                                                                        @if($jth[5] == ' Sadar akan kemampuan diri sendiri') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Sadar akan kemampuan diri sendiri</label>
                                                                </div>
                                                            </td>
                                                            <td>10</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-danger">PASIEN ANAK MENGGUNAKAN SKALA HUMPTY DUMPTY</div>
                                            <div class="card-body">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <th>Faktor resiko</th>
                                                        <th>Skala</th>
                                                        <th>Poin</th>
                                                        <th>Skor</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="5">Umur</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="umur_anak"
                                                                        id="umur_anak" value="Kurang dari 3 tahun" @if($resume[0]->umur == 'Kurang dari 3 tahun') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Kurang dari 3 tahun</label>
                                                                </div>
                                                            </td>
                                                            <td>4</td>
                                                            <td rowspan="5"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="umur_anak"
                                                                        id="umur_anak" value="3 tahun - 7 tahun"
                                                                        @if($resume[0]->umur == '3 tahun - 7 tahun') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        3 tahun - 7 tahun</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="umur_anak"
                                                                        id="umur_anak" value="7 tahun - 13 tahun"
                                                                        @if($resume[0]->umur == '7 tahun - 13 tahun') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        7 tahun - 13 tahun</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="umur_anak"
                                                                        id="umur_anak" value="Lebih 13 tahun" @if($resume[0]->umur == 'Lebih 13 tahun') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Lebih 13 tahun</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="umur_anak"
                                                                        id="umur_anak" value="0" @if($resume[0]->umur == '0') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                       None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="3">Jenis Kelamin</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jeniskelaminanak"
                                                                        id="jeniskelaminanak" value="Laki-laki"  @if($resume[0]->jeniskelamin == 'Laki-laki') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Laki - laki</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                            <td rowspan="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jeniskelaminanak"
                                                                        id="jeniskelaminanak" value="Perempuan"
                                                                        @if($resume[0]->jeniskelamin == 'Perempuan') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Perempuan</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="jeniskelaminanak"
                                                                        id="jeniskelaminanak" value="0" @if($resume[0]->jeniskelamin == '0') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="5">Diagnosa</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosa_anak"
                                                                        id="diagnosa_anak" value="Neurologi"
                                                                        @if($resume[0]->diagnosis == 'Neurologi') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Neurologi</label>
                                                                </div>
                                                            </td>
                                                            <td>4</td>
                                                            <td rowspan="5"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosa_anak"
                                                                        id="diagnosa_anak" value="Respiratori, dehidrasi, anemia,anorexia,syncope"
                                                                        @if($resume[0]->diagnosis == 'Respiratori, dehidrasi, anemia,anorexia,syncope') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Respiratori, dehidrasi, anemia,anorexia,
                                                                        syncope</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosa_anak"
                                                                        id="diagnosa_anak" value="Perilaku"
                                                                        @if($resume[0]->diagnosis == 'Perilaku') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Perilaku</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosa_anak"
                                                                        id="diagnosa_anak" value="Lain - lain"
                                                                        @if($resume[0]->diagnosis == 'Lain - lain') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Lain - lain</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="diagnosa_anak"
                                                                        id="diagnosa_anak" value="0"
                                                                        @if($resume[0]->diagnosis == '0') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="4">Gangguan kognitif</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gangguankognitif_anak"
                                                                        id="gangguankognitif_anak" value="Keterbatasan daya pikir"  @if($resume[0]->gangguankoginitf == 'Keterbatasan daya pikir') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Keterbatasan daya pikir</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                            <td rowspan="4"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gangguankognitif_anak"
                                                                        id="gangguankognitif_anak" value="Pelupa, berkurangnya orientasi sekitar"
                                                                        @if($resume[0]->gangguankoginitf == 'Pelupa, berkurangnya orientasi sekitar') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Pelupa, berkurangnya orientasi sekitar</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gangguankognitif_anak"
                                                                        id="gangguankognitif_anak" value="Dapat menggunakan daya pikir tanpa hambatan"
                                                                        @if($resume[0]->gangguankoginitf == 'Dapat menggunakan daya pikir tanpa hambatan') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Dapat menggunakan daya pikir tanpa hambatan</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="gangguankognitif_anak"
                                                                        id="gangguankognitif_anak" value="0" @if($resume[0]->gangguankoginitf == '0') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="5">Faktor lingkungan</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="faktorlingkungan_anak"
                                                                        id="faktorlingkungan_anak" value="Riwayat jatuh atau bayi / balita yang ditempatkan ditempat tidur" @if($resume[0]->faktorlingkungan == '0') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Riwayat jatuh atau bayi / balita yang ditempatkan
                                                                        ditempat tidur</label>
                                                                </div>
                                                            </td>
                                                            <td>4</td>
                                                            <td rowspan="5"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="faktorlingkungan_anak"
                                                                        id="faktorlingkungan_anak" value="Pasien yang menggunakan alat bantu / bayi balita dalam ayunan" @if($resume[0]->faktorlingkungan == 'Pasien yang menggunakan alat bantu / bayi balita dalam ayunan') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Pasien yang menggunakan alat bantu / bayi balita
                                                                        dalam ayunan</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="faktorlingkungan_anak"
                                                                        id="faktorlingkungan_anak" value="Pasien ditempat tidur standar" @if($resume[0]->faktorlingkungan == 'Pasien ditempat tidur standar') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Pasien ditempat tidur standar</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="faktorlingkungan_anak"
                                                                        id="faktorlingkungan_anak" value="Area pasien rawat jalan"  @if($resume[0]->faktorlingkungan == 'Area pasien rawat jalan') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Area pasien rawat jalan</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="faktorlingkungan_anak"
                                                                        id="faktorlingkungan_anak" value="0" @if($resume[0]->faktorlingkungan == '0') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="4">Respon terhadap pembedahan, sedasi, dan
                                                                anestesi</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="responanestesi_anak"
                                                                        id="responanestesi_anak" value=" Dalam 24 jam" @if($resume[0]->responterhadapoperasi == ' Dalam 24 jam') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Dalam 24 jam</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                            <td rowspan="4"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="responanestesi_anak"
                                                                        id="responanestesi_anak" value="Dalam 48 jam" @if($resume[0]->responterhadapoperasi == 'Dalam 48 jam') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Dalam 48 jam</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="responanestesi_anak"
                                                                        id="responanestesi_anak" value="Lebih dari 48 jam / tidak ada respon" @if($resume[0]->responterhadapoperasi == 'Lebih dari 48 jam / tidak ada respon') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Lebih dari 48 jam / tidak ada respon</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="responanestesi_anak"
                                                                        id="responanestesi_anak" value="0" @if($resume[0]->responterhadapoperasi == '0') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="4">Penggunaan obat obatan</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penggunaanobatobatan_anak"
                                                                        id="penggunaanobatobatan_anak" value="Penggunaan bersamaan sedative, barbiturate, anti depresan, diuretik, narkotik" @if($resume[0]->penggunaanobat == 'Penggunaan bersamaan sedative, barbiturate, anti depresan, diuretik, narkotik') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Penggunaan bersamaan sedative, barbiturate, anti
                                                                        depresan, diuretik, narkotik</label>
                                                                </div>
                                                            </td>
                                                            <td>3</td>
                                                            <td rowspan="4"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penggunaanobatobatan_anak"
                                                                        id="penggunaanobatobatan_anak" value="salah satu dari obat diatas" @if($resume[0]->penggunaanobat == 'salah satu dari obat diatas') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        salah satu dari obat diatas</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penggunaanobatobatan_anak"
                                                                        id="penggunaanobatobatan_anak" value="obat obatan lainnya / tanpa obat" @if($resume[0]->penggunaanobat == 'obat obatan lainnya / tanpa obat') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        obat obatan lainnya / tanpa obat</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penggunaanobatobatan_anak"
                                                                        id="penggunaanobatobatan_anak" value="0" @if($resume[0]->penggunaanobat == '0') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        None</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-warning" id="headingSeven">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    SKRINNING NUTRISI
                                </button>
                            </h2>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-danger">PASIEN DEWASA MENGGUNAKAN MALNUTRITION SCREENING TOOLS ( MST )
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-sm  table-bordered table-striped">
                                                    <thead>
                                                        <th>Parameter</th>
                                                        <th>Skala</th>
                                                        <th>Poin</th>
                                                        <th>Skor</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="3">Apakah Pasien mengalami penurunan berat badan yang tidak direncanakan ?</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="apakahadapenurunanbb"
                                                                        id="apakahadapenurunanbb" value="Tidak ( Tidak terjadi penurunan dalam 6 bulan terakhir )" @if($resume[0]->adapenurunanbbanak == 'Tidak ( Tidak terjadi penurunan dalam 6 bulan terakhir )') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak ( Tidak terjadi penurunan dalam 6 bulan terakhir )</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                            <td rowspan="3"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="apakahadapenurunanbb"
                                                                        id="apakahadapenurunanbb" value="Tidak Yakin"
                                                                        @if($resume[0]->adapenurunanbbanak == 'Tidak Yakin') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak Yakin ( Tanyakan apakah baju / celanan terasa linggar )</label>
                                                                </div>
                                                            </td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="apakahadapenurunanbb"
                                                                        id="apakahadapenurunanbb" value="Ada" @if($resume[0]->adapenurunanbbanak == 'Ada') checked @endif
                                                                        >
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya, berapakah penurunan berat badan tersebut ?</label>
                                                                </div>
                                                                @php $gz = explode('|',$resume[0]->faktormalnutrisianak ) @endphp
                                                                <div class="row">
                                                                    <p class="mt-2 mb-2 text-bold">pilih berat penurunan</p>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="beratpenurunan"
                                                                                id="beratpenurunan" value="1-5kg"
                                                                                @if($gz[0] == '1-5kg ') checked @endif>
                                                                            <label class="form-check-label" for="inlineRadio1">
                                                                                1 - 5 kg</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="beratpenurunan"
                                                                                id="beratpenurunan" value="6-10kg"
                                                                                @if($gz[0] == '6-10kg ') checked @endif>
                                                                            <label class="form-check-label" for="inlineRadio1">
                                                                                6 - 10 kg</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="beratpenurunan"
                                                                                id="beratpenurunan" value="11-15kg"
                                                                                @if($gz[0] == '11-15kg ') checked @endif>
                                                                            <label class="form-check-label" for="inlineRadio1">
                                                                                11 - 15 kg</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="beratpenurunan"
                                                                                id="beratpenurunan" value=">15kg"
                                                                                @if($gz[0] == '>15kg ') checked @endif>
                                                                            <label class="form-check-label" for="inlineRadio1">
                                                                               >15 kg</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="beratpenurunan"
                                                                                id="beratpenurunan" value="Tidak Yakin"
                                                                                @if($gz[0] == 'Tidak Yakin ') checked @endif>
                                                                            <label class="form-check-label" for="inlineRadio1">
                                                                                Tidak Yakin</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Apakah asupan makanan pasien buruk akibat nafsu makan yang menurun ? ( misalnya asupan makanan hanya 3/4 dari biasanya )
                                                            </td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="apakahasupanmakanburuk"
                                                                        id="apakahasupanmakanburuk" value="Ya"
                                                                        @if($gz[1] == ' Ya ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="apakahasupanmakanburuk"
                                                                        id="apakahasupanmakanburuk" value="Tidak"
                                                                        @if($gz[1] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Sakit Berat ***</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="Sakitberat"
                                                                        id="Sakitberat" value="Ya"
                                                                        @if($gz[2] == ' Ya ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="Sakitberat"
                                                                        id="Sakitberat" value="Tidak"
                                                                        @if($gz[2] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-danger">PASIEN ANAK MENGGUNAKAN STRONG KIDS</div>
                                            <div class="card-body">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <th>Pertanyaan</th>
                                                        <th>Skala</th>
                                                        <th>Poin</th>
                                                        <th>Skor</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="2">Apakah pasien tampak kurus ?</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="pasientampakkurus"
                                                                        id="pasientampakkurus" value="Ya"
                                                                        @if($resume[0]->anaktampakkurus == 'Ya') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="pasientampakkurus"
                                                                        id="pasientampakkurus" value="Tidak"
                                                                        @if($resume[0]->anaktampakkurus == 'Tidak') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Apakah ada penurunan BB selama satu bulan terakhir ( berdasarkan penilaian objektif data BB bila ada / penilaian subjektif dari orang tua pasien atau untuk bayi < 1 tahun : BB naik selama 3 bulan terkahir</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penurunanbb_anak"
                                                                        id="penurunanbb_anak" value="Ya"
                                                                        @if($gz[3] == ' Ya ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penurunanbb_anak"
                                                                        id="penurunanbb_anak" value="Tidak"
                                                                        @if($gz[3] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Apakah terdapat salah satu dari kondisi <br>
                                                            1. Diari > kali / hari dan atau muntah > 3 kali / hari dalam seminggu terakhir <br>
                                                            2. Asupan makanan berkurang selama 1 minggu terakhir
                                                        </td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="kondisilain"
                                                                        id="kondisilain" value="diare / asupan makanan berkurang "
                                                                        @if($gz[4] == ' diare / asupan makanan berkurang  ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="kondisilain"
                                                                        id="kondisilain" value="Tidak"
                                                                        @if($gz[4] == ' Tidak ') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                        Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                        <tr>
                                                            <td rowspan="2">Apakah terdapat penyakit atau keadaan yang mengakibatkan pasien beresiko mengalami malnutrisi</td>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penyakitlain_anak"
                                                                        id="penyakitlain_anak" value="Ya"
                                                                        @if($gz[5] == ' Ya') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                       Ya</label>
                                                                </div>
                                                            </td>
                                                            <td>1</td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="penyakitlain_anak"
                                                                        id="penyakitlain_anak" value="Tidak"
                                                                        @if($gz[5] == ' Tidak') checked @endif>
                                                                    <label class="form-check-label" for="inlineRadio1">
                                                                      Tidak</label>
                                                                </div>
                                                            </td>
                                                            <td>0</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <td colspan="4" class="text-center bg-info">Diagnosa Keperawatan/Kebidanan</td>
                    </tr>
                    <tr>
                        <td>
                            @php $p = explode('|',$resume[0]->penyakitlainpasien ) @endphp
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="jlnnafas" name="jlnnafas" @if($p[0] == 'on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko bersihan jalan nafas tidak efektif</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="polanafas" id="polanafas" @if($p[1] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko pola nafas tidak efektif</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="pertukarangas" id="pertukarangas" @if($p[2] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko gangguan pertukaran gas</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="sirkulasi" id="sirkulasi" @if($p[3] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko gangguan sirkulasi</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="perfusijaringan" id="perfusijaringan" @if($p[4] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko gangguan perfusi jaringan / cerebral</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="hipertermia" id="hipertermia" @if($p[5] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">hipertermia</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="keseimbangancairan" id="keseimbangancairan" @if($p[6] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko gangguan keseimbangan cairan</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="integritaskulit" id="integritaskulit" @if($p[7] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko gangguan gangguan integritas kulit</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="aktualtakut" id="aktualtakut" @if($p[8] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Aktual / risiko cemas / takut</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="toksik" id="toksik" @if($p[9] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Risiko penyebaran toksik</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="cederajatuh" id="cederajatuh" @if($p[10] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Risiko cedera / jatuh</label>
                              </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="nyeri" id="nyeri" @if($p[11] == ' on ') checked @endif>
                                <label class="form-check-label" for="exampleCheck1">Nyeri</label>
                              </div>
                            <textarea class="form-control" placeholder="Masukan diagnosa keperawatan ..." name="diagnosakeperawatan"
                                id="diagnosakeperawatan">{{ $dg[0] }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center bg-info">Rencana Keperawatan/Kebidanan</td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="form-control" placeholder="Masukan rencana keperawatan" id="rencanakeperawatan"
                                name="rencanakeperawatan">{{ $resume[0]->rencanakeperawatan}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center bg-info">Tindakan Keperawatan/Kebidanan</td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="form-control" placeholder="Masukan tindakan keperawatan" id="tindakankeperawatan"
                                name="tindakankeperawatan">{{ $resume[0]->tindakankeperawatan}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center bg-info">Evaluasi Keperawatan/Kebidanan</td>
                    </tr>
                    <tr>
                        <td>
                            <textarea class="form-control" placeholder="Masukan evaluasi keperawatan" name="evaluasikeperawatan"
                                id="evaluasikeperawatan">{{ $resume[0]->evaluasikeperawatan}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center bg-info">Kolaborasi</td>
                    </tr>
                    <tr>
                        <td>
                           <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="infus" name="infus">
                                    <label class="form-check-label" for="exampleCheck1">INFUS / IVFD</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="lab" name="lab">
                                    <label class="form-check-label" for="exampleCheck1">LAB</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="ekg" name="ekg">
                                    <label class="form-check-label" for="exampleCheck1">EKG</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="oksigenasi" name="oksigenasi">
                                    <label class="form-check-label" for="exampleCheck1">OKSIGENASI</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="nebulizer" name="nebulizer">
                                    <label class="form-check-label" for="exampleCheck1">NEBULIZER</label>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="saturasioksigen" name="saturasioksigen">
                                    <label class="form-check-label" for="exampleCheck1">SATURASI OKSIGEN</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="ngt" name="ngt">
                                    <label class="form-check-label" for="exampleCheck1">NGT</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="mengumbahlambung" name="mengumbahlambung">
                                    <label class="form-check-label" for="exampleCheck1">MENGUMBAH LAMBUNG</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="kateter" name="kateter">
                                    <label class="form-check-label" for="exampleCheck1">KATETER</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="defibrilasi" name="defibrilasi">
                                    <label class="form-check-label" for="exampleCheck1">DEFIBRILASI</label>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="mayo" name="mayo">
                                    <label class="form-check-label" for="exampleCheck1">MAYO</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="ett" name="ett">
                                    <label class="form-check-label" for="exampleCheck1">ETT</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="suction" name="suction">
                                    <label class="form-check-label" for="exampleCheck1">SUCTION</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="eksplorasi" name="eksplorasi">
                                    <label class="form-check-label" for="exampleCheck1">EXPLORASI / IRIGASI</label>
                                  </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="obat" name="obat">
                                    <label class="form-check-label" for="exampleCheck1">OBAT</label>
                                  </div>
                            </div>
                           </div>
                        </td>
                    </tr>
                </table>
                <button type="button" class="btn btn-danger float-right ml-2" onclick="ambildatapasien()">Kembali</button>
                <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
            </form>
        </div>
    </div>
</div>
<script>
     function simpanhasil() {
        var data = $('.formpemeriksaanperawat').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpemeriksaanperawat_igd') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
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
                }
            }
        });
    }
</script>
