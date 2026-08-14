@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pasien Kronis</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pasien Kronis</li>
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
            <div class="v_1">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Filter Data Pasien Kronis
                        </h3>
                    </div>
                    <form action="" method="GET" id="form-filter">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tanggal Awal -->
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Awal</label>
                                        <input type="date" class="form-control" id="tanggalawal"
                                            aria-describedby="emailHelp" value="{{ $date }}">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Akhir</label>
                                        <input type="date" class="form-control" id="tanggalakhir"
                                            aria-describedby="emailHelp" value="{{ $date }}">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <button style="margin-top:32px" type="button" class="btn btn-primary" onclick="tampilkandata()">
                                        <i class="fas fa-search mr-1"></i> Tampilkan Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="v_data_pasien mt-2">
                        <div class="card">
                            <div class="card-header">Data Pasien Kronis</div>
                            <div class="card-body">
                                <div class="vd">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            tampilkandata()
        });

        function tampilkandata() {
            awal = $('#tanggalawal').val()
            akhir = $('#tanggalakhir').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    awal,
                    akhir
                },
                url: '<?= route('ambildatapasienkronis') ?>',
                error: function(response) {
                    alert('error!')
                    spinner.hide()
                },
                success: function(response) {
                    $('.vd').html(response);
                    spinner.hide()
                }
            });
        }

        function kembali() {
            $('.v_1').removeAttr('hidden', true)
            $('.v_2').attr('hidden', true)
        }

        function caripasien_far() {
            rm = $('#cari_rm').val()
            tanggalcari = $('#tanggalcari').val()
            poliklinik = $('#poliklinik').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm,
                    poliklinik,
                    tanggalcari
                },
                url: '<?= route('ambil_data_pasien_far') ?>',
                success: function(response) {
                    $('.v_t_pasien_poli').html(response);
                    spinner.hide()
                }
            });
        }
    </script>
@endsection
