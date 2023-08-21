<div class="card">
    <div class="card-header bg-warning">FORM MONITORING DARAH</div>
    <div class="card-body">
        <div class="row">
            {{-- <button class="btn btn-success mb-2"><i class="bi bi-journal-plus mr-2"></i> Form</button> --}}
            <div class="col-md-12">
                <button class="btn btn-success mb-2 btn-darah" data-toggle="modal" data-target="#modal_kantong_darah">+
                    Kantong Darah</button>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">Data Transfusi Darah</div>
                    <div class="card-body">
                        <div class="header_darah">
                            <table class="table table-sm table-bordered table-hover" id="tabel_riwayat_transfusi">
                                <thead>
                                    <th>Tanggal Transfusi</th>
                                    <th>Jenis Darah</th>
                                    <th>Diagnosa Klinis</th>
                                    <th>Nomor Kantong</th>
                                    <th>action</th>
                                </thead>
                                <tbody>
                                    @foreach ($datareaksi as $d)
                                        <tr class="pilikantongdarah">
                                            <td>{{ $d->tgl_transfusi }}</td>
                                            <td>{{ $d->Jenis_darah }}</td>
                                            <td>{{ $d->diag_klinis }}</td>
                                            <td>{{ $d->no_kantong }}</td>
                                            <td>
                                                <button class="badge badge-success">Reaksi</button>
                                                <button class="badge badge-warning isimon"
                                                    nomorkantong="{{ $d->no_kantong }}"
                                                    kodekunjungan="{{ $d->kode_kunjungan }}" id="{{ $d->idx }}"
                                                    isi="{{ $d->isi }}" jenis="{{ $d->Jenis_darah }}"
                                                    data-toggle="modal"
                                                    data-target="#modalmonitoring">Monitoring</button>
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
    </div>
</div>
<div class="card">
    <div class="card-header bg-warning">Hasil Monitoring Transfusi Darah</div>
    <div class="card-body">
        <div class="tabel_monitoring">
            @foreach ($datareaksi as $d )
                <div class="card">
                    <div class="card-header bg-secondary">Nomor Kantong {{ $d->no_kantong }}</div>
                    <div class="card-body">
                        <table class="table table-sm table-boredered">
                            <thead>
                                <th>Nomor Kantong</th>
                                <th>Isi ( ml )</th>
                                <th>Tgl Monitoring</th>
                                <th>Jam Monitoring</th>
                                <th>Tekanan Darah</th>
                                <th>Nadi</th>
                                <th>RR</th>
                                <th>S</th>
                                <th>Reakasi - / + </th>
                            </thead>
                            <tbody>
                                    @foreach ($datamonitoring as $dm)
                                    @if($dm->no_kantong == $d->no_kantong)
                                        <tr>
                                            <td>{{ $dm->no_kantong}}</td>
                                            <td>{{ $dm->isi}}</td>
                                            <td>{{ $dm->tgl_monitoring}}</td>
                                            <td>{{ $dm->jam_monitoring}}</td>
                                            <td>{{ $dm->ttv_td}}</td>
                                            <td>{{ $dm->ttv_nadi}}</td>
                                            <td>{{ $dm->ttv_rr}}</td>
                                            <td>{{ $dm->ttv_s}}</td>
                                            <td>{{ $dm->reaksi}}</td>
                                        </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_kantong_darah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">+ Kantong Darah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-add_darah">
                    <input hidden type="text" class="form-control" value="{{ $kodekunjungan }}" name="kodekunjungan"
                        id="kodekunjungan">
                    <input hidden type="text" class="form-control" value="{{ $nomorrm }}" name="nomorrm"
                        id="nomorrm">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ruang Rawat</label>
                                    <select class="form-control" id="ruangrawat" name="ruangrawat">
                                        <option>1</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Transfusi</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Darah</label>
                                <input type="text" class="form-control" id="jenisdarah" name="jenisdarah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa Klinis</label>
                                <input type="text" class="form-control" id="diagnosaklinis" name="diagnosaklinis"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mulai Transfusi</label>
                                <input type="text" class="form-control" id="mulai_tf" name="mulai_tf"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Selesai Transfusi</label>
                                <input type="text" class="form-control" id="selesai_tf" name="selesai_tf"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Kantong Darah</label>
                                <input type="text" class="form-control" id="noka_darah" name="noka_darah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Isi ( ml )</label>
                                <input type="text" class="form-control" id="isi_darah" name="isi_darah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Volume yang sudah ditransfusi</label>
                                <input type="text" class="form-control" id="vol_tf" name="vol_tf"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpan_header_darah()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalmonitoring" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Monitoring Transfusi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-monitoring">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanmonitoring()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabel_riwayat_transfusi").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function simpan_header_darah() {
        var data = $('.form-add_darah').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpandarah') ?>',
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
                    $('#modal_kantong_darah').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }
    $(".isimon").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        nomorkantong = $(this).attr('nomorkantong')
        id = $(this).attr('id')
        isi = $(this).attr('isi')
        jenis = $(this).attr('jenis')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                nomorkantong,
                id,
                isi,
                jenis
            },
            url: '<?= route('ambilform_monitoring') ?>',
            success: function(response) {
                $('.form-monitoring').html(response);
            }
        });

    });

    function simpanmonitoring() {
        var data = $('.isi_form_monitoring').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpanmonitoring_darah') ?>',
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
                    $('#modalmonitoring').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }
</script>
