<h2 class="text-bold mt-3 text-info">Data Klaim JR</h2>
<table id="kunjunganpasienrawatjalan" class="table table-bordered table-sm text-xs">
    <thead>
        <th>No RM</th>
        <th>No kartu</th>
        <th>Nama</th>
        <th>No SEP</th>
        <th>Tgl SEP</th>
        <th>Tgl pulang SEP</th>
        <th>Poli</th>
        <th>Tgl Kejadian</th>
        <th>Keterangan</th>
        <th>Status dikirim</th>
        <th>Biaya dijamin</th>
        <th>Biaya dibayar</th>
        <th>Result</th>
    </thead>
    <tbody>
        @if ($data->metaData->code == 200)
            @foreach ($data->response->jaminan as $r)
                    <tr>
                        <td>{{ $r->sep->peserta->noMR }}</td>
                        <td>{{ $r->sep->peserta->noKartu }}</td>
                        <td>{{ $r->sep->peserta->nama }}</td>
                        <td>{{ $r->sep->noSEP }}</td>
                        <td>{{ $r->sep->tglSEP }}</td>
                        <td>{{ $r->sep->tglPlgSEP }}</td>
                        <td>{{ $r->sep->poli }}</td>
                        <td>{{ $r->jasaRaharja->tglKejadian }}</td>
                        <td>{{ $r->jasaRaharja->ketStatusDijamin }}</td>
                        <td>{{ $r->jasaRaharja->ketStatusDikirim }}</td>
                        <td>{{ $r->jasaRaharja->biayaDijamin }}</td>
                        <td>{{ $r->jasaRaharja->jmlDibayar }}</td>
                        <td>{{ $r->jasaRaharja->resultsJasaRaharja }}</td>
                    </tr>
            @endforeach
            @else
            <h5 class="text-danger"> {{ $data->metaData->message }} </h5>
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
