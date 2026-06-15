<style>
    .modal-lg {
        max-width: 80% !important;
    }
</style>
<div class="container-fluid"> asdad
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Pemeriksaan Laboraotrium</div>
                <div class="card-body">
                    @foreach ($hasil_lab as $c)
                        <iframe src="{{ $c->link }}"
                            width="100%" height="1000px"></iframe>
                     
                    @endforeach                   
                </div>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" value="{{ $rm }}" id="rm">
<script>
    function tampilkanhasillab() {
        jlh = $('#jumlahdata2').val()
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
            error: function(response){
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
