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
                    <div class="input-group mb-3">
                        <input type="text" class="form-control col-md-3"
                            placeholder="Masukan jumlah hasil yang ingin ditampilkan ..."
                            aria-label="Recipient's username" aria-describedby="button-addon2" id="jumlahdata">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                onclick="tampilkanhasillab()">Tampilkan</button>
                        </div>
                    </div>
                </div>
                <div class="v_hasil_lab_2">

                </div>
                {{-- @foreach ($hasil_lab as $c)
                    <iframe src="//192.168.2.74/smartlab_waled/his/his_report?hisno={{ $c->kode_layanan_header }}"
                        width="100%" height="1000px"></iframe>
                @endforeach --}}
            </div>
        </div>
    </div>
</div>
<input hidden type="text" value="{{ $rm }}" id="rm">
<script>
    function tampilkanhasillab() {
        jlh = $('#jumlahdata').val()
        rm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jlh,rm
            },
            url: '<?= route('ambilhasillab_by_limit') ?>',
            success: function(response) {
                $('.v_hasil_lab_2').html(response);
                spinner.hide()
            }
        });
    }
</script>
