<form action="" class="formpemeriksaan">
<input hidden type="text" name="kodekunjungan" id="kodekunjungan" value="{{ $kodekunjungan }}">
<div class="card">
    <div class="card-header bg-secondary">Tanda tanda vital</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"> Tekanan darah </label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="tekanan darah ..." name="tekanandarah"
                            id="tekanandarah" aria-label="Recipient's username" aria-describedby="basic-addon2"
                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->tekanan_darah }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->tekanandarah }} @endif @endif">
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
                        <input type="text" class="form-control" placeholder="Frekeunsi nadi" name="frekuensinadi"
                            id="frekuensinadi" aria-label="Recipient's username" aria-describedby="basic-addon2"
                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->frekuensi_nadi }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->frekuensinadi }} @endif @endif">
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
                        <input type="text" class="form-control" placeholder="Frekuensi nafas" name="frekuensinafas"
                            id="frekuensinafas" aria-label="Recipient's username" aria-describedby="basic-addon2"
                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->frekuensi_nafas }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->frekuensinapas }} @endif @endif">
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
                        <input type="text" class="form-control" placeholder="Suhu" aria-label="Recipient's username"
                            name="suhu" id="suhu" aria-describedby="basic-addon2"
                            value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->suhu_tubuh }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->suhutubuh }} @endif @endif">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2"> °C </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"> Berat badan / Tinggi badan / IMT </label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="berat badan" name="beratbadan" id="beratbadan"
                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->beratbadan }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->beratbadan }} / {{ $resume_perawat[0]->tinggibadan }} / {{ $resume_perawat[0]->imt }} @endif @endif">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1"> Umur </label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="umur" name="umur" id="umur"
                        value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->umur }} @else @if (count($resume_perawat) > 0) {{ $resume_perawat[0]->usia }} @endif @endif">
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
            <textarea class="form-control" id="anamnesa" name="anamnesa" rows="3">
@if (count($assdok_now) > 0) {{ $assdok_now[0]->anamnesa }}
@else
@if (count($last_assdok) > 0) {{ $last_assdok[0]->anamnesa }} @endif @endif
</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Pemeriksaan fungsi dan uji fungsi</label>
            <textarea class="form-control" id="pemeriksaanfisi" name="pemeriksaanfisik" rows="3"> @if (count($assdok_now) > 0) {{ $assdok_now[0]->pemeriksaan_fisik }}
@else
@if (count($last_assdok) > 0) {{ $last_assdok[0]->pemeriksaan_fisik }} @endif @endif
</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1"> Diagnosis Medis ( ICD 10) </label>
            <input type="email" class="form-control" id="diagnosaprimer" name="diagnosaprimer" placeholder="name@example.com"
                value="@if (count($assdok_now) > 0) {{ $assdok_now[0]->diagnosakerja }} @else @if (count($last_assdok) > 0) {{ $last_assdok[0]->diagnosakerja }} @endif @endif">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1"> Diagnosis Fungsi ( ICD 10) </label>
            <input type="email" class="form-control" id="diagnosabanding" name="diagnosabanding" placeholder="name@example.com"
                value=" @if (count($assdok_now) > 0) {{ $assdok_now[0]->diagnosabanding }} @else @if (count($last_assdok) > 0) {{ $last_assdok[0]->diagnosabanding }} @endif @endif">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Pemeriksaan penunjang</label>
            <textarea class="form-control" id="pemeriksaanpenunjang" name="pemeriksaanpenunjang" rows="3"> @if (count($assdok_now) > 0) {{ $assdok_now[0]->rencanakerja }}
@else
@if (count($last_assdok) > 0) {{ $last_assdok[0]->rencanakerja }} @endif @endif
</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Anjuran</label>
            <textarea class="form-control" id="anjuran" name="anjuran" rows="3"> @if (count($assdok_now) > 0) {{ $assdok_now[0]->anjuran }}
@else
@if (count($last_assdok) > 0) {{ $last_assdok[0]->anjuran }} @endif @endif
</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Evaluasi</label>
            <textarea class="form-control" id="evaluasi" name="evaluasi" rows="3"> @if (count($assdok_now) > 0) {{ $assdok_now[0]->evaluasi }}
@else
@if (count($last_assdok) > 0) {{ $last_assdok[0]->evaluasi }} @endif @endif
</textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Suspek penyakit akibat kerja</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="suspekpenyakit" id="suspekpenyakit"
                    value="Ya" @if (count($assdok_now) > 0) @if ($assdok_now[0]->riwayatlain == 'Ya') Checked @endif
                @else @if (count($last_assdok) > 0) @if ($last_assdok[0]->riwayatlain == 'Ya') Checked @endif
                    @endif @endif>
                <label class="form-check-label" for="inlineRadio1">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="suspekpenyakit" id="suspekpenyakit"
                    value="Tidak" @if (count($assdok_now) > 0) @if ($assdok_now[0]->riwayatlain == 'Tidak') Checked @endif
            @else @if (count($last_assdok) > 0) @if ($last_assdok[0]->riwayatlain == 'Tidak') Checked @endif @else
                checked @endif @endif>
            <label class="form-check-label" for="inlineRadio2">Tidak</label>
        </div>
        <textarea class="form-control" id="keterangansuspek" name="keterangansuspek" rows="3"> @if (count($assdok_now) > 0) {{ $assdok_now[0]->ket_riwayatlain }}
@else
@if (count($last_assdok) > 0) {{ $last_assdok[0]->ket_riwayatlain }} @endif @endif
</textarea>
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
                        type="checkbox"
                        name="kontrol" id="kontrol" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Kontrol</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[2] == 1) checked @endif
                            @endif @endif class="form-check-input"
                        type="checkbox"
                        name="konsulpoli" id="konsulpoli" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Konsul Poli lain</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[3] == 1) checked @endif
                            @endif @endif class="form-check-input"
                        type="checkbox"
                        name="rawatinap" id="rawatinap" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Rawat Inap</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            @if (count($last_assdok) > 0) @if ($last_assdok[0]->versi == 2) @if ($tl[4] == 1) checked @endif
                            @endif @endif class="form-check-input"
                        type="checkbox"
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
</form>
