@if(count($cek) > 0)
    <table class="table table-sm table-hover">
        <thead>
            <th>Nama File</th>
            <th>Unit</th>
            <th>Tanggal Upload</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($cek as $d )
                <tr>
                    <td><img width="20px" src="{{ url('../../files/'.$d->gambar) }}" alt="" class="mr-3"> {{ $d->gambar }}</td>
                    <td>{{ $d->nama_unit }}</td>
                    <td>{{ $d->tgl_upload }}</td>
                    <td>
                        <button class="badge badge-danger">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h5>Tidak ada berkas yang diupload !</h5>
@endif
