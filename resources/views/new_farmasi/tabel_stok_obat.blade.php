<table id="tabelstok" class="table table-sm table-bordered text-xs">
    <thead>
        <th>Nama Barang</th>
        <th>Nama Generik</th>
        <th>Nama Unit</th>
        <th>Stok</th>
        <th>Dosis</th>
        <th>Satuan</th>
        <th>Aturan Pakai</th>
        <td></td>
    </thead>
    <tbody>
        @foreach ($data as $d )
        @if($d->stok_current > 0)
            <tr>
                <td>{{ $d->nama_barang}}</td>
                <td>{{ $d->nama_generik}}</td>
                <td>{{ $d->nama_unit}}</td>
                <td>{{ $d->stok_current}}</td>
                <td>{{ $d->dosis}}</td>
                <td>{{ $d->sediaan}}</td>
                <td>{{ $d->aturan_pakai}}</td>
                <td>
                    <button class="btn btn-success btn-sm pilihobat" kodebarang="{{ $d->kode_barang }}" namabarang="{{ $d->nama_barang }}" dosis="{{ $d->dosis}}" sediaan="{{ $d->sediaan }}" aturanpakai="{{ $d->aturan_pakai}}" stok="{{ $d->stok_current}}" jenisobat="REGULER"><i class="bi bi-check2-square"></i></button>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelstok").DataTable({
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
        var wrapper = $(".draft_obat2");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-2 text-xxs"><label for="">Tipe Anestesi</label>    <select class="form-control" id="tipeanestesi" name="tipeanestesi"><option value="REG">REGULER</option><option value="KRONIS">KRONIS</option></select></div><div class="form-group col-md-1"><label for="">Jumlah</label><input type="" class="form-control form-control-sm text-xs edit_field" id="jumlah" name="jumlah" value="0"></div><div class="form-group col-md-2"><label for="">Nama Barang</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="namabarang" name="namabarang" value="' +
            namabarang +
            '"><input   hidden readonly type="" class="form-control form-control-sm" id="kodebarang" name="kodebarang" value="' +
            kodebarang +
            '"><input hidden   readonly type="" class="form-control form-control-sm" id="jenisresep" name="jenisresep" value="NON RACIK"></div><div class="form-group col-md-1"><label for="">Dosis</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="dosis" name="dosis" value="' +
            dosis +
            '"></div><div class="form-group col-md-1"><label for="">Stok</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="stok" name="stok" value="' +
            stok +
            '"></div><div class="form-group col-md-1"><label for="">Sediaan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="sediaan" name="sediaan" value="' +
            sediaan +
            '"></div><div class="form-group col-md-3"><label for="">Aturan Pakai</label><textarea type="" cols="3" rows="3" class="form-control form-control-sm text-xs edit_field" id="aturanpakai" name="aturanpakai" value="">' +
            aturanpakai +
            '</textarea></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        Swal.fire({
            title: "Obat berhasil dipilih " + namabarang,
            text: "ok!",
            icon: "success"
        });
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
