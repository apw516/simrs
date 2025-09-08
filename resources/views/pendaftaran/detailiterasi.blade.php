<table class="table table-sm">
    <thead>
        <th>Nama Unit</th>
        <th>Tanggal Masuk</th>
    </thead>
    <tbody>
        @foreach ($get_detail as $f)
            <tr>
                <td>{{ $f->nama_unit}}</td>
                <td>{{ \Carbon\Carbon::parse($f->tglk)->format('d - M - Y')}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
