<div class="card">
    <div class="card-header bg-warning">Upload Berkas</div>
    <div class="card-body">
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="fileupload" id="fileupload">
            <input type="text" class="form-control" name="kodeunitnya" id="kodeunitnya"
                value="{{ auth()->user()->unit }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                    onclick="uploadFile()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    function uploadFile() {
        var files = $('#fileupload')[0].files;
        var fd = new FormData();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        fd.append('file', files[0]);
        fd.append('_token',"{{ csrf_token() }}");
        fd.append('kodekunjungan',kodekunjungan);
        fd.append('nomorrm',nomorrm);
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: fd,
            url: '<?= route('uploadgambarnya') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                }
            }
        });
    }
</script>
