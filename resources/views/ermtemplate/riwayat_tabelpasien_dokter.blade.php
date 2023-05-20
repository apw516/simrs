<table id="tablepasienpoli" class="table table-sm table-hover text-xs">
    <thead>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Unit</th>
        <th>Penjamin</th>
        <th>Assemen Keperawatan</th>
        <th>Assemen Awal Medis</th>
    </thead>
    <tbody>
        @foreach ($pasienpoli as $p)
            <tr class="pilihpasien" rm="{{ $p->no_rm }}" kodekunjungan="{{ $p->kode_kunjungan }}"
                pic="{{ $p->id_dokter }}">
                <td>{{ $p->no_rm }}</td>
                <td>{{ $p->nama_pasien }}</td>
                <td>{{ $p->nama_unit }}</td>
                <td>{{ $p->nama_penjamin }}</td>
                <td>
                    @if ($p->id_pemeriksaan_perawat != null)
                        @if ($p->status_asskep == 0)
                            <button class="badge badge-warning"> Belum validasi </button>
                        @else
                            <button class="badge badge-success"> sudah diisi </button>
                        @endif
                    @else
                        <button class="badge badge-danger"> belum diisi </button>
                    @endif
                </td>
                <td>
                    @if ($p->id_pemeriksaan_dokter != null)
                        @if ($p->status_assdok == 0)
                            <button class="badge badge-warning"> Belum validasi </button>
                             | {{ $p->nama_dokter }}
                        @else
                            <button class="badge badge-success"> sudah diisi </button>
                             | {{ $p->nama_dokter }}
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
        pic = $(this).attr('pic')
        $(".formpasien").removeAttr('hidden', true);
        $(".vpasien").attr('hidden', true);
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
