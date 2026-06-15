<div class="row text-dark">
    @forelse($cek as $index => $c)
        <div class="col-12 mb-4">
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-light py-3">
                    <div>
                        <h6 class="card-title mb-0 fw-bold text-primary">
                            <i class="bi bi-file-earmark-pdf-fill me-2 fs-5"></i> Berkas Rekam Medis #{{ $index + 1 }}
                        </h6>
                        <small class="text-muted d-block mt-1">
                            <i class="bi bi-link-45deg"></i> Nama Berkas: <span
                                class="text-break fw-medium">{{ basename($c->fileurl) }}</span>
                        </small>
                    </div>
                    <div>
                        <a href="{{ $c->fileurl }}" target="_blank" class="btn btn-sm btn-outline-primary me-2">
                            <i class="bi bi-box-arrow-up-right"></i> Buka di Tab Baru
                        </a>
                        <a href="{{ $c->fileurl }}" download class="btn btn-sm btn-primary">
                            <i class="bi bi-download"></i> Unduh Berkas
                        </a>
                    </div>
                </div>

                <div class="card-body p-0 bg-dark" style="height: 600px;">
                    @if (request()->secure() && Str::startsWith($c->fileurl, 'http://'))
                        <div
                            class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-white p-4 text-center">
                            <i class="bi bi-shield-exclamation text-warning mb-3" style="font-size: 3rem;"></i>
                            <h5>Keamanan Browser Memblokir Pratinjau</h5>
                            <p class="text-muted small max-width-500">
                                Halaman ini berjalan di mode aman (HTTPS), sedangkan file rekam medis berada di server
                                lokal non-HTTPS.
                            </p>
                            <a href="{{ $c->fileurl }}" target="_blank" class="btn btn-warning btn-md mt-2 fw-bold">
                                <i class="bi bi-box-arrow-up-right"></i> Klik Disini Untuk Membuka Dokumen
                            </a>
                        </div>
                    @else
                        <iframe src="{{ $c->fileurl }}#toolbar=1&navpanes=0&statusbar=0" width="100%" height="100%"
                            style="border: none;"></iframe>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-secondary text-center p-5 rounded shadow-sm">
                <i class="bi bi-folder-x text-muted mb-3" style="font-size: 3rem; display: block;"></i>
                <h5 class="fw-bold text-secondary">Berkas Tidak Ditemukan</h5>
                <p class="text-muted mb-0 small">Tidak ada file scan rekam medis yang terikat dengan nomor RM ini di
                    database.</p>
            </div>
        </div>
    @endforelse
</div>
