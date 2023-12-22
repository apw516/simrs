<div class="row mt-4">
    <div class="col-md-12">
        <table id="tabelheader" class="table table-sm table-bordered table-hover text-xs">
            <thead>
                <th>Nomor RM</th>
                <th>Nama</th>
                <th>Tgl lahir</th>
                <th>Alamat</th>
                <th>---</th>
            </thead>
            <tbody>
                @foreach ($dh as $d)
                    <tr>
                        <td>{{ $d->no_rm }}</td>
                        <td>{{ $d->nama_px }}</td>
                        <td>{{ $d->tgl_lahir }}</td>
                        <td>{{ $d->alamat_px}} | {{ $d->alamat }}</td>
                        <td>
                            <button id="{{ $d->id }}"class="btn btn-warning btn-sm editheader" data-toggle="modal"
                                data-target="#modaleditheader"><i class="bi bi-pencil-square"></i></button>
                            <button norm="{{ $d->no_rm }}"class="btn btn-sm btn-success jasmani" data-toggle="modal"
                                data-target="#modaljasmani">Jasmani</button>
                            <button norm="{{ $d->no_rm }}"class="btn btn-warning btn-sm napsa" data-toggle="modal"
                                data-target="#modalnapsa">Napsa</button>
                            <button norm="{{ $d->no_rm }}"class="btn btn-success btn-sm napsa" data-toggle="modal"
                                data-target="#modalnapsa">Rohani</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaljasmani" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Surat Keterangan Sehat Jasmani</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_suket_jasmani">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanjasmani()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalnapsa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Surat Keterangan Napsa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_suket_napsa">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpannapsa()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaleditheader" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Header</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_edit_header">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpaneditheader()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabelheader").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $(".jasmani").on('click', function(event) {
        rm = $(this).attr('norm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambil_v_jasmani') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_suket_jasmani').html(response);
            }
        });
    });
    $(".napsa").on('click', function(event) {
        rm = $(this).attr('norm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambil_v_napsa') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_suket_napsa').html(response);
            }
        });
    });
    $(".editheader").on('click', function(event) {
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambil_v_edit_header') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_edit_header').html(response);
            }
        });
    });
    function simpanjasmani() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formjasmaninya').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanjasmani') ?>',
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
                }
            }
        });
    }
    function simpannapsa() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formnapsanya').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpannapsa') ?>',
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
                }
            }
        });
    }
    function simpaneditheader() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formheadersurat_edit').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpaneditheader') ?>',
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
                }
            }
        });
    }
</script>
