<div class="accordion" id="accordionExample_penunjang1">
    <div class="card">
        <div class="card-header bg-light" id="headingTwo_Penunjang">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-dark text-bold text-left collapsed" type="button"
                    data-toggle="collapse" data-target="#collapseTwo_penunjang2" aria-expanded="false"
                    aria-controls="collapseTwo_penunjang2">
                    <i class="bi bi-plus-lg"></i> Order Farmasi
                </button>
            </h2>
        </div>
        <div id="collapseTwo_penunjang2" class="collapse" aria-labelledby="headingTwo_Penunjang"
            data-parent="#accordionExample_penunjang1">
            <div class="card-body">
                <div class="card">
                    <div class="card-header bg-light font-italic">Riwayat Order Hari ini
                    </div>
                    <div class="card-body">
                        <div class="v_riwayat_order_farmasi">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light font-italic">Silahkan Pilih Obat</div>
                    <div class="card-body">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalobatreguler"><i class="bi bi-plus"></i> Obat
                                Reguler</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalobatracik"><i class="bi bi-plus"></i> Obat
                                Racikan</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#riwayatpemakaianobatmodal"><i class="bi bi-plus"></i>
                                Riwayat Pemakaian Obat</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#riwayatracikan"><i class="bi bi-plus"></i>
                                Riwayat Racikan</button>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <label for="" class="font-italic">List obat yang dipilih
                            ...</label>
                        <form action="" method="post" class="formorderfarmasi">
                            <div class="field_order_farmasi" id="field_fix_1">
                                <div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        riwayat_order_farmasi()
    })
    function riwayat_order_farmasi() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_farmasi') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_order_farmasi').html(response);
            }
        });
    }
</script>
