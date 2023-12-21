<form class="formheadersurat_edit">
    <div class="form-group">
        <label for="exampleInputEmail1">Nomor RM</label>
        <input type="text" class="form-control" id="nomorrm" name="nomorrm" value="{{ $p[0]->no_rm }}"
            aria-describedby="emailHelp">
        <input hidden type="text" class="form-control" id="id" name="id" value="{{ $p[0]->id }}"
            aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Nama Pasien</label>
        <input type="text" class="form-control" id="namapasien" name="namapasien" value="{{ $p[0]->nama_px }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $p[0]->alamat }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Pekerjaan</label>
        <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ $p[0]->pekerjaan }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Tinggi Badan</label>
        <input type="text" class="form-control" id="tinggi badan" name="tinggibadan" value="{{ $p[0]->tb }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Berat Badan</label>
        <input type="text" class="form-control" id="beratbadan" name="beratbadan" value="{{ $p[0]->bb }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Tekanan Darah</label>
        <input type="text" class="form-control" id="tekanandarah" name="tekanandarah" value="{{ $p[0]->td }}">
    </div>
</form>
