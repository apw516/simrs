@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <div class="input-group mb-3 mt-3">
                        <input disabled type="text" class="form-control" id="pencariansep"
                            placeholder="Masih dalam tahap pengembangan ...">
                        <div class="input-group-append">
                            <button disabled class="btn btn-outline-primary" type="button" id="button-addon2"
                                onclick="carisuratkontrol()" data-toggle="modal" data-target="#modaleditsuratkontrol"><i
                                    class="bi bi-search-heart"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 mt-3">
                    <button class="btn btn-primary float-sm-right mr-2" data-toggle="modal" data-target="#staticBackdrop"
                        onclick="buatrujukan()"><i class="bi bi-person-plus"></i> RUJUKAN </button>
                </div>
            </div>
            <div hidden id="formrujuk" class="row mb-2 justify-content-center">
                <div class="col-sm-6">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3>Form Buat Rujukan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nomor SEP</label>
                                <input type="email" class="form-control" id="nomorsep_rujukan"
                                    placeholder="Masukan nomor SEP">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Rujukan</label>
                                <input type="email" class="form-control datepicker" id="tanggal_rujukan"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Rencana Kunjungan</label>
                                <input type="email" class="form-control datepicker" id="tglrencana_kunjungan"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1">Jenis Faskes</label>
                                        <select class="form-control" id="jenisfaskes">
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="1">Faskes 1</option>
                                            <option value="2">Faskes 2 ( Rumah Sakit ) </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1">PPK dirujuk</label>
                                        <input type="email" class="form-control" id="namappkrujukan"
                                            placeholder="cari nama ppk rujukan ...">
                                        <input hidden type="email" class="form-control" id="kodeppkrujukan"
                                            placeholder="name@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1">Jenis Pelayanan</label>
                                        <select class="form-control" id="jenispelayanan">
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="1">Rawat Inap</option>
                                            <option value="2">Rawat Jalan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlInput1">Tipe Rujukan</label>
                                        <select class="form-control" id="tiperujukan">
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option value="0">Penuh</option>
                                            <option value="1">Partial</option>
                                            <option value="2">Rujuk Balik</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Poli Rujukan</label>
                                <div class="input-group mb-3">
                                    <input readonly type="text" class="form-control" id="namapolirujukan"
                                        placeholder="Pilih poli rujukan" aria-label="Recipient's username"
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                            data-toggle="modal" data-target="#modalpolippk" onclick="caripolippk()">List
                                            Poli
                                            Rujukan</button>
                                    </div>
                                    <input hidden readonly type="text" class="form-control" id="kodepolirujukan"
                                        placeholder="Pilih poli rujukan" aria-label="Recipient's username"
                                        aria-describedby="button-addon2">
                                </div>
                                <small id="emailHelp" class="form-text text-danger">*Kosongkan jika rujuk balik, Wajib diisi
                                    jika rujukan penuh atau partial !</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">diagnosa</label>
                                <input type="text" class="form-control" id="namadiagnosa">
                                <input hidden type="text" class="form-control" id="kodediagnosa">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Catatan</label>
                                <textarea type="email" class="form-control" id="catatanrujukan"
                                    placeholder="catatan untuk ppk rujukan ..."></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success float-right mb-2 btn-sm" onclick="simpanrujukan()">Buat
                                Rujukan</button>
                            <button class="btn btn-danger float-right mb-2 mr-2 btn-sm"
                                onclick="batalrujukan()">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RUJUKAN</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="card collapsed-card">
            <div class="card-header bg-success">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <h4>List Rujukan Keluar RS</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="">Tanggal awal</label>
                            <input type="text" class="form-control datepicker" id="tanggalawal_rj"
                            data-date-format="yyyy-mm-dd" placeholder="Masukan No kartu ..">
                        </div>
                        <div class="col-sm-2">
                            <label for="">Tanggal akhir</label>
                            <input type="text" class="form-control datepicker" id="tanggalakhir_rj"
                            data-date-format="yyyy-mm-dd" placeholder="Masukan No kartu ..">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-dark mb-2 mt-4" onclick="get_list_rujukan()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="list_rujukan_keluar">
                        <table id="tabelsuratkontrol_rs" class="table table-bordered table-sm text-xs mt-3">
                            <thead>
                                <th>nomor rujukan</th>
                                <th>tgl rujukan</th>
                                <th>jenis pelayanan</th>
                                <th>no sep</th>
                                <th>No kartu</th>
                                <th>nama peserta</th>
                                <th>nama ppk dirujuk</th>
                                <th>---</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="card collapsed-card">
            <div class="card-header bg-success">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <h4>List Rujukan Khusus</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="nomorkartu" placeholder="Masukan No kartu ..">
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="bulan">
                                <option>-- Silahkan Pilih Bulan --</option>
                                <option value="01">Januari</option>
                                <option valie="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="tahun">
                                <option>-- Silahkan Pilih Tahun --</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control" id="filter">
                                <option value="1">Tanggal entry</option>
                                <option value="2">tanggal rencana kontrol</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-dark mb-2" onclick="getsuratkontrol_bycard()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="listsuratkontrol_peserta">
                        <table id="tabelsuratkontrol_peserta" class="table table-bordered table-sm text-xs mt-3">
                            <thead>
                                <th>nomor kartu</th>
                                <th>Nama</th>
                                <th>Terbit Sep</th>
                                <th>Tgl Sep</th>
                                <th>Nomor surat</th>
                                <th>Jn pelayanan</th>
                                <th>Jn kontrol</th>
                                <th>Tgl kontrol</th>
                                <th>Tgl terbit</th>
                                <th>SEP asal</th>
                                <th>poli asal</th>
                                <th>poli tujuan</th>
                                <th>dokter</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modalpolippk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pilih Poli</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="view_poli_ppk_rujukan">


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function buatrujukan() {
            $('#formrujuk').removeAttr('Hidden', true)
        }

        function batalrujukan() {
            $('#formrujuk').attr('Hidden', true)
        }
        $(document).ready(function() {
            $("#namappkrujukan").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "<?= route('carippkrujukan') ?>",
                        dataType: "json",
                        data: {
                            term: request.term,
                            faskes: $("#jenisfaskes").val()
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                delay: 300,
                select: function(event, ui) {
                    $('[id="kodeppkrujukan"]').val(ui.item.kode);
                }
            });
        });

        function caripolippk() {
            tgl = $('#tanggal_rujukan').val()
            kodeppk = $('#kodeppkrujukan').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodeppk,
                    tgl
                },
                url: '<?= route('caripoli_ppk') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_poli_ppk_rujukan').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
        $(document).ready(function() {
            $('#namadiagnosa').autocomplete({
                source: "<?= route('caridiagnosa') ?>",
                select: function(event, ui) {
                    $('[id="namadiagnosa"]').val(ui.item.label);
                    $('[id="kodediagnosa"]').val(ui.item.kode);
                }
            });
        });

        function simpanrujukan() {
            spinner = $('#loader');
            spinner.show();
            nosep = $('#nomorsep_rujukan').val()
            tglRujukan = $('#tanggal_rujukan').val()
            tglRencanaKunjungan = $('#tglrencana_kunjungan').val()
            ppkDirujuk = $('#kodeppkrujukan').val()
            jnsPelayanan = $('#jenispelayanan').val()
            catatan = $('#catatanrujukan').val()
            diagRujukan = $('#kodediagnosa').val()
            tipeRujukan = $('#tiperujukan').val()
            poliRujukan = $('#kodepolirujukan').val()
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nosep,
                    tglRujukan,
                    tglRencanaKunjungan,
                    ppkDirujuk,
                    jnsPelayanan,
                    catatan,
                    diagRujukan,
                    tipeRujukan,
                    poliRujukan
                },
                url: '<?= route('simpanrujukan') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(data) {
                    if(data.kode == 200)
                    {
                        spinner.hide()
                        alert('rujukan berhasil disimpan !')
                    }else if (data.kode == 500) {
                        spinner.hide()
                        alert(data.message)
                    }else{
                        spinner.hide()
                        alert(data.message)
                    }
                }
            });
        }
        function get_list_rujukan()
        {          
            tgl_awal = $('#tanggalawal_rj').val()
            tgl_akhir = $('#tanggalakhir_rj').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tgl_awal,
                    tgl_akhir
                },
                url: '<?= route('vclaimlistrujukan_keluar') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.list_rujukan_keluar').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
    </script>
@endsection
