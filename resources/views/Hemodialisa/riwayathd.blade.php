<div class="card mt-2">
    <div class="card-header bg-light">Riwayat Catatan Hemodialisa</div>
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
                                            <input style="pointer-events: none;" style="pointer-events: none;"
                                                class="form-check-input" type="checkbox" value="1" id="inisiasi"
                                                name="inisiasi" @if ($item->inisiasi == 1) checked @endif>
                                            <label class="form-check-label" for="checkDefault">
                                                Inisiasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="1" id="akut"
                                                @if ($item->akut == 1) checked @endif name="akut">
                                            <label class="form-check-label" for="checkDefault">
                                                Akut
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="" id="rutin"
                                                @if ($item->rutin == 1) checked @endif name="rutin">
                                            <label class="form-check-label" for="checkDefault">
                                                Rutin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="" id="preop"
                                                @if ($item->preop == 1) checked @endif name="preop">
                                            <label class="form-check-label" for="checkDefault">
                                                Pre-OP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="" id="sled"
                                                @if ($item->sled == 1) checked @endif name="sled">
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
                                    <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                        value="1" id="dialist" name="dialist"
                                        @if ($item->dialist == 1) checked @endif>
                                    <label class="form-check-label" for="checkDefault">
                                        Bicarbonat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                        value="2" id="dialist" name="dialist"
                                        @if ($item->dialist == 2) checked @endif>
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
                                            <input readonly type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="qb" id="qb"
                                                value="{{ $item->qb }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">QD</label>
                                        <div class="input-group mb-3">
                                            <input readonly type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="qd" id="qd"
                                                value="{{ $item->qd }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">UF GOAL</label>
                                        <div class="input-group mb-3">
                                            <input readonly type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="ufgoal" name="ufgoal"
                                                value="{{ $item->ufgoal }}">
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
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="" id="NA" name="NA"
                                                @if ($item->NA == 1) checked @endif>
                                            <label class="form-check-label" for="checkDefault">
                                                Na
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="" id="UF" name="UF"
                                                @if ($item->UF == 2) checked @endif>
                                            <label class="form-check-label" for="checkDefault">
                                                UF
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="" id="bicarbonat" name="bicarbonat"
                                                @if ($item->bicarbonat == 3) checked @endif>
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
                                    <input readonly name="lamahd" id="lamahd" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->lamahd }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">jam</span>
                                    </div>
                                </div>
                                <label for="exampleInputEmail1">Dializer</label>
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                            value="1" id="dializer" name="dializer"
                                            @if ($item->dializer == 1) checked @endif>
                                        <label class="form-check-label" for="checkDefault">
                                            Baru
                                        </label>
                                    </div>
                                    <div class="form-check ml-2 mr-2">
                                        <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                            value="2" id="dializer" name="dializer"
                                            @if ($item->dializer == 2) checked @endif>
                                        <label class="form-check-label" for="checkDefault">
                                            Reuse
                                        </label>
                                    </div><br><br>
                                    <div class="input-group mb-3">
                                        <label for="exampleInputEmail1" class="mr-2 ml-2">Ke</label>
                                        <input readonly name="hd_ke" id="hd_ke" type="text"
                                            class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            value="{{ $item->hd_ke }}">
                                    </div>
                                    <label for="exampleInputEmail1">BB pre HD</label>
                                    <div class="input-group mb-3">
                                        <input readonly name="bb_pre_hd" id="bb_pre_hd" type="text"
                                            class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            value="{{ $item->bb_pre_hd }}">
                                    </div>
                                    <label for="exampleInputEmail1">BB Post HD</label>
                                    <div class="input-group mb-3">
                                        <input readonly name="bb_post_hd" id="bb_post_hd" type="text"
                                            class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            value="{{ $item->bb_post_hd }}">
                                    </div>
                                </div>
                            </td>
                            <td width="30%">
                                <label for="exampleInputEmail1">Jam mulai HD</label>
                                <div class="input-group mb-3">
                                    <input readonlyname="jam_mulai_hd" id="jam_mulai_hd" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->jam_mulai_hd }}">
                                </div>
                                <label for="exampleInputEmail1">Jam Selesai HD</label>
                                <div class="input-group mb-3">
                                    <input readonly name="jam_selesai_hd" id="jam_selesai_hd" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->jam_selesai_hd }}">
                                </div>
                                <label for="exampleInputEmail1">ke ...</label>
                                <div class="input-group mb-3">
                                    <input readonly type="text" name="ke" id="ke"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->ke }}">
                                </div>
                                <label for="exampleInputEmail1">HD ke ...</label>
                                <div class="input-group mb-3">
                                    <input readonly type="text" name="hd_ke" id="hd_ke"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->hd_ke }}">
                                </div>
                                <label for="exampleInputEmail1">Target BB kering :</label>
                                <div class="input-group mb-3">
                                    <input readonly name="target_bb_kering" id="target_bb_kering" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->target_bb_kering }}">
                                </div>
                                <label for="exampleInputEmail1">BB Observasi :</label>
                                <div class="input-group mb-3">
                                    <input readonly name="bb_observasi" id="bb_observasi" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        value="{{ $item->bb_observasi }}">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="btn-group mt-2" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalawal"
                            idheader="{{ $item->id }}" onclick="$('#idheader').val($(this).attr('idheader'));"><i
                                class="bi bi-journal-plus" style="margin-right: 8px"></i> Pre
                            HD</button>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modaltengah" idheader="{{ $item->id }}" onclick="$('#idheader').val($(this).attr('idheader'));"><i class="bi bi-journal-plus" style="margin-right: 8px"></i>
                            Intra HD</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#modalakhir"><i class="bi bi-journal-plus" style="margin-right: 8px"></i>
                            Post HD</button>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">Tindakan Keperawatan </div>
                        <div class="card-body">
                            <style>
                                .text-vertikal {
                                    writing-mode: vertical-rl;
                                    /* Membuat teks vertikal */
                                    transform: rotate(180deg);
                                    /* Memutar agar arah baca dari bawah ke atas */
                                    white-space: nowrap;
                                    /* Mencegah tulisan turun ke bawah (wrap) */
                                    text-align: center;
                                    vertical-align: middle;
                                }
                            </style>
                            <div class="v_tindakan">
                                <table class="table table-sm table-bordered" style="font-size:14px;">
                                    <thead style="text-align: center; vertical-align: middle;">
                                        <th rowspan="2" class="align-middle text-center text-vertikal">Observation
                                        </th>
                                        <th class="align-middle text-center" rowspan="2">Jam</th>
                                        <th class="align-middle text-center" rowspan="2">QB (ml/mnt)</th>
                                        <th class="align-middle text-center" rowspan="2">UF Rate (ml)</th>
                                        <th class="align-middle text-center" rowspan="2">Tek Darah (mmHg)</th>
                                        <th class="align-middle text-center" rowspan="2">Nadi (x/menit)</th>
                                        <th class="align-middle text-center" rowspan="2">Suhu(c)</th>
                                        <th class="align-middle text-center" rowspan="2">Resp (x/menit)</th>
                                        <th colspan="5">Intake (ml)</th>
                                        <th>Output (ml)</th>
                                        <th class="align-middle text-center" rowspan="2">Keterangan lain</th>
                                        <th class="align-middle text-center" rowspan="2">Pemeriksa</th>
                                        <tr>
                                            <th>NaCl 0.9%</th>
                                            <th>Dextrose 40 %</th>
                                            <th>Makanan / minuman</th>
                                            <th>Lain-lain</th>
                                            <th>UF Terapi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // 1. Filter data yang sesuai dengan idheader terlebih dahulu
                                            $filteredData = array_filter($arrayBaru, function ($val) use ($item) {
                                                return $val->idheader == $item->id;
                                            });
                                            $totalData = count($filteredData);
                                            $isFirst = true; // Penanda baris pertama
                                        @endphp
                                        @foreach ($arrayBaru as $dd)
                                            @if ($dd->idheader == $item->id)
                                                <tr>
                                                    {{-- 2. Logika Rowspan: Hanya muncul di baris pertama --}}
                                                    @if ($isFirst)
                                                        <td rowspan="{{ $totalData }}"
                                                            class="align-middle text-center">
                                                            Pre-HD
                                                        </td>
                                                        @php $isFirst = false; @endphp {{-- Set ke false agar tidak muncul di baris berikutnya --}}
                                                    @endif
                                                    <td>{{ \Carbon\Carbon::parse('2026-02-22 04:46:26')->locale('id')->translatedFormat('d F Y') }}
                                                        / {{ $dd->jam }}</td>
                                                    <td>{{ $dd->qb }}</td>
                                                    <td>{{ $dd->ufrate }}</td>
                                                    <td>{{ $dd->tekanandarah }}</td>
                                                    <td>{{ $dd->frekuensinadi }}</td>
                                                    <td>{{ $dd->suhu }}</td>
                                                    <td>{{ $dd->resep }}</td>
                                                    <td>{{ $dd->intake_nacl }}</td>
                                                    <td>{{ $dd->intake_dextrose }}</td>
                                                    <td>{{ $dd->intake_makanan_minuman }}</td>
                                                    <td>{{ $dd->intake_lainlain }}</td>
                                                    <td>{{ $dd->output }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->nama_pic }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($arrayBaru as $dd)
                                            @if ($dd->idheader == $item->id)
                                                <tr>
                                                    <td>Intra-HD</td>
                                                    <td>{{ $dd->jam }}</td>
                                                    <td>{{ $dd->qb }}</td>
                                                    <td>{{ $dd->ufrate }}</td>
                                                    <td>{{ $dd->tekanandarah }}</td>
                                                    <td>{{ $dd->frekuensinadi }}</td>
                                                    <td>{{ $dd->suhu }}</td>
                                                    <td>{{ $dd->resep }}</td>
                                                    <td>{{ $dd->intake_nacl }}</td>
                                                    <td>{{ $dd->intake_dextrose }}</td>
                                                    <td>{{ $dd->intake_makanan_minuman }}</td>
                                                    <td>{{ $dd->intake_lainlain }}</td>
                                                    <td>{{ $dd->output }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->keteranganlain }}</td>
                                                    <td>{{ $dd->nama_pic }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CATATAN PRE-HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="fromprehd">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam</label>
                        <input type="email" class="form-control" id="jam" name="jam"
                            aria-describedby="emailHelp">
                        <input hidden type="email" class="form-control" id="idheader" name="idheader"
                            aria-describedby="emailHelp" value="">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">QB ( ml / menit )</label>
                                <input type="text" class="form-control" id="qb" name="qb">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">UF Rate ( ml )</label>
                                <input type="text" class="form-control" id="ufrate" name="ufrate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tekanan Darah</label>
                                <input type="text" class="form-control" id="tekanandarah" name="tekanandarah">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Frekuensi Nadi</label>
                                <input type="text" class="form-control" id="frekuensinadi" name="frekuensinadi">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Suhu</label>
                                <input type="text" class="form-control" id="suhu" name="suhu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">resp</label>
                                <input type="text" class="form-control" id="resep" name="resep">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Intake ( ml )</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( NaCL 0.9 %
                                                    )</label>
                                                <input type="text" class="form-control" id="intake_nacl"
                                                    name="intake_nacl">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( Dextrose 40 % )
                                                </label>
                                                <input type="text" class="form-control" id="intake_dextrose"
                                                    name="intake_dextrose">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( Makanan / Minuman
                                                    )</label>
                                                <input type="text" class="form-control"
                                                    id="intake_makanan_minuman" name="intake_makanan_minuman">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( Lain - lain
                                                    )</label>
                                                <input type="text" class="form-control" id="intake_lainlain"
                                                    name="intake_lainlain">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Output ( ml )</label>
                                <input type="text" class="form-control" id="output" name="output">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Keterangan lain</label>
                                <textarea type="text" class="form-control" id="keteranganlain" name="keteranganlain"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanprehd()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modaltengah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CATATAN INTRA-HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formintrahd">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam</label>
                        <input type="email" class="form-control" id="jam" name="jam"
                            aria-describedby="emailHelp">
                        <input hidden type="email" class="form-control" id="idheader" name="idheader"
                            aria-describedby="emailHelp" value="">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">QB ( ml / menit )</label>
                                <input type="text" class="form-control" id="qb" name="qb">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">UF Rate ( ml )</label>
                                <input type="text" class="form-control" id="ufrate" name="ufrate">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tekanan Darah</label>
                                <input type="text" class="form-control" id="tekanandarah" name="tekanandarah">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Frekuensi Nadi</label>
                                <input type="text" class="form-control" id="frekuensinadi" name="frekuensinadi">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Suhu</label>
                                <input type="text" class="form-control" id="suhu" name="suhu">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputPassword1">resp</label>
                                <input type="text" class="form-control" id="resep" name="resep">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Intake ( ml )</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( NaCL 0.9 %
                                                    )</label>
                                                <input type="text" class="form-control" id="intake_nacl"
                                                    name="intake_nacl">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( Dextrose 40 % )
                                                </label>
                                                <input type="text" class="form-control" id="intake_dextrose"
                                                    name="intake_dextrose">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( Makanan / Minuman
                                                    )</label>
                                                <input type="text" class="form-control"
                                                    id="intake_makanan_minuman" name="intake_makanan_minuman">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Intake ( ml ) / ( Lain - lain
                                                    )</label>
                                                <input type="text" class="form-control" id="intake_lainlain"
                                                    name="intake_lainlain">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Output ( ml )</label>
                                <input type="text" class="form-control" id="output" name="output">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Keterangan lain</label>
                                <textarea type="text" class="form-control" id="keteranganlain" name="keteranganlain"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanintrahd()">Simpan</button>
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
<script>
    function simpanprehd() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "catatan per-HD hd akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanprehdfinal()
            }
        });
    }
    function simpanintrahd() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "catatan header intra-HD akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanintrahdFINAL()
            }
        });
    }

    function simpanprehdfinal() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.fromprehd').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                rm,
                kode_kunjungan
            },
            url: '<?= route('simpanprehd') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    $('#modalawal').modal('toggle');
                }
            }
        });
    }

    function simpanintrahdFINAL() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.fromprehd').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                rm,
                kode_kunjungan
            },
            url: '<?= route('simpanintrahd') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    $('#modalawal').modal('toggle');
                }
            }
        });
    }
</script>
