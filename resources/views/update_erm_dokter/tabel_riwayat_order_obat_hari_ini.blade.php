<div class="card shadow-sm border-0 my-3">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0"><i class="bi bi-list-check me-2"></i>Daftar Order Farmasi</h6>
        <span class="badge bg-secondary">Kode Kunjungan: {{ $kodeKunjungan ?? '22741774' }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0" id="tabel-order-farmasi">
                <thead class="table-light text-center small text-uppercase">
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Obat / Barang</th>
                        <th style="width: 80px;">Hari</th>
                        <th style="width: 100px;">Aturan Pakai</th>
                        <th style="width: 80px;">Jumlah</th>
                        <th>Dokter / PIC</th>
                        <th>Catatan</th>
                        <th style="width: 100px;">Status</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orderFarmasi as $index => $item)
                        <tr id="row-order-{{ $item->id_deteail }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <span class="fw-bold d-block text-dark">{{ $item->nama_barang }}</span>
                                <small class="text-muted">{{ $item->kode_barang }}</small>
                            </td>
                            <td class="text-center">{{ $item->jumlah_hari }} Hari</td>
                            <td class="text-center font-monospace">{{ $item->signa_1 }} x {{ $item->signa_2 }}</td>
                            <td class="text-center fw-bold text-success">{{ $item->jumlah_obat }}</td>
                            <td><small class="fw-semibold">{{ $item->nama_dokter }}</small></td>
                            <td><small class="text-muted">{{ $item->catatan ?? '-' }}</small></td>
                            <td class="text-center">
                                @if ($item->status_order == 1)
                                    <span class="badge bg-warning text-dark"><i
                                            class="bi bi-clock-history me-1"></i>Pending</span>
                                @elseif($item->status_order == 2)
                                    <span class="badge bg-success"><i
                                            class="bi bi-check-circle me-1"></i>Diproses</span>
                                @elseif($item->status_order == 0)
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Dibatalkan</span>
                                @else
                                    <span class="badge bg-secondary">Lainnya</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($item->status_order == 1)
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-batal-order"
                                        data-id-header="{{ $item->id }}" data-id-detail="{{ $item->id_deteail }}"
                                        data-nama="{{ $item->nama_barang }}" title="Batalkan / Retur Order Obat">
                                        <i class="bi bi-x-square me-1"></i> Batal
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-light text-muted border" disabled
                                        title="Tidak dapat dibatalkan karena order sudah diproses">
                                        <i class="bi bi-lock-fill me-1"></i> Dikunci
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <em>Belum ada order farmasi untuk kunjungan ini.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Event listener untuk tombol Batal/Retur
        $(document).on('click', '.btn-batal-order', function() {
            var idHeader = $(this).data('id-header');
            var idDetail = $(this).data('id-detail');
            var namaObat = $(this).data('nama');

            Swal.fire({
                title: 'Batalkan Order Obat?',
                text: 'Obat "' + namaObat + '" akan dibatalkan/diretur dari daftar order.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jalankan Ajax untuk merubah status di Database
                    $.ajax({
                        url: "{{ route('order.farmasi.batal') }}", // Ganti dengan route aksi Anda
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_header: idHeader,
                            id_detail: idDetail
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire('Berhasil!',
                                    'Order obat berhasil dibatalkan.', 'success'
                                    );

                                // Hilangkan baris atau reload bagian tabel
                                $('#row-order-' + idDetail).fadeOut(300,
                            function() {
                                    $(this).remove();
                                });
                            } else {
                                Swal.fire('Gagal!', response.message ||
                                    'Terjadi kesalahan sistem.', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Tidak dapat memproses permintaan.',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>
