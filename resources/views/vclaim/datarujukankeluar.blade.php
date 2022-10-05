@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Rujukan Keluar RS</h1>
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
            <div class="row mt-3 mb-4">
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal awal pencarian</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_awal_cari_rujukan_keluar"
                        placeholder="Tanggal awal pencarian">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal akhir pencarian</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_akhir_cari_rujukan_keluar"
                        placeholder="Tanggal akhir pencarian">
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_carirujukan_keluar()"> <i
                                class="bi bi-search-heart"></i> Cari Rujukan Keluar </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_rujukan_keluar">

            </div>
        </div>
    </section>
    <script>
        function vclaim_carirujukan_keluar() {
            tglawal = $('#tgl_awal_cari_rujukan_keluar').val()
            tglakhir = $('#tgl_akhir_cari_rujukan_keluar').val()          
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglawal,
                    tglakhir
                },
                url: '<?= route('vclaimcarirujukankeluar') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_rujukan_keluar').html(response);
                }
            });
        }
    </script>
@endsection
