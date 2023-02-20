<input id="pencarian" type="text" class="form-control" placeholder="ketik nama diagnosa ...">
<div class="table_icd9_kerja">
    <table id="tablediagnosa9" class="table table-sm table-bordered table-hover">
        <thead>
            <th>Kode</th>
            <th>Nama</th>
        </thead>
        <tbody>
            @foreach ($icd9 as $i)
                <tr diag={{ $i->diag }} nama={{ $i->nama_pendek }} class="pilihdiagnosakerja">
                    <td>{{ $i->diag }}</td>
                    <td>{{ $i->nama_pendek }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(function() {
        $("#tablediagnosa9").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": false
        })
    });
    $('#tablediagnosa9').on('click', '.pilihdiagnosakerja', function() {
        diag = $(this).attr('diag')
        nama = $(this).attr('nama')
        diagnosalama = $('#diagnosakerja').val()
        diagnosabaru = diag + ' | ' + nama
        $('#diagnosakerja').val(diagnosalama + ' , ' + diagnosabaru)
    })
    $("#pencarian").keypress(function() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                key: $('#pencarian').val()
            },
            url: '<?= route('cariicd9') ?>',
            success: function(response) {
                $('.table_icd9_kerja').html(response);
            }
        });
    });
</script>
