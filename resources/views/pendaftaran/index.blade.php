@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
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
            </div>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pendaftaran</h1>
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
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorrm" placeholder="nomor RM ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorktp" placeholder="nomor KTP ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_namapasien" placeholder="Nama pasien ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_nomorbpjs" placeholder="nomor BPJS ..">
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="cari_alamat" placeholder="Alamat ..">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary mb-2" onclick="caripasien()"> <i
                            class="bi bi-search-heart"></i> Cari Pasien</button>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="vpasien">
                <table id="tabelpasienbaru" class="table table-bordered table-sm">
                    <thead>
                        <th>Tgl entry</th>
                        <th>Nomor RM</th>
                        <th>NIK</th>
                        <th>No BPJS</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($data_pasien as $p)
                            <tr>
                                <td>{{ date('Y-m-d', strtotime($p['tgl_entry'])) }}</td>
                                <td>{{ $p['no_rm'] }}</td>
                                <td>{{ $p['nik_bpjs'] }}</td>
                                <td>{{ $p['no_Bpjs'] }}</td>
                                <td>{{ $p['nama_px'] }}</td>
                                <td>
                                    @isset($p->Desa)
                                        
                                    {{ $p->Desa->name }}
                                    @endisset
                                    @empty($p->Desa)
                                        null
                                    @endempty
                                </td>
                                <td>
                                    <button class="badge badge-primary daftarumum" rm="{{ $p['no_rm'] }}"
                                        nik="{{ $p['nik_bpjs'] }}">Umum</button>
                                    <button class="badge badge-success daftarbpjs" rm="{{ $p['no_rm'] }}"
                                        noka="{{ $p['no_Bpjs'] }}">Bpjs</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="formpasien">

            </div>
        </div>
    </section>
    <div class="modal fade" id="modalformpasienbaru" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <h4>Form pasien baru</h4>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="card col-sm-5">
                            <div class="col-md-12">
                                <H4 class="mb-3 text-bold text-danger">DATA PASIEN</H4>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor KTP</label>
                                            <input class="form-control" id="nomorktp" placeholder="masukan nomor ktp ...">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor BPJS</label>
                                            <input class="form-control" id="nomorbpjs"
                                                placeholder="masukan nomor bpjs ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Pasien</label>
                                            <input class="form-control" id="namapasien"
                                                placeholder="masukan nama pasien ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tempat</label>
                                            <input class="form-control" id="tempatlahir" placeholder="ketik tempat lahir">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tgl lahir</label>
                                            <input class="form-control datepicker" data-date-format="yyyy-mm-dd" id="tanggallahir" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                                            <select class="form-control" id="jeniskelamin">
                                                <option value="">--Silahkan Pilih--</option>
                                                <option value="L">Laki - Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Agama</label>
                                            <select class="form-control" id="agama">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($agama as $a)
                                                    <option value="{{ $a->ID }}">{{ $a->agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pekerjaan</label>
                                            <select class="form-control" id="pekerjaan">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($pekerjaan as $a)
                                                    <option value="{{ $a->ID }}">{{ $a->pekerjaan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Pendidikan</label>
                                            <select class="form-control" id="pendidikan">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($pendidikan as $a)
                                                    <option value="{{ $a->ID }}">{{ $a->pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nomor Telp</label>
                                            <input class="form-control" id="nomortelp" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-2 text-bold text-danger">Data keluarga</h5>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Keluarga</label>
                                            <input class="form-control" id="namakeluarga" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Hubungan</label>
                                            <select class="form-control" id="hubungankeluarga">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($hubkel as $a)
                                                    <option value="{{ $a->kode }}">{{ $a->nama_hubungan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No Telp</label>
                                            <input class="form-control" id="telpkeluarga" aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <textarea class="form-control" id="alamatkeluarga" aria-describedby="emailHelp"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-sm-5 ml-2">
                            <div class="col-md-12">
                                <H4 class="mb-3 text-bold text-danger">Alamat</H4>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kewarganegaraan</label>
                                            <select class="form-control" id="kewarganegaraan">
                                                <option value="">--Silahkan Pilih--</option>
                                                <option value="1">WNI</option>
                                                <option value="2">WNA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Negara</label>
                                            <select class="form-control text-xs" id="negara">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($negara as $a)
                                                    <option value="{{ $a->nama_negara }}"
                                                        @if ($a->kode_negara == 'ID') selected @endif>
                                                        {{ $a->nama_negara }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Provinisi</label>
                                            <select class="form-control" id="provinsi">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($provinsi as $a)
                                                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kabupaten</label>
                                            <select class="form-control" id="kabupaten">
                                                <option value="">--Silahkan Pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kecamatan</label>
                                            <select class="form-control" id="kecamatan">
                                                <option value="">--Silahkan Pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Desa</label>
                                            <select class="form-control" id="desa">
                                                <option value="">--Silahkan Pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <textarea class="form-control" id="alamat" aria-describedby="emailHelp"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <H4 class="mb-3 text-bold text-danger">Alamat Domisili</H4>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="sesuaiktp" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Sesuai KTP</label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Provinisi</label>
                                            <select class="form-control" id="provinisidom">
                                                <option value="">--Silahkan Pilih--</option>
                                                @foreach ($provinsi as $a)
                                                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kabupaten</label>
                                            <select class="form-control" id="kabupatendom">
                                                <option value="">--Silahkan Pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Kecamatan</label>
                                            <select class="form-control" id="kecamatandom">
                                                <option value="">--Silahkan Pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Desa</label>
                                            <select class="form-control" id="desadom">
                                                <option value="">--Silahkan Pilih--</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat</label>
                                            <textarea class="form-control" id="alamatdom" aria-describedby="emailHelp"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="simpanpasien()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function simpanpasien() {
            nomorktp = $('#nomorktp').val()
            nomorbpjs = $('#nomorbpjs').val()
            namapasien = $('#namapasien').val()
            tempatlahir = $('#tempatlahir').val()
            tanggallahir = $('#tanggallahir').val()
            jeniskelamin = $('#jeniskelamin').val()
            agama = $('#agama').val()
            pekerjaan = $('#pekerjaan').val()
            pendidikan = $('#pendidikan').val()
            nomortelp = $('#nomortelp').val()
            namakeluarga = $('#namakeluarga').val()
            hubungankeluarga = $('#hubungankeluarga').val()
            telpkeluarga = $('#telpkeluarga').val()
            alamatkeluarga = $('#alamatkeluarga').val()
            kewarganegaraan = $('#kewarganegaraan').val()
            negara = $('#negara').val()
            provinsi = $('#provinsi').val()
            kabupaten = $('#kabupaten').val()
            kecamatan = $('#kecamatan').val()
            desa = $('#desa').val()
            alamat = $('#alamat').val()
            sesuaiktp = $('#sesuaiktp:checked').val()
            provinisidom = $('#provinisidom').val()
            kabupatendom = $('#kabupatendom').val()
            kecamatandom = $('#kecamatandom').val()
            desadom = $('#desadom').val()
            alamatdom = $('#alamatdom').val()
            if (nomorktp == '') {
                $('#nomorktp').addClass('is-invalid')
                alert('Nomor ktp belum diisi !')
            } else if (namapasien == '') {
                $('#namapasien').addClass('is-invalid')
                alert('Nama pasien belum diisi !')
            } else if (tempatlahir == '') {
                $('#tempatlahir').addClass('is-invalid')
            } else if (jeniskelamin == '') {
                $('#jeniskelamin').addClass('is-invalid')
            } else if (agama == '') {
                $('#agama').addClass('is-invalid')
            } else if (pekerjaan == '') {
                $('#pekerjaan').addClass('is-invalid')
            } else if (pendidikan == '') {
                $('#pendidikan').addClass('is-invalid')
            } else if (nomortelp == '') {
                $('#nomortelp').addClass('is-invalid')
            } else if (namakeluarga == '') {
                $('#namakeluarga').addClass('is-invalid')
            } else if (hubungankeluarga == '') {
                $('#hubungankeluarga').addClass('is-invalid')
            } else if (telpkeluarga == '') {
                $('#telpkeluarga').addClass('is-invalid')
            } else if (alamatkeluarga == '') {
                $('#alamatkeluarga').addClass('is-invalid')
            } else if (kewarganegaraan == '') {
                $('#kewarganegaraan').addClass('is-invalid')
            } else if (negara == '') {
                $('#negara').addClass('is-invalid')
            } else if (provinsi == '') {
                $('#provinsi').addClass('is-invalid')
            } else if (kabupaten == '') {
                $('#kabupaten').addClass('is-invalid')
            } else if (kecamatan == '') {
                $('#kecamatan').addClass('is-invalid')
            } else if (desa == '') {
                $('#desa').addClass('is-invalid')
            } else if (alamat == '') {
                $('#alamat').addClass('is-invalid')
            } else if (sesuaiktp != 1) {
                if (provinisidom == '') {
                    $('#provinisidom').addClass('is-invalid')
                } else if (kabupatendom == '') {
                    $('#kabupatendom').addClass('is-invalid')
                } else if (kecamatandom == '') {
                    $('#kecamatandom').addClass('is-invalid')
                } else if (desadom == '') {
                    $('#desadom').addClass('is-invalid')
                } else if (alamatdom == '') {
                    $('#alamatdom').addClass('is-invalid')
                } else {
                    simpan()
                }
            } else {
                simpan()
            }
            function simpan() {
                    $.ajax({
                        dataType: 'Json',
                        async: true,
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            nomorktp,
                            nomorbpjs,
                            namapasien,
                            tempatlahir,
                            tanggallahir,
                            jeniskelamin,
                            agama,
                            pekerjaan,
                            pendidikan,
                            nomortelp,
                            namakeluarga,
                            hubungankeluarga,
                            telpkeluarga,
                            alamatkeluarga,
                            kewarganegaraan,
                            negara,
                            provinsi,
                            kabupaten,
                            kecamatan,
                            desa,
                            alamat,
                            sesuaiktp,
                            provinisidom,
                            kabupatendom,
                            kecamatandom,
                            desadom,
                            alamatdom
                        },
                        url: '<?= route('simpanpasien') ?>',
                        error: function(datas) {
                            alert('error')
                        },
                        success: function(data) {
                            alert('Berhasil')
                            location.reload()
                            // $('#daftarpxumum').attr('disabled', true);
                        }
                    });
                }
        }
        $(document).ready(function() {
            $('#provinsi').change(function() {
                var provinsi = $('#provinsi').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        provinsi: provinsi
                    },
                    url: '<?= route('carikab_local') ?>',
                    success: function(response) {
                        $('#kabupaten').html(response);
                        // $('#daftarpxumum').attr('disabled', true);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#kabupaten').change(function() {
                var kabupaten = $('#kabupaten').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kabupaten: kabupaten
                    },
                    url: '<?= route('carikec_local') ?>',
                    success: function(response) {
                        $('#kecamatan').html(response);
                        // $('#daftarpxumum').attr('disabled', true);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#kecamatan').change(function() {
                var kecamatan = $('#kecamatan').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kecamatan: kecamatan
                    },
                    url: '<?= route('caridesa_local') ?>',
                    success: function(response) {
                        $('#desa').html(response);
                        // $('#daftarpxumum').attr('disabled', true);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#provinisidom').change(function() {
                var provinsi = $('#provinisidom').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        provinsi: provinsi
                    },
                    url: '<?= route('carikab_local') ?>',
                    success: function(response) {
                        $('#kabupatendom').html(response);
                        // $('#daftarpxumum').attr('disabled', true);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#kabupatendom').change(function() {
                var kabupaten = $('#kabupatendom').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kabupaten: kabupaten
                    },
                    url: '<?= route('carikec_local') ?>',
                    success: function(response) {
                        $('#kecamatandom').html(response);
                        // $('#daftarpxumum').attr('disabled', true);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#kecamatandom').change(function() {
                var kecamatan = $('#kecamatandom').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kecamatan: kecamatan
                    },
                    url: '<?= route('caridesa_local') ?>',
                    success: function(response) {
                        $('#desadom').html(response);
                        // $('#daftarpxumum').attr('disabled', true);
                    }
                });
            });
        });
    </script>
@endsection
