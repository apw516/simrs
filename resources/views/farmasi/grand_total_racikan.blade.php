    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Racikan</label>
                <input readonly type="text" class="form-control" id="jumlahitem_racikan_gt" name="jumlahitem_racikan_gt" value="{{ $qtyracikan }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Komponen</label>
                <input readonly type="text" class="form-control" id="jumlahkomponen_racikan_gt" name="jumlahkomponen_racikan_gt" value="{{ $jumlahkomponen }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Total Item</label>
                <input readonly type="text" class="form-control" id="totalitemracik_racikan_gt" name="totalitemracik_racikan_gt"
                    value="IDR {{ number_format($new_total_item_racik, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="totalitemracik2_gt" name="totalitemracik2_gt"
                    value="{{ $new_total_item_racik }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Baca</label>
                <input readonly type="text" class="form-control" id="jasabacaracik2_gt" name="jasabacaracik2_gt"
                    value="IDR {{ number_format($jasabaca, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="jasabacaracik_gt" name="jasabacaracik_gt"
                    value="{{ $jasabaca }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Embalase</label>
                <input readonly type="text" class="form-control" id="jasaembalaseracik2_gt" name="jasaembalaseracik2_gt"
                    value="IDR {{ number_format($jasaembalase, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="jasaembalaseracik_gt" name="jasaembalaseracik_gt"
                    value="{{ $jasaembalase }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Resep</label>
                <input readonly type="text" class="form-control" id="jasaresepracik2_gt" name="jasaresepracik2_gt"
                    value="IDR {{ number_format($jasaresep, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="jasaresepracik_gt" name="jasaresepracik_gt"
                    value="{{ $jasaresep }}" aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Grand Total Racikan</label>
                <input readonly type="text" class="form-control" id="grandtotal_racikan2_gt" name="grandtotal_racikan2_gt"
                    value="IDR {{ number_format($grantotalracik, 2) }}" aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="grandtotal_racikan_gt" name="grandtotal_racikan_gt"
                    value="{{ $grantotalracik }}" aria-describedby="emailHelp">
            </div>
        </div>
    </div>
