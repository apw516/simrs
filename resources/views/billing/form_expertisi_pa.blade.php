<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Hasil Expertisi Pathology Anatomi</h5>
        </div>
        <div class="card-body">
            @if (empty($expertisi) || (is_iterable($expertisi) && count($expertisi) == 0))
                <!-- Tampilan Jika Data Kosong (Bootstrap 4) -->
                <div class="alert alert-warning text-center p-4" role="alert">
                    <i class="fas fa-exclamation-triangle fa-3x d-block mb-3"></i>
                    <h5>Belum Ada Data Expertisi</h5>
                    <p class="text-muted">Silakan ambil nomor sediaan terlebih dahulu untuk memulai pengisian hasil
                        expertisi.</p>
                    <form id="formGenerateNomor">
                        <div class="modal-body">
                            <input type="hidden" name="id_header" value="{{ $ID_HEADER }}">
                            <div class="form-group">
                                <label for="jenis_pemeriksaan">Jenis Pemeriksaan PA</label>
                                <select class="form-control" id="jenis_pemeriksaan" name="jenis_pemeriksaan" required>
                                    <option value="" selected disabled>-- Pilih Jenis Pemeriksaan --</option>
                                    <option value="1">Hispatologi</option>
                                    <option value="2">Biopsi Jarum Halus (FNAB)</option>
                                    <option value="3">Sitologi</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" id="btnSubmitNomor" class="btn btn-primary">Generate Nomor</button>
                        </div>
                    </form>
                </div>
            @else
                <!-- Tampilan Jika Data Sudah Ada -->
                {{-- @php $data = is_iterable($expertisi) ? $expertisi[0] : $expertisi; @endphp
                <form action="{{ route('expertisi.update', $data->id_header) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold">Nomor Sediaan</label>
                            <input type="text" class="form-control" value="{{ $data->no_sediaan ?? '' }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold">Jenis Pemeriksaan</label>
                            <input type="text" class="form-control" value="{{ $data->jenis_pemeriksaan ?? '' }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Makroskopis</label>
                        <textarea class="form-control" name="makroskopis" rows="3">{{ $data->makroskopis ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Mikroskopis</label>
                        <textarea class="form-control" name="mikroskopis" rows="4">{{ $data->mikroskopis ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Kesimpulan / Diagnosa</label>
                        <textarea class="form-control" name="kesimpulan" rows="3">{{ $data->kesimpulan ?? '' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save mr-1"></i> Simpan Hasil Expertisi
                    </button>
                </form> --}}
            @endif
        </div>
    </div>
</div>

<!-- Script Handling AJAX -->
<script>
    $('#btnSubmitNomor').on('click', function() {
        let jenis = $('#jenis_pemeriksaan').val();
        let idHeader = $('input[name="id_header"]').val();

        if (!jenis) {
            alert('Silakan pilih jenis pemeriksaan terlebih dahulu!');
            return;
        }

        $.ajax({
            url: "{{ route('expertisi.generate_nomor') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id_header: idHeader,
                jenis_pemeriksaan: jenis
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message || 'Gagal mengambil nomor sediaan.');
                }
            },
            error: function(err) {
                alert('Terjadi kesalahan pada sistem.');
            }
        });
    });
</script>
