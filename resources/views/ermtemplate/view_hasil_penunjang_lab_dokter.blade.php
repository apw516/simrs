<style>
    .modal-lg {
        max-width: 80% !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Pemeriksaan Laboraotrium</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah data</label>
                                <input type="text" class="form-control" id="jumlahnya"
                                    aria-describedby="emailHelp" value="5">
                                <small class="form-text text-muted">masukan jumlah hasil yang ingin ditampilkan ...</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" style="margin-top:32px" onclick="tampilkanhasillab22()">Tampillkan</button>
                        </div>
                    </div>
                </div>
                <div class="v_hasil_lab_2">

                </div>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" value="{{ $rm }}" id="rm">
<script>
    function tampilkanhasillab22() {
        jlh = $('#jumlahnya').val()
        rm = $('#rm').val()
        alert(jlh)
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jlh,
                rm
            },
            url: '<?= route('ambilhasillab_by_limit') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_hasil_lab_2').html(response);
                spinner.hide()
            }
        });
    }
</script>
