<div class="container-fluid p-3">
    <!-- Header Card Info Pasien -->
    <div class="card card-outline card-primary shadow-sm mb-3">
        <div class="card-header">
            <h5 class="card-title font-weight-bold mb-0">
                <i class="fas fa-history mr-2 text-primary"></i>Riwayat Kunjungan Pasien
            </h5>
        </div>
        <div class="card-body">
            @if (count($ts_kunjungan) > 0)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless text-sm">
                            <tr>
                                <th width="120">No. RM</th>
                                <td>: <span class="badge badge-secondary px-2 py-1">{{ $ts_kunjungan[0]->no_rm }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Pasien</th>
                                <td>: <strong class="text-uppercase">{{ $ts_kunjungan[0]->nama_pasien ?? '-' }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Tabel Riwayat Kunjungan -->
                <div class="table-responsive">
                    <table id="table-riwayat-kunjungan"
                        class="table table-bordered table-hover table-striped text-sm w-100">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th width="40">No</th>
                                <th>Tgl Masuk</th>
                                <th>Ref Kunjungan</th>
                                <th>Jenis / Tipe</th>
                                <th>Unit / Poliklinik</th>
                                <th>Dokter DPJP</th>
                                <th>No. SEP</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ts_kunjungan as $index => $kunjungan)
                                <tr>
                                    <td class="text-center align-middle">{{ $index + 1 }}</td>
                                    <td class="align-middle text-center">
                                        {{ \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="align-middle text-center font-weight-bold text-primary">
                                        {{ $kunjungan->ref_kunjungan ?? '-' }}
                                    </td>
                                    <td class="align-middle text-center">
                                        @if (!empty($kunjungan->ref_kunjungan))
                                            <span class="badge badge-warning text-dark">
                                                <i class="fas fa-user-md mr-1"></i>Pasien Konsul
                                            </span>
                                        @else
                                            <span class="badge badge-success">
                                                <i class="fas fa-user-check mr-1"></i>Pasien Utama
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $kunjungan->nama_unit ?? '-' }}</td>
                                    <td class="align-middle">{{ $kunjungan->nama_dokter ?? '-' }}</td>
                                    <td class="align-middle text-center">
                                        @if (!empty($kunjungan->no_sep))
                                            <span class="badge badge-info">{{ $kunjungan->no_sep }}</span>
                                        @else
                                            <span class="badge badge-light text-muted">Tidak ada SEP</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <button type="button" class="btn btn-xs btn-primary btn-detail-berkas"
                                            data-kode="{{ $kunjungan->kode_kunjungan }}" title="Lihat Berkas">
                                            <i class="fas fa-folder-open mr-1"></i> Detail Berkas
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-folder-open fa-3x mb-3 text-secondary"></i>
                    <p class="mb-0">Tidak ada riwayat kunjungan ditemukan untuk No. RM:
                        <strong>{{ $rm ?? '-' }}</strong>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetailResep" tabindex="-1" role="dialog" aria-labelledby="modalDetailResepLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalDetailResepLabel">
                    <i class="fas fa-pills mr-2"></i>Detail Berkas Pasien 
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3" id="contentDetailResep">
                {{-- Konten HTML dari controller ambildetailresep akan di-render di sini --}}
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- Script DataTables -->
<script>
    $(document).ready(function() {
        if ($('#table-riwayat-kunjungan').length > 0) {
            $('#table-riwayat-kunjungan').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ],
                "language": {
                    "sSearch": "Cari:",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan data yang sesuai",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                    "oPaginate": {
                        "sNext": "Selanjutnya",
                        "sPrevious": "Sebelumnya"
                    }
                }
            });
        }
    });
    // 2. Event click tombol detail (Menggunakan delegated event agar kompatibel dengan paginasi DataTables)
    $('#table-riwayat-kunjungan').on('click', '.btn-detail-berkas', function() {
        var kodekunjungan = $(this).data('kode');
        var btn = $(this);
        var originalContent = btn.html();
        // Tampilkan state loading pada tombol
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

        // Panggil method ambildetailresep via AJAX
        $.ajax({
            url: "{{ route('ambildetailberkaslengkap2') }}", // Sesuaikan dengan nama route Anda
            type: "GET",
            data: {
                kodekunjungan: kodekunjungan
            },
            success: function(response) {
                $('#contentDetailResep').html(response.html);
                $('#modalDetailResep').modal('show');
            },
            error: function(xhr) {
                alert('Gagal mengambil data detail resep. Silakan coba lagi.');
            },
            complete: function() {
                // Kembalikan tombol ke keadaan semula
                btn.prop('disabled', false).html(originalContent);
            }
        });
    });
</script>
