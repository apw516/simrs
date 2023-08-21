<form class="isi_form_monitoring">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Nomor Kantong</label>
                <input readonly type="text" class="form-control" id="nomorkantong_mon" name="nomorkantong_mon"
                    aria-describedby="emailHelp" value="{{ $nomorkantong }}">
                <input hidden readonly type="text" class="form-control" id="kode_kunjungan_mon"
                    name="kode_kunjungan_mon" aria-describedby="emailHelp" value="{{ $kodekunjungan }}">
                <input hidden readonly type="text" class="form-control" id="id_reak" name="id_reak"
                    aria-describedby="emailHelp" value="{{ $id }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Darah</label>
                <input readonly type="text" class="form-control" id="jd_mon" name="jd_mon"
                    aria-describedby="emailHelp" value="{{ $jenis }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Isi ( ml )</label>
                <input readonly type="text" class="form-control" id="isda_mon" name="isda_mon"
                    aria-describedby="emailHelp" value="{{ $isi }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1">Tanggal Monitoring</label>
            <input type="date" class="form-control" id="tgl_mon" name="tgl_mon" aria-describedby="emailHelp"
                value="">
        </div>
        <div class="col-md-6">
            <label for="exampleInputEmail1">Jam Monitoring</label>
            <input type="text" class="form-control" id="jm_mon" name="jm_mon" aria-describedby="emailHelp"
                value="">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <table class="table">
                <tr class="text-center bg-dark">
                    <td colspan="4">TTV</td>
                </tr>
                <tr class="bg-secondary text-center">
                    <td>TD</td>
                    <td>Nadi</td>
                    <td>RR</td>
                    <td>S</td>
                </tr>
                <tr class="bg-secondary">
                    <td><input type="text" class="form-control" name="td_mon" id="td_mon"></td>
                    <td><input type="text" class="form-control" name="nadi_mon" id="nadi_mon"></td>
                    <td><input type="text" class="form-control" name="rr_mon" id="rr_mon"></td>
                    <td><input type="text" class="form-control" name="s_mon" id="s_mon"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mb-4">
            <div class="form-group">
                <label for="exampleInputPassword1">Riwayat alergi</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                    value="1">
                <label class="form-check-label" for="inlineRadio1">Ada</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                    value="0" checked>
                <label class="form-check-label" for="inlineRadio2">Tidak Ada</label>
            </div>
            <textarea type="text" class="form-control" id="ket_alergi" name="ket_alergi" rows="4" placeholder="keterangan alergi ..."></textarea>
        </div>
        <div class="col-md-12 mb-4">
            <div class="form-group">
                <label for="exampleInputPassword1">Pernah transfusi darah / produk darah</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                    value="1">
                <label class="form-check-label" for="inlineRadio1">Ada</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                    value="0" checked>
                <label class="form-check-label" for="inlineRadio2">Tidak</label>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="exampleInputPassword1">Reaksi - / + </label>
                <textarea type="text" class="form-control" id="reaksi_mon" name="reaksi_mon" rows="4"></textarea>
            </div>
        </div>
    </div>
</form>
