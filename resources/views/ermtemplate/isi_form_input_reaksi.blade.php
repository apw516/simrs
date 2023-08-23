<form class="form-data-reaksi">
    <input hidden type="text" class="form-control" value="{{ $data_mon[0]->idx }}" name="kodemonitoring"
        id="kodemonitoring">
    <input hidden type="text" class="form-control" value="{{ $data_reaksi[0]->idx }}" name="kodereaksi"
        id="kodereaksi">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ruang Rawat</label>
                    <select class="form-control" id="ruangrawat" name="ruangrawat">
                        <option value="">Silahkan Pillih</option>
                        @foreach ($unit as $u)
                            <option value="{{ $u->kode_unit }}" @if($u->kode_unit == $data_reaksi[0]->asal_unit) selected @endif>{{ $u->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Transfusi</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->tgl_transfusi}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Reaksi</label>
                <input type="date" class="form-control" id="tanggal_reaksi" name="tanggal_reaksi"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->tgl_transfusi}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Darah</label>
                <input type="text" class="form-control" id="jenisdarah" name="jenisdarah"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->Jenis_darah}}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Diagnosa Klinis</label>
                <input type="text" class="form-control" id="diagnosaklinis" name="diagnosaklinis"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->diag_klinis}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Jam Mulai Transfusi</label>
                <input type="text" class="form-control" id="mulai_tf" name="mulai_tf"
                    aria-describedby="emailHelp" placeholder="00:00" value="{{ $data_reaksi[0]->mulai_transfusi}}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Jam Selesai Transfusi</label>
                <input type="text" class="form-control" id="selesai_tf" name="selesai_tf"
                    aria-describedby="emailHelp" placeholder="00:00" value="{{ $data_reaksi[0]->selesai_transfusi}}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Nomor Kantong Darah</label>
                <input type="text" class="form-control" id="noka_darah" name="noka_darah"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->no_kantong}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Isi ( ml )</label>
                <input type="text" class="form-control" id="isi_darah" name="isi_darah"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->isi}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Volume yang sudah ditransfusi</label>
                <input type="text" class="form-control" id="vol_tf" name="vol_tf"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->volume_pakai}}">
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Riwayat alergi</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                value="0" @if($data_reaksi[0]->riwayat_alergi == '0') checked @endif>
            <label class="form-check-label" for="inlineRadio2">Tidak Ada</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                value="1" @if($data_reaksi[0]->riwayat_alergi == '1') checked @endif>
            <label class="form-check-label" for="inlineRadio1">Ada</label>
        </div>
        <textarea type="text" class="form-control" id="ket_alergi" name="ket_alergi" rows="4"
            placeholder="keterangan alergi ...">{{ $data_reaksi[0]->riwayat_alergi_ket }}</textarea>
    </div>
    <div class="col-md-12 mb-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Pernah transfusi darah / produk darah</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                value="0"  @if($data_reaksi[0]->pernah_transfusi == '0') checked @endif>
            <label class="form-check-label" for="inlineRadio2">Tidak</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                value="1" @if($data_reaksi[0]->pernah_transfusi == '1') checked @endif>
            <label class="form-check-label" for="inlineRadio1">Ada</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            Daftar Check
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-6 col-form-label">Apakah identitas Pasien Benar ?</label>
                  <div class="col-sm-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="idpasien" id="idpasien" value="1" checked>
                        <label class="form-check-label" for="inlineRadio1">Ya</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="idpasien" id="idpasien" value="0">
                        <label class="form-check-label" for="inlineRadio2">Tidak</label>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-6 col-form-label">Kantong Darah Benar ?</label>
                  <div class="col-sm-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_kantong" id="status_kantong" value="1" checked>
                        <label class="form-check-label" for="inlineRadio1">Ya</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_kantong" id="status_kantong" value="0">
                        <label class="form-check-label" for="inlineRadio2">Tidak</label>
                      </div>
                  </div>
                </div>
        </div>
        <div class="col-md-6">
            Suhu Badan Dalam 24 Jam
                <div class="form-group row mt-3">
                  <div class="col-sm-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="demam" id="demam" value="1">
                        <label class="form-check-label" for="inlineRadio1">Demam</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="demam" id="demam" value="0" checked>
                        <label class="form-check-label" for="inlineRadio2">Tidak Demam</label>
                      </div>
                  </div>
                </div>
        </div>
        <div class="col-md-12">
            <table class="table table-sm">
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
                        <td>Sebelum terjadi reaksi</td>
                        <td><input type="text" id="jam_sebelum_reak" name="jam_sebelum_reak" class="form-control" value="{{ $data_mon[0]->jam_monitoring }}"></td>
                        <td><input type="text" id="ttv_s_sebelum" name="ttv_s_sebelum" class="form-control" value="{{ $data_mon[0]->ttv_s }}"></td>
                        <td><input type="text" id="ttv_rr_sebelum" name="ttv_rr_sebelum" class="form-control" value="{{ $data_mon[0]->ttv_rr }}"></td>
                        <td><input type="text" id="ttv_td_sebelum" name="ttv_td_sebelum" class="form-control" value="{{ $data_mon[0]->ttv_td }}"></td>
                        <td><input type="text" id="ttv_nadi_sebelum" name="ttv_nadi_sebelum" class="form-control" value="{{ $data_mon[0]->ttv_nadi }}"></td>
                    </tr>
                    <tr>
                        <td>Pada waktu terjadi reaksi</td>
                        <td><input type="text" id="jam_sesudah_reak" name="jam_sesudah_reak" class="form-control" placeholder="00:00"></td>
                        <td><input type="text" id="ttv_s_sesudah" name="ttv_s_sesudah" class="form-control"></td>
                        <td><input type="text" id="ttv_rr_sesudah" name="ttv_rr_sesudah" class="form-control"></td>
                        <td><input type="text" id="ttv_td_sesudah" name="ttv_td_sesudah" class="form-control"></td>
                        <td><input type="text" id="ttv_nadi_sesudah" name="ttv_nadi_sesudah" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            Gejala dan tanda klinis
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="demam2" name="demam2">
                <label class="form-check-label" for="defaultCheck1">
                  Demam
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="menggigil" name="menggigil">
                <label class="form-check-label" for="defaultCheck1">
                  Mengigil
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="gatal" name="gatal">
                <label class="form-check-label" for="defaultCheck1">
                  Gatal - gatal
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="lainnya" name="lainnya">
                <label class="form-check-label" for="defaultCheck1">
                    Lainnya
                </label>
                <textarea cols="30" rows="4" name="keterangan_lainnya" id="keterangan_lainnya" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="nyeripinggangbawah" name="nyeripinggangbawah">
                <label class="form-check-label" for="defaultCheck1">
                  Nyeri pinggang bawah
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="nyeridada" name="nyeridada">
                <label class="form-check-label" for="defaultCheck1">
                  Nyeri dada
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="cemas" name="cemas">
                <label class="form-check-label" for="defaultCheck1">
                  Cemas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="sakitkepala" name="sakitkepala">
                <label class="form-check-label" for="defaultCheck1">
                  Sakit kepala
                </label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="kulitbiru" name="kulitbiru">
                <label class="form-check-label" for="defaultCheck1">
                  Kulit biru
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="bakgelas" name="bakgelas">
                <label class="form-check-label" for="defaultCheck1">
                  Bak gelas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="sesaknafas" name="sesaknafas">
                <label class="form-check-label" for="defaultCheck1">
                  Sesak nafas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="perdarahanluka" name="perdarahanluka">
                <label class="form-check-label" for="defaultCheck1">
                  Perdarahan dari luka
                </label>
            </div>
        </div>
    </div>
</form>
