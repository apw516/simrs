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
                <label for="staticEmail" class="col-sm-2 col-form-label">Diagnosa WD & DD</label>
                <div class="col-sm-10">
                    <textarea rows="5" type="text" class="form-control" id="diagnosakerja"
                        name="diagnosakerja">
@if (count($last_assdok) > 0){{ $last_assdok[0]->diagnosakerja }}@endif
</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Dasar diagnosa</label>
                <div class="col-sm-10">
                    <textarea rows="5" type="text" class="form-control" id="diagnosabanding"
                        name="diagnosabanding">
@if (count($last_assdok) > 0){{ $last_assdok[0]->diagnosabanding }}@endif
</textarea>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-bold font-lg bg-light">Anamnesa</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">A ( Alergi )</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alergi" name="alergi" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->alergi }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->alergi }} @endif @endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">M ( Medikasi )</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="medikasi" name="medikasi" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->medikasi }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->medikasi }} @endif @endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">P ( Post Illnes )</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="post" name="post" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->postillnes }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->postillnes }} @endif @endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">L ( Last Meal )</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastmeal" name="lastmeal" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->lastmeal }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->lastmeal }} @endif @endif">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">E ( Event )</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="event" name="event" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->event }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->event }} @endif @endif">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Pemeriksaan Fisik</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td>Cor</td>
                            <td><input type="text" class="form-control" name="cor" id="cor" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->cor }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->cor }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>Pulmo</td>
                            <td><input type="text" class="form-control" name="pulmo" id="pulmo" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->pulmo }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->pulmo }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>Gigi</td>
                            <td><input type="text" class="form-control" name="gigi" id="gigi" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->gigi }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->gigi }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>Ekstremitas</td>
                            <td><input type="text" class="form-control" name="ekstremitas" id="ekstremitas" value="@if(count($assdok_now) > 0) {{ $assdok_now[0]->ekstremitas }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->ekstremitas }} @endif @endif"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Penilaian Evaluasi Jalan Nafas</div>
                <div class="card-body">
                    @if(count($assdok_now) > 0)
                        @php $lemon = explode('|',$assdok_now[0]->LEMON ) @endphp
                    @else
                        @if (count($last_assdok) > 0)
                            @php $lemon = explode('|',$last_assdok[0]->LEMON ) @endphp
                        @endif
                    @endif
                    <table class="table table-sm">
                        <tr>
                            <td>L</td>
                            <td><input type="text" class="form-control" name="L" id="L" value="@if(count($assdok_now) > 0) {{ $lemon[0] }}@else @if (count($last_assdok) > 0) {{ $lemon[0] }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>E</td>
                            <td><input type="text" class="form-control" name="E" id="E" value="@if(count($assdok_now) > 0) {{ $lemon[1] }}@else @if (count($last_assdok) > 0) {{ $lemon[1] }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>M</td>
                            <td><input type="text" class="form-control" name="M" id="M" value="@if(count($assdok_now) > 0) {{ $lemon[2] }}@else @if (count($last_assdok) > 0) {{ $lemon[2] }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>O</td>
                            <td><input type="text" class="form-control" name="O" id="O" value="@if(count($assdok_now) > 0) {{ $lemon[3] }}@else @if (count($last_assdok) > 0) {{ $lemon[3] }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>N</td>
                            <td><input type="text" class="form-control" name="N" id="N" value="@if(count($assdok_now) > 0) {{ $lemon[4] }}@else @if (count($last_assdok) > 0) {{ $lemon[4] }} @endif @endif"></td>
                        </tr>
                        <tr>
                            <td>Assesmen</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="assesmen" id="assesmen" value="1" @if(count($assdok_now) > 0) @if($assdok_now[0]->tindak_lanjut == 1) checked @endif @else @if (count($last_assdok) > 0) @if($last_assdok[0]->tindak_lanjut == 1) checked @endif @endif @endif>
                                    <label class="form-check-label" for="inlineRadio1">Setuju dijadwalkan
                                        operasi</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="assesmen" id="assesmen" value="2" @if(count($assdok_now) > 0) @if($assdok_now[0]->tindak_lanjut == 2) checked @endif @else @if (count($last_assdok) > 0) @if($last_assdok[0]->tindak_lanjut == 2) checked @endif @endif @endif>
                                    <label class="form-check-label" for="inlineRadio2">Saat ini keadaan pasien
                                        dalam kondisi belum untuk dilakukan tindakan anestesi</label>
                                  </div>

                            </td>
                        </tr>
                        <tr>
                            <td>Saran</td>
                            <td>
                                <textarea  class="form-control" name="saran" id="saran" cols="30" rows="10">@if(count($assdok_now) > 0) {{ $assdok_now[0]->keterangan_tindak_lanjut }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->keterangan_tindak_lanjut }} @endif @endif</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Jawaban konsul</td>
                            <td>
                                <textarea  class="form-control" name="jawabankonsul" id="jawabankonsul" cols="30" rows="10">@if(count($assdok_now) > 0) {{ $assdok_now[0]->keterangan_tindak_lanjut_2 }}@else @if (count($last_assdok) > 0) {{ $last_assdok[0]->keterangan_tindak_lanjut_2 }} @endif @endif</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            {{--
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
                                        placeholder="Ketik keterangan tindak lanjut ...">@if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) {{ $tl[5] }} @endif @endif</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
</form>
