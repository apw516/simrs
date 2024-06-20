<table class="table table-sm table-bordered">
    <thead>
        <th>Nama Poli</th>
        <th>Diagnosa</th>
        <th>Keterangan</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($list as $l )
            <tr>
                <td>{{ $l->nama_unit}}</td>
                <td>{{ $l->diagx}}</td>
                <td>{{ $l->keterangan3}}</td>
                <td><button class="btn btn-sm btn-danger batalkonsul" kodekunjungan="{{ $l->kode_kunjungan}}">Batal Konsul</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(".batalkonsul").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin ?",
            text: "konsul akan dibatalkan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, batal"
        }).then((result) => {
            if (result.isConfirmed) {
                id = $(this).attr('kodekunjungan')
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
                    url: '<?= route('batal_konsul') ?>',
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
                            ambilriwayatkonsul()
                        } else {
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
