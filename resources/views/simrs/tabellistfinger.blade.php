<table id="tabellistfinger" class="table table-bordered table-sm text-xs mt-3">
    <thead>
        <th>nomor kartu</th>
        <th>Nomor SEP</th>
    </thead>
    <tbody>
        @if($listajuan->metaData->code == 200)
            @foreach ($listajuan->response->list as $d )
                <tr>
                    <td>{{ $d->noKartu}}</td>
                    <td>{{ $d->noSEP}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#tabellistfinger").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [[ 1, "desc" ]]
        })
    });
</script>