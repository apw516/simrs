@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Data Master Tarif</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="v_12">
                    <div class="v_pencarian">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Cari Tarif</label>
                                    <input type="text" name="namatarif" id="namatarif" class="form-control"
                                        id="exampleFormControlInput1" placeholder="Ketik nama tarif ....">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-success" style="margin-top:32px" onclick="caritarif()"><i
                                            class="bi bi-search mr-2 ml-2"></i> Cari Tarif</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="v_master_tarif_header">

                    </div>

                </div>
                <div hidden class="v_22">

                </div>
            </div>
        </section>
        <script>
            function spinneron() {
                spinner = $('#loader')
                spinner.show();
            }

            function spinnerof() {
                spinner = $('#loader')
                spinner.hide();
            }

            function caritarif() {
                namatarif = $('#namatarif').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        namatarif
                    },
                    url: '<?= route('carinamatarif') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.v_master_tarif_header').html(response);
                    }
                });
            }
        </script>
    @endsection
