<table id="tabelstokobat2" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tgl Stok</th>
        <th>Nama Barang</th>
        <th>STOK</th>
        <th>Dosis</th>
        <th>Satuan</th>
        <th>Aturan Pakai</th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            @if ($d->stok_current > 0)
                <tr class="pilihobat" kodebarang="{{ $d->kode_barang }}" nama="{{ $d->nama_barang }}"
                    dosis="{{ $d->dosis }}" satuan = "{{ $d->satuan }}" aturanpakai = "{{ $d->aturan_pakai }}"
                    namagenerik="{{ $d->nama_generik }}">
                    <td>{{ $d->tgl_stok }}</td>
                    <td>{{ $d->nama_barang }}</td>
                    <td>{{ $d->stok_current }}</td>
                    <td>{{ $d->dosis }}</td>
                    <td>{{ $d->satuan }}</td>
                    <td>{{ $d->aturan_pakai }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelstokobat2").DataTable({
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
        namagenerik = $(this).attr('namagenerik')
        var wrapper = $(".draft_obat_racik");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-3"><label for="">Nama Obat</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namaobat" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodeobat" value="' +
            kodebarang +
            '"></div><div class="form-group col-md-3"><label for="inputPassword4">Nama Generik</label><input readonly type="" class="form-control form-control-sm" id="" name="namagenerik" value="' +
            namagenerik +
            '"></div><div class="form-group col-md-1"><label for="inputPassword4">Sediaan</label><input readonly type="" class="form-control form-control-sm" id="" name="sediaan" value="' +
            satuan +
            '"></div><div class="form-group col-md-1"><label for="inputPassword4">Dosis Awal</label><input type="" class="form-control form-control-sm" id="" name="dosisawal" value="' +
            dosis +
            '"></div><div class="form-group col-md-1"><label for="inputPassword4">Dosis Racik</label><input type="" class="form-control form-control-sm" id="" name="dosisracik" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
