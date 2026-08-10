<div class="container-fluid mt-4">
    @php
        // Mengamankan pembacaan data jika berupa string JSON atau bertipe null
        $res = is_string($data) ? json_decode($data, true) : (array) $data;
        $response = $res['response'] ?? null;
        
        // Pengecekan jumlah data & status meta
        $jumlahData = $response['jumlahdata'] ?? ($response['rekap']['jumlahdata'] ?? 0);
        $rekap = $response['rekap'] ?? null;
        $listSep = $response['listsep'] ?? ($rekap['listsep'] ?? []);
        $metaMessage = $res['metaData']['message'] ?? ($response['metaData']['message'] ?? 'Data tidak ditemukan');
    @endphp

    {{-- Tampilkan Konten jika Jumlah Data Lebih dari 0 dan listSep Berisi Data --}}
    @if ((int) $jumlahData > 0 && !empty($listSep))

        {{-- Section Ringkasan (Rekap) --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahData }} Data</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Biaya Pengajuan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($rekap['totalbiayapengajuan'] ?? ($response['totalbiayapengajuan'] ?? 0), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Biaya Disetujui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp {{ number_format($rekap['totalbiayasetuju'] ?? ($response['totalbiayasetuju'] ?? 0), 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Tabel Detail SEP Apotek --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary text-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Daftar SEP Apotek</h6>
                <span class="badge badge-light text-dark">Status: {{ $metaMessage }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>No. SEP Apotek / Asal</th>
                                <th>No. Kartu & Peserta</th>
                                <th>No. Resep</th>
                                <th>Jenis Obat</th>
                                <th>Tgl Pelayanan</th>
                                <th class="text-right">Biaya Pengajuan</th>
                                <th class="text-right">Biaya Disetujui</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($listSep as $index => $ss)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $ss['nosepapotek'] ?? '-' }}</strong><br>
                                        <small class="text-muted">Asal: {{ $ss['nosepaasal'] ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <strong>{{ $ss['namapeserta'] ?? ($ss['nmpst'] ?? '-') }}</strong><br>
                                        <small class="text-muted">No: {{ $ss['nokartu'] ?? ($ss['nokapst'] ?? '-') }}</small>
                                    </td>
                                    <td><span class="badge badge-info">{{ $ss['noresep'] ?? '-' }}</span></td>
                                    <td>{{ $ss['jnsobat'] ?? ($ss['nmjnsobat'] ?? '-') }}</td>
                                    <td>
                                        {{ isset($ss['tglpelayanan']) ? \Carbon\Carbon::parse($ss['tglpelayanan'])->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="text-right font-weight-bold">
                                        Rp {{ number_format($ss['biayapengajuan'] ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="text-right font-weight-bold text-success">
                                        Rp {{ number_format($ss['biayasetuju'] ?? ($ss['biayasetujui'] ?? 0), 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle mr-1"></i> Data SEP tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        {{-- Tampilan Alert yang Aman Jika Data Kosong / 0 / Error --}}
        <div class="alert alert-warning shadow d-flex align-items-center" role="alert">
            <div class="mr-3">
                <i class="fas fa-exclamation-triangle fa-2x"></i>
            </div>
            <div>
                <h5 class="alert-heading mb-1">Data Tidak Ditemukan</h5>
                <p class="mb-0">{{ $metaMessage }} (Jumlah Data: {{ $jumlahData }})</p>
            </div>
        </div>
    @endif
</div>