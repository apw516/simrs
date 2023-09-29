@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kartu Stok</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Kartu Stok</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid form-awal-cari-resep">
            <div class="row form-awal-cari-resep">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggalawal" aria-describedby="emailHelp"
                                    value="{{ $oneweek }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggalakhir" aria-describedby="emailHelp"
                                    value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label><br>
                                <button class="btn btn-primary mt-2" onclick="caristok()"><i class="bi bi-search mr-2"></i>Lihat Stok</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="v_t_r">

                    </div>
                </div>
            </div>
        </div>
        <script>
            function cariresepbydate(){
                spinner = $('#loader')
                spinner.show();
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                ambil_riwayat_resep(tanggalawal, tanggalakhir)
            }
            function caristok()
            {
                spinner = $('#loader')
                spinner.show();
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                ambil_kartu_stok(tanggalawal, tanggalakhir)
            }
            function ambil_kartu_stok(tanggalawal, tanggalakhir) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggalawal,
                        tanggalakhir
                    },
                    url: '<?= route('ambil_kartu_stok') ?>',
                    success: function(response) {
                        $('.v_t_r').html(response);
                        spinner.hide()
                    }
                });
            }
            function Kembaliawal()
            {
                $(".form-awal-cari-resep").removeAttr('Hidden',true)
                $(".form-awal-detail-resep").attr('Hidden',true)
            }
            $(document).ready(function() {
                spinner = $('#loader')
                spinner.show();
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                ambil_kartu_stok(tanggalawal, tanggalakhir)
            });
        </script>
    @endsection
