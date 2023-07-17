@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Berkas ERM</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="boxcari mb-3">
                    <form class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only"></label>
                            <input type="date" class="form-control" id="tglawal" placeholder="Password"  value="{{ $now }}">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <input type="date" class="form-control" id="tglakhir" placeholder="Password"  value="{{ $now }}">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" onclick="caripasien_erm()">Cari Pasien</button>
                    </form>
                </div>
                <div class="vberkaserm">

                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                ambildatapasien()
            });
            function ambildatapasien() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambil_berkas_erm') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vberkaserm').html(response);
                    }
                });
            }
            function caripasien_erm()
            {
                spinner = $('#loader')
                spinner.show();
                tglawal = $('#tglawal').val()
                tglakhir = $('#tglakhir').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tglawal,
                        tglakhir
                    },
                    url: '<?= route('ambil_berkas_erm') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vberkaserm').html(response);
                    }
                });
            }
        </script>
    @endsection
