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
        <!-- 1. IDENTITAS & RINGKASAN DATA PASIEN (STICKY TOP) -->
        <div class="card card-light mb-4 sticky-top shadow-sm" style="top: 0; z-index: 1020;">
            <div class="card-header bg-light">
                <h5 class="card-title text-sm font-weight-bold">Data Pasien & Kunjungan</h5>
            </div>
            <div class="card-body p-3 bg-white">
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
            <div class="card-footer">
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
                @else
                    <div class="p-3 mb-3 bg-white border-left border-danger rounded shadow-sm">
                        <div class="d-flex align-items-center text-danger">
                            <i class="bi bi-exclamation-circle-fill mr-2"></i>
                            <h6 class="font-weight-bold mb-0">Status Verifikasi: Belum diverifikasi</h6>
                        </div>
                        {{-- <div class="small text-dark mt-2 p-2 bg-light rounded border">
                            <strong>Catatan Verifikator:</strong><br>
                            {{ $get_cek_ver->catatan_verifikasi_awal ?? '-' }}
                        </div> --}}
                    </div>

                @endif
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Berkas & Medis Pasien</h6>

                        <!-- Group Tombol Aksi -->
                        <div class="btn-group" role="group" aria-label="Aksi Berkas Medis">
                            <!-- Tombol Utama: Input Diagnosa -->
                            @if (isset($get_cek_ver) && $get_cek_ver->status_verifikasi == 2)
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modalInputDiagnosa">
                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Diagnosa / Prosedur
                                </button>
                            @endif

                            <!-- Tombol Berkas Lain 1: Resume Medis / Lampiran -->
                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                data-target="#modalberkasseep">
                                <i class="fas fa-file-medical mr-1"></i> Berkas SEP
                            </button>

                            <!-- Tombol Berkas Lain 2: Upload Document / Hasil Lab -->
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#modalberkaslab">
                                <i class="fas fa-vials mr-1"></i> Hasil Laboratorium
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#modalberkaspa">
                                <i class="fas fa-vials mr-1"></i> Hasil Laboratorium Patologi Anatomi
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#modalberkasradiologi">
                                <i class="fas fa-vials mr-1"></i> Hasil Radiologi
                            </button>

                            <!-- Optional: Dropdown Menu jika jenis berkas sangat banyak -->
                            <div class="btn-group" role="group">
                                <button id="btnGroupDropBerkas" type="button"
                                    class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-folder-open mr-1"></i> Berkas Lainnya
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDropBerkas">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalberkasdariluar">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Berkas dari luar
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalberkasusg">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Expertisi
                                        Ultrasonography
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalkonsul">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Lembar Konsul
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalcatatanhd">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Catatan HD
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $urlResume = isset($ts_kunjungan[0])
                ? route('cetakresumedmedisttelokal', $ts_kunjungan[0]->kode_kunjungan)
                : null;
        @endphp
        <!-- 2. TAMPILAN BERKAS / RESUME PASIEN (IFRAME) -->
        <div class="card card-outline card-secondary">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="card-title text-sm font-weight-bold mb-0">
                    <i class="bi bi-file-earmark-pdf mr-1"></i> Berkas Resume Medis
                </h5>
                @if ($urlResume)
                    <a href="{{ $urlResume }}" target="_blank" class="btn btn-xs btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di Tab Baru
                    </a>
                @endif
            </div>
            <div class="card-body p-0">
                @if ($urlResume)
                    <iframe id="iframeResume" src="{{ $urlResume }}"
                        style="width: 100%; height: 750px; border: none;" title="Resume Medis Pasien">
                    </iframe>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-exclamation-circle display-4 d-block mb-2 text-warning"></i>
                        <p class="mb-0">Berkas resume medis tidak ditemukan / URL tidak valid.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>



