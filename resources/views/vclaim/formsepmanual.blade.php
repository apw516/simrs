<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <div class="container">
                    <div class="card">
                        {{-- @dd($data_peserta->response->peserta->noKartu); --}}
                        <div class="card-header bg-info">Info Peserta</div>
                        <div class="card-body text-md">
                            <div class="row">
                                <div class="col-sm-3">Nomor RM</div>
                                <div class="col-sm-5">: {{ $data_peserta->response->peserta->mr->noMR }}</div>
                                <input hidden type="text" class="form-control" id="nomorrm"
                                    value="{{ $rm }}">
                                <input hidden type="text" class="form-control" id="nomorkartu"
                                    value="{{ $data_peserta->response->peserta->noKartu }}">
                                <input hidden type="text" class="form-control" id="kodekunjungan"
                                    value="{{ $kode }}">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor Kartu</div>
                                <div class="col-sm-5">: {{ $data_peserta->response->peserta->noKartu }}</div>
                                <input hidden type="text" value="{{ $data_peserta->response->peserta->noKartu }}"
                                    id="nomorkartu">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor KTP</div>
                                <div class="col-sm-5">: {{ $data_peserta->response->peserta->nik }}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">Nama</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->nama }}</div>
                                <input hidden type="text" value="{{ $data_peserta->response->peserta->nama }}"
                                    id="namapasien">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor Telp</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->mr->noTelepon }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Tgl lahir</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->tglLahir }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Status Peserta</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->statusPeserta->keterangan }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Jenis Peserta</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->jenisPeserta->keterangan }}</div>
                                <input hidden type="text"
                                    value="{{ $data_peserta->response->peserta->jenisPeserta->keterangan }}"
                                    id="penjamin">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Hak Kelas</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->hakKelas->keterangan }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Faskes 1</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->provUmum->nmProvider }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Umur</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->umur->umurSekarang }}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">COB</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->cob->nmAsuransi }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->cob->noAsuransi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h4 class="text-danger mb-2">*Wajib Diisi</h4>
                    <div class="row">
                        <div class="col-sm-4 text-right text-bold">Jenis Pelayanan</div>
                        <div class="col-sm-7">
                            <select class="form-control" id="jenispelayanan_ranap">
                                <option value="1">Rawat Inap</option>
                            </select>
                        </div>
                    </div>
                    <div class="ranap" id="ranap">
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Hak Kelas</div>
                            <div class="col-sm-7">
                                <select class="form-control" id="hakkelasbpjs">
                                    <option value="">-- Silahkan Pilih Kelas --</option>
                                    <option value="1" @if ($data_peserta->response->peserta->hakKelas->kode == 1) selected @endif>Kelas 1
                                    </option>
                                    <option value="2" @if ($data_peserta->response->peserta->hakKelas->kode == 2) selected @endif>Kelas 2
                                    </option>
                                    <option value="3" @if ($data_peserta->response->peserta->hakKelas->kode == 3) selected @endif>Kelas 3
                                    </option>
                                    <option value="4" @if ($data_peserta->response->peserta->hakKelas->kode == 4) selected @endif>VIP
                                    </option>
                                    <option value="5" @if ($data_peserta->response->peserta->hakKelas->kode == 5) selected @endif>VVIP
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Naik Kelas</div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" value="1" id="naikkelas">
                                <label style="font-size:15"class="form-check-label text-danger"
                                    for="exampleCheck1">*ceklis jika pasien naik kelas.</label>
                            </div>
                        </div>
                        <div hidden class="jikanaikkelas">
                            <div class="row mt-2">
                                <div class="col-md-4 text-right">
                                    Pembiayaan
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control form-control-md" id="pembiayaan">
                                        <option value="">-- Silahkan Pilih --</option>
                                        <option value="1">Pribadi</option>
                                        <option value="2">Pemberi Kerja</option>
                                        <option value="3">Asuransi Kesehatan Tambahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 text-right">
                                    Nama Penanggung Jawab
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" placeholder="Jika pembiayaan oleh pemberi kerja atau layanan kesehatan tambahan"
                                        id="penanggugjawab"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Kelas</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="niakkelasranap">
                                        <option value="">-- Silahkan Pilih Kelas --</option>
                                        <option value="1">VVIP</option>
                                        <option value="2">VIP</option>
                                        <option value="3">Kelas 1</option>
                                        <option value="4">Kelas 2</option>
                                        <option value="5">Kelas 3</option>
                                        <option value="6">ICCU</option>
                                        <option value="7">ICU</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Tgl masuk</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tglmasukranap">
                        </div>
                    </div>
                    <div id="pakebridging">
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="form-group form-check">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modalbuatspri">Buat
                                    SPRI</button>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#modalcarispri"
                                    onclick="carisuratkontrol()">Cari SPRI</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Nomor Telp</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nomortelp">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Nomor SPRI</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nomorspri">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Tanggal SPRI</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                    id="tglspri">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">DPJP SPRI</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"id="dpjp">
                                <input hidden type="text" class="form-control" id="kodedpjp">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Diagnosa</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="diagnosaranap">
                                <input hidden type="text" class="form-control" id="kodediagnosaranap">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Catatan</div>
                            <div class="col-sm-7">
                                <textarea type="text" class="form-control" id="catatan"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Status Kecelakaan</div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="keterangan_kll">
                                    <option value="">-- Silahkan Pilih --</option>
                                    <option selected value="0">Bukan Kecelakaan lalu lintas [BKLL]
                                    </option>
                                    <option value="1">KLL dan bukan kecelakaan Kerja [BKK]</option>
                                    <option value="2">KLL dan KK</option>
                                    <option value="3">Kecelakaan Kerja</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div hidden class="formlaka">
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="col-sm-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" class="mr-1" id="keterangansuplesi"
                                                value="1">Suplesi
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="sepsuplesi">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Tgl Kejadian</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                    id="tglkejadianlaka">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">No.LP</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nomorlp">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Lokasi Kejadian</div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="provinsikejadian">
                                    <option value="">-- Silahkan Pilih Provinsi --</option>
                                    @foreach ($provinsi->response->list as $p)
                                        <option value="{{ $p->kode }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="kabupatenkejadian">
                                    <option value="">-- Silahkan Pilih Kabupaten --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="kecamatankejadian">
                                    <option value="">-- Silahkan Pilih Kecamatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Keterangan</div>
                            <div class="col-sm-7">
                                <textarea type="text" class="form-control" id="keteranganlaka"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Alasan masuk</div>
                        <div class="col-sm-7">
                            <select class="form-control" id="alasanmasuk">
                                @foreach ($alasan_masuk as $a)
                                    <option value="{{ $a->id }}"
                                        @if ($a->id == 1) selected @endif>
                                        {{ $a->alasan_masuk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-4">

                        </div>
                        <div class="col-sm-7">
                            <button class="btn btn-danger" onclick="location.reload()">Batal</button>
                            <button class="btn btn-success float-right" onclick="daftarpasienranap()">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalcarispri" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cari SPRI / Surat Kontrol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vspri">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalbuatspri" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                        {{-- <option value="2">SURAT KONTROL</option> --}}
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                    <input type="email" class="form-control datepicker" id="tanggalkontrol"
                        placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nomor Kartu</label>
                    <input type="email" class="form-control" id="nomorkartukontrol" value=""
                        placeholder="name@example.com">
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
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
    $(document).ready(function() {
        $('#diagnosaranap').autocomplete({
            source: "<?= route('caridiagnosa') ?>",
            select: function(event, ui) {
                $('[id="diagnosaranap"]').val(ui.item.label);
                $('[id="kodediagnosaranap"]').val(ui.item.kode);
            }
        });
    });
    $("#naikkelas").click(function() {
        value2 = $('#naikkelas:checked').val()
        if (value2 == '1') {
            $('.jikanaikkelas').removeAttr('hidden', true)
        } else {
            $('.jikanaikkelas').attr('hidden', true)
        }
    })
    $(document).ready(function() {
        $('#keterangan_kll').change(function() {
            var status = $('#keterangan_kll').val()
            if (status == '' || status == '0') {
                $('.formlaka').attr('Hidden', true);
            } else {
                $('.formlaka').removeAttr('Hidden', true);
            }

        })
    });
    $(document).ready(function() {
        $('#provinsikejadian').change(function() {
            var sep_laka_prov = $('#provinsikejadian').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    prov: sep_laka_prov
                },
                url: '<?= route('carikabupaten') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#kabupatenkejadian').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#kabupatenkejadian').change(function() {
            var sep_laka_kab = $('#kabupatenkejadian').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kab: sep_laka_kab
                },
                url: '<?= route('carikecamatan') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#kecamatankejadian').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
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
                    $('#nomorspri').val(data.response.noSPRI)
                    $('#tglspri').val(data.response.tglRencanaKontrol)
                    $('#dpjp').val(dokterkontrol)
                    $('#kodedpjp').val(kodedokterkontrol)
                    $('#staticBackdrop').modal('hide');
                } else {
                    alert(data.metaData.message)
                }
            }
        });
    }

    function daftarpasienranap() {
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        nomorkartu = $('#nomorkartu').val()
        jenispelayanan_ranap = $('#jenispelayanan_ranap').val()
        hakkelasbpjs = $('#hakkelasbpjs').val()
        naikkelas = $('#naikkelas:checked').val()
        pembiayaan = $('#pembiayaan').val()
        penanggugjawab = $('#penanggugjawab').val()
        niakkelasranap = $('#niakkelasranap').val()
        tglmasukranap = $('#tglmasukranap').val()
        nomorspri = $('#nomorspri').val()
        nomortelp = $('#nomortelp').val()
        tglspri = $('#tglspri').val()
        kodedpjp = $('#kodedpjp').val()
        kodediagnosaranap = $('#kodediagnosaranap').val()
        catatan = $('#catatan').val()
        keterangan_kll = $('#keterangan_kll').val()
        keterangansuplesi = $('#keterangansuplesi:checked').val()
        sepsuplesi = $('#sepsuplesi').val()
        tglkejadianlaka = $('#tglkejadianlaka').val()
        nomorlp = $('#nomorlp').val()
        provinsikejadian = $('#provinsikejadian').val()
        kabupatenkejadian = $('#kabupatenkejadian').val()
        kecamatankejadian = $('#kecamatankejadian').val()
        keteranganlaka = $('#keteranganlaka').val()
        alasanmasuk = $('#alasanmasuk').val()
        spinner = $('#loader');
        spinner.show()
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                nomorrm,
                nomorkartu,
                jenispelayanan_ranap,
                hakkelasbpjs,
                naikkelas,
                pembiayaan,
                penanggugjawab,
                niakkelasranap,
                tglmasukranap,
                nomorspri,
                nomortelp,
                tglspri,
                kodedpjp,
                kodediagnosaranap,
                catatan,
                keterangan_kll,
                keterangansuplesi,
                sepsuplesi,
                tglkejadianlaka,
                nomorlp,
                provinsikejadian,
                kabupatenkejadian,
                kecamatankejadian,
                keteranganlaka,
                alasanmasuk
            },
            url: '<?= route('buatsep_manual') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == '200') {
                    if (data.jenis == 'BPJS') {
                        Swal.fire({
                            title: 'Pendaftaran berhasil !',
                            text: "Apakah anda ingin mencetak SEP ?",
                            icon: 'success',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            denyButtonColor: 'green',
                            confirmButtonText: 'Ya, cetak SEP',
                            denyButtonText: `Cetak SEP dan Label`,
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open('cetaksep/' + data.kode_kunjungan);
                                location.reload();
                            } else if (result.isDenied) {
                                // window.open('cetakstruk/' + data.kode_kunjungan);
                                // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                                var url = 'cetaksep/' + data.kode_kunjungan
                                var url2 = `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                    norm + `&nama=` + data.nama;
                                var locs = [url, url2]
                                for (let i = 0; i < locs.length; i++) {
                                    window.open(locs[i])
                                }
                                location.reload();
                            } else {
                                location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            title: 'Pendaftaran berhasil !',
                            text: "Cetak nota pembayaran ...",
                            icon: 'success',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            denyButtonColor: 'green',
                            denyButtonText: `Cetak Nota dan Label`,
                            confirmButtonText: 'Ya, cetak Nota',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open('cetakstruk/' + data.kode_kunjungan);
                                location.reload();
                            } else if (result.isDenied) {
                                // window.open('cetakstruk/' + data.kode_kunjungan);
                                // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                                var url = 'cetakstruk/' + data.kode_kunjungan
                                var url2 =
                                    `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                    nomorrm + `&nama=` + namapasien;
                                var locs = [url, url2]
                                for (let i = 0; i < locs.length; i++) {
                                    window.open(locs[i])
                                }
                                location.reload();
                            } else {
                                location.reload();
                            }
                        })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops, Sorry !',
                        text: data.message,
                    })
                }
            }
        });
    }

    function carisuratkontrol() {
        spinner = $('#loader');
        spinner.show();
        nomorkartu = $('#nomorkartu').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorkartu
            },
            url: '<?= route('carisuratkontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vspri').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }
</script>
