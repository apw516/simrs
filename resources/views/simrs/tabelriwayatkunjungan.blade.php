<h5>Rawat Jalan </h5>
<table id="kunjunganrawatjalan" class="table table-bordered table-sm text-xs">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor sep</th>
        <th>nomor rujukan</th>
        <th>jns pelayanan</th>
        <th>poli</th>
        <th>tgl sep</th>
        <th>tgl pulang sep</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($rajal->metaData->code == 200)
            @foreach ($rajal->response->sep as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->noKartu }}</td>
                    <td>{{ $s->noSep }}</td>
                    <td>{{ $s->noRujukan }}</td>
                    <td>{{ $s->jnsPelayanan }}</td>
                    <td>{{ $s->poli }}</td>
                    <td>{{ $s->tglSep }}</td>
                    <td>{{ $s->tglPlgSep }}</td>
                    <td>
                        <button class="badge badge-primary  detailsep" nomorsep="{{ $s->noSep }}"
                            data-placement="right" title="detail sep"><i class="bi bi-eye text-sm" data-toggle="modal"
                                data-target="#exampleModal"></i></button>
                        <button class="badge badge-danger hapussep" nomorsep="{{ $s->noSep }}" data-placement="right"
                            title="hapus sep"><i class="bi bi-trash text-sm"></i></button>
                        <button class="badge badge-warning editsep" nomorsep="{{ $s->noSep }}"
                            data-placement="right" title="edit sep" data-toggle="modal" data-target="#modaleditsep"><i
                                class="bi bi-pencil-square text-sm"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<h5>Rawat Inap </h5>
<table id="kunjunganrawatinap" class="table table-bordered table-sm text-xs">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor sep</th>
        <th>nomor rujukan</th>
        <th>jns pelayanan</th>
        <th>poli</th>
        <th>tgl sep</th>
        <th>tgl pulang sep</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($ranap->metaData->code == 200)
            @foreach ($ranap->response->sep as $s)
                <tr>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->noKartu }}</td>
                    <td>{{ $s->noSep }}</td>
                    <td>{{ $s->noRujukan }}</td>
                    <td>{{ $s->jnsPelayanan }}</td>
                    <td>{{ $s->poli }}</td>
                    <td>{{ $s->tglSep }}</td>
                    <td>{{ $s->tglPlgSep }}</td>
                    <td>
                        <button class="badge badge-primary  detailsep" nomorsep="{{ $s->noSep }}"
                            data-placement="right" title="detail sep"><i class="bi bi-eye text-sm" data-toggle="modal"
                                data-target="#exampleModal"></i></button>
                        <button class="badge badge-danger hapussep" nomorsep="{{ $s->noSep }}"
                            data-placement="right" title="hapus sep"><i class="bi bi-trash text-sm"></i></button>
                        <button class="badge badge-warning editsep" nomorsep="{{ $s->noSep }}"
                            data-placement="right" title="edit sep" data-toggle="modal" data-target="#modaleditsep"><i
                                class="bi bi-pencil-square text-sm"></i></button>
                                <button class="badge badge-success pulangkan" nomorsep="{{ $s->noSep }}"
                                    data-placement="right" title="edit tgl pulangsep" data-toggle="modal"
                                    data-target="#modalupdatetglpulang"><i
                                        class="bi bi-pencil-square text-sm"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#kunjunganrawatjalan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });
    $(function() {
        $("#kunjunganrawatinap").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });

    $('#kunjunganrawatjalan').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '<?= route('vclaimdetailsep');?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewdetailsep').html(response)
            }
        });
    });
    $('#kunjunganrawatinap').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '<?= route('vclaimdetailsep');?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewdetailsep').html(response)
            }
        });
    });

    $('#kunjunganrawatjalan').on('click', '.hapussep', function() {
        nomorsep = $(this).attr('nomorsep')
        Swal.fire({
            title: 'Hapus SEP ...',
            text: "Apakah anda ingin menghapus SEP ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus SEP',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nomorsep,
                    },
                    dataType: 'Json',
                    Async: true,
                    url: '<?= route('vclaimhapussep');?>',
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
                                title: 'SEP berhasil dihapus',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.metaData.message,
                            })
                        }
                    }
                });
            }
        });
    });
    $('#kunjunganrawatinap').on('click', '.hapussep', function() {
        nomorsep = $(this).attr('nomorsep')
        Swal.fire({
            title: 'Hapus SEP ...',
            text: "Apakah anda ingin menghapus SEP ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus SEP',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nomorsep,
                    },
                    dataType: 'Json',
                    Async: true,
                    url: '<?= route('vclaimhapussep');?>',
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
                                title: 'SEP berhasil dihapus',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.metaData.message,
                            })
                        }
                    }
                });
            }
        });
    });

    //update sep
    $('#kunjunganrawatjalan').on('click', '.editsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '<?= route('vclaimupdate');?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewupdatesep').html(response)
            }
        });
    });
    $('#kunjunganrawatinap').on('click', '.editsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '<?= route('vclaimupdate');?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewupdatesep').html(response)
            }
        });
    });
    $('#kunjunganrawatinap').on('click', '.pulangkan', function() {
        nomorsep = $(this).attr('nomorsep')
       $('#pulang_nomorsep').val(nomorsep)
    })
</script>
