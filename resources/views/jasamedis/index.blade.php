@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Jasa Medis</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid v_utama">
                <div class="boxcari mb-3">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tglawal" aria-describedby="emailHelp" value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tglakhir" aria-describedby="emailHelp" value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" style="margin-top:32px" onclick="caridatakunjungan()"><i class="bi bi-search"></i> Cari Data</button>
                        </div>
                    </div>
                </div>
                <div class="vpasien">

                </div>
            </div>
            <div class="container-fluid v_kedua" hidden></div>
        </section>
        <script>
            function caridatakunjungan()
            {
                tglawal = $('#tglawal').val()
                tglakhir = $('#tglakhir').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tglawal,
                        tglakhir
                    },
                    url: '<?= route('ambildatatotalklaim') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.vpasien').html(response);
                    }
                });
            }
        </script>
    @endsection
