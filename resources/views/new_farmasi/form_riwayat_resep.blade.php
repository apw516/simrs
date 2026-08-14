@foreach ($data as $row)
    <tr id="row-obat-${kodeBarang}">
        <td class="text-center nomor-urut"></td>
        <td>
            <span class="font-weight-bold d-block">{{ $row->nama_barang_asli }}</span>
            <small class="text-muted">{{ $row->kode_barang }}</small>
            <input type="hidden" name="kode_barang" value="{{ $row->kode_barang }}">
        </td>
        <td>
            <input readonly type="number" name="stok" class="form-control form-control-sm text-center" value="0"
                min="0">
        </td>
        <td>
            <select name="jenis_resep" class="form-control form-control-sm">
                <option value="NonRacikan">(Non-Racik)</option>
                <option value="Racikan">Racikan</option>
            </select>
        </td>
        <td hidden >
            <select name="jenis_obat" class="form-control form-control-sm">
                <option value="Reguler">Reguler</option>
                <option value="Kronis">Kronis</option>
                <option value="PRB">PRB</option>
                <option value="Kemoterapi">Kempoterapi</option>
            </select>
        </td>
        <td hidden >
            <select name="iterasi" class="form-control form-control-sm text-center">
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            </select>
        </td>
        <td hidden >
            <input type="number" name="jlh_iterasi" class="form-control form-control-sm text-center" value="0"
                min="0">
        </td>
        <td>
            <div class="row">
                <div hidden class="col-md-6"> <input type="number" name="jumlahhari"
                        class="form-control form-control-sm text-center" value="1" min="1" required></div>
                <div class="col-md-12"><input type="number" name="qtyobat"
                        class="form-control form-control-sm text-center" value="{{ $row->jumlah_layanan }}" min="1"
                        required></div>
            </div>
        </td>
        <td hidden>
            <input hidden type="number" name="jumlahobat" class="form-control form-control-sm text-center input-jumlah-obat"
                value="1" min="1" required>
        </td>
        <td>
            <input type="number" name="signa1" class="form-control form-control-sm text-center" 
                min="1" required value="0">
        </td>
        <td class="text-center align-middle font-weight-bold">
            <span class="mr-1">x</span>
        </td>
        <td>
            <input type="number" name="signa2" class="form-control form-control-sm text-center" value="0"
                min="1" required>
        </td>
        <td>
            <input type="text" name="catatan" class="form-control form-control-sm" placeholder="Contoh: Ssh Makan" value="">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-obat">
                <i class="fas fa-times"></i>
            </button>
        </td>
    </tr>
@endforeach
