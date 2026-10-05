<style>
    /* Merapikan kontainer utama agar mengikuti grid Bootstrap */
    .select2-container--bootstrap4 {
        display: block;
        width: 100% !important;
    }

    /* Memperbaiki tinggi dan batas padding pada multi-select */
    .select2-container--bootstrap4 .select2-selection--multiple {
        min-height: calc(2.25rem + 2px) !important;
        border: 1px solid #ced4da !important;
        border-radius: .25rem !important;
        padding: 2px 6px !important;
    }

    /* Memperbaiki alignment placeholder & area ketik */
    .select2-container--bootstrap4 .select2-selection--multiple .select2-search__field {
        margin-top: 3px !important;
        color: #495057 !important;
        width: 100% !important;
    }

    /* Penyesuaian chip/tag item yang terpilih */
    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
        background-color: #007bff !important;
        border-color: #0069d9 !important;
        color: #fff !important;
        padding: 2px 8px !important;
        margin-top: 3px !important;
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
        margin-right: 5px !important;
    }
</style>
<style>
    /* Paksa container selection menggunakan Flex-wrap berarah column/row penuh */
    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__rendered {
        display: flex !important;
        flex-wrap: wrap !important;
        width: 100% !important;
        padding: 0 4px !important;
    }

    /* Bikin item/chip yang sudah dipilih mengambil tempatnya sendiri */
    .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
        margin-top: 4px !important;
        margin-bottom: 4px !important;
    }

    /* PENTING: Force area input ketik agar selalu turun ke baris bawah & selebar 100% */
    .select2-container--bootstrap4 .select2-selection--multiple .select2-search--inline {
        display: block !important;
        width: 100% !important;
        flex-basis: 100% !important;
        /* Memaksa pindah ke baris baru */
        clear: both !important;
    }

    .select2-container--bootstrap4 .select2-selection--multiple .select2-search__field {
        width: 100% !important;
        min-width: 100% !important;
        margin-top: 4px !important;
        margin-bottom: 4px !important;
        padding: 2px 4px !important;
        direction: ltr !important;
    }
