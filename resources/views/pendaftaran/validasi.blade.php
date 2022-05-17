@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-sm-5">
                    <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" id="pencariansep" placeholder="Cari SEP ...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="carisep()"
                                data-toggle="modal" data-target="#modaleditsep"><i class="bi bi-search-heart"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 mt-3">
                    <button class="btn btn-warning float-sm-right" data-toggle="modal" data-target="#modalpengajuansep"> <i
                            class="bi bi-send-plus-fill"></i> PENGAJUAN SEP</button>
                    <button class="btn btn-success float-sm-right mr-2" data-toggle="modal"
                        data-target="#modalformpasienbaru"><i class="bi bi-person-plus"></i> PASIEN BARU</button>
                </div>
            </div> --}}

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Validasi Pasien Ranap</h1>
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
            <div class="card-body">
                {{-- <div class="container-fluid mb-4">
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
                            <label for=""></label>
                            <button type="submit" data-toggle="collapse" href="#cardriwayatpelayanan"
                                class="btn btn-dark mt-4 btn-lg" onclick="caririwayatdaftar()">Cari Riwayat</button>

                        </div>
                    </div>
                </div> --}}
                <div class="vriwayatdaftar">
                    <table id="tabelriwayatpelayanan_local" class="table table-sm text-xs table-bordered">
                        <thead>
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
                                @if ($d->nama_penjamin != 'PRIBADI')
                                    <tr @if ($d->nama_penjamin != 'PRIBADI' && $d->no_sep == '') class="bg-warning" @endif>
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
                                            <button class="badge badge-primary tombolvalidasi" tglmasuk ={{ $d->tgl_masuk }} nomorrm="{{ $d->no_rm }}"
                                                kodekunjungan="{{ $d->kode_kunjungan }}" naikkelas="{{ $d->crad }}"
                                                data-placement="right" title="detail">Validasi</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="formvalidasi">
                </div>
        </div>
    </section>
    <script>
        $(function() {
            $("#tabelriwayatpelayanan_local").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 5,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tabelriwayatpelayanan_local').on('click', '.tombolvalidasi', function() {
            spinner = $('#loader')
            spinner.show();
            kodekunjungan = $(this).attr('kodekunjungan')
            nomorrm = $(this).attr('nomorrm')
            tglmasuk = $(this).attr('tglmasuk')
            naikkelas = $(this).attr('naikkelas')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan,
                    nomorrm,
                    tglmasuk,
                    naikkelas
                },
                url: '<?= route('formvalidasi') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.formvalidasi').html(response)
                }
            });
        });
    </script>
@endsection
