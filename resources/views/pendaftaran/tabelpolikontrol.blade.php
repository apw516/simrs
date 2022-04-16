<table id="tabelpolikontrol" class="table table-sm table-bordered">
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
            "pageLength": 3,
            "searching": false
        })
    });
    $('#tabelpolikontrol').on('click', '.pilihpoli', function() {
        nama = $(this).attr('nama')
        kode = $(this).attr('data-id')
        $('#polikontrol').val(nama)
        $('#kodepolikontrol').val(kode)

    });
</script>
