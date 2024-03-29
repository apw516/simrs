<p class="text-bold mt-5 text-lg">Rujukan Rawat Jalan</p>
<table id="tabelrujukankeluar_rajal" class="table table-bordered table-sm text-xs mt-4">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor rujukan</th>
        <th>no sep</th>
        <th>jns pelayanan</th>
        <th>PPk dirujuk</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($list->metaData->code == 200)
            @foreach ($list->response->list as $r)
            @if($r->jnsPelayanan == 2)
                <tr>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->noKartu }}</td>
                    <td>{{ $r->noRujukan }}</td>
                    <td>{{ $r->noSep }}</td>
                    <td>@if($r->jnsPelayanan == 1)Rawat Inap @else Rawat Jalan @endif</td>
                    <td>{{ $r->namaPpkDirujuk }}</td>
                    <td>
                        <button class="badge badge-primary detailrujukan" noRujukan="{{ $r->noRujukan }}"
                            data-placement="right" title="detail rujukan" data-toggle="modal" data-target="#modaldetail"><i
                                class="bi bi-eye text-md"></i></button>
                        <button class="badge badge-warning updaterujukankeluar" noRujukan="{{ $r->noRujukan }}"
                            data-placement="right" title="update rujukan" data-toggle="modal"
                            data-target="#modalupdate"><i class="bi bi-pencil-square text-md"></i></button>
                        <button class="badge badge-danger deleterujukankeluar" noRujukan="{{ $r->noRujukan }}"
                            data-placement="right" title="hapus rujukan"><i class="bi bi-trash text-md"></i></button>
                    </td>
                </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>
