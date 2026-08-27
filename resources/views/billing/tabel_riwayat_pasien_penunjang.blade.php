<table id="tableLayanan" class="table table-hover table-striped align-middle w-100" style="font-size: 13px;">
    <thead class="table-light">
        <tr>
            <th class="text-center" style="width: 50px;">No</th>
            <th>Kode Kunjungan / Header</th>
            <th>No RM / Nama Pasien</th>
            <th>Alamat</th>
            <th>Penjamin</th>
            <th>Unit Pengirim</th>
            <th>Tgl Entry / Kunjungan</th>
            <th class="text-center">Status</th>
            <th class="text-center" style="width: 180px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $row)
            <tr>
                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                <td>
                    <span class="fw-bold text-primary">{{ $row->kode_kunjungan }}</span><br>
                    <small class="text-muted">{{ $row->kode_layanan_header }}</small>
                </td>
                <td>
                    <strong>{{ $row->nama_pasien ?? '-' }}</strong><br>
                    <span class="badge bg-secondary">{{ $row->no_rm }}</span>
                </td>
                <td>{{ $row->alamat_pasien ?? '-' }}</td>
                <td>
                    <span class="badge bg-info text-dark">{{ $row->nama_penjamin ?? '-' }}</span>
                </td>
                <td>
                    <i class="bi bi-house-fill"></i>
                    {{ $row->unit_pengirim ?? '-' }}
                </td>
                <td>
                    <div><i
                            class="bi bi-clock me-1 text-muted"></i>{{ \Carbon\Carbon::parse($row->tgl_entry)->format('d-m-Y H:i') }}
                    </div>
                    <small class="text-muted">Kunjungan:
                        {{ \Carbon\Carbon::parse($row->tgl_kunjungan)->format('d-m-Y H:i') }}</small>
                </td>
                <td class="text-center">
                    @if ($row->status_kunjungan == 1)
                        <span class="badge bg-warning text-dark">Aktif</span>
                    @elseif ($row->status_kunjungan == 2)
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-light text-dark">Status:
                            {{ $row->status_kunjungan }}</span>
                    @endif
                </td>
                <td class="text-center">
                    {{-- <a class="btn btn-sm btn-primary" title="Detail Layanan" idlayanan="{{ $row->id_layanan_header }}">
                        <i class="bi bi-eye"></i>
                    </a> --}}
                    <a class="btn btn-sm btn-success lihathasilexpertisi" title="Lihat detail layanan"
                        idlayanan="{{ $row->id_layanan_header }}" data-toggle="modal" data-target="#modalexpertisi">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted py-4">
                    <i class="fa-solid fa-folder-open fa-2x mb-2"></i><br>
                    Tidak ada data layanan penunjang untuk hari ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modalexpertisi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_expertisi">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        var table = $('#tableLayanan').DataTable({
            "language": {
                "search": "Cari Pasien:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari total _MAX_ data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            },
            "pageLength": 10,
            "order": [
                [7, "desc"]
            ] // Urutkan berdasarkan Tanggal Masuk
        });
        // Event Handler saat Tombol "Pilih" Diklik
        $('#tableLayanan').on('click', '.lihathasilexpertisi', function() {

            spinner = $('#loader');
            spinner.show();
            var id_layanan_header = $(this).attr('idlayanan');
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_layanan_header
                },
                url: '<?= route('ambil_hasil_expertisi_pa') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('something wrong ...')
                },
                success: function(response) {
                    $('.v_hasil_expertisi').html(response);
                    spinner.hide()
                }
            });
        });
    });
</script>
