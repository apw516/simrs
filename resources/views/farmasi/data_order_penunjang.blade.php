<div class="card">
    <div class="card-header bg-info">Data Order Penunjang</div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">Order Farmasi</div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Nama Barang</th>
                        <th>QTY</th>
                        <th>Aturan Pakai</th>
                        <th>Status antrian</th>
                        <th>Status detail</th>
                        {{-- <th>Nomor Antrian</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($data_order as $d)
                            <tr>
                                <td>{{ $d->namabarang }}</td>
                                <td>{{ $d->jumlah }}</td>
                                <td>{{ $d->aturanpakai }}</td>
                                <td>
                                    @if ($d->status_antrian == 0)
                                    Belum dikirim
                                    @elseif($d->status_antrian == 1)
                                    Sudah dikirim
                                    @endif
                                </td>
                                <td>
                                    @if ($d->status_detail == 1)
                                        Aktif
                                    @elseif($d->status_detail == 0)
                                        Retur
                                    @endif
                                </td>
                                {{-- <td>{{ $d->nomor_antrian }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <button class="btn btn-success kirimorderfarmasi" kodekunjungan = "{{ $kode_kunjungan }}"><i
                        class="bi bi-send mr-1 ml-1"></i> Kirim
                    Order</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".kirimorderfarmasi").on('click', function(event) {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data order akan dikirim ke farmasi ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, kirim order ..."
        }).then((result) => {
            if (result.isConfirmed) {
                kodekunjungan = $(this).attr('kodekunjungan')
                kirimorderfarmasi(kodekunjungan)
            }
        });
    });

    function kirimorderfarmasi(kodekunjungan) {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('kirimorderfarmasi') ?>',
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
                    dataorderpenunjang()
                }
            }
        });
    }
</script>
