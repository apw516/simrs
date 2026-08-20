<div class="container-fluid p-2">
    <!-- Header Informasi Pasien & Quick Actions -->
    <div class="card mb-3 border-left-primary shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title text-primary font-weight-bold mb-2">
                        <i class="fas fa-folder-open mr-2"></i>Detail Berkas Pasien
                    </h5>
                    <div class="row text-muted small">
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>Kode Kunjungan:</strong>
                                {{ $ts_kunjungan[0]->kode_kunjungan ?? '-' }}</p>
                            <p class="mb-1"><strong>No. RM:</strong> {{ $ts_kunjungan[0]->no_rm ?? '-' }}</p>
                            <p class="mb-0"><strong>Nama Pasien:</strong> <span
                                    class="text-dark font-weight-bold">{{ $ts_kunjungan[0]->nama_pasien ?? '-' }}</span>
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-1"><strong>No. SEP:</strong>
                                @if (!empty($ts_kunjungan[0]->no_sep))
                                    <span class="badge badge-info">{{ $ts_kunjungan[0]->no_sep }}</span>
                                @else
                                    <span class="badge badge-secondary">Tidak ada SEP</span>
                                @endif
                            </p>
                            <p class="mb-1"><strong>Penjamin:</strong> {{ $ts_kunjungan[0]->penjamin ?? '-' }}</p>
                            <p class="mb-0"><strong>Tgl Kunjungan:</strong> {{ $ts_kunjungan[0]->tgl_masuk ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                    <div class="btn-group-vertical btn-block">
                        @if ($urlCetakSEP)
                            <a href="{{ $urlCetakSEP }}" target="_blank" class="btn btn-sm btn-danger mb-2">
                                <i class="fas fa-print mr-1"></i> Cetak SEP Antrian
                            </a>
                        @endif

                        @if (isset($urlCetakNota) && $urlCetakNota)
                            <a href="{{ $urlCetakNota }}" target="_blank" class="btn btn-sm btn-success">
                                <i class="fas fa-receipt mr-1"></i> Cetak Nota Farmasi
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs untuk Tampilan Berkas -->
    <ul class="nav nav-tabs mb-3" id="berkasTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active font-weight-bold" id="sep-tab" data-toggle="tab" href="#sep" role="tab">
                <i class="fas fa-id-card mr-1"></i> Berkas SEP
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" id="resume-tab" data-toggle="tab" href="#resume" role="tab">
                <i class="fas fa-file-invoice-dollar mr-1"></i> Resume Medis Rawat Jalan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" id="lab-tab" data-toggle="tab" href="#lab" role="tab">
                <i class="fas fa-vials mr-1"></i> Hasil Lab PDF
                @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                    <span class="badge badge-pill badge-primary">{{ count($lab_terpilih) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" id="rad-tab" data-toggle="tab" href="#rad" role="tab">
                <i class="fas fa-x-ray mr-1"></i> Hasil Radiologi
                @if (isset($rad_terpilih) && count($rad_terpilih) > 0)
                    <span class="badge badge-pill badge-warning">{{ count($rad_terpilih) }}</span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" id="obat-tab" data-toggle="tab" href="#obat" role="tab">
                <i class="fas fa-file-invoice-dollar mr-1"></i> Nota / Rincian Obat
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link font-weight-bold" id="berkasscan-tab" data-toggle="tab" href="#berkasscan"
                role="tab">
                <i class="fas fa-layer-group mr-1 text-purple"></i> Berkas scan dipoli
            </a>
        </li>
        <li hidden class="nav-item">
            <a class="nav-link font-weight-bold" id="all-tab" data-toggle="tab" href="#all" role="tab">
                <i class="fas fa-layer-group mr-1 text-purple"></i> Semua Berkas (Merger View)
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="berkasTabContent">

        <!-- 1. TAB PREVIEW SEP -->
        <div class="tab-pane fade show active" id="sep" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-1">
                    @if ($urlCetakSEP)
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
            </div>
        </div>
        <div class="tab-pane fade" id="resume" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-1">
                    @php
                        // Sesuaikan variabel URL Resume dengan variabel/route controller Anda
                        $urlResume = route('cetakresumedmedisttelokal', $ts_kunjungan[0]->kode_kunjungan);
                    @endphp
                    @if (isset($urlResume))
                        <div class="d-flex justify-content-end mb-2 p-2">
                            <a href="{{ $urlResume }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                            </a>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                            <iframe class="embed-responsive-item" src="{{ $urlResume }}" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                            <p class="mb-0">URL Cetak Nota/Rincian Obat tidak ditemukan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- 2. TAB HASIL LAB (PDF / IFRAME) -->
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
                            <p class="mb-0">Tidak ada berkas PDF hasil laboratorium untuk kode kunjungan ini.</p>
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
                            <p class="mb-0">Tidak ada berkas hasil radiologi untuk kode kunjungan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- 4. TAB PREVIEW NOTA / RINCIAN OBAT (PDF / IFRAME) -->
        <div class="tab-pane fade" id="obat" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-1">
                    @if (isset($urlCetakNota) && $urlCetakNota)
                        <div class="d-flex justify-content-end mb-2 p-2">
                            <a href="{{ $urlCetakNota }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                            </a>
                        </div>
                        <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                            <iframe class="embed-responsive-item" src="{{ $urlCetakNota }}" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                            <p class="mb-0">URL Cetak Nota/Rincian Obat tidak ditemukan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="berkasscan" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-1">
                    @if (isset($gambarscan) && $gambarscan)
                        @foreach ($gambarscan as $aaa)
                            @php
                                // Menyusun URL lengkap ke server IP internal
                                $fileUrl = 'http://192.168.2.45/files/' . ltrim($aaa->gambar, '/');
                            @endphp
                            <div class="d-flex justify-content-end mb-2 p-2">
                                <a href="{{ $fileUrl }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                                </a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                <iframe class="embed-responsive-item" src="{{ $fileUrl }}"
                                    allowfullscreen></iframe>
                            </div>
                            {{-- <div class="d-flex justify-content-end mb-2 p-2">
                                <a href="{{ url('../../files/' . $aaa->gambar) }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                                </a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                                <iframe class="embed-responsive-item" src="{{ url('../../files/' . $aaa->gambar) }}"
                                    allowfullscreen></iframe>
                            </div> --}}
                        @endforeach
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                            <p class="mb-0">Tidak ada berkas yang discan ...</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- 5. TAB MERGER / SEMUA BERKAS -->
        <div class="tab-pane fade" id="all" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body p-1">
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 500px;">
                        <iframe class="embed-responsive-item"
                            src="{{ route('farmasi.preview-merger-pdf', $idresep) }}" allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
