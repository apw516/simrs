<table class="table table-sm table-bordered table-hover" id="tabel_riwayat_order_lab">
    <thead>
        <th>Nama Layanan</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($riwayat_order as $t)
            <tr>
                <td>{{ $t->NAMA_TARIF }}</td>
                <td>{{ $t->jumlah_layanan }}</td>
                <td>
                    @if ($t->status_order == 99)
                        Belum dikirim
                    @elseif($t->status_order == 0)
                        Terkirim Ke laboratorium
                    @elseif($t->status_order == 1)
                        Dalam antrian laboratorium
                    @endif
                </td>
                <td><button type="button" class="btn btn-danger btn-sm bataldetaillab" id={{ $t->id_detail }} nama="{{ $t->NAMA_TARIF}}"> <i
                            class="bi bi-trash mr-1"></i> Batal</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabel_riwayat_order_lab").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": true
        })
    });
    $(".bataldetaillab").on('click', function(event) {
        nama = $(this).attr('nama')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Order layanan laboratorium " + nama +" akan dibatalkan ...",
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
                    url: '<?= route('batal_detail_order_lab') ?>',
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
                            riwayat_order_lab()
                        }
                    }
                });
            }
        });
    });
