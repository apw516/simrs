<div class="container">
    <h4>Data SEP internal</h4>
    <table id="tabelsepinternal" class="table table-sm table-bordered">
        <thead>
            <th>No SEP</th>
            <th>No Surat</th>
            <th>No SEP ref</th>
            <th>tgl sep</th>
            <th>Poli Asal</th>
            <th>Poli rujukan</th>
            <th>Dokter</th>
            <th>Diagnosa</th>
            <th>tgl rujuk internal</th>
            <th>user</th>
        </thead>
        <tbody>
            @if ($sepinternal->metaData->code == 200)
                @foreach ($sepinternal->response->list as $d)
                    <tr>
                        <td>{{ $d->nosep }}</td>
                        <td>{{ $d->nosurat }}</td>
                        <td>{{ $d->nosepref }}</td>
                        <td>{{ $d->tglsep }}</td>
                        <td>{{ $d->nmpoliasal }}</td>
                        <td>{{ $d->nmtujuanrujuk }}</td>
                        <td>{{ $d->nmdokter }}</td>
                        <td>{{ $d->nmdiag }}</td>
                        <td>{{ $d->tglrujukinternal }}</td>
                        <td>{{ $d->fuser }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
</div>
<script>
    $(function() {
        $("#tabelsepinternal").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [2, "desc"]
            ]
        })
    });
</script>