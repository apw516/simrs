@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Riwayat Kartu Stok</h1>
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
                                <label for="exampleFormControlSelect1">Pilih Unit</label>
                                <select class="form-control" id="unit" name="unit">
                                    <option value="4002" @if (auth()->user()->unit == '4002') selected @endif>DEPO 1</option>
                                    <option value="4008" @if (auth()->user()->unit == '4008') selected @endif>DEPO 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Cari Barang</label>
                                <input type="text" class="form-control" id="namabarang" name="namabarang"
                                    placeholder="Cari nama barang ..." value="">
                                <input hidden type="text" class="form-control" id="kodebarang" name="kodebarang"
                                    placeholder="Cari nama barang ..." value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Stok Awal</label>
                                <input type="date" class="form-control" id="tanggalawal" name="tanggalawal"
                                    placeholder="Cari nama barang ..." value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Stok Akhir</label>
                                <input type="date" class="form-control" id="tanggalakhir" name="tanggalakhir"
                                    placeholder="Cari nama barang ..." value="{{ $now }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" style="margin-top:32px" onclick="caririwayatstok()"><i
                                    class="bi bi-search mr-1 ml-1"></i> Cari Riwayat</button>
                        </div>
                    </div>
                    <div class=" mt-2">
                        <div class="card">
                            <div class="card-header">Riwayat Kartu Stok</div>
                            <div class="card-body v_tabel_order">

                            </div>
                        </div>
                    </div>
                </div>
                <div hidden class="v_2">

                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('#namabarang').autocomplete({
                    source: "<?= route('caribarangfarmasi') ?>",
                    select: function(event, ui) {
                        $('[id="namabarang"]').val(ui.item.label);
                        $('[id="kodebarang"]').val(ui.item.kode);
                    }
                });
            });

            function spinneron() {
                spinner = $('#loader')
                spinner.show();
            }

            function spinnerof() {
                spinner = $('#loader')
                spinner.hide();
            }

            function caririwayatstok() {
                unit = $('#unit').val()
                namabarang = $('#namabarang').val()
                kodebarang = $('#kodebarang').val()
                tanggalawal = $('#tanggalawal').val()
                tanggalakhir = $('#tanggalakhir').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        unit,
                        namabarang,
                        kodebarang,
                        tanggalawal,
                        tanggalakhir
                    },
                    url: '<?= route('caririwayatstok') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.v_tabel_order').html(response);
                    }
                });
            }
        </script>
    @endsection
