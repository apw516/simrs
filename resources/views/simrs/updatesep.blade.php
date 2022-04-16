<div class="container">
    {{-- @dd($detailsep) --}}
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor SEP</label>
                        <input readonly type="text" class="form-control" value="{{ $detailsep->response->noSep }}" id="sep_update">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor RM</label>
                        <input readonly type="text" class="form-control" id="nomorm_update"
                            value="{{ $detailsep->response->peserta->noMr }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hak kelas</label>
                        <input type="text" readonly class="form-control" id="hakkelas_update"
                            value="{{ $detailsep->response->klsRawat->klsRawatHak }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">kelas rawat naik</label>
                        <select class="form-control" id="kelasnaik_update">
                            <option value="">-- Silahkan Pilih --</option>
                            <option value="1" @if($detailsep->response->klsRawat->klsRawatNaik == 1) selected @endif>VVIP</option>
                            <option value="2" @if($detailsep->response->klsRawat->klsRawatNaik == 2) selected @endif>VIP</option>
                            <option value="3" @if($detailsep->response->klsRawat->klsRawatNaik == 3) selected @endif>Kelas 1</option>
                            <option value="4" @if($detailsep->response->klsRawat->klsRawatNaik == 4) selected @endif>Kelas 2</option>
                            <option value="5" @if($detailsep->response->klsRawat->klsRawatNaik == 5) selected @endif>Kelas 3</option>
                            <option value="6" @if($detailsep->response->klsRawat->klsRawatNaik == 6) selected @endif>ICCU</option>
                            <option value="7" @if($detailsep->response->klsRawat->klsRawatNaik == 7) selected @endif>ICU</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pembiayaan</label>
                        <select class="form-control" id="pembiayaan_update">
                            <option value="">-- Silahkan Pilih --</option>
                            <option value="1" @if($detailsep->response->klsRawat->pembiayaan == 1) selected @endif>Pribadi</option>
                            <option value="2" @if($detailsep->response->klsRawat->pembiayaan == 2) selected @endif>Pemberi Kerja</option>
                            <option value="3" @if($detailsep->response->klsRawat->pembiayaan == 3) selected @endif>Asuransi Kesehatan Tambahan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="penanggungjawab_update" placeholder="Contoh : Pribadi..."
                            value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Poli Tujuan</label>
                        <input type="text" id="editpolitujuan" class="form-control" value="{{ $detailsep->response->poli }}">
                        <input hidden type="text" id="editkodepolitujuan"readonly class="form-control" value="{{ $kodepoli }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Poli Eksekutif</label>
                        <select class="form-control" id="polieks">
                            <option value="1" @if($detailsep->response->poliEksekutif == 1) selected @endif>YA</option>
                            <option value="0" @if($detailsep->response->poliEksekutif == 0) selected @endif>TIDAK</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">COB</label>
                        <select class="form-control" id="cob">
                            <option value="1" @if($detailsep->response->katarak == 1) selected @endif>YA</option>
                            <option value="0" @if($detailsep->response->katarak == 0) selected @endif>TIDAK</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Katarak</label>
                        <select class="form-control" id="katarak">
                            <option value="1" @if($detailsep->response->cob == 1) selected @endif>YA</option>
                            <option value="0" @if($detailsep->response->cob == 0) selected @endif>TIDAK</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status Kecelakaan</label>
                        <select class="form-control" id="statuslaka">
                            <option value="0" @if ($detailsep->response->kdStatusKecelakaan == '0') selected @endif>Bukan Kecelakaan lalu
                                lintas</option>
                            <option value="1">KLL dan bukan kecelakaan Kerja</option>
                            <option value="2">KLL dan KK</option>
                            <option value="3">Kecelakaan Kerja</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl Kejadian</label>
                        <input type="text" class="form-control datepicker" id="tgllaka"
                            value="{{ $detailsep->response->lokasiKejadian->tglKejadian }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Keterangan</label>
                        <textarea type="text" class="form-control" id="ketlaka"
                            value="{{ $detailsep->response->lokasiKejadian->ketKejadian }}"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">DPJP Layan</label>
                        <input type="text" class="form-control" id="namadokterlayan2"value="{{ $detailsep->response->dpjp->nmDPJP }}">
                        <input hidden type="text" id="kodedokterlayan2" value="{{ $detailsep->response->dpjp->kdDPJP }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">NO Suplesi</label>
                        <input type="text" class="form-control" value="" id="sepsuplesi">
                        <small id="emailHelp" class="form-text text-danger">* Diisi jika ada sep suplesi
                            jasaraharja</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosa</label>
                        <textarea type="text" class="form-control" id="diagnosa">{{ $detailsep->response->diagnosa }}</textarea>
                        <input type="text" class="form-control" value="{{ substr($sepkontrol->response->diagnosa,0,5) }}" id="kodediagnosa">
                        <small id="emailHelp" class="form-text text-danger">* Ketik diagnosa </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Provinsi Kecelakaan</label>
                        <select class="form-control" id="updateprovlaka">
                            <option value=""> -- Silahkan Pilih --</option>
                            @foreach ($propinsi->response->list as $p)
                                <option value="{{ $p->kode }}" @if ($detailsep->response->lokasiKejadian->kdProp == $p->kode) selected @endif>
                                    {{ $p->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kabupaten Kecelakaan</label>
                        <select class="form-control" id="updatekablaka">
                            <option value=""> -- Silahkan Pilih --</option>
                            @if ($kabupaten->metaData->code == 200)
                                @foreach ($kabupaten->response->list as $p)
                                    <option value="{{ $p->kode }}"
                                        @if ($detailsep->response->lokasiKejadian->kdKab == $p->kode) selected @endif>{{ $p->nama }}</option>
                                @endforeach
                            @endif;
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kecamatan Kecelakaan</label>
                        <select class="form-control" id="updatekeclaka">
                            <option value=""> -- Silahkan Pilih --</option>
                            @if ($kecamatan->metaData->code == 200)
                                @foreach ($kecamatan->response->list as $p)
                                    <option value="{{ $p->kode }}"
                                        @if ($detailsep->response->lokasiKejadian->kdKec == $p->kode) selected @endif>{{ $p->nama }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nomor Telp</label>
                       <input type="text" class="form-control" id="nomortelp" value="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.ui-menu .ui-menu-item a {
  font-size: 12px;
}
.ui-autocomplete {
  position: absolute;
  top: 0;
  left: 0;
  z-index: 1510 !important;
  float: left;
  display: none;
  min-width: 160px;
  width: 160px;
  padding: 4px 0;
  margin: 2px 0 0 0;
  list-style: none;
  background-color: #ffffff;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 2px;
  -moz-border-radius: 2px;
  border-radius: 2px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.ui-menu-item > a.ui-corner-all {
    display: block;
    padding: 3px 15px;
    clear: both;
    font-weight: normal;
    line-height: 18px;
    color: #555555;
    white-space: nowrap;
    text-decoration: none;
}
.ui-state-hover, .ui-state-active {
      color: #ffffff;
      text-decoration: none;
      background-color: #0088cc;
      border-radius: 0px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0px;
      background-image: none;
}
</style>
<script>
    $(document).ready(function() {
        $('#diagnosa').autocomplete({
            source: "<?= route('caridiagnosa');?>",
            select: function(event, ui) {
                $('[id="diagnosa"]').val(ui.item.label);
                $('[id="kodediagnosa"]').val(ui.item.kode);
            }
        });
    });
     $(document).ready(function() {
        $('#editpolitujuan').autocomplete({
            source: "<?= route('caripoli');?>",
            select: function(event, ui) {
                spinner.show();
                $('[id="editpolitujuan"]').val(ui.item.label);
                $('[id="editkodepolitujuan"]').val(ui.item.kode);
                spinner.hide();

            }
        });
    });
     $(document).ready(function() {
        $('#namadokterlayan2').autocomplete({
            source: "<?= route('caridokter');?>",
            select: function(event, ui) {
                $('[id="namadokterlayan2"]').val(ui.item.label);
                $('[id="kodedokterlayan2"]').val(ui.item.kode);
            }
        });
    });
    $(document).ready(function() {
        $('#updateprovlaka').change(function() {
            var sep_laka_prov = $('#updateprovlaka').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    prov: sep_laka_prov
                },
                url: '<?= route('carikabupaten');?>',
                success: function(response) {
                    spinner.hide();
                    $('#updatekablaka').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
    $('#updatekablaka').change(function() {
        var sep_laka_kab = $('#updatekablaka').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kab: sep_laka_kab
            },
            url: '<?= route('carikecamatan');?>',
            success: function(response) {
                spinner.hide();
                $('#updatekeclaka').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    });
});
</script>
