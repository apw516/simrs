<div class="riwayat-resep-wrapper">
    @forelse ($dataKunjungan as $kunjungan)
        @php
            $details = $dataResepDetail->get($kunjungan->id_header) ?? collect();
        @endphp

        <div class="card mb-3 shadow-sm border">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <div>
                    <span class="badge bg-primary me-2">
                        <i class="bi bi-receipt me-1"></i>{{ $kunjungan->kode_layanan_header }}
                    </span>
                    <strong class="text-dark">{{ $kunjungan->unit_kunjungan }}</strong>
                    <span class="text-muted small ms-2">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ \Carbon\Carbon::parse($kunjungan->tgl_masuk)->translatedFormat('d F Y - H:i') }}
                    </span>
                </div>
                <div>
                    <span class="badge bg-secondary">
                        <i class="bi bi-person-badge me-1"></i>{{ $kunjungan->nama_dokter }}
                    </span>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($details->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped mb-0 align-middle">
                            <thead class="table-secondary small">
                                <tr>
                                    <th class="text-center" style="width: 40px;">No</th>
                                    <th style="width: 110px;">Kode</th>
                                    <th>Nama Obat / Barang</th>
                                    <th class="text-center" style="width: 80px;">Jumlah</th>
                                    <th>Aturan Pakai</th>
                                    <th class="text-center" style="width: 90px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td><code>{{ $item->kode_barang }}</code></td>
                                        <td class="fw-bold text-dark">{{ $item->nama_barang }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-info text-dark">{{ $item->jumlah_layanan }}</span>
                                        </td>
                                        <td class="text-primary fw-semibold">
                                            {{ $item->aturan_pakai ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                class="btn btn-sm btn-outline-success btn-pilih-riwayat-obat"
                                                data-kode="{{ $item->kode_barang }}"
                                                data-nama="{{ $item->nama_barang }}"
                                                data-jumlah="{{ $item->jumlah_layanan }}"
                                                data-aturan="{{ $item->aturan_pakai }}">
                                                <i class="bi bi-plus-circle me-1"></i>Pilih
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-3 text-center text-muted small">
                        <i class="bi bi-exclamation-circle me-1"></i>Tidak ada rincian obat pada kunjungan ini.
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center mb-0" role="alert">
            <i class="bi bi-info-circle me-1"></i> Belum ada riwayat resep obat untuk pasien ini.
        </div>
    @endforelse
</div>
<script>
    // Handling event saat tombol "Pilih" pada riwayat obat diklik
    $(document).on('click', '.btn-pilih-riwayat-obat', function() {
        var kodeBarang = $(this).data('kode');
        var namaBarang = $(this).data('nama');
        var jumlah = $(this).data('jumlah') || 1;
        var aturan = $(this).data('aturan') || '';
        var existingRow = $('#row-obat-' + kodeBarang);

        if (existingRow.length > 0) {
            // Jika obat sudah ada di dalam form, tambahkan jumlahnya
            var inputJumlah = existingRow.find('.input-jumlah');
            var currentJumlah = parseInt(inputJumlah.val()) || 0;
            inputJumlah.val(currentJumlah + parseInt(jumlah));
        } else {
            // Sembunyikan row "Belum ada obat"
            $('#empty-row').hide();
            // Insert baris obat baru ke wrapper form
            var htmlRow = `
                <tr id="row-obat-${kodeBarang}">
                    <td>
                        <span class="fw-bold d-block">${namaBarang}</span>
                        <small class="text-muted">${kodeBarang}</small>
                        <input type="hidden" name="kode_barang" value="${kodeBarang}">
                    </td>
                    <td>
                        <input type="number" name="jumlahhari" class="form-control form-control-sm text-center input-hari" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="signa1" class="form-control form-control-sm text-center input-signa1" value="1" min="1" required>
                    </td>
                    <td class="text-center px-0 fw-bold">x</td>
                    <td>
                        <input type="number" name="signa2" class="form-control form-control-sm text-center input-signa2" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="jumlahobat" class="form-control form-control-sm text-center fw-bold text-success" value="${jumlah}" min="1">
                    </td>
                    <td>
                        <textarea name="catatan" class="form-control form-control-sm text-center" placeholder="contoh : Sesudah Makan / Sebelum Makan" rows="3px">${aturan}</textarea>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-obat">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </td>
                </tr>
            `;

            $('#wrapper-obat-terpilih').append(htmlRow);
        }

        // Aktifkan tombol simpan resep
        if (typeof checkSubmitButton === "function") {
            checkSubmitButton();
        } else {
            $('#btn-submit-obat').prop('disabled', false);
        }
    });
</script>
