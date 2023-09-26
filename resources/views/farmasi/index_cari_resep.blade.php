@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cari Resep</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Cari Resep</li>
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
                                <button class="btn btn-primary mt-2" onclick="cariresepbydate()"><i class="bi bi-search mr-2"></i>Cari Resep</button>
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
        <div hidden class="container-fluid form-awal-detail-resep">
            <div class="col-md-12">
                <button class="btn btn-danger" onclick="Kembaliawal()">Kembali</button>
                <div class="view_detail_resep">

                </div>
            </div>
        </div>
        <script>
            // var input1 = document.getElementById("cari_rm");
            // input1.addEventListener("keypress", function(event) {
            //     if (event.key === "Enter") {
            //         event.preventDefault();
            //         document.getElementById("myBtncaripx").click();
            //     }
            // });
            function cariresepbydate(){
                spinner = $('#loader')
                spinner.show();
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                ambil_riwayat_resep(tanggalawal, tanggalakhir)
            }
            function ambil_riwayat_resep(tanggalawal, tanggalakhir) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggalawal,
                        tanggalakhir
                    },
                    url: '<?= route('cari_riwayat_resep') ?>',
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
                ambil_riwayat_resep(tanggalawal, tanggalakhir)
            });
        </script>
    @endsection
