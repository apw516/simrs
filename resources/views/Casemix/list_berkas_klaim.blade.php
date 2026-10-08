<!-- Tombol Kembali -->
<button class="btn btn-sm btn-danger mb-3 shadow-sm" onclick="kembaliKeTabel()">
    <i class="bi bi-arrow-left-circle mr-1"></i> Kembali
</button>
@if ($get_cek_ver)
    @if ($get_cek_ver->status_verifikasi == 2)
        <div class="p-3 mb-3 bg-white border-left border-success rounded shadow-sm">
            <div class="d-flex align-items-center text-success">
                <i class="bi bi-patch-check-fill mr-2"></i>
                <h6 class="font-weight-bold mb-0">Status Verifikasi: Terverifikasi</h6>
            </div>
            <small class="text-muted d-block mt-1">Berkas telah diperiksa dan disetujui.</small>
        </div>
    @else
        <div class="p-3 mb-3 bg-white border-left border-warning rounded shadow-sm">
            <div class="d-flex align-items-center text-warning">
                <i class="bi bi-exclamation-circle-fill mr-2"></i>
                <h6 class="font-weight-bold mb-0">Status Verifikasi: Perlu Perbaikan</h6>
            </div>
            <div class="small text-dark mt-2 p-2 bg-light rounded border">
                <strong>Catatan Verifikator:</strong><br>
                {{ $get_cek_ver->catatan_verifikasi_awal ?? '-' }}
            </div>
        </div>
    @endif
