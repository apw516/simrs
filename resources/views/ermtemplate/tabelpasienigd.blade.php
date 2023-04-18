<table id="tablepasienpoli" class="table table-sm table-hover text-xs">
    <thead>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Unit</th>
    </thead>
    <tbody>
        @foreach ($pasienigd as $p)
            <tr class="pilihpasien">
                <td>{{ $p->id }}</td>
                <td>{{ $p->nama_px }}</td>
                <td>{{ $p->alamat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

