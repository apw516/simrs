<input id="pencarianicd9_banding" type="text" class="form-control" placeholder="ketik nama diagnosa ...">
<div class="table_icd9_kerja">
    <table id="tablediagnosa9_banding" class="table table-sm table-bordered table-hover">
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
        $("#tablediagnosa9_banding").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": false
        })
    });
    $('#tablediagnosa9_banding').on('click', '.pilihdiagnosakerja', function() {
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
        $('#modalicd9banding').modal('hide');
    })
    $("#pencarianicd9_banding").keypress(function() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                key: $('#pencarianicd9_banding').val()
            },
            url: '<?= route('cariicd9_banding') ?>',
            success: function(response) {
                $('.table_icd9_kerja').html(response);
            }
        });
    });
</script>
