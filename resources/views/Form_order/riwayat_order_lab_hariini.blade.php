@foreach ($data_header as $dh)
    <div class="card">
        <div class="card-header">{{ $dh->nama_dokter }}
            | Status : @if ($dh->status_order == 0)
                Belum dikirim @elseif($dh->status_order == 1)Sudah dikirim
                @elseif($dh->status_order == 2) Sudah diterima
            @endif | {{ $dh->tgl_entry }} | tanggal periksa ke penunjang : {{ $dh->tgl_periksa}}
        </div>
        <div class="card-body">
            <button @if($dh->status_order >= 2) disabled @endif type="button" class="btn btn-danger mb-2 btn-sm batalorderheader" idheader="{{ $dh->id }}"><i
                    class="bi bi-trash3"></i> Batal Order</button>
            <table class="table table-sm table-bordered">
                <thead>
                    <th>Nama Layanan</th>
                    <th>Tarif</th>
                    <th>QTY</th>
                    <th>Total</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($data_detail as $dt)
                        @if ($dt->row_id_header == $dh->id)
                            <tr>
                                <td>{{ $dt->NAMA_TARIF }}</td>
                                <td>
                                    RP. {{ number_format($dt->total_tarif, 2) }}
                                </td>
                                <td>{{ $dt->jumlah_layanan }}</td>
                                <td>
                                    RP. {{ number_format($dt->grantotal_layanan, 2) }}
                                </td>
                                <td>
                                    <button @if($dh->status_order >= 2) disabled @endif type="button" iddetail="{{ $dt->iddetail }}"
                                        class="btn btn-sm btn-warning editdetailorder" data-toggle="modal"
                                        data-target="#modaleditorderpenunjnag"><i class="bi bi-pencil-square"></i></button>
                                    <button @if($dh->status_order >= 2) disabled @endif type="button" class="btn btn-sm btn-danger hapusdetailorder"
                                        nama="{{ $dt->NAMA_TARIF }}" iddetail="{{ $dt->iddetail }}"><i
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
<div class="modal fade" id="modaleditorderpenunjnag" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Order Penunjang</h5>
                <button type="button" class="close" data-dismiss="modal" data-target="#modaleditorderpenunjnag"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_edit_detail_order_penunjang">

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
            text: "Data Order Laboratoriun " + nama + " akan dibatalkan !",
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
                    url: '<?= route('batalorderlab_detail') ?>',
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
                            $('#modalriwayatorderpenunjanghariini').modal('toggle');
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
            text: "Data Order Laboratorium akan dibatalkan !",
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
                    url: '<?= route('batalorderlab') ?>',
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
                            $('#modalriwayatorderpenunjanghariini').modal('toggle');
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
            url: '<?= route('ambilformeditorderpenunjang') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_form_edit_detail_order_penunjang').html(response);
            }
        });
    });
</script>
