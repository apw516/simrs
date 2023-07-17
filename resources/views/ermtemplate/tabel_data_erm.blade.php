<table id="tabeldataerm" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tanggal Pemeriksaan</th>
        <th>No RM</th>
        <th>Nama Pasien</th>
        <th>Nama Dokter</th>
        <th>Nama Perawat</th>
        <th>Nama Poli</th>
        <th>---</th>
    </thead>
    <tbody>
        @foreach ($dataerm as $d)
            <tr>
                <td>{{ $d->tgl_pemeriksaan }}</td>
                <td>{{ $d->id_pasien }}</td>
                <td>{{ $d->nama_pasien }}</td>
                <td>{{ $d->nama_dokter }}</td>
                <td>{{ $d->perawat }}</td>
                <td>{{ $d->nama_poli }}</td>
                <td><button id_asskep="{{ $d->id_asskep }}" id_assdok="{{ $d->id_assdok }}"
                        class="btn btn-success btn-sm tampilresume" data-toggle="modal" data-target="#modalresume"><i
                            class="bi bi-bullseye"></i></button></td>
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
        $("#tabeldataerm").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeldataerm').on('click', '.tampilresume', function() {
        id_asskep = $(this).attr('id_asskep')
        id_assdok = $(this).attr('id_assdok')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id_asskep,
                id_assdok
            },
            url: '<?= route('ambil_berkas_erm_pasien') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_r').html(response);
            }
        });
    });
</script>
