@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Berkas Pasien</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Berkas Pasien</li>
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
                            <i class="fas fa-filter mr-1"></i> Filter Data Pasien 
                        </h3>
                    </div>
                    <form action="" method="GET" id="form-filter">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tanggal Awal -->
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nomor RM</label>
                                        <input type="text" class="form-control" id="nomorrm"
                                            aria-describedby="emailHelp" value="" placeholder="Masukan 8 Digit Nomor RM  ...">
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
                            <div class="card-header">Berkas Pasien</div>
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
            nomorrm = $('#nomorrm').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorrm
                },
                url: '<?= route('ambilberkaspasienlengkap') ?>',
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
