<div class="card">
    <div class="card-header">Buat surat pengantar</div>
    <div class="card-body">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Jenis Surat Pengantar</label>
            <select class="form-control" id="exampleFormControlSelect1" onchange="gantiform()">
                <option value="1" selected>Surat Konsul Antar Poli</option>
                <option value="2">Surat Rujuk Internal</option>
            </select>
            <div class="card mt-2 suratkonsul">
                <div class="card-header bg-success">Konsul Antar Poli</div>
                <div class="card-body">
                    <form action="" class="formsuratkonsul">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pilih Poli</label>
                            <input type="text" class="form-control" id="unittujuan" name="unittujuan" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Konsul</label>
                            <input type="date" class="form-control" id="tanggalkonsul" name="tanggalkonsul" placeholder="name@example.com">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="konsul1" name="konsul1">
                            <label class="form-check-label" for="defaultCheck1">
                                Konsul Untuk Kondisi saat ini
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="konsul2" name="konsul2">
                            <label class="form-check-label" for="defaultCheck2">
                                Alih Rawat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="konsul3" name="konsul3">
                            <label class="form-check-label" for="defaultCheck2">
                                Tim Medis, sebagai DPJP
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" onclick="simpansurkon()">Simpan surat konsul</button>
                </div>
            </div>
            <div hidden class="card mt-2 suratrujin">
                <div class="card-header bg-success">Rujuk Internal</div>
                <div class="card-body">
                    <form action="" class="formsuratrujukinternal">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pilih Poli</label>
                            <input type="text" class="form-control" id="unittujuan" name="unittujuan" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tanggal Konsul</label>
                            <input type="date" class="form-control" id="tanggalkonsul" name="tanggalkonsul" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan Klinik / Diagnosa </label>
                            <textarea class="form-control" id="keterangan" name="keteranganklinis" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="konsul1" name="konsul1">
                            <label class="form-check-label" for="defaultCheck1">
                                Konsultasi/ Konseling
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="konsul2" name="konsul2">
                            <label class="form-check-label" for="defaultCheck2">
                                Fisioterap
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="konsul3" name="konsul3">
                            <label class="form-check-label" for="defaultCheck2">
                                Rawat Luka
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="konsul4" name="konsul4">
                            <label class="form-check-label" for="defaultCheck2">
                                Tindak lain
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan tindakan lain</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" onclick="simpanrujin()">Simpan surat rujuk internal</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function gantiform() {
        cek = $('#exampleFormControlSelect1').val()
        if (cek == 1) {
            $('.suratkonsul').removeAttr('hidden', true)
            $('.suratrujin').attr('hidden', true)
        } else {
            $('.suratrujin').removeAttr('hidden', true)
            $('.suratkonsul').attr('hidden', true)
        }
    }

    function simpanrujin() {
        var data = $('.formsuratrujukinternal').serializeArray();
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true
            , type: 'post'
            , dataType: 'json'
            , data: {
                _token: "{{ csrf_token() }}"
                , data: JSON.stringify(data)
                , kode_kunjungan
            }
            , url: '<?= route('simpanrujin') ?>'
            , error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error'
                    , title: 'Ooops....'
                    , text: 'Sepertinya ada masalah......'
                    , footer: ''
                })
            }
            , success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oopss...'
                        , text: data.message
                        , footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success'
                        , title: 'OK'
                        , text: data.message
                        , footer: ''
                    })
                }
            }
        });
    }

    function simpansurkon() {
        var data = $('.formsuratkonsul').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true
            , type: 'post'
            , dataType: 'json'
            , data: {
                _token: "{{ csrf_token() }}"
                , data: JSON.stringify(data)
            }
            , url: '<?= route('simpansurkon') ?>'
            , error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error'
                    , title: 'Ooops....'
                    , text: 'Sepertinya ada masalah......'
                    , footer: ''
                })
            }
            , success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oopss...'
                        , text: data.message
                        , footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success'
                        , title: 'OK'
                        , text: data.message
                        , footer: ''
                    })
                }
            }
        });
    }

</script>
