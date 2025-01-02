<table id="tabelriwayatkonsul" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tgl Masuk</th>
        <th>Nama Unit</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($data_kunjungan as $dk )
            <tr>
                <td>{{ $dk->tgl_masuk}}</td>
                <td>{{ $dk->nama_unit}}</td>
                <td>@if($dk->status_kunjungan == 1)Aktif @elseif($dk->status_kunjungan == 8) Batal @endif</td>
                <td>{{ $dk->keterangan3}}</td>
                <td>
                    <button class="btn btn-danger btn-sm batalkonsul" nama ="{{ $dk->nama_unit}}" kodekunjungan ="{{ $dk->kode_kunjungan }}"><i class="bi bi-trash3"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatkonsul").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(".batalkonsul").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        nama = $(this).attr('nama')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Konsul Poli "+ nama + " akan dibatalkan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Batal !"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan,
                    },
                    url: '<?= route('batalkonsulpoli') ?>',
                    error: function(data) {
                        spinnerof()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        if (data.kode == 500) {
                            spinnerof()
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            spinnerof()
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            riwayatkonsultoday()
                        }
                    }
                });
            }
        });
    });
