<div class="container-fluid pt-3">
    <div class="card card-outline card-primary shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-notes-medical mr-2"></i>Laporan Resep Kronis
                    </h5>
                    <small class="text-muted">
                        Periode: {{ \Carbon\Carbon::parse($awal)->format('d-m-Y H:i') }} s/d
                        {{ \Carbon\Carbon::parse($akhir)->format('d-m-Y H:i') }}
                    </small>
                </div>
                <span class="badge badge-primary px-3 py-2">
                    Total: {{ $data->count() }} Pasien
                </span>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped text-nowrap" id="tableResepKronis"
                    style="width: 100%;">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>No. BPJS / SEP</th>
                            <th>Unit Asal</th>
                            <th>Kode Layanan</th>
                            <th hidden>Alamat</th>
                            <th>Keterangan</th>
                            <th class="text-center">Total Obat</th>
                            <th class="text-center" width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">
                                    <span class="badge badge-outline-secondary font-weight-bold">
                                        {{ $item->no_rm }}
                                    </span>
                                </td>
                                <td class="align-middle font-weight-bold text-uppercase">
                                    {{ $item->nama_px }}
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">BPJS: {{ $item->no_Bpjs ?? '-' }}</small>
                                        @if (!empty($item->no_sep) && $item->no_sep != '-')
                                            <small class="text-primary font-weight-bold">SEP:
                                                {{ $item->no_sep }}</small>
                                        @else
                                            <small class="text-danger font-weight-bold">
                                                <i class="fas fa-exclamation-circle mr-1"></i>SEP: Tanpa SEP / Kosong
                                            </small>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="badge badge-info">{{ $item->unit_asal ?? '-' }}</span>
                                </td>
                                <td class="align-middle">
                                    <code>{{ $item->kode_layanan_header }}</code>
                                </td>
                                <td hidden class="align-middle">
                                    <small>{{ $item->alamat ?? '-' }}</small>
                                </td>
                                <td class="align-middle">
                                    <small class="text-secondary">{{ $item->keterangan2 ?? '-' }}</small>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-success px-2 py-1">
                                        {{ $item->total_detail }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-primary btn-detail"
                                        data-id="{{ $item->row_id_header }}" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle fa-2x d-block mb-2 text-warning"></i>
                                    Tidak ada data resep kronis pada periode tanggal yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail Resep --}}
<div class="modal fade" id="modalDetailResep" tabindex="-1" role="dialog" aria-labelledby="modalDetailResepLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalDetailResepLabel">
                    <i class="fas fa-pills mr-2"></i>Rincian Obat / Resep
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

{{-- Inisialisasi DataTables & Handler AJAX Detail --}}
<script>
    $(document).ready(function() {
        // 1. Inisialisasi DataTables
        var table = $('#tableResepKronis').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Semua"]
            ],
            "language": {
                "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                "sProcessing": "Sedang memproses...",
                "sLengthMenu": "Tampilkan _MENU_ entri",
                "sZeroRecords": "Tidak ditemukan data yang sesuai",
                "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                "sSearch": "Cari:",
                "oPaginate": {
                    "sFirst": "Pertama",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Terakhir"
                }
            }
        });

        // 2. Event click tombol detail (Menggunakan delegated event agar kompatibel dengan paginasi DataTables)
        $('#tableResepKronis').on('click', '.btn-detail', function() {
            var idResep = $(this).data('id');
            var btn = $(this);
            var originalContent = btn.html();

            // Tampilkan state loading pada tombol
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            // Panggil method ambildetailresep via AJAX
            $.ajax({
                url: "{{ route('ambildetailberkas') }}", // Sesuaikan dengan nama route Anda
                type: "GET",
                data: {
                    idresep: idResep
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
    });
</script>
