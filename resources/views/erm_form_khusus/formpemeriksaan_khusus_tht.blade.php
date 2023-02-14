<div class="card">
    <div class="card-header bg-danger">Form Pemeriksaan THT</div>
    <div class="card-body">
        @if (count($resume) > 0)
            <input hidden type="text" class="form-control" id="idassesmen" value="{{ $resume[0]->id }}">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header bg-warning" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed text-dark" type="button"
                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                aria-controls="collapseOne">
                                Hasil Pemeriksaan Mikroskopik / Endoskopi Telinga
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-bold">Telinga Kanan</div>
                                        <div class="card-body">
                                            <form action="" class="formtelingakanan">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Liang Telinga</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Liang Telinga')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="ltketeranganlain">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Membran Timpan</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Membran Timpani')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    id=""
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="mtketeranganlain">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kavum Timpani</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Mukosa</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mukosa">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Oslkel</label>
                                                                    <input type="text" class="form-control"
                                                                        name="oslkel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Isthmus timpani/anterior
                                                                        timpani/posterior timpani</label>
                                                                    <input type="text" class="form-control"
                                                                        name="Isthmus">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lain - Lain</td>
                                                        <td>
                                                            <textarea class="form-control" name="keteranganlain"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telinga kanan</td>
                                                        <td>
                                                            <div class="gambar1">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-bold">Telinga Kiri</div>
                                        <div class="card-body">
                                            <form action="" class="formtelingakiri">
                                                <table class="table table-sm">
                                                    <tr>
                                                        <td>Liang Telinga</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Liang Telinga')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="ltketeranganlain">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Membran Timpan</td>
                                                        <td>
                                                            <div class="row">
                                                                @foreach ($penyakit as $p)
                                                                    @if ($p->sub_organ == 'Membran Timpani')
                                                                        <div class="col-md-4">
                                                                            <div class="form-group form-check">
                                                                                <input type="checkbox"
                                                                                    class="form-check-input"
                                                                                    id=""
                                                                                    name="{{ $p->nama_pemeriksaan }}"
                                                                                    value="1">
                                                                                <label class="form-check-label"
                                                                                    for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <input class="form-control" name="mtketeranganlain">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kavum Timpani</td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Mukosa</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mukosa">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Oslkel</label>
                                                                    <input type="text" class="form-control"
                                                                        name="oslkel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">Isthmus timpani/anterior
                                                                        timpani/posterior timpani</label>
                                                                    <input type="text" class="form-control"
                                                                        name="Isthmus">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lain - Lain</td>
                                                        <td>
                                                            <textarea class="form-control" name="keteranganlain"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Telinga kanan</td>
                                                        <td>
                                                            <div class="gambar2">

                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Kesimpulan</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="kesimpulan" name="kesimpulan"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Anjuran</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="anjuran" name="anjuran"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <button type="button"
                                        class="btn btn-lg btn-success float-right mt-2 simpanpemeriksaan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-warning" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed text-dark" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                Hasil Pemeriksaan Nasoendoskopi / Endoskopi Hidung
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-bold">Hidung Kanan</div>
                                        <div class="card-body">
                                            <form action="" class="formhidungkanan">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td>Kavum Nasi</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Kavum Nasi')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Konka Inferior</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Konka Interior')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Meatus Medius</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Meatus Medius')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Septum</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Septum')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nasofaring</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Nasofaring')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Lain - Lain</td>
                                                    <td>
                                                        <textarea class="form-control" name="lain-lain"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-bold">Hidung Kiri</div>
                                        <div class="card-body">
                                            <form action="" class="formhidungkiri">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td>Kavum Nasi</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Kavum Nasi')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Konka Inferior</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Konka Interior')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Meatus Medius</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Meatus Medius')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Septum</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Septum')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Nasofaring</td>
                                                    <td>
                                                        <div class="row">
                                                            @foreach ($penyakit as $p)
                                                                @if ($p->sub_organ == 'Nasofaring')
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                id=""
                                                                                name="{{ $p->nama_pemeriksaan }}"
                                                                                value="1">
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Lain - Lain</td>
                                                    <td>
                                                        <textarea class="form-control" name="lain-lain"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Kesimpulan</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="kesimpulanhidung" name="kesimpulanhidung"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    <button class="btn btn-success btn-lg float-right simpanpemeriksaan2">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img width="340px" src="" alt="">
        @else
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...
                </h3>
                <p>
                    Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
                </p>
            </div>
        @endif
    </div>
