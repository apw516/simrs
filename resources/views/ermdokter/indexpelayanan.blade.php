@extends('ermtemplate.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Riwayat Pemeriksaan</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <form class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Tanggal awal</label>
                        <input type="date" class="form-control" id="tglawal" placeholder="Tanggal Awal ...">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Tanggal akhir</label>
                        <input type="date" class="form-control" id="tglakhir" placeholder="Tanggal Akhir ...">
                    </div>
                    <button type="button" class="btn btn-primary mb-2" onclick="caririwayat()">Cari Riwayat</button>
                </form>
                <div class="vriwayat">

                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                ambilriwayat()
            });
            function caririwayat()
            {
                tanggalawal = $('#tglawal').val()
                tanggalakhir = $('#tglakhir').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggalawal,
                        tanggalakhir
                    },
                    url: '<?= route('ambilriwayat_pasien_cari') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vriwayat').html(response);
                    }
                });
            }
            function ambilriwayat() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambilriwayat_pasien') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vriwayat').html(response);
                    }
                });
            }
        </script>
    @endsection
