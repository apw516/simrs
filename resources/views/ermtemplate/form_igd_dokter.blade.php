<div class="card">
    <div class="card-header bg-info">CPPT
        <button class="btn btn-warning ml-2" idrp="" data-toggle="modal"
            data-target="#modalresumeperawat"><i class="bi bi-eye mr-1"></i> Hasil Assesmen Keperawatan</button>
        {{-- <button class="btn btn-danger ml-2 lihathasilpenunjang_lab" nomorrm="" data-toggle="modal"
            data-target="#modalhasilpenunjang_lab"><i class="bi bi-eye mr-1"></i> Hasil Pemeriksaan Laboratorium</button>
        <button class="btn btn-danger ml-2 lihathasilpenunjang_rad" nomorrm="{{ $kunjungan[0]->no_rm }}" data-toggle="modal"
            data-target="#modalhasilpenunjang_rad"><i class="bi bi-eye mr-1"></i> Hasil Pemeriksaan Radiologi</button>
        @if ($kunjungan[0]->ref_kunjungan != '0')
            <button class="btn btn-warning ml-2" idrp="{{ $resume_perawat[0]->id }}" data-toggle="modal"
                data-target="#modalcatatankonsul"><i class="bi bi-eye mr-1"></i> Catatan Konsul</button>
        @endif --}}
    </div>
    <div class="card-body table-responsive p-5" style="height: 757Px">

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
                                            <textarea name="riwayatkehamilan" cols="10" rows="4" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Kelahiran (bagi pasien anak) </td>
                                        <td colspan="3">
                                            <textarea name="riwayatkelahiran" cols="10" rows="4" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Penyakit Sekarang</td>
                                        <td colspan="3">
                                            <textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Penyakit Dahulu</td>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="hipertensi"
                                                            name="hipertensi" value="1">
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Hipertensi</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="kencingmanis" name="kencingmanis" value="1">
                                                        <label class="form-check-label" for="exampleCheck1">Kencing
                                                            Manis</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="jantung"
                                                            name="jantung" value="1">
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Jantung</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="stroke"
                                                            name="stroke" value="1">
                                                        <label class="form-check-label"
                                                            for="exampleCheck1">Stroke</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="hepatitis"
                                                            name="hepatitis" value="1">
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
                                                            id="riwayatlain" name="riwayatlain" value="1">
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
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input ml-2 mr-3" type="radio"
                                                        name="alergi" id="alergi" value="Tidak Ada">
                                                    <label class="form-check-label" for="inlineRadio1">Tidak
                                                        Ada</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input mr-3" type="radio"
                                                        name="alergi" id="alergi" value="Ada">
                                                    <label class="form-check-label" for="inlineRadio2">Ada</label>
                                                    <div class="form-group form-check">
                                                        <input class="form-control" id="ketalergi" name="ketalergi"
                                                            placeholder="keterangan alergi ...">
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
                                                value="">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <input hidden type="text" name="kodekunjungan" class="form-control"
                    value="">
                <input hidden type="text" name="counter" class="form-control"
                    value="">
                <input hidden type="text" name="unit" class="form-control"
                    value="">
                <input hidden type="text" name="nomorrm" class="form-control"
                    value="">
                <input hidden type="text" name="idasskep" class="form-control"
                    value="">
                <table class="table">
                    <tr hidden>
                        <td class="text-bold font-italic">Tanggal Kunjungan</td>
                        <td><input readonly type="text" name="tanggalkunjungan" class="form-control"
                                value=""></td>
                        <td class="text-bold font-italic">Tanggal Assesmen</td>
                        <td><input type="text" name="tanggalassesmen" class="form-control datepicker"
                                data-date-format="yyyy-mm-dd"></td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Sumber Data</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                    value="Pasien Sendiri">
                                <label class="form-check-label" for="inlineRadio1">Pasien Sendiri /
                                    Autoanamase</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                    value="Keluarga">
                                <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Keluhan Utama</td>
                        <td colspan="3">
                            <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ..."></textarea>
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
                                        value="">
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
                                        value="">
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
                                        value="">
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
                                        aria-describedby="basic-addon2" value="">
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
                                    <input type="text" class="form-control" placeholder="Berat badan Pasien ..."
                                        name="beratbadan" id="beratbadan" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" value="">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">kg</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-bold font-italic">Umur</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Umur pasien ..."
                                        aria-label="Suhu tubuh pasien" name="usia" id="usia"
                                        aria-describedby="basic-addon2" value="">
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
                                <textarea class="form-control" rows="5" name="pemeriksaanfisik"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="bg-secondary">Pemeriksaan Umum</td>
                        </tr>
                        <tr hidden>
                            <td class="text-bold font-italic">Keadaan Umum</td>
                            <td colspan="3">
                                <textarea class="form-control" name="keadaanumum"></textarea>
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
                                <textarea name="diagnosakerja" id="diagnosakerja" class="form-control"></textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Diagnosa Sekunder</td>
                            <td colspan="2">
                                <textarea name="diagnosabanding" id="diagnosabanding" class="form-control"></textarea>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header text-bold bg-success">+ PLANNING ( P )</div>
            <div class="card-body">
                <form action="" class="form_pemeriksaan_4">
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td class="text-bold font-italic">Rencana Terapi</td>
                            <td colspan="3">
                                <textarea class="form-control" name="rencanakerja"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Tindakan Medis</td>
                            <td colspan="3">
                                <textarea class="form-control" name="tindakanmedis"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
        {{-- <form action="" class="formpemeriksaandokter">

        </form> --}}


        <button type="button" class="btn btn-danger float-right ml-2" onclick="batalisi()">Batal</button>
        <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
    </div>
</div>


<link rel="stylesheet" href="{{ asset('public/dist/css/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('public/dist/js/bootstrap-datepicker.js') }}"></script>

<script src="{{ asset('public/marker/markerjs2.js') }}"></script>
