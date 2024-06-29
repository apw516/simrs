<div class="card">
    <div class="card-header">Penandaan Gambar</div>
    <div class="card-body">
        <input hidden type="text" id="gambarcoret2" name="gambarcoret2">
        <img id="gambarnya2" name="gambarnya2" style="margin-top:50px" width="800px" height="500px" src="{{ asset('public/img/POLIMATA.png') }}" onclick="showMarkerArea();" />
        <canvas hidden id="myCanvas2" width="800px" height="500px" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
        <button type="button" class="btn btn-danger mt-2 ml-2" onclick="resetgambar_1()"><i class="bi bi-arrow-clockwise mr-1"></i> Reset</button>
    </div>
</div>
<script src="{{ asset('public/marker/markerjs2.js') }}">
</script>
<script>
    function showMarkerArea() {
        target = document.getElementById("gambarnya2")
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
        markerArea.show();
    }
</script>
