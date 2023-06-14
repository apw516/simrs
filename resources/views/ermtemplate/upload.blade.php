<div class="card">
    <div class="card-header bg-warning">Upload Berkas</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="namafile" id="namafile" placeholder="Masukan nama file ...">
                    <input type="file" class="form-control" name="fileupload" id="fileupload">
                    <input hidden type="text" class="form-control" name="kodeunitnya" id="kodeunitnya"
                        value="{{ auth()->user()->unit }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                            onclick="uploadFile()">Simpan</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">Riwayat Upload</div>
                    <div class="card-body">
                        <div class="riwayatupload">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(function() {
        kodekunjungan = $('#kodekunjungan').val()
        riwayatupload(kodekunjungan)
    })
    function riwayatupload(kodekunjungan) {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayatupload') ?>',
            success: function(response) {
                $('.riwayatupload').html(response);
            }
        });
    }
    function uploadFile() {
        spinner = $('#loader')
        spinner.show();
        var files = $('#fileupload')[0].files;
        var fd = new FormData();
        kodekunjungan = $('#kodekunjungan').val()
        namafile = $('#namafile').val()
        nomorrm = $('#nomorrm').val()
        fd.append('file', files[0]);
        fd.append('_token', "{{ csrf_token() }}");
        fd.append('kodekunjungan', kodekunjungan);
        fd.append('nomorrm', nomorrm);
        fd.append('namafile', namafile);
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: fd,
            url: '<?= route('uploadgambarnya') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    riwayatupload(kodekunjungan)
                }
            }
        });
    }
</script>
