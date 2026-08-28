@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Pendapatan</h1>
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
        <div class="v_1">
            <div class="container-fluid">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Filter Periode Tanggal
                        </h3>
                    </div>
                    <div class="card-body">
                        <form id="form-filter">
                            <div class="form-row align-items-end">
                                <!-- Tanggal Awal -->
                                <div class="form-group col-md-3 mb-2 mb-md-0">
                                    <label for="tgl_awal" class="font-weight-bold">Tanggal Awal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal"
                                            value="{{ request('tgl_awal') ?? date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <!-- Tanggal Akhir -->
                                <div class="form-group col-md-3 mb-2 mb-md-0">
                                    <label for="tgl_akhir" class="font-weight-bold">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"
                                            value="{{ request('tgl_akhir') ?? date('Y-m-d') }}" required>
                                    </div>
                                </div>
                                <div hidden class="form-group col-md-3 mb-2 mb-md-0">
                                    <label for="tgl_akhir" class="font-weight-bold">Jenis Pasien</label>
                                    <select class="form-control" id="jenispasien">
                                        <option value="1">Rawat Jalan</option>
                                        <option value="2">Rawat Inap</option>
                                    </select>
                                </div>
                                <!-- Tombol Aksi -->
                                <div class="form-group col-md-3 mb-0">
                                    <button type="button" class="btn btn-primary shadow-sm"
                                        onclick="carilaporanpendapatan()">
                                        <i class="fas fa-search mr-1"></i> Tampilkan
                                    </button>
                                    <a href="{{ url()->current() }}" class="btn btn-secondary shadow-sm ml-1">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Data Pasien</div>
                    <div class="card-body">
                        <div class="v_t_b">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div hidden class="v_2">
            <button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace"></i> Kembali </button>
            <div class="v_f mt-2">

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            carilaporanpendapatan()
        });

        function carilaporanpendapatan() {
            spinner = $('#loader')
            spinner.show();
            tanggalawal = $('#tgl_awal').val()
            tanggalakhir = $('#tgl_akhir').val()
            jenispasien = $('#jenispasien').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalawal,
                    tanggalakhir,
                    jenispasien
                },
                url: '<?= route('cari_laporan_pendapatan_lab_pa') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('something wrong ...')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_t_b').html(response);
                }
            });
        }

        function kembali() {
            $('.v_2').attr('hidden', true)
            $('.v_1').removeAttr('hidden', true)
        }
    </script>
@endsection
