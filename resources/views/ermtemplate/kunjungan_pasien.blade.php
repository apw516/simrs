@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Scan RM Pasien Poli / Kunjungan</h1>
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
                            <input type="date" class="form-control" id="tglawal" placeholder="Password"
                                value="{{ $now }}">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only"></label>
                            <input type="date" class="form-control" id="tglakhir" placeholder="Password"
                                value="{{ $now }}">
                        </div>
                        <div class="form-group mx-sm-4 mb-2">
                            <label for="inputPassword2" class="sr-only"></label>
                            <select class="form-control" id="pilihunit" name="pilihunit">
                                <option value="">--</option>
                                @foreach ($mt_unit as $u )
                                <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary mb-2" onclick="caripasien_kunjungan()">Cari</button>
                    </form>
                </div>
                <div class="vberkaserm">

                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                ambildatapasien_hari_ini()
            });

            function ambildatapasien_hari_ini() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambil_kunjungan_hari_ini') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vberkaserm').html(response);
                    }
                });
            }

            function caripasien_kunjungan() {
                spinner = $('#loader')
                spinner.show();
                tglawal = $('#tglawal').val()
                tglakhir = $('#tglakhir').val()
                pilihunit = $('#pilihunit').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tglawal,tglakhir,
                        pilihunit
                    },
                    url: '<?= route('ambil_kunjungan_hari_ini') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vberkaserm').html(response);
                    }
                });
            }
        </script>
    @endsection
