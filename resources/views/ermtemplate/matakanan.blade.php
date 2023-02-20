<div class="card">
    <div class="card-header  bg-warning">Mata Kanan</div>
    <div class="card-body">
        <input hidden type="text" id="matakanan">
        @if(count($cek1) > 0)
        <img id="gambarnya1" style="margin-top:50px" width="340px" height="320px" src="{{ $cek1[0]->matakanan }}"
            onclick="showMarkerArea(this);" />
        @else
        <img id="gambarnya1" style="margin-top:50px" width="340px" height="320px" src="{{ asset('public/img/bolamata2.jpg') }}"
            onclick="showMarkerArea(this);" />
        @endif
        <canvas hidden id="myCanvas1" width="340px" height="320px" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
        <button type="button" class="btn btn-danger mt-2" onclick="batalgambar1()">batal</button>
    </div>
</div>
<script src="{{ asset('public/marker/markerjs2.js') }}"></script>
<script>
    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
        markerArea.show();
    }
    function batalgambar1() {
        ambilgambar1()
    }
    function ambilgambar1() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('gambarmatakanan') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar1').html(response)
                }
            });
        }
</script>
