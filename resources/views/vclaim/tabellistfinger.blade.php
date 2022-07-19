<div class="container mt-4">
    <table id="tabellistfinger" class="table table-sm table-bordered">
        <thead>
            <th>No Kartu</th>
            <th>No SEP</th>
        </thead>
        <tbody>
            @if ($list->metaData->code == 200)
                @foreach ($list->response->list as $d)
                    <tr>
                        <td>{{ $d->noKartu }}</td>
                        <td>{{ $d->noSEP }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
</div>
<script>
    $(function() {
        $("#tabellistfinger").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [0, "desc"]
            ]
        })
    });
</script>