@extends('dashboard.layouts.main')

@section('container')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center my-2">
                <div class="col-sm-6">
                    <h3 class="mb-0 fw-bold text-dark">Mapping Master Barang</h3>
                    <small class="text-muted">Pemetaan Data Obat BPJS dengan SIMRS</small>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mapping Master Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <!-- Tables Row -->
            <div class="row g-3">
                <!-- Table BPJS -->
                <div class="col-lg-6">
                    <div class="card card-outline card-primary shadow-sm h-100">
                        <div class="card-header bg-primary text-white py-2">
                            <h5 class="card-title mb-0 fs-6 fw-semibold"><i class="bi bi-card-checklist me-2"></i>Pilih Nama
                                Obat Generik (BPJS)</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table id="tabel_barang_bpjs" class="table table-striped table-hover align-middle w-100"
                                    style="font-size:13px">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Obat</th>
                                            <th>Generik</th>
                                            <th>Restriksi</th>
                                            <th>Dosis</th>
                                            <th class="text-center" style="width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table SIMRS -->
                <div class="col-lg-6">
                    <div class="card card-outline card-info shadow-sm h-100">
                        <div class="card-header bg-info text-white py-2">
                            <h5 class="card-title mb-0 fs-6 fw-semibold">
                                <i class="bi bi-box-seam me-2"></i>Pilih Master Barang (SIMRS)
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            <!-- Filter Pencarian Manual -->
                            <div class="row g-2 mb-3">
                                <div class="col-8 col-sm-9">
                                    <input type="text" id="keyword_simrs" class="form-control form-control-sm"
                                        placeholder="Ketik nama atau kode barang...">
                                </div>
                                <div class="col-4 col-sm-3">
                                    <button type="button" id="btn_cari_simrs" class="btn btn-sm btn-info text-white w-100">
                                        <i class="bi bi-search me-1"></i> Cari
                                    </button>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tabel_barang_simrs" class="table table-striped table-hover align-middle w-100"
                                    style="font-size:13px">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Sediaan</th>
                                            <th>Dosis</th>
                                            <th>Status</th>
                                            <th class="text-center" style="width: 40px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Form Mapping Row -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white py-2 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fs-6 fw-bold"><i class="bi bi-diagram-3 me-2"></i>Form Mapping Data
                                Obat</h5>
                            <span class="badge bg-secondary">Draft Selection</span>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row g-3">
                                <!-- Selected BPJS Info -->
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-header bg-white fw-bold py-2 text-primary border-bottom">
                                            <i class="bi bi-info-circle me-1"></i> Detail Obat BPJS Terpilih
                                        </div>
                                        <div class="card-body">
                                            <form class="form_obat_bpjs" id="form_obat_bpjs">
                                                <div class="row g-2">
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-semibold">Nama Obat BPJS</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="namaobatbpjs"
                                                            name="namaobatbpjs" placeholder="Belum ada yang dipilih...">
                                                        <input hidden readonly type="text" id="kodeobatbpjs"
                                                            name="kodeobatbpjs">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-semibold">Generik</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="generik"
                                                            name="generik">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small fw-semibold">Restriksi</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="restriksi"
                                                            name="restriksi">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small fw-semibold">Dosis</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="dosis"
                                                            name="dosis">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small fw-semibold">Kronis</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="kronis"
                                                            name="kronis">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small fw-semibold">PRB</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="prb"
                                                            name="prb">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small fw-semibold">Kemo</label>
                                                        <input readonly type="text"
                                                            class="form-control form-control-sm bg-light" id="kemo"
                                                            name="kemo">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected SIMRS List -->
                                <div class="col-12">
                                    <div class="card border">
                                        <div class="card-header bg-white fw-bold py-2 text-info border-bottom">
                                            <i class="bi bi-list-check me-1"></i> List Barang SIMRS Terpilih
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="post" class="v_list_barang">
                                                <div class="draft_barang p-2 rounded bg-white border min-vh-10">
                                                    <!-- Dynamic rows will append here -->
                                                    <div class="text-muted text-center py-2 empty-placeholder small">
                                                        Belum ada barang SIMRS yang dipilih.
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white text-end py-3 border-top">
                            <button class="btn btn-success px-4" onclick="alertsimpandatamapping()">
                                <i class="bi bi-save me-1"></i> Simpan Mapping
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var tableBPJS = $('#tabel_barang_bpjs').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                lengthChange: false,
                ajax: "{{ route('ambilbarangbpjs') }}",
                columns: [{
                        data: 'kodeobat',
                        name: 'kodeobat'
                    },
                    {
                        data: 'namaobat',
                        name: 'namaobat'
                    },
                    {
                        data: 'generik',
                        name: 'generik'
                    },
                    {
                        data: 'restriksi',
                        name: 'restriksi'
                    },
                    {
                        data: 'sedia',
                        name: 'sedia'
                    },
                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                            <button class="btn btn-xs btn-success btn-pilih-bpjs" 
                                    data-kode="${row.kodeobat}" 
                                    data-nama="${row.namaobat}"
                                    data-kronis="${row.kronis}"
                                    data-prb="${row.prb}"
                                    data-kemo="${row.kemo}"
                                    data-restriksi="${row.restriksi}"
                                    data-generik="${row.generik}"
                                    data-sedia="${row.sedia}"
                                    title="Pilih Obat BPJS">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        `;
                        }
                    }
                ]
            });
            var tableSIMRS = $('#tabel_barang_simrs').DataTable({
                processing: true,
                serverSide: true,
                deferLoading: 0, // Mencegah DataTables otomatis mengambil data saat halaman diawal dibuka
                pageLength: 15,
                lengthChange: false,
                searching: false, // Matikan pencarian bawaan DataTables
                ajax: {
                    url: "{{ route('ambilbarangmappingdepo') }}",
                    type: "GET",
                    data: function(d) {
                        d.keyword = $('#keyword_simrs')
                    .val(); // Kirim kata kunci pencarian ke controller
                    }
                },
                columns: [{
                        data: 'kode_barang',
                        name: 'kode_barang'
                    },
                    {
                        data: 'nama_barang',
                        name: 'nama_barang'
                    },
                    {
                        data: 'satuan_besar',
                        name: 'satuan_besar'
                    },
                    {
                        data: 'sediaan',
                        name: 'sediaan'
                    },
                    {
                        data: 'dosis',
                        name: 'dosis'
                    },
                    {
                        data: 'kode_obat_bpjs',
                        name: 'kode_obat_bpjs',
                        searchable: false,
                        render: function(data, type, row) {
                            if (data == null || data == '0') {
                                return '<span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Belum</span>';
                            } else {
                                return '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Mapped</span>';
                            }
                        }
                    },
                    {
                        data: null,
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                    <button class="btn btn-xs btn-primary btn-pilih" 
                            data-id="${row.kode_barang}" 
                            data-nama="${row.nama_barang}" 
                            data-satuan="${row.satuan_besar}" 
                            data-sediaan="${row.sediaan}" 
                            data-dosis="${row.dosis}"
                            title="Tambah Ke Draft">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                `;
                        }
                    }
                ]
            });

            // Event Klik Tombol Cari
            $('#btn_cari_simrs').on('click', function() {
                var keyword = $('#keyword_simrs').val().trim();
                if (keyword.length < 2) {
                    Swal.fire('Perhatian', 'Ketikkan minimal 2 karakter untuk mencari barang!', 'warning');
                    return;
                }
                tableSIMRS.draw();
            });

            // Event Tekan Enter di Input Text
            $('#keyword_simrs').on('keyup', function(e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    $('#btn_cari_simrs').click();
                }
            });
            // Event Tambah Item SIMRS ke Draft
            $('#tabel_barang_simrs tbody').on('click', '.btn-pilih', function() {
                var id_barang = $(this).attr('data-id');
                var nama_barang = $(this).attr('data-nama');
                var satuan = $(this).attr('data-satuan');
                var sediaan = $(this).attr('data-sediaan');
                var dosis = $(this).attr('data-dosis');

                $('.empty-placeholder').hide();

                var rowHtml = `
                <div class="row align-items-center g-2 mb-2 pb-2 border-bottom draft-row">
                    <div class="col-md-5">
                        <input readonly type="text" class="form-control form-control-sm bg-light" name="namabarang" value="${nama_barang}">
                        <input type="hidden" name="kodebarang" value="${id_barang}">
                    </div>
                    <div class="col-md-2">
                        <input readonly type="text" class="form-control form-control-sm bg-light" name="satuan" value="${satuan}">
                    </div>
                    <div class="col-md-2">
                        <input readonly type="text" class="form-control form-control-sm bg-light" name="sediaan" value="${sediaan}">
                    </div>
                    <div class="col-md-2">
                        <input readonly type="text" class="form-control form-control-sm bg-light" name="dosis" value="${dosis}">
                    </div>
                    <div class="col-md-1 text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger remove_field"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            `;
                $(".draft_barang").append(rowHtml);
                Swal.fire({
                    title: "Berhasil Ditambahkan",
                    text: nama_barang,
                    icon: "success",
                    timer: 800,
                    showConfirmButton: false
                });
            });

            // Event Hapus Item SIMRS
            $(".draft_barang").on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).closest('.draft-row').remove();
                if ($('.draft-row').length === 0) {
                    $('.empty-placeholder').show();
                }
            });

            // Event Pilih Obat BPJS
            $('#tabel_barang_bpjs tbody').on('click', '.btn-pilih-bpjs', function() {
                $('#namaobatbpjs').val($(this).attr('data-nama'));
                $('#kodeobatbpjs').val($(this).attr('data-kode'));
                $('#generik').val($(this).attr('data-generik'));
                $('#restriksi').val($(this).attr('data-restriksi'));
                $('#dosis').val($(this).attr('data-sedia'));
                $('#kronis').val($(this).attr('data-kronis'));
                $('#kemo').val($(this).attr('data-kemo'));
                $('#prb').val($(this).attr('data-prb'));
                Swal.fire({
                    title: "BPJS Obat Dipilih",
                    text: $(this).attr('data-nama'),
                    icon: "success",
                    timer: 800,
                    showConfirmButton: false
                });
            });
        });

        function alertsimpandatamapping() {
            if (!$('#kodeobatbpjs').val()) {
                Swal.fire('Perhatian', 'Silakan pilih obat BPJS terlebih dahulu!', 'warning');
                return;
            }
            if ($('.draft-row').length === 0) {
                Swal.fire('Perhatian', 'Silakan pilih minimal 1 barang SIMRS!', 'warning');
                return;
            }

            Swal.fire({
                title: "Konfirmasi Simpan",
                text: "Apakah data mapping sudah benar?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#198754",
                cancelButtonColor: "#dc3545",
                confirmButtonText: "Ya, Simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpanmappobat();
                }
            });
        }

        function simpanmappobat() {
            if (typeof spinner_on === "function") spinner_on();

            var data_simrs = $('.v_list_barang').serializeArray();
            var data_bpjs = $('.form_obat_bpjs').serializeArray();

            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data_simrs: JSON.stringify(data_simrs),
                    data_bpjs: JSON.stringify(data_bpjs),
                },
                url: "{{ route('simpanmappingobatdaridepo') }}",
                error: function(data) {
                    if (typeof spinner_off === "function") spinner_off();
                    Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan.', 'error');
                },
                success: function(data) {
                    if (typeof spinner_off === "function") spinner_off();
                    if (data.kode == 500) {
                        Swal.fire('Gagal', data.message, 'error');
                    } else {
                        Swal.fire('Sukses', data.message, 'success').then(() => {
                            document.getElementById("form_obat_bpjs").reset();
                            location.reload();
                        });
                    }
                }
            });
        }
    </script>
@endsection
