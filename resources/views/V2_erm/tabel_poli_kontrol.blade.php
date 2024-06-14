<table id="listpolippkrujukan" class="table table-sm table-bordered table-hover text-md">
    <thead>
        <th>Kode Poli</th>
        <th>Nama Poli</th>
        <th>Kapasitas</th>
        <th>jumlah rujukan dan rencana kontrol</th>
        <th>presentase</th>
    </thead>
    <tbody>
        {{-- @dd($f1); --}}
        @if ($poli->metaData->code == 200)
            @foreach ($poli->response->list as $p)
                <tr class="pilihpoli" kodepoli="{{ $p->kodePoli }}" namapoli="{{ $p->namaPoli }}">
                    <td>{{ $p->kodePoli }}</td>
                    <td>{{ $p->namaPoli }}</td>
                    <td>{{ $p->kapasitas }}</td>
                    <td>{{ $p->jmlRencanaKontroldanRujukan }}</td>
                    <td>{{ $p->persentase }} %</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#listpolippkrujukan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });
    $(".pilihpoli").on('click', function(event) {
        kode = $(this).attr('kodepoli')
        nama = $(this).attr('namapoli')
        $('#kodepoli').val(kode)
        $('#namapoli').val(nama)
        $('#modalcaripoli').modal('toggle')
    })

</script>
