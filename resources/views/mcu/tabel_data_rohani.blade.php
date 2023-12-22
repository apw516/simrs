<table id="tbsuratroh" class="table table-sm table-hover table-bordered">
    <thead>
        <th>Nomor Surat</th>
        <th>RM</th>
        <th>Nama Pasien</th>
        <th>Keperluan</th>
        <th>Tanggal Surat</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($dh as $d )
            <tr>
                <td>{{ $d->no_surat}}</td>
                <td>{{ $d->no_rm}}</td>
                <td>{{ $d->nama_px}}</td>
                <td>{{ $d->keperluan}} | {{ $d->keterangan }}</td>
                <td>{{ $d->tgl_surat}}</td>
                <td><button id="{{ $d->id_surat}}" class="btn btn-sm btn-info cetaksurat">Cetak</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
 $(function() {
        $("#tbsuratroh").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $(".cetaksurat").on('click', function(event) {
        id = $(this).attr('id')
        var url = 'http://192.168.2.233/simcu/Cetak_jasroh/index/' +id;
        window.open(url)

    });
</script>
