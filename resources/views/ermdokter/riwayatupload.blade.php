@if (count($cek) > 0)
    <table class="table table-sm table-hover" id="tabelgbr">
        <thead>
            <th>Nama File</th>
            <th>Unit</th>
            <th>Tanggal Upload</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($cek as $d)
                <tr class="klikklik" url="{{ url('../../files/' . $d->gambar) }}">
                    <td><img width="20px" src="{{ url('../../files/' . $d->gambar) }}" alt="" class="mr-3">
                        {{ $d->gambar }}</td>
                    <td>{{ $d->nama_unit }}</td>
                    <td>{{ $d->tgl_upload }}</td>
                    <td>
                        <button class="badge badge-danger">Hapus</button>
                        <button class="badge badge-danger">lihat</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h5>Tidak ada berkas yang diupload !</h5>
@endif
<div class="modal" tabindex="-1" id="modalgambar" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Berkas Penunjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="imageviewer">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#tabelgbr').on('click', '.klikklik', function() {
        $("#modalgambar").modal()
        url = $(this).attr('url')
        wrapper = $(".imageviewer")
        $(wrapper).append('<img src='+ url + '>');
    })
</script>
