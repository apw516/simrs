@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cari SEP</h1>
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
                    <label for="exampleInputEmail1">Nomor RM / Nomor BPJS</label>
                    <input type="text" class="form-control" id="nomorrm_sep"
                        placeholder="Ketik nomor rm / nomor kartu bpjs">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal awal pencarian</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_awal_cari_sep"
                        placeholder="Tanggal awal pencarian">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal akhir pencarian</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_akhir_cari_sep"
                        placeholder="Tanggal akhir pencarian">
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_carisep()"> <i
                                class="bi bi-search-heart"></i> Cari SEP </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_historysep">

            </div>
        </div>
    </section>
    <script>
        function vclaim_carisep() {
            tglawal = $('#tgl_awal_cari_sep').val()
            tglakhir = $('#tgl_akhir_cari_sep').val()
            nomorkartu = $('#nomorrm_sep').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglawal,
                    tglakhir,
                    nomorkartu
                },
                url: '<?= route('vclaimcarisep') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_historysep').html(response);
                }
            });
        }
    </script>
@endsection
