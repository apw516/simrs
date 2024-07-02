@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Klaim</h1>
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
        <div class="container mb-5">
            <div class="row mt-3">
                <div class="col-sm-2">
                    <label for="exampleInputEmail1">Tanggal Awal</label>
                    <input type="text " data-date-format="yyyy-mm-dd" class="form-control datepicker" id="tanggalawal">
                </div>
                <div class="col-sm-2">
                    <label for="exampleInputEmail1">Tanggal Akhir</label>
                    <input type="text " data-date-format="yyyy-mm-dd" class="form-control datepicker" id="tanggalakhir">
                </div>
                <div class="col-sm-2">
                    <label for="exampleInputEmail1">Jenis Pelayanan</label>
                    <select class="form-control" id="jenislayan">
                        <option value="1">Rawat Inap</option>
                        <option value="2">Rawat Jalan</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="exampleInputEmail1">Status Klaim</label>
                    <select class="form-control" id="status">
                        <option value="1">Proses Verifikasi</option>
                        <option value="2">Pending Verifikasi</option>
                        <option value="3">Klaim</option>
                    </select>
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_dataklaim()"> <i
                                class="bi bi-search-heart"></i> Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="view_dataklaim">

            </div>
        </div>
    </section>
    <script>
        function vclaim_dataklaim() {
            tanggalawal = $('#tanggalawal').val()
            tanggalakhir = $('#tanggalakhir').val()
            jenislayan = $('#jenislayan').val()
            status = $('#status').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalawal,
                    tanggalakhir,
                    jenislayan,
                    status
                },
                url: '<?= route('vclaimcaridataklaim') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_dataklaim').html(response);
                }
            });
        }
    </script>
@endsection
