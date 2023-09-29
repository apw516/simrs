<table id="tabelstok" class="table table-sm table-bordered text-xs">
    <thead>
        <th>Tanggal Stok</th>
        <th>Nomor Dokumen</th>
        <th>Nama Barang</th>
        <th>Stok Last</th>
        <th>Stok In</th>
        <th>Stok Out</th>
        <th>Stok Current</th>
        {{-- <th>Harga Beli</th> --}}
        <th>Keterangan</th>
    </thead>
    <tbody>
        @foreach ($stok as $s)
            <tr>
                <td>{{ $s->tgl_stok }}</td>
                <td>{{ $s->no_dokumen }}</td>
                <td>{{ $s->nama_barang }}</td>
                <td>{{ $s->stok_last }}</td>
                <td>{{ $s->stok_in }}</td>
                <td>{{ $s->stok_out_rajal }}</td>
                <td>{{ $s->stok_current }}</td>
                {{-- <td>IDR {{ number_format($s->harga_beli, 2) }}</td> --}}
                <td>{{ $s->username }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelstok").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
    });
</script>
