<div class="card">
    <div class="card-header bg-info">Catatan Perkembangan Pasien Terintegrasi @if ($kunjungan[0]->ref_kunjungan != '0')
        <button class="btn btn-warning ml-2" data-toggle="modal"
            data-target="#modalcatatankonsul"><i class="bi bi-eye mr-1"></i> Catatan Konsul</button>
    @endif</div>
    <div class="card-body">
        <form class="formpemeriksaan_fisio">
            <input hidden type="text" name="kodekunjungan" id="kodekunjungan" class="form-control"
                value="{{ $kunjungan[0]->kode_kunjungan }}">
            <input hidden type="text" name="counter" id="counter" class="form-control"
                value="{{ $kunjungan[0]->counter }}">
            <input hidden type="text" name="unit" id="unit" class="form-control"
                value="{{ $kunjungan[0]->kode_unit }}">
            <input hidden type="text" name="nomorrm" id="nomorrm" class="form-control"
                value="{{ $kunjungan[0]->no_rm }}">
            @if (count($resume_lain) > 0 && count($last_assdok) == 0)
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
                                        aria-describedby="basic-addon2" value="{{ $resume_lain[0]->tekanandarah }}">
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
                                        aria-describedby="basic-addon2" value="{{ $resume_lain[0]->frekuensinadi }}">
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
                                        aria-describedby="basic-addon2" value="{{ $resume_lain[0]->frekuensinapas }}">
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
                                        aria-describedby="basic-addon2" value="{{ $resume_lain[0]->suhutubuh }}">
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
                                        aria-describedby="basic-addon2" value="{{ $resume_lain[0]->beratbadan }}">
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
                                        aria-describedby="basic-addon2" value="{{ $resume_lain[0]->usia }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-bold font-italic">Keluhan Utama</td>
                            <td colspan="3">
                                <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ...">
                                    {{ $resume_lain[0]->keluhanutama }}
                                </textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @elseif(count($last_assdok) > 0)
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
                                    <input type="text" class="form-control"
                                        placeholder="Frekuensi nadi pasien ..." id="frekuensinadi"
                                        name="frekuensinadi" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2"
                                        value="{{ $last_assdok[0]->frekuensi_nadi }}">
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
                                        aria-describedby="basic-addon2" value="{{ $last_assdok[0]->umur }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2"></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
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
                                        aria-describedby="basic-addon2" value="">
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
                                        aria-describedby="basic-addon2" value="">
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
                                        aria-describedby="basic-addon2" value="">
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
                            <td class="text-bold font-italic">Keluhan Utama</td>
                            <td colspan="3">
                                <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ..."></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
            <div class="card">
                <div class="card-header text-bold bg-dark">LAYANAN FISIK DAN REHABILITASI</div>
                <div class="card-body">
                    @if (count($last_assdok) > 0)
                    <div class="form-group">
                        <label for="exampleInputEmail1">Anamnesa</label>
                        <textarea type="text" class="form-control" id="anamnesa" name="anamnesa" rows="5"
                            aria-describedby="emailHelp">{{ $last_assdok[0]->anamnesa }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pemeriksaan Fisik dan Uji Fungsi</label>
                        <textarea type="text" class="form-control" id="pemeriksaanfisik" name="pemeriksaanfisik" rows="4">{{ $last_assdok[0]->pemeriksaan_fisik }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosis Medis ( ICD 10)</label>
                        <input type="text" class="form-control" id="diagnosismedis" name="diagnosismedis"
                            rows="4" value="{{ $last_assdok[0]->diagnosakerja }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosis fungsi ( ICD 10)</label>
                        <input type="text" class="form-control" id="diagnosisfungsi" name="diagnosisfungsi"
                            rows="4" value="{{ $last_assdok[0]->diagnosabanding }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pemeriksaan Penunjang</label>
                        <textarea type="text" class="form-control" id="pemeriksaanpenunjang" name="pemeriksaanpenunjang" rows="4">{{ $last_assdok[0]->rencanakerja }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tata Laksana KFR ( ICD 9CM )</label>
                        <textarea type="text" class="form-control" id="tatalaksankfr" name="tatalaksankfr" rows="4">{{ $last_assdok[0]->tatalaksana_kfr }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Anjuran</label>
                        <textarea type="text" class="form-control" id="anjuran" name="anjuran" rows="2">{{ $last_assdok[0]->anjuran }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Evaluasi</label>
                        <textarea type="text" class="form-control" id="evaluasi" name="evaluasi" rows="2">{{ $last_assdok[0]->evaluasi }}</textarea>
                    </div>
                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-4 float-sm-left pt-0">Suspek Penyakit Akibat Kerja</legend>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="supekpenyakit" id="supekpenyakit"
                                    value="Ya" @if($last_assdok[0]->riwayatlain == 'Ya') checked @endif>
                                <label class="form-check-label" for="gridRadios1">
                                    Ya
                                </label>
                                <input type="text" class="form-control form-control-sm" id="keterangansuspek"
                                    name="keterangansuspek" value="{{ $last_assdok[0]->ket_riwayatlain }}">
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="supekpenyakit" id="supekpenyakit"
                                    value="Tidak" @if($last_assdok[0]->riwayatlain == 'Tidak') checked @endif>
                                <label class="form-check-label" for="gridRadios2">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </fieldset>
                @else
                    <div class="form-group">
                        <label for="exampleInputEmail1">Anamnesa</label>
                        <textarea type="text" class="form-control" id="anamnesa" name="anamnesa" rows="5"
                            aria-describedby="emailHelp"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pemeriksaan Fisik dan Uji Fungsi</label>
                        <textarea type="text" class="form-control" id="pemeriksaanfisik" name="pemeriksaanfisik" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosis Medis ( ICD 10)</label>
                        <input type="text" class="form-control" id="diagnosismedis" name="diagnosismedis"
                            rows="4">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosis fungsi ( ICD 10)</label>
                        <input type="text" class="form-control" id="diagnosisfungsi" name="diagnosisfungsi"
                            rows="4">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pemeriksaan Penunjang</label>
                        <textarea type="text" class="form-control" id="pemeriksaanpenunjang" name="pemeriksaanpenunjang" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tata Laksana KFR ( ICD 9CM )</label>
                        <textarea type="text" class="form-control" id="tatalaksankfr" name="tatalaksankfr" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Anjuran</label>
                        <textarea type="text" class="form-control" id="anjuran" name="anjuran" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Evaluasi</label>
                        <textarea type="text" class="form-control" id="evaluasi" name="evaluasi" rows="2"></textarea>
                    </div>
                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-4 float-sm-left pt-0">Suspek Penyakit Akibat Kerja</legend>
                        <div class="col-sm-8">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="supekpenyakit" id="supekpenyakit"
                                    value="Ya" checked>
                                <label class="form-check-label" for="gridRadios1">
                                    Ya
                                </label>
                                <input type="text" class="form-control form-control-sm" id="keterangansuspek"
                                    name="keterangansuspek">
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="supekpenyakit" id="supekpenyakit"
                                    value="Tidak">
                                <label class="form-check-label" for="gridRadios2">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </fieldset>
                @endif
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-header bg-light">Order Farmasi <button type="button"
                    class="btn btn-success float-right" data-toggle="modal" data-target="#modaltemplate"
                    onclick="ambilresep()">Template resep</button></div>
            <div class="card-body">
                <div class="form-group mt-2">
                    <button type="button" class="btn btn-success tambahobat" onclick="addform()">+ Tambah
                        Obat</button>
                </div>
                <input hidden type="text" value="" id="jumlahform">
                <form action="" method="post" class="arrayobat">
                    <div class="formobatfarmasi2">

                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="simpantemplate" onclick="showname()">
                        <label class="form-check-label" for="exampleCheck1">ceklis, untuk
                            simpan
                            resep sebagai template</label>
                    </div>
                    <input hidden type="text" class="form-control col-md-3 mb-3" id="namaresep" name="namaresep"
                        placeholder="isi nama resep ...">
                </form>
            </div>
        </div>
        <button type="button" class="btn btn-danger float-right ml-1" onclick="simpanhasil()">Batal</button>
        <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalcatatankonsul" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Konsul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="jumbotron">
                    <h1 class="display-4">Hello {{ auth()->user()->nama }} </h1><br>
                    <p class="lead">Dokter Pengirim : {{ $kunjungan[0]->dokter_kirim }}</p>
                    <p class="lead">Poliklinik Pengirim : {{ $kunjungan[0]->poli_asal }}</p>
                    <p class="lead">Mohon Konsul</p>
                    <p class="lead">Pasien dengan : <br>RM {{ $kunjungan[0]->no_rm }} |
                        {{ $kunjungan[0]->nama_pasien }} | {{ $kunjungan[0]->diagx }} <br><br>
                        Keterangan <br>
                        {{ $kunjungan[0]->keterangan3 }}
                    </p>
                    <hr class="my-4">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function simpanhasil() {
        var data = $('.formpemeriksaan_fisio').serializeArray();
        var data2 = $('.arrayobat').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        var counter = $('#counter').val()
        var unit = $('#unit').val()
        var nomorrm = $('#nomorrm').val()
        var simpantemplate = $('#simpantemplate:checked').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                dataobat: JSON.stringify(data2),
                kodekunjungan,
                counter,
                unit,
                nomorrm,
                simpantemplate
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
    function addform() {
        var max_fields = 10;
        var wrapper = $(".formobatfarmasi2"); //Fields wrapper
        var x = 1
        jlh = $('#jumlahform').val()
        cek = document.getElementById('jumlahform').value
        if (cek === '') {
            jlh1 = $('#jumlahform').val(1)
        } else {
            cek = parseInt(document.getElementById('jumlahform').value)
            jlh2 = $('#jumlahform').val(cek + 1)
        }
        nomor = parseInt(document.getElementById('jumlahform').value)
        if (x < max_fields) { //max input box allowed
            nama = 'namaobat'+nomor
            aturan = 'aturanpakai'+nomor
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Obat</label><input type="" class="form-control form-control-sm text-xs" id="'+nama+'" name="namaobat" value=""><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodebarang" value="""></div><div class="form-group col-md-2"><label for="inputPassword4">Aturan Pakai</label><input type="" class="form-control form-control-sm" id="'+ aturan +'" name="aturanpakai" value=""></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                kode = $(this).attr('kode2')
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
            // $('#'+nama).autocomplete({
            //     source: "<?= route('cariobat') ?>",
            //     select: function(event, ui) {
            //         $('[id="namaobat"]').val(ui.item.label);
            //         $('[id="'+aturan+'"]').val(ui.item.aturan);
            //     }
            // });
        }
    }
    function showname() {
        a = $('#simpantemplate:checked').val()
        if (a == 'on') {
            $('#namaresep').removeAttr('Hidden', true)
        } else {
            $('#namaresep').attr('Hidden', true)
        }
    }
</script>
