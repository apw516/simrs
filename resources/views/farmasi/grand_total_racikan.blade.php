<div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Racikan</label>
                <input readonly type="text" class="form-control" id="jumlahitem" value="{{ $qtyracikan }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jumlah Komponen</label>
                <input readonly type="text" class="form-control" id="jumlahkomponen" value="{{ $jumlahkomponen }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Total Item</label>
                <input readonly type="text" class="form-control" id="totalitemracik" value="IDR {{ number_format($new_total_item_racik, 2) }}"
                    aria-describedby="emailHelp">
                <input hidden readonly type="text" class="form-control" id="totalitemracik2" value="{{ $new_total_item_racik }}"
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Baca</label>
                <input readonly type="text" class="form-control" id="jumlahitem" value=""
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Embalase</label>
                <input readonly type="text" class="form-control" id="jumlahitem" value=""
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Jasa Resep</label>
                <input readonly type="text" class="form-control" id="jumlahitem" value=""
                    aria-describedby="emailHelp">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="exampleInputEmail1">Grand Total Racikan</label>
                <input readonly type="text" class="form-control" id="jumlahitem" value=""
                    aria-describedby="emailHelp">
            </div>
        </div>
</div>
