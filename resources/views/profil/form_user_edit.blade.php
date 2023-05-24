<form class="formedit_usersimrs">
    <div class="form-group">
        <label for="exampleInputEmail1">id simrs</label>
        <input hidden type="text" class="form-control" id="id" name="id" value="{{ $datauser[0]->id }}" aria-describedby="emailHelp">
        <input type="text" class="form-control" id="id_simrs" name="id_simrs" value="{{ $datauser[0]->id_simrs }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{ $datauser[0]->username }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="{{ $datauser[0]->nama }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Hak akses</label>
        <select class="form-control" id="hak_akses" name="hak_akses">
            <option value="1" @if($datauser[0]->hak_akses == 1) selected @endif>SUPER USER</option>
            <option value="2" @if($datauser[0]->hak_akses == 2) selected @endif>USER PENDAFTARAN</option>
            {{-- <option value="3"></option> --}}
            <option value="4" @if($datauser[0]->hak_akses == 4) selected @endif>PERAWAT POLIKLINIK</option>2
            <option value="5" @if($datauser[0]->hak_akses == 5) selected @endif>DOKTER</option>
            <option value="6" @if($datauser[0]->hak_akses == 6) selected @endif>ADMIN PENUNJANG</option>
            <option value="9" @if($datauser[0]->hak_akses == 9) selected @endif>ADMIN RANAP</option>
            {{-- <option value="99">5</option> --}}
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Unit</label>
        <select class="form-control" id="unit" name="unit">
            @foreach ($unit as $u )
            <option value="{{ $u->kode_unit }}" @if($u->kode_unit == $datauser[0]->unit ) selected @endif>{{ $u->nama_unit }}</option>
            @endforeach
          </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Kode Paramedis</label>
        <input type="text" class="form-control" id="kodeparamedis" name="kodeparamedis" value="{{ $datauser[0]->kode_paramedis }}">
    </div>
</form>
