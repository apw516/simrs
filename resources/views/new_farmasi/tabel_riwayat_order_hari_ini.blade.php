<table class="table table-sm table-hover text-xs" id="tabelriwayatorder">
    <thead>
        <th>Nama Barang</th>
        <th>Keterangan</th>
        <th>qty</th>
        <th>Sediaan</th>
        <th>Dosis</th>
        <th>Aturan Pakai</th>
        <th></th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($dataorder as $r)
            <tr>
                <td>{{ $r->namabarang }}</td>
                <td>{{ $r->tipeanestesi }} | {{ $r->jenisresep }} </td>
                <td>{{ $r->jumlah }}</td>
                <td>{{ $r->sediaan }}</td>
                <td>{{ $r->dosis }}</td>
                <td>{{ $r->aturanpakai }}</td>
                <td>
                    @if ($r->status_antrian == 0)
                        Belum dikirim
                    @elseif ($r->status_antrian == 1)
                        Sudah dikirim
                    @elseif ($r->status_antrian == 2)
                        Sudah diterima
                    @endif
                    </button>
                </td>
                <td>
                    <button @if($r->status_antrian == 2) disabled @endif class="btn btn-sm btn-danger bataloder" namabarang="{{ $r->namabarang }}"
                        iddetail="{{ $r->iddetail }}"><i class="bi bi-recycle"></i>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatorder").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": true,
            "ordering": false,
        })
    });
    $(".bataloder").on('click', function(event) {
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
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinnerof()
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
                    ambilformfarmasi2()
                }
            }
        });
    }
