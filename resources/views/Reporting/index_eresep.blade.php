@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Berkas E - Resep</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Berkas E - Resep</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Bulan</label>
                        <select class="form-control" id="bulan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tahun</label>
                        <select class="form-control" id="tahun">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-info" style=margin-top:32px onclick="cariresep()" disabled><i
                            class="bi bi-search mr-1 ml-1"></i>Tampil</button>
                </div>
            </div>
            <div class="v_kedua mt-3">
                <div class="error-page">
                    <h2 class="headline text-danger">500</h2>

                    <div class="error-content">
                      <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Something went wrong.</h3>

                      <p>
                        We will work on fixing that right away.
                        Meanwhile, you may <a href="">return to dashboard</a> or try using the search form.
                      </p>
                    </div>
                  </div>
            </div>
        </div>
        <script>
            function cariresep() {
                bulan = $('#bulan').val()
                tahun = $('#tahun').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        bulan,tahun
                    },
                    url: '<?= route('ambildataeresep') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        spinner.hide()
                        $('.v_kedua').html(response);
                    }
                });
            }
        </script>
    @endsection
