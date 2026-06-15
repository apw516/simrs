@foreach ($data as $d)
    <div class="card card-outline card-info shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-light py-3">
            <div>
                <h6 class="card-title mb-0 fw-bold text-secondary">
                    <i class="bi bi-file-earmark-medical-fill text-info me-2"></i>Hasil Ekspertisi
                </h6>
                <small class="text-muted d-block mt-1">
                    <i class="bi bi-person-fill"></i> Dikirim oleh: <strong>{{ $d->REFERRINGDOCTORNAME }}</strong>
                    <span class="mx-2">|</span>
                    <i class="bi bi-building"></i> {{ $d->ENTERINGOGANIZATION }}
                </small>
            </div>
            <span class="badge bg-info px-3 py-2 rounded-pill fs-7 shadow-sm">
                <i class="bi bi-activity me-1"></i> {{ $d->PROCEDURENAME }}
            </span>
        </div>

        <div class="card-body py-4">
            <div class="row">
                <div class="col-md-8 border-end pr-md-4 mb-3 mb-md-0">
                    <p class="text-uppercase fw-bold text-muted small mb-2" style="letter-spacing: 0.5px;">Catatan /
                        Laporan Ekspertisi:</p>
                    <div class="p-3 bg-light rounded border-start border-3 border-info text-dark"
                        style="white-space: pre-line; line-height: 1.6; font-size: 0.95rem;">
                        {!! nl2br(e($d->REPORT)) !!}
                    </div>
                </div>

                <div class="col-md-4 pl-md-4 d-flex flex-column justify-content-between">
                    <div>
                        <p class="text-uppercase fw-bold text-muted small mb-2" style="letter-spacing: 0.5px;">Lampiran
                            Medis:</p>
                        @if (!empty($d->URL))
                            <a href="{{ $d->URL }}" target="_blank"
                                class="btn btn-outline-primary btn-sm w-100 py-2 mb-3 shadow-sm d-flex align-items-center justify-content-center">
                                <i class="bi bi-images me-2"></i> Lihat Gambar Ekspertisi
                            </a>
                        @else
                            <div class="alert alert-secondary p-2 small text-center rounded mb-3">
                                <i class="bi bi-image-alt"></i> Tidak ada lampiran gambar
                            </div>
                        @endif
                    </div>

                    <div class="pt-3 border-top mt-2">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-check-fill text-success fs-5 me-2"></i>
                            <div>
                                <span class="text-muted d-block small" style="font-size: 0.75rem;">Diisi Oleh:</span>
                                <span class="fw-bold text-dark small">{{ $d->APPROVER }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-check text-muted fs-5 me-2"></i>
                            <div>
                                <span class="text-muted d-block small" style="font-size: 0.75rem;">Tanggal
                                    Disetujui:</span>
                                <span
                                    class="text-muted small fw-medium">{{ date('d M Y H:i', strtotime($d->ADMITDATE)) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
