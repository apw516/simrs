<p>{{ $kunjungan}}</p>
<input hidden type="text" value="{{$nomorkartu}}" id="nomorkartubpjs">
<div class="card">
    <div class="card-header">Riwayat SEP</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">tanggal awal</label>
                    <input type="date" class="form-control" id="tglawal2" placeholder="name@example.com">
                  </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">tanggal akhir</label>
                    <input type="date" class="form-control" id="tglakhir2" placeholder="name@example.com">
                  </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" style="margin-top:34px" onclick="caririwayatsep()">Cari Sep</button>
            </div>
        </div>
        <div class="v_tabel_riwayat_sep mt-3">

        </div>
    </div>
</div>
<script>
    function caririwayatsep()
    {
        nomorkartubpjs = $('#nomorkartubpjs').val()
        tglawal = $('#tglawal2').val()
        tglakhir = $('#tglakhir2').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                tglawal,
                tglakhir,nomorkartubpjs
            },
            url: '<?= route('v2_cari_riwayat_sep') ?>',
            error: function(data){
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_tabel_riwayat_sep').html(response);
                spinner.hide()
            }
        });
    }

</script>
