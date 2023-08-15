    <form class="updatesumarilisnya2">
        <div class="form-group">
            <label for="exampleInputEmail1">Tgl Sumarilis</label>
            <input type="date" class="form-control" id="tanggalsumarilis" name="tanggalsumarilis" aria-describedby="emailHelp" value="{{ $data[0]->tanggal }}">
            <input hidden type="text" class="form-control" id="nomorrm" name="nomorrm" aria-describedby="emailHelp" value="{{ $data[0]->no_rm }}">
            <input hidden type="text" class="form-control" id="kodekunjungan" name="kodekunjungan" aria-describedby="emailHelp" value="{{ $data[0]->kode_kunjungan }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Diagnosa</label>
            <input type="text" class="form-control" id="diagnosasum" name="diagnosasum" value="{{ $data[0]->diagnosa }}">
        </div>
        <div hidden class="form-group">
            <label for="exampleInputPassword1">Siklus</label>
            <input type="text" class="form-control" id="siklus" name="siklus" value="{{ $data[0]->siklus }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Keterangan Regimen</label>
            <textarea type="text" class="form-control" id="ketreg" name="ketreg">{{ $data[0]->ket_regimen}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Obat</label>
            <textarea type="text" class="form-control" id="obat" name="obat">{{ $data[0]->obat}}</textarea>
        </div>
    </form>
