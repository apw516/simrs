<div class="container-fluid text-dark">
    <div class="timeline">

        @forelse($cek as $index => $c)
            <div class="time-label">
                <span class="bg-primary text-white shadow-sm px-3 py-2 rounded font-weight-bold">
                    <i class="bi bi-calendar3 me-1"></i> {{ date('d M Y', strtotime($c->tgl_kunjungan)) }}
                </span>
            </div>

            <div>
                <i class="bi bi-activity bg-info text-white shadow-sm"></i>

                <div class="timeline-item card shadow-sm border-start border-3 border-info mb-4">
                    <div
                        class="timeline-header card-header bg-light d-flex justify-content-between align-items-center py-2">
                        <h6 class="mb-0 fw-bold text-secondary">
                            <i class="bi bi-file-earmark-medical me-1 text-info"></i> Kunjungan Rekam Medis
                        </h6>
                        <span class="badge bg-dark px-3 py-2 rounded-pill">
                            <i class="bi bi-arrow-repeat me-1 text-warning"></i> Siklus: <strong
                                class="text-white">{{ $c->siklus }}</strong>
                        </span>
                    </div>

                    <div class="timeline-body card-body py-3">
                        <div class="row g-3">
                            <div class="col-md-4 border-end-md">
                                <span class="text-uppercase text-dark d-block small fw-bold mb-1"
                                    style="letter-spacing: 0.5px;">Diagnosa</span>
                                <div class="p-2 bg-light rounded fw-semibold text-primary">
                                    <i class="bi bi-patch-check-fill text-primary me-1"></i> {{ $c->diagnosa }}
                                </div>
                            </div>

                            <div class="col-md-8">
                                <span class="text-uppercase text-dark d-block small fw-bold mb-1"
                                    style="letter-spacing: 0.5px;">Keterangan Regimen</span>
                                <p class="mb-0 text-secondary small" style="line-height: 1.5;">
                                    {{ $c->ket_regimen ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <hr class="text-dark my-3 opacity-25">

                        <div class="bg-light p-3 rounded border border-start-0">
                            <span class="text-uppercase text-danger d-block small fw-bold mb-2"
                                style="letter-spacing: 0.5px;">
                                <i class="bi bi-capsule-hr me-1"></i> Resep Obat / Regimen Terapi
                            </span>
                            <div class="text-dark fw-medium" style="white-space: pre-line; line-height: 1.6;">
                                {{ $c->obat }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center p-5 bg-light rounded border border-dashed">
                <i class="bi bi-journal-x text-dark mb-3" style="font-size: 3rem; display: block;"></i>
                <h5 class="text-secondary fw-bold">Belum Ada Riwayat Siklus</h5>
                <p class="text-dark small mb-0">Pasien ini belum memiliki catatan riwayat kunjungan atau regimen
                    pengobatan.</p>
            </div>
        @endforelse

        <div>
            <i class="bi bi-clock bg-secondary text-white shadow-sm"></i>
        </div>
    </div>
</div>
