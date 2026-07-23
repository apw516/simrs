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
        <form action="" method="POST" id="formInputObat">
            @csrf
            <!-- Hidden Input untuk menangkap No RM / Kunjungan -->
            <input type="hidden" name="no_rm" value="{{ $data_kunjungan[0]->no_rm ?? '' }}">

            <div class="row">
                <!-- Select Nama Obat -->
                <div class="col-md-3 mb-3">
                    <label class="font-weight-bold small text-muted">NO SEP KUNJUNGAN</label>
                    <input type="text" name="no_sep" class="form-control" placeholder="0" min="1"
                        value="{{ $data_kunjungan[0]->no_sep }}">
                </div>

                <!-- Jumlah / Qty -->
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Tanggal Resep</label>
                    <input type="date" name="jumlah" class="form-control" placeholder="0" min="1" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Tanggal Pelayanan Resep</label>
                    <input type="date" name="jumlah" class="form-control" placeholder="0" min="1" required>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="font-weight-bold small text-muted">Dokter</label>
                    <input type="text" name="jumlah" class="form-control" placeholder="0" min="1" required>
                </div>
            </div>
            <!-- Tombol Tambah ke Daftar -->
            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-success btn-block font-weight-bold" data-toggle="modal"
                    data-target="#modalpilihobat">
                    <i class="fas fa-plus mr-1"></i> Pilih Obat
                </button>
            </div>
    </div>
    </form>
    <hr class="my-4">
    <h6 class="text-uppercase text-muted font-weight-bold mb-3 style-sm">
        <i class="fas fa-list-ol mr-2"></i>Daftar Obat Terpilih
    </h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Obat</th>
                    <th style="width: 100px;">Jenis Resep</th>
                    <th style="width: 100px;">Jenis Obat</th>
                    <th style="width: 100px;">Iterasi</th>
                    <th style="width: 100px;">Jlh Iterasi</th>
                    <th>Jumlah hari</th>
                    <th>Signa 1</th>
                    <th>Signa 2</th>
                    <th>Catatan</th>
                    <th style="width: 80px;" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- Tombol Simpan Akhir -->
    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-primary px-4 font-weight-bold">
            <i class="fas fa-save mr-2"></i>Simpan Resep Obat
        </button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpilihobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Silahkan Pilih Obat</h5>
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
<!-- Stylings & Helper Rotasi Collapse Icon -->
<style>
    .transition-icon {
        transition: transform 0.3s ease;
    }

    [aria-expanded="false"] .toggle-icon {
        transform: rotate(-90deg);
    }
</style>

<!-- CSS Tambahan untuk Efek Rotasi Panah -->
<style>
    .transition-icon {
        transition: transform 0.3s ease;
    }

    /* Memutar panah ke kanan saat collapse tertutup */
    [aria-expanded="false"] .toggle-icon {
        transform: rotate(-90deg);
    }
</style>
