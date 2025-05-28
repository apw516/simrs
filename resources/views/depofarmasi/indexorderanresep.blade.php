@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Data Order Resep</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="v_1">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Unit Tujuan</label>
                                <select class="form-control" id="unit" name="unit">
                                    <option value="4002">DEPO 1</option>
                                    <option value="4008">DEPO 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Order</label>
                                <input type="date" class="form-control" id="tanggalorder" name="tanggalorder"
                                    placeholder="name@example.com" value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" style="margin-top:32px" onclick="cariorder()"><i class="bi bi-search mr-1 ml-1"></i> Cari Order</button>
                        </div>
                    </div>
                    <div class="v_tabel_order mt-2">

                    </div>
                </div>
                <div hidden class="v_2">

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
            function cariorder() {
                unit = $('#unit').val()
                tanggal = $('#tanggalorder').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal,unit
                    },
                    url: '<?= route('cariorderfarmasi') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.v_tabel_order').html(response);
                    }
                });
            }
        </script>
    @endsection
