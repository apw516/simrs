@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pendaftaran</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Riwayat pelayanan user</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="card ">
            <div class="card-header bg-success">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <h4>Riwayat Pelayanan by.User</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Tanggal awal</label>
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tanggalawal" placeholder="Tanggal sep ..">
                        </div>
                        <div class="col-sm-4">
                            <label for="">Tanggal akhir</label>
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tanggalakhir" placeholder="Tanggal sep ..">
                        </div>
                        <div class="col-sm-2">
                            <label for="">Jenis pasien</label>
                            <select class="form-control" id="jenispasien">
                                <option value="1">Semua Pasien</option>
                                <option value="2">Pasien Baru</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for=""></label>
                            <button type="submit" data-toggle="collapse" href="#cardriwayatpelayanan"
                                class="btn btn-dark mt-4 btn-lg" onclick="caririwayatdaftar()">Cari Riwayat</button>

                        </div>
                    </div>
                </div>
                <div class="vriwayatdaftar">
                    <table id="tabelriwayatpelayanan_local" class="table table-sm text-xs table-bordered">
                        <thead>
                            <th>Kunjungan ke - </th>
                            <th>nomor rm</th>
                            {{-- <th>kode kunjungan</th> --}}
                            <th>tgl masuk</th>
                            <th>tgl keluar</th>
                            <th>nama</th>
                            <th>penjamin</th>
                            <th>unit</th>
                            <th>dokter</th>
                            <th>user</th>
                            <th>no sep</th>
                            <th>--</th>
                        </thead>
                        <tbody>
                            @foreach ($datakunjungan as $d)
                                @if (auth()->user()->id_simrs == $d->pic)
                                    <tr>
                                        <td>{{ $d->Kun }}</td>
                                        <td>{{ $d->no_rm }}</td>
                                        {{-- <td>{{ $d->kode_kunjungan }}</td> --}}
                                        <td>{{ $d->tgl_masuk }}</td>
                                        <td>{{ $d->tgl_keluar }}</td>
                                        <td>{{ $d->nama_px }}</td>
                                        <td>{{ $d->nama_penjamin }}</td>
                                        <td>{{ $d->nama_unit }}</td>
                                        <td>{{ $d->dokter }}</td>
                                        {{-- <td>{{ $d->status }}</td> --}}
                                        <td>{{ $d->nama_user }}</td>
                                        <td>{{ $d->no_sep }}</td>
                                        <td>
                                            <button class="badge badge-primary detailkunjungan"
                                                nomorrm ="{{ $d->no_rm }}" kodekunjungan="{{ $d->kode_kunjungan }}"
                                                data-placement="right" title="detail"><i class="bi bi-eye text-sm"
                                                    data-toggle="modal" data-target="#detailkunjungan"></i></button>
                                            <button class="badge badge-danger batal"
                                                kodekunjungan="{{ $d->kode_kunjungan }}" data-placement="right"
                                                title="batal periksa"><i class="bi bi-trash text-sm"></i></button>
                                            {{-- <button class="badge badge-success pulangkan" nama="{{ $d->nama_px }}"
                                        kodekunjungan2="{{ $d->kode_kunjungan }}" data-placement="right"
                                        title="pulangkan pasien" data-toggle="modal" data-target="#modalpulangkanpasien"><i
                                            class="bi bi-pencil-square text-sm"></i></button>
                                </td> --}}
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalpulangkanpasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pulangkan pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div class="formupdate_tgl_pulang"> --}}
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama pasien</label>
                            <input readonly class="form-control" id="nama_pasien">
                            <input hidden readonly class="form-control" id="kode_kunjungan_simrs">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Status pulang</label>
                            <select class="form-control" id="status_pulang2" onchange="gantistatuspulang2()">
                                @foreach ($alasan as $a)
                                    <option value="{{ $a->kode }}">{{ $a->alasan_pulang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal pulang</label>
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="pulang_tanggal2">
                        </div>
                        <div hidden id="formmeninggal">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal meninggal</label>
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                    id="tanggal_meninggal2" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nomor Surat Meninggal</label>
                                <input type="text" class="form-control" id="surat_meninggal2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nomor LP Manual</label>
                            <input type="text" class="form-control" id="nomor_lp_manual2">
                            <small id="emailHelp" class="form-text text-muted">Diisi jika sep KLL.</small>
                        </div>
                    </form>
                    {{-- </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="pulangkanpasien()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#tabelriwayatpelayanan_local").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 20,
                "searching": true,
                "dom": 'Bfrtip',
                "order": [
                    [1, "desc"]
                ],
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
        });

        function caririwayatdaftar() {
            tanggalawal = $('#tanggalawal').val()
            tanggalakhir = $('#tanggalakhir').val()
            jenispasien = $('#jenispasien').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggalakhir,
                    tanggalawal,jenispasien
                },
                url: '<?= route('caririwayatpelayanan_user') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vriwayatdaftar').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
        $('#tabelriwayatpelayanan_local').on('click', '.detailkunjungan', function() {
            spinner = $('#loader')
            spinner.show();
            kodekunjungan = $(this).attr('kodekunjungan')
            nomorrm = $(this).attr('nomorrm')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan,
                    nomorrm
                },
                url: '<?= route('detailkunjungan') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewdetailkunjungan').html(response)
                }
            });
        });
        $('#tabelriwayatpelayanan_local').on('click', '.batal', function() {
            kodekunjungan = $(this).attr('kodekunjungan')
            Swal.fire({
                title: 'batal periksa ...',
                text: "data pendaftaran akan dibatalkan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batal periksa',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    spinner = $('#loader')
                    spinner.show()
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            kodekunjungan,
                        },
                        dataType: 'Json',
                        Async: true,
                        url: '<?= route('batalperiksa') ?>',
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
                                    title: 'Berhasil dibatalkan ...',
                                })
                                location.reload()
                            }
                        }
                    });
                }
            });
        });
        $('#tabelriwayatpelayanan_local').on('click', '.pulangkan', function() {
            nama = $(this).attr('nama')
            kodekunjungan = $(this).attr('kodekunjungan2')
            $('#kode_kunjungan_simrs').val(kodekunjungan)
            $('#nama_pasien').val(nama)
        })

        function gantistatuspulang2() {
            status = $('#status_pulang2').val()
            if (status == 6 || status == 7) {
                $('#formmeninggal').removeAttr('hidden', true)
            } else {
                $('#formmeninggal').attr('hidden', true)
            }
        }

        function pulangkanpasien() {
            spinner = $('#loader');
            spinner.show();
            kodekunjungan = $('#kode_kunjungan_simrs').val()
            status = $('#status_pulang2').val()
            tanggalpulang = $('#pulang_tanggal2').val()
            tanggalmeninggal = $('#tanggal_meninggal2').val()
            suratmeninggal = $('#surat_meninggal2').val()
            nomorlp = $('#nomor_lp_manual2').val()
            if (status != 6 || status != 7) {
                tanggalmeninggal = ''
                suratmeninggal = ''
            }
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan,
                    status,
                    tanggalpulang,
                    tanggalmeninggal,
                    suratmeninggal,
                    nomorlp
                },
                url: '<?= route('updatepulang') ?>',
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
                            title: 'Pasien dipulangkan ...',
                        })
                        location.reload()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.metaData.message
                        })
                    }
                }
            });
        }
    </script>
@endsection
