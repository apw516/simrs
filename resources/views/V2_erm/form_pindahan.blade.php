<div class="card-body">
    @if (auth()->user()->unit == '1028')
    <div class="card">
        <div class="card-header bg-secondary">Tanda tanda vital</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Tekanan darah </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="tekanan darah ..."
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"> mmHg </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Frekuensi nadi </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Frekeunsi nadi"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"> x/menit </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Frekuensi nafas </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Frekuensi nafas"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"> x/menit </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Suhu </label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Suhu"
                                aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"> °C </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Berat badan </label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="berat badan">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlInput1"> Umur </label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="umur">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-secondary">Layanan Fisik dan Rehabilitasi</div>
        <div class="card-body">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Anamnesa</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Pemeriksaan fungsi dan uji fungsi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1"> Diagnosis Medis ( ICD 10) </label>
                <input type="email" class="form-control" id="exampleFormControlInput1"
                    placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1"> Diagnosis Fungsi ( ICD 10) </label>
                <input type="email" class="form-control" id="exampleFormControlInput1"
                    placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Pemeriksaan penunjang</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Anjuran</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Evaluasi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Suspek penyakit akibat kerja</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                        value="option1">
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                        value="option2">
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (count($last_assdok) > 0)
                        @php
                            $tl = explode('|', $last_assdok[0]->tindak_lanjut);
                        @endphp
                    @endif
                    <div class="card">
                        <div class="card-header bg-secondary">Tindak Lanjut</div>
                        <div class="card-body">
                            <div class="form-check form-check-inline">
                                <input @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[0] == 1) checked @endif @endif @endif class="form-check-input" type="checkbox" name="pulangsembuh" id="pulangsembuh" value="1">
                            <label class="form-check-label" for="inlineCheckbox1">Pulang / Sembuh</label>
</div>
<div class="form-check form-check-inline">
    <input
        @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[1] == 1) checked @endif
        @endif @endif class="form-check-input" type="checkbox"
    name="kontrol" id="kontrol" value="1">
    <label class="form-check-label" for="inlineCheckbox2">Kontrol</label>
</div>
<div class="form-check form-check-inline">
    <input
        @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[2] == 1) checked @endif
        @endif @endif class="form-check-input" type="checkbox"
    name="konsulpoli" id="konsulpoli" value="1">
    <label class="form-check-label" for="inlineCheckbox2">Konsul Poli lain</label>
</div>
<div class="form-check form-check-inline">
    <input
        @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[3] == 1) checked @endif
        @endif @endif class="form-check-input" type="checkbox"
    name="rawatinap" id="rawatinap" value="1">
    <label class="form-check-label" for="inlineCheckbox2">Rawat Inap</label>
</div>
<div class="form-check form-check-inline">
    <input
        @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[4] == 1) checked @endif
        @endif @endif class="form-check-input" type="checkbox"
    name="rujukekluar" id="rujukekluar" value="1">
    <label class="form-check-label" for="inlineCheckbox2">Rujuk Keluar</label>
</div>
<div class="col-md-12">
    <div class="form-group container-fluid">
        <label for="exampleFormControlTextarea1">Keterangan Tindak Lanjut</label>
        <textarea class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut" rows="3"
            placeholder="Ketik keterangan tindak lanjut ...">
@if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) {{ $tl[5] }} @endif @endif
</textarea>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
    @else
        @if (count($resume_perawat) > 0)
            <form action="" class="formpemeriksaan">
                <input hidden type="text" name="kodekunjungan" id="kodekunjungan"
                    value="{{ $kodekunjungan }}">
                {{-- <input hidden type="text" name="usia" id="usia" value="{{ $usia }}"> --}}
                <div class="card card-outline card-success">
                    <div class="card-header text-dark text-bold">Hasil Pemeriksaan</div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header bg-light">Tanda tanda vital</div>
                            <div class="card-body">
                                <div class="row mb-1">
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">Tekanan
                                                Darah</label>
                                            <div class="col-sm-6">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-plaintext"
                                                        placeholder="silahkan isi tekanan darah pasien"
                                                        aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2" name="tekanandarah"
                                                        id="tekanandarah"
                                                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->tekanan_darah }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->tekanandarah }} @endif @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            id="basic-addon2">mmHg</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="staticEmail"
                                                class="col-sm-5 col-form-label">Frekuensi
                                                Nadi</label>
                                            <div class="col-sm-4">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-plaintext"
                                                        placeholder="Recipient's username"
                                                        aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2" name="frekuensinadi"
                                                        id="frekuensinadi"
                                                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->frekuensi_nadi }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->frekuensinadi }} @endif @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            id="basic-addon2">x/menit</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="staticEmail"
                                                class="col-sm-5 col-form-label">Frekuensi
                                                Nafas</label>
                                            <div class="col-sm-4">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-plaintext"
                                                        placeholder="Recipient's username"
                                                        aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2"
                                                        name="frekuensinafas" id="frekuensinafas"
                                                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->frekuensi_nafas }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->frekuensinapas }} @endif @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            id="basic-addon2">x/menit</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="staticEmail"
                                                class="col-sm-5 col-form-label">Suhu</label>
                                            <div class="col-sm-4">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-plaintext"
                                                        placeholder="Recipient's username"
                                                        aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2" name="suhu"
                                                        id="suhu"
                                                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->suhu_tubuh }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->suhutubuh }} @endif @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            id="basic-addon2">°C</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">BB /
                                                TB /
                                                IMT</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-plaintext"
                                                        placeholder="Recipient's username"
                                                        aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2" name="bb"
                                                        id="bb"
                                                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->beratbadan }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->imt }} @endif @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            id="basic-addon2">kg/cm/imt</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row">
                                            <label for="staticEmail"
                                                class="col-sm-5 col-form-label">Usia</label>
                                            <div class="col-sm-4">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control-plaintext"
                                                        placeholder="masukan usia pasien ..."
                                                        aria-label="Recipient's username"
                                                        aria-describedby="basic-addon2" name="usia1"
                                                        id="usia1"
                                                        value="@if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) {{ $assdok_now[0]->umur }}@else {{ $mt_pasien[0]->usia }} @endif
