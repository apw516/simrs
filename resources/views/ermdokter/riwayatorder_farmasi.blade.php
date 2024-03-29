<table id="tabelorder_farmasi2" class="table table-sm table-hover">
    <thead>
        <th>Nama Obat</th>
        {{-- <th>Jenis</th>
        <th>Satuan</th> --}}
        <th>Jumlah</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @foreach ($riwayat_order as $r)
            <tr @if($r->status_layanan_header == '3') class="bg-danger"  @endif>
                <td>
                    @if($r->status_layanan_header != '3')
                    <button id="{{ $r->id_header }}" kodelayananheader="{{ $r->kode_layanan_header }}"
                        class="badge badge-danger returheader" data-toggle="tooltip" data-placement="top"
                        title="retur header ..."><i class="bi bi-trash"></i></button>
                        @endif
                    {{ $r->kode_barang }}</td>
                {{-- <td>{{ $r->kategori_resep }}</td>
                <td>{{ $r->satuan_barang }}</td> --}}
                <td>{{ $r->jumlah_layanan }}</td>
                <td>{{ $r->aturan_pakai }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelorder_farmasi2").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabelorder_farmasi2').on('click', '.returheader', function() {
        idheader = $(this).attr('id')
        kodelayananheader = $(this).attr('kodelayananheader')
        Swal.fire({
            title: 'Anda yakin ?',
            text: "Semua order dengan kode header " + kodelayananheader + " akan dibatalkan / retur ...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batal layanan header'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        idheader,
                        kodelayananheader
                    },
                    url: '<?= route('batalheaderlayanan_order') ?>',
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        if (data.kode == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            orderobathariini()
                        }
                    }
                });
            }
        })

    })
</script>
