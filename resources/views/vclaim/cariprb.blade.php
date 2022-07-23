@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pencarian PRB</h1>
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
            <div class="card">
                <div class="card-body">
                    <h5 class="m-0">Cari berdasarkan nomor SRB dan SEP ...</h5>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row mt-3">
                                <div class="col-sm-5">
                                    <label for="exampleInputEmail1">Masukan Nomor SRB</label>
                                    <input type="text" class="form-control" id="nomorsrb"
                                        placeholder="Ketik nomor srb peserta ...">
                                </div>
                                <div class="col-sm-5">
                                    <label for="exampleInputEmail1">Masukan Nomor SEP</label>
                                    <input type="text" class="form-control" id="nomorsepsrb"
                                        placeholder="Ketik nomor sep ...">
                                </div>
                                <div class="col-sm-2 form-inline">
                                    <div class="form-group mt-4">
                                        <label for="exampleInputEmail1"></label>
                                        <button type="submit" class="btn btn-primary" onclick="vclaim_carisrb()"> <i
                                                class="bi bi-search-heart"></i> Cari </button>
                                    </div>
                                </div>
                            </div>
                            <h5 class="m-0 mt-3">Cari berdasarkan Tanggal...</h5>
                            <div class="row mt-3">
                                <div class="col-sm-5">
                                    <label for="exampleInputEmail1">Tanggal awal</label>
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tanggalawalcari"
                                        placeholder="Ketik nomor srb peserta ...">
                                </div>
                                <div class="col-sm-5">
                                    <label for="exampleInputEmail1">Tanggal akhir</label>
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tanggalakhircari"
                                        placeholder="Ketik nomor sep ...">
                                </div>
                                <div class="col-sm-2 form-inline">
                                    <div class="form-group mt-4">
                                        <label for="exampleInputEmail1"></label>
                                        <button type="submit" class="btn btn-primary" onclick="vclaim_carisrb_date()"> <i
                                                class="bi bi-search-heart"></i> Cari </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="viewsrb">
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="data-table-srb">
               
            </div>
        </div>        
    </section>
    <script>           
        function vclaim_carisrb()
        {           
            srb = $('#nomorsrb').val()
            sep = $('#nomorsepsrb').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    srb,
                    sep,
                },
                url: '<?= route('vclaimcarisrb') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.viewsrb').html(response);
                }
            });
        }
        function vclaim_carisrb_date()
        {           
            tglawal = $('#tanggalawalcari').val()
            tglakhir = $('#tanggalakhircari').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglawal,
                    tglakhir,
                },
                url: '<?= route('vclaimcarisrb_date') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.data-table-srb').html(response);
                }
            });
        }
    </script>
@endsection
