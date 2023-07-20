<table id="tabeldataerm2" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tanggal Masuk</th>
        <th>No RM</th>
        <th>Nama Pasien</th>
        <th>Poli Tujuan</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @foreach ($dataerm as $d)
            <tr class="pilih" norm="{{ $d->no_rm }}" data-toggle="modal" data-target="#modalresume">
                <td>{{ $d->tgl_masuk }}</td>
                <td>{{ $d->no_rm }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->nama_unit }}</td>
                <td>{{ $d->keterangan2 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modalresume" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resume Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_r">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabeldataerm2").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeldataerm2').on('click', '.pilih', function() {
        rm = $(this).attr('norm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambil_berkas_erm_pasien_scan') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_r').html(response);
            }
        });
    });
</script>
