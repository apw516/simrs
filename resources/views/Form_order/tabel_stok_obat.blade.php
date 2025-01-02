<table id="tabelstokobat" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tgl Stok</th>
        <th>Nama Barang</th>
        <th>STOK</th>
        <th>DOSIS</th>
        <th>Satuan</th>
        <th>Aturan Pakai</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
        @if($d->stok_current > 0)
            <tr class="pilihobat" kodebarang="{{$d->kode_barang}}" nama="{{ $d->nama_barang }}" dosis="{{ $d->dosis }}"
                satuan = "{{ $d->satuan }}" aturanpakai = "{{ $d->aturan_pakai }}" >
                <td>{{ $d->tgl_stok}}</td>
                <td>{{ $d->nama_barang}}</td>
                <td>{{ $d->stok_current}}</td>
                <td>{{ $d->dosis}}</td>
                <td>{{ $d->satuan}}</td>
                <td>{{ $d->aturan_pakai}}</td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelstokobat").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihobat").on('click', function(event) {
        kodebarang = $(this).attr('kodebarang')
        nama = $(this).attr('nama')
        dosis = $(this).attr('dosis')
        aturanpakai = $(this).attr('aturanpakai')
        satuan = $(this).attr('satuan')
        var wrapper = $(".draft_obat");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Obat</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namaobat" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodeobat" value="' +
            kodebarang +
            '"><input  readonly type="" class="form-control form-control-sm" id="" name="jenisobat" value="REGULER"></div><div class="form-group col-md-1"><label for="inputPassword4">Sediaan</label><input readonly type="" class="form-control form-control-sm" id="" name="sediaan" value="' +
            satuan +
            '"></div><div class="form-group col-md-1"><label for="inputPassword4">Dosis</label><input readonly type="" class="form-control form-control-sm" id="" name="dosis" value="' +
            dosis +
            '"></div><div class="form-group col-md-3"><label for="inputPassword4">Aturan Pakai</label><textarea type="" class="form-control form-control-sm" id="" name="aturanpakai">'+ aturanpakai +'</textarea></div><div class="form-group col-md-1"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="0"></div><div class="form-group col-md-1"><label for="exampleFormControlSelect1">Tipe Anestesi</label><select class="form-control" name="tipeanestesi" id="tipeanestesi"><option value="80">Reguler</option><option value="81">Kronis</option><option value="82">Kemoterapi</option></select></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><textarea type="" class="form-control form-control-sm" id="" name="keteranganorder" rows="4"></textarea></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
