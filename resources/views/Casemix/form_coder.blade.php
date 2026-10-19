<div class="card card-outline card-primary">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title font-weight-bold">
            <i class="bi bi-file-earmark-check-fill mr-1"></i> Verifikasi Berkas Pasien
        </h3>
        <div>
            {{-- Tombol kembali yang menyembunyikan v_2 dan menampilkan v_1 tanpa reload halaman --}}
            <button class="btn btn-sm btn-danger" onclick="kembaliKeTabel()">
                <i class="bi bi-arrow-left-circle mr-1"></i> Kembali
            </button>
        </div>
    </div>
    <div class="card-body">
        <!-- 1. IDENTITAS & RINGKASAN DATA PASIEN (STICKY TOP) -->
        <div class="card card-light mb-4 sticky-top shadow-sm" style="top: 0; z-index: 1020;">
            <div class="card-header bg-light">
                <h5 class="card-title text-sm font-weight-bold">Data Pasien & Kunjungan</h5>
            </div>
            <div class="card-body p-3 bg-white">
                <div class="row text-sm">
                    <div class="col-md-3">
                        <strong><i class="bi bi-person mr-1"></i> Nama Pasien:</strong>
                        <p class="text-muted mb-2">{{ $kunjungan->nama_pasien ?? '-' }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="bi bi-card-heading mr-1"></i> No. RM:</strong>
                        <p class="text-muted mb-2">{{ $kunjungan->no_rm ?? '-' }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="bi bi-journal-text mr-1"></i> No. SEP:</strong>
                        <p class="text-muted mb-2">{{ $kunjungan->no_sep ?? '-' }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="bi bi-building mr-1"></i> Poliklinik / Unit:</strong>
                        <p class="text-muted mb-2">{{ $kunjungan->nama_unit ?? '-' }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="bi bi-calendar-event mr-1"></i> Tgl Masuk:</strong>
                        <p class="text-muted mb-0">{{ $kunjungan->tgl_masuk ?? '-' }}</p>
                    </div>
                    <div class="col-md-3">
                        <strong><i class="bi bi-person-badge mr-1"></i> Dokter DPJP:</strong>
                        <p class="text-muted mb-0">{{ $kunjungan->nama_dokter ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="bi bi-hash mr-1"></i> Kode Kunjungan:</strong>
                        <p class="text-muted mb-0">{{ $kunjungan->kode_kunjungan ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                @if ($get_cek_ver)
                    @if ($get_cek_ver->status_verifikasi == 2)
                        <div class="p-3 mb-3 bg-white border-left border-success rounded shadow-sm">
                            <div class="d-flex align-items-center text-success">
                                <i class="bi bi-patch-check-fill mr-2"></i>
                                <h6 class="font-weight-bold mb-0">Status Verifikasi: Terverifikasi</h6>
                            </div>
                            <small class="text-muted d-block mt-1">Berkas telah diperiksa dan disetujui.</small>
                        </div>
                    @else
                        <div class="p-3 mb-3 bg-white border-left border-warning rounded shadow-sm">
                            <div class="d-flex align-items-center text-warning">
                                <i class="bi bi-exclamation-circle-fill mr-2"></i>
                                <h6 class="font-weight-bold mb-0">Status Verifikasi: Perlu Perbaikan</h6>
                            </div>
                            <div class="small text-dark mt-2 p-2 bg-light rounded border">
                                <strong>Catatan Verifikator:</strong><br>
                                {{ $get_cek_ver->catatan_verifikasi_awal ?? '-' }}
                            </div>
                        </div>
                    @endif
                @else
                    <div class="p-3 mb-3 bg-white border-left border-danger rounded shadow-sm">
                        <div class="d-flex align-items-center text-danger">
                            <i class="bi bi-exclamation-circle-fill mr-2"></i>
                            <h6 class="font-weight-bold mb-0">Status Verifikasi: Belum diverifikasi</h6>
                        </div>
                        {{-- <div class="small text-dark mt-2 p-2 bg-light rounded border">
                            <strong>Catatan Verifikator:</strong><br>
                            {{ $get_cek_ver->catatan_verifikasi_awal ?? '-' }}
                        </div> --}}
                    </div>

                @endif
                {{-- <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Berkas & Medis Pasien</h6>

                        <!-- Group Tombol Aksi -->
                        <div class="btn-group" role="group" aria-label="Aksi Berkas Medis">
                            <!-- Tombol Utama: Input Diagnosa -->
                            @if (isset($get_cek_ver) && $get_cek_ver->status_verifikasi == 2)
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modalInputDiagnosa">
                                    <i class="fas fa-plus-circle mr-1"></i> Tambah Diagnosa / Prosedur
                                </button>
                            @endif

                            <!-- Tombol Berkas Lain 1: Resume Medis / Lampiran -->
                            <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal"
                                data-target="#modalberkasseep">
                                <i class="fas fa-file-medical mr-1"></i> Berkas SEP
                            </button>

                            <!-- Tombol Berkas Lain 2: Upload Document / Hasil Lab -->
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#modalberkaslab">
                                <i class="fas fa-vials mr-1"></i> Hasil Laboratorium
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#modalberkaspa">
                                <i class="fas fa-vials mr-1"></i> Hasil Laboratorium Patologi Anatomi
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal"
                                data-target="#modalberkasradiologi">
                                <i class="fas fa-vials mr-1"></i> Hasil Radiologi
                            </button>

                            <!-- Optional: Dropdown Menu jika jenis berkas sangat banyak -->
                            <div class="btn-group" role="group">
                                <button id="btnGroupDropBerkas" type="button"
                                    class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-folder-open mr-1"></i> Berkas Lainnya
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDropBerkas">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalberkasdariluar">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Berkas dari luar
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalberkasusg">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Expertisi
                                        Ultrasonography
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalkonsul">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Lembar Konsul
                                    </a>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#modalcatatanhd">
                                        <i class="fas fa-file-signature text-primary mr-2"></i> Catatan HD
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Data Resume Medis</div>
                            <div class="card-body" style="max-height: 500px; overflow-y: auto; overflow-x: auto;">
                                <form action="" class="formcoding">
                                    <input hidden type="text" name="kode_kunjungan" id="kode_kunjungan"
                                        value="{{ $kode_kunjungan }}">
                                    @csrf
                                    <table class="table">
                                        <tr>
                                            <td>POLI KLINIK : </td>
                                            <td>Tanggal Periksa</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Keluhan Utama : {{ $assesmen_dokters->keluhan_pasien }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Riwayat Alergi : @if (!empty($assesmen_dokters->riwayat_alergi) || !empty($assesmen_dokters->keterangan_alergi))
                                                    {{ $assesmen_dokters->riwayat_alergi }} |
                                                    {{ $assesmen_dokters->keterangan_alergi }}
                                                @else
                                                    Tidak Ada Riwayat Alergi
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Kesadaran : {{ $assesmen_dokters->kesadaran }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Pemeriksaan Tanda Vital :

                                                <table
                                                    style="width: 100%; table-layout: fixed; border: none; background: transparent; font-size: 11px;">
                                                    <tr>
                                                        <td style="border: none; padding: 2px 0; width: 50%;">• Tekanan
                                                            Darah:
                                                            {{ $assesmen_dokters->tekanan_darah }} mmHg</td>
                                                        <td style="border: none; padding: 2px 0; width: 50%;">•
                                                            Frekuensi
                                                            Nadi:
                                                            {{ $assesmen_dokters->frekuensi_nadi }} x/menit</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border: none; padding: 2px 0;">• Frekuensi Nafas:
                                                            {{ $assesmen_dokters->frekuensi_nafas }} x/menit</td>
                                                        <td style="border: none; padding: 2px 0;">• Suhu Tubuh:
                                                            {{ $assesmen_dokters->suhu_tubuh }} °C
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"
                                                            style="border: none; padding-top: 5px; margin-top: 5px; border-top: 1px dashed #ddd;">
                                                            • BB / TB / IMT: {{ $assesmen_dokters->beratbadan }}
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; •
                                                            Umur: {{ $assesmen_dokters->umur }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Pemeriksaan Fisik ( O ) :
                                                {{ $assesmen_dokters->pemeriksaan_fisik }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Hasil Laboratorium</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Hasil Radiologi</td>
                                        </tr>
                                        @if ($assesmen_dokters->kode_unit == '1012')
                                            <tr>
                                                <td
                                                    style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                                                    Hasil USG Kebidanan</td>
                                                <td style="padding: 5px;">
                                                    <strong>Hasil Expertisi :</strong><br>
                                                    {{ $assesmen_dokters->evaluasi }}
                                                </td>
                                            </tr>
                                        @endif

                                        <!-- Kondisional USG Urologi -->
                                        @if ($assesmen_dokters->kode_unit == '1027')
                                            <tr>
                                                <td
                                                    style="padding: 5px; font-weight: bold; background-color: #f8f9fa; vertical-align: top;">
                                                    Hasil USG Urologi</td>
                                                <td style="padding: 5px;">
                                                    <strong>Hasil Expertisi :</strong><br>
                                                    {{ $assesmen_dokters->evaluasi }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Diagnosis</td>
                                        </tr>
                                    </table>
                                    <table class="table">
                                        <tr>
                                            <td>Diagnosa Utama : {{ $assesmen_dokters->diagnosakerja }}
                                                <div class="v_diag_utama_tersimpan">

                                                </div>
                                            </td>
                                            <td>
                                                ICD 10 : <br>
                                                <div class="arraydiagutama">

                                                </div>
                                                <div class="form-group mb-0">
                                                    <label>Pilih Diagnosa Utama <span
                                                            class="text-danger">*</span></label>
                                                    <!-- Tambahkan style width: 100% agar select2 merentang penuh -->
                                                    <select class="form-control select2-icd10"
                                                        id="select_diagnosa_utama" style="width: 100%;"></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosa Sekunder : {{ $assesmen_dokters->diagnosabanding }}
                                                <div class="v_diag_sekunder_tersimpan">

                                                </div>
                                            </td>
                                            <td>
                                                ICD 10 : <br>
                                                <div class="arraydiagsekunder">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label>Pilih Diagnosa Sekunder</label>
                                                    <select class="form-control select2-icd10"
                                                        id="select_diagnosa_sekunder" style="width: 100%;"></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Prosedur :</td>
                                            <td>
                                                {{ $assesmen_dokters->tindakanmedis }}
                                                @foreach ($tindakan as $t)
                                                    @if ($t->kode_kunjungan == $assesmen_dokters->id_kunjungan)
                                                        <div style="margin-top: 2px;">• {{ $t->NAMA_TARIF }}</div>
                                                    @endif
                                                @endforeach
                                                Coding ICD 9 : <br>
                                                <div class="v_diag_prosedur">

                                                </div>
                                                <br>
                                                <div class="arraytindakanprosedur">
                                                </div>
                                                <div class="mb-0 form-group">
                                                    <label>Pilih Tindakan / Prosedur</label>
                                                    <select class="form-control select2-icd9" id="select_prosedur"
                                                        data-kategori="Prosedur" style="width: 100%;"></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Operasi :</td>
                                            <td>
                                                Coding ICD 9 : <br>
                                                <div class="v_diag_tindakan_op">

                                                </div>
                                                <br>
                                                <div class="arraytindakanoperasi">
                                                </div>
                                                <div class="mb-0 form-group">
                                                    <label>Pilih Tindakan Operasi</label>
                                                    <select class="form-control select2-icd9" id="select_operasi"
                                                        data-kategori="Operasi" style="width: 100%;"></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Rencana Terapi ( P ) :
                                                {{ $assesmen_dokters->rencanakerja }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Tindak Lanjut :

                                                <strong>Status:</strong> {{ $assesmen_dokters->tindak_lanjut }}
                                                @if (!empty($assesmen_dokters->keterangan_tindak_lanjut))
                                                    <br><span style="color: #444;"><strong>Ket:</strong>
                                                        {{ $assesmen_dokters->keterangan_tindak_lanjut }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Obat Obatan :
                                                @if (count($orderfarmasi) > 0)
                                                    @foreach ($orderfarmasi as $t)
                                                        <div style="margin-bottom: 2px;">
                                                            • <strong>{{ $t->kode_barang }}</strong> (Qty:
                                                            {{ $t->jumlah_layanan }}),
                                                            Aturan Pakai: <em>{{ $t->aturan_pakai }}</em>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <span style="color: #777;">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pmeriksaan Penunjang :
                                                @if (count($order_penunjang) > 0)
                                                    @foreach ($order_penunjang as $d)
                                                        • {{ $d->nama_unit }} ({{ $d->NAMA_TARIF }})<br>
                                                    @endforeach
                                                @else
                                                    <span style="color: #777;">Tidak ada order penunjang</span>
                                                @endif
                                            </td>
                                            <td>
                                                ICD 9 : <br>
                                                <div class="v_diag_tindakan_penunjang">

                                                </div>
                                                <br>
                                                <div class="arraytindakanpenunjang">
                                                </div>
                                                <div class="form-group">
                                                    <label>Pilih Tindakan Penunjang</label>
                                                    <select class="form-control select2-icd9" id="select_penunjang"
                                                        data-kategori="Penunjang" style="width: 100%;"></select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Jawaban Konsul ke poli lain :
                                                {{ $assesmen_dokters->keterangan_tindak_lanjut_2 ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Hasil Pemeriksaan Khusus</td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">Berkas</div>
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" id="berkasTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active font-weight-bold" id="sep-tab" data-toggle="tab"
                                            href="#sep" role="tab">
                                            <i class="fas fa-id-card mr-1"></i> Berkas SEP
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="resume-tab" data-toggle="tab"
                                            href="#resume" role="tab">
                                            <i class="fas fa-file-invoice-dollar mr-1"></i> Resume Medis Rawat </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="lab-tab" data-toggle="tab"
                                            href="#lab" role="tab">
                                            <i class="fas fa-vials mr-1"></i> Hasil Lab
                                            {{-- @if (isset($lab_terpilih) && count($lab_terpilih) > 0) --}}
                                            {{-- <span
                                                    class="badge badge-pill badge-primary">{{ count($lab_terpilih) }}</span> --}}
                                            {{-- @endif --}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="labPA-tab" data-toggle="tab"
                                            href="#labPA" role="tab">
                                            <i class="fas fa-vials mr-1"></i> Hasil Lab Patologi Anatomi
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="rad-tab" data-toggle="tab"
                                            href="#rad" role="tab">
                                            <i class="fas fa-x-ray mr-1"></i> Hasil Radiologi
                                            {{-- @if (isset($rad_terpilih) && count($rad_terpilih) > 0)
                                                <span
                                                    class="badge badge-pill badge-warning">{{ count($rad_terpilih) }}</span>
                                            @endif --}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="lembarkonsul-tab" data-toggle="tab"
                                            href="#lembarkonsul" role="tab">
                                            <i class="fas fa-file-invoice-dollar mr-1"></i> Lembar Konsul
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="catatanhd-tab" data-toggle="tab"
                                            href="#catatanhd" role="tab">
                                            <i class="fas fa-file-invoice-dollar mr-1"></i> Catatan Hemodialisa
                                        </a>
                                    </li>
                                    {{-- @endif --}}
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="berkasscan-tab" data-toggle="tab"
                                            href="#berkasscan" role="tab">
                                            <i class="fas fa-layer-group mr-1 text-purple"></i> Berkas Penunjang Lain
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bold" id="berkaslain-tab" data-toggle="tab"
                                            href="#berkaslain" role="tab">
                                            <i class="fas fa-layer-group mr-1 text-purple"></i> Berkas Lain
                                        </a>
                                    </li>
                                    <li hidden class="nav-item">
                                        <a class="nav-link font-weight-bold" id="all-tab" data-toggle="tab"
                                            href="#all" role="tab">
                                            <i class="fas fa-layer-group mr-1 text-purple"></i> Semua Berkas (Merger
                                            View)
                                        </a>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="berkasTabContent">
                                    <!-- 1. TAB PREVIEW SEP -->
                                    <div class="tab-pane fade show active" id="sep" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                @if ($urlCetakSEP)
                                                    <div class="embed-responsive embed-responsive-16by9"
                                                        style="min-height: 480px;">
                                                        <iframe class="embed-responsive-item"
                                                            src="{{ $urlCetakSEP }}" allowfullscreen></iframe>
                                                    </div>
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i
                                                            class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                                        <p class="mb-0">Nomor SEP tidak ditemukan untuk kunjungan
                                                            ini.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="resume" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                @php
                                                    // Sesuaikan variabel URL Resume dengan variabel/route controller Anda
                                                    $urlCetakResume = route(
                                                        'cetakresumedmedisttelokal',
                                                        $ts_kunjungan[0]->kode_kunjungan,
                                                    );
                                                @endphp
                                                @if (isset($urlCetakResume))
                                                    <div class="d-flex justify-content-end mb-2 p-2">
                                                        <a href="{{ $urlCetakResume }}" target="_blank"
                                                            class="btn btn-xs btn-outline-primary">
                                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan
                                                            di Tab Baru
                                                        </a>
                                                    </div>
                                                    <div class="embed-responsive embed-responsive-16by9"
                                                        style="min-height: 480px;">
                                                        <iframe class="embed-responsive-item"
                                                            src="{{ $urlCetakResume }}" allowfullscreen></iframe>
                                                    </div>
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i
                                                            class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                                        <p class="mb-0">URL Cetak Nota/Rincian Obat tidak ditemukan.
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 2. TAB HASIL LAB (PDF / IFRAME) -->
                                    <div class="tab-pane fade" id="lab" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-2">
                                                @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                                                    @foreach ($lab_terpilih as $index => $lab)
                                                        @php
                                                            $urlPdfLab =
                                                                $lab->link ??
                                                                ($lab->file_pdf ?? ($lab->url_file ?? null));
                                                        @endphp
                                                        @if ($urlPdfLab)
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2 px-2">
                                                                <span class="font-weight-bold text-dark">
                                                                    <i class="fas fa-file-pdf text-danger mr-1"></i>
                                                                    Hasil Lab
                                                                    #{{ $index + 1 }}
                                                                </span>
                                                                <a href="{{ $urlPdfLab }}" target="_blank"
                                                                    class="btn btn-xs btn-outline-primary">
                                                                    <i class="fas fa-external-link-alt mr-1"></i> Buka
                                                                    di Tab Baru
                                                                </a>
                                                            </div>
                                                            <div class="embed-responsive embed-responsive-16by9 mb-3"
                                                                style="min-height: 480px;">
                                                                <iframe class="embed-responsive-item"
                                                                    src="{{ $urlPdfLab }}"
                                                                    allowfullscreen></iframe>
                                                            </div>
                                                            @if (!$loop->last)
                                                                <hr class="my-3">
                                                            @endif
                                                        @else
                                                            <div class="text-center py-4 text-muted">
                                                                <i
                                                                    class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                                                <p>URL berkas PDF untuk hasil lab ini tidak valid atau
                                                                    kosong.</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                                        <p class="mb-0">Tidak ada berkas PDF hasil laboratorium untuk
                                                            kode kunjungan ini.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="labPA" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-2">
                                                @if (isset($layananheaderPA) && count($layananheaderPA) > 0)
                                                    @foreach ($layananheaderPA as $index => $labPA)
                                                        @php
                                                            $urlPdfLab =
                                                                $labPA->id ?? ($labPA->id ?? ($labPA->id ?? null));
                                                        @endphp
                                                        @if ($urlPdfLab)
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2 px-2">
                                                                <span class="font-weight-bold text-dark">
                                                                    <i class="fas fa-file-pdf text-danger mr-1"></i>
                                                                    Hasil Lab
                                                                    #{{ $index + 1 }}
                                                                </span>
                                                                <a href="{{ route('expertisi.cetak', ['id' => $urlPdfLab]) }}"
                                                                    target="_blank"
                                                                    class="btn btn-xs btn-outline-primary">
                                                                    <i class="fas fa-external-link-alt mr-1"></i> Buka
                                                                    di Tab Baru
                                                                </a>
                                                            </div>
                                                            <div class="embed-responsive embed-responsive-16by9 mb-3"
                                                                style="min-height: 480px;">
                                                                <iframe class="embed-responsive-item"
                                                                    src="{{ route('expertisi.cetak', ['id' => $urlPdfLab]) }}"
                                                                    allowfullscreen></iframe>
                                                            </div>
                                                            @if (!$loop->last)
                                                                <hr class="my-3">
                                                            @endif
                                                        @else
                                                            <div class="text-center py-4 text-muted">
                                                                <i
                                                                    class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                                                <p>URL berkas PDF untuk hasil lab ini tidak valid atau
                                                                    kosong.</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                                        <p class="mb-0">Tidak ada berkas PDF hasil laboratorium untuk
                                                            kode kunjungan ini.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="rad" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-2">
                                                @if (isset($LINK_RADIOLOGI) && count($LINK_RADIOLOGI) > 0)
                                                    @foreach ($LINK_RADIOLOGI as $index => $urlPdfRad)
                                                        @if (!empty($urlPdfRad))
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2 px-2">
                                                                <span class="font-weight-bold text-dark">
                                                                    <i class="fas fa-x-ray text-warning mr-1"></i>
                                                                    Hasil Radiologi
                                                                    #{{ $index + 1 }}
                                                                </span>
                                                                <a href="{{ $urlPdfRad }}" target="_blank"
                                                                    class="btn btn-xs btn-outline-primary">
                                                                    <i class="fas fa-external-link-alt mr-1"></i> Buka
                                                                    di Tab Baru
                                                                </a>
                                                            </div>
                                                            <div class="embed-responsive embed-responsive-16by9 mb-3"
                                                                style="min-height: 480px;">
                                                                <iframe class="embed-responsive-item"
                                                                    src="{{ $urlPdfRad }}"
                                                                    allowfullscreen></iframe>
                                                            </div>
                                                            @if (!$loop->last)
                                                                <hr class="my-3">
                                                            @endif
                                                        @else
                                                            <div class="text-center py-4 text-muted">
                                                                <i
                                                                    class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                                                <p>ACCESSIONNUMBER / URL berkas Radiologi ini tidak
                                                                    ditemukan.</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                                                        <p class="mb-0">Tidak ada berkas hasil radiologi untuk kode
                                                            kunjungan ini.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="lembarkonsul" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                @if (isset($urlLembarKonsul) && $urlLembarKonsul)
                                                    <div class="d-flex justify-content-end mb-2 p-2">
                                                        <a href="{{ $urlLembarKonsul }}" target="_blank"
                                                            class="btn btn-xs btn-outline-primary">
                                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan
                                                            di Tab Baru
                                                        </a>
                                                    </div>
                                                    <div class="embed-responsive embed-responsive-16by9"
                                                        style="min-height: 480px;">
                                                        <iframe class="embed-responsive-item"
                                                            src="{{ $urlLembarKonsul }}" allowfullscreen></iframe>
                                                    </div>
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i
                                                            class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                                        <p class="mb-0">URL Cetak Lembar Konsul tidak ditemukan.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="expertisipoli" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                {{-- @if (isset($urlExpertisiPoli) && $urlExpertisiPoli)
                                                    <div class="d-flex justify-content-end mb-2 p-2">
                                                        <a href="{{ $urlExpertisiPoli }}" target="_blank"
                                                            class="btn btn-xs btn-outline-primary">
                                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan
                                                            di Tab Baru
                                                        </a>
                                                    </div>
                                                    <div class="embed-responsive embed-responsive-16by9"
                                                        style="min-height: 480px;">
                                                        <iframe class="embed-responsive-item"
                                                            src="{{ $urlExpertisiPoli }}" allowfullscreen></iframe>
                                                    </div>
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i
                                                            class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                                        <p class="mb-0">URL Cetak Nota/Rincian Obat tidak ditemukan.
                                                        </p>
                                                    </div>
                                                @endif --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="catatanhd" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                @if (isset($urlCetakHD) && $urlCetakHD)
                                                    <div class="d-flex justify-content-end mb-2 p-2">
                                                        <a href="{{ $urlCetakHD }}" target="_blank"
                                                            class="btn btn-xs btn-outline-primary">
                                                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan
                                                            di Tab Baru
                                                        </a>
                                                    </div>
                                                    <div class="embed-responsive embed-responsive-16by9"
                                                        style="min-height: 480px;">
                                                        <iframe class="embed-responsive-item"
                                                            src="{{ $urlCetakHD }}" allowfullscreen></iframe>
                                                    </div>
                                                @else
                                                    <div class="text-center py-5 text-muted">
                                                        <i
                                                            class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                                                        <p class="mb-0">URL Cetak Nota/Rincian Obat tidak ditemukan.
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="berkasscan" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                <div class="card mb-4 border shadow-sm">
                                                    <div
                                                        class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                        <span class="font-weight-bold text-dark text-sm">
                                                            <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                            Expertisi Poli
                                                        </span>
                                                        <a href="{{ $urlExpertisiPoli }}" target="_blank"
                                                            class="btn btn-xs btn-outline-primary">
                                                            <i class="bi bi-box-arrow-up-right mr-1"></i> Buka Tab Baru
                                                        </a>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <iframe src="{{ $urlExpertisiPoli }}" width="100%"
                                                            height="700px" style="border: none;"
                                                            loading="lazy"></iframe>
                                                    </div>
                                                </div>
                                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3 mt-4">
                                                    <i class="bi bi-images text-info mr-1"></i> Laboratorium dari luar
                                                </h6>
                                                @foreach ($lab_luar as $scanlab_luar)
                                                    @php
                                                        $namaFilelab_luar = basename($scanlab_luar);
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFilelab_luar,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3 mt-4">
                                                    <i class="bi bi-images text-info mr-1"></i> Radiologi dari luar
                                                </h6>
                                                @foreach ($rad_luar as $scanrad_luar)
                                                    @php
                                                        $namaFilerad_luar = basename($scanrad_luar);
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFilerad_luar,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3 mt-4">
                                                    <i class="bi bi-images text-info mr-1"></i> Berkas Penunjang Lain
                                                </h6>
                                                @foreach ($echo_jantung as $scanecho_jantung)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFileecho_jantung = basename($scanecho_jantung);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFileecho_jantung,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Penunjang Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($ekg as $scanekg)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFileekg = basename($scanekg);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', ['filename' => $namaFileekg]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Penunjang Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($endoskopi as $scanendoskopi)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFileendoskopi = basename($scanendoskopi);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFileendoskopi,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Penunjang Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($USG as $scanUSG)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFileUSG = basename($scanUSG);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', ['filename' => $namaFileUSG]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Penunjang Lainnya ( USG )
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="berkaslain" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3 mt-4">
                                                    <i class="bi bi-images text-info mr-1"></i> Berkas Lain
                                                </h6>
                                                @foreach ($kronologis_laka as $scankronologis_laka)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFilekronologis_laka = basename($scankronologis_laka);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFilekronologis_laka,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($laporan_polisi as $scanlaporan_polisi)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFilelaporan_polisi = basename($scanlaporan_polisi);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFilelaporan_polisi,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($produk_obat as $scanproduk_obat)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFileproduk_obat = basename($scanproduk_obat);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', [
                                                            'filename' => $namaFileproduk_obat,
                                                        ]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($lainnya as $scan)
                                                    @php
                                                        // Mengubah path mentah NAS (\\192.168.2.14\...\namafile.pdf)
                                                        // menjadi hanya nama file-nya saja (namafile.pdf)
                                                        $namaFile = basename($scan);

                                                        // Membuat URL web aman menuju route Laravel
                                                        $fileUrl = route('berkas.nas', ['filename' => $namaFile]);
                                                    @endphp
                                                    <div class="card mb-4 border shadow-sm">
                                                        <div
                                                            class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                                                            <span class="font-weight-bold text-dark text-sm">
                                                                <i class="bi bi-file-earmark-pdf text-danger mr-1"></i>
                                                                Berkas Lainnya
                                                            </span>
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="bi bi-box-arrow-up-right mr-1"></i> Buka di
                                                                Tab Baru
                                                            </a>
                                                        </div>
                                                        <div class="card-body p-0">
                                                            <!-- Iframe memuat URL HTTP aman dari Laravel, bukan path NAS langsung -->
                                                            <iframe src="{{ $fileUrl }}" width="100%"
                                                                height="700px" style="border: none;"
                                                                loading="lazy"></iframe>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 5. TAB MERGER / SEMUA BERKAS -->
                                    <div class="tab-pane fade" id="all" role="tabpanel">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-1">
                                                <div class="embed-responsive embed-responsive-16by9"
                                                    style="min-height: 500px;">
                                                    <iframe class="embed-responsive-item"
                                                        src="{{ route('farmasi.preview-merger-pdf', $idresep) }}"
                                                        allowfullscreen>
                                                    </iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Modal Berkas Penunjang -->
<div class="modal fade" id="modalberkasdariluar" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Dari Luar
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($gambarscan) && count($gambarscan) > 0)
                    @foreach ($gambarscan as $scan)
                        @php
                            $fileUrl = 'http://192.168.2.45/files/' . ltrim($scan->gambar, '/');
                        @endphp
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="font-weight-bold text-dark">
                                <i class="fas fa-image text-purple mr-1"></i> Berkas Scan Poli
                            </span>
                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka Gambarnya di Tab
                                Baru
                            </a>
                        </div>
                        <div class="text-center mb-3">
                            <img src="{{ $fileUrl }}" class="img-fluid rounded border shadow-sm"
                                style="max-height: 600px; object-fit: contain;" alt="Berkas Scan">
                        </div>
                        @if (!$loop->last)
                            <hr class="my-3">
                        @endif
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                        <p class="mb-0">Tidak ada berkas scan poli untuk kunjungan ini.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkasseep" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas SEP
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlCetakSEP))
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlCetakSEP }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">Nomor SEP tidak ditemukan untuk kunjungan ini.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkasradiologi" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Radiologi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($LINK_RADIOLOGI) && count($LINK_RADIOLOGI) > 0)
                    @foreach ($LINK_RADIOLOGI as $index => $urlPdfRad)
                        @if (!empty($urlPdfRad))
                            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                <span class="font-weight-bold text-dark">
                                    <i class="fas fa-x-ray text-warning mr-1"></i> Hasil Radiologi
                                    #{{ $index + 1 }}
                                </span>
                                <a href="{{ $urlPdfRad }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                </a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 mb-3" style="min-height: 480px;">
                                <iframe class="embed-responsive-item" src="{{ $urlPdfRad }}"
                                    allowfullscreen></iframe>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-3">
                            @endif
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                <p>ACCESSIONNUMBER / URL berkas Radiologi ini tidak ditemukan.</p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                        <p class="mb-0">Tidak ada berkas hasil radiologi untuk kode kunjungan ini.
                        </p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkaspa" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Laboratorium Patologi Anatomi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (isset($layananheaderPA) && count($layananheaderPA) > 0)
                    @foreach ($layananheaderPA as $index => $labPA)
                        @php
                            $idPA = $labPA->id ?? null;
                        @endphp
                        @if ($idPA)
                            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                <span class="font-weight-bold text-dark">
                                    <i class="fas fa-file-pdf text-danger mr-1"></i> Hasil Lab PA
                                    #{{ $index + 1 }}
                                </span>
                                <a href="{{ route('expertisi.cetak', ['id' => $idPA]) }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                </a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 mb-3" style="min-height: 480px;">
                                <iframe class="embed-responsive-item"
                                    src="{{ route('expertisi.cetak', ['id' => $idPA]) }}" allowfullscreen></iframe>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-3">
                            @endif
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                <p>URL berkas PDF untuk hasil lab PA ini tidak valid atau kosong.</p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                        <p class="mb-0">Tidak ada berkas PDF hasil laboratorium PA untuk kode
                            kunjungan ini.
                        </p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalcatatanhd" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Catatan Hemodialisa
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlCetakHD))
                    <div class="d-flex justify-content-end mb-2 p-2">
                        <a href="{{ $urlCetakHD }}" target="_blank" class="btn btn-xs btn-outline-primary">
                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                        </a>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlCetakHD }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">URL Catatan Hemodialisa tidak ditemukan.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkaslab" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Laboratorium
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <i class="fas fa-vials mr-1"></i> Hasil Lab PDF
                @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                    <span class="badge badge-pill badge-primary">{{ count($lab_terpilih) }}</span>
                @endif
                @if (isset($lab_terpilih) && count($lab_terpilih) > 0)
                    @foreach ($lab_terpilih as $index => $lab)
                        @php
                            $urlPdfLab = $lab->link ?? ($lab->file_pdf ?? ($lab->url_file ?? null));
                        @endphp
                        @if ($urlPdfLab)
                            <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                                <span class="font-weight-bold text-dark">
                                    <i class="fas fa-file-pdf text-danger mr-1"></i> Hasil Lab
                                    #{{ $index + 1 }}
                                </span>
                                <a href="{{ $urlPdfLab }}" target="_blank"
                                    class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka di Tab Baru
                                </a>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 mb-3" style="min-height: 480px;">
                                <iframe class="embed-responsive-item" src="{{ $urlPdfLab }}"
                                    allowfullscreen></iframe>
                            </div>
                            @if (!$loop->last)
                                <hr class="my-3">
                            @endif
                        @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-exclamation-triangle text-warning mb-2 fa-2x"></i>
                                <p>URL berkas PDF untuk hasil lab ini tidak valid atau kosong.</p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-info-circle fa-3x mb-3 text-info"></i>
                        <p class="mb-0">Tidak ada berkas PDF hasil laboratorium untuk kode kunjungan
                            ini.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalberkasusg" tabindex="-1" role="dialog"
    aria-labelledby="modalBerkasPenunjangLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Ultrasonography
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlExpertisiPoli))
                    <div class="d-flex justify-content-end mb-2 p-2">
                        <a href="{{ $urlExpertisiPoli }}" target="_blank" class="btn btn-xs btn-outline-primary">
                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                        </a>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlExpertisiPoli }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">URL Expertisi Ultrasonography tidak ditemukan.</p>
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalkonsul" tabindex="-1" role="dialog" aria-labelledby="modalBerkasPenunjangLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="modalBerkasPenunjangLabel">
                    <i class="fas fa-file-medical mr-1"></i> Berkas Konsul
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (!empty($urlLembarKonsul))
                    <div class="d-flex justify-content-end mb-2 p-2">
                        <a href="{{ $urlLembarKonsul }}" target="_blank" class="btn btn-xs btn-outline-primary">
                            <i class="fas fa-external-link-alt mr-1"></i> Buka Cetakan di Tab Baru
                        </a>
                    </div>
                    <div class="embed-responsive embed-responsive-16by9" style="min-height: 480px;">
                        <iframe class="embed-responsive-item" src="{{ $urlLembarKonsul }}" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-exclamation-circle fa-3x mb-3 text-warning"></i>
                        <p class="mb-0">URL Cetak Lembar Konsul tidak ditemukan.</p>
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function kembaliKeTabel() {
        $('.v_1').removeAttr('hidden');
        $('.v_2').attr('hidden', true);
    }

    $(document).ready(function() {
        $('.select2-icd10').select2({
            theme: 'bootstrap4',
            placeholder: 'Ketik kode atau nama diagnosa...',
            allowClear: true,
            width: '100%',
            minimumInputLength: 2, // Minimal 2 karakter baru mencari ke server
            ajax: {
                url: "{{ route('referensi.icd10') }}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term // Parameter yang dikirim ke controller (Request()->q)
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.diag + ' - ' + item
                                    .nama, // Nilai yang disimpan (biasanya kode ICD)
                                text: item.diag + ' - ' + item
                                    .nama, // Label yang tampil di dropdown
                                kode: item.diag,
                                nama: item.nama
                            };
                        })
                    };
                },
                cache: true
            }
        });
        $('.select2-icd9').select2({
            theme: 'bootstrap4',
            placeholder: 'Ketik kode atau nama tindakan...',
            allowClear: true,
            width: '100%',
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('referensi.icd9') }}",
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.diag + ' - ' + item.nama_panjang,
                                text: item.diag + ' - ' + item.nama_panjang,
                                kode: item.diag,
                                nama: item.nama_panjang
                            };
                        })
                    };
                },
                cache: true
            }
        });
        $('#modalInputDiagnosa').on('hidden.bs.modal', function() {
            $('.select2-icd10, .select2-icd9').val(null).trigger('change');
            // Jika ingin mengosongkan tabel temporer saat modal ditutup:
            // $('#tableDiagnosa tbody').empty();
            // $('#tableTindakan tbody').empty();
        });
        $('#select_diagnosa_utama').on('select2:select', function(e) {
            var data = e.params.data; // Mengambil data objek dari item yang dipilih

            // Cek apakah item sudah pernah ditambahkan sebelumnya (mencegah duplikat)
            if ($('#diag-item-' + data.id).length > 0) {
                alert('Diagnosa ini sudah dipilih.');
                $(this).val(null).trigger('change'); // Reset select
                return;
            }

            // Buat HTML elemen untuk ditampilkan di .arraydiagutama
            // Menyertakan input hidden agar nilainya ikut terkirim saat form disubmit
            var htmlItem = `
                    <div class="badge badge-info mr-2 mb-2 p-2 d-inline-flex align-items-center" id="diag-item-${data.id}" style="font-size: 13px;">
                        <span class="mr-2">${data.text}</span>
                        <input type="hidden" name="diagnosa_utama[]" value="${data.id}">
                        <button type="button" class="btn btn-xs btn-light text-danger ml-1 remove-diag" style="padding: 0 5px; font-weight: bold;">&times;</button>
                    </div>
                `;

            // Masukkan ke dalam container .arraydiagutama
            $('.arraydiagutama').append(htmlItem);

            // Reset pilihan Select2 agar kembali kosong setelah dipilih
            $(this).val(null).trigger('change');
        });
        $('#select_diagnosa_sekunder').on('select2:select', function(e) {
            var data = e.params.data; // Mengambil data objek dari item yang dipilih

            // Cek apakah item sudah pernah ditambahkan sebelumnya (mencegah duplikat)
            if ($('#diag-item-' + data.id).length > 0) {
                alert('Diagnosa ini sudah dipilih.');
                $(this).val(null).trigger('change'); // Reset select
                return;
            }

            // Buat HTML elemen untuk ditampilkan di .arraydiagutama
            // Menyertakan input hidden agar nilainya ikut terkirim saat form disubmit
            var htmlItem = `
                    <div class="badge badge-info mr-2 mb-2 p-2 d-inline-flex align-items-center" id="diag-item-${data.id}" style="font-size: 13px;">
                        <span class="mr-2">${data.text}</span>
                        <input type="hidden" name="diagnosa_sekunder[]" value="${data.id}">
                        <button type="button" class="btn btn-xs btn-light text-danger ml-1 remove-diag" style="padding: 0 5px; font-weight: bold;">&times;</button>
                    </div>
                `;

            // Masukkan ke dalam container .arraydiagutama
            $('.arraydiagsekunder').append(htmlItem);

            // Reset pilihan Select2 agar kembali kosong setelah dipilih
            $(this).val(null).trigger('change');
        });
        $(document).on('click', '.remove-diag', function() {
            $(this).closest('div').remove();
        });
        $('#select_prosedur').on('select2:select', function(e) {
            var data = e.params.data; // Mengambil data objek dari item yang dipilih

            // Cek apakah item sudah pernah ditambahkan sebelumnya (mencegah duplikat)
            if ($('#diag-item-' + data.id).length > 0) {
                alert('Diagnosa ini sudah dipilih.');
                $(this).val(null).trigger('change'); // Reset select
                return;
            }

            // Buat HTML elemen untuk ditampilkan di .arraydiagutama
            // Menyertakan input hidden agar nilainya ikut terkirim saat form disubmit
            var htmlItem = `
                    <div class="badge badge-info mr-2 mb-2 p-2 d-inline-flex align-items-center" id="diag-item-${data.id}" style="font-size: 13px;">
                        <span class="mr-2">${data.text}</span>
                        <input type="hidden" name="tindakan_prosedur[]" value="${data.id}">
                        <button type="button" class="btn btn-xs btn-light text-danger ml-1 remove-diag" style="padding: 0 5px; font-weight: bold;">&times;</button>
                    </div>
                `;

            // Masukkan ke dalam container .arraydiagutama
            $('.arraytindakanprosedur').append(htmlItem);

            // Reset pilihan Select2 agar kembali kosong setelah dipilih
            $(this).val(null).trigger('change');
        });
        $('#select_operasi').on('select2:select', function(e) {
            var data = e.params.data; // Mengambil data objek dari item yang dipilih

            // Cek apakah item sudah pernah ditambahkan sebelumnya (mencegah duplikat)
            if ($('#diag-item-' + data.id).length > 0) {
                alert('Diagnosa ini sudah dipilih.');
                $(this).val(null).trigger('change'); // Reset select
                return;
            }

            // Buat HTML elemen untuk ditampilkan di .arraydiagutama
            // Menyertakan input hidden agar nilainya ikut terkirim saat form disubmit
            var htmlItem = `
                    <div class="badge badge-info mr-2 mb-2 p-2 d-inline-flex align-items-center" id="diag-item-${data.id}" style="font-size: 13px;">
                        <span class="mr-2">${data.text}</span>
                        <input type="hidden" name="tindakan_operasi[]" value="${data.id}">
                        <button type="button" class="btn btn-xs btn-light text-danger ml-1 remove-diag" style="padding: 0 5px; font-weight: bold;">&times;</button>
                    </div>
                `;

            // Masukkan ke dalam container .arraydiagutama
            $('.arraytindakanoperasi').append(htmlItem);

            // Reset pilihan Select2 agar kembali kosong setelah dipilih
            $(this).val(null).trigger('change');
        });
        $('#select_penunjang').on('select2:select', function(e) {
            var data = e.params.data; // Mengambil data objek dari item yang dipilih

            // Cek apakah item sudah pernah ditambahkan sebelumnya (mencegah duplikat)
            if ($('#diag-item-' + data.id).length > 0) {
                alert('Diagnosa ini sudah dipilih.');
                $(this).val(null).trigger('change'); // Reset select
                return;
            }

            // Buat HTML elemen untuk ditampilkan di .arraydiagutama
            // Menyertakan input hidden agar nilainya ikut terkirim saat form disubmit
            var htmlItem = `
                    <div class="badge badge-info mr-2 mb-2 p-2 d-inline-flex align-items-center" id="diag-item-${data.id}" style="font-size: 13px;">
                        <span class="mr-2">${data.text}</span>
                        <input type="hidden" name="tindakan_penunjang[]" value="${data.id}">
                        <button type="button" class="btn btn-xs btn-light text-danger ml-1 remove-diag" style="padding: 0 5px; font-weight: bold;">&times;</button>
                    </div>
                `;

            // Masukkan ke dalam container .arraydiagutama
            $('.arraytindakanpenunjang').append(htmlItem);

            // Reset pilihan Select2 agar kembali kosong setelah dipilih
            $(this).val(null).trigger('change');
        });
        // 5. Hapus Baris Tabel Secara Lokal
        $(document).on('click', '.btn-remove-row', function() {
            $(this).closest('tr').remove();
        });

        // 6. Simpan Data via AJAX
        $('#formDiagnosaTindakan button[type="button"]').on('click', function(e) {
            e.preventDefault();

            let form = $('#formDiagnosaTindakan');
            let formData = form.serialize();
            let btnSave = $(this);

            let hasUtama = $('#tableDiagnosa tbody tr[data-kategori="Utama"]').length > 0;
            if (!hasUtama) {
                alert('Silakan pilih minimal 1 Diagnosa Utama!');
                return;
            }

            btnSave.prop('disabled', true).html(
                '<i class="spinner-border spinner-border-sm mr-1"></i> Menyimpan...');

            $.ajax({
                url: "{{ route('diagnosa-tindakan.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message || 'Data berhasil disimpan!');
                        $('#modalInputDiagnosa').modal('hide');

                        // Reload iframe Resume Medis
                        let iframe = $('#iframeResume');
                        if (iframe.length) {
                            // Menambahkan timestamp query agar browser tidak memakai cache lama
                            let currentUrl = iframe.attr('src').split('?')[0];
                            iframe.attr('src', currentUrl + '?t=' + new Date().getTime());
                        }
                    } else {
                        alert(response.message || 'Terjadi kesalahan saat menyimpan data.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + '\n';
                        });
                        alert('Validasi Gagal:\n' + errorMessages);
                    } else {
                        alert('Terjadi kesalahan sistem (' + xhr.status +
                            '). Silakan coba lagi.');
                    }
                },
                complete: function() {
                    btnSave.prop('disabled', false).html(
                        '<i class="bi bi-save mr-1"></i> Simpan Diagnosa & Prosedur');
                }
            });
        });

        // 7. Hapus Item Tersimpan via AJAX
        $(document).on('click', '.btn-delete-item', function(e) {
            e.preventDefault();

            let btn = $(this);
            let url = btn.data('url');
            let rowId = btn.data('row');

            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                return;
            }
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        $(rowId).fadeOut(400, function() {
                            let tbody = $(this).closest('tbody');
                            $(this).remove();
                            let iframe = $('#iframeResume');
                            if (iframe.length) {
                                // Menambahkan timestamp query agar browser tidak memakai cache lama
                                let currentUrl = iframe.attr('src').split('?')[0];
                                iframe.attr('src', currentUrl + '?t=' + new Date()
                                    .getTime());
                            }
                            if (tbody.find('tr').length === 0) {
                                tbody.html(`
                                    <tr class="empty-row">
                                        <td colspan="4" class="text-center text-muted">Belum ada data tersimpan.</td>
                                    </tr>
                                `);
                            }
                        });
                    } else {
                        alert(response.message || 'Gagal menghapus data.');
                        btn.prop('disabled', false).html(
                            '<i class="fas fa-trash-alt"></i>');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 419) {
                        alert(
                            'Sesi Anda telah berakhir (CSRF token expired). Silakan muat ulang halaman.'
                        );
                    } else {
                        alert('Terjadi kesalahan saat menghapus data (' + xhr.status +
                            ').');
                    }
                    btn.prop('disabled', false).html('<i class="fas fa-trash-alt"></i>');
                }
            });
        });

    });
    $(document).ready(function() {
        ambildiagnosautama()
        ambildiagnosasekunder()
        ambil_tindakan_prosedur()
        ambil_tindakan_op()
        ambil_tindakan_penunjang()
        // Event ketika tombol Simpan di dalam card-footer diklik
        $('.card-footer .btn-success').on('click', function(e) {
            e.preventDefault(); // Mencegah form melakukan submit standar (reload halaman)

            var $btn = $(this);
            $btn.prop('disabled', true).text('Menyimpan...'); // Ubah teks tombol saat loading

            // Mengambil semua data dari dalam form dengan class .formcoding
            var formData = $('.formcoding').serialize();

            // Lakukan request AJAX ke Laravel
            $.ajax({
                url: "{{ route('diagnosa-tindakan.store') }}", // Sesuaikan dengan route simpan Anda
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content') // Keamanan CSRF Laravel
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message || 'Data berhasil disimpan!');
                        $('#modalInputDiagnosa').modal('hide');
                        ambildiagnosautama()
                        ambildiagnosasekunder()
                        ambil_tindakan_prosedur()
                        ambil_tindakan_op()
                        ambil_tindakan_penunjang()
                        // Reload iframe Resume Medis
                        let iframe = $('#iframeResume');
                        if (iframe.length) {
                            // Menambahkan timestamp query agar browser tidak memakai cache lama
                            let currentUrl = iframe.attr('src').split('?')[0];
                            iframe.attr('src', currentUrl + '?t=' + new Date().getTime());
                        }
                    } else {
                        alert(response.message || 'Terjadi kesalahan saat menyimpan data.');
                    }
                    // if (response.status === 'success' || response.code === 200) {
                    //     alert('Data resume medis berhasil disimpan!');
                    //     // Opsi: Redirect atau reload halaman jika diperlukan
                    //     // location.reload();
                    // } else {
                    //     alert('Gagal menyimpan data: ' + (response.message ||
                    //         'Terjadi kesalahan.'));
                    // }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validasi error dari Laravel
                        var errors = xhr.responseJSON.errors;
                        var errorString = '';
                        $.each(errors, function(key, value) {
                            errorString += '- ' + value[0] + '\n';
                        });
                        alert('Validasi Gagal:\n' + errorString);
                    } else {
                        alert('Terjadi kesalahan pada server. Silakan coba lagi.');
                    }
                },
                complete: function() {
                    // Kembalikan tombol ke kondisi semula
                    $btn.prop('disabled', false).text('Simpan');
                }
            });
        });
    });

    function ambildiagnosautama() {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambil_diagnosa_utama_tersimpan') ?>',
            success: function(response) {
                $('.v_diag_utama_tersimpan').html(response);
                spinner.hide()
            },
            error: function(response) {
                spinner.hide()
            }
        });
    }

    function ambildiagnosasekunder() {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambil_diagnosa_sekunder_tersimpan') ?>',
            success: function(response) {
                $('.v_diag_sekunder_tersimpan').html(response);
                spinner.hide()
            },
            error: function(response) {
                spinner.hide()
            }
        });
    }

    function ambil_tindakan_prosedur() {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambil_tindakan_prosedur') ?>',
            success: function(response) {
                $('.v_diag_prosedur').html(response);
                spinner.hide()
            },
            error: function(response) {
                spinner.hide()
            }
        });
    }

    function ambil_tindakan_op() {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambil_tindakan_op') ?>',
            success: function(response) {
                $('.v_diag_tindakan_op').html(response);
                spinner.hide()
            },
            error: function(response) {
                spinner.hide()
            }
        });
    }

    function ambil_tindakan_penunjang() {
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('ambil_tindakan_penunjang') ?>',
            success: function(response) {
                $('.v_diag_tindakan_penunjang').html(response);
                spinner.hide()
            },
            error: function(response) {
                spinner.hide()
            }
        });
    }
</script>
