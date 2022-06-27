<div class="row justify-content-center">
    <div class="card col-sm-5">
        <div class="col-md-12">
            <H4 class="mb-3 text-bold text-danger">DATA PASIEN</H4>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor RM</label>
                        <input class="form-control" id="edit_nomorrm" value="{{ $data_pasien[0]['no_rm'] }}"
                            placeholder="masukan nomor ktp ...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor KTP</label>
                        <input class="form-control" id="edit_nomorktp" value="{{ $data_pasien[0]['nik_bpjs'] }}"
                            placeholder="masukan nomor ktp ...">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor BPJS</label>
                        <input class="form-control" id="edit_nomorbpjs" value="{{ $data_pasien[0]['no_Bpjs'] }}"
                            placeholder="masukan nomor bpjs ...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pasien</label>
                        <input class="form-control" id="edit_namapasien" value="{{ $data_pasien[0]['nama_px'] }}"
                            placeholder="masukan nama pasien ...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tempat</label>
                        <input class="form-control" id="edit_tempatlahir"
                            value="{{ $data_pasien[0]['tempat_lahir'] }}"placeholder="ketik tempat lahir">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tgl lahir</label>
                        <input class="form-control datepicker" data-date-format="yyyy-mm-dd" id="edit_tanggallahir"
                            value="{{ $data_pasien[0]['tgl_lahir'] }}"placeholder="">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin</label>
                        <select class="form-control" id="edit_jeniskelamin">
                            <option value="">--Silahkan Pilih--</option>
                            <option @if ($data_pasien[0]['jenis_kelamin'] == 'L') selected @endif value="L">Laki - Laki
                            </option>
                            <option @if ($data_pasien[0]['jenis_kelamin'] == 'P') selected @endif value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Agama</label>
                        <select class="form-control" id="edit_agama">
                            <option value="">--Silahkan Pilih--</option>
                            @foreach ($agama as $a)
                                <option @if ($data_pasien[0]['agama'] == $a->ID) selected @endif value="{{ $a->ID }}">
                                    {{ $a->agama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pekerjaan</label>
                        <select class="form-control" id="edit_pekerjaan">
                            <option value="">--Silahkan Pilih--</option>
                            @foreach ($pekerjaan as $a)
                                <option @if ($data_pasien[0]['pekerjaan'] == $a->ID) selected @endif value="{{ $a->ID }}">
                                    {{ $a->pekerjaan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pendidikan</label>
                        <select class="form-control" id="edit_pendidikan">
                            <option value="">--Silahkan Pilih--</option>
                            @foreach ($pendidikan as $a)
                                <option @if ($data_pasien[0]['pendidikan'] == $a->ID) selected @endif value="{{ $a->ID }}">
                                    {{ $a->pendidikan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nomor Telp</label>
                        <input class="form-control" value="{{ $data_pasien[0]['no_hp'] }}" id="edit_nomortelp"
                            aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <h5 class="mt-2 text-bold text-danger">Data keluarga</h5>
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Keluarga</label>
                        @if($status_k > 0)
                        <input class="form-control" id="edit_namakeluarga"
                            value="{{ $data_keluarga[0]['nama_keluarga'] }}" aria-describedby="emailHelp">
                        @else
                        <input class="form-control" id="edit_namakeluarga"
                            value="" aria-describedby="emailHelp">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hubungan</label>
                        <select class="form-control" id="edit_hubungankeluarga">
                            <option value="">--Silahkan Pilih--</option>
                            @foreach ($hubkel as $a)
                            @if($status_k > 0)
                                <option @if ($data_keluarga[0]['hubungan_keluarga'] == $a->kode) selected @endif value="{{ $a->kode }}">
                                    {{ $a->nama_hubungan }}</option>
                                    @else
                                    <option value="{{ $a->kode }}">
                                        {{ $a->nama_hubungan }}</option>
                                    @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Telp</label>
                        @if($status_k > 0)
                        <input class="form-control"
                            value="{{ $data_keluarga[0]['tlp_keluarga'] }}"id="edit_telpkeluarga"
                            aria-describedby="emailHelp">
                        @else
                            <input class="form-control"
                                value=""id="edit_telpkeluarga"
                                aria-describedby="emailHelp">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        @if($status_k > 0)
                        <textarea class="form-control" id="edit_alamatkeluarga" aria-describedby="emailHelp">
                            {{ $data_keluarga[0]['alamat_keluarga'] }}
                        </textarea>
                        @else
                        <textarea class="form-control" id="edit_alamatkeluarga" aria-describedby="emailHelp">
                            
                        </textarea>
                        @endif
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
                        <select class="form-control" id="edit_kewarganegaraan">
                            <option value="">--Silahkan Pilih--</option>
                            <option @if ($data_pasien[0]['kewarganegaraan'] == 1) selected @endif value="1">WNI</option>
                            <option @if ($data_pasien[0]['kewarganegaraan'] == 2) selected @endif value="2">WNA</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Negara</label>
                        <select class="form-control text-xs" id="edit_negara">
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
                        <select class="form-control" id="edit_provinsi">
                            <option value="">--Silahkan Pilih--</option>
                            @foreach ($provinsi as $a)
                                <option @if ($data_pasien[0]['kode_propinsi'] == $a->id) selected @endif value="{{ $a->id }}">
                                    {{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kabupaten</label>
                        <select class="form-control" id="edit_kabupaten">
                            @foreach ($kabupaten as $a)
                                <option @if ($data_pasien[0]['kabupaten'] == $a->id) selected @endif
                                    value="{{ $a->id }}">
                                    {{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kecamatan</label>
                        <select class="form-control" id="edit_kecamatan">
                            @foreach ($kecamatan as $a)
                                <option @if ($data_pasien[0]['kecamatan'] == $a->id) selected @endif
                                    value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Desa</label>
                        <select class="form-control" id="edit_desa">
                            @foreach ($desa as $a)
                                <option @if ($data_pasien[0]['kode_desa'] == $a->id) selected @endif
                                    value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" aria-describedby="emailHelp">{{ $data_pasien[0]['alamat'] }}</textarea>
                    </div>
                </div>
            </div>

            <H4 class="mb-3 text-bold text-danger">Alamat Domisili</H4>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="edit_sesuaiktp" value="1">
                <label class="form-check-label" for="exampleCheck1">Sesuai KTP</label>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Provinisi</label>
                        <select class="form-control" id="edit_provinisidom">
                            @foreach ($provinsi as $a)
                            @if($status_dom > 0)
                                <option @if ($domisili[0]['kd_prop'] == $a->id)selected @endif value="{{ $a->id }}">{{ $a->name }}</option>
                                @else
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kabupaten</label>
                        <select class="form-control" id="edit_kabupatendom">
                            @foreach ($kabupatendom as $a)
                            @if($status_dom > 0)
                                <option @if ($domisili[0]['kd_kabupaten'] == $a->id)selected @endif value="{{ $a->id }}">{{ $a->name }}</option>
                                @else
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kecamatan</label>
                        <select class="form-control" id="edit_kecamatandom">
                            @foreach ($kecamatandom as $a)
                            @if($status_dom > 0)
                                <option @if ($domisili[0]['kd_kecamatan'] == $a->id)selected @endif value="{{ $a->id }}">{{ $a->name }}</option>
                                @else
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Desa</label>
                        <select class="form-control" id="edit_desadom">
                            @foreach ($desadom as $a)
                            @if($status_dom > 0)
                                <option @if ($domisili[0]['kd_desa'] == $a->id)selected @endif value="{{ $a->id }}">{{ $a->name }}</option>
                                @else
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        @if($status_dom > 0)
                        @else
                        <textarea class="form-control" id="edit_alamatdom" aria-describedby="emailHelp"></textarea>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="updatepasien()">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
</div>
<script>
    $(document).ready(function() {
        $('#edit_provinsi').change(function() {
            var provinsi = $('#edit_provinsi').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    provinsi: provinsi
                },
                url: '<?= route('carikab_local') ?>',
                success: function(response) {
                    $('#edit_kabupaten').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#edit_kabupaten').change(function() {
            var kabupaten = $('#edit_kabupaten').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kabupaten: kabupaten
                },
                url: '<?= route('carikec_local') ?>',
                success: function(response) {
                    $('#edit_kecamatan').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#edit_kecamatan').change(function() {
            var kecamatan = $('#edit_kecamatan').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kecamatan: kecamatan
                },
                url: '<?= route('caridesa_local') ?>',
                success: function(response) {
                    $('#edit_desa').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#edit_provinisidom').change(function() {
            var provinsi = $('#edit_provinisidom').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    provinsi: provinsi
                },
                url: '<?= route('carikab_local') ?>',
                success: function(response) {
                    $('#edit_kabupatendom').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#edit_kabupatendom').change(function() {
            var kabupaten = $('#edit_kabupatendom').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kabupaten: kabupaten
                },
                url: '<?= route('carikec_local') ?>',
                success: function(response) {
                    $('#edit_kecamatandom').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#edit_kecamatandom').change(function() {
            var kecamatan = $('#edit_kecamatandom').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kecamatan: kecamatan
                },
                url: '<?= route('caridesa_local') ?>',
                success: function(response) {
                    $('#edit_desadom').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
</script>