@else
{{ $mt_pasien[0]->usia }} @endif">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"
                                                            id="basic-addon2">tahun</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Sumber Data</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sumberdata"
                                        id="sumberdata" value="1"
                                        @if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) @if ($assdok_now[0]->sumber_data == 1) checked @endif
                                        @endif
                                @else
                                    checked
        @endif>
        <label class="form-check-label" for="inlineRadio1">Pasien Sendiri</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata" value="2"
        @if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) @if ($assdok_now[0]->sumber_data == 2) checked @endif
        @endif @endif>
    <label class="form-check-label" for="inlineRadio2">Keluarga</label>
</div>
</div>
</div>
<div class="form-group row">
<label for="staticEmail" class="col-sm-2 col-form-label">Keluhan Utama</label>
<div class="col-sm-10">
<textarea rows="5" type="text" class="form-control" id="keluhanutama" name="keluhanutama">
@if (count($assdok_now) > 0) {{ $assdok_now[0]->keluhan_pasien }}
@else
@if (count($resume_perawat) > 0) {{ $resume_perawat[0]->keluhanutama }} @endif @endif
</textarea>
</div>
</div>
<div class="form-group row">
<label for="staticEmail" class="col-sm-2 col-form-label">Riwayat penyakit
dahulu</label>
<div class="col-sm-10">
<textarea rows="5" type="text" class="form-control" id="riwayatpenyakitdahulu"
    name="riwayatpenyakitdahulu">
@if (count($last_assdok) > 0){{ $last_assdok[0]->ket_riwayatlain }}@endif
</textarea>
</div>
</div>
<div class="form-group row">
<label for="staticEmail" class="col-sm-2 col-form-label">Riwayat alergi</label>
<div class="col-sm-10">
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="riwayatalergi" id="riwayatalergi"
        value="1"
        @if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) @if ($assdok_now[0]->riwayat_alergi == 1) checked @endif
        @endif
@else
    checked @endif>
    <label class="form-check-label" for="inlineRadio1">Tidak</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="riwayatalergi" id="riwayatalergi"
        value="2"
        @if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) @if ($assdok_now[0]->riwayat_alergi == 2) checked @endif
        @endif @endif>
    <label class="form-check-label" for="inlineRadio2">Ya</label>
</div><br>
<textarea rows="5" type="text" class="form-control" id="keteranganriwayatalergi"
    name="keteranganriwayatalergi">
@if (count($last_assdok) > 0){{ $last_assdok[0]->keterangan_alergi }}@endif
</textarea>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
    <label for="exampleInputEmail1">Pemeriksaan Fisik ( O )</label>
    <textarea rows="5" type="text" class="form-control" id="pemeriksaanfisik" name="pemeriksaanfisik"
        rows="4" aria-describedby="emailHelp">
@if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 1){{ $last_assdok[0]->keadaanumum }} {{ $last_assdok[0]->kesadaran }} {{ $last_assdok[0]->pemeriksaan_fisik }}
@else
{{ $last_assdok[0]->pemeriksaan_fisik }} @endif @endif
</textarea>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
    <label for="exampleInputEmail1">Diagnosa primer ( A )</label>
    <input type="text" class="form-control" id="diagnosaprimer" name="diagnosaprimer"
        aria-describedby="emailHelp"
        value="@if (count($last_assdok) > 0) {{ $last_assdok[0]->diagnosakerja }} @endif">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
    <label for="exampleInputEmail1">Diagnosa Sekunder</label>
    <input type="text" class="form-control" id="diagnosasekunder" name="diagnosasekunder"
        aria-describedby="emailHelp"
        value="@if (count($last_assdok) > 0) {{ $last_assdok[0]->diagnosabanding }} @endif">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group">
    <label for="exampleInputEmail1">Rencana Terapi ( P )</label>
    <textarea type="text" class="form-control" id="rencanaterapi" name="rencanaterapi" rows="4"
        aria-describedby="emailHelp">
