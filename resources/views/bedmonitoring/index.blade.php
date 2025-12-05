@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bridging Bed Monitoring</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bridging Bed Monitoring</li>
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
            <button class="btn btn-success" onclick="getruangan()"><i class="bi bi-bullseye"></i> Get
                Ruangan</button>
        </div>
        <div class="card mt-2">
            <div class="card-header">Data Ruangan</div>
            <div class="card-body">
                <div class="v_t_r">

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                ambildataruangan()
            });

            function getruangan() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('get_ruangan_for_brid') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        $('.v_t_r').html(response);
                        spinner.hide()
                        ambildataruangan()

                    }
                });
            }

            function ambildataruangan() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambildataruangan') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        $('.v_t_r').html(response);
                        spinner.hide()
                    }
                });
            }
        </script>
    @endsection
