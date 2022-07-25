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
                    <label for="exampleInputEmail1">Tanggal SEP</label>
                    <input type="text" class="form-control datepicker" id="tanggalsep" data-date-format="yyyy-mm-dd">
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tanggal awal pencarian</label>
                    <select class="form-control" id="jenislayan">
                        <option value="1">Rawat Inap</option>
                        <option value="2">Rawat Jalan</option>
                    </select>
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_caridatakunjungan()"> <i
                                class="bi bi-search-heart"></i> Cari </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_datakunjungan">

            </div>
        </div>
    </section>
    <script>
        function vclaim_caridatakunjungan() {
            tanggalsep = $('#tanggalsep').val()
            jenislayan = $('#jenislayan').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalsep,
                    jenislayan
                },
                url: '<?= route('vclaimcaridatakunjungan') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_datakunjungan').html(response);
                }
            });
        }
    </script>
@endsection
