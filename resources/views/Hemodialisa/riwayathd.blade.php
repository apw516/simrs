<div class="card mt-2">
    <div class="card-header bg-light">Riwayat Catatan Hemodialisa</div>
    <div class="card-body">
        @foreach ($datah as $item)
            <div class="card">
                <div class="card-body">
                    <div class="card mt-2">
                        <div class="card-header bg-warning">Catatan Hemodialisa <br>
                            Tanggal Entry :
                            {{ \Carbon\Carbon::parse($item->tgl_entry)->locale('id')->translatedFormat('d F Y') }} <br>
                            Tanggal Periksa :
                            {{ \Carbon\Carbon::parse($item->tgl_periksa)->locale('id')->translatedFormat('d F Y') }}
                            <br>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-danger mb-2"><i class="bi bi-trash3"></i></button>
                            <button class="btn btn-warning mb-2"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-info mb-2"><i class="bi bi-printer"></i></button>

                            <table class="table">
                                <tr>
                                    <td colspan="2">Preskripsi HD :
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1"
                                                        id="inisiasi" name="inisiasi"
                                                        @if ($item->inisiasi == 1) checked @endif>
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
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="1" id="dialist" name="dialist"
                                                @if ($item->dialist == 1) checked @endif>
                                            <label class="form-check-label" for="checkDefault">
                                                Bicarbonat
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input style="pointer-events: none;" class="form-check-input"
                                                type="checkbox" value="2" id="dialist" name="dialist"
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
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">QB : {{ $item->qb }}
                                                    ml/menit</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">QD : {{ $item->qd }}
                                                    ml/menit</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">UF GOAL : {{ $item->ufgoal }} ml</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        Prog. Profiling <br>
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
                                                        type="checkbox" value="" id="bicarbonat"
                                                        name="bicarbonat"
                                                        @if ($item->bicarbonat == 3) checked @endif>
                                                    <label class="form-check-label" for="checkDefault">
                                                        Bicarbonat
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%">
                                        <label for="exampleInputEmail1">Heparinisasi</label><br>
                                        <label for="exampleInputEmail1">Dosis sirkulasi : {{ $item->dosissirkulasi }}
                                            iu</label><br>
                                        <label for="exampleInputEmail1">Dosis awal : {{ $item->dosisawal }}
                                            iu</label><br>
                                        <label for="exampleInputEmail1">dosis maintenance</label><br>
                                        <label for="exampleInputEmail1">continues : {{ $item->continues }}
                                            iu/jam</label><br>
                                        <label for="exampleInputEmail1">intermitten : {{ $item->intermitten }}
                                            iu/jam</label><br>
                                        <label for="exampleInputEmail1">LWMH : {{ $item->LWMH }} </label><br>
                                        <label for="exampleInputEmail1">Tanpa Heparin, penyebab :
                                            {{ $item->tanpaheparin }} </label><br>
                                        <label for="exampleInputEmail1">Program bilas NaCl 0.9 % 100cc/ jam/ 1/2 jam :
                                            {{ $item->programbilas }} </label><br>
                                    </td>
                                    <td>
                                        <label for="exampleInputEmail1">Lama HD : {{ $item->lamahd }} jam</label><br>
                                        <label for="exampleInputEmail1">Dializer</label>
                                        <div class="input-group mb-3">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="1" id="dializer" name="dializer"
                                                    @if ($item->dializer == 1) checked @endif>
                                                <label class="form-check-label" for="checkDefault">
                                                    Baru
                                                </label>
                                            </div>
                                            <div class="form-check ml-2 mr-2">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="2" id="dializer" name="dializer"
                                                    @if ($item->dializer == 2) checked @endif>
                                                <label class="form-check-label" for="checkDefault">
                                                    Reuse
                                                </label>
                                            </div><br><br>
                                        </div>
                                        <label for="exampleInputEmail1" class="mr-2 ml-2">Ke :
                                            {{ $item->hd_ke }} </label>
                                        <br>
                                        <label for="exampleInputEmail1">BB pre HD :
                                            {{ $item->bb_pre_hd }}</label><br>
                                        <label for="exampleInputEmail1">BB Post HD :
                                            {{ $item->bb_post_hd }}</label><br>
                                    </td>
                                    <td width="30%">
                                        <label for="exampleInputEmail1">Jam mulai HD :
                                            {{ $item->jam_mulai_hd }}</label><br>
                                        <label for="exampleInputEmail1">Jam Selesai HD :
                                            {{ $item->jam_selesai_hd }}</label><br>
                                        <label for="exampleInputEmail1">ke : {{ $item->ke }}</label><br>
                                        <label for="exampleInputEmail1">Target BB kering :
                                            {{ $item->target_bb_kering }}</label><br>
                                        <label for="exampleInputEmail1">BB Observasi :
                                            {{ $item->bb_observasi }}</label><br>
                                    </td>
                                </tr>
                            </table>
                        </div>
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
                                        <th colspan="4">Intake (ml)</th>
                                        <th>Output (ml)</th>
                                        <th class="align-middle text-center" rowspan="2">Keterangan lain</th>
                                        <th class="align-middle text-center" rowspan="2">Pemeriksa</th>
                                        <th class="align-middle text-center" rowspan="2"></th>
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
                                                    <td>{{ $dd->nama_pic }} </td>
                                                    <td>
                                                        <button class="badge btn-danger mb-2"><i
                                                                class="bi bi-trash3"></i></button>
                                                        <button class="badge btn-warning mb-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @php
                                            // 1. Filter data yang sesuai dengan idheader terlebih dahulu
                                            $filteredData = array_filter($arrayBaru2, function ($val) use ($item) {
                                                return $val->idheader == $item->id;
                                            });
                                            $totalData2 = count($filteredData);
                                            $isFirst = true; // Penanda baris pertama
                                        @endphp
                                        @foreach ($arrayBaru2 as $dd)
                                            @if ($dd->idheader == $item->id)
                                                <tr>
                                                    @if ($isFirst)
                                                        <td rowspan="{{ $totalData2 }}"
                                                            class="align-middle text-center">
                                                            Intra-HD
                                                        </td>
                                                        @php $isFirst = false; @endphp {{-- Set ke false agar tidak muncul di baris berikutnya --}}
                                                    @endif
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
                                                    <td>{{ $dd->nama_pic }}</td>
                                                    <td>
                                                        <button class="badge btn-danger mb-2"><i
                                                                class="bi bi-trash3"></i></button>
                                                        <button class="badge btn-warning mb-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @php
                                            // 1. Filter data yang sesuai dengan idheader terlebih dahulu
                                            $filteredData = array_filter($arrayBaru3, function ($val) use ($item) {
                                                return $val->idheader == $item->id;
                                            });
                                            $totalData3 = count($filteredData);
                                            $isFirst = true; // Penanda baris pertama
                                        @endphp
                                        @foreach ($arrayBaru3 as $dd)
                                            @if ($dd->idheader == $item->id)
                                                <tr>
                                                    @if ($isFirst)
                                                        <td rowspan="{{ $totalData3 }}"
                                                            class="align-middle text-center">
                                                            POST-HD
                                                        </td>
                                                        @php $isFirst = false; @endphp {{-- Set ke false agar tidak muncul di baris berikutnya --}}
                                                    @endif
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
                                                    <td>{{ $dd->nama_pic }}</td>
                                                    <td>
                                                        <button class="badge btn-danger mb-2"><i
                                                                class="bi bi-trash3"></i></button>
                                                        <button class="badge btn-warning mb-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($arrayBaru3 as $dd)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="4">Jumlah : {{ $dd->jmlhintake }}</td>
                                                <td>Jumlah : {{ $dd->jmlhuf }}</td>
                                                <td>Balance : {{ $dd->balance }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="5">Total UF : {{ $dd->totaluf }} ml</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="btn-group mt-2" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#modalawal" idheader="{{ $item->id }}"
                                    onclick="$('#idheader').val($(this).attr('idheader'));"><i
                                        class="bi bi-journal-plus" style="margin-right: 8px"></i> Pre
                                    HD</button>
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#modaltengah" idheader="{{ $item->id }}"
                                    onclick="$('#idheader2').val($(this).attr('idheader'));"><i
                                        class="bi bi-journal-plus" style="margin-right: 8px"></i>
                                    Intra HD</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#modalakhir" idheader="{{ $item->id }}"
                                    onclick="$('#idheader3').val($(this).attr('idheader'));"><i
                                        class="bi bi-journal-plus" style="margin-right: 8px"></i>
                                    Post HD</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#modalpenyulit" idheader="{{ $item->id }}"
                                    onclick="$('#idheader4').val($(this).attr('idheader'));"><i
                                        class="bi bi-journal-plus" style="margin-right: 8px"></i>
                                    Penyulit selama HD</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#modalevaluasikeperawatan" idheader="{{ $item->id }}"
                                    onclick="$('#idheader5').val($(this).attr('idheader'));"><i
                                        class="bi bi-journal-plus" style="margin-right: 8px"></i>
                                    Evaluasi Keperawatan</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                    data-target="#modalaksesvakuler" idheader="{{ $item->id }}"
                                    onclick="$('#idheader6').val($(this).attr('idheader'));"><i
                                        class="bi bi-journal-plus" style="margin-right: 8px"></i>
                                    Akses Vaskuler</button>
                            </div>
                        </div>
                        <div class="container">
                            <p>
                            <h5>Penyulit selama HD <button class="badge btn-danger mb-2"><i
                                        class="bi bi-trash3"></i></button>
                                <button class="badge btn-warning mb-2"><i class="bi bi-pencil-square"></i></button>
                            </h5> <br>
                            @foreach ($arrayBaru4 as $dd)
                                @if ($dd->idheader == $item->id)
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" style="pointer-events: none;"
                                                    class="form-check-input" type="checkbox" value="1"
                                                    id="inisiasi" name="inisiasi"
                                                    @if ($dd->masalahakses == 1) checked @endif>
                                                <label class="form-check-label" for="checkDefault">
                                                    Masalah akses
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="1" id="akut"
                                                    @if ($dd->perdarahan == 1) checked @endif name="akut">
                                                <label class="form-check-label" for="checkDefault">
                                                    Perdarahan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="rutin"
                                                    @if ($dd->fus == 1) checked @endif name="rutin">
                                                <label class="form-check-label" for="checkDefault">
                                                    First use syndrome
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="preop"
                                                    @if ($dd->sakitkepala == 1) checked @endif name="preop">
                                                <label class="form-check-label" for="checkDefault">
                                                    Sakit kepala
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->mualmuntah == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Mual dan muntah
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->kramototo == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    kram otot
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->hiperkalemia == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Hiperkalemia
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->hipotensi == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Hipotensi
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->hipertensi == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Hipertensi
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->nyeridada == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Nyeri dada
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->aritmia == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Aritmia
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->gatalgatal == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Gatal gatal
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->demam == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Demam
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-check">
                                                <input style="pointer-events: none;" class="form-check-input"
                                                    type="checkbox" value="" id="sled"
                                                    @if ($dd->menggigil == 1) checked @endif name="sled">
                                                <label class="form-check-label" for="checkDefault">
                                                    Menggigil / dingin
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    Lainnya : {{ $dd->lainnya }}
                                    </p>
                                @endif
                            @endforeach
                        </div>
                        <div class="container">
                            <p>
                            <h5>Evaluasi Keperawatan : {{ $item->evaluasi_keperawatan }} <br><button
                                    class="badge btn-danger mb-2"><i class="bi bi-trash3"></i></button>
                                <button class="badge btn-warning mb-2"><i class="bi bi-pencil-square"></i></button>
                            </h5>
                            </p>
                        </div>
                        <div class="container">
                            <p>
                            <h5>Akses Vaskuler</h5> <button class="badge btn-danger mb-2"><i
                                    class="bi bi-trash3"></i></button>
                            <button class="badge btn-warning mb-2"><i class="bi bi-pencil-square"></i></button><br>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input style="pointer-events: none;" style="pointer-events: none;"
                                            class="form-check-input" type="checkbox" value="1" id="inisiasi"
                                            name="inisiasi" @if ($item->avshunt == 1) checked @endif>
                                        <label class="form-check-label" for="checkDefault">
                                            AV Shunt
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                            value="1" id="akut"
                                            @if ($item->avfemoral == 1) checked @endif name="akut">
                                        <label class="form-check-label" for="checkDefault">
                                            AV Femoral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                            value="" id="rutin"
                                            @if ($item->cateterdoublelumensubclavia == 1) checked @endif name="rutin">
                                        <label class="form-check-label" for="checkDefault">
                                            Cateter double lumen subclavia
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                            value="" id="preop"
                                            @if ($item->cataterdoublelumenjugularis == 1) checked @endif name="preop">
                                        <label class="form-check-label" for="checkDefault">
                                            Cateter double lumen jugularis
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-check">
                                        <input style="pointer-events: none;" class="form-check-input" type="checkbox"
                                            value="" id="sled"
                                            @if ($item->cateterdoublelumenfemoralis == 1) checked @endif name="sled">
                                        <label class="form-check-label" for="checkDefault">
                                            Cateter double lumen femoralis
                                        </label>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                    <h5>Akses Vaskuler Oleh  : {{  $item->akses_vaskuler_oleh    }}</h5>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p>
                                    <h5 class="text-center">
                                        diperiksa :
                                        {{ \Carbon\Carbon::parse($item->tgl_periksa)->locale('id')->translatedFormat('d F Y') }}
                                        <br>Nama dan tanda tangan perawat yang bertugas :
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        {{ strtoupper($item->akses_vaskuler_oleh )}}
                                    </h5>
                                    </p>
                                </div>
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
                                <label for="exampleInputPassword1">Output UF TERAPI( ml )</label>
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
                        <input hidden type="email" class="form-control" id="idheader2" name="idheader2"
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
                                <label for="exampleInputPassword1">Output UF TERAPI ( ml )</label>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CATATAN POST-HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formposthd">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jam</label>
                        <input type="email" class="form-control" id="jam" name="jam"
                            aria-describedby="emailHelp">
                        <input hidden type="email" class="form-control" id="idheader3" name="idheader3"
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
                                <label for="exampleInputPassword1">Output UF TERAPI ( ml )</label>
                                <input type="text" class="form-control" id="output" name="output">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Keterangan lain</label>
                                <textarea type="text" class="form-control" id="keteranganlain" name="keteranganlain"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">jumlah intake </label>
                                <input type="text" class="form-control" id="jmlhintake" name="jmlhintake">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">jumlah UF </label>
                                <input type="text" class="form-control" id="jmlhuf" name="jmlhuf">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Balance </label>
                                <input type="text" class="form-control" id="balance" name="balance">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Total UF </label>
                                <input type="text" class="form-control" id="totaluf" name="totaluf">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanposthd()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpenyulit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penyulit selama HD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formpenyulit">
                    <input hidden type="email" class="form-control" id="idheader4" name="idheader4"
                        aria-describedby="emailHelp" value="">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="masalahakses"
                                    name="masalahakses">
                                <label class="form-check-label" for="checkDefault">
                                    Masalah akses
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="perdarahan"
                                    name="perdarahan">
                                <label class="form-check-label" for="checkDefault">
                                    Perdarahan
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="fus"
                                    name="fus">
                                <label class="form-check-label" for="checkDefault">
                                    First use syndrome
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="sakitkepala"
                                    name="sakitkepala">
                                <label class="form-check-label" for="checkDefault">
                                    Sakit kepala
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="mualmuntah"
                                    name="mualmuntah">
                                <label class="form-check-label" for="checkDefault">
                                    Mual dan muntah
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="kramototo"
                                    name="kramototo">
                                <label class="form-check-label" for="checkDefault">
                                    kram otot
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="hiperkalemia"
                                    name="hiperkalemia">
                                <label class="form-check-label" for="checkDefault">
                                    Hiperkalemia
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="hipotensi"
                                    name="hipotensi">
                                <label class="form-check-label" for="checkDefault">
                                    Hipotensi
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="hipertensi"
                                    name="hipertensi">
                                <label class="form-check-label" for="checkDefault">
                                    Hipertensi
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="nyeridada"
                                    name="nyeridada">
                                <label class="form-check-label" for="checkDefault">
                                    Nyeri dada
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="aritmia"
                                    name="aritmia">
                                <label class="form-check-label" for="checkDefault">
                                    Aritmia
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="gatalgatal"
                                    name="gatalgatal">
                                <label class="form-check-label" for="checkDefault">
                                    Gatal gatal
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="demam"
                                    name="demam">
                                <label class="form-check-label" for="checkDefault">
                                    Demam
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="menggigil"
                                    name="menggigil">
                                <label class="form-check-label" for="checkDefault">
                                    Menggigil / dingin
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Lainnya</label>
                        <input type="email" class="form-control" id="lainnya" name="lainnya"
                            aria-describedby="emailHelp">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanpenyulithd()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalevaluasikeperawatan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Evaluasi Keperawatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formevaluasi">
                    <input hidden type="email" class="form-control" id="idheader5" name="idheader5"
                        aria-describedby="emailHelp" value="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Catatan</label>
                        <textarea type="email" class="form-control" id="evaluasi_keperawatan" name="evaluasi_keperawatan"
                            aria-describedby="emailHelp"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanevaluasi()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalaksesvakuler" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Akses Vaskuler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formaksesvaskular">
                    <input hidden type="email" class="form-control" id="idheader6" name="idheader6"
                        aria-describedby="emailHelp" value="">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="avshunt"
                                    name="avshunt">
                                <label class="form-check-label" for="checkDefault">
                                    AV Shunt
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="1" id="avfemoral" name="avfemoral">
                                <label class="form-check-label" for="checkDefault">
                                    AV Femoral
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="1" id="cateterdoublelumensubclavia" name="cateterdoublelumensubclavia">
                                <label class="form-check-label" for="checkDefault">
                                    Cateter double lumen subclavia
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="1" id="cataterdoublelumenjugularis" name="cataterdoublelumenjugularis">
                                <label class="form-check-label" for="checkDefault">
                                    Cateter double lumen jugularis
                                </label>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"
                                    value="1" id="cateterdoublelumenfemoralis" name="cateterdoublelumenfemoralis">
                                <label class="form-check-label" for="checkDefault">
                                    Cateter double lumen femoralis
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanakses()">Simpan</button>
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
            text: "catatan intra-HD akan disimpan !",
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
    function simpanakses() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "catatan akses vaskuler akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanaksesfinal()
            }
        });
    }

    function simpanevaluasi() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Hasil evaluasi keperawatan akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanevaluasifinal()
            }
        });
    }

    function simpanposthd() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "catatan Post-HD akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanposthdfinal()
            }
        });
    }

    function simpanpenyulithd() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "catatan Penyulit HD akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanpenyulitfinal()
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
                    formcatatanhemodialisis()
                }
            }
        });
    }

    function simpanintrahdFINAL() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.formintrahd').serializeArray();
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
                    $('#modaltengah').modal('toggle');
                    formcatatanhemodialisis()
                }
            }
        });
    }

    function simpanposthdfinal() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.formposthd').serializeArray();
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
            url: '<?= route('simpanposthd') ?>',
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
                    $('#modalakhir').modal('toggle');
                    formcatatanhemodialisis()
                }
            }
        });
    }

    function simpanpenyulitfinal() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.formpenyulit').serializeArray();
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
            url: '<?= route('simpanpenyulithd') ?>',
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
                    $('#modalpenyulit').modal('toggle');
                    formcatatanhemodialisis()
                }
            }
        });
    }

    function simpanevaluasifinal() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.formevaluasi').serializeArray();
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
            url: '<?= route('simpanevaluasi') ?>',
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
                    $('#modalevaluasikeperawatan').modal('toggle');
                    formcatatanhemodialisis()
                }
            }
        });
    }
    function simpanaksesfinal() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.formaksesvaskular').serializeArray();
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
            url: '<?= route('simpanaksesvaskularfinal') ?>',
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
                    $('#modalaksesvakuler').modal('toggle');
                    formcatatanhemodialisis()
                }
            }
        });
    }
</script>
