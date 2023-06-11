<table id="tablecariobat" class="table table-sm table-hover text-xs">
    <thead>
        <th>Nama Obat</th>
        <th>Jenis</th>
        <th>Stok</th>
        <th>Dosis</th>
        <th>Satuan</th>
        <th>Aturan</th>
    </thead>
    <tbody>
        @foreach ($obat as $o)
            <tr class="pilihobat @if ($o->stok_current < 10 && $o->stok_current > 0) bg-warning @endif"
                jenis="@if ($o->narkotika == 1) Narkotika @elseif ($o->Psikotropika == 1)Psikotropika @elseif ($o->obat_generik == 1)Obat generik @elseif ($o->prekusor)Prekusor @elseif ($o->antibiotik)Antibiotik @elseif ($o->formularium)Formularium @elseif ($o->non_formularium)Non Formularium @elseif ($o->morphin)Morphin @endif"
                satuan="{{ $o->satuan }}" aturanpakai="{{ $o->aturan_pakai }}" kode="{{ $o->kode_barang }}"
                namaobat="{{ $o->nama_barang }}">

                <td>{{ $o->nama_barang }}</td>
                <td>
                    @if ($o->narkotika == 1)
                        Narkotika
                    @elseif ($o->Psikotropika == 1)
                        Psikotropika
                    @elseif ($o->obat_generik == 1)
                        Obat generik
                    @elseif ($o->prekusor)
                        Prekusor
                    @elseif ($o->antibiotik)
                        Antibiotik
                    @elseif ($o->formularium)
                        Formularium
                    @elseif ($o->non_formularium)
                        Non Formularium
                    @elseif ($o->morphin)
                        Morphin
                    @endif
                </td>
                <td>{{ $o->stok_current }}</td>
                <td>{{ $o->dosis }}</td>
                <td>{{ $o->satuan }}</td>
                <td>{{ $o->aturan_pakai }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tablecariobat").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tablecariobat').on('click', '.pilihobat', function() {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Obat berhasil dipilih !',
            showConfirmButton: false,
            timer: 1200
        })
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap2"); //Fields wrapper
        var x = 1; //initlal text box count
        kode = $(this).attr('kode')
        namaobat = $(this).attr('namaobat')
        aturanpakai = $(this).attr('aturanpakai')
        satuan = $(this).attr('satuan')
        jenis = $(this).attr('jenis')
        // e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Obat</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="namaobat" value="' +
                namaobat +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodebarang" value="' +
                kode +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Aturan Pakai</label><input readonly type="" class="form-control form-control-sm" id="" name="aturanpakai" value="' +
                aturanpakai +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jenis</label><input readonly type="" class="form-control form-control-sm" id="" name="jenis" value="' +
                jenis +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Satuan</label><input readonly type="" class="form-control form-control-sm" id="" name="satuan" value="' +
                satuan +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
</script>
