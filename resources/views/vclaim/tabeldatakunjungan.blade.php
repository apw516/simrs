<h2 class="text-bold mt-3 text-info">Data Kunjungan {{ $jenis }}</h2>
<table id="kunjunganpasienrawatjalan" class="table table-bordered table-sm text-xs">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor sep</th>
        <th>nomor rujukan</th>
        <th>poli</th>
        <th>tgl sep</th>
        <th>tgl pulang sep</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($datakunjungan->metaData->code == 200)
            @foreach ($datakunjungan->response->sep as $r)
                    <tr>
                        <td>{{ $r->nama }}</td>
                        <td>{{ $r->noKartu }}</td>
                        <td>{{ $r->noSep }}</td>
                        <td>{{ $r->noRujukan }}</td>
                        <td>{{ $r->poli }}</td>
                        <td>{{ $r->tglSep }}</td>
                        <td>{{ $r->tglPlgSep }}</td>
                        <td>
                            <button class="badge badge-primary detailsep" nomorsep="{{ $r->noSep }}"
                                data-placement="right" title="detail sep" data-toggle="modal" data-target="#modaldetail"><i
                                    class="bi bi-eye text-md"></i></button>
                            <button class="badge badge-warning sepinternal" nomorsep="{{ $r->noSep }}"
                                data-placement="right" title="sep internal" data-toggle="modal"
                                data-target="#modalsepinternal"><i class="bi bi-clipboard2-data text-md"></i></button>
                            {{-- <button class="badge badge-warning updatesep" nomorsep="{{ $r->noSep }}"
                                data-placement="right" title="update sep" data-toggle="modal"
                                data-target="#updatesepvclaim"><i class="bi bi-pencil-square text-md"></i></button> --}}
                            <button disabled class="badge badge-danger hapussep" nomorsep="{{ $r->noSep }}"
                                data-placement="right" title="delete sep"><i
                                    class="bi bi-x-square-fill text-md"></i></button>
                            {{-- <button class="badge badge-success" data-placement="right" title="print sep"><i
                                    class="bi bi-printer text-md"></i></button> --}}
                        </td>
                    </tr>
            @endforeach
        @endif
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian SEP ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <div class="viewinfoSEP2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsepinternal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="exampleModalLabel">SEP Internal ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ui-front">
                <div class="viewinfoSEPinternal2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        $("#kunjunganpasienrawatjalan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(function() {
        $("#kunjunganpasienrawatinap").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [6, "desc"]
            ]
        })
    });
    $('#kunjunganpasienrawatjalan').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nosep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nosep,
            },
            url: '<?= route('cariinfoseppasien') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewinfoSEP2').html(response)
            }
        });
    });
    $('#kunjunganpasienrawatjalan').on('click', '.sepinternal', function() {
        spinner = $('#loader')
        spinner.show();
        nosep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nosep,
            },
            url: '<?= route('vclaimcarisepinternal') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewinfoSEPinternal2').html(response)
            }
        });
    });
    $('#kunjunganpasienrawatjalan').on('click', '.hapussep', function() {
        nosep = $(this).attr('nomorsep')
        Swal.fire({
            title: 'Hapus SEP',
            text: "Apakah anda ingin menghapus SEP " + nosep + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'SEP '+ nosep +' akan dihapus ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //KE AJAX
                    }
                })

            }
        })

    });
    $('#kunjunganpasienrawatinap').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nosep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nosep,
            },
            url: '<?= route('cariinfoseppasien') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewinfoSEP2').html(response)
            }
        });
    });
    $('#kunjunganpasienrawatinap').on('click', '.sepinternal', function() {
        spinner = $('#loader')
        spinner.show();
        nosep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nosep,
            },
            url: '<?= route('vclaimcarisepinternal') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewinfoSEPinternal2').html(response)
            }
        });
    });
    $('#kunjunganpasienrawatinap').on('click', '.hapussep', function() {
        nosep = $(this).attr('nomorsep')
        Swal.fire({
            title: 'Hapus SEP',
            text: "Apakah anda ingin menghapus SEP " + nosep + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'SEP '+ nosep +' akan dihapus ?',
                    icon: 'danger',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d5',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //KE AJAX
                    }
                })

            }
        })

    });
    $('#kunjunganpasienrawatinap').on('click', '.updatepulang', function() {
        nosep = $(this).attr('nomorsep')
        $('#pulang_nomorsep').val(nosep)    });
</script>
