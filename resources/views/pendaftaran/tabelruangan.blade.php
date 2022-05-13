    <div class="row col-md-12 justify-content-center">
        <table class="table table-md" id="tabelruangan">
            <thead>
                <th>Nama ruangan</th>
                <th>Bed</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($ruangan as $r )
                <tr>
                    <td>{{ $r->nama_kamar}}</td>
                    <td>{{ $r->no_bed }}</td>
                    <td class="text-center">                    
                        @if($r->status_incharge == '1') <p class="text-md text-danger">sudah diisi !</p> @else <button class="badge badge-success pilhruangan" namaruangan="{{ $r->nama_kamar }}" bed="{{ $r->no_bed }}">Pilih</button> @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<script>
    $(function() {
        $("#tabelruangan").DataTable({
            "responsive": true,
            "lengthChange": false,
            // "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order": [[ 1, "desc" ]]
        })
    });
    $('#tabelruangan').on('click', '.pilhruangan', function() {
        nama = $(this).attr('namaruangan')
        bed = $(this).attr('bed')
        $('#namaruanganranap').val(nama)
        $('#kodebedranap').val(bed)
    });
</script>