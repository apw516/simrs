@foreach ($resep as $r)
    <div class="form-row text-xs">
        <div class="form-group col-md-2"><label for="">Nama Obat</label><input readonly type=""
                class="form-control form-control-sm text-xs" id="" name="namaobat"
                value="{{ $r->nama_barang }}"><input hidden readonly type="" class="form-control form-control-sm"
                id="" name="kodebarang" value="{{ $r->kode_barang }}">
        </div>
        <div class="form-group col-md-2"><label for="inputPassword4">Aturan
                Pakai</label><input readonly type="" class="form-control form-control-sm" id=""
                name="aturanpakai" value="{{ $r->aturan_pakai }}">
        </div>
        <div class="form-group col-md-1"><label for="inputPassword4">Jenis</label><input readonly type=""
                class="form-control form-control-sm" id="" name="jenis" value="{{ $r->jenis }}">
        </div>
        <div class="form-group col-md-1"><label for="inputPassword4">Satuan</label><input readonly type=""
                class="form-control form-control-sm" id="" name="satuan" value="{{ $r->satuan }}">
        </div>
        <div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type=""
                class="form-control form-control-sm" id="" name="jumlah" value="{{ $r->jumlah }}">
        </div>
        <div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type=""
                class="form-control form-control-sm" id="" name="signa" value="{{ $r->signa }}"></div>
        <div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type=""
                class="form-control form-control-sm" id="" name="keterangan" value="{{ $r->keterangan }}">
        </div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i>
    </div>
@endforeach
<script>
     $(".fi").on("click", ".remove_field", function(e) { //user click on remove
        e.preventDefault();
        $(this).parent('div').remove();
    })
</script>
