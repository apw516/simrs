<table id="tabelhasil" class="table table-sm table-hover">
    <thead>
        <th>tgl sumarilis</th>
        <th>Diagnosa</th>
        {{-- <th>Siklus</th> --}}
        <th>Keterangan Regimen</th>
        <th>Obat</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
            <tr>
                <td>{{ $d->tgl_kunjungan}}</td>
                <td>{{ $d->diagnosa}}</td>
                {{-- <td>{{ $d->siklus}}</td> --}}
                <td>{{ $d->tindakan}}</td>
                <td>{{ $d->obat}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelhasil").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
</script>
