@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert Rujukan Khusus</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route}}">Dashboard</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Pendaftaran</li> --}}
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Nomor Rujukan</div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Ketik Nomor Rujukan ..."
                                id="nomor_rujukan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Total Diagnosa</div>
                        <div class="col-sm-3">
                            {{-- <input type="text" class="form-control"> --}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Total Diagnosa ..."
                                    aria-label="Recipient's username" id="jlh_diagnosa" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="button" onclick="add_diagnosa()"><i
                                            class="bi bi-plus text-md"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Total Procedure</div>
                        <div class="col-sm-3">
                            {{-- <input type="text" class="form-control"> --}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="jlh_procedure"
                                    placeholder="Total Procedure ..." aria-label="Recipient's username"
                                    aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="button" id="button-addon2"
                                        onclick="add_procedure()"><i class="bi bi-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-rujukan-khusus">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_diagnosa">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form_procedure">

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger float-right ml-1"><i class="bi bi-x-square"></i>  batal</button>
                        <button class="btn btn-primary float-right" onclick="simpanrujukan_khusus()"><i class="bi bi-sd-card"></i> simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        function add_diagnosa() {
            jumlah_diagnosa = $('#jlh_diagnosa').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    jumlah_diagnosa
                },
                url: '<?= route('vclaimambil_formdiagnosa') ?>',
                error: function(data) {
                    alert('error!')
                },
                success: function(response) {
                    $('.form_diagnosa').html(response);
                }
            });
        }

        function add_procedure() {
            jumlah_procedure = $('#jlh_procedure').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    jumlah_procedure
                },
                url: '<?= route('vclaimambil_formprocedure') ?>',
                error: function(data) {
                    alert('error!')
                },
                success: function(response) {
                    $('.form_procedure').html(response);
                }
            });
        }

        function simpanrujukan_khusus() {
            rujukan = $('#nomor_rujukan').val()
            jlhdiag = $('#jlh_diagnosa').val()
            jlhproc = $('#jlh_procedure').val()
            s1 = $('#s_diag1').val()
            s2 = $('#s_diag2').val()
            s3 = $('#s_diag3').val()
            s4 = $('#s_diag4').val()
            s5 = $('#s_diag5').val()
            diag1 = $('#kodediag_rk1').val()
            diag2 = $('#kodediag_rk2').val()
            diag3 = $('#kodediag_rk3').val()
            diag4 = $('#kodediag_rk4').val()
            diag5 = $('#kodediag_rk5').val()
            proc1 = $('#kdproc1').val()
            proc2 = $('#kdproc2').val()
            proc3 = $('#kdproc3').val()
            proc4 = $('#kdproc4').val()
            proc5 = $('#kdproc5').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rujukan,
                    jlhdiag,
                    jlhproc,
                    s1,
                    s2,
                    s3,
                    s4,
                    s5,
                    diag1,
                    diag2,
                    diag3,
                    diag4,
                    diag5,
                    proc1,
                    proc2,
                    proc3,
                    proc4,
                    proc5
                },
                url: '<?= route('vclaimsimpan_rujukankhusus') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Rujukan khusus Berhasil dibuat !',
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                        })
                    }
                }
            });
        }
    </script>
@endsection
