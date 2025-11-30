@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Verifikasi Berkas TTE</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Verifikasi Berkas TTE</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid form-awal-cari-resep">
            <div class="v_log_data">

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            ambildata()
        });

        function ambildata() {
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambildataberkastte') ?>',
                success: function(response) {
                    $('.v_log_data').html(response);
                    spinner.hide()
                }
            });
        }
    </script>
@endsection
