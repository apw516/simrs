<div class="row justify-content-center">
    <div class="col-sm-6">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="carinomorrujukan"
                placeholder="Cari rujukan ...." aria-label="Recipient's username"
                aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"
                    onclick="pencarianrujukan()"><i class="bi bi-search"></i>
                    Rujukan</button>
            </div>
        </div>
    </div>
</div>
<div class="hasilpencarianrujukan">
    
</div>
<table id="rujukanf1" class="table table-sm table-bordered table-hover text-md">
    <thead>
        <th>Nomor rujukan</th>
        <th>Tgl rujukan</th>
        <th>status</th>
        <th>jns pelayanan</th>
        <th>faskes perujuk</th>
        <th>diagnosa</th>
        <th>poli rujukan</th>
    </thead>
    <tbody>
        {{-- @dd($f1); --}}
        @if ($f1->metaData->code == 200)
            @foreach ($f1->response->rujukan as $p)
                <?php
                $awal = new DateTime($p->tglKunjungan);
                $akhir = new DateTime(date('Y-m-d'));
                $diff = $awal->diff($akhir);
                if ($diff->y > 0) {
                    $status = 'expired';
                } elseif ($diff->y < 1 && $diff->m < 4) {
                    $status = 'aktif';
                } else {
                    $status = 'expired';
                }
                ?>
                <tr class="pilihrujukan" ppk="{{ $p->provPerujuk->nama }}"
                    jenispelayanan="{{ $p->pelayanan->kode }}" nomorrujukan="{{ $p->noKunjungan }}"
                    tglrujukan="{{ $p->tglKunjungan }}" polirujukan="{{ $p->poliRujukan->nama }}"
                    kodepolirujukan="{{ $p->poliRujukan->kode }}" faskes="1"
                    kodefaskes="{{ $p->provPerujuk->kode }}" diagnosa="{{ $p->diagnosa->nama }}"
                    kodediagnosa="{{ $p->diagnosa->kode }}" data-dismiss="modal">
                    <td>{{ $p->noKunjungan }}</td>
                    <td>{{ $p->tglKunjungan }}</td>
                    <td>{{ $status }} </td>
                    <td>{{ $p->pelayanan->nama }}</td>
                    <td>{{ $p->provPerujuk->nama }}</td>
                    <td>{{ $p->diagnosa->nama }}</td>
                    <td>{{ $p->poliRujukan->nama }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<table id="rujukanf2" class="table table-sm table-bordered table-hover text-md">
    <thead>
        <th>Nomor rujukan</th>
        <th>Tgl rujukan</th>
        <th>Status</th>
        <th>jns pelayanan</th>
        <th>faskes perujuk</th>
        <th>diagnosa</th>
        <th>poli rujukan</th>
    </thead>
    <tbody>
        {{-- @dd($f1); --}}
        @if ($f2->metaData->code == 200)
            @foreach ($f2->response->rujukan as $p)
                <?php
                $awal = new DateTime($p->tglKunjungan);
                $akhir = new DateTime(date('Y-m-d'));
                $diff = $awal->diff($akhir);
                if ($diff->y > 0) {
                    $status = 'expired';
                } elseif ($diff->y < 1 && $diff->m < 4) {
                    $status = 'aktif';
                } else {
                    $status = 'expired';
                }
                ?>
                <tr class="pilihrujukan" ppk="{{ $p->provPerujuk->nama }}"
                    jenispelayanan="{{ $p->pelayanan->kode }}" nomorrujukan="{{ $p->noKunjungan }}"
                    tglrujukan="{{ $p->tglKunjungan }}" polirujukan="{{ $p->poliRujukan->nama }}"
                    kodepolirujukan="{{ $p->poliRujukan->kode }}" faskes="2"
                    kodefaskes="{{ $p->provPerujuk->kode }}" diagnosa="{{ $p->diagnosa->nama }}"
                    kodediagnosa="{{ $p->diagnosa->kode }}" data-dismiss="modal">
                    <td>{{ $p->noKunjungan }}</td>
                    <td>{{ $p->tglKunjungan }}</td>
                    <td>{{ $status }} </td>
                    <td>{{ $p->pelayanan->nama }}</td>
                    <td>{{ $p->provPerujuk->nama }}</td>
                    <td>{{ $p->diagnosa->nama }}</td>
                    <td>{{ $p->poliRujukan->nama }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#rujukanf1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $(function() {
        $("#rujukanf2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
</script>
