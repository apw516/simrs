<div class="card">
    <div class="card-header  bg-warning">Penandaan Gambar</div>
    <div class="card-body">
        @if(count($data) > 0)
        <input hidden type="text" id="gambarcoret2" name="gambarcoret2">
        <img id="gambarnya2" name="gambarnya2" style="margin-top:50px" width="300px" height="300px" src="{{ $data[0]->gambar_1 }}"
        onclick="showMarkerArea(this);" />
        @else
        <input hidden type="text" id="gambarcoret2" name="gambarcoret2">
        <img id="gambarnya2" name="gambarnya2" style="margin-top:50px" width="300px" height="300px" src="{{ asset('public/img/mata1.png') }}"
            onclick="showMarkerArea(this);" />
        @endif
        <canvas hidden id="myCanvas2" width="300px" height="300px" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
        <button type="button" class="btn btn-danger mt-2 ml-2" onclick="resetgambar()"><i class="bi bi-arrow-clockwise mr-1"></i> Reset</button>
    </div>
</div>
