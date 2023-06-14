<div class="card">
    <div class="card-header bg-info">Resume</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if (count($resume) > 0)
            <table class="table table-sm">
                <tr>
                    <td>Sumber Data</td>
                    <td colspan="3">{{ $resume[0]->sumber_data }}</td>
                </tr>
                <tr>
                    <td>Keluhan Utama</td>
                    <td colspan="3">{{ $resume[0]->keluhan_pasien }}</td>
                </tr>
                <tr>
                    <td colspan="4">Tanda - Tanda Vital</td>
                </tr>
                <tr>
                    <td>Tekanan Darah</td>
                    <td>{{ $resume[0]->tekanan_darah }} mmHg</td>
                    <td>Frekuensi Nadi</td>
                    <td>{{ $resume[0]->frekuensi_nadi }} x/menit</td>
                </tr>
                <tr>
                    <td>Frekuensi Nafas</td>
                    <td>{{ $resume[0]->frekuensi_nafas }} x/menit</td>
                    <td>Suhu</td>
                    <td>{{ $resume[0]->suhu_tubuh }} °C</td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-info">Riwayat Kesehatan</td>
                </tr>
                <tr>
                    <td>Riwayat Kehamilan (bagi pasien wanita) </td>
                    <td colspan="3">{{ $resume[0]->riwayat_kehamilan_pasien_wanita }}</td>
                </tr>
                <tr>
                    <td>Riwayat Kelahiran (bagi pasien anak) </td>
                    <td colspan="3">{{ $resume[0]->riwyat_kelahiran_pasien_anak }}</td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Sekarang</td>
                    <td colspan="3">{{ $resume[0]->riwyat_penyakit_sekarang }}</td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Dahulu</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->hipertensi == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="hipertensi" name="hipertensi" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->kencingmanis == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="kencingmanis" name="kencingmanis" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->jantung == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="jantung" name="jantung" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->stroke == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="stroke" name="stroke" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->hepatitis == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="hepatitis" name="hepatitis" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->asthma == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="asthma" name="asthma" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->ginjal == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="ginjal" name="ginjal" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->tbparu == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="tb" name="tb" value="1">
                                    <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->riwayatlain == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="riwayatlain" name="riwayatlain" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Lain-lain</label>
                                </div>
                            </div>
                        </div>
                        <textarea readonly name="ketriwayatlain" id="ketriwayatlain" class="form-control" placeholder="keterangan lain - lain">{{ $resume[0]->ket_riwayatlain }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Alergi</td>
                    <td>{{ $resume[0]->riwayat_alergi }}</td>
                    <td>Keterangan</td>
                    <td>{{ $resume[0]->keterangan_alergi }}</td>
                </tr>
                <tr>
                    <td>Status Generalis</td>
                    <td colspan="3">{{ $resume[0]->statusgeneralis }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-info">Pemeriksaan Fisik</td>
                </tr>
                <tr>
                    <td colspan="4">{{ $resume[0]->pemeriksaan_fisik }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-info">Pemeriksaan Umum</td>
                </tr>
                <tr>
                    <td>Keadaan Umum</td>
                    <td colspan="3">{{ $resume[0]->keadaanumum }}</td>
                </tr>
                <tr>
                    <td>Kesadaran</td>
                    <td colspan="3">{{ $resume[0]->kesadaran }}</td>
                </tr>
                <tr>
                    <td>Diagnosa Kerja</td>
                    <td colspan="3">{{ $resume[0]->diagnosakerja }}</td>
                </tr>
                <tr>
                    <td>Diagnosa Banding</td>
                    <td colspan="3">{{ $resume[0]->diagnosabanding }}</td>
                </tr>
                <tr>
                    <td>Rencana Kerja</td>
                    <td colspan="3">{{ $resume[0]->rencanakerja }}</td>
                </tr>
                <tr>
                    <td>Tindakan Medis</td>
                    <td colspan="3">{{ $resume[0]->tindakanmedis }}</td>
                </tr>
                <tr>
                    <td>Tindak Lanjut</td>
                    <td colspan="3">{{ $resume[0]->tindak_lanjut }} | {{ $resume[0]->keterangan_tindak_lanjut }}</td>
                </tr>
            </table>
            @if ($formkhusus['keterangan'] == 'tht')
                <div class="row mt-2">
                    <div class="col-md-12">
                        <img src="{{ $resume[0]->gambar_1 }}" alt="">
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning">Telinga Kanan</div>
                            <div class="card-body">
                                @if ($formkhusus['cek1'] > 0)
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Liang Telinga</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Lapang" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_lapang == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Lapang
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Sempit" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Sempit == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Sempit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Destruksi" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_dataSetestruksi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Destruksi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Serumen" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Serumen == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Serumen</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Sekret" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Sekret</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Jamur" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Jamur</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Kolesteatoma" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Kolesteatoma</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Massa atau Jaringan" name="Kolesteatoma"
                                                                value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Massa_Jaringan == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Massa
                                                                atau
                                                                Jaringan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Benda Asing" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Benda_asing == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Benda
                                                                Asing</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="LT Lain-Lain" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->LT_Lain_lain == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">LT
                                                                Lain-Lain</label>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" name="ltketeranganlain"
                                                        value="{{ $formkhusus['telingakanan'][0]->LT_Keterangan_lain }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Membran Timpan</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Normal" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_intak_normal) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Normal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Hiperemis"
                                                                value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_intak_hiperemis) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Hiperemis</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Bulging" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_intak_bulging) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Bulging</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Retraksi" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_intak_retraksi) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Retraksi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Sklerotik"
                                                                value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_intak_sklerotik) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Sklerotik</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Sentral"
                                                                value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_perforasi_sentral) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Sentral</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Atik" value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_perforasi_atik) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Atik</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Marginal"
                                                                value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_perforasi_marginal) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Marginal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Lain-Lain"
                                                                value="1"
                                                                @if ($formkhusus['telingakanan'][0]->MT_perforasi_lain) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Lain-Lain</label>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" name="mtketeranganlain"
                                                        value="{{ $formkhusus['telingakanan'][0]->MT_keterangan_lain }}">

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kavum Timpani</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Mukosa</label>
                                                        <input type="text" class="form-control" name="mukosa"
                                                            value="{{ $formkhusus['telingakanan'][0]->MT_mukosa }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Oslkel</label>
                                                        <input type="text" class="form-control" name="oslkel"
                                                            value="{{ $formkhusus['telingakanan'][0]->MT_osikal }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Isthmus
                                                            timpani/anterior
                                                            timpani/posterior timpani</label>
                                                        <input type="text" class="form-control" name="Isthmus"
                                                            value="{{ $formkhusus['telingakanan'][0]->MT_isthmus }}">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lain - Lain</td>
                                            <td>
                                                <textarea class="form-control" name="keteranganlain">{{ $formkhusus['telingakanan'][0]->lain_lain }}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <h5 class="text-danger">Tidak ada pemeriksaan khusus</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning">Telinga Kiri</div>
                            <div class="card-body">
                                @if ($formkhusus['cek2'] > 0)
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Liang Telinga</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Lapang" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_lapang == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Lapang
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Sempit" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Sempit == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Sempit
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Destruksi" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_dataSetestruksi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Destruksi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Serumen" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Serumen == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Serumen</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Sekret" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Sekret</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Jamur" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Jamur</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Kolesteatoma" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Kolesteatoma</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Massa atau Jaringan" name="Kolesteatoma"
                                                                value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Massa_Jaringan == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Massa
                                                                atau
                                                                Jaringan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="Benda Asing" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Benda_asing == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Benda
                                                                Asing</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                name="LT Lain-Lain" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->LT_Lain_lain == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">LT
                                                                Lain-Lain</label>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" name="ltketeranganlain"
                                                        value="{{ $formkhusus['telingakiri'][0]->LT_Keterangan_lain }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Membran Timpan</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Normal" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_intak_normal) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Normal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Hiperemis"
                                                                value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_intak_hiperemis) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Hiperemis</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Bulging" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_intak_bulging) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Bulging</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Retraksi" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_intak_retraksi) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Retraksi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Intak - Sklerotik"
                                                                value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_intak_sklerotik) checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Intak
                                                                -
                                                                Sklerotik</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Sentral"
                                                                value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_perforasi_sentral) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Sentral</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Atik" value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_perforasi_atik) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Atik</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Marginal"
                                                                value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_perforasi_marginal) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Marginal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Perforasi - Lain-Lain"
                                                                value="1"
                                                                @if ($formkhusus['telingakiri'][0]->MT_perforasi_lain) checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Perforasi
                                                                -
                                                                Lain-Lain</label>
                                                        </div>
                                                    </div>
                                                    <input class="form-control" name="mtketeranganlain"
                                                        value="{{ $formkhusus['telingakiri'][0]->MT_keterangan_lain }}">

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kavum Timpani</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Mukosa</label>
                                                        <input type="text" class="form-control" name="mukosa"
                                                            value="{{ $formkhusus['telingakiri'][0]->MT_mukosa }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Oslkel</label>
                                                        <input type="text" class="form-control" name="oslkel"
                                                            value="{{ $formkhusus['telingakiri'][0]->MT_osikal }}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Isthmus
                                                            timpani/anterior
                                                            timpani/posterior timpani</label>
                                                        <input type="text" class="form-control" name="Isthmus"
                                                            value="{{ $formkhusus['telingakiri'][0]->MT_isthmus }}">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lain - Lain</td>
                                            <td>
                                                <textarea class="form-control" name="keteranganlain">{{ $formkhusus['telingakiri'][0]->lain_lain }}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <h5 class="text-danger">Tidak ada pemeriksaan khusus</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($formkhusus['cek2'] > 0)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-warning">Kesimpulan</div>
                                <div class="card-body">
                                    {{ $formkhusus['telingakanan'][0]->kesimpulan }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($formkhusus['cek2'] > 0)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-warning">Anjuran</div>
                                <div class="card-body">
                                    {{ $formkhusus['telingakanan'][0]->anjuran }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning">Hidung Kanan</div>
                            <div class="card-body">
                                @if ($formkhusus['cek3'] > 0)
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Kavum Nasi</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Lapang" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Lapang == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Lapang</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Sempit" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Sempit == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Sempit</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Mukosa Pucat" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Mukosa_pucat == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Mukosa
                                                                Pucat</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Mukosa Hiperemis" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Mukosa_hiperemis == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Mukosa
                                                                Hiperemis</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Kavum Nasi Mukosa Edema"
                                                                value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Mukosa_edema == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Kavum
                                                                Nasi Mukosa
                                                                Edema</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Massa" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Massa == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Massa</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Kavum Nasi Polip" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KN_Polip == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Kavum
                                                                Nasi
                                                                Polip</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Konka Inferior</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Eutrofi" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KI_Eutrofi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Eutrofi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Hipertrofi" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KI_Hipertrofi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Hipertrofi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Atrofi" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->KI_Atrofi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Atrofi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Meatus Medius</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Terbuka" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->MM_Terbuka == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Terbuka</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Tertutup" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->MM_Tertutup == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Tertutup</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Mukosa Edema" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->MM_Mukosa_Edema == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Mukosa
                                                                Edema</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Septum</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Septum Polip" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->S_Polip == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Septum
                                                                Polip</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Sekret" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->S_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Sekret</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Lurus" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->S_Lurus == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Lurus</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Deviasi" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->S_Deviasi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Deviasi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Spina" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->S_Spina == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Spina</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nasofaring</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Normal" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->N_Normal == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Normal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Adenoid" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->N_Adenoid == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Adenoid</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Keradangan" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->N_Keradangan == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Keradangan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Massa" value="1"
                                                                @if ($formkhusus['hidungkanan'][0]->N_Massa == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Massa</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lain - Lain</td>
                                            <td>
                                                <textarea class="form-control" name="lain-lain">{{ $formkhusus['hidungkanan'][0]->lain_lain }}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <h5 class="text-danger">Tidak ada pemeriksaan khusus</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-warning">Hidung Kiri</div>
                            <div class="card-body">
                                @if ($formkhusus['cek4'] > 0)
                                    <table class="table table-sm">
                                        <tr>
                                            <td>Kavum Nasi</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Lapang" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Lapang == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Lapang</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Sempit" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Sempit == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Sempit</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Mukosa Pucat" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Mukosa_pucat == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Mukosa
                                                                Pucat</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Mukosa Hiperemis" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Mukosa_hiperemis == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Mukosa
                                                                Hiperemis</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Kavum Nasi Mukosa Edema"
                                                                value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Mukosa_edema == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Kavum
                                                                Nasi Mukosa
                                                                Edema</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Massa" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Massa == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Massa</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Kavum Nasi Polip" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KN_Polip == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Kavum
                                                                Nasi
                                                                Polip</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Konka Inferior</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Eutrofi" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KI_Eutrofi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Eutrofi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Hipertrofi" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KI_Hipertrofi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Hipertrofi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Atrofi" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->KI_Atrofi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Atrofi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Meatus Medius</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Terbuka" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->MM_Terbuka == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Terbuka</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Tertutup" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->MM_Tertutup == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Tertutup</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Mukosa Edema" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->MM_Mukosa_Edema == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Mukosa
                                                                Edema</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Septum</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Septum Polip" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->S_Polip == '1') checked @endif>
                                                            <label class="form-check-label" for="exampleCheck1">Septum
                                                                Polip</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Sekret" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->S_Sekret == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Sekret</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Lurus" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->S_Lurus == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Lurus</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Deviasi" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->S_Deviasi == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Deviasi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Spina" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->S_Spina == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Spina</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nasofaring</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Normal" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->N_Normal == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Normal</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Adenoid" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->N_Adenoid == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Adenoid</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Keradangan" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->N_Keradangan == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Keradangan</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="" name="Massa" value="1"
                                                                @if ($formkhusus['hidungkiri'][0]->N_Massa == '1') checked @endif>
                                                            <label class="form-check-label"
                                                                for="exampleCheck1">Massa</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lain - Lain</td>
                                            <td>
                                                <textarea class="form-control" name="lain-lain">{{ $formkhusus['hidungkiri'][0]->lain_lain }}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <h5 class="text-danger">Tidak ada pemeriksaan khusus</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($formkhusus['cek3'] > 0)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-warning">Kesimpulan</div>
                                <div class="card-body">
                                    {{ $formkhusus['hidungkanan'][0]->kesimpulan }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @elseif($formkhusus['keterangan'] == 'mata')
                @if ($formkhusus['cek'] > 0)
                <div class="col-md-12">
                    <img src="{{ $resume[0]->gambar_1 }}" alt="">
                </div>
                    <div class="col-md-12">
                        <table class="table table-sm">
                            <tr>
                                <td rowspan="2">Visus Dasar</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">OD</span>
                                        </div>
                                        <input readonly type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)" id="od_visus_dasar"
                                            name="od_visus_dasar" value="{{ $formkhusus['mata'][0]->vd_od }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PINHOLE</span>
                                        </div>
                                        <input readonly type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)" name="od_pinhole_visus_dasar"
                                            id="od_pinhole_visus_dasar"
                                            value="{{ $formkhusus['mata'][0]->vd_od_pinhole }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">OS</span>
                                        </div>
                                        <input readonly name="os_visus_dasar" id="os_visus_dasar"
                                            value="{{ $formkhusus['mata'][0]->vd_os }}" type="text"
                                            class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PINHOLE</span>
                                        </div>
                                        <input readonly name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar"
                                            type="text" class="form-control"
                                            value="{{ $formkhusus['mata'][0]->vd_os_pinhole }}"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">Refraktometer / streak</td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">OD : Sph</span>
                                        </div>
                                        <input readonly name="od_sph_refraktometer"
                                            value="{{ $formkhusus['mata'][0]->refraktometer_od_sph }}"
                                            id="od_sph_refraktometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cyl</span>
                                        </div>
                                        <input readonly type="text"
                                            value="{{ $formkhusus['mata'][0]->refraktometer_od_cyl }}"
                                            id="od_cyl_refraktometer" name="od_cyl_refraktometer"
                                            class="form-control" aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">X</span>
                                        </div>
                                        <input readonly id="od_x_refraktometer"
                                            value="{{ $formkhusus['mata'][0]->refraktometer_od_x }}"
                                            name="od_x_refraktometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">OS : Sph</span>
                                        </div>
                                        <input readonly id="os_sph_refraktometer"
                                            value="{{ $formkhusus['mata'][0]->refraktometer_os_sph }}"
                                            name="os_sph_refraktometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cyl</span>
                                        </div>
                                        <input readonly id="os_cyl_refraktometer"
                                            value="{{ $formkhusus['mata'][0]->refraktometer_os_cyl }}"
                                            name="os_cyl_refraktometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">X</span>
                                        </div>
                                        <input readonly id="os_x_refraktometer"
                                            value="{{ $formkhusus['mata'][0]->refraktometer_os_x }}"
                                            name="os_x_refraktometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">Lensometer</td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">OD : Sph</span>
                                        </div>
                                        <input readonly id="od_sph_Lensometer"
                                            value="{{ $formkhusus['mata'][0]->Lensometer_od_sph }}"
                                            name="od_sph_Lensometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cyl</span>
                                        </div>
                                        <input readonly id="od_cyl_Lensometer"
                                            value="{{ $formkhusus['mata'][0]->Lensometer_od_cyl }}"
                                            name="od_cyl_Lensometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">X</span>
                                        </div>
                                        <input readonly id="od_x_Lensometer"
                                            value="{{ $formkhusus['mata'][0]->Lensometer_od_x }}"
                                            name="od_x_Lensometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">OS : Sph</span>
                                        </div>
                                        <input readonly id="os_sph_Lensometer"
                                            value="{{ $formkhusus['mata'][0]->Lensometer_os_sph }}"
                                            name="os_sph_Lensometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cyl</span>
                                        </div>
                                        <input readonly id="os_cyl_Lensometer"
                                            value="{{ $formkhusus['mata'][0]->Lensometer_os_cyl }}"
                                            name="os_cyl_Lensometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">X</span>
                                        </div>
                                        <input readonly id="os_x_Lensometer"
                                            value="{{ $formkhusus['mata'][0]->Lensometer_os_x }}"
                                            name="os_x_Lensometer" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan="2">Koreksi penglihatan jauh</td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">VOD : Sph</span>
                                        </div>
                                        <input readonly id="vod_sph_kpj"
                                            value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vod_sph }}"
                                            name="vod_sph_kpj" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cyl</span>
                                        </div>
                                        <input readonly id="vod_cyl_kpj"
                                            value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vod_cyl }}"
                                            name="vod_cyl_kpj" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">X</span>
                                        </div>
                                        <input readonly id="vod_x_kpj"
                                            value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vod_x }}"
                                            name="vod_x_kpj" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">VOS : Sph</span>
                                        </div>
                                        <input readonly type="text" id="vos_sph_kpj"
                                            value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vos_sph }}"
                                            name="vos_sph_kpj" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Cyl</span>
                                        </div>
                                        <input readonly id="vos_cyl_kpj"
                                            value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vos_cyl }}"
                                            name="vos_cyl_kpj" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">X</span>
                                        </div>
                                        <input readonly id="vos_x_kpj"
                                            value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vos_x }}"
                                            name="vos_x_kpj" type="text" class="form-control"
                                            aria-label="Amount (to the nearest dollar)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tajam penglihatan dekat</td>
                                <td colspan="3">
                                    <textarea readonly class="form-control" id="penglihatan_dekat" name="penglihatan_dekat">{{ $formkhusus['mata'][0]->tajampenglihatandekat }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Tekanan Intra Okular</td>
                                <td colspan="3">
                                    <textarea readonly class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $formkhusus['mata'][0]->tekananintraokular }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Catatan Pemeriksaan Lainnya</td>
                                <td colspan="3">
                                    <textarea readonly class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $formkhusus['mata'][0]->catatanpemeriksaanlain }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Palpebra</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->palpebra }}" id="palpebra"
                                        name="palpebra"></input></td>
                            </tr>
                            <tr>
                                <td>Konjungtiva</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->konjungtiva }}" id="konjungtiva"
                                        name="konjungtiva"></input></td>
                            </tr>
                            <tr>
                                <td>Kornea</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->kornea }}" name="kornea"
                                        id="kornea"></input></td>
                            </tr>
                            <tr>
                                <td>Bilik Mata Depan</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->bilikmatadepan }}"
                                        name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
                            </tr>
                            <tr>
                                <td>Pupil</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->pupil }}" id="pupil"
                                        name="pupil"></input></td>
                            </tr>
                            <tr>
                                <td>Iris</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->iris }}" name="iris"
                                        id="iris"></input></td>
                            </tr>
                            <tr>
                                <td>Lensa</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->lensa }}" name="lensa"
                                        id="lensa"></input></td>
                            </tr>
                            <tr>
                                <td>Funduskopi</td>
                                <td colspan="3"><input class="form-control" readonly
                                        value="{{ $formkhusus['mata'][0]->funduskopi }}" name="funduskopi"
                                        id="funduskopi"></input></td>
                            </tr>
                            <tr>
                                <td>Status Oftalmologis Khusus</td>
                                <td colspan="3">
                                    <textarea readonly class="form-control" name="oftamologis" id="oftamologis">{{ $formkhusus['mata'][0]->status_oftamologis_khusus }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Masalah Medis</td>
                                <td colspan="3">
                                    <textarea readonly class="form-control" name="masalahmedis" id="masalahmedis">{{ $formkhusus['mata'][0]->masalahmedis }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Prognosis</td>
                                <td colspan="3">
                                    <textarea readonly class="form-control" name="prognosis" id="prognosis">{{ $formkhusus['mata'][0]->prognosis }}</textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
            @elseif ($formkhusus['keterangan'] == 'gigi')
                @if ($formkhusus['cek'] > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-warning">Gambar Gigi</div>
                                <div class="card-body">
                                    <img src="{{ $resume[0]->gambar_1 }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-warning">Catatan</div>
                                <div class="card-body">
                                    <img src="{{ $resume[0]->gambar_1 }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
            @endif
            <div class="card">
                <div class="card-header bg-info">Riwayat Upload</div>
                <div class="card-body">
                    @if (count($riwayat_upload) > 0)
                        <table class="table table-sm">
                            <thead>
                                <th>Nama File</th>
                                <th>Unit</th>
                                <th>Tanggal Upload</th>
                            </thead>
                            <tbody>
                                @foreach ($riwayat_upload as $d)
                                    <tr>
                                        <td><img width="20px" src="{{ url('../../files/' . $d->gambar) }}"
                                                alt="" class="mr-3"> {{ $d->gambar }}</td>
                                        <td>{{ $d->nama_unit }}</td>
                                        <td>{{ $d->tgl_upload }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <h5>Tidak ada berkas yang diupload !</h5>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-danger">Riwayat Tindakan</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Kode layanan header</th>
                            <th>Kode layanan detail</th>
                            <th>Nama Tindakan</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_tindakan as $r)
                                @if ($r->status_header != '3')
                                    <tr>
                                        <td>{{ $r->kode_layanan_header }}</td>
                                        <td>{{ $r->id_detail }}</td>
                                        <td>{{ $r->NAMA_TARIF }}</td>
                                        <td>{{ $r->jumlah_layanan }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-danger">Riwayat Order Penunjang</div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Kode layanan header</th>
                            <th>Kode layanan detail</th>
                            <th>Nama Tindakan</th>
                            <th>Jumlah</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_order as $r)
                                @if ($r->status_header != '3')
                                    <tr>
                                        <td>{{ $r->kode_layanan_header }}</td>
                                        <td>{{ $r->id_detail }}</td>
                                        <td>{{ $r->NAMA_TARIF }}</td>
                                        <td>{{ $r->jumlah_layanan }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-danger">Riwayat Order Farmasi</div>
                <div class="card-body">
                    <table id="tabelorder_farmasi" class="table table-sm table-hover">
                        <thead>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_order_f as $r)
                                @if ($r->status_layanan_header != '3')
                                    <tr>
                                        <td>{{ $r->nama_barang }}</td>
                                        <td>{{ $r->kategori_resep }}</td>
                                        <td>{{ $r->satuan_barang }}</td>
                                        <td>{{ $r->jumlah_layanan }}</td>
                                        <td>{{ $r->aturan_pakai }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <table class="table mt-4">
                <thead>
                    <th>Nama Dokter</th>
                    <th>Tanda Tangan</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold text-md">{{ $resume[0]->nama_dokter }}</td>
                        <td>
                            @if ($resume[0]->signature == '')
                                @if ($resume[0]->pic == auth()->user()->id || $resume[0]->pic == '')
                                    <div id="signature-pad">
                                        <div
                                            style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
                                            <div id="note" onmouseover="my_function();">tulis tanda tangan
                                                didalam
                                                box ...
                                            </div>
                                            <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                        </div>
                                        <div style="margin:10px;">
                                            <input hidden type="" id="signature" name="signature">
                                            <button type="button" id="clear_btn" class="btn btn-danger"
                                                data-action="clear"><span class="glyphicon glyphicon-remove"></span>
                                                Clear</button>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <img src="{{ $resume[0]->signature }}" alt="">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table> --}}
            @if ($resume[0]->signature == '')
                @if ($resume[0]->pic == auth()->user()->id || $resume[0]->pic == '')
                    {{-- <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button> --}}
                    <div class="jumbotron">
                        <h1 class="display-2 mb-3">Terima Kasih !</h1>
                        <p class="lead">Anda telah mengisi form assesmen medis rawat jalan ... </p>
                        <p class="lead">Tindak lanjut pasien <br>
                            {{ $resume[0]->tindak_lanjut }} | keterangan : {{ $resume[0]->keterangan_tindak_lanjut }} </p>
                        <hr class="my-4">
                        <p>Pastikan data sudah terisi dengan benar.</p>
                        <a class="btn btn-success btn-lg" href="#" role="button"
                            onclick="simpantandatangan()">Simpan</a>
                    </div>
                @endif
            @else
                <button class="btn btn-danger float-right" onclick="ambildatapasien()">Kembali</button>
            @endif
        @else
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...
                </h3>
                <p>
                    Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
                </p>
            </div>
        @endif
    </div>
</div>
<script type="text/javascript" src="{{ asset('public/signature/js/signature.js') }}"></script>
<script>
    // var wrapper = document.getElementById("signature-pad");
    // var clearButton = wrapper.querySelector("[data-action=clear]");
    // var canvas = wrapper.querySelector("canvas");
    // var el_note = document.getElementById("note");
    // var signaturePad;
    // signaturePad = new SignaturePad(canvas);
    // clearButton.addEventListener("click", function(event) {
    //     document.getElementById("note").innerHTML = "The signature should be inside box";
    //     signaturePad.clear();
    // });

    // function my_function() {
    //     document.getElementById("note").innerHTML = "";
    // }

    function simpantandatangan() {
        kodekunjungan = $('#kodekunjungan').val()
        // var canvas = document.getElementById("the_canvas");
        // var dataUrl = canvas.toDataURL();
        // if (dataUrl ==
        //     'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAABkCAYAAADOvVhlAAADOklEQVR4Xu3UwQkAAAgDMbv/0m5xr7hAIcjtHAECBAikAkvXjBEgQIDACa8nIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECDweoABlt2MJjgAAAABJRU5ErkJggg=='
        // ) {
        //     dataUrl = ''
        // }
        // document.getElementById("signature").value = dataUrl;
        // signature = $('#signature').val()
        Swal.fire({
            icon: 'warning',
            title: 'Anda yakin data sudah benar ?',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Cek lagi ...`,
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan: kodekunjungan,
                        // signature
                    },
                    url: '<?= route('simpanttddokter') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: 'ermwaled2023'
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.kode == '502') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops',
                                text: data.message,
                                footer: 'ermwaled2023'
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: 'ermwaled2023'
                            })
                            ambildatapasien()
                        }
                    }
                });
            } else if (result.isDenied) {
                resume()
            }
        })

    }
</script>
