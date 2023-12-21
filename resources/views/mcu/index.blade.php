@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Data Pasien MCU</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalheader">+ Add Header
                    Surat</button>
                <div class="vpasien">

                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalheader" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Header Surat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="formheadersurat">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor RM</label>
                                        <input type="text" class="form-control" id="nomorrm" name="nomorrm"
                                            aria-describedby="emailHelp">
                                        <input hidden type="text" class="form-control" id="nomorrm2" name="nomorrm2"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nama Pasien</label>
                                        <input type="text" class="form-control" id="namapasien" name="namapasien">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Pekerjaan</label>
                                        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tinggi Badan</label>
                                        <input type="text" class="form-control" id="tinggi badan" name="tinggibadan">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Berat Badan</label>
                                        <input type="text" class="form-control" id="beratbadan" name="beratbadan">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tekanan Darah</label>
                                        <input type="text" class="form-control" id="tekanandarah" name="tekanandarah">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="simpanheader()">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <script>
              $(document).ready(function() {
                ambildataheader()
            });

            function ambildataheader() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambildataheader_mcu') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vpasien').html(response);
                    }
                });
            }
            function simpanheader() {
                spinner = $('#loader')
                spinner.show();
                var data = $('.formheadersurat').serializeArray();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                    },
                    url: '<?= route('simpanheader') ?>',
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
                            location_reload()
                        }
                    }
                });
            }
            $(document).ready(function() {
                $('#nomorrm').autocomplete(
                    {
                    source: "<?= route('caripasien_mcu') ?>",
                    select: function(event, ui) {
                        $('[id="nomorrm"]').val(ui.item.label);
                        $('[id="nomorrm2"]').val(ui.item.rm);
                        $('[id="namapasien"]').val(ui.item.nama);
                    }
                });
            });
        </script>
    @endsection
