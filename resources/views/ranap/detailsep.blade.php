<div class="row text-xs">
    <div class="col-md-2">
        <div class="card">
            <div class="card-header">Data Pasien</div>
            <div class="card-body">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <h5 class="profile-username text-center">{{ $mt_pasien[0]->nama_px }}</h5>

                        <p class="text-dark text-center">RM : {{ $mt_pasien[0]->no_rm }}</p>
                        <p class="text-dark text-center">NO BPJS : {{ $nobpjs }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            {{-- <li class="list-group-item">
                                <b>SEP sebelumnya</b> <input type="text" class="form-control">
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li> --}}
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">Detail Sep {{ $sep }}</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-sm text-dark text-xs">
                            <tr class="bg-warning">
                                <td class="text-bold">Nomor Kartu </td>
                                <td class="text-bold">{{ $detsep->response->peserta->noKartu }}</td>
                            </tr>
                            <tr class="bg-warning">
                                <td class="text-bold">Nama Pasien</td>
                                <td class="text-bold">{{ $detsep->response->peserta->nama }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Pelayanan</td>
                                <td>{{ $detsep->response->tglSep }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Pelayanan</td>
                                <td>{{ $detsep->response->jnsPelayanan }}</td>
                            </tr>
                            <tr>
                                <td>Diagnosa</td>
                                <td>{{ $detsep->response->diagnosa }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">Riwayat Sep</div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <thead class="bg-secondary">
                        <th>Nomor Kartu</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" value="{{ $nobpjs }}" id="nokapencarian"></td>
                            <td><input type="date" class="form-control" id="tanggalawalpencarian"></td>
                            <td><input type="date" class="form-control" id="tanggalakhirpencarian"></td>
                            <td><button class="btn btn-primary text-xs" onclick="caririwayatsep()"><i class="bi bi-search ml-1 mr-1 text-lg"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="view_riwayat_sep">

                </div>
            </div>
        </div>
    </div>
</div>
