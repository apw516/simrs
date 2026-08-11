<!-- 1. DETAIL PASIEN (COMPONENTS SEBELUMNYA) -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3"
        style="cursor: pointer;" data-toggle="collapse" data-target="#patientDetailBody" aria-expanded="true"
        aria-controls="patientDetailBody">

        <div class="d-flex align-items-center">
            <i class="fas fa-chevron-down toggle-icon transition-icon mr-2"></i>
            <span class="font-weight-bold"><i class="fas fa-id-card mr-2"></i>Detail Pasien</span>
        </div>
        <span class="badge badge-light text-primary" style="font-size: 0.9rem;">No. RM:
            {{ $data_kunjungan[0]->no_rm ?? '' }}</span>
    </div>
    <div id="patientDetailBody" class="collapse">
        <div class="card-body p-4">
            <div class="row">
                <!-- Kolom Kiri: Informasi Pribadi -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">
                        <i class="fas fa-user mr-2"></i>Data Pribadi
                    </h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 40%;">Nama Lengkap</td>
                                <td class="font-weight-bold">: {{ $mt_pasien[0]->nama_px ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">NIK</td>
                                <td>: {{ $mt_pasien[0]->nik_bpjs ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">TTL / Usia</td>
                                <td>: {{ $mt_pasien[0]->tempat_lahir ?? '-' }}, {{ $mt_pasien[0]->tgl_lahir ?? '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">Jenis Kelamin</td>
                                <td>:
                                    @if (isset($mt_pasien[0]->jenis_kelamin) && strtoupper($mt_pasien[0]->jenis_kelamin) == 'P')
                                        Perempuan
                                    @elseif(isset($mt_pasien[0]->jenis_kelamin) && strtoupper($mt_pasien[0]->jenis_kelamin) == 'L')
                                        Laki - Laki
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Kolom Kanan: Kontak & Asuransi -->
                <div class="col-md-6">
                    <h6 class="text-uppercase text-muted font-weight-bold mb-3">
                        <i class="fas fa-phone-alt mr-2"></i>Kontak & Penjamin
                    </h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tbody>
                            <tr>
                                <td class="text-muted" style="width: 40%;">No. Telepon</td>
                                <td>: {{ $mt_pasien[0]->no_tlp ?? '-' }} / {{ $mt_pasien[0]->no_hp ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Alamat</td>
                                <td>: {{ $mt_pasien[0]->alamatpx ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Penjamin / BPJS</td>
                                <td>: <span
                                        class="badge badge-success">{{ $data_kunjungan[0]->nama_penjamin ?? '-' }}</span><br>&nbsp;
                                    {{ $mt_pasien[0]->no_Bpjs ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. FORM INPUT OBAT (KOMPONEN BARU) -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h6 class="font-weight-bold text-primary m-0">
            <i class="fas fa-pills mr-2"></i>Input Resep / Obat Pasien
        </h6>
    </div>
    <div class="card-body p-4">
        <form action="" method="POST" id="formInputObat" class="formInputObat">
            <!-- Hidden Input untuk menangkap No RM / Kunjungan -->
            <input type="hidden" name="no_rm" value="{{ $data_kunjungan[0]->no_rm ?? '' }}">
            <input type="hidden" id="kode_kunjungan" name="kode_kunjungan"
                value="{{ $data_kunjungan[0]->kode_kunjungan ?? '' }}">
            <input type="hidden" name="kode_penjamin" value="{{ $data_kunjungan[0]->kode_penjamin ?? '' }}">
            <div class="row">
                <!-- Select Nama Obat -->
                <div class="col-md-3 mb-3">
                    <label class="font-weight-bold small text-muted">Penjamin</label>
                    <input readonly type="text" name="nama_penjamin" class="form-control" placeholder="0"
                        min="1" value="{{ $data_kunjungan[0]->nama_penjamin }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">NO SEP KUNJUNGAN</label>
                    <input readonly type="text" name="no_sep" class="form-control" placeholder="0" min="1"
                        value="{{ $data_kunjungan[0]->no_sep }}">
                </div>
                <!-- Jumlah / Qty -->
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Tanggal Resep</label>
                    <input type="date" name="tgl_resep" class="form-control" placeholder="0" min="1"
                        value="{{ request('tgl_awal', date('Y-m-d')) }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Tanggal Pelayanan Resep</label>
                    <input type="date" name="tgl_pel_resep" class="form-control" placeholder="0" min="1"
                        value="{{ request('tgl_awal', date('Y-m-d')) }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Dokter</label>
                    <input readonly type="text" name="nama_dokter" class="form-control" placeholder="0"
                        min="1" value="{{ $dokter[0]->nama_paramedis }}">
                    <input hidden type="text" name="kode_paramedis" class="form-control" placeholder="0"
                        min="1" value="{{ $dokter[0]->kode_dokter_jkn }}">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Iterasi</label>
                    <select class="form-control" id="iterasi" name="iterasi">
                        <option value="0">NON - ITERASI</option>
                        <option value="1">ITERASI 1 X</option>
                        <option value="2">ITERASI 2 X</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Jenis Obat</label>
                    <select class="form-control" id="jenisobat" name="jenisobat">
                        <option value="0">Obat Reguler</option>
                        <option value="1">Obat PRB</option>
                        <option value="2">Obat Kronis</option>
                        <option value="3">Obat Kemo</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-success btn-block font-weight-bold" data-toggle="modal"
                        data-target="#modalpilihobat">
                        <i class="fas fa-plus mr-1"></i> Pilih Obat
                    </button>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-success btn-block font-weight-bold ambilobatracik2"
                        data-toggle="modal" data-target="#modalobatracikan">
                        <i class="fas fa-plus mr-1"></i> Pilih Obat Racik
                    </button>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-warning btn-block font-weight-bold" data-toggle="modal"
                        data-target="#modalbuatobatracik">
                        <i class="fas fa-plus mr-1"></i> Buat Obat Racik
                    </button>
                </div>
                <div class="col-md-6">
                    <div class="card card-outline card-primary shadow-sm border-0">
                        <div class="card-header bg-warning py-2 px-3">
                            <h6 class="card-title mb-0 fw-bold fs-7 text-dark">
                                <i class="bi bi-receipt me-1"></i> Data Obat yang diorder
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-hover align-middle mb-0"
                                    style="font-size: 12px;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-center" style="width: 35px;">#</th>
                                            {{-- <th>Kode Order</th> --}}
                                            <th>Nama Layanan/Barang</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Aturan Pakai</th>
                                            <th class="text-end">Keterangan</th>
                                            <th class="text-end">Antrian</th>
                                            <th class="text-center" style="width: 70px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($data_order as $index => $item)
                                            <tr>
                                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                                {{-- <td>{{ $item->kode_order ?? ($item->no_order ?? '-') }}</td> --}}
                                                <td>
                                                    <span
                                                        class="text-bold text-dark">{{ $item->kode_barang ?? ($item->nama_barang ?? '-') }}</span>
                                                </td>
                                                <td class="text-center fw-bold">
                                                    {{ $item->jumlah_layanan ?? ($item->qty ?? 1) }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $item->aturan_pakai }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $item->keterangan_header }}
                                                </td>
                                                <td class="text-end">
                                                    {{ $item->jenis_antrian }}
                                                </td>
                                                {{-- <td class="text-end fw-bold">
                                                Rp
                                                {{ number_format(($item->tarif ?? ($item->harga ?? 0)) * ($item->jumlah ?? ($item->qty ?? 1)), 0, ',', '.') }}
                                            </td> --}}
                                                <td class="text-center">
                                                    @if (($item->status_order ?? 0) == 2)
                                                        <span class="badge bg-success"
                                                            style="font-size: 10px;">tracer</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark"
                                                            style="font-size: 10px;">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-3">
                                                    <i class="bi bi-inbox d-block fs-5 mb-1"></i>
                                                    Belum ada data order untuk kunjungan ini.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Tambah ke Daftar -->
    </div>
    </form>
    <hr class="my-4">
    <h6 class="text-uppercase text-muted font-weight-bold mb-3 style-sm">
        <i class="fas fa-list-ol mr-2"></i>Daftar Obat Terpilih
    </h6>
    <div class="table-responsive">
        <form action="" method="POST" class="arrayobat">
            <table class="table table-bordered table-striped table-hover align-middle">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 40px;" class="text-center">No</th>
                        <th style="min-width: 90px;">Nama Obat</th>
                        <th style="width: 180px;">Stok</th>
                        <th style="width: 180px;">Jenis Resep</th>
                        <th hidden style="width: 180px;">Jenis Obat</th>
                        <th hidden style="width: 90px;">Iterasi</th>
                        <th hidden style="width: 80px;">Jlh Iter</th>
                        <th style="width: 190px;">Jlh Obat</th>
                        <th hidden style="width: 100px;">Dosis Minum</th>
                        <th style="width: 120px;">Signa 1</th>
                        <th style="width: 80px;"></th>
                        <th style="width: 140px;">Signa 2</th>
                        <th style="min-width: 120px;">Catatan</th>
                        <th style="width: 60px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="wrapper-obat-terpilih">
                    <!-- Row Default Saat Kosong -->
                    <tr id="empty-row" class="empty-row">
                        <td colspan="12" class="text-center text-muted font-italic py-3">
                            Belum ada obat yang dipilih. Klik tombol "Pilih" pada tabel obat.
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Tombol Submit -->
    <div class="d-flex justify-content-end mt-3 mb-4">
        <button type="button" id="btn-submit-obat" class="btn btn-primary px-4 font-weight-bold"
            onclick="simpanresep()">
            <i class="fas fa-save mr-2"></i>Simpan Resep
        </button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalbuatobatracik" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Komponen Obat Racik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">Header Racikan</div>
                    <div class="card-body">
                        <form action="" class="form_header_racikan">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama
                                            Racikan</label>
                                        <input type="text" class="form-control" id="namaracikan"
                                            name="namaracikan" placeholder="Ketik nama racikan ...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Tipe
                                            Racikan</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tiperacikan"
                                                id="tiperacikan" value="1" checked>
                                            <label class="form-check-label" for="radioDefault1">
                                                Non - Powder
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="tiperacikan"
                                                id="tiperacikan2" value="2">
                                            <label class="form-check-label" for="radioDefault2">
                                                Powder
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleFormControlInput1" class="form-label">Pilih sediaan</label>
                                    <select class="form-select" aria-label="Default select example" name="sediaan"
                                        id="sediaan">
                                        <option value="0">Silahkan Pilih Sediaan</option>
                                        <option value="1">Kapsul</option>
                                        <option value="2">Kertas Perkamen</option>
                                        <option value="3">Pot Salep</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">QTY
                                            Racikan</label>
                                        <input type="text" class="form-control" id="qtyracikan" name="qtyracikan"
                                            placeholder="Ketik qty racikan ..." value="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Signa 1</label>
                                        <input type="text" class="form-control" id="signa1racikan"
                                            name="signa1racikan" placeholder="masukan signa 1 ...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Signa 2</label>
                                        <input type="text" class="form-control" id="signa2racikan"
                                            name="signa2racikan" placeholder="masukan signa 2 ...">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Catatan</label>
                                        <textarea type="text" class="form-control" id="aturanpakai" name="aturanpakai"
                                            placeholder="masukan aturan pakai ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Silahkan Pilih Komponen</div>
                    <div class="card-body">
                        <div class="input-group mb-1">
                            <input type="text" class="form-control" placeholder="Masukan nama obat ..."
                                aria-label="Recipient’s username" aria-describedby="basic-addon2"
                                id="input_pencarian_nama_komponen">
                            <span class="btn btn-success input-group-text" id="tombol_cari_komponen"><i
                                    class="bi bi-search"></i> Cari
                                Obat</span>
                        </div>
                        <table id="tabel_barang2" class="table table-bordered table-hover mt-1"
                            style="font-size:12px">
                            <thead>
                                <tr>
                                    <th>Tgl Stok</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Stok tersisa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <form action="" class="form_komponen">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama
                                            Barang</label>
                                        <input readonly type="text" class="form-control" id="komponen_namabarang"
                                            name="komponen_namabarang" placeholder="nama barang ...">
                                        <input hidden readonly type="text" class="form-control"
                                            id="komponen_kodebarang" name="komponen_kodebarang"
                                            placeholder="kode barang ...">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                                        <input readonly type="text" class="form-control"
                                            id="komponen_satuanbarang" name="komponen_satuanbarang"
                                            placeholder="satuan barang ...">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Stok</label>
                                        <input readonly type="text" class="form-control" id="komponen_stokbarang"
                                            name="komponen_stokbarang" placeholder="stok barang ...">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Dosis</label>
                                        <input value="0" type="text" class="form-control"
                                            id="komponen_dosis" name="komponen_dosis" placeholder="dosis awal ...">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Dosis
                                            Racik</label>
                                        <input value="0" type="text" class="form-control"
                                            name="komponen_dosisracik" id="komponen_dosisracik"
                                            placeholder="nama barang ...">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success tombolproses" id="tombolproses"
                                        style="margin-top:32px" onclick="prosesracikan()"><i
                                            class="bi bi-bullseye"></i> Proses</button>
                                </div>
                            </div>
                        </form>
                        <div class="container">
                            <div class="card-header bg-warning">List Komponen obat yang sudah dipilih</div>
                            <div class="card-body">
                                <form action="" class="formdatakomponen">
                                    <div class="v_list_komponen" id="v_list_komponen"></div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success" onclick="simpanobatracikan()"><i
                                        class="bi bi-floppy"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpilihobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card card-outline card-primary shadow-sm border-0">
                    <div class="card-header bg-warning py-2 px-3">
                        <h6 class="card-title mb-0 fw-bold fs-7 text-dark">
                            <i class="bi bi-receipt me-1"></i> Data Obat yang diorder
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped table-hover align-middle mb-0"
                                style="font-size: 12px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center" style="width: 35px;">#</th>
                                        {{-- <th>Kode Order</th> --}}
                                        <th>Nama Layanan/Barang</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Aturan Pakai</th>
                                        <th class="text-end">Keterangan</th>
                                        <th class="text-end">Antrian</th>
                                        <th class="text-center" style="width: 70px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_order as $index => $item)
                                        <tr>
                                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                            {{-- <td>{{ $item->kode_order ?? ($item->no_order ?? '-') }}</td> --}}
                                            <td>
                                                <span
                                                    class="text-bold text-dark">{{ $item->kode_barang ?? ($item->nama_barang ?? '-') }}</span>
                                            </td>
                                            <td class="text-center fw-bold">
                                                {{ $item->jumlah_layanan ?? ($item->qty ?? 1) }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item->aturan_pakai }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item->keterangan_header }}
                                            </td>
                                            <td class="text-end">
                                                {{ $item->jenis_antrian }}
                                            </td>
                                            {{-- <td class="text-end fw-bold">
                                                Rp
                                                {{ number_format(($item->tarif ?? ($item->harga ?? 0)) * ($item->jumlah ?? ($item->qty ?? 1)), 0, ',', '.') }}
                                            </td> --}}
                                            <td class="text-center">
                                                @if (($item->status_order ?? 0) == 2)
                                                    <span class="badge bg-success"
                                                        style="font-size: 10px;">tracer</span>
                                                @else
                                                    <span class="badge bg-warning text-dark"
                                                        style="font-size: 10px;">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-3">
                                                <i class="bi bi-inbox d-block fs-5 mb-1"></i>
                                                Belum ada data order untuk kunjungan ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table-stok-obat"
                        class="table table-striped table-hover table-bordered align-middle w-100">
                        <thead class="table-dark text-center">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Barang</th>
                                <th>Nama Generik</th>
                                <th>Stok</th>
                                <th>Kronis</th>
                                <th>Prb</th>
                                <th>Kemo</th>
                                <th style="width: 80px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stokBarang as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <span class="fw-bold d-block">{{ $item->nama_barang }}</span>
                                        <small class="text-muted">{{ $item->kode_barang }}</small>
                                    </td>
                                    <td>{{ $item->nama_generik ?? '-' }}</td>
                                    <td class="text-end fw-bold text-success">
                                        {{ number_format($item->stok_saat_ini, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $item->kronis }}</td>
                                    <td>{{ $item->prb }}</td>
                                    <td>{{ $item->kemo }}</td>
                                    <td class="text-center">
                                        {{-- <button type="button" class="btn btn-sm btn-primary btn-pilih-obat"
                                            data-kode="{{ $item->kode_barang }}"
                                            data-nama="{{ $item->nama_barang }}"
                                            data-stok="{{ $item->stok_saat_ini }}">
                                            <i class="bi bi-plus-lg"></i> Pilih
                                        </button> --}}
                                        <button type="button" class="btn btn-sm btn-primary btn-pilih-obat"
                                            data-kode="{{ $item->kode_barang }}"
                                            data-nama="{{ $item->nama_barang }}"
                                            data-stok="{{ $item->stok_saat_ini }}" data-kronis="{{ $item->kronis }}"
                                            data-prb="{{ $item->prb }}" data-kemo="{{ $item->kemo }}">
                                            <i class="bi bi-plus-lg"></i> Pilih
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <em>Tidak ada data stok barang yang ditemukan.</em>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalobatracikan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Obat Racik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_t_racikan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Stylings & Helper Rotasi Collapse Icon -->
<style>
    .transition-icon {
        transition: transform 0.3s ease;
    }

    [aria-expanded="false"] .toggle-icon {
        transform: rotate(-90deg);
    }

    .transition-icon {
        transition: transform 0.3s ease;
    }

    /* Memutar panah ke kanan saat collapse tertutup */
    [aria-expanded="false"] .toggle-icon {
        transform: rotate(-90deg);
    }
</style>
<script>
    var table2 = $('#tabel_barang2').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        pageLength: 4, // Menampilkan 4 data per halaman
        lengthMenu: [4, 6, 8], // Opsi jumlah data yang
        ajax: {
            url: "{{ route('ambildatastokdepo') }}",
            type: 'GET',
            // --- TAMBAHKAN BAGIAN INI ---
            data: function(d) {
                d.keyword = $('#input_pencarian_nama_komponen')
                    .val(); // Ambil nilai dari input form
                // d.kode_unit = $('#input_kode_unit').val(); // Contoh jika ada parameter lain
            }
            // -----------------------------
        },
        deferLoading: 0, // Menginstruksikan DataTables bahwa data di server belum dimuat
        language: {
            processing: '<div class="loading-container">' +
                '<img src="{{ asset('public/img/fb.gif') }}" width="80">' +
                '<p>Sedang mengambil data...</p>' +
                '</div>'
        },
        columns: [{
                data: 'tgl_stok',
                name: 'tgl_stok'
            },
            {
                data: 'nama_barang',
                name: 'nama_barang'
            },
            {
                data: 'satuan',
                name: 'satuan'
            },
            {
                data: 'stok_current',
                name: 'stok_current'
            },
            {
                data: null, // Kolom ini tidak terikat data langsung
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    // row adalah objek data untuk baris tersebut
                    return '<button class="btn btn-success btn-sm pilihkomponen" ' +
                        'data-kode_barang="' + row.kode_barang + '" ' +
                        'data-nama_barang="' + row.nama_barang + '" ' +
                        'data-stok_barang="' + row.stok_current + '" ' +
                        'data-satuan_barang="' + row.satuan + '" ' +
                        // Tambahkan atribut lain yang dibutuhkan di sini
                        '><i class="bi bi-layer-backward"></i></button>';
                }
            }
        ]
    });
    $('body').off('click', '.pilihkomponen').on('click', '.pilihkomponen', function(event) {
        event.preventDefault();
        var kode_barang = $(this).data('kode_barang');
        var nama_barang = $(this).data('nama_barang');
        var stok_barang = $(this).data('stok_barang');
        var satuan_barang = $(this).data('satuan_barang');
        $('#komponen_namabarang').val(nama_barang)
        $('#komponen_kodebarang').val(kode_barang)
        $('#komponen_satuanbarang').val(satuan_barang)
        $('#komponen_stokbarang').val(stok_barang)
        $('#komponen_dosis').val(0)
        $('#komponen_dosisracik').val(0)
        komponen_dosis
        komponen_dosisracik
        Swal.fire({
            title: nama_barang + " Berhasil dipilih",
            icon: "success",
            timer: 1500,
            showConfirmButton: false
        });
        $('#tombolproses').focus();
    });
    $(document).ready(function() {
        // 1. Inisialisasi DataTables
        var tableObat = $('#table-stok-komponen-obat').DataTable({
            "pageLength": 5,
            "language": {
                "search": "Cari Obat:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Obat tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ obat",
                "infoEmpty": "Tidak ada data",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "›",
                    "previous": "‹"
                }
            }
        });
        var tableObat = $('#table-stok-obat').DataTable({
            "pageLength": 10,
            "language": {
                "search": "Cari Obat:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Obat tidak ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ obat",
                "infoEmpty": "Tidak ada data",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "›",
                    "previous": "‹"
                }
            }
        });
        $('#table-stok-obat').on('click', '.btn-pilih-obat', function() {
            var kodeBarang = $(this).data('kode');
            var namaBarang = $(this).data('nama');
            var maxStok = parseInt($(this).data('stok')) || 999;

            // Ambil data status kronis, prb, kemo (bisa berupa boolean, 1/0, atau string '1'/'true')
            var isKronis = $(this).data('kronis') == 1 || $(this).data('kronis') == 'True' || $(this)
                .data('kronis') == 'Ya';
            var isPrb = $(this).data('prb') == 1 || $(this).data('prb') == 'True' || $(this).data(
                'prb') == 'Ya';
            var isKemo = $(this).data('kemo') == 1 || $(this).data('kemo') == 'True' || $(this).data(
                'kemo') == 'Ya';
            // Logika menentukan default jenis_obat (Prioritas jika ada multiple 'True')
            var defaultJenis = 'Reguler';
            if (isKronis) {
                defaultJenis = 'Kronis';
            } else if (isPrb) {
                defaultJenis = 'PRB';
            } else if (isKemo) {
                defaultJenis = 'Kemoterapi';
            }

            // Cek apakah obat sudah ada di dalam tabel terpilih
            var existingRow = $('#row-obat-' + kodeBarang);

            if (existingRow.length > 0) {
                // Jika obat sudah ada, tambahkan nilai 'jumlahobat' (+1)
                var inputQty = existingRow.find('.input-jumlah-obat');
                var currentQty = parseInt(inputQty.val()) || 0;

                if (currentQty < maxStok) {
                    inputQty.val(currentQty + 1);
                } else {
                    alert('Jumlah melebihi stok yang tersedia (' + maxStok + ')');
                }
            } else {
                // Hapus pesan "Belum ada obat" (empty-row)
                $('#empty-row').hide();

                // Hitung nomor urut baris
                var noUrut = $('#wrapper-obat-terpilih tr').not('#empty-row').length + 1;

                // Generate HTML Baris Baru dengan opsi terpilih (selected) secara dinamis
                var htmlRow = `
        <tr id="row-obat-${kodeBarang}">
            <td class="text-center nomor-urut">${noUrut}</td>
            <td>
                <span class="font-weight-bold d-block">${namaBarang}</span>
                <small class="text-muted">${kodeBarang}</small>
                <input type="hidden" name="kode_barang" value="${kodeBarang}">
            </td>
            <td>
                <input readonly type="number" name="stok" class="form-control form-control-sm text-center" value="${maxStok}" min="0">
            </td>
            <td>
                <select readonly name="jenis_resep" class="form-control form-control-sm">
                    <option value="NonRacikan">(Non-Racik)</option>
                    <option value="Racikan">Racikan</option>
                </select>
            </td>
            <td hidden>
                <select name="jenis_obat" class="form-control form-control-sm">
                    <option value="Reguler" ${defaultJenis === 'Reguler' ? 'selected' : ''}>Reguler</option>
                    <option value="Kronis" ${defaultJenis === 'Kronis' ? 'selected' : ''}>Kronis</option>
                    <option value="PRB" ${defaultJenis === 'PRB' ? 'selected' : ''}>PRB</option>
                    <option value="Kemoterapi" ${defaultJenis === 'Kemoterapi' ? 'selected' : ''}>Kemoterapi</option>
                </select>
            </td>
            <td hidden>
                <select name="iterasi" class="form-control form-control-sm text-center">
                    <option value="0">Tidak</option>
                    <option value="1">Ya</option>
                </select>
            </td>
            <td hidden>
                <input type="number" name="jlh_iterasi" class="form-control form-control-sm text-center" value="0" min="0">
            </td>
            <td>
                <div class="row">
                    <div class="col-md-6"><input hidden type="number" name="jumlahhari" class="form-control form-control-sm text-center" value="1" min="1" required></div>
                    <div class="col-md-12"><input type="number" name="qtyobat" class="form-control form-control-sm text-center" value="1" min="1" required></div>
                </div>
            </td>
            <td hidden>
                <input hidden type="number" name="jumlahobat" class="form-control form-control-sm text-center input-jumlah-obat" value="1" min="1" max="${maxStok}" required>
            </td>
            <td>
                <input type="number" name="signa1" class="form-control form-control-sm text-center" value="3" min="1" required>
            </td>
            <td class="text-center align-middle font-weight-bold">
                <span class="mr-1">x</span>
            </td>
            <td>
                <input type="number" name="signa2" class="form-control form-control-sm text-center" value="1" min="1" required>
            </td>
            <td>
                <input type="text" name="catatan" class="form-control form-control-sm" placeholder="Contoh: Ssh Makan">
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-outline-danger btn-hapus-obat">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        </tr>
        `;
                $('#wrapper-obat-terpilih').append(htmlRow);
            }
            updateNomorUrut();
            checkSubmitButton();
        });
        // 3. Event Listener Hapus Baris Obat
        $('#wrapper-obat-terpilih').on('click', '.btn-hapus-obat', function() {
            $(this).closest('tr').remove();

            // Jika tabel kosong, tampilkan kembali row empty
            if ($('#wrapper-obat-terpilih tr').not('#empty-row').length === 0) {
                $('#empty-row').show();
            }

            updateNomorUrut();
            checkSubmitButton();
        });

        // Helper: Update Nomor Urut Baris secara Dinamis
        function updateNomorUrut() {
            $('#wrapper-obat-terpilih tr').not('#empty-row').each(function(index) {
                $(this).find('.nomor-urut').text(index + 1);
            });
        }

        // Helper: Enable / Disable Tombol Simpan
        function checkSubmitButton() {
            var totalItem = $('#wrapper-obat-terpilih tr').not('#empty-row').length;
            if (totalItem > 0) {
                $('#btn-submit-obat').prop('disabled', false);
            } else {
                $('#btn-submit-obat').prop('disabled', true);
            }
        }
    });

    function simpanresep() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Pastikan data sudah terisi dengan benar!",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan resep !"
        }).then((result) => {
            if (result.isConfirmed) {
                save()
            }
        });
    }

    function save() {
        var data1 = $('.arrayobat').serializeArray();
        var data2 = $('.formInputObat').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data_obat: JSON.stringify(data1),
                data_header_obat: JSON.stringify(data2),
            },
            url: '<?= route('simpandataresepobatpasien_versi_2') ?>',
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
                    location.reload()
                }
            }
        });
    }
    $('#tombol_cari_komponen').click(function() {
        $('#tabel_barang2').DataTable().ajax.reload(); // Reload tabel dengan parameter baru
    });

    function prosesracikan() {
        spinner = $('#loader')
        spinner.show();
        var dataheader = $('.form_header_racikan').serializeArray();
        var datakomponen = $('.form_komponen').serializeArray();
        kode_kunjungan = $('#kode_kunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                dataheader: JSON.stringify(dataheader),
                datakomponen: JSON.stringify(datakomponen),
                kode_kunjungan
            },
            url: '<?= route('proseskomponenracik') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response) {
                spinner.hide()
                if (response.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: response.message,
                    });
                } else {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        text: "Silahkan cek dosis racik dan stoknya ...",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    let newRow = `
                        <div class="row mb-2 item-obat border p-2">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                <input type="email" class="form-control" id="list_nama_barang" name="list_nama_barang" aria-describedby="emailHelp" value="${response.data.nama_barang}">
                                <input hidden type="email" class="form-control" id="list_kode_barang" name="list_kode_barang" aria-describedby="emailHelp" value="${response.data.kode_barang}">
                            </div>
                        </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Satuan</label>
                                    <input type="email" class="form-control" id="list_satuan_barang" name="list_satuan_barang" aria-describedby="emailHelp" value="${response.data.satuan_barang}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Stok</label>
                                    <input type="email" class="form-control" id="list_stok_current_barang" name="list_stok_current_barang" aria-describedby="emailHelp" value="${response.data.stok_current}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">qty obat</label>
                                    <input type="email" class="form-control" id="list_qty_barang" name="list_qty_barang" aria-describedby="emailHelp" value="${response.data.jumlah}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">qty hari</label>
                                    <input type="email" class="form-control" id="list_qty_hari" name="list_qty_hari" aria-describedby="emailHelp" value="${response.data.lama_hari}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Dosis</label>
                                    <input readonly type="email" class="form-control" id="list_dosis_barang" name="list_dosis_barang" aria-describedby="emailHelp" value="${response.data.dosis_awal}">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Racik</label>
                                    <input readonly type="email" class="form-control" id="list_dosis_racik_barang" name="list_dosis_racik_barang" aria-describedby="emailHelp" value="${response.data.dosis_racik}">
                                </div>
                            </div>
                        <div class="col-1 text-end">
                            <button type="button" class="btn btn-danger btn-sm btn-hapus-racik"><i class="bi bi-x-circle"></i></button>
                        </div>
                        </div>`;
                    $('.v_list_komponen').append(newRow);
                }
            }
        });
    }
    $(document).ready(function() {
        // Event listener untuk menghapus baris komponen racikan
        $(document).on('click', '.btn-hapus-racik', function() {
            // Menghapus elemen parent dengan class .item-obat
            $(this).closest('.item-obat').remove();
        });

    });

    function simpanobatracikan() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data racikan akan disimpan ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Pastikan data racikan sudah dibuat dengan benar",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Ya, simpan data racikan",
                    denyButtonText: `Batal`
                }).then((result) => {
                    if (result.isConfirmed) {
                        simpandata()
                    } else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            }
        });
    }

    function spinner_on() {
        spinner.show();
    }

    function spinner_off() {
        spinner.hide();
    }

    function simpandata() {
        kode_kunjungan = $('#kode_kunjungan').val()
        var dataheader = $('.form_header_racikan').serializeArray();
        var datakomponen = $('.formdatakomponen').serializeArray();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan,
                dataheader: JSON.stringify(dataheader),
                datakomponen: JSON.stringify(datakomponen)
            },
            url: '<?= route('simpanobatracikan') ?>',
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
                    $('#modalbuatracikan').modal('toggle')
                    $('.modal-backdrop').remove();
                    Swal.fire({
                        icon: 'success',
                        title: 'OK!',
                        text: response.message,
                    });
                    clearFormByClass('vv');
                }
            }
        });
    }
    $(".ambilobatracik2").on('click', function(event) {
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}"
            },
            url: '<?= route('ambillistobatracikan_versi2') ?>',
            error: function(response) {
                spinner_off()
                alert('error')
            },
            success: function(response) {
                spinner_off()
                $('.v_t_racikan').html(response);
            }
        });
    });
</script>
