<table id="tablepasienpoli" class="table table-sm table-hover text-xs">
    <thead>
        <th>Tgl Masuk</th>
        <th>Antrian</th>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Unit</th>
        <th>Penjamin</th>
        <th>Assemen Keperawatan</th>
        <th>Assemen Awal Medis</th>
    </thead>
    <tbody>
        @foreach ($pasienpoli as $p)
            <tr class="pilihpasien" rm="{{ $p->no_rm }}" kodekunjungan="{{ $p->kode_kunjungan }}">
                <td>{{ $p->tgl_masuk }}</td>
                <td>{{ $p->antrian }}</td>
                <td>{{ $p->no_rm }}</td>
                <td>{{ $p->nama_pasien }}</td>
                <td>{{ $p->nama_unit }}</td>
                <td>{{ $p->nama_penjamin }}</td>
                <td>
                    @if ($p->id_pemeriksaan_perawat != null)
                        @if ($p->status_asskep == 0)
                            <button class="badge badge-warning"> Belum validasi </button>
                        @else
                            <button class="badge badge-success"> sudah diisi </button> | {{ $p->namapemeriksa }}
                        @endif
                    @else
                        <button class="badge badge-danger"> belum diisi </button>
                    @endif
                </td>
                <td>
                    @if ($p->id_pemeriksaan_dokter != null)
                        @if ($p->status_assdok == 0)
                            <button class="badge badge-warning"> Belum validasi </button>
                        @else
                            <button class="badge badge-success"> sudah diisi </button> | {{ $p->nama_dokter }}
                        @endif
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
        $(".formpasien").removeAttr('hidden', true);
        $(".vpasien").attr('hidden', true);
        $(".btnasskep").attr('hidden', true);
        $(".boxcari").attr('hidden', true);
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kode
            },
            url: '<?= route('ambildetailpasien') ?>',
            success: function(response) {
                $('.formpasien').html(response);
                spinner.hide();
            }
        });
    });
</script>
