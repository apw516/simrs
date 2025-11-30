<table id="tabelriwayattindakanpoli" class="table table-sm table-bordered">
    <thead>
        <th>Nama Tarif</th>
        <th>Jumlah</th>
        <th>Tarif</th>
        <th>action</th>
    </thead>
    <tbody>
        @foreach ($datatarif as $d)
            @if ($d->kode_unit != '4008')
                <tr>
                    <td>{{ $d->NAMA_TARIF }}</td>
                    <td>{{ $d->jumlah_layanan }}</td>
                    <td>Rp. {{ number_format($d->grantotal_layanan, 2, ',', '.') }}</td>
                    <td><button nama="{{ $d->NAMA_TARIF }}" iddetail="{{ $d->id_detail }}"
                            class="btn btn-danger pilihtarif"><i class="bi bi-trash"></i></button></td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayattindakanpoli").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })
    })
    $(".pilihtarif").on('click', function(event) {
        iddetail = $(this).attr('iddetail')
        nama = $(this).attr('nama')
        Swal.fire({
            title: "Apa anda yakin ?",
            text: "Tarif " + nama + " akan diretur ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Retur tarif ( " + nama + " )"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        iddetail
                    },
                    url: '<?= route('returtindakan') ?>',
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
                            $('#modalriwayattindakan').modal('toggle');
                        }
                    }
                });
            }
        });
    });
</script>
