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
                            <button disabled class="btn btn-outline-primary" type="button" id="button-addon2" onclick="carisuratkontrol()"
                            data-toggle="modal"
                            data-target="#modaleditsuratkontrol"><i class="bi bi-search-heart"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 mt-3">
                    <button class="btn btn-primary float-sm-right mr-2" data-toggle="modal" data-target="#staticBackdrop"><i
                            class="bi bi-person-plus"></i> SURAT KONTROL</button>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RENCANA KONTROL</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pendaftaran</li>
                    </ol>
                </div>
                <!-- /.col -->
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
                <h4>Data Surat Kontrol Rumah Sakit</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-2">
                            <input type="text" class="form-control datepicker" id="tanggalawal"
                                data-date-format="yyyy-mm-dd" placeholder="Masukan No kartu ..">
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control datepicker" id="tanggalakhir"
                                data-date-format="yyyy-mm-dd" placeholder="Masukan No kartu ..">
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="filter_rs">
                                <option value="1">Tanggal entry</option>
                                <option value="2" selected>tanggal rencana kontrol</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-dark mb-2" onclick="getsuratkontrol_rs()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="listsuratkontrol_rs">
                        <table id="tabelsuratkontrol_rs" class="table table-bordered table-sm text-xs mt-3">
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
                                <th>---</th>
                            </thead>
                            <tbody>
                                @if ($list->metaData->code == 200)
                                    @foreach ($list->response->list as $d)
                                        <tr>
                                            <td>{{ $d->noKartu }}</td>
                                            <td>{{ $d->nama }}</td>
                                            <td>{{ $d->terbitSEP }}</td>
                                            <td>{{ $d->tglSEP }}</td>
                                            <td>{{ $d->noSuratKontrol }}</td>
                                            <td>{{ $d->jnsPelayanan }}</td>
                                            <td>{{ $d->namaJnsKontrol }}</td>
                                            <td>{{ $d->tglRencanaKontrol }}</td>
                                            <td>{{ $d->tglTerbitKontrol }}</td>
                                            <td>{{ $d->noSepAsalKontrol }}</td>
                                            <td>{{ $d->namaPoliAsal }}</td>
                                            <td>{{ $d->namaPoliTujuan }}</td>
                                            <td>{{ $d->namaDokter }}</td>
                                            <td>
                                                <button nomorsurat="{{ $d->noSuratKontrol }}"
                                                    class="badge badge-danger hapussurat"><i
                                                        class="bi bi-trash"></i></button>
                                                <button tglkontrol="{{ $d->tglRencanaKontrol }}"
                                                    jenissurat="{{ $d->jnsKontrol }}"
                                                    suratkontrol="{{ $d->noSuratKontrol }}"
                                                    nomorsep="{{ $d->noSepAsalKontrol }}"
                                                    nomorkartu="{{ $d->noKartu }}"
                                                    namapolitujuan="{{ $d->namaPoliTujuan }}"
                                                    kodepolitujuan="{{ $d->poliTujuan }}"
                                                    namadokter="{{ $d->namaDokter }}"
                                                    kodedokter="{{ $d->kodeDokter }}"
                                                    class="badge badge-warning editsurat" data-toggle="modal"
                                                    data-target="#modaleditsuratkontrol"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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
                <h4>Surat Kontrol Peserta</h4>
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
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Buat Surat Kontrol / SPRI </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Jenis Surat</label>
                        <select class="form-control" id="jenissurat">
                            <option value="1">SPRI</option>
                            <option value="2">SURAT KONTROL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                        <input type="email" class="form-control datepicker" id="tanggalkontrol"
                            placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Kartu / SEP</label>
                        <input type="email" class="form-control" id="nomorkartukontrol" value=""
                            placeholder="masukan nomor kartu / sep ...">
                        <small id="emailHelp" class="form-text text-danger">masukan nomor kartu untuk pembuatan spri / sep
                            untuk pembuatan surat kontrol</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Poli Kontrol</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                id="polikontrol">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                id="kodepolikontrol">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                    data-target="#modalpilihpoli" onclick="caripolikontrol()">Cari Poli</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Dokter</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="dokterkontrol">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="kodedokterkontrol">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                    data-target="#modalpilihdokter" onclick="caridokterkontrol()">Cari Dokter</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="buatsuratkontrol()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#tabelsuratkontrol_rs").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $(function() {
            $("#tabelsuratkontrol_peserta").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });

        function getsuratkontrol_bycard() {
            noka = $('#nomorkartu').val()
            bulan = $('#bulan').val()
            tahun = $('#tahun').val()
            filter = $('#filter').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    noka,
                    bulan,
                    tahun,
                    filter
                },
                url: '<?= route('vclaimlistsuratkontrol_peserta') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.listsuratkontrol_peserta').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }

        function getsuratkontrol_rs() {
            tanggalawal = $('#tanggalawal').val()
            tanggalakhir = $('#tanggalakhir').val()
            filter = $('#filter_rs').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalawal,
                    tanggalakhir,
                    filter
                },
                url: '<?= route('vclaimlistsuratkontrol_rs') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.listsuratkontrol_rs').html(response);
                }
            });
        }
        $('#tabelsuratkontrol_rs').on('click', '.hapussurat', function() {
            nomorsurat = $(this).attr('nomorsurat')
            Swal.fire({
                title: 'surat kontrol ' + nomorsurat,
                text: "Surat kontrol akan dihapus ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    spinner = $('#loader')
                    spinner.show()
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            nomorsurat,
                        },
                        dataType: 'Json',
                        Async: true,
                        url: '<?= route('vclaimhapussurkon') ?>',
                        error: function(data) {
                            spinner.hide()
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops,silahkan coba lagi',
                            })
                        },
                        success: function(data) {
                            spinner.hide()
                            if (data.metaData.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil dihapus ...',
                                })
                                location.reload()
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.metaData.message,
                                })
                            }
                        }
                    });
                }
            });
        });
        $('#tabelsuratkontrol_rs').on('click', '.editsurat', function() {
            tgl = $(this).attr('tglkontrol')
            jenissurat = $(this).attr('jenissurat')
            suratkontrol = $(this).attr('suratkontrol')
            nomorsep = $(this).attr('nomorsep')
            nomorkartu = $(this).attr('nomorkartu')
            namapolitujuan = $(this).attr('namapolitujuan')
            kodepolitujuan = $(this).attr('kodepolitujuan')
            namadokter = $(this).attr('namadokter')
            kodedokter = $(this).attr('kodedokter')
            if (jenissurat == 1) {
                nomor = nomorkartu
            } else {
                nomor = nomorsep
            }
            $('#editjenissurat').val(jenissurat)
            $('#edittanggalkontrol').val(tgl)
            $('#editnomorkartukontrol').val(nomor)
            $('#editpolikontrol').val(namapolitujuan)
            $('#editkodepolikontrol').val(kodepolitujuan)
            $('#editdokterkontrol').val(namadokter)
            $('#editkodedokterkontrol').val(kodedokter)
            $('#editnomorsurat').val(suratkontrol)
        });
        function buatsuratkontrol() {
            spinner = $('#loader');
            spinner.show();
            nomorkartu = $('#nomorkartukontrol').val()
            jenissurat = $('#jenissurat').val()
            tanggalkontrol = $('#tanggalkontrol').val()
            polikontrol = $('#polikontrol').val()
            kodepolikontrol = $('#kodepolikontrol').val()
            dokterkontrol = $('#dokterkontrol').val()
            kodedokterkontrol = $('#kodedokterkontrol').val()
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorkartu,
                    jenissurat,
                    tanggalkontrol,
                    kodepolikontrol,
                    kodedokterkontrol
                },
                url: '<?= route('buatsuratkontrol') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(data) {
                    spinner.hide();
                    if (data.metaData.code == 200) {
                        alert(data.metaData.message)
                    } else {
                        alert(data.metaData.message)
                    }
                }
            });
        }
    </script>
@endsection
