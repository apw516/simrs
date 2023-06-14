<div class="card">
    <div class="card-header  bg-warning">Penandaan Gambar</div>
    <div class="card-body">
        @if(count($data) > 0)
        <input hidden type="text" id="gambarcoret" name="gambarcoret">
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="1000px" height="500px" src="{{ $data[0]->gambar_1 }}"
        onclick="showMarkerArea(this);" />
        @else
        <input hidden type="text" id="gambarcoret" name="gambarcoret">
        @if($unit == '1014')
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="1000px" height="500px" src="{{ asset('public/img/polosan.jpg') }}"
            onclick="showMarkerArea(this);" />
        @elseif($unit == '1019')
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="1000px" height="500px" src="{{ asset('public/img/politht.png') }}"
            onclick="showMarkerArea(this);" />
        @elseif($unit == '1007')
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="1000px" height="500px" src="{{ asset('public/img/poligigi.png') }}"
            onclick="showMarkerArea(this);" />
        @elseif($unit == '1011')
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="1000px" height="500px" src="{{ asset('public/img/bedahumum.png') }}"
            onclick="showMarkerArea(this);" />
        @else
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="1000px" height="500px" src="{{ asset('public/img/polosan.jpg') }}"
            onclick="showMarkerArea(this);" />
        @endif
        @endif
        <canvas hidden id="myCanvas1" width="1000px" height="500px" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
        <button type="button" class="btn btn-danger mt-2 ml-2" onclick="resetgambar()"><i class="bi bi-arrow-clockwise mr-1"></i> Reset</button>
    </div>
</div>
