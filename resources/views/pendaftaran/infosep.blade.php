<div class="container">
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Nomor SEP</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $sep->response->noSep }}
                        </a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="nomorsep_update"
                        value="{{ $sep->response->noSep }}">
                </li>
                <li class="list-group-item">
                    <b>Nomor Rujukan</b> <a
                        class="float-right text-dark text-bold text-monospace d-block p-2 bg-info text-white">{{ $sep->response->noRujukan }}</a>
                </li>
                <li class="list-group-item">
                    <b>Tanggal SEP</b> <a
                        class="float-right text-dark text-bold text-monospace">{{ $sep->response->tglSep }}</a>
                </li>
                <li class="list-group-item">
                    <b>No. Kartu</b> <a
                        class="float-right text-dark text-bold text-monospace">{{ $sep->response->peserta->noKartu }}</a>
                </li>
                <li class="list-group-item">
                    <b>Jns.Pelayanan</b> <a
                        class="float-right text-dark text-bold text-monospace">{{ $sep->response->jnsPelayanan }}</a>
                </li>
                <li class="list-group-item">
                    <b>Kelas Rawat</b> <a
                        class="float-right text-dark text-bold text-monospace">{{ $sep->response->kelasRawat }}</a>
                </li>
                <li class="list-group-item">
                    <b>Diagnosa</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-bold text-monospace">{{ $sep->response->diagnosa }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="diagnosasep_update"
                        value="{{ $sep->response->diagnosa }}">
                    <input hidden type="text" class="form-control" id="kodediagnosasep_update"
                        value="{{ $sep->response->diagnosa }}">
                </li>
                <li class="list-group-item">
                    <b>Poli</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-bold text-monospace">{{ $sep->response->poli }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="polisep_update"
                        value="{{ $sep->response->poli }}">
                    <input hidden type="text" class="form-control" id="kodepolisep_update"
                        value="{{ $sep->response->poli }}">
                </li>
                <li class="list-group-item">
                    <b>Catatan</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-bold text-monospace">{{ $sep->response->catatan }}</a>
                    </div>
                    <textarea hidden type="text" class="form-control edit" id="catatansep_update"> {{ $sep->response->catatan }} </textarea>
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Status Kecelakaan</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-monospace">{{ $sep->response->nmstatusKecelakaan }}</a>
                    </div>
                    {{-- <input hidden type="text" class="form-control edit" id="statuslakasep_update" value="{{ $sep->response->nmstatusKecelakaan }}"> --}}
                    <select hidden class="form-control form-control-sm edit" id="keterangan_kll_update">
                        <option value="">-- Silahkan Pilih --</option>
                        <option @if ($sep->response->kdStatusKecelakaan == 0) selected @endif value="0">Bukan Kecelakaan lalu
                            lintas [BKLL]</option>
                        <option @if ($sep->response->kdStatusKecelakaan == 1) selected @endif value="1">KLL dan bukan
                            kecelakaan Kerja [BKK]</option>
                        <option @if ($sep->response->kdStatusKecelakaan == 2) selected @endif value="2">KLL dan KK</option>
                        <option @if ($sep->response->kdStatusKecelakaan == 3) selected @endif value="3">Kecelakaan Kerja
                        </option>
                    </select>
                </li>
                <li class="list-group-item">
                    <b>Lokasi Provinsi </b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->lokasiKejadian->kdKec }}</a>
                    </div>
                    {{-- <input hidden type="text" class="form-control edit" value="{{ $sep->response->lokasiKejadian->kdKec }}" id="lokasikec_update"> --}}
                    <select hidden class="form-control form-control-sm edit" id="provinsikejadian_update">
                        <option value="">-- Silahkan Pilih Provinsi --</option>
                        @foreach ($prop as $p)
                            <option value="{{ $p->kode }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">
                    <b>Lokasi Kabupaten </b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->lokasiKejadian->kdKab }}</a>
                    </div>
                    <select hidden class="form-control form-control-sm edit" id="kabupatenkejadian_update">
                        <option value="">-- Silahkan Pilih Kabupaten --</option>
                        @if ($kab != 0)
                            @foreach ($kab as $k)
                                <option value="{{ $k->kode }}">{{ $k->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                </li>
                <li class="list-group-item">
                    <b>Lokasi Kecamatan </b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->lokasiKejadian->ketKejadian }}</a>
                    </div>
                    <select hidden class="form-control form-control-sm edit" id="kecamatankejadian_update">
                        <option value="">-- Silahkan Pilih Kecamatan --</option>
                        @if ($kec != 0)
                            @foreach ($kec as $k)
                                <option value="{{ $k->kode }}">{{ $k->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                    {{-- <input hidden type="text" class="form-control edit"> --}}
                </li>
                <li class="list-group-item">
                    <b>Keterangan Kecelakaan </b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->lokasiKejadian->kdKab }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="keterangankll_update"
                        value="{{ $sep->response->lokasiKejadian->kdKab }}">
                </li>
                <li class="list-group-item">
                    <b>Tgl Kecelakaan </b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->lokasiKejadian->tglKejadian }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit datepicker"
                        id="tglkll_update"value="{{ $sep->response->lokasiKejadian->tglKejadian }}">
                </li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Nama</b> <a
                        class="float-right text-dark text-monospace">{{ $sep->response->peserta->nama }}</a>
                </li>
                <li class="list-group-item">
                    <b>Nomor Kartu</b> <a
                        class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $sep->response->peserta->noKartu }}</a>
                </li>
                <li class="list-group-item">
                    <b>Nomor RM</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-monospace"> {{ $sep->response->peserta->noMr }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="nomorrm_update"
                        value="{{ $sep->response->peserta->noMr }}">
                </li>
                <li class="list-group-item">
                    <b>Tgl lahir</b> <a
                        class="float-right text-dark text-monospace">{{ $sep->response->peserta->tglLahir }}</a>
                </li>
                <li class="list-group-item">
                    <b>Jenis Kelamin</b> <a
                        class="float-right text-dark text-monospace">{{ $sep->response->peserta->kelamin }}</a>
                </li>
                <li class="list-group-item">
                    <b>Kls Rawat Hak</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-monospace">{{ $sep->response->peserta->hakKelas }}</a>
                    </div>
                    {{-- <input hidden type="text" class="form-control edit" value="{{ $sep->response->klsRawat->klsRawatHak }}" id="hakkelas_update"> --}}
                    <select hidden class="form-control form-control-sm edit" id="hakkelas_update">
                        <option value="1" @if ($sep->response->klsRawat->klsRawatHak == 1) selected @endif>Kelas 1</option>
                        <option value="2" @if ($sep->response->klsRawat->klsRawatHak == 2) selected @endif>Kelas 2</option>
                        <option value="3" @if ($sep->response->klsRawat->klsRawatHak == 3) selected @endif>Kelas 3</option>
                    </select>
                </li>
                <li class="list-group-item">
                    <b>Asuransi</b> <a
                        class="float-right text-dark text-monospace">{{ $sep->response->peserta->asuransi }}</a>
                </li>
                <li class="list-group-item">
                    <b>Kelas Rawat Naik</b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->klsRawat->klsRawatNaik }}</a>
                    </div>
                    {{-- <input hidden type="text" class="form-control edit" id="kelasnaik_update" value="{{ $sep->response->klsRawat->klsRawatNaik }}"> --}}
                    <select hidden class="form-control form-control-sm edit" id="kelasnaik_update">
                        <option value=""></option>
                        <option value="1" @if ($sep->response->klsRawat->klsRawatNaik == 1) selected @endif>VVIP</option>
                        <option value="2" @if ($sep->response->klsRawat->klsRawatNaik == 2) selected @endif>VIP</option>
                        <option value="3" @if ($sep->response->klsRawat->klsRawatNaik == 3) selected @endif>Kelas 1</option>
                        <option value="4" @if ($sep->response->klsRawat->klsRawatNaik == 4) selected @endif>Kelas 2</option>
                        <option value="5" @if ($sep->response->klsRawat->klsRawatNaik == 5) selected @endif>Kelas 3</option>
                    </select>
                </li>
                <li class="list-group-item">
                    <b>Pembiayaan</b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->klsRawat->pembiayaan }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="pembiayaan_update"
                        value="{{ $sep->response->klsRawat->pembiayaan }}">
                </li>
                <li class="list-group-item">
                    <b>Penanggung Jawab</b>
                    <div class="bataledit">
                        <a
                            class="float-right text-dark text-monospace">{{ $sep->response->klsRawat->penanggungJawab }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="penanggungjawab_update"
                        value="{{ $sep->response->klsRawat->penanggungJawab }}">
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Dokter DPJP</b> <a
                        class="float-right text-dark text-monospace">{{ $sep->response->dpjp->nmDPJP }}</a>
                </li>
                <li class="list-group-item">
                    <b>Dokter Kontrol</b>
                    <div class="bataledit">
                        <a class="float-right text-dark text-monospace">{{ $sep->response->kontrol->nmDokter }}</a>
                    </div>
                    <input hidden type="text" class="form-control edit" id="dokterkontrol_update"
                        value="{{ $sep->response->kontrol->nmDokter }}">
                    <input hidden type="text" class="form-control" id="kodedokterkontrol_update"
                        value="{{ $sep->response->kontrol->nmDokter }}">
                </li>
                <li class="list-group-item">
                    <b>No.Surat Kontrol</b> <a
                        class="float-right text-dark text-monospace">{{ $sep->response->kontrol->noSurat }}</a>
                </li>
            </ul>
        </div>
        <div class="col-md-8">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <button disabled class="float-right btn btn-warning editsep" onclick="editsep()"><i
                            class="bi bi-pencil-square"></i> Edit SEP</button>
                    <button hidden class="float-right btn btn-danger mr-2 batledit" onclick="bataledit()"><i
                            class="bi bi-pencil-square"></i> Batal Edit</button>
                    <button hidden class="float-right btn btn-success mr-2 batledit" onclick="simapanedit()"><i
                            class="bi bi-pencil-square"></i> Simpan Edit</button>
                    <a href="cetaksep_v/{{ $sep->response->noSep }}" target="_blank"
                        class="btn btn-primary float-right btn btn-info mr-2"><i class="bi bi-printer"></i> Cetak
                        SEP</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
    function editsep() {
        $('.batledit').removeAttr('Hidden', true)
        $('.edit').removeAttr('Hidden', true)
        $('.editsep').attr('Hidden', true)
        $('.bataledit').attr('Hidden', true)
    }
    function bataledit() {
        $('.batledit').attr('Hidden', true)
        $('.editsep').removeAttr('Hidden', true)
        $('.bataledit').removeAttr('Hidden', true)
        $('.edit').attr('Hidden', true)
        $('.edit').val('')
    }
    function simapanedit() {
        nomorsep = $('#nomorsep_update').val()
        kelasrawathak = $('#hakkelas_update').val()
        klsRawatNaik = $('#kelasnaik_update').val()
        pembiayaan = $('#pembiayaan_update').val()
        penanggungjawab = $('#penanggungjawab_update').val()
        nomorrm = $('#nomorrm_update').val()
        catatan = $('#catatansep_update').val()
        diagnosa = $('#kodediagnosasep_update').val()
        politujuan = $('#kodepolisep_update').val()
        lakaLantas = $('#keterangan_kll_update').val()
        tglkejadian = $('#tglkll_update').val()
        keterangan = $('#keterangankll_update').val()
        suplesi = "0"
        nosuplesi = ""
        kdprop = $('#provinsikejadian_update').val()
        kdkab = $('#kabupatenkejadian_update').val()
        kdkec = $('#kecamatankejadian_update').val()
        dpjpLayan = $('#kodedokterkontrol_update').val()
        notelp = "000000000000"
        spinner = $('#loader');
        spinner.show();
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorsep,
                kelasrawathak,
                klsRawatNaik,
                pembiayaan,
                penanggungjawab,
                nomorrm,
                catatan,
                diagnosa,
                politujuan,
                lakaLantas,
                tglkejadian,
                keterangan,
                suplesi,
                nosuplesi,
                kdprop,
                kdkab,
                kdkec,
                dpjpLayan,
                notelp
            },
            url: '<?= route('vclaimupdatesep') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()               
            }
        });
    }
    $(document).ready(function() {
        $('#polisep_update').autocomplete({
            source: "<?= route('caripoli') ?>",
            select: function(event, ui) {
                spinner.show();
                $('[id="polisep_update"]').val(ui.item.label);
                $('[id="kodepolisep_update"]').val(ui.item.kode);
                spinner.hide();
            }
        });
    });
    $(document).ready(function() {
        $('#dokterkontrol_update').autocomplete({
            source: "<?= route('caridokter') ?>",
            select: function(event, ui) {
                $('[id="dokterkontrol_update"]').val(ui.item.label);
                $('[id="kodedokterkontrol_update"]').val(ui.item.kode);
            }
        });
    });
    $(document).ready(function() {
        $('#diagnosasep_update').autocomplete({
            source: "<?= route('caridiagnosa') ?>",
            select: function(event, ui) {
                $('[id="diagnosasep_update"]').val(ui.item.label);
                $('[id="kodediagnosasep_update"]').val(ui.item.kode);
            }
        });
    });
    $(document).ready(function() {
        $('#provinsikejadian_update').change(function() {
            var sep_laka_prov = $('#provinsikejadian_update').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    prov: sep_laka_prov
                },
                url: '<?= route('carikabupaten') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#kabupatenkejadian_update').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#kabupatenkejadian_update').change(function() {
            var sep_laka_kab = $('#kabupatenkejadian_update').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kab: sep_laka_kab
                },
                url: '<?= route('carikecamatan') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#kecamatankejadian_update').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
</script>
