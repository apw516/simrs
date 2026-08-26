<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary"><i class="bi bi-clipboard2-data-fill"></i> Form Order & Billing
            Penunjang</h4>
        <a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm"><i
                class="fa-solid fa-arrow-left me-1"></i> Kembali</a>
    </div>

    @php
        $detail = $datakunjungan->first();
    @endphp

    <!-- SECTION 1: DETAIL PASIEN & KUNJUNGAN -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white font-weight-bold">
            <h6 class="mb-0 text-dark"><i class="fa-solid fa-user-injured me-2 text-primary"></i>Detail Kunjungan
                Pasien</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label text-muted mb-0">No RM</label>
                    <p class="fw-bold mb-0 text-dark">{{ $detail->no_rm ?? $noRm }}</p>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted mb-0">Nama Pasien</label>
                    <p class="fw-bold mb-0 text-dark">{{ $detail->nama_pasien ?? $nama }}</p>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted mb-0">Kode Kunjungan</label>
                    <p class="fw-bold mb-0 text-primary">{{ $detail->kode_kunjungan ?? $kodeKunjungan }}</p>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted mb-0">Poliklinik / Unit Asal</label>
                    <p class="fw-bold mb-0 text-dark">{{ $detail->nama_unit ?? $unit }}</p>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted mb-0">Penjamin / Jaminan</label>
                    <p class="fw-bold mb-0 text-dark"><span
                            class="badge bg-info text-dark">{{ $detail->nama_penjamin ?? '-' }}</span></p>
                </div>
                <div class="col-md-3">
                    <label class="form-label text-muted mb-0">Tgl Masuk</label>
                    <p class="fw-bold mb-0 text-dark">
                        {{ isset($detail->tgl_masuk) ? \Carbon\Carbon::parse($detail->tgl_masuk)->format('d-m-Y H:i') : '-' }}
                    </p>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted mb-0">Alamat</label>
                    <p class="fw-bold mb-0 text-dark">{{ $detail->alamat_pasien ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- SECTION 2: MASTER TARIF (SELEKSI) -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 text-dark"><i class="fa-solid fa-list-check me-2 text-primary"></i>Pilih Tarif /
                        Pelayanan Lab</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableMasterTarif" class="table table-striped table-bordered hover align-middle w-100"
                            style="font-size: 13px;">
                            <thead class="table-light">
                                <tr>
                                    <th>Kode / Nama Tarif</th>
                                    <th>Kategori</th>
                                    <th>Tarif (Rp)</th>
                                    <th class="text-center" style="width: 60px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarif as $t)
                                    @php
                                        // Menyesuaikan penamaan kolom yang berasal dari Stored Procedure
                                        $KODE_TARIF = $t->kode ?? ($t->kode_tarif ?? ($t->KODE ?? $loop->iteration));
                                        $NAMA_TARIF =
                                            $t->Tindakan ?? ($t->NAMA_PELAYANAN ?? ($t->nama_tarif ?? 'Pelayanan'));
                                        $TOTAL_TARIF = $t->tarif ?? ($t->TARIF ?? ($t->tarif ?? 0));
                                        $KATEGORI = $t->NAMA_KATEGORI ?? ($t->KATEGORI ?? '-');
                                    @endphp
                                    <tr>
                                        <td>
                                            <strong>{{ $NAMA_TARIF }}</strong><br>
                                            <small class="text-muted">{{ $KODE_TARIF }}</small>
                                        </td>
                                        <td>{{ $KATEGORI }}</td>
                                        <td class="text-end fw-bold">Rp
                                            {{ number_format($TOTAL_TARIF, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-primary btn-pilih-tarif"
                                                data-kode="{{ $KODE_TARIF }}" data-nama="{{ $NAMA_TARIF }}"
                                                data-tarif="{{ $TOTAL_TARIF }}">
                                                <i class="bi bi-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION 3: TABEL LIST TAGIHAN TERPILIH -->
        <div class="col-lg-6 mb-4">
            <form action="{{ route('billing.simpan_penunjang') }}" method="POST" id="formTagihan">
                @csrf
                <input type="hidden" name="kode_kunjungan" value="{{ $detail->kode_kunjungan ?? $kodeKunjungan }}">
                <input type="hidden" name="no_rm" value="{{ $detail->no_rm ?? $noRm }}">

                <div class="card shadow-sm h-100 border-primary">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h6 class="mb-0"><i class="fa-solid fa-cart-flatbed me-2"></i>Rincian Tagihan Yang Dipilih
                        </h6>
                        <span class="badge bg-light text-primary" id="jumlahItemBadge">0 Item</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-bordered table-selected align-middle mb-0" id="tableSelectedTarif"
                                style="font-size: 13px;">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th>Nama Layanan / Tarif</th>
                                        <th style="width: 100px;">Harga (Rp)</th>
                                        <th style="width: 80px;" class="text-center">Qty</th>
                                        <th style="width: 110px;" class="text-end">Subtotal (Rp)</th>
                                        <th style="width: 40px;" class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody id="listTarifBody">
                                    <tr id="emptyRow">
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fa-solid fa-basket-shopping fa-2x mb-2"></i><br>
                                            Belum ada tarif yang dipilih. Silakan klik tombol <strong>Pilih</strong>
                                            dari tabel sebelah kiri.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fs-6 fw-bold">TOTAL TAGIHAN:</span>
                            <span class="fs-4 fw-bold text-success" id="grandTotalText">Rp 0</span>
                            <input type="hidden" name="grand_total" id="grandTotalInput" value="0">
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold" id="btnSimpan" disabled>
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Tagihan & Order
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables Master Tarif
        var tableMaster = $('#tableMasterTarif').DataTable({
            "language": {
                "search": "Cari Tarif/Layanan:",
                "lengthMenu": "Tampilkan _MENU_",
                "zeroRecords": "Tarif tidak ditemukan",
                "info": "Tampil _START_ - _END_ dari _TOTAL_ tarif",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            },
            "pageLength": 8,
            "lengthMenu": [5, 8, 15, 25]
        });

        // Handle Klik Tombol "Pilih"
        $('#tableMasterTarif').on('click', '.btn-pilih-tarif', function() {
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var tarif = parseFloat($(this).data('tarif')) || 0;

            // Cek apakah item sudah ada di tabel keranjang
            if ($('#row_' + kode).length > 0) {
                // Jika sudah ada, tambahkan qty +1
                var inputQty = $('#qty_' + kode);
                var currentQty = parseInt(inputQty.val()) || 0;
                inputQty.val(currentQty + 1).trigger('change');

                // Efek Highlight sederhana
                $('#row_' + kode).addClass('table-warning');
                setTimeout(function() {
                    $('#row_' + kode).removeClass('table-warning');
                }, 500);
                return;
            }

            // Hilangkan pesan kosong jika item pertama ditambahkan
            $('#emptyRow').hide();

            // Buat Baris Tabel Baru
            var htmlRow = `
            <tr id="row_${kode}">
                <td>
                    <strong>${nama}</strong>
                    <input type="hidden" name="items[${kode}][kode_tarif]" value="${kode}">
                    <input type="hidden" name="items[${kode}][nama_tarif]" value="${nama}">
                </td>
                <td>
                    Rp ${formatRupiah(tarif)}
                    <input type="hidden" class="harga-input" name="items[${kode}][harga]" value="${tarif}">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm text-center qty-input" 
                           name="items[${kode}][qty]" id="qty_${kode}" value="1" min="1" data-kode="${kode}">
                </td>
                <td class="text-end fw-bold subtotal-text" id="subtotal_${kode}">
                    Rp ${formatRupiah(tarif)}
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-kode="${kode}">
                        <i class="bi bi-recycle"></i>
                    </button>
                </td>
            </tr>
        `;

            $('#listTarifBody').append(htmlRow);
            hitungGrandTotal();
        });

        // Handle Perubahan Qty Input
        $('#tableSelectedTarif').on('change keyup', '.qty-input', function() {
            var kode = $(this).data('kode');
            var qty = parseInt($(this).val()) || 0;

            if (qty < 1) {
                qty = 1;
                $(this).val(1);
            }

            var harga = parseFloat($('#row_' + kode + ' .harga-input').val()) || 0;
            var subtotal = harga * qty;

            $('#subtotal_' + kode).text('Rp ' + formatRupiah(subtotal));
            hitungGrandTotal();
        });

        // Handle Hapus Item
        $('#tableSelectedTarif').on('click', '.btn-hapus', function() {
            var kode = $(this).data('kode');
            $('#row_' + kode).remove();

            // Jika tidak ada baris selain emptyRow, tampilkan kembali pesan kosong
            if ($('#listTarifBody tr').length === 1) {
                $('#emptyRow').show();
            }

            hitungGrandTotal();
        });

        // Fungsi Menghitung Total Keseluruhan
        function hitungGrandTotal() {
            var grandTotal = 0;
            var totalItem = 0;

            $('#listTarifBody tr').each(function() {
                if ($(this).attr('id') !== 'emptyRow') {
                    var harga = parseFloat($(this).find('.harga-input').val()) || 0;
                    var qty = parseInt($(this).find('.qty-input').val()) || 0;
                    grandTotal += (harga * qty);
                    totalItem++;
                }
            });

            $('#grandTotalText').text('Rp ' + formatRupiah(grandTotal));
            $('#grandTotalInput').value = grandTotal;
            $('#jumlahItemBadge').text(totalItem + ' Item');

            // Enable / Disable Tombol Simpan
            if (totalItem > 0) {
                $('#btnSimpan').prop('disabled', false);
            } else {
                $('#btnSimpan').prop('disabled', true);
            }
        }

        // Helper Format Angka ke Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        // Submit Handler / Validasi sederhana
        // $('#formTagihan').on('submit', function(e) {
        //     if ($('#listTarifBody tr:visible').not('#emptyRow').length === 0) {
        //         e.preventDefault();
        //         Swal.fire('Peringatan', 'Silakan pilih setidaknya satu tarif layanan terlebih dahulu.',
        //             'warning');
        //     }
        // });
        $('#formTagihan').on('submit', function(e) {
            e.preventDefault();

            if ($('#listTarifBody tr:visible').not('#emptyRow').length === 0) {
                return Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Silakan pilih setidaknya satu tarif layanan terlebih dahulu.',
                    confirmButtonColor: '#0d6efd'
                });
            }

            // Tampilkan Loading Alert
            Swal.fire({
                title: 'Menyimpan Data...',
                text: 'Mohon tunggu sejenak',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // NOTIFIKASI SUKSES DITAMPILKAN DI SINI
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil Disimpan!',
                        text: response.message ||
                            'Data order & billing penunjang berhasil disimpan.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Opsional: Redirect ke halaman lain atau reset form
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    });
                },
                error: function(xhr) {
                    let errorMsg = 'Terjadi kesalahan saat menyimpan data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }

                    // NOTIFIKASI GAGAL
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan',
                        text: errorMsg,
                        confirmButtonColor: '#dc3545'
                    });
                }
            });
        });
    });
</script>
