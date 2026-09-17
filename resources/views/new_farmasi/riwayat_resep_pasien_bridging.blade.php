
<table class="table table-sm table-bordered" id="tabelriayawatbpjs">
    <thead>
        <th>SEP Apotek</th>
        <th>Tanggal Pelayanan</th>
        <th>no resep</th>
        <th>nama obat</th>
        <th>jumlah obat</th>
        <th>jumlah obat</th>
    </thead>
    <tbody>
        @foreach($detail->response->list->history as $d)
            <tr>
                <td>{{ $d->nosjp}}</td>
                <td>{{ $d->tglpelayanan}}</td>
                <td>{{ $d->noresep}}</td>
                <td>{{ $d->kodeobat}}</td>
                <td>{{ $d->namaobat}}</td>
                <td>{{ $d->jmlobat}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriayawatbpjs").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });