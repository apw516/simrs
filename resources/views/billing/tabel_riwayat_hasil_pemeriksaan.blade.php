<div class="card shadow-sm border-0">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="table-riwayat-pa" class="table table-bordered table-hover align-middle w-100"
                style="font-size: 0.85rem;">
                <thead class="thead-dark text-center">
                    <tr>
                        <th style="width: 3%;">No</th>
                        <th style="width: 3%;">Tanggal</th>
                        <th style="width: 8%;">No. RM</th>
                        <th style="width: 12%;">Nama Pasien</th>
                        <th style="width: 10%;">Tgl Lahir / Usia</th>
                        <th hidden>Alamat</th>
                        <th style="width: 9%;">No. Periksa</th>
                        <th style="width: 12%;">Jenis Pemeriksaan</th>
                        <th style="width: 8%;">Sampel</th>
                        <th style="width: 12%;">Makroskopis</th>
                        <th style="width: 13%;">Mikroskopis</th>
                        <th style="width: 13%;">Kesimpulan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $index => $row)
                        @php
                            $hasil_split = isset($row->hasil) ? explode('|', $row->hasil) : [];
                            $Makroskopis = $hasil_split[0] ?? '-';
                            $Mikroskopis = $hasil_split[1] ?? '-';
                            $kesimpulan = $hasil_split[2] ?? '-';
                        @endphp
                        <tr>
                            <td class="text-center align-top">{{ $index + 1 }}</td>
                            <td class="text-center align-top text-nowrap">{{ \Carbon\Carbon::parse($row->tgl_input_layanan)->format('d-m-Y') }}</td>
                            <td class="font-weight-bold text-center align-top text-nowrap">{{ $row->no_rm }}</td>
                            <td class="align-top text-break">{{ $row->nama_pasien }}</td>
                            <td class="align-top text-nowrap">
                                @if (!empty($row->tgl_lahir))
                                    {{ \Carbon\Carbon::parse($row->tgl_lahir)->format('d-m-Y') }}/ {{ \Carbon\Carbon::parse($row->tgl_lahir)->age }} Th</small>
                                @else
                                    -
                                @endif
                            </td>
                            <td hidden>{{ $row->alamat }}</td>
                            <td class="text-center align-top font-monospace text-nowrap">{{ $row->no_periksa }}</td>
                            <td class="align-top text-break">{{ $row->NAMA_TARIF }}</td>
                            <td class="align-top text-break">{{ $row->tipe }}</td>
                            <td class="align-top text-break" style="white-space: pre-line; max-width: 180px;">
                                {{ $Makroskopis }}</td>
                            <td class="align-top text-break" style="white-space: pre-line; max-width: 200px;">
                                {{ $Mikroskopis }}</td>
                            <td class="align-top text-break" style="white-space: pre-line; max-width: 200px;">
                                {{ $kesimpulan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Data riwayat hasil pemeriksaan tidak
                                ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
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
        $('#table-riwayat-pa').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"lBf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            autoWidth: false,
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel mr-1"></i> Export Excel',
                    className: 'btn btn-success btn-sm',
                    title: 'Riwayat_Hasil_Pemeriksaan_PA',
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
                    title: 'Riwayat Hasil Pemeriksaan PA'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-1"></i> Cetak',
                    className: 'btn btn-secondary btn-sm'
                }
            ],
            language: {
                search: "Cari Data:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Lanjut",
                    previous: "Kembali"
                }
            },
            pageLength: 10
        });
    });
</script>
