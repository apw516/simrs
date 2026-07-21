<div class="table-responsive">
    <table class="table table-bordered text-bold table-striped table-hover align-middle mb-0" id="table-order-terkirim">
        <thead class="table-dark text-center small">
            <tr>
                <th style="width: 40px;">No</th>
                <th style="width: 140px;">Tanggal / Waktu</th>
                <th>Nama Pasien / No RM</th>
                <th>Dokter DPJP</th>
                <th style="width: 100px;">Jumlah Item</th>
                <th style="width: 100px;">Status</th>
                <th style="width: 80px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataOrder as $index => $row)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center small">
                        {{ \Carbon\Carbon::parse($row->tgl_order)->translatedFormat('d/m/Y H:i') }}
                    </td>
                    <td>
                        <span class="fw-bold d-block text-dark">{{ $row->nama_pasien }}</span>
                        <small class="text-bold">RM: {{ $row->no_rm }}</small>
                    </td>
                    <td><small class="text-bold">{{ $row->unit_pengirim }} | {{ $row->nama_dokter }}</small></td>
                    <td class="text-center fw-bold text-primary">{{ $row->total_item }} Item</td>
                    <td class="text-center">
                        @if ($row->status_order == 1)
                            <span class="badge bg-warning text-dark"><i
                                    class="bi bi-clock-history me-1"></i>Terkirim</span>
                        @elseif($row->status_order == 2)
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Diproses</span>
                        @elseif($row->status_order == 0)
                            <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Batal</span>
                        @else
                            <span class="badge bg-secondary">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-info btn-detail-order"
                            data-id="{{ $row->id }}" data-kode-kunjungan="{{ $row->kode_kunjungan }}"
                            title="Lihat Detail Resep">
                            <i class="bi bi-eye"></i> Detail
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                        Tidak ada data order pada rentang tanggal tersebut.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<SCript>
    $(document).ready(function() {
        // Action saat tombol detail diklik
        $(document).on('click', '.btn-detail-order', function() {
            var idHeader = $(this).data('id');
            var kodeKunjungan = $(this).data('kode-kunjungan');

            // 1. Tampilkan indikator loading di .v_kedua
            $('.v_kedua').html(`
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <div class="spinner-border text-primary mb-2" role="status"></div>
                    <p class="text-muted mb-0">Memuat detail order...</p>
                </div>
            </div>
        `).show();
            // 2. Sembunyikan view utama/pertama (misalnya .v_pertama)
            $('.v_awal').hide();
            $('.v_kedua').removeAttr('hidden',true)
            // 3. Request AJAX untuk mengambil form/tabel detail
            $.ajax({
                url: "{{ route('order.farmasi.detail') }}", // Ganti dengan route detail Anda
                type: "GET",
                data: {
                    id_header: idHeader,
                    kode_kunjungan: kodeKunjungan
                },
                success: function(response) {
                    $('.v_kedua').html(response);
                },
                error: function(xhr) {
                    $('.v_kedua').html(`
                    <div class="alert alert-danger d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-exclamation-triangle-fill me-2"></i> Gagal memuat detail order.</span>
                        <button type="button" class="btn btn-sm btn-dark btn-kembali">Kembali</button>
                    </div>
                `);
                }
            });
        });

        // Action untuk kembali ke tampilan utama dari .v_kedua
        $(document).on('click', '.btn-kembali', function() {
            $('.v_kedua').hide().empty();
            $('.v_awal').show();
        });
    });
</SCript>
