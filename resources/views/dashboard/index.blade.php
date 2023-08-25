@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard SIMRS</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard SIMRS</li>
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
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-success">Data Kunjungan</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Pasien Rawat Jalan</strong>
                                      </p>
                                      <form class="form-inline mb-3">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="date" class="form-control" id="" name=""
                                                placeholder="Password" value="{{ $awal_bulan }}">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="date" class="form-control" id=""
                                                name="" placeholder="Password" value="{{ $now }}">
                                        </div>
                                        <button type="button" class="btn btn-primary mb-2"><i
                                                class="bi bi-eye mr-1 ml-1"></i>Tampil</button>
                                    </form>
                                      <div class="progress-group">
                                        Total Pasien
                                        <span class="float-right"><b>160</b>/200</span>
                                        <div class="progress progress-sm">
                                          <div class="progress-bar bg-primary" style="width: 80%"></div>
                                        </div>
                                      </div>
                                      <!-- /.progress-group -->

                                      <div class="progress-group">
                                          Pasien Umum
                                        <span class="float-right"><b>310</b>/400</span>
                                        <div class="progress progress-sm">
                                          <div class="progress-bar bg-danger" style="width: 75%"></div>
                                        </div>
                                      </div>

                                      <!-- /.progress-group -->
                                      <div class="progress-group">
                                        <span class="progress-text">Pasien BPJS</span>
                                        <span class="float-right"><b>480</b>/800</span>
                                        <div class="progress progress-sm">
                                          <div class="progress-bar bg-success" style="width: 60%"></div>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-center">
                                        <strong>Pasien Rawat Inap</strong>
                                        <form class="form-inline mb-3">
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label for="inputPassword2" class="sr-only">Password</label>
                                                <input type="date" class="form-control" id="" name=""
                                                    placeholder="Password" value="{{ $awal_bulan }}">
                                            </div>
                                            <div class="form-group mx-sm-3 mb-2">
                                                <label for="inputPassword2" class="sr-only">Password</label>
                                                <input type="date" class="form-control" id=""
                                                    name="" placeholder="Password" value="{{ $now }}">
                                            </div>
                                            <button type="button" class="btn btn-primary mb-2"><i
                                                    class="bi bi-eye mr-1 ml-1"></i>Tampil</button>
                                        </form>
                                      </p>
                                      <div class="progress-group">
                                        Total Kunjungan
                                        <span class="float-right"><b>160</b>/200</span>
                                        <div class="progress progress-sm">
                                          <div class="progress-bar bg-primary" style="width: 80%"></div>
                                        </div>
                                      </div>
                                      <!-- /.progress-group -->

                                      <div class="progress-group">
                                          Pasien Umum
                                        <span class="float-right"><b>310</b>/400</span>
                                        <div class="progress progress-sm">
                                          <div class="progress-bar bg-danger" style="width: 75%"></div>
                                        </div>
                                      </div>

                                      <!-- /.progress-group -->
                                      <div class="progress-group">
                                        <span class="progress-text">Pasien BPJS</span>
                                        <span class="float-right"><b>480</b>/800</span>
                                        <div class="progress progress-sm">
                                          <div class="progress-bar bg-success" style="width: 60%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info">Grafik Penggunaan ERM Poliklinik / Bulan</div>
                                <div class="card-body">
                                    <form class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal"
                                                placeholder="Password" value="{{ $awal_bulan }}">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="date" class="form-control" id="tanggal_akhir"
                                                name="tanggal_akhir" placeholder="Password" value="{{ $now }}">
                                        </div>
                                        <button type="button" class="btn btn-primary mb-2" onclick="tampilperbulan()"><i
                                                class="bi bi-eye mr-1 ml-1"></i>Tampil</button>
                                    </form>
                                    <div class="col-md-12">
                                        <div class="graf_1">
                                            <canvas id="chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-danger">Grafik Penggunaan ERM Poliklinik / Bulan by Poliklinik
                                </div>
                                <div class="card-body">
                                    <form class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="date" class="form-control" id="tanggal_awal_poli"
                                                name="tanggal_awal_poli" placeholder="Password" value="{{ $awal_bulan }}">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <input type="date" class="form-control" id="tanggal_akhir_poli"
                                                name="tanggal_akhir_poli" placeholder="Password"
                                                value="{{ $now }}">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="inputPassword2" class="sr-only">Password</label>
                                            <select class="form-control" id="poliklinik" name="poliklinik">
                                                <option>Silahkan Pilih Poli</option>
                                                @foreach ($mt_unit as $m)
                                                    <option value="{{ $m->kode_unit }}"
                                                        @if ($m->kode_unit == auth()->user()->unit) selected @endif>
                                                        {{ $m->nama_unit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-primary mb-2"
                                            onclick="tampilperbulan_bypoli()"><i
                                                class="bi bi-eye mr-1 ml-1"></i>Tampil</button>
                                    </form>
                                    <div class="col-md-12">
                                        <div class="graf_2">
                                            <canvas id="chart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const ctx = document.getElementById('chart');
            var unit = {!! json_encode($unit) !!};
            var total = {!! json_encode($total) !!};
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: unit,
                    datasets: [{
                            label: '# Data Penggunaan',
                            data: total,
                            borderWidth: 1,
                            backgroundColor: '#9932CC',
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                        },
                        {
                            label: '# Total Kunjungan',
                            data: total,
                            borderWidth: 1,
                            borderColor: [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                        }

                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctx3 = document.getElementById('chart2');
            var unit = {!! json_encode($tgl) !!};
            var total = {!! json_encode($jml) !!};
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: unit,
                    datasets: [{
                        label: '# Data Penggunaan',
                        data: total,
                        borderWidth: 1,
                        backgroundColor: '#008B8B',
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });


            function tampilperbulan() {
                awal = $('#tanggal_awal').val()
                akhir = $('#tanggal_akhir').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        awal,
                        akhir
                    },
                    url: '<?= route('ambil_grafik_all_poli') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        $('.graf_1').html(response);
                        spinner.hide()
                    }
                });
            }

            function tampilperbulan_bypoli() {
                awal = $('#tanggal_awal_poli').val()
                akhir = $('#tanggal_akhir_poli').val()
                poli = $('#poliklinik').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        awal,
                        akhir,
                        poli
                    },
                    url: '<?= route('ambil_grafik_by_poli') ?>',
                    error: function(response) {
                        spinner.hide()
                        alert('error')
                    },
                    success: function(response) {
                        $('.graf_2').html(response);
                        spinner.hide()
                    }
                });
            }
        </script>
    @endsection
