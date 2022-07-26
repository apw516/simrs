@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
               
            </div>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert SEP</h1>
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
            <div class="row">
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="nomorrm_px" placeholder="nomor RM ..">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary mb-2" onclick="carikunjungan()"> <i
                            class="bi bi-search-heart"></i> Cari Pasien</button>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="vpasien_r">
                
            </div>
        </div>
        <div class="container">
            <div class="formpasien">

            </div>
        </div>
    </section>
   
    <script>
        function carikunjungan()
        {
            nomorrm = $('#nomorrm_px').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorrm
                },
                url: '<?= route('caririwayatkunjungan') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vpasien_r').html(response);
                }
            });
        }
    </script>
@endsection
