<input id="pencarian" type="text" class="form-control" placeholder="ketik nama diagnosa ...">
<div class="table_icd10_kerja">
    <table id="tablediagnosa10" class="table table-sm table-bordered table-hover">
        <thead>
            <th>Kode</th>
            <th>Nama</th>
        </thead>
        <tbody>
            @foreach ($icd10 as $i)
                <tr diag = {{ $i->diag }} nama = {{ $i->nama }} class="pilihdiagnosakerja">
                    <td>{{ $i->diag }}</td>
                    <td>{{ $i->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(function() {
        $("#tablediagnosa10").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": false
        })
    });
    $('#tablediagnosa10').on('click', '.pilihdiagnosakerja', function() {
        diag = $(this).attr('diag')
        nama = $(this).attr('nama')
        diagnosalama = $('#diagnosakerja').val()
        diagnosabaru = diag + ' | ' + nama
        $('#diagnosakerja').val(diagnosalama + ' , '+ diagnosabaru)
    })
    $("#pencarian").keypress(function() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                key: $('#pencarian').val()
            },
            url: '<?= route('cariicd10') ?>',
            success: function(response) {
                $('.table_icd10_kerja').html(response);
            }
        });
    });
</script>