</style>
<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="bi bi-file-earmark-check-fill mr-1"></i> Verifikasi Berkas Pasien
        </h3>
        <div>
            {{-- Tombol kembali yang menyembunyikan v_2 dan menampilkan v_1 tanpa reload halaman --}}
            <button class="btn btn-sm btn-danger" onclick="kembaliKeTabel()">
                <i class="bi bi-arrow-left-circle mr-1"></i> Kembali
            </button>
        </div>
    </div>

    <div class="card-body">

        <!-- 1. IDENTITAS & RINGKASAN DATA PASIEN -->
        <div class="card card-light mb-4">
            <div class="card-header bg-light">
                <h5 class="card-title text-sm font-weight-bold">Data Pasien & Kunjungan</h5>
            </div>
            <div class="card-body p-3">
                <div class="row text-sm">
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
                        <p class="text-muted mb-0">{{ $kunjungan->tgl_masuk ?? '-' }}</p>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <ul class="nav nav-tabs mb-3" id="berkasTab2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" id="sep2-tab" data-toggle="tab" href="#sep2"
                            role="tab">
                            <i class="fas fa-id-card mr-1"></i> Berkas SEP
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="resume2-tab" data-toggle="tab" href="#resume2"
                            role="tab">
                            <i class="fas fa-file-invoice-dollar mr-1"></i> Resume Medis Rawat Jalan
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="berkasTabContent">
                    <div class="tab-pane fade show active" id="sep2" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-1">
                                @if (!empty($urlCetakSEP))
                                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                        <iframe class="embed-responsive-item" src="{{ $urlCetakSEP }}"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                        <p class="mb-0">Nomor SEP tidak ditemukan untuk kunjungan ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="resume2" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-2">

                                <!-- 3. TAMPILAN RESUME MEDIS (IFRAME) -->
                                @php
                                    $urlResume = isset($ts_kunjungan[0])
                                        ? route('cetakresumedmedisttelokal', $ts_kunjungan[0]->kode_kunjungan)
                                        : null;
                                @endphp
                                @if ($urlResume)
                                    <div class="d-flex justify-content-end mb-2 p-2">
                                        <a href="{{ $urlResume }}" target="_blank"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                                        </a>
                                    </div>
                                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                        <iframe class="embed-responsive-item" src="{{ $urlResume }}"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                        <p class="mb-0">URL Cetak Resume Medis tidak ditemukan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Preview SEP -->
            <div class="col-md-6 mb-3">
                <ul class="nav nav-tabs mb-3" id="berkasTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="ringkasandiagnosa-tab" data-toggle="tab"
                            href="#ringkasandiagnosa" role="tab">
                            <i class="fas fa-vials mr-1"></i> Ringkasan Diagnosa & Prosedur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="lab-tab" data-toggle="tab" href="#lab"
                            role="tab">
                            <i class="fas fa-vials mr-1"></i> Hasil Lab PDF
                            @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                                <span class="badge badge-pill badge-primary">{{ count($lab_terpilih) }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="labPA-tab" data-toggle="tab" href="#labPA"
                            role="tab">
                            <i class="fas fa-vials mr-1"></i> Hasil Lab PA
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="rad-tab" data-toggle="tab" href="#rad"
                            role="tab">
                            <i class="fas fa-x-ray mr-1"></i> Hasil Radiologi
                            @if (isset($rad_terpilih) && count($rad_terpilih) > 0)
                                <span class="badge badge-pill badge-warning">{{ count($rad_terpilih) }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="lembarkonsul-tab" data-toggle="tab"
                            href="#lembarkonsul" role="tab">
                            <i class="fas fa-file-invoice-dollar mr-1"></i> Lembar Konsul
                        </a>
                    </li>
                    @if (isset($ts_kunjungan[0]) && in_array($ts_kunjungan[0]->kode_unit, ['1012', '1027', '1032']))
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="expertisipoli-tab" data-toggle="tab"
                                href="#expertisipoli" role="tab">
                                <i class="fas fa-file-invoice-dollar mr-1"></i> Expertisi Ultrasonography
                            </a>
                        </li>
                    @endif
                    @if (isset($ts_kunjungan[0]) && $ts_kunjungan[0]->kode_unit == '3007')
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" id="catatanhd-tab" data-toggle="tab"
                                href="#catatanhd" role="tab">
                                <i class="fas fa-file-invoice-dollar mr-1"></i> Catatan Hemodialisa
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" id="berkasscan-tab" data-toggle="tab"
                            href="#berkasscan" role="tab">
                            <i class="fas fa-layer-group mr-1 text-purple"></i> Berkas scan dipoli
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="berkasTabContent">
                    <div class="tab-pane fade" id="ringkasandiagnosa" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="mb-4">
                                <h6 class="font-weight-bold text-primary mb-2">
                                    <i class="fas fa-stethoscope mr-1"></i> Riwayat Diagnosa (ICD-10)
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-sm text-sm"
                                        id="tableRiwayatDiagnosa">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="width: 15%">Kategori</th>
                                                <th style="width: 80px">Kode ICD-10 - Nama Diagnosa</th>
                                                {{-- <th></th> --}}
                                                <th style="width: 20%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($diagnosakunjungan as $d)
                                                <tr id="row-diagnosa-{{ $d->id }}">
                                                    <td>
                                                        <span
                                                            class="badge {{ $d->kategori == 'Utama' ? 'badge-danger' : 'badge-info' }}">
                                                            {{ $d->kategori }}
                                                        </span>
                                                    </td>
                                                    <td><strong>{{ $d->kode_icd10 }}</strong></td>
                                                    {{-- <td>{{ $d->nama_diagnosa ?? '-' }}</td> --}}
                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-xs btn-outline-danger btn-delete-item"
                                                            data-url="{{ route('diagnosa.destroy', $d->id) }}"
                                                            data-row="#row-diagnosa-{{ $d->id }}"
                                                            title="Hapus Diagnosa">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="empty-row">
                                                    <td colspan="4" class="text-center text-muted">Belum ada data
                                                        diagnosa tersimpan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- 2. TABEL RIWAYAT TINDAKAN / PROSEDUR (ICD-9) -->
                            <div class="mb-4">
                                <h6 class="font-weight-bold text-info mb-2">
                                    <i class="fas fa-procedures mr-1"></i> Riwayat Tindakan / Prosedur (ICD-9)
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover table-sm text-sm"
                                        id="tableRiwayatTindakan">
                                        <thead class="bg-light">
                                            <tr>
                                                <th style="width: 15%">Kategori</th>
                                                <th style="width: 80px">Kode ICD-9 - Nama Prosedur / Tindakan</th>
                                                {{-- <th></th> --}}
                                                <th style="width: 20%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($diagnosatindakan as $t)
                                                <tr id="row-tindakan-{{ $t->id }}">
                                                    <td>
                                                        @php
                                                            $badgeClass = match ($t->kategori) {
                                                                'Prosedur' => 'badge-primary',
                                                                'Operasi' => 'badge-warning',
                                                                default => 'badge-secondary',
                                                            };
                                                        @endphp
                                                        <span
                                                            class="badge {{ $badgeClass }}">{{ $t->kategori }}</span>
                                                    </td>
                                                    <td><strong>{{ $t->kode_icd9 }}</strong></td>
                                                    {{-- <td>{{ $t->nama_tindakan ?? '-' }}</td> --}}
                                                    <td class="text-center">
                                                        <button type="button"
                                                            class="btn btn-xs btn-outline-danger btn-delete-item"
                                                            data-url="{{ route('tindakan.destroy', $t->id) }}"
                                                            data-row="#row-tindakan-{{ $t->id }}"
                                                            title="Hapus Tindakan">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="empty-row">
                                                    <td colspan="4" class="text-center text-muted">Belum ada
                                                        data tindakan tersimpan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <hr>
                            <div class="card-body p-2">
                                <form id="formDiagnosaTindakan">
                                    @csrf
                                    <input type="hidden" name="kode_kunjungan"
                                        value="{{ $kunjungan->kode_kunjungan }}">

                                    <div class="row">
                                        <!-- Input Diagnosa Utama -->
                                        <div class="col-md-6 form-group">
                                            <label>Pilih Diagnosa Utama <span class="text-danger">*</span></label>
                                            <select class="form-control select2-icd10"
                                                id="select_diagnosa_utama"></select>
                                        </div>

                                        <!-- Input Diagnosa Sekunder -->
                                        <div class="col-md-6 form-group">
                                            <label>Pilih Diagnosa Sekunder</label>
                                            <select class="form-control select2-icd10"
                                                id="select_diagnosa_sekunder"></select>
                                        </div>
                                    </div>

                                    <!-- Tabel Penampung Diagnosa -->
                                    <div class="table-responsive mb-4">
                                        <table class="table table-bordered table-striped table-sm" id="tableDiagnosa">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 15%">Kategori</th>
                                                    <th style="width: 20%">Kode ICD-10</th>
                                                    <th>Nama Diagnosa</th>
                                                    <th style="width: 80px" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data item akan masuk ke sini lewat JS -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <hr>

                                    <div class="row mt-3">
                                        <!-- Input Prosedur -->
                                        <div class="col-md-4 form-group">
                                            <label>Pilih Tindakan / Prosedur</label>
                                            <select class="form-control select2-icd9" id="select_prosedur"
                                                data-kategori="Prosedur"></select>
                                        </div>

                                        <!-- Input Operasi -->
                                        <div class="col-md-4 form-group">
                                            <label>Pilih Tindakan Operasi</label>
                                            <select class="form-control select2-icd9" id="select_operasi"
                                                data-kategori="Operasi"></select>
                                        </div>

                                        <!-- Input Penunjang -->
                                        <div class="col-md-4 form-group">
                                            <label>Pilih Tindakan Penunjang</label>
                                            <select class="form-control select2-icd9" id="select_penunjang"
                                                data-kategori="Penunjang"></select>
                                        </div>
                                    </div>

                                    <!-- Tabel Penampung Tindakan / Prosedur -->
                                    <div class="table-responsive mb-3">
                                        <table class="table table-bordered table-striped table-sm" id="tableTindakan">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th style="width: 15%">Kategori</th>
                                                    <th style="width: 20%">Kode ICD-9</th>
                                                    <th>Nama Prosedur / Tindakan</th>
                                                    <th style="width: 80px" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data item akan masuk ke sini lewat JS -->
                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="button" class="btn btn-primary float-right">
                                        <i class="bi bi-save mr-1"></i> Simpan Diagnosa & Prosedur
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="lab" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-2">
                                @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                                    @foreach ($lab_terpilih as $index => $lab)
                                        @php
                                            $urlPdfLab = $lab->link ?? ($lab->file_pdf ?? ($lab->url_file ?? null));
                                        @endphp
                                        @if ($urlPdfLab)
                                            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                                <span class="font-weight-bold text-dark">
                                                    <i class="fas fa-file-pdf text-danger mr-1"></i> Hasil Lab
                                                    #{{ $index + 1 }}
                                                </span>
                                                <a href="{{ $urlPdfLab }}" target="_blank"
                                                    class="btn btn-xs btn-outline-primary">
                                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                                </a>
                                            </div>
                                            <div class="embed-responsive embed-responsive-16by9 mb-3"
                                                style="min-height: 480px;">
                                                <iframe class="embed-responsive-item" src="{{ $urlPdfLab }}"
                                                    allowfullscreen></iframe>
                                            </div>
                                            @if (!$loop->last)
                                                <hr class="my-3">
                                            @endif
                                        @else
                                            <div class="text-center py-4 text-muted">
                                                <i class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                                <p>URL berkas PDF untuk hasil lab ini tidak valid atau kosong.</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                        <p class="mb-0">Tidak ada berkas PDF hasil laboratorium untuk kode kunjungan
                                            ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="labPA" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-2">
                                @if (isset($layananheaderPA) && count($layananheaderPA) > 0)
                                    @foreach ($layananheaderPA as $index => $labPA)
                                        @php
                                            $idPA = $labPA->id ?? null;
                                        @endphp
                                        @if ($idPA)
                                            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                                <span class="font-weight-bold text-dark">
                                                    <i class="fas fa-file-pdf text-danger mr-1"></i> Hasil Lab PA
                                                    #{{ $index + 1 }}
                                                </span>
                                                <a href="{{ route('expertisi.cetak', ['id' => $idPA]) }}"
                                                    target="_blank" class="btn btn-xs btn-outline-primary">
                                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                                </a>
                                            </div>
                                            <div class="embed-responsive embed-responsive-16by9 mb-3"
                                                style="min-height: 480px;">
                                                <iframe class="embed-responsive-item"
                                                    src="{{ route('expertisi.cetak', ['id' => $idPA]) }}"
                                                    allowfullscreen></iframe>
                                            </div>
                                            @if (!$loop->last)
                                                <hr class="my-3">
                                            @endif
                                        @else
                                            <div class="text-center py-4 text-muted">
                                                <i class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                                <p>URL berkas PDF untuk hasil lab PA ini tidak valid atau kosong.</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                        <p class="mb-0">Tidak ada berkas PDF hasil laboratorium PA untuk kode
                                            kunjungan ini.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="rad" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-2">
                                @if (isset($LINK_RADIOLOGI) && count($LINK_RADIOLOGI) > 0)
                                    @foreach ($LINK_RADIOLOGI as $index => $urlPdfRad)
                                        @if (!empty($urlPdfRad))
                                            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                                <span class="font-weight-bold text-dark">
                                                    <i class="fas fa-x-ray text-warning mr-1"></i> Hasil Radiologi
                                                    #{{ $index + 1 }}
                                                </span>
                                                <a href="{{ $urlPdfRad }}" target="_blank"
                                                    class="btn btn-xs btn-outline-primary">
                                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                                </a>
                                            </div>
                                            <div class="embed-responsive embed-responsive-16by9 mb-3"
                                                style="min-height: 480px;">
                                                <iframe class="embed-responsive-item" src="{{ $urlPdfRad }}"
                                                    allowfullscreen></iframe>
                                            </div>
                                            @if (!$loop->last)
                                                <hr class="my-3">
                                            @endif
                                        @else
                                            <div class="text-center py-4 text-muted">
                                                <i class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                                <p>ACCESSIONNUMBER / URL berkas Radiologi ini tidak ditemukan.</p>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                        <p class="mb-0">Tidak ada berkas hasil radiologi untuk kode kunjungan ini.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="lembarkonsul" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-1">
                                @if (!empty($urlLembarKonsul))
                                    <div class="d-flex justify-content-end mb-2 p-2">
                                        <a href="{{ $urlLembarKonsul }}" target="_blank"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                                        </a>
                                    </div>
                                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                        <iframe class="embed-responsive-item" src="{{ $urlLembarKonsul }}"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                        <p class="mb-0">URL Cetak Lembar Konsul tidak ditemukan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="expertisipoli" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-1">
                                @if (!empty($urlExpertisiPoli))
                                    <div class="d-flex justify-content-end mb-2 p-2">
                                        <a href="{{ $urlExpertisiPoli }}" target="_blank"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                                        </a>
                                    </div>
                                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                        <iframe class="embed-responsive-item" src="{{ $urlExpertisiPoli }}"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                        <p class="mb-0">URL Expertisi Ultrasonography tidak ditemukan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="catatanhd" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-1">
                                @if (!empty($urlCetakHD))
                                    <div class="d-flex justify-content-end mb-2 p-2">
                                        <a href="{{ $urlCetakHD }}" target="_blank"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                                        </a>
                                    </div>
                                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                        <iframe class="embed-responsive-item" src="{{ $urlCetakHD }}"
                                            allowfullscreen></iframe>
                                    </div>
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                        <p class="mb-0">URL Catatan Hemodialisa tidak ditemukan.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="berkasscan" role="tabpanel">
                        <div class="card shadow-sm">
                            <div class="card-body p-3">
                                @if (isset($gambarscan) && count($gambarscan) > 0)
                                    @foreach ($gambarscan as $scan)
                                        @php
                                            $fileUrl = 'http://192.168.2.45/files/' . ltrim($scan->gambar, '/');
                                        @endphp
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="font-weight-bold text-dark">
                                                <i class="fas fa-image text-purple mr-1"></i> Berkas Scan Poli
                                            </span>
                                            <a href="{{ $fileUrl }}" target="_blank"
                                                class="btn btn-xs btn-outline-primary">
                                                <i class="fas fa-external-link-alt mr-1"></i> Buka Gambarnya di Tab
                                                Baru
                                            </a>
                                        </div>
                                        <div class="text-center mb-3">
                                            <img src="{{ $fileUrl }}" class="img-fluid rounded border shadow-sm"
                                                style="max-height: 600px; object-fit: contain;" alt="Berkas Scan">
                                        </div>
                                        @if (!$loop->last)
                                            <hr class="my-3">
                                        @endif
                                    @endforeach
                                @else
                                    <div class="text-center py-5 text-muted">
                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                        <p class="mb-0">Tidak ada berkas scan poli untuk kunjungan ini.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-success card-outline mt-4">
            <div class="card-header">
                <h5 class="card-title text-sm font-weight-bold">Form Persetujuan Verifikasi</h5>
            </div>
            <div class="card-body">
                <form id="formSimpanVerifikasi">
                    @csrf
                    <input type="hidden" name="kode_kunjungan" value="{{ $kunjungan->kode_kunjungan }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status Verifikasi <span class="text-danger">*</span></label>
                                <select name="status_verifikasi" class="form-control" required>
                                    <option value="1">Lengkap / Disetujui</option>
                                    <option value="2">Tidak Lengkap / Dikembalikan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Catatan Verifikator</label>
                                <input type="text" name="catatan" class="form-control"
                                    placeholder="Tambahkan catatan jika ada berkas yang kurang atau perlu perbaikan...">
                            </div>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button type="button" class="btn btn-secondary mr-2" onclick="kembaliKeTabel()">
                            <i class="bi bi-x-circle mr-1"></i> Batal
                        </button>
                        <button type="button" class="btn btn-success" id="btnSimpanVerifikasi">
                            <i class="bi bi-check-circle mr-1"></i> Simpan Hasil Verifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Preview Berkas Merger -->
<div class="modal fade" id="modalMergerPdf" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-file-earmark-pdf text-danger mr-2"></i> Preview Berkas Merger
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <!-- Frame untuk menampilkan file PDF/Merger -->
                <iframe id="frameMergerPdf" src="" style="width: 100%; height: 80vh; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Fungsi kembali tanpa mereload Halaman
    function kembaliKeTabel() {
        $('.v_2').addClass('d-none').hide().empty();
        $('.v_1').removeClass('d-none').show();
    }
    // $(document).ready(function() {
    //     // Autocomplete ICD-10 (Diagnosa)
    //     $('.select2-icd10').select2({
    //         theme: 'bootstrap4',
    //         placeholder: 'Ketik kode atau nama diagnosa...',
    //         allowClear: true,
    //         tags: true,
    //         width: '100%',
    //         minimumInputLength: 2, // Minimal 2 karakter baru mencari ke database
    //         createTag: function(params) {
    //             var term = $.trim(params.term);
    //             if (term === '') {
    //                 return null;
    //             }
    //             return {
    //                 id: term,
    //                 text: term + ' (Diagnosa Baru)'
    //             };
    //         },
    //         ajax: {
    //             url: "{{ route('referensi.icd10') }}", // Ganti dengan route endpoint Anda
    //             dataType: 'json',
    //             delay: 300, // Debounce 300ms
    //             data: function(params) {
    //                 return {
    //                     q: params.term // Kata kunci pencarian
    //                 };
    //             },
    //             processResults: function(data) {
    //                 return {
    //                     results: $.map(data, function(item) {
    //                         return {
    //                             id: item.diag,
    //                             text: item.diag + ' - ' + item.nama
    //                         }
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });

    //     // Autocomplete ICD-9-CM (Prosedur / Tindakan)
    //     $('.select2-icd9').select2({
    //         theme: 'bootstrap4',
    //         placeholder: 'Ketik kode atau nama tindakan...',
    //         allowClear: true,
    //         tags: true,
    //         width: '100%',
    //         minimumInputLength: 2,
    //         createTag: function(params) {
    //             var term = $.trim(params.term);
    //             if (term === '') {
    //                 return null;
    //             }
    //             return {
    //                 id: term,
    //                 text: term + ' (Diagnosa Baru)'
    //             };
    //         },
    //         ajax: {
    //             url: "{{ route('referensi.icd9') }}", // Ganti dengan route endpoint Anda
    //             dataType: 'json',
    //             delay: 300,
    //             data: function(params) {
    //                 return {
    //                     q: params.term
    //                 };
    //             },
    //             processResults: function(data) {
    //                 return {
    //                     results: $.map(data, function(item) {
    //                         return {
    //                             id: item.diag,
    //                             text: item.diag + ' - ' + item.nama_panjang
    //                         }
    //                     })
    //                 };
    //             },
    //             cache: true
    //         }
    //     });
    // });
