<div class="">
    <table class="table table-sm table-bordered">
        <tr>
            <td>Nomor SEP Kunjungan</td>
            <td>{{ $ts_kunjungan[0]->no_sep }}</td>
        </tr>
        <tr>
            <td>Nomor Rujukan</td>
            <td>{{ $ts_kunjungan[0]->no_rujukan }}</td>
        </tr>
    </table>
    @php $cek= substr($ts_kunjungan[0]->no_rujukan,0,8) @endphp
    @if ($cek == '1018R001')
        @php
            $sttusrujukan = 1;
        @endphp
    @else
        @php
            $sttusrujukan = 2;
        @endphp
    @endif
    <input hidden id="jenisrujukan" type="text" value="{{ $sttusrujukan }}">
    <input hidden id="rujukanawal" type="text" value="{{ $ts_kunjungan[0]->no_rujukan }}">
    <input hidden id="sepsekarang" type="text" value="{{ $ts_kunjungan[0]->no_sep }}">
    @if ($stt == 'OK')
        <hr class="my-4">
        <p>@php $cek= substr($ts_kunjungan[0]->no_rujukan,0,8) @endphp
            @if ($cek == '1018R001')
                <h5 class="mb-4">Pasien pasca rawat inap, Cari sep rawat jalan
                    jika pasien sudah memiiki rujukan dari faskes 1... <br></h5>
                <div class="card">
                    <div class="card-header">Riwayat Kunjungan Pasien</div>
                    <div class="card-body">
                        <table id="tabelriwayatpelayanan" class="table table-sm table-bordered table-hover text-xs">
                            <thead>
                                <th>Tgl Pelayanan</th>
                                <th>PPK Pelayanan</th>
                                <th>Unit</th>
                                <th>Jenis Pelayanan</th>
                                <th>Rujukan</th>
                                <th>SEP</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach ($riwayatpelayanan->response->histori as $rp)
                                    <tr>
                                        <td>{{ $rp->tglSep }}</td>
                                        <td>{{ $rp->ppkPelayanan }}</td>
                                        <td>{{ $rp->poli }}</td>
                                        <td>
                                            @if ($rp->jnsPelayanan == 1)
                                                Rawat Inap
                                            @else
                                                Rawat Jalan
                                            @endif
                                        </td>
                                        <td>{{ $rp->noRujukan }}</td>
                                        <td>{{ $rp->noSep }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success pilihsep"
                                                nomorrujukan="{{ $rp->noRujukan }}" nomorsep="{{ $rp->noSep }}"
                                                kodepoli="{{ $rp->poliTujSep }}" namapoli="{{ $rp->poli }}"><i
                                                    class="bi bi-check2-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </p>
        <div class="card">
            <div class="card-header">Form Buat Surat Kontrol</div>
            <div class="card-body">
                <div class="modal-body">
                    <form action="" class="formsurkon">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jenis Surat</label>
                            <select class="form-control" id="jenissurat2" name="jenissurat2">
                                <option value="2">SURAT KONTROL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                            <input type="date" class="form-control datepicker" id="tanggalkontrol2"
                                name="tanggalkontrol2" placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor SEP</label>
                            <input type="email" class="form-control" id="nomorsepkontrol" name="nomorsepkontrol"
                                value="" placeholder="masukan nomor kartu / sep ...">
                            <small id="emailHelp" class="form-text text-danger">masukan nomor sep untuk pembuatan surat
                                kontrol</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Poli Kontrol</label>
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                    id="polikontrol2" name="polikontrol2">
                                <input hidden readonly type="text" class="form-control"
                                    placeholder="Klik cari poli ..." id="kodepolikontrol2" name="kodepolikontrol2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary caripolikontrol1" type="button" data-toggle="modal"
                                        data-target="#modalpilihpoli">Cari Poli</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Dokter</label>
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                    id="dokterkontrol2" name="dokterkontrol2">
                                <input hidden readonly type="text" class="form-control"
                                    placeholder="Klik cari dokter ..." id="kodedokterkontrol2"
                                    name="kodedokterkontrol2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary caridokter1" type="button" data-toggle="modal"
                                        data-target="#modalpilihdokter">Cari
                                        Dokter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <button class="btn btn-success float-right" onclick="simpansuratkontrol()"><i
                            class="bi bi-box-arrow-down mr-1 ml-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    @else
        <div class="jumbotron">
            <h1 class="display-4 text-danger mb-2">Oops, Sepertinya ada masalah !</h1>
            <p class="lead font-italic">Silahkan cari riwayat sep secara manual ....</p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal awal</label>
                        <input type="date" class="form-control" id="tanggalawalsep" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal akhir</label>
                        <input type="date" class="form-control" id="tanggalakhirsep"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Kartu</label>
                        <input type="text" class="form-control" id="nomorkartu" value="{{ $nomorkartu }}"
                            aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-3"><button class="btn btn-md btn-info" style="margin-top:32px"
                        onclick="caririwayatsep_vclaim()"><i class="bi bi-search mr-1 ml-1"></i>Cari Riwayat</button>
                </div>
            </div>
            <hr class="my-4">
            <div class="v_t_r_s"></div>
            <div class="card">
                <div class="card-header">Form Buat Surat Kontrol</div>
                <div class="card-body">
                    <div class="modal-body">
                        <form action="" class="formsurkon2">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jenis Surat</label>
                                <select class="form-control" id="jenissurat2" name="jenissurat2">
                                    <option value="2">SURAT KONTROL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                                <input type="date" class="form-control datepicker" id="tanggalkontrol2"
                                    name="tanggalkontrol2" placeholder="name@example.com"
                                    data-date-format="yyyy-mm-dd">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nomor SEP</label>
                                <input type="email" class="form-control" id="nomorsepkontrol2"
                                    name="nomorsepkontrol2" value=""
                                    placeholder="masukan nomor kartu / sep ...">
                                <small id="emailHelp" class="form-text text-danger">masukan nomor sep untuk pembuatan
                                    surat
                                    kontrol</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Poli Kontrol</label>
                                <div class="input-group mb-3">
                                    <input readonly type="text" class="form-control"
                                        placeholder="Klik cari poli ..." id="polikontrol4" name="polikontrol4">
                                    <input hidden readonly type="text" class="form-control"
                                        placeholder="Klik cari poli ..." id="kodepolikontrol4"
                                        name="kodepolikontrol4">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary caripolikontrol2" type="button" data-toggle="modal"
                                            data-target="#modalpilihpoli">Cari
                                            Poli</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Dokter</label>
                                <div class="input-group mb-3">
                                    <input readonly type="text" class="form-control"
                                        placeholder="Klik cari dokter ..." id="dokterkontrol4" name="dokterkontrol4">
                                    <input hidden readonly type="text" class="form-control"
                                        placeholder="Klik cari dokter ..." id="kodedokterkontrol2"
                                        name="kodedokterkontrol4">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary caridokter" type="button" data-toggle="modal"
                                            data-target="#modalpilihdokter">Cari
                                            Dokter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success float-right" onclick="simpansuratkontrol2()"><i
                                class="bi bi-box-arrow-down mr-1 ml-1"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
<!-- Modal -->
<div class="modal modal11 fade" id="modalpilihdokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_tabel_jadwal">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="modal modal11 fade" id="modalpilihpoli" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_tabel_poli">

                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        cek = $('#jenisrujukan').val()
        if (cek == 2) {
            cekrujukan()
        }
    });
    $(function() {
        $("#tabelriwayatpelayanan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": true,
            "order": [
                [0, "desc"]
            ]
        })
    });
    $(".pilihsep").on('click', function(event) {
        spinneron()
        rujukan = $(this).attr('nomorrujukan')
        sep = $(this).attr('nomorsep')
        kodepoli = $(this).attr('kodepoli')
        namapoli = $(this).attr('namapoli')
        kodekunjungan = $('#kodekunjungan').val()
        $('#nomorsepkontrol').val('')
        $('#polikontrol2').val('')
        $('#kodepolikontrol2').val('')
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                rujukan,
                kodekunjungan,
                sep
            },
            url: '<?= route('cekstatusrujukan') ?>',
            error: function(data) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                if (data.kode != 200) {
                    spinnerof()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    spinnerof()
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    $('#nomorsepkontrol').val(sep)
                    $('#polikontrol2').val(namapoli)
                    $('#kodepolikontrol2').val(kodepoli)
                    $('#dokterkontrol2').val(data.nama_dokter_jkn)
                    $('#kodedokterkontrol2').val(data.kode_dokter_jkn)
                }
            }
        });
    });
    $(".caridokter1").on('click', function(event) {
        spinneron()
        tglkontrol = $('#tanggalkontrol2').val()
        kodepoli = $('#kodepolikontrol2').val()
        $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglkontrol,
                    kodepoli
                },
                url: '<?= route('ambil_jadwal_dokter') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_tabel_jadwal').html(response);
                }
            });
    });
    $(".caridokter").on('click', function(event) {
        spinneron()
        tglkontrol = $('#tanggalkontrol2').val()
        kodepoli = $('#kodepolikontrol4').val()
        $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglkontrol,
                    kodepoli
                },
                url: '<?= route('ambil_jadwal_dokter') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_tabel_jadwal').html(response);
                }
            });
    });
    $(".caripolikontrol1").on('click', function(event) {
        spinneron()
        tglkontrol = $('#tanggalkontrol2').val()
        nosep = $('#nomorsepkontrol').val()
        $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglkontrol,
                    nosep
                },
                url: '<?= route('ambil_jadwal_poli') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_tabel_poli').html(response);
                }
            });
    });
    $(".caripolikontrol2").on('click', function(event) {
        spinneron()
        tglkontrol = $('#tanggalkontrol2').val()
        nosep = $('#nomorsepkontrol2').val()
        $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglkontrol,
                    nosep
                },
                url: '<?= route('ambil_jadwal_poli') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_tabel_poli').html(response);
                }
            });
    });

    function cekrujukan() {
        spinneron()
        rujukan = $('#rujukanawal').val()
        sep = $('#sepsekarang').val()
        $('#nomorsepkontrol').val('')
        $('#polikontrol2').val('')
        $('#kodepolikontrol2').val('')
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                rujukan,
                sep,
                kodekunjungan
            },
            url: '<?= route('cekstatusrujukan_rajal') ?>',
            error: function(data) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                if (data.kode != 200) {
                    spinnerof()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    spinnerof()
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        footer: ''
                    })
                    $('#nomorsepkontrol').val(sep)
                    $('#polikontrol2').val(data.namapoli)
                    $('#kodepolikontrol2').val(data.kodepoli)
                    $('#dokterkontrol2').val(data.nama_dokter_jkn)
                    $('#kodedokterkontrol2').val(data.kode_dokter_jkn)
                }
            }
        });
    }

    function simpansuratkontrol() {
        var data = $('.formsurkon').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        kodekunjungan = $('#kodekunjungan').val()
        no_rm = $('#no_rm').val()
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan,
                no_rm
            },
            url: '<?= route('simpansuratkontrol') ?>',
            error: function(data) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinnerof()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    $('#modalsuratkontrol').modal('toggle');
                    getformbillingtindakan()
                }
            }
        });
    }

    function simpansuratkontrol2() {
        var data = $('.formsurkon2').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        no_rm = $('#no_rm').val()
        spinneron()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan,
                no_rm
            },
            url: '<?= route('simpansuratkontrol2') ?>',
            error: function(data) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinnerof()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    $('#modalsuratkontrol').modal('toggle');
                    getformbillingtindakan()
                }
            }
        });
    }

    function caririwayatsep_vclaim() {
        tglawal = $('#tanggalawalsep').val()
        tglakhir = $('#tanggalakhirsep').val()
        noka = $('#nomorkartu').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                tglawal,
                tglakhir,
                noka
            },
            url: '<?= route('ambilriwayatpelayanan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_t_r_s').html(response);
            }
        });
    }
