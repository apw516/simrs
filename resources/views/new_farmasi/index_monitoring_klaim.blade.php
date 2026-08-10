@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Klaim</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Klaim</li>
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
                            <i class="fas fa-filter mr-1"></i> Filter Data Klaim
                        </h3>
                    </div>
                    <form action="" method="GET" id="form-filter">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tanggal Awal -->
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <label for="tgl_awal" class="form-label font-weight-bold">Bulan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                        </div>
                                        <select class="form-control" id="bulan" name="bulan">
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
                                <!-- Tanggal Akhir -->
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <label for="tgl_akhir" class="form-label font-weight-bold">Tahun</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                        </div>
                                        <select class="form-control" id="tahun" name="tahun">
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Pilihan Jenis Pelayanan / Unit -->
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <label for="jenis_pelayanan" class="form-label font-weight-bold">Jenis Obat</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                        </div>
                                        <select class="form-control" id="jenis_obat" name="jenis_obat">
                                            <option value="0">Semua</option>
                                            <option value="0">Obat PRB</option>
                                            <option value="0">Obat Kronis</option>
                                            <option value="0">Obat Kemo</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Pilihan Jenis Pelayanan / Unit -->
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <label for="jenis_pelayanan" class="form-label font-weight-bold">Status</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                        </div>
                                        <select class="form-control" id="status" name="status">
                                            <option value="0">Belum diverifikasi</option>
                                            <option value="1">Sudah diverifikasi</option>
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
        </div>
    </section>
    <script>
        $(document).ready(function() {
            tampilkandata()
        });

        function tampilkandata() {
            bulan = $('#bulan').val()
            tahun = $('#tahun').val()
            jenis_obat = $('#jenis_obat').val()
            status = $('#status').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan,
                    tahun,
                    jenis_obat,
                    status
                },
                url: '<?= route('ambildataklaimfarmasi') ?>',
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

        function kembali() {
            $('.v_1').removeAttr('hidden', true)
            $('.v_2').attr('hidden', true)
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
