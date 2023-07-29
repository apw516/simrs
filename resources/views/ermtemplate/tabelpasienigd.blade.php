<table id="tablepasienpoli" class="table table-sm table-hover text-xs">
    <thead>
        <th>Nomor Antrian</th>
        <th>Nomor RM</th>
        <th>Nama</th>
        <th>Tgl Masuk</th>
    </thead>
    <tbody>
        @foreach ($pasienigd as $p)
            <tr class="pilihpasien" idantrian="{{ $p->id }}">
                <td>{{ $p->nomor_antrian }}</td>
                <td>{{ $p->nomor_rm }}</td>
                <td>{{ $p->nama_px }}</td>
                <td>{{ $p->tgl_masuk }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tablepasienpoli").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $('#tablepasienpoli').on('click', '.pilihpasien', function() {
        id = $(this).attr('idantrian')
        $(".formpasien").removeAttr('hidden', true);
        $(".vpasien").attr('hidden', true);
        $(".boxcari").attr('hidden', true);
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambil_form_igd') ?>',
            success: function(response) {
                $('.formpasien').html(response);
            }
        });
    });
</script>
