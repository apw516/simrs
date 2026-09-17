<table id="tabelfaskes" class="table table-sm table-bordered">
    <thead>
        <th>Kode</th>
        <th>Nama Faskes</th>
    </thead>
    <tbody>
        @foreach ($detail->response->faskes as $d)
            <tr>
                <td>{{ $d->kode }}</td>
                <td>{{ $d->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelfaskes").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 8,
            "searching": true,
            "ordering": false,
        })
    });
