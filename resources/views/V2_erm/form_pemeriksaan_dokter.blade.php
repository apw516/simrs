<style>
    div.ex3 {
        height: 550px;
        width: 100%;
        overflow-y: auto;
    }

    div.ex1 {
        height: 850px;
        width: 100%;
        overflow-y: auto;
    }
</style>
<input hidden type="text" value="{{ $nomorrm }}" id="nomormform">
<input hidden type="text" value="{{ $kodekunjungan }}" id="kodekunjungan">
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header bg-primary" id="headingOne" onclick="ambilriwayatkunjungan()">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-light text-bold" type="button"
                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="bi bi-plus"></i> CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
                </button>
            </h2>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body ex3">
                <div class="v_riwayat_kujungan">

                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="bi bi-plus"></i> ASSESMENT RAWAT JALAN
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
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
                                                    <label for="staticEmail" class="col-sm-5 col-form-label">Frekuensi
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
                                                    <label for="staticEmail" class="col-sm-5 col-form-label">Frekuensi
                                                        Nafas</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control-plaintext"
                                                                placeholder="Recipient's username"
                                                                aria-label="Recipient's username"
                                                                aria-describedby="basic-addon2" name="frekuensinafas"
                                                                id="frekuensinafas"
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
                                                    <label for="staticEmail" class="col-sm-5 col-form-label">BB / TB /
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
                    $tl = explode('|',$last_assdok[0]->tindak_lanjut);
                @endphp
            @endif
            <div class="card">
                <div class="card-header">Tindak Lanjut</div>
                <div class="card-body">
                    <div class="form-check form-check-inline">
                        <input @if(count($last_assdok) > 0) @if($last_assdok[0]->versi == 2) @if($tl[0] == 1) checked @endif @endif @endif class="form-check-input" type="checkbox" name="pulangsembuh" id="pulangsembuh" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Pulang / Sembuh</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input @if(count($last_assdok) > 0) @if($last_assdok[0]->versi == 2) @if($tl[1] == 1) checked @endif @endif @endif class="form-check-input" type="checkbox" name="kontrol" id="kontrol" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Kontrol</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input @if(count($last_assdok) > 0) @if($last_assdok[0]->versi == 2) @if($tl[2] == 1) checked @endif @endif @endif class="form-check-input" type="checkbox" name="konsulpoli" id="konsulpoli" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Konsul Poli lain</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input @if(count($last_assdok) > 0) @if($last_assdok[0]->versi == 2) @if($tl[3] == 1) checked @endif @endif @endif class="form-check-input" type="checkbox" name="rawatinap" id="rawatinap" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Rawat Inap</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input @if(count($last_assdok) > 0) @if($last_assdok[0]->versi == 2) @if($tl[4] == 1) checked @endif @endif @endif class="form-check-input" type="checkbox" name="rujukekluar" id="rujukekluar" value="1">
                        <label class="form-check-label" for="inlineCheckbox2">Rujuk Keluar</label>
                      </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group container">
                <label for="exampleFormControlTextarea1">Keterangan Tindak Lanjut</label>
                <textarea class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut" rows="3" placeholder="Ketik keterangan tindak lanjut ...">@if(count($last_assdok) > 0) @if($last_assdok[0]->versi == 2) {{$tl[5]}} @endif @endif</textarea>
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
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalobatreguler" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Obat Reguler </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-inline">
                    <div class="form-group mx-sm-5 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <input type="text" class="form-control" id="namaobatreguler"
                            placeholder="Masukan nama obat ...">
                    </div>
                    <button type="button" class="btn btn-primary mb-2" onclick="cariobatreguler()"><i
                            class="bi bi-search"></i> Cari Obat</button>
                </div>
                <div class="v_tabel_obat_reguler mt-3">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalobatracik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih komponen obat racik </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ex1">
                <div class="card">
                    <div class="card-header font-italic bg-light">Header Racikan</div>
                    <div class="card-body">
                        <form class="formheaderracikan">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Racikan</label>
                                <input type="email" class="form-control" id="namaracikan" name="namaracikan"
                                    placeholder="masukan nama racikan ...">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Jumlah Racikan</label>
                                        <input type="email" class="form-control" id="jumlahracikan"
                                            name="jumlahracikan" placeholder="Masukan jumlah racikan ...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Aturan Pakai</label>
                                        <textarea class="form-control" id="aturanpakairacikan" name="aturanpakairacikan" rows="3"
                                            placeholder="Masukan aturan pakai racikan ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipe Racikan</label>
                                        <select class="form-control" id="tiperacikan" name="tiperacikan">
                                            <option value="1">Powder</option>
                                            <option value="2">Non-Powder</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Kemasan</label>
                                        <select class="form-control" id="kemasanracikan" name="kemasanracikan">
                                            <option value="1">Kapsul</option>
                                            <option value="2">Kertas Perkamen</option>
                                            <option value="3">Pot Salep</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light">Komponen Obat Racik</div>
                    <div class="card-body">
                        <div class="form-inline">
                            <div class="form-group mx-sm-5 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" id="namakomponen"
                                    placeholder="Masukan nama obat ...">
                            </div>
                            <button type="button" class="btn btn-primary mb-2" onclick="carikomponenracikan()"><i
                                    class="bi bi-search"></i> Cari Obat</button>
                        </div>
                        <div class="v_tabel_obat_komponen mt-3">

                        </div>
                        <label for="" class="mt-2 mb-2">List Komponen Racikan</label>
                        <form action="" method="post" class="formlistkomponenracik">
                            <div class="field_komponen_racik" id="id_field">
                                <div id="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="simpanracikan()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="riwayatpemakaianobatmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Pemakaian Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ex1">
                <div class="v_r_ob">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="riwayatracikan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat racikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ex1">
                <div class="v_r_racikan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        riwayat_order_farmasi()
        riwayat_order_lab()
        riwayat_order_rad()
        riwayat_racikan()
        riwayat_pemakaian_obat()
        riwayat_tindakan()
    })
    $(function() {
        $("#tabel_pilih_layanan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(function() {
        $("#tabel_pilih_layanan_lab").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(function() {
        $("#tabel_pilih_layanan_rad").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(".pilihtindakan").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_tindakan"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    $(".pilihlayanan_lab").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_lab"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-6"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    $(".pilihlayanan_rad").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_rad"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-6"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });

    function simpanpemeriksaandokter() {
        var data = $('.formpemeriksaan').serializeArray();
        var data_order_farmasi = $('.formorderfarmasi').serializeArray();
        var data_billing_tindakan = $('.formbillingtindakan').serializeArray();
        var data_order_lab = $('.form_order_lab').serializeArray();
        var data_order_rad = $('.form_order_rad').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                data_order_farmasi: JSON.stringify(data_order_farmasi),
                data_order_lab: JSON.stringify(data_order_lab),
                data_order_rad: JSON.stringify(data_order_rad),
                data_billing_tindakan: JSON.stringify(data_billing_tindakan)
            },
            url: '<?= route('v2_simpanpemeriksaandokter') ?>',
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
                    document.getElementById('field_fix_1').innerHTML = "";
                    document.getElementById('field_fix_tindakan').innerHTML = "";
                    document.getElementById('field_fix_lab').innerHTML = "";
                    document.getElementById('field_fix_rad').innerHTML = "";
                    riwayat_order_farmasi()
                    riwayat_tindakan()
                    riwayat_order_lab()
                    riwayat_order_rad()
                }
            }
        });
    }

    function ambilriwayatkunjungan() {
        rm = $('#nomormform').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
            },
            url: '<?= route('v2_riwayatkunjungan') ?>',
            success: function(response) {
                $('.v_riwayat_kujungan').html(response);
            }
        });
    }

    function cariobatreguler() {
        nama = $('#namaobatreguler').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,
                kodekunjungan
            },
            url: '<?= route('v2_cari_obat_reguler') ?>',
            success: function(response) {
                $('.v_tabel_obat_reguler').html(response);
                spinner.hide()
            }
        });
    }

    function carikomponenracikan() {
        nama = $('#namakomponen').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,
                kodekunjungan
            },
            url: '<?= route('v2_cari_obat_komponen') ?>',
            success: function(response) {
                $('.v_tabel_obat_komponen').html(response);
                spinner.hide()
            }
        });
    }

    function simpanracikan() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data racikan akan disimpan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                var dataheader = $('.formheaderracikan').serializeArray();
                var datalist = $('.formlistkomponenracik').serializeArray();
                kodekunjungan = $('#kodekunjungan').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        dataheader: JSON.stringify(dataheader),
                        datalist: JSON.stringify(datalist),
                        kodekunjungan
                    },
                    url: '<?= route('v2_add_draft_komponen') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(response, data) {
                        spinner.hide()
                        var wrapper = $(".field_order_farmasi");
                        $('#modalobatracik').modal('hide');
                        document.getElementById('id_field').innerHTML = "";
                        $(wrapper).append(response);
                        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                            e.preventDefault();
                            $(this).parent('div').remove();
                            x--;
                        })
                    }
                });
            }
        });
    }

    function riwayat_order_farmasi() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_farmasi') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_order_farmasi').html(response);
            }
        });
    }

    function riwayat_order_lab() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_lab') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_order_lab').html(response);
            }
        });
    }

    function riwayat_order_rad() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_rad') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_order_rad_hari_ini').html(response);
            }
        });
    }

    function riwayat_tindakan() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_tindakan_Tdy') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_tindakan_tdy').html(response);
            }
        });
    }

    function riwayat_pemakaian_obat() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_pemakaian_obat') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_ob').html(response);
            }
        });
    }

    function riwayat_racikan() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_racikan') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_racikan').html(response);
            }
        });
    }
</script>
