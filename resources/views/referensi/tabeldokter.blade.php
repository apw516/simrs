<table id="tabeldokter" class="table table-bordered table-sm text-md mt-3">
    <thead>
        <th>Kode</th>
        <th>Nama</th>
    </thead>
    <tbody>
        @if ($dokter->metaData->code == 200)
        @foreach ($dokter->response->list as $d )
            <tr>
                <td>{{ $d->kode }}</td>
                <td>{{ $d->nama }}</td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
     $(function() {
            $("#tabeldokter").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
</script>