<h5>List tanggal pulang </h5>
<table id="tabeltanggalpulang" class="table table-bordered table-sm text-xs mt-3">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>jns pelayanan</th>
        <th>nomor sep</th>
        <th>nomor sep updating</th>
        <th>status</th>
        <th>tgl meninggal</th>
        <th>no. surat</th>
        <th>keterangan</th>
        <th>tgl sep</th>
        <th>tgl pulang</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($datakunjungan->metaData->code == 200)
            @foreach ($datakunjungan->response->list as $d)
                <tr>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->noKartu }}</td>
                    <td>{{ $d->jnsPelayanan }}</td>
                    <td>{{ $d->noSep }}</td>
                    <td>{{ $d->noSepUpdating }}</td>
                    <td>{{ $d->status }}</td>
                    <td>{{ $d->tglMeninggal }}</td>
                    <td>{{ $d->noSurat }}</td>
                    <td>{{ $d->keterangan }}</td>
                    <td>{{ $d->tglSep }}</td>
                    <td>{{ $d->tglPulang }}</td>
                    <td>
                        <button class="badge badge-primary detailsep" nomorsep="{{ $d->noSep }}"
                            data-placement="right" title="detail sep" data-toggle="modal" data-target="#exampleModal"><i
                                class="bi bi-eye text-xs"></i></button>
                        <button nomorsep="{{ $d->noSep }}" class="badge badge-warning pulangkan"
                            data-placement="right" title="update tanggal pulang" data-toggle="modal"
                            data-target="#modalupdatetglpulang"><i class="bi bi-pencil-square text-xs"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeltanggalpulang").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [[ 9, "desc" ]]
        })
    });
    $('#tabeltanggalpulang').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '/simrsvclaim/detailsep',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewdetailsep').html(response)
            }
        });
    });
    $('#tabeltanggalpulang').on('click', '.pulangkan', function() {
        nomorsep = $(this).attr('nomorsep')
       $('#pulang_nomorsep').val(nomorsep)
    });
</script>
