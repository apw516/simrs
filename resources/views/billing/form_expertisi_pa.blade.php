<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Layanan & Expertisi</h5>
        <span class="badge badge-light">ID Header: {{ $ID_HEADER }}</span>
    </div>
    <div class="card-body">

        @if ($result->isEmpty())
            <!-- TAMPILAN JIKA DATA NULL / KOSONG -->
            <div class="alert alert-warning text-center p-4 my-3" role="alert">
                <i class="fas fa-exclamation-triangle fa-3x d-block mb-3 text-warning"></i>
                <h5 class="font-weight-bold">Data Layanan Tidak Ditemukan</h5>
                <p class="text-muted mb-3">Tidak ada detail pemeriksaan atau rincian tarif yang terikat dengan ID Header
                    <strong>{{ $ID_HEADER }}</strong>.
                </p>

                <form id="formGenerateNomor" class="d-inline-block text-left style-form-box">
                    <input type="hidden" name="id_header" value="{{ $ID_HEADER }}">
                    <div class="form-group">
                        <label for="jenis_pemeriksaan" class="font-weight-bold">Jenis Pemeriksaan PA</label>
                        <select class="form-control" id="jenis_pemeriksaan" name="jenis_pemeriksaan" required>
                            <option value="" selected disabled>-- Pilih Jenis Pemeriksaan --</option>
                            <option value="1">Hispatologi</option>
                            <option value="2">Biopsi Jarum Halus (FNAB)</option>
                            <option value="3">Sitologi</option>
                        </select>
                    </div>
                    <button type="button" id="btnSubmitNomor" class="btn btn-primary btn-block">
                        <i class="fas fa-cog mr-1"></i> Generate Nomor Sediaan
                    </button>
                </form>
            </div>
        @else
            <!-- TAMPILAN JIKA DATA ADA -->
            @php $header = $result->first(); @endphp
            <!-- Informas Pasien & Kunjungan -->
            <div class="row mb-4 p-3 bg-light rounded border">
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">No. RM / Nama Pasien</small>
                    <strong>{{ $header->no_rm ?? '-' }}</strong> - {{ $header->nama_pasien ?? '-' }}
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Kode Kunjungan</small>
                    <strong>{{ $header->kode_kunjungan ?? '-' }}</strong>
                </div>
                <div class="col-md-4 mb-2">
                    <small class="text-muted d-block">Penjamin</small>
                    <span class="badge badge-info">{{ $header->nama_penjamin ?? '-' }}</span>
                </div>
                <div class="col-md-4 mt-2">
                    <small class="text-muted d-block">Dokter Pengirim</small>
                    <span>{{ $header->dokter_pengirim ?? '-' }}</span>
                </div>
                <div class="col-md-4 mt-2">
                    <small class="text-muted d-block">Dokter Pemeriksa</small>
                    <span>{{ $header->dokter_pemeriksa ?? '-' }}</span>
                </div>
                <div class="col-md-4 mt-2">
                    <small class="text-muted d-block">Status Layanan</small>
                    <span class="badge badge-success">
                        @if ($header->status_layanan == 2)
                            Aktif
                        @else
                            {{ $header->status_layanan }}
                        @endif
                    </span>
                </div>
            </div>
            @if ($header->status_kunjungan != 1)
                <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                    title="Pasien sudah pulang, layanan tidak bisa diretur atau hubungi tim Casemix">
                    <button class="btn btn-danger mb-2" disabled style="pointer-events: none;">
                        <i class="bi bi-trash mr-2"></i> Retur Layanan
                    </button>
                </span>
                <small class="d-block text-danger font-weight-bold mb-1">
                    *Pasien sudah dipulangkan atau status kunjungan sudah ditutup, layanan tidak bisa diretur. Hubungi tim Casemix jika layanan akan diretur...
                </small>
            @else
                <button class="btn btn-danger mb-2">
                    <i class="bi bi-trash mr-2"></i> Retur Layanan
                </button>
            @endif
            <!-- Tabel Detail Layanan/Tarif -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped hover">
                    <thead class="thead-dark">
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th width="20%">Kode Detail</th>
                            <th>Nama Tarif / Layanan</th>
                            <th width="15%" class="text-center">Jumlah</th>
                            <th width="20%" class="text-right">Total Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td><code>{{ $item->kode_tarif_detail }}</code></td>
                                <td>{{ $item->NAMA_TARIF ?? '-' }}</td>
                                <td class="text-center">{{ $item->jumlah_layanan }}</td>
                                <td class="text-right">Rp {{ number_format($item->total_detail ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="font-weight-bold bg-light">
                            <td colspan="4" class="text-right">Total Layanan Header:</td>
                            <td class="text-right text-primary">
                                Rp {{ number_format($header->total_layanan ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        @endif

    </div>
</div>
<div class="card mt-2">
    <div class="card-header bg-success">Hasil Expertisi</div>
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
                            <select class="form-control" id="jenis_pemeriksaan" name="jenis_pemeriksaan">
                                <option value="" selected disabled>-- Pilih Jenis Pemeriksaan --</option>
                                <option value="1">Hispatologi</option>
                                <option value="2">Biopsi Jarum Halus (FNAB)</option>
                                <option value="3">Sitologi</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnSubmitNomor" class="btn btn-primary">Generate
                            Nomor</button>
                    </div>
                </form>
            </div>
        @else
            @php
                $data = is_iterable($expertisi) ? $expertisi[0] : $expertisi;
                $hasil_split = isset($data->hasil) ? array_map('trim', explode('|', $data->hasil)) : [];
                $makro = $hasil_split[0] ?? '';
                $mikro = $hasil_split[1] ?? '';
                $kesimpulan = $hasil_split[2] ?? '';
            @endphp
            <form action="" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="font-weight-bold text-dark">Nama Dokter Pemeriksa</label>
                        <input type="text" class="form-control bg-light font-weight-bold text-primary"
                            value="{{ $data_2->nama_dokter }}" readonly>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label class="font-weight-bold text-dark">Jenis Pemeriksaan</label>
                        <input type="text" class="form-control bg-light font-weight-bold text-primary"
                            value="{{ $data_2->NAMA_TARIF }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="font-weight-bold text-dark">Nomor Sediaan PA</label>
                        <input type="text" class="form-control bg-light font-weight-bold text-primary"
                            value="{{ $data->no_periksa }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="font-weight-bold text-dark">Jenis Sampel</label>
                        <input type="text" name="jenis_sampel" class="form-control bg-light"
                            value="{{ old('jenis_sampel', $data->tipe ?? '') }}" placeholder="Masukkan jenis sampel"
                            readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="font-weight-bold text-dark">Tipe Pemeriksaan</label><br>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="checkbox" name="is_kritis" id="kritis"
                                value="1" {{ old('is_kritis', $data->kritis ?? 0) == 1 ? 'checked' : '' }}
                                onclick="return false;">
                            <label class="form-check-label font-weight-bold text-danger" for="kritis">Kritis</label>
                        </div>
                        <div class="form-check form-check-inline mt-2">
                            <input class="form-check-input" type="checkbox" name="is_cyto" id="cyto"
                                value="1" {{ old('is_cyto', $data->cito ?? 0) == 1 ? 'checked' : '' }}
                                onclick="return false;">
                            <label class="form-check-label font-weight-bold text-warning" for="cyto">Cyto</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Makroskopis</label>
                    <textarea class="form-control bg-light" name="makroskopis" rows="6" readonly>{{ $makro ?? '' }}</textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Mikroskopis</label>
                    <textarea class="form-control bg-light" name="mikroskopis" rows="6" readonly>{{ $mikro ?? '' }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Diagnostik Klinik</label>
                            <textarea class="form-control bg-light" name="diagnostik_klinik" rows="6"
                                placeholder="Masukkan uraian Diagnostik Klinik..." readonly>{{ old('diagnostik_klinik', $data->diagnostik_klinik ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold text-dark">Diagnostik Pasca Bedah</label>
                            <textarea class="form-control bg-light" name="diagnostik_pasca_bedah" rows="6"
                                placeholder="Masukkan uraian Diagnostik Pasca Bedah..." readonly>{{ old('diagnostik_pasca_bedah', $data->diagnostik_pasca_bedah ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold">Kesimpulan / Diagnosa</label>
                    <textarea class="form-control bg-light" name="kesimpulan" rows="6" readonly>{{ $kesimpulan }}</textarea>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold text-dark">Validasi Hasil</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="is_validasi" id="is_validasi"
                            value="1" {{ old('is_validasi', $data->validasi ?? 0) == 2 ? 'checked' : '' }}
                            onclick="return false;">
                        <label class="form-check-label font-weight-bold text-success" for="is_validasi">Validasi &
                            Selesai</label>
                    </div>
                </div>

                <a href="{{ route('expertisi.cetak', ['id' => $ID_HEADER]) }}" target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-success @if ($data->validasi != 2) disabled @endif">
                    <i class="bi bi-printer mr-1"></i> Cetak Hasil Expertisi
                </a>
            </form>
        @endif
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#btnSubmitNomor').on('click', function(e) {
            e.preventDefault();

            let jenisPemeriksaan = $('#jenis_pemeriksaan').val();
            if (!jenisPemeriksaan) {
                alert('Pilih jenis pemeriksaan terlebih dahulu!');
                return;
            }

            let formData = $('#formGenerateNomor').serialize();

            $.ajax({
                url: "{{ route('expertisi.generate_nomor') }}", // Sesuaikan dengan route simpan/generate kamu
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $('#btnSubmitNomor').prop('disabled', true).html(
                        '<i class="fas fa-spinner fa-spin mr-1"></i> Memproses...');
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr) {
                    alert('Gagal me-generate nomor sediaan.');
                    $('#btnSubmitNomor').prop('disabled', false).html(
                        '<i class="fas fa-cog mr-1"></i> Generate Nomor');
                }
            });
        });
    });
</script>
