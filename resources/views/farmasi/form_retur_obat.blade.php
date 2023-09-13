<form class="form_isian_retur">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Barang</label>
        <input readonly type="text" class="form-control" id="namabarang"  name="namabarang" value="{{ $ambil_detail[0]->nama_barang }}" aria-describedby="emailHelp">
        <input hidden readonly type="text" class="form-control" id="kodebarang" name="kodebarang"  value="{{ $ambil_detail[0]->kode_barang }}" aria-describedby="emailHelp">
        <input hidden readonly type="text" class="form-control" id="idheader" name="idheader"  value="{{ $idheader }}" aria-describedby="emailHelp">
        <input hidden readonly type="text" class="form-control" id="iddetail" name="iddetail"  value="{{ $iddetail }}" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Satuan</label>
        <input readonly type="text" class="form-control" id="satuan"  name="satuan" value="{{ $ambil_detail[0]->satuan_barang }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Jumlah</label>
        <input readonly type="text" class="form-control" id="jumlah" name="jumlah"  value="{{ $ambil_detail[0]->jumlah_layanan }}">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Jumlah Retur</label>
        <input  type="text" class="form-control" id="jumlahretur" name="jumlahretur">
    </div>
</form>

