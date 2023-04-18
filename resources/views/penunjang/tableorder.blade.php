<table id="tabelorder" class="table table-sm table-hover">
    <thead class="bg-secondary">
        <th></th>
        <th>Tgl Entry</th>
        <th>Tgl Periksa</th>
        <th>Nomor Order</th>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Asal Order</th>
        <th>--</th>
    </thead>
    <tbody>
        @foreach ($order as $o)
            <tr>
                <td class="text-right">
                    @if ($o->status_order == 1)
                        <i class="bi bi-exclamation-circle-fill text-md text-warning"></i>
                    @elseif($o->status_order == 2)
                        <i class="bi bi-check-circle-fill text-md text-success"></i>
                    @endif
                </td>
                <td>{{ $o->tgl_entry }}</td>
                <td>{{ $o->tgl_periksa }}</td>
                <td>{{ $o->kode_layanan_header }}</td>
                <td>{{ $o->no_rm }}</td>
                <td>{{ $o->nama }}</td>
                <td>{{ $o->unit_kirim }}</td>
                <td>
                    <button id="{{ $o->id }}"class="badge badge-primary btndetail" data-toggle="modal"
                        data-target="#detailorder"><i class="bi bi-eye mr-2 text-bold"></i>detail</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>

    $(function() {
            $("#tabelorder").DataTable({
                "responsive": true,
                "lengthChange": false,
                // "autoWidth": true,
                "pageLength": 10,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tabelorder').on('click', '.btndetail', function() {
            id = $(this).attr('id')
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id
                },
                url: '<?= route('ambildetailorder') ?>',
                success: function(response) {
                    $('.vdetail_order').html(response);
                    spinner.hide();
                }
            });
        });
</script>
