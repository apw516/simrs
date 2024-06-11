<table id="tabelriwayatorderfarm" class="table table-sm text-xs table-hover">
    <thead>
        <th>Nama Obat</th>
        <th>Satuan</th>
        <th>Jumlah</th>
        <th>Kategori</th>
        <th>Keterangan</th>
        <th>Status</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($riwayat_order as $r)
            <tr>
                <td>{{ $r->kode_tarif_detail }}</td>
                <td>{{ $r->satuan_barang }}</td>
                <td>{{ $r->jumlah_layanan }}</td>
                <td>{{ $r->kategori_resep }}</td>
                <td>{{ $r->keterangan }} | {{ $r->status_layanan_detail }}</td>
                <td>
                    @if ($r->status_order == 99)
                        Belum dikirim
                    @elseif($r->status_order == 0)
                        Terkirim Ke farmasi
                    @elseif($r->status_order == 98)
                        Dalam antrian farmasi
                    @elseif($r->status_order == 2)
                        Sudah dilayani farmasi
                    @endif
                </td>
                <td><button type="button" class="btn btn-danger btn-sm batalorder" id="{{ $r->id_detail }}"><i
                            class="bi bi-trash mr-1"></i>Batal</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatorderfarm").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });

    $(".batalorder").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Order obat akan dibatalkan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, batal"
        }).then((result) => {
            if (result.isConfirmed) {
                id = $(this).attr('id')
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    async: true,
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    },
                    url: '<?= route('batal_detail_order_farmasi') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.kode == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            riwayat_order_farmasi()
                        }else{
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: data.message,
                                footer: ''
                            })
                        }
                    }
                });
            }
        });
    });
</script>
