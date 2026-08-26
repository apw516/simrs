<table id="tableLayanan" class="table table-hover table-striped align-middle w-100" style="font-size: 13px;">
    <thead class="table-light">
        <tr>
            <th class="text-center" style="width: 50px;">No</th>
            <th>Kode Kunjungan / Header</th>
            <th>No RM / Nama Pasien</th>
            <th>Alamat</th>
            <th>Penjamin</th>
            <th>Unit Pengirim</th>
            <th>Tgl Entry / Kunjungan</th>
            <th class="text-center">Status</th>
            <th class="text-center" style="width: 80px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $row)
            <tr>
                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                <td>
                    <span class="fw-bold text-primary">{{ $row->kode_kunjungan }}</span><br>
                    <small class="text-muted">{{ $row->kode_layanan_header }}</small>
                </td>
                <td>
                    <strong>{{ $row->nama_pasien ?? '-' }}</strong><br>
                    <span class="badge bg-secondary">{{ $row->no_rm }}</span>
                </td>
                <td>{{ $row->alamat_pasien ?? '-' }}</td>
                <td>
                    <span class="badge bg-info text-dark">{{ $row->nama_penjamin ?? '-' }}</span>
                </td>
                <td>
                    <i class="bi bi-house-fill"></i>
                    {{ $row->unit_pengirim ?? '-' }}
                </td>
                <td>
                    <div><i
                            class="bi bi-clock me-1 text-muted"></i>{{ \Carbon\Carbon::parse($row->tgl_entry)->format('d-m-Y H:i') }}
                    </div>
                    <small class="text-muted">Kunjungan:
                        {{ \Carbon\Carbon::parse($row->tgl_kunjungan)->format('d-m-Y H:i') }}</small>
                </td>
                <td class="text-center">
                    @if ($row->status_kunjungan == 1)
                        <span class="badge bg-warning text-dark">Aktif</span>
                    @elseif ($row->status_kunjungan == 2)
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-light text-dark">Status:
                            {{ $row->status_kunjungan }}</span>
                    @endif
                </td>
                <td class="text-center">
                    {{-- <a href="{{ route('billing.penunjang', ['kode' => $row->kode_kunjungan]) }}"
                                        class="btn btn-sm btn-primary" title="Proses Order / Billing">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a> --}}
                    <a class="btn btn-sm btn-primary" title="Detail Layanan">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a class="btn btn-sm btn-success" title="Lihat Hasil Expertisi">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted py-4">
                    <i class="fa-solid fa-folder-open fa-2x mb-2"></i><br>
                    Tidak ada data layanan penunjang untuk hari ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
