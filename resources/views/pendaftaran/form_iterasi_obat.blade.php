<form class="formdaftariter">
    <div class="form-group">
        <label for="exampleFormControlSelect1">Pilih Unit Farmasi</label>
        <select class="form-control" id="unit" name="unit">
            @foreach ($mt_unit as $d)
                <option value="{{ $d->kode_unit }}">{{ $d->nama_unit }}</option>
            @endforeach
        </select>
    </div>
    <input hidden id="iditer" name="iditer" type="text" value="{{ $iditer }}">
    <input hidden id="kodekunjunganlama"name="kodekunjunganlama" type="text" value="{{ $kodekunjunganlama }}">
    <input hidden id="rm" name="rm" type="text" value="{{ $rm }}">
</form>
