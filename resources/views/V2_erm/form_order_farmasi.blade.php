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
                            <button hidden type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#riwayatpemakaianobatmodal"><i class="bi bi-plus"></i>
                                Riwayat Pemakaian Obat Pasien</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#riwayatracikan"><i class="bi bi-plus"></i>
                                Riwayat Racikan</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#riwayatresepdokter"><i class="bi bi-plus"></i>
                                Riwayat Resep</button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#riwayattemplateresep"><i class="bi bi-plus"></i>
                                Template Resep</button>
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
                        <form action="" class="form_template">
                            <div class="form-group form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="cektemplate" name="cektemplate">
                                <label class="form-check-label" for="exampleCheck1">Simpan sebagai template</label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nama Template</label>
                                <input type="text" class="form-control col-md-6" id="namatemplate"
                                    name="namatemplate" placeholder="masukan nama template ...">
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
