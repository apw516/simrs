<div class="card">
    <div class="card-header bg-danger">Form Pemeriksaan Mata</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if (count($resume) > 0)
        <form action="" class="formmata">
        <input hidden type="text" class="form-control" id="idassesmen" value="{{ $resume[0]->id }}">
        <table class="table table-sm">
            <tr>
                <td colspan="4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gambar1">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gambar2">

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Visus Dasar</td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                            id="od_visus_dasar" name="od_visus_dasar" value="{{ $cek[0]->vd_od }}">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">PINHOLE</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                            name="od_pinhole_visus_dasar" id="od_pinhole_visus_dasar"
                            value="{{ $cek[0]->vd_od_pinhole }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS</span>
                        </div>
                        <input name="os_visus_dasar" id="os_visus_dasar" value="{{ $cek[0]->vd_os }}" type="text"
                            class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">PINHOLE</span>
                        </div>
                        <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text"
                            class="form-control" value="{{ $cek[0]->vd_os_pinhole }}"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Refraktometer / streak</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD : Sph</span>
                        </div>
                        <input name="od_sph_refraktometer" value="{{ $cek[0]->refraktometer_od_sph }}"
                            id="od_sph_refraktometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input type="text" value="{{ $cek[0]->refraktometer_od_cyl }}" id="od_cyl_refraktometer"
                            name="od_cyl_refraktometer" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="od_x_refraktometer" value="{{ $cek[0]->refraktometer_od_x }}"
                            name="od_x_refraktometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS : Sph</span>
                        </div>
                        <input id="os_sph_refraktometer" value="{{ $cek[0]->refraktometer_os_sph }}"
                            name="os_sph_refraktometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="os_cyl_refraktometer" value="{{ $cek[0]->refraktometer_os_cyl }}"
                            name="os_cyl_refraktometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="os_x_refraktometer" value="{{ $cek[0]->refraktometer_os_x }}"
                            name="os_x_refraktometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Lensometer</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OD : Sph</span>
                        </div>
                        <input id="od_sph_Lensometer" value="{{ $cek[0]->Lensometer_od_sph }}"
                            name="od_sph_Lensometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="od_cyl_Lensometer" value="{{ $cek[0]->Lensometer_od_cyl }}"
                            name="od_cyl_Lensometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="od_x_Lensometer" value="{{ $cek[0]->Lensometer_od_x }}" name="od_x_Lensometer"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">OS : Sph</span>
                        </div>
                        <input id="os_sph_Lensometer" value="{{ $cek[0]->Lensometer_os_sph }}"
                            name="os_sph_Lensometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="os_cyl_Lensometer" value="{{ $cek[0]->Lensometer_os_cyl }}"
                            name="os_cyl_Lensometer" type="text" class="form-control"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="os_x_Lensometer" value="{{ $cek[0]->Lensometer_os_x }}" name="os_x_Lensometer"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td rowspan="2">Koreksi penglihatan jauh</td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VOD : Sph</span>
                        </div>
                        <input id="vod_sph_kpj" value="{{ $cek[0]->koreksipenglihatan_vod_sph }}" name="vod_sph_kpj"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="vod_cyl_kpj" value="{{ $cek[0]->koreksipenglihatan_vod_cyl }}" name="vod_cyl_kpj"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="vod_x_kpj" value="{{ $cek[0]->koreksipenglihatan_vod_x }}" name="vod_x_kpj"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">VOS : Sph</span>
                        </div>
                        <input type="text" id="vos_sph_kpj" value="{{ $cek[0]->koreksipenglihatan_vos_sph }}"
                            name="vos_sph_kpj" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Cyl</span>
                        </div>
                        <input id="vos_cyl_kpj" value="{{ $cek[0]->koreksipenglihatan_vos_cyl }}" name="vos_cyl_kpj"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
                <td>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">X</span>
                        </div>
                        <input id="vos_x_kpj" value="{{ $cek[0]->koreksipenglihatan_vos_x }}" name="vos_x_kpj"
                            type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </td>
            </tr>
            <tr>
                <td>Tajam penglihatan dekat</td>
                <td colspan="3">
                    <textarea class="form-control" id="penglihatan_dekat" name="penglihatan_dekat">{{ $cek[0]->tajampenglihatandekat }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Tekanan Intra Okular</td>
                <td colspan="3">
                    <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $cek[0]->tekananintraokular }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Catatan Pemeriksaan Lainnya</td>
                <td colspan="3">
                    <textarea class="form-control" name="catatan_pemeriksaan_lainnya"
                        id="catatan_pemerikssaan_lainnya">{{ $cek[0]->catatanpemeriksaanlain }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Palpebra</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->palpebra }}" id="palpebra"
                        name="palpebra"></input></td>
            </tr>
            <tr>
                <td>Konjungtiva</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->konjungtiva }}" id="konjungtiva"
                        name="konjungtiva"></input></td>
            </tr>
            <tr>
                <td>Kornea</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->kornea }}" name="kornea"
                        id="kornea"></input></td>
            </tr>
            <tr>
                <td>Bilik Mata Depan</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->bilikmatadepan }}"
                        name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
            </tr>
            <tr>
                <td>Pupil</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->pupil }}" id="pupil"
                        name="pupil"></input></td>
            </tr>
            <tr>
                <td>Iris</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->iris }}" name="iris"
                        id="iris"></input></td>
            </tr>
            <tr>
                <td>Lensa</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->lensa }}" name="lensa"
                        id="lensa"></input></td>
            </tr>
            <tr>
                <td>Funduskopi</td>
                <td colspan="3"><input class="form-control" value="{{ $cek[0]->funduskopi }}" name="funduskopi"
                        id="funduskopi"></input></td>
            </tr>
            <tr>
                <td>Status Oftalmologis Khusus</td>
                <td colspan="3">
                    <textarea class="form-control" name="oftamologis" id="oftamologis">{{ $cek[0]->status_oftamologis_khusus }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Masalah Medis</td>
                <td colspan="3">
                    <textarea class="form-control" name="masalahmedis" id="masalahmedis">{{ $cek[0]->masalahmedis }}</textarea>
                </td>
            </tr>
            <tr>
                <td>Prognosis</td>
                <td colspan="3">
                    <textarea class="form-control" name="prognosis" id="prognosis">{{ $cek[0]->prognosis }}</textarea>
                </td>
            </tr>
        </table>
        <button type="button" class="btn btn-success float-right simpanpemeriksaan">Simpan</button>
        </form>
        @else
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...
            </h3>
            <p>
                Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
            </p>
        </div>
    @endif
    </div>
</div>
<script>
     $(document).ready(function() {
        ambilgambar1()
        ambilgambar2()

        function ambilgambar1() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('gambarmatakanan') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar1').html(response)
                }
            });
        }

        function ambilgambar2() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()

                },
                url: '<?= route('gambarmatakiri') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar2').html(response)
                }
            });
        }
    });
     $(".simpanpemeriksaan").click(function() {
        var canvas1 = document.getElementById("myCanvas1");
        var ctx1 = canvas1.getContext("2d");
        var img1 = document.getElementById("gambarnya1");
        ctx1.drawImage(img1, 10, 10);
        var dataUrl1 = canvas1.toDataURL();
        $('#matakanan').val(dataUrl1)
        matakanan = $('#matakanan').val()

        var canvas = document.getElementById("myCanvas2");
        var ctx = canvas.getContext("2d");
        var img = document.getElementById("gambarnya2");
        ctx.drawImage(img, 10, 10);
        var dataUrl = canvas.toDataURL();
        $('#matakiri').val(dataUrl)
        matakiri = $('#matakiri').val()
        var data = $('.formmata').serializeArray();

        var kodekunjungan = $('#kodekunjungan').val()
        var nomorrm = $('#nomorrm').val()
        var idassesmen = $('#idassesmen').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan: kodekunjungan,
                matakanan,
                matakiri,
                idassesmen,
                nomorrm
            },
            url: '<?= route('simpanformmata') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                console.log(data)
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: 'Data berhasil disimpan!',
                        footer: ''
                    })
                }
            }
        });
    })
</script>
