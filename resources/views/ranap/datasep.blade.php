@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pasien Rawat Inap</h1>
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
            <table id="tabelpasienranappulang" class="table table-sm table-bordered text-xs">
                <thead>
                    <th>Nomor BPJS</th>
                    <th>Nomor RM</th>
                    <th>Nomor SEP</th>
                    {{-- <th>Tgl Masuk</th> --}}
                    <th>Tgl Keluar</th>
                    <th>Alasan Pulang</th>
                    <th>Nama Pasien</th>
                    <th>Unit</th>
                    {{-- <th>Kamar</th>
                    <th>Bed</th> --}}
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($datapasien as $d)
                        <tr>
                            <td>{{ $d->no_Bpjs }}</td>
                            <td>{{ $d->no_rm }}</td>
                            <td>{{ $d->no_sep }}</td>
                            <td>{{ $d->tgl_keluar }}</td>
                            <td>{{ $d->alasan_pulang }} | {{ $d->keterangan2 }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->unit }}</td>
                            {{-- <td>{{ $d->kamar }}</td>
                            <td>{{ $d->no_bed }}</td> --}}
                            <td class="text-center">
                                <button kodekunjungan="{{ $d->kode_kunjungan }}" nama="{{ $d->nama }}"
                                    nomorsep="{{ $d->no_sep }}" rm="{{ $d->no_rm }}" bpjs="{{ $d->no_Bpjs }}"
                                    class="badge badge-danger editkunjungan" data-toggle="tooltip" data-placement="top"
                                    title="edit nomor sep ..."><i class="bi bi-pencil-square"></i></button>
                                <button rm="{{ $d->no_rm }}" bpjs="{{ $d->no_Bpjs }}"
                                    class="badge badge-info infopasien" data-toggle="tooltip" data-placement="top"
                                    title="Info pasien ..."><i class="bi bi-info-square"></i></button>
                                <button kodekunjungan="{{ $d->kode_kunjungan }}" tglpulang="{{ $d->tgl_keluar }}""
                                    alasan="{{ $d->kode }}" nomorsep="{{ $d->no_sep }}"
                                    nama="{{ $d->nama }}" class="badge badge-warning pulangsep" data-toggle="tooltip"
                                    data-placement="top" title="Pulangkan SEP ..."><i class="bi bi-house-door"></i></button>
                                {{-- <button nomorsep="{{ $d->no_sep }}" class="badge badge-success buatsuratkontrolinap"
                                    data-toggle="tooltip" data-placement="top" title="Buat surat kontrol ..."><i
                                        class="bi bi-envelope-plus"></i></button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="infopasienranap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Info Pasien</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body infopx">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalpasienmeninggal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pasien Meninggal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Nomor SEP</label>
                            <div class="col-sm-8">
                                <input readonly type="" class="form-control" id="nomorsep_meninggal">
                                <input hidden type="" class="form-control" id="alasanmeninggal">
                                <input hidden type="" class="form-control" id="kodekunjunganmeninggal">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Tanggl Pulang</label>
                            <div class="col-sm-8">
                                <input readonly type="" class="form-control" id="tanggal_pulangmeninggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Nomor Surat Meninggal</label>
                            <div class="col-sm-8">
                                <input type="" class="form-control" id="nomorsuratmeninggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Tanggal Meninggal</label>
                            <div class="col-sm-8">
                                <input type="" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                    id="tanggalmeninggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">No Laporan Polisi</label>
                            <div class="col-sm-8">
                                <input type="" class="form-control" id="nomorlaporanmeninggal"
                                    placeholder="isi nomor laporan jika sep kll ...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="updatesep_meninggal()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalpasienpulang" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Pasien Pulang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Nomor SEP</label>
                            <div class="col-sm-8">
                                <input readonly type="" class="form-control" id="nomorsep_pulang">
                                <input hidden type="" class="form-control" id="alasanpulang">
                                <input hidden type="" class="form-control" id="kodekunjunganpulang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Tanggal Pulang</label>
                            <div class="col-sm-8">
                                <input readonly type="" class="form-control" id="tanggal_pulangpasien">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">No Laporan Polisi</label>
                            <div class="col-sm-8">
                                <input type="" class="form-control" id="nomorlaporan"
                                    placeholder="isi nomor laporan jika sep kll ...">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="updatesep_pulang()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalsurkonpasca" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Buat Surat Kontrol Pasca Rawat </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jenis Surat</label>
                            <select class="form-control" id="jenissurat_kontrolpasca">
                                <option value="2">SURAT KONTROL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                            <input type="" class="form-control datepicker" id="tglkontrol_pasca"
                                placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor SEP</label>
                            <input type="" class="form-control" id="seppasca" value=""
                                placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Poli Kontrol</label>
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                    id="polikontrolpasca">
                                <input hidden readonly type="text" class="form-control"
                                    placeholder="Klik cari poli ..." id="kodepolikontrolpasca">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                        data-target="#modalpilihpolipasca" onclick="caripolikontrolpasca()">Cari
                                        Poli</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Dokter</label>
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                    id="dokterkontrolpasca">
                                <input hidden readonly type="text" class="form-control"
                                    placeholder="Klik cari dokter ..." id="kodedokterkontrolpasca">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                        data-target="#modalpilihdokterpasca" onclick="caridokterkontrolpasca()">Cari
                                        Dokter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="buatsuratkontrol()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalpilihpolipasca" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pilih Poli</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body vpolikontrol">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalpilihdokterpasca" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pilih Dokter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body vdokterkontrol">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modaleditkunjungan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Nomor SEP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-4 col-form-label text-xs">Nomor SEP</label>
                            <div class="col-sm-8">
                                <input type="" class="form-control" id="NOSEPUPDATE">
                                <input hidden type="" class="form-control" id="KODEKUNJUNGAN">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="editkunjungan()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            $("#tabelpasienranappulang").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 8,
                "searching": true,
                "order": [
                    [3, "desc"]
                ]
            })
        });
        $('#tabelpasienranappulang').on('click', '.pulangsep', function() {
            kodekunjungan = $(this).attr('kodekunjungan')
            nomorsurat = $(this).attr('nomorsep')
            namapasien = $(this).attr('nama')
            alasan = $(this).attr('alasan')
            tglpulang = $(this).attr('tglpulang')
            if (alasan == 6 || alasan == 7) {
                $("#modalpasienmeninggal").modal();
                $('#alasanmeninggal').val(alasan)
                $('#nomorsep_meninggal').val(nomorsurat)
                $('#tanggal_pulangmeninggal').val(tglpulang)
                $('#kodekunjunganmeninggal').val(kodekunjungan)
            } else {
                $("#modalpasienpulang").modal();
                $('#alasanpulang').val(alasan)
                $('#nomorsep_pulang').val(nomorsurat)
                $('#tanggal_pulangpasien').val(tglpulang)
                $('#kodekunjunganpulang').val(kodekunjungan)

            }

        });
        $('#tabelpasienranappulang').on('click', '.buatsuratkontrolinap', function() {
            nomorsep = $(this).attr('nomorsep')
            $('#seppasca').val(nomorsep)
            $("#modalsurkonpasca").modal();
        })
        $('#tabelpasienranappulang').on('click', '.infopasien', function() {
            $("#infopasienranap").modal();
            spinner = $('#loader')
            spinner.show()
            rm = $(this).attr('rm')
            bpjs = $(this).attr('bpjs')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm,
                    bpjs
                },
                url: '<?= route('infopasienranap') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.infopx').html(response)
                }
            });
        })
        $('#tabelpasienranappulang').on('click', '.editkunjungan', function() {
            $("#modaleditkunjungan").modal();
            $('#NOSEPUPDATE').val($(this).attr('nomorsep'))
            $('#KODEKUNJUNGAN').val($(this).attr('kodekunjungan'))
        })

        function updatesep_meninggal() {
            spinner = $('#loader')
            spinner.show()
            kodekunjungan = $('#kodekunjunganmeninggal').val()
            nolp = $('#nomorlaporanmeninggal').val()
            alasan = $('#alasanmeninggal').val()
            nomorsurat = $('#nomorsep_meninggal').val()
            tglpulang = $('#tanggal_pulangmeninggal').val()
            suratmeninggal = $('#nomorsuratmeninggal').val()
            tglmeninggal = $('#tanggalmeninggal').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorsurat,
                    nolp,
                    kodekunjungan,
                    alasan,
                    tglpulang,
                    suratmeninggal,
                    tglmeninggal
                },
                dataType: 'Json',
                Async: true,
                url: '<?= route('ranapupdatesep') ?>',
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
                            title: 'Update tanggal pulang sep Berhasil ...',
                        })
                        $('#modalpasienmeninggal').modal('hide');
                        // $("#modalsurkonpasca").modal();
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

        function updatesep_pulang() {
            spinner = $('#loader')
            spinner.show()
            kodekunjungan = $('#kodekunjunganpulang').val()
            nolp = $('#nomorlaporan').val()
            alasan = $('#alasanpulang').val()
            nomorsurat = $('#nomorsep_pulang').val()
            tglpulang = $('#tanggal_pulangpasien').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorsurat,
                    nolp,
                    kodekunjungan,
                    alasan,
                    tglpulang,
                },
                dataType: 'Json',
                Async: true,
                url: '<?= route('ranapupdatesep') ?>',
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
                            title: 'Update tanggal pulang sep Berhasil,silahkan buat surat kontrol pasca rawat inap ...',
                        })
                        $('#seppasca').val(nomorsurat)
                        $('#modalpasienpulang').modal('hide');
                        $("#modalsurkonpasca").modal();
                        // location.reload()

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.metaData.message,
                        })
                    }
                }
            });
        }

        function caripolikontrolpasca() {
            spinner = $('#loader');
            spinner.show();
            jenis = $('#jenissurat_kontrolpasca').val()
            nomor = $('#seppasca').val()
            tanggal = $('#tglkontrol_pasca').val()
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

        function caridokterkontrolpasca() {
            spinner = $('#loader');
            spinner.show();
            jenis = $('#jenissurat_kontrolpasca').val()
            kodepoli = $('#kodepolikontrolpasca').val()
            tanggal = $('#tglkontrol_pasca').val()
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

        function buatsuratkontrol() {
            spinner = $('#loader');
            spinner.show();
            nomorkartu = $('#seppasca').val()
            jenissurat = $('#jenissurat_kontrolpasca').val()
            tanggalkontrol = $('#tglkontrol_pasca').val()
            polikontrol = $('#polikontrolpasca').val()
            kodepolikontrol = $('#kodepolikontrolpasca').val()
            dokterkontrol = $('#dokterkontrolpasca').val()
            kodedokterkontrol = $('#kodedokterkontrolpasca').val()
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
                        Swal.fire({
                            title: 'Surat kontrol berhasil disimpan!',
                            text: "Cetak surat kontrol ? " + data.response.noSuratKontrol,
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Cetak!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open('cetaksurkon/' + data.response.noSuratKontrol);
                                location.reload()
                            } else {
                                location.reload()
                            }
                        })
                    } else {
                        Swal.fire(
                            'Gagal!',
                            data.metaData.message,
                            'error'
                        )
                    }
                }
            });
        }

        function editkunjungan() {
            spinner = $('#loader');
            spinner.show();
            sep = $('#NOSEPUPDATE').val()
            kodekunjungan = $('#KODEKUNJUNGAN').val()
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    sep,
                    kodekunjungan
                },
                url: '<?= route('editkunjungan') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(data) {
                    spinner.hide();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Update nomor sep berhasil !',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    location.reload()
                }
            });
        }
    </script>
@endsection
