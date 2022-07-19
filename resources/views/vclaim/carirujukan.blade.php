@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cari Rujukan</h1>
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
                <div class="col-sm-5">
                    <label for="exampleInputEmail1">Nomor Rujukan / Nomor RM / Nomor BPJS</label>
                    <input type="text" class="form-control" id="nomorrujukanpencarian"
                        placeholder="Ketik nomor rujukan / nomor rm / nomor kartu bpjs">
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_carirujukan()"> <i
                                class="bi bi-search-heart"></i> Cari Rujukan </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_hasilpencarian">

            </div>
        </div>
    </section>
    <script>
        function vclaim_carirujukan() {
            nomorpencarian = $('#nomorrujukanpencarian').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorpencarian
                },
                url: '<?= route('vclaimcarirujukanpeserta') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_hasilpencarian').html(response);
                }
            });
        }
    </script>
@endsection
