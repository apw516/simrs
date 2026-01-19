<table id="tabelsetapotek" class="table table-bordered table-hover">
    <thead>
        <th>Nama Apoteker</th>
        <th>Nama Kepala</th>
        <th>Jabatan Kepala</th>
        <th>NIP</th>
        <th>SIUP</th>
        <th>Alamat</th>
        <th>Nama verifikator</th>
        <th>Nama petugas apotek</th>
        <th>Check Stok</th>
        <th>Update</th>
    </thead>
    <tbody>
        @foreach($data as $d)
            <tr>
                <td>{{ $d->namaapoteker}}</td>
                <td>{{ $d->namakepala}}</td>
                <td>{{ $d->jabatankepala}}</td>
                <td>{{ $d->nipkepala}}</td>
                <td>{{ $d->siup}}</td>
                <td>{{ $d->kota }} , {{ $d->alamat}}</td>
                <td>{{ $d->namaverifikator}}</td>
                <td>{{ $d->namapetugasapotek}}</td>
                <td>{{ $d->checkstock}}</td>
                <td>{{ $d->last_update}}</td>
            </tr>
        @endforeach 
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelsetapotek").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 12,
            "searching": true
        })
    });
</script>