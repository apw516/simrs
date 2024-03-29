<table id="tabelpolikontrol" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama Poli</th>
        <th>Jlh Kontrol dan Rujukan</th>
        <th>Kapasitas</th>
    </thead>
    <tbody>
        @if($poli->metaData->code == 200)
        @foreach ($poli->response->list as $p)
            <tr class="pilihpoli" nama="{{ $p->namaPoli }}" data-id="{{ $p->kodePoli }}">
                <td>{{ $p->namaPoli }}</td>
                <td>{{ $p->jmlRencanaKontroldanRujukan }}</td>
                <td>{{ $p->kapasitas }}</td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelpolikontrol").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true
        })
    });
    $('#tabelpolikontrol').on('click', '.pilihpoli', function() {
        nama = $(this).attr('nama')
        kode = $(this).attr('data-id')
        $('#modalpilihpolipasca').modal('hide');
        $('#modalpilihpoli').modal('hide');
        $('#polikontrolpasca').val(nama)
        $('#polikontrol').val(nama)
        $('#kodepolikontrol').val(kode)
        $('#kodepolikontrolpasca').val(kode)
        $('#polikontrol2').val(nama)
        $('#kodepolikontrol2').val(kode)
        $('#polikontrol_update').val(nama)
        $('#kodepolikontrol_update').val(kode)      
    });
</script>