@if (count($last_assdok) > 0){{ $last_assdok[0]->rencanakerja }}@endif
</textarea>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
@if (count($last_assdok) > 0)
    @php
        $tl = explode('|', $last_assdok[0]->tindak_lanjut);
    @endphp
@endif
<div class="card">
    <div class="card-header">Tindak Lanjut</div>
    <div class="card-body">
        <div class="form-check form-check-inline">
            <input
                @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[0] == 1) checked @endif
                @endif @endif class="form-check-input"
            type="checkbox" name="pulangsembuh" id="pulangsembuh" value="1">
            <label class="form-check-label" for="inlineCheckbox1">Pulang / Sembuh</label>
        </div>
        <div class="form-check form-check-inline">
            <input
                @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[1] == 1) checked @endif
                @endif @endif class="form-check-input"
            type="checkbox" name="kontrol" id="kontrol" value="1">
            <label class="form-check-label" for="inlineCheckbox2">Kontrol</label>
        </div>
        <div class="form-check form-check-inline">
            <input
                @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[2] == 1) checked @endif
                @endif @endif class="form-check-input"
            type="checkbox" name="konsulpoli" id="konsulpoli" value="1">
            <label class="form-check-label" for="inlineCheckbox2">Konsul Poli lain</label>
        </div>
        <div class="form-check form-check-inline">
            <input
                @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[3] == 1) checked @endif
                @endif @endif class="form-check-input"
            type="checkbox" name="rawatinap" id="rawatinap" value="1">
            <label class="form-check-label" for="inlineCheckbox2">Rawat Inap</label>
        </div>
        <div class="form-check form-check-inline">
            <input
                @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[4] == 1) checked @endif
                @endif @endif class="form-check-input"
            type="checkbox" name="rujukekluar" id="rujukekluar" value="1">
            <label class="form-check-label" for="inlineCheckbox2">Rujuk Keluar</label>
        </div>
        <div class="col-md-12">
            <div class="form-group container-fluid">
                <label for="exampleFormControlTextarea1">Keterangan Tindak Lanjut</label>
                <textarea class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut" rows="3"
                    placeholder="Ketik keterangan tindak lanjut ...">
@if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) {{ $tl[5] }} @endif @endif
</textarea>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</form>

<div class="accordion" id="accordionExample_penunjang1">
<div class="card">
<div class="card-header bg-light" id="headingOne_Penunjang">
    <h2 class="mb-0">
        <button class="btn btn-link btn-block text-dark text-bold text-left collapsed" type="button"
            data-toggle="collapse" data-target="#collapseOne_penunjang1" aria-expanded="true"
            aria-controls="collapseOne_penunjang1">
            <i class="bi bi-plus-lg"></i> Billing Tindakan Poliklinik
        </button>
    </h2>
