<table id="tabeldpho" class="table table-bordered table-hover">
    <thead class="bg-secondary">
        <th>Kode Obat</th>
        <th>Nama Obat</th>
        <th>PRB</th>
        <th>KRONIS</th>
        <th>KEMO</th>
        <th>Restriksi</th>
        <th>Generik</th>
        <th>Aktif</th>
        <th>Sedia</th>
        <th>Stok</th>
        <th>Last update</th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->kodeobat }}</td>
                <td>{{ $d->namaobat }}</td>
                <td>{{ $d->prb }}</td>
                <td>{{ $d->kronis }}</td>
                <td>{{ $d->kemo }}</td>
                <td>{{ $d->restriksi }}</td>
                <td>{{ $d->generik }}</td>
                <td>{{ $d->aktif }}</td>
                <td>{{ $d->sedia }}</td>
                <td>{{ $d->stok }}</td>
                <td>{{ $d->tgl_download }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeldpho").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 12,
            "searching": true
        })
    });
</script>
