<table id="tablediagnosa9_1" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Kode</th>
        <th>Nama</th>
    </thead>
    <tbody>
        @foreach ($icd9 as $i)
            <tr diag = {{ $i->diag }} nama = {{ $i->nama_pendek }} class="pilihdiagnosakerja">
                <td>{{ $i->diag }}</td>
                <td>{{ $i->nama_pendek }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
      $(function() {
        $("#tablediagnosa9_1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": false
        })
    });
    $('#tablediagnosa9_1').on('click', '.pilihdiagnosakerja', function() {
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
        $('#modalicd9kerja').modal('hide');
    })
</script>
