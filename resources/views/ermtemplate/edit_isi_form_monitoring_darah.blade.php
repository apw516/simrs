<form class="isi_edit_form_monitoring">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Nomor Kantong</label>
                <input type="text" class="form-control" id="nomorkantong_mon" name="nomorkantong_mon"
                    aria-describedby="emailHelp" value="{{ $data_mon[0]->no_kantong }}">
                <input hidden readonly type="text" class="form-control" id="id_mon"
                    name="id_mon" aria-describedby="emailHelp" value="{{ $data_mon[0]->idx}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Darah</label>
                <input type="text" class="form-control" id="jd_mon" name="jd_mon"
                    aria-describedby="emailHelp" value="{{ $data_mon[0]->Jenis_darah}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Isi ( ml )</label>
                <input type="text" class="form-control" id="isda_mon" name="isda_mon"
                    aria-describedby="emailHelp" value="{{ $data_mon[0]->isi}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="exampleInputEmail1">Tanggal Monitoring</label>
            <input type="date" class="form-control" id="tgl_mon" name="tgl_mon" aria-describedby="emailHelp"
                value="{{ $data_mon[0]->tgl_monitoring}}">
        </div>
        <div class="col-md-6">
            <label for="exampleInputEmail1">Jam Monitoring</label>
            <input type="text" class="form-control" id="jm_mon" name="jm_mon" aria-describedby="emailHelp"
                value="{{ $data_mon[0]->jam_monitoring }}" placeholder="00:00">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <table class="table">
                <tr class="text-center bg-dark">
                    <td colspan="4">TTV</td>
                </tr>
                <tr class="bg-secondary text-center">
                    <td>TD (mmHg)</td>
                    <td>Nadi ( x/menit )</td>
                    <td>RR ( x/menit )</td>
                    <td>S ( °C )</td>
                </tr>
                <tr class="bg-secondary">
                    <td><input type="text" class="form-control" name="td_mon" id="td_mon" value="{{ $data_mon[0]->ttv_td }}"></td>
                    <td><input type="text" class="form-control" name="nadi_mon" id="nadi_mon" value="{{ $data_mon[0]->ttv_nadi }}"></td>
                    <td><input type="text" class="form-control" name="rr_mon" id="rr_mon" value="{{ $data_mon[0]->ttv_rr }}"></td>
                    <td><input type="text" class="form-control" name="s_mon" id="s_mon" value="{{ $data_mon[0]->ttv_s }}"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3">
            <div class="form-group">
                <label for="exampleInputPassword1">Reaksi - / + </label>
                <textarea type="text" class="form-control" id="reaksi_mon" name="reaksi_mon" rows="4">{{ $data_mon[0]->reaksi }}</textarea>
            </div>
        </div>
    </div>
</form>
