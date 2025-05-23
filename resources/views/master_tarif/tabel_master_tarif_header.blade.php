<div class="card mt-4">
    <div class="card-header">Data Master Tarif</div>
    <div class="card-body">
        <table id="tabelmastertarif" class="table table-sm table-bordered table-hover">
            <thead>
                <th>KODE TARIF HEADER</th>
                <th>NAMA TARIF HEADER</th>
                <th>NAMA KELOMPOK TARIF</th>
                <th>TANGGAL INPUT</th>
                <th>Detail</th>
            </thead>
            <tbody>
                @foreach ($get_tarif_header as $d)
                    <tr>
                        <td>{{ $d->KODE_TARIF_HEADER }}</td>
                        <td>{{ $d->NAMA_TARIF }}</td>
                        <td>{{ $d->kelompok_tarif_name }}</td>
                        <td>{{ $d->TGL_INPUT }}</td>
                        <td><button class="btn btn-info detailtarif" idTA="{{ $d->KODE_TARIF_HEADER }}">detail</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function() {
        $("#tabelmastertarif").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 15,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $(".detailtarif").on('click', function(event) {
        idtarif = $(this).attr('idTA')
        $('.v_12').attr('hidden',true)
        $(".v_22").removeAttr('hidden', true);
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idtarif
            },
            url: '<?= route('detailmastertarif') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_22').html(response);
            }
        });
    })
