@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kunjungan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Kunjungan</li>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggalawal" aria-describedby="emailHelp"
                                    value="{{ $oneweek }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggalakhir" aria-describedby="emailHelp"
                                    value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Kunjungan</label>
                                <select class="form-control" id="jeniskunjungan">
                                    <option value="1">Rawat Jalan</option>
                                    <option value="2">Rawat Inap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label><br>
                                <button class="btn btn-primary mt-2" onclick="carikunjunganfarmasi()"><i
                                        class="bi bi-search mr-2"></i>Cari Data</button>
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
            function carikunjunganfarmasi() {
                spinner = $('#loader')
                spinner.show();
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                jeniskunjungan = $('#jeniskunjungan').val()
                ambil_datakunjungan(tanggalawal, tanggalakhir, jeniskunjungan)
            }

            function ambil_datakunjungan(tanggalawal, tanggalakhir, jeniskunjungan) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggalawal,
                        tanggalakhir,
                        jeniskunjungan
                    },
                    url: '<?= route('cari_data_kunjungan_farmasi') ?>',
                    success: function(response) {
                        $('.v_t_r').html(response);
                        spinner.hide()
                    }
                });
            }

            function Kembaliawal() {
                $(".form-awal-cari-resep").removeAttr('Hidden', true)
                $(".form-awal-detail-resep").attr('Hidden', true)
            }
            $(document).ready(function() {
                spinner = $('#loader')
                spinner.show();
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                jeniskunjungan = $('#jeniskunjungan').val()
                ambil_datakunjungan(tanggalawal, tanggalakhir, jeniskunjungan)
            });
        </script>
    @endsection
