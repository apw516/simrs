<table id="tabeltemplate" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama Resep</th>
        <th>Detail Resep</th>
    </thead>
    <tbody>
        @foreach ($resep as $r)
            <tr class="pilihresep" kode="{{ $r->id }}">
                <td>{{ $r->nama_resep }}</td>
                <td>{{ $r->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeltemplate").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltemplate').on('click', '.pilihresep', function() {
        id = $(this).attr('kode')
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Template berhasil dipilih !',
            showConfirmButton: false,
            timer: 1200
        })
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambilresep_detail') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.fi').html(response)
                spinner.hide()
            }
        });
        $('#modaltemplate').modal('hide')
    });
</script>
