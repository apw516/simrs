<form class="formlaporanoperasi1">
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Ruang Operasi</label>
                <input type="text" class="form-control" id="ruangoperasi" value="@if(count($cek) > 0){{ $cek[0]->ruangoperasi}}@endif" name="ruangoperasi"
                    placeholder="Masukan nama ruang operasi ...">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Kamar</label>
                <input type="text" class="form-control" id="kamaroperasi" value="@if(count($cek) > 0){{ $cek[0]->kamaroperasi}}@endif" name="kamaroperasi"
                    placeholder="Masukan nama kamar operasi ...">
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Cito Terencana</label>
                <input type="text" class="form-control" id="citoterencana" name="citoterencana"
                    placeholder="Masukan cito terencana ..." value="@if(count($cek) > 0){{ $cek[0]->citoterencana}}@endif">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Tanggal Operasi</label>
                <input type="date" class="form-control" id="tanggaloperasi" name="tanggaloperasi"
                    placeholder="masukan tanggal operasi ..." value="@if(count($cek) > 0){{ $cek[0]->tanggaloperasi}}@endif">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jam Operasi</label>
                <input type="text" class="form-control" id="jamoperasi" name="jamoperasi"
                    placeholder="JAM:MENIT (FORMAT 24JAM)" value="@if(count($cek) > 0){{ $cek[0]->jamoperasi}}@endif">
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Pembedah</label>
                <textarea type="text" class="form-control" id="pembedah" name="pembedah" placeholder="Masukan nama pembedah ...">@if(count($cek) > 0){{ $cek[0]->pembedah}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Ahli Anestesi</label>
                <textarea type="text" class="form-control" id="ahlianestesi" name="ahlianestesi"
                    placeholder="Masukan nama ahli anestesi ...">@if(count($cek) > 0){{ $cek[0]->ahlianestesi}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Asisten</label>
                <textarea type="text" class="form-control" id="asisten" name="asisten" placeholder="Masukan nama nama asisten ...">@if(count($cek) > 0){{ $cek[0]->asisten}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Perawat Instrumen</label>
                <textarea type="text" class="form-control" id="perawatinstrumen" name="perawatinstrumen"
                    placeholder="Masukan nama nama perawat instrumen ...">@if(count($cek) > 0){{ $cek[0]->perawatinstrumen}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jenis Anestesi</label>
                <textarea type="text" class="form-control" id="jenisanestesi" name="jenisanestesi" placeholder="Masukan jenis anestesi ...">@if(count($cek) > 0){{ $cek[0]->jenisanestesi}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Diagnosa Pra-bedah</label>
                <textarea type="text" class="form-control" id="diagnosaprabedah" name="diagnosaprabedah"
                    placeholder="Masukan diagnosa pra-bedah ...">@if(count($cek) > 0){{ $cek[0]->diagnosaprabedah}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Indikasi Operasi</label>
                <textarea type="text" class="form-control" id="indikasioperasi" name="indikasioperasi" placeholder="Masukan indikaasi operasi ...">@if(count($cek) > 0){{ $cek[0]->indikasioperasi}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Diagnosa Pasca-bedah</label>
                <textarea type="text" class="form-control" id="diagnosapascabedah" name="diagnosapascabedah"
                    placeholder="Masukan diagnosa pasca-bedah ...">@if(count($cek) > 0){{ $cek[0]->diagnosapascabedah}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jenis Operasi</label>
                <textarea type="text" class="form-control" id="jenisoperasi" name="jenisoperasi" placeholder="Masukan jenis operasi ...">@if(count($cek) > 0){{ $cek[0]->jenisoperasi}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Desinfeksi kulit dengan </label>
                <textarea type="text" class="form-control" id="desinfeksikulit" name="desinfeksikulit"
                    placeholder="Masukan desinfeksi kulit dengan ...">@if(count($cek) > 0){{ $cek[0]->desinfeksikulit}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jaringan yang dieksisi</label>
                <textarea type="text" class="form-control" id="jaringanyangdikesisi" name="jaringanyangdikesisi" placeholder="Masukan Jaringan yang dieksisi ...">@if(count($cek) > 0){{ $cek[0]->jaringanyangdikesisi}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Dikirim ke bagian patologi anatomi ?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kirimkepatologi" id="kirimkepatologi"
                        value="1" @if(count($cek) > 0) @if($cek[0]->kirimkepatologi == 1 ) checked @endif @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kirimkepatologi" id="kirimkepatologi"
                        value="0" @if(count($cek) > 0) @if($cek[0]->kirimkepatologi == 0 ) checked @endif @else checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jam operasi dimulai </label>
                <input type="text" class="form-control" id="jamoperasidimulai" name="jamoperasidimulai"
                    placeholder="JAM:MENIT (FORMAT 24JAM)" value="@if(count($cek) > 0){{ $cek[0]->jamoperasidimulai}}@endif"></input>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jam operasi selesai </label>
                <input type="text" class="form-control" id="jamoperasiselesai" name="jamoperasiselesai"
                    placeholder="JAM:MENIT (FORMAT 24JAM)" value="@if(count($cek) > 0){{ $cek[0]->jamoperasiselesai}}@endif"></input>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Lama Operasi berlangsung</label>
                <textarea type="text" class="form-control" id="lamaoperasiberlangsung" name="lamaoperasiberlangsung" placeholder="Masukan lama operasi berlangsung ...">@if(count($cek) > 0){{ $cek[0]->lamaoperasiberlangsung}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group font-italic text-xs">
                <label for="exampleFormControlInput1 font-italic">Jenis bahan yang dikirim ke laboratorium untuk
                    pemeriksaan ...</label>
                <textarea type="text" class="form-control" id="jenisbahanyangdikirimkelab" name="jenisbahanyangdikirimkelab" placeholder="Jenis bahan yang dikirim laboratorium dan untuk pemeriksaan ...">@if(count($cek) > 0){{ $cek[0]->jenisbahanyangdikirimkelab}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Macam Sayatan</label>
                <textarea type="text" class="form-control" id="macamsayatan" name="macamsayatan"
                    placeholder="Masukan macam sayatan ...">@if(count($cek) > 0){{ $cek[0]->macamsayatan}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Posisi Penderita</label>
                <textarea type="text" class="form-control" id="posisipenderita" name="posisipenderita" placeholder="Masukan posisi penderita ...">@if(count($cek) > 0){{ $cek[0]->posisipenderita}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-12">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Teknik operasi dan temuan intra-operasi</label>
                <textarea rows="4px" type="text" class="form-control" id="teknikoperasidantemuan" name="teknikoperasidantemuan"
                    placeholder="Masukan teknik operasi dan temuan ...">@if(count($cek) > 0){{ $cek[0]->teknikoperasidantemuan}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-5">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Penggunan BHP Khusus ?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penggunaanbhp" id="penggunaanbhp"
                        value="1" @if(count($cek) > 0) @if($cek[0]->penggunaanbhp == 1 ) checked @endif @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="penggunaanbhp" id="penggunaanbhp"
                        value="0" @if(count($cek) > 0) @if($cek[0]->penggunaanbhp == 0 ) checked @endif @else checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Jenis dan jumlah ( BHP Khusus )</label>
                <textarea type="text" class="form-control" id="jenisdanjumlahbhp" name="jenisdanjumlahbhp" placeholder="Masukan jenis operasi ...">@if(count($cek) > 0){{ $cek[0]->jenisdanjumlahbhp}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Komplikasi intra-operasi ?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="komplikasiintraoperasi" id="komplikasiintraoperasi"
                        value="1"  @if(count($cek) > 0) @if($cek[0]->komplikasiintraoperasi == 1 ) checked @endif @endif>
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="komplikasiintraoperasi" id="komplikasiintraoperasi"
                        value="0"  @if(count($cek) > 0) @if($cek[0]->komplikasiintraoperasi == 0 ) checked @endif @else checked @endif>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Penjabaran komplikasi intra-operasi</label>
                <textarea type="text" class="form-control" id="penjabarankomplikasi" name="penjabarankomplikasi" placeholder="Masukan jenis operasi ...">@if(count($cek) > 0){{ $cek[0]->penjabarankomplikasi}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group font-italic">
                <label for="exampleFormControlInput1 font-italic">Perdarahan</label>
                <input type="text" class="form-control" id="perdarahancc" name="perdarahancc"
                    placeholder="Masukan jenis operasi ..." value="@if(count($cek) > 0){{ $cek[0]->perdarahancc}} @else 0 cc @endif"></input>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Instruksi Pasca - bedah</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">1. Kontrol nadi / tensi / pernafasan / suhu /
                            ....</label>
                        <textarea type="text" class="form-control" id="instruksi1" name="instruksi1" placeholder="Masukan instruksi 1 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi1}}@endif</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">5. Obat obatan </label>
                        <textarea type="text" class="form-control" id="instruksi5" name="instruksi5" placeholder="Masukan instruksi 5 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi5}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">2. Puasa</label>
                        <textarea type="text" class="form-control" id="instruksi2" name="instruksi2" placeholder="Masukan instruksi 2 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi2}}@endif</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">6. Ganti balut</label>
                        <textarea type="text" class="form-control" id="instruksi6" name="instruksi6" placeholder="Masukan instruksi 6 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi6}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">3. Drain</label>
                        <textarea type="text" class="form-control" id="instruksi3" name="instruksi3" placeholder="Masukan instruksi 3 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi3}}@endif</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">7. Lain - lain</label>
                        <textarea type="text" class="form-control" id="instruksi7" name="instruksi7" placeholder="Masukan instruksi 7 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi7}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group font-italic">
                        <label for="exampleFormControlInput1 font-italic">4. Infus</label>
                        <textarea type="text" class="form-control" id="instruksi4" name="instruksi4" placeholder="Masukan instruksi4 ..."
                            value="">@if(count($cek) > 0){{ $cek[0]->instruksi4}}@endif</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
