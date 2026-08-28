<div class="container-fluid pt-4">

    @php
        $kunjungan = $datakunjungan[0] ?? null;
        $data = $data ?? null;
        $hasil_split = isset($data->hasil) ? array_map('trim', explode('|', $data->hasil)) : [];

        $makro = $hasil_split[0] ?? '';
        $mikro = $hasil_split[1] ?? '';
        $kesimpulan = $hasil_split[2] ?? '';
    @endphp

    <!-- INFORMASI DETAIL PASIEN & KUNJUNGAN -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h6 class="mb-0 font-weight-bold">
                <i class="fas fa-user-injured mr-2"></i>Detail Informasi Pasien
            </h6>
            <span class="badge badge-light">Kunjungan: {{ $kunjungan->kode_kunjungan ?? '-' }}</span>
        </div>
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-3 border-right">
                    <small class="text-muted d-block">No. Rekam Medis</small>
                    <h5 class="font-weight-bold text-primary mb-1">{{ $kunjungan->no_rm ?? '-' }}</h5>

                    <small class="text-muted d-block mt-2">Nama Pasien</small>
                    <span class="font-weight-bold text-dark d-block">{{ $kunjungan->nama_pasien ?? '-' }}</span>
                </div>

                <div class="col-md-4 border-right">
                    <small class="text-muted d-block">Unit Asal / Ruangan</small>
                    <span class="font-weight-bold text-dark d-block mb-2">
                        <i class="fas fa-clinic-medical mr-1 text-info"></i>{{ $kunjungan->nama_unit ?? '-' }}
                    </span>

                    <small class="text-muted d-block">Penjamin / Asuransi</small>
                    <span class="badge badge-info">{{ $kunjungan->nama_penjamin ?? '-' }}</span>
                </div>

                <div class="col-md-5">
                    <small class="text-muted d-block">Tgl Masuk Kunjungan</small>
                    <span class="font-weight-bold text-dark d-block mb-2">
                        <i class="fas fa-calendar-alt mr-1 text-secondary"></i>
                        {{ isset($kunjungan->tgl_masuk) ? \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('d-m-Y H:i') : '-' }}
                    </span>

                    <small class="text-muted d-block">Alamat Pasien</small>
                    <small class="text-dark d-block text-truncate" title="{{ $kunjungan->alamat_pasien ?? '-' }}">
                        <i class="fas fa-map-marker-alt mr-1 text-danger"></i>{{ $kunjungan->alamat_pasien ?? '-' }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- FORM INPUT EXPERTISI PA -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold">
                <i class="fas fa-file-medical-alt mr-2"></i>Form Hasil Expertisi Pathology Anatomi
            </h5>
            <a hidden href="javascript:history.back()" class="btn btn-sm btn-light text-primary font-weight-bold">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            @if (empty($data->no_periksa))
                <!-- BLOK JIKA NOMOR SEDIAAN BELUM DIGENERATE -->
                <div class="alert alert-warning text-center p-4 border-warning" role="alert">
                    <i class="fas fa-exclamation-triangle fa-3x text-warning d-block mb-3"></i>
                    <h5 class="font-weight-bold text-dark">Nomor Sediaan Belum Ada</h5>
                    <p class="text-muted">Silakan tentukan jenis pemeriksaan untuk merilis nomor sediaan sebelum
                        pengisian hasil expertisi.</p>
                    <button type="button" class="btn btn-primary btn-lg mt-2 font-weight-bold" data-toggle="modal"
                        data-target="#modalAmbilNomor">
                        <i class="fas fa-barcode mr-2"></i>Ambil Nomor Sediaan
                    </button>
                </div>
            @else
                <!-- FORM ISIAN HASIL EXPERTISI -->
                <form action="{{ route('expertisi.simpan', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="font-weight-bold text-dark">Jenis Pemeriksaan</label>
                            <input type="text" class="form-control bg-white font-weight-bold"
                                value="{{ $data_2->NAMA_TARIF ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="font-weight-bold text-dark">Nomor Sediaan PA</label>
                            <input type="text" class="form-control bg-white font-weight-bold text-primary"
                                value="{{ $data->no_periksa }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="font-weight-bold text-dark">Jenis Sampel</label>
                            <input type="text" name="jenis_sampel" class="form-control"
                                value="{{ old('jenis_sampel', $data->tipe ?? '') }}"
                                placeholder="Masukkan jenis sampel">
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold text-dark">Tipe Pemeriksaan</label><br>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" name="is_kritis" id="kritis"
                                    value="1" {{ old('is_kritis', $data->kritis ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label font-weight-bold text-danger"
                                    for="kritis">Kritis</label>
                            </div>
                            <div class="form-check form-check-inline mt-2">
                                <input class="form-check-input" type="checkbox" name="is_cyto" id="cyto"
                                    value="1" {{ old('is_cyto', $data->cito ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label font-weight-bold text-warning"
                                    for="cyto">Cyto</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Makroskopis</label>
                                <textarea class="form-control" name="makroskopis" rows="5"
                                    placeholder="Masukkan uraian pemeriksaan makroskopis...">{{ old('makroskopis', $makro ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Mikroskopis</label>
                                <textarea class="form-control" name="mikroskopis" rows="5"
                                    placeholder="Masukkan uraian pemeriksaan mikroskopis...">{{ old('mikroskopis', $mikro ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Diagnostik Klinik</label>
                                <textarea class="form-control" name="diagnostik_klinik" rows="5"
                                    placeholder="Masukkan uraian Diagnostik Klinik...">{{ old('diagnostik_klinik', $data->diagnostik_klinik ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold text-dark">Diagnostik Pasca Bedah</label>
                                <textarea class="form-control" name="diagnostik_pasca_bedah" rows="5"
                                    placeholder="Masukkan uraian Diagnostik Pasca Bedah...">{{ old('diagnostik_pasca_bedah', $data->diagnostik_pasca_bedah ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Kesimpulan / Diagnosa PA</label>
                        <textarea class="form-control" name="kesimpulan" rows="3"
                            placeholder="Masukkan kesimpulan atau diagnosa akhir...">{{ old('kesimpulan', $kesimpulan ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Validasi Hasil</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="is_validasi" id="is_validasi"
                                value="1" {{ old('is_validasi', $data->validasi ?? 0) == 2 ? 'checked' : '' }}>
                            <label class="form-check-label font-weight-bold text-success" for="is_validasi">Validasi &
                                Selesai</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success btn-lg px-4 font-weight-bold">
                            <i class="fas fa-save mr-2"></i>Simpan Hasil Expertisi
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
