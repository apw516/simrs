@foreach ($resep as $r)
    <div class="form-row text-xs">
        <div class="form-group col-md-2"><label for="">Nama Obat</label><input type=""
                class="form-control form-control-sm text-xs" id="" name="namaobat"
                value="{{ $r->nama_barang }}"><input hidden readonly type="" class="form-control form-control-sm"
                id="" name="kodebarang" value="{{ $r->kode_barang }}"><input hidden type=""
                class="form-control form-control-sm" id="" name="kode_kunjungan" value="0">
        </div>
        <div hidden class="form-group col-md-2"><label for="inputPassword4">Aturan
                Pakai</label><input type="" class="form-control form-control-sm" id=""
                name="aturanpakai" value="{{ $r->aturan_pakai }}">
        </div>
        <div class="form-group col-md-2"><label for="inputPassword4">Jenis Resep</label>
            <select class="form-control form-control-sm" id="jenisresep" name="jenisresep">
                <option value="NON-RACIKAN">NON RACIKAN</option>
                <option value="RACIKAN">RACIKAN</option>
            </select>
        </div>
        <div class="form-group col-md-1"><label for="inputPassword4">Jumlah Obat</label><input type=""
                class="form-control form-control-sm" id="" name="jumlah" value="{{ $r->jumlah }}">
        </div>
        <div class="form-group col-md-1"><label for="inputPassword4">Signa 1</label><input type=""
                class="form-control form-control-sm" id="" name="signa1" value="{{ $r->signa_1 }}"></div>
        <div class="form-group col-md-1"><label for="inputPassword4">Signa 2</label><input type=""
                class="form-control form-control-sm" id="" name="signa2" value="{{ $r->signa_2 }}"></div>
        <div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type=""
                class="form-control form-control-sm" id="" name="keterangan" value="{{ $r->aturan_pakai }}">
        </div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i>
    </div>
@endforeach
<script>
    $(".fi").on("click", ".remove_field", function(e) { //user click on remove
        e.preventDefault();
        $(this).parent('div').remove();
    })
</script>


