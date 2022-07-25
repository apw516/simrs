@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">History Pelayanan Peserta</h1>
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
            <div class="row mt-3">
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Nomor Kartu</label>
                    <input type="text" class="form-control"
                        id="nomorkartu_peserta">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal Awal</label>
                    <input type="text " data-date-format="yyyy-mm-dd" class="form-control datepicker" id="tanggalawal">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal Akhir</label>
                    <input type="text " data-date-format="yyyy-mm-dd" class="form-control datepicker" id="tanggalakhir">
                </div>

                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_caririwayatpeserta()"> <i
                                class="bi bi-search-heart"></i> Cari </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_riwayatpeserta">

            </div>
        </div>
    </section>
    <script>
        function vclaim_caririwayatpeserta() {
            nomorkartu_peserta = $('#nomorkartu_peserta').val()
            tanggalawal = $('#tanggalawal').val()
            tanggalakhir = $('#tanggalakhir').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorkartu_peserta,
                    tanggalawal,
                    tanggalakhir
                },
                url: '<?= route('vclaimcaririwayatpeserta') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_riwayatpeserta').html(response);
                }
            });
        }
    </script>
@endsection
