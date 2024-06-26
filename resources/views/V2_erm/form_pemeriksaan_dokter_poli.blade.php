<form action="" class="formpemeriksaan">
    <input hidden type="text" name="kodekunjungan" id="kodekunjungan" value="{{ $kodekunjungan }}">
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
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            name="tekanandarah" id="tekanandarah"
                                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->tekanan_darah }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->tekanandarah }} @endif @endif">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">mmHg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Frekuensi
                                    Nadi</label>
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control-plaintext"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" name="frekuensinadi" id="frekuensinadi"
                                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->frekuensi_nadi }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->frekuensinadi }} @endif @endif">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Frekuensi
                                    Nafas</label>
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control-plaintext"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" name="frekuensinafas" id="frekuensinafas"
                                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->frekuensi_nafas }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->frekuensinapas }} @endif @endif">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Suhu</label>
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control-plaintext"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" name="suhu" id="suhu"
                                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->suhu_tubuh }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->suhutubuh }} @endif @endif">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">°C</span>
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
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" name="bb" id="bb"
                                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->beratbadan }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->imt }} @endif @endif">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">kg/cm/imt</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Usia</label>
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control-plaintext"
                                            placeholder="masukan usia pasien ..." aria-label="Recipient's username"
                                            aria-describedby="basic-addon2" name="usia1" id="usia1"
                                            value="@if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) {{ $assdok_now[0]->umur }}@else {{ $mt_pasien[0]->usia }} @endif @else{{ $mt_pasien[0]->usia }} @endif">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">tahun</span>
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
                        <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                            value="1"
                            @if (count($assdok_now) > 0) @if ($assdok_now[0]->versi == 2) @if ($assdok_now[0]->sumber_data == 1) checked @endif
                            @endif
                    @else
                        checked
                        @endif>
                        <label class="form-check-label" for="inlineRadio1">Pasien Sendiri</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                            value="2"
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
                            rows="4" aria-describedby="emailHelp"> @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 1){{ $last_assdok[0]->keadaanumum }} {{ $last_assdok[0]->kesadaran }} {{ $last_assdok[0]->pemeriksaan_fisik }}@else{{ $last_assdok[0]->pemeriksaan_fisik }} @endif @endif
</textarea>
                    </div>
                </div>
            </div>
            @if ($unit == '1014')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pemeriksaan RO MATA</label>
                            <textarea rows="20" type="text" class="form-control" id="ro_mata" name="ro_mata" rows="4"
                                aria-describedby="emailHelp">
@foreach ($RO_MATA as $r)
{{ $r->tajampenglihatandekat }}
@endforeach
</textarea>
                            <input hidden type="text" id="id_ro" name="id_ro"
                                value="@foreach ($RO_MATA as $rm) {{ $r->id }} @endforeach">
                        </div>
                    </div>
                </div>
            @endif
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
