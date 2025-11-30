@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cari Berkas ERM</h1>
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
        <div class="container-fluid">
            <form class="form-inline">
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Password</label>
                    <input type="texts" class="form-control" id="nomorrm_cari" placeholder="Masukan nomor RM ...">
                </div>
                <button type="button" class="btn btn-primary mb-2" onclick="cariberkasnya()"><i
                        class="bi bi-search mr-2"></i>Cari Berkas</button>
            </form>
        </div>
        <div class="container-fluid">
            <div class="hasilcariberkas">

            </div>
        </div>
    </section>
    <script>
        function cariberkasnya() {
            spinner = $('#loader')
            spinner.show();
            rm = $('#nomorrm_cari').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm,
                },
                url: '<?= route('cariberkasnya_pasien') ?>',
                success: function(response) {
                    spinner.hide();
                    $('.hasilcariberkas').html(response);
                }
            });
        }
    </script>
@endsection