</div>
<script src="{{ asset('public/marker/markerjs.js') }}"></script>
<script>
    $(document).ready(function() {
        ambilgambar1()
        ambilgambar2()

        function ambilgambar1() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan : $('#kodekunjungan').val()
                },
                url: '<?= route('gambartht1') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar1').html(response)
                }
            });
        }

        function ambilgambar2() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan : $('#kodekunjungan').val()

                },
                url: '<?= route('gambartht2') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.gambar2').html(response)
                }
            });
        }

    });

    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));

        markerArea.uiStyleSettings.toolbarStyleColorsClassName = 'bg-gray-50';
        markerArea.uiStyleSettings.toolbarButtonStyleColorsClassName =
            'bg-gradient-to-t from-gray-50 to-gray-50 hover:from-gray-50 hover:to-pink-50 fill-current text-pink-300';
        markerArea.uiStyleSettings.toolbarActiveButtonStyleColorsClassName =
            'bg-gradient-to-t from-pink-100 via-gray-50 to-gray-50 fill-current text-pink-400';
        markerArea.uiStyleSettings.toolbarOverflowBlockStyleColorsClassName = "bg-gray-50";

        markerArea.uiStyleSettings.toolboxColor = '#F472B6',
            markerArea.uiStyleSettings.toolboxAccentColor = '#BE185D',
            markerArea.uiStyleSettings.toolboxStyleColorsClassName = 'bg-gray-50';
        markerArea.uiStyleSettings.toolboxButtonRowStyleColorsClassName = 'bg-gray-50';
        markerArea.uiStyleSettings.toolboxPanelRowStyleColorsClassName =
            'bg-pink-100 bg-opacity-90 fill-current text-pink-400';
        markerArea.uiStyleSettings.toolboxButtonStyleColorsClassName =
            'bg-gradient-to-t from-gray-50 to-gray-50 hover:from-gray-50 hover:to-pink-50 fill-current text-pink-300';
        markerArea.uiStyleSettings.toolboxActiveButtonStyleColorsClassName =
            'bg-gradient-to-b from-pink-100 to-gray-50 fill-current text-pink-400';
        markerArea.show();
    }
</script>
<script>
    $(".simpanpemeriksaan").click(function() {
        var canvas1 = document.getElementById("myCanvas1");
        var ctx1 = canvas1.getContext("2d");
        var img1 = document.getElementById("gambarnya1");
        ctx1.drawImage(img1, 10, 10);
        var dataUrl1 = canvas1.toDataURL();
        $('#telingakanan').val(dataUrl1)
        telingakanan = $('#telingakanan').val()
        var data1 = $('.formtelingakanan').serializeArray();

        var canvas = document.getElementById("myCanvas2");
        var ctx = canvas.getContext("2d");
        var img = document.getElementById("gambarnya2");
        ctx.drawImage(img, 10, 10);
        var dataUrl = canvas.toDataURL();
        $('#telingakiri').val(dataUrl)
        telingakiri = $('#telingakiri').val()
        var data2 = $('.formtelingakiri').serializeArray();

        var kodekunjungan = $('#kodekunjungan').val()
        var nomorrm = $('#nomorrm').val()
        var idassesmen = $('#idassesmen').val()
        var kesimpulan = $('#kesimpulan').val()
        var anjuran = $('#anjuran').val()

        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data1: JSON.stringify(data1),
                data2: JSON.stringify(data2),
                kodekunjungan: kodekunjungan,
                telingakiri,
                telingakanan,
                idassesmen,
                nomorrm,
                kesimpulan,
                anjuran
            },
            url: '<?= route('simpantht_telinga') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                console.log(data)
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: 'Data berhasil disimpan!',
                        footer: ''
                    })
                }
            }
        });
    })
    $(".simpanpemeriksaan2").click(function(){
        var data1 = $('.formhidungkanan').serializeArray();
        var data2 = $('.formhidungkiri').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        var nomorrm = $('#nomorrm').val()
        var idassesmen = $('#idassesmen').val()
        var kesimpulan = $('#kesimpulanhidung').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data1: JSON.stringify(data1),
                data2: JSON.stringify(data2),
                kodekunjungan: kodekunjungan,
                idassesmen,
                nomorrm,
                kesimpulan,
            },
            url: '<?= route('simpantht_hidung') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                console.log(data)
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: 'Data berhasil disimpan!',
                        footer: ''
                    })
                }
            }
        });
    })
</script>
