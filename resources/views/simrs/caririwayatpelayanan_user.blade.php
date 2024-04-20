<table id="tabelriwayatpelayanan_local" class="table table-sm text-xs table-bordered">
    <thead>
        <th>nomor rm</th>
        {{-- <th>kode kunjungan</th> --}}
        <th>tgl masuk</th>
        <th>tgl keluar</th>
        <th>nama</th>
        <th>penjamin</th>
        <th>unit</th>
        <th>dokter</th>
        <th>user</th>
        <th>no sep</th>
        <th>--</th>
    </thead>
    <tbody>
        @foreach ($datakunjungan as $d)
            @if (auth()->user()->id_simrs == $d->pic)
                <tr>
                    <td>{{ $d->no_rm }}</td>
                    {{-- <td>{{ $d->kode_kunjungan }}</td> --}}
                    <td>{{ $d->tgl_masuk }}</td>
                    <td>{{ $d->tgl_keluar }}</td>
                    <td>{{ $d->nama_px }}</td>
                    <td>{{ $d->nama_penjamin }}</td>
                    <td>{{ $d->nama_unit }}</td>
                    <td>{{ $d->dokter }}</td>
                    {{-- <td>{{ $d->status }}</td> --}}
                    <td>{{ $d->nama_user }}</td>
                    <td>{{ $d->no_sep }}</td>
                    <td>
                        <button class="badge badge-primary detailkunjungan" kodekunjungan="{{ $d->kode_kunjungan }}"
                            data-placement="right" title="detail"><i class="bi bi-eye text-sm" data-toggle="modal"
                                data-target="#detailkunjungan"></i></button>
                        <button class="badge badge-danger batal" kodekunjungan="{{ $d->kode_kunjungan }}"
                            data-placement="right" title="batal periksa"><i class="bi bi-trash text-sm"></i></button>
                        {{-- <button class="badge badge-success pulangkan" nama="{{ $d->nama_px }}"
                        kodekunjungan2="{{ $d->kode_kunjungan }}" data-placement="right"
                        title="pulangkan pasien" data-toggle="modal" data-target="#modalpulangkanpasien"><i
                            class="bi bi-pencil-square text-sm"></i></button>
                </td> --}}
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatpelayanan_local").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 20,
            "searching": true,
            "dom": 'Bfrtip',
            "order": [
                [1, "desc"]
            ],
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
    });
    $('#tabelriwayatpelayanan_local').on('click', '.detailkunjungan', function() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
            },
            url: '<?= route('detailkunjungan') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewdetailkunjungan').html(response)
            }
        });
    });
    $('#tabelriwayatpelayanan_local').on('click', '.batal', function() {
        kodekunjungan = $(this).attr('kodekunjungan')
        Swal.fire({
            title: 'batal periksa ...',
            text: "data pendaftaran akan dibatalkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batal periksa',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan,
                    },
                    dataType: 'Json',
                    Async: true,
                    url: '<?= route('batalperiksa') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops,silahkan coba lagi',
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.metaData.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil dibatalkan ...',
                            })
                            location.reload()
                        }
                    }
                });
            }
        });
    });
</script>
