@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Finger SEP</h1>
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
                    <label for="exampleInputEmail1">Tanggal Pelayanan</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tanggalpelayanan"
                        placeholder="Tahun pencarian...">
                </div>
                {{-- <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal akhir pencarian</label>
                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tgl_akhir_cari_sep"
                        placeholder="Tanggal akhir pencarian">
                </div> --}}
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_carilistfinger()"> <i
                                class="bi bi-search-heart"></i> Tampilkan List </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-4">
            <div class="view_listfinger">

            </div>
        </div>
    </section>
    <script>
        function vclaim_carilistfinger() {
            tanggal = $('#tanggalpelayanan').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggal
                },
                url: '<?= route('vclaimlistfinger') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_listfinger').html(response);
                }
            });
        }
    </script>
@endsection
