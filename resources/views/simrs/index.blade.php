@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="col-sm-5">
                <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control" id="pencariansep" placeholder="Cari SEP ...">
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="carisep()"><i class="bi bi-search-heart"  data-toggle="modal" data-target="#modaleditsep"></i></button>
                    </div>
                  </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SEP</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data SEP</li>
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
                <h4>List Approval Pengajuan SEP </h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tanggalpelayanan" placeholder="Tanggal Pelayanan ..">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-dark mb-2" onclick="getlisfinger()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="vlistajuan">
                        <table id="tabellistfinger" class="table table-bordered table-sm text-xs mt-3">
                            <thead>
                                <th>nomor kartu</th>
                                <th>Nomor SEP</th>
                            </thead>
                            <tbody>
                                @if($listajuan->metaData->code == 200)
                                    @foreach ($listajuan->response->list as $d )
                                        <tr>
                                            <td>{{ $d->noKartu}}</td>
                                            <td>{{ $d->noSEP}}</td>
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
                <h4>Riwayat Pelayanan Peserta </h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="nomorkartu" placeholder="masukan nomor kartu ...">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tanggalawal" placeholder="Tanggal awal ..">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tanggalakhir" placeholder="Tanggal akhir ..">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-dark mb-2" onclick="caririwayatseppeserta()">Cari
                                Riwayat</button>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="vkunjunganpasien">
                        <h5>Rawat Jalan </h5>
                        <table id="kunjunganpasienrawatjalan" class="table table-bordered table-sm text-xs mt-3">
                            <thead>
                                <th>Nama</th>
                                <th>nomor kartu</th>
                                <th>nomor sep</th>
                                <th>nomor rujukan</th>
                                <th>jns pelayanan</th>
                                <th>poli</th>
                                <th>tgl sep</th>
                                <th>tgl pulang sep</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <h5>Rawat Inap </h5>
                        <table id="kunjunganpasienrawatinap" class="table table-bordered table-sm text-xs mt-3">
                            <thead>
                                <th>Nama</th>
                                <th>nomor kartu</th>
                                <th>nomor sep</th>
                                <th>nomor rujukan</th>
                                <th>jns pelayanan</th>
                                <th>poli</th>
                                <th>tgl sep</th>
                                <th>tgl pulang sep</th>
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
                <h4>Riwayat Kunjungan</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tanggalsep"
                                placeholder="Tanggal sep ..">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" data-toggle="collapse" href="#cardriwayatpelayanan"
                                class="btn btn-dark mb-2" onclick="caririwayatsep()">Cari Riwayat</button>

                        </div>
                    </div>
                </div>
                <div class="vkunjungan">
                    <h5>Rawat Jalan </h5>
                    <table id="kunjunganrawatjalan" class="table table-bordered table-sm text-xs">
                        <thead>
                            <th>Nama</th>
                            <th>nomor kartu</th>
                            <th>nomor sep</th>
                            <th>nomor rujukan</th>
                            <th>jns pelayanan</th>
                            <th>poli</th>
                            <th>tgl sep</th>
                            <th>tgl pulang sep</th>
                            <th>
                                ===
                            </th>
                        </thead>
                        <tbody>
                            @if ($rajal->metaData->code == 200)
                                @foreach ($rajal->response->sep as $s)
                                    <tr>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->noKartu }}</td>
                                        <td>{{ $s->noSep }}</td>
                                        <td>{{ $s->noRujukan }}</td>
                                        <td>{{ $s->jnsPelayanan }}</td>
                                        <td>{{ $s->poli }}</td>
                                        <td>{{ $s->tglSep }}</td>
                                        <td>{{ $s->tglPlgSep }}</td>
                                        <td>
                                            <button class="badge badge-primary detailsep" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="detail sep" data-toggle="modal"
                                                data-target="#exampleModal"><i class="bi bi-eye text-sm"></i></button>
                                            <button class="badge badge-danger hapussep" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="hapus sep"><i
                                                    class="bi bi-trash text-sm"></i></button>
                                            <button class="badge badge-warning editsep" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="edit sep" data-toggle="modal"
                                                data-target="#modaleditsep"><i
                                                    class="bi bi-pencil-square text-sm"></i></button>
                                        </td>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <h5>Rawat Inap </h5>
                    <table id="kunjunganrawatinap" class="table table-bordered table-sm text-xs">
                        <thead>
                            <th>Nama</th>
                            <th>nomor kartu</th>
                            <th>nomor sep</th>
                            <th>nomor rujukan</th>
                            <th>jns pelayanan</th>
                            <th>poli</th>
                            <th>tgl sep</th>
                            <th>tgl pulang sep</th>
                            <th>===</th>
                        </thead>
                        <tbody>
                            @if ($ranap->metaData->code == 200)
                                @foreach ($ranap->response->sep as $s)
                                    <tr>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->noKartu }}</td>
                                        <td>{{ $s->noSep }}</td>
                                        <td>{{ $s->noRujukan }}</td>
                                        <td>{{ $s->jnsPelayanan }}</td>
                                        <td>{{ $s->poli }}</td>
                                        <td>{{ $s->tglSep }}</td>
                                        <td>{{ $s->tglPlgSep }}</td>
                                        <td>
                                            <button class="badge badge-primary  detailsep" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="detail sep"><i class="bi bi-eye text-sm"
                                                    data-toggle="modal" data-target="#exampleModal"></i></button>

                                            <button class="badge badge-danger hapussep" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="hapus sep"><i
                                                    class="bi bi-trash text-sm"></i></button>
                                            <button class="badge badge-warning editsep" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="edit sep" data-toggle="modal"
                                                data-target="#modaleditsep"><i
                                                    class="bi bi-pencil-square text-sm"></i></button>
                                                          
                                            <button class="badge badge-success pulangkan" nomorsep="{{ $s->noSep }}"
                                                data-placement="right" title="edit tgl pulangsep" data-toggle="modal"
                                                data-target="#modalupdatetglpulang"><i
                                                    class="bi bi-pencil-square text-sm"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card collapsed-card">
            <div class="card-header bg-success">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <h4>List Update Tanggal Pulang </h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <select class="form-control" id="bulan">
                                    <option>-- Pilih Bulan --</option>
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
                                    <option value="11">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="tahun" placeholder="masukan tahun pencarian ...">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-dark mb-2" onclick="getlisttanggalpulang()">show
                                list</button>
                        </div>
                    </div>
                </div>
                <div class="vtanggalpulang">
                    <h5>List tanggal pulang </h5>
                    <table id="tabeltanggalpulang" class="table table-bordered table-sm text-xs mt-3">
                        <thead>
                            <th>Nama</th>
                            <th>nomor kartu</th>
                            <th>jns pelayanan</th>
                            <th>nomor sep</th>
                            <th>nomor sep updating</th>
                            <th>status</th>
                            <th>tgl meninggal</th>
                            <th>no. surat</th>
                            <th>keterangan</th>
                            <th>tgl sep</th>
                            <th>tgl pulang</th>
                            <th>===</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            $("#tabellistfinger").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [[ 1, "desc" ]]
            })
        });
        $(function() {
            $("#tabeltanggalpulang").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [[ 6, "desc" ]]
            })
        });
        $(function() {
            $("#kunjunganpasienrawatjalan").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [[ 6, "desc" ]]
            })
        });
        $(function() {
            $("#kunjunganpasienrawatinap").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [[ 6, "desc" ]]
            })
        });
        $(function() {
            $("#kunjunganrawatjalan").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [[ 6, "desc" ]]
            })
        });
        $(function() {
            $("#kunjunganrawatinap").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [[ 6, "desc" ]]
            })
        });

        function getlisttanggalpulang() {
            bulan = $('#bulan').val()
            tahun = $('#tahun').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan,
                    tahun
                },
                url: '/simrsvclaim/listtanggalpulang',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vtanggalpulang').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
        function getlisfinger (){
            tanggalpelayanan = $('#tanggalpelayanan').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalpelayanan
                },
                url: '/simrsvclaim/carilistfinger',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vlistajuan').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
        function caririwayatseppeserta() {
            tglawal = $('#tanggalawal').val()
            tglakhir = $('#tanggalakhir').val()
            nomorkartu = $('#nomorkartu').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglawal,
                    tglakhir,
                    nomorkartu
                },
                url: '/simrsvclaim/carikunjungansep_peserta',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vkunjunganpasien').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }

        function caririwayatsep() {
            tanggalsep = $('#tanggalsep').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalsep
                },
                url: '/simrsvclaim/carikunjungansep',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vkunjungan').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
        //detail sep
        $('#kunjunganrawatjalan').on('click', '.detailsep', function() {
            spinner = $('#loader')
            spinner.show();
            nomorsep = $(this).attr('nomorsep')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorsep,
                },
                url: '/simrsvclaim/detailsep',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewdetailsep').html(response)
                }
            });
        });
        $('#kunjunganrawatinap').on('click', '.detailsep', function() {
            spinner = $('#loader')
            spinner.show();
            nomorsep = $(this).attr('nomorsep')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorsep,
                },
                url: '/simrsvclaim/detailsep',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewdetailsep').html(response)
                }
            });
        });
        //hapus sep
        $('#kunjunganrawatjalan').on('click', '.hapussep', function() {
            nomorsep = $(this).attr('nomorsep')
            Swal.fire({
                title: 'Hapus SEP ...',
                text: "Apakah anda ingin menghapus SEP ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus SEP',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    spinner = $('#loader')
                    spinner.show()
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            nomorsep,
                        },
                        dataType: 'Json',
                        Async: true,
                        url: '/simrsvclaim/hapussep',
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
                                    title: 'SEP berhasil dihapus',
                                })
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
        $('#kunjunganrawatinap').on('click', '.hapussep', function() {
            nomorsep = $(this).attr('nomorsep')
            Swal.fire({
                title: 'Hapus SEP ...',
                text: "Apakah anda ingin menghapus SEP ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus SEP',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    spinner = $('#loader')
                    spinner.show()
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            nomorsep,
                        },
                        dataType: 'Json',
                        Async: true,
                        url: '/simrsvclaim/hapussep',
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
                                    title: 'SEP berhasil dihapus',
                                })
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
        //update sep
        $('#kunjunganrawatjalan').on('click', '.editsep', function() {
            spinner = $('#loader')
            spinner.show();
            nomorsep = $(this).attr('nomorsep')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorsep,
                },
                url: '/simrsvclaim/update',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewupdatesep').html(response)
                }
            });
        });
        $('#kunjunganrawatinap').on('click', '.editsep', function() {
            spinner = $('#loader')
            spinner.show();
            nomorsep = $(this).attr('nomorsep')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorsep,
                },
                url: '/simrsvclaim/update',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewupdatesep').html(response)
                }
            });
        });

        $('#kunjunganrawatinap').on('click', '.pulangkan', function() {
        nomorsep = $(this).attr('nomorsep')
       $('#pulang_nomorsep').val(nomorsep)
    });
    </script>
@endsection
