<table id="tablepasienpoli" class="table table-sm table-hover text-xs">
    <thead>
        <th>Tanggal Masuk</th>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Unit</th>
        <th>Penjamin</th>
        <th>Assemen Keperawatan</th>
        <th>Assemen Medis</th>
    </thead>
    <tbody>
        @foreach ($pasienpoli as $p)
            <tr class="pilihpasien" rm="{{ $p->no_rm }}" kodekunjungan="{{ $p->kode_kunjungan }}"
                pic="">
                <td>{{ $p->tgl_masuk }}</td>
                <td>{{ $p->no_rm }}</td>
                <td>{{ $p->nama_pasien }} @if($p->ref_kunjungan != 0 || $p->ref_kunjungan != NULL )| <button class="badge badge-warning">PASIEN KONSUL </button>@endif</td>
                <td>{{ $p->nama_unit }}</td>
                <td>{{ $p->nama_penjamin }}</td>
                <td>
                    @if ($p->cek2 != 0)
                            <button class="badge badge-success"> sudah diisi </button>
                    @else
                        <button class="badge badge-danger"> belum diisi </button>
                    @endif
                </td>
                <td>
                    @if ($p->cek != 0)
                            <button class="badge badge-success"> sudah diisi </button>
                    @else
                        <button class="badge badge-danger"> belum diisi </button>
                    @endif
                </td>
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
        rm = $(this).attr('rm')
        kode = $(this).attr('kodekunjungan')
        pic = $(this).attr('pic')
        $(".formpasien").removeAttr('hidden', true);
        $(".vpasien").attr('hidden', true);
        $(".boxcari").attr('hidden', true);
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kode,
                pic
            },
            url: '<?= route('ambildetailpasien_dokter') ?>',
            success: function(response) {
                $('.formpasien').html(response);
            }
        });
    });
</script>
