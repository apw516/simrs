<div class="card shadow-sm border-0">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-bold">
            <i class="fas fa-pills mr-2"></i> Detail Obat & Resep BPJS
        </h6>
        @if (isset($data) && count($data) > 0 && !empty($data[0]->NORESEP))
            <span class="badge badge-light text-dark font-weight-bold">
                No. Resep: {{ $data[0]->NORESEP }}
            </span>
        @endif
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle mb-0">
                <thead class="bg-light text-dark text-center font-weight-bold small">
                    <tr>
                        <th style="width: 40px;" rowspan="2" class="align-middle">No</th>
                        <th colspan="3" class="bg-light border-bottom-0">Data Obat SIMRS (Layanan)</th>
                        <th colspan="4" class="bg-light border-bottom-0 border-left">Data Bridging / Resep BPJS</th>
                        <th style="width: 90px;" rowspan="2" class="align-middle border-left">Status</th>
                    </tr>
                    <tr>
                        <!-- SIMRS -->
                        <th>Nama Barang</th>
                        <th style="width: 80px;">Jumlah</th>
                        <th>Aturan Pakai</th>

                        <!-- BPJS -->
                        <th class="border-left">Nama Obat BPJS</th>
                        <th style="width: 90px;">Signa</th>
                        <th style="width: 60px;">JHO</th>
                        <th style="width: 80px;">Jml BPJS</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($data as $index => $row)
                        <tr>
                            <td class="text-center align-middle font-weight-bold">{{ $index + 1 }}</td>

                            <!-- SIMRS Data -->
                            <td class="align-middle">
                                <strong class="text-dark">{{ $row->nama_barang ?? '-' }}</strong>
                            </td>
                            <td class="text-center align-middle">
                                <span class="badge badge-secondary px-2 py-1">
                                    {{ $row->jumlah_layanan ?? 0 }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <span class="text-muted">{{ $row->aturan_pakai ?? '-' }}</span>
                            </td>

                            <!-- BPJS Data -->
                            <td class="align-middle border-left">
                                @if (!empty($row->NMOBAT))
                                    <span class="text-primary font-weight-bold">{{ $row->NMOBAT }}</span>
                                @else
                                    <span class="text-muted italic">- (Belum Mapping) -</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @if ($row->SIGNA1OBT || $row->SIGNA2OBT)
                                    <code>{{ $row->SIGNA1OBT ?? '0' }} x {{ $row->SIGNA2OBT ?? '0' }}</code>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                {{ $row->JHO ?? '-' }} Hari
                            </td>
                            <td class="text-center align-middle">
                                @if (!empty($row->JMLOBT))
                                    <span class="badge badge-info px-2 py-1">{{ $row->JMLOBT }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <!-- Status Bridging -->
                            <td class="text-center align-middle border-left">
                                @if ($row->Bridging == '1' || strtolower($row->Bridging ?? '') == 'sudah')
                                    <span class="badge badge-success px-2 py-1" title="Sudah Bridging">
                                        <i class="fas fa-check-circle"></i> Bridging
                                    </span>
                                @elseif($row->Bridging == '0' || strtolower($row->Bridging ?? '') == 'belum')
                                    <span class="badge badge-warning px-2 py-1" title="Belum Bridging">
                                        <i class="fas fa-clock"></i> Belum
                                    </span>
                                @else
                                    <span class="badge badge-light border text-muted px-2 py-1">
                                        {{ $row->Bridging ?? '-' }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2 d-block text-secondary"></i>
                                Tidak ada detail item resep/layanan untuk ID Header ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
