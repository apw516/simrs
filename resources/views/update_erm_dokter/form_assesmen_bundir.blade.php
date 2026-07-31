{{-- <div class="card card-outline card-danger shadow-sm">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 font-weight-bold">
            <i class="fas fa-exclamation-triangle mr-2"></i> ASESMEN KHUSUS RISIKO BUNUH DIRI ( INPATIENT SUICIDE / SELF
            - HARM ASSESMENT )
        </h5>
    </div>

    <form action="" method="POST" id="formAsesmenBunuhDiri">
        @csrf
        <div class="card-body">
            <!-- Informasi Skrining Awal -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="form-label font-weight-bold">Sumber Informasi</label>
                        <select name="sumber_informasi" class="form-control form-control-sm">
                            <option value="Pasien (Autoanamnesis)">Pasien (Autoanamnesis)</option>
                            <option value="Keluarga / Pengantar (Alloanamnesis)">Keluarga / Pengantar (Alloanamnesis)
                            </option>
                            <option value="Petugas Medis">Petugas Medis / Rujukan</option>
                        </select>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-3">
            <!-- Tabel Pertanyaan Skrining (1 Bulan / 1 Minggu Terakhir) -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 45%;" class="text-left">Apakah pengobatan yang sekarang diakibatkan karena
                                percobaan bunuh diri ?</th>

                            <th style="width: 15%;" class="text-center">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-xs btn-outline-secondary opt-q">
                                        <input type="radio" name="q1" value="0" class="hitung-skor"
                                            required> Tidak ( Skor : 1 )
                                    </label>
                                    <label class="btn btn-xs btn-outline-danger opt-q">
                                        <input type="radio" name="q1" value="1" class="hitung-skor"> Ya (
                                        Skor : 2)
                                    </label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 15%;" class="text-center">I. Faktor Kunci</th>
                            <th style="width: 5%;">Skor</th>
                            <th style="width: 45%;" class="text-center">Indikator</th>
                            <th style="width: 15%;" class="text-center">Skor / Risiko</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Pertanyaan 1 -->
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">1. KOMITMEN UNTUK KESELAMATAN</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan1"
                                        id="inlineRadio1" value="option1">
                                </div>
                                Menolak membuat komitmen/tidak mampu membuat komitmen karena ketidak mampuan menilai (
                                Halusinasi, delusi, demensia, delirium, disosiasi)
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan1"
                                        id="inlineRadio1" value="option1">
                                </div>
                                Mampu membuat komitmen tapi ragu - ragu dalam membuatnya
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan1"
                                        id="inlineRadio1" value="option1" checked>
                                </div>
                                Mampu membuat komitmen untuk keselamatan dengan jelas
                            </td>
                        </tr>
                        <!-- Pertanyaan 1 -->
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">2. RENCANA BUNUH DIRI</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan2"
                                        id="inlineRadio1" value="option1">
                                </div>Merencanakan secara aktual ide bunuh diri dan sudah mengungkapkan metode/cara
                                bunuh diri
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan2"
                                        id="inlineRadio1" value="option1">
                                </div>Merencanakan secara aktual ide bunuh diri tapi belum ada
                                cara bunuh diri
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan2"
                                        id="inlineRadio1" value="option1" checked>
                                </div>Tidak ada rencana
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">3. RENCANA YANG MEMATIKAN (
                                TOTALITAS RENCANA )</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan3"
                                        id="inlineRadio1" value="option1">
                                </div> Letalitas rencana yang tinggi ( dengan senapan, gantung diri, melompat tebing,
                                dan
                                korban dioksida)
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan3"
                                        id="inlineRadio1" value="option1">
                                </div> Letalitas rencana yang sedang (dengan pil tidur,
                                overdosis, aspirin, dan barbiturat)
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan3"
                                        id="inlineRadio1" value="option1" checked>
                                </div> Letalitas rencana yang rendah ( menggarukan kuku ke
                                kulit membenturkan kepala ke pintu, mengancam dengan benda tajam, menutup kepala dengan
                                bantal )
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">4. RIWAYAT PERCOBAAN BUNUH DIRI (
                                TIDAK DIBATASI WAKTU )</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan4"
                                        id="inlineRadio1" value="option1">
                                </div> Riwayat percobaan dengan letalitas tinggi
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan4"
                                        id="inlineRadio1" value="option1">
                                </div> Riwayat percobaan dengan letalitas sedang
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan4"
                                        id="inlineRadio1" value="option1" checked>
                                </div> Tidak ada riwayat percobaan
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">5. IDE BUNUH DIRI</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan5"
                                        id="inlineRadio1" value="option1">
                                </div> Pikiran bunuh diri terus menerus
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan5"
                                        id="inlineRadio1" value="option1">
                                </div> Pikiran bunuh diri sesekali atau singkat
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan5"
                                        id="inlineRadio1" value="option1" checked>
                                </div> Tidak ada pikiran bunuh diri
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">6. GEJALA ( a. Putus asa , b.
                                Tidak berdaya , C.Anhedonia, d. rasa bersalah/malu, e. kemarahan , f. Impulsivitas)</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan6"
                                        id="inlineRadio1" value="option1">
                                </div>Terdapat 5-6 gejala
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan6"
                                        id="inlineRadio1" value="option1">
                                </div>Terdapat 3-4 gejala
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan6"
                                        id="inlineRadio1" value="option1" checked>
                                </div>Terdapat 0 - 2 gejala
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">7. PIKIRAN KEMATIAN SAAT INI (
                                Berfantasi yang berlebihan, selalu berbicara tentang kematian )</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan7"
                                        id="inlineRadio1" value="option1">
                                </div>Terus menerus
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan7"
                                        id="inlineRadio1" value="option1">
                                </div>Sering
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan7"
                                        id="inlineRadio1" value="option1" checked>
                                </div>Jarang
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-center font-weight-bold">8. PENILAIAN PEMERIKSAAN TERHADAP
                                VALIDASI JAWABAN PASIEN</td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Tinggi</td>
                            <td class="align-middle">2</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan8"
                                        id="inlineRadio1" value="option1">
                                </div>Jawaban tidak dapat dipercaya tetapi beberapa syarat
                                menunjukan perilaku resiko bunuh diri ditemukan
                            </td>
                            <td rowspan="3" class="text-left align-middle font-weight-bold text-muted score-val" id="score-q1">-
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Resiko Sedang</td>
                            <td class="align-middle">1</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan8"
                                        id="inlineRadio1" value="option1">
                                </div>Jawaban atas pertanyaan pasien bisa dipercaya, terdapat
                                sedikitnya isyarat risiko bunuh diri
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada resiko</td>
                            <td class="align-middle">0 </td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan8"
                                        id="inlineRadio1" value="option1" checked>
                                </div>Jawab pasien dapat dipercaya
                            </td>
                        </tr>
                         <tr>
                            <td colspan="3" class="text-center font-weight-bold">TOTAL SKOR</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>Interval Pengawasan</td>
                            <td>Ruang Perawatan</td>
                        </tr>
                        <tr>
                            <td rowspan="3">II. Kunci Skoring</td>
                            <td width="20%">Resiko tinggi jika skor 10+</td>
                            <td>Tiap 1 jam</td>
                            <td rowspan="3">Ruang Perawatan <br> Intensif Psikiatri</td>
                        </tr>
                        <tr>
                            <td>Resiko tinggi jika skor 10+</td>
                            <td>Tiap 1 jam</td>
                           
                        </tr>
                        <tr>
                            <td>Resiko tinggi jika skor 10+</td>
                            <td>Tiap 1 jam</td>
                            
                        </tr>
                    </tbody>
                </table>
            </div>          
        </div>
        <div class="card-footer text-right bg-white border-top p-2">
            <button type="reset" class="btn btn-sm btn-secondary mr-2" id="btnReset">
                <i class="fas fa-undo mr-1"></i> Reset
            </button>
            <button type="submit" class="btn btn-sm btn-danger font-weight-bold">
                <i class="fas fa-save mr-1"></i> Simpan Asesmen
            </button>
        </div>
    </form>
