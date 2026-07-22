<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                    <i class="fas fa-microscope text-primary mr-2"></i> Hasil Pemeriksaan Laboratorium
                </div>
                <div class="card-body p-2">
                    @foreach ($datahasil as $c)
                        <div class="mb-4 border rounded shadow-sm">
                            <div
                                class="bg-light p-2 border-bottom small fw-bold text-secondary d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-file-pdf text-danger mr-1"></i>
                                    No. Lab: {{ $c->no_lab }}
                                </span>
                                <span class="badge badge-primary">Arsip Lokal LAB_1</span>
                            </div>
                            <iframe src="{{ route('buka.pdf.lokal', ['nama_file' => $c->nama_file]) }}" width="100%"
                                height="900px" style="border: none; display: block;">
                            </iframe>
                        </div>
                    @endforeach
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
