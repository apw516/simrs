<div class="card">
    <div class="card-header  bg-warning">Penandaan Gambar</div>
    <div class="card-body">
        <input hidden type="text" id="gambarcoret" name="gambarcoret">
        <img id="gambarnya1" name="gambarnya1" style="margin-top:50px" width="300px" height="300px" src="{{ asset('public/img/mata1.png') }}"
            onclick="showMarkerArea(this);" />
        <canvas hidden id="myCanvas1" width="300px" height="300px" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
        <button type="button" class="btn btn-danger mt-2 ml-2" onclick="resetgambar_2()"><i class="bi bi-arrow-clockwise mr-1"></i> Reset</button>
    </div>
</div>
