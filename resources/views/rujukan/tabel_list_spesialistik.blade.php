<div class="hasilpencarianrujukan">
    
</div>
<table id="listpolippkrujukan" class="table table-sm table-bordered table-hover text-md">
    <thead>
        <th>Kode Spesialis</th>
        <th>Nama Spesialis</th>
        <th>Kapasitas</th>
        <th>jumlah rujukan</th>
        <th>presentase</th>
    </thead>
    <tbody>
        {{-- @dd($f1); --}}
        @if ($f1->metaData->code == 200)
            @foreach ($f1->response->list as $p)
                <tr class="pilihpoli" data-dismiss="modal" kodepoli="{{ $p->kodeSpesialis }}" namapoli="{{ $p->namaSpesialis }}">
                 <td>{{ $p->kodeSpesialis }}</td>                   
                 <td>{{ $p->namaSpesialis }}</td>                   
                 <td>{{ $p->kapasitas }}</td>                   
                 <td>{{ $p->jumlahRujukan }}</td>                   
                 <td>{{ $p->persentase }}</td>                   
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#listpolippkrujukan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $('#listpolippkrujukan').on('click', '.pilihpoli', function() {
        spinner = $('#loader');
        spinner.show();
        kodepoli = $(this).attr('kodepoli')
        namapoli = $(this).attr('namapoli')        
        $('#kodepolirujukan').val(kodepoli)
        $('#namapolirujukan').val(namapoli)    
        spinner.hide();
    
    });
</script>

