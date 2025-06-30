<div class="card">
    <div class="card-header">Data Order Farmasi</div>
    <div class="card-body">
        {{-- <table id="tabeldataorder" class="table table-sm table-hover table-bordered">
            <thead>
                <th>Nomor Antrian</th>
                <th>Unit Tujuan</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jenis Resep</th>
                <th>Aturan Pakai</th>
                <th>Status</th>
                <th>===</th>
            </thead>
            <tbody>
                @foreach ($orderfarmasi as $d)
                    <tr iddetail="{{ $d->id }}" idheader="{{ $d->idheader }}">
                        <td>{{ $d->status_antrian_b }}</td>
                        <td>
                            @if ($d->unit_tujuan == '4002')
                                DEPO 1
                            @else
                                DEPO 2
                            @endif
                        </td>
                        <td>{{ $d->namabarang }}</td>
                        <td>{{ $d->jumlah }}</td>
                        <td>{{ $d->jenisresep }}</td>
                        <td>{{ $d->aturanpakai }}</td>
                        <td>
                            @if ($d->status_antrian_a == 0)
                                Belum dikirim
                            @elseif($d->status_antrian_a == 1)
                                Sudah dikirim
                            @elseif($d->status_antrian_a == 2)
                                Sudah diterima
                            @endif
                        </td>
                        <td>
                            <button @if ($d->status_antrian_a == 2) disabled @endif
                                class="btn btn-sm btn-danger batalorder" namabarang="{{ $d->namabarang }}"
                                iddetail="{{ $d->iddetail }}" data-placement="top" title="retur order ..."><i
                                    class="bi bi-recycle"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        @foreach ($headerorder as $d)
            <div class="card">
                <div class="card-header">
                    Status Order : @if ($d->status_antrian == 0)
                        Belum dikirim
                    @elseif($d->status_antrian == 1)
                        Sudah dikirim
                    @elseif($d->status_antrian == 2)
                        Sudah diterima
                    @endif
                    @foreach ($antrian as $ad )
                        @if($d->id == $ad->id_header_order)
                           <br> Nomor antrian : {{ $ad->kode_antrian}} - {{ $ad->nomor_urut }}
                           <br> Unit : {{ $ad->nama_unit }} @if($ad->kode_unit == 4002) 1 @endif
                        @endif
                    @endforeach
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Nama barang</th>
                            <th>Jumlah</th>
                            <th>Aturan Pakai</th>
                            <th></th>
                        </thead>
                        @foreach ($dataorder as $dd)
                            @if ($dd->idheader == $d->id)
                                <tr>
                                    <td>{{ $dd->namabarang }}</td>
                                    <td>{{ $dd->jumlah }}</td>
                                    <td>{{ $dd->aturanpakai }}</td>
                                    <td>
                                        <button @if ($d->status_antrian == 2) disabled @endif
                                            class="btn btn-sm btn-danger batalorder" namabarang="{{ $dd->namabarang }}"
                                            iddetail="{{ $dd->iddetail }}" data-placement="top"
                                            title="retur order ..."><i class="bi bi-recycle"></i>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <div class="card-footer">
        <input hidden type="text" value="{{ $kodekunjungan }}" id="kodekunjungan">
        <button class="btn btn-danger" onclick="batalsemuaorder()">Batal Kirim Order</button>
        <button class="btn btn-success" onclick="kirimorder()">Kirim Order</button>
    </div>
</div>
<script>
    $(function() {
        $("#tabeldataorder").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "ordering": false,
        })
    });
    $(".batalorder").on('click', function(event) {
        iddetail = $(this).attr('iddetail')
        namabarang = $(this).attr('namabarang')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Order Obat " + namabarang + " Akan dibatalkan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                batalorderobat(iddetail)
            }
        });
    });

    function batalsemuaorder() {
        Swal.fire({
            title: "Data order yang sudah dikirim akan dibatalkan ?",
            text: "anda bisa mengirimnya lagi nanti ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, batal "
        }).then((result) => {
            if (result.isConfirmed) {
                batalkirimorder_action()
            }
        });
    }

    function kirimorder() {
        Swal.fire({
            title: "Data akan dikirim ke farmasi ?",
            text: "pastikan data order sudah benar, anda yakin ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Kirim "
        }).then((result) => {
            if (result.isConfirmed) {
                kirimorder_action()
            }
        });
    }

    function kirimorder_action() {
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('kirimorderkefarmasi') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
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
                    formorderfarmasiperawat()
                }
            }
        });
    }

    function batalkirimorder_action() {
        Swal.fire({
            title: "order yang sudah diterima tidak bisa dibatalkan oleh sistem ...",
            text: "Harap menghubungi petugas farmasi ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, lanjut "
        }).then((result) => {
            if (result.isConfirmed) {
                kodekunjungan = $('#kodekunjungan').val()
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan
                    },
                    url: '<?= route('batalkirimorder_action') ?>',
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
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
                            formorderfarmasiperawat()
                        }
                    }
                });
            }
        });

    }

    function batalorderobat(iddetail) {
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                iddetail
            },
            url: '<?= route('batalorderobat') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
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
                    formorderfarmasiperawat()
                }
            }
        });
    }
