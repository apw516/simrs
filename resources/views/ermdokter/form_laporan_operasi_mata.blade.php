<div class="card">
    <div class="card-header text-bold font-lg bg-secondary">Laporan Operasi</div>
    <div class="card-body">
        <form action="" class="formlaporanoperasi">

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ruang Operasi</label>
                        <input value="@foreach ($cek as $c ){{$c->ruangoperasi}}@endforeach" type="text" class="form-control" id="ruangoperasi" name="ruangoperasi" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kamar</label>
                        <input value="@foreach ($cek as $c ){{$c->kamaroperasi}}@endforeach" type="text" class="form-control" id="kamaroperasi" name="kamaroperasi" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cito Terencana</label>
                        <input value="@foreach ($cek as $c ){{$c->citoterencana}}@endforeach" type="text" class="form-control" id="citoterencana" name="citoterencana" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Operasi</label>
                        <input @if(count($cek)> 0 ) value="@foreach($cek as $c ){{$c->tanggaloperasi}}@endforeach" @else value="{{ $date }}" @endif type="date" class="form-control" id="tanggaloperasi" name="tanggaloperasi" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam Operasi</label>
                        <input value="@foreach ($cek as $c ){{$c->jamoperasi}}@endforeach" type="time" class="form-control" id="jamoperasi" name="jamoperasi" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pembedah</label>
                        <textarea type="text" class="form-control" id="pembedah" name="pembedah" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->pembedah}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Ahli Anestesi</label>
                        <textarea type="text" class="form-control" id="ahlianestesi" name="ahlianestesi" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->ahlianestesi}}@endforeach</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Asisten I</label>
                        <textarea type="text" class="form-control" id="asisten1" name="asisten1" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->asisten1}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Asisten II</label>
                        <textarea type="text" class="form-control" id="asisten2" name="asisten2" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->asisten2}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Perawat Instrumen</label>
                        <textarea type="text" class="form-control" id="perawatinstrumen" name="perawatinstrumen" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->perawatinstrumen}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Anestesi</label>
                        <textarea type="text" class="form-control" id="jenisanestesi" name="jenisanestesi" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->jenisanestesi}}@endforeach</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diagnosa Prabedah</label>
                        <textarea type="text" class="form-control" id="diagnosaprabedah" name="diagnosaprabedah" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->diagnosaprabedah}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Indikasi Operasi</label>
                        <textarea type="text" class="form-control" id="indikasioperasi" name="indikasioperasi" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->indikasioperasi}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diagnosa Pasca Bedah</label>
                        <textarea type="text" class="form-control" id="diagnosapascabedah" name="diagnosapascabedah" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->diagnosapascabedah}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Operasi</label>
                        <textarea type="text" class="form-control" id="jenisoperasi" name="jenisoperasi" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->jenisoperasi}}@endforeach</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Desinfeksi Kulit dengan</label>
                        <textarea type="text" class="form-control" id="desinfeksikulitdengan" name="desinfeksikulitdengan" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->desinfeksikulitdengan}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jaringan yang dieksisi</label>
                        <textarea type="text" class="form-control" id="jaringanyangdieksisi" name="jaringanyangdieksisi" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->jaringanyangdieksisi}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dikirm Ke bagian patologi anatomi :</label> <br>
                        <div class="form-check form-check-inline">
                            <input @foreach ($cek as $c )@if($c->kirimkepatologi == 1) checked @endif @endforeach class="form-check-input" type="radio" name="kirimkepatologi" id="kirimkepatologi" value="1">
                            <label class="form-check-label" for="inlineRadio1">Ya</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input @if(count($cek)> 0 ) @foreach ($cek as $c ) @if($c->kirimkepatologi == 0) checked @endif @endforeach @else checked @endif class="form-check-input" type="radio" name="kirimkepatologi" id="kirimkepatologi" value="0">
                            <label class="form-check-label" for="inlineRadio2">Tidak</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                        <input value="@foreach ($cek as $c ){{$c->jammulaioperasi}}@endforeach" type="time" class="form-control" id="jammulaioperasi" name="jammulaioperasi" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam Operasi selesai</label>
                        <input value="@foreach ($cek as $c ){{$c->jamoperasiselesai}}@endforeach" type="time" class="form-control" id="jamoperasiselesai" name="jamoperasiselesai" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lama Operasi Berlangsung</label>
                        <input value="@foreach ($cek as $c ){{$c->lamaoperasiberlangsung}}@endforeach" type="text" class="form-control" id="lamaoperasiberlangsung" name="lamaoperasiberlangsung" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Bahan yang dikirimkan ke laboratorium ...</label>
                        <textarea type="text" class="form-control" id="jenisbahanyangdikirim" name="jenisbahanyangdikirim" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->jenisbahanyangdikirim}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Untuk Pemerikssaan ...</label>
                        <textarea type="text" class="form-control" id="untukpemeriksaan" name="untukpemeriksaan" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->untukpemeriksaan}}@endforeach</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Macam sayatan ...</label>
                        <textarea type="text" class="form-control" id="macamsayatan" name="macamsayatan" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->macamsayatan}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Posisi Penderita ...</label>
                        <textarea type="text" class="form-control" id="posisipenderita" name="posisipenderita" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->posisipenderita}}@endforeach</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="exampleInputEmail1" class="mb-2">Teknik Operasi dan temuan intra - operasi</label>
                    <label for="exampleInputEmail1">1. Pasien tidur terlentang di meja operasi</label>
                    <label for="exampleInputEmail1">2. Dilakukan tindakan aseptik dan antiseptik dengan betadine </label><br>
                    <div class="form-check form-check-inline">
                        <input @if(count($cek)> 0 ) @foreach ($cek as $c )@if($c->pertanyaan2 == 'Mata Kanan') checked @endif @endforeach @else checked @endif class="form-check-input" type="radio" name="pertanyaan2" id="pertanyaan2" value="Mata Kanan">
                        <label class="form-check-label" for="inlineRadio1">Mata Kanan</label>
                    </div>
                    <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                        <input @foreach ($cek as $c )@if($c->pertanyaan2 == 'Mata Kiri') checked @endif @endforeach class="form-check-input" type="radio" name="pertanyaan2" id="pertanyaan2" value="Mata Kiri">
                        <label class="form-check-label" for="inlineRadio2">Mata Kiri</label>
                    </div><br>
                    <label for="exampleInputEmail1">3. Pasang Doek bolong </label><br>
                    <label for="exampleInputEmail1">4. Anestesi dengan lidokain topikal</label><br>
                    <label for="exampleInputEmail1">5. Pasang Klem </label><br>
                    <label for="exampleInputEmail1">6. Lakukan insisi dengan pisau </label><br>
                    <label for="exampleInputEmail1">7. Bersihkan hordeolum / kalazion dengan kuret</label><br>
                    <label for="exampleInputEmail1">8. Lepaskan klem </label><br>
                    <label for="exampleInputEmail1">9. Berikan Salep Antibiotik </label><br>
                    <label for="exampleInputEmail1">10. Operasi Selesai </label><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Penggunaan BHP Khusus ...</label><br>
                        <div class="form-check form-check-inline">
                            <input @if(count($cek)> 0 ) @foreach ($cek as $c )@if($c->penggunaanBHP == '0') checked @endif @endforeach @else checked @endif class="form-check-input" type="radio" name="penggunaanBHP" id="penggunaanBHP" value="0">
                            <label class="form-check-label" for="inlineRadio1">TIDAK</label>
                        </div>
                        <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                            <input @foreach ($cek as $c )@if($c->penggunaanBHP == '1') checked @endif @endforeach class="form-check-input" type="radio" name="penggunaanBHP" id="penggunaanBHP" value="1">
                            <label class="form-check-label" for="inlineRadio2">YA</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis dan jumlah BHP ...</label>
                        <textarea type="text" class="form-control" id="jenisjumlahBHP" name="jenisjumlahBHP" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->jenisjumlahBHP}}@endforeach</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Komplikasi Intra-operasi...</label><br>
                        <div class="form-check form-check-inline">
                            <input @if(count($cek)> 0 ) @foreach ($cek as $c )@if($c->komplikasiintraoprasi == '0') checked @endif @endforeach @else checked @endif class="form-check-input" type="radio" name="komplikasiintraoprasi" id="komplikasiintraoprasi" value="0">
                            <label class="form-check-label" for="inlineRadio1">TIDAK</label>
                        </div>
                        <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                            <input @foreach ($cek as $c )@if($c->komplikasiintraoprasi == '1') checked @endif @endforeach class="form-check-input" type="radio" name="komplikasiintraoprasi" id="komplikasiintraoprasi" value="1">
                            <label class="form-check-label" for="inlineRadio2">YA</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Penjabaran Komplikasi Intra-Operasi ...</label>
                        <textarea type="text" class="form-control" id="penjabarankomplikasi" name="penjabarankomplikasi" aria-describedby="emailHelp">@foreach ($cek as $c ){{$c->penjabarankomplikasi}}@endforeach</textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Perdarahan ...</label>
                       <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="perdarahan" id="perdarahan" value="@foreach ($cek as $c ){{$c->perdarahan}}@endforeach">
                        <span class="input-group-text" id="basic-addon2">cc</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Instruksi Pasca Bedah</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">1. Kontrol nadi / tensi / pernafasan / suhu ...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="kontrolnaditensi" id="kontrolnaditensi">@foreach ($cek as $c ){{$c->kontrolnaditensi}}@endforeach</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">5. Obat Obatan ...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obatobatan" id="obatobatan">@foreach ($cek as $c ){{$c->obatobatan}}@endforeach</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">2. Puasa ...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="puasa" id="puasa">@foreach ($cek as $c ){{$c->puasa}}@endforeach</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">6. Ganti Balut...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="gantibalut" id="gantibalut">@foreach ($cek as $c ){{$c->gantibalut}}@endforeach</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">3. Drain...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="drain" id="drain">@foreach ($cek as $c ){{$c->drain}}@endforeach</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">7. Lain Lain...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="lainlain" id="lainlain">@foreach ($cek as $c ){{$c->lainlain}}@endforeach</textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlTextarea1" class="form-label">4. Infus...</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="infus" id="infus">@foreach ($cek as $c ){{$c->infus}}@endforeach</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        @if(count($cek)> 0) @if($cek[0]->pic != auth()->user()->id ) <h5 class="text-danger mb-2">Laporan operasi sudah diisi oleh {{ $username }}...</h5> @endif @endif
        <button class="btn btn-success" onclick="sve()" @if(count($cek)> 0) @if($cek[0]->pic != auth()->user()->id ) disabled @endif @endif><i class="bi bi-download"></i> Simpan</button>
    </div>
</div>
<script>
    function sve() {
        Swal.fire({
            title: "Anda yakin ?"
            , text: "Laporan operasi akan disimpan ..."
            , icon: "warning"
            , showCancelButton: true
            , confirmButtonColor: "#3085d6"
            , cancelButtonColor: "#d33"
            , confirmButtonText: "Ya, simpan!"
        }).then((result) => {
            if (result.isConfirmed) {
                simpandata()
            }
        });
    }

    function simpandata() {
        var data1 = $('.formlaporanoperasi').serializeArray();
        var kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true
            , type: 'post'
            , dataType: 'json'
            , data: {
                _token: "{{ csrf_token() }}"
                , data1: JSON.stringify(data1)
                , kodekunjungan
            }
            , url: '<?= route('simpanhasiloperasi') ?>'
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
                }
            }
        });
    }

</script>
