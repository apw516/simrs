<form class="form-edit_add_darah">
    <input hidden type="text" class="form-control" value="{{ $data_reaksi[0]->idx }}"
        name="id" id="id">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ruang Rawat</label>
                    <select class="form-control" id="ruangrawat" name="ruangrawat">
                        <option value="">Silahkan Pillih</option>
                        @foreach ($unit as $u)
                            <option value="{{ $u->kode_unit }}" @if($data_reaksi[0]->asal_unit == $u->kode_unit ) selected @endif>{{ $u->nama_unit }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Transfusi</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->tgl_transfusi }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Jenis Darah</label>
                <input type="text" class="form-control" id="jenisdarah" name="jenisdarah"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->Jenis_darah }}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Diagnosa Klinis</label>
                <input type="text" class="form-control" id="diagnosaklinis" name="diagnosaklinis"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->diag_klinis }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Jam Mulai Transfusi</label>
                <input type="text" class="form-control" id="mulai_tf" name="mulai_tf"
                    aria-describedby="emailHelp" placeholder="00:00" value="{{ $data_reaksi[0]->mulai_transfusi }}">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="exampleInputEmail1">Jam Selesai Transfusi</label>
                <input type="text" class="form-control" id="selesai_tf" name="selesai_tf"
                    aria-describedby="emailHelp" placeholder="00:00" value="{{ $data_reaksi[0]->selesai_transfusi }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Nomor Kantong Darah</label>
                <input type="text" class="form-control" id="noka_darah" name="noka_darah"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->no_kantong }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Isi ( ml )</label>
                <input type="text" class="form-control" id="isi_darah" name="isi_darah"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->isi }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Volume yang sudah ditransfusi</label>
                <input type="text" class="form-control" id="vol_tf" name="vol_tf"
                    aria-describedby="emailHelp" value="{{ $data_reaksi[0]->volume_pakai }}">
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="form-group">
            <label for="exampleInputPassword1">Riwayat alergi</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="riw_alergi" id="riw_alergi"
                value="0" @if($data_reaksi[0]->riwayat_alergi == '0') checked @endif >
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
                value="0" @if($data_reaksi[0]->pernah_transfusi == '0') checked @endif>
            <label class="form-check-label" for="inlineRadio2">Tidak</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="per_traf" id="per_traf"
                value="1" @if($data_reaksi[0]->pernah_transfusi == '1') checked @endif>
            <label class="form-check-label" for="inlineRadio1">Ada</label>
        </div>
    </div>
</form>