</div>
<div id="collapseOne_penunjang1" class="collapse" aria-labelledby="headingOne_Penunjang"
    data-parent="#accordionExample_penunjang1">
    <div class="card-body">
        <div class="card">
            <div class="card-header bg-light font-italic">Riwayat Tindakan hari ini
                ...</div>
            <div class="card-body">
                <div class="v_riwayat_tindakan_tdy">

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light font-italic">Silahkan Pilih Tindakan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered table-hover" id="tabel_pilih_layanan">
                            <thead>
                                <th>Nama Tindakan</th>
                                <th>Tarif</th>
                            </thead>
                            @foreach ($layanan as $l)
                                <tr class="pilihtindakan" id="{{ $l->kode }}"
                                    nama="{{ $l->Tindakan }}" tarif={{ $l->tarif }}>
                                    <td>{{ $l->Tindakan }}</td>
                                    <td>{{ $l->tarif }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-secondary"><i class="bi bi-check-lg mr-2"></i> List
                                tindakan yang dipilih</div>
                            <div class="card-body">
                                <form action="" method="post" class="formbillingtindakan">
                                    <div class="field_tindakan" id="field_fix_tindakan">
                                        <div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card">
<div class="card-header bg-light" id="headingTwo_Penunjang">
    <h2 class="mb-0">
        <button class="btn btn-link btn-block text-dark text-bold text-left collapsed" type="button"
            data-toggle="collapse" data-target="#collapseTwo_penunjang2" aria-expanded="false"
            aria-controls="collapseTwo_penunjang2">
            <i class="bi bi-plus-lg"></i> Order Farmasi
        </button>
    </h2>
</div>
<div id="collapseTwo_penunjang2" class="collapse" aria-labelledby="headingTwo_Penunjang"
    data-parent="#accordionExample_penunjang1">
    <div class="card-body">
        <div class="card">
            <div class="card-header bg-light font-italic">Riwayat Order Hari ini
            </div>
            <div class="card-body">
                <div class="v_riwayat_order_farmasi">

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-light font-italic">Silahkan Pilih Obat</div>
            <div class="card-body">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalobatreguler"><i class="bi bi-plus"></i> Obat
                        Reguler</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#modalobatracik"><i class="bi bi-plus"></i> Obat
                        Racikan</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#riwayatpemakaianobatmodal"><i class="bi bi-plus"></i>
                        Riwayat Pemakaian Obat</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#riwayatracikan"><i class="bi bi-plus"></i>
                        Riwayat Racikan</button>
                </div>
            </div>
            <div class="container-fluid">
                <label for="" class="font-italic">List obat yang dipilih
                    ...</label>
                <form action="" method="post" class="formorderfarmasi">
                    <div class="field_order_farmasi" id="field_fix_1">
                        <div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card">
<div class="card-header bg-light" id="headingThree_penunjang">
    <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left text-dark text-bold collapsed" type="button"
            data-toggle="collapse" data-target="#collapseThree_penunjang1" aria-expanded="false"
            aria-controls="collapseThree_penunjang1">
            <i class="bi bi-plus-lg"></i> Order Laboratorium
        </button>
    </h2>
</div>
<div id="collapseThree_penunjang1" class="collapse" aria-labelledby="headingThree_penunjang"
    data-parent="#accordionExample_penunjang1">
    <div class="card-body">
        <div class="card">
            <div class="card-header">Riwayat Order Laboratorium hari ini ...</div>
            <div class="card-body">
                <div class="v_r_order_lab">

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Silahkan pilih layanan Laboratorium</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-bordered table-hover"
                            id="tabel_pilih_layanan_lab">
                            <thead>
                                <th>Nama Layanan</th>
                                <th>Tarif</th>
                            </thead>
                            @foreach ($layanan_lab as $l)
                                <tr class="pilihlayanan_lab" id="{{ $l->kode }}"
                                    nama="{{ $l->Tindakan }}" tarif={{ $l->tarif }}>
                                    <td>{{ $l->Tindakan }}</td>
                                    <td>{{ $l->tarif }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-secondary"><i class="bi bi-check-lg mr-2"></i> List
                                Layanan laboratorium yang dipilih</div>
                            <div class="card-body">
                                <form action="" method="post" class="form_order_lab">
                                    <div class="field_lab" id="field_fix_lab">
                                        <div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="card">
<div class="card-header bg-light" id="headingFour_penunjang">
    <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left text-dark text-bold collapsed" type="button"
            data-toggle="collapse" data-target="#collapseFour_penunjang1" aria-expanded="false"
            aria-controls="collapseFour_penunjang1">
            <i class="bi bi-plus-lg"></i> Order Radiologi
        </button>
    </h2>
</div>
<div id="collapseFour_penunjang1" class="collapse" aria-labelledby="headingFour_penunjang"
    data-parent="#accordionExample_penunjang1">
    <div class="card-body">
        <div class="card">
            <div class="card-header">Riwayat order radiologi hari ini ...</div>
            <div class="card-body">
                <div class="v_r_order_rad_hari_ini">

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="card-header">Silahkan pilih layanan Radiologi</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered table-hover"
                                id="tabel_pilih_layanan_rad">
                                <thead>
                                    <th>Nama Layanan</th>
                                    <th>Tarif</th>
                                </thead>
                                @foreach ($layanan_rad as $l)
                                    <tr class="pilihlayanan_rad" id="{{ $l->kode }}"
                                        nama="{{ $l->Tindakan }}" tarif={{ $l->tarif }}>
                                        <td>{{ $l->Tindakan }}</td>
                                        <td>{{ $l->tarif }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-secondary"><i class="bi bi-check-lg mr-2"></i>
                                    List
                                    Layanan Radiologi yang dipilih</div>
                                <div class="card-body">
                                    <form action="" method="post" class="form_order_rad">
                                        <div class="field_rad" id="field_fix_rad">
                                            <div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<button type="button" class="btn btn-success float-right" onclick="simpanpemeriksaandokter()"><i
class="bi bi-save"></i>
Simpan</button>
<button type="button" class="btn btn-danger float-right ml-1 mr-1" onclick="ambildatapasien()()"><i
class="bi bi-backspace mr-1"></i> Kembali</button>
</div>
@else
<h4 class="text-danger"><i class="bi bi-exclamation-triangle mr-2"></i> Perawat / Bidan belum mengisi assesment ...
</h4>
@endif
@endif
