<table id="table-stok-obat" class="table table-striped table-hover table-bordered align-middle w-100">
    <thead class="table-dark text-center">
        <tr>
            <th style="width: 50px;">No</th>
            <th>Nama Barang</th>
            <th>Nama Generik</th>
            <th>Stok</th>
            <th>Aturan pakai</th>
            <th style="width: 80px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($stokBarang as $index =>$item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <span class="fw-bold d-block">{{ $item->nama_barang }}</span>
                    <small class="text-muted">{{ $item->kode_barang }}</small>
                </td>
                <td>{{ $item->nama_generik ?? '-' }}</td>
                <td class="text-end fw-bold text-success">
                    {{ number_format($item->stok_saat_ini, 0, ',', '.') }}
                </td>
                <td class="text-end fw-bold text-success">
                    {{ $item->aturan_pakai }}
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-primary btn-pilih-obat"
                        data-kode="{{ $item->kode_barang }}" data-nama="{{ $item->nama_barang }}"
                        data-stok="{{ $item->stok_saat_ini }}" data-aturan="{{ $item->aturan_pakai }}" data-sediaan="{{ $item->sediaan }}" >
                        <i class="bi bi-plus-lg"></i> Pilih
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted py-4">
                    <em>Tidak ada data stok barang yang ditemukan.</em>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<script>
      $(function() {
        $("#table-stok-obat").DataTable({
            "responsive": true,
            "lengthChange": false,
            // "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $(document).ready(function() {
        // Fungsi Re-Index Nomor Urut di Tabel Order
        function reindexTableOrder() {
            $('#tbody-edit-order tr:visible').each(function(index) {
                $(this).find('.row-number').text(index + 1);
            });
        }
        // Event Handler saat Tombol "Pilih" di Tabel Stok Diklik
        $(document).on('click', '.btn-pilih-obat', function() {
            var kodeBarang = $(this).data('kode');
            var namaBarang = $(this).data('nama');
            var stokBarang = $(this).data('stok');
            var aturanpakai = $(this).data('aturan');
            var sediaan = $(this).data('sediaan');
            // Validasi jika stok habis (opsional)
            if (parseInt(stokBarang) <= 0) {
                Swal.fire('Stok Kosong!', 'Stok obat ini tidak mencukupi.', 'warning');
                return;
            }

            // Cek apakah obat sudah ada di dalam tabel detail order
            var existingRow = $('#row-edit-' + kodeBarang);

            if (existingRow.length > 0) {
                // Jika sudah ada, tambahkan jumlah obatnya (+1)
                var inputJumlah = existingRow.find('.input-jumlah');
                var currentJumlah = parseInt(inputJumlah.val()) || 0;
                inputJumlah.val(currentJumlah + 1);

                // Efek sorot/highlight row
                existingRow.addClass('table-warning');
                setTimeout(function() {
                    existingRow.removeClass('table-warning');
                }, 1000);

                // Toast notifikasi
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'info',
                    title: 'Jumlah ' + namaBarang + ' ditambah (+1)',
                    showConfirmButton: false,
                    timer: 1500
                });

            } else {
                // Hapus baris kosong/empty state jika ada
                $('#empty-row-edit').remove();

                // Susun HTML baris form order obat baru
                var newRowHtml = `
                <tr id="row-edit-${kodeBarang}">
                    <td class="text-center row-number"></td>
                    <td class="text-center">
                        <code>${kodeBarang}</code>
                        <input type="hidden" name="kode_barang" value="${kodeBarang}">
                        <input type="hidden" name="id_detail" value="">
                    </td>
                    <td>
                        <span class="fw-bold d-block text-dark">${namaBarang}</span>
                        <small hidden class="text-muted">Stok: ${stokBarang}</small>
                    </td>
                      <td class="text-center">
                        <code>${stokBarang} ${sediaan}</code>
                    </td>
                    <td>
                        <select class="form-control" name="jenis_resep">
                            <option value="0">Non Racikan</option>
                            <option value="1">Racikan</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="jenis_obat">
                            <option value="0">Obat Reguler</option>
                            <option value="1">Obat PRB</option>
                            <option value="2">Obat Kronis</option>
                            <option value="3">Obat Kemo</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="jumlah_hari" class="form-control form-control-sm text-center input-hari" value="3" min="1" required>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="number" name="signa_1" class="form-control text-center input-signa1" value="3" min="1" required>
                            <span class="input-group-text px-1">x</span>
                            <input type="number" name="signa_2" class="form-control text-center input-signa2" value="1" min="1" required>
                        </div>
                    </td>
                    <td>
                        <input type="number" name="jumlah_obat" class="form-control form-control-sm text-center input-jumlah fw-bold text-success" value="10" min="1" max="${stokBarang}" required>
                    </td>
                    <td>
                        <input type="text" name="catatan" class="form-control form-control-sm" placeholder="Aturan pakai / Catatan" value="${aturanpakai}">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-row-order" title="Batalkan / Hapus Obat">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            `;

                // Insert baris ke tabel detail order
                $('#tbody-edit-order').append(newRowHtml);
                reindexTableOrder();

                // Toast notifikasi berhasil
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: namaBarang + ' ditambahkan ke order',
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            // Sembunyikan Modal Stok Obat (jika tabel stok di dalam Modal Bootstrap)
            if ($('#modal-stok-obat').length) {
                $('#modal-stok-obat').modal('hide');
            }
        });

    });
</script>
