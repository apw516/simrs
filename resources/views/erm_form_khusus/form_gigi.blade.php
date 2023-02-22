<div class="card">
    <div class="card-header bg-danger"> Form Pemeriksaan Gigi </div>
    <div class="card-body">
        @if (count($resume) > 0)
            <form action="" class="formgigi">
                <input hidden type="text" class="form-control" id="idassesmen" value="{{ $resume[0]->id }}">
                <table class="table table-sm">
                    <tr>
                        <td colspan="4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="gambar1">

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <button type="button" class="btn btn-success float-right simpanpemeriksaan">Simpan</button>
            </form>
        @else
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...
                </h3>
                <p>
                    Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
                </p>
            </div>
        @endif
    </div>
</div>
<script>
    $(document).ready(function() {
        ambilgambar1()
        function ambilgambar1() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('gambargigi') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar1').html(response)
                }
            });
        }
    });
    $(".simpanpemeriksaan").click(function() {
        var canvas1 = document.getElementById("myCanvas1");
        var ctx1 = canvas1.getContext("2d");
        var img1 = document.getElementById("gambarnya1");
        ctx1.drawImage(img1, 10, 10);
        var dataUrl1 = canvas1.toDataURL();
        $('#gambargigi').val(dataUrl1)
        gambargigi = $('#gambargigi').val()

        var kodekunjungan = $('#kodekunjungan').val()
        var nomorrm = $('#nomorrm').val()
        var idassesmen = $('#idassesmen').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: kodekunjungan,
                gambargigi,
                idassesmen,
                nomorrm
            },
            url: '<?= route('simpanformgigi') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                console.log(data)
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: 'Data berhasil disimpan!',
                        footer: ''
                    })
                }
            }
        });
    })
</script>
