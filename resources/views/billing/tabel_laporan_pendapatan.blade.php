<div class="card shadow-sm border-0">
    <div class="card-body p-3">

        <!-- HEADER LAPORAN -->
        <div class="text-center mb-4">
            <h5 class="font-weight-bold mb-1">PENDAPATAN LABORATORIUM PATOLOGI ANATOMI</h5>
            <h5 class="font-weight-bold mb-1">RSUD WALED KABUPATEN CIREBON</h5>
            <h6 class="font-weight-bold text-uppercase">
                PERIODE : {{ \Carbon\Carbon::parse($tgl_awal)->format('d-m-Y') }} s/d
                {{ \Carbon\Carbon::parse($tgl_akhir)->format('d-m-Y') }}
            </h6>
        </div>

        <div class="table-responsive">
            <table id="table-laporan-pendapatan" class="table table-bordered table-hover align-middle w-100"
                style="font-size: 0.82rem;">
                <thead class="thead-light text-center">
                    <tr>
                        <th rowspan="2" class="align-middle" style="width: 3%;">NO</th>
                        <th rowspan="2" class="align-middle" style="width: 8%;">TANGGAL</th>
                        <th rowspan="2" class="align-middle" style="width: 18%;">NAMA PASIEN</th>
                        <th rowspan="2" class="align-middle" style="width: 8%;">NO RM</th>
                        <th rowspan="2" class="align-middle" style="width: 22%;">NAMA TINDAKAN</th>
                        <th rowspan="2" class="align-middle" style="width: 9%;">TARIF</th>
                        <th colspan="2" class="align-middle" style="width: 16%;">UMUM</th>
                        <th colspan="2" class="align-middle" style="width: 16%;">BPJS</th>
                    </tr>
                    <tr>
                        <th class="align-middle" style="width: 5%;">JUMLAH</th>
                        <th class="align-middle" style="width: 11%;">PENDAPATAN</th>
                        <th class="align-middle" style="width: 5%;">JUMLAH</th>
                        <th class="align-middle" style="width: 11%;">PENDAPATAN</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tot_pribadi_qty = 0;
                        $tot_pribadi_rp = 0;
                        $tot_penjamin_qty = 0;
                        $tot_penjamin_rp = 0;
                    @endphp

                    @forelse($results as $index => $row)
                        @php
                            // Logika Pemisahan Umum (Pribadi) vs BPJS (Penjamin)
                            $is_pribadi = $row->tagihan_pribadi > 0;
                            $is_penjamin = $row->tagihan_penjamin > 0;

                            $qty_umum = $is_pribadi ? $row->jumlah_layanan : 0;
                            $rp_umum = $is_pribadi ? $row->total_tarif : 0;

                            $qty_bpjs = $is_penjamin ? $row->jumlah_layanan : 0;
                            $rp_bpjs = $is_penjamin ? $row->total_tarif : 0;

                            // Akumulasi Total Bottom Row
                            $tot_pribadi_qty += $qty_umum;
                            $tot_pribadi_rp += $rp_umum;
                            $tot_penjamin_qty += $qty_bpjs;
                            $tot_penjamin_rp += $rp_bpjs;
                        @endphp
                        <tr>
                            <td class="text-center align-middle">{{ $index + 1 }}</td>
                            <td class="text-center align-middle text-nowrap">
                                {{ \Carbon\Carbon::parse($row->tgl_entry)->format('d/m/Y') }}
                            </td>
                            <td class="align-middle text-break">{{ $row->nama_pasien }}</td>
                            <td class="text-center align-middle font-monospace text-nowrap">{{ $row->no_rm }}</td>
                            <td class="align-middle text-break">{{ $row->NAMA_TARIF }}</td>
                            <td class="text-right align-middle text-nowrap">
                                Rp {{ number_format($row->total_tarif, 0, ',', '.') }}
                            </td>

                            <!-- KELOMPOK UMUM -->
                            <td class="text-center align-middle">
                                {{ $qty_umum > 0 ? $qty_umum : '' }}
                            </td>
                            <td class="text-right align-middle text-nowrap">
                                {{ $rp_umum > 0 ? 'Rp ' . number_format($rp_umum, 0, ',', '.') : '' }}
                            </td>

                            <!-- KELOMPOK BPJS -->
                            <td class="text-center align-middle">
                                {{ $qty_bpjs > 0 ? $qty_bpjs : '' }}
                            </td>
                            <td class="text-right align-middle text-nowrap">
                                {{ $rp_bpjs > 0 ? 'Rp ' . number_format($rp_bpjs, 0, ',', '.') : '' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Data laporan pendapatan tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="thead-light font-weight-bold">
                    <tr>
                        <td colspan="6" class="text-center align-middle">JUMLAH TOTAL</td>
                        <td class="text-center align-middle">{{ $tot_pribadi_qty }}</td>
                        <td class="text-right align-middle text-nowrap">
                            Rp {{ number_format($tot_pribadi_rp, 0, ',', '.') }}
                        </td>
                        <td class="text-center align-middle">{{ $tot_penjamin_qty }}</td>
                        <td class="text-right align-middle text-nowrap">
                            Rp {{ number_format($tot_penjamin_rp, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- ASSETS DATATABLES BOOTSTRAP 4 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<!-- EXPORT DEPENDENCIES -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table-laporan-pendapatan').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"lBf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            autoWidth: false,
            paging: false, // Menampilkan seluruh baris sekaligus agar hasil export Excel lengkap
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel mr-1"></i> Export Excel',
                    className: 'btn btn-success btn-sm',
                    title: 'PENDAPATAN_LABORATORIUM_PATOLOGI_ANATOMI_{{ $tgl_awal }}_s/d_{{ $tgl_akhir }}',
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf mr-1"></i> Export PDF',
                    className: 'btn btn-danger btn-sm',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    title: 'PENDAPATAN LABORATORIUM PATOLOGI ANATOMI',
                    footer: true
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-1"></i> Cetak',
                    className: 'btn btn-secondary btn-sm',
                    footer: true
                }
            ],
            language: {
                search: "Cari Data:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                zeroRecords: "Data tidak ditemukan"
            }
        });
    });
</script>
