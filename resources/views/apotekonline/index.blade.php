@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Referensi DPHO</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Referensi DPHO</li>
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
            <button class="btn btn-success mb-3" onclick="getdata()"><i class="bi bi-cloud-plus"></i> Get Referensi</button>
            <div class="card">
                <div class="card-header">Data Referensi DPHO</div>
                <div class="card-body">
                    <div class="v_data">

                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                get_ref_dpho_lokal()
            });

            function get_ref_dpho_lokal() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan: $('#kodekunjungan').val()
                    },
                    url: '<?= route('ambilrefdpholokal') ?>',
                    error: function(data) {
                        alert('ok')
                    },
                    success: function(response) {
                        $('.v_data').html(response)
                        spinner.hide()
                    }
                });
            }

            function getdata() {
                Swal.fire({
                    title: "Anda yakin ?",
                    text: "Data referensi akan diperbaharui ...",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, download !"
                }).then((result) => {
                    if (result.isConfirmed) {
                        get_ref_dpho()
                    }
                });
            }

            function get_ref_dpho() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    url: '<?= route('downloadrefdpho') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.kode == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            get_ref_dpho_lokal()
                        }
                    }
                });
            }
        </script>
    @endsection
