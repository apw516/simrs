<div class="card">
    <div class="card-header bg-info">Catatan Perkembangan Pasien Terintegrasi</div>
    <div class="card-body">
        <form class="formpemeriksaan_fisio">
            <input hidden type="text" name="kodekunjungan" id="kodekunjungan" class="form-control"
                value="{{ $kunjungan[0]->kode_kunjungan }}">
            <input hidden type="text" name="counter" id="counter" class="form-control" value="{{ $kunjungan[0]->counter }}">
            <input hidden type="text" name="unit" id="unit" class="form-control" value="{{ $kunjungan[0]->kode_unit }}">
            <input hidden type="text" name="nomorrm" id="nomorrm" class="form-control" value="{{ $kunjungan[0]->no_rm }}">
            @if(count($last_assdok) > 0)
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
                                    aria-describedby="basic-addon2" value="{{ $last_assdok[0]->tekanan_darah }}">
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
                                    aria-describedby="basic-addon2" value="{{ $last_assdok[0]->frekuensi_nadi }}">
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
                                    aria-describedby="basic-addon2"
                                    value="{{ $last_assdok[0]->frekuensi_nafas }}">
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
                                    aria-describedby="basic-addon2" value="{{ $last_assdok[0]->suhu_tubuh }}">
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
                                    aria-describedby="basic-addon2" value="{{ $last_assdok[0]->beratbadan }}">
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
                                    aria-describedby="basic-addon2" value="{{ $last_assdok[0]->umur }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Keluhan Utama</td>
                        <td colspan="3">
                            <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ...">{{ $last_assdok[0]->keluhan_pasien }}</textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
                <div class="form-group">
                    <label for="exampleInputEmail1">Anamnesa</label>
                    <textarea type="text" class="form-control" id="anamnesa" name="anamnesa" rows="5"
                        aria-describedby="emailHelp">{{ $last_assdok[0]->anamnesa }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Pemeriksaan Fisik dan Uji Fungsi</label>
                    <textarea type="password" class="form-control" id="pemeriksaanfisik" name="pemeriksaanfisik" rows="4">{{ $last_assdok[0]->pemeriksaan_fisik }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Diagnosis Medis ( ICD 10)</label>
                    <input type="text" class="form-control" id="diagnosismedis" name="diagnosismedis"
                        rows="4" value="{{ $last_assdok[0]->diagnosakerja }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Diagnosis fungsi ( ICD 10)</label>
                    <input type="texrt" class="form-control" id="diagnosisfungsi" name="diagnosisfungsi"
                        rows="4" value="{{ $last_assdok[0]->diagnosabanding }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Pemeriksaan Penunjang</label>
                    <textarea type="text" class="form-control" id="pemeriksaanpenunjang" name="pemeriksaanpenunjang"
                        rows="4">{{ $last_assdok[0]->rencanakerja }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tata Laksana KFR ( ICD 9CM )</label>
                    <textarea type="password" class="form-control" id="tatalaksankfr" name="tatalaksankfr" rows="4">{{ $last_assdok[0]->tatalaksana_kfr }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Anjuran</label>
                    <textarea type="password" class="form-control" id="anjuran" name="anjuran" rows="2">{{ $last_assdok[0]->anjuran }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Evaluasi</label>
                    <textarea type="password" class="form-control" id="evaluasi" name="evaluasi" rows="2">{{ $last_assdok[0]->evaluasi }}</textarea>
                </div>
                <fieldset class="form-group row">
                    <legend class="col-form-label col-sm-4 float-sm-left pt-0">Suspek Penyakit Akibat Kerja</legend>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="supekpenyakit" id="supekpenyakit"
                                value="Ya" @if($last_assdok[0]->riwayatlain =='Ya')checked @endif>
                            <label class="form-check-label" for="gridRadios1">
                                Ya
                            </label>
                            <input type="text" class="form-control form-control-sm" id="keterangansuspek"
                                name="keterangansuspek" value="{{ $last_assdok[0]->ket_riwayatlain }}">
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="radio" name="supekpenyakit" id="supekpenyakit"
                                value="Tidak" @if($last_assdok[0]->riwayatlain =='Tidak')checked @endif>
                            <label class="form-check-label" for="gridRadios2">
                                Tidak
                            </label>
                        </div>
                    </div>
                </fieldset>
        </form>
        <button type="button" class="btn btn-danger float-right ml-1" onclick="simpanhasil()">Batal</button>
        <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
    </div>
</div>
<script>
    function simpanhasil() {
        var data = $('.formpemeriksaan_fisio').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        var counter = $('#counter').val()
        var unit = $('#unit').val()
        var nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan,
                counter,
                unit,
                nomorrm
            },
            url: '<?= route('simpanpemeriksaandokter_fisio') ?>',
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
</script>
