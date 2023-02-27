<table id="tabelriwayattindakan_tdy" class="table table-sm table-bordered text-xs">
    <thead>
        <th>Kode Header</th>
        <th>Kode Detail</th>
        <th>Nama Layanan</th>
        <th>Jumlah</th>
        <th>status</th>
    </thead>
    <tbody>
        @foreach ($riwayat_tindakan as $r)
            <tr @if($r->status_layanan_header == '3') class="bg-danger"  @endif >
                <td><button id="{{ $r->id_header }}" kodelayananheader="{{ $r->kode_layanan_header }}"
                        class="badge badge-danger returheader" data-toggle="tooltip" data-placement="top"
                        title="retur header ..."><i class="bi bi-trash"></i></button>
                    {{ $r->kode_layanan_header }}</td>
                <td>{{ $r->id_detail }}</td>
                <td>{{ $r->NAMA_TARIF }}</td>
                <td>{{ $r->jumlah_layanan }}</td>
                <td>@if($r->status_layanan_header == '3') Batal @else Aktif @endif </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayattindakan_tdy").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": false,
            "order" :[4,'asc']
        })
    });
    $('#tabelriwayattindakan_tdy').on('click', '.returheader', function() {
        idheader = $(this).attr('id')
        kodelayananheader = $(this).attr('kodelayananheader')
        Swal.fire({
            title: 'Anda yakin ?',
            text: "Semua layanan dengan kode header " + kodelayananheader + " akan dibatalkan / retur ...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batal layanan header'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        idheader,
                        kodelayananheader
                    },
                    url: '<?= route('batalheaderlayanan') ?>',
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
                            tindakanhariini()
                        }
                    }
                });
            }
        })

    })
</script>
