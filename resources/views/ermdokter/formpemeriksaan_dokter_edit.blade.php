<div class="card">
    <div class="card-header bg-info">Assesmen Awal Medis</div>
    <div class="card-body">
        <form action="" class="formpemeriksaandokter">
            <input hidden type="text" name="kodekunjungan" class="form-control"
                value="{{ $kunjungan[0]->kode_kunjungan }}">
            <input hidden type="text" name="counter" class="form-control" value="{{ $kunjungan[0]->counter }}">
            <input hidden type="text" name="unit" class="form-control" value="{{ $kunjungan[0]->kode_unit }}">
            <input hidden type="text" name="nomorrm" class="form-control" value="{{ $kunjungan[0]->no_rm }}">
            <input hidden type="text" name="idasskep" class="form-control" value="{{ $resume_perawat[0]->id }}">
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
                                value="Pasien Sendiri" @if ($resume[0]->sumber_data == 'Pasien Sendiri') checked @endif>
                            <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                value="Keluarga" @if ($resume[0]->sumber_data == 'Keluarga') checked @endif>
                            <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Keluhan Utama</td>
                    <td colspan="3">
                        <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ...">
                            {{ $resume[0]->keluhan_pasien }}
                        </textarea>
                    </td>
                </tr>
            </table>
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
                                    aria-describedby="basic-addon2" value="{{ $resume[0]->tekanan_darah }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">mmHg</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Frekuensi nadi pasien ..."
                                    id="frekuensinadi" name="frekuensinadi" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" value="{{ $resume[0]->frekuensi_nadi }}">
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
                                <input type="text" class="form-control" placeholder="Frekuensi Nafas Pasien ..."
                                    name="frekuensinafas" id="frekuensinafas" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" value="{{ $resume[0]->frekuensi_nafas }}">
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
                                    aria-describedby="basic-addon2" value="{{ $resume[0]->suhu_tubuh }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">°C</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="bg-secondary">Riwayat Kesehatan</td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Kehamilan (bagi pasien wanita) </td>
                        <td colspan="3">
                            <textarea name="riwayatkehamilan" cols="10" rows="4" class="form-control">{{ $resume[0]->riwayat_kehamilan_pasien_wanita }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Kelahiran (bagi pasien anak) </td>
                        <td colspan="3">
                            <textarea name="riwayatkelahiran" cols="10" rows="4" class="form-control">{{ $resume[0]->riwyat_kelahiran_pasien_anak }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Penyakit Sekarang</td>
                        <td colspan="3">
                            <textarea name="riwayatpenyakitsekarang" cols="10" rows="4" class="form-control">{{ $resume[0]->riwyat_penyakit_sekarang }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Penyakit Dahulu</td>
                        <td colspan="3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->hipertensi == 1) checked @endif type="checkbox" class="form-check-input" id="hipertensi"
                                            name="hipertensi" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->kencingmanis == 1) checked @endif type="checkbox" class="form-check-input" id="kencingmanis"
                                            name="kencingmanis" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->jantung == 1) checked @endif type="checkbox" class="form-check-input" id="jantung"
                                            name="jantung" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->stroke == 1) checked @endif type="checkbox" class="form-check-input" id="stroke"
                                            name="stroke" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->hepatitis == 1) checked @endif type="checkbox" class="form-check-input" id="hepatitis"
                                            name="hepatitis" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->asthma == 1) checked @endif type="checkbox" class="form-check-input" id="asthma"
                                            name="asthma" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->ginjal == 1) checked @endif type="checkbox" class="form-check-input" id="ginjal"
                                            name="ginjal" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input @if($resume[0]->tbparu == 1) checked @endif type="checkbox" class="form-check-input" id="tb"
                                            name="tb" value="1">
                                        <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="riwayatlain"
                                            name="riwayatlain" value="1">
                                        <label class="form-check-label" for="exampleCheck1">Lain-lain</label>
                                    </div>
                                </div>
                                <textarea name="ketriwayatlain" id="ketriwayatlain" class="form-control" placeholder="keterangan lain - lain">{{ $resume[0]->ket_riwayatlain }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Alergi</td>
                        <td colspan="3">
                            <div class="row">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input ml-2 mr-3" type="radio" name="alergi"
                                        id="alergi" value="Tidak Ada" checked>
                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mr-3" type="radio" name="alergi"
                                        id="alergi" value="Ada">
                                    <label class="form-check-label" for="inlineRadio2">Ada</label>
                                    <div class="form-group form-check">
                                        <input class="form-control" id="ketalergi" name="ketalergi"
                                            placeholder="keterangan alergi ..." value="{{ $resume[0]->keterangan_alergi }}">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Status Generalis</td>
                        <td>
                            <input type="text" class="form-control" name="statusgeneralis" id="statusgeneralis" value="{{ $resume[0]->statusgeneralis }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="bg-secondary">Pemeriksaan Umum</td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Keadaan Umum</td>
                        <td colspan="3">
                            <textarea class="form-control" name="keadaanumum">{{ $resume[0]->keadaanumum }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Kesadaran</td>
                        <td colspan="3">
                            <textarea class="form-control" name="kesadaran">{{ $resume[0]->kesadaran }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Diagnosa Kerja</td>
                        <td colspan="2">
                            <textarea name="diagnosakerja" class="form-control">{{ $resume[0]->diagnosakerja }}</textarea>
                        </td>
                        <td><button type="button" class="btn btn-warning showmodalicd" data-toggle="modal"
                                data-target="#modalicd">ICD 10</button>
                            <button type="button" class="btn btn-danger showmodalicd9" data-toggle="modal"
                                data-target="#modalicd9">ICD 9</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Diagnosa banding</td>
                        <td colspan="2">
                            <textarea name="diagnosabanding" class="form-control">{{ $resume[0]->diagnosabanding }}</textarea>
                        </td>
                        <td><button type="button" class="btn btn-warning showmodalicd" data-toggle="modal"
                                data-target="#modalicd">ICD 10</button>
                            <button type="button" class="btn btn-danger showmodalicd9" data-toggle="modal"
                                data-target="#modalicd9">ICD 9</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Rencana Kerja</td>
                        <td colspan="3">
                            <textarea class="form-control" name="rencanakerja">{{ $resume[0]->rencanakerja }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button type="button" class="btn btn-danger float-right ml-2">Batal</button>
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
        var data = $('.formpemeriksaandokter').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpemeriksaandokter') ?>',
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
