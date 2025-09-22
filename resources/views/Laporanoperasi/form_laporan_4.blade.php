<form class="formlaporanoperasi3">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Tanggal Operasi</label>
                <input type="date" class="form-control" id="tanggaloperasi" name="tanggaloperasi"
                    aria-describedby="emailHelp" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                <input type="text" class="form-control" id="jammulaioperasi" name="jammulaioperasi"
                    aria-describedby="emailHelp" placeholder="JAM:MENIT (FORMAT 24JAM)" value="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                <input type="text" class="form-control" id="jamselesaioperasi" name="jamselesaioperasi"
                    aria-describedby="emailHelp" placeholder="JAM:MENIT (FORMAT 24JAM)" value="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Nama ahli bedah</label>
                <textarea rows="4px" type="text" class="form-control" id="namaahlibedah" name="namaahlibedah"
                    aria-describedby="emailHelp"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Nama Asisten</label>
                <textarea rows="4px" type="text" class="form-control" id="namaasisten" name="namaasisten"
                    aria-describedby="emailHelp"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Nama ahli anestesi</label>
                <textarea rows="4px" type="text" class="form-control" id="namaahlianestesi" name="namaahlianestesi"
                    aria-describedby="emailHelp"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Tindakan</label>
                <textarea rows="4px" type="text" class="form-control" id="namaahlianestesi" name="namaahlianestesi"
                    aria-describedby="emailHelp"></textarea>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Diagnosa Sebelum operasi</label>
                <textarea rows="4px" type="text" class="form-control" id="diagnosasebelumoperasi"
                    name="diagnosasebelumoperasi" aria-describedby="emailHelp"></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Diagnosa paska operasi</label>
                <textarea rows="4px" type="text" class="form-control" id="diagnosapaskaoperasi" name="diagnosapaskaoperasi"
                    aria-describedby="emailHelp"></textarea>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Laporan Operasi</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="tindakanaseptik" name="tindakanaseptik"
                            value="option1">
                        <label class="form-check-label" for="inlineCheckbox1">Dilakukan Tindakan aseptik dan antiseptik</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="injeksilidocain" name="injeksilidocain"
                            value="option2">
                        <label class="form-check-label" for="inlineCheckbox2">Dilakukan Injeksi lidocain subtenon</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="guntingjaringanpterygium"
                            name="guntingjaringanpterygium" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Dilakukan jahitan kendali</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="perdarahan" name="perdarahan"
                            value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Peritomi basis Fornix</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="perdarahan" name="perdarahan"
                            value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Peritomi basis Limbal</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="injeksilidocaine"
                            name="injeksilidocaine" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Parasentesis jam</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="pengambilangraft"
                            name="pengambilangraft" value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Iridektomi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="pemberiansalep" name="pemberiansalep"
                            value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Cek filtrasi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="operasiselesai" name="operasiselesai"
                            value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Hidrasi sideport</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="operasiselesai" name="operasiselesai"
                            value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Antibiotik Subkonjungtiva</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="operasiselesai" name="operasiselesai"
                            value="option3">
                        <label class="form-check-label" for="inlineCheckbox3">Antibiotik Topikal</label>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Serelal flap dibuat, ukuran .... x .... mm</label>
                        <textarea rows="4px" type="text" class="form-control" id="pemasanggraftdijahit" name="pemasanggraftdijahit"
                            name="diagnosasebelumoperasi" aria-describedby="emailHelp" placeholder="tulis keterangannya disini ..."></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Selerotomy dibuat, ukuran .... x .... mm</label>
                        <textarea rows="4px" type="text" class="form-control" id="pemasanggraftdijahit" name="pemasanggraftdijahit"
                            name="diagnosasebelumoperasi" aria-describedby="emailHelp" placeholder="tulis keterangannya disini ..."></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Serelal flap dijahit sebanyak....jahitan, dengan benang ...</label>
                        <textarea rows="4px" type="text" class="form-control" id="pemasanggraftdijahit" name="pemasanggraftdijahit"
                            name="diagnosasebelumoperasi" aria-describedby="emailHelp" placeholder="tulis keterangannya disini ..."></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group font-italic">
                        <label for="exampleInputEmail1">Konjungtiva dijahit sebanyak....jahitan, dengan benang ...</label>
                        <textarea rows="4px" type="text" class="form-control" id="pemasanggraftdijahit" name="pemasanggraftdijahit"
                            name="diagnosasebelumoperasi" aria-describedby="emailHelp" placeholder="tulis keterangannya disini ..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
