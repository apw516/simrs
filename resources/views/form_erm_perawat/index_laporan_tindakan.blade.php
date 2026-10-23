<div class="card">
    {{-- <div class="card-header">Laporan Tindakan</div> --}}
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <div @if (auth()->user()->unit != '1045' && auth()->user()->unit != '1019' ) hidden @endif class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-dark text-bold collapsed" type="button"
                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne">
                            Hasil Pemeriksaan Mikroskopik / Endoskopi Telinga
                        </button>
                    </h2>
                    <a hidden href="{{ route('cetak.laporantelinga', $kode_kunjungan ?? '') }}" target="_blank"
                        class="btn btn-sm btn-secondary text-nowrap ml-2">
                        <i class="fas fa-print"></i> Cetak PDF
                    </a>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="formLaporanTelinga">
                            <!-- Hidden Input untuk Identifikasi Data -->
                            <input type="hidden" name="kode_kunjungan" value="{{ $kode_kunjungan }}">
                            <input type="hidden" name="id_laporan" value="{{ $get_data->id ?? '' }}">
                            <input type="hidden" id="id_dokter" name="id_dokter"
                                value="{{ $formData['id_dokter'] ?? '' }}">

                            <table class="table table-bordered mb-3">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th style="width: 20%;">TELINGA</th>
                                        <th style="width: 40%;">Kanan</th>
                                        <th style="width: 40%;">Kiri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- LIANG TELINGA -->
                                    <tr>
                                        <td class="font-weight-bold">Liang Telinga</td>
                                        <!-- KANAN -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $k_lt =$formData['kanan_liang_telinga'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Lapang" id="k_lt_lapang"
                                                            {{ in_array('Lapang', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_lt_lapang">Lapang</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Sempit" id="k_lt_sempit"
                                                            {{ in_array('Sempit', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_lt_sempit">Sempit</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Serumen"
                                                            id="k_lt_serumen"
                                                            {{ in_array('Serumen', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_lt_serumen">Serumen</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Sekret" id="k_lt_sekret"
                                                            {{ in_array('Sekret', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_lt_sekret">Sekret</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Jamur" id="k_lt_jamur"
                                                            {{ in_array('Jamur', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_lt_jamur">Jamur</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Destruksi"
                                                            id="k_lt_destruksi"
                                                            {{ in_array('Destruksi', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_lt_destruksi">Destruksi</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Kolesteatoma"
                                                            id="k_lt_kolesteatoma"
                                                            {{ in_array('Kolesteatoma', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_lt_kolesteatoma">Kolesteatoma</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Massa / jaringan"
                                                            id="k_lt_massa"
                                                            {{ in_array('Massa / jaringan', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_lt_massa">Massa /
                                                            jaringan</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_liang_telinga[]" value="Benda asing"
                                                            id="k_lt_benda"
                                                            {{ in_array('Benda asing', $k_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_lt_benda">Benda
                                                            asing</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline mt-1">
                                                <div class="form-check mr-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="kanan_liang_telinga[]" value="Lain-lain"
                                                        id="k_lt_lain_check"
                                                        {{ in_array('Lain-lain', $k_lt) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="k_lt_lain_check">Lain-lain
                                                        :</label>
                                                </div>
                                                <input type="text" name="kanan_liang_telinga_lain"
                                                    value="{{ $formData['kanan_liang_telinga_lain'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                        </td>
                                        <!-- KIRI -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $ki_lt =$formData['kiri_liang_telinga'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Lapang"
                                                            id="ki_lt_lapang"
                                                            {{ in_array('Lapang', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_lapang">Lapang</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Sempit"
                                                            id="ki_lt_sempit"
                                                            {{ in_array('Sempit', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_sempit">Sempit</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Serumen"
                                                            id="ki_lt_serumen"
                                                            {{ in_array('Serumen', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_serumen">Serumen</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Sekret"
                                                            id="ki_lt_sekret"
                                                            {{ in_array('Sekret', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_sekret">Sekret</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Jamur"
                                                            id="ki_lt_jamur"
                                                            {{ in_array('Jamur', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_jamur">Jamur</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Destruksi"
                                                            id="ki_lt_destruksi"
                                                            {{ in_array('Destruksi', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_destruksi">Destruksi</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Kolesteatoma"
                                                            id="ki_lt_kolesteatoma"
                                                            {{ in_array('Kolesteatoma', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_lt_kolesteatoma">Kolesteatoma</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Massa / jaringan"
                                                            id="ki_lt_massa"
                                                            {{ in_array('Massa / jaringan', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_lt_massa">Massa /
                                                            jaringan</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_liang_telinga[]" value="Benda asing"
                                                            id="ki_lt_benda"
                                                            {{ in_array('Benda asing', $ki_lt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_lt_benda">Benda
                                                            asing</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline mt-1">
                                                <div class="form-check mr-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="kiri_liang_telinga[]" value="Lain-lain"
                                                        id="ki_lt_lain_check"
                                                        {{ in_array('Lain-lain', $ki_lt) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ki_lt_lain_check">Lain-lain
                                                        :</label>
                                                </div>
                                                <input type="text" name="kiri_liang_telinga_lain"
                                                    value="{{ $formData['kiri_liang_telinga_lain'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MEMBRAN TIMPANI -->
                                    <tr>
                                        <td class="font-weight-bold">Membran Timpani</td>
                                        <!-- KANAN -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $k_mt =$formData['kanan_membran_timpani'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Intak"
                                                            id="k_mt_intak"
                                                            {{ in_array('Intak', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_mt_intak">Intak</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Normal"
                                                            id="k_mt_normal"
                                                            {{ in_array('Normal', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_normal">Normal</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Hiperemis"
                                                            id="k_mt_hiperemis"
                                                            {{ in_array('Hiperemis', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_hiperemis">Hiperemis</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Bulging"
                                                            id="k_mt_bulging"
                                                            {{ in_array('Bulging', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_bulging">Bulging</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Retraksi"
                                                            id="k_mt_retraksi"
                                                            {{ in_array('Retraksi', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_retraksi">Retraksi</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Sklerotik"
                                                            id="k_mt_sklerotik"
                                                            {{ in_array('Sklerotik', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_sklerotik">Sklerotik</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Perforasi"
                                                            id="k_mt_perforasi"
                                                            {{ in_array('Perforasi', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_perforasi">Perforasi:</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Sentral"
                                                            id="k_mt_sentral"
                                                            {{ in_array('Sentral', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_sentral">Sentral</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Atik"
                                                            id="k_mt_atik"
                                                            {{ in_array('Atik', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_mt_atik">Atik</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_membran_timpani[]" value="Marginal"
                                                            id="k_mt_marginal"
                                                            {{ in_array('Marginal', $k_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mt_marginal">Marginal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline mt-1">
                                                <div class="form-check mr-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="kanan_membran_timpani[]" value="Lain-lain"
                                                        id="k_mt_lain_check"
                                                        {{ in_array('Lain-lain', $k_mt) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="k_mt_lain_check">Lain-lain
                                                        :</label>
                                                </div>
                                                <input type="text" name="kanan_membran_timpani_lain"
                                                    value="{{ $formData['kanan_membran_timpani_lain'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                        </td>
                                        <!-- KIRI -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $ki_mt =$formData['kiri_membran_timpani'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Intak"
                                                            id="ki_mt_intak"
                                                            {{ in_array('Intak', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_intak">Intak</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Normal"
                                                            id="ki_mt_normal"
                                                            {{ in_array('Normal', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_normal">Normal</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Hiperemis"
                                                            id="ki_mt_hiperemis"
                                                            {{ in_array('Hiperemis', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_hiperemis">Hiperemis</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Bulging"
                                                            id="ki_mt_bulging"
                                                            {{ in_array('Bulging', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_bulging">Bulging</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Retraksi"
                                                            id="ki_mt_retraksi"
                                                            {{ in_array('Retraksi', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_retraksi">Retraksi</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Sklerotik"
                                                            id="ki_mt_sklerotik"
                                                            {{ in_array('Sklerotik', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_sklerotik">Sklerotik</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Perforasi"
                                                            id="ki_mt_perforasi"
                                                            {{ in_array('Perforasi', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_perforasi">Perforasi:</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Sentral"
                                                            id="ki_mt_sentral"
                                                            {{ in_array('Sentral', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_sentral">Sentral</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Atik"
                                                            id="ki_mt_atik"
                                                            {{ in_array('Atik', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_mt_atik">Atik</label>
                                                    </div>
                                                    <div class="form-check pl-4">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_membran_timpani[]" value="Marginal"
                                                            id="ki_mt_marginal"
                                                            {{ in_array('Marginal', $ki_mt) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mt_marginal">Marginal</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-inline mt-1">
                                                <div class="form-check mr-1">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="kiri_membran_timpani[]" value="Lain-lain"
                                                        id="ki_mt_lain_check"
                                                        {{ in_array('Lain-lain', $ki_mt) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="ki_mt_lain_check">Lain-lain
                                                        :</label>
                                                </div>
                                                <input type="text" name="kiri_membran_timpani_lain"
                                                    value="{{ $formData['kiri_membran_timpani_lain'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- KAVUM TIMPANI -->
                                    <tr>
                                        <td class="font-weight-bold">Kavum Timpani</td>
                                        <td>
                                            <div class="form-inline mb-1">
                                                <label class="mr-1">Mukosa :</label>
                                                <input type="text" name="kanan_kavum_mukosa"
                                                    value="{{ $formData['kanan_kavum_mukosa'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                            <div class="form-inline mb-1">
                                                <label class="mr-1">Osikel :</label>
                                                <input type="text" name="kanan_kavum_osikel"
                                                    value="{{ $formData['kanan_kavum_osikel'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                            <div>
                                                <label class="mb-0">Isthmus Timpani / anterior timpani / posterior
                                                    timpani :</label>
                                                <input type="text" name="kanan_kavum_isthmus"
                                                    value="{{ $formData['kanan_kavum_isthmus'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input w-100 mt-1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-inline mb-1">
                                                <label class="mr-1">Mukosa :</label>
                                                <input type="text" name="kiri_kavum_mukosa"
                                                    value="{{ $formData['kiri_kavum_mukosa'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                            <div class="form-inline mb-1">
                                                <label class="mr-1">Osikel :</label>
                                                <input type="text" name="kiri_kavum_osikel"
                                                    value="{{ $formData['kiri_kavum_osikel'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input flex-grow-1">
                                            </div>
                                            <div>
                                                <label class="mb-0">Isthmus Timpani / anterior timpani / posterior
                                                    timpani :</label>
                                                <input type="text" name="kiri_kavum_isthmus"
                                                    value="{{ $formData['kiri_kavum_isthmus'] ?? '' }}"
                                                    class="form-control form-control-sm underline-input w-100 mt-1">
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- LAIN - LAIN -->
                                    <tr>
                                        <td class="font-weight-bold">Lain - Lain</td>
                                        <td>
                                            <textarea name="kanan_lain_lain" class="form-control underline-input" rows="2">{{ $formData['kanan_lain_lain'] ?? '' }}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="kiri_lain_lain" class="form-control underline-input" rows="2">{{ $formData['kiri_lain_lain'] ?? '' }}</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- KESIMPULAN & ANJURAN -->
                            <div class="form-group row mb-2">
                                <label class="col-sm-2 col-form-label font-weight-bold">KESIMPULAN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kesimpulan"
                                        value="{{ $formData['kesimpulan'] ?? '' }}"
                                        class="form-control underline-input">
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label font-weight-bold">ANJURAN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="anjuran" value="{{ $formData['anjuran'] ?? '' }}"
                                        class="form-control underline-input">
                                </div>
                            </div>

                            <!-- FOOTER / TANDA TANGAN -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <small class="text-muted"><i class="far fa-check-square"></i> Beri tanda ✓ pada
                                        kotak pilihan</small>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="mb-1">Cirebon, <input type="text" name="tanggal_pemeriksaan"
                                            value="{{ $formData['tanggal_pemeriksaan'] ?? '' }}"
                                            class="underline-input text-center" style="width: 150px;"
                                            placeholder="Tanggal Pemeriksaan"></p>
                                    <div style="height: 30px;"></div>

                                    <!-- Autocomplete Search Container -->
                                    <div class="position-relative px-3">
                                        <!-- Input Text untuk Pencarian -->
                                        <input type="text" id="search_dokter"
                                            value="{{ $mt_paramedis->nama_paramedis }}"
                                            class="form-control form-control-sm text-center underline-input font-weight-bold"
                                            placeholder="Ketik nama dokter/paramedis..." autocomplete="off">

                                        <!-- Dropdown Hasil AJAX -->
                                        <div id="list_dokter" class="dropdown-menu w-100 shadow-sm"
                                            style="max-height: 160px; overflow-y: auto; display: none; position: absolute; z-index: 1000;">
                                        </div>
                                    </div>

                                    <small class="text-muted mt-1 d-block">Dokter Pemeriksa</small>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan1()">Simpan</button>
                    </div>
                </div>
            </div>
            <div @if (auth()->user()->unit != '1045' && auth()->user()->unit != '1019' ) hidden @endif class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-dark text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                            Hasil Pemeriksaan Nasoendoskopi / Endoskopi Hidung
                        </button>
                    </h2>
                    <a hidden href="{{ route('cetak.laporanhidung', $kode_kunjungan ?? '') }}" target="_blank"
                        class="btn btn-sm btn-secondary text-nowrap ml-2">
                        <i class="fas fa-print"></i> Cetak PDF
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="formLaporanHidung">
                            <!-- Hidden Input untuk Identifikasi Data -->
                            <input type="hidden" name="kode_kunjungan" value="{{ $kode_kunjungan ?? '' }}">
                            <input type="hidden" name="id_laporan" value="{{ $get_data_hidung->id ?? '' }}">
                            <input type="hidden" id="id_dokter_hidung" name="id_dokter"
                                value="{{ $formData_hidung['id_dokter'] ?? '' }}">

                            <table class="table table-bordered mb-3">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th style="width: 20%;">HIDUNG</th>
                                        <th style="width: 40%;">Kanan</th>
                                        <th style="width: 40%;">Kiri</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- KAVUM NASI -->
                                    <tr>
                                        <td class="font-weight-bold">Kavum Nasi</td>
                                        <!-- KANAN -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $k_kn =$formData_hidung['kanan_kavum_nasi'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Lapang" id="k_kn_lapang"
                                                            {{ in_array('Lapang', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_kn_lapang">Lapang</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Sempit" id="k_kn_sempit"
                                                            {{ in_array('Sempit', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_kn_sempit">Sempit</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Mukosa edema"
                                                            id="k_kn_edema"
                                                            {{ in_array('Mukosa edema', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_kn_edema">Mukosa
                                                            edema</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Mukosa pucat"
                                                            id="k_kn_pucat"
                                                            {{ in_array('Mukosa pucat', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_kn_pucat">Mukosa
                                                            pucat</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Mukosa hiperemis"
                                                            id="k_kn_hiperemis"
                                                            {{ in_array('Mukosa hiperemis', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_kn_hiperemis">Mukosa
                                                            hiperemis</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Massa" id="k_kn_massa"
                                                            {{ in_array('Massa', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_kn_massa">Massa</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_kavum_nasi[]" value="Polip" id="k_kn_polip"
                                                            {{ in_array('Polip', $k_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_kn_polip">Polip</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- KIRI -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $ki_kn =$formData_hidung['kiri_kavum_nasi'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Lapang" id="ki_kn_lapang"
                                                            {{ in_array('Lapang', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_kn_lapang">Lapang</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Sempit" id="ki_kn_sempit"
                                                            {{ in_array('Sempit', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_kn_sempit">Sempit</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Mukosa edema"
                                                            id="ki_kn_edema"
                                                            {{ in_array('Mukosa edema', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_kn_edema">Mukosa
                                                            edema</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Mukosa pucat"
                                                            id="ki_kn_pucat"
                                                            {{ in_array('Mukosa pucat', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_kn_pucat">Mukosa
                                                            pucat</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Mukosa hiperemis"
                                                            id="ki_kn_hiperemis"
                                                            {{ in_array('Mukosa hiperemis', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_kn_hiperemis">Mukosa
                                                            hiperemis</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Massa" id="ki_kn_massa"
                                                            {{ in_array('Massa', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_kn_massa">Massa</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_kavum_nasi[]" value="Polip" id="ki_kn_polip"
                                                            {{ in_array('Polip', $ki_kn) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_kn_polip">Polip</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- KONKA INFERIOR -->
                                    <tr>
                                        <td class="font-weight-bold">Konka Inferior</td>
                                        <!-- KANAN -->
                                        <td>
                                            @php $k_ki =$formData_hidung['kanan_konka_inferior'] ?? []; @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    name="kanan_konka_inferior[]" value="Eutrofi" id="k_ki_eutrofi"
                                                    {{ in_array('Eutrofi', $k_ki) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="k_ki_eutrofi">Eutrofi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    name="kanan_konka_inferior[]" value="Hipertrofi"
                                                    id="k_ki_hipertrofi"
                                                    {{ in_array('Hipertrofi', $k_ki) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="k_ki_hipertrofi">Hipertrofi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    name="kanan_konka_inferior[]" value="Atrofi" id="k_ki_atrofi"
                                                    {{ in_array('Atrofi', $k_ki) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="k_ki_atrofi">Atrofi</label>
                                            </div>
                                        </td>
                                        <!-- KIRI -->
                                        <td>
                                            @php $ki_ki =$formData_hidung['kiri_konka_inferior'] ?? []; @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    name="kiri_konka_inferior[]" value="Eutrofi" id="ki_ki_eutrofi"
                                                    {{ in_array('Eutrofi', $ki_ki) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="ki_ki_eutrofi">Eutrofi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    name="kiri_konka_inferior[]" value="Hipertrofi"
                                                    id="ki_ki_hipertrofi"
                                                    {{ in_array('Hipertrofi', $ki_ki) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="ki_ki_hipertrofi">Hipertrofi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox"
                                                    name="kiri_konka_inferior[]" value="Atrofi" id="ki_ki_atrofi"
                                                    {{ in_array('Atrofi', $ki_ki) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="ki_ki_atrofi">Atrofi</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MEATUS MEDIUS -->
                                    <tr>
                                        <td class="font-weight-bold">Meatus Medius</td>
                                        <!-- KANAN -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $k_mm =$formData_hidung['kanan_meatus_medius'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_meatus_medius[]" value="Terbuka"
                                                            id="k_mm_terbuka"
                                                            {{ in_array('Terbuka', $k_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mm_terbuka">Terbuka</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_meatus_medius[]" value="Tertutup"
                                                            id="k_mm_tertutup"
                                                            {{ in_array('Tertutup', $k_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mm_tertutup">Tertutup</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_meatus_medius[]" value="Mukosa edema"
                                                            id="k_mm_edema"
                                                            {{ in_array('Mukosa edema', $k_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_mm_edema">Mukosa
                                                            edema</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_meatus_medius[]" value="Polip"
                                                            id="k_mm_polip"
                                                            {{ in_array('Polip', $k_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_mm_polip">Polip</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_meatus_medius[]" value="Sekret"
                                                            id="k_mm_sekret"
                                                            {{ in_array('Sekret', $k_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="k_mm_sekret">Sekret</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kanan_meatus_medius[]" value="Spina"
                                                            id="k_mm_spina"
                                                            {{ in_array('Spina', $k_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="k_mm_spina">Spina</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <!-- KIRI -->
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    @php $ki_mm =$formData_hidung['kiri_meatus_medius'] ?? []; @endphp
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_meatus_medius[]" value="Terbuka"
                                                            id="ki_mm_terbuka"
                                                            {{ in_array('Terbuka', $ki_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mm_terbuka">Terbuka</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_meatus_medius[]" value="Tertutup"
                                                            id="ki_mm_tertutup"
                                                            {{ in_array('Tertutup', $ki_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mm_tertutup">Tertutup</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_meatus_medius[]" value="Mukosa edema"
                                                            id="ki_mm_edema"
                                                            {{ in_array('Mukosa edema', $ki_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="ki_mm_edema">Mukosa
                                                            edema</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_meatus_medius[]" value="Polip"
                                                            id="ki_mm_polip"
                                                            {{ in_array('Polip', $ki_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mm_polip">Polip</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_meatus_medius[]" value="Sekret"
                                                            id="ki_mm_sekret"
                                                            {{ in_array('Sekret', $ki_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mm_sekret">Sekret</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="kiri_meatus_medius[]" value="Spina"
                                                            id="ki_mm_spina"
                                                            {{ in_array('Spina', $ki_mm) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="ki_mm_spina">Spina</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- SEPTUM -->
                                    <tr>
                                        <td class="font-weight-bold">Septum</td>
                                        <td colspan="2">
                                            @php $septum =$formData_hidung['septum'] ?? []; @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="septum[]"
                                                    value="Lurus" id="septum_lurus"
                                                    {{ in_array('Lurus', $septum) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="septum_lurus">Lurus</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="septum[]"
                                                    value="Deviasi" id="septum_deviasi"
                                                    {{ in_array('Deviasi', $septum) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="septum_deviasi">Deviasi</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- NASOFARING -->
                                    <tr>
                                        <td class="font-weight-bold">Nasofaring</td>
                                        <td colspan="2">
                                            @php $nasofaring =$formData_hidung['nasofaring'] ?? []; @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="nasofaring[]"
                                                    value="Normal" id="naso_normal"
                                                    {{ in_array('Normal', $nasofaring) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="naso_normal">Normal</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="nasofaring[]"
                                                    value="Adenoid" id="naso_adenoid"
                                                    {{ in_array('Adenoid', $nasofaring) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="naso_adenoid">Adenoid</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="nasofaring[]"
                                                    value="Keradangan" id="naso_keradangan"
                                                    {{ in_array('Keradangan', $nasofaring) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="naso_keradangan">Keradangan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="nasofaring[]"
                                                    value="Massa" id="naso_massa"
                                                    {{ in_array('Massa', $nasofaring) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="naso_massa">Massa</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- LAIN - LAIN -->
                                    <tr>
                                        <td class="font-weight-bold">Lain-lain</td>
                                        <td>
                                            <textarea name="kanan_lain_lain" class="form-control underline-input" rows="2"
                                                placeholder="Keterangan lain kanan...">{{ $formData_hidung['kanan_lain_lain'] ?? '' }}</textarea>
                                        </td>
                                        <td>
                                            <textarea name="kiri_lain_lain" class="form-control underline-input" rows="2"
                                                placeholder="Keterangan lain kiri...">{{ $formData_hidung['kiri_lain_lain'] ?? '' }}</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- KESIMPULAN -->
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label font-weight-bold">KESIMPULAN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kesimpulan"
                                        value="{{ $formData_hidung['kesimpulan'] ?? '' }}"
                                        class="form-control underline-input">
                                </div>
                            </div>

                            <!-- FOOTER / TANDA TANGAN -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <small class="text-muted"><i class="far fa-check-square"></i> Beri tanda ✓ pada
                                        kotak pilihan</small>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="mb-1">Cirebon, <input type="text" name="tanggal_pemeriksaan"
                                            value="{{ $formData_hidung['tanggal_pemeriksaan'] ?? '' }}"
                                            class="underline-input text-center" style="width: 150px;"
                                            placeholder="Tanggal Pemeriksaan"></p>
                                    <div style="height: 30px;"></div>

                                    <!-- Autocomplete Search Container -->
                                    <div class="position-relative px-3">
                                        <input type="text" id="search_dokter_hidung"
                                            value="{{ $mt_paramedis->nama_paramedis }}"
                                            class="form-control form-control-sm text-center underline-input font-weight-bold"
                                            placeholder="Ketik nama dokter/paramedis..." autocomplete="off">
                                        <div id="list_dokter_hidung" class="dropdown-menu w-100 shadow-sm"
                                            style="max-height: 160px; overflow-y: auto; display: none; position: absolute; z-index: 1000;">
                                        </div>
                                    </div>
                                    <small class="text-muted mt-1 d-block">Tanda tangan dan Nama jelas</small>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanLaporanHidung(this)">Simpan</button>
                    </div>
                </div>
            </div>
            <div @if (auth()->user()->unit != '1045' && auth()->user()->unit != '1019' ) hidden @endif class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-dark text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            Laporan Hasil Pemeriksaan Endoskopi THT-KL
                        </button>
                    </h2>
                    <a hidden href="{{ route('cetak.laporanendoskopitht', $kode_kunjungan ?? '') }}" target="_blank"
                        class="btn btn-sm btn-secondary text-nowrap ml-2">
                        <i class="fas fa-print"></i> Cetak PDF
                    </a>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <form id="formLaporanEndoskopiTht">
                            <!-- Hidden Input untuk Identifikasi Data -->
                            <input type="hidden" name="kode_kunjungan" value="{{ $kode_kunjungan ?? '' }}">
                            <input type="hidden" name="id_laporan" value="{{ $get_data_tht->id ?? '' }}">
                            <input type="hidden" id="id_dokter_tht" name="id_dokter"
                                value="{{ $formData_tht['id_dokter'] ?? '' }}">

                            <!-- TABEL PEMERIKSAAN ENDOSKOPI THT-KL -->
                            <table class="table table-bordered table-sm mb-3">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th style="width: 35%;">KOMPONEN PEMERIKSAAN</th>
                                        <th style="width: 65%;">URAIAN / HASIL PEMERIKSAAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- 1. KANALIS & TELINGA / BAGIAN AWAL -->
                                    <tr>
                                        <td class="font-weight-bold">Kanalis akustikus externus</td>
                                        <td>
                                            <input type="text" name="kanalis_akustikus"
                                                value="{{ $formData_tht['kanalis_akustikus'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan kanalis...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Sekret (Telinga)</td>
                                        <td>
                                            <input type="text" name="sekret_telinga"
                                                value="{{ $formData_tht['sekret_telinga'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan sekret...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Serumen</td>
                                        <td>
                                            <input type="text" name="serumen"
                                                value="{{ $formData_tht['serumen'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan serumen...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Membran Timpani</td>
                                        <td>
                                            <input type="text" name="membran_timpani"
                                                value="{{ $formData_tht['membran_timpani'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan membran timpani...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Mukosa</td>
                                        <td>
                                            <input type="text" name="mukosa"
                                                value="{{ $formData_tht['mukosa'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan mukosa...">
                                        </td>
                                    </tr>

                                    <!-- 2. HIDUNG & NASOFARING -->
                                    <tr>
                                        <td class="font-weight-bold">Konka Inferior</td>
                                        <td>
                                            <input type="text" name="konka_inferior"
                                                value="{{ $formData_tht['konka_inferior'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan konka inferior...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Konka Media</td>
                                        <td>
                                            <input type="text" name="konka_media"
                                                value="{{ $formData_tht['konka_media'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan konka media...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Ostium Sinus Maxila</td>
                                        <td>
                                            <input type="text" name="ostium_sinus_maxila"
                                                value="{{ $formData_tht['ostium_sinus_maxila'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan ostium sinus maxila...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Septum Nasi</td>
                                        <td>
                                            <input type="text" name="septum_nasi"
                                                value="{{ $formData_tht['septum_nasi'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan septum nasi...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Sekret (Hidung)</td>
                                        <td>
                                            <input type="text" name="sekret_hidung"
                                                value="{{ $formData_tht['sekret_hidung'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan sekret hidung...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Dinding Posterior & Lateral</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <input type="text" name="dinding_posterior"
                                                        value="{{ $formData_tht['dinding_posterior'] ?? '' }}"
                                                        class="form-control form-control-sm underline-input"
                                                        placeholder="Dinding posterior">
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="dinding_lateral"
                                                        value="{{ $formData_tht['dinding_lateral'] ?? '' }}"
                                                        class="form-control form-control-sm underline-input"
                                                        placeholder="Dinding lateral">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Fossa Rosenmuller</td>
                                        <td>
                                            <input type="text" name="fossa_rosenmuller"
                                                value="{{ $formData_tht['fossa_rosenmuller'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan fossa rosenmuller...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Torus Tubarius</td>
                                        <td>
                                            <input type="text" name="torus_tubarius"
                                                value="{{ $formData_tht['torus_tubarius'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan torus tubarius...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tuba Eustachius</td>
                                        <td>
                                            <input type="text" name="tuba_eustachius"
                                                value="{{ $formData_tht['tuba_eustachius'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan tuba eustachius...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Adenoid</td>
                                        <td>
                                            <input type="text" name="adenoid"
                                                value="{{ $formData_tht['adenoid'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan adenoid...">
                                        </td>
                                    </tr>

                                    <!-- 3. OROFARING -->
                                    <tr>
                                        <td class="font-weight-bold">Arkus Faring</td>
                                        <td>
                                            <input type="text" name="arkus_faring"
                                                value="{{ $formData_tht['arkus_faring'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan arkus faring...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Uvula</td>
                                        <td>
                                            <input type="text" name="uvula"
                                                value="{{ $formData_tht['uvula'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan uvula...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Dinding Faring Posterior</td>
                                        <td>
                                            <input type="text" name="dinding_faring_posterior"
                                                value="{{ $formData_tht['dinding_faring_posterior'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan dinding faring posterior...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tonsil Palatina</td>
                                        <td>
                                            <input type="text" name="tonsil_palatina"
                                                value="{{ $formData_tht['tonsil_palatina'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan tonsil palatina...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Palatum</td>
                                        <td>
                                            <input type="text" name="palatum"
                                                value="{{ $formData_tht['palatum'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan palatum...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Post Nasal Drip</td>
                                        <td>
                                            <input type="text" name="post_nasal_drip"
                                                value="{{ $formData_tht['post_nasal_drip'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan post nasal drip...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tonsila Lingualis</td>
                                        <td>
                                            <input type="text" name="tonsila_lingualis"
                                                value="{{ $formData_tht['tonsila_lingualis'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan tonsila lingualis...">
                                        </td>
                                    </tr>

                                    <!-- 4. LARING -->
                                    <tr>
                                        <td class="font-weight-bold">Plica Ariepiglotika</td>
                                        <td>
                                            <input type="text" name="plica_ariepiglotika"
                                                value="{{ $formData_tht['plica_ariepiglotika'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan plica ariepiglotika...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Plica Vocalis</td>
                                        <td>
                                            <input type="text" name="plica_vocalis"
                                                value="{{ $formData_tht['plica_vocalis'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan plica vocalis...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Plica Ventrikularis</td>
                                        <td>
                                            <input type="text" name="plica_ventrikularis"
                                                value="{{ $formData_tht['plica_ventrikularis'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan plica ventrikularis...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Aritenoid</td>
                                        <td>
                                            <input type="text" name="aritenoid"
                                                value="{{ $formData_tht['aritenoid'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan aritenoid...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Fossa Piriformis</td>
                                        <td>
                                            <input type="text" name="fossa_piriformis"
                                                value="{{ $formData_tht['fossa_piriformis'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan fossa piriformis...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Trakea</td>
                                        <td>
                                            <input type="text" name="trakea"
                                                value="{{ $formData_tht['trakea'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan trakea...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Endolaring Sekret</td>
                                        <td>
                                            <input type="text" name="endolaring_sekret"
                                                value="{{ $formData_tht['endolaring_sekret'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan endolaring sekret...">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Granuloma</td>
                                        <td>
                                            <input type="text" name="granuloma"
                                                value="{{ $formData_tht['granuloma'] ?? '' }}"
                                                class="form-control form-control-sm underline-input"
                                                placeholder="Keterangan granuloma...">
                                        </td>
                                    </tr>

                                    <!-- 5. BIOPSI -->
                                    <tr>
                                        <td class="font-weight-bold">Tindakan Biopsi</td>
                                        <td>
                                            @php $biopsiVal =$formData_tht['status_biopsi'] ?? ''; @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="status_biopsi" value="Dilakukan" id="biopsi_ya"
                                                    {{ $biopsiVal == 'Dilakukan' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="biopsi_ya">Dilakukan</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="status_biopsi" value="Tidak Dilakukan" id="biopsi_tidak"
                                                    {{ $biopsiVal == 'Tidak Dilakukan' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="biopsi_tidak">Tidak
                                                    Dilakukan</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- KESIMPULAN & SARAN -->
                            <div class="form-group row mb-2">
                                <label class="col-sm-2 col-form-label font-weight-bold">KESIMPULAN</label>
                                <div class="col-sm-10">
                                    <textarea name="kesimpulan" class="form-control underline-input" rows="2"
                                        placeholder="Kesimpulan pemeriksaan...">{{ $formData_tht['kesimpulan'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label class="col-sm-2 col-form-label font-weight-bold">SARAN</label>
                                <div class="col-sm-10">
                                    <textarea name="saran" class="form-control underline-input" rows="2"
                                        placeholder="Saran / anjuran medis...">{{ $formData_tht['saran'] ?? '' }}</textarea>
                                </div>
                            </div>

                            <!-- FOOTER / TANDA TANGAN -->
                            <div class="row mt-4">
                                <div class="col-6">
                                    <small class="text-muted"><i class="far fa-check-square"></i> Laporan hasil
                                        pemeriksaan endoskopi THT-KL</small>
                                </div>
                                <div class="col-6 text-center">
                                    <p class="mb-1">Cirebon, <input type="text" name="tanggal_pemeriksaan"
                                            value="{{ $formData_tht['tanggal_pemeriksaan'] ?? '' }}"
                                            class="underline-input text-center" style="width: 150px;"
                                            placeholder="Tanggal Pemeriksaan"></p>
                                    <div style="height: 30px;"></div>

                                    <!-- Autocomplete Search Container -->
                                    <div class="position-relative px-3">
                                        <input type="text" id="search_dokter_tht"
                                            value="{{ $mt_paramedis->nama_paramedis }}"
                                            class="form-control form-control-sm text-center underline-input font-weight-bold"
                                            placeholder="Ketik nama dokter/paramedis..." autocomplete="off">

                                        <div id="list_dokter_tht" class="dropdown-menu w-100 shadow-sm"
                                            style="max-height: 160px; overflow-y: auto; display: none; position: absolute; z-index: 1000;">
                                        </div>
                                    </div>

                                    <small class="text-muted mt-1 d-block">Tanda tangan dan Nama jelas[cite:
                                        2]</small>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success" onclick="simpanLaporanEndoskopiTht(this)">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="v_lp">
            
        </div>
    </div>
</div>
<script>
    function initAutocompleteDokter() {
        const searchInput = document.getElementById('search_dokter');
        const listContainer = document.getElementById('list_dokter');
        const hiddenIdInput = document.getElementById('id_dokter');
        let debounceTimer;

        if (!searchInput || !listContainer || !hiddenIdInput) return;

        const newInput = searchInput.cloneNode(true);
        searchInput.parentNode.replaceChild(newInput, searchInput);

        const activeSearchInput = document.getElementById('search_dokter');
        const activeHiddenIdInput = document.getElementById('id_dokter');
        const activeListContainer = document.getElementById('list_dokter');

        activeSearchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            let keyword = this.value.trim();
            activeHiddenIdInput.value = '';

            if (keyword.length < 2) {
                activeListContainer.style.display = 'none';
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`caridoktertindakan?q=${encodeURIComponent(keyword)}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        activeListContainer.innerHTML = '';
                        if (data && data.length > 0) {
                            data.forEach(item => {
                                let itemA = document.createElement('a');
                                itemA.className = 'dropdown-item';
                                itemA.href = '#';

                                let namaParamedis = item.nama_paramedis || item.nama;
                                let kodeParamedis = item.kode_paramedis || item.id;

                                itemA.innerText = namaParamedis;
                                itemA.onclick = function(e) {
                                    e.preventDefault();
                                    activeSearchInput.value = namaParamedis;
                                    activeHiddenIdInput.value = kodeParamedis;
                                    activeListContainer.style.display = 'none';
                                };
                                activeListContainer.appendChild(itemA);
                            });
                            activeListContainer.style.display = 'block';
                        } else {
                            activeListContainer.innerHTML =
                                '<span class="dropdown-item text-muted">Dokter/Paramedis tidak ditemukan</span>';
                            activeListContainer.style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }, 300);
        });
    }

    function simpanlaporan1() {
        const formElement = document.getElementById('formLaporanTelinga');
        const formData = new FormData(formElement);

        // Tambahkan value input pencarian teks dokter ke formData agar ikut tersimpan di JSON
        const searchDokterVal = document.getElementById('search_dokter').value;
        formData.append('search_dokter', searchDokterVal);

        const btnSimpan = document.querySelector('#collapseOne .card-footer .btn-success');
        let originalText = btnSimpan.innerText;
        btnSimpan.disabled = true;
        btnSimpan.innerText = 'Menyimpan...';

        fetch("{{ route('simpanlaporantelinga') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Sukses: ' + data.message);
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada jaringan atau server.');
            })
            .finally(() => {
                btnSimpan.disabled = false;
                btnSimpan.innerText = originalText;
            });
    }

    // Inisialisasi saat halaman/DOM siap
    document.addEventListener("DOMContentLoaded", function() {
        initAutocompleteDokter();
    });

    // Inisialisasi ulang jika accordion dibuka
    $('#collapseOne').on('shown.bs.collapse', function() {
        initAutocompleteDokter();
    });

    // Global click listener untuk menutup dropdown autocomplete
    document.addEventListener('click', function(e) {
        const searchInput = document.getElementById('search_dokter');
        const listContainer = document.getElementById('list_dokter');
        if (searchInput && listContainer) {
            if (!searchInput.contains(e.target) && !listContainer.contains(e.target)) {
                listContainer.style.display = 'none';
            }
        }
    });
</script>
<script>
    function simpanLaporanHidung(btn) {
        const formElement = document.getElementById('formLaporanHidung');
        const formData = new FormData(formElement);

        // Ambil nilai input pencarian dokter manual
        const searchDokter = document.getElementById('search_dokter_hidung');
        if (searchDokter) {
            formData.append('search_dokter', searchDokter.value);
        }

        // Gunakan parameter 'btn' yang dikirim dari HTML langsung
        let originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch("{{ route('simpanlaporanhidung') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Sukses: ' + data.message);
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada jaringan atau server.');
            })
            .finally(() => {
                // Kembalikan tombol seperti semula
                btn.disabled = false;
                btn.innerText = originalText;
            });
    }

    function initAutocompleteDokterHidung() {
        const searchInput = document.getElementById('search_dokter_hidung');
        const listContainer = document.getElementById('list_dokter_hidung');
        const hiddenIdInput = document.getElementById('id_dokter_hidung');
        let debounceTimer;

        if (!searchInput || !listContainer || !hiddenIdInput) return;

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            let keyword = this.value.trim();
            hiddenIdInput.value = '';

            if (keyword.length < 2) {
                listContainer.style.display = 'none';
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`caridoktertindakan?q=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        listContainer.innerHTML = '';
                        if (data && data.length > 0) {
                            data.forEach(item => {
                                let itemA = document.createElement('a');
                                itemA.className = 'dropdown-item';
                                itemA.href = '#';

                                let namaParamedis = item.nama_paramedis || item.nama;
                                let kodeParamedis = item.kode_paramedis || item.id;

                                itemA.innerText = namaParamedis;
                                itemA.onclick = function(e) {
                                    e.preventDefault();
                                    searchInput.value = namaParamedis;
                                    hiddenIdInput.value = kodeParamedis;
                                    listContainer.style.display = 'none';
                                };
                                listContainer.appendChild(itemA);
                            });
                            listContainer.style.display = 'block';
                        } else {
                            listContainer.innerHTML =
                                '<span class="dropdown-item text-muted">Tidak ditemukan</span>';
                            listContainer.style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }, 300);
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        initAutocompleteDokterHidung();
    });
    $('#collapseTwo').on('shown.bs.collapse', function() {
        initAutocompleteDokterHidung();
    });
    // Global click untuk menutup dropdown autocomplete jika diklik di luar
    document.addEventListener('click', function(e) {
        const searchInput = document.getElementById('search_dokter_hidung');
        const listContainer = document.getElementById('list_dokter_hidung');
        if (searchInput && listContainer) {
            if (!searchInput.contains(e.target) && !listContainer.contains(e.target)) {
                listContainer.style.display = 'none';
            }
        }
    });
</script>
<script>
    function initAutocompleteDokterTht() {
        const searchInput = document.getElementById('search_dokter_tht');
        const listContainer = document.getElementById('list_dokter_tht');
        const hiddenIdInput = document.getElementById('id_dokter_tht');
        let debounceTimer;

        if (!searchInput || !listContainer || !hiddenIdInput) return;

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            let keyword = this.value.trim();
            hiddenIdInput.value = '';

            if (keyword.length < 2) {
                listContainer.style.display = 'none';
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`caridoktertindakan?q=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        listContainer.innerHTML = '';
                        if (data && data.length > 0) {
                            data.forEach(item => {
                                let itemA = document.createElement('a');
                                itemA.className = 'dropdown-item';
                                itemA.href = '#';

                                let namaParamedis = item.nama_paramedis || item.nama;
                                let kodeParamedis = item.kode_paramedis || item.id;

                                itemA.innerText = namaParamedis;
                                itemA.onclick = function(e) {
                                    e.preventDefault();
                                    searchInput.value = namaParamedis;
                                    hiddenIdInput.value = kodeParamedis;
                                    listContainer.style.display = 'none';
                                };
                                listContainer.appendChild(itemA);
                            });
                            listContainer.style.display = 'block';
                        } else {
                            listContainer.innerHTML =
                                '<span class="dropdown-item text-muted">Dokter tidak ditemukan</span>';
                            listContainer.style.display = 'block';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }, 300);
        });
    }

    function simpanLaporanEndoskopiTht(btn) {
        const formElement = document.getElementById('formLaporanEndoskopiTht');
        const formData = new FormData(formElement);

        const searchDokter = document.getElementById('search_dokter_tht');
        if (searchDokter) {
            formData.append('search_dokter', searchDokter.value);
        }

        let originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch("{{ route('simpanlaporanendoskopitht') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Sukses: ' + data.message);
                } else {
                    alert('Gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan pada jaringan atau server.');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = originalText;
            });
    }

    document.addEventListener("DOMContentLoaded", function() {
        initAutocompleteDokterTht();
    });
    $('#collapseThree').on('shown.bs.collapse', function() {
        initAutocompleteDokterTht();
    });
    document.addEventListener('click', function(e) {
        const searchInput = document.getElementById('search_dokter_tht');
        const listContainer = document.getElementById('list_dokter_tht');
        if (searchInput && listContainer) {
            if (!searchInput.contains(e.target) && !listContainer.contains(e.target)) {
                listContainer.style.display = 'none';
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        laporanoperasi()
    })
    function laporanoperasi() {
        rm = $('#nomorrm').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kodekunjungan
            },
            url: '<?= route('formlaporanoperasimata') ?>',
            success: function(response) {
                $('.v_lp').html(response);
                spinner.hide()
            }
        });
    }
</script>
