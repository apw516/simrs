 <div class="container my-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Detail Resep Apotek - {{ $databpjs->response->noresep }}</h5>
                        <span class="badge bg-light text-dark">{{ $databpjs->response->nmjnsobat }}</span>
                    </div>
                    <div class="card-body">
                        <!-- HEADER DETAIL -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="130"><strong>Nama Pasien</strong></td>
                                        <td>: {{ $databpjs->response->nmpst }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. Kartu BPJS</strong></td>
                                        <td>: {{ $databpjs->response->nokartu }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tgl Pelayanan</strong></td>
                                        <td>: {{ $databpjs->response->tglpelayanan }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td width="130"><strong>No. SEP Apotek</strong></td>
                                        <td>: {{ $databpjs->response->noSepApotek }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>No. SEP Asal</strong></td>
                                        <td>: {{ $databpjs->response->noSepAsal }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- TABEL OBAT -->
                        <h6 class="fw-bold">Daftar Obat</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle text-sm">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Obat</th>
                                        <th>Tipe</th>
                                        <th>Signa</th>
                                        <th>Hari</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($databpjs->response->listobat as $index => $obat)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td><code>{{ $obat->kodeobat }}</code></td>
                                            <td>{{ $obat->namaobat }}</td>
                                            <td class="text-center">{{ $obat->tipeobat }}</td>
                                            <td class="text-center">{{ (float) $obat->signa1 }} x
                                                {{ (float) $obat->signa2 }}</td>
                                            <td class="text-center">{{ (float) $obat->hari }} Hari</td>
                                            <td class="text-center">{{ (float) $obat->jumlah }}</td>
                                            <td class="text-end">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                            {{-- <td class="text-end font-weight-bold">Rp
                                                {{ number_format($obat->jumlah * $obat->harga, 0, ',', '.') }}</td> --}}
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm batalobat"
                                                    kodeobat="{{ $obat->kodeobat }}"
                                                    noresep="{{ $databpjs->response->noresep }}"
                                                    nosepobat="{{ $databpjs->response->noSepApotek }}"
                                                    tipeobat="{{ $obat->tipeobat }}"><i
                                                        class="bi bi-recycle"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>