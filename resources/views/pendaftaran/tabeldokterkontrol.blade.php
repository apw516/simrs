<table id="tabeldokterkontrol" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama Dokter</th>
        <th>Jadwal</th>
        <th>Kapasitas</th>
    </thead>
    <tbody>
        @if($poli->metaData->code == 200)
        @foreach ($poli->response->list as $p)
            <tr class="pilihdokter" nama="{{ $p->namaDokter }}" data-id="{{ $p->kodeDokter }}">
                <td>{{ $p->namaDokter }}</td>
                <td>{{ $p->jadwalPraktek }}</td>
                <td>{{ $p->kapasitas }}</td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeldokterkontrol").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $('#tabeldokterkontrol').on('click', '.pilihdokter', function() {
        nama = $(this).attr('nama')
        kode = $(this).attr('data-id')
        $('#dokterkontrol').val(nama)
        $('#modalpilihdokterpasca').modal('hide');
        $('#modalpilihdokter').modal('hide');
        $('#dokterkontrolpasca').val(nama)
        $('#kodedokterkontrol').val(kode)
        $('#kodedokterkontrolpasca').val(kode)
        $('#dokterkontrol2').val(nama)
        $('#kodedokterkontrol2').val(kode)
        $('#dokterkontrol_update').val(nama)
        $('#kodedokterkontrol_update').val(kode)      
    
    });
</script>