<p class="text-bold mt-5 text-lg">Rujukan Rawat Inap</p>
<table id="tabelrujukankeluar_ranap" class="table table-bordered table-sm text-xs mt-4">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor rujukan</th>
        <th>no sep</th>
        <th>jns pelayanan</th>
        <th>PPk dirujuk</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($list->metaData->code == 200)
            @foreach ($list->response->list as $r)
            @if($r->jnsPelayanan == 1)
                <tr>
                    <td>{{ $r->nama }}</td>
                    <td>{{ $r->noKartu }}</td>
                    <td>{{ $r->noRujukan }}</td>
                    <td>{{ $r->noSep }}</td>
                    <td>@if($r->jnsPelayanan == 1)Rawat Inap @else Rawat Jalan @endif</td>
                    <td>{{ $r->namaPpkDirujuk }}</td>
                    <td>
                        <button class="badge badge-primary detailrujukan" noRujukan="{{ $r->noRujukan }}"
                            data-placement="right" title="detail rujukan" data-toggle="modal" data-target="#modaldetail"><i
                                class="bi bi-eye text-md"></i></button>
                        <button class="badge badge-warning updaterujukankeluar" noRujukan="{{ $r->noRujukan }}"
                            data-placement="right" title="update rujukan" data-toggle="modal"
                            data-target="#modalupdate"><i class="bi bi-pencil-square text-md"></i></button>
                        <button class="badge badge-danger deleterujukankeluar" noRujukan="{{ $r->noRujukan }}"
                            data-placement="right" title="hapus rujukan"><i class="bi bi-trash text-md"></i></button>
                    </td>
                </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Detail Rujukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <div class="viewrujukankeluar">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Update Rujukan ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <div class="formupdate">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="updaterujukankeluar()">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="updatesepvclaim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Update SEP ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <div class="FORMUPDATESEP">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabelrujukankeluar_rajal").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
    });
    $(function() {
        $("#tabelrujukankeluar_ranap").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
    });
    $('#tabelrujukankeluar_ranap').on('click', '.detailrujukan', function() {
        spinner = $('#loader')
        spinner.show();
        noRujukan = $(this).attr('noRujukan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                noRujukan,
            },
            url: '<?= route('detailrujukankeluar') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewrujukankeluar').html(response)
            }
        });
    });
    $('#tabelrujukankeluar_rajal').on('click', '.detailrujukan', function() {
        spinner = $('#loader')
        spinner.show();
        noRujukan = $(this).attr('noRujukan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                noRujukan,
            },
            url: '<?= route('detailrujukankeluar') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewrujukankeluar').html(response)
            }
        });
    });
    $('#tabelrujukankeluar_ranap').on('click', '.updaterujukankeluar', function() {
        spinner = $('#loader')
        spinner.show();
        noRujukan = $(this).attr('noRujukan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                noRujukan,
            },
            url: '<?= route('updaterujukankeluar') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.formupdate').html(response)
            }
        });
    });
    $('#tabelrujukankeluar_rajal').on('click', '.updaterujukankeluar', function() {
        spinner = $('#loader')
        spinner.show();
        noRujukan = $(this).attr('noRujukan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                noRujukan,
            },
            url: '<?= route('updaterujukankeluar') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.formupdate').html(response)
            }
        });
    });
    $('#tabelrujukankeluar_ranap').on('click', '.deleterujukankeluar', function() {
        noRujukan = $(this).attr('noRujukan')
        Swal.fire({
            title: 'Hapus Rujukan Keluar',
            text: "Apakah anda ingin menghapus Rujukan " + noRujukan + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Rujukan ' + noRujukan + ' akan dihapus ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        spinner = $('#loader')
                        spinner.show();
                        $.ajax({
                            async: true,
                            dataType: 'Json',
                            type: 'post',
                            data: {
                                _token: "{{ csrf_token() }}",
                                noRujukan,
                            },
                            url: '<?= route('deleterujukan') ?>',
                            error: function(data) {
                                spinner.hide()
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops,silahkan coba lagi',
                                })
                            },
                            success: function(data) {
                                spinner.hide()
                                if (data.kode == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Rujukan Berhasil dihapus !',
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: data.message,
                                    })
                                }
                            }
                        });
                    }
                })

            }
        })
    });
    $('#tabelrujukankeluar_rajal').on('click', '.deleterujukankeluar', function() {
        noRujukan = $(this).attr('noRujukan')
        Swal.fire({
            title: 'Hapus Rujukan Keluar',
            text: "Apakah anda ingin menghapus Rujukan " + noRujukan + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Rujukan ' + noRujukan + ' akan dihapus ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        spinner = $('#loader')
                        spinner.show();
                        $.ajax({
                            async: true,
                            dataType: 'Json',
                            type: 'post',
                            data: {
                                _token: "{{ csrf_token() }}",
                                noRujukan,
                            },
                            url: '<?= route('deleterujukan') ?>',
                            error: function(data) {
                                spinner.hide()
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops,silahkan coba lagi',
                                })
                            },
                            success: function(data) {
                                spinner.hide()
                                if (data.kode == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Rujukan Berhasil dihapus !',
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: data.message,
                                    })
                                }
                            }
                        });
                    }
                })

            }
        })
    });

    function updaterujukankeluar() {
        rujukan = $('#norujukan_update').val()
        tglrujukan = $('#tglrujukan_update').val()
        tglrencanakunjungan = $('#tglrencana_update').val()
        kodeppk = $('#kodeppk_update').val()
        kodediag = $('#kodediagnosa_update').val()
        tiperujukan = $('#tiperujukan_update').val()
        jnspelyanan = $('#jenispelayanan_update').val()
        kodepoli = $('#kodepoli_update').val()
        catatan = $('#catatan_update').val()
        spinner = $('#loader');
        spinner.show();
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rujukan,
                tglrujukan,
                tglrencanakunjungan,
                kodeppk,
                kodediag,
                tiperujukan,
                jnspelyanan,
                kodepoli,
                catatan
            },
            url: '<?= route('vclaimsimpanupdate_rujukan') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Rujukan Berhasil diupdate !',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                    })
                }
            }
        });
    }
</script>
