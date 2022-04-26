<h2 class="text-bold">Kunjungan Rawat Jalan </h2>
<table id="kunjunganpasienrawatjalan" class="table table-bordered table-sm text-xs">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor sep</th>
        <th>nomor rujukan</th>
        <th>jns pelayanan</th>
        <th>poli</th>
        <th>PPk pelayanan</th>
        <th>tgl sep</th>
        <th>tgl pulang sep</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($datakunjungan->metaData->code == 200)
            @foreach ($datakunjungan->response->histori as $r)
                @if ($r->jnsPelayanan == 2)
                    <tr>
                        <td>{{ $r->namaPeserta }}</td>
                        <td>{{ $r->noKartu }}</td>
                        <td>{{ $r->noSep }}</td>
                        <td>{{ $r->noRujukan }}</td>
                        <td>Rawat Jalan</td>
                        <td>{{ $r->poli }}</td>
                        <td>{{ $r->ppkPelayanan }}</td>
                        <td>{{ $r->tglSep }}</td>
                        <td>{{ $r->tglPlgSep }}</td>
                        <td>
                            <button class="badge badge-primary detailsep" nomorsep="{{ $r->noSep }}"
                                data-placement="right" title="detail sep" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-eye text-md"></i></button>
                            <button class="badge badge-success" data-placement="right" title="print sep"><i
                                    class="bi bi-printer text-md"></i></button>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>
<h2 class="text-bold">Kunjungan Rawat Inap </h2>
<table id="kunjunganpasienrawatinap" class="table table-bordered table-sm text-xs">
    <thead>
        <th>Nama</th>
        <th>nomor kartu</th>
        <th>nomor sep</th>
        <th>nomor rujukan</th>
        <th>jns pelayanan</th>
        <th>poli</th>
        <th>PPk pelayanan</th>
        <th>tgl sep</th>
        <th>tgl pulang sep</th>
        <th>===</th>
    </thead>
    <tbody>
        @if ($datakunjungan->metaData->code == 200)
            @foreach ($datakunjungan->response->histori as $r)
                @if ($r->jnsPelayanan == 1)
                    <tr>
                        <td>{{ $r->namaPeserta }}</td>
                        <td>{{ $r->noKartu }}</td>
                        <td>{{ $r->noSep }}</td>
                        <td>{{ $r->noRujukan }}</td>
                        <td>Rawat Inap</td>
                        <td>{{ $r->poli }}</td>
                        <td>{{ $r->ppkPelayanan }}</td>
                        <td>{{ $r->tglSep }}</td>
                        <td>{{ $r->tglPlgSep }}</td>
                        <td>
                            <button class="badge badge-primary detailsep" nomorsep="{{ $r->noSep }}" data-placement="right" title="detail sep" data-toggle="modal" data-target="#exampleModal"><i
                                    class="bi bi-eye text-md"></i></button>
                            <button class="badge badge-success" data-placement="right" title="print sep"><i
                                    class="bi bi-printer text-md"></i></button>
                        </td>
                    </tr>
                @endif
            @endforeach
        @endif
    </tbody>
</table>

<script>
    $(function() {
        $("#kunjunganpasienrawatjalan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true
        })
    });
    $(function() {
        $("#kunjunganpasienrawatinap").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [[ 6, "desc" ]]
        })
    });
    $('#kunjunganpasienrawatjalan').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '<?= route('vclaimdetailsep');?>',
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
    $('#kunjunganpasienrawatinap').on('click', '.detailsep', function() {
        spinner = $('#loader')
        spinner.show();
        nomorsep = $(this).attr('nomorsep')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
            },
            url: '<?= route('vclaimdetailsep');?>',
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
</script>
