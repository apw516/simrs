@if (count($cek) > 0)
    <div class="table-responsive">
        <table class="table table-sm table-hover align-middle" id="tabelgbr">
            <thead class="thead-dark">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Berkas</th>
                    <th>Jenis</th>
                    <th>Unit</th>
                    <th>Tanggal Upload</th>
                    <th width="20%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cek as $d)
                    <tr class="klikklik2" data-id="{{ $d->id }}"
                        data-url="{{ route('showfile2', ['id' => $d->id]) }}">
                        <td class="text-center align-middle">{{ $loop->iteration }}</td>
                        <td class="font-weight-bold align-middle">{{ $d->nama }}</td>
                        <td class="align-middle">{{ $d->jenis_berkas }}</td>
                        <td class="align-middle"><span class="badge badge-info">{{ $d->nama_unit }}</span></td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($d->tgl_upload)->locale('id')->translatedFormat('d F Y H:i') }}</td>
                        <td class="text-center align-middle">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-primary btn-lihat" data-id="{{ $d->id }}"
                                    data-url="{{ route('showfile2', ['id' => $d->id]) }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>
                                <button type="button" class="btn btn-danger hapus" data-id="{{ $d->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-3">
                            <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                            Belum ada berkas yang diunggah.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-secondary text-center mb-0">
        <h5><i class="fas fa-info-circle"></i> Tidak ada berkas yang diupload!</h5>
    </div>
@endif

<!-- Modal Preview Gambar / PDF -->
<div class="modal fade" id="modalgambar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-file-alt"></i> Preview Berkas Penunjang</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center p-3">
                <div class="imageviewer">
                    <!-- Loading placeholder -->
                    <div class="spinner-border text-primary my-5" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('#tabelgbr').on('click', '.klikklik2, .btn-lihat', function(e) {
        // Mencegah trigger jika yang diklik adalah tombol hapus
        if ($(e.target).hasClass('hapus') || $(e.target).parents('.hapus').length) {
            return;
        }
        let id = $(this).data('id');
        let url = $(this).data('url');
        // Tampilkan modal dan animasi loading
        $("#modalgambar").modal('show');
        $('.imageviewer').html(`
            <div class="text-center my-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2">Memuat berkas...</p>
            </div>
        `);

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(response) {
                $('.imageviewer').html(response);
            },
            error: function() {
                $('.imageviewer').html(`
                    <div class="alert alert-danger mb-0">
                        Gagal memuat berkas dari server/NAS.
                    </div>
                `);
            }
        });
    });
    // Event Klik untuk Hapus Berkas
    $('#tabelgbr').on('click', '.hapus', function(e) {
        e.stopPropagation(); // Hentikan event bubbling agar modal preview tidak ikut terbuka

        let id = $(this).data('id');
        let kodekunjungan = $('#kodekunjungan').val();
        let spinner = $('#loader');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "File yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    url: '<?= route('hapusgambarupload') ?>',
                    error: function(data) {
                        spinner.hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sepertinya ada masalah koneksi...',
                            footer: 'ermwaled2023'
                        });
                    },
                    success: function(data) {
                        spinner.hide();
                        if (data.kode == '502') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops',
                                text: data.message,
                                footer: 'ermwaled2023'
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.message,
                                footer: 'ermwaled2023'
                            });
                        }
                        // Reload tabel riwayat upload
                        if (typeof riwayatupload === 'function') {
                            riwayatupload(kodekunjungan);
                        }
                    }
                });
            }
        });
    });
</script>
