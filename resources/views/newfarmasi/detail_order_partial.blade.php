    <input type="hidden" id="id_header_order" name="id_header" value="{{ $orderHeader->id ?? '' }}">
    <input type="hidden" id="kode_kunjungan" name="kode_kunjungan" value="{{ $orderHeader->kode_kunjungan ?? '' }}">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Edit / Detail Order Farmasi</h6>
            <div>
                <button type="button" class="btn btn-sm btn-light fw-bold btn-kembali me-1">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3 bg-light p-2 rounded border mx-0 align-items-center">
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Nama Pasien / No RM</small>
                    <strong>{{ $orderHeader->nama_pasien ?? '-' }} ({{ $orderHeader->no_rm ?? '-' }})</strong>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Dokter DPJP</small>
                    <strong>{{ $orderHeader->nama_dokter ?? '-' }}</strong>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Status Order</small>
                    @if (($orderHeader->status_order ?? 1) == 1)
                        <span class="badge bg-warning text-dark"><i class="bi bi-clock-history me-1"></i>Dapat
                            Diubah</span>
                    @else
                        <span class="badge bg-secondary"><i class="bi bi-lock-fill me-1"></i>Terkunci</span>
                    @endif
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Unit Pengirim</small>
                    <strong>{{ $orderHeader->nama_unit_pengirim ?? '-' }}</strong>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Penjamin</small>
                    <strong>{{ $orderHeader->nama_penjamin ?? '-' }}</strong>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">No SEP Kunjungan</small>
                    <strong>{{ $orderHeader->no_sep ?? '-' }}</strong>
                </div>
                <div class="col-12">
                    <hr class="my-2 text-muted">
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-group">
                        <label for="tgl_resep" class="form-label small fw-bold text-dark">Tanggal Resep</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_resep" name="tgl_resep"
                            value="{{ $orderHeader->tgl_resep ?? date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-group">
                        <label for="tgl_pelayanan" class="form-label small fw-bold text-dark">Tanggal Pelayanan</label>
                        <input type="date" class="form-control form-control-sm" id="tgl_pelayanan"
                            name="tgl_pelayanan" value="{{ $orderHeader->tgl_pelayanan ?? date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-group">
                        <label class="form-label small fw-bold text-dark d-block">Jenis Resep</label>
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input radio-iterasi" type="radio" name="jenis_iterasi"
                                id="iterasi_tidak" value="0"
                                {{ ($orderHeader->iterasi ?? 0) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label small" for="iterasi_non">Non - Iterasi</label>
                        </div>
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input radio-iterasi" type="radio" name="jenis_iterasi"
                                id="iterasi_ya" value="1"
                                {{ ($orderHeader->iterasi ?? 1) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label small" for="iterasi_ya">Iterasi</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mt-2">
                    <div class="form-group">
                        <label for="jumlah_iterasi" class="form-label small fw-bold text-dark">Jumlah Iterasi</label>
                        <div class="input-group input-group-sm">
                            <input type="number" class="form-control form-control-sm text-center fw-bold"
                                id="jumlah_iterasi" name="jumlah_iterasi"
                                value="{{ $orderHeader->jumlah_iterasi ?? 0 }}" min="0" max="10"
                                placeholder="0" {{ ($orderHeader->jenis_iterasi ?? 0) == 1 ? '' : 'disabled' }}>
                            <span class="input-group-text form-control-sm">Kali</span>
                        </div>
                    </div>
                </div>
            </div>
            <button type ="button" class="btn btn-info mb-2" onclick="ambilstokobat()" data-toggle="modal"
                data-target="#modaltambahobat"><i class="bi bi-plus-circle me-1"></i> Tambah Obat
                Ke Order Ini</button>
            <button class="btn btn-info mb-2"><i class="bi bi-plus-circle me-1"></i> Template Obat Racik</button>
            <button class="btn btn-warning mb-2 float-right"><i class="bi bi-plus-circle me-1"></i> Buat Obat
                Racik</button>
            <div class="table-responsive">
                <form id="form-update-order-farmasi" class="formobat">
                    <table class="table table-sm table-striped table-bordered align-middle"
                        id="tabel-edit-detail-order">
                        <thead class="table-dark text-center small">
                            <tr>
                                <th style="width: 40px;">No</th>
                                <th style="width: 100px;">Kode</th>
                                <th>Nama Obat / Barang</th>
                                <th style="width: 150px;">Stok Tersedia</th>
                                <th style="width: 150px;">Jenis Resep</th>
                                <th style="width: 150px;">Jenis Obat</th>
                                <th style="width: 90px;">Hari</th>
                                <th style="width: 130px;">Signa / Aturan</th>
                                <th style="width: 90px;">Jumlah</th>
                                <th>Catatan</th>
                                <th style="width: 60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-edit-order">
                            @forelse($orderDetail as $index => $item)
                                <tr id="row-edit-{{ $item->kode_barang }}">
                                    <td class="text-center row-number">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        <code>{{ $item->kode_barang }}</code>
                                        <input type="hidden" name="kode_barang" value="{{ $item->kode_barang }}">
                                        <input type="hidden" name="id_detail" value="{{ $item->id }}">
                                    </td>
                                    <td>
                                        <span class="fw-bold d-block text-dark">{{ $item->nama_barang }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fw-bold d-block text-dark">{{ $item->stok_akhir_unit }}
                                            {{ $item->sediaan }}</span>
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
                                        <input type="number" name="jumlah_hari"
                                            class="form-control form-control-sm text-center input-hari"
                                            value="{{ $item->jumlah_hari }}" min="1" required>
                                    </td>
                                    <td>
                                        <div class="input-group input-group-sm">
                                            <input type="number" name="signa_1"
                                                class="form-control text-center input-signa1"
                                                value="{{ $item->signa_1 }}" min="1" required>
                                            <span class="input-group-text px-1">x</span>
                                            <input type="number" name="signa_2"
                                                class="form-control text-center input-signa2"
                                                value="{{ $item->signa_2 }}" min="1" required>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="jumlah_obat"
                                            class="form-control form-control-sm text-center input-jumlah fw-bold text-success"
                                            value="{{ $item->jumlah_obat }}" min="1" required>
                                    </td>
                                    <td>
                                        <input type="text" name="catatan" class="form-control form-control-sm"
                                            value="{{ $item->catatan ?? '' }}" placeholder="Catatan / Aturan Pakai">
                                    </td>
                                    <td class="text-center">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-hapus-row-order"
                                            title="Batalkan / Hapus Obat Ini">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr id="empty-row-edit">
                                    <td colspan="8" class="text-center text-muted py-3">Tidak ada item detail obat
                                        dalam
                                        order ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center bg-white">
            <button type="button" class="btn btn-secondary btn-sm btn-kembali">
                <i class="bi bi-arrow-left me-1"></i> Batal / Kembali
            </button>
            <button type="button" class="btn btn-primary btn-sm fw-bold" id="btn-simpan-update-order"
                onclick="simpanorder()">
                <i class="bi bi-check-circle me-1"></i> Terima Order / Save Data Pelayanan Resep
            </button>
        </div>
    </div>
    <div class="modal fade" id="modaltambahobat" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="v_22">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function ambilstokobat() {
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambilstokobatfarmasi') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('Error')
                },
                success: function(response) {
                    $('.v_22').html(response);
                    spinner.hide()
                }
            });
        }
        $(document).ready(function() {
            // Event listener saat radio button iterasi berubah
            $('.radio-iterasi').on('change', function() {
                if ($('#iterasi_ya').is(':checked')) {
                    // Jika pilih Iterasi -> Aktifkan input jumlah
                    $('#jumlah_iterasi').prop('disabled', false).focus();
                    if ($('#jumlah_iterasi').val() == 0) {
                        $('#jumlah_iterasi').val(1); // Set default 1 kali
                    }
                } else {
                    // Jika pilih Non-Iterasi -> Nonaktifkan & set angka 0
                    $('#jumlah_iterasi').prop('disabled', true).val(0);
                }
            });
        });

        function simpanorder() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Pastikan data sudah diisi dengan benar !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan !"
            }).then((result) => {
                if (result.isConfirmed) {
                    save()
                }
            });
        }

        function save() {
            var dataobat = $('.formobat').serializeArray();
            var is_simpan_template = $('#is_simpan_template:checked').val()
            var nama_resep = $('#nama_resep').val()
            tgl_resep = $('#tgl_resep').val()
            tgl_pelayanan = $('#tgl_pelayanan').val()
            iterasi_tidak = $('#iterasi_tidak').val()
            iterasi_ya = $('#iterasi_ya').val()
            jumlah_iterasi = $('#jumlah_iterasi').val()
            id_order_header = $('#id_header_order').val()
            kode_kunjungan = $('#kode_kunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    dataobat: JSON.stringify(dataobat),
                    is_simpan_template,
                    nama_resep,
                    tgl_resep,
                    tgl_pelayanan,
                    iterasi_tidak,
                    iterasi_ya,
                    jumlah_iterasi,
                    id_order_header,
                    kode_kunjungan
                },
                url: '<?= route('simpandatapelayananobat') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Ooops....',
                        text: 'Sepertinya ada masalah......',
                        footer: ''
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oopss...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: data.message,
                            footer: ''
                        })
                        location.reload()
                    }
                }
            });
        }
    </script>
