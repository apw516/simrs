@foreach ($data_header as $dh)
    <div class="card">
        <div class="card-header">Resep : {{ $dh->nama_dokter }}
            | Status : @if ($dh->status_order == 1)
                Belum dikirim @elseif($dh->status_order == 2)Sudah dikirim @elseif($dh->status_order == 3)Sudah diterima
            @endif | {{ $dh->tgl_entry }}
        </div>
        <div class="card-body">
            <button @if($dh->status_order > 2) disabled @endif type="button" class="btn btn-danger mb-2 btn-sm batalorderheader" idheader="{{ $dh->id }}"><i
                    class="bi bi-trash3"></i> Batal Order</button>
            <table class="table table-sm table-bordered">
                <thead>
                    <th>Nama Obat</th>
                    <th>Dosis</th>
                    <th>Sediaan</th>
                    <th>Aturan Pakai</th>
                    <th>qty</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($data_detail as $dt)
                        @if ($dt->id_header_order == $dh->id)
                            <tr>
                                <td>{{ $dt->nama_barang }}</td>
                                <td>{{ $dt->dosis }}</td>
                                <td>{{ $dt->sediaan }}</td>
                                <td>{{ $dt->aturan_pakai }}</td>
                                <td>{{ $dt->qty }}</td>
                                <td>
                                    <button @if($dh->status_order > 2) disabled @endif type="button" iddetail="{{ $dt->iddetail }}"
                                        class="btn btn-sm btn-warning editdetailorder" data-toggle="modal"
                                        data-target="#modaleditorder"><i class="bi bi-pencil-square"></i></button>

                                    <button @if($dh->status_order > 2) disabled @endif type="button" class="btn btn-sm btn-danger hapusdetailorder"
                                        nama="{{ $dt->nama_barang }}" iddetail="{{ $dt->iddetail }}"><i
                                            class="bi bi-trash3"></i></button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
<!-- Modal -->
<div class="modal fade" id="modaleditorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                <button type="button" class="close" data-dismiss="modal" data-target="#modaleditorder"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_edit_detail_order">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="simpaneditorder()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".hapusdetailorder").on('click', function(event) {
        iddetail = $(this).attr('iddetail')
        nama = $(this).attr('nama')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data Order Farmasi " + nama + " akan dibatalkan !",
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
                        iddetail,
                    },
                    url: '<?= route('batalorderfarmasi_detail') ?>',
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
                            $('#modalriwayatorderhariini').modal('toggle');
                        }
                    }
                });
            }
        });
    });
    $(".batalorderheader").on('click', function(event) {
        idheader = $(this).attr('idheader')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data Order Farmasi akan dibatalkan !",
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
                        idheader,
                    },
                    url: '<?= route('batalorderfarmasi') ?>',
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
                            $('#modalriwayatorderhariini').modal('toggle');
                        }
                    }
                });
            }
        });
    });
    $(".editdetailorder").on('click', function(event) {
        iddetail = $(this).attr('iddetail')
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                iddetail
            },
            url: '<?= route('ambilformeditorder') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_form_edit_detail_order').html(response);
            }
        });
    });
</script>
