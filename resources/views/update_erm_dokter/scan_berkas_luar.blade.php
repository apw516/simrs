<div class="container-fluid text-dark p-0">
    <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
        <i class="bi bi-paperclip text-primary fs-5 me-2"></i>
        <div>
            <h6 class="mb-0 fw-bold">Dokumen & Galeri Scan Medis</h6>
            <small class="text-muted" style="font-size: 0.75rem;">
                Sistem otomatis menampilkan langsung berkas gambar dan dokumen PDF
            </small>
        </div>
    </div>

    <div class="row g-3">
        @foreach ($cek as $c)
            @php
                $fullImageUrl = rtrim($url, '/') . '/' . ltrim($c->gambar, '/');
                $ext = strtolower(pathinfo($c->gambar, PATHINFO_EXTENSION));
            @endphp

            <div class="col-12 mb-3">
                <div class="card shadow-sm border">
                    <!-- Header Card Nama File & Akses Buka Tab Baru -->
                    <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                        <small class="fw-bold text-truncate me-2">
                            @if ($ext === 'pdf')
                                <i class="bi bi-file-earmark-pdf-fill text-danger me-1"></i>
                            @else
                                <i class="bi bi-file-earmark-image-fill text-primary me-1"></i>
                            @endif
                            {{ $c->gambar }}
                        </small>
                        <a href="{{ $fullImageUrl }}" target="_blank" class="btn btn-xs btn-outline-secondary"
                            title="Buka di tab baru">
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>

                    <!-- Body Card: Tempat Render Langsung File -->
                    <div class="card-body p-2 text-center bg-white">
                        @if ($ext === 'pdf')
                            <!-- Render PDF Langsung dengan iframe -->
                            <iframe src="{{ $fullImageUrl }}" width="100%" height="600px" style="border: none;"
                                class="rounded">
                                <p>Browser Anda tidak mendukung preview PDF.
                                    <a href="{{ $fullImageUrl }}" target="_blank">Klik di sini untuk mengunduh PDF</a>.
                                </p>
                            </iframe>
                        @else
                            <!-- Render Gambar Langsung -->
                            <img src="{{ $fullImageUrl }}" class="img-fluid rounded border shadow-sm" alt="Scan Medis"
                                style="max-height: 700px; width: auto;">
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
