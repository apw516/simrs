<table id="tabeldokterkontrol" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama Dokter</th>
        <th>Jadwal</th>
        <th>Kapasitas</th>
    </thead>
    <tbody>
        @foreach ($dokter as $p)
            <tr class="pilihdokter" nama="{{ $p->nama_paramedis }}" data-id="{{ $p->kode_dokter_jkn }}">
                <td>{{ $p->nama_paramedis }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
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
