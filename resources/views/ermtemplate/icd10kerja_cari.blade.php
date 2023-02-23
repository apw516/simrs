<table id="tablediagnosa101" class="table table-sm table-bordered table-hover">
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
<script>
      $(function() {
        $("#tablediagnosa101").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": false
        })
    });
    $('#tablediagnosa101').on('click', '.pilihdiagnosakerja', function() {
        diag = $(this).attr('diag')
        nama = $(this).attr('nama')
        diagnosalama = $('#diagnosakerja').val()
        diagnosabaru = diag + ' | ' + nama
        if(diagnosalama == ''){
            $('#diagnosakerja').val(diagnosabaru)
        }else{
            $('#diagnosakerja').val(diagnosalama + ' , '+ diagnosabaru)
        }
        Swal.fire({
            icon: 'success',
            title: 'OK',
            text: 'Diagnosa berhasil dipilih',
            footer: 'ermwaled2023'
        })
        $('#modalicdkerja').modal('hide');
    })
</script>
