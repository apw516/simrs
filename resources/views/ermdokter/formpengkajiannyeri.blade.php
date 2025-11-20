<div class="card">
    <div class="card-header bg-info">FORM PENGKAJIAN NYERI ACUTE/ CHRONIC/CANCER </div>
    <div class="card-body">
        <form class="formpemeriksaan">
                <div class="form-group">
                <label for="exampleInputEmail1">1. Lamanya nyeri ( hari / bulan / tahunan)</label>
                <input type="text" class="form-control" id="lamanyeri" name="lamanyeri" aria-describedby="emailHelp" value="@foreach($cek as $c ){{ $c->lamanyeri}}@endforeach">
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">2. Bagaimana kwalitas nyeri sekarang ?</label>
                        <input type="text" class="form-control" id="kualitasnyeri" name="kualitasnyeri" placeholder="Masukan skala 1 sampai 10 ...." value="@foreach($cek as $c ){{ $c->kualitasnyeri}}@endforeach">
                    </div>
                </div>
                <div class="col-md-4">
                    <img width="100%" src="{{ asset('public/img/skalanyeri.jpg') }}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputPassword1">3. Dalam satu bulan terakhir bagaimana kwalitas nyeri
                            ?</label>
                        <input type="text" class="form-control" id="kualitasnyerisatubulan" name="kualitasnyerisatubulan" placeholder="Masukan skala 1 sampai 10 ...." value="@foreach($cek as $c ){{ $c->kualitasnyerisatubulan}}@endforeach">
                    </div>
                </div>
                <div class="col-md-4">
                    <img width="100%" src="{{ asset('public/img/skalanyeri.jpg') }}" alt="">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">4. Tandai Gambaran nyeri anda</label>
                <div class="form-check">
                    <label class="form-check-label" for="defaultCheck1">
                        A. Tetap nyeri kadang agak meningkat
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" id="gambar1" name="gambar1" @foreach ($cek as $c )@if($c->gambar1== 1) checked @endif @endforeach>
                    <img width="10%" src="{{ asset('public/img/nyeri1.png') }}" alt="">
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="defaultCheck1">
                        B. Tetap nyeri kadang sangat nyeri
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" id="gambar2" name="gambar2"  @foreach ($cek as $c )@if($c->gambar2== 1) checked @endif @endforeach>
                    <img width="10%" src="{{ asset('public/img/nyeri2.png') }}" alt="">

                </div>
                <div class="form-check">
                    <label class="form-check-label" for="defaultCheck1">
                        C. Nyeri dengan episode tanpa nyeri
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" id="gambar3" name="gambar3"  @foreach ($cek as $c )@if($c->gambar3== 1) checked @endif @endforeach>
                    <img width="10%" src="{{ asset('public/img/nyeri3.png') }}" alt="">

                </div>
                <div class="form-check">
                    <label class="form-check-label" for="defaultCheck1">
                        D. Mendadak lebih nyeri, dengan episode nyeri diantaranya
                    </label>
                    <input class="form-check-input" type="checkbox" value="1" id="gambar4" name="gambar4" @foreach ($cek as $c )@if($c->gambar4== 1) checked @endif @endforeach>
                    <img width="10%" src="{{ asset('public/img/nyeri4.png') }}" alt="">

                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">5. Apakah nyeri menyebar ke bagian tubuh yang lain ?</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="pertanyaan5" name="pertanyaan5" value="1" @foreach ($cek as $c )@if($c->pertanyaan5 == 1) checked @endif @endforeach >
                    <label class="form-check-label" for="inlineRadio1">YA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="pertanyaan5" name="pertanyaan5" value="0"  @foreach ($cek as $c )@if($c->pertanyaan5 == 0) checked @endif @endforeach @if(count($cek) == 0) checked @endif>
                    <label class="form-check-label" for="inlineRadio2">TIDAK</label>
                </div>
                <textarea class="form-control" name="keterangan5" id="keterangan5" cols="3" rows="4" placeholder="Keterangan ...."> @foreach ($cek as $c ){{$c->keterangan5}}@endforeach</textarea>
            </div>
        </form>
        <div class="card">
            <div class="card-header bg-light">Order Farmasi <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modaltemplate" onclick="ambilresep()">Template resep</button>
            </div>
            <div class="card-body">
                {{-- @if ($selisih > 70)
                <div class="alert alert-warning" role="alert">
                    @if (count($kunjunganKronis) > 0)
                    Pasien Kronis ,
                    @endif Pasien Berpotensi PRB, dan melanjutkan pengobatan kembali ke
                    faskes 1... <b>( Abaikan pesan ini jika diagnosa pasien tidak termasuk 9 diagnosa PRB
                        ...)</b>
                </div>
                @endif --}}
                <div class="form-group mt-2">
                    <button type="button" class="btn btn-success tambahobat" onclick="addform()">+ Tambah
                        Obat</button>
                </div>
                {{-- <input hidden type="text" id="selisih" value="{{ $selisih }}"> --}}
                <input hidden type="text" value="" id="jumlahform">
                <form action="" method="post" class="arrayobat">
                    <div class="formobatfarmasi2">

                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="simpantemplate" onclick="showname()">
                        <label class="form-check-label" for="exampleCheck1">ceklis, untuk
                            simpan
                            resep sebagai template</label>
                    </div>
                    <input hidden type="text" class="form-control col-md-3 mb-3" id="namaresep" name="namaresep" placeholder="isi nama resep ...">
                </form>
                <div class="v_itterasi_obat">

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary" onclick="simpanpemeriksaan()">Simpan</button>
    </div>
