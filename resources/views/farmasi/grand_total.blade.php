<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Jumlah Item</label>
            <input readonly type="text" class="form-control" id="jumlahitem" value="{{ $jumlahitem }}"
                aria-describedby="emailHelp">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Total Item</label>
            <input readonly type="text" class="form-control" id="totalitem1"
                value="IDR {{ number_format($new_total_item, 2) }}" aria-describedby="emailHelp">
            <input type="text" hidden class="form-control" id="totalitem2" value="{{ $new_total_item }}"
                aria-describedby="emailHelp">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            @php
                $jasa_resep = 1200 * $jumlahitem;
                $jasa_embalase = 500 * $jumlahitem;
            @endphp
            <label for="exampleInputEmail1">Jasa Resep</label>
            <input readonly type="text" class="form-control" id="jasaresep1" value="IDR {{ number_format($jasa_resep, 2) }}"
                aria-describedby="emailHelp">
            <input type="text" hidden class="form-control" id="jasaresep2" value=""
                aria-describedby="emailHelp">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Embalse</label>
            <input readonly type="text" class="form-control" id="embalse1" value="IDR {{ number_format($jasa_embalase, 2) }}"
                aria-describedby="emailHelp">
            <input type="text" hidden class="form-control" id="embalse2" value=""
                aria-describedby="emailHelp">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="exampleInputEmail1">Jasa Resep / lembar</label>
            <input readonly type="text" class="form-control" id="embalse1" value="IDR {{ number_format(1000, 2) }}"
                aria-describedby="emailHelp">
            <input type="text" hidden class="form-control" id="embalse2" value=""
                aria-describedby="emailHelp">
        </div>
    </div>
    <div class="col-md-12">
        @if ($operator == '+')
            @if ($jumlahitem == 1)
                @php $grand_total_last = $grandtotal + 1000 @endphp
            @else
                @php $grand_total_last = $grandtotal @endphp
            @endif
        @else
            @if ($jumlahitem == 0)
            @php $grand_total_last = 0 @endphp
            @else
                @php $grand_total_last = $grandtotal @endphp
            @endif
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">Grand Total</label>
            <input readonly type="text" class="form-control" id="grandtotal1"
                value="IDR {{ number_format($grand_total_last, 2) }}" aria-describedby="emailHelp">
            <input type="text" hidden class="form-control" id="grandtotal2" value="{{ $grand_total_last }}"
                aria-describedby="emailHelp">
        </div>
    </div>
</div>
