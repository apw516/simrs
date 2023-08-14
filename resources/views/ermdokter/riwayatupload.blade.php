@if (count($cek) > 0)
    <table class="table table-sm table-hover" id="tabelgbr">
        <thead>
            <th>Nama</th>
            <th>File</th>
            <th>Unit</th>
            <th>Tanggal Upload</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($cek as $d)
                <tr class="klikklik2" url="{{ url('../../files/' . $d->gambar) }}">
                    <td>{{ $d->nama }}</td>
                    <td><img width="20px" src="{{ url('../../files/' . $d->gambar) }}" alt="" class="mr-3">
                        {{ $d->gambar }}</td>
                    <td>{{ $d->nama_unit }}</td>
                    <td>{{ $d->tgl_upload }}</td>
                    <td>
                        <button class="badge badge-danger hapus" id="{{ $d->id }}">Hapus</button>
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
    $('#tabelgbr').on('click', '.klikklik2', function() {
        $("#modalgambar").modal()
        url = $(this).attr('url')
        wrapper = $(".imageviewer")
        $(wrapper).append('<img src=' + url + '>');
    })
    $('#tabelgbr').on('click', '.hapus', function() {
        id = $(this).attr('id')
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                id,
                // signature
            },
            url: '<?= route('hapusgambarupload') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'ermwaled2023'
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == '502') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: data.message,
                        footer: 'ermwaled2023'
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: 'ermwaled2023'
                    })
                }
                riwayatupload(kodekunjungan)
            }
        });
    });
</script>
