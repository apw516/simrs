<input id="pencarian" type="text" class="form-control" placeholder="ketik nama diagnosa ...">
<div class="table_icd10_kerja">
    <table id="tablediagnosa10_banding" class="table table-sm table-bordered table-hover">
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
        $("#tablediagnosa10_banding").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": false
        })
    });
    $('#tablediagnosa10_banding').on('click', '.pilihdiagnosakerja', function() {
        diag = $(this).attr('diag')
        nama = $(this).attr('nama')
        diagnosalama = $('#diagnosabanding').val()
        diagnosabaru = diag + ' | ' + nama
        if(diagnosalama == ''){
            $('#diagnosabanding').val(diagnosabaru)
        }else{
            $('#diagnosabanding').val(diagnosalama + ' , '+ diagnosabaru)
        }
        Swal.fire({
            icon: 'success',
            title: 'OK',
            text: 'Diagnosa berhasil dipilih',
            footer: 'ermwaled2023'
        })
        $('#modalicdbanding').modal('hide');
    })
    $("#pencarian").keypress(function() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                key: $('#pencarian').val()
            },
            url: '<?= route('cariicd10_banding') ?>',
            success: function(response) {
                $('.table_icd10_kerja').html(response);
            }
        });
    });
</script>
