@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Layanan Resep</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Layanan Resep</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"><i
                                            class="bi bi-list-ul ml-1 mr-2"></i>Data Order</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><i
                                            class="bi bi-search ml-1 mr-2"></i>Cari Pasien</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <div class="v_o_f">

                                            </div>
                                            {{-- <table class="table table-sm table-bordered">
                                                <thead>
                                                    <th>Nomor RM</th>
                                                    <th>Asal Unit</th>
                                                    <th>Dokter Pengirim</th>
                                                    <th>Status</th>
                                                </thead>
                                            </table> --}}
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">
                                            <form class="form-inline">
                                                <div class="form-group mx-sm-3 mb-2">
                                                    <label for="inputPassword2" class="sr-only">Nomor RM</label>
                                                    <input type="text" class="form-control" id="cari_rm" name="cari_rm"
                                                        placeholder="Nomor RM">
                                                </div>
                                                <button type="button" class="btn btn-success mb-2" id="myBtncaripx"
                                                    onclick="caripasien_far()"><i class="bi bi-search ml-1 mr-2"></i>Cari
                                                    Pasien</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="data_pasien_pencarian">

                    </div>
                </div>
            </div>
        </div>
        <script>
            var input1 = document.getElementById("cari_rm");
            input1.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("myBtncaripx").click();
                }
            });
            function caripasien_far() {
                rm = $('#cari_rm').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        rm
                    },
                    url: '<?= route('ambil_data_pasien_far') ?>',
                    success: function(response) {
                        $('.data_pasien_pencarian').html(response);
                        spinner.hide()
                    }
                });
            }
            function ambil_data_order()
            {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    url: '<?= route('ambil_data_order') ?>',
                    success: function(response) {
                        $('.v_o_f').html(response);
                        spinner.hide()
                    }
                });
            }

            $(document).ready(function() {
                spinner = $('#loader')
                spinner.show();
                ambil_data_order()
            });
        </script>
    @endsection
