<div class="card">
    <div class="card-header">Formulir Program Rehabilitasi Medik</div>
    <div class="card-body">
        <button class="btn btn-success" data-toggle="modal" data-target="#formulirbaru">Buat Formulir Baru</button>
        <div class="card mt-2">
            <div class="card-header">Riwayat Formulir</div>
            <div class="card-body">
                <div class="v_riwayat_form">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <th>Tanggal Entry</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Diagnosa</th>
                            <th>Permintaan Terapi</th>
                            <th>Terapis</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($dataheader as $d)
                                <tr>
                                    <td>{{ $d->tglentry }}</td>
                                    <td>{{ $d->tglkunjungan }}</td>
                                    <td>{{ $d->diagnosa }}</td>
                                    <td>{{ $d->permintaanterapi }}</td>
                                    <td>{{ $d->nama_pic }}</td>
                                    <td>
                                        <button class="badge badge-success pilihheader" idheader="{{ $d->id }}"
                                            data-toggle="modal" data-target="#addprogram">+ program</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="formulirbaru" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulir Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="formprogram">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor RM</label>
                                <input readonly type="text" class="form-control" id="nomorrm" name="nomorrm"
                                    aria-describedby="emailHelp" value="{{ $mt_pasien[0]->no_rm }}">
                                <input readonly type="text" class="form-control" id="kodekunjungan"
                                    name="kodekunjungan" aria-describedby="emailHelp" value="{{ $kodekunjungan }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input readonly type="text" class="form-control" id="namapasien" name="namapasien"
                                    aria-describedby="emailHelp" value="{{ $mt_pasien[0]->nama_px }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Lahir</label>
                                <input readonly type="date" class="form-control" id="tanggallahir"
                                    name="tanggallahir" aria-describedby="emailHelp"
                                    value="{{ $mt_pasien[0]->tgl_lahir }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa</label>
                                <textarea type="email" rows="3" class="form-control" id="diagnosa" name="diagnosa"
                                    aria-describedby="emailHelp">{{ $diagnosa_kerja }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Permintaan Terapi</label>
                                <textarea type="text" rows="3" class="form-control" id="permintaanterapi" name="permintaanterapi"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanformrehab()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addprogram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="formaddprogram">
                    <div class="form-group">
                        <label for="exampleInputEmail1">id header</label>
                        <input type="text" rows="5" class="form-control" id="idheader" name="idheader"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal</label>
                        <input type="date" rows="5" class="form-control" id="tanggalprogram" name="tanggalprogram"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Program</label>
                        <textarea type="email" rows="5" class="form-control" id="namaprogram" name="namaprogram"
                            aria-describedby="emailHelp"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanformprogram()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    function simpanformrehab() {
        var data = $('.formprogram').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanformrehab') ?>',
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
                    formprogramrehab()
                    $('#formulirbaru').modal('toggle');
                }
            }
        });
    }
    function simpanformprogram() {
        var data = $('.formaddprogram').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanformprogram') ?>',
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
                    formprogramrehab()
                    $('#formulirbaru').modal('toggle');
                }
            }
        });
    }
     $('.pilihheader').on('click', function() {
        idheader = $(this).attr('idheader')
        $('#idheader').val(idheader)
    });
</script>
