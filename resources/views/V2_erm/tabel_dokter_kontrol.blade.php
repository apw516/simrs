<table id="tabeldokter" class="table table-sm table-bordered table-hover text-md">
    <thead>
        <th>Nama dokter</th>
        <th>Jadwal Praktek</th>
        <th>Kapasitas</th>
    </thead>
    <tbody>
        {{-- @dd($f1); --}}
        @if ($dokter->metaData->code == 200)
            @foreach ($dokter->response->list as $p)
                <tr class="pilihdokter" kodeDokter="{{ $p->kodeDokter }}" namadokter="{{ $p->namaDokter }}">
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
        $("#tabeldokter").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });
    $(".pilihdokter").on('click', function(event) {
        kode = $(this).attr('kodeDokter')
        nama = $(this).attr('namadokter')
        $('#namadokter').val(nama)
        $('#kodedokter').val(kode)
        $('#modalcaridokter').modal('toggle')
    })
</script>
