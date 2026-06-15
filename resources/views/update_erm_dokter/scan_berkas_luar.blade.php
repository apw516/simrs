<div class="container-fluid text-dark p-0">
    <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
        <i class="bi bi-paperclip text-primary fs-5 me-2"></i>
        <div>
            <h6 class="mb-0 fw-bold">Dokumen & Galeri Scan Medis</h6>
            <small class="text-muted" style="font-size: 0.75rem;">Sistem otomatis memisahkan berkas gambar dan dokumen
                PDF</small>
        </div>
    </div>

    <div class="row g-2">
        @foreach ($cek as $c)
            @php
                $fullImageUrl = rtrim($url, '/') . '/' . ltrim($c->gambar, '/');
                $ext = strtolower(pathinfo($c->gambar, PATHINFO_EXTENSION));
            @endphp

            @if ($ext === 'pdf')
                <div class="col-12 my-1">
                    <a href="{{ $fullImageUrl }}" target="_blank"
                        class="btn btn-sm btn-outline-danger d-inline-flex align-items-center">
                        <i class="bi bi-file-earmark-pdf-fill me-2"></i> Buka Dokumen PDF ({{ $c->gambar }})
                    </a>
                </div>
            @else
                <div class="col-12 col-md-12 col-lg-12 m-1">
                    <img src="{{ $fullImageUrl }}" class="img-thumbnail img-fluid" alt="Scan Medis">
                    <div class="small text-muted text-truncate" style="font-size: 0.7rem;">{{ $c->gambar }}</div>
                </div>
            @endif
        @endforeach
    </div>
</div>
