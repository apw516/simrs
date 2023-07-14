<table id="tabler_konsul" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Keterangan Konsul</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
            <tr>
                <td class="pilihriwayat" ket="{{ $d->keterangan_tindak_lanjut }}" data-dismiss="modal">{{ $d->keterangan_tindak_lanjut }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabler_konsul").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $('#tabler_konsul').on('click', '.pilihriwayat', function() {
        ket = $(this).attr('ket')
        $('#saran').val(ket)

    });
</script>
