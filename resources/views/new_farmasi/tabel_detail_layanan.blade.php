<div class="card shadow-sm border-0">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-bold">
            <i class="fas fa-pills mr-2"></i> Detail Obat & Tagihan Dengan Tarif Rumah Sakit
        </h6>
        @if (isset($data) && count($data) > 0 && !empty($data[0]->NORESEP))
            <span class="badge badge-light text-dark font-weight-bold">
                No. Resep: {{ $data[0]->NORESEP }}
            </span>
        @endif
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover align-middle mb-0">
                <thead class="bg-light text-dark text-center font-weight-bold small">
                    <tr>
                        <th style="width: 40px;" rowspan="2" class="align-middle">No</th>
                        <th colspan="3" class="bg-light border-bottom-0">Data Obat SIMRS (Layanan)</th>
                        <th colspan="2" class="bg-light border-bottom-0 border-left">Data Bridging / Resep BPJS</th>
                        {{-- <th style="width: 90px;" rowspan="2" class="align-middle border-left">Status</th> --}}
                        <th style="width: 90px;" rowspan="2" class="align-middle border-left">Aksi</th>
                    </tr>
                    <tr>
                        <!-- SIMRS -->
                        <th>Nama Barang</th>
                        <th style="width: 80px;">Jumlah</th>
                        <th>Aturan Pakai</th>

                        <!-- BPJS -->
                        {{-- <th class="border-left">Nama Obat di Bpjs</th>
                        <th style="width: 90px;">Signa</th> --}}
                        {{-- <th style="width: 60px;">JHO</th> --}}
                        <th style="width: 80px;">Jml Obat</th>
                        <th>Tarif RS</th>
                    </tr>
                </thead>
                <tbody class="small">
                    @forelse($data as $index => $row)
                        <tr>
                            <td class="text-center align-middle font-weight-bold">{{ $index + 1 }}</td>

                            <!-- SIMRS Data -->
                            <td class="align-middle">
                                <strong class="text-dark">{{ $row->nama_barang ?? $row->nama_racik }}</strong>
                            </td>
                            <td class="text-center align-middle">
                                <span class="badge badge-secondary px-2 py-1">
                                    {{ $row->jumlah_layanan ?? 0 }}
                                </span>
                            </td>
                            <td class="align-middle">
                                <span class="text-muted">{{ $row->aturan_pakai ?? '-' }}</span>
                            </td>

                            <!-- BPJS Data -->
                            {{-- <td class="align-middle border-left">
                                @if (!empty($row->NMOBAT))
                                    <span class="text-primary font-weight-bold">{{ $row->NMOBAT }}</span>
                                @else
                                    <span class="text-muted italic">- (Belum Mapping) -</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @if ($row->SIGNA1OBT || $row->SIGNA2OBT)
                                    <code>{{ $row->SIGNA1OBT ?? '0' }} x {{ $row->SIGNA2OBT ?? '0' }}</code>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td> --}}
                            {{-- <td class="text-center align-middle">
                                {{ $row->JHO ?? '-' }} Hari
                            </td> --}}
                            <td class="text-center align-middle">
                                @if (!empty($row->jumlah_layanan))
                                    <span class="badge badge-info px-2 py-1">{{ $row->jumlah_layanan }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center align-middle text-bold">
                                {{ number_format($row->grantotal_layanan, 0, ',', '.') }}
                            </td>
                            <!-- Status Bridging -->
                            {{-- <td class="text-center align-middle border-left">
                                @if ($row->Bridging == '1' || strtolower($row->Bridging ?? '') == 'sudah')
                                    <span class="badge badge-success px-2 py-1" title="Sudah Bridging">
                                        <i class="fas fa-check-circle"></i> Bridging
                                    </span>
                                @elseif($row->Bridging == '0' || strtolower($row->Bridging ?? '') == 'belum')
                                    <span class="badge badge-warning px-2 py-1" title="Belum Bridging">
                                        <i class="fas fa-clock"></i> Belum
                                    </span>
                                @else
                                    <span class="badge badge-light border text-muted px-2 py-1">
                                        {{ $row->Bridging ?? '-' }}
                                    </span>
                                @endif
                            </td> --}}
                            <td class="text-center"> <button class="btn btn-danger btn-sm returobat" idlayanandetail ="{{ $row->id_layanan_detail}}"><i
                                        class="bi bi-recycle"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2 d-block text-secondary"></i>
                                Tidak ada detail item resep/layanan untuk ID Header ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">Detail Obat dan Tarif Dari Bridging BPJS</div>
    <div class="card-body">
        @if ($bridging == 1)
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
        @else
            Tidak ada data bridging ....
        @endif
    </div>
</div>
<script>
    $(".returobat").on('click', function(event) {
        idlayanandetail = $(this).attr('idlayanandetail')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data obat akan diretur ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, retur"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Pastikan data obat yang diretur sudah dipilih dengan benar",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Ya, retur data obat ...",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        returobat(idlayanandetail)
                    }
                });
            }
        });
    });
    $(".batalobat").on('click', function(event) {
        kodeobat = $(this).attr('kodeobat')
        noresep = $(this).attr('noresep')
        nosepobat = $(this).attr('nosepobat')
        tipeobat = $(this).attr('tipeobat')
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data obat akan dihapus ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Pastikan data obat yang dihapus sudah dipilih dengan benar",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus data obat ...",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        hapusobat(kodeobat, noresep, nosepobat, tipeobat)
                    }
                });
            }
        });
    });

    function hapusobat(kodeobat, noresep, nosepobat, tipeobat) {
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodeobat,
                noresep,
                nosepobat,
                tipeobat
            },
            url: '<?= route('bridginghapusobat') ?>',
            error: function(response) {
                spinner_off()
                Swal.fire({
                    icon: 'error',
                    title: 'Ups!',
                    text: response.message,
                });
            },
            success: function(response) {
                spinner_off()
                if (response.kode == '500') {
                    // Kondisi jika validasi gagal atau ada error sistem
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: response.message,
                    });
                } else {
                    $('#modaldetail').modal('hide');
                    $('.modal-backdrop').remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'OK!',
                        text: response.message,
                    });
                }
            }
        });
    }

    function returobat(idlayanandetail) {
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idlayanandetail
            },
            url: '<?= route('returobatsatuan') ?>',
            error: function(response) {
                spinner_off()
                Swal.fire({
                    icon: 'error',
                    title: 'Ups!',
                    text: response.message,
                });
            },
            success: function(response) {
                spinner_off()
                if (response.kode == '500') {
                    // Kondisi jika validasi gagal atau ada error sistem
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: response.message,
                    });
                } else {
                    $('#modaldetail').modal('hide');
                    $('.modal-backdrop').remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'OK!',
                        text: response.message,
                    });
                }
            }
        });
    }
</script>
