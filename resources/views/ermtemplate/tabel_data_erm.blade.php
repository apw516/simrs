<table id="tabeldataerm" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tanggal Pemeriksaan</th>
        <th>No RM</th>
        <th>Nama Pasien</th>
        <th>Nama Dokter</th>
        <th>Nama Perawat</th>
        <th>Nama Poli</th>
    </thead>
    <tbody>
        @foreach ($dataerm as $d )
            <tr>
                <td>{{ $d->tgl_pemeriksaan}}</td>
                <td>{{ $d->id_pasien}}</td>
                <td>{{ $d->nama_pasien}}</td>
                <td>{{ $d->nama_dokter}}</td>
                <td>{{ $d->perawat}}</td>
                <td>{{ $d->nama_poli}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeldataerm").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>
