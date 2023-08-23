<div class="card">
    <div class="card-header bg-warning">FORM MONITORING DARAH</div>
    <div class="card-body">
        <div class="row">
            {{-- <button class="btn btn-success mb-2"><i class="bi bi-journal-plus mr-2"></i> Form</button> --}}
            <div class="col-md-12">
                <button class="btn btn-success mb-2 btn-darah" data-toggle="modal" data-target="#modal_kantong_darah">+
                    Kantong Darah</button>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">Data Transfusi Darah</div>
                    <div class="card-body">
                        <div class="header_darah">
                            <table class="table table-sm table-bordered table-hover" id="tabel_riwayat_transfusi">
                                <thead>
                                    <th>Tanggal Transfusi</th>
                                    <th>Jenis Darah</th>
                                    <th>Diagnosa Klinis</th>
                                    <th>Nomor Kantong</th>
                                    <th>action</th>
                                </thead>
                                <tbody>
                                    @foreach ($datareaksi as $d)
                                        <tr class="pilikantongdarah">
                                            <td>{{ $d->tgl_transfusi }}</td>
                                            <td>{{ $d->Jenis_darah }}</td>
                                            <td>{{ $d->diag_klinis }}</td>
                                            <td>{{ $d->no_kantong }}</td>
                                            <td>
                                                <button class="badge badge-warning isimon"
                                                    nomorkantong="{{ $d->no_kantong }}"
                                                    kodekunjungan="{{ $d->kode_kunjungan }}" id="{{ $d->idx }}"
                                                    isi="{{ $d->isi }}" jenis="{{ $d->Jenis_darah }}"
                                                    data-toggle="modal" data-target="#modalmonitoring"
                                                    data-placement="right" title="Input Monitoring"><i
                                                        class="bi bi-bar-chart-line"></i></button>
                                                <button class="badge badge-danger hapustransfusi"
                                                    id="{{ $d->idx }}" data-placement="right"
                                                    title="Hapus data transfusi"><i class="bi bi-trash"></i></button>
                                                <button class="badge badge-info edittransfusi" id="{{ $d->idx }}"
                                                    data-placement="right" title="edit data transfusi"
                                                    data-toggle="modal" data-target="#modaledittransfusi"><i
                                                        class="bi bi-pencil-square"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-warning">Hasil Monitoring Transfusi Darah</div>
    <div class="card-body">
        <div class="tabel_monitoring">
            @foreach ($datareaksi as $d)
                <div class="card">
                    <div class="card-header bg-secondary">Nomor Kantong {{ $d->no_kantong }}</div>
                    <div class="card-body">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="bi bi-prescription2"></i>Nomor Kantong {{ $d->no_kantong }}
                                        <small class="float-right">Tanggal : {{ $d->tgl_transfusi }}</small>
                                    </h4>
                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-12 invoice-col">
                                    Ruang Rawat
                                    <address>
                                        <strong>{{ $d->asal_unit }}</strong><br>
                                        Diagnosa Klinis : {{ $d->diag_klinis }}<br>
                                        Jenis Darah : {{ $d->Jenis_darah }}<br>
                                        Nomor Kantong Darah : {{ $d->no_kantong }} Mulai Transfusi :
                                        {{ $d->mulai_transfusi }} Selesai Transfusi : {{ $d->selesai_transfusi }}<br>
                                        Volume yang sudah ditransfusikan : {{ $d->volume_pakai }}
                                    </address>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-sm table-boredered table-hover table-striped">
                                        <thead>
                                            <th>Nomor Kantong</th>
                                            <th>Isi ( ml )</th>
                                            <th>Tgl Monitoring</th>
                                            <th>Jam Monitoring</th>
                                            <th>Tekanan Darah ( mmHg )</th>
                                            <th>Nadi ( x/menit )</th>
                                            <th>RR ( x/menit )</th>
                                            <th>S ( °C ) </th>
                                            <th>Reaksi - / + </th>
                                            <th>---</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($datamonitoring as $dm)
                                                @if ($dm->no_kantong == $d->no_kantong)
                                                    <tr>
                                                        <td>{{ $dm->no_kantong }}</td>
                                                        <td>{{ $dm->isi }}</td>
                                                        <td>{{ $dm->tgl_monitoring }}</td>
                                                        <td>{{ $dm->jam_monitoring }}</td>
                                                        <td>{{ $dm->ttv_td }}</td>
                                                        <td>{{ $dm->ttv_nadi }}</td>
                                                        <td>{{ $dm->ttv_rr }}</td>
                                                        <td>{{ $dm->ttv_s }}</td>
                                                        <td>{{ $dm->reaksi }}</td>
                                                        <td>
                                                            <button class="badge badge-success pilihmon"
                                                                id="{{ $dm->idx }}" data-toggle="modal"
                                                                data-target="#modalreaksi" data-placement="right"
                                                                title="Input reaksi"><i
                                                                    class="bi bi-pencil-square"></i></button>
                                                            <button class="badge badge-danger hapusmonitoring" id="{{ $dm->idx }}"  data-placement="right"
                                                                title="Hapus monitoring"><i
                                                                    class="bi bi-trash"></i></button>
                                                            <button class="badge badge-info editmonitoring" id="{{ $dm->idx }}" data-placement="right"
                                                                title="edit monitoring" data-toggle="modal"
                                                                data-target="#modaleditmonitoring"><i
                                                                    class="bi bi-pencil-square"></i></button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <p class="lead">Daftar Check</p>
                                    <form>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">Apakah identitas
                                                Pasien Benar ?</label>
                                            <div class="col-sm-6">
                                                @if ($d->check_identitas == 1)
                                                    Benar
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="staticEmail" class="col-sm-6 col-form-label">Kantong darah Benar
                                                ?</label>
                                            <div class="col-sm-6">
                                                @if ($d->check_kantong == 1)
                                                    Benar
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <p class="lead">Suhu badan dalam 24 Jam</p>
                                    <form>
                                        @if ($d->check_suhu == 1)
                                            Demam
                                        @else
                                            Tidak demam
                                        @endif
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    @php $tv_sebelum = explode('|',$d->tv_sebelum_reaksi ) @endphp
                                    @php $tv_sesudah = explode('|',$d->tv_terjadi_reaksi ) @endphp
                                    @php $gejala_klinis = explode('|',$d->Gejala_klinis ) @endphp
                                    @php
                                        $cek_tv_sebelum = count($tv_sebelum);
                                    @endphp
                                    @php
                                        $cek_tv_sesudah = count($tv_sesudah);
                                    @endphp
                                    @php
                                        $cek_gejala_klinis = count($gejala_klinis);
                                    @endphp
                                    <label for="">Tanda Vital</label>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <th></th>
                                            <th>Jam</th>
                                            <th>Suhu</th>
                                            <th>Frek Nafas</th>
                                            <th>B.P</th>
                                            <th>Nadi</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Sebelum Terjadi Reaksi</td>
                                                <td>
                                                    @if ($cek_tv_sebelum > 1)
                                                        {{ $tv_sebelum[0] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sebelum > 1)
                                                        {{ $tv_sebelum[1] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sebelum > 1)
                                                        {{ $tv_sebelum[2] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sebelum > 1)
                                                        {{ $tv_sebelum[3] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sebelum > 1)
                                                        {{ $tv_sebelum[4] }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Pada Waktu Terjadi Reaksi</td>
                                                <td>
                                                    @if ($cek_tv_sesudah > 1)
                                                        {{ $tv_sesudah[0] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sesudah > 1)
                                                        {{ $tv_sesudah[1] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sesudah > 1)
                                                        {{ $tv_sesudah[2] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sesudah > 1)
                                                        {{ $tv_sesudah[3] }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($cek_tv_sesudah > 1)
                                                        {{ $tv_sesudah[4] }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Gejala dan tanda klinis</label>
                                </div>
                                <div class="col-md-4">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Demam</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[0] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Mengigil</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[1] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Gatal - gatal</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[2] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Lainnya </label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[3] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Nyeri pinggang
                                        bawah</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[4] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Nyeri dada</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[5] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Cemas</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[6] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Sakit Kepala </label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[7] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                </div>
                                <div class="col-md-4">
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Kulit biru</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[8] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Bak gelas</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[9] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Sesak nafas</label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[10] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                    <label for="staticEmail" class="col-sm-6 col-form-label">Perdarahan dari luka
                                    </label>
                                    @if ($cek_gejala_klinis > 1)
                                        @if ($gejala_klinis[11] == 1)
                                            Ya
                                        @endif
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_kantong_darah" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">+ Kantong Darah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-add_darah">
                    <input hidden type="text" class="form-control" value="{{ $kodekunjungan }}"
                        name="kodekunjungan" id="kodekunjungan">
                    <input hidden type="text" class="form-control" value="{{ $nomorrm }}" name="nomorrm"
                        id="nomorrm">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ruang Rawat</label>
                                    <select class="form-control" id="ruangrawat" name="ruangrawat">
                                        <option value="">Silahkan Pillih</option>
                                        @foreach ($unit as $u)
                                            <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Transfusi</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Darah</label>
                                <input type="text" class="form-control" id="jenisdarah" name="jenisdarah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa Klinis</label>
                                <input type="text" class="form-control" id="diagnosaklinis" name="diagnosaklinis"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Mulai Transfusi</label>
                                <input type="text" class="form-control" id="mulai_tf" name="mulai_tf"
                                    aria-describedby="emailHelp" placeholder="00:00">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Selesai Transfusi</label>
                                <input type="text" class="form-control" id="selesai_tf" name="selesai_tf"
                                    aria-describedby="emailHelp" placeholder="00:00">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Kantong Darah</label>
                                <input type="text" class="form-control" id="noka_darah" name="noka_darah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Isi ( ml )</label>
                                <input type="text" class="form-control" id="isi_darah" name="isi_darah"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Volume yang sudah ditransfusi</label>
                                <input type="text" class="form-control" id="vol_tf" name="vol_tf"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Riwayat alergi</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                                value="0" checked>
                            <label class="form-check-label" for="inlineRadio2">Tidak Ada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                                value="1">
                            <label class="form-check-label" for="inlineRadio1">Ada</label>
                        </div>
                        <textarea type="text" class="form-control" id="ket_alergi" name="ket_alergi" rows="4"
                            placeholder="keterangan alergi ..."></textarea>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Pernah transfusi darah / produk darah</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                                value="0" checked>
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                                value="1">
                            <label class="form-check-label" for="inlineRadio1">Ada</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpan_header_darah()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaledittransfusi" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">+ Edit Kantong Darah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form_edit_transfusi">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpan_edit_header_darah()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalmonitoring" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Monitoring Transfusi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-monitoring">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanmonitoring()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaleditmonitoring" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Monitoring Transfusi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-edit-monitoring">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpaneditmonitoring()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalreaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Data Reaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-input_reaksi">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanreaksi()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabel_riwayat_transfusi").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });

    function simpan_header_darah() {
        var data = $('.form-add_darah').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpandarah') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    $('#modal_kantong_darah').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }

    function simpan_edit_header_darah() {
        var data = $('.form-edit_add_darah').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpaneditdarah') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    $('#modaledittransfusi').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }
    $(".isimon").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        nomorkantong = $(this).attr('nomorkantong')
        id = $(this).attr('id')
        isi = $(this).attr('isi')
        jenis = $(this).attr('jenis')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                nomorkantong,
                id,
                isi,
                jenis
            },
            url: '<?= route('ambilform_monitoring') ?>',
            success: function(response) {
                $('.form-monitoring').html(response);
            }
        });

    });
    $(".editmonitoring").on('click', function(event) {
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambilform_editmonitoring') ?>',
            success: function(response) {
                $('.form-edit-monitoring').html(response);
            }
        });

    });
    $(".pilihmon").on('click', function(event) {
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambilform_input_reaksi') ?>',
            success: function(response) {
                $('.form-input_reaksi').html(response);
            }
        });

    });
    $(".edittransfusi").on('click', function(event) {
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambilform_edit_transfusi') ?>',
            success: function(response) {
                $('.form_edit_transfusi').html(response);
            }
        });

    });
    $(".hapustransfusi").on('click', function(event) {
        id = $(this).attr('id')
        Swal.fire({
            title: 'Hapus data transfusi ?',
            text: "Hapus data transfusi juga akan menghapus data monitoringnya...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus !'
        }).then((result) => {
            if (result.isConfirmed) {
                hapustransfusi(id)
            }
        })
    });
    $(".hapusmonitoring").on('click', function(event) {
        id = $(this).attr('id')
        Swal.fire({
            title: 'Hapus data monitoring ?',
            text: "Anda bisa membatalkan dengan klik cancel",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus !'
        }).then((result) => {
            if (result.isConfirmed) {
                hapusmonitoring(id)
            }
        })
    });
    function hapustransfusi(id)
    {
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('hapusdarah') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    formmonitoringdarah()
                }
            }
        });
    }
    function hapusmonitoring(id)
    {
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('hapusmonitoring') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    formmonitoringdarah()
                }
            }
        });
    }
    function simpanmonitoring() {
        var data = $('.isi_form_monitoring').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpanmonitoring_darah') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    $('#modalmonitoring').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }
    function simpaneditmonitoring() {
        var data = $('.isi_edit_form_monitoring').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpaneditmonitoring_darah') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    $('#modaleditmonitoring').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }

    function simpanreaksi() {
        var data = $('.form-data-reaksi').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpanhasil_reaksi') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    $('#modalreaksi').modal('hide');
                    formmonitoringdarah()
                }
            }
        });
    }
</script>
