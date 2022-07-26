<div class="card">
    <div class="card-header bg-info">Riwayat Kunjungan</div>
    <div class="card-body">
        <table id="tabelriwayatkunjungan"
            class="table table-bordered table-sm text-sm table-hover table-striped">
            <thead>
                <th>rm</th>
                <th>Nama</th>
                <th>Unit</th>
                <th>Tgl Masuk</th>
                <th>Tgl Keluar</th>
                <th>PENJAMIN</th>
                <th>Dokter</th>
                <th>SEP</th>
                <th>Rujukan</th>
                <th>action</th>
            </thead>
            <tbody>
                @foreach ($riwayat_kunjungan as $r)
                    <tr>
                        <td>{{ $r->no_rm }}</td>
                        <td>{{ $r->nama_px }}</td>
                        <td>{{ $r->nama_unit }}</td>
                        <td><button class="badge badge-warning">{{ $r->tgl_masuk }}</button></td>
                        <td>{{ $r->tgl_keluar }}</td>
                        <td>{{ $r->nama_penjamin }}</td>
                        <td>{{ $r->dokter }}</td>
                        <td>{{ $r->no_sep }}</td>
                        <td><p class="font-weight-bold">{{ $r->no_rujukan }} </p></td>
                        <td>
                            <?php $jns = substr($r->kode_unit,0,1) ;?>
                            @if($jns == 1 ) 
                            @else
                            <button rm="{{ $r->no_rm }}" kode="{{ $r->kode_kunjungan }}" class="badge badge-danger buatsep">+ buat sep </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="formsepmanual">

</div>
<script>
     $(function() {
        $("#tabelriwayatkunjungan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "ordering": true,
            "columnDefs": [{
                "targets": 0,
                "type": "date"
            }],
            // "order": [
            //     [1, "desc"]
            // ]
        })
    });
    $('#tabelriwayatkunjungan').on('click', '.buatsep', function() {
        spinner = $('#loader');
        spinner.show();
        rm = $(this).attr('rm')
        kode = $(this).attr('kode')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kode
            },
            url: '<?= route('formbuatsep_manual') ?>',
            error: function(data) {
                spinner.hide();
            },
            success: function(response) {
                spinner.hide();
                $('.formsepmanual').html(response);
            }
        });
    });
</script>