<table id="tablepasienpoli" class="table table-sm table-hover text-xs">
    <thead>
        <th>Nomor Antrian</th>
        <th>Nomor RM</th>
        <th>Nama</th>
        <th>Tgl Masuk</th>
        <th>Nama Perawat</th>
        <th>Nama Dokter</th>
    </thead>
    <tbody>
        @foreach ($pasienigd as $p)
            <tr class="pilihpasien" idantrian="{{ $p->id }}">
                <td>{{ $p->nomor_antrian }}</td>
                <td>{{ $p->nomor_rm }}</td>
                <td>{{ $p->nama_px }}</td>
                <td>{{ $p->tgl_masuk }}</td>
                <td>@if($p->namapemeriksa == '')<button class="badge badge-warning">Belum diisi</button> @else {{ $p->namapemeriksa }} <i class="bi bi-check-circle text-success mr-1 ml-1"></i>@endif</td>
                <td>@if($p->namadokter == '') <button class="badge badge-warning">Belum diisi</button> @else {{ $p->namadokter }} @endif</td>
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
            url: '<?= route('ambil_form_igd_dokter') ?>',
            success: function(response) {
                $('.formpasien').html(response);
            }
        });
    });
</script>