</script>
<script>
    $(document).ready(function() {
        // 1. Inisialisasi Select2 ICD-10
        $('.select2-icd10').select2({
            theme: 'bootstrap4',
            placeholder: 'Ketik kode atau nama diagnosa...',
            allowClear: true,
            width: '100%',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('referensi.icd10') }}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.diag,
                                text: item.diag + ' - ' + item.nama,
                                kode: item.diag,
                                nama: item.nama
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // 2. Inisialisasi Select2 ICD-9
        $('.select2-icd9').select2({
            theme: 'bootstrap4',
            placeholder: 'Ketik kode atau nama tindakan...',
            allowClear: true,
            width: '100%',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('referensi.icd9') }}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.diag,
                                text: item.diag + ' - ' + item.nama_panjang,
                                kode: item.diag,
                                nama: item.nama_panjang
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // 3. Event Handling: Menambahkan Diagnosa ke Tabel
        // 3. Event Handling: Menambahkan Diagnosa ke Tabel
        $('#select_diagnosa_utama, #select_diagnosa_sekunder').on('select2:select', function(e) {
            let data = e.params.data;
            let isUtama = $(this).attr('id') === 'select_diagnosa_utama';
            let kategoriKey = isUtama ? 'Utama' : 'Sekunder';
            let kategoriText = isUtama ? '<span class="badge badge-danger">Utama</span>' :
                '<span class="badge badge-info">Sekunder</span>';
            let inputName = isUtama ? 'diagnosa_utama[]' : 'diagnosa_sekunder[]';

            // Cek jika kode sudah ada di tabel
            if ($(`#tableDiagnosa input[value="${data.kode}"]`).length > 0) {
                alert('Diagnosa ini sudah ditambahkan.');
                $(this).val(null).trigger('change');
                return;
            }

            // Jika yang dipilih adalah Diagnosa Utama, hapus Diagnosa Utama lama (karena Utama hanya 1)
            if (isUtama) {
                $('#tableDiagnosa tbody tr[data-kategori="Utama"]').remove();
            }

            // PERBAIKAN: Tambahkan atribut data-kategori="${kategoriKey}" pada tag <tr>
            let htmlRow = `
    <tr data-kategori="${kategoriKey}">
        <td>${kategoriText}</td>
        <td>
            <strong>${data.kode}</strong>
            <input type="hidden" name="${inputName}" value="${data.kode} - ${data.nama}">
        </td>
        <td>${data.nama}</td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-xs btn-remove-row">
                <i class="bi bi-trash"></i>
            </button>
        </td>
    </tr>
    `;

            $('#tableDiagnosa tbody').append(htmlRow);
            $(this).val(null).trigger('change'); // Reset Select2
        });

        // 4. Event Handling: Menambahkan Tindakan ke Tabel
        $('#select_prosedur, #select_operasi, #select_penunjang').on('select2:select', function(e) {
            let data = e.params.data;
            let kategori = $(this).data('kategori');
            let inputName = '';
            let badgeColor = '';

            if (kategori === 'Prosedur') {
                inputName = 'tindakan_prosedur[]';
                badgeColor = 'badge-primary';
            } else if (kategori === 'Operasi') {
                inputName = 'tindakan_operasi[]';
                badgeColor = 'badge-warning';
            } else {
                inputName = 'tindakan_penunjang[]';
                badgeColor = 'badge-secondary';
            }

            if ($(`#tableTindakan input[value="${data.kode}"]`).length > 0) {
                alert('Tindakan ini sudah ditambahkan.');
                $(this).val(null).trigger('change');
                return;
            }

            let htmlRow = `
            <tr>
                <td><span class="badge ${badgeColor}">${kategori}</span></td>
                <td>
                    <strong>${data.kode}</strong>
                    <input type="hidden" name="${inputName}" value="${data.kode} - ${data.nama}">
                </td>
                <td>${data.nama}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-xs btn-remove-row">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        `;

            $('#tableTindakan tbody').append(htmlRow);
            $(this).val(null).trigger('change');
        });

        // 5. Hapus Baris Tabel
        $(document).on('click', '.btn-remove-row', function() {
            $(this).closest('tr').remove();
        });

        $('#formDiagnosaTindakan button[type="button"]').on('click', function(e) {
            e.preventDefault();

            let form = $('#formDiagnosaTindakan');
            let formData = form.serialize();
            let btnSave = $(this);

            // Validasi: Pastikan Diagnosa Utama diisi
            let hasUtama = $('#tableDiagnosa tbody tr[data-kategori="Utama"]').length > 0;
            if (!hasUtama) {
                alert('Silakan pilih minimal 1 Diagnosa Utama!');
                return;
            }

            // Disable button & ubah text loading
            btnSave.prop('disabled', true).html(
                '<i class="spinner-border spinner-border-sm mr-1"></i> Menyimpan...');

            $.ajax({
                url: "{{ route('diagnosa-tindakan.store') }}", // Ganti dengan route penyimpanan Anda
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message || 'Data berhasil disimpan!');
                        // Opsi redirect atau reload
                        // window.location.reload();
                    } else {
                        alert(response.message || 'Terjadi kesalahan saat menyimpan data.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert('Validasi Gagal:\n' + errorMessages);
                    } else {
                        alert('Terjadi kesalahan sistem (' + xhr.status +
                            '). Silakan coba lagi.');
                    }
                },
                complete: function() {
                    // Restore button
                    btnSave.prop('disabled', false).html(
                        '<i class="bi bi-save mr-1"></i> Simpan Diagnosa & Prosedur');
                }
            });
        });
    });
    $(document).ready(function() {
        // Handling Hapus Data Diagnosa / Tindakan via AJAX
        $(document).on('click', '.btn-delete-item', function(e) {
            e.preventDefault();

            let btn = $(this);
            let url = btn.data('url');
            let rowId = btn.data('row');

            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                return;
            }

            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        // Hapus baris dari tabel dengan animasi fadeOut
                        $(rowId).fadeOut(400, function() {
                            let tbody = $(this).closest('tbody');
                            $(this).remove();

                            // Jika tabel menjadi kosong, tampilkan pesan kosong
                            if (tbody.find('tr').length === 0) {
                                tbody.html(`
                        <tr class="empty-row">
                            <td colspan="4" class="text-center text-muted">Belum ada data tersimpan.</td>
                        </tr>
                    `);
                            }
                        });
                    } else {
                        alert(response.message || 'Gagal menghapus data.');
                        btn.prop('disabled', false).html(
                            '<i class="fas fa-trash-alt"></i>');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 419) {
                        alert(
                            'Sesi Anda telah berakhir (CSRF token expired). Silakan muat ulang halaman.'
                        );
                    } else {
                        alert('Terjadi kesalahan saat menghapus data (' + xhr.status +
                            ').');
                    }
                    btn.prop('disabled', false).html('<i class="fas fa-trash-alt"></i>');
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#btnSimpanVerifikasi').on('click', function(e) {
            e.preventDefault();

            let btn = $(this);
            let form = $('#formSimpanVerifikasi');
            let originalText = btn.html();

            if (!form[0].checkValidity()) {
                form[0].reportValidity();
                return;
            }

            let formData = form.serialize();

            btn.prop('disabled', true).html(
                '<i class="spinner-border spinner-border-sm mr-1"></i> Menyimpan & Menggabungkan Berkas...'
            );

            $.ajax({
                url: "{{ route('verifikasi.simpan') }}",
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // 1. Set URL PDF ke iframe di dalam modal
                        if (response.pdf_url) {
                            $('#frameMergerPdf').attr('src', response.pdf_url);

                            // 2. Tampilkan Modal Bootstrap
                            $('#modalMergerPdf').modal('show');
                        } else {
                            alert(response.message ||
                            'Hasil verifikasi berhasil disimpan!');
                        }

                        // 3. Callback jika modal ditutup (opsional: reset/kembali ke tabel saat modal ditutup)
                        $('#modalMergerPdf').off('hidden.bs.modal').on('hidden.bs.modal',
                            function() {
                                $('#frameMergerPdf').attr('src', ''); // bersihkan frame
                                if (typeof kembaliKeTabel === 'function') {
                                    // kembaliKeTabel();
                                }
                            });

                    } else {
                        alert(response.message || 'Gagal menyimpan data.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 419) {
                        alert(
                            'Sesi Anda telah berakhir (CSRF token expired). Silakan muat ulang halaman.');
                    } else if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let firstError = Object.values(errors)[0][0];
                        alert('Validasi gagal: ' + firstError);
                    } else {
                        alert('Terjadi kesalahan saat menyimpan data (' + xhr.status +
                        ').');
                    }
                },
                complete: function() {
                    btn.prop('disabled', false).html(originalText);
                }
            });
        });
    });
</script>
