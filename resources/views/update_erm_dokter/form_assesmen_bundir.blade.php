<div class="card card-outline card-danger shadow-sm">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 font-weight-bold">
            <i class="fas fa-exclamation-triangle mr-2"></i> ASESMEN KHUSUS RISIKO BUNUH DIRI ( INPATIENT SUICIDE / SELF
            - HARM ASSESSMENT )
        </h5>
    </div>
    <form class="formAsesmenBunuhDiri" id="formAsesmenBunuhDiri">
        <div class="card-body">
            @if ($asesmen)
                @php
                    // Hitung total skor dari field asesmen
                    $skor1 = $asesmen->pertanyaan1 ?? 0;
                    $skor2 = $asesmen->pertanyaan2 ?? 0;
                    $skor3 = $asesmen->pertanyaan3 ?? 0;
                    $skor4 = $asesmen->pertanyaan4 ?? 0;
                    $skor5 = $asesmen->pertanyaan5 ?? 0;
                    $skor6 = $asesmen->pertanyaan6 ?? 0;
                    $skor7 = $asesmen->pertanyaan7 ?? 0;
                    $skor8 = $asesmen->pertanyaan8 ?? 0;
                    $skor9 = $asesmen->q_skrining ?? 0;

                    $skor = $skor1 + $skor2 + $skor3 + $skor4 + $skor5 + $skor6 + $skor7 + $skor8 + $skor9;

                    // Tema & warna dinamis sesuai kriteria skor
                    if ($skor >= 10) {
                        $tingkatRisiko = 'Risiko Tinggi';
                        $themeClass = 'danger';
                        $badgeColor = 'bg-danger text-white';
                        $iconClass = 'bi-exclamation-triangle-fill';
                        $interval = 'Pengawasan tiap 1 jam';
                    } elseif ($skor >= 4 && $skor <= 9) {
                        $tingkatRisiko = 'Risiko Sedang';
                        $themeClass = 'warning';
                        $badgeColor = 'bg-warning text-dark';
                        $iconClass = 'bi-exclamation-shield-fill';
                        $interval = 'Pengawasan tiap 2 - 7 jam';
                    } else {
                        $tingkatRisiko = 'Risiko Rendah';
                        $themeClass = 'success';
                        $badgeColor = 'bg-success text-white';
                        $iconClass = 'bi-shield-check';
                        $interval = 'Pengawasan tiap 8 jam';
                    }
                @endphp

                <div
                    class="card border-0 border-start border-{{ $themeClass }} border-4 shadow-sm rounded-3 mb-3 bg-{{ $themeClass }} bg-opacity-10">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <!-- Sisi Kiri: Icon, Title, & Tanggal Entry -->
                            <div class="d-flex align-items-center">
                                <div class="bg-{{ $themeClass }} bg-opacity-25 text-{{ $themeClass }} rounded-circle p-2 me-3 d-flex align-items-center justify-content-center flex-shrink-0"
                                    style="width: 48px; height: 48px;">
                                    <i class="bi {{ $iconClass }} fs-4"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                                        <strong class="text-dark">Asesmen Risiko Bunuh Diri</strong>
                                        <span class="badge bg-light text-dark border">Inpatient Suicide /
                                            Self-Harm</span>
                                    </div>
                                    <small class="text-light d-block">
                                        <i class="bi bi-clock me-1"></i>Terakhir diisi:
                                        <span class="fw-semibold text-light">
                                            {{ \Carbon\Carbon::parse($asesmen->tgl_entry)->translatedFormat('d F Y, H:i') }}
                                            WIB
                                        </span>
                                    </small>
                                </div>
                            </div>
                            <!-- Sisi Kanan: Total Skor, Level Risiko, & Action Button -->
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <!-- Total Skor Box -->
                                <div class="bg-white px-3 py-1 rounded-3 border shadow-sm text-center">
                                    <small class="text-muted d-block uppercase fw-bold"
                                        style="font-size: 0.7rem; letter-spacing: 0.5px;">SKOR</small>
                                    <span class="fw-bold fs-5 text-{{ $themeClass }}">{{ $skor }}</span>
                                </div>
                                <!-- Badge & Interval Pengawasan -->
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge {{ $badgeColor }} px-2 py-1 fs-6 align-self-start shadow-sm">
                                        <i class="bi bi-shield-exclamation me-1"></i>{{ $tingkatRisiko }}
                                    </span>
                                    <small class="text-light fw-medium">
                                        <i
                                            class="bi bi-arrow-repeat me-1 text-{{ $themeClass }}"></i>{{ $interval }}
                                    </small>
                                </div>
                                <!-- Tombol Lihat Asesmen -->
                                <a class="btn btn-sm btn-info text-{{ $themeClass == 'warning' ? 'dark' : 'white' }} fw-semibold shadow-sm ms-lg-2 cetakassesmenbunuhdiri"
                                    kode_assesmen="{{ $asesmen->id }}">
                                    <i class="bi bi-printer me-1"></i> Print
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            @endif
            <!-- Hidden Inputs -->
            <input hidden type="text" value="{{ $kunjungan[0]->kode_kunjungan ?? '' }}" name="kode_kunjungan">
            <input hidden type="text" value="{{ $rm ?? '' }}" name="nomor_rm">
            <!-- Informasi Skrining Awal -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="form-label font-weight-bold">Sumber Informasi</label>
                        <select name="sumber_informasi" class="form-control form-control-sm">
                            <option value="Pasien (Autoanamnesis)"
                                {{ ($asesmen->sumber_informasi ?? '') == 'Pasien (Autoanamnesis)' ? 'selected' : '' }}>
                                Pasien (Autoanamnesis)</option>
                            <option value="Keluarga / Pengantar (Alloanamnesis)"
                                {{ ($asesmen->sumber_informasi ?? '') == 'Keluarga / Pengantar (Alloanamnesis)' ? 'selected' : '' }}>
                                Keluarga / Pengantar (Alloanamnesis)</option>
                            <option value="Petugas Medis"
                                {{ ($asesmen->sumber_informasi ?? '') == 'Petugas Medis' ? 'selected' : '' }}>Petugas
                                Medis / Rujukan</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-3">

            <!-- Tabel Skrining Awal -->
            <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 70%;" class="text-left">Apakah pengobatan yang sekarang diakibatkan karena
                                percobaan bunuh diri ?</th>
                            <th style="width: 30%;" class="text-center">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label
                                        class="btn btn-xs btn-outline-secondary opt-q {{ ($asesmen->q_skrining ?? '1') == '1' ? 'active' : '' }}">
                                        <input type="radio" name="q_skrining" value="1" class="hitung-skor"
                                            required {{ ($asesmen->q_skrining ?? '1') == '1' ? 'checked' : '' }}> Tidak
                                        (Skor: 1)
                                    </label>
                                    <label
                                        class="btn btn-xs btn-outline-danger opt-q {{ ($asesmen->q_skrining ?? '') == '2' ? 'active' : '' }}">
                                        <input type="radio" name="q_skrining" value="2" class="hitung-skor"
                                            {{ ($asesmen->q_skrining ?? '') == '2' ? 'checked' : '' }}> Ya (Skor: 2)
                                    </label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>

            <!-- Tabel Faktor Kunci (8 Indikator) -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 15%;" class="text-center">I. Faktor Kunci</th>
                            <th style="width: 10%;" class="text-center">Skor Poin</th>
                            <th style="width: 60%;" class="text-center">Indikator</th>
                            <th style="width: 15%;" class="text-center">Skor Terpilih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Pertanyaan 1 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">1. KOMITMEN UNTUK KESELAMATAN</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan1"
                                        id="p1_2" value="2"
                                        {{ ($asesmen->pertanyaan1 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p1_2" class="mb-0 font-weight-normal">Menolak membuat komitmen/tidak
                                    mampu membuat komitmen karena ketidakmampuan menilai (Halusinasi, delusi, demensia,
                                    delirium, disosiasi)</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q1">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan1"
                                        id="p1_1" value="1"
                                        {{ ($asesmen->pertanyaan1 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p1_1" class="mb-0 font-weight-normal">Mampu membuat komitmen tapi ragu
                                    -
                                    ragu dalam membuatnya</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan1"
                                        id="p1_0" value="0"
                                        {{ ($asesmen->pertanyaan1 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p1_0" class="mb-0 font-weight-normal">Mampu membuat komitmen untuk
                                    keselamatan dengan jelas</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 2 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">2. RENCANA BUNUH DIRI</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan2"
                                        id="p2_2" value="2"
                                        {{ ($asesmen->pertanyaan2 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p2_2" class="mb-0 font-weight-normal">Merencanakan secara aktual ide
                                    bunuh diri dan sudah mengungkapkan metode/cara bunuh diri</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q2">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan2"
                                        id="p2_1" value="1"
                                        {{ ($asesmen->pertanyaan2 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p2_1" class="mb-0 font-weight-normal">Merencanakan secara aktual ide
                                    bunuh diri tapi belum ada cara bunuh diri</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan2"
                                        id="p2_0" value="0"
                                        {{ ($asesmen->pertanyaan2 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p2_0" class="mb-0 font-weight-normal">Tidak ada rencana</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 3 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">3. RENCANA YANG MEMATIKAN (TOTALITAS
                                RENCANA)</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan3"
                                        id="p3_2" value="2"
                                        {{ ($asesmen->pertanyaan3 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p3_2" class="mb-0 font-weight-normal">Letalitas rencana yang tinggi
                                    (dengan senapan, gantung diri, melompat tebing, karbon monoksida)</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q3">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan3"
                                        id="p3_1" value="1"
                                        {{ ($asesmen->pertanyaan3 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p3_1" class="mb-0 font-weight-normal">Letalitas rencana yang sedang
                                    (dengan pil tidur, overdosis, aspirin, dan barbiturat)</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan3"
                                        id="p3_0" value="0"
                                        {{ ($asesmen->pertanyaan3 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p3_0" class="mb-0 font-weight-normal">Letalitas rencana yang rendah
                                    (menggarukkan kuku ke kulit, membenturkan kepala ke pintu, mengancam dengan benda
                                    tajam, menutup kepala dengan bantal)</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 4 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">4. RIWAYAT PERCOBAAN BUNUH DIRI
                                (TIDAK DIBATASI WAKTU)</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan4"
                                        id="p4_2" value="2"
                                        {{ ($asesmen->pertanyaan4 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p4_2" class="mb-0 font-weight-normal">Riwayat percobaan dengan
                                    letalitas tinggi</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q4">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan4"
                                        id="p4_1" value="1"
                                        {{ ($asesmen->pertanyaan4 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p4_1" class="mb-0 font-weight-normal">Riwayat percobaan dengan
                                    letalitas sedang</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan4"
                                        id="p4_0" value="0"
                                        {{ ($asesmen->pertanyaan4 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p4_0" class="mb-0 font-weight-normal">Tidak ada riwayat
                                    percobaan</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 5 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">5. IDE BUNUH DIRI</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan5"
                                        id="p5_2" value="2"
                                        {{ ($asesmen->pertanyaan5 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p5_2" class="mb-0 font-weight-normal">Pikiran bunuh diri terus
                                    menerus</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q5">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan5"
                                        id="p5_1" value="1"
                                        {{ ($asesmen->pertanyaan5 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p5_1" class="mb-0 font-weight-normal">Pikiran bunuh diri sesekali atau
                                    singkat</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan5"
                                        id="p5_0" value="0"
                                        {{ ($asesmen->pertanyaan5 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p5_0" class="mb-0 font-weight-normal">Tidak ada pikiran bunuh
                                    diri</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 6 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">6. GEJALA (a. Putus asa, b. Tidak
                                berdaya, c. Anhedonia, d. Rasa bersalah/malu, e. Kemarahan, f. Impulsivitas)</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan6"
                                        id="p6_2" value="2"
                                        {{ ($asesmen->pertanyaan6 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p6_2" class="mb-0 font-weight-normal">Terdapat 5-6 gejala</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q6">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan6"
                                        id="p6_1" value="1"
                                        {{ ($asesmen->pertanyaan6 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p6_1" class="mb-0 font-weight-normal">Terdapat 3-4 gejala</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan6"
                                        id="p6_0" value="0"
                                        {{ ($asesmen->pertanyaan6 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p6_0" class="mb-0 font-weight-normal">Terdapat 0 - 2 gejala</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 7 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">7. PIKIRAN KEMATIAN SAAT INI
                                (Berfantasi yang berlebihan, selalu berbicara tentang kematian)</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan7"
                                        id="p7_2" value="2"
                                        {{ ($asesmen->pertanyaan7 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p7_2" class="mb-0 font-weight-normal">Terus menerus</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q7">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan7"
                                        id="p7_1" value="1"
                                        {{ ($asesmen->pertanyaan7 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p7_1" class="mb-0 font-weight-normal">Sering</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan7"
                                        id="p7_0" value="0"
                                        {{ ($asesmen->pertanyaan7 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p7_0" class="mb-0 font-weight-normal">Jarang</label>
                            </td>
                        </tr>

                        <!-- Pertanyaan 8 -->
                        <tr>
                            <td colspan="4" class="bg-light font-weight-bold">8. PENILAIAN PEMERIKSAAN TERHADAP
                                VALIDASI JAWABAN PASIEN</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Tinggi</td>
                            <td class="text-center align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan8"
                                        id="p8_2" value="2"
                                        {{ ($asesmen->pertanyaan8 ?? '') == '2' ? 'checked' : '' }}>
                                </div>
                                <label for="p8_2" class="mb-0 font-weight-normal">Jawaban tidak dapat dipercaya
                                    tetapi beberapa syarat menunjukan perilaku resiko bunuh diri ditemukan</label>
                            </td>
                            <td rowspan="3" class="text-center align-middle font-weight-bold text-primary h5"
                                id="score-q8">0</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Risiko Sedang</td>
                            <td class="text-center align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan8"
                                        id="p8_1" value="1"
                                        {{ ($asesmen->pertanyaan8 ?? '') == '1' ? 'checked' : '' }}>
                                </div>
                                <label for="p8_1" class="mb-0 font-weight-normal">Jawaban atas pertanyaan pasien
                                    bisa dipercaya, terdapat sedikitnya isyarat risiko bunuh diri</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan8"
                                        id="p8_0" value="0"
                                        {{ ($asesmen->pertanyaan8 ?? '0') == '0' ? 'checked' : '' }}>
                                </div>
                                <label for="p8_0" class="mb-0 font-weight-normal">Jawaban pasien dapat
                                    dipercaya</label>
                            </td>
                        </tr>

                        <!-- Baris Total Skor -->
                        <tr class="bg-secondary text-white">
                            <td colspan="3" class="text-right font-weight-bold align-middle">TOTAL SKOR KESELURUHAN
                                :</td>
                            <td class="text-center font-weight-bold h4 mb-0 text-warning" id="totalScore">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-right bg-white border-top p-2">
            <button type="button" id="btnSimpanAsesmen" class="btn btn-primary" onclick="simpanassesmenbundir()">
                <i class="fas fa-save"></i> Simpan Asesmen
            </button>
        </div>
    </form>
</div>
<!-- JavaScript Logika Penilaian Risiko (Pure Vanilla JS) -->
<script>
    (function() {
        // Fungsi utama perhitungan skor
        function hitungRisiko() {
            let totalSkor = 0;

            // 1. Hitung Pertanyaan Skrining Awal
            const skriningSelected = document.querySelector('input[name="q_skrining"]:checked');
            if (skriningSelected) {
                totalSkor += parseInt(skriningSelected.value, 10) || 0;
            }

            // 2. Loop melalui 8 Pertanyaan Indikator
            for (let i = 1; i <= 8; i++) {
                const selected = document.querySelector(`input[name="pertanyaan${i}"]:checked`);
                const scoreCell = document.getElementById(`score-q${i}`);

                if (scoreCell) {
                    if (selected) {
                        let val = parseInt(selected.value, 10) || 0;
                        scoreCell.innerText = val;
                        totalSkor += val;
                    } else {
                        scoreCell.innerText = '0';
                    }
                }
            }

            // 3. Tampilkan Total Skor Akumulasi
            const totalScoreCell = document.getElementById('totalScore');
            if (totalScoreCell) {
                totalScoreCell.innerText = totalSkor;
            }
        }

        // Fungsi inisialisasi listener
        function initAsesmen() {
            const form = document.getElementById('formAsesmenBunuhDiri');
            if (!form) return;

            // 1. Perhitungan awal saat form dimuat
            hitungRisiko();

            // 2. Event Listener untuk perubahan radio button (Event Delegation pada form)
            form.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('hitung-skor')) {
                    hitungRisiko();
                }
            });

            // 3. Penanganan khusus klik tombol toggle Bootstrap
            form.addEventListener('click', function(e) {
                if (e.target && (e.target.classList.contains('opt-q') || e.target.closest('.opt-q'))) {
                    setTimeout(hitungRisiko, 50);
                }
            });

            // 4. Event Listener saat form di-reset
            form.addEventListener('reset', function() {
                setTimeout(hitungRisiko, 50);
            });
        }

        // Jalankan inisialisasi (Aman untuk AJAX/Modal/Page Load biasa)
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAsesmen);
        } else {
            initAsesmen();
        }
    })();
    $(".cetakassesmenbunuhdiri").on('click', function(event) {
        kode_assesmen = $(this).attr('kode_assesmen')
        window.open('cetakresumebunuhdiri/' + kode_assesmen);
    })
</script>
<script>
    function simpanassesmenbundir() {
        var dataisi = $('.formAsesmenBunuhDiri').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                dataisi: JSON.stringify(dataisi)
            },
            url: '<?= route('asesmen-bunuh-diri.store') ?>',
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
                    assesmenbundir()
                }
            }
        });
    }
</script>
