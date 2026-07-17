@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Order Resep</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Order Resep</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="v_awal">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold"><i class="bi bi-send-check me-2"></i> Daftar Order Farmasi Terkirim
                                </h6>
                                <button type="button" class="btn btn-sm btn-light text-primary fw-bold"
                                    id="btn-refresh-order">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Refresh
                                </button>
                            </div>
                            <div class="card-body">
                                <form id="form-filter-order" class="row g-2 mb-3 align-items-end">
                                    <div class="col-md-3 col-6">
                                        <label for="tgl_awal" class="form-label small fw-bold text-muted">Tanggal
                                            Awal</label>
                                        <input type="date" class="form-control form-control-sm" id="tgl_awal"
                                            name="tgl_awal" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label for="tgl_akhir" class="form-label small fw-bold text-muted">Tanggal
                                            Akhir</label>
                                        <input type="date" class="form-control form-control-sm" id="tgl_akhir"
                                            name="tgl_akhir" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-sm btn-primary w-100" id="btn-filter-order">
                                            <i class="bi bi-search me-1"></i> Cari Order
                                        </button>
                                    </div>
                                </form>

                                <hr class="text-muted">

                                <div class="v_t_order_poli">
                                    <div class="text-center py-4 text-muted">
                                        <div class="spinner-border spinner-border-sm text-primary me-2" role="status">
                                        </div>
                                        Memuat data order...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div hidden class="v_kedua">
            {{-- <div class="container-fluid">
                <button class="btn btn-danger" onclick="batalpilih()"><i class="bi bi-backspace mr-2"></i>Kembali</button>
                <div class="v_select">

                </div>
            </div> --}}
        </div>
        <script>
            function batalpilih() {
                $('.v_awal').removeAttr('hidden', true)
                $('.v_kedua').attr('hidden', true)
            }
        </script>
        <script>
            $(document).ready(function() {

                // Fungsi Load Data Order Poli
                function loadOrderPoli() {
                    var tglAwal = $('#tgl_awal').val();
                    var tglAkhir = $('#tgl_akhir').val();

                    $('.v_t_order_poli').html(`
            <div class="text-center py-4 text-muted">
                <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                Memuat data order...
            </div>
        `);

                    $.ajax({
                        url: "{{ route('order.poli.get_data') }}", // Sesuaikan dengan route Controller Anda
                        type: "GET",
                        data: {
                            tgl_awal: tglAwal,
                            tgl_akhir: tglAkhir
                        },
                        success: function(response) {
                            $('.v_t_order_poli').html(response);
                        },
                        error: function(xhr) {
                            $('.v_t_order_poli').html(`
                    <div class="alert alert-danger text-center mb-0">
                        <i class="bi bi-exclamation-triangle me-1"></i> Gagal memuat data order.
                    </div>
                `);
                        }
                    });
                }

                // First load
                loadOrderPoli();

                // Trigger Tombol Cari & Refresh
                $('#btn-filter-order, #btn-refresh-order').on('click', function() {
                    loadOrderPoli();
                });
            });
        </script>
    @endsection
