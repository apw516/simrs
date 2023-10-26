    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Racikan</label>
                <input readonly type="text" class="form-control" id="jumlahitem" name="jumlahitem" value="{{ $qtyracikan }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Komponen</label>
                <input readonly type="text" class="form-control" id="jumlahkomponen" name="jumlahkomponen" value="{{ $jumlahkomponen }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Total Item</label>
                <input readonly type="text" class="form-control" id="totalitemracik" name="totalitemracik"
                    value="IDR {{ number_format($new_total_item_racik, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="totalitemracik2" name="totalitemracik2"
                    value="{{ $new_total_item_racik }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Baca</label>
                <input readonly type="text" class="form-control" id="jasabacaracik2"
                    value="IDR {{ number_format($jasabaca, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="jasabacaracik" name="jasabacaracik"
                    value="{{ $jasabaca }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Embalase</label>
                <input readonly type="text" class="form-control" id="jasaembalaseracik2"
                    value="IDR {{ number_format($jasaembalase, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="jasaembalaseracik" name="jasaembalaseracik"
                    value="{{ $jasaembalase }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Resep</label>
                <input readonly type="text" class="form-control" id="jasaresepracik2"
                    value="IDR {{ number_format($jasaresep, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="jasaresepracik" name="jasaresepracik"
                    value="{{ $jasaresep }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Grand Total Racikan</label>
                <input readonly type="text" class="form-control" id="grandtotal_racikan2"
                    value="IDR {{ number_format($grantotalracik, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="grandtotal_racikan" name="grandtotal_racikan"
                    value="{{ $grantotalracik }}" aria-describedby="emailHelp">
            </div>
        </div>
    </div>