</div>
<input hidden name="kodekunjungan" id="kodekunjungan" type="text" value="{{ $kodekunjungan}}">
<input hidden name="nomorrm" id="nomorrm" type="text" value="{{ $nomorrm}}">
<!-- Modal -->
<div class="modal fade" id="modaltemplate" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vtemplateresep">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
     function showname() {
        a = $('#simpantemplate:checked').val()
        if (a == 'on') {
            $('#namaresep').removeAttr('Hidden', true)
        } else {
            $('#namaresep').attr('Hidden', true)
        }
    }
    function simpanpemeriksaan() {
        Swal.fire({
            title: "Anda yakin ?"
            , text: "Hasil pemeriksaan akan disimpan ..."
            , icon: "warning"
            , showCancelButton: true
            , confirmButtonColor: "#3085d6"
            , cancelButtonColor: "#d33"
            , confirmButtonText: "Ya, simpan ..."
        }).then((result) => {
            if (result.isConfirmed) {
                save()
            }
        });
    }

    function save() {
        var data = $('.formpemeriksaan').serializeArray();
        var data2= $('.arrayobat').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        var simpantemplate = $('#simpantemplate:checked').val()
        var namaresep = $('#namaresep').val()
        $.ajax({
            async: true
            , type: 'post'
            , dataType: 'json'
            , data: {
                _token: "{{ csrf_token() }}"
                , data: JSON.stringify(data)
                , data2: JSON.stringify(data2)
                , kodekunjungan
                , nomorrm
                , simpantemplate
                , namaresep
            , }
            , url: '<?= route('simpanpemeriksaanpolinyeri') ?>'
            , error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error'
                    , title: 'Ooops....'
                    , text: 'Sepertinya ada masalah......'
                    , footer: ''
                })
            }
            , success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oopss...'
                        , text: data.message
                        , footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success'
                        , title: 'OK'
                        , text: data.message
                        , footer: ''
                    })
                    resume2()
                }
            }
        });
    }

    function addform() {
        var max_fields = 10;
        var wrapper = $(".formobatfarmasi2"); //Fields wrapper
        var x = 1
        jlh = $('#jumlahform').val()
        cek = document.getElementById('jumlahform').value
        if (cek === '') {
            jlh1 = $('#jumlahform').val(1)
        } else {
            cek = parseInt(document.getElementById('jumlahform').value)
            jlh2 = $('#jumlahform').val(cek + 1)
        }
        nomor = parseInt(document.getElementById('jumlahform').value)
        if (x < max_fields) { //max input box allowed
            nama = 'namaobat' + nomor
            aturan = 'aturanpakai' + nomor
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Obat</label><input type="" class="form-control form-control-sm text-xs" id="' +
                nama +
                '" name="namaobat" value=""><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodebarang" value="""></div><div class="form-group col-md-2"><label for="inputPassword4">Aturan Pakai</label><input type="" class="form-control form-control-sm" id="' +
                aturan +
                '" name="aturanpakai" value=""></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                kode = $(this).attr('kode2')
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
            // $('#'+nama).autocomplete({
            //     source: "<?= route('cariobat') ?>",
            //     select: function(event, ui) {
            //         $('[id="namaobat"]').val(ui.item.label);
            //         $('[id="'+aturan+'"]').val(ui.item.aturan);
            //     }
            // });
        }
    }
    function ambilresep() {
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('ambilresep') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.vtemplateresep').html(response)
                    spinner.hide()
                }
            });
        }
</script>
