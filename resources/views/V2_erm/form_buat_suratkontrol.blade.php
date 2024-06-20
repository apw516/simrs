<div class="row mt-4">
    <div class="card col-md-4">
        <div class="card-header bg-light">Form surat kontrol</div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nomor Sep</label>
                    <input type="email" readonly class="form-control" id="nomorsep" aria-describedby="emailHelp"
                        value="{{ $nosep }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Kontrol</label>
                    <input type="date" class="form-control" id="tanggalkontrol">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Poli tujuan</label>
                    <div class="input-group mb-3">
                        <input readonly type="text" class="form-control" placeholder="Klik cari poliklinik ..."
                            aria-label="Recipient's username" aria-describedby="button-addon2" id="namapoli">
                        <input hidden readonly type="text" class="form-control"
                            placeholder="Klik cari poliklinik ..." aria-label="Recipient's username"
                            aria-describedby="button-addon2" id="kodepoli">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                onclick="caripoli()" data-toggle="modal" data-target="#modalcaripoli">Cari Poli</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Pilih Dokter</label>
                    <div class="input-group mb-3">
                        <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                            aria-label="Recipient's username" aria-describedby="button-addon2" id="namadokter">
                        <input hidden readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                            aria-label="Recipient's username" aria-describedby="button-addon2" id="kodedokter">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                                onclick="caridokter()" data-toggle="modal" data-target="#modalcaridokter">Cari
                                Dokter</button>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right" disabled>Simpan</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">Riwayat Surat Kontrol</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Bulan</label>
                            <select class="form-control" id="bulan">
                              <option value="01" @if($bulan == '01') selected @endif>Januari</option>
                              <option value="02" @if($bulan == '02') selected @endif>Februari</option>
                              <option value="03" @if($bulan == '03') selected @endif>Maret</option>
                              <option value="04" @if($bulan == '04') selected @endif>April</option>
                              <option value="05" @if($bulan == '05') selected @endif>Mei</option>
                              <option value="06" @if($bulan == '06') selected @endif>Juni</option>
                              <option value="07" @if($bulan == '07') selected @endif>Juli</option>
                              <option value="08" @if($bulan == '08') selected @endif>Agustus</option>
                              <option value="09" @if($bulan == '09') selected @endif>September</option>
                              <option value="10" @if($bulan == '10') selected @endif>Oktober</option>
                              <option value="11" @if($bulan == '11') selected @endif>November</option>
                              <option value="12" @if($bulan == '12') selected @endif>Desember</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Tahun</label>
                            <select class="form-control" id="tahun">
                              <option value="2023" @if($tahun == '2023') selected @endif>2023</option>
                              <option value="2024" @if($tahun == '2024') selected @endif>2024</option>
                              <option value="2025" @if($tahun == '2025') selected @endif>2025</option>
                              <option value="2026" @if($tahun == '2026') selected @endif>2026</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Jenis Pencarian</label>
                            <select class="form-control" id="jenis">
                              <option value="1">Bulan entry</option>
                              <option value="2">Bulan Kontrol</option>
                            </select>
                          </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success btn-sm" style="margin-top:36px" onclick="caririwayat()">Cari</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="v_t_riwayat_surat_kontrol">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalcaripoli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Poli Tujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_data_poli">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalcaridokter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_data_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(function() {
        caririwayat()
    })
    function caripoli() {
        spinner = $('#loader')
        sep = $('#nomorsep').val()
        tgl = $('#tanggalkontrol').val()
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                sep,
                tgl
            },
            url: '<?= route('v2_cari_poli_kontrol') ?>',
            error: function(data) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_data_poli').html(response);
                spinner.hide()
            }
        });
    }
    function caridokter() {
        spinner = $('#loader')
        kode = $('#kodepoli').val()
        tgl = $('#tanggalkontrol').val()
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode,
                tgl
            },
            url: '<?= route('v2_cari_dokter_kontrol') ?>',
            error: function(data) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_data_dokter').html(response);
                spinner.hide()
            }
        });
    }
    function caririwayat()
    {
        bulan = $('#bulan').val()
        tahun = $('#tahun').val()
        jenis = $('#jenis').val()
        nomorkartu = $('#nomorkartu').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                bulan,
                tahun,
                jenis,
                nomorkartu,
            },
            url: '<?= route('v2_cari_riwayat_surat_kontrol') ?>',
            error: function(data) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_t_riwayat_surat_kontrol').html(response);
                spinner.hide()
            }
        });
    }
</script>
