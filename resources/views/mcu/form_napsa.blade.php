<form class="formnapsanya">
    <div class="form-group">
      <label for="exampleInputEmail1">Nomor RM | Nama</label>
      <input type="email" class="form-control" id="" aria-describedby="emailHelp" value="{{ $rm}} | {{ $p[0]->nama_px}}">
      <input hidden type="email" class="form-control" name="no_rm" aria-describedby="emailHelp" value="{{ $rm}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Tanggal Surat</label>
      <input type="text" class="form-control" name="tglsurat" value="{{ $date}}">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Nomor Surat</label>
      <input type="text" class="form-control" name="nomorsurat" value="400.7.22.1 / 04411 / MCU / 2023">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Keperluan</label>
      <input type="text" class="form-control" name="keperluan" value="Persyaratan Pemberkasan PPPK">
    </div>
  </form>
