@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Depo Obat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Depo Obat</li>
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
            <div class="v_1">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Filter Data Kunjungan / Pelayanan
                        </h3>
                    </div>
                    <form action="" method="GET" id="form-filter">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tanggal Awal -->
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="tgl_awal" class="form-label font-weight-bold">Tanggal Awal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal"
                                            value="{{ request('tgl_awal', date('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <!-- Tanggal Akhir -->
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="tgl_akhir" class="form-label font-weight-bold">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"
                                            value="{{ request('tgl_akhir', date('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <!-- Pilihan Jenis Pelayanan / Unit -->
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="jenis_pelayanan" class="form-label font-weight-bold">Jenis Pelayanan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                        </div>
                                        <select class="form-control" id="jenis_pelayanan" name="jenis_pelayanan">
                                            <option value="all"
                                                {{ request('jenis_pelayanan') == 'all' ? 'selected' : '' }}>
                                                -- Semua Pelayanan --</option>
                                            <option value="J"
                                                {{ request('jenis_pelayanan') == 'J' ? 'selected' : '' }}>
                                                Rawat Jalan
                                            </option>
                                            <option value="I"
                                                {{ request('jenis_pelayanan') == 'I' ? 'selected' : '' }}>
                                                Rawat Inap
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="card-footer bg-white text-right">
                            <button type="reset" class="btn btn-secondary mr-2" onclick="location.reload()">
                                <i class="fas fa-undo mr-1"></i> Reset
                            </button>
                            <button type="button" class="btn btn-primary" onclick="tampilkandata()">
                                <i class="fas fa-search mr-1"></i> Tampilkan Data
                            </button>
                        </div>
                    </form>
                    <div class="v_data_pasien mt-2">
                        <div class="card">
                            <div class="card-header">Data Kunjungan Pasien</div>
                            <div class="card-body">
                                <div class="vd">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="v_2">
                <button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace"></i> Kembali</button>
                <div class="v_detail_pasien mt-2">

                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            tampilkandata()
        });

        function tampilkandata() {
            tgl_awal = $('#tgl_awal').val()
            tgl_akhir = $('#tgl_akhir').val()
            jenis_pelayanan = $('#jenis_pelayanan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tgl_awal,
                    tgl_akhir,
                    jenis_pelayanan
                },
                url: '<?= route('ambildatakunjungandepo') ?>',
                error: function(response) {
                    alert('error!')
                    spinner.hide()
                },
                success: function(response) {
                    $('.vd').html(response);
                    spinner.hide()
                }
            });
        }
        function kembali()
        {
            $('.v_1').removeAttr('hidden',true)
            $('.v_2').attr('hidden',true)
        }
        function caripasien_far() {
            rm = $('#cari_rm').val()
            tanggalcari = $('#tanggalcari').val()
            poliklinik = $('#poliklinik').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm,
                    poliklinik,
                    tanggalcari
                },
                url: '<?= route('ambil_data_pasien_far') ?>',
                success: function(response) {
                    $('.v_t_pasien_poli').html(response);
                    spinner.hide()
                }
            });
        }
    </script>
@endsection
