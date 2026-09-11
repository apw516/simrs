<style>
    .modal-lg {
        max-width: 95% !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Pemeriksaan Laboratorium PA</div>
                <div class="card-body">

                    @forelse ($hasil_pa as $p)
                        {{-- Cek jika status validasi masih 0 --}}
                        @if ($p->validasi == 0)
                            <div class="alert alert-warning text-center my-3" role="alert">
                                <strong>Pemberitahuan:</strong> Hasil pemeriksaan untuk No. Periksa
                                <strong>{{ $p->no_periksa ?? '-' }}</strong> belum ada atau belum divalidasi.
                            </div>
                        @else
                            {{-- Tampilkan iframe dan detail jika validasi != 0 --}}
                            <iframe src="{{ route('expertisi.cetak', $p->id_header) }}" width="100%" height="600px"
                                class="mb-3 border-0"></iframe>

                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">
                                    <h4 class="m-0">{{ $p->unit_asal }}</h4>
                                    <small>Tanggal Periksa: {{ $p->tgl_input_layanan }} | No Periksa:
                                        {{ $p->no_periksa }} | Tipe: {{ $p->tipe }}</small>
                                </div>
                                <div class="card-body">
                                    <h5>Hasil Pemeriksaan</h5>
                                    <p>
                                        {{ $p->hasil }} {{ $p->id_header }}
                                    </p>

                                    <h5>Diagnostik Pasca Bedah</h5>
                                    <p>
                                        {{ $p->diagnostik_pasca_bedah }}
                                    </p>
                                </div>
                            </div>
                        @endif

                    @empty
                        {{-- Tampilan jika array/collection $hasil_pa benar-benar kosong --}}
                        <div class="alert alert-secondary text-center my-4" role="alert">
                            <i class="fas fa-info-circle mr-1"></i> Tidak ada data hasil pemeriksaan yang ditemukan.
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>
