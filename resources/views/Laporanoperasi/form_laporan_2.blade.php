<form class="formlaporanoperasi2">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Tanggal Operasi</label>
                <input type="date" class="form-control" id="tanggaloperasi" name="tanggaloperasi" aria-describedby="emailHelp" value="@if(count($cek)>0){{ $cek[0]->tanggaloperasi}}@endif">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                <input type="text" class="form-control" id="jammulaioperasi" name="jammulaioperasi" aria-describedby="emailHelp"
                    placeholder="JAM:MENIT (FORMAT 24JAM)"  value="@if(count($cek)>0){{ $cek[0]->jammulaioperasi}}@endif">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                <input type="text" class="form-control" id="jamselesaioperasi" name="jamselesaioperasi" aria-describedby="emailHelp"
                    placeholder="JAM:MENIT (FORMAT 24JAM)"  value="@if(count($cek)>0){{ $cek[0]->jamselesaioperasi}}@endif">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Nama ahli bedah</label>
                <textarea rows="4px" type="text" class="form-control" id="namaahlibedah" name="namaahlibedah" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->namaahlibedah}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Nama Asisten</label>
                <textarea rows="4px" type="text" class="form-control" id="namaasisten" name="namaasisten" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->namaasisten}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Nama ahli anestesi</label>
                <textarea rows="4px" type="text" class="form-control" id="namaahlianestesi" name="namaahlianestesi" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->namaahlianestesi}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jenis anestesi</label>
                <textarea rows="4px" type="text" class="form-control" id="jenisanestesi" name="jenisanestesi" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->jenisanestesi}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Diagnosa Sebelum operasi</label>
                <textarea rows="4px" type="text" class="form-control" id="diagnosasebelumoperasi" name="diagnosasebelumoperasi" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->diagnosasebelumoperasi}}@endif</textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Diagnosa paska operasi</label>
                <textarea rows="4px" type="text" class="form-control" id="diagnosapaskaoperasi" name="diagnosapaskaoperasi" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->diagnosapaskaoperasi}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Lapooran Operasi</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="injeksiantibiotik" name="injeksiantibiotik" @if(count($cek) >0) @if($cek[0]->injeksiantibiotik== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Injeksi antibiotik</label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea rows="2px" type="text" class="form-control" id="keteranganinjeksiantibiotik" name="keteranganinjeksiantibiotik" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->keteranganinjeksiantibiotik}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="injeksiantivegp" name="injeksiantivegp" @if(count($cek) >0) @if($cek[0]->injeksiantivegp== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Injeksi anti VEGP</label>
                    </div>
                    <div class="row container">
                        <div class="col-md-4">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="avastine" name="avastine" @if(count($cek) >0) @if($cek[0]->avastine== 1) checked @endif @endif>
                                <label class="form-check-label" for="exampleCheck1">Avastine</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="patizra" name="patizra" @if(count($cek) >0) @if($cek[0]->patizra== 1) checked @endif @endif>
                                <label class="form-check-label" for="exampleCheck1">Patizra</label>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="eylea" name="eylea" @if(count($cek) >0) @if($cek[0]->eylea== 1) checked @endif @endif>
                                <label class="form-check-label" for="exampleCheck1">Eylea</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="tindakanaseptikdanantiseptik" name="tindakanaseptikdanantiseptik" @if(count($cek) > 0) @if($cek[0]->tindakanaseptikdanantiseptik== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Tindakan aseptik dan antiseptik dengan
                            betadine</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lokasiinjek4mm" name="lokasiinjek4mm" @if(count($cek) >0) @if($cek[0]->lokasiinjek4mm== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Lokasi injeksi dari limbus ( 4 mm dari
                            limbus)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="lokasiinjek3mm" name="lokasiinjek3mm" @if(count($cek) >0) @if($cek[0]->lokasiinjek3mm== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Lokasi injeksi dari limbus ( 3 mm dari
                            limbus)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="injeksivegf" name="injeksivegf" @if(count($cek) >0) @if($cek[0]->injeksivegf== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Injeksi VEGF</label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea rows="2px" type="text" class="form-control" id="keteranganinjeksivegf" name="keteranganinjeksivegf" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->keteranganinjeksivegf}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="injeksiantibiotik2" name="injeksiantibiotik2" @if(count($cek) >0) @if($cek[0]->injeksiantibiotik2== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Injeksi Antibiotik</label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea rows="2px" type="text" class="form-control" id="keteranganinjeksiantibiotik2" name="keteranganinjeksiantibiotik2" aria-describedby="emailHelp">@if(count($cek)>0){{ $cek[0]->keteranganinjeksiantibiotik2}}@endif</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="tetesmataantibiotik" name="tetesmataantibiotik" @if(count($cek) >0) @if($cek[0]->tetesmataantibiotik== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Tetes mata Antibiotik</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="balut" name="balut" @if(count($cek) >0) @if($cek[0]->balut== 1) checked @endif @endif>
                        <label class="form-check-label" for="exampleCheck1">Balut</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
