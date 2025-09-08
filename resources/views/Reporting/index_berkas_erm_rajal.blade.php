@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Berkas ERM Rawat Jalan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Berkas ERM Rawat Jalan</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="v_utama row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Cari Berdasarkan Nomor RM</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nomor RM</label>
                                    <input type="text" class="form-control" id="nomorrm">
                                    <small id="emailHelp" class="form-text text-muted">Masukan nomor RM Pasien ...</small>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="cariberkas()"><i
                                        class="bi bi-search"></i> Cari berkas</button>
                            </form>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>

            </div>
            <div hidden class="v_kedua mt-3">
                <button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace"></i> Kembali</button>
                <div class="v_datanya mt-3">

                </div>
            </div>
        </div>
        <script>
            function cariresep() {
                bulan = $('#bulan').val()
                tahun = $('#tahun').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        bulan,
                        tahun
                    },
                    url: '<?= route('ambildataeresep') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        spinner.hide()
                        $('.v_kedua').html(response);
                    }
                });
            }

            function cariberkas() {
                $('.v_kedua').removeAttr('hidden', true)
                $('.v_utama').attr('hidden', true)
                rm = $('#nomorrm').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        rm
                    },
                    url: '<?= route('ambilberkasermrajal') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        spinner.hide()
                        $('.v_datanya').html(response);
                    }
                });
            }

            function kembali() {
                $('.v_utama').removeAttr('hidden', true)
                $('.v_kedua').attr('hidden', true)
            }
        </script>
    @endsection
