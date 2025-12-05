<table id="tabelruangan" class="table table-sm table-bordered">
    <thead>
        <th>kodekelas</th>
        <th>koderuang</th>
        <th>namaruang</th>
        <th>kapasitas</th>
        <th>tersedia</th>
        <th>tersediapria</th>
        <th>tersediawanita</th>
        <th>tersediapriawanita</th>
        <th>status_send</th>
        <th>Last update</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->kodekelas }}</td>
                <td>{{ $d->koderuang }}</td>
                <td>{{ $d->namaruang }}</td>
                <td>{{ $d->kapasitas }}</td>
                <td>{{ $d->tersedia }}</td>
                <td>{{ $d->tersediapria }}</td>
                <td>{{ $d->tersediawanita }}</td>
                <td>{{ $d->tersediapriawanita }}</td>
                <td>
                    @if ($d->status_send == 0)
                        Belum dikirim
                    @else
                        sudah dikirim
                    @endif
                </td>
                <td>{{ $d->last_update }}</td>
                <td>
                    <button class="btn btn-success kirimruangan" idruangan="{{ $d->id }}">Kirim</button>
                    <button class="btn btn-warning update" idruangan="{{ $d->id }}">Update</button>
                    <button class="btn btn-danger hapusruangan" idruangan="{{ $d->id }}">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelruangan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "ordering": false
        })
    });
    $(".kirimruangan").on('click', function(event) {
        idruangan = $(this).attr('idruangan')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                idruangan
            },
            url: '<?= route('kirimruangan') ?>',
            error: function(data) {
                spinner.hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide();
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.pesan,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.pesan,
                        footer: ''
                    })
                    ambildataruangan()
                }
            }
        });
    });
    $(".update").on('click', function(event) {
        idruangan = $(this).attr('idruangan')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                idruangan
            },
            url: '<?= route('updateruangan') ?>',
            error: function(data) {
                spinner.hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide();
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.pesan,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.pesan,
                        footer: ''
                    })
                }
            }
        });
    });
</script>
