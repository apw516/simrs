<form action="" class="form_edit_header_pemeriksaan">
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal Periksa</label>
        <input type="date" class="form-control" value="{{ $data->tgl_periksa }}" name="tgl_periksa" id="tgl_periksa" aria-describedby="emailHelp">
        <input hidden type="text" class="form-control" value="{{ $data->id }}" name="idheader" id="idheader" aria-describedby="emailHelp">
    </div>
    <table class="table table-lg table-bordered">
        <tr>
            <td>Preskripsi HD</td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="inisiasi"
                                name="inisiasi" @if($data->inisiasi == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                Inisiasi
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="akut"
                                name="akut" @if($data->akut == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                Akut
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="rutin"
                                name="rutin" @if($data->rutin == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                Rutin
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="preop"
                                name="preop" @if($data->preop == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                Pre-OP
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sled"
                                name="sled" @if($data->sled == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                SLED
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="exampleInputEmail1">QB</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" name="qb"
                                id="qb" value="{{ $data->qb }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="exampleInputEmail1">QD</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" name="qd"
                                id="qd" value="{{ $data->qd }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5">
                        <label for="exampleInputEmail1">UF GOAL</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Recipient's username"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" name="ufgoal"
                                name="ufgoal" value="{{ $data->ufgoal }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">ml</span>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td rowspan="2">
                Dialist : <br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="dialist" name="dialist" @if($data->dialist == 1) checked @endif>
                    <label class="form-check-label" for="checkDefault">
                        Bicarbonat
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="2" id="dialist" name="dialist" @if($data->dialist == 2) checked @endif>
                    <label class="form-check-label" for="checkDefault">
                        Acetat
                    </label>
                </div>
            </td>
        </tr>
        <tr>
            <td width="10%">
                Prog. Profiling
            </td>
            <td>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="NA"
                                name="NA" @if($data->NA == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                Na
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="2" id="UF"
                                name="UF" @if($data->UF == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                UF
                            </label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="3" id="bicarbonat"
                                name="bicarbonat" @if($data->bicarbonat == 1) checked @endif>
                            <label class="form-check-label" for="checkDefault">
                                Bicarbonat
                            </label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-lg table-bordered">
        <tr>
            <td>
                <label for="">Heparinasi</label>
                <div class="form-group">
                    <label for="exampleInputPassword1">Dosis sirkulasi</label>
                    <input type="text" class="form-control" value="{{ $data->dosissirkulasi }}" id="dosissirkulasi" name="dosissirkulasi">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Dosis Awal</label>
                    <input type="text" class="form-control" value="{{ $data->dosisawal }}" id="dosisawal" name="dosisawal">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Dosis maintenance</label><br>
                    <label for="exampleInputEmail1">Continues</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="basic-addon2" name="continues"
                            id="continues" value="{{ $data->continues }}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">iu/jam</span>
                        </div>
                    </div>
                    <label for="exampleInputEmail1">Intermitten</label>
                    <div class="input-group mb-3">
                        <input name="intermitten" id="intermitten" type="text" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->intermitten }}">
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">iu/jam</span>
                        </div>
                    </div>
                    <label for="exampleInputEmail1">LWMH</label>
                    <div class="input-group mb-3">
                        <input type="text" name="LWMH" id="LWMH" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->LWMH }}">

                    </div>
                    <label for="exampleInputEmail1">Tanpa heparin, penyebab ...</label>
                    <div class="input-group mb-3">
                        <input name="tanpaheparin" id="tanpaheparin" type="text" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->tanpaheparin }}">

                    </div>
                    <label for="exampleInputEmail1">Program bilas NaCL 0,9 % 100 cc/jam atau 1/2 jam
                        ...</label>
                    <div class="input-group mb-3">
                        <input name="programbilas" id="programbilas" type="text" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->programbilas }}">

                    </div>
                </div>
            </td>
            <td>
                <label for="exampleInputEmail1">Lama HD</label>
                <div class="input-group mb-3">
                    <input name="lamahd" id="lamahd" type="text" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->lamahd }}">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">jam</span>
                    </div>
                </div>
                <label for="exampleInputEmail1">Dializer</label>
                <div class="input-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="dializer"
                            name="dializer" @if($data->dializer == 1) checked @endif>
                        <label class="form-check-label" for="checkDefault">
                            Baru
                        </label>
                    </div>
                    <div class="form-check ml-2 mr-2">
                        <input class="form-check-input" type="checkbox" value="2" id="dializer"
                            name="dializer" @if($data->dializer == 2) checked @endif>
                        <label class="form-check-label" for="checkDefault">
                            Reuse
                        </label>
                    </div><br><br>
                    <div class="input-group mb-3">
                        <label for="exampleInputEmail1" class="mr-2 ml-2">Ke</label>
                        <input name="hd_ke" id="hd_ke" type="text" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->hd_ke }}">
                    </div>
                    <label for="exampleInputEmail1">BB pre HD</label>
                    <div class="input-group mb-3">
                        <input name="bb_pre_hd" id="bb_pre_hd" type="text" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->bb_pre_hd }}">
                    </div>
                    <label for="exampleInputEmail1">BB Post HD</label>
                    <div class="input-group mb-3">
                        <input name="bb_post_hd" id="bb_post_hd" type="text" class="form-control"
                            placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" value="{{ $data->bb_post_hd }}">
                    </div>
                </div>
            </td>
            <td>
                <label for="exampleInputEmail1">Jam mulai HD</label>
                <div class="input-group mb-3">
                    <input name="jam_mulai_hd" id="jam_mulai_hd" type="text" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->jam_mulai_hd }}">
                </div>
                <label for="exampleInputEmail1">Jam Selesai HD</label>
                <div class="input-group mb-3">
                    <input name="jam_selesai_hd" id="jam_selesai_hd" type="text" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->jam_selesai_hd }}">
                </div>
                <label for="exampleInputEmail1">ke ...</label>
                <div class="input-group mb-3">
                    <input type="text" name="ke" id="ke" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->ke }}">
                </div>
                <label for="exampleInputEmail1">HD ke ...</label>
                <div class="input-group mb-3">
                    <input type="text" name="hd_ke" id="hd_ke" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->hd_ke }}">
                </div>
                <label for="exampleInputEmail1">Target BB kering :</label>
                <div class="input-group mb-3">
                    <input name="target_bb_kering" id="target_bb_kering" type="text" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->target_bb_kering }}">
                </div>
                <label for="exampleInputEmail1">BB Observasi :</label>
                <div class="input-group mb-3">
                    <input name="bb_observasi" id="bb_observasi" type="text" class="form-control"
                        placeholder="Recipient's username" aria-label="Recipient's username"
                        aria-describedby="basic-addon2" value="{{ $data->bb_observasi }}">
                </div>
            </td>
        </tr>
    </table>
</form>
