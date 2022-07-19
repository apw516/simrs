@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cari Surat Kontrol & SPRI</h1>
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
            <div class="row">
                <div class="col-md-5">
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Berdasarkan Nomor Surat</label>
                            <input type="text" class="form-control" id="nomorsuratpencarian"
                                placeholder="Ketik nomor surat ...">
                        </div>
                        <div class="col-sm-6 form-inline">
                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1"></label>
                                <button type="submit" class="btn btn-primary" onclick="vclaim_carisurat_kontrol()"> <i
                                        class="bi bi-search-heart"></i> Cari </button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Berdasarkan Nomor kartu</label>
                            <input type="text" class="form-control" id="nomorkartucarisurat"
                                placeholder="nomor kartu ...">
                            <select id="bulan" class="form-control">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
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
                            <select id="tahun" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                            <select id="filter" class="form-control">
                                <option value="">-- Filter --</option>
                                <option value="1">tgl entri</option>
                                <option value="2">tgl kontrol</option>
                            </select>
                        </div>
                        <div class="col-sm-6 form-inline">
                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1"></label>
                                <button type="submit" class="btn btn-primary" onclick="vclaim_carisurat_kontrol_peserta()">
                                    <i class="bi bi-search-heart"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1" class="text-sm">Berdasarkan Data Rumah Sakit</label>
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tglawalcari_surkon" placeholder="tanggal awal">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tglakhircari_surkon" placeholder="tanggal akhir">
                            <select id="filter2" class="form-control">
                                <option value="">-- Filter --</option>
                                <option value="1">tgl entri</option>
                                <option value="2">tgl kontrol</option>
                            </select>
                        </div>
                        <div class="col-sm-6 form-inline">
                            <div class="form-group mt-4">
                                <label for="exampleInputEmail1"></label>
                                <button type="submit" class="btn btn-primary" onclick="vclaim_carisurat_kontrol_rs()"> <i
                                        class="bi bi-search-heart"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="viewsurkon">

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_hasilpencarian">
            </div>
        </div>
    </section>
    <script>
        function vclaim_carisurat_kontrol() {
            nomorpencarian = $('#nomorsuratpencarian').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorpencarian
                },
                url: '<?= route('vclaimcarisuratkontrolpeserta') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.viewsurkon').html(response);
                }
            });
        }

        function vclaim_carisurat_kontrol_peserta() {
            nomorpencarian = $('#nomorkartucarisurat').val()
            bulan = $('#bulan').val()
            tahun = $('#tahun').val()
            filter = $('#filter').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorpencarian,
                    bulan,
                    tahun,
                    filter,
                },
                url: '<?= route('vclaimcarisuratkontrolpeserta_bycard') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.viewsurkon').html(response);
                }
            });
        }

        function vclaim_carisurat_kontrol_rs() {
            tglawalcari_surkon = $('#tglawalcari_surkon').val()
            tglakhircari_surkon = $('#tglakhircari_surkon').val()
            filter = $('#filter2').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglawalcari_surkon,
                    tglakhircari_surkon,
                    filter,
                },
                url: '<?= route('vclaimcarisuratkontrol_byrs') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.viewsurkon').html(response);
                }
            });
        }
    </script>
    <!-- Modal -->
    <div class="modal fade" id="modaleditsurkon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Surat Kontrol / SPRI </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Kartu BPJS</label>
                        <input type="email" class="form-control" id="nomorkartu_update" value=""
                            placeholder="masukan nomor kartu / sep ...">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input type="email" class="form-control" id="nama_update" value=""
                            placeholder="masukan nomor kartu / sep ...">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Surat Kontrol / SPRI</label>
                        <input type="email" class="form-control" id="nomorsuratkontrol_update" value=""
                            placeholder="masukan nomor kartu / sep ...">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor SEP</label>
                        <input type="email" class="form-control" id="nomorsep_update" value=""
                            placeholder="masukan nomor kartu / sep ...">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Rencana Kontrol</label>
                        <input type="email" class="form-control datepicker" id="tanggalkontrol_update"
                            placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Poli Kontrol</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                id="polikontrol_update">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                id="kodepolikontrol_update">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                    data-target="#modalpilihpoli" onclick="caripolikontrol2()">Cari Poli</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Dokter</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="dokterkontrol_update">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="jenis">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="kodedokterkontrol_update">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                    data-target="#modalpilihdokter" onclick="caridokterkontrol2()">Cari Dokter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updatesuratkontrol_()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function updatesuratkontrol_() {
        jenissurat = $('#jenis').val()
        nomorsurat = $('#nomorsuratkontrol_update').val()
        nomorkartu = $('#nomorsep_update').val()
        tanggalkontrol = $('#tanggalkontrol_update').val()
        kodepolikontrol = $('#kodepolikontrol_update').val()
        kodedokterkontrol = $('#kodedokterkontrol_update').val()
        spinner = $('#loader');
        spinner.show();
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jenissurat,
                nomorsurat,
                nomorkartu,
                kodedokterkontrol,
                kodepolikontrol,
                tanggalkontrol
            },
            url: '<?= route('updatesuratkontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(data) {
                spinner.hide();
                if (data.metaData.code == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: data.metaData.message,
                    })
                    location.reload()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.metaData.message,
                    })
                }
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }

    function caripolikontrol2() {
        spinner = $('#loader');
        spinner.show();
        jenis = $('#jenis').val()
        if (jenis == 2) {
            nomor = $('#nomorsep_update').val()
        } else {
            nomor = $('#nomorkartu_update').val()
        }
        tanggal = $('#tanggalkontrol_update').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jenis,
                nomor,
                tanggal
            },
            url: '<?= route('caripolikontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vpolikontrol').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }

    function caridokterkontrol2() {
        spinner = $('#loader');
        spinner.show();
        jenis = $('#jenis').val()
        kodepoli = $('#kodepolikontrol_update').val()
        tanggal = $('#tanggalkontrol_update').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jenis,
                kodepoli,
                tanggal
            },
            url: '<?= route('caridokterkontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vdokterkontrol').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }
</script>
