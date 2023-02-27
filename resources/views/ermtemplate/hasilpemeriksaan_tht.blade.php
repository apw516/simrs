<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger">Telinga Kanan</div>
            <div class="card-body">
                @if(count($kanan) > 0)
                <table class="table table-sm">
                    <tr>
                        <td>Liang Telinga</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Lapang"
                                            value="1"
                                            @if ($kanan['0']->LT_lapang == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Lapang </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Sempit"
                                            value="1"
                                            @if ($kanan['0']->LT_Sempit == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sempit </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Destruksi" value="1"
                                            @if ($kanan['0']->LT_dataSetestruksi == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Destruksi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Serumen"
                                            value="1"
                                            @if ($kanan['0']->LT_Serumen == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Serumen</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Sekret"
                                            value="1"
                                            @if ($kanan['0']->LT_Sekret == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sekret</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Jamur"
                                            value="1"
                                            @if ($kanan['0']->LT_Jamur == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Jamur</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Kolesteatoma" value="1"
                                            @if ($kanan['0']->LT_Kolesteatoma == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Kolesteatoma</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Massa atau Jaringan"
                                            value="1"
                                            @if ($kanan['0']->LT_Massa_Jaringan == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Massa atau
                                            Jaringan</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Benda Asing" value="1"
                                            @if ($kanan['0']->LT_Benda_asing == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Benda
                                            Asing</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="LT Lain-Lain" value="1"
                                            @if ($kanan['0']->LT_Lain_lain == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">LT
                                            Lain-Lain</label>
                                    </div>
                                </div>
                                <input class="form-control"
                                    name="ltketeranganlain"
                                    value="{{ $kanan['0']->LT_Keterangan_lain }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Membran Timpan</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Intak - Normal"
                                            value="1"
                                            @if ($kanan['0']->MT_intak_normal) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Normal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Intak - Hiperemis"
                                            value="1"
                                            @if ($kanan['0']->MT_intak_hiperemis) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Hiperemis</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Intak - Bulging"
                                            value="1"
                                            @if ($kanan['0']->MT_intak_bulging) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Bulging</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Intak - Retraksi"
                                            value="1"
                                            @if ($kanan['0']->MT_intak_retraksi) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Retraksi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Intak - Sklerotik"
                                            value="1"
                                            @if ($kanan['0']->MT_intak_sklerotik) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Sklerotik</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Perforasi - Sentral"
                                            value="1"
                                            @if ($kanan['0']->MT_perforasi_sentral) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Sentral</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Perforasi - Atik"
                                            value="1"
                                            @if ($kanan['0']->MT_perforasi_atik) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Atik</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Perforasi - Marginal"
                                            value="1"
                                            @if ($kanan['0']->MT_perforasi_marginal) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Marginal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Perforasi - Lain-Lain"
                                            value="1"
                                            @if ($kanan['0']->MT_perforasi_lain) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Lain-Lain</label>
                                    </div>
                                </div>
                                <input class="form-control"
                                    name="mtketeranganlain"
                                    value="{{ $kanan['0']->MT_keterangan_lain }}">

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
                                        name="mukosa"
                                        value="{{ $kanan['0']->MT_mukosa }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Oslkel</label>
                                    <input type="text" class="form-control"
                                        name="oslkel"
                                        value="{{ $kanan['0']->MT_osikal }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Isthmus
                                        timpani/anterior
                                        timpani/posterior timpani</label>
                                    <input type="text" class="form-control"
                                        name="Isthmus"
                                        value="{{ $kanan['0']->MT_isthmus }}">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Lain - Lain</td>
                        <td>
                            <textarea class="form-control" name="keteranganlain">{{ $kanan['0']->lain_lain }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Telinga kanan</td>
                        <td>
                            <div class="gambar1">
                                <img src="{{ $kanan[0]->gambar }}" alt="">
                            </div>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger">Telinga Kiri</div>
            <div class="card-body">
                @if(count($kiri) > 0)
                <table class="table table-sm">
                    <tr>
                        <td>Liang Telinga</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Lapang"
                                            value="1"
                                            @if ($kiri['0']->LT_lapang == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Lapang </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Sempit"
                                            value="1"
                                            @if ($kiri['0']->LT_Sempit == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sempit </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Destruksi" value="1"
                                            @if ($kiri['0']->LT_dataSetestruksi == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Destruksi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Serumen"
                                            value="1"
                                            @if ($kiri['0']->LT_Serumen == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Serumen</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Sekret"
                                            value="1"
                                            @if ($kiri['0']->LT_Sekret == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sekret</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" name="Jamur"
                                            value="1"
                                            @if ($kiri['0']->LT_Jamur == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Jamur</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Kolesteatoma" value="1"
                                            @if ($kiri['0']->LT_Kolesteatoma == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Kolesteatoma</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Massa atau Jaringan"
                                            value="1"
                                            @if ($kiri['0']->LT_Massa_Jaringan == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Massa atau
                                            Jaringan</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="Benda Asing" value="1"
                                            @if ($kiri['0']->LT_Benda_asing == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Benda
                                            Asing</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            name="LT Lain-Lain" value="1"
                                            @if ($kiri['0']->LT_Lain_lain == 1) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">LT
                                            Lain-Lain</label>
                                    </div>
                                </div>
                                <input class="form-control"
                                    name="ltketeranganlain"
                                    value="{{ $kiri['0']->LT_Keterangan_lain }}">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Membran Timpan</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Intak - Normal"
                                            value="1"
                                            @if ($kiri['0']->MT_intak_normal) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Normal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Intak - Hiperemis"
                                            value="1"
                                            @if ($kiri['0']->MT_intak_hiperemis) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Hiperemis</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Intak - Bulging"
                                            value="1"
                                            @if ($kiri['0']->MT_intak_bulging) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Bulging</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Intak - Retraksi"
                                            value="1"
                                            @if ($kiri['0']->MT_intak_retraksi) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Retraksi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Intak - Sklerotik"
                                            value="1"
                                            @if ($kiri['0']->MT_intak_sklerotik) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Intak -
                                            Sklerotik</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Perforasi - Sentral"
                                            value="1"
                                            @if ($kiri['0']->MT_perforasi_sentral) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Sentral</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id="" name="Perforasi - Atik"
                                            value="1"
                                            @if ($kiri['0']->MT_perforasi_atik) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Atik</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Perforasi - Marginal"
                                            value="1"
                                            @if ($kiri['0']->MT_perforasi_marginal) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Marginal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input"
                                            id=""
                                            name="Perforasi - Lain-Lain"
                                            value="1"
                                            @if ($kiri['0']->MT_perforasi_lain) checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Perforasi -
                                            Lain-Lain</label>
                                    </div>
                                </div>
                                <input class="form-control"
                                    name="mtketeranganlain"
                                    value="{{ $kiri['0']->MT_keterangan_lain }}">

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
                                        name="mukosa"
                                        value="{{ $kiri['0']->MT_mukosa }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Oslkel</label>
                                    <input type="text" class="form-control"
                                        name="oslkel"
                                        value="{{ $kiri['0']->MT_osikal }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Isthmus
                                        timpani/anterior
                                        timpani/posterior timpani</label>
                                    <input type="text" class="form-control"
                                        name="Isthmus"
                                        value="{{ $kiri['0']->MT_isthmus }}">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Lain - Lain</td>
                        <td>
                            <textarea class="form-control" name="keteranganlain">{{ $kiri['0']->lain_lain }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Telinga kiri</td>
                        <td>
                            <div class="gambar1">
                                <img src="{{ $kiri[0]->gambar }}" alt="">
                            </div>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>
    @if(count($kanan) > 0)
    <div class="col-md-12">
        <table class="table table-sm">
            <tr>
                <td>Kesimpulan</td>
                <td>{{ $kanan[0]->kesimpulan }}</td>
            </tr>
            <tr>
                <td>Anjuran</td>
                <td>{{ $kanan[0]->anjuran }}</td>
            </tr>
        </table>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger">Hidung Kanan</div>
            <div class="card-body">
                @if(count($hidungkanan) > 0)
                <table class="table table-sm">
                    <tr>
                        <td>Kavum Nasi</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Lapang" value="1" @if($hidungkanan[0]->KN_Lapang == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Lapang</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Sempit" value="1" @if($hidungkanan[0]->KN_Sempit == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sempit</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Mukosa Pucat" value="1" @if($hidungkanan[0]->KN_Mukosa_pucat == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Mukosa Pucat</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Mukosa Hiperemis" value="1" @if($hidungkanan[0]->KN_Mukosa_hiperemis == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Mukosa
                                            Hiperemis</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Kavum Nasi Mukosa Edema"
                                            value="1" @if($hidungkanan[0]->KN_Mukosa_edema == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Kavum Nasi Mukosa
                                            Edema</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Massa" value="1" @if($hidungkanan[0]->KN_Massa == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Massa</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Kavum Nasi Polip" value="1" @if($hidungkanan[0]->KN_Polip == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Kavum Nasi
                                            Polip</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Konka Inferior</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Eutrofi" value="1" @if($hidungkanan[0]->KI_Eutrofi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Eutrofi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Hipertrofi" value="1" @if($hidungkanan[0]->KI_Hipertrofi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Hipertrofi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Atrofi" value="1" @if($hidungkanan[0]->KI_Atrofi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Atrofi</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Meatus Medius</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Terbuka" value="1" @if($hidungkanan[0]->MM_Terbuka == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Terbuka</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Tertutup" value="1" @if($hidungkanan[0]->MM_Tertutup == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Tertutup</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Mukosa Edema" value="1" @if($hidungkanan[0]->MM_Mukosa_Edema == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Mukosa Edema</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Septum</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Septum Polip" value="1" @if($hidungkanan[0]->S_Polip == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Septum Polip</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Sekret" value="1" @if($hidungkanan[0]->S_Sekret == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sekret</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Lurus" value="1" @if($hidungkanan[0]->S_Lurus == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Lurus</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Deviasi" value="1" @if($hidungkanan[0]->S_Deviasi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Deviasi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Spina" value="1" @if($hidungkanan[0]->S_Spina == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Spina</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nasofaring</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Normal" value="1" @if($hidungkanan[0]->N_Normal == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Normal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Adenoid" value="1" @if($hidungkanan[0]->N_Adenoid == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Adenoid</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Keradangan" value="1" @if($hidungkanan[0]->N_Keradangan == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Keradangan</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Massa" value="1" @if($hidungkanan[0]->N_Massa == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Massa</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Lain - Lain</td>
                        <td>
                            <textarea class="form-control" name="lain-lain">{{ $hidungkanan[0]->lain_lain }}</textarea>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger">Hidung Kiri</div>
            <div class="card-body">
                @if(count($hidungkiri) > 0)
                <table class="table table-sm">
                    <tr>
                        <td>Kavum Nasi</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Lapang" value="1" @if($hidungkiri[0]->KN_Lapang == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Lapang</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Sempit" value="1" @if($hidungkiri[0]->KN_Sempit == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sempit</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Mukosa Pucat" value="1" @if($hidungkiri[0]->KN_Mukosa_pucat == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Mukosa Pucat</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Mukosa Hiperemis" value="1" @if($hidungkiri[0]->KN_Mukosa_hiperemis == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Mukosa
                                            Hiperemis</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Kavum Nasi Mukosa Edema"
                                            value="1" @if($hidungkiri[0]->KN_Mukosa_edema == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Kavum Nasi Mukosa
                                            Edema</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Massa" value="1" @if($hidungkiri[0]->KN_Massa == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Massa</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Kavum Nasi Polip" value="1" @if($hidungkiri[0]->KN_Polip == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Kavum Nasi
                                            Polip</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Konka Inferior</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Eutrofi" value="1" @if($hidungkiri[0]->KI_Eutrofi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Eutrofi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Hipertrofi" value="1" @if($hidungkiri[0]->KI_Hipertrofi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Hipertrofi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Atrofi" value="1" @if($hidungkiri[0]->KI_Atrofi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Atrofi</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Meatus Medius</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Terbuka" value="1" @if($hidungkiri[0]->MM_Terbuka == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Terbuka</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Tertutup" value="1" @if($hidungkiri[0]->MM_Tertutup == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Tertutup</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Mukosa Edema" value="1" @if($hidungkiri[0]->MM_Mukosa_Edema == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Mukosa Edema</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Septum</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Septum Polip" value="1" @if($hidungkiri[0]->S_Polip == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Septum Polip</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Sekret" value="1" @if($hidungkiri[0]->S_Sekret == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Sekret</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Lurus" value="1" @if($hidungkiri[0]->S_Lurus == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Lurus</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Deviasi" value="1" @if($hidungkiri[0]->S_Deviasi == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Deviasi</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Spina" value="1" @if($hidungkiri[0]->S_Spina == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Spina</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Nasofaring</td>
                        <td>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Normal" value="1" @if($hidungkiri[0]->N_Normal == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Normal</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Adenoid" value="1" @if($hidungkiri[0]->N_Adenoid == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Adenoid</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Keradangan" value="1" @if($hidungkiri[0]->N_Keradangan == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Keradangan</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-check">
                                        <input type="checkbox"
                                            class="form-check-input" id=""
                                            name="Massa" value="1" @if($hidungkiri[0]->N_Massa == '1')checked @endif>
                                        <label class="form-check-label"
                                            for="exampleCheck1">Massa</label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Lain - Lain</td>
                        <td>
                            <textarea class="form-control" name="lain-lain">{{ $hidungkiri[0]->lain_lain }}</textarea>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>
    @if(count($hidungkanan) > 0)
    <div class="col-md-12">
        <table class="table table-sm">
            <tr>
                <td>Kesimpulan</td>
                <td>{{ $hidungkanan[0]->kesimpulan }}</td>
            </tr>
        </table>
    </div>
    @endif
</div>
