<div class="card">
    <div class="card-header bg-warning">Mata Kiri</div>
    <div class="card-body">
        <input hidden type="text" id="matakiri">
        @if(count($cek1) > 0)
        <img id="gambarnya2" style="margin-top:50px" width="340px" height="320px" src="{{ $cek1[0]->matakiri }}"
            onclick="showMarkerArea(this);" />
        @else
        <img id="gambarnya2" style="margin-top:50px" width="340px" height="320px" src="{{ asset('public/img/bolamata2.jpg') }}"
            onclick="showMarkerArea(this);" />
        @endif
        <canvas hidden id="myCanvas2" width="340px" height="320px" style="border:1px solid #d3d3d3;">
            Your browser does not support the HTML5 canvas tag.
        </canvas>
        <button type="button" class="btn btn-danger mt-2" onclick="batalgambar2()">batal</button>
    </div>
</div>
<script src="{{ asset('public/marker/markerjs.js') }}"></script>
<script>
    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
        markerArea.show();
    }
    function batalgambar2() {
        ambilgambar2()
    }
    function ambilgambar2() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('gambarmatakiri') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar2').html(response)
                }
            });
        }
</script>
