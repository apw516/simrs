<table class="table table-sm">
    <thead>
        <th>Diagnosa</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data_digan as $d)
            <tr>
                <td>{{ $d->kode_icd10 }}</td>
                <td>
                    <button type="button" class=" badge badge-danger hapuscoding" idcoder="{{ $d->id }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('.hapuscoding').on('click', function() {
        // Tulis kode yang ingin dijalankan di sini
        id = $(this).attr('idcoder')
        Swal.fire({
            title: "Data diagnosa akan dihapus ?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Hapus",
            denyButtonText: `Batal`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                hapusdiagnosa(id)
            }
        });
    });

    function hapusdiagnosa(id) {
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('hapuscoderdiagnosau') ?>',
            error: function(response) {
                spinner_off()
                Swal.fire({
                    icon: 'error',
                    title: 'Ups!',
                    text: response.message,
                });
            },
            success: function(response) {
                spinner_off()
                if (response.kode == '200') {
                    ambildiagnosautama()
                    ambildiagnosasekunder()
                    ambil_tindakan_prosedur()
                    ambil_tindakan_op()
                    ambil_tindakan_penunjang()
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data  berhasil dihapus ",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                        footer: "<a href=\"#\">Why do I have this issue?</a>"
                    });
                }
            }
        });
    }
</script>
