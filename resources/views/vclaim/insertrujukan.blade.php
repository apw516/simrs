@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert Rujukan Keluar RS</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route}}">Dashboard</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Pendaftaran</li> --}}
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Nomor SEP</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="ketik nomor sep ..."
                                id="nomorsep_rujukan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Tanggal Rujukan</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                placeholder="ketik nama dokter ..." id="tglrujukan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Tanggal Rencana Kunjungan</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                placeholder="ketik nama dokter ..." id="tglrencanakunjungan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Jenis Faskes Rujukan</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="jenisfaskes">
                                <option value="1">Faskes 1</option>
                                <option value="2">Faskes 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Nama Faskes Rujukan</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="namafaskes_rujukan"
                                placeholder="ketik nama faskes ..." id="namafaskes_rujukan">
                            <input readonly type="text" class="form-control" name="kodefaskes_rujukan"
                                id="kodefaskes_rujukan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Jenis Pelayanan</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="jenispelayanan_rujukan">
                                <option value="1">Rawat Inap</option>
                                <option selected value="2">Rawat Jalan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Tipe Rujukan</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="tiperujukan">
                                <option value="0">Penuh</option>
                                <option value="1">Partial</option>
                                <option value="2">Balik PRB</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Poli Rujukan</div>
                        <div class="col-sm-7">
                            <input readonly type="text" data-toggle="modal" data-target="#modalpilihpoli2"
                                onclick="caripoli()" class="form-control" placeholder="ketik nama poli ..."
                                id="namapoli_rujukan">
                            <input hidden type="text" class="form-control" id="kodepoli_rujukan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Diagnosa</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="Pilih diagnosa ..."
                                id="diagnosa_rujukan">
                            <input hidden type="text" class="form-control" id="kodediagnosa_rujukan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Catatan</div>
                        <div class="col-sm-7">
                            <textarea type="text" class="form-control" placeholder="Catatan untuk faskes yang dirujuk ..." id="catatan_rujukan"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold"></div>
                        <div class="col-sm-7">
                            <button class="btn btn-success float-right" onclick="buatrujukan_keluar()">Buat
                                Rujukan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalpilihpoli2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Poli</h5>
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ui-front">
                    <div class="viewpolispesialistik2">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function buatrujukan_keluar() {
            sep = $('#nomorsep_rujukan').val()
            tanggalrujukan = $('#tglrujukan').val()
            tglrencanakunjungan = $('#tglrencanakunjungan').val()
            kodefaskes_rujukan = $('#kodefaskes_rujukan').val()
            jenispelayanan_rujukan = $('#jenispelayanan_rujukan').val()
            tiperujukan = $('#tiperujukan').val()
            kodepoli_rujukan = $('#kodepoli_rujukan').val()
            kodediagnosa_rujukan = $('#kodediagnosa_rujukan').val()
            catatan_rujukan = $('#catatan_rujukan').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    sep,
                    tanggalrujukan,
                    tglrencanakunjungan,
                    kodefaskes_rujukan,
                    jenispelayanan_rujukan,
                    tiperujukan,
                    kodepoli_rujukan,
                    kodediagnosa_rujukan,
                    catatan_rujukan
                },
                url: '<?= route('vclaimsimpan_rujukan') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Rujukan Berhasil dibuat !',
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                        })
                    }
                }
            });
        }
        $(document).ready(function() {
            $('#namafaskes_rujukan').autocomplete({
                source: function(request, response) {
                    faskes = $('#jenisfaskes').val()
                    $.ajax({
                        url: "<?= route('carifaskes') ?>",
                        dataType: "json",
                        data: {
                            _token: "{{ csrf_token() }}",
                            faskes: faskes,
                            q: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('[name="namafaskes_rujukan"]').val(ui.item.label);
                    $('[name="kodefaskes_rujukan"]').val(ui.item.kode);
                }
            });
        });

        function caripoli() {
            spinner = $('#loader');
            spinner.show();
            tglrujukan = $('#tglrujukan').val()
            kodeppk = $('#kodefaskes_rujukan').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglrujukan,
                    kodeppk
                },
                url: '<?= route('caripolirujukan') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewpolispesialistik2').html(response)
                }
            });
        }

        $(document).ready(function() {
            $('#diagnosa_rujukan').autocomplete({
                source: "<?= route('caridiagnosa') ?>",
                select: function(event, ui) {
                    $('[id="diagnosa_rujukan"]').val(ui.item.label);
                    $('[id="kodediagnosa_rujukan"]').val(ui.item.kode);
                }
            });
        });

        function vclaim_carirujukan() {
            nomorpencarian = $('#nomorrujukanpencarian').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorpencarian
                },
                url: '<?= route('vclaimcarirujukanpeserta') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_hasilpencarian').html(response);
                }
            });
        }
    </script>
@endsection