</div>

<!-- JavaScript Logika Penilaian Risiko -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const radios = document.querySelectorAll('.hitung-skor');

        radios.forEach(radio => {
            radio.addEventListener('change', hitungRisiko);
        });

        function hitungRisiko() {
            let maxScore = 0;
            let answeredCount = 0;

            for (let i = 1; i <= 6; i++) {
                const selected = document.querySelector(`input[name="q${i}"]:checked`);
                const scoreCell = document.getElementById(`score-q${i}`);

                if (selected) {
                    answeredCount++;
                    let val = parseInt(selected.value);
                    scoreCell.innerText = val > 0 ? `+${val}` : '0';
                    if (val > maxScore) {
                        maxScore = val;
                    }
                }
            }

            const badge = document.getElementById('badgeRisiko');
            const listTindakan = document.getElementById('listTindakan');
            const inputTingkat = document.getElementById('inputTingkatRisiko');

            if (answeredCount < 6) {
                badge.className = "badge badge-secondary p-2";
                badge.innerText = `LENGKAPI SEMUA PERTANYAAN (${answeredCount}/6)`;
                return;
            }

            // Kategori Risiko berdasarkan Nilai Tertinggi
            if (maxScore >= 4) {
                // RISIKO TINGGI (MERAH)
                badge.className = "badge badge-danger p-2";
                badge.innerText = "RISIKO TINGGI (HIGH RISK)";
                inputTingkat.value = "Tinggi";
                listTindakan.innerHTML = `
                    <li class="text-danger font-weight-bold">Pasang Gelang Identifikasi Kuning (Risiko Jatuh/Bahaya) & Akses Khusus.</li>
                    <li class="text-danger font-weight-bold">Konsul Cepat Spesialis Jiwa / Psikiatri.</li>
                    <li>Pengawasan ketat 1:1 (Observasi terus menerus, tidak boleh ditinggal sendiri).</li>
                    <li>Jauhkan semua benda berbahaya (silet, tali, kassa, obat-obatan berlebih, alat makan tajam).</li>
                `;
            } else if (maxScore >= 1 && maxScore <= 3) {
                // RISIKO SEDANG (KUNING)
                badge.className = "badge badge-warning p-2 text-dark";
                badge.innerText = "RISIKO SEDANG (MODERATE RISK)";
                inputTingkat.value = "Sedang";
                listTindakan.innerHTML = `
                    <li class="text-dark font-weight-bold">Konsultasi Poliklinik Spesialis Jiwa / Psikolog.</li>
                    <li>Edukasi keluarga untuk pendampingan rutin.</li>
                    <li>Amankan benda-benda berpotensi berbahaya dari jangkauan pasien.</li>
                    <li>Observasi kondisi mental berkala (tiap shift).</li>
                `;
            } else {
                // RISIKO RENDAH (HIJAU)
                badge.className = "badge badge-success p-2";
                badge.innerText = "RISIKO RENDAH (LOW RISK)";
                inputTingkat.value = "Rendah";
                listTindakan.innerHTML = `
                    <li class="text-success">Tindakan medis standar sesuai keluhan utama.</li>
                    <li>Berikan dukungan psikologis standar & edukasi keluarga.</li>
                `;
            }
        }
    });
