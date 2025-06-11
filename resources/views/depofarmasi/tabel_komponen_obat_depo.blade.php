<table id="tabelstok2" class="table table-sm table-bordered text-xs table-hover">
    <thead>
        <th>Nama Barang</th>
        <th>Nama Generik</th>
        <th>Stok</th>
        <th>Dosis</th>
        <th>Satuan</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
            <tr class="pilihobat" kodebarang="{{ $d->kode_barang }}" namabarang="{{ $d->nama_barang }}" dosis="{{ $d->dosis}}" sediaan="{{ $d->sediaan }}"
                aturanpakai="{{ $d->aturan_pakai}}" stok="{{ $d->stok_current}}" jenisobat="REGULER">
                <td>{{ $d->nama_barang}}</td>
                <td>{{ $d->nama_generik}}</td>
                <td>{{ $d->stok_current}}</td>
                <td>{{ $d->dosis}}</td>
                <td>{{ $d->sediaan}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelstok2").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihobat").on('click', function(event) {
        kodebarang = $(this).attr('kodebarang')
        namabarang = $(this).attr('namabarang')
        dosis = $(this).attr('dosis')
        sediaan = $(this).attr('sediaan')
        aturanpakai = $(this).attr('aturanpakai')
        stok = $(this).attr('stok')
        jenisobat = $(this).attr('jenisobat')
        var wrapper = $(".draft_komponen_obat");
        $(wrapper).append(
            '<div class="form-row text-xs"><div hidden class="form-group col-md-2 text-xxs"><label for="">Tipe Anestesi</label><select class="form-control" id="tipeanestesi" name="tipeanestesi"><option value="REG">REGULER</option><option value="KRONIS">KRONIS</option></select></div><div class="form-group col-md-1" hidden><label for="">Jumlah</label><input type="" class="form-control form-control-sm text-xs edit_field" id="jumlah" name="jumlah" value="0"></div><div class="form-group col-md-4"><label for="">Nama Barang</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="namabarang" name="namabarang" value="' +
            namabarang +
            '"><input hidden readonly type="" class="form-control form-control-sm" id="kodebarang" name="kodebarang" value="' +
            kodebarang +
            '"><input hidden readonly type="" class="form-control form-control-sm" id="idantrianheader" name="idantrianheader" value="0"><input  hidden readonly type="" class="form-control form-control-sm" id="idheaderorder" name="idheaderorder" value="0"><input hidden  readonly type="" class="form-control form-control-sm" id="iddetailorder" name="iddetailorder" value="0"><input hidden  readonly type="" class="form-control form-control-sm" id="jenisresep" name="jenisresep" value="NON RACIK"></div><div class="form-group col-md-1"><label for="">Stok</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="dosis" name="dosis" value="' +
            stok +
            '"></div><div class="form-group col-md-1"><label for="">Sediaan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="dosis" name="dosis" value="' +
            sediaan +
            '"></div><div class="form-group col-md-1"><label for="">Dosis awal</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="stok" name="stok" value="' +
            dosis +
            '"></div><div class="form-group col-md-1"><label for="">Dosis Racik</label><input type="" class="form-control form-control-sm text-xs edit_field" id="sediaan" name="sediaan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

