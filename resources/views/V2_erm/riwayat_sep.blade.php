<table id="tabelriwayatsep" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nomor Sep</th>
        <th>Nomor Rujukan</th>
        <th>Nama Pasien</th>
        <th>Jenis Sep</th>
        <th>Rumah sakit</th>
        <th>Tanggal Sep</th>
        <th>Poliklinik</th>
    </thead>
    <tbody>
        @foreach ($data->response->histori as $d)
            <tr class="pilihsep" nosep="{{ $d->noSep }}">
                <td>{{ $d->noSep }}</td>
                <td>{{ $d->noRujukan }}</td>
                <td>{{ $d->namaPeserta }}</td>
                <td>
                    @if ($d->jnsPelayanan == 1)
                        RAWAT INAP
                    @else
                        RAWAT JALAN
                    @endif
                </td>
                <td>{{ $d->ppkPelayanan }}</td>
                <td>{{ $d->tglSep }}</td>
                <td>{{ $d->poli }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="v_hasil_Sep2"></div>
<script>
    $(function() {
        $("#tabelriwayatsep").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });
    $(".pilihsep").on('click', function(event) {
        sep = $(this).attr('nosep')
        spinner = $('#loader')
        idpic = $('#idpic').val()
        nomorkartu = $('#nomorkartu').val()
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                sep,
                idpic,
                nomorkartu
            },
            url: '<?= route('v2_carisep_kontrol') ?>',
            success: function(response) {
                $('.v_hasil_Sep2').html(response);
                spinner.hide()
            }
        });
    })
</script>
