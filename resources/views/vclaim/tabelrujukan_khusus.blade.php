<div class="container mt-4">
    <table id="tabelrujukankhusus" class="table table-sm table-bordered">
        <thead>
            <th>No Rujukan</th>
            <th>No Kartu Peserta</th>
            <th>Nama</th>
            <th>Diagnosa</th>
            <th>Tgl Rujukan Awal</th>
            <th>Tgl Rujukan Akhir</th>
        </thead>
        <tbody>
            @if ($list->metaData->code == 200)
                @foreach ($list->response->rujukan as $d)
                    <tr>
                        <td>{{ $d->norujukan }}</td>
                        <td>{{ $d->nokapst }}</td>
                        <td>{{ $d->nmpst }}</td>
                        <td>{{ $d->diagppk }}</td>
                        <td>{{ $d->tglrujukan_awal }}</td>
                        <td>{{ $d->tglrujukan_berakhir }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
</div>
<script>
    $(function() {
        $("#tabelrujukankhusus").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [4, "desc"]
            ]
        })
    });
</script>