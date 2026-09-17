<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="tbr" class="table table-hover table-striped align-middle mb-0">
                <thead class="table-dark text-nowrap">
                    <tr>
                        <th class="text-center" scope="col">NO</th>
                        <th scope="col">NO RESEP</th>
                        <th scope="col">NO APOTIK</th>
                        <th scope="col">NO SEP KUNJUNGAN</th>
                        <th scope="col">NO KARTU</th>
                        <th scope="col">NAMA PASIEN</th>
                        <th scope="col">TGL ENTRY</th>
                        <th scope="col">TGL RESEP</th>
                        <th scope="col">TGL PELAYANAN RESEP</th>
                        <th class="text-end" scope="col">BYTAGRSP</th>
                        <th class="text-end" scope="col">BYVERRSP</th>
                        <th class="text-center" scope="col">KDJNSOBAT</th>
                        <th scope="col" hidden>FASKESASAL</th>
                        <th class="text-center" scope="col">FLAGITER</th>
                    </tr>
                </thead>
                <tbody class="text-nowrap">
                    @forelse($detail->response as $d)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $d->NORESEP }}</span></td>
                            <td>{{ $d->NOAPOTIK }}</td>
                            <td>{{ $d->NOSEP_KUNJUNGAN }}</td>
                            <td>{{ $d->NOKARTU }}</td>
                            <td class="fw-semibold">{{ $d->NAMA }}</td>
                            <td>{{ $d->TGLENTRY }}</td>
                            <td>{{ $d->TGLRESEP }}</td>
                            <td>{{ $d->TGLPELRSP }}</td>
                            <td class="text-end font-monospace">{{ number_format($d->BYTAGRSP ?? 0, 0, ',', '.') }}</td>
                            <td class="text-end font-monospace">{{ number_format($d->BYVERRSP ?? 0, 0, ',', '.') }}</td>
                            <td class="text-center"><span class="badge bg-info text-dark">{{ $d->KDJNSOBAT }}</span></td>
                            <td hidden>{{ $d->FASKESASAL }}</td>
                            <td class="text-center">
                                <span class="badge {{ $d->FLAGITER ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $d->FLAGITER }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="13" class="text-center py-4 text-muted">
                                <em>Data resep tidak ditemukan.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tbr").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 12,
            "searching": true,
            "ordering": false,
        })
    });
</script>