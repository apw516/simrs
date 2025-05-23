<table class="table table-sm table-bordered table-hover">
    <thead>
        <th>KODE BARANG</th>
        <th>NAMA BARANG</th>
        <th>SATUAN KECIL | SATUAN</th>
    </thead>
    <tbody>
        @foreach ($masterbarang as $mb)
            <tr class="pilihbarang" kodebarang="{{ $mb->kode_barang }}" namabarang="{{ $mb->nama_barang }}"
                satuan={{ $mb->satuan }} sediaan ="{{ $mb->sediaan }}">
                <td>{{ $mb->kode_barang }}</td>
                <td>{{ $mb->nama_barang }}</td>
                <td>{{ $mb->satuan }} | {{ $mb->sediaan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(".pilihbarang").on('click', function(event) {
        kodebarang = $(this).attr('kodebarang')
        namabarang = $(this).attr('namabarang')
        sediaan = $(this).attr('sediaan')
        satuan = $(this).attr('satuan')
        var wrapper = $(".draft_bhp");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Barang</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="namabarang" name="namabarang" value="' +
            namabarang +
            '"></div><div class="form-group col-md-1"><label for="">Kode Barang</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="kodebarang" name="kodebarang" value="' +
            kodebarang +
            '"></div><div class="form-group col-md-1"><label for="">Sediaan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="sediaan" name="sediaan" value="' +
            sediaan +
            '"></div><div class="form-group col-md-1"><label for="">Satuan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="satuan" name="satuan" value="'+satuan+'"></div><div class="form-group col-md-3"><label for="">Kebutuhan</label><input type="" class="form-control form-control-sm text-xs edit_field" id="kebutuhan" name="kebutuhan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
