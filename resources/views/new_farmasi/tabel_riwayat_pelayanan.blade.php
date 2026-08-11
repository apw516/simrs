<!-- CDN DataTables & Bootstrap 4 Integration -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold">
                <i class="fas fa-file-medical-alt mr-2"></i> Data Resep Header BPJS
            </h5>
            <div>
                <span class="badge badge-light text-dark font-weight-bold p-2">
                    <i class="far fa-calendar-alt mr-1"></i>
                    {{ \Carbon\Carbon::parse($tglAwal ?? date('Y-m-d'))->format('d/m/Y') }}
                </span>
            </div>
        </div>

        <div class="card-body">
            <!-- Action Buttons Header -->
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-outline-secondary btn-sm mr-2"
                    onclick="window.location.reload();">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
                <button type="button" class="btn btn-success btn-sm" onclick="window.print();">
                    <i class="fas fa-print"></i> Cetak Dokumen
                </button>
            </div>

            <!-- Table Data -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle mb-0" id="res_dt">
                    <thead class="bg-light text-dark font-weight-bold text-center">
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>No RM & Pasien</th>
                            <th>Dokter & Penjamin</th>
                            <th style="width: 160px;">Unit & Pengirim</th>
                            <th>Kode Layanan / Kunjungan</th>
                            <th>Detail Resep BPJS</th>
                            <th style="width: 80px;">Iterasi</th>
                            <th style="width: 110px;">Status Bridging</th>
                            <th style="width: 80px;" class="no-print">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $row)
                            <tr>
                                <td class="text-center align-middle font-weight-bold">{{ $index + 1 }}</td>

                                <!-- No RM & Nama Pasien -->
                                <td class="align-middle">
                                    <span class="badge badge-secondary mb-1">{{ $row->no_rm ?? '-' }}</span><br>
                                    <strong class="text-primary">{{ $row->nama_pasien ?? 'Tidak Diketahui' }}</strong>
                                </td>

                                <!-- Dokter & Penjamin -->
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark mb-1">
                                        <i class="fas fa-user-md text-info mr-1"></i> {{ $row->nama_dokter ?? '-' }}
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-shield-alt text-success mr-1"></i>
                                        {{ $row->nama_penjamin ?? '-' }}
                                    </small>
                                </td>

                                <!-- Unit Layanan & Unit Pengirim -->
                                <td class="align-middle">
                                    <div class="mb-1">
                                        <small class="text-muted d-block">Unit Tuju/Layanan:</small>
                                        <span class="badge badge-primary px-2 py-1">
                                            <i class="fas fa-hospital-symbol mr-1"></i> {{ $row->nama_unit ?? '-' }}
                                        </span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Unit Pengirim:</small>
                                        <span class="badge badge-light border text-dark px-2 py-1">
                                            <i class="fas fa-paper-plane mr-1 text-secondary"></i>
                                            {{ $row->nama_unit_asal ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Kode Layanan & Kunjungan -->
                                <td class="align-middle">
                                    <small class="text-muted d-block">Layanan Header:</small>
                                    <code class="text-dark">{{ $row->kode_layanan_header ?? '-' }}</code>
                                    <small class="text-muted d-block mt-1">Kunjungan:</small>
                                    <span class="text-dark">{{ $row->kode_kunjungan ?? '-' }}</span>
                                </td>

                                <!-- Detail Resep BPJS -->
                                <td class="align-middle">
                                    <div class="small">
                                        <strong>No Resep:</strong> <span
                                            class="text-primary">{{ $row->NORESEP ?? '-' }}</span><br>
                                        <strong>Ref SJP:</strong> {{ $row->REFASALSJP ?? '-' }}<br>
                                        <strong>SEP Apotek:</strong> {{ $row->Sepapotek ?? '-' }}
                                    </div>
                                </td>

                                <!-- Iterasi -->
                                <td class="text-center align-middle">
                                    <span class="badge badge-info px-2 py-1">
                                        Iterasi: {{ $row->iterasi ?? '0' }}
                                    </span>
                                </td>

                                <!-- Status Bridging -->
                                <td class="text-center align-middle">
                                    @if ($row->Bridging == '1' || strtolower($row->Bridging) == 'sudah')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle"></i>
                                            Bridging</span>
                                    @elseif($row->Bridging == '0' || strtolower($row->Bridging) == 'belum')
                                        <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock"></i>
                                            Belum</span>
                                    @else
                                        <span
                                            class="badge badge-light border text-muted px-2 py-1">{{ $row->Bridging ?? '-' }}</span>
                                    @endif
                                </td>
                                <!-- Action Buttons -->
                                <td class="text-center align-middle no-print">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-danger batallayanan"
                                            title="Retur Resep" idlayananhheader="{{ $row->id_layanan_header }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-info detaillayanan"
                                            title="Detail Resep" idlayananhheader="{{ $row->id_layanan_header }}"
                                            data-toggle="modal" data-target="#modaldetail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary cetaketiket"
                                            title="Cetak Etiket" idlayananhheader="{{ $row->id_layanan_header }}">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-success cetaknota"
                                            title="Cetak Nota" idlayananhheader="{{ $row->id_layanan_header }}">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary tambahobat"
                                            title="Tamabah Obat" idlayananhheader="{{ $row->id_layanan_header }}">
                                            <i class="fas fa-plus"></i> <i class="bi bi-database-add"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    /* Penyesuaian Style DataTables dengan Bootstrap 4 */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0 !important;
        margin: 0 !important;
    }

    .dataTables_filter input {
        border-radius: 4px;
        padding: 4px 8px;
    }

    @media print {

        .no-print,
        .dataTables_length,
        .dataTables_filter,
        .dataTables_info,
        .dataTables_paginate,
        .card-header button,
        .btn {
            display: none !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000 !important;
            font-size: 10px;
            padding: 4px 6px !important;
        }

        body {
            background: #fff !important;
        }
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modaldetail" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_layanan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#res_dt').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Semua"]
            ],
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data resep BPJS yang ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_ (Total _TOTAL_ data)",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari _MAX_ total data)",
                "search": "Cari Data:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            },
            "columnDefs": [{
                    "orderable": false,
                    "targets": [8]
                } // Nonaktifkan sorting pada kolom Aksi
            ]
        });
    });
    $('.detaillayanan').on('click', function() {
        idlayananhheader = $(this).attr('idlayananhheader')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idlayananhheader
            },
            url: '<?= route('ambildetaillayanandepo') ?>',
            error: function(response) {
                alert('error!')
                spinner.hide()
            },
            success: function(response) {
                $('.v_detail_layanan').html(response);
                spinner.hide()
            }
        });
    });
    $('.tambahobat').on('click', function() {
        idlayananhheader = $(this).attr('idlayananhheader')
        spinner = $('#loader')
        spinner.show();
        $('.v_1').attr('hidden', true)
        $('.v_2').removeAttr('hidden', true)
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idlayananhheader
            },
            url: '<?= route('ambilformtambahobat') ?>',
            error: function(response) {
                alert('error!')
                spinner.hide()
            },
            success: function(response) {
                $('.v_detail_pasien').html(response);
                spinner.hide()
            }
        });
    });
    $(".batallayanan").on('click', function(event) {
        idlayananhheader = $(this).attr('idlayananhheader')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data Resep akan dibatalkan ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, batalkan"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Pastikan data resep yang dibatalkan sudah dipilih dengan benar",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus data obat ...",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        hapusresep(idlayananhheader)
                    }
                });
            }
        });
    });
    $(".cetaketiket").on('click', function(event) {
        idlayananhheader = $(this).attr('idlayananhheader')
        var url = "{{ url('cetaketiket_2') }}/" + idlayananhheader;
        window.open(url, '_blank');
    });
    $(".cetaknota").on('click', function(event) {
        idlayananhheader = $(this).attr('idlayananhheader')
        var url = "{{ url('cetaknotafarmasi') }}/" + idlayananhheader;
        window.open(url, '_blank');
    });

    function hapusresep(idlayananhheader) {
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idlayananhheader
            },
            url: '<?= route('batalresep') ?>',
            error: function(response) {
                spinner_off()
                Swal.fire({
                    icon: 'error',
                    title: 'Ups!',
                    text: response.message,
                });
            },
            success: function(response) {
                spinner_off()
                if (response.kode == '500') {
                    // Kondisi jika validasi gagal atau ada error sistem
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK!',
                        text: response.message,
                    });
                    location.reload()
                }
            }
        });
    }
</script>
