<table id="tabelstok" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tanggal Stok</th>
        <th>Nama Barang</th>
        <th>Unit</th>
        <th>Stok LAST</th>
        <th>Stok IN</th>
        <th>Stok OUT</th>
        <th>Stok CURRENT</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @foreach ($stok  as $s )
            <tr>
                <td>{{ $s->tgl_stok}}</td>
                <td>{{ $s->nama}}</td>
                <td>{{ $s->kode_unit}}</td>
                <td class="text-right">{{ $s->stok_last}}</td>
                <td class="text-right">{{ $s->stok_in}}</td>
                <td class="text-right">{{ $s->stok_out }}</td>
                <td class="text-right">{{ $s->stok_current}}</td>
                <td class="text-right">{{ $s->keterangan}}</td>
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
            "pageLength": 15,
            "searching": true,
            "ordering": false,
        })
    });