<div class="modal fade" id="modalInputDiagnosa" tabindex="-1" role="dialog"
    aria-labelledby="modalInputDiagnosaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white py-2">
                <h5 class="modal-title font-weight-bold text-sm" id="modalInputDiagnosaLabel">
                    <i class="fas fa-plus-circle mr-1"></i> Form Entry Diagnosa & Prosedur (ICD-10 / ICD-9)
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">Riwayat Diagnosa yang tersimpan</div>
                    <div class="card-body">
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
                    </div>
                </div>
                <form id="formDiagnosaTindakan">
                    @csrf
                    <input type="hidden" name="kode_kunjungan" value="{{ $kunjungan->kode_kunjungan }}">

                    <div class="row">
                        <!-- Input Diagnosa Utama -->
                        <div class="col-md-6 form-group">
                            <label>Pilih Diagnosa Utama <span class="text-danger">*</span></label>
                            <select class="form-control select2-icd10" id="select_diagnosa_utama"></select>
                        </div>

                        <!-- Input Diagnosa Sekunder -->
                        <div class="col-md-6 form-group">
                            <label>Pilih Diagnosa Sekunder</label>
                            <select class="form-control select2-icd10" id="select_diagnosa_sekunder"></select>
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
</div>
<!-- Modal Berkas Penunjang -->
<div class="modal fade" id="modalberkasdariluar" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Dari Luar
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($gambarscan) && count($gambarscan) > 0)
                    @foreach ($gambarscan as $scan)
                        @php
                            $fileUrl = 'http://192.168.2.45/files/' . ltrim($scan->gambar, '/');
                        @endphp
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="font-weight-bold text-dark">
                                <i class="fas fa-image text-purple mr-1"></i> Berkas Scan Poli
                            </span>
                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-xs btn-outline-primary">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkasseep" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas SEP
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlCetakSEP))
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlCetakSEP }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">Nomor SEP tidak ditemukan untuk kunjungan ini.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkasradiologi" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Radiologi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            <div class="embed-responsive embed-responsive-16by9 mb-3" style="min-height: 480px;">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkaspa" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Laboratorium Patologi Anatomi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                <a href="{{ route('expertisi.cetak', ['id' => $idPA]) }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                </a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 mb-3" style="min-height: 480px;">
                                <iframe class="embed-responsive-item"
                                    src="{{ route('expertisi.cetak', ['id' => $idPA]) }}" allowfullscreen></iframe>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalcatatanhd" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Catatan Hemodialisa
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlCetakHD))
                    <div class="d-flex justify-content-end mb-2 p-2">
                        <a href="{{ $urlCetakHD }}" target="_blank" class="btn btn-xs btn-outline-primary">
                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                        </a>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlCetakHD }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">URL Catatan Hemodialisa tidak ditemukan.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkaslab" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Laboratorium
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <i class="fas fa-vials mr-1"></i> Hasil Lab PDF
                @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                    <span class="badge badge-pill badge-primary">{{ count($lab_terpilih) }}</span>
                @endif
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
                            <div class="embed-responsive embed-responsive-16by9 mb-3" style="min-height: 480px;">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkasusg" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Ultrasonography
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlExpertisiPoli))
                    <div class="d-flex justify-content-end mb-2 p-2">
                        <a href="{{ $urlExpertisiPoli }}" target="_blank" class="btn btn-xs btn-outline-primary">
                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                        </a>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlExpertisiPoli }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">URL Expertisi Ultrasonography tidak ditemukan.</p>
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalkonsul" tabindex="-1" role="dialog" aria-labelledby="modalBerkasPenunjangLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Konsul
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlLembarKonsul))
                    <div class="d-flex justify-content-end mb-2 p-2">
                        <a href="{{ $urlLembarKonsul }}" target="_blank" class="btn btn-xs btn-outline-primary">
                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                        </a>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlLembarKonsul }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">URL Cetak Lembar Konsul tidak ditemukan.</p>
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function kembaliKeTabel() {
        $('.v_1').removeAttr('hidden');
        $('.v_2').attr('hidden', true);
    }

    $(document).ready(function() {
        // 1. Inisialisasi Select2 CUKUP SEKALI saat DOM ready
        // (Menggunakan dropdownParent agar z-index dropdown tidak tertutup modal)
        $('.select2-icd10').select2({
            theme: 'bootstrap4',
            placeholder: 'Ketik kode atau nama diagnosa...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalInputDiagnosa'),
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
                            };
                        })
                    };
                },
                cache: true
            }
        });

        $('.select2-icd9').select2({
            theme: 'bootstrap4',
            placeholder: 'Ketik kode atau nama tindakan...',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#modalInputDiagnosa'),
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
                            };
                        })
                    };
                },
                cache: true
            }
        });

        // 2. Reset Select2 & Form saat Modal Ditutup
        $('#modalInputDiagnosa').on('hidden.bs.modal', function() {
            $('.select2-icd10, .select2-icd9').val(null).trigger('change');
            // Jika ingin mengosongkan tabel temporer saat modal ditutup:
            // $('#tableDiagnosa tbody').empty();
            // $('#tableTindakan tbody').empty();
        });

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

            // Jika Diagnosa Utama dipilih, hapus Diagnosa Utama lama
            if (isUtama) {
                $('#tableDiagnosa tbody tr[data-kategori="Utama"]').remove();
            }

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
            $(this).val(null).trigger('change');
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

        // 5. Hapus Baris Tabel Secara Lokal
        $(document).on('click', '.btn-remove-row', function() {
            $(this).closest('tr').remove();
        });

        // 6. Simpan Data via AJAX
        $('#formDiagnosaTindakan button[type="button"]').on('click', function(e) {
            e.preventDefault();

            let form = $('#formDiagnosaTindakan');
            let formData = form.serialize();
            let btnSave = $(this);

            let hasUtama = $('#tableDiagnosa tbody tr[data-kategori="Utama"]').length > 0;
            if (!hasUtama) {
                alert('Silakan pilih minimal 1 Diagnosa Utama!');
                return;
            }

            btnSave.prop('disabled', true).html(
                '<i class="spinner-border spinner-border-sm mr-1"></i> Menyimpan...');

            $.ajax({
                url: "{{ route('diagnosa-tindakan.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message || 'Data berhasil disimpan!');
                        $('#modalInputDiagnosa').modal('hide');

                        // Reload iframe Resume Medis
                        let iframe = $('#iframeResume');
                        if (iframe.length) {
                            // Menambahkan timestamp query agar browser tidak memakai cache lama
                            let currentUrl = iframe.attr('src').split('?')[0];
                            iframe.attr('src', currentUrl + '?t=' + new Date().getTime());
                        }
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
                    btnSave.prop('disabled', false).html(
                        '<i class="bi bi-save mr-1"></i> Simpan Diagnosa & Prosedur');
                }
            });
        });

        // 7. Hapus Item Tersimpan via AJAX
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
                        $(rowId).fadeOut(400, function() {
                            let tbody = $(this).closest('tbody');
                            $(this).remove();
                            let iframe = $('#iframeResume');
                            if (iframe.length) {
                                // Menambahkan timestamp query agar browser tidak memakai cache lama
                                let currentUrl = iframe.attr('src').split('?')[0];
                                iframe.attr('src', currentUrl + '?t=' + new Date()
                                    .getTime());
                            }
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
