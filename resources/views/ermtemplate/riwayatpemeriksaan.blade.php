<div class="container-fluid">
    <table id="tableriwayatperiksa" class="table table-bordered table-sm table-hover">
        <thead class="bg-secondary">
            <th>Tanggal Kunjungan</th>
            <th>RM</th>
            <th>Nama</th>
            <th>Dokter Periksa</th>
            <th>Perawat</th>
            <th>Keluhan Utama</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d->tanggalkunjungan }}</td>
                    <td>{{ $d->no_rm }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->nama_dokter }}</td>
                    <td>{{ $d->nama_perawat }}</td>
                    <td>{{ $d->keluhanutama }}</td>
                    <td class="text-center"><button class="badge badge-info">Detail</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(function() {
        $("#tableriwayatperiksa").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>
