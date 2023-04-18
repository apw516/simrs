<table class="table table-sm">
    <thead>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
    </thead>
    <tbody>
        @foreach ($pasien_igd as $p )
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nama_px }}</td>
                <td>{{ $p->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
