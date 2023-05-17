<div class="card">
    <div class="card-header bg-danger">Form Pemeriksaan THT</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
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
                                                @if (count($kanan) > 0)
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

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
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
                                                                    <input class="form-control"
                                                                        name="ltketeranganlain">
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
                                                                    <input class="form-control"
                                                                        name="mtketeranganlain">

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
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-bold">Telinga Kiri</div>
                                        <div class="card-body">
                                            <form action="" class="formtelingakiri">
                                                @if (count($kiri) > 0)
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>Liang Telinga</td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="Lapang" value="1"
                                                                                @if ($kiri['0']->LT_lapang == 1) checked @endif>
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">Lapang </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="Sempit" value="1"
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
                                                                                class="form-check-input"
                                                                                name="Serumen" value="1"
                                                                                @if ($kiri['0']->LT_Serumen == 1) checked @endif>
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">Serumen</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="Sekret" value="1"
                                                                                @if ($kiri['0']->LT_Sekret == 1) checked @endif>
                                                                            <label class="form-check-label"
                                                                                for="exampleCheck1">Sekret</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group form-check">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="Jamur" value="1"
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
                                                                <div class="gambar2">

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                @else
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
                                                                    <input class="form-control"
                                                                        name="ltketeranganlain">
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
                                                                    <input class="form-control"
                                                                        name="mtketeranganlain">

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
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @if (count($kanan) > 0)
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Kesimpulan</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <textarea class="form-control" id="kesimpulan" name="kesimpulan">{{ $kanan['0']->kesimpulan }}</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    @if (count($kanan) > 0)
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Anjuran</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <textarea class="form-control" id="anjuran" name="anjuran">{{ $kanan['0']->anjuran }}</textarea>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
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
                                            @if (count($hidungkanan) > 0)
                                            <form action="" class="formhidungkanan">
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
                                            </form>
                                            @else
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
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-bold">Hidung Kiri</div>
                                        <div class="card-body">
                                            @if (count($hidungkiri) > 0)
                                            <form action="" class="formhidungkiri">
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
                                            </form>
                                            @else
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
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    @if (count($hidungkiri) > 0)
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Kesimpulan</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="kesimpulanhidung">{{ $hidungkanan[0]->kesimpulan }}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    @else
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Kesimpulan</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea class="form-control" id="kesimpulanhidung"></textarea>
                                            </td>
                                        </tr>
                                    </table>
                                    @endif
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
                    kodekunjungan: $('#kodekunjungan').val()
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
                    kodekunjungan: $('#kodekunjungan').val()
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
        spinner = $('#loader')
        spinner.show();
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
                anjuran,
            },
            url: '<?= route('simpantht_telinga') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
        spinner = $('#loader')
        spinner.show();
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
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
