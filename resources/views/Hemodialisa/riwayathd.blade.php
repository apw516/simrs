<div class="card mt-2">
    <div class="card-header">Riwayat Catatan Hemodialisa</div>
    <div class="card-body">
        @foreach ($datah as $item)
            <div class="card">
                <div class="card-header bg-info">
                    Tanggal Entry : {{ $item->tgl_entry }} <br>
                    Tanggal Periksa : {{ $item->tgl_periksa }} <br>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td colspan="2">Preskripsi HD :
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="inisiasi" name="inisiasi">
                                            <label class="form-check-label" for="checkDefault">
                                                Inisiasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="akut" name="akut">
                                            <label class="form-check-label" for="checkDefault">
                                                Akut
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="rutin" name="rutin">
                                            <label class="form-check-label" for="checkDefault">
                                                Rutin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="preop" name="preop">
                                            <label class="form-check-label" for="checkDefault">
                                                Pre-OP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="sled" name="sled">
                                            <label class="form-check-label" for="checkDefault">
                                                SLED
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                Dialist : <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="dialist"
                                        name="dialist">
                                    <label class="form-check-label" for="checkDefault">
                                        Bicarbonat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="dialist"
                                        name="dialist">
                                    <label class="form-check-label" for="checkDefault">
                                        Acetat
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div class="row">
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">QB</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="qb" id="qb">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">QD</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="qd" id="qd">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">UF GOAL</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="ufgoal" name="ufgoal">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                Prog. Profiling
                            </td>
                        </tr>
                        <tr>
                            <td width="30%">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="NA" name="NA">
                                            <label class="form-check-label" for="checkDefault">
                                                Na
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="UF" name="UF">
                                            <label class="form-check-label" for="checkDefault">
                                                UF
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="bicarbonat" name="bicarbonat">
                                            <label class="form-check-label" for="checkDefault">
                                                Bicarbonat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <label for="exampleInputEmail1">Lama HD</label>
                                <div class="input-group mb-3">
                                    <input name="lamahd" id="lamahd" type="text" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">jam</span>
                                    </div>
                                </div>
                                <label for="exampleInputEmail1">Dializer</label>
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="dializer" name="dializer">
                                        <label class="form-check-label" for="checkDefault">
                                            Baru
                                        </label>
                                    </div>
                                    <div class="form-check ml-2 mr-2">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            id="dializer" name="dializer">
                                        <label class="form-check-label" for="checkDefault">
                                            Reuse
                                        </label>
                                    </div><br><br>
                                    <div class="input-group mb-3">
                                        <label for="exampleInputEmail1" class="mr-2 ml-2">Ke</label>
                                        <input name="hd_ke" id="hd_ke" type="text" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <label for="exampleInputEmail1">BB pre HD</label>
                                    <div class="input-group mb-3">
                                        <input name="bb_pre_hd" id="bb_pre_hd" type="text" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <label for="exampleInputEmail1">BB Post HD</label>
                                    <div class="input-group mb-3">
                                        <input name="bb_post_hd" id="bb_post_hd" type="text" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                </div>
                            </td>
                            <td width="30%">
                                <label for="exampleInputEmail1">Jam mulai HD</label>
                                <div class="input-group mb-3">
                                    <input name="jam_mulai_hd" id="jam_mulai_hd" type="text" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">Jam Selesai HD</label>
                                <div class="input-group mb-3">
                                    <input name="jam_selesai_hd" id="jam_selesai_hd" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">ke ...</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="ke" id="ke" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">HD ke ...</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="hd_ke" id="hd_ke" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">Target BB kering :</label>
                                <div class="input-group mb-3">
                                    <input name="target_bb_kering" id="target_bb_kering" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">BB Observasi :</label>
                                <div class="input-group mb-3">
                                    <input name="bb_observasi" id="bb_observasi" type="text" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="btn-group mt-2" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#modalawal"><i class="bi bi-journal-plus" style="margin-right: 8px"></i> Pre
                            HD</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modaltengah"><i class="bi bi-journal-plus" style="margin-right: 8px"></i>
                            Intra HD</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#modalakhir"><i class="bi bi-journal-plus" style="margin-right: 8px"></i>
                            Post HD</button>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">Tindakan Keperawatan </div>
                        <div class="card-body">
                            <div class="v_tindakan">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalawal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CATATAN PRE-HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">QB ( ml / menit )</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">UF Rate ( ml )</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tekanan Darah</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Frekuensi Nadi</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Suhu</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Resp</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">NaCL 0.9 %</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">Dextrose</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">Makanan / Minuman</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="exampleInputPassword1">Lain - lain</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltengah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CATATAN INTRA-HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalakhir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CATATAN POST-HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
