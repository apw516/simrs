<div class="table-responsive">
    <table id="tableKunjungan" class="table table-striped table-bordered align-middle hover" style="width:100%">
        <thead class="table-light">
            <tr>
                <th>No RM</th>
                <th>Kode Kunjungan</th>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Unit / Poliklinik</th>
                <th>Penjamin</th>
                <th>Tgl Masuk</th>
                <th>Status</th>
                <th class="text-center" style="width: 50px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datakunjungan as $item)
                <tr>
                    <td><span class="badge bg-secondary">{{ $item->no_rm }}</span></td>
                    <td>{{ $item->kode_kunjungan }}</td>
                    <td><strong>{{ $item->nama_pasien }}</strong></td>
                    <td>{{ $item->alamat_pasien }}</td>
                    <td>{{ $item->nama_unit }}</td>
                    <td>{{ $item->nama_penjamin }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y H:i') }}</td>
                    <td>
                        @if ($item->status_kunjungan == 1)
                            <span class="badge bg-warning text-dark">Aktif</span>
                        @elseif($item->status_kunjungan == 2)
                            <span class="badge bg-danger">Sudah Pulang</span>
                        @else
                            <span class="badge bg-info">Status {{ $item->status_kunjungan }}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btn-pilih"
                            data-counter="{{ $item->counter }}" data-kode="{{ $item->kode_kunjungan }}"
                            data-norm="{{ $item->no_rm }}" data-nama="{{ $item->nama_pasien }}"
                            data-alamat="{{ $item->alamat_pasien }}" data-unit="{{ $item->nama_unit }}"
                            data-penjamin="{{ $item->nama_penjamin }}">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        var table = $('#tableKunjungan').DataTable({
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
        $('#tableKunjungan').on('click', '.btn-pilih', function() {
            var noRm = $(this).data('norm');
            var nama = $(this).data('nama');
            var kodeKunjungan = $(this).data('kode');
            var unit = $(this).data('unit');
            $('.v_1').attr('hidden', true)
            $('.v_2').removeAttr('hidden', true)
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    noRm,
                    nama,
                    kodeKunjungan,
                    unit
                },
                url: '<?= route('ambil_form_billing_penunjang') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('something wrong ...')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_f').html(response);
                }
            });
        });
    });
</script>
