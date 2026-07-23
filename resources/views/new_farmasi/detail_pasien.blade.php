<!-- 1. DETAIL PASIEN (COMPONENTS SEBELUMNYA) -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3"
        style="cursor: pointer;" data-toggle="collapse" data-target="#patientDetailBody" aria-expanded="true"
        aria-controls="patientDetailBody">

        <div class="d-flex align-items-center">
            <i class="fas fa-chevron-down toggle-icon transition-icon mr-2"></i>
            <span class="font-weight-bold"><i class="fas fa-id-card mr-2"></i>Detail Pasien</span>
        </div>
        <span class="badge badge-light text-primary" style="font-size: 0.9rem;">No. RM:
            {{ $data_kunjungan[0]->no_rm ?? '' }}</span>
    </div>
    <div id="patientDetailBody" class="collapse">
        <div class="card-body p-4">
            <div class="row">
                <!-- Kolom Kiri: Informasi Pribadi -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">
                        <i class="fas fa-user mr-2"></i>Data Pribadi
                    </h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 40%;">Nama Lengkap</td>
                                <td class="font-weight-bold">: {{ $mt_pasien[0]->nama_px ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIK</td>
                                <td>: {{ $mt_pasien[0]->nik_bpjs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">TTL / Usia</td>
                                <td>: {{ $mt_pasien[0]->tempat_lahir ?? '-' }}, {{ $mt_pasien[0]->tgl_lahir ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis Kelamin</td>
                                <td>:
                                    @if (isset($mt_pasien[0]->jenis_kelamin) && strtoupper($mt_pasien[0]->jenis_kelamin) == 'P')
                                        Perempuan
                                    @elseif(isset($mt_pasien[0]->jenis_kelamin) && strtoupper($mt_pasien[0]->jenis_kelamin) == 'L')
                                        Laki - Laki
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Kolom Kanan: Kontak & Asuransi -->
                <div class="col-md-6">
                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">
                        <i class="fas fa-phone-alt mr-2"></i>Kontak & Penjamin
                    </h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 40%;">No. Telepon</td>
                                <td>: {{ $mt_pasien[0]->no_tlp ?? '-' }} / {{ $mt_pasien[0]->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td>: {{ $mt_pasien[0]->alamatpx ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Penjamin / BPJS</td>
                                <td>: <span
                                        class="badge badge-success">{{ $data_kunjungan[0]->nama_penjamin ?? '-' }}</span><br>&nbsp;
                                    {{ $mt_pasien[0]->no_Bpjs ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. FORM INPUT OBAT (KOMPONEN BARU) -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h6 class="font-weight-bold text-primary m-0">
            <i class="fas fa-pills mr-2"></i>Input Resep / Obat Pasien
        </h6>
    </div>
    <div class="card-body p-4">
        <form action="" method="POST" id="formInputObat">
            @csrf
            <!-- Hidden Input untuk menangkap No RM / Kunjungan -->
            <input type="hidden" name="no_rm" value="{{ $data_kunjungan[0]->no_rm ?? '' }}">

            <div class="row">
                <!-- Select Nama Obat -->
                <div class="col-md-3 mb-3">
                    <label class="font-weight-bold small text-muted">NO SEP KUNJUNGAN</label>
                    <input type="text" name="no_sep" class="form-control" placeholder="0" min="1"
                        value="{{ $data_kunjungan[0]->no_sep }}">
                </div>

                <!-- Jumlah / Qty -->
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Tanggal Resep</label>
                    <input type="date" name="jumlah" class="form-control" placeholder="0" min="1" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Tanggal Pelayanan Resep</label>
                    <input type="date" name="jumlah" class="form-control" placeholder="0" min="1" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Dokter</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="0" min="1" required>
                </div>
            </div>
            <!-- Tombol Tambah ke Daftar -->
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-success btn-block font-weight-bold" data-toggle="modal"
                    data-target="#modalpilihobat">
                    <i class="fas fa-plus mr-1"></i> Pilih Obat
                </button>
            </div>
    </div>
    </form>
    <hr class="my-4">
    <h6 class="text-uppercase text-muted font-weight-bold mb-3 style-sm">
        <i class="fas fa-list-ol mr-2"></i>Daftar Obat Terpilih
    </h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th style="width: 40px;" class="text-center">No</th>
                    <th style="min-width: 90px;">Nama Obat</th>
                    <th style="width: 180px;">Jenis Resep</th>
                    <th style="width: 180px;">Jenis Obat</th>
                    <th style="width: 90px;">Iterasi</th>
                    <th style="width: 80px;">Jlh Iter</th>
                    <th style="width: 90px;">Jlh Hari</th>
                    <th style="width: 120px;">Signa 1</th>
                    <th style="width: 80px;"></th>
                    <th style="width: 140px;">Signa 2</th>
                    <th style="width: 100px;">Total Qty</th>
                    <th style="min-width: 120px;">Catatan</th>
                    <th style="width: 60px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="wrapper-obat-terpilih">
                <!-- Row Default Saat Kosong -->
                <tr id="empty-row">
                    <td colspan="12" class="text-center text-muted font-italic py-3">
                        Belum ada obat yang dipilih. Klik tombol "Pilih" pada tabel obat.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Tombol Submit -->
    <div class="d-flex justify-content-end mt-3 mb-4">
        <button type="button" id="btn-submit-obat" class="btn btn-primary px-4 font-weight-bold"
            onclick="simpanresep()">
            <i class="fas fa-save mr-2"></i>Simpan Resep
        </button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpilihobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table-stok-obat"
                        class="table table-striped table-hover table-bordered align-middle w-100">
                        <thead class="table-dark text-center">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Barang</th>
                                <th>Nama Generik</th>
                                <th>Stok</th>
                                <th style="width: 80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stokBarang as $index => $item)
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
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary btn-pilih-obat"
                                            data-kode="{{ $item->kode_barang }}"
                                            data-nama="{{ $item->nama_barang }}"
                                            data-stok="{{ $item->stok_saat_ini }}">
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
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Stylings & Helper Rotasi Collapse Icon -->
<style>
    .transition-icon {
        transition: transform 0.3s ease;
    }

    [aria-expanded="false"] .toggle-icon {
        transform: rotate(-90deg);
    }

    .transition-icon {
        transition: transform 0.3s ease;
    }

    /* Memutar panah ke kanan saat collapse tertutup */
    [aria-expanded="false"] .toggle-icon {
        transform: rotate(-90deg);
    }
</style>
<script>
    $(document).ready(function() {
        // 1. Inisialisasi DataTables
        var tableObat = $('#table-stok-obat').DataTable({
            "pageLength": 10,
            "language": {
                "search": "Cari Obat:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Obat tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ obat",
                "infoEmpty": "Tidak ada data",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "›",
                    "previous": "‹"
                }
            }
        });

        // 2. Event Listener Klik Tombol 'Pilih'
        $('#table-stok-obat').on('click', '.btn-pilih-obat', function() {
            var kodeBarang = $(this).data('kode');
            var namaBarang = $(this).data('nama');
            var maxStok = parseInt($(this).data('stok')) || 999;

            // Cek apakah obat sudah ada di dalam tabel terpilih
            var existingRow = $('#row-obat-' + kodeBarang);

            if (existingRow.length > 0) {
                // Jika obat sudah ada, tambahkan nilai 'jumlahobat' (+1)
                var inputQty = existingRow.find('.input-jumlah-obat');
                var currentQty = parseInt(inputQty.val()) || 0;

                if (currentQty < maxStok) {
                    inputQty.val(currentQty + 1);
                } else {
                    alert('Jumlah melebihi stok yang tersedia (' + maxStok + ')');
                }
            } else {
                // Hapus pesan "Belum ada obat" (empty-row)
                $('#empty-row').hide();

                // Hitung nomor urut baris
                var noUrut = $('#wrapper-obat-terpilih tr').not('#empty-row').length + 1;

                // Generate HTML Baris Baru sesuai <th> Tabel
                var htmlRow = `
                <tr id="row-obat-${kodeBarang}">
                    <td class="text-center nomor-urut">${noUrut}</td>
                    <td>
                        <span class="font-weight-bold d-block">${namaBarang}</span>
                        <small class="text-muted">${kodeBarang}</small>
                        <input type="hidden" name="kode_barang" value="${kodeBarang}">
                    </td>
                    <td>
                        <select name="jenis_resep" class="form-control form-control-sm">
                            <option value="R/">R/ (Non-Racik)</option>
                            <option value="Racikan">Racikan</option>
                        </select>
                    </td>
                    <td>
                        <select name="jenis_obat" class="form-control form-control-sm">
                            <option value="Reguler">Reguler</option>
                            <option value="Kronis">Kronis</option>
                            <option value="PRB">PRB</option>
                            <option value="Kemoterapi">Kempoterapi</option>
                        </select>
                    </td>
                    <td>
                        <select name="iterasi" class="form-control form-control-sm text-center">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="jlh_iterasi" class="form-control form-control-sm text-center" value="0" min="0">
                    </td>
                    <td>
                        <input type="number" name="jumlahhari" class="form-control form-control-sm text-center" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="signa1" class="form-control form-control-sm text-center" value="3" min="1" required>
                    </td>
                    <td  class="text-center align-middle font-weight-bold">
                        <span class="mr-1">x</span>
                    </td>
                    <td>
                            <input type="number" name="signa2" class="form-control form-control-sm text-center" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" name="jumlahobat" class="form-control form-control-sm text-center input-jumlah-obat" value="1" min="1" max="${maxStok}" required>
                    </td>
                    <td>
                        <input type="text" name="catatan" class="form-control form-control-sm" placeholder="Contoh: Ssh Makan">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-obat">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            `;

                $('#wrapper-obat-terpilih').append(htmlRow);
            }

            updateNomorUrut();
            checkSubmitButton();
        });

        // 3. Event Listener Hapus Baris Obat
        $('#wrapper-obat-terpilih').on('click', '.btn-hapus-obat', function() {
            $(this).closest('tr').remove();

            // Jika tabel kosong, tampilkan kembali row empty
            if ($('#wrapper-obat-terpilih tr').not('#empty-row').length === 0) {
                $('#empty-row').show();
            }

            updateNomorUrut();
            checkSubmitButton();
        });

        // Helper: Update Nomor Urut Baris secara Dinamis
        function updateNomorUrut() {
            $('#wrapper-obat-terpilih tr').not('#empty-row').each(function(index) {
                $(this).find('.nomor-urut').text(index + 1);
            });
        }

        // Helper: Enable / Disable Tombol Simpan
        function checkSubmitButton() {
            var totalItem = $('#wrapper-obat-terpilih tr').not('#empty-row').length;
            if (totalItem > 0) {
                $('#btn-submit-obat').prop('disabled', false);
            } else {
                $('#btn-submit-obat').prop('disabled', true);
            }
        }
    });

    function simpanresep() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Pastikan data sudah terisi dengan benar!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan resep !"
        }).then((result) => {
            if (result.isConfirmed){
                save()
            }
        });
    }
    function save()
    {
        alert('ok')
    }
</script>