@endif
<!-- Card Data Pasien & Kunjungan (STICKY) -->
<div class="card card-light mb-4 shadow-sm" style="position: sticky; top: 10px; z-index: 1020;">
    <div class="card-header bg-success d-flex justify-content-between align-items-center py-2">
        <h5 class="card-title text-sm font-weight-bold mb-0 text-white">
            <i class="bi bi-person-lines-fill mr-1"></i> Data Pasien & Kunjungan
        </h5>
        <span class="badge badge-light text-success font-weight-bold">Form Verifikasi</span>
    </div>
    <div class="card-body p-3 bg-white">
        <!-- Informasi Pasien -->
        <div class="row text-sm border-bottom pb-2 mb-3">
            <div class="col-md-3">
                <strong><i class="bi bi-person mr-1"></i> Nama Pasien:</strong>
                <p class="text-muted mb-2">{{ $kunjungan->nama_pasien ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <strong><i class="bi bi-card-heading mr-1"></i> No. RM:</strong>
                <p class="text-muted mb-2">{{ $kunjungan->no_rm ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <strong><i class="bi bi-journal-text mr-1"></i> No. SEP:</strong>
                <p class="text-muted mb-2">{{ $kunjungan->no_sep ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <strong><i class="bi bi-building mr-1"></i> Poliklinik / Unit:</strong>
                <p class="text-muted mb-2">{{ $kunjungan->nama_unit ?? '-' }}</p>
            </div>
            <div class="col-md-3">
                <strong><i class="bi bi-calendar-event mr-1"></i> Tgl Masuk:</strong>
                <p class="text-muted mb-0">
                    {{ !empty($kunjungan->tgl_masuk) ? \Carbon\Carbon::parse($kunjungan->tgl_masuk)->locale('id')->translatedFormat('d F Y H:i') : '-' }}
                </p>
            </div>
            <div class="col-md-3">
                <strong><i class="bi bi-person-badge mr-1"></i> Dokter DPJP:</strong>
                <p class="text-muted mb-0">{{ $kunjungan->nama_dokter ?? '-' }}</p>
            </div>
            <div class="col-md-6">
                <strong><i class="bi bi-hash mr-1"></i> Kode Kunjungan:</strong>
                <p class="text-muted mb-0">{{ $kunjungan->kode_kunjungan ?? '-' }}</p>
            </div>
        </div>

        <!-- FORM VERIFIKASI BERKAS -->
        <form id="formVerifikasiBerkas" action="{{ route('verifikasi.simpan') }}" method="POST">
            @csrf
            <input type="hidden" name="kode_kunjungan" value="{{ $kunjungan->kode_kunjungan ?? '' }}">

            <div class="row text-sm">
                <!-- 1. Checklist Keberadaan Berkas -->
                @php
                    // Decode data JSON dari database ke Array PHP (asumsikan kolom bernama berkas_checked atau sejenisnya)
                    // Jika data berupa objek, json_decode($json, true) akan mengubahnya jadi array asosiatif
                    $dataBerkas = [];
                    if (!empty($get_cek_ver->detail_berkas)) {
                        // Ganti 'detail_berkas' sesuai nama kolom JSON di DB kamu
                        $dataBerkas = is_array($get_cek_ver->detail_berkas)
                            ? $get_cek_ver->detail_berkas
                            : json_decode($get_cek_ver->detail_berkas, true);
                    }
                @endphp

                <div class="row text-sm">
                    <!-- 1. Checklist Keberadaan Berkas -->
                    <div class="col-md-12 mb-2">
                        <label class="font-weight-bold text-dark mb-1">
                            <i class="bi bi-check2-square text-primary mr-1"></i> Checklist Kelengkapan Berkas Fisik /
                            Digital:
                        </label>
                        <div class="d-flex flex-wrap gap-3 bg-light p-2 rounded border">

                            <!-- Checkbox SEP -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="check_sep"
                                    name="berkas_checked[SEP]" value="{{ $urlCetakSEP ?? '' }}"
                                    {{ isset($dataBerkas['SEP']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="check_sep">Berkas SEP</label>
                            </div>

                            <!-- Checkbox Resume Medis -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="check_resume"
                                    name="berkas_checked[Resume Medis]"
                                    value="{{ isset($ts_kunjungan[0]) ? route('cetakresumedmedisttelokal', $ts_kunjungan[0]->kode_kunjungan) : '' }}"
                                    {{ isset($dataBerkas['Resume Medis']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="check_resume">Resume Medis</label>
                            </div>

                            <!-- Checkbox Hasil Lab -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="check_lab"
                                    name="berkas_checked[Laboratorium]"
                                    value="{{ isset($lab_terpilih[0]->link) ? $lab_terpilih[0]->link : '' }}"
                                    {{ isset($dataBerkas['Laboratorium']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="check_lab">Hasil Lab</label>
                            </div>

                            <!-- Checkbox Lab PA -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="check_lab_pa"
                                    name="berkas_checked[Laboratorium PA]"
                                    value="{{ isset($layananheaderPA[0]->id) ? route('expertisi.cetak', ['id' => $layananheaderPA[0]->id]) : '' }}"
                                    {{ isset($dataBerkas['Laboratorium PA']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="check_lab_pa">Hasil Lab Patologi
                                    Anatomi</label>
                            </div>

                            <!-- Checkbox Radiologi -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="check_rad"
                                    name="berkas_checked[Radiologi]" value="{{ $LINK_RADIOLOGI[0] ?? '' }}"
                                    {{ isset($dataBerkas['Radiologi']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="check_rad">Hasil Radiologi</label>
                            </div>

                            <!-- Checkbox Lembar Konsul -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="lembar_konsul"
                                    name="berkas_checked[Lembar Konsul]" value="{{ $urlLembarKonsul ?? '' }}"
                                    {{ isset($dataBerkas['Lembar Konsul']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="lembar_konsul">Lembar Konsul</label>
                            </div>

                            <!-- Checkbox Hemodialisa -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="catatan_hd"
                                    name="berkas_checked[Hemodialisa]" value="{{ $urlCetakHD ?? '' }}"
                                    {{ isset($dataBerkas['Hemodialisa']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="catatan_hd">Catatan Hemodialisa</label>
                            </div>

                            <!-- Checkbox Lampiran Lain -->
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="berkas_penunjang_lain"
                                    name="berkas_checked[Lampiran Lain]" value="{{ $urlLampiranLain ?? '' }}"
                                    {{ isset($dataBerkas['Lampiran Lain']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="berkas_penunjang_lain">Berkas Penunjang Lain</label>
                            </div>
                            <div class="custom-control custom-checkbox mr-3">
                                <input type="checkbox" class="custom-control-input check-berkas" id="berkas_lain"
                                    name="berkas_checked[Lampiran Lain]" value="{{ $urlLampiranLain ?? '' }}"
                                    {{ isset($dataBerkas['Lampiran Lain']) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="berkas_lain">Berkas Lain</label>
                            </div>

                        </div>
                    </div>
                </div>>

                <!-- 2. Opsi Status Verifikasi -->
                <div class="col-md-4 mb-2">
                    <label class="font-weight-bold text-dark mb-1">Status Verifikasi:</label>
                    <select name="status_verifikasi" id="status_verifikasi" class="form-control form-control-sm"
                        onchange="togglePesanVerifikasi()" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="2"
                            {{ isset($get_cek_ver->status_verifikasi) && $get_cek_ver->status_verifikasi == 2 ? 'selected' : '' }}>
                            Terverifikasi / Berkas Lengkap
                        </option>
                        <option value="1"
                            {{ isset($get_cek_ver->status_verifikasi) && $get_cek_ver->status_verifikasi == 1 ? 'selected' : '' }}>
                            Pending / Berkas Belum Lengkap
                        </option>
                    </select>
                </div>

                <!-- 3. Catatan jika Berkas Belum Lengkap -->
                @php
                    $showCatatan = isset($get_cek_ver->status_verifikasi) && $get_cek_ver->status_verifikasi == 1;
                @endphp
                <div class="col-md-6 mb-2" id="wrapper_catatan"
                    style="display: {{ $showCatatan ? 'block' : 'none' }};">
                    <label class="font-weight-bold text-dark mb-1">Catatan / Alasan Belum Lengkap:</label>
                    <input type="text" name="catatan" id="catatan_verifikasi"
                        class="form-control form-control-sm" placeholder="Contoh: Hasil Radiologi belum diunggah"
                        value="{{ $get_cek_ver->catatan_verifikasi_awal ?? '' }}">
                </div>

                <!-- 4. Tombol Simpan -->
                <div class="col-md-2 mb-2 d-flex align-items-end">
                    <button type="submit" id="btnSimpanVerifikasi"
                        class="btn btn-sm btn-primary btn-block shadow-sm">
                        <i class="bi bi-save mr-1"></i> Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- PHP Processing Dokumen List untuk Iframe Preview -->
@php
    $dokumenList = [];
    if (!empty($urlCetakSEP)) {
        $dokumenList[] = ['judul' => 'Berkas SEP', 'url' => $urlCetakSEP];
    }

    $urlResume = isset($ts_kunjungan[0]) ? route('cetakresumedmedisttelokal', $ts_kunjungan[0]->kode_kunjungan) : null;
    if (!empty($urlResume)) {
        $dokumenList[] = ['judul' => 'Resume Medis / Catatan Dokter', 'url' => $urlResume];
    }

    if (($ref_kunjungan ?? '0') != '0' && !empty($urlLembarKonsul)) {
        $dokumenList[] = ['judul' => 'Lembar Konsultasi', 'url' => $urlLembarKonsul];
    }

    if (
        isset($ts_kunjungan[0]) &&
        ($ts_kunjungan[0]->kode_unit == '1012' || $ts_kunjungan[0]->ref_kunjungan == '1027') &&
        !empty($urlExpertisiPoli)
    ) {
        $dokumenList[] = ['judul' => 'Expertisi Poli', 'url' => $urlExpertisiPoli];
    }

    if (isset($ts_kunjungan[0]) && $ts_kunjungan[0]->kode_unit == '3007' && !empty($urlCetakHD)) {
        $dokumenList[] = ['judul' => 'Berkas Hemodialisa (HD)', 'url' => $urlCetakHD];
    }

    if (isset($LINK_RADIOLOGI) && is_array($LINK_RADIOLOGI)) {
        foreach ($LINK_RADIOLOGI as $idx => $urlPdfRad) {
            if (!empty($urlPdfRad)) {
                $dokumenList[] = ['judul' => 'Hasil Radiologi ' . ($idx + 1), 'url' => $urlPdfRad];
            }
        }
    }

    if (isset($layananheaderPA) && count($layananheaderPA) > 0) {
        foreach ($layananheaderPA as $idx => $labPA) {
            if (!empty($labPA->id)) {
                $dokumenList[] = [
                    'judul' => 'Hasil Patologi Anatomi (PA) ' . ($idx + 1),
                    'url' => route('expertisi.cetak', ['id' => $labPA->id]),
                ];
            }
        }
    }

    if (isset($lab_terpilih) && count($lab_terpilih) > 0) {
        foreach ($lab_terpilih as $idx => $lab) {
            $urlPdfLab = $lab->link ?? ($lab->file_pdf ?? ($lab->url_file ?? null));
            if (!empty($urlPdfLab)) {
                $dokumenList[] = ['judul' => 'Hasil Laboratorium ' . ($idx + 1), 'url' => $urlPdfLab];
            }
        }
    }

    if (!empty($urlLampiranLain)) {
        $dokumenList[] = ['judul' => 'Berkas Lampiran Tambahan', 'url' => $urlLampiranLain];
    }
@endphp

<!-- Dokumen Viewer Section -->
<div class="dokumen-wrapper">
    @if (count($dokumenList) > 0)
        <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
            <i class="bi bi-file-earmark-pdf text-danger mr-1"></i> Dokumen PDF & Laporan
        </h6>
        @foreach ($dokumenList as $item)
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                    <span class="font-weight-bold text-dark text-sm">
                        <i class="bi bi-file-earmark-pdf text-danger mr-1"></i> {{ $item['judul'] }}
                    </span>
                    <a href="{{ $item['url'] }}" target="_blank" class="btn btn-xs btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right mr-1"></i> Buka Tab Baru
                    </a>
                </div>
                <div class="card-body p-0">
                    <iframe src="{{ $item['url'] }}" width="100%" height="700px" style="border: none;"
                        loading="lazy"></iframe>
                </div>
            </div>
        @endforeach
    @endif

    @if (isset($gambarscan) && count($gambarscan) > 0)
        <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3 mt-4">
            <i class="bi bi-images text-info mr-1"></i> Berkas Scan Poli / Gambar
        </h6>
        @foreach ($gambarscan as $scan)
            @php $fileUrl = 'http://192.168.2.45/files/' . ltrim($scan->gambar, '/'); @endphp
            <div class="card mb-4 border shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                    <span class="font-weight-bold text-dark text-sm">
                        <i class="bi bi-file-earmark-image text-purple mr-1"></i> Berkas Scan Poli
                    </span>
                    <a href="{{ $fileUrl }}" target="_blank" class="btn btn-xs btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right mr-1"></i> Buka Gambar di Tab Baru
                    </a>
                </div>
                <div class="card-body p-0">
                    <iframe src="{{ $fileUrl }}" width="100%" height="700px" style="border: none;"
                        loading="lazy"></iframe>
                </div>
            </div>
        @endforeach
    @endif

    @if ((!isset($gambarscan) || count($gambarscan) == 0) && count($dokumenList) == 0)
        <div class="card shadow-sm p-5 text-center text-muted">
            <i class="bi bi-file-earmark-x display-4 text-secondary mb-2"></i>
            <p class="mb-0 font-weight-bold">Tidak ada berkas scan maupun dokumen PDF untuk kunjungan ini.</p>
        </div>
    @endif
</div>
<script>
    function kembaliKeTabel() {
        $('.v_1').removeAttr('hidden');
        $('.v_2').attr('hidden', true);
    }

    function togglePesanVerifikasi() {
        var status = document.getElementById('status_verifikasi').value;
        var wrapperCatatan = document.getElementById('wrapper_catatan');
        var inputCatatan = document.getElementById('catatan_verifikasi');

        if (status === '1') { // 1 = Pending / Tidak Lengkap
            wrapperCatatan.style.display = 'block';
            inputCatatan.setAttribute('required', 'required');
        } else {
            wrapperCatatan.style.display = 'none';
            inputCatatan.removeAttribute('required');
            inputCatatan.value = '';
        }
    }

    // Handling Submit Form via AJAX
    $('#formVerifikasiBerkas').on('submit', function(e) {
        e.preventDefault();

        let btnSimpan = $('#btnSimpanVerifikasi');
        btnSimpan.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                btnSimpan.prop('disabled', false).html('<i class="bi bi-save mr-1"></i> Simpan');
                Swal.fire({
                    title: "Terima Kasih",
                    text: "Hasil verifikasi berhasil disimpan!",
                    icon: "success"
                });
                location.reload();
            },
            error: function(xhr) {
                btnSimpan.prop('disabled', false).html('<i class="bi bi-save mr-1"></i> Simpan');
                alert('Gagal menyimpan data: ' + (xhr.responseJSON?.message ||
                    'Terjadi kesalahan sistem.'));
            }
        });
    });
</script>