</script> --}}
<div class="card card-outline card-danger shadow-sm">
    <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 font-weight-bold">
            <i class="fas fa-exclamation-triangle mr-2"></i> ASESMEN KHUSUS RISIKO BUNUH DIRI ( INPATIENT SUICIDE / SELF
            - HARM ASSESSMENT )
        </h5>
    </div>

    <form action="" method="POST" id="formAsesmenBunuhDiri">
        @csrf
        <div class="card-body">
            <!-- Informasi Skrining Awal -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="form-label font-weight-bold">Sumber Informasi</label>
                        <select name="sumber_informasi" class="form-control form-control-sm">
                            <option value="Pasien (Autoanamnesis)">Pasien (Autoanamnesis)</option>
                            <option value="Keluarga / Pengantar (Alloanamnesis)">Keluarga / Pengantar (Alloanamnesis)
                            </option>
                            <option value="Petugas Medis">Petugas Medis / Rujukan</option>
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
                                    <label class="btn btn-xs btn-outline-secondary opt-q">
                                        <input type="radio" name="q_skrining" value="1" class="hitung-skor"
                                            required> Tidak (Skor: 1)
                                    </label>
                                    <label class="btn btn-xs btn-outline-danger opt-q">
                                        <input type="radio" name="q_skrining" value="2" class="hitung-skor"> Ya
                                        (Skor: 2)
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
                                        id="p1_2" value="2">
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
                                        id="p1_1" value="1">
                                </div>
                                <label for="p1_1" class="mb-0 font-weight-normal">Mampu membuat komitmen tapi ragu -
                                    ragu dalam membuatnya</label>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left align-middle">Tidak ada risiko</td>
                            <td class="text-center align-middle">0</td>
                            <td class="text-left align-middle">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input hitung-skor" type="radio" name="pertanyaan1"
                                        id="p1_0" value="0" checked>
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
                                        id="p2_2" value="2">
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
                                        id="p2_1" value="1">
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
                                        id="p2_0" value="0" checked>
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
                                        id="p3_2" value="2">
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
                                        id="p3_1" value="1">
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
                                        id="p3_0" value="0" checked>
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
                                        id="p4_2" value="2">
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
                                        id="p4_1" value="1">
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
                                        id="p4_0" value="0" checked>
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
                                        id="p5_2" value="2">
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
                                        id="p5_1" value="1">
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
                                        id="p5_0" value="0" checked>
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
                                        id="p6_2" value="2">
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
                                        id="p6_1" value="1">
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
                                        id="p6_0" value="0" checked>
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
                                        id="p7_2" value="2">
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
                                        id="p7_1" value="1">
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
                                        id="p7_0" value="0" checked>
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
                                        id="p8_2" value="2">
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
                                        id="p8_1" value="1">
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
                                        id="p8_0" value="0" checked>
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
            <button type="reset" class="btn btn-sm btn-secondary mr-2" id="btnReset">
                <i class="fas fa-undo mr-1"></i> Reset
            </button>
            <button type="submit" class="btn btn-sm btn-danger font-weight-bold">
                <i class="fas fa-save mr-1"></i> Simpan Asesmen
            </button>
        </div>
    </form>
</div>

<!-- JavaScript Logika Penilaian Risiko -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnReset = document.getElementById('btnReset');

        // 1. Perhitungan awal saat halaman dimuat
        hitungRisiko();

        // 2. Event Delegation untuk mendeteksi perubahan pada SEMUA radio button .hitung-skor
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('hitung-skor')) {
                hitungRisiko();
            }
        });

        // 3. Jika menggunakan Bootstrap Button Toggle, tangkap juga event click/change pada label/btn
        // agar sinkronisasi class 'active' Bootstrap tidak menghambat nilai input
        $(document).on('change', '.hitung-skor', function() {
            hitungRisiko();
        });

        // 4. Event listener saat tombol reset diklik
        if (btnReset) {
            btnReset.addEventListener('click', function() {
                setTimeout(hitungRisiko, 100);
            });
        }

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
                        scoreCell.innerText = 0;
                    }
                }
            }

            // 3. Tampilkan Total Skor Akumulasi
            const totalScoreCell = document.getElementById('totalScore');
            if (totalScoreCell) {
                totalScoreCell.innerText = totalSkor;
            }
        }
    });
</script>
