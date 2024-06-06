<table class="table table-sm table-bordered table-hover" id="tabel_data_riwayat_tindakan_today">
    <thead>
        <th>Nama Tindakan</th>
        <th>Jumlah</th>
        <th>Tarif</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($riwayat_tindakan as $t )
            <tr>
                <td>{{ $t->NAMA_TARIF}}</td>
                <td>{{ $t->jumlah_layanan}}</td>
                <td>{{ $t->total_tarif}}</td>
                <td><button type="button" class="btn btn-danger btn-sm returtindakan" nama="{{ $t->NAMA_TARIF }}" id="{{ $t->id_detail }}"> <i class="bi bi-trash mr-1"></i> Batal</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabel_data_riwayat_tindakan_today").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": true
        })
    });
    $(".returtindakan").on('click', function(event) {
        nama = $(this).attr('nama')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Tindakan " + nama +" akan dibatalkan ...",
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
                    url: '<?= route('batal_tindakan_poli') ?>',
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
                            riwayat_tindakan()
                        }
                    }
                });
            }
        });
    });
